<?php

/**
 * AccountTransaction filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseAccountTransactionFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id'      => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => true)),
      'bankbook_id'     => new sfWidgetFormPropelChoice(array('model' => 'Bankbook', 'add_empty' => true)),
      'account_balance' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'account_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Account', 'column' => 'id')),
      'bankbook_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Bankbook', 'column' => 'id')),
      'account_balance' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('account_transaction_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountTransaction';
  }

  public function getFields()
  {
    return array(
      'id'              => 'ForeignKey',
      'account_id'      => 'ForeignKey',
      'bankbook_id'     => 'ForeignKey',
      'account_balance' => 'Number',
    );
  }
}
