<?php

/**
 * CreditTransaction filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseCreditTransactionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'credit_id' => new sfWidgetFormPropelChoice(array('model' => 'Credit', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'credit_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Credit', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('credit_transaction_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CreditTransaction';
  }

  public function getFields()
  {
    return array(
      'id'        => 'ForeignKey',
      'credit_id' => 'ForeignKey',
    );
  }
}
