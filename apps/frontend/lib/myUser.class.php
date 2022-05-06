<?php

class myUser extends sfGuardSecurityUser
{
  protected $agency = null;
  protected $cash = null;

  public function getCash()
  {
    $this->cash = CashPeer::retrieveByPK($this->getAttribute('cash_id'));
    
    if(!$this->cash){
      
      $this->getAttributeHolder()->remove('cash_id');
    }
    
    return $this->cash;
  }
  
  public function getAgency()
  {
    $this->agency = AgencyPeer::retrieveByPK($this->getAttribute('agency_id'));
    
    if(!$this->agency){
      
      $this->getAttributeHolder()->remove('agency_id');
      $this->getAttributeHolder()->remove('cash_id');
    }
    
    return $this->agency;
  }
}
