<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountTransactionTypeTransferFromInvestment
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class AccountTransactionTypeConfigurationForm extends BaseTransactionTypeForm
{
  /**
   * Configure this form
   */
  public function configure() 
  {
    parent::configure();
    
    $this->useFields(array('concept', 'initials')); 
    
    $this->getObject()->setType(TransactionType::TYPE_ACCOUNT);
  }
}

?>
