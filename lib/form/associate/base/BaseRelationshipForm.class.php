<?php

/**
 * Relationship form base class.
 *
 * @method Relationship getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseRelationshipForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'associate_id' => new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => false)),
      'name'         => new sfWidgetFormInputText(),
      'type'         => new sfWidgetFormInputText(),
      'phone_number' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'associate_id' => new sfValidatorPropelChoice(array('model' => 'Associate', 'column' => 'id')),
      'name'         => new sfValidatorString(array('max_length' => 100)),
      'type'         => new sfValidatorString(array('max_length' => 100)),
      'phone_number' => new sfValidatorString(array('max_length' => 25, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('relationship[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Relationship';
  }


}
