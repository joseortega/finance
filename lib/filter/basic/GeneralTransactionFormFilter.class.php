<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GeneralTransactionFormFilter
 *
 * @author jose
 */
class GeneralTransactionFormFilter extends TransactionFormFilter
{
  public function configure() 
  {
    parent::configure();
    
    $criteria = new Criteria();
    $criteria->add(TransactionTypePeer::CASH_BALANCE_IS_AFFECT, true, Criteria::EQUAL);

    $this->widgetSchema['transaction_type_id']->setOption('criteria', $criteria);
    $this->validatorSchema['transaction_type_id']->setOption('criteria', $criteria);
    
    $this->widgetSchema['id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    
    $this->validatorSchema['id'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));
    
    $this->useFields(array('id', 'user_id', 'transaction_type_id', 'created_at'));
  }
}

?>
