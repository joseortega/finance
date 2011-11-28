<?php

/**
 * GuaranteePersonal form base class.
 *
 * @method GuaranteePersonal getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseGuaranteePersonalForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'credit_id'    => new sfWidgetFormInputHidden(),
      'associate_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'credit_id'    => new sfValidatorPropelChoice(array('model' => 'Credit', 'column' => 'id', 'required' => false)),
      'associate_id' => new sfValidatorPropelChoice(array('model' => 'Associate', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('guarantee_personal[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GuaranteePersonal';
  }


}
