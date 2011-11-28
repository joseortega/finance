<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountTransactionValidatorSchema
 *
 * @author jose
 * @package    fynance
 * @subpackage validator
 */
class AccountTransactionValidatorSchema extends sfValidatorSchema
{
  public function  configure($options = array(), $messages = array()) 
  {
    $this->addMessage('amount', 'The amount is higher than the balance in the account.');
    $this->addMessage('transaction_type_id', 'The account does not accept this type of transaction.');
    $this->addMessage('cash_id', 'The amount is higher than the balance available in cash.');
    $this->addMessage('account_id', 'Required');
    $this->addMessage('cash', 'This Connection is not configured, Admin.');
    $this->addOption('cash');

    parent::configure($options, $messages);
  }

  protected function doClean($values)
  {
    $cash = $this->getOption('cash');
    
    $account = AccountPeer::retrieveByPK($values['account_transaction']['account_id']);
    
    if(!$account){
      throw new sfValidatorErrorSchema($this, array());
    }
    
    $accountProduct = $account->getProduct();
    
    $productTransactionType = AccountProductTransactionTypePeer::retrieveByPK($accountProduct->getId(), $values['transaction_type_id']);

    //Un error para typos de transacciones no aceptadas en cuenta
    if(!$productTransactionType){
      $error = new sfValidatorError($this, 'transaction_type_id');
      throw new sfValidatorErrorSchema($this, array('transaction_type_id'=>$error));
    }

    //error para transacciones de debito que exende al saldo disponible en caja o cuenta
    if($productTransactionType->getTransactionType()->getNature() == TransactionType::DEBIT){
      //error para caja
      if($productTransactionType->getTransactionType()->getCashBalanceIsAffect()){
        
        if(!$cash){
          $error = new sfValidatorError($this, 'cash');
          throw new sfValidatorErrorSchema($this, array('cash'=>$error));
        }
    
        if($values['amount'] > $cash->getBalance()){
          $error = new sfValidatorError($this, 'cash_id');
          throw new sfValidatorErrorSchema($this, array('amount'=>$error));
        }
      }
      //error para cuenta
      if ($values['amount'] > $account->getAvailableBalance())
      {
         $error = new sfValidatorError($this, 'amount');
         throw new sfValidatorErrorSchema($this, array('amount'=>$error));
      }
    }

    return $values;
  }

}
?>
