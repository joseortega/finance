<?php

/**
 * credit_transaction actions.
 *
 * @package    finance
 * @subpackage credit_transaction
 * @author     Jose Ortega
 */
class credit_transactionActions extends sfActions
{
  /**
   * Execute index (credit transactions list)
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
  }

  /**
   * Execute filter transactions
   * 
   * @param sfWebRequest $request 
   */
  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->getFilterDefaults());

      $this->redirect('@credit_transaction');
    }

    $this->filters = new CreditTransactionFormFilter($this->getFilters(), array(
        'url' => $this->getController()->genUrl('ajax/ajaxCredit')
    ));

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@credit_transaction');
    }

    $this->pager = $this->getPager();

    $this->setTemplate('index');
  }

  /**
   * Get pager
   *  
   * @return sfPropelPager 
   */
  protected function getPager()
  {
    $pager = new sfPropelPager('Transaction',20);
    $pager->setCriteria($this->buildCriteria());
    $pager->setPeerMethod('doSelectJoinAll');
    $pager->setPage($this->getPage());
    $pager->init();

    return $pager;
  }

  /**
   * Build criteria
   * 
   * @return Criteria 
   */
  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = new CreditTransactionFormFilter($this->getFilters(), array(
        'url' => $this->getController()->genUrl('ajax/ajaxCredit')
    ));
    }

    $criteria = $this->filters->buildCriteria($this->getFilters());
    
    $criteria->add(TransactionPeer::CREDIT_ID, null, Criteria::NOT_EQUAL);
    $criteria->addDescendingOrderByColumn(TransactionPeer::CREATED_AT);
    $criteria->addDescendingOrderByColumn(TransactionPeer::ID);
    
    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();

    return $criteria;
  }

  /**
   * Execute show credit transaction
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->transaction = $this->getRoute()->getObject();
   
  }

  /**
   * Get filters
   * 
   * @return array 
   */
  protected function getFilters()
  {
    return $this->getUser()->getAttribute('credit_transaction.filters', $this->getFilterDefaults());
  }

  /**
   * Set filters
   * 
   * @param array $filters
   */
  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('credit_transaction.filters', $filters);
  }

  /**
   * Get filters defaults
   * 
   * @return type 
   */
  public function getFilterDefaults()
  {
    return array();
  }

  /**
   * Set page
   *  
   * @param int $page 
   */
  protected function setPage($page)
  {
    $this->getUser()->setAttribute('credit_transaction.page', $page);
  }

  /**
   * Get page
   * 
   * @return int 
   */
  protected function getPage()
  {
    return $this->getUser()->getAttribute('credit_transaction.page', 1);
  }
  
  /**
   * Execute print detail in pdf
   * 
   * @param sfWebRequest $request 
   */
  public function  executePrintDetail(sfWebRequest $request)
  {
    $transaction = TransactionPeer::retrieveByPK($request->getParameter('id'));
    $this->forward404Unless($transaction);

    $pdf = Document::pdfCreditTransaction($transaction, $this->getUser()->getCulture());

    $pdf->Output();

    exit();

    $this->setLayout(false);
  }
  
  /**
   * Execute print current list in pdf
   * 
   * @param sfWebRequest $request 
   */
  public function executePrintList(sfWebRequest $request)
  {
    $orderBy = $request->getParameter('orderBy');

    $criteria = $this->buildCriteria();
    
    if($orderBy == Criteria::ASC){
      $criteria->clearOrderByColumns();
      $criteria->addAscendingOrderByColumn(TransactionPeer::ID);
    }
    
    $transactions = TransactionPeer::doSelectJoinAll($criteria);
    
    $pdf = Document::pdfCreditTransactions($transactions, $this->getUser()->getCulture());
    
    $pdf->Output();

    exit();

    $this->setLayout(false);
  }
}
