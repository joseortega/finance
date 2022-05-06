<?php

/**
 * InvestmentProduct form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class InvestmentProductForm extends BaseInvestmentProductForm
{
  public function configure()
  {
    $this->useFields(array('name', 'tax_rate'));
    
    $this->validatorSchema['tax_rate'] = new sfValidatorNumber(array('min'=>0.00, 'max'=>99999999.99));
  }
}
