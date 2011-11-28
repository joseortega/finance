<?php

/**
 * RateUnique filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseRateUniqueFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'value'                              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'credit_product_interest_rate_list'  => new sfWidgetFormPropelChoice(array('model' => 'CreditProduct', 'add_empty' => true)),
      'credit_product_arrear_rate_list'    => new sfWidgetFormPropelChoice(array('model' => 'CreditProduct', 'add_empty' => true)),
      'account_product_interest_rate_list' => new sfWidgetFormPropelChoice(array('model' => 'AccountProduct', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'value'                              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'                         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'credit_product_interest_rate_list'  => new sfValidatorPropelChoice(array('model' => 'CreditProduct', 'required' => false)),
      'credit_product_arrear_rate_list'    => new sfValidatorPropelChoice(array('model' => 'CreditProduct', 'required' => false)),
      'account_product_interest_rate_list' => new sfValidatorPropelChoice(array('model' => 'AccountProduct', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rate_unique_filters[%s]');

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

    $criteria->addJoin(CreditProductInterestRatePeer::RATE_UNIQUE_ID, RateUniquePeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(CreditProductInterestRatePeer::PRODUCT_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(CreditProductInterestRatePeer::PRODUCT_ID, $value));
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

    $criteria->addJoin(CreditProductArrearRatePeer::RATE_UNIQUE_ID, RateUniquePeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(CreditProductArrearRatePeer::PRODUCT_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(CreditProductArrearRatePeer::PRODUCT_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addAccountProductInterestRateListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(AccountProductInterestRatePeer::RATE_UNIQUE_ID, RateUniquePeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(AccountProductInterestRatePeer::PRODUCT_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(AccountProductInterestRatePeer::PRODUCT_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'RateUnique';
  }

  public function getFields()
  {
    return array(
      'id'                                 => 'Number',
      'value'                              => 'Number',
      'created_at'                         => 'Date',
      'credit_product_interest_rate_list'  => 'ManyKey',
      'credit_product_arrear_rate_list'    => 'ManyKey',
      'account_product_interest_rate_list' => 'ManyKey',
    );
  }
}
