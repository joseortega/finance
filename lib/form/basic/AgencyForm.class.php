<?php

/**
 * Agency form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class AgencyForm extends BaseAgencyForm
{
  public function configure()
  {
    unset ($this['created_at'], $this['updated_at']);
  }
}
