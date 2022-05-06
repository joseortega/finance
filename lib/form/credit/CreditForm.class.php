<?php

/**
 * Credit form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class CreditForm extends BaseCreditForm
{
  public function configure()
  {
    $this->useFields(array('product_id', 'associate_id', 'amount', 'time_in_months', 'pay_frequency_in_months', 'purpose'));
    
    $this->widgetSchema['associate_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['associate_id']->setOption('renderer_options', array(
      'model' => 'Associate',
      'url'   => $this->getOption('url'),
    ));
    
    $this->widgetSchema->setHelp('associate_id', 'Name of the associate.');

    $this->validatorSchema['time_in_months'] = new sfValidatorInteger(array('min' => 1, 'max' => 2147483647));
    
    $this->validatorSchema['pay_frequency_in_months'] = new sfValidatorInteger(array('min' => 1, 'max' => 2147483647));
    
    $this->validatorSchema['amount'] = new sfValidatorNumber(array('min'=>0.01, 'max'=>99999999.99));
    
    $this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('pay_frequency_in_months','<=', 'time_in_months'));

    $this->mergePostValidator(new CreditValidatorSchema());
    
    if(!$this->getObject()->isNew()){
      unset ($this['associate_id'], $this['account_id']);
    }
  }
}
