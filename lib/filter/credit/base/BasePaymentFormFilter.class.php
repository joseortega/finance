<?php

/**
 * Payment filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BasePaymentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'credit_id'      => new sfWidgetFormPropelChoice(array('model' => 'Credit', 'add_empty' => true)),
      'transaction_id' => new sfWidgetFormPropelChoice(array('model' => 'CreditTransaction', 'add_empty' => true)),
      'number'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'date'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'balance'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'capital'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'interest'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'days_in_arrear' => new sfWidgetFormFilterInput(),
      'arrear'         => new sfWidgetFormFilterInput(),
      'discount'       => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'credit_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Credit', 'column' => 'id')),
      'transaction_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'CreditTransaction', 'column' => 'id')),
      'number'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'date'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'balance'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'capital'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'interest'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'status'         => new sfValidatorPass(array('required' => false)),
      'days_in_arrear' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'arrear'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'discount'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('payment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Payment';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'credit_id'      => 'ForeignKey',
      'transaction_id' => 'ForeignKey',
      'number'         => 'Number',
      'date'           => 'Date',
      'balance'        => 'Number',
      'capital'        => 'Number',
      'interest'       => 'Number',
      'status'         => 'Text',
      'days_in_arrear' => 'Number',
      'arrear'         => 'Number',
      'discount'       => 'Number',
    );
  }
}
