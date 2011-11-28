<?php

/**
 * associate_account actions.
 *
 * @package    finance
 * @subpackage associate_account
 * @author     Jose Ortega
 */
class associate_accountActions extends sfActions
{
  /**
   * List accounts respect to one associate
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->associate = $this->getRoute()->getObject();
    
    $criteria = new Criteria();
    $criteria->add(AccountPeer::ASSOCIATE_ID, $this->associate->getId(), Criteria::EQUAL);

    $this->pager = new sfPropelPager('Account',20);
    $this->pager->setCriteria($criteria);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->setPeerMethod('doSelectJoinProduct');
    $this->pager->init();
  }
}
