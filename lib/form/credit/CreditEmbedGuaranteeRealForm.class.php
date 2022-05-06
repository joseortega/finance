<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreditGuaranteRealEmbedForm
 *
 * @author jose
 */
class CreditEmbedGuaranteeRealForm extends BaseCreditForm{

  private  $markForDeletion = array();

  public function  configure() {
    parent::configure();

    $this->useFields();

    $guarantees = $this->getObject()->getGuaranteeReals();

    if(!$guarantees){

      $guarantee = new GuaranteeReal();
      $guarantee->setCredit($this->getObject());

      $guarantees = array($guarantee);
    }

    $forms = new sfForm();

    foreach ($guarantees as $key=>$guarantee){

      $guaranteeForm = new GuaranteeRealForm($guarantee);
      if(!$guaranteeForm->getObject()->isNew()){
        $guaranteeForm->widgetSchema['delete'] = new sfWidgetFormInputCheckbox();
        $guaranteeForm->validatorSchema['delete'] = new sfValidatorBoolean();
      }
      $forms->embedForm($key, $guaranteeForm);
    }

    $this->embedForm('guarantees', $forms);


  }

    /**
   *
   * @param integer $num
   */

  public function addGuarantee($num){

    $guarantee = new GuaranteeReal();
    $guarantee->setCredit($this->getObject());

    $guaranteeForm = new GuaranteeRealForm($guarantee);

    $guaranteeForm->widgetSchema['remove'] = new sfWidgetFormPlain(array('value'=>'<a class="removenew" href="#">X</a>'));

    $this->embeddedForms['guarantees']->embedForm($num, $guaranteeForm);

    $this->embedForm('guarantees', $this->embeddedForms['guarantees']);
  }

    /**
     * @see sfForm
     */

  public function bind(array $taintedValues = null, array $taintedFiles = null){

    foreach($taintedValues['guarantees'] as $key=>$newGuarantee){

      if (!isset($this['guarantees'][$key])){

        $this->addGuarantee($key);

      }else{

        if(isset ($newGuarantee['delete'])){
            $this->markForDeletion[$key] = $newGuarantee['id'];
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

        unset($values['guarantees'][$index]);
        unset($this->embeddedForms['guarantees'][$index]);

        GuaranteeRealPeer::retrieveByPK($id)->delete();

      }
    }

    parent::doUpdateObject($values);
  }
}
?>
