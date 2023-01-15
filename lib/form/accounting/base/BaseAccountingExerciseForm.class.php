<?php

/**
 * AccountingExercise form base class.
 *
 * @method AccountingExercise getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseAccountingExerciseForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'code'       => new sfWidgetFormInputText(),
      'name'       => new sfWidgetFormInputText(),
      'start_date' => new sfWidgetFormDate(),
      'end_date'   => new sfWidgetFormDate(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'code'       => new sfValidatorString(array('max_length' => 60)),
      'name'       => new sfValidatorString(array('max_length' => 60)),
      'start_date' => new sfValidatorDate(),
      'end_date'   => new sfValidatorDate(),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'AccountingExercise', 'column' => array('code')))
    );

    $this->widgetSchema->setNameFormat('accounting_exercise[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountingExercise';
  }


}
