<?php

/**
 * account_product actions.
 *
 * @package    fynance
 * @subpackage account_product
 * @author     Your name here
 */
class account_productActions extends sfActions
{
  /**
   * Execute List account products
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {   
    $this->pager = new sfPropelPager('AccountProduct',20);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }

  /**
   * Execute show account
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->product = AccountProductPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->product);
  }
}
