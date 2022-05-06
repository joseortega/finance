<?php

/**
 * investment_product actions.
 *
 * @package    finance
 * @subpackage investment_product
 * @author     Your name here
 */
class investment_productActions extends sfActions
{
  /**
   * Execute list investment products
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {   
    $this->pager = new sfPropelPager('InvestmentProduct',20);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }

  /**
   * Execute show product
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getObject();
  }
}
