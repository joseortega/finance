<?php

/**
 * CreditProduct filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseCreditProductFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'amortization_type'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'grace_days'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'                        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'credit_product_interest_rate_list' => new sfWidgetFormPropelChoice(array('model' => 'RateUnique', 'add_empty' => true)),
      'credit_product_arrear_rate_list'   => new sfWidgetFormPropelChoice(array('model' => 'RateUnique', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                              => new sfValidatorPass(array('required' => false)),
      'amortization_type'                 => new sfValidatorPass(array('required' => false)),
      'grace_days'                        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'                        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'                        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'credit_product_interest_rate_list' => new sfValidatorPropelChoice(array('model' => 'RateUnique', 'required' => false)),
      'credit_product_arrear_rate_list'   => new sfValidatorPropelChoice(array('model' => 'RateUnique', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('credit_product_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addCreditProductInterestRateListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(CreditProductInterestRatePeer::PRODUCT_ID, CreditProductPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(CreditProductInterestRatePeer::RATE_UNIQUE_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(CreditProductInterestRatePeer::RATE_UNIQUE_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addCreditProductArrearRateListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(CreditProductArrearRatePeer::PRODUCT_ID, CreditProductPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(CreditProductArrearRatePeer::RATE_UNIQUE_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(CreditProductArrearRatePeer::RATE_UNIQUE_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'CreditProduct';
  }

  public function getFields()
  {
    return array(
      'id'                                => 'Number',
      'name'                              => 'Text',
      'amortization_type'                 => 'Text',
      'grace_days'                        => 'Number',
      'created_at'                        => 'Date',
      'updated_at'                        => 'Date',
      'credit_product_interest_rate_list' => 'ManyKey',
      'credit_product_arrear_rate_list'   => 'ManyKey',
    );
  }
}
