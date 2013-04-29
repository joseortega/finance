<?php

/**
 * CreditTransaction filter form.
 *
 * @package    fynance
 * @subpackage filter
 * @author     Your name here
 */
class CreditTransactionFormFilter extends TransactionFormFilter
{
  public function configure()
  {    
    $this->widgetSchema['id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    
    $this->validatorSchema['id'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));
    
    $criteria = new Criteria();
    $criteria->add(TransactionTypePeer::TYPE, TransactionType::TYPE_CREDIT, Criteria::EQUAL);

    $this->widgetSchema['transaction_type_id']->setOption('criteria', $criteria);
    $this->validatorSchema['transaction_type_id']->setOption('criteria', $criteria);
    
    $this->widgetSchema['credit_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['credit_id']->setOption('renderer_options', array(
      'model' => 'Credit',
      'url'   => $this->getOption('url'),
    ));
    
    $this->useFields(array('id','user_id', 'credit_id', 'transaction_type_id', 'created_at'));
  }
}
