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
class GeneralTransactionValidatorSchema extends sfValidatorSchema{

  public function  configure($options = array(), $messages = array()) {

    $this->addMessage('amount', 'The amount is higher than the balance available in cash.');
    $this->addMessage('cash', 'This Connection is not configured, Admin');
    $this->addOption('cash');

    parent::configure($options, $messages);
  }

  protected function doClean($values)
  {
    $cash = $this->getOption('cash');
    
    if(!$cash){
      $error = new sfValidatorError($this, 'cash');
      throw new sfValidatorErrorSchema($this, array('cash'=>$error));
    }
        
    $transactionType = TransactionTypePeer::retrieveByPK($values['transaction_type_id']);
    
    if(!$transactionType){
      throw new sfValidatorErrorSchema($this, array());
    }

    //error para transacciones de debito que exende al saldo disponible en caja o cuenta
    if($transactionType->getNature() == TransactionType::DEBIT)
    {
      //error para caja
      if($values['amount'] > $cash->getBalance())
      {
        $error = new sfValidatorError($this, 'amount');
        throw new sfValidatorErrorSchema($this, array('amount'=>$error));
      }
    }

    return $values;
  }

}
?>
