<?php

/**
 * BalanceBlockedDetail form base class.
 *
 * @method BalanceBlockedDetail getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseBalanceBlockedDetailForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'account_id'      => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => false)),
      'reason_block_id' => new sfWidgetFormPropelChoice(array('model' => 'ReasonBlock', 'add_empty' => false)),
      'amount'          => new sfWidgetFormInputText(),
      'blocked_at'      => new sfWidgetFormDateTime(),
      'unblock_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'account_id'      => new sfValidatorPropelChoice(array('model' => 'Account', 'column' => 'id')),
      'reason_block_id' => new sfValidatorPropelChoice(array('model' => 'ReasonBlock', 'column' => 'id')),
      'amount'          => new sfValidatorNumber(),
      'blocked_at'      => new sfValidatorDateTime(),
      'unblock_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('balance_blocked_detail[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BalanceBlockedDetail';
  }


}
