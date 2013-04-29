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
      'amount'              => new sfWidgetFormInputText(),
      'observation'         => new sfWidgetFormTextarea(),
      'created_at'          => new sfWidgetFormDateTime(),
      'credit_id'           => new sfWidgetFormPropelChoice(array('model' => 'Credit', 'add_empty' => true)),
      'account_id'          => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => true)),
      'bankbook_id'         => new sfWidgetFormPropelChoice(array('model' => 'Bankbook', 'add_empty' => true)),
      'account_balance'     => new sfWidgetFormInputText(),
      'investment_id'       => new sfWidgetFormPropelChoice(array('model' => 'Investment', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'cash_id'             => new sfValidatorPropelChoice(array('model' => 'Cash', 'column' => 'id', 'required' => false)),
      'user_id'             => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'transaction_type_id' => new sfValidatorPropelChoice(array('model' => 'TransactionType', 'column' => 'id')),
      'amount'              => new sfValidatorNumber(),
      'observation'         => new sfValidatorString(array('required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'credit_id'           => new sfValidatorPropelChoice(array('model' => 'Credit', 'column' => 'id', 'required' => false)),
      'account_id'          => new sfValidatorPropelChoice(array('model' => 'Account', 'column' => 'id', 'required' => false)),
      'bankbook_id'         => new sfValidatorPropelChoice(array('model' => 'Bankbook', 'column' => 'id', 'required' => false)),
      'account_balance'     => new sfValidatorNumber(array('required' => false)),
      'investment_id'       => new sfValidatorPropelChoice(array('model' => 'Investment', 'column' => 'id', 'required' => false)),
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
