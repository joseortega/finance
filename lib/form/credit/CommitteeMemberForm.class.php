<?php

/**
 * CommitteeMember form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class CommitteeMemberForm extends BaseCommitteeMemberForm
{
  public function configure()
  {
    $this->useFields(array('name'));
  }
}
