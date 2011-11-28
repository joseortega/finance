<?php

/**
 * AccountProduct filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseAccountProductFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'capitalization_frequency'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'                            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'account_product_transaction_type_list' => new sfWidgetFormPropelChoice(array('model' => 'TransactionType', 'add_empty' => true)),
      'account_product_interest_rate_list'    => new sfWidgetFormPropelChoice(array('model' => 'RateUnique', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'                                  => new sfValidatorPass(array('required' => false)),
      'capitalization_frequency'              => new sfValidatorPass(array('required' => false)),
      'created_at'                            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'                            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'account_product_transaction_type_list' => new sfValidatorPropelChoice(array('model' => 'TransactionType', 'required' => false)),
      'account_product_interest_rate_list'    => new sfValidatorPropelChoice(array('model' => 'RateUnique', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('account_product_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addAccountProductTransactionTypeListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(AccountProductTransactionTypePeer::PRODUCT_ID, AccountProductPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(AccountProductTransactionTypePeer::TRANSACTION_TYPE_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(AccountProductTransactionTypePeer::TRANSACTION_TYPE_ID, $value));
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

    $criteria->addJoin(AccountProductInterestRatePeer::PRODUCT_ID, AccountProductPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(AccountProductInterestRatePeer::RATE_UNIQUE_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(AccountProductInterestRatePeer::RATE_UNIQUE_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'AccountProduct';
  }

  public function getFields()
  {
    return array(
      'id'                                    => 'Number',
      'name'                                  => 'Text',
      'capitalization_frequency'              => 'Text',
      'created_at'                            => 'Date',
      'updated_at'                            => 'Date',
      'account_product_transaction_type_list' => 'ManyKey',
      'account_product_interest_rate_list'    => 'ManyKey',
    );
  }
}
