<?php

/**
 * InvestmentProductInterestRate filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseInvestmentProductInterestRateFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('investment_product_interest_rate_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InvestmentProductInterestRate';
  }

  public function getFields()
  {
    return array(
      'product_id'   => 'ForeignKey',
      'rate_term_id' => 'ForeignKey',
    );
  }
}
