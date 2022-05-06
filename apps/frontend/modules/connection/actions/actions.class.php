<?php

/**
 * connection actions.
 *
 * @package    finance
 * @subpackage connection
 * @author     Jose Ortega
 */
class connectionActions extends sfActions
{
  /**
   * Execute index cash
   * 
   * @param sfWebRequest $request 
   */
  public function executeIndex(sfWebRequest $request)
  {
  }
    
  /**
   * Execute inicialize agency
   */
  public function executeAgencyInicialize(sfWebRequest $request)
  {
    $this->agency = AgencyPeer::retrieveByPK($request->getParameter('agency_id'));
    
    if($this->agency){
      
       $this->getUser()->setAttribute('agency_id', $this->agency->getId());
    }
    
    $this->setTemplate('index');
  }
  
  /**
   * Execute agency reconnect
   * 
   * @param sfWebRequest $request 
   */
  public function executeAgencyReconnect(sfWebRequest $request)
  {    
    $this->getUser()->getAttributeHolder()->remove('agency_id');
    
    //close cash
    if($this->getUser()->getCash()){
      
      $this->getUser()->getAttributeHolder()->remove('cash_id');
    }
    
    $this->setTemplate('index');
  }
  
  /**
   * Execute open cash
   * 
   * @param sfWebRequest $request 
   */
  public function executeCashOpen(sfWebRequest $request)
  {
    if($this->getUser()->getAgency()){
      
      $this->cash = CashPeer::retrieveByPK($request->getParameter('cash_id'));
      
      if($this->cash){
      
        $this->forward404If($this->cash->getAgencyId() != $this->getUser()->getAgency()->getId());
        $this->getUser()->setAttribute('cash_id', $this->cash->getId());
      }
    }

    $this->setTemplate('index');
  }
  
  /**
   * Execute close cash
   * 
   * @param sfWebRequest $request 
   */
  public function executeCashClose(sfWebRequest $request)
  {    
    $this->getUser()->getAttributeHolder()->remove('cash_id');
    
    $this->setTemplate('index');
  }
}
