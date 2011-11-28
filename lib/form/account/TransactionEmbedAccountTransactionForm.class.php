<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TransactionEmbedAccountTransactionForm
 *
 * @author jose
 */
class TransactionEmbedAccountTransactionForm extends TransactionForm
{
  /**
   * Configure this form
   */
  public function configure() 
  {
    parent::configure();
    
    $accountTransactionForm = new AccountTransactionForm();
   
    $criteria = new Criteria();
    $criteria->add(TransactionTypePeer::TYPE, TransactionType::TYPE_ACCOUNT);
    $criteria->add(TransactionTypePeer::OPERATION_TYPE, TransactionType::CUSTOM);

    $this->widgetSchema['transaction_type_id']->setOption('criteria', $criteria);
    $this->validatorSchema['transaction_type_id']->setOption('criteria', $criteria);
    
    $accountTransactionForm->widgetSchema['account_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $accountTransactionForm->widgetSchema['account_id']->setOption('renderer_options', array(
      'model' => 'Account',
      'url'   => $this->getOption('url'),
    ));
    
    $this->getObject()->setAccountTransaction($accountTransactionForm->getObject());
    
    $this->embedForm('account_transaction', $accountTransactionForm);

    $this->mergePostValidator(new AccountTransactionValidatorSchema(null, array('cash'=> $this->getOption('cash'))));
  }
}

?>
