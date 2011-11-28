<?php

/**
 * general_transaction actions.
 *
 * @package    finance
 * @subpackage general_transaction
 * @author     Jose Ortega
 */
class general_transactionActions extends sfActions
{
  /**
   * Execute list transaction
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
    
    $this->cash = CashPeer::retrieveByPK($this->getUser()->getAttribute('cash_id'));
    
    if($this->cash){
      $this->pager = $this->getPager();
    }
  }

  /**
   * Ececute filter
   * 
   * @param sfWebRequest $request 
   */
  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->getFilterDefaults());

      $this->redirect('@general_transaction');
    }

    $this->filters = new GeneralTransactionFormFilter($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@general_transaction');
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
   * Build criteria
   * 
   * @return Criteria 
   */
  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = new GeneralTransactionFormFilter($this->getFilters());
    }
    
    $cash = CashPeer::retrieveByPK($this->getUser()->getAttribute('cash_id'));
    
    $criteria = $this->filters->buildCriteria($this->getFilters());
    $criteria->add(TransactionPeer::TYPE, Transaction::TYPE_GENERAL, Criteria::EQUAL);
    $criteria->add(TransactionPeer::CASH_ID, $cash->getId(), Criteria::EQUAL);
    $criteria->addDescendingOrderByColumn(TransactionPeer::CREATED_AT);
    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();

    return $criteria;
  }

  /**
   * Execute show transaction
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->transaction = $this->getRoute()->getObject();
    
    $this->cash = $this->transaction->getCash();
  }

  /**
   * Execute new transaction
   * 
   * @param sfWebRequest $request 
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->cash = CashPeer::retrieveByPK($this->getUser()->getAttribute('cash_id'));
    
    $transaction = new Transaction();
    
    $transaction->setCash($this->cash);
    
    $this->form = new GeneralTransactionForm($transaction);
  }

  /**
   * Execute create transaction
   * 
   * @param sfWebRequest $request 
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    
    $this->cash = CashPeer::retrieveByPK($this->getUser()->getAttribute('cash_id'));
    
    $user = $this->getUser()->getGuardUser();
    
    $transaction = new Transaction();
    
    $transaction->setCash($this->cash);
    
    $transaction->setUser($user);

    $this->form = new GeneralTransactionForm($transaction, array(
        'cash'=>$this->cash,
    ));

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  /**
   * Process form
   * 
   * @param sfWebRequest $request
   * @param sfForm $form 
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $transaction = $form->save();
      
      $this->getUser()->setFlash('notice', 'The item was created successfully.');

      $this->redirect('general_transaction_show', $transaction);
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  /**
   * Get filters
   * 
   * @return array 
   */
  protected function getFilters()
  {
    return $this->getUser()->getAttribute('general_transaction.filters', $this->getFilterDefaults());
  }

  /**
   * Set filters
   * 
   * @param array $filters
   * @return type 
   */
  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('general_transaction.filters', $filters);
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
    $this->getUser()->setAttribute('general_transaction.page', $page);
  }

  /**
   * Get page
   * 
   * @return int 
   */
  protected function getPage()
  {
    return $this->getUser()->getAttribute('general_transaction.page', 1);
  }
}
