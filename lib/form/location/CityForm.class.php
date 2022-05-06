<?php

/**
 * City form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class CityForm extends BaseCityForm
{
  public function configure()
  {
    if(sfContext::hasInstance()){
      $this->widgetSchema['province_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
      $this->widgetSchema['province_id']->setOption('renderer_options', array(
        'model' => 'Province',
        'url'   => sfContext::getInstance()->getController()->genUrl('ajax/ajaxProvince'),
      ));
    }
    
  }
}
