<?php

/**
 * GuaranteePersonal filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseGuaranteePersonalFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('guarantee_personal_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GuaranteePersonal';
  }

  public function getFields()
  {
    return array(
      'credit_id'    => 'ForeignKey',
      'associate_id' => 'ForeignKey',
    );
  }
}
