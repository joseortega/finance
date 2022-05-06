<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaymentValidatorSchema
 *
 * @author jose
 * @package fynance
 * @subpackage validator
 */

class PaymentValidatorSchema extends sfValidatorSchema
{  
  public function  configure($options = array(), $messages = array()) 
  {
    $this->addMessage('account_transaction_type', 'Investment: Transaction type is not configured, Admin');
    $this->addMessage('credit_transaction_type', 'Credit: Transaction type no configuration, Admin');
    $this->addMessage('amount', 'The amount is higher than the balance in the account.');
    
    $this->addOption('accountTransactionType');
    $this->addOption('creditTransactionType');
    $this->addOption('credit');

    parent::configure($options, $messages);
  }

  protected function doClean($values)
  {    
    $accountTransactionType = $this->getOption('accountTransactionType');
    if(!$accountTransactionType){
      $error = new sfValidatorError($this, 'account_transaction_type');
      throw new sfValidatorErrorSchema($this, array('account_transaction_type'=>$error));
    }
    
    $creditTransactionType = $this->getOption('creditTransactionType');
    if(!$creditTransactionType){
      $error = new sfValidatorError($this, 'credit_transaction_type');
      throw new sfValidatorErrorSchema($this, array('credit_transaction_type'=>$error));
    }
    
    $credit = $this->getOption('credit');
    
    $account = $credit->getAccount();
    
    $numberPayments = $values['number_payments'];
    
    if(sfContext::hasInstance()){
      sfContext::getInstance()->getUser()->setAttribute('number_payments', $numberPayments);
    }
    
    $amortizations = $credit->getPaymentsPending($numberPayments);
    
    if($account->getAvailableBalance() < PaymentPeer::sumAll($amortizations))
    {
      $error = new sfValidatorError($this, 'amount');
      throw new sfValidatorErrorSchema($this, array('amount'=>$error));
    }

    return $values;
  }
}

?>
