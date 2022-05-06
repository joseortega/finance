<?php

/**
 * Investment form base class.
 *
 * @method Investment getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseInvestmentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'associate_id'    => new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => false)),
      'account_id'      => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => false)),
      'product_id'      => new sfWidgetFormPropelChoice(array('model' => 'InvestmentProduct', 'add_empty' => false)),
      'amount'          => new sfWidgetFormInputText(),
      'balance'         => new sfWidgetFormInputText(),
      'time_days'       => new sfWidgetFormInputText(),
      'expiration_date' => new sfWidgetFormDateTime(),
      'interest_rate'   => new sfWidgetFormInputText(),
      'tax_rate'        => new sfWidgetFormInputText(),
      'is_current'      => new sfWidgetFormInputCheckbox(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'associate_id'    => new sfValidatorPropelChoice(array('model' => 'Associate', 'column' => 'id')),
      'account_id'      => new sfValidatorPropelChoice(array('model' => 'Account', 'column' => 'id')),
      'product_id'      => new sfValidatorPropelChoice(array('model' => 'InvestmentProduct', 'column' => 'id')),
      'amount'          => new sfValidatorNumber(),
      'balance'         => new sfValidatorNumber(),
      'time_days'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'expiration_date' => new sfValidatorDateTime(),
      'interest_rate'   => new sfValidatorNumber(),
      'tax_rate'        => new sfValidatorNumber(),
      'is_current'      => new sfValidatorBoolean(),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('investment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Investment';
  }


}
