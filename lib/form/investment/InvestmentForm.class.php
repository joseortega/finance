<?php

/**
 * Investment form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class InvestmentForm extends BaseInvestmentForm
{
  /**
   * Configure form
   */
  public function configure()
  {
    $this->useFields(array('associate_id', 'product_id', 'account_id', 'time_days', 'amount'));
    
    $this->widgetSchema['associate_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['associate_id']->setOption('renderer_options', array(
      'model' => 'Associate',
      'url'   => $this->getOption('url'),
    ));
    
    $this->widgetSchema['account_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['account_id']->setOption('renderer_options', array(
      'model' => 'Account',
      'url'   => $this->getOption('url2'),
    ));
    
    $this->widgetSchema->setHelp('associate_id', 'Name of the associate.');
    $this->widgetSchema->setHelp('account_id', 'Account to debit');
    
    $this->widgetSchema->setLabel('time_days', 'Time in days');
    
    $this->validatorSchema['amount'] = new sfValidatorNumber(array('min'=>0.01, 'max'=>99999999.99));
    $this->validatorSchema['time_days'] = new sfValidatorInteger(array('min' => 1, 'max' => 2147483647));
    
    if($this->isNew()){
      $this->mergePostValidator(new InvestmentValidatorSchema(null, array(
          'accountTransactionType'=> $this->getOption('accountTransactionType'),
          'investmentTransactionType'=> $this->getOption('investmentTransactionType'),
      )));
    }
  }
}
