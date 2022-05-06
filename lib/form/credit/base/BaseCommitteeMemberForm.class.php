<?php

/**
 * CommitteeMember form base class.
 *
 * @method CommitteeMember getObject() Returns the current form's model object
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
abstract class BaseCommitteeMemberForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'credit_id' => new sfWidgetFormPropelChoice(array('model' => 'Credit', 'add_empty' => false)),
      'name'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'credit_id' => new sfValidatorPropelChoice(array('model' => 'Credit', 'column' => 'id')),
      'name'      => new sfValidatorString(array('max_length' => 60)),
    ));

    $this->widgetSchema->setNameFormat('committee_member[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CommitteeMember';
  }


}
