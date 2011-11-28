<?php

/**
 * account_transaction_type_from_investment actions.
 *
 * @package    fynance
 * @subpackage account_transaction_type_from_investment
 * @author     Your name here
 */
class account_transaction_type_configurationActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->operationType = $request->getParameter('operation_type');
  
    $transactionType = TransactionTypePeer::retrieveByOperationType($this->operationType);
    
    $this->forward404Unless(
            $this->operationType == TransactionType::ACCOUNT_TRANSFER_FROM_ACCOUNT ||
            $this->operationType == TransactionType::ACCOUNT_TRANSFER_TO_ACCOUNT ||
            $this->operationType == TransactionType::ACCOUNT_TRANSFER_FROM_INVESTMENT ||
            $this->operationType == TransactionType::ACCOUNT_TRANSFER_TO_INVESTMENT ||
            $this->operationType == TransactionType::ACCOUNT_PAYMENT_CREDIT ||
            $this->operationType == TransactionType::ACCOUNT_DISBURSEMENT_CREDIT ||
            $this->operationType == TransactionType::ACCOUNT_INTEREST_CAPITALIZATION
    );
    
    if(!$transactionType){
      $transactionType = new TransactionType();
      $transactionType->setOperationType($this->operationType);
    }
    
    $this->form = new AccountTransactionTypeConfigurationForm($transactionType);
  }


  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    
    $this->operationType = $request->getParameter('operation_type');
    
    $transactionType = TransactionTypePeer::retrieveByOperationType($this->operationType);
    
    if(!$transactionType){
      $transactionType = new TransactionType();
      $transactionType->setOperationType($this->operationType);
    }
    
    $this->form = new AccountTransactionTypeConfigurationForm($transactionType);

    $this->processForm($request, $this->form);

    $this->setTemplate('index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      
      $AccountTransactionType = $form->save();
      
      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('account_transaction_type_configuration/index?operation_type='.$AccountTransactionType->getOperationType());
    }
    else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
