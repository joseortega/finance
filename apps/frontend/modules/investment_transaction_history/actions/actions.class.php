<?php

/**
 * investment_transaction_history actions.
 *
 * @package    finance
 * @subpackage investment_transaction_history
 * @author     Jose Ortega
 */
class investment_transaction_historyActions extends sfActions
{
  /**
   * List transactions respect to one investment
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->investment = $this->getRoute()->getObject();

    $this->pager = new sfPropelPager('Transaction',20);
    $this->pager->setCriteria($this->buildCriteria($this->investment));
    $this->pager->setPeerMethod('doSelectJoinAll');
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }

  /**
   * Build criteria
   * 
   * @param Investment $investment
   * @return Criteria 
   */
  protected function buildCriteria(Investment $investment)
  {
    $criteria = new Criteria();
    
    $criteria->add(TransactionPeer::INVESTMENT_ID, $investment->getId(), Criteria::EQUAL);
    $criteria->addDescendingOrderByColumn(TransactionPeer::CREATED_AT);
    $criteria->addDescendingOrderByColumn(TransactionPeer::ID);

    return $criteria;
  }

  /**
   * Execute show investment-transaction
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->investment = $this->getRoute()->getObject();
    
    $this->transaction = TransactionPeer::retrieveByPk($request->getParameter('transaction_id'));
    $this->forward404Unless($this->transaction);
  }
}
