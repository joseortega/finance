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

class AccountBalanceBlockValidatorSchema extends sfValidatorSchema
{
  /**
   * Options configure 
   * @param type $options
   * @param type $messages 
   */
  public function  configure($options = array(), $messages = array()) 
  {
    $this->addMessage('amount_block', 'The amount is higher than the balance in the account.');
    $this->addOption('account');

    parent::configure($options, $messages);
  }

  /**
   * Do clean
   * @param type $values
   * @return type 
   */
  protected function doClean($values)
  {
    $account = $this->getOption('account');
    
    if(!$account) {
      throw new sfValidatorErrorSchema($this, array());
    }
    
    if($values['amount'] > $account->getAvailableBalance()) {

      $error = new sfValidatorError($this, 'amount_block');
      throw new sfValidatorErrorSchema($this, array('amount'=>$error));

    }

    return $values;
  }

}
?>
