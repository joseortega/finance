<?php

/**
 * Investment filter form.
 *
 * @package    fynance
 * @subpackage filter
 * @author     Your name here
 */
class InvestmentFormFilter extends BaseInvestmentFormFilter
{
  public function configure()
  {
    $this->widgetSchema['associate_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['associate_id']->setOption('renderer_options', array(
      'model' => 'Associate',
      'url'   => $this->getOption('url'),
    ));
    
    $this->widgetSchema['id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    
    $this->validatorSchema['id'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));
    
    $this->useFields(array('id', 'associate_id', 'product_id', 'created_at', 'expiration_date'));
  }
}
