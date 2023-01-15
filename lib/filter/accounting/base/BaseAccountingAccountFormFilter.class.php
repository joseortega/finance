<?php

/**
 * AccountingAccount filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseAccountingAccountFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'accounting_account_id'  => new sfWidgetFormPropelChoice(array('model' => 'AccountingAccount', 'add_empty' => true)),
      'accounting_exercise_id' => new sfWidgetFormPropelChoice(array('model' => 'AccountingExercise', 'add_empty' => true)),
      'code'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nature'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'debit'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'credit'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'balance'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'accounting_account_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AccountingAccount', 'column' => 'id')),
      'accounting_exercise_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AccountingExercise', 'column' => 'id')),
      'code'                   => new sfValidatorPass(array('required' => false)),
      'name'                   => new sfValidatorPass(array('required' => false)),
      'type'                   => new sfValidatorPass(array('required' => false)),
      'nature'                 => new sfValidatorPass(array('required' => false)),
      'debit'                  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'credit'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'balance'                => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('accounting_account_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountingAccount';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'accounting_account_id'  => 'ForeignKey',
      'accounting_exercise_id' => 'ForeignKey',
      'code'                   => 'Text',
      'name'                   => 'Text',
      'type'                   => 'Text',
      'nature'                 => 'Text',
      'debit'                  => 'Number',
      'credit'                 => 'Number',
      'balance'                => 'Number',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
