<?php

/**
 * CreditProductArrearRate filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseCreditProductArrearRateFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('credit_product_arrear_rate_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CreditProductArrearRate';
  }

  public function getFields()
  {
    return array(
      'product_id'     => 'ForeignKey',
      'rate_unique_id' => 'ForeignKey',
    );
  }
}
