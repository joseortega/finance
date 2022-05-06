<?php

/**
 * credit_guarantee_real actions.
 *
 * @package    finance
 * @subpackage credit_guarantee_real
 * @author     Jose Ortega
 */
class credit_guarantee_realActions extends sfActions
{
  /**
   * Execute edit credit with guarantees real
   * 
   * @param sfWebRequest $request 
   */
  public function executeEdit(sfWebRequest $request)
  {
    $this->credit = $this->getRoute()->getObject();
    
    $this->forward404If(!($this->credit->isCurrent()||$this->credit->isInRequest()||$this->credit->isApproved()));
    
    $this->form = new CreditEmbedGuaranteeRealForm($this->credit);
  }

  /**
   *  Execute update credit with guarantees real
   * 
   * @param sfWebRequest $request 
   */
  public function executeUpdate(sfWebRequest $request)
  {
    $this->credit = $this->getRoute()->getObject();
    
    $this->forward404If(!($this->credit->isCurrent()||$this->credit->isInRequest()||$this->credit->isApproved()));
    
    $this->form = new CreditEmbedGuaranteeRealForm($this->credit);

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

      $this->redirect('credit_guarantee_real_edit', $credit);
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  /**
   * Execute add guarantee real
   * 
   * @param sfRequest $request
   * @return type 
   */
  public function executeAddGuaranteeForm(sfRequest $request)
  {
    $this->forward404unless($request->isXmlHttpRequest());
    $key = intval($request->getParameter("key"));

    if($credit = CreditPeer::retrieveByPk($request->getParameter('id'))){
        $form = new CreditEmbedGuaranteeRealForm($credit);
    }else{
        $form = new CreditEmbedGuaranteeRealForm(null);
    }

    $form->addGuarantee($key);

    return $this->renderPartial('addGuaranteeForm',array('form' => $form, 'key' => $key));
  }
    
  /**
   * Exevute show guarantee real
   * 
   * @param sfWebRequest $request 
   */
  public function executeOneDetail(sfWebRequest $request)
  {
    $this->guarantee = GuaranteeRealPeer::retrieveByPK($request->getParameter('guarantee_id'));     
  }
}
