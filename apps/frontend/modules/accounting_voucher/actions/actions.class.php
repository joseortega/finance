<?php

/**
 * accounting_voucher actions.
 *
 * @package    finance
 * @subpackage accounting_voucher
 * @author     Jose Ortega
 */
class accounting_voucherActions extends sfActions
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

      $this->redirect('@accounting_voucher');
    }

    $this->filters = new AccountingVoucherFormFilter($this->getFilters(), array(
    ));

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid()){
      $this->setFilters($this->filters->getValues());

      $this->redirect('@accounting_voucher');
    }

    $this->pager = $this->getPager();

    $this->setTemplate('index');
  }
  
  protected function getPager()
  {
    $pager = new sfPropelPager('AccountingVoucher',20);
    $pager->setCriteria($this->buildCriteria());
    $pager->setPage($this->getPage());
    $pager->setPeerMethod('doSelect');
    $pager->init();

    return $pager;
  }
  
  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = new AccountingVoucherFormFilter($this->getFilters(), array(
      ));
    }
    
    $criteria = $this->filters->buildCriteria($this->getFilters());
    $criteria->addDescendingOrderByColumn(AccountingVoucherPeer::ID);
    
    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();

    return $criteria;
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->AccountingVoucher = AccountingVoucherPeer::retrieveByPk($request->getParameter('id'));
    $this->forward404Unless($this->AccountingVoucher);
  }

  public function executeNew(sfWebRequest $request)
  {
    $accountingVoucher = new AccountingVoucher();
    
    $this->form = new AccountingVoucherEmbedVoucherItemForm($accountingVoucher, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAccountingAccount')
    )); 
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new AccountingVoucherForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($AccountingVoucher = AccountingVoucherPeer::retrieveByPk($request->getParameter('id')), sprintf('Object AccountingVoucher does not exist (%s).', $request->getParameter('id')));
    $this->form = new AccountingVoucherForm($AccountingVoucher);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($AccountingVoucher = AccountingVoucherPeer::retrieveByPk($request->getParameter('id')), sprintf('Object AccountingVoucher does not exist (%s).', $request->getParameter('id')));
    $this->form = new AccountingVoucherForm($AccountingVoucher);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($AccountingVoucher = AccountingVoucherPeer::retrieveByPk($request->getParameter('id')), sprintf('Object AccountingVoucher does not exist (%s).', $request->getParameter('id')));
    $AccountingVoucher->delete();

    $this->redirect('accounting_voucher/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $AccountingVoucher = $form->save();

      $this->redirect('accounting_voucher/edit?id='.$AccountingVoucher->getId());
    }
  }
  protected function getFilters()
  {
    return $this->getUser()->getAttribute('accounting_voucher.filters', $this->getFilterDefaults());
  }

  /**
   * Set filters
   * 
   * @param array $filters  
   */
  protected function setFilters(array $filters)
  {
    $this->getUser()->setAttribute('accounting_voucher.filters', $filters);
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
    $this->getUser()->setAttribute('accounting_voucher.page', $page);
  }

  /**
   * Get page
   * 
   * @return int 
   */
  protected function getPage()
  {
    return $this->getUser()->getAttribute('accounting_voucher.page', 1);
  }
}
