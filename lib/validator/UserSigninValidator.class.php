<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserValidator
 *
 * @author jose
 */
class UserSigninValidator extends sfGuardValidatorUser
{
  public function configure($options = array(), $messages = array()) {
    parent::configure($options, $messages);
    
    $this->addOption('throw_global_error', true);
  }
}

?>
