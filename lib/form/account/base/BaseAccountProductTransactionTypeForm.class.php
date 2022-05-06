<?php

/**
 * AccountProductTransactionType form base class.
 *
 * @method AccountProductTransactionType getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseAccountProductTransactionTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'product_id'          => new sfWidgetFormInputHidden(),
      'transaction_type_id' => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'product_id'          => new sfValidatorPropelChoice(array('model' => 'AccountProduct', 'column' => 'id', 'required' => false)),
      'transaction_type_id' => new sfValidatorPropelChoice(array('model' => 'TransactionType', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('account_product_transaction_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountProductTransactionType';
  }


}
