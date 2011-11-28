<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AssociateSearchFormFilter
 *
 * @author jose
 */
class AssociateSearchFormFilter extends sfFormFilter
{
  public function configure() 
  {
    parent::configure();
    
    $this->widgetSchema['associate_id'] = new sfWidgetFormPropelChoice(array('model' => 'Associate', 'add_empty' => true));
    
    $this->widgetSchema['associate_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['associate_id']->setOption('renderer_options', array(
      'model' => 'Associate',
      'url'   => $this->getOption('url'),
    ));
  }
}

?>
