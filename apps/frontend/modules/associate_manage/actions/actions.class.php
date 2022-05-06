<?php

/**
 * associate_contact actions.
 *
 * @package    fynance
 * @subpackage associate_contact
 * @author     Your name here
 */
class associate_manageActions extends sfActions
{
  /**
   * Execute preDelete action
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->associate = $this->getRoute()->getObject();
  }
}
