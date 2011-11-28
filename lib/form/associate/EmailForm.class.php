<?php

/**
 * Email form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class EmailForm extends BaseEmailForm
{
  public function configure()
  {
    $this->useFields(array('address'));
    
    $this->validatorSchema['address'] = new sfValidatorAnd(array(
        $this->validatorSchema['address'],
        new sfValidatorEmail(),
    ));
    
    $this->validatorSchema['address']->setOption('trim', true);
    $this->validatorSchema['address']->setOption('required', true);
  }
}
