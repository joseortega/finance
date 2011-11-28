<?php

/**
 * RateUnique form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class RateUniqueForm extends BaseRateUniqueForm
{
  public function configure()
  {
    $this->validatorSchema['value'] = new sfValidatorNumber(array('min'=>0.00, 'max'=>99999999.99));
  }
}
