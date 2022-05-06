<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvestmentValidatorSchema
 *
 * @author jose
 * @package fynance
 * @subpackage validator
 */

class InvestmentValidatorSchema extends sfValidatorSchema
{  
  /**
   * Configure validator
   * 
   * @param array $options
   * @param array $messages 
   */ 
  public function  configure($options = array(), $messages = array()) 
   {
    $this->addMessage('time_days', 'The interest rate does not support the given deadline.');
    $this->addMessage('account_id', 'The account does not belong to the associate.');
    $this->addMessage('account_transaction_type', 'Account: Transaction type is not configured, Admin.');
    $this->addMessage('investment_transaction_type', 'Investment: Transaction type is not configured, Admin.');
    $this->addMessage('amount', 'The amount is higher than the balance in the account.');
    
    $this->addOption('accountTransactionType');
    $this->addOption('investmentTransactionType');

    parent::configure($options, $messages);
  }

  /**
   * Do clean
   * 
   * @param type $values
   * @return type 
   */
  protected function doClean($values)
  {    
    $accountTransactionType = $this->getOption('accountTransactionType');
    if(!$accountTransactionType){
      $error = new sfValidatorError($this, 'account_transaction_type');
      throw new sfValidatorErrorSchema($this, array('account_transaction_type'=>$error));
    }
    
    $investmentTransactionType = $this->getOption('investmentTransactionType');
    if(!$investmentTransactionType){
      $error = new sfValidatorError($this, 'account_transaction_type');
      throw new sfValidatorErrorSchema($this, array('account_transaction_type'=>$error));
    }
    
    $associate = AssociatePeer::retrieveByPK($values['associate_id']);
    if(!$associate){
      throw new sfValidatorErrorSchema($this, array());
    }
    
    $account = AccountPeer::retrieveByPK($values['account_id']);
    if(!$account){
      throw new sfValidatorErrorSchema($this, array());
    }
    
    $criteria = new Criteria();
    $criteria->add(AccountPeer::ASSOCIATE_ID, $associate->getId(), Criteria::EQUAL);
    $criteria->add(AccountPeer::ID, $account->getId(), Criteria::EQUAL);
    
    $associateAccount = AccountPeer::doSelectOne($criteria);
    if(!$associateAccount){
      $error = new sfValidatorError($this, 'account_id');
      throw new sfValidatorErrorSchema($this, array('account_id'=>$error));
    }
    
    $product = InvestmentProductPeer::retrieveByPK($values['product_id']); 
    if(!$product){
      throw new sfValidatorErrorSchema($this, array());
    }
    
    $timeDays = (int) $values['time_days'];
    if(!$timeDays){
      throw new sfValidatorErrorSchema($this, array());
    }
    
    $rateTerm = $product->getInterestRate($timeDays);
    if(!$rateTerm){
      $error = new sfValidatorError($this, 'time_days');
      throw new sfValidatorErrorSchema($this, array('time_days'=>$error));
    }
    
    if($values['amount'] > $associateAccount->getAvailableBalance()){
      $error = new sfValidatorError($this, 'amount');
      throw new sfValidatorErrorSchema($this, array('amount'=>$error));
    }
    
    return $values;
  }
}

?>
