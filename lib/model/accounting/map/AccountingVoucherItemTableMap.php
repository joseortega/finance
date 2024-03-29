<?php


/**
 * This class defines the structure of the 'accounting_voucher_item' table.
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
 * @package    lib.model.accounting.map
 */
class AccountingVoucherItemTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'lib.model.accounting.map.AccountingVoucherItemTableMap';

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
		$this->setName('accounting_voucher_item');
		$this->setPhpName('AccountingVoucherItem');
		$this->setClassname('AccountingVoucherItem');
		$this->setPackage('lib.model.accounting');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'BIGINT', true, null, null);
		$this->addForeignKey('ACCOUNTING_VOUCHER_ID', 'AccountingVoucherId', 'BIGINT', 'accounting_voucher', 'ID', true, null, null);
		$this->addForeignKey('ACCOUNTING_ACCOUNT_ID', 'AccountingAccountId', 'BIGINT', 'accounting_account', 'ID', true, null, null);
		$this->addColumn('DEBIT', 'Debit', 'DECIMAL', true, 18, null);
		$this->addColumn('CREDIT', 'Credit', 'DECIMAL', true, 18, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', true, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', true, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('AccountingVoucher', 'AccountingVoucher', RelationMap::MANY_TO_ONE, array('accounting_voucher_id' => 'id', ), 'CASCADE', 'RESTRICT');
    $this->addRelation('AccountingAccount', 'AccountingAccount', RelationMap::MANY_TO_ONE, array('accounting_account_id' => 'id', ), 'RESTRICT', 'RESTRICT');
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

} // AccountingVoucherItemTableMap
