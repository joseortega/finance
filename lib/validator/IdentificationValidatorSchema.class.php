<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccountTransactionValidatorSchema
 *
 * @author jose
 * @package    fynance
 * @subpackage validator
 */
class IdentificationValidatorSchema extends sfValidatorSchema{

  public function  configure($options = array(), $messages = array()) 
  {
    $this->addMessage('identification', 'Other object with this identification already exists.');
    $this->addRequiredOption('type');

    parent::configure($options, $messages);
  }

  protected function doClean($values)
  {
    if(!$values['identification']){
      throw new sfValidatorErrorSchema($this, array());
    }
    
    $criteria = new Criteria();
    $criteria->add(AssociatePeer::IDENTIFICATION, $values['identification']);
    $criteria->add(AssociatePeer::TYPE, $this->getOption('type'));
    $criteria->add(AssociatePeer::ID, $values['id'], Criteria::NOT_EQUAL);
    $associate = AssociatePeer::doSelectOne($criteria);

    if($associate){
      $error = new sfValidatorError($this, 'identification');
      throw new sfValidatorErrorSchema($this, array('identification'=>$error));
    }

    return $values;
  }

}
?>
