<?php

/**
 * AccountingVoucherItem filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseAccountingVoucherItemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'accounting_voucher_id' => new sfWidgetFormPropelChoice(array('model' => 'AccountingVoucher', 'add_empty' => true)),
      'accounting_account_id' => new sfWidgetFormPropelChoice(array('model' => 'AccountingAccount', 'add_empty' => true)),
      'debit'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'credit'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'accounting_voucher_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AccountingVoucher', 'column' => 'id')),
      'accounting_account_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AccountingAccount', 'column' => 'id')),
      'debit'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'credit'                => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('accounting_voucher_item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountingVoucherItem';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'accounting_voucher_id' => 'ForeignKey',
      'accounting_account_id' => 'ForeignKey',
      'debit'                 => 'Number',
      'credit'                => 'Number',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
    );
  }
}
