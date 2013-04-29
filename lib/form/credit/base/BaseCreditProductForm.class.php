<?php

/**
 * CreditProduct form base class.
 *
 * @method CreditProduct getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseCreditProductForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                => new sfWidgetFormInputHidden(),
      'name'                              => new sfWidgetFormInputText(),
      'amortization_type'                 => new sfWidgetFormInputText(),
      'grace_days'                        => new sfWidgetFormInputText(),
      'created_at'                        => new sfWidgetFormDateTime(),
      'updated_at'                        => new sfWidgetFormDateTime(),
      'credit_product_arrear_rate_list'   => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'RateUnique')),
      'credit_product_interest_rate_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'RateUnique')),
    ));

    $this->setValidators(array(
      'id'                                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'                              => new sfValidatorString(array('max_length' => 60)),
      'amortization_type'                 => new sfValidatorString(array('max_length' => 60)),
      'grace_days'                        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'created_at'                        => new sfValidatorDateTime(),
      'updated_at'                        => new sfValidatorDateTime(),
      'credit_product_arrear_rate_list'   => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'RateUnique', 'required' => false)),
      'credit_product_interest_rate_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'RateUnique', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'CreditProduct', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('credit_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CreditProduct';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['credit_product_arrear_rate_list']))
    {
      $values = array();
      foreach ($this->object->getCreditProductArrearRates() as $obj)
      {
        $values[] = $obj->getRateUniqueId();
      }

      $this->setDefault('credit_product_arrear_rate_list', $values);
    }

    if (isset($this->widgetSchema['credit_product_interest_rate_list']))
    {
      $values = array();
      foreach ($this->object->getCreditProductInterestRates() as $obj)
      {
        $values[] = $obj->getRateUniqueId();
      }

      $this->setDefault('credit_product_interest_rate_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCreditProductArrearRateList($con);
    $this->saveCreditProductInterestRateList($con);
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
    $c->add(CreditProductArrearRatePeer::PRODUCT_ID, $this->object->getPrimaryKey());
    CreditProductArrearRatePeer::doDelete($c, $con);

    $values = $this->getValue('credit_product_arrear_rate_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CreditProductArrearRate();
        $obj->setProductId($this->object->getPrimaryKey());
        $obj->setRateUniqueId($value);
        $obj->save();
      }
    }
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
    $c->add(CreditProductInterestRatePeer::PRODUCT_ID, $this->object->getPrimaryKey());
    CreditProductInterestRatePeer::doDelete($c, $con);

    $values = $this->getValue('credit_product_interest_rate_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new CreditProductInterestRate();
        $obj->setProductId($this->object->getPrimaryKey());
        $obj->setRateUniqueId($value);
        $obj->save();
      }
    }
  }

}
