<?php

/**
 * account_bankbook_history actions.
 *
 * @package    fynance
 * @subpackage account_bankbook_history
 * @author     Your name here
 */
class account_bankbook_historyActions extends sfActions
{
  /**
   * List bankbook respect to one account
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->account = AccountPeer::retrieveByPK($request->getParameter('id'));
    
    $criteria = new Criteria();
    $criteria->add(BankbookPeer::ACCOUNT_ID, $this->account->getId(), Criteria::EQUAL);
    $criteria->addDescendingOrderByColumn(BankbookPeer::ID);

    $this->pager = new sfPropelPager('Bankbook',20);
    $this->pager->setCriteria($criteria);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }
  
  /**
   * Execute show bankbook
   * 
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->forward404Unless($request->isXmlHttpRequest());
    
    $this->bankbook = BankbookPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->bankbook);
    
    return $this->renderPartial('detail', array('bankbook' => $this->bankbook));
  }
}
