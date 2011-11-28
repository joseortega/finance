<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserFormSignin
 *
 * @author jose
 */
class UserFormSignin extends sfGuardFormSignin
{
  public function configure() {
    parent::configure();
    
    $this->validatorSchema->setPostValidator(new UserSigninValidator());
  }
}

?>
