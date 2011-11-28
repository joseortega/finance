<?php

/**
 * City filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseCityFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'province_id' => new sfWidgetFormPropelChoice(array('model' => 'Province', 'add_empty' => true)),
      'name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'province_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Province', 'column' => 'id')),
      'name'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('city_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'City';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'province_id' => 'ForeignKey',
      'name'        => 'Text',
    );
  }
}
