<?php

/**
 * Associate filter form base class.
 *
 * @package    finance
 * @subpackage filter
 * @author     Jose Ortega
 */
abstract class BaseAssociateFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'category_id'             => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
      'city_hometown_id'        => new sfWidgetFormPropelChoice(array('model' => 'City', 'add_empty' => true)),
      'city_current_id'         => new sfWidgetFormPropelChoice(array('model' => 'City', 'add_empty' => true)),
      'number'                  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'identification'          => new sfWidgetFormFilterInput(),
      'name'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'is_active'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'picture'                 => new sfWidgetFormFilterInput(),
      'address'                 => new sfWidgetFormFilterInput(),
      'neighborhood'            => new sfWidgetFormFilterInput(),
      'website'                 => new sfWidgetFormFilterInput(),
      'about'                   => new sfWidgetFormFilterInput(),
      'gender'                  => new sfWidgetFormFilterInput(),
      'relationship_status'     => new sfWidgetFormFilterInput(),
      'birthday'                => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'monthly_income'          => new sfWidgetFormFilterInput(),
      'monthly_expenditure'     => new sfWidgetFormFilterInput(),
      'created_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'              => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'guarantee_personal_list' => new sfWidgetFormPropelChoice(array('model' => 'Credit', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'category_id'             => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Category', 'column' => 'id')),
      'city_hometown_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'City', 'column' => 'id')),
      'city_current_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'City', 'column' => 'id')),
      'number'                  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'identification'          => new sfValidatorPass(array('required' => false)),
      'name'                    => new sfValidatorPass(array('required' => false)),
      'type'                    => new sfValidatorPass(array('required' => false)),
      'is_active'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'picture'                 => new sfValidatorPass(array('required' => false)),
      'address'                 => new sfValidatorPass(array('required' => false)),
      'neighborhood'            => new sfValidatorPass(array('required' => false)),
      'website'                 => new sfValidatorPass(array('required' => false)),
      'about'                   => new sfValidatorPass(array('required' => false)),
      'gender'                  => new sfValidatorPass(array('required' => false)),
      'relationship_status'     => new sfValidatorPass(array('required' => false)),
      'birthday'                => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'monthly_income'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'monthly_expenditure'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'created_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'              => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'guarantee_personal_list' => new sfValidatorPropelChoice(array('model' => 'Credit', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('associate_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addGuaranteePersonalListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(GuaranteePersonalPeer::ASSOCIATE_ID, AssociatePeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(GuaranteePersonalPeer::CREDIT_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(GuaranteePersonalPeer::CREDIT_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Associate';
  }

  public function getFields()
  {
    return array(
      'id'                      => 'Number',
      'category_id'             => 'ForeignKey',
      'city_hometown_id'        => 'ForeignKey',
      'city_current_id'         => 'ForeignKey',
      'number'                  => 'Number',
      'identification'          => 'Text',
      'name'                    => 'Text',
      'type'                    => 'Text',
      'is_active'               => 'Boolean',
      'picture'                 => 'Text',
      'address'                 => 'Text',
      'neighborhood'            => 'Text',
      'website'                 => 'Text',
      'about'                   => 'Text',
      'gender'                  => 'Text',
      'relationship_status'     => 'Text',
      'birthday'                => 'Date',
      'monthly_income'          => 'Number',
      'monthly_expenditure'     => 'Number',
      'created_at'              => 'Date',
      'updated_at'              => 'Date',
      'guarantee_personal_list' => 'ManyKey',
    );
  }
}
