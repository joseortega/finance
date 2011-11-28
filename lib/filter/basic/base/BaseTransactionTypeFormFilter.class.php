<?php

/**
 * TransactionType filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseTransactionTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'type'                                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nature'                                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'cash_balance_is_affect'                => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'concept'                               => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'initials'                              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'operation_type'                        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'                            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'account_product_transaction_type_list' => new sfWidgetFormPropelChoice(array('model' => 'AccountProduct', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'type'                                  => new sfValidatorPass(array('required' => false)),
      'nature'                                => new sfValidatorPass(array('required' => false)),
      'cash_balance_is_affect'                => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'concept'                               => new sfValidatorPass(array('required' => false)),
      'initials'                              => new sfValidatorPass(array('required' => false)),
      'operation_type'                        => new sfValidatorPass(array('required' => false)),
      'created_at'                            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'                            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'account_product_transaction_type_list' => new sfValidatorPropelChoice(array('model' => 'AccountProduct', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('transaction_type_filters[%s]');

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

    $criteria->addJoin(AccountProductTransactionTypePeer::TRANSACTION_TYPE_ID, TransactionTypePeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(AccountProductTransactionTypePeer::PRODUCT_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(AccountProductTransactionTypePeer::PRODUCT_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'TransactionType';
  }

  public function getFields()
  {
    return array(
      'id'                                    => 'Number',
      'type'                                  => 'Text',
      'nature'                                => 'Text',
      'cash_balance_is_affect'                => 'Boolean',
      'concept'                               => 'Text',
      'initials'                              => 'Text',
      'operation_type'                        => 'Text',
      'created_at'                            => 'Date',
      'updated_at'                            => 'Date',
      'account_product_transaction_type_list' => 'ManyKey',
    );
  }
}
