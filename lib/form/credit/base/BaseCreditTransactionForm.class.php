<?php

/**
 * CreditTransaction form base class.
 *
 * @method CreditTransaction getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseCreditTransactionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'credit_id' => new sfWidgetFormPropelChoice(array('model' => 'Credit', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'Transaction', 'column' => 'id', 'required' => false)),
      'credit_id' => new sfValidatorPropelChoice(array('model' => 'Credit', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('credit_transaction[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CreditTransaction';
  }


}
