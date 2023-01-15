<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanyPersonnelForm
 *
 * @author jose
 */
class AccountingVoucherEmbedVoucherItemForm extends AccountingVoucherForm
{
    public function  configure() {
        parent::configure();

        $voucherItems = $this->getObject()->getAccountingVoucherItems();

        if(!$voucherItems){
            $voucherItem = new AccountingVoucherItem();
            $voucherItem->setAccountingVoucher($this->getObject());

            $voucherItems = array($voucherItem);
        }

        $form = new sfForm();

        foreach ($voucherItems as $key=>$voucherItem){

            $voucherItemForm = new AccountingVoucherItemForm($voucherItem, array('url'   => $this->getOption('url'),));

            if(!$voucherItemForm->getObject()->isNew()){
                $voucherItemForm->widgetSchema['delete'] = new sfWidgetFormInputCheckbox();
                $voucherItemForm->widgetSchema->setHelp('delete', 'Mark this item to delete');
                $voucherItemForm->validatorSchema['delete'] = new sfValidatorBoolean();
            }

            $form->embedForm($key, $voucherItemForm);
        }

        $this->embedForm('voucher_items', $form);
    }

    public function addRelationship($key){

        $relationship = new Relationship();
        $relationship->setAssociate($this->getObject());

        $relationshipFrom = new RelationshipForm($relationship);

        $relationshipFrom->widgetSchema['remove'] = new sfWidgetFormPlain(array('value'=>'<a class="removenew" href="#">X</a>'));

        $this->embeddedForms['relations']->embedForm($key, $relationshipFrom);

        $this->embedForm('relations', $this->embeddedForms['relations']);
    }

    /**
     * @see sfForm
     */
    public function bind(array $taintedValues = null, array $taintedFiles = null){

        foreach($taintedValues['relations'] as $key=>$newRelationship){

            if (!isset($this['relations'][$key])){

                $this->addRelationship($key);

            }else{

                if(isset ($newRelationship['delete']) && $newRelationship['id']){
                    $this->markForDeletion[$key] = $newRelationship['id'];
                }
            }

        }

        parent::bind($taintedValues, $taintedFiles);
    }

    /**
     * @see sfFormPropel
     */
    public function  doUpdateObject($values) {

        if (count($this->markForDeletion)){

          foreach ($this->markForDeletion as $index => $id){

            unset($values['relations'][$index]);
            unset($this->embeddedForms['relations'][$index]);

            RelationshipPeer::retrieveByPK($id)->delete();

          }
        }

        parent::doUpdateObject($values);
    }
}
?>
