<?php

/**
 * email actions.
 *
 * @package    finance
 * @subpackage email
 * @author     Jose Ortega
 */
class emailActions extends sfActions
{
  /**
   * List email respect to one associate
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->associate = $this->getRoute()->getObject();
    
    $this->Emails = $this->associate->getEmails();
  }

  /**
   * Execute new email
   * 
   * @param sfWebRequest $request
   * @return sfView::NONE
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->forward404Unless($request->isXmlHttpRequest());
    
    $this->associate = AssociatePeer::retrieveByPK($request->getParameter('id'));

    $email = new Email();
    $email->setAssociate($this->associate);

    $this->form = new EmailForm($email);

    return $this->renderPartial('form',array('form' => $this->form, 'associate' => $this->associate));
 
  }

  /**
   * Execute create email
   * 
   * @param sfWebRequest $request
   * @return sfView::NONE
   */
  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isXmlHttpRequest());
    
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    
    $this->associate = AssociatePeer::retrieveByPK($request->getParameter('id'));
    
    $email = new Email();
    $email->setAssociate($this->associate);

    $this->form = new EmailForm($email);

    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($this->form->isValid())
    {
      $Email = $this->form->save();

      return $this->renderPartial('new', array('Email' => $Email, 'associate' => $this->associate));
    }
  }

  /**
   * Execute delete email
   * 
   * @param sfWebRequest $request 
   */
  public function executeDelete(sfWebRequest $request)
  {
//    $request->checkCSRFProtection();

    $this->forward404Unless($Email = EmailPeer::retrieveByPk($request->getParameter('id')), sprintf('Object Email does not exist (%s).', $request->getParameter('id')));
    $Email->delete();

    $this->redirect('email', $Email->getAssociate());
  }

}
