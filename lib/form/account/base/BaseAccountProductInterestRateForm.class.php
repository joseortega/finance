<?php

/**
 * AccountProductInterestRate form base class.
 *
 * @method AccountProductInterestRate getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseAccountProductInterestRateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'product_id'     => new sfWidgetFormInputHidden(),
      'rate_unique_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'product_id'     => new sfValidatorPropelChoice(array('model' => 'AccountProduct', 'column' => 'id', 'required' => false)),
      'rate_unique_id' => new sfValidatorPropelChoice(array('model' => 'RateUnique', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('account_product_interest_rate[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountProductInterestRate';
  }


}
