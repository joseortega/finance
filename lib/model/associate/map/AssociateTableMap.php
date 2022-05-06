<?php


/**
 * This class defines the structure of the 'associate' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Jan  8 23:27:25 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.associate.map
 */
class AssociateTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.associate.map.AssociateTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('associate');
		$this->setPhpName('Associate');
		$this->setClassname('Associate');
		$this->setPackage('lib.model.associate');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'BIGINT', true, null, null);
		$this->addForeignKey('CATEGORY_ID', 'CategoryId', 'BIGINT', 'category', 'ID', true, null, null);
		$this->addForeignKey('CITY_HOMETOWN_ID', 'CityHometownId', 'BIGINT', 'city', 'ID', false, null, null);
		$this->addForeignKey('CITY_CURRENT_ID', 'CityCurrentId', 'BIGINT', 'city', 'ID', false, null, null);
		$this->addColumn('NUMBER', 'Number', 'BIGINT', true, null, null);
		$this->addColumn('IDENTIFICATION', 'Identification', 'VARCHAR', false, 15, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 100, null);
		$this->addColumn('TYPE', 'Type', 'VARCHAR', true, 30, null);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', true, null, true);
		$this->addColumn('PICTURE', 'Picture', 'VARCHAR', false, 255, null);
		$this->addColumn('ADDRESS', 'Address', 'LONGVARCHAR', false, null, null);
		$this->addColumn('NEIGHBORHOOD', 'Neighborhood', 'VARCHAR', false, 150, null);
		$this->addColumn('WEBSITE', 'Website', 'VARCHAR', false, 150, null);
		$this->addColumn('ABOUT', 'About', 'LONGVARCHAR', false, null, null);
		$this->addColumn('GENDER', 'Gender', 'VARCHAR', false, 15, null);
		$this->addColumn('RELATIONSHIP_STATUS', 'RelationshipStatus', 'VARCHAR', false, 30, null);
		$this->addColumn('BIRTHDAY', 'Birthday', 'DATE', false, null, null);
		$this->addColumn('MONTHLY_INCOME', 'MonthlyIncome', 'DECIMAL', false, 18, 0);
		$this->addColumn('MONTHLY_EXPENDITURE', 'MonthlyExpenditure', 'DECIMAL', false, 18, 0);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', true, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Category', 'Category', RelationMap::MANY_TO_ONE, array('category_id' => 'id', ), 'RESTRICT', null);
    $this->addRelation('CityHomeTown', 'City', RelationMap::MANY_TO_ONE, array('city_hometown_id' => 'id', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('CityCurrent', 'City', RelationMap::MANY_TO_ONE, array('city_current_id' => 'id', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('Relationship', 'Relationship', RelationMap::ONE_TO_MANY, array('id' => 'associate_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Email', 'Email', RelationMap::ONE_TO_MANY, array('id' => 'associate_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Phone', 'Phone', RelationMap::ONE_TO_MANY, array('id' => 'associate_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Account', 'Account', RelationMap::ONE_TO_MANY, array('id' => 'associate_id', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('Credit', 'Credit', RelationMap::ONE_TO_MANY, array('id' => 'associate_id', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('GuaranteePersonal', 'GuaranteePersonal', RelationMap::ONE_TO_MANY, array('id' => 'associate_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Investment', 'Investment', RelationMap::ONE_TO_MANY, array('id' => 'associate_id', ), 'RESTRICT', 'RESTRICT');
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
			'symfony_timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
		);
	} // getBehaviors()

} // AssociateTableMap
