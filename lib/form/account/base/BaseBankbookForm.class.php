<?php

/**
 * Bankbook form base class.
 *
 * @method Bankbook getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseBankbookForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'account_id'         => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => false)),
      'is_active'          => new sfWidgetFormInputCheckbox(),
      'was_printed_header' => new sfWidgetFormInputCheckbox(),
      'print_row'          => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'account_id'         => new sfValidatorPropelChoice(array('model' => 'Account', 'column' => 'id')),
      'is_active'          => new sfValidatorBoolean(),
      'was_printed_header' => new sfValidatorBoolean(),
      'print_row'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'created_at'         => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('bankbook[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bankbook';
  }


}
