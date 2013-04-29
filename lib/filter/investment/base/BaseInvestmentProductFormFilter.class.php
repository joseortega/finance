<?php

/**
 * InvestmentProduct filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseInvestmentProductFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'tax_rate'                              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'investment_product_interest_rate_list' => new sfWidgetFormPropelChoice(array('model' => 'RateTerm', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                                  => new sfValidatorPass(array('required' => false)),
      'tax_rate'                              => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'                            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'                            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'investment_product_interest_rate_list' => new sfValidatorPropelChoice(array('model' => 'RateTerm', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('investment_product_filters[%s]');

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

    $criteria->addJoin(InvestmentProductInterestRatePeer::PRODUCT_ID, InvestmentProductPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(InvestmentProductInterestRatePeer::RATE_TERM_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(InvestmentProductInterestRatePeer::RATE_TERM_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'InvestmentProduct';
  }

  public function getFields()
  {
    return array(
      'id'                                    => 'Number',
      'name'                                  => 'Text',
      'tax_rate'                              => 'Number',
      'created_at'                            => 'Date',
      'updated_at'                            => 'Date',
      'investment_product_interest_rate_list' => 'ManyKey',
    );
  }
}
