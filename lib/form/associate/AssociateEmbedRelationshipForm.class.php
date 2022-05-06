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
class AssociateEmbedRelationshipForm extends AssociateForm
{
    public function  configure() {
        parent::configure();
        
        $this->useFields(array());

        $relationships = $this->getObject()->getRelationships();

        if(!$relationships){
            $relationship = new Relationship();
            $relationship->setAssociate($this->getObject());

            $relationships = array($relationship);
        }

        $form = new sfForm();

        foreach ($relationships as $key=>$relationship){

            $relationshipForm = new RelationshipForm($relationship);

            if(!$relationshipForm->getObject()->isNew()){
                $relationshipForm->widgetSchema['delete'] = new sfWidgetFormInputCheckbox();
                $relationshipForm->widgetSchema->setHelp('delete', 'Mark this item to delete');
                $relationshipForm->validatorSchema['delete'] = new sfValidatorBoolean();
            }

            $form->embedForm($key, $relationshipForm);
        }

        $this->embedForm('relations', $form);
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
