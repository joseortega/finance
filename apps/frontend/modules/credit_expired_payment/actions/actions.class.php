<?php

/**
 * credit_expired_payment actions.
 *
 * @package    finance
 * @subpackage credit_expired_payment
 * @author     Jose Ortega
 */
class credit_expired_paymentActions extends sfActions
{
  /**
   * Execute index (credits wthit expires payments)
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->pager = new sfPropelPager('Credit',20);
    $this->pager->setCriteria(CreditPeer::addCriteriaExpired());
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }
}
