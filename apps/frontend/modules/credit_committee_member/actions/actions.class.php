<?php

/**
 * credit_guarantee_personal actions.
 *
 * @package    finance
 * @subpackage credit_committeeMember
 * @author     Jose Ortega
 */
class credit_committee_memberActions extends sfActions
{
  /**
   * Execute index
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->credit = $this->getRoute()->getObject();
    
    $this->forward404Unless($this->credit->isInRequest());
    
    $this->committeeMembers = $this->credit->getCommitteeMembers();
  }

  /**
   * Execute new
   * 
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeNew(sfWebRequest $request)
  {
    $this->credit = CreditPeer::retrieveByPK($request->getParameter('id'));
    
    $this->forward404Unless($this->credit->isInRequest());
    
    $object = new CommitteeMember();
    $object->setCredit($this->credit);
    
    $this->form = new CommitteeMemberForm($object);
    
    if($request->isXmlHttpRequest()){
      return $this->renderPartial('form',array('form' => $this->form, 'credit' => $this->credit));
    }
  }

  /**
   * Execute create
   * 
   * @param sfWebRequest $request
   * @return type 
   */
  public function executeCreate(sfWebRequest $request)
  {  
    $this->forward404Unless($request->isXmlHttpRequest());
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    
    $this->credit = CreditPeer::retrieveByPK($request->getParameter('id'));
    
    $this->forward404Unless($this->credit->isInRequest());

    $object = new CommitteeMember();
    $object->setCredit($this->credit);

    $this->form = new CommitteeMemberForm($object);
    
    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($this->form->isValid())
    {
      $committeeMember = $this->form->save();
      
      return $this->renderPartial('new', array('committeeMember' => $committeeMember, 'credit' => $this->credit));
    }
  }

  /**
   * Execute delete
   * 
   * @param sfWebRequest $request 
   */
  public function executeDelete(sfWebRequest $request)
  {
//    $request->checkCSRFProtection();

    $this->forward404Unless($committeeMember = CommitteeMemberPeer::retrieveByPk($request->getParameter('id')), 
            sprintf('Object CommitteeMember does not exist (%s).', $request->getParameter('id')
    ));
        
    $committeeMember->delete();

    $this->redirect('credit_committee_member', $committeeMember->getCredit());
  }
}
