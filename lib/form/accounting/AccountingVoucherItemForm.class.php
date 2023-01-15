<?php

/**
 * AccountingVoucherItem form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class AccountingVoucherItemForm extends BaseAccountingVoucherItemForm
{
  public function configure()
  {
    $this->useFields(array('accounting_account_id','debit', 'credit'));

    $this->widgetSchema['accounting_account_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['accounting_account_id']->setOption('renderer_options', array(
      'model' => 'AccountingAccount',
      'url'   => $this->getOption('url'),
    ));
  }
}
