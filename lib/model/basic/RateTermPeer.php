<?php


/**
 * Skeleton subclass for performing query and update operations on the 'rate_term' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Aug  2 09:37:33 2011
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model.basic
 */
class RateTermPeer extends BaseRateTermPeer 
{
  /**
   * Add criteria by term
   * 
   * @param int $term
   * @param Criteria $criteria
   * @return Criteria 
   */
  public static function addTermCriteria($term, Criteria $criteria = null)
  {
    if(!$criteria){
      $criteria = new Criteria();
    }
    
    $criteria->add(self::MINIMUM_TIME, $term, Criteria::LESS_EQUAL);
    $criteria->add(self::MAXIMUM_TIME, $term, Criteria::GREATER_EQUAL);
    
    return $criteria;
  }
} // RateTermPeer