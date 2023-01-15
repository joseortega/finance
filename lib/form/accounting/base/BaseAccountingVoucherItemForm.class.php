<?php

/**
 * AccountingVoucherItem form base class.
 *
 * @method AccountingVoucherItem getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseAccountingVoucherItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'accounting_voucher_id' => new sfWidgetFormPropelChoice(array('model' => 'AccountingVoucher', 'add_empty' => false)),
      'accounting_account_id' => new sfWidgetFormPropelChoice(array('model' => 'AccountingAccount', 'add_empty' => false)),
      'debit'                 => new sfWidgetFormInputText(),
      'credit'                => new sfWidgetFormInputText(),
      'created_at'            => new sfWidgetFormDateTime(),
      'updated_at'            => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'accounting_voucher_id' => new sfValidatorPropelChoice(array('model' => 'AccountingVoucher', 'column' => 'id')),
      'accounting_account_id' => new sfValidatorPropelChoice(array('model' => 'AccountingAccount', 'column' => 'id')),
      'debit'                 => new sfValidatorNumber(),
      'credit'                => new sfValidatorNumber(),
      'created_at'            => new sfValidatorDateTime(),
      'updated_at'            => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('accounting_voucher_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountingVoucherItem';
  }


}
