<?php


/**
 * This class defines the structure of the 'investment_product_interest_rate' table.
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
 * @package    lib.model.investment.map
 */
class InvestmentProductInterestRateTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.investment.map.InvestmentProductInterestRateTableMap';

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
		$this->setName('investment_product_interest_rate');
		$this->setPhpName('InvestmentProductInterestRate');
		$this->setClassname('InvestmentProductInterestRate');
		$this->setPackage('lib.model.investment');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('PRODUCT_ID', 'ProductId', 'BIGINT' , 'investment_product', 'ID', true, null, null);
		$this->addForeignPrimaryKey('RATE_TERM_ID', 'RateTermId', 'BIGINT' , 'rate_term', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Product', 'InvestmentProduct', RelationMap::MANY_TO_ONE, array('product_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('RateTerm', 'RateTerm', RelationMap::MANY_TO_ONE, array('rate_term_id' => 'id', ), 'CASCADE', 'RESTRICT');
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
		);
	} // getBehaviors()

} // InvestmentProductInterestRateTableMap
