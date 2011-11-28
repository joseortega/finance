<?php

/**
 * AccountTransaction form base class.
 *
 * @method AccountTransaction getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseAccountTransactionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'account_id'      => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => false)),
      'bankbook_id'     => new sfWidgetFormPropelChoice(array('model' => 'Bankbook', 'add_empty' => true)),
      'account_balance' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorPropelChoice(array('model' => 'Transaction', 'column' => 'id', 'required' => false)),
      'account_id'      => new sfValidatorPropelChoice(array('model' => 'Account', 'column' => 'id')),
      'bankbook_id'     => new sfValidatorPropelChoice(array('model' => 'Bankbook', 'column' => 'id', 'required' => false)),
      'account_balance' => new sfValidatorNumber(),
    ));

    $this->widgetSchema->setNameFormat('account_transaction[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountTransaction';
  }


}
