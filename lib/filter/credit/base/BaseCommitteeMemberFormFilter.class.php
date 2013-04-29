<?php

/**
 * CommitteeMember filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseCommitteeMemberFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'credit_id' => new sfWidgetFormPropelChoice(array('model' => 'Credit', 'add_empty' => true)),
      'name'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'credit_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Credit', 'column' => 'id')),
      'name'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('committee_member_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CommitteeMember';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'credit_id' => 'ForeignKey',
      'name'      => 'Text',
    );
  }
}
