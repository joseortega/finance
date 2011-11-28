<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PaymentForm
 *
 * @author jose
 */
class PaymentCustomForm extends BaseCreditForm
{
  public function configure() 
  {
    parent::configure();
    
    $this->useFields();
    
    $credit = $this->getOption('credit');
    
    $this->setWidget('account_id', new sfWidgetFormPlain(array('value'=> $this->getObject()->getAccount())));
         unset($this->validatorSchema['account_id']);
    
    $number = $credit->CountPaymentsPending();
    
    $this->widgetSchema['number_payments'] = new sfWidgetFormChoice(array(
          'choices'  => $this->generateChoicesValues($number),
          'expanded' => false,
    ));
    
    $this->validatorSchema['number_payments'] = new sfValidatorChoice(array(
          'choices' => array_keys($this->generateChoicesValues($number)),
    ));
    
    $this->setDefault('number_payments', 1);
    
    $this->mergePostValidator(new PaymentValidatorSchema(null, array(
        'accountTransactionType'=> $this->getOption('accountTransactionType'),
        'creditTransactionType'=> $this->getOption('creditTransactionType'),
        'credit'=> $this->getOption('credit')
    )));
  }
  
  public static function generateChoicesValues($number)
  {
    $choices = array();
    
    for($i = 1; $i <= $number; $i++){
      $choices[$i] = $i;
    }
    
    return $choices;
  }
}

?>
