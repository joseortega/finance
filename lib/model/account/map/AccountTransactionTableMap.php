<?php


/**
 * This class defines the structure of the 'account_transaction' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Thu Jan 26 16:56:10 2012
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.account.map
 */
class AccountTransactionTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.account.map.AccountTransactionTableMap';

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
		$this->setName('account_transaction');
		$this->setPhpName('AccountTransaction');
		$this->setClassname('AccountTransaction');
		$this->setPackage('lib.model.account');
		$this->setUseIdGenerator(false);
		// columns
		$this->addForeignPrimaryKey('ID', 'Id', 'BIGINT' , 'transaction', 'ID', true, null, null);
		$this->addForeignKey('ACCOUNT_ID', 'AccountId', 'BIGINT', 'account', 'ID', true, null, null);
		$this->addForeignKey('BANKBOOK_ID', 'BankbookId', 'BIGINT', 'bankbook', 'ID', false, null, null);
		$this->addColumn('ACCOUNT_BALANCE', 'AccountBalance', 'DECIMAL', true, 18, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Transaction', 'Transaction', RelationMap::MANY_TO_ONE, array('id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Account', 'Account', RelationMap::MANY_TO_ONE, array('account_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Bankbook', 'Bankbook', RelationMap::MANY_TO_ONE, array('bankbook_id' => 'id', ), 'RESTRICT', 'RESTRICT');
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

} // AccountTransactionTableMap
