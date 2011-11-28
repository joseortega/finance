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
class UserValidatorSchema extends sfValidatorSchema
{

  public function  configure($options = array(), $messages = array()) 
  {
    $this->addMessage('password_old', 'The password is invalid.');

    parent::configure($options, $messages);
  }

  protected function doClean($values)
  {
    $user = sfGuardUserPeer::retrieveByPK($values['id']);
    
    if(!$user){
      throw new sfValidatorErrorSchema($this, array());
    }
    
    if(!$values['password_old']){
      throw new sfValidatorErrorSchema($this, array());
    }

    if(!$user->checkPassword($values['password_old'])){
      $error = new sfValidatorError($this, 'password_old');
      throw new sfValidatorErrorSchema($this, array('password_old'=>$error));
    }

    return $values;
  }

}
?>
