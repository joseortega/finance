<?php

/**
 * credit_account actions.
 *
 * @package    fynance
 * @subpackage credit_account
 * @author     Your name here
 */
class credit_accountActions extends sfActions
{
  /**
   * Execute edit credit-account
   * 
   * @param sfWebRequest $request 
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->credit = $this->getRoute()->getObject();
    
    $this->forward404If(!($this->credit->isCurrent()||$this->credit->isInRequest()||$this->credit->isApproved()));
    
  
    $this->form = new CreditAccountForm($this->credit);
  }

  /**
   * Execute update credit-acount
   * 
   * @param sfWebRequest $request 
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->credit = $this->getRoute()->getObject();
    
    $this->forward404If(!($this->credit->isCurrent()||$this->credit->isInRequest()||$this->credit->isApproved()));
    
    $this->form = new CreditAccountForm($this->credit);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
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
      $credit = $form->save();
      
      $this->getUser()->setFlash('notice', 'The item was updated successfully.');

      $this->redirect('credit_account_edit', $credit);
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
