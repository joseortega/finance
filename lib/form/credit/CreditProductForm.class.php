<?php

/**
 * CreditProduct form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class CreditProductForm extends BaseCreditProductForm
{
  public function configure()
  {
    $this->useFields(array('name', 'amortization_type', 'grace_days'));

    $this->widgetSchema['amortization_type'] = new sfWidgetFormChoice(array(
        'choices'  => CreditProductPeer::$amortizationTypes,
        'expanded' => true,
    ));

    $this->validatorSchema['amortization_type'] = new sfValidatorChoice(array(
        'choices' => array_keys(CreditProductPeer::$amortizationTypes),
    ));
    
    $this->validatorSchema['grace_days'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647));
  }
}
