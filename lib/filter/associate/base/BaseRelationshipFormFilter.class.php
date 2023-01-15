<?php

/**
 * Relationship filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseRelationshipFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'associate_id' => new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => true)),
      'name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'phone_number' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'associate_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Associate', 'column' => 'id')),
      'name'         => new sfValidatorPass(array('required' => false)),
      'type'         => new sfValidatorPass(array('required' => false)),
      'phone_number' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('relationship_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Relationship';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'associate_id' => 'ForeignKey',
      'name'         => 'Text',
      'type'         => 'Text',
      'phone_number' => 'Text',
    );
  }
}
