<?php


/**
 * Skeleton subclass for representing a row from the 'transaction' table.
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
class Transaction extends BaseTransaction 
{
  /**
   * Type attribute = 'account'
   */
  const TYPE_ACCOUNT = 'account';
  
  /**
   * Type attribute = 'investment'
   */
  const TYPE_INVESTMENT = 'investment';
  
  /**
   * Type attribute = 'credit'
   */
  
  const TYPE_CREDIT = 'credit';
  
  /**
   * Type attribute = 'general'
   */
  const TYPE_GENERAL = 'general';
  
  /**
   * Initializes internal state of InvestmentTransaction object.
   * @see        parent::__construct()
   */
  public function __construct(sfGuardUser $user = null, TransactionType $transactionType = null, $amount = null, $observation = null, Cash $cash = null) 
  {
    $this->setUser($user);
    $this->setCash($cash);
    $this->setTransactionType($transactionType);;
    $this->setAmount($amount);
    $this->setObservation($observation);
    
    parent::__construct();
  }

  /**
   * Get isDebit
   * 
   * @return boolean 
   */
  public function isDebit()
  {
    $b = false;
    
    if($this->getTransactionType()->getNature() == TransactionType::DEBIT){
      
      $b = true;
    }
    
    return $b;
  }
  
  /**
   * Get isCredit
   * 
   * @return boolean 
   */
  public function isCredit()
  {
    $b = false;
    
    if($this->getTransactionType()->getNature() == TransactionType::CREDIT){
      
      $b = true;
    }
    
    return $b;
  }
  
  /**
   * Get isDeposit
   * 
   * @return boolean 
   */
  public function isDeposit()
  {
    $b = false;
    
    $nature = $this->getTransactionType()->getNature();
    $isCashAffect = $this->getTransactionType()->getCashBalanceIsAffect();
    
    if($nature == TransactionType::CREDIT && $isCashAffect == TRUE){
      $b = true;
    }
    
    return $b;
  }
  
  /**
   * Get isWithdrawal
   * 
   * @return boolean 
   */
  public function isWithdrawal()
  {
    $b = false;
    
    $nature = $this->getTransactionType()->getNature();
    $isCashAffect = $this->getTransactionType()->getCashBalanceIsAffect();
    
    if($nature==TransactionType::DEBIT && $isCashAffect == TRUE){
      $b = true;
    }
    
    return $b;
  }
  
  /**
   * Get isCreditNote
   * 
   * @return boolean 
   */
  public function isCreditNote()
  {
    $b = false;   
    
    $nature = $this->getTransactionType()->getNature();
    $isCashAffect = $this->getTransactionType()->getCashBalanceIsAffect();
    
    if($nature==TransactionType::CREDIT && $isCashAffect == FALSE){
      $b = true;
    }
    
    return $b;
  }
  
  /**
   * Get isDebitNote
   * 
   * @return boolean 
   */
  public function isDebitNote()
  {
    $b = false;
    
    $nature = $this->getTransactionType()->getNature();
    $isCashAffect = $this->getTransactionType()->getCashBalanceIsAffect();
    
    if($nature==TransactionType::DEBIT && $isCashAffect == FALSE){
      $b = true;
    }
    
    return $b;
  }
  
  /**
   * Get transaction type in format text
   * 
   * @return string 
   */
  public function getTypeOperationText()
  {
    $text = 'error';
    
    if($this->isDeposit()){
      $text = 'deposit';
    }elseif($this->isWithdrawal()){
      $text = 'withdrawal';
    }elseif($this->isCreditNote()){
      $text = 'credit_note';
    }elseif($this->isDebitNote()){
      $text = 'debit_note';
    }
       
    return $text;
  }
  
  /** Return Entity type
   * 
   * @return string 
   */
  public function getEntityType()
  {
    $entityType = null;
    
    if($this->getAccountId() != null){
        $entityType = 'account';
        
        if($this->getCashId() !=null){
            $entityType = 'account_cash';
        }
        
    }elseif($this->getInvestmentId() != null){
        $entityType = 'investment';
    }elseif($this->getCreditId() != null){
        $entityType = 'credit';
    }elseif($this->getCashId() != null){
        $entityType = 'cash';
    }
    
    return $entityType;
    
  }

  /**
   * update balance
   * 
   * @param PropelPDO $con 
   */
  public function updateAccountBalance($amount, PropelPDO $con = null)
  {
    if($con == NULL){
        $con = Propel::getConnection(TransactionPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
    }
    
    $con->beginTransaction();
    
    try {
        
        $this->setAccountBalance($amount);
        $this->save($con);
        
        $con->commit();
        
    }  catch (Exception $e){
        $con->rollBack();
    }
  }
  
  /**
   * Method toString
   * 
   * @return type 
   */
  public function __toString() 
  {
    return $this->getAmount();  ;
  }
  
} // Transaction