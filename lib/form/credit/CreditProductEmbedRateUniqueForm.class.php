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
class CreditProductEmbedRateUniqueForm extends CreditProductForm
{
  public function configure() 
  {
    parent::configure(); 
    $this->useFields();
    
    $rateUniqueform = new RateUniqueForm();
    
    $rateUniqueform->useFields(array('value'));
    
    $creditProductRateUnique = new CreditProductInterestRate();
    
    $creditProductRateUnique->setRateUnique($rateUniqueform->getObject());
    $creditProductRateUnique->setProduct($this->getObject());
    
    $this->getObject()->addCreditProductInterestRate($creditProductRateUnique);
    
    $this->embedForm('rate_unique', $rateUniqueform);
  }
}

?>
