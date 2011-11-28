<?php

/**
 * AccountProduct form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class AccountProductForm extends BaseAccountProductForm
{ 
  /**
   * Configure this form
   */
  public function configure()
  { 
    $this->useFields(array('name', 'capitalization_frequency'));    
    
    $this->widgetSchema['capitalization_frequency'] = new sfWidgetFormChoice(array(
        'choices'  => AccountProductPeer::$capitalization_frequency,
        'expanded' => false,
    ));
    
    $this->validatorSchema['capitalization_frequency'] = new sfValidatorChoice(array(
        'choices' => array_keys(AccountProductPeer::$capitalization_frequency),
    ));
    
    $this->widgetSchema->setHelp('capitalization_frequency', 'Support for the calculation of interest daily on the balance the end day.');
  }
}
