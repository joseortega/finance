<?php

/**
 * account_transaction_history actions.
 *
 * @package    fynance
 * @subpackage account_transaction_history
 * @author     Your name here
 */
class account_transaction_historyActions extends sfActions
{
  /**
   * List transactions respect to one account
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->account = AccountPeer::retrieveByPK($request->getParameter('id'));
    
    $criteria = new Criteria();
    $criteria->add(TransactionPeer::ACCOUNT_ID, $this->account->getId(), Criteria::EQUAL);
    $criteria->addDescendingOrderByColumn(TransactionPeer::ID);    

    $this->pager = new sfPropelPager('Transaction',20);
    $this->pager->setCriteria($criteria);
    $this->pager->setPeerMethod('doSelectJoinAll');
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }
  
  /**
   * Execute show transaction
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->transaction = TransactionPeer::retrieveByPk($request->getParameter('transaction_id'));
    $this->forward404Unless($this->transaction);
    
    $this->account = $this->transaction->getAccount();
  }
}
