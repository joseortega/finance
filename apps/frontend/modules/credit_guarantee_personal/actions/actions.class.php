<?php

/**
 * credit_guarantee_personal actions.
 *
 * @package    finance
 * @subpackage credit_guarantee_personal
 * @author     Jose Ortega
 */
class credit_guarantee_personalActions extends sfActions
{
  /**
   * Execute index credit-guarantee-personal
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->credit = $this->getRoute()->getObject();
    
    $this->forward404If(!($this->credit->isCurrent()||$this->credit->isInRequest()||$this->credit->isApproved()));
    
    $criteria = new Criteria();
    
    $criteria->add(GuaranteePersonalPeer::CREDIT_ID, $this->credit->getId(), Criteria::EQUAL);
    
    $this->guaranteePersonals = GuaranteePersonalPeer::doSelect($criteria);
  }

  /**
   * Execute new guarantee personal
   * 
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->credit = CreditPeer::retrieveByPK($request->getParameter('id'));
    
    $this->forward404If(!($this->credit->isCurrent()||$this->credit->isInRequest()||$this->credit->isApproved()));
    
    $object = new GuaranteePersonal();
    $object->setCredit($this->credit);
    
    $this->form = new GuaranteePersonalForm($object, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates')
    ));
    
    if($request->isXmlHttpRequest()){
      return $this->renderPartial('form',array('form' => $this->form, 'credit' => $this->credit));
    }
  }

  /**
   * Execute create guarantee personal
   * 
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeCreate(sfWebRequest $request)
  {  
    $this->credit = CreditPeer::retrieveByPK($request->getParameter('id'));
    
    $this->forward404If(!($this->credit->isCurrent()||$this->credit->isInRequest()||$this->credit->isApproved()));
    
    $this->forward404Unless($request->isXmlHttpRequest());
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $object = new GuaranteePersonal();
    $object->setCredit($this->credit);

    $this->form = new GuaranteePersonalForm($object, array(
        'url' => $this->getController()->genUrl('ajax/ajaxAssociates')
    ));
    
    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($this->form->isValid())
    {
      $guaranteePersonal = $this->form->save();
      
      return $this->renderPartial('new', array('guaranteePersonal' => $guaranteePersonal, 'credit' => $this->credit));
    }
  }

  /**
   * Execute delete guarantee personal
   * 
   * @param sfWebRequest $request 
   */
  public function executeDelete(sfWebRequest $request)
  {
//    $request->checkCSRFProtection();

    $this->forward404Unless($guaranteePersonal = GuaranteePersonalPeer::retrieveByPk($request->getParameter('credit_id'),
    $request->getParameter('associate_id')), sprintf('Object CreditGuaranteePersonal does not exist (%s).', $request->getParameter('credit_id'),
    $request->getParameter('associate_id')));
        
    $guaranteePersonal->delete();

    $this->redirect('credit_guarantee_personal', $guaranteePersonal->getCredit());
  }

}
