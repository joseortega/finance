<?php

/**
 * Investment filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseInvestmentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'associate_id'    => new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => true)),
      'account_id'      => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => true)),
      'product_id'      => new sfWidgetFormPropelChoice(array('model' => 'InvestmentProduct', 'add_empty' => true)),
      'amount'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'balance'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'time_days'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'expiration_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'interest_rate'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tax_rate'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_current'      => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'associate_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Associate', 'column' => 'id')),
      'account_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Account', 'column' => 'id')),
      'product_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'InvestmentProduct', 'column' => 'id')),
      'amount'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'balance'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'time_days'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'expiration_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'interest_rate'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'tax_rate'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'is_current'      => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('investment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Investment';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'associate_id'    => 'ForeignKey',
      'account_id'      => 'ForeignKey',
      'product_id'      => 'ForeignKey',
      'amount'          => 'Number',
      'balance'         => 'Number',
      'time_days'       => 'Number',
      'expiration_date' => 'Date',
      'interest_rate'   => 'Number',
      'tax_rate'        => 'Number',
      'is_current'      => 'Boolean',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
