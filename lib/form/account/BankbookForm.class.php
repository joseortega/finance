<?php

/**
 * AccountBankbook form.
 *
 * @package    finance
 * @subpackage form
 * @author     Your name here
 */
class BankbookForm extends BaseBankbookForm
{
  /**
   * Configure this form
   */
  public function configure()
  {
    $this->useFields(array('account_id'));
    
    $this->widgetSchema['account_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['account_id']->setOption('renderer_options', array(
      'model' => 'Account',
      'url'   => $this->getOption('url'),
    ));
  }
}
