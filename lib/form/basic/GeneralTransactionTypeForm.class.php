<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GeneralTransactionTypeForm
 *
 * @author jose
 */
class GeneralTransactionTypeForm extends TransactionTypeForm
{
  /**
   * configuration this form
   */
  public function configure() 
  {
    parent::configure();
    
    $this->useFields(array('nature', 'concept', 'initials'));
    
    $this->getObject()->setCashBalanceIsAffect(TRUE);
    $this->getObject()->setType(TransactionType::TYPE_GENERAL);

  }
}

?>
