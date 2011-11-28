<?php

/**
 * Transaction filter form.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
class TransactionFormFilter extends BaseTransactionFormFilter
{
  public function configure()
  {
    $this->useFields(array('cash_id', 'user_id', 'transaction_type_id', 'created_at'));
  }
}
