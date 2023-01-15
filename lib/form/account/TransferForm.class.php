<?php

/**
 * Transfer form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class TransferForm extends BaseTransferForm
{
  public function configure()
  {
    $this->useFields(array('account_origin_id', 'account_destination_id', 'amount', 'observation'));
    
    $this->widgetSchema['account_origin_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['account_origin_id']->setOption('renderer_options', array(
      'model' => 'Account',
      'url'   => $this->getOption('url'),
    ));
    
    $this->widgetSchema['account_destination_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['account_destination_id']->setOption('renderer_options', array(
      'model' => 'Account',
      'url'   => $this->getOption('url'),
    ));
    
    
    $this->validatorSchema['amount'] = new sfValidatorNumber(array('min'=>0.01, 'max'=>99999999.99));
    
    $this->mergePostValidator(new TransferValidatorSchema(null));
  }
}
