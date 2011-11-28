<?php

/**
 * account_bankbook actions.
 *
 * @package    finance
 * @subpackage account_bankbook
 * @author     Your name here
 */
class account_bankbookActions extends sfActions
{
  /**
   * Execute index bankbook
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
   // pager
    if ($request->getParameter('page')){
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

    if ($request->hasParameter('_reset')){
      $this->setFilters($this->getFilterDefaults());

      $this->redirect('@account_bankbook');
    }

    $this->filters = new BankbookFormFilter($this->getFilters(), array(
        'url' => $this->getController()->genUrl('ajax/ajaxAccount')
    ));

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid()){
      $this->setFilters($this->filters->getValues());

      $this->redirect('@account_bankbook');
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
    $pager = new sfPropelPager('Bankbook',20);
    $pager->setCriteria($this->buildCriteria());
    $pager->setPeerMethod('doSelectJoinAccount');
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
    if (null === $this->filters){
      $this->filters = new BankbookFormFilter($this->getFilters(), array(
          'url' => $this->getController()->genUrl('ajax/ajaxAccount')
      ));
    }

    $criteria = $this->filters->buildCriteria($this->getFilters());
    $criteria->addDescendingOrderByColumn(BankbookPeer::IS_ACTIVE);
    $criteria->addDescendingOrderByColumn(BankbookPeer::CREATED_AT);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();

    return $criteria;
  }

  /**
   * Execute show bankbook
   * 
   * @param sfWebRequest $request 
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->bankbook = BankbookPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->bankbook);
  }

  /**
   * Execute new bankbook
   * 
   * @param sfWebRequest $request 
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new BankbookForm(new Bankbook(), array(
        'url' => $this->getController()->genUrl('ajax/ajaxAccount')
    ));
  }

  /**
   * Execute create bankbook
   * 
   * @param sfWebRequest $request 
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new BankbookForm(new Bankbook(), array(
        'url' => $this->getController()->genUrl('ajax/ajaxAccount')
    ));

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  /**
   * Execute delete bankbook
   * 
   * @param sfWebRequest $request 
   */
  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($bankbook = BankbookPeer::retrieveByPk($request->getParameter('id')), sprintf('Object bankbook does not exist (%s).', $request->getParameter('id')));
    $bankbook->delete();

    $this->redirect('account_bankbook/index');
  }

  /**
   * Execute proccess form
   * 
   * @param sfWebRequest $request
   * @param sfForm $form 
   */
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid()){
    
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
    
      $bankbook = $form->save();
      
      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('account_bankbook/show?id='.$bankbook->getId());
    }else{
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
    return $this->getUser()->getAttribute('account_bankbook.filters', $this->getFilterDefaults());
  }

  /**
   * Set filters
   * 
   * @param array $filters
   * @return type 
   */
  protected function setFilters(array $filters)
  {
    $this->getUser()->setAttribute('account_bankbook.filters', $filters);
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
    $this->getUser()->setAttribute('account_bankbook.page', $page);
  }

  /**
   * Get page
   * 
   * @return int 
   */
  protected function getPage()
  {
    return $this->getUser()->getAttribute('account_bankbook.page', 1);
  }
  
  /**
   * Execute print header bankbook
   * 
   * @param sfWebRequest $request 
   */
  public function  executePrintHeader(sfWebRequest $request)
  {
    $bankbook = BankbookPeer::retrieveByPK($request->getParameter('id'));
    $this->forward404Unless($bankbook);
    
    $pdf = BankbookPdf::pdfHeader($bankbook, $this->getUser()->getAgency());
    
    $pdf->Output();

    exit();

    $this->setLayout(false);
  }
  
  /**
   * Execute print content
   * 
   * @param sfWebRequest $request 
   */
  public function  executePrintContent(sfWebRequest $request)
  {  
    $bankbook = BankbookPeer::retrieveByPK($request->getParameter('id'));
    $this->forward404Unless($bankbook);
    
    $pdf = BankbookPdf::pdfContent($bankbook);
    
    $pdf->Output();

    exit();

    $this->setLayout(false);
  }
  
  /**
   * Execute print all
   * 
   * @param sfWebRequest $request 
   */
  public function  executePrintAll(sfWebRequest $request)
  {
    $bankbook = BankbookPeer::retrieveByPK($request->getParameter('id'));
    
    $this->forward404Unless($bankbook);
    
    $pdf = BankbookPdf::pdfAll($bankbook, $this->getUser()->getAgency());

    $pdf->Output();

    exit();

    $this->setLayout(false);
  }
}
