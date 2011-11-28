<?php

/**
 * AccountProductTransactionType filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseAccountProductTransactionTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
    ));

    $this->setValidators(array(
    ));

    $this->widgetSchema->setNameFormat('account_product_transaction_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountProductTransactionType';
  }

  public function getFields()
  {
    return array(
      'product_id'          => 'ForeignKey',
      'transaction_type_id' => 'ForeignKey',
    );
  }
}
