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

class TransferValidatorSchema extends sfValidatorSchema
{  
  public function  configure($options = array(), $messages = array()) 
  {
    $this->addMessage('account_origin_transaction_type', 'Account Origin: Transaction type is not configured, Admin');
    $this->addMessage('account_destination_transaction_type', 'Account Destination: Transaction type no configuration, Admin');
    $this->addMessage('amount', 'The amount is higher than the balance in the account.');
    $this->addMessage('account_destination_id', 'No puede transferir a una misma cuenta');

    parent::configure($options, $messages);
  }

  protected function doClean($values)
  {    
    $accountOriginTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_TRANSFER_ORIGIN_ACCOUNT);
    
    if(!$accountOriginTransactionType){
      $error = new sfValidatorError($this, 'account_origin_transaction_type');
      throw new sfValidatorErrorSchema($this, array('account_origin_transaction_type'=>$error));
    }
    
    $accountDestinationTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_TRANSFER_DESTINATION_ACCOUNT);
    
    if(!$accountDestinationTransactionType){
      $error = new sfValidatorError($this, 'account_destination_transaction_type');
      throw new sfValidatorErrorSchema($this, array('account_destination_transaction_type'=>$error));
    }
    
    $accountOrigin = AccountPeer::retrieveByPK($values['account_origin_id']);
    $accountDestination = AccountPeer::retrieveByPK($values['account_destination_id']);
    

    if(!$accountOrigin){
      throw new sfValidatorErrorSchema($this, array());
    }
    
    if(!$accountDestination){
      throw new sfValidatorErrorSchema($this, array());
    }
    
    if($accountOrigin->getId() == $accountDestination->getId())
    {
      $error = new sfValidatorError($this, 'account_destination_id');
      throw new sfValidatorErrorSchema($this, array('account_destination_id'=>$error));
    }
    
    if($accountOrigin->getAvailableBalance() < $values['amount'])
    {
      $error = new sfValidatorError($this, 'amount');
      throw new sfValidatorErrorSchema($this, array('amount'=>$error));
    }

    return $values;
  }
}

?>
