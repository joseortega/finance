<?php

/**
 * associate_contact actions.
 *
 * @package    fynance
 * @subpackage associate_contact
 * @author     Your name here
 */
class credit_product_manageActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->product = $this->getRoute()->getObject();
  }
}