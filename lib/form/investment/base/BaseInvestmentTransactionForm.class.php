<?php

/**
 * InvestmentTransaction form base class.
 *
 * @method InvestmentTransaction getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseInvestmentTransactionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'investment_id' => new sfWidgetFormPropelChoice(array('model' => 'Investment', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Transaction', 'column' => 'id', 'required' => false)),
      'investment_id' => new sfValidatorPropelChoice(array('model' => 'Investment', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('investment_transaction[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InvestmentTransaction';
  }


}
