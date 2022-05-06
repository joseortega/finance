<?php

/**
 * TransactionType form base class.
 *
 * @method TransactionType getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseTransactionTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                                    => new sfWidgetFormInputHidden(),
      'type'                                  => new sfWidgetFormInputText(),
      'nature'                                => new sfWidgetFormInputText(),
      'cash_balance_is_affect'                => new sfWidgetFormInputCheckbox(),
      'concept'                               => new sfWidgetFormInputText(),
      'initials'                              => new sfWidgetFormInputText(),
      'operation_type'                        => new sfWidgetFormInputText(),
      'created_at'                            => new sfWidgetFormDateTime(),
      'updated_at'                            => new sfWidgetFormDateTime(),
      'account_product_transaction_type_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'AccountProduct')),
    ));

    $this->setValidators(array(
      'id'                                    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'type'                                  => new sfValidatorString(array('max_length' => 30)),
      'nature'                                => new sfValidatorString(array('max_length' => 30)),
      'cash_balance_is_affect'                => new sfValidatorBoolean(),
      'concept'                               => new sfValidatorString(array('max_length' => 30)),
      'initials'                              => new sfValidatorString(array('max_length' => 15)),
      'operation_type'                        => new sfValidatorString(array('max_length' => 50)),
      'created_at'                            => new sfValidatorDateTime(),
      'updated_at'                            => new sfValidatorDateTime(),
      'account_product_transaction_type_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'AccountProduct', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorPropelUnique(array('model' => 'TransactionType', 'column' => array('concept'))),
        new sfValidatorPropelUnique(array('model' => 'TransactionType', 'column' => array('initials'))),
      ))
    );

    $this->widgetSchema->setNameFormat('transaction_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TransactionType';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['account_product_transaction_type_list']))
    {
      $values = array();
      foreach ($this->object->getAccountProductTransactionTypes() as $obj)
      {
        $values[] = $obj->getProductId();
      }

      $this->setDefault('account_product_transaction_type_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveAccountProductTransactionTypeList($con);
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
    $c->add(AccountProductTransactionTypePeer::TRANSACTION_TYPE_ID, $this->object->getPrimaryKey());
    AccountProductTransactionTypePeer::doDelete($c, $con);

    $values = $this->getValue('account_product_transaction_type_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new AccountProductTransactionType();
        $obj->setTransactionTypeId($this->object->getPrimaryKey());
        $obj->setProductId($value);
        $obj->save();
      }
    }
  }

}
