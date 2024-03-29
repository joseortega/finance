<?php


/**
 * This class defines the structure of the 'balance_blocked_detail' table.
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
 * @package    lib.model.account.map
 */
class BalanceBlockedDetailTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.account.map.BalanceBlockedDetailTableMap';

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
		$this->setName('balance_blocked_detail');
		$this->setPhpName('BalanceBlockedDetail');
		$this->setClassname('BalanceBlockedDetail');
		$this->setPackage('lib.model.account');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'BIGINT', true, null, null);
		$this->addForeignKey('ACCOUNT_ID', 'AccountId', 'BIGINT', 'account', 'ID', true, null, null);
		$this->addForeignKey('REASON_BLOCK_ID', 'ReasonBlockId', 'BIGINT', 'reason_block', 'ID', true, null, null);
		$this->addColumn('AMOUNT', 'Amount', 'DECIMAL', true, 18, null);
		$this->addColumn('BLOCKED_AT', 'BlockedAt', 'TIMESTAMP', true, null, null);
		$this->addColumn('UNBLOCK_AT', 'UnblockAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Account', 'Account', RelationMap::MANY_TO_ONE, array('account_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('ReasonBlock', 'ReasonBlock', RelationMap::MANY_TO_ONE, array('reason_block_id' => 'id', ), 'RESTRICT', 'RESTRICT');
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

} // BalanceBlockedDetailTableMap
