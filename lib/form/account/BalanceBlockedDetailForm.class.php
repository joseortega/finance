<?php

/**
 * BalanceBlockDetail form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class BalanceBlockedDetailForm extends BaseBalanceBlockedDetailForm
{
  /**
   * Configure this form
   */
  public function configure()
  {
    $this->useFields(array('reason_block_id', 'amount'));
    
    $this->validatorSchema['amount'] = new sfValidatorNumber(array('min'=>0.01, 'max'=>99999999.99));
    
    $this->mergePostValidator(new AccountBalanceBlockValidatorSchema(null, array('account' => $this->getObject()->getAccount())));
  }
}
