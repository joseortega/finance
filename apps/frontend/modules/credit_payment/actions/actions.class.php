<?php

/**
 * credit_payment actions.
 *
 * @package    finance
 * @subpackage credit_payment
 * @author     Jose Ortega
 */
class credit_paymentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->credit = CreditPeer::retrieveByPK($request->getParameter('id'));
    
    $this->forward404Unless($this->credit);
    
    $this->forward404Unless($this->credit->isCurrent());
    
    $this->form = new PaymentCustomForm($this->credit, array('credit' => $this->credit));
    
    $value = $this->form->getDefault('number_payments');
    
    $this->getUser()->setAttribute('number_payments', $value);
    
    $this->amortizations = $this->credit->getPaymentsPending($value);
  }
  
  /**
   * Execute select of payments
   * 
   * @param sfWebRequest $request
   * @return _partial 
   */
  public function executeSelect(sfWebRequest $request)
  {
    $this->forward404Unless($request->isXmlHttpRequest());
    
    $query = $request->getParameter('query');
    
    $this->credit = CreditPeer::retrieveByPK($request->getParameter('id'));
    
    $amortizations = $this->credit->getPaymentsPending($query);
    
    return $this->renderPartial('credit_payment/list', array('amortizations' => $amortizations));
  }
  
  /**
   * Execute pay
   * 
   * @param sfWebRequest $request 
   */
  public function executePay(sfWebRequest $request)
  {
    $this->credit = CreditPeer::retrieveByPK($request->getParameter('id'));
    
    $this->forward404Unless($this->credit);
    
    $account = $this->credit->getAccount();
    
    $user  = $this->getUser()->getGuardUser();
    
    $actTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_PAYMENT_CREDIT);
    
    $crdTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::CREDIT_PAYMENT_ACCOUNT);
    
    $this->form = new PaymentCustomForm($this->credit, array(
        'accountTransactionType' => $actTransactionType,
        'creditTransactionType' => $crdTransactionType,
        'credit' => $this->credit,
    ));
    
    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    
    $this->amortizations = $this->credit->getPaymentsPending($this->getUser()->getAttribute('number_payments'));
    
    if($this->form->isValid()){
      
      try {
        
        $number = $this->form->getValue('number_payments');
        
        $payments = $this->credit->getPaymentsPending($number);
        
        $this->credit->pay($user, $actTransactionType, $crdTransactionType, $number);
        
      } catch (Exception $e) {
        
        $this->getUser()->setFlash('error', 'A persistence error occurred.');
        $this->setTemplate('index');
      }
      
      $this->getUser()->setFlash('notice', 'Payments have been made successfully.');
      $this->redirect('credit_amortization', $this->credit);

    }  else {
      
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
    
    $this->setTemplate('index');
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
