<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GeneralTransactionForm
 *
 * @author jose
 */
class GeneralTransactionForm extends TransactionForm
{
  /**
   * Configuration this form
   */
  public function configure() 
  {
    parent::configure();
    
    $criteria = new Criteria();
    $criteria->add(TransactionTypePeer::TYPE, TransactionType::TYPE_GENERAL, Criteria::EQUAL);

    $this->widgetSchema['transaction_type_id']->setOption('criteria', $criteria);
    $this->validatorSchema['transaction_type_id']->setOption('criteria', $criteria);
    
    $this->mergePostValidator(new GeneralTransactionValidatorSchema(null, array('cash'=> $this->getOption('cash'))));
  }
}

?>
