<?php

/**
 * RateTerm form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class RateTermForm extends BaseRateTermForm
{
  public function configure()
  {
    $this->useFields(array('minimum_time', 'maximum_time', 'value'));
    
    $this->validatorSchema['minimum_time'] = new sfValidatorInteger(array('min' => 1, 'max' => 2147483647));
    $this->validatorSchema['maximum_time'] = new sfValidatorInteger(array('min' => 1, 'max' => 2147483647));
    
    $this->validatorSchema['value'] = new sfValidatorNumber(array('min'=>0.00, 'max'=>99999999.99));
    
    $this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('maximum_time', '>=', 'minimum_time'));
  }
}
