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
class AccountTransactionForm extends TransactionForm
{
  /**
   * Configure this form
   */
  public function configure() 
  {
    parent::configure();
    
    $this->useFields(array('account_id', 'transaction_type_id', 'amount', 'observation'));

    $criteria = new Criteria();
    $criteria->add(TransactionTypePeer::TYPE, TransactionType::TYPE_ACCOUNT);
    $criteria->add(TransactionTypePeer::OPERATION_TYPE, TransactionType::CUSTOM);

    $this->widgetSchema['transaction_type_id']->setOption('criteria', $criteria);
    $this->validatorSchema['transaction_type_id']->setOption('criteria', $criteria);
    
    $this->widgetSchema['account_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['account_id']->setOption('renderer_options', array(
      'model' => 'Account',
      'url'   => $this->getOption('url'),
    ));
    

    $this->mergePostValidator(new AccountTransactionValidatorSchema(null, array('cash'=> $this->getOption('cash'))));
  }
}

?>
