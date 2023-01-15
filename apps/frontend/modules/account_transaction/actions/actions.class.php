<?php

/**
 * account_transaction actions.
 *
 * @package    finance
 * @subpackage account_transaction
 * @author     Your name here
 */
class account_transactionActions extends sfActions
{
  public $cash = null;

  /**
   * Execute list account transactions
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
    
    $this->cash = CashPeer::retrieveByPK($this->getUser()->getAttribute('cash_id'));
  }

  /**
   * Execute filter
   * 
   * @param sfWebRequest $request 
   */
  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->getFilterDefaults());

      $this->redirect('@account_transaction');
    }

    $this->filters = new AccountTransactionFormFilter($this->getFilters(),  array(
        'url' => $this->getController()->genUrl('ajax/ajaxAccount')
      ));

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@account_transaction');
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
      $this->filters = new AccountTransactionFormFilter($this->getFilters(), array(
          'url' => $this->getController()->genUrl('ajax/ajaxAccount')
      ));
    }
    
    $criteria = $this->filters->buildCriteria($this->getFilters());
    $criteria->addDescendingOrderByColumn(TransactionPeer::ID);
    $criteria->add(TransactionPeer::ACCOUNT_ID, null, Criteria::NOT_EQUAL);
    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();

    return $criteria;
  }

  /**
   * Execute show account transaction
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->transaction = TransactionPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->transaction);
  }

  /**
   * Execute new account transaction
   * 
   * @param sfWebRequest $request 
   */
  public function executeNew(sfWebRequest $request)
  {
    $transaction = new Transaction();

    $this->form = new AccountTransactionForm($transaction, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAccount'),
        'type' => $this->type
    ));
  }

  /**
   * Execute create account transaction
   * 
   * @param sfWebRequest $request 
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    
    $user = $this->getUser()->getGuardUser();
      
    $this->cash = $this->getUser()->getCash();

    $transaction = new Transaction();
    
    $transaction->setUser($user);
    
    $this->form = new AccountTransactionForm($transaction, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAccount'),
        'cash' => $this->cash,
    ));

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  /**
   * Proccess form and save transaction
   * 
   * @param sfWebRequest $request
   * @param sfForm $form 
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $transaction = $form->updateObject();
      
      if($transaction->getTransactionType()->getCashBalanceIsAffect()){
          $transaction->setCash($this->cash);
      }
      
      $nature = $transaction->getTransactionType()->getNature();
      
      $con = Propel::getConnection(AccountPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
      $con->beginTransaction();
      
      try {
        
        $transaction->save($con);
        
        if($nature == TransactionType::CREDIT){
          
          if($transaction->getCash()){
            $transaction->getCash()->accredit($transaction->getAmount(), $con);
          }

          $transaction->getAccount()->accredit($transaction->getAmount(), $con);

        }elseif($nature == TransactionType::DEBIT){

          if($transaction->getCash()){
            $transaction->getCash()->debit($transaction->getAmount(), $con);
          }

          $transaction->getAccount()->debit($transaction->getAmount(), $con);

        }
        
        $transaction->updateAccountBalance($transaction->getAccount()->getBalance(), $con);
        
        $con->commit();
        
      }catch(Exception $e){
        
        $con->rollBack();
        $this->getUser()->setFlash('error', 'A persistence error occurred.');
      }
        
      $this->getUser()->setFlash('notice', 'The item was created successfully.');

      $this->redirect('account_transaction_show', $transaction);
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  /**
   * Print transaction detail in pdf
   * 
   * @param sfWebRequest $request 
   */
  public function  executePrintDetail(sfWebRequest $request)
  {  
    $transaction = TransactionPeer::retrieveByPK($request->getParameter('id'));
    $this->forward404Unless($transaction);
    
    $pdf = Document::pdfAccountTransaction($transaction, $this->getUser()->getCulture());

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
    
    $pdf = Document::pdfAccountTransactions($transactions, $this->getUser()->getCulture());
    
    $pdf->Output();

    exit();

    $this->setLayout(false);
  }

  /**
   * Get filters
   * 
   * @return array 
   */
  protected function getFilters()
  {
    return $this->getUser()->getAttribute('account_transaction.filters', $this->getFilterDefaults());
  }

  /**
   * Set filters
   * 
   * @param array $filters  
   */
  protected function setFilters(array $filters)
  {
    $this->getUser()->setAttribute('account_transaction.filters', $filters);
  }

  /**
   * Get filter defaults
   * 
   * @return array 
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
    $this->getUser()->setAttribute('account_transaction.page', $page);
  }

  /**
   * Get page
   * 
   * @return int 
   */
  protected function getPage()
  {
    return $this->getUser()->getAttribute('account_transaction.page', 1);
  }
}
