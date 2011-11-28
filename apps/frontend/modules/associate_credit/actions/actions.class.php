<?php

/**
 * associate_credit actions.
 *
 * @package    fynance
 * @subpackage associate_credit
 * @author     Your name here
 */
class associate_creditActions extends sfActions
{
  /**
   * List credits respect to one associate
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->associate = $this->getRoute()->getObject();
    
    $criteria = new Criteria();
    $criteria->add(CreditPeer::ASSOCIATE_ID, $this->associate->getId(), Criteria::EQUAL);

    $this->pager = new sfPropelPager('Credit',20);
    $this->pager->setCriteria($criteria);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->setPeerMethod('doSelectJoinProduct');
    $this->pager->init();
  }
}
