
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- accounting_exercise
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `accounting_exercise`;


CREATE TABLE `accounting_exercise`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(60)  NOT NULL,
	`name` VARCHAR(60)  NOT NULL,
	`start_date` DATE  NOT NULL,
	`end_date` DATE  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `accounting_exercise_U_1` (`code`)
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- accounting_account
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `accounting_account`;


CREATE TABLE `accounting_account`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`accounting_account_id` BIGINT,
	`accounting_exercise_id` INTEGER  NOT NULL,
	`code` VARCHAR(60)  NOT NULL,
	`name` VARCHAR(254)  NOT NULL,
	`type` VARCHAR(30)  NOT NULL,
	`nature` VARCHAR(30)  NOT NULL,
	`debit` DECIMAL(18,2) default 0.00 NOT NULL,
	`credit` DECIMAL(18,2) default 0.00 NOT NULL,
	`balance` DECIMAL(18,2) default 0.00 NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `accounting_account_U_1` (`accounting_exercise_id`, `code`),
	INDEX `accounting_account_FI_1` (`accounting_account_id`),
	CONSTRAINT `accounting_account_FK_1`
		FOREIGN KEY (`accounting_account_id`)
		REFERENCES `accounting_account` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	CONSTRAINT `accounting_account_FK_2`
		FOREIGN KEY (`accounting_exercise_id`)
		REFERENCES `accounting_exercise` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- accounting_voucher
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `accounting_voucher`;


CREATE TABLE `accounting_voucher`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`code` INTEGER  NOT NULL,
	`reference` VARCHAR(60)  NOT NULL,
	`date` DATE  NOT NULL,
	`observation` TEXT,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `accounting_voucher_U_1` (`code`)
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- accounting_voucher_item
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `accounting_voucher_item`;


CREATE TABLE `accounting_voucher_item`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`accounting_voucher_id` BIGINT  NOT NULL,
	`accounting_account_id` BIGINT  NOT NULL,
	`debit` DECIMAL(18,2)  NOT NULL,
	`credit` DECIMAL(18,2)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `accounting_voucher_item_FI_1` (`accounting_voucher_id`),
	CONSTRAINT `accounting_voucher_item_FK_1`
		FOREIGN KEY (`accounting_voucher_id`)
		REFERENCES `accounting_voucher` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `accounting_voucher_item_FI_2` (`accounting_account_id`),
	CONSTRAINT `accounting_voucher_item_FK_2`
		FOREIGN KEY (`accounting_account_id`)
		REFERENCES `accounting_account` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
