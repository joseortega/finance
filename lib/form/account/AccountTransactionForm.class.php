<?php

/**
 * AccountTransaction form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class AccountTransactionForm extends BaseAccountTransactionForm
{
  /**
   * Configure this form
   */
  public function configure()
  {
    $this->useFields(array( 'account_id')); 
  }
}
