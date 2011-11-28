<?php

/**
 * RateUnique form base class.
 *
 * @method RateUnique getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseRateUniqueForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                 => new sfWidgetFormInputHidden(),
      'value'                              => new sfWidgetFormInputText(),
      'created_at'                         => new sfWidgetFormDateTime(),
      'credit_product_interest_rate_list'  => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'CreditProduct')),
      'credit_product_arrear_rate_list'    => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'CreditProduct')),
      'account_product_interest_rate_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'AccountProduct')),
    ));

    $this->setValidators(array(
      'id'                                 => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'value'                              => new sfValidatorNumber(),
      'created_at'                         => new sfValidatorDateTime(),
      'credit_product_interest_rate_list'  => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'CreditProduct', 'required' => false)),
      'credit_product_arrear_rate_list'    => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'CreditProduct', 'required' => false)),
      'account_product_interest_rate_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'AccountProduct', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rate_unique[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RateUnique';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['credit_product_interest_rate_list']))
    {
      $values = array();
      foreach ($this->object->getCreditProductInterestRates() as $obj)
      {
        $values[] = $obj->getProductId();
      }

      $this->setDefault('credit_product_interest_rate_list', $values);
    }

    if (isset($this->widgetSchema['credit_product_arrear_rate_list']))
    {
      $values = array();
      foreach ($this->object->getCreditProductArrearRates() as $obj)
      {
        $values[] = $obj->getProductId();
      }

      $this->setDefault('credit_product_arrear_rate_list', $values);
    }

    if (isset($this->widgetSchema['account_product_interest_rate_list']))
    {
      $values = array();
      foreach ($this->object->getAccountProductInterestRates() as $obj)
      {
        $values[] = $obj->getProductId();
      }

      $this->setDefault('account_product_interest_rate_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCreditProductInterestRateList($con);
    $this->saveCreditProductArrearRateList($con);
    $this->saveAccountProductInterestRateList($con);
  }

  public function saveCreditProductInterestRateList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['credit_product_interest_rate_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(CreditProductInterestRatePeer::RATE_UNIQUE_ID, $this->object->getPrimaryKey());
    CreditProductInterestRatePeer::doDelete($c, $con);

    $values = $this->getValue('credit_product_interest_rate_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CreditProductInterestRate();
        $obj->setRateUniqueId($this->object->getPrimaryKey());
        $obj->setProductId($value);
        $obj->save();
      }
    }
  }

  public function saveCreditProductArrearRateList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['credit_product_arrear_rate_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(CreditProductArrearRatePeer::RATE_UNIQUE_ID, $this->object->getPrimaryKey());
    CreditProductArrearRatePeer::doDelete($c, $con);

    $values = $this->getValue('credit_product_arrear_rate_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CreditProductArrearRate();
        $obj->setRateUniqueId($this->object->getPrimaryKey());
        $obj->setProductId($value);
        $obj->save();
      }
    }
  }

  public function saveAccountProductInterestRateList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['account_product_interest_rate_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(AccountProductInterestRatePeer::RATE_UNIQUE_ID, $this->object->getPrimaryKey());
    AccountProductInterestRatePeer::doDelete($c, $con);

    $values = $this->getValue('account_product_interest_rate_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new AccountProductInterestRate();
        $obj->setRateUniqueId($this->object->getPrimaryKey());
        $obj->setProductId($value);
        $obj->save();
      }
    }
  }

}
