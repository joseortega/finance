<?php

/**
 * Transaction form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class TransactionForm extends BaseTransactionForm
{
  public function configure()
  {
    $this->useFields(array('transaction_type_id','amount', 'observation'));
    
    $this->widgetSchema['amount']->setAttribute('autocomplete', 'off');
    $this->validatorSchema['amount'] = new sfValidatorNumber(array('min'=>0.01, 'max'=>99999999.99));
  }
}
