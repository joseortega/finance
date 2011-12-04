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
    
    $connection = CashPeer::retrieveByPK($this->getUser()->getAttribute('connection_id'));
    
    $investment = new Investment();
    
    $this->form = new InvestmentForm($investment, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates'),
        'url2' => $this->getController()->genUrl('ajax/ajaxAccount'),
        'user' => $user,
    ));
    
    $this->processForm($request, $this->form);
    
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
      
      $investment = $form->save();

      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('investment/show?id='.$investment->getId());
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
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
