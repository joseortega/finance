
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- account_product
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `account_product`;


CREATE TABLE `account_product`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(60)  NOT NULL,
	`capitalization_frequency` VARCHAR(30) default 'monthly' NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `account_product_U_1` (`name`)
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- account_product_interest_rate
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `account_product_interest_rate`;


CREATE TABLE `account_product_interest_rate`
(
	`product_id` BIGINT  NOT NULL,
	`rate_unique_id` BIGINT  NOT NULL,
	PRIMARY KEY (`product_id`,`rate_unique_id`),
	CONSTRAINT `account_product_interest_rate_FK_1`
		FOREIGN KEY (`product_id`)
		REFERENCES `account_product` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `account_product_interest_rate_FI_2` (`rate_unique_id`),
	CONSTRAINT `account_product_interest_rate_FK_2`
		FOREIGN KEY (`rate_unique_id`)
		REFERENCES `rate_unique` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- account
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `account`;


CREATE TABLE `account`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`associate_id` BIGINT  NOT NULL,
	`product_id` BIGINT  NOT NULL,
	`number` BIGINT  NOT NULL,
	`balance` DECIMAL(18,2) default 0.00 NOT NULL,
	`blocked_balance` DECIMAL(18,2) default 0.00 NOT NULL,
	`available_balance` DECIMAL(18,2) default 0.00 NOT NULL,
	`last_capitalization` DATE,
	`next_capitalization` DATE,
	`is_active` TINYINT default 1 NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `account_U_1` (`number`),
	INDEX `account_FI_1` (`associate_id`),
	CONSTRAINT `account_FK_1`
		FOREIGN KEY (`associate_id`)
		REFERENCES `associate` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	INDEX `account_FI_2` (`product_id`),
	CONSTRAINT `account_FK_2`
		FOREIGN KEY (`product_id`)
		REFERENCES `account_product` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- balance_blocked_detail
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `balance_blocked_detail`;


CREATE TABLE `balance_blocked_detail`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`account_id` BIGINT  NOT NULL,
	`reason_block_id` BIGINT  NOT NULL,
	`amount` DECIMAL(18,2)  NOT NULL,
	`blocked_at` DATETIME  NOT NULL,
	`unblock_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `balance_blocked_detail_FI_1` (`account_id`),
	CONSTRAINT `balance_blocked_detail_FK_1`
		FOREIGN KEY (`account_id`)
		REFERENCES `account` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `balance_blocked_detail_FI_2` (`reason_block_id`),
	CONSTRAINT `balance_blocked_detail_FK_2`
		FOREIGN KEY (`reason_block_id`)
		REFERENCES `reason_block` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- reason_block
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `reason_block`;


CREATE TABLE `reason_block`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`description` VARCHAR(60)  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `reason_block_U_1` (`description`)
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- bankbook
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `bankbook`;


CREATE TABLE `bankbook`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`account_id` BIGINT  NOT NULL,
	`is_active` TINYINT default 1 NOT NULL,
	`was_printed_header` TINYINT default 0 NOT NULL,
	`print_row` INTEGER  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `bankbook_FI_1` (`account_id`),
	CONSTRAINT `bankbook_FK_1`
		FOREIGN KEY (`account_id`)
		REFERENCES `account` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- account_product_transaction_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `account_product_transaction_type`;


CREATE TABLE `account_product_transaction_type`
(
	`product_id` BIGINT  NOT NULL,
	`transaction_type_id` BIGINT  NOT NULL,
	PRIMARY KEY (`product_id`,`transaction_type_id`),
	CONSTRAINT `account_product_transaction_type_FK_1`
		FOREIGN KEY (`product_id`)
		REFERENCES `account_product` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `account_product_transaction_type_FI_2` (`transaction_type_id`),
	CONSTRAINT `account_product_transaction_type_FK_2`
		FOREIGN KEY (`transaction_type_id`)
		REFERENCES `transaction_type` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
