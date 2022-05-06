<?php

/**
 * CreditGuaranteePersonal form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class GuaranteePersonalForm extends BaseGuaranteePersonalForm
{
  public function configure()
  {
    $this->widgetSchema['associate_id'] =  new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => false));
    
    if(sfContext::hasInstance()){
      $this->widgetSchema['associate_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
      $this->widgetSchema['associate_id']->setOption('renderer_options', array(
        'model' => 'Associate',
        'url'   => $this->getOption('url'),
      ));
    }
  }
}
