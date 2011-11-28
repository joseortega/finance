<?php

/**
 * AccountBankbook filter form.
 *
 * @package    fynance
 * @subpackage filter
 * @author     Your name here
 */
class BankbookFormFilter extends BaseBankbookFormFilter
{
  public function configure()
  {   
    $this->widgetSchema['id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    
    $this->validatorSchema['id'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));
    
    $this->widgetSchema['account_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['account_id']->setOption('renderer_options', array(
      'model' => 'Account',
      'url'   => $this->getOption('url'),
    ));
    
    $this->useFields(array('id', 'account_id', 'is_active', 'created_at'));
  }
}
