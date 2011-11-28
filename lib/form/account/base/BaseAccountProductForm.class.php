<?php

/**
 * AccountProduct form base class.
 *
 * @method AccountProduct getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseAccountProductForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                    => new sfWidgetFormInputHidden(),
      'name'                                  => new sfWidgetFormInputText(),
      'capitalization_frequency'              => new sfWidgetFormInputText(),
      'created_at'                            => new sfWidgetFormDateTime(),
      'updated_at'                            => new sfWidgetFormDateTime(),
      'account_product_transaction_type_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'TransactionType')),
      'account_product_interest_rate_list'    => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'RateUnique')),
    ));

    $this->setValidators(array(
      'id'                                    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'                                  => new sfValidatorString(array('max_length' => 60)),
      'capitalization_frequency'              => new sfValidatorString(array('max_length' => 30)),
      'created_at'                            => new sfValidatorDateTime(array('required' => false)),
      'updated_at'                            => new sfValidatorDateTime(array('required' => false)),
      'account_product_transaction_type_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'TransactionType', 'required' => false)),
      'account_product_interest_rate_list'    => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'RateUnique', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'AccountProduct', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('account_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountProduct';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['account_product_transaction_type_list']))
    {
      $values = array();
      foreach ($this->object->getAccountProductTransactionTypes() as $obj)
      {
        $values[] = $obj->getTransactionTypeId();
      }

      $this->setDefault('account_product_transaction_type_list', $values);
    }

    if (isset($this->widgetSchema['account_product_interest_rate_list']))
    {
      $values = array();
      foreach ($this->object->getAccountProductInterestRates() as $obj)
      {
        $values[] = $obj->getRateUniqueId();
      }

      $this->setDefault('account_product_interest_rate_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveAccountProductTransactionTypeList($con);
    $this->saveAccountProductInterestRateList($con);
  }

  public function saveAccountProductTransactionTypeList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['account_product_transaction_type_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(AccountProductTransactionTypePeer::PRODUCT_ID, $this->object->getPrimaryKey());
    AccountProductTransactionTypePeer::doDelete($c, $con);

    $values = $this->getValue('account_product_transaction_type_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new AccountProductTransactionType();
        $obj->setProductId($this->object->getPrimaryKey());
        $obj->setTransactionTypeId($value);
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
    $c->add(AccountProductInterestRatePeer::PRODUCT_ID, $this->object->getPrimaryKey());
    AccountProductInterestRatePeer::doDelete($c, $con);

    $values = $this->getValue('account_product_interest_rate_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new AccountProductInterestRate();
        $obj->setProductId($this->object->getPrimaryKey());
        $obj->setRateUniqueId($value);
        $obj->save();
      }
    }
  }

}
