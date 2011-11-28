<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of actions
 *
 * @author jose
 */
class helpActions extends sfActions
{
  public function executeIndex()
  {
    $this->forward('notice_dev', 'index');
  }
}

?>
