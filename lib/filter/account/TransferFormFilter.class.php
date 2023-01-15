<?php

/**
 * Transfer filter form.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
class TransferFormFilter extends BaseTransferFormFilter
{
  public function configure()
  {
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
    
    $this->useFields(array('account_origin_id', 'account_destination_id','user_id', 'created_at'));
  }
}
