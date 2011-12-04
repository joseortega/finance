<?php

/**
 * account actions.
 *
 * @package    finance
 * @subpackage account
 * @author     Your name here
 */
class accountActions extends sfActions
{
  /**
  * Execute index account
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

      $this->redirect('@account');
    }

    $this->filters = new AccountFormFilter($this->getFilters(), array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates')
    ));

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@account');
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
    $pager = new sfPropelPager('Account',20);
    $pager->setCriteria($this->buildCriteria());
    $pager->setPage($this->getPage());
    $pager->setPeerMethod('doSelectJoinAll');
    $pager->init();

    return $pager;
  }

  /**
   * Build criteria
   * 
   * @return type 
   */
  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = new AccountFormFilter($this->getFilters(), array(
          'url' => $this->getController()->genUrl('ajax/ajaxAssociates')
      ));
    }

    $criteria = $this->filters->buildCriteria($this->getFilters());
    $criteria->addDescendingOrderByColumn(AccountPeer::UPDATED_AT);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();

    return $criteria;
  }

  /**
   * Executa show account
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->account = AccountPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->account);
  }

  /**
   * Exucute new account
   * 
   * @param sfWebRequest $request 
   */
  public function executeNew(sfWebRequest $request)
  {
    $account = new Account();
    
    if($request->getParameter('id')){
      
      $associate = AssociatePeer::retrieveByPK($request->getParameter('id'));
      $account->setAssociate($associate);
    }
    
    $this->form = new AccountForm($account, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates')
    ));   
  }

  /**
   * Execute create account
   * 
   * @param sfWebRequest $request 
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $account = new Account();
    $this->form = new AccountForm($account, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates')
    ));

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  /**
   * Execute delete account
   * 
   * @param sfWebRequest $request 
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($account = AccountPeer::retrieveByPk($request->getParameter('id')), sprintf('Object account does not exist (%s).', $request->getParameter('id')));
    $account->delete();

    $this->redirect('account/index');
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
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      
      $account = $form->save();

      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('account/show?id='.$account->getId());
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  /**
   * Print pending transactions in bankbook
   * 
   * @param sfWebRequest $request 
   */
  public function  executePrintPendingTransactionsInBankbook(sfWebRequest $request)
  {  
    $account = AccountPeer::retrieveByPK($request->getParameter('id'));
    $this->forward404Unless($account);
    
    $agency = $this->getUser()->getAgency();
    
    $pdf = BankbookPdf::buildBasic();
    
    //query bankbook current
    $criteria = new Criteria();
    $criteria->add(BankbookPeer::ACCOUNT_ID, $account->getId(), Criteria::EQUAL);
    $criteria->add(BankbookPeer::IS_ACTIVE, TRUE, Criteria::EQUAL);
    
    $bankbook = BankbookPeer::doSelectOne($criteria);
    
    if(!$bankbook){
      $bankbook = new Bankbook();
      $bankbook->setAccount($account);
      $bankbook->save();
    }
       
    if($bankbook->getPrintRow() < (BankbookPdf::rowsByPage * 2)){
      
      if($bankbook->getPrintRow() < BankbookPdf::rowsByPage){
        
        $pdf->AddPage();
        
        if(!$bankbook->getWasPrintedHeader()){
          
          $pdf->Ln(BankbookPdf::spaceHeaderlogo);
          $pdf = BankbookPdf::buildHeader($bankbook, $pdf, $agency);
          $pdf->Ln(BankbookPdf::marginTopContent);
          $pdf->Ln(BankbookPdf::spaceTableHeader);

        }else{  
          
          $pdf->Ln(BankbookPdf::spaceHeaderlogo);
          $pdf->ln(BankbookPdf::spaceHeaderContent);
          $pdf->ln(BankbookPdf::marginTopContent);
          $pdf->Ln(BankbookPdf::spaceTableHeader);
          
          $pdf->ln(BankbookPdf::h * ($bankbook->getPrintRow()));
        }
        
      }elseif($bankbook->getPrintRow() > BankbookPdf::rowsByPage){
        
        $pdf->AddPage();
        
        $pdf->Ln(BankbookPdf::spaceHeaderlogo);
        $pdf->ln(BankbookPdf::spaceHeaderContent);
        $pdf->ln(BankbookPdf::marginTopContent);
        $pdf->Ln(BankbookPdf::spaceTableHeader);
        
        $pdf->ln(BankbookPdf::h * ($bankbook->getPrintRow() - BankbookPdf::rowsByPage));
      }
    }
    
    //query transactions
    
    $criteria = new Criteria();
    $criteria->add(AccountTransactionPeer::BANKBOOK_ID, null, Criteria::EQUAL);
    $transactions = $account->getAccountTransactions($criteria);
    
    foreach ($transactions as $key => $transaction){
      
      if($bankbook->getPrintRow() == BankbookPdf::rowsByPage){
        
        $pdf->AddPage();
        $pdf->Ln(BankbookPdf::spaceHeaderlogo);
        $pdf->ln(BankbookPdf::spaceHeaderContent);
        $pdf->ln(BankbookPdf::marginTopContent);
        $pdf->Ln(BankbookPdf::spaceTableHeader);
        
      }elseif($bankbook->getPrintRow() == BankbookPdf::rowsByPage * 2){
        
        $pdf->AddPage();
        $bankbook = new Bankbook();
        $bankbook->setAccount($account);
        $bankbook->save();
        
        $pdf->Ln(BankbookPdf::spaceHeaderlogo);
        $pdf = BankbookPdf::buildHeader($bankbook, $pdf, $agency);
        $pdf->Ln(BankbookPdf::marginTopContent);
        $pdf->Ln(BankbookPdf::spaceTableHeader);
      }
      
      $pdf->Cell(BankbookPdf::w, BankbookPdf::h, $transaction->getCreatedAt('Y-m-d'),0,0,'C',1);
      $pdf->Cell(BankbookPdf::w, BankbookPdf::h, $transaction->getTransactionType()->getInitials(),0,0,'C',1);
      
      if($transaction->isCredit()){
        $pdf->Cell(BankbookPdf::w, BankbookPdf::h, $transaction->getAmount(),0,0,'C',1);
        $pdf->Cell(BankbookPdf::w, BankbookPdf::h, '',0,0,'R',1);
      }else{
        $pdf->Cell(BankbookPdf::w, BankbookPdf::h, '',0,0,'R',1);
        $pdf->Cell(BankbookPdf::w, BankbookPdf::h, $transaction->getAmount(),0,0,'C',1);
      }

      $pdf->Cell(BankbookPdf::w, BankbookPdf::h, $transaction->getAccountBalance(),0,0,'C',1);
      $pdf->Ln();
      
      $bankbook->setPrintRow($bankbook->getPrintRow()+1);
      $transaction->setBankbook($bankbook);
      $bankbook->save();
    }

    $pdf->Output();

    exit();

    $this->setLayout(false);
  }

  /**
   *  Get filters
   * 
   * @return array 
   */
  protected function getFilters()
  {
    return $this->getUser()->getAttribute('account.filters', $this->getFilterDefaults());
  }

  /**
   * Set filters
   * 
   * @param array $filters
   * @return array 
   */
  protected function setFilters(array $filters)
  {
    $this->getUser()->setAttribute('account.filters', $filters);
  }

  /**
   * Get filter defaults
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
    $this->getUser()->setAttribute('account.page', $page);
  }

  /**
   * Get page
   * 
   * @return int 
   */
  protected function getPage()
  {
    return $this->getUser()->getAttribute('account.page', 1);
  }
}
