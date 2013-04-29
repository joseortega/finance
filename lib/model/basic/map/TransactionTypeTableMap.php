<?php


/**
 * This class defines the structure of the 'transaction_type' table.
 *
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Tue Jan  8 23:27:26 2013
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    lib.model.basic.map
 */
class TransactionTypeTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.basic.map.TransactionTypeTableMap';

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
		$this->setName('transaction_type');
		$this->setPhpName('TransactionType');
		$this->setClassname('TransactionType');
		$this->setPackage('lib.model.basic');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'BIGINT', true, null, null);
		$this->addColumn('TYPE', 'Type', 'VARCHAR', true, 30, null);
		$this->addColumn('NATURE', 'Nature', 'VARCHAR', true, 30, null);
		$this->addColumn('CASH_BALANCE_IS_AFFECT', 'CashBalanceIsAffect', 'BOOLEAN', true, null, false);
		$this->addColumn('CONCEPT', 'Concept', 'VARCHAR', true, 30, null);
		$this->addColumn('INITIALS', 'Initials', 'VARCHAR', true, 15, null);
		$this->addColumn('OPERATION_TYPE', 'OperationType', 'VARCHAR', true, 50, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', true, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('AccountProductTransactionType', 'AccountProductTransactionType', RelationMap::ONE_TO_MANY, array('id' => 'transaction_type_id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('Transaction', 'Transaction', RelationMap::ONE_TO_MANY, array('id' => 'transaction_type_id', ), 'RESTRICT', 'RESTRICT');
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

} // TransactionTypeTableMap
