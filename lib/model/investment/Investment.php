<?php


/**
 * Skeleton subclass for representing a row from the 'investment' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun Feb 20 09:15:59 2011
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model.investment
 */
class Investment extends BaseInvestment 
{ 
  /**
   *
   * @param type $amount
   * @param PropelPDO $con 
   */
  public function accredit($amount, PropelPDO $con = null)
  {
    if($con == NULL){
        $con = Propel::getConnection(InvestmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    }
    
    $con->beginTransaction();
    
    try {
        //set values $account
        $this->setBalance($this->getBalance() + $amount);
        $this->save($con);
        
        $con->commit();
        
    }  catch (Exception $e){
        
        $con->rollBack();
    }
    
  }
  
  /**
   *
   * @param type $amount
   * @param PropelPDO $con 
   */
  public function debit($amount, PropelPDO $con)
  {
    if($con == NULL){
        $con = Propel::getConnection(InvestmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    }
    
    $con->beginTransaction();
    
    try {
        //set values $account
        $this->setBalance($this->getBalance() - $amount);
        $this->save($con);
        
        $con->commit();
        
    } catch (Exception $exc) {
        
        $con->rollBack();
    }
  }
  
  /**
   * Get interestAmount
   * 
   * @return decimal 
   */
  public function getInterestAmount()
  {
    $interestAmount = ($this->getAmount()*($this->getTimeDays()/100)*$this->getInterestRate())/360;

    return round($interestAmount, 2);
  }

  /**
   * Get taxAmount
   * 
   * @return decimal
   */
  public function getTaxAmount()
  {
    $taxAmount = $this->getInterestAmount() * $this->getTaxRate()/100;

    return round($taxAmount, 2);
  }
    
  /**
   * Get finalAmount
   * 
   * @return decimal
   */
  public function getFinalAmount()
  {   
    $finalAmount = $this->getAmount() + $this->getInterestAmount() - $this->getTaxAmount();

    return $finalAmount;
  }
  
  /**
   * Get isExpired
   * 
   * @return boolean 
   */
  public function isExpired()
  {
    $b = false;
    
    if($this->getIsCurrent()){
      $expiresAt = $this->getExpirationDate('U');
      
      $expiresAt = mktime(0, 0, 0, date("m", $expiresAt)  , date("d", $expiresAt), date("Y", $expiresAt));
      $now = mktime(0, 0, 0, date("m")  , date("d"), date("Y"));
      
      if($now >= $expiresAt){
        $b = true;
      }
    }
    
    return $b;
  }
  
  /**
   * Get daysToExpire
   * 
   * @return integer
   */
  public function getDaysToExpire()
  {
    $now = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
    
    $expiresAt = $this->getExpirationDate('U');
    $expiresAt = mktime(0, 0, 0, date("m", $expiresAt)  , date("d", $expiresAt), date("Y", $expiresAt));

    $days = ($expiresAt - $now)/86400;
    
    return floor($days);
  }

    /**
   * Accredit to account
   * 
   * @param Cash $connection
   * @param sfGuardUser $user
   * @param TransactionType $invTransactionType
   * @param TransactionType $actTransactionType
   * @param PropelPDO $con 
   */
  public function accreditToAccount(sfGuardUser $user, TransactionType $invTransactionType, TransactionType $actTransactionType, PropelPDO $con = null)
  {
    $account = $this->getAccount();
    
    $amount = $this->getFinalAmount();
    
    if($con == null){
      $con = Propel::getConnection(TransactionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    }
    
    $con->beginTransaction();
    try
    {      
      $invTransaction = new Transaction($user, $invTransactionType, $amount);
      $invTransaction->setInvestment($this);
      $invTransaction->save($con);
      
      $this->debit($amount, $con);
      
      $actTransaction = new Transaction($user, $actTransactionType, $amount);
      $actTransaction->setAccount($account);
      $actTransaction->save($con);
      
      $account->accredit($amount, $con);
      $actTransaction->updateAccountBalance($account->getBalance(), $con);
      
      $this->setIsCurrent(false);
      $this->save();
      
      $con->commit();
    }
    catch (Exception $e)
    {
      $con->rollBack();
      throw $e;
    }
  }
  
  /**
   * Interest capitalization
   * 
   * @param Cash $connection
   * @param sfGuardUser $user
   * @param TransactionType $invTransactionType
   * @param PropelPDO $con 
   */
  public function interestCapitalization(sfGuardUser $user, TransactionType $invTransactionType, PropelPDO $con = null)
  {
    if($con == null){
      $con = Propel::getConnection(TransactionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    }
    
    $con->beginTransaction();
    
    try{
      
      $amount = $this->getInterestAmount();

      $transaction = new Transaction($user, $invTransactionType, $amount);
      $transaction->setInvestment($this);
      $transaction->save($con);
      
      $this->accredit($amount, $con);

      $con->commit();
      
    }catch (Exception $e){
      $con->rollBack();
      throw $e;
    }    
  }
  
  /**
   * Withholding tax
   * 
   * @param Cash $connection
   * @param sfGuardUser $user
   * @param TransactionType $invTransactionType
   * @param PropelPDO $con 
   */
  public function withholdingTax(sfGuardUser $user, TransactionType $invTransactionType, PropelPDO $con = null)
  {
    if($con == null){
      $con = Propel::getConnection(TransactionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    }
   
    $con->beginTransaction();
    
    try {
      $amount = $this->getTaxAmount();

      $transaction = new Transaction($user, $invTransactionType, $amount);
      $transaction->setInvestment($this);
      $transaction->save($con);
      
      $this->accredit($amount, $con);
      
      $con->commit();
      
    }catch (Exception $e){
      $con->rollBack();
      throw $e;
    }
  }
  
  /**
   * Get status in format text
   * 
   * @return string 
   */
  public function getStatusText()
  {
    $text = '';
    
    if($this->getIsCurrent()){
      if($this->isExpired()){
        $text = 'Expired';
      }else {
        $text = 'Current';
      }
    } else {
      $text = 'Repaid';
    }
    
    return $text;
  }

  /**
   * Method toString
   * 
   * @return string 
   */
  public function  __toString() 
  {
    return $this->getId().' / '.$this->getAssociate()->getName();
  }
} // Investment
