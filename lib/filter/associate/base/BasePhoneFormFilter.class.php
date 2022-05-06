<?php

/**
 * Phone filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BasePhoneFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'associate_id' => new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => true)),
      'type'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'number'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'associate_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Associate', 'column' => 'id')),
      'type'         => new sfValidatorPass(array('required' => false)),
      'number'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('phone_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Phone';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'associate_id' => 'ForeignKey',
      'type'         => 'Text',
      'number'       => 'Text',
    );
  }
}
