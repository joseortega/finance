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
class account_expired_capitalizationActions extends sfActions
{
  /**
   * Execute list accounts pending capitalization
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->pager = new sfPropelPager('Account',20);
    $this->pager->setCriteria(AccountPeer::addCriteriaExpiredCapitalization());
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }
}

?>
