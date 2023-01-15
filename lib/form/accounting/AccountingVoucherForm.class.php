<?php

/**
 * AccountingVoucher form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class AccountingVoucherForm extends BaseAccountingVoucherForm
{
  public function configure()
  {
      $this->useFields(array('code', 'reference', 'date', 'observation'));
  }
}
