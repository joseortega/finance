<?php

/**
 * InvestmentProductInterestRate form base class.
 *
 * @method InvestmentProductInterestRate getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseInvestmentProductInterestRateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'product_id'   => new sfWidgetFormInputHidden(),
      'rate_term_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'product_id'   => new sfValidatorPropelChoice(array('model' => 'InvestmentProduct', 'column' => 'id', 'required' => false)),
      'rate_term_id' => new sfValidatorPropelChoice(array('model' => 'RateTerm', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('investment_product_interest_rate[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InvestmentProductInterestRate';
  }


}
