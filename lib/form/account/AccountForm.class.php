<?php

/**
 * Account form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class AccountForm extends BaseAccountForm
{
  /**
   * Form configuration
   */
  public function configure()
  {
    $this->useFields(array('associate_id', 'product_id'));
      
    $this->widgetSchema['associate_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['associate_id']->setOption('renderer_options', array(
      'model' => 'Associate',
      'url'   => $this->getOption('url'),
    ));
    
    $this->widgetSchema->setHelp('associate_id', 'Escriba el nombre del socio');
  }
}
