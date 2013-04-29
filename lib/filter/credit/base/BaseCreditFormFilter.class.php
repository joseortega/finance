<?php

/**
 * Credit filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseCreditFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'product_id'              => new sfWidgetFormPropelChoice(array('model' => 'CreditProduct', 'add_empty' => true)),
      'associate_id'            => new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => true)),
      'account_id'              => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => true)),
      'amount'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'balance'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'time_in_months'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pay_frequency_in_months' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'amortization_type'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'purpose'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'interest_rate'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'status'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'issued_at'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'disbursed_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'annulled_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'guarantee_personal_list' => new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'product_id'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'CreditProduct', 'column' => 'id')),
      'associate_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Associate', 'column' => 'id')),
      'account_id'              => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Account', 'column' => 'id')),
      'amount'                  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'balance'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'time_in_months'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pay_frequency_in_months' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'amortization_type'       => new sfValidatorPass(array('required' => false)),
      'purpose'                 => new sfValidatorPass(array('required' => false)),
      'interest_rate'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'status'                  => new sfValidatorPass(array('required' => false)),
      'issued_at'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'disbursed_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'annulled_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'guarantee_personal_list' => new sfValidatorPropelChoice(array('model' => 'Associate', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('credit_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addGuaranteePersonalListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(GuaranteePersonalPeer::CREDIT_ID, CreditPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(GuaranteePersonalPeer::ASSOCIATE_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(GuaranteePersonalPeer::ASSOCIATE_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Credit';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'product_id'              => 'ForeignKey',
      'associate_id'            => 'ForeignKey',
      'account_id'              => 'ForeignKey',
      'amount'                  => 'Number',
      'balance'                 => 'Number',
      'time_in_months'          => 'Number',
      'pay_frequency_in_months' => 'Number',
      'amortization_type'       => 'Text',
      'purpose'                 => 'Text',
      'interest_rate'           => 'Number',
      'status'                  => 'Text',
      'issued_at'               => 'Date',
      'disbursed_at'            => 'Date',
      'annulled_at'             => 'Date',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
      'guarantee_personal_list' => 'ManyKey',
    );
  }
}
