<?php

/**
 * AccountingAccount form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class AccountingAccountForm extends BaseAccountingAccountForm
{
  public function configure()
  {
      $this->useFields(array('accounting_exercise_id', 'accounting_account_id', 'type', 'nature', 'code', 'name'));
      
      $this->widgetSchema['nature'] = new sfWidgetFormChoice(array(
        'choices'  => AccountingAccountPeer::$nature,
        'expanded' => false,
      ));
      
      $this->widgetSchema['type'] = new sfWidgetFormChoice(array(
        'choices'  => AccountingAccountPeer::$type,
        'expanded' => false,
      ));
      
      if(sfContext::hasInstance()){
      $this->widgetSchema['accounting_account_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
      $this->widgetSchema['accounting_account_id']->setOption('renderer_options', array(
        'model' => 'AccountingAccount',
        'url'   => sfContext::getInstance()->getController()->genUrl('ajax/ajaxAccountingAccount'),
      ));
    }
  }
}
