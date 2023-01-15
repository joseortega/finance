<?php

/**
 * account_transfer actions.
 *
 * @package    finance
 * @subpackage account_transfer
 * @author     Jose Ortega
 */
class account_transferActions extends sfActions
{
    
  public function executeIndex(sfWebRequest $request)
  {
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
  }
  
  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset')){
      $this->setFilters($this->getFilterDefaults());

      $this->redirect('@account_transfer');
    }

    $this->filters = new TransferFormFilter($this->getFilters(), array(
        'url' => $this->getController()->genUrl('ajax/ajaxAccount')
    ));

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid()){
      $this->setFilters($this->filters->getValues());

      $this->redirect('@account_transfer');
    }

    $this->pager = $this->getPager();

    $this->setTemplate('index');
  }
  
  protected function getPager()
  {
    $pager = new sfPropelPager('Transfer',20);
    $pager->setCriteria($this->buildCriteria());
    $pager->setPage($this->getPage());
    $pager->setPeerMethod('doSelectJoinAccountOrigin');
    $pager->init();

    return $pager;
  }
  
  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = new TransferFormFilter($this->getFilters(), array(
          'url' => $this->getController()->genUrl('ajax/ajaxAccount')
      ));
    }
    
    $criteria = $this->filters->buildCriteria($this->getFilters());
    $criteria->addDescendingOrderByColumn(TransferPeer::ID);
    
    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();

    return $criteria;
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->transfer = TransferPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->transfer);
  }

  public function executeNew(sfWebRequest $request)
  {
    $transfer = new Transfer();
    
    $this->form = new TransferForm($transfer, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAccount'),
    ));
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    
    $user = $this->getUser()->getGuardUser();

    $transfer = new Transfer();
    
    $transfer->setUser($user);
    
    $this->form = new TransferForm($transfer, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAccount'),
    ));
    
    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    
    if ($form->isValid())
    {
      $transfer = $form->updateObject();
      
      $con = Propel::getConnection(TransferPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
      $con->beginTransaction();
      
      try {
        
        $transfer->save($con);
        $transfer->makeTransfer($con);
        
        $con->commit();
        
      }catch(Exception $e){
        
        $con->rollBack();
        $this->getUser()->setFlash('error', 'A persistence error occurred.');
      }
        
      $this->getUser()->setFlash('notice', 'The item was created successfully.');

      $this->redirect('account_transfer_show', $transfer);
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  public function  executePrintDetail(sfWebRequest $request)
  {  
    $transfer = TransferPeer::retrieveByPK($request->getParameter('id'));
    $this->forward404Unless($transfer);
    
    $pdf = Document::pdfAccountTransfer($transfer, $this->getUser()->getCulture());

    $pdf->Output();

    exit();

    $this->setLayout(false);
  } 
  
  protected function getFilters()
  {
    return $this->getUser()->getAttribute('account_transfer.filters', $this->getFilterDefaults());
  }

  /**
   * Set filters
   * 
   * @param array $filters  
   */
  protected function setFilters(array $filters)
  {
    $this->getUser()->setAttribute('account_transfer.filters', $filters);
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
    $this->getUser()->setAttribute('account_transfer.page', $page);
  }

  /**
   * Get page
   * 
   * @return int 
   */
  protected function getPage()
  {
    return $this->getUser()->getAttribute('account_transfer.page', 1);
  }
}
