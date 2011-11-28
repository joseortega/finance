<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserForm
 *
 * @author jose
 */
class UserForm extends sfGuardUserAdminForm
{
  public function configure() {
    parent::configure();

    $this->widgetSchema['password_old'] = new sfWidgetFormInputPassword();
    
    $this->validatorSchema['password_old'] = new sfValidatorString(array('max_length' => 128, 'required' => true));
    
    $this->validatorSchema['password']->setOption('required', true);
    
    $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];
    
    $this->widgetSchema['password_old']->setLabel('Your current password');
    
    $this->widgetSchema['password']->setLabel('Your new password');
    
    $this->useFields(array('password_old', 'password', 'password_again'));
    
    $this->widgetSchema->moveField('password_again', 'after', 'password');
    
    $this->mergePostValidator(new UserValidatorSchema());
       
  }
}

?>
