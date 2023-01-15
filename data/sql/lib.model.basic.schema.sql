
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- configuration
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `configuration`;


CREATE TABLE `configuration`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(30)  NOT NULL,
	`value` VARCHAR(60)  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `configuration_U_1` (`name`)
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- agency
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `agency`;


CREATE TABLE `agency`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(60)  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `agency_U_1` (`name`)
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- cash
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cash`;


CREATE TABLE `cash`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`agency_id` BIGINT  NOT NULL,
	`name` VARCHAR(60)  NOT NULL,
	`ip_address` VARCHAR(50),
	`balance` DECIMAL(18,2) default 0.00 NOT NULL,
	`status` VARCHAR(50) default '' NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `cash_U_1` (`name`),
	INDEX `cash_FI_1` (`agency_id`),
	CONSTRAINT `cash_FK_1`
		FOREIGN KEY (`agency_id`)
		REFERENCES `agency` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- transaction_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `transaction_type`;


CREATE TABLE `transaction_type`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`type` VARCHAR(30)  NOT NULL,
	`nature` VARCHAR(30)  NOT NULL,
	`cash_balance_is_affect` TINYINT default 0 NOT NULL,
	`concept` VARCHAR(30)  NOT NULL,
	`initials` VARCHAR(15)  NOT NULL,
	`operation_type` VARCHAR(50)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `transaction_type_U_1` (`concept`),
	UNIQUE KEY `transaction_type_U_2` (`initials`)
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- transaction
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `transaction`;


CREATE TABLE `transaction`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`cash_id` BIGINT,
	`user_id` INTEGER  NOT NULL,
	`transaction_type_id` BIGINT  NOT NULL,
	`amount` DECIMAL(18,2)  NOT NULL,
	`observation` TEXT,
	`created_at` DATETIME  NOT NULL,
	`credit_id` BIGINT,
	`account_id` BIGINT,
	`bankbook_id` BIGINT,
	`account_balance` DECIMAL(18,2),
	`investment_id` BIGINT,
	PRIMARY KEY (`id`),
	INDEX `transaction_FI_1` (`cash_id`),
	CONSTRAINT `transaction_FK_1`
		FOREIGN KEY (`cash_id`)
		REFERENCES `cash` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	INDEX `transaction_FI_2` (`user_id`),
	CONSTRAINT `transaction_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `sf_guard_user` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	INDEX `transaction_FI_3` (`transaction_type_id`),
	CONSTRAINT `transaction_FK_3`
		FOREIGN KEY (`transaction_type_id`)
		REFERENCES `transaction_type` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	INDEX `transaction_FI_4` (`credit_id`),
	CONSTRAINT `transaction_FK_4`
		FOREIGN KEY (`credit_id`)
		REFERENCES `credit` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `transaction_FI_5` (`account_id`),
	CONSTRAINT `transaction_FK_5`
		FOREIGN KEY (`account_id`)
		REFERENCES `account` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `transaction_FI_6` (`bankbook_id`),
	CONSTRAINT `transaction_FK_6`
		FOREIGN KEY (`bankbook_id`)
		REFERENCES `bankbook` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	INDEX `transaction_FI_7` (`investment_id`),
	CONSTRAINT `transaction_FK_7`
		FOREIGN KEY (`investment_id`)
		REFERENCES `investment` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- rate_unique
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rate_unique`;


CREATE TABLE `rate_unique`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`value` DECIMAL(8,2)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`)
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- rate_term
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `rate_term`;


CREATE TABLE `rate_term`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`minimum_time` INTEGER  NOT NULL,
	`maximum_time` INTEGER  NOT NULL,
	`value` DECIMAL(8,2)  NOT NULL,
	`created_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`)
)ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
