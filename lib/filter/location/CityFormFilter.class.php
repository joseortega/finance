<?php

/**
 * City filter form.
 *
 * @package    fynance
 * @subpackage filter
 * @author     Your name here
 */
class CityFormFilter extends BaseCityFormFilter
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
