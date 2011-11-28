<?php

/**
 * Connection form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class CashForm extends BaseCashForm
{
  public function configure()
  {
    $this->useFields(array('agency_id', 'name'));
  }
}
