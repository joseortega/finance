<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AssociatePhonesValidatorSchema
 *
 * @author jose
 * @package    fynance
 * @subpackage validator
 */
class AssociatePhonesValidatorSchema extends sfValidatorSchema{
  protected function configure($options = array(), $messages = array())
  {
    $this->addMessage('number', 'The caption is required.');
  }
 
  protected function doClean($values)
  {
    $errorSchema = new sfValidatorErrorSchema($this);
 
    foreach($values['phones'] as $key => $value)
    {
      $errorSchemaLocal = new sfValidatorErrorSchema($this);
 
      if (!$value['number'])
      {
        unset($values['phones'][$key]);
      }
    }
 
    return $values;
  }
}

?>
