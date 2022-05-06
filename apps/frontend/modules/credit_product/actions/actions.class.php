<?php

/**
 * credit_product actions.
 *
 * @package    finance
 * @subpackage credit_product
 * @author     Jose Ortega
 */
class credit_productActions extends sfActions
{
  /**
   * Execute list credit-products
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {   
    $this->pager = new sfPropelPager('CreditProduct',20);
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
