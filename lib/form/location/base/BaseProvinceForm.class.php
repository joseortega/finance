<?php

/**
 * Province form base class.
 *
 * @method Province getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseProvinceForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'country_id' => new sfWidgetFormPropelChoice(array('model' => 'Country', 'add_empty' => false)),
      'name'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'country_id' => new sfValidatorPropelChoice(array('model' => 'Country', 'column' => 'id')),
      'name'       => new sfValidatorString(array('max_length' => 50)),
    ));

    $this->widgetSchema->setNameFormat('province[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Province';
  }


}
