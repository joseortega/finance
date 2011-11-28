<?php

/**
 * GuaranteeReal form base class.
 *
 * @method GuaranteeReal getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseGuaranteeRealForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'credit_id'   => new sfWidgetFormPropelChoice(array('model' => 'Credit', 'add_empty' => false)),
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'credit_id'   => new sfValidatorPropelChoice(array('model' => 'Credit', 'column' => 'id')),
      'name'        => new sfValidatorString(array('max_length' => 30)),
      'description' => new sfValidatorString(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('guarantee_real[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GuaranteeReal';
  }


}
