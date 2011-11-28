<?php

/**
 * Cash form base class.
 *
 * @method Cash getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseCashForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'agency_id'  => new sfWidgetFormPropelChoice(array('model' => 'Agency', 'add_empty' => false)),
      'name'       => new sfWidgetFormInputText(),
      'ip_address' => new sfWidgetFormInputText(),
      'balance'    => new sfWidgetFormInputText(),
      'status'     => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'agency_id'  => new sfValidatorPropelChoice(array('model' => 'Agency', 'column' => 'id')),
      'name'       => new sfValidatorString(array('max_length' => 60)),
      'ip_address' => new sfValidatorString(array('max_length' => 50)),
      'balance'    => new sfValidatorNumber(),
      'status'     => new sfValidatorString(array('max_length' => 50)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Cash', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('cash[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Cash';
  }


}
