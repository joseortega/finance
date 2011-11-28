<?php

/**
 * Phone form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class PhoneForm extends BasePhoneForm
{
  public function configure()
  {
    $this->useFields(array('number', 'type'));

    $this->widgetSchema['type'] = new sfWidgetFormChoice(array(
        'choices'  => PhonePeer::$types,
        'expanded' => false,
    ));

    $this->validatorSchema['type'] = new sfValidatorChoice(array(
        'choices' => array_keys(PhonePeer::$types),
    ));
      
    $this->widgetSchema['number']->setAttribute('class', 'phoneNumber');
    
    $this->validatorSchema['number']->setOption('trim', true);
    $this->validatorSchema['number']->setOption('required', false);
    
    $this->validatorSchema['type']->setOption('trim', true);
    $this->validatorSchema['type']->setOption('required', false);
      
  }
}
