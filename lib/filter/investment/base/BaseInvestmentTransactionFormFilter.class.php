<?php

/**
 * InvestmentTransaction filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseInvestmentTransactionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'investment_id' => new sfWidgetFormPropelChoice(array('model' => 'Investment', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'investment_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Investment', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('investment_transaction_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InvestmentTransaction';
  }

  public function getFields()
  {
    return array(
      'id'            => 'ForeignKey',
      'investment_id' => 'ForeignKey',
    );
  }
}
