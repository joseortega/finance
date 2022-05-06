<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreditAccountForm
 *
 * @author jose
 */
class CreditAmortizationTypesForm extends BaseCreditForm{

  public function  configure() {
    parent::configure();
    
    $this->useFields(array('amortization_type'));

    $this->widgetSchema['amortization_type'] = new sfWidgetFormChoice(array(
      'choices'  => CreditProductPeer::$amortizationTypes,
      'expanded' => true,
    ));

    $this->validatorSchema['amortization_type'] = new sfValidatorChoice(array(
        'choices' => array_keys(CreditProductPeer::$amortizationTypes),
    ));
  
  }
}
?>
