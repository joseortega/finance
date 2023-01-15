<?php


/**
 * This class defines the structure of the 'rate_unique' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Sun Jan  8 00:50:48 2023
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.basic.map
 */
class RateUniqueTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.basic.map.RateUniqueTableMap';

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
		$this->setName('rate_unique');
		$this->setPhpName('RateUnique');
		$this->setClassname('RateUnique');
		$this->setPackage('lib.model.basic');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'BIGINT', true, null, null);
		$this->addColumn('VALUE', 'Value', 'DECIMAL', true, 8, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('AccountProductInterestRate', 'AccountProductInterestRate', RelationMap::ONE_TO_MANY, array('id' => 'rate_unique_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('CreditProductInterestRate', 'CreditProductInterestRate', RelationMap::ONE_TO_MANY, array('id' => 'rate_unique_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('CreditProductArrearRate', 'CreditProductArrearRate', RelationMap::ONE_TO_MANY, array('id' => 'rate_unique_id', ), 'CASCADE', 'RESTRICT');
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
			'symfony_timestampable' => array('create_column' => 'created_at', ),
		);
	} // getBehaviors()

} // RateUniqueTableMap
