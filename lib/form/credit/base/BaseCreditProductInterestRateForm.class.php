<?php

/**
 * CreditProductInterestRate form base class.
 *
 * @method CreditProductInterestRate getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseCreditProductInterestRateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'product_id'     => new sfWidgetFormInputHidden(),
      'rate_unique_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'product_id'     => new sfValidatorPropelChoice(array('model' => 'CreditProduct', 'column' => 'id', 'required' => false)),
      'rate_unique_id' => new sfValidatorPropelChoice(array('model' => 'RateUnique', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('credit_product_interest_rate[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CreditProductInterestRate';
  }


}
