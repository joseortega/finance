<?php

/**
 * AccountTransactionType form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class AccountTransactionTypeForm extends TransactionTypeForm
{
  /**
   * Configure this form
   */
  public function configure()
  {
    parent::configure();
    
    $this->getObject()->setOperationType(TransactionType::CUSTOM);
    $this->getObject()->setType(TransactionType::TYPE_ACCOUNT);
    
  }
}
