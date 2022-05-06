<?php

/**
 * CreditProductInterestRate filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseCreditProductInterestRateFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('credit_product_interest_rate_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CreditProductInterestRate';
  }

  public function getFields()
  {
    return array(
      'product_id'     => 'ForeignKey',
      'rate_unique_id' => 'ForeignKey',
    );
  }
}
