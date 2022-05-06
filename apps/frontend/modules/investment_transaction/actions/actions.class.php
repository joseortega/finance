<?php

/**
 * investment_transaction actions.
 *
 * @package    finance
 * @subpackage investment_transaction
 * @author     Your name here
 */
class investment_transactionActions extends sfActions
{
  /**
   * Execute list investment-transaction
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
   * Execute filter transaction
   * 
   * @param sfWebRequest $request 
   */
  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->getFilterDefaults());

      $this->redirect('@investment_transaction');
    }

    $this->filters = new InvestmentTransactionFormFilter($this->getFilters(),  array(
        'url' => $this->getController()->genUrl('ajax/ajaxInvestment')
    ));

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@investment_transaction');
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
    $pager->setPage($this->getPage());
    $pager->setPeerMethod('doSelectJoinAll');
    $pager->init();

    return $pager;
  }

  /**
   * build criteria
   * 
   * @return Criteria 
   */
  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = new InvestmentTransactionFormFilter($this->getFilters(),  array(
          'url' => $this->getController()->genUrl('ajax/ajaxInvestment')
      ));
    }
    
    $criteria = $this->filters->buildCriteria($this->getFilters());
    $criteria->add(TransactionPeer::INVESTMENT_ID, null, Criteria::NOT_EQUAL);
    $criteria->addDescendingOrderByColumn(TransactionPeer::CREATED_AT);
    $criteria->addDescendingOrderByColumn(TransactionPeer::ID);
    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();

    return $criteria;
  }

  /**
   * Execute show investment-transaction
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->transaction = TransactionPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->transaction);
  }

  /**
   * Get filters
   * 
   * @return array 
   */
  protected function getFilters()
  {
    return $this->getUser()->getAttribute('investment_transaction.filters', $this->getFilterDefaults());
  }

  /**
   * Set filters
   * 
   * @param array $filters
   */
  protected function setFilters(array $filters)
  {
    $this->getUser()->setAttribute('investment_transaction.filters', $filters);
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
    $this->getUser()->setAttribute('investment_transaction.page', $page);
  }

  /**
   * Get page
   * 
   * @return int 
   */
  protected function getPage()
  {
    return $this->getUser()->getAttribute('investment_transaction.page', 1);
  }

  /**
   * Execute print transaction detail
   * 
   * @param sfWebRequest $request 
   */
  public function  executePrintDetail(sfWebRequest $request){
    
    $transaction = TransactionPeer::retrieveByPK($request->getParameter('id'));
    $this->forward404Unless($transaction);

    $documentTransaction = new Document();
    
    $pdf = $documentTransaction->pdfInvestmentTransaction($transaction, $this->getUser()->getCulture());

    $pdf->Output();

    exit();

    $this->setLayout(false);
  }
  
  /**
   * Print the transactions based to current filter
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
    
    $pdf = Document::pdfInvestmentTransactions($transactions, $this->getUser()->getCulture());
    
    $pdf->Output();

    exit();

    $this->setLayout(false);
  }
}
