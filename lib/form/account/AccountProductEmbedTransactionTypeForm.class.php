<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountProductEmbedTransactionTypeForm
 *
 * @author jose
 */
class AccountProductEmbedTransactionTypeForm extends BaseAccountProductForm
{
  public function  configure() 
  {
    parent::configure();

    $this->useFields(array('account_product_transaction_type_list'));
    
    $this->widgetSchema['account_product_transaction_type_list']->setOption('expanded', true);
    
    $this->widgetSchema->setLabels(array(
        'account_product_transaction_type_list' => 'Transaction types',
    ));
    
    $this->widgetSchema->setHelp('account_product_transaction_type_list', 'Link the types of transaction to this product.');
    
    $criteria = new Criteria();
    $criteria->add(TransactionTypePeer::TYPE, TransactionType::TYPE_ACCOUNT, Criteria::EQUAL);
    $criteria->add(TransactionTypePeer::OPERATION_TYPE, TransactionType::CUSTOM, Criteria::EQUAL);
     
    $this->widgetSchema['account_product_transaction_type_list']->setOption('criteria', $criteria);

  }
}
?>
