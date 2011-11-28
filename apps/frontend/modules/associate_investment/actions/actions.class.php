<?php

/**
 * associate_investment actions.
 *
 * @package    fynance
 * @subpackage associate_investment
 * @author     Your name here
 */
class associate_investmentActions extends sfActions
{
  /**
   * List investments respect to one associate
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->associate = $this->getRoute()->getObject();
    
    $criteria = new Criteria();
    $criteria->add(InvestmentPeer::ASSOCIATE_ID, $this->associate->getId(), Criteria::EQUAL);

    $this->pager = new sfPropelPager('Investment',20);
    $this->pager->setCriteria($criteria);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->setPeerMethod('doSelectJoinProduct');
    $this->pager->init();
  }
}
