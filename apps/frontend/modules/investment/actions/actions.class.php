<?php

/**
 * investment actions.
 *
 * @package    finance
 * @subpackage investment
 * @author     Jose Ortega
 */
class investmentActions extends sfActions
{
  /**
   * Execute list investment
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

      $this->redirect('@investment');
    }

    $this->filters = new InvestmentFormFilter($this->getFilters(), array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates')
    ));

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@investment');
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
    $pager = new sfPropelPager('Investment',20);
    $pager->setCriteria($this->buildCriteria());
    $pager->setPage($this->getPage());
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
      $this->filters = new InvestmentFormFilter($this->getFilters(), array(
          'url' => $this->getController()->genUrl('ajax/ajaxAssociates')
      ));
    }

    $criteria = $this->filters->buildCriteria($this->getFilters());
    $criteria->addDescendingOrderByColumn(InvestmentPeer::IS_CURRENT, true);
    $criteria->addDescendingOrderByColumn(InvestmentPeer::UPDATED_AT);
    
    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();

    return $criteria;
  }

  /**
   * Execute show investment
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->investment = $this->getRoute()->getObject();
  }

  /**
   * Execute new investment
   * 
   * @param sfWebRequest $request 
   */
  public function executeNew(sfWebRequest $request)
  {  
    $investment = new Investment();
    
    if($request->getParameter('id')){
      
      $associate = AssociatePeer::retrieveByPK($request->getParameter('id'));
      $investment->setAssociate($associate);
    }
    
    $this->form = new InvestmentForm($investment, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates'),
        'url2' => $this->getController()->genUrl('ajax/ajaxAccount'),  
    ));
        
  }

  /**
   * Execute create investment
   * 
   * @param sfWebRequest $request 
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    
    $user = $this->getUser()->getGuardUser();
    $investment = new Investment();
    $actTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::ACCOUNT_TRANSFER_TO_INVESTMENT);
    $invTransactionType = TransactionTypePeer::retrieveByOperationType(TransactionType::INVESTMENT_TRANSFER_FROM_ACCOUNT);
    
    $this->form = new InvestmentForm($investment, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates'),
        'url2' => $this->getController()->genUrl('ajax/ajaxAccount'),
        'user' => $user,
        'accountTransactionType' => $actTransactionType,
        'investmentTransactionType' => $invTransactionType,
    ));
    
    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($this->form->isValid()){
      
      $investment = $this->form->updateObject();
      
      //set default values
      $investment->setCreatedAt(time());
      $expiresAt = $investment->getCreatedAt('U') + 86400 * $investment->getTimeDays();
      $investment->setExpirationDate(date('Y-m-d', $expiresAt));
      $product = $investment->getProduct();
      $investment->setInterestRate($product->getInterestRate($investment->getTimeDays()));
      $investment->setTaxRate($product->getTaxRate());
      $investment->setIsCurrent(true);
      
      $amount = $investment->getAmount();
      
      $con = Propel::getConnection(InvestmentPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
      $con->beginTransaction();
      
      try{
        
        $investment->save($con);
        
        //register transactios
        $actTransaction = new Transaction($user, $actTransactionType, $amount);
        $actTransaction->setAccount($investment->getAccount());
        $actTransaction->save($con);
        
        $investment->getAccount()->debit($amount, $con);
        $actTransaction->updateAccountBalance($investment->getAccount()->getBalance(), $con);

        $invTransaction = new Transaction($user, $invTransactionType, $amount, $observation);
        $invTransaction->setInvestment($investment);
        $invTransaction->save($con);
        
        $investment->accredit($amount, $con);

        $con->commit();

      }catch (Exception $e){
        
        $con->rollBack();
        $this->getUser()->setFlash('error', 'Persistence error.');
      }

      $this->getUser()->setFlash('notice', 'The item was created successfully.');

      $this->redirect('investment/show?id='.$investment->getId());
    }else{
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
    
    $this->setTemplate('new');
  }

  /**
   * Execute delete investment
   * 
   * @param sfWebRequest $request 
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($investment = InvestmentPeer::retrieveByPk($request->getParameter('id')), sprintf('Object account does not exist (%s).', $request->getParameter('id')));
    $investment->delete();

    $this->redirect('investment/index');
  }
  
  /**
   * Execute print investment detail in pdf
   * 
   * @param sfWebRequest $request 
   */
  public function executePdf(sfWebRequest $request)
  {
    $investment = InvestmentPeer::retrieveByPK($request->getParameter('id'));
    
    $pdf = Document::pdfInvestmnet($investment, $this->getUser()->getAgency());
    
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
    return $this->getUser()->getAttribute('investment.filters', $this->getFilterDefaults());
  }

  /**
   * Set filters
   *  
   * @param array $filters
   */
  protected function setFilters(array $filters)
  {
    $this->getUser()->setAttribute('investment.filters', $filters);
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
    $this->getUser()->setAttribute('investment.page', $page);
  }

  /**
   * Get page
   * 
   * @return int 
   */
  protected function getPage()
  {
    return $this->getUser()->getAttribute('investment.page', 1);
  }
}
