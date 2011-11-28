<?php

/**
 * Associate form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class AssociateForm extends BaseAssociateForm
{
  public function configure()
  {
    unset ($this['created_at'], $this['updated_at'], $this['guarantee_personal_list']);
   
    //widget

    $this->widgetSchema['gender'] = new sfWidgetFormChoice(array(
        'choices'  => AssociatePeer::$gender,
        'expanded' => false,
    ));

    $this->widgetSchema['relationship_status'] = new sfWidgetFormChoice(array(
        'choices'  => AssociatePeer::$relationship_status,
        'expanded' => false,
    ));

    $years = range(date('1905'), date('Y'));
    $this->widgetSchema['birthday'] = new sfWidgetFormDate(array('years'=>array_combine($years, $years)));

    //validators
    
    $this->validatorSchema['identification']->setOption('required', true);

    $this->validatorSchema['gender'] = new sfValidatorChoice(array(
        'choices' => array_keys(AssociatePeer::$gender),
    ));

    $this->validatorSchema['relationship_status'] = new sfValidatorChoice(array(
        'choices' => array_keys(AssociatePeer::$relationship_status),
    ));
    
    $this->widgetSchema->setHelp('birthday', 'This field is optional');
    
    if($this->getObject()->isPerson()){
      
      if($this->getObject()->isNew()){
        $this->useFields(array('category_id', 'name', 'identification', 'gender', 'birthday'));
      }else{
        $this->useFields(array('category_id', 'name', 'identification', 'gender', 'birthday', 'relationship_status', 'about'));
      }
      
      $this->mergePostValidator(new IdentificationValidatorSchema(null, array('type' => Associate::TYPE_PERSON)));
   
    }elseif($this->getObject()->isOrganization()){
      
      $this->widgetSchema['identification']->setLabel('Juridical identification');
      
      $this->widgetSchema['birthday']->setLabel('Constituted at');
      
      if($this->getObject()->isNew()){
        $this->useFields(array('category_id', 'name', 'identification', 'birthday'));
      }else{
        $this->useFields(array('category_id', 'name', 'identification', 'birthday', 'about'));
      }
      
      $this->mergePostValidator(new IdentificationValidatorSchema(null, array('type' => Associate::TYPE_ORGANIZATION)));
    }
  }
 
}
