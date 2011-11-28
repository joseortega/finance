<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreditSearchFormFilter
 *
 * @author jose
 */
class CreditSearchFormFilter extends BaseCreditFormFilter{

  public function  configure() {
    parent::configure();

    

    $this->widgetSchema['status'] = new sfWidgetFormChoice(array(
        'choices'  => CreditPeer::$status,
        'expanded' => false,
    ));

    $this->validatorSchema['status'] = new sfValidatorChoice(array(
            'choices' => array_keys(CreditPeer::$status),
        ));

    $this->useFields(array('status','credit_product_id', 'associate_id', 'created_at'));
  }
}
?>
