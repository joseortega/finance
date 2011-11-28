<?php

/**
 * CreditTransactionPayment filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseCreditTransactionPaymentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'payment_id'     => new sfWidgetFormPropelChoice(array('model' => 'Payment', 'add_empty' => true)),
      'days_in_arrear' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'arrear'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'discount'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'payment_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Payment', 'column' => 'id')),
      'days_in_arrear' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'arrear'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'discount'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('credit_transaction_payment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CreditTransactionPayment';
  }

  public function getFields()
  {
    return array(
      'id'             => 'ForeignKey',
      'payment_id'     => 'ForeignKey',
      'days_in_arrear' => 'Number',
      'arrear'         => 'Number',
      'discount'       => 'Number',
    );
  }
}
