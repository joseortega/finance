<?php

/**
 * CreditTransactionPayment form base class.
 *
 * @method CreditTransactionPayment getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseCreditTransactionPaymentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'payment_id'     => new sfWidgetFormPropelChoice(array('model' => 'Payment', 'add_empty' => false)),
      'days_in_arrear' => new sfWidgetFormInputText(),
      'arrear'         => new sfWidgetFormInputText(),
      'discount'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'CreditTransaction', 'column' => 'id', 'required' => false)),
      'payment_id'     => new sfValidatorPropelChoice(array('model' => 'Payment', 'column' => 'id')),
      'days_in_arrear' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'arrear'         => new sfValidatorNumber(),
      'discount'       => new sfValidatorNumber(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'CreditTransactionPayment', 'column' => array('payment_id')))
    );

    $this->widgetSchema->setNameFormat('credit_transaction_payment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CreditTransactionPayment';
  }


}
