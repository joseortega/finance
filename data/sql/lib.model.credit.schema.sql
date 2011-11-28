
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- credit_product
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `credit_product`;


CREATE TABLE `credit_product`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(60)  NOT NULL,
	`amortization_type` VARCHAR(60) default 'german' NOT NULL,
	`grace_days` INTEGER default 0 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `credit_product_U_1` (`name`)
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- credit_product_interest_rate
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `credit_product_interest_rate`;


CREATE TABLE `credit_product_interest_rate`
(
	`product_id` BIGINT  NOT NULL,
	`rate_unique_id` BIGINT  NOT NULL,
	PRIMARY KEY (`product_id`,`rate_unique_id`),
	CONSTRAINT `credit_product_interest_rate_FK_1`
		FOREIGN KEY (`product_id`)
		REFERENCES `credit_product` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `credit_product_interest_rate_FI_2` (`rate_unique_id`),
	CONSTRAINT `credit_product_interest_rate_FK_2`
		FOREIGN KEY (`rate_unique_id`)
		REFERENCES `rate_unique` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- credit_product_arrear_rate
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `credit_product_arrear_rate`;


CREATE TABLE `credit_product_arrear_rate`
(
	`product_id` BIGINT  NOT NULL,
	`rate_unique_id` BIGINT  NOT NULL,
	PRIMARY KEY (`product_id`,`rate_unique_id`),
	CONSTRAINT `credit_product_arrear_rate_FK_1`
		FOREIGN KEY (`product_id`)
		REFERENCES `credit_product` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `credit_product_arrear_rate_FI_2` (`rate_unique_id`),
	CONSTRAINT `credit_product_arrear_rate_FK_2`
		FOREIGN KEY (`rate_unique_id`)
		REFERENCES `rate_unique` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- credit
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `credit`;


CREATE TABLE `credit`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`product_id` BIGINT  NOT NULL,
	`associate_id` BIGINT  NOT NULL,
	`account_id` BIGINT  NOT NULL,
	`amount` DECIMAL(18,2)  NOT NULL,
	`balance` DECIMAL(18,2)  NOT NULL,
	`time_in_months` INTEGER  NOT NULL,
	`pay_frequency_in_months` INTEGER default 1 NOT NULL,
	`amortization_type` VARCHAR(60)  NOT NULL,
	`purpose` VARCHAR(100)  NOT NULL,
	`interest_rate` DECIMAL(8,2)  NOT NULL,
	`status` VARCHAR(30) default 'in_request' NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `credit_FI_1` (`product_id`),
	CONSTRAINT `credit_FK_1`
		FOREIGN KEY (`product_id`)
		REFERENCES `credit_product` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	INDEX `credit_FI_2` (`associate_id`),
	CONSTRAINT `credit_FK_2`
		FOREIGN KEY (`associate_id`)
		REFERENCES `associate` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	INDEX `credit_FI_3` (`account_id`),
	CONSTRAINT `credit_FK_3`
		FOREIGN KEY (`account_id`)
		REFERENCES `account` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- payment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `payment`;


CREATE TABLE `payment`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`credit_id` BIGINT  NOT NULL,
	`transaction_id` BIGINT,
	`number` INTEGER  NOT NULL,
	`date` DATE  NOT NULL,
	`balance` DECIMAL(18,2)  NOT NULL,
	`capital` DECIMAL(18,2)  NOT NULL,
	`interest` DECIMAL(18,2)  NOT NULL,
	`status` VARCHAR(30)  NOT NULL,
	`days_in_arrear` INTEGER,
	`arrear` DECIMAL(8,2),
	`discount` DECIMAL(8,2),
	PRIMARY KEY (`id`),
	UNIQUE KEY `payment_U_1` (`transaction_id`),
	INDEX `payment_FI_1` (`credit_id`),
	CONSTRAINT `payment_FK_1`
		FOREIGN KEY (`credit_id`)
		REFERENCES `credit` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	CONSTRAINT `payment_FK_2`
		FOREIGN KEY (`transaction_id`)
		REFERENCES `credit_transaction` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- credit_transaction
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `credit_transaction`;


CREATE TABLE `credit_transaction`
(
	`id` BIGINT  NOT NULL,
	`credit_id` BIGINT  NOT NULL,
	PRIMARY KEY (`id`),
	CONSTRAINT `credit_transaction_FK_1`
		FOREIGN KEY (`id`)
		REFERENCES `transaction` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `credit_transaction_FI_2` (`credit_id`),
	CONSTRAINT `credit_transaction_FK_2`
		FOREIGN KEY (`credit_id`)
		REFERENCES `credit` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- guarantee_personal
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `guarantee_personal`;


CREATE TABLE `guarantee_personal`
(
	`credit_id` BIGINT  NOT NULL,
	`associate_id` BIGINT  NOT NULL,
	PRIMARY KEY (`credit_id`,`associate_id`),
	CONSTRAINT `guarantee_personal_FK_1`
		FOREIGN KEY (`credit_id`)
		REFERENCES `credit` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `guarantee_personal_FI_2` (`associate_id`),
	CONSTRAINT `guarantee_personal_FK_2`
		FOREIGN KEY (`associate_id`)
		REFERENCES `associate` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- guarantee_real
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `guarantee_real`;


CREATE TABLE `guarantee_real`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`credit_id` BIGINT  NOT NULL,
	`name` VARCHAR(30)  NOT NULL,
	`description` TEXT,
	PRIMARY KEY (`id`),
	INDEX `guarantee_real_FI_1` (`credit_id`),
	CONSTRAINT `guarantee_real_FK_1`
		FOREIGN KEY (`credit_id`)
		REFERENCES `credit` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
