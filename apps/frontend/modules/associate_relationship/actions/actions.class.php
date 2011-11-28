<?php

/**
 * associate_company_personnel actions.
 *
 * @package    finance
 * @subpackage associate_relationship
 * @author     Jose Ortega
 */
class associate_relationshipActions extends sfActions
{
  /**
   * Execute edit associate-relationship
   * 
   * @param sfWebRequest $request 
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->associate = $this->getRoute()->getObject();
   
    $this->form = new AssociateEmbedRelationshipForm($this->associate);
  }

  /**
   * Execute update associate-relationship
   * 
   * @param sfWebRequest $request 
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    
    $this->associate = $this->getRoute()->getObject();
    
    $this->form = new AssociateEmbedRelationshipForm($this->associate);

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

      $this->redirect('associate_relationship_edit', $associate);
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  /**
   * Execute add relationship
   * 
   * @param sfRequest $request
   * @return _partial 
   */
  public function executeAddRelationship(sfRequest $request)
  {
    $this->forward404unless($request->isXmlHttpRequest());
    $key = intval($request->getParameter("key"));

    if($associate = AssociatePeer::retrieveByPk($request->getParameter('id'))){
      $form = new AssociateEmbedRelationshipForm($associate);
    }else{
      $form = new AssociateEmbedRelationshipForm(null);
    }

    $form->addRelationship($key);

    return $this->renderPartial('addRelationship',array('form' => $form, 'key' => $key));
    }
}
