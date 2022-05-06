<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GruopForm
 *
 * @author jose
 */
class GroupForm extends sfGuardGroupForm{
  
  public function configure() {
    parent::configure();
     $this->widgetSchema['sf_guard_group_permission_list']->setOption('expanded', true);
  }
  //put your code here
}

?>
