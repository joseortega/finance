<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreditProductEmbedRateUniqueForm
 *
 * @author jose
 */
class CreditProductEmbedArrearRateForm extends CreditProductForm
{
  public function configure() 
  {
    parent::configure(); 
    $this->useFields();
    
    $rateUniqueform = new RateUniqueForm();
    
    $rateUniqueform->useFields(array('value'));
    
    $creditProductArrearRate = new CreditProductArrearRate();
    
    $creditProductArrearRate->setRateUnique($rateUniqueform->getObject());
    $creditProductArrearRate->setProduct($this->getObject());
    
    $this->getObject()->addCreditProductArrearRate($creditProductArrearRate);
    
    $this->embedForm('rate_unique', $rateUniqueform);
  }
}

?>
