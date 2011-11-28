<?php

/**
 * Associate filter form.
 *
 * @package    fynance
 * @subpackage filter
 * @author     Your name here
 */
class AssociateFormFilter extends BaseAssociateFormFilter
{
  public function configure()
  {
    $this->useFields(array('category_id', 'number', 'name', 'identification', 'created_at' ));    
  }
}
