<?php

/**
 * InvestmentTransaction filter form.
 *
 * @package    fynance
 * @subpackage filter
 * @author     Your name here
 */
class InvestmentTransactionFormFilter extends TransactionFormFilter
{
  public function configure()
  {    
    $this->widgetSchema['id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    
    $this->validatorSchema['id'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));
    
    $criteria = new Criteria();
    $criteria->add(TransactionTypePeer::TYPE, TransactionType::TYPE_INVESTMENT, Criteria::EQUAL);

    $this->widgetSchema['transaction_type_id']->setOption('criteria', $criteria);
    $this->validatorSchema['transaction_type_id']->setOption('criteria', $criteria);
    
    $this->widgetSchema['investment_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['investment_id']->setOption('renderer_options', array(
      'model' => 'Investment',
      'url'   => $this->getOption('url'),
    ));
    
    $this->useFields(array('id','user_id', 'investment_id', 'transaction_type_id', 'created_at'));
  }
}
