<?php

/**
 * investment_expired actions.
 *
 * @package    finance
 * @subpackage investment_expired
 * @author     Jose Ortega
 */
class investment_expiredActions extends sfActions
{
  /**
   * Execute list investment-expired
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->pager = new sfPropelPager('Investment',20);
    $this->pager->setCriteria(InvestmentPeer::addCriteriaExpired());
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }
}
