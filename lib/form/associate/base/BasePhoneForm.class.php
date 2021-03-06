<?php

/**
 * Phone form base class.
 *
 * @method Phone getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BasePhoneForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'associate_id' => new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => false)),
      'type'         => new sfWidgetFormInputText(),
      'number'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'associate_id' => new sfValidatorPropelChoice(array('model' => 'Associate', 'column' => 'id')),
      'type'         => new sfValidatorString(array('max_length' => 60)),
      'number'       => new sfValidatorString(array('max_length' => 25)),
    ));

    $this->widgetSchema->setNameFormat('phone[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Phone';
  }


}
