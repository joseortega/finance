<?php

/**
 * account_transaction_type_from_investment actions.
 *
 * @package    fynance
 * @subpackage account_transaction_type_from_investment
 * @author     Your name here
 */
class credit_transaction_type_configurationActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->operationType = $request->getParameter('operation_type');
  
    $transactionType = TransactionTypePeer::retrieveByOperationType($this->operationType);
    
    $this->forward404Unless(
            $this->operationType == TransactionType::CREDIT_APPROVAL ||
            $this->operationType == TransactionType::CREDIT_PAYMENT_ACCOUNT ||
            $this->operationType == TransactionType::CREDIT_DISBURSEMENT_ACCOUNT
    );
    
    if(!$transactionType){
      $transactionType = new TransactionType();
      $transactionType->setOperationType($this->operationType);
    }

    $this->form = new CreditTransactionTypeConfigurationForm($transactionType);
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
    
    $this->form = new CreditTransactionTypeConfigurationForm($transactionType);

    $this->processForm($request, $this->form);

    $this->setTemplate('index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      
      $AccountTransactionType = $form->save();
      
      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('credit_transaction_type_configuration/index?operation_type='.$AccountTransactionType->getOperationType());
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
