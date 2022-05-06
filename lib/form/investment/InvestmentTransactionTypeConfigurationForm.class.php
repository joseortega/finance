<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvestmentTransactionTypeConfiguration
 *
 * @author jose
 */
class InvestmentTransactionTypeConfigurationForm extends InvestmentTransactionTypeForm
{
  public function configure() {
    parent::configure();
    
    $this->useFields(array('concept', 'initials'));
    
    $this->getObject()->setType(TransactionType::TYPE_INVESTMENT);
  }
}

?>
