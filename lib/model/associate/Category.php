<?php


/**
 * Skeleton subclass for representing a row from the 'associate_category' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Feb 16 06:30:46 2011
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model.associate
 */
class Category extends BaseCategory 
{
  /**
   * Method toString
   * 
   * @return type 
   */
  public function  __toString() 
  {
    return $this->getName();
  }

} // AssociateCategory