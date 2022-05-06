<?php

/**
 * Email filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseEmailFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'associate_id' => new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => true)),
      'address'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'associate_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Associate', 'column' => 'id')),
      'address'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('email_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Email';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'associate_id' => 'ForeignKey',
      'address'      => 'Text',
    );
  }
}
