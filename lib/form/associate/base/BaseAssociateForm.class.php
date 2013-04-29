<?php

/**
 * Associate form base class.
 *
 * @method Associate getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseAssociateForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                      => new sfWidgetFormInputHidden(),
      'category_id'             => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => false)),
      'city_hometown_id'        => new sfWidgetFormPropelChoice(array('model' => 'City', 'add_empty' => true)),
      'city_current_id'         => new sfWidgetFormPropelChoice(array('model' => 'City', 'add_empty' => true)),
      'number'                  => new sfWidgetFormInputText(),
      'identification'          => new sfWidgetFormInputText(),
      'name'                    => new sfWidgetFormInputText(),
      'type'                    => new sfWidgetFormInputText(),
      'is_active'               => new sfWidgetFormInputCheckbox(),
      'picture'                 => new sfWidgetFormInputText(),
      'address'                 => new sfWidgetFormTextarea(),
      'neighborhood'            => new sfWidgetFormInputText(),
      'website'                 => new sfWidgetFormInputText(),
      'about'                   => new sfWidgetFormTextarea(),
      'gender'                  => new sfWidgetFormInputText(),
      'relationship_status'     => new sfWidgetFormInputText(),
      'birthday'                => new sfWidgetFormDate(),
      'monthly_income'          => new sfWidgetFormInputText(),
      'monthly_expenditure'     => new sfWidgetFormInputText(),
      'created_at'              => new sfWidgetFormDateTime(),
      'updated_at'              => new sfWidgetFormDateTime(),
      'guarantee_personal_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Credit')),
    ));

    $this->setValidators(array(
      'id'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'category_id'             => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id')),
      'city_hometown_id'        => new sfValidatorPropelChoice(array('model' => 'City', 'column' => 'id', 'required' => false)),
      'city_current_id'         => new sfValidatorPropelChoice(array('model' => 'City', 'column' => 'id', 'required' => false)),
      'number'                  => new sfValidatorInteger(array('min' => -9.2233720368548E+18, 'max' => 9.2233720368548E+18)),
      'identification'          => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'name'                    => new sfValidatorString(array('max_length' => 100)),
      'type'                    => new sfValidatorString(array('max_length' => 30)),
      'is_active'               => new sfValidatorBoolean(),
      'picture'                 => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'address'                 => new sfValidatorString(array('required' => false)),
      'neighborhood'            => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'website'                 => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'about'                   => new sfValidatorString(array('required' => false)),
      'gender'                  => new sfValidatorString(array('max_length' => 15, 'required' => false)),
      'relationship_status'     => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'birthday'                => new sfValidatorDate(array('required' => false)),
      'monthly_income'          => new sfValidatorNumber(array('required' => false)),
      'monthly_expenditure'     => new sfValidatorNumber(array('required' => false)),
      'created_at'              => new sfValidatorDateTime(),
      'updated_at'              => new sfValidatorDateTime(),
      'guarantee_personal_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Credit', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Associate', 'column' => array('number')))
    );

    $this->widgetSchema->setNameFormat('associate[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Associate';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['guarantee_personal_list']))
    {
      $values = array();
      foreach ($this->object->getGuaranteePersonals() as $obj)
      {
        $values[] = $obj->getCreditId();
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
    $c->add(GuaranteePersonalPeer::ASSOCIATE_ID, $this->object->getPrimaryKey());
    GuaranteePersonalPeer::doDelete($c, $con);

    $values = $this->getValue('guarantee_personal_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new GuaranteePersonal();
        $obj->setAssociateId($this->object->getPrimaryKey());
        $obj->setCreditId($value);
        $obj->save();
      }
    }
  }

}
