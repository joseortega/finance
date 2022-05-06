<?php

/**
 * user actions.
 *
 * @package    finance
 * @subpackage user
 * @author     Jose Ortega
 */
class userActions extends sfActions
{
  /**
   * Execute change password the user current
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $user = $this->getUser()->getGuardUser();
    
    $this->forward404Unless($user);
    
    $this->form = new UserForm($user);
  }

  /**
   * Ececute update password
   * 
   * @param sfWebRequest $request 
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    
    $user = $this->getUser()->getGuardUser();
    
    $this->forward404Unless($user);
    
    $this->form = new UserForm($user);

    $this->processForm($request, $this->form);

    $this->setTemplate('index');
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
      
      $form->save();
      
      $this->getUser()->setFlash('notice', 'The item was updated successfully');

      $this->redirect('@user');
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

}
