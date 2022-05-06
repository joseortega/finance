<?php

/**
 * Credit filter form.
 *
 * @package    fynance
 * @subpackage filter
 * @author     Your name here
 */
class CreditFormFilter extends BaseCreditFormFilter
{
  public function configure()
  {
    $this->widgetSchema['id'] = new sfWidgetFormFilterInput(array('with_empty' => false));
    
    $this->validatorSchema['id'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));
    
    $this->widgetSchema['associate_id']->setOption('renderer_class', 'sfWidgetFormPropelJQueryAutocompleter');
    $this->widgetSchema['associate_id']->setOption('renderer_options', array(
      'model' => 'Associate',
      'url'   => $this->getOption('url'),
    ));
    
    $this->widgetSchema['status']  = new sfWidgetFormInputHidden();
    
    $this->validatorSchema['status'] = new sfValidatorChoice(array(
        'choices' => array_keys(CreditPeer::$status),
        'required' => false,
    ));
    
    $this->useFields(array('product_id', 'id', 'associate_id', 'created_at', 'status'));
  }
  
  protected function addStatusColumnCriteria(Criteria $criteria, $field, $value)
  {
    $colname = CreditPeer::STATUS;

    if (is_array($value))
    {
      $values = $value;
      $value = array_pop($values);
      
      $criterion = $criteria->getNewCriterion($colname, $value);

      foreach ($values as $value)
      {
        $criterion->addOr($criteria->getNewCriterion($colname, $value));
      }

      $criteria->add($criterion);
    }
    else
    {
      $criteria->add($colname, $value);
    }
  }
}
