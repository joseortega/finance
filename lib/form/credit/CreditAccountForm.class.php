<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreditAccountForm
 *
 * @author jose
 */
class CreditAccountForm extends BaseCreditForm{

  public function  configure() {
    parent::configure();
    
    $this->useFields(array('account_id'));

    $criteria = new Criteria();
    $criteria->add(AccountPeer::ASSOCIATE_ID, $this->getObject()->getAssociateId(), Criteria::EQUAL);

    $this->widgetSchema['account_id'] = new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => false, 'expanded'=>true));
    $this->widgetSchema['account_id']->setOption('criteria', $criteria);
  }
}
?>
