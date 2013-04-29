<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreditApproveForm
 *
 * @author jose
 */
class CreditPreDisburseForm extends BaseCreditForm
{
    public function configure() 
    {
        parent::configure();
        
        $this->useFields(array('account_id'));
        
        $criteria = new Criteria();
        $criteria->add(AccountPeer::ASSOCIATE_ID, $this->getObject()->getAssociateId());
        
        $this->widgetSchema['account_id']->setOption('criteria', $criteria);
        $this->widgetSchema['account_id']->setOption('multiple', true);
    }
}

?>
