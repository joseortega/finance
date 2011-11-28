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
class AccountProductEmbedRateUniqueForm extends AccountProductForm
{
  /**
   * Form configuration
   */
  public function configure() 
  {
    parent::configure(); 
    $this->useFields();
    
    $rateUniqueform = new RateUniqueForm();
    
    $rateUniqueform->useFields(array('value'));
    
    $productRateUnique = new AccountProductInterestRate();
    
    $productRateUnique->setRateUnique($rateUniqueform->getObject());
    $productRateUnique->setProduct($this->getObject());
    
    $this->getObject()->addAccountProductInterestRate($productRateUnique);
    
    $this->embedForm('rate_unique', $rateUniqueform);
  }
}

?>
