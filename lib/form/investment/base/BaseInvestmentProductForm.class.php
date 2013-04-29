<?php

/**
 * InvestmentProduct form base class.
 *
 * @method InvestmentProduct getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseInvestmentProductForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                    => new sfWidgetFormInputHidden(),
      'name'                                  => new sfWidgetFormInputText(),
      'tax_rate'                              => new sfWidgetFormInputText(),
      'created_at'                            => new sfWidgetFormDateTime(),
      'updated_at'                            => new sfWidgetFormDateTime(),
      'investment_product_interest_rate_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'RateTerm')),
    ));

    $this->setValidators(array(
      'id'                                    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'                                  => new sfValidatorString(array('max_length' => 60)),
      'tax_rate'                              => new sfValidatorNumber(),
      'created_at'                            => new sfValidatorDateTime(),
      'updated_at'                            => new sfValidatorDateTime(),
      'investment_product_interest_rate_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'RateTerm', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'InvestmentProduct', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('investment_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'InvestmentProduct';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['investment_product_interest_rate_list']))
    {
      $values = array();
      foreach ($this->object->getInvestmentProductInterestRates() as $obj)
      {
        $values[] = $obj->getRateTermId();
      }

      $this->setDefault('investment_product_interest_rate_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveInvestmentProductInterestRateList($con);
  }

  public function saveInvestmentProductInterestRateList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['investment_product_interest_rate_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(InvestmentProductInterestRatePeer::PRODUCT_ID, $this->object->getPrimaryKey());
    InvestmentProductInterestRatePeer::doDelete($c, $con);

    $values = $this->getValue('investment_product_interest_rate_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new InvestmentProductInterestRate();
        $obj->setProductId($this->object->getPrimaryKey());
        $obj->setRateTermId($value);
        $obj->save();
      }
    }
  }

}
