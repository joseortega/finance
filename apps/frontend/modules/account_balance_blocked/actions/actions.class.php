<?php

/**
 * account_balance_manage actions.
 *
 * @package    fynance
 * @subpackage account_balance_manage
 * @author     Your name here
 */
class account_balance_blockedActions extends sfActions
{
  /**
   * Execute index
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->account = $this->getRoute()->getObject();
    
    $criteria = new Criteria();
    $criteria->add(BalanceBlockedDetailPeer::ACCOUNT_ID, $this->account->getId(), Criteria::EQUAL);
    $criteria->addDescendingOrderByColumn(BalanceBlockedDetailPeer::BLOCKED_AT);
    $criteria->addDescendingOrderByColumn(BalanceBlockedDetailPeer::UNBLOCK_AT);

    $this->pager = new sfPropelPager('BalanceBlockedDetail',20);
    $this->pager->setCriteria($criteria);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
  }
  
  /**
   * Execute new BalanceBlockedDetail
   * 
   * @param sfWebRequest $request 
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->account = $this->getRoute()->getObject();
    
    $balanceBlockedDetail = new BalanceBlockedDetail();
    $balanceBlockedDetail->setAccount($this->account);
    
    $this->form = new BalanceBlockedDetailForm($balanceBlockedDetail);
  }

  /**
   * Execute create BalanceBlockedDetail
   *  
   * @param sfWebRequest $request 
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    
    $this->account = $this->getRoute()->getObject();
    
    $balanceBlockedDetail = new BalanceBlockedDetail();
    $balanceBlockedDetail->setAccount($this->account);
    
    $this->form = new BalanceBlockedDetailForm($balanceBlockedDetail);

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
      $balanceBlockedDetail = $form->save();
      
      $notice = 'The value was blocked successfully.';
      
      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('account_balance_blocked', $balanceBlockedDetail->getAccount());
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  /**
   * Execute unblock balance
   * 
   * @param sfWebRequest $request 
   */
  public function executeUnblock(sfWebRequest $request)
  {
    $balanceBlockedDetail = BalanceBlockedDetailPeer::retrieveByPK($request->getParameter('id'));
    
    $this->forward404Unless($balanceBlockedDetail);
    
    $this->forward404Unless(!$balanceBlockedDetail->getUnblockAt());
    try{
      
      $balanceBlockedDetail->unblock();
      $this->getUser()->setFlash('notice', 'The value was unblocked successfully.');
      
    } catch (Exception $e){
      
      $this->getUser()->setFlash('error', 'Persistence error.');
    }
    
    $this->redirect('account_balance_blocked', $balanceBlockedDetail->getAccount());
  }
}
