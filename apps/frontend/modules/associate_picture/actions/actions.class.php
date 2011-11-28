<?php

/**
 * associate_picture actions.
 *
 * @package    fynance
 * @subpackage associate_picture
 * @author     Your name here
 */
class associate_pictureActions extends sfActions
{
  /**
   * Execute edit associate-picture
   * 
   * @param sfWebRequest $request 
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->associate = $this->getRoute()->getObject();
    
    $this->form = new AssociatePictureForm($this->associate);
  }

  /**
   * Execute update associate-picture
   * 
   * @param sfWebRequest $request 
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    
    $this->associate = $this->getRoute()->getObject();
    
    $this->form = new AssociatePictureForm($this->associate);

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
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      
      $associate = $form->save();
      
      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('associate_picture/edit?id='.$associate->getId());
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
