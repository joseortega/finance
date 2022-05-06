<?php

/**
 * AccountTransaction filter form.
 *
 * @package    fynance
 * @subpackage filter
 * @author     Your name here
 */
class AccountTransactionFormFilter extends TransactionFormFilter
{
  public function configure()
  {       
    $criteria = new Criteria();
    $criteria->add(TransactionTypePeer::TYPE, TransactionType::TYPE_ACCOUNT, Criteria::EQUAL);
    
    $this->widgetSchema['id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    
    $this->validatorSchema['id'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));
    
    $this->widgetSchema['transaction_type_id']->setOption('criteria', $criteria);
    $this->validatorSchema['transaction_type_id']->setOption('criteria', $criteria);
    
    $this->widgetSchema['account_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['account_id']->setOption('renderer_options', array(
      'model' => 'Account',
      'url'   => $this->getOption('url'),
    ));
    
    $this->useFields(array('id','user_id', 'account_id','transaction_type_id', 'created_at'));
  }
 
}
