<?php

/**
 * Transfer form base class.
 *
 * @method Transfer getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseTransferForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'account_origin_id'      => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => false)),
      'account_destination_id' => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => false)),
      'user_id'                => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'amount'                 => new sfWidgetFormInputText(),
      'observation'            => new sfWidgetFormTextarea(),
      'created_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'account_origin_id'      => new sfValidatorPropelChoice(array('model' => 'Account', 'column' => 'id')),
      'account_destination_id' => new sfValidatorPropelChoice(array('model' => 'Account', 'column' => 'id')),
      'user_id'                => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'amount'                 => new sfValidatorNumber(),
      'observation'            => new sfValidatorString(),
      'created_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('transfer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transfer';
  }


}
