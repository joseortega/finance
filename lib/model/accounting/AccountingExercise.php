<?php


/**
 * Skeleton subclass for representing a row from the 'accounting_exercise' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Oct 26 04:26:25 2022
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model.accounting
 */
class AccountingExercise extends BaseAccountingExercise {
    
    public function __toString() {
        return $this->getCode();
    }

} // AccountingExercise