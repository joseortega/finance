<?php


/**
 * Skeleton subclass for performing query and update operations on the 'transaction_type' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun Jul 17 20:02:37 2011
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model.basic
 */
class TransactionTypePeer extends BaseTransactionTypePeer 
{  
  /**
   * Options nature attribute
   * 
   * @var array 
   */
  public static $nature = array(
      'debit' => 'Debit',
      'credit' => 'Credit',
  );

    /**
   * Select by TransactionType::TYPE_ACCOUNT and TransactionType::CUSTOM
   * 
   * @param Criteria $criteria
   * @return array object(TransactionType) 
   */
  public static function doSelectAccountCustom(Criteria $criteria)
  {  
    if($criteria==null){
      $criteria = new Criteria();
    }
    $criteria->add(self::TYPE, TransactionType::TYPE_ACCOUNT, Criteria::EQUAL);
    $criteria->add(self::OPERATION_TYPE, TransactionType::CUSTOM, Criteria::EQUAL);
    return self::doSelect($criteria);    
  }
  
  /**
   * Count by TransactionType::TYPE_ACCOUNT and TransactionType::CUSTOM
   * 
   * @param Criteria $criteria
   * @return int
   */
  public static function doCountAccountCustom(Criteria $criteria)
  {
    if($criteria==null){
      $criteria = new Criteria();
    }
    
    $criteria->add(self::TYPE, TransactionType::TYPE_ACCOUNT, Criteria::EQUAL);
    $criteria->add(self::OPERATION_TYPE, TransactionType::CUSTOM, Criteria::EQUAL);
    return self::doCount($criteria);    
  }
  
  /**
   * Select by TransactionType::TYPE_GENERAL
   * 
   * @param Criteria $criteria
   * @return array object(TransactionType)
   */
  public static function doSelectGeneral(Criteria $criteria)
  {
    if($criteria==null){
      $criteria = new Criteria();
    }
    
    $criteria->add(self::TYPE, TransactionType::TYPE_GENERAL, Criteria::EQUAL);
    return self::doSelect($criteria);    
  }
  
  /**
   * Count by TransactionType::TYPE_GENERAL
   * 
   * @param Criteria $criteria
   * @return int
   */
  public static function doCountGeneral(Criteria $criteria)
  {
    if($criteria==null){
      $criteria = new Criteria();
    }
    
    $criteria->add(self::TYPE, TransactionType::TYPE_GENERAL, Criteria::EQUAL);
    return self::doCount($criteria);    
  }
  
  /**
   * Retrieve one by operation type
   * 
   * @param type $operationType
   * @return TransactionType 
   */
  public static function retrieveByOperationType($operationType)
  {
    $criteria = new Criteria();
    $criteria->add(self::OPERATION_TYPE, $operationType, Criteria::EQUAL);
    
    return self::doSelectOne($criteria);
  }
} 
