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
class UserAdminForm extends sfGuardUserAdminForm{
  
  public function configure() 
  {
    parent::configure();  
    
    $this->widgetSchema['sf_guard_user_group_list']->setOption('expanded', true);
    $this->widgetSchema['sf_guard_user_permission_list']->setOption('expanded', true);
      
    if($this->isNew()){
      $this->validatorSchema['password']->setOption('required', true);
      $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];
    }  
  }
}

?>
