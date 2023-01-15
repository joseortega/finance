<?php


/**
 * Skeleton subclass for performing query and update operations on the 'credit_amortization' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Wed Apr 13 13:25:41 2011
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model.credit
 */
class PaymentPeer extends BasePaymentPeer
{  
  /**
   * Return the sum of the values ​​of a given column
   * 
   * @param type $column
   * @param Criteria $criteria 
   */
  public static function sum($column, Criteria $criteria = null)
  {
    if(!$criteria){
      $criteria = new Criteria();
    }
    
    $criteria->clearSelectColumns()->addSelectColumn('SUM(' . $column . ')');
    $stmt = self::doSelectStmt($criteria);

    $row = $stmt->fetch(PDO::FETCH_NUM);
    $sum= $row[0];
    
    return $sum;
  }
  
  /**
   * Return the sum arrear
   * 
   * @param array $payments 
   */
  public static function sumArrear($payments)
  {
    $amount = 0.00;
    
    foreach ($payments as $payment){
      $amount = $amount + $payment->getArrear();
    }
    
    return $amount;
  }
  
  /**
   * Returns the sum of capital
   * 
   * @param array $payments
   * @return decimal 
   */
  public static function sumCapital($payments)
  {
    $amount = 0.00;
    
    foreach ($payments as $payment){
      $amount = $amount + $payment->getCapital();
    }
    
    return $amount;
  }
  
  /**
   * Returns the sum of interest
   * 
   * @param array $payments
   * @return decimal 
   */
  public static function sumInterest($payments)
  {
    $amount = 0.00;
    
    foreach ($payments as $payment){
      $amount = $amount + $payment->getInterest();
    }
    
    return $amount;
  }
  
  /**
   * Returns the sum of interest
   * 
   * @param array $payments
   * @return decimal 
   */
  public static function sumDiscount($payments)
  {
    $amount = 0.00;
    
    foreach ($payments as $payment){
      $amount = $amount + $payment->getDiscount();
    }
    
    return $amount;
  }
  
  /**
   * Returns the sum of (interest + arrear + capital)
   * 
   * @param array $payments
   * @return decimal 
   */
  public static function sumAll($payments)
  {
    $amount = 0.00;
    
    foreach ($payments as $payment){
      $amount = $amount + $payment->getCapital() + $payment->getInterest() + $payment->getArrear() - $payment->getDiscount();
    }
    
    return $amount;
  }
  
  /**
   * Do select expired payments
   * 
   * @return array 
   */
  public static function doSelectExpired()
  {
    $now = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    
    $criteria = new Criteria();
    $criteria->add(self::STATUS, Payment::STATUS_UNPAID);
    $criteria->add(self::DATE, $now, Criteria::LESS_EQUAL);
    $criteria->addAscendingOrderByColumn(self::NUMBER);
    
    return self::doSelect($criteria);
  }
  
  /**
   *
   * @param sfGuardUser $user
   * @param Credit $credit
   * @param type $numbers
   * @param TransactionType $actTransactionType
   * @param TransactionType $cdtTransactionType
   * @param PropelPDO $con
   * @return Transaction 
   */
  public static function pay(sfGuardUser $user, Credit $credit, $numbers, TransactionType $actTransactionType, TransactionType $cdtTransactionType, PropelPDO $con = null)
  {
    $payments = $credit->getPaymentsPending($numbers);
    $account = $credit->getAccount();
    
    $amount = self::sumAll($payments);
    
    if($con == null){
      $con = Propel::getConnection(PaymentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    }
   
    $con->beginTransaction();
    try {
      
      $actTransaction = new Transaction($user, $actTransactionType, $amount);
      $actTransaction->setAccount($account);
      $actTransaction->save($con);
      
      $account->debit($amount, $con);
      $actTransaction->updateAccountBalance($account->getBalance(), $con);
        
      $cdtTransaction = new Transaction($user, $cdtTransactionType, $amount);
      $cdtTransaction->setCredit($credit);
      $cdtTransaction->save($con);
      
      $credit->accredit($amount, $con);
      
      foreach ($payments as $payment){
          
        $payment->setTransaction($cdtTransaction);
        $payment->setStatus(Payment::STATUS_PAID);
        $payment->setPaidAt(time());
        $payment->save($con);
      }
      
      if($credit->CountPaymentsPending()== 0){       
        $credit->setStatus(Credit::STATUS_PAID);  
        $credit->save($con);
      }
      
      $con->commit();

    } catch (Exception $e) {
      
      $con->rollBack();
      throw $e;
    }
    
    return $cdtTransaction;
  }
} // CreditAmortizationPeer