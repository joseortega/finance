<?php

/**
 * Credit form base class.
 *
 * @method Credit getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseCreditForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'product_id'              => new sfWidgetFormPropelChoice(array('model' => 'CreditProduct', 'add_empty' => false)),
      'associate_id'            => new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => false)),
      'account_id'              => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => false)),
      'amount'                  => new sfWidgetFormInputText(),
      'balance'                 => new sfWidgetFormInputText(),
      'time_in_months'          => new sfWidgetFormInputText(),
      'pay_frequency_in_months' => new sfWidgetFormInputText(),
      'amortization_type'       => new sfWidgetFormInputText(),
      'purpose'                 => new sfWidgetFormInputText(),
      'interest_rate'           => new sfWidgetFormInputText(),
      'status'                  => new sfWidgetFormInputText(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
      'guarantee_personal_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Associate')),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'product_id'              => new sfValidatorPropelChoice(array('model' => 'CreditProduct', 'column' => 'id')),
      'associate_id'            => new sfValidatorPropelChoice(array('model' => 'Associate', 'column' => 'id')),
      'account_id'              => new sfValidatorPropelChoice(array('model' => 'Account', 'column' => 'id')),
      'amount'                  => new sfValidatorNumber(),
      'balance'                 => new sfValidatorNumber(),
      'time_in_months'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'pay_frequency_in_months' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'amortization_type'       => new sfValidatorString(array('max_length' => 60)),
      'purpose'                 => new sfValidatorString(array('max_length' => 100)),
      'interest_rate'           => new sfValidatorNumber(),
      'status'                  => new sfValidatorString(array('max_length' => 30)),
      'created_at'              => new sfValidatorDateTime(array('required' => false)),
      'updated_at'              => new sfValidatorDateTime(array('required' => false)),
      'guarantee_personal_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Associate', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('credit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Credit';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['guarantee_personal_list']))
    {
      $values = array();
      foreach ($this->object->getGuaranteePersonals() as $obj)
      {
        $values[] = $obj->getAssociateId();
      }

      $this->setDefault('guarantee_personal_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveGuaranteePersonalList($con);
  }

  public function saveGuaranteePersonalList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['guarantee_personal_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(GuaranteePersonalPeer::CREDIT_ID, $this->object->getPrimaryKey());
    GuaranteePersonalPeer::doDelete($c, $con);

    $values = $this->getValue('guarantee_personal_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new GuaranteePersonal();
        $obj->setCreditId($this->object->getPrimaryKey());
        $obj->setAssociateId($value);
        $obj->save();
      }
    }
  }

}
