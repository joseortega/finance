<?php

/**
 * account_transaction_type_from_investment actions.
 *
 * @package    fynance
 * @subpackage account_transaction_type_from_investment
 * @author     Your name here
 */
class investment_transaction_type_configurationActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->operationType = $request->getParameter('operation_type');
  
    $transactionType = TransactionTypePeer::retrieveByOperationType($this->operationType);
    
    $this->forward404Unless(
            $this->operationType == TransactionType::INVESTMENT_TRANSFER_FROM_ACCOUNT ||
            $this->operationType == TransactionType::INVESTMENT_TRANSFER_TO_ACCOUNT ||
            $this->operationType == TransactionType::INVESTMENT_INTEREST_CAPITALIZATION ||
            $this->operationType == TransactionType::INVESTMENT_WITHHOLDING_TAX
    );
    
    if(!$transactionType){
      $transactionType = new TransactionType();
      $transactionType->setOperationType($this->operationType);
    }
    
    $this->form = new InvestmentTransactionTypeConfigurationForm($transactionType);
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
    
    $this->form = new InvestmentTransactionTypeConfigurationForm($transactionType);

    $this->processForm($request, $this->form);

    $this->setTemplate('index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      
      $transactionType = $form->save();
      
      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('investment_transaction_type_configuration/index?operation_type='.$transactionType->getOperationType());
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
