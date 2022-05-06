<?php

/**
 * Province filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseProvinceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'country_id' => new sfWidgetFormPropelChoice(array('model' => 'Country', 'add_empty' => true)),
      'name'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'country_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Country', 'column' => 'id')),
      'name'       => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('province_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Province';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'country_id' => 'ForeignKey',
      'name'       => 'Text',
    );
  }
}
