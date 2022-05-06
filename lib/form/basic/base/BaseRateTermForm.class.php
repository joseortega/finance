<?php

/**
 * RateTerm form base class.
 *
 * @method RateTerm getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseRateTermForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                    => new sfWidgetFormInputHidden(),
      'minimum_time'                          => new sfWidgetFormInputText(),
      'maximum_time'                          => new sfWidgetFormInputText(),
      'value'                                 => new sfWidgetFormInputText(),
      'created_at'                            => new sfWidgetFormDateTime(),
      'investment_product_interest_rate_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'InvestmentProduct')),
    ));

    $this->setValidators(array(
      'id'                                    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'minimum_time'                          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'maximum_time'                          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'value'                                 => new sfValidatorNumber(),
      'created_at'                            => new sfValidatorDateTime(),
      'investment_product_interest_rate_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'InvestmentProduct', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rate_term[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'RateTerm';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['investment_product_interest_rate_list']))
    {
      $values = array();
      foreach ($this->object->getInvestmentProductInterestRates() as $obj)
      {
        $values[] = $obj->getProductId();
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
    $c->add(InvestmentProductInterestRatePeer::RATE_TERM_ID, $this->object->getPrimaryKey());
    InvestmentProductInterestRatePeer::doDelete($c, $con);

    $values = $this->getValue('investment_product_interest_rate_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new InvestmentProductInterestRate();
        $obj->setRateTermId($this->object->getPrimaryKey());
        $obj->setProductId($value);
        $obj->save();
      }
    }
  }

}
