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
class CreditValidatorSchema extends sfValidatorSchema{

  public function  configure($options = array(), $messages = array()) 
  {
    $this->addMessage('pay_frequency_in_months', 'The frequency of payment is incompatible with the time.');
    $this->addMessage('account_id', 'The account does not belong to the associate.');

    parent::configure($options, $messages);
  }

  protected function doClean($values)
  {
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
    
    $payFrecquencyInMonths = $values['pay_frequency_in_months'];
    $timeInMoths = $values['time_in_months'];
    
    if(!$payFrecquencyInMonths){
      throw new sfValidatorErrorSchema($this, array());
    }
    
    if(!$timeInMoths){
      throw new sfValidatorErrorSchema($this, array());
    }
    
    $var = $timeInMoths/$payFrecquencyInMonths;

    if(!is_int($var)){
      $error = new sfValidatorError($this, 'pay_frequency_in_months');
      throw new sfValidatorErrorSchema($this, array('pay_frequency_in_months'=>$error));
    }

    return $values;
  }

}
?>
