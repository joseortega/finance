<?php

/**
 * TransactionType form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class TransactionTypeForm extends BaseTransactionTypeForm
{
  /**
   * Configure this form
   */
  public function configure()
  {
    $this->useFields(array('nature', 'cash_balance_is_affect', 'concept', 'initials'));
    
    $this->widgetSchema['nature'] = new sfWidgetFormChoice(array(
        'choices'  => TransactionTypePeer::$nature,
        'expanded' => false,
    ));
    
    $this->validatorSchema['nature'] = new sfValidatorChoice(array(
        'choices' => array_keys(TransactionTypePeer::$nature),
    ));
     
    if(!$this->isNew()){

       if($this->getObject()->countTransactions()>0){
         
         //transaction nature
         $nature = $this->getObject()->getNature();
         
         //cash affect transaction
         if($this->getObject()->getCashBalanceIsAffect()){
           $cashAffect = 'yes';
         }else{
           $cashAffect = 'not';
         }
         
         //has sfContext
         if(sfContext::hasInstance()){
           
           $i18n = sfContext::getInstance()->getUser()->getCulture();
           
           $nature = sfConfig::get('app_'.$i18n.'_'.$nature);
           $cashAffect = sfConfig::get('app_'.$i18n.'_'.$cashAffect);
         }
         
         $this->setWidget('nature', new sfWidgetFormPlain(array('value'=> $nature)));
         unset($this->validatorSchema['nature']);
         
         $this->setWidget('cash_balance_is_affect', new sfWidgetFormPlain(array('value'=>$cashAffect)));
         unset($this->validatorSchema['cash_balance_is_affect']);
       }
     }
  }
}
