<?php


/**
 * This class defines the structure of the 'account_product_interest_rate' table.
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
 * @package    lib.model.account.map
 */
class AccountProductInterestRateTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.account.map.AccountProductInterestRateTableMap';

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
		$this->setName('account_product_interest_rate');
		$this->setPhpName('AccountProductInterestRate');
		$this->setClassname('AccountProductInterestRate');
		$this->setPackage('lib.model.account');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('PRODUCT_ID', 'ProductId', 'BIGINT' , 'account_product', 'ID', true, null, null);
		$this->addForeignPrimaryKey('RATE_UNIQUE_ID', 'RateUniqueId', 'BIGINT' , 'rate_unique', 'ID', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Product', 'AccountProduct', RelationMap::MANY_TO_ONE, array('product_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('RateUnique', 'RateUnique', RelationMap::MANY_TO_ONE, array('rate_unique_id' => 'id', ), 'CASCADE', 'RESTRICT');
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

} // AccountProductInterestRateTableMap
