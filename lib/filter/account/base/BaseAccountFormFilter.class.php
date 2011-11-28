<?php

/**
 * Account filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseAccountFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'associate_id'        => new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => true)),
      'product_id'          => new sfWidgetFormPropelChoice(array('model' => 'AccountProduct', 'add_empty' => true)),
      'number'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'balance'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'blocked_balance'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'available_balance'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_capitalization' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'next_capitalization' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'is_active'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'associate_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Associate', 'column' => 'id')),
      'product_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'AccountProduct', 'column' => 'id')),
      'number'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'balance'             => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'blocked_balance'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'available_balance'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'last_capitalization' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'next_capitalization' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'is_active'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('account_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Account';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'associate_id'        => 'ForeignKey',
      'product_id'          => 'ForeignKey',
      'number'              => 'Number',
      'balance'             => 'Number',
      'blocked_balance'     => 'Number',
      'available_balance'   => 'Number',
      'last_capitalization' => 'Date',
      'next_capitalization' => 'Date',
      'is_active'           => 'Boolean',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
