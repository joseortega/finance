<?php

/**
 * account_transaction_type_from_investment actions.
 *
 * @package    fynance
 * @subpackage account_transaction_type_from_investment
 * @author     Your name here
 */
class configurationActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->name = $request->getParameter('name');
    
    $this->forward404If($this->name != Configuration::TITLE_REPORT);
    
    $configuration = ConfigurationPeer::retrieveByName($this->name);
    
    if(!$configuration){
      $configuration = new Configuration();
      $configuration->setName($this->name);
    }
    
    $label = ucfirst(str_replace('_', ' ', $this->name));
    
    $this->form = new ConfigurationForm($configuration, array('label' => $label));
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    
    $this->name = $request->getParameter('name');
  
    $configuration = ConfigurationPeer::retrieveByName($this->name);
    
    $this->forward404If($this->name != Configuration::TITLE_REPORT);
    
    if(!$configuration){
      $configuration = new Configuration();
      $configuration->setName($this->name);
    }
    
    $label = ucfirst(str_replace('_', ' ', $this->name));
    
    $this->form = new ConfigurationForm($configuration, array('label' => $label));

    $this->processForm($request, $this->form);

    $this->setTemplate('index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';
      
      $configuration = $form->save();
      
      $this->getUser()->setFlash('notice', $notice);

      $this->redirect('configuration/index?name='.$configuration->getName());
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
}
