<?php

/**
 * AccountingExercise form.
 *
 * @package    finance
 * @subpackage form
 * @author     Jose Ortega
 */
class AccountingExerciseForm extends BaseAccountingExerciseForm
{
  public function configure()
  {
      $this->useFields(array('code', 'name', 'start_date', 'end_date'));
  }
}
