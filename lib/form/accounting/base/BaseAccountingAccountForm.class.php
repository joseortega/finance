<?php

/**
 * AccountingAccount form base class.
 *
 * @method AccountingAccount getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseAccountingAccountForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'accounting_account_id'  => new sfWidgetFormPropelChoice(array('model' => 'AccountingAccount', 'add_empty' => true)),
      'accounting_exercise_id' => new sfWidgetFormPropelChoice(array('model' => 'AccountingExercise', 'add_empty' => false)),
      'code'                   => new sfWidgetFormInputText(),
      'name'                   => new sfWidgetFormInputText(),
      'type'                   => new sfWidgetFormInputText(),
      'nature'                 => new sfWidgetFormInputText(),
      'debit'                  => new sfWidgetFormInputText(),
      'credit'                 => new sfWidgetFormInputText(),
      'balance'                => new sfWidgetFormInputText(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'accounting_account_id'  => new sfValidatorPropelChoice(array('model' => 'AccountingAccount', 'column' => 'id', 'required' => false)),
      'accounting_exercise_id' => new sfValidatorPropelChoice(array('model' => 'AccountingExercise', 'column' => 'id')),
      'code'                   => new sfValidatorString(array('max_length' => 60)),
      'name'                   => new sfValidatorString(array('max_length' => 254)),
      'type'                   => new sfValidatorString(array('max_length' => 30)),
      'nature'                 => new sfValidatorString(array('max_length' => 30)),
      'debit'                  => new sfValidatorNumber(),
      'credit'                 => new sfValidatorNumber(),
      'balance'                => new sfValidatorNumber(),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'AccountingAccount', 'column' => array('accounting_exercise_id', 'code')))
    );

    $this->widgetSchema->setNameFormat('accounting_account[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountingAccount';
  }


}
