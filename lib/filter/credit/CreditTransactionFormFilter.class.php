<?php

/**
 * CreditTransaction filter form.
 *
 * @package    fynance
 * @subpackage filter
 * @author     Your name here
 */
class CreditTransactionFormFilter extends BaseCreditTransactionFormFilter
{
  public function configure()
  {
    $transactionFormFilter = new TransactionFormFilter();
    
    $this->mergeForm($transactionFormFilter);
    
    $this->useFields(array('user_id', 'credit_id', 'transaction_type_id', 'created_at'));
    
    $criteria = new Criteria();
    $criteria->add(TransactionTypePeer::TYPE, TransactionType::TYPE_CREDIT, Criteria::EQUAL);

    $this->widgetSchema['transaction_type_id']->setOption('criteria', $criteria);
    $this->validatorSchema['transaction_type_id']->setOption('criteria', $criteria);
    
    $this->widgetSchema['credit_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['credit_id']->setOption('renderer_options', array(
      'model' => 'Credit',
      'url'   => $this->getOption('url'),
    ));
  }
  
  public function addCashIdColumnCriteria(Criteria $criteria, $field, $value)
  {
    $colname = TransactionPeer::CASH_ID;
    
    $criteria->addJoin(CreditTransactionPeer::ID, TransactionPeer::ID, Criteria::LEFT_JOIN);

    if (is_array($value))
    {
      $values = $value;
      $value = array_pop($values);
      $criterion = $criteria->getNewCriterion($colname, $value);

      foreach ($values as $value)
      {
        $criterion->addOr($criteria->getNewCriterion($colname, $value));
      }

      $criteria->add($criterion);
    }
    else
    {
      $criteria->add($colname, $value);
    }
  }
  
  public function addCreatedAtColumnCriteria(Criteria $criteria, $field, $values)
  {
    $colname = TransactionPeer::CREATED_AT;
    
    $criteria->addJoin(CreditTransactionPeer::ID, TransactionPeer::ID, Criteria::LEFT_JOIN);

    if (isset($values['is_empty']) && $values['is_empty'])
    {
      $criteria->add($colname, null, Criteria::ISNULL);
    }
    else
    {
      $criterion = null;
      if (null !== $values['from'] && null !== $values['to'])
      {
        $criterion = $criteria->getNewCriterion($colname, $values['from'], Criteria::GREATER_EQUAL);
        $criterion->addAnd($criteria->getNewCriterion($colname, $values['to'], Criteria::LESS_EQUAL));
      }
      else if (null !== $values['from'])
      {
        $criterion = $criteria->getNewCriterion($colname, $values['from'], Criteria::GREATER_EQUAL);
      }
      else if (null !== $values['to'])
      {
        $criterion = $criteria->getNewCriterion($colname, $values['to'], Criteria::LESS_EQUAL);
      }

      if (null !== $criterion)
      {
        $criteria->add($criterion);
      }
    }
  }
  
  public function addTransactionTypeIdColumnCriteria(Criteria $criteria, $field, $value)
  {
    $colname = TransactionPeer::TRANSACTION_TYPE_ID;
    
    $criteria->addJoin(CreditTransactionPeer::ID, TransactionPeer::ID, Criteria::LEFT_JOIN);

    if (is_array($value))
    {
      $values = $value;
      $value = array_pop($values);
      $criterion = $criteria->getNewCriterion($colname, $value);

      foreach ($values as $value)
      {
        $criterion->addOr($criteria->getNewCriterion($colname, $value));
      }

      $criteria->add($criterion);
    }
    else
    {
      $criteria->add($colname, $value);
    }
  }
  
  public function addUserIdColumnCriteria(Criteria $criteria, $field, $value)
  {
    $colname = TransactionPeer::USER_ID;
    
    $criteria->addJoin(CreditTransactionPeer::ID, TransactionPeer::ID, Criteria::LEFT_JOIN);

    if (is_array($value))
    {
      $values = $value;
      $value = array_pop($values);
      $criterion = $criteria->getNewCriterion($colname, $value);

      foreach ($values as $value)
      {
        $criterion->addOr($criteria->getNewCriterion($colname, $value));
      }

      $criteria->add($criterion);
    }
    else
    {
      $criteria->add($colname, $value);
    }
  }
}
