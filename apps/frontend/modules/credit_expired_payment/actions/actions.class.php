<?php

/**
 * credit_expired_payment actions.
 *
 * @package    finance
 * @subpackage credit_expired_payment
 * @author     Jose Ortega
 */
class credit_expired_paymentActions extends sfActions
{
  /**
   * Execute index (credits wthit expires payments)
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->pager = new sfPropelPager('Credit',20);
    $this->pager->setCriteria(CreditPeer::addCriteriaExpired());
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }
  
  /**
   * Pay the expired fee with reference to a credit
   * 
   * @param sfWebRequest $request 
   */
  public function executePayExpiredOneCredit(sfWebRequest $request)
  {
    $credit = CreditPeer::retrieveByPK($request->getParameter('id'));
    
    $this->forward404Unless($credit);
    
    $this->forward404if($credit->isPaid());
    
    $user  = $this->getUser()->getGuardUser();
    
    //get account transaction type
    $actTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_PAYMENT_CREDIT);
    
    if(!$actTransactionType){
      $this->getUser()->setFlash('error', 'Account: Transaction type is not configured, Admin.');
      $this->redirect('@credit_expired_payment');
    }
    
    //get credit transaction type
    $crdTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::CREDIT_PAYMENT_ACCOUNT);
    
    if(!$crdTransactionType){
      $this->getUser()->setFlash('error', 'Credit: Transaction type is not configured, Admin.');
      $this->redirect('@credit_expired_payment');
    }
    
    $payments = $credit->getExpiredPayments();
    
    try{
      
      $fNotice = 0;
      $fError = 0;
      
      foreach ($payments as $payment){
        
        $account = $payment->getCredit()->getAccount();
        
        if($account->hasAvailableBalance($payment->getTotal())){
          $payment->pay($user, $actTransactionType, $crdTransactionType);
          $fNotice = $fNotice +1;
        }else{
          $fError = $fError + 1;
        }
      }
    }catch(Exception $e){
      throw $e;
    }
    
    if($fNotice > 0){
      $this->getUser()->setFlash('notice', 'Payments have been made successfully.');
    }elseif($fError > 0){
      $this->getUser()->setFlash('error', 'The amount is higher than the balance in the account.');
    }
    
    $this->redirect('@credit_expired_payment');
  }

    /**
   * Pay the expired payments
   * 
   * @param sfWebRequest $request 
   */
  public function executePayExpiredAll(sfWebRequest $request)
  {
    $user  = $this->getUser()->getGuardUser();
    
    //get account transaction type
    $actTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_PAYMENT_CREDIT);
    
    if(!$actTransactionType){
      $this->getUser()->setFlash('error', 'Account: Transaction type is not configured, Admin.');
      $this->redirect('@credit_expired_payment');
    }
    
    //get credit transaction type
    $crdTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::CREDIT_PAYMENT_ACCOUNT);
    
    if(!$crdTransactionType){
      $this->getUser()->setFlash('error', 'Credit: Transaction type is not configured, Admin.');
      $this->redirect('@credit_expired_payment');
    }
    
    $payments = PaymentPeer::doSelectExpired();
    
    try{
      
      $fNotice = 0;
      $fError = 0;
      
      foreach ($payments as $payment){
        
        $account = $payment->getCredit()->getAccount();
        
        if($account->hasAvailableBalance($payment->getTotal())){
          $payment->pay($user, $actTransactionType, $crdTransactionType);
          $fNotice = $fNotice+1;
        }else{
          $fError = $fError+1;
        }
      }
    }catch(Exception $e){
      $this->getUser()->setFlash('error', 'A persistence error ocurred.');
      $this->redirect('@credit_expired_payment');
    }
    
    if($fNotice > 0){
      $this->getUser()->setFlash('notice', 'Payments have been made successfully.');
    }elseif($fError > 0){
      $this->getUser()->setFlash('error', 'The amount is higher than the balance in the account.');
    }
    
    $this->redirect('@credit_expired_payment');
  }
}
