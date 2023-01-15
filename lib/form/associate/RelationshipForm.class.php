<?php

/**
 * Personnel form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class RelationshipForm extends BaseRelationshipForm
{
  public function configure()
  {
    $this->useFields(array('name', 'type', 'phone_number'));
    
    $this->validatorSchema['name']->setOption('required', false);
    $this->validatorSchema['type']->setOption('required', false);
    
    if($this->getObject()->getAssociate()->isPerson()){
      
      $this->widgetSchema['type'] = new sfWidgetFormChoice(array(
          'choices'  => RelationshipPeer::$relation,
          'expanded' => false,
       ));

      $this->validatorSchema['type'] = new sfValidatorChoice(array(
          'choices' => array_keys(RelationshipPeer::$relation),
      ));

      $this->widgetSchema['type']->setLabel('Relation');
      
    }elseif($this->getObject()->getAssociate()->isOrganization()){
      
      $this->widgetSchema['type']->setLabel('Position');
    }
  }
}
