<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvestmentProductEmbedRateTermForm
 *
 * @author jose
 */
class InvestmentProductEmbedRateTermForm extends InvestmentProductForm
{
  /**
   * Configure this form
   */
  public function configure() 
  {
    parent::configure();
    
    $this->useFields();
    
    $rateTerms = $this->getObject()->getInterestRates();
    
    if(!$rateTerms)
    {
      $rateTerm = new RateTerm();
      
      $productInterestRate = new InvestmentProductInterestRate();
      $productInterestRate->setProduct($this->getObject());
      
      $rateTerm->addInvestmentProductInterestRate($productInterestRate);
      
      $rateTerms[] = $rateTerm;
    }
    
    $form = new sfForm();
    
    foreach ($rateTerms as $key => $rateTerm){
      
      $rateTermForm = new RateTermForm($rateTerm);
      
      if(!$rateTermForm->getObject()->isNew()){
        $rateTermForm->widgetSchema['delete'] = new sfWidgetFormInputCheckbox();
        $rateTermForm->validatorSchema['delete'] = new sfValidatorBoolean();
      }
      
      $form->embedForm($key, $rateTermForm);
    }
    
    $this->embedForm('rate_terms', $form);
  }
  
  /**
   * Add RateTermForm
   * @param type $key 
   */
  public function addRateTerm($key)
  {
    $rateTerm = new RateTerm();
      
    $productInterestRate = new InvestmentProductInterestRate();
    $productInterestRate->setProduct($this->getObject());

    $rateTerm->addInvestmentProductInterestRate($productInterestRate);

    $rateTermForm = new RateTermForm($rateTerm);

    $rateTermForm->widgetSchema['remove'] = new sfWidgetFormPlain(array('value'=>'<a class="removenew" href="#">X</a>'));

    $this->embeddedForms['rate_terms']->embedForm($key, $rateTermForm);

    $this->embedForm('rate_terms', $this->embeddedForms['rate_terms']);
  }

  /**
   * @see sfForm
   */
  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
    foreach($taintedValues['rate_terms'] as $key=>$newRateTime){

      if (!isset($this['rate_terms'][$key])){

        $this->addRateTerm($key);

      }else{

        if(isset ($newRateTime['delete']) && $newRateTime['id']){
            $this->markForDeletion[$key] = $newRateTime['id'];
        }
      }

    }

    parent::bind($taintedValues, $taintedFiles);
  }

  /**
   * @see sfFormPropel
   */

  public function  doUpdateObject($values) 
  {
    if (count($this->markForDeletion)){

      foreach ($this->markForDeletion as $index => $id){

        unset($values['rate_terms'][$index]);
        unset($this->embeddedForms['rate_terms'][$index]);

        InvestmentProductInterestRatePeer::retrieveByPK($this->getObject()->getId(), $id)->delete();
      }
    }

    parent::doUpdateObject($values);
  }
}

?>
