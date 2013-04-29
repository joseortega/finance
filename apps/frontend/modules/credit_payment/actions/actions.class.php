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
        $crdTransaction = PaymentPeer::pay($user, $this->credit, $number, $actTransactionType, $crdTransactionType);
                
      } catch (Exception $e) {
        
        $this->getUser()->setFlash('error', 'A persistence error occurred.'.$e);
        $this->setTemplate('index');
      }
      
      $this->getUser()->setFlash('notice', 'Payments have been made successfully.');
      $this->redirect('credit_transaction_history/show?id='.$this->credit->getId().'&transaction_id='.$crdTransaction->getId());

    }  else {
      
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
    
    $this->setTemplate('index');
  }
}
