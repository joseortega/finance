<?php

/**
 * AccountingVoucher form base class.
 *
 * @method AccountingVoucher getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseAccountingVoucherForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'code'        => new sfWidgetFormInputText(),
      'reference'   => new sfWidgetFormInputText(),
      'date'        => new sfWidgetFormDate(),
      'observation' => new sfWidgetFormTextarea(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'code'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'reference'   => new sfValidatorString(array('max_length' => 60)),
      'date'        => new sfValidatorDate(),
      'observation' => new sfValidatorString(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'AccountingVoucher', 'column' => array('code')))
    );

    $this->widgetSchema->setNameFormat('accounting_voucher[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountingVoucher';
  }


}
