<?php

/**
 * Transfer filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseTransferFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_origin_id'      => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => true)),
      'account_destination_id' => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => true)),
      'user_id'                => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'amount'                 => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'observation'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'account_origin_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Account', 'column' => 'id')),
      'account_destination_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Account', 'column' => 'id')),
      'user_id'                => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'amount'                 => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'observation'            => new sfValidatorPass(array('required' => false)),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('transfer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Transfer';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'account_origin_id'      => 'ForeignKey',
      'account_destination_id' => 'ForeignKey',
      'user_id'                => 'ForeignKey',
      'amount'                 => 'Number',
      'observation'            => 'Text',
      'created_at'             => 'Date',
    );
  }
}
