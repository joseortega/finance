<?php

/**
 * Configuration form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class ConfigurationForm extends BaseConfigurationForm
{
  public function configure()
  {
    $this->useFields(array('value'));
    
    $label = $this->getOption('label');
    
    $this->widgetSchema['value']->setLabel($label);
    
  }
}
