<?php


/**
 * This class defines the structure of the 'investment_product' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Fri Oct 21 16:12:24 2011
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.investment.map
 */
class InvestmentProductTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.investment.map.InvestmentProductTableMap';

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
		$this->setName('investment_product');
		$this->setPhpName('InvestmentProduct');
		$this->setClassname('InvestmentProduct');
		$this->setPackage('lib.model.investment');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'BIGINT', true, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 60, null);
		$this->addColumn('TAX_RATE', 'TaxRate', 'DECIMAL', true, 8, 0);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('InvestmentProductInterestRate', 'InvestmentProductInterestRate', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Investment', 'Investment', RelationMap::ONE_TO_MANY, array('id' => 'product_id', ), 'RESTRICT', 'RESTRICT');
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
			'timestampable' => array('add_columns' => 'true', 'create_column' => 'created_at', 'update_column' => 'updated_at', ),
			'symfony' => array('form' => 'true', 'filter' => 'true', ),
			'symfony_behaviors' => array(),
		);
	} // getBehaviors()

} // InvestmentProductTableMap
