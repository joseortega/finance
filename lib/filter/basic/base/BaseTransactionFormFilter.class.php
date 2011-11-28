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
      'type'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'amount'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observation'         => new sfWidgetFormFilterInput(),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'cash_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Cash', 'column' => 'id')),
      'user_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'transaction_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TransactionType', 'column' => 'id')),
      'type'                => new sfValidatorPass(array('required' => false)),
      'amount'              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observation'         => new sfValidatorPass(array('required' => false)),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
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
      'type'                => 'Text',
      'amount'              => 'Number',
      'observation'         => 'Text',
      'created_at'          => 'Date',
    );
  }
}
