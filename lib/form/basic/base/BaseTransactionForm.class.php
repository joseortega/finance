<?php

/**
 * Transaction form base class.
 *
 * @method Transaction getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseTransactionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'cash_id'             => new sfWidgetFormPropelChoice(array('model' => 'Cash', 'add_empty' => true)),
      'user_id'             => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'transaction_type_id' => new sfWidgetFormPropelChoice(array('model' => 'TransactionType', 'add_empty' => false)),
      'type'                => new sfWidgetFormInputText(),
      'amount'              => new sfWidgetFormInputText(),
      'observation'         => new sfWidgetFormTextarea(),
      'created_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'cash_id'             => new sfValidatorPropelChoice(array('model' => 'Cash', 'column' => 'id', 'required' => false)),
      'user_id'             => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'transaction_type_id' => new sfValidatorPropelChoice(array('model' => 'TransactionType', 'column' => 'id')),
      'type'                => new sfValidatorString(array('max_length' => 30)),
      'amount'              => new sfValidatorNumber(),
      'observation'         => new sfValidatorString(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('transaction[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transaction';
  }


}
