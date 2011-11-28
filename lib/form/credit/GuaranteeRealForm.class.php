<?php

/**
 * CreditGuaranteeReal form.
 *
 * @package    fynance
 * @subpackage form
 * @author     Your name here
 */
class GuaranteeRealForm extends BaseGuaranteeRealForm
{
  public function configure()
  {
    unset ($this['credit_id']);
  }
}
