<?php

/**
 * Account form base class.
 *
 * @method Account getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseAccountForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'associate_id'        => new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => false)),
      'product_id'          => new sfWidgetFormPropelChoice(array('model' => 'AccountProduct', 'add_empty' => false)),
      'number'              => new sfWidgetFormInputText(),
      'balance'             => new sfWidgetFormInputText(),
      'blocked_balance'     => new sfWidgetFormInputText(),
      'available_balance'   => new sfWidgetFormInputText(),
      'last_capitalization' => new sfWidgetFormDate(),
      'next_capitalization' => new sfWidgetFormDate(),
      'is_active'           => new sfWidgetFormInputCheckbox(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'associate_id'        => new sfValidatorPropelChoice(array('model' => 'Associate', 'column' => 'id')),
      'product_id'          => new sfValidatorPropelChoice(array('model' => 'AccountProduct', 'column' => 'id')),
      'number'              => new sfValidatorInteger(array('min' => -9.2233720368548E+18, 'max' => 9223372036854775807)),
      'balance'             => new sfValidatorNumber(),
      'blocked_balance'     => new sfValidatorNumber(),
      'available_balance'   => new sfValidatorNumber(),
      'last_capitalization' => new sfValidatorDate(array('required' => false)),
      'next_capitalization' => new sfValidatorDate(array('required' => false)),
      'is_active'           => new sfValidatorBoolean(),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Account', 'column' => array('number')))
    );

    $this->widgetSchema->setNameFormat('account[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Account';
  }


}
