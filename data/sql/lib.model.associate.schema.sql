
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- category
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `category`;


CREATE TABLE `category`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(30)  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `category_U_1` (`name`)
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- associate
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `associate`;


CREATE TABLE `associate`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`category_id` BIGINT  NOT NULL,
	`city_hometown_id` BIGINT,
	`city_current_id` BIGINT,
	`number` BIGINT  NOT NULL,
	`identification` VARCHAR(15),
	`name` VARCHAR(100)  NOT NULL,
	`type` VARCHAR(30)  NOT NULL,
	`is_active` TINYINT default 1 NOT NULL,
	`picture` VARCHAR(255),
	`address` TEXT,
	`neighborhood` VARCHAR(150),
	`website` VARCHAR(150),
	`about` TEXT,
	`gender` VARCHAR(15),
	`relationship_status` VARCHAR(30),
	`birthday` DATE,
	`monthly_income` DECIMAL(18,2) default 0.00,
	`monthly_expenditure` DECIMAL(18,2) default 0.00,
	`created_at` DATETIME  NOT NULL,
	`updated_at` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `associate_U_1` (`number`),
	INDEX `associate_FI_1` (`category_id`),
	CONSTRAINT `associate_FK_1`
		FOREIGN KEY (`category_id`)
		REFERENCES `category` (`id`)
		ON DELETE RESTRICT,
	INDEX `associate_FI_2` (`city_hometown_id`),
	CONSTRAINT `associate_FK_2`
		FOREIGN KEY (`city_hometown_id`)
		REFERENCES `city` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	INDEX `associate_FI_3` (`city_current_id`),
	CONSTRAINT `associate_FK_3`
		FOREIGN KEY (`city_current_id`)
		REFERENCES `city` (`id`)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- relationship
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `relationship`;


CREATE TABLE `relationship`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`associate_id` BIGINT  NOT NULL,
	`name` VARCHAR(100)  NOT NULL,
	`type` VARCHAR(100)  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `relationship_FI_1` (`associate_id`),
	CONSTRAINT `relationship_FK_1`
		FOREIGN KEY (`associate_id`)
		REFERENCES `associate` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- email
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `email`;


CREATE TABLE `email`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`associate_id` BIGINT  NOT NULL,
	`address` VARCHAR(60)  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `email_FI_1` (`associate_id`),
	CONSTRAINT `email_FK_1`
		FOREIGN KEY (`associate_id`)
		REFERENCES `associate` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- phone
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `phone`;


CREATE TABLE `phone`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`associate_id` BIGINT  NOT NULL,
	`type` VARCHAR(60)  NOT NULL,
	`number` VARCHAR(25)  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `phone_FI_1` (`associate_id`),
	CONSTRAINT `phone_FK_1`
		FOREIGN KEY (`associate_id`)
		REFERENCES `associate` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
