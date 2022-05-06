<?php

/**
 * BalanceBlockedDetail filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseBalanceBlockedDetailFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id'      => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => true)),
      'reason_block_id' => new sfWidgetFormPropelChoice(array('model' => 'ReasonBlock', 'add_empty' => true)),
      'amount'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'blocked_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'unblock_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'account_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Account', 'column' => 'id')),
      'reason_block_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'ReasonBlock', 'column' => 'id')),
      'amount'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'blocked_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'unblock_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('balance_blocked_detail_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BalanceBlockedDetail';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'account_id'      => 'ForeignKey',
      'reason_block_id' => 'ForeignKey',
      'amount'          => 'Number',
      'blocked_at'      => 'Date',
      'unblock_at'      => 'Date',
    );
  }
}
