<?php

/**
 * credit_transaction_history actions.
 *
 * @package    finance
 * @subpackage credit_transaction_history
 * @author     Jose Ortega
 */
class credit_transaction_historyActions extends sfActions
{
  /**
   * List transactions respect to one credit
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->credit = CreditPeer::retrieveByPK($request->getParameter('id'));

    $this->pager = new sfPropelPager('Transaction',20);
    $this->pager->setCriteria($this->buildCriteria($this->credit));
    $this->pager->setPeerMethod('doSelectJoinAll');
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }

  /**
   * Build criteria
   * 
   * @param Credit $credit
   * @return Criteria 
   */
  protected function buildCriteria(Credit $credit)
  {
    $criteria = new Criteria();
    $criteria->add(TransactionPeer::CREDIT_ID, $credit->getId(), Criteria::EQUAL);
    $criteria->addDescendingOrderByColumn(TransactionPeer::CREATED_AT);
    $criteria->addDescendingOrderByColumn(TransactionPeer::ID);

    return $criteria;
  }

  /**
   * Execute show transaction
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->credit = $this->getRoute()->getObject();
    
    $this->transaction = TransactionPeer::retrieveByPk($request->getParameter('transaction_id'));
    $this->forward404Unless($this->transaction);
  }
}
