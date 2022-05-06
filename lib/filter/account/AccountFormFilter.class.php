<?php

/**
 * Account filter form.
 *
 * @package    fynance
 * @subpackage filter
 * @author     Your name here
 */
class AccountFormFilter extends BaseAccountFormFilter
{
  public function configure()
  {
    $this->useFields(array('number', 'associate_id', 'product_id'));
    
    $this->widgetSchema['associate_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['associate_id']->setOption('renderer_options', array(
      'model' => 'Associate',
      'url'   => $this->getOption('url'),
    ));
  }
}
