<?php

/**
 * Transaction filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseTransactionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'cash_id'             => new sfWidgetFormPropelChoice(array('model' => 'Cash', 'add_empty' => true)),
      'user_id'             => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'transaction_type_id' => new sfWidgetFormPropelChoice(array('model' => 'TransactionType', 'add_empty' => true)),
      'amount'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observation'         => new sfWidgetFormFilterInput(),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'credit_id'           => new sfWidgetFormPropelChoice(array('model' => 'Credit', 'add_empty' => true)),
      'account_id'          => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => true)),
      'bankbook_id'         => new sfWidgetFormPropelChoice(array('model' => 'Bankbook', 'add_empty' => true)),
      'account_balance'     => new sfWidgetFormFilterInput(),
      'investment_id'       => new sfWidgetFormPropelChoice(array('model' => 'Investment', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'cash_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Cash', 'column' => 'id')),
      'user_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'transaction_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TransactionType', 'column' => 'id')),
      'amount'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observation'         => new sfValidatorPass(array('required' => false)),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'credit_id'           => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Credit', 'column' => 'id')),
      'account_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Account', 'column' => 'id')),
      'bankbook_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Bankbook', 'column' => 'id')),
      'account_balance'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'investment_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Investment', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('transaction_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transaction';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'cash_id'             => 'ForeignKey',
      'user_id'             => 'ForeignKey',
      'transaction_type_id' => 'ForeignKey',
      'amount'              => 'Number',
      'observation'         => 'Text',
      'created_at'          => 'Date',
      'credit_id'           => 'ForeignKey',
      'account_id'          => 'ForeignKey',
      'bankbook_id'         => 'ForeignKey',
      'account_balance'     => 'Number',
      'investment_id'       => 'ForeignKey',
    );
  }
}
