
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- investment_product
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `investment_product`;


CREATE TABLE `investment_product`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(60)  NOT NULL,
	`tax_rate` DECIMAL(8,2) default 0.00 NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `investment_product_U_1` (`name`)
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- investment_product_interest_rate
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `investment_product_interest_rate`;


CREATE TABLE `investment_product_interest_rate`
(
	`product_id` BIGINT  NOT NULL,
	`rate_term_id` BIGINT  NOT NULL,
	PRIMARY KEY (`product_id`,`rate_term_id`),
	CONSTRAINT `investment_product_interest_rate_FK_1`
		FOREIGN KEY (`product_id`)
		REFERENCES `investment_product` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE,
	INDEX `investment_product_interest_rate_FI_2` (`rate_term_id`),
	CONSTRAINT `investment_product_interest_rate_FK_2`
		FOREIGN KEY (`rate_term_id`)
		REFERENCES `rate_term` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- investment
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `investment`;


CREATE TABLE `investment`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`associate_id` BIGINT  NOT NULL,
	`account_id` BIGINT  NOT NULL,
	`product_id` BIGINT  NOT NULL,
	`amount` DECIMAL(18,2) default 0.00 NOT NULL,
	`balance` DECIMAL(18,2) default 0.00 NOT NULL,
	`time_days` INTEGER  NOT NULL,
	`expiration_date` DATETIME  NOT NULL,
	`interest_rate` DECIMAL(8,2)  NOT NULL,
	`tax_rate` DECIMAL(8,2)  NOT NULL,
	`is_current` TINYINT default 0 NOT NULL,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `investment_FI_1` (`associate_id`),
	CONSTRAINT `investment_FK_1`
		FOREIGN KEY (`associate_id`)
		REFERENCES `associate` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	INDEX `investment_FI_2` (`account_id`),
	CONSTRAINT `investment_FK_2`
		FOREIGN KEY (`account_id`)
		REFERENCES `account` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	INDEX `investment_FI_3` (`product_id`),
	CONSTRAINT `investment_FK_3`
		FOREIGN KEY (`product_id`)
		REFERENCES `investment_product` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
