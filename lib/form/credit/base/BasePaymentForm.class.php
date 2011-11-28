<?php

/**
 * Payment form base class.
 *
 * @method Payment getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BasePaymentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'credit_id'      => new sfWidgetFormPropelChoice(array('model' => 'Credit', 'add_empty' => false)),
      'transaction_id' => new sfWidgetFormPropelChoice(array('model' => 'CreditTransaction', 'add_empty' => true)),
      'number'         => new sfWidgetFormInputText(),
      'date'           => new sfWidgetFormDate(),
      'balance'        => new sfWidgetFormInputText(),
      'capital'        => new sfWidgetFormInputText(),
      'interest'       => new sfWidgetFormInputText(),
      'status'         => new sfWidgetFormInputText(),
      'days_in_arrear' => new sfWidgetFormInputText(),
      'arrear'         => new sfWidgetFormInputText(),
      'discount'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'credit_id'      => new sfValidatorPropelChoice(array('model' => 'Credit', 'column' => 'id')),
      'transaction_id' => new sfValidatorPropelChoice(array('model' => 'CreditTransaction', 'column' => 'id', 'required' => false)),
      'number'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'date'           => new sfValidatorDate(),
      'balance'        => new sfValidatorNumber(),
      'capital'        => new sfValidatorNumber(),
      'interest'       => new sfValidatorNumber(),
      'status'         => new sfValidatorString(array('max_length' => 30)),
      'days_in_arrear' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'arrear'         => new sfValidatorNumber(array('required' => false)),
      'discount'       => new sfValidatorNumber(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Payment', 'column' => array('transaction_id')))
    );

    $this->widgetSchema->setNameFormat('payment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Payment';
  }


}
