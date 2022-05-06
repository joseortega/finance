<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountTransactionTypeTransferFromInvestment
 *
 * @author jose
 */
class CreditTransactionTypeConfigurationForm extends TransactionTypeForm
{
  public function configure() {
    parent::configure();
    
    $this->useFields(array('concept', 'initials'));
    
    $this->getObject()->setType(TransactionType::TYPE_CREDIT);
  }
}

?>
