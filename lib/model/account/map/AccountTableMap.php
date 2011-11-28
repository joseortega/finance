<?php


/**
 * This class defines the structure of the 'account' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Fri Oct 21 16:12:18 2011
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.account.map
 */
class AccountTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.account.map.AccountTableMap';

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
		$this->setName('account');
		$this->setPhpName('Account');
		$this->setClassname('Account');
		$this->setPackage('lib.model.account');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'BIGINT', true, null, null);
		$this->addForeignKey('ASSOCIATE_ID', 'AssociateId', 'BIGINT', 'associate', 'ID', true, null, null);
		$this->addForeignKey('PRODUCT_ID', 'ProductId', 'BIGINT', 'account_product', 'ID', true, null, null);
		$this->addColumn('NUMBER', 'Number', 'BIGINT', true, null, null);
		$this->addColumn('BALANCE', 'Balance', 'DECIMAL', true, 18, 0);
		$this->addColumn('BLOCKED_BALANCE', 'BlockedBalance', 'DECIMAL', true, 18, 0);
		$this->addColumn('AVAILABLE_BALANCE', 'AvailableBalance', 'DECIMAL', true, 18, 0);
		$this->addColumn('LAST_CAPITALIZATION', 'LastCapitalization', 'DATE', false, null, null);
		$this->addColumn('NEXT_CAPITALIZATION', 'NextCapitalization', 'DATE', false, null, null);
		$this->addColumn('IS_ACTIVE', 'IsActive', 'BOOLEAN', true, null, true);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Associate', 'Associate', RelationMap::MANY_TO_ONE, array('associate_id' => 'id', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('Product', 'AccountProduct', RelationMap::MANY_TO_ONE, array('product_id' => 'id', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('BalanceBlockedDetail', 'BalanceBlockedDetail', RelationMap::ONE_TO_MANY, array('id' => 'account_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Bankbook', 'Bankbook', RelationMap::ONE_TO_MANY, array('id' => 'account_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('AccountTransaction', 'AccountTransaction', RelationMap::ONE_TO_MANY, array('id' => 'account_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Credit', 'Credit', RelationMap::ONE_TO_MANY, array('id' => 'account_id', ), 'RESTRICT', 'RESTRICT');
    $this->addRelation('Investment', 'Investment', RelationMap::ONE_TO_MANY, array('id' => 'account_id', ), 'RESTRICT', 'RESTRICT');
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

} // AccountTableMap
