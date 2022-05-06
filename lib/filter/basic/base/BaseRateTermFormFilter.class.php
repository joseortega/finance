<?php

/**
 * RateTerm filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseRateTermFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'minimum_time'                          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'maximum_time'                          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'value'                                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'investment_product_interest_rate_list' => new sfWidgetFormPropelChoice(array('model' => 'InvestmentProduct', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'minimum_time'                          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'maximum_time'                          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'value'                                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'                            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'investment_product_interest_rate_list' => new sfValidatorPropelChoice(array('model' => 'InvestmentProduct', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rate_term_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addInvestmentProductInterestRateListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(InvestmentProductInterestRatePeer::RATE_TERM_ID, RateTermPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(InvestmentProductInterestRatePeer::PRODUCT_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(InvestmentProductInterestRatePeer::PRODUCT_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'RateTerm';
  }

  public function getFields()
  {
    return array(
      'id'                                    => 'Number',
      'minimum_time'                          => 'Number',
      'maximum_time'                          => 'Number',
      'value'                                 => 'Number',
      'created_at'                            => 'Date',
      'investment_product_interest_rate_list' => 'ManyKey',
    );
  }
}
