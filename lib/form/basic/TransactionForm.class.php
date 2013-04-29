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
    $this->widgetSchema['amount']->setAttribute('autocomplete', 'off');
    $this->validatorSchema['amount'] = new sfValidatorNumber(array('min'=>0.01, 'max'=>99999999.99));
  }
}
