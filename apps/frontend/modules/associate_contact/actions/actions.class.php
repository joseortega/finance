<?php

/**
 * associate_contact actions.
 *
 * @package    finance
 * @subpackage associate_contact
 * @author     Jose Ortega
 */
class associate_contactActions extends sfActions
{
  /**
   * Execute contact edit
   * 
   * @param sfWebRequest $request 
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->associate = $this->getRoute()->getObject();
    
    $this->form = new ContactForm($this->associate);
  }

  /**
   * Execute contact update
   * 
   * @param sfWebRequest $request 
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    
    $this->associate = $this->getRoute()->getObject();
    
    $this->form = new ContactForm($this->associate);

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
      
      $Associate = $form->save();
      
      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('associate_contact/edit?id='.$Associate->getId());
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  /**
   * Execute add phone
   *
   * @param sfRequest $request
   * @return type 
   */
  public function executeAddPhone(sfRequest $request)
  {
    $this->forward404unless($request->isXmlHttpRequest());
    $key = intval($request->getParameter("key"));

    if($asociate = AssociatePeer::retrieveByPk($request->getParameter('id'))){
        $form = new ContactForm($asociate);
    }else{
        $form = new ContactForm(null);
    }

    $form->addPhone($key);

    return $this->renderPartial('addPhone',array('form' => $form, 'key' => $key));
  }
    
  /**
   * Execute ajax city
   * 
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeAjaxCity(sfWebRequest $request)
  {
    $this->getResponse()->setContentType('application/json');

    $citys = CityPeer::retrieveForSelect($request->getParameter('q'), $request->getParameter('limit'));

    return $this->renderText(json_encode($citys));
  }

}
