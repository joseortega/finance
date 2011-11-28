<?php

/**
 * associate_contact actions.
 *
 * @package    fynance
 * @subpackage associate_contact
 * @author     Your name here
 */
class account_manageActions extends sfActions
{
  /**
   * Execute preDelete account
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->account = $this->getRoute()->getObject();
  }
}
