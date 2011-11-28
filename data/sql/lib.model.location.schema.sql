
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- country
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `country`;


CREATE TABLE `country`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50)  NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE KEY `country_U_1` (`name`)
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- province
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `province`;


CREATE TABLE `province`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`country_id` BIGINT  NOT NULL,
	`name` VARCHAR(50)  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `province_FI_1` (`country_id`),
	CONSTRAINT `province_FK_1`
		FOREIGN KEY (`country_id`)
		REFERENCES `country` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

#-----------------------------------------------------------------------------
#-- city
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `city`;


CREATE TABLE `city`
(
	`id` BIGINT  NOT NULL AUTO_INCREMENT,
	`province_id` BIGINT  NOT NULL,
	`name` VARCHAR(50)  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `city_FI_1` (`province_id`),
	CONSTRAINT `city_FK_1`
		FOREIGN KEY (`province_id`)
		REFERENCES `province` (`id`)
		ON UPDATE RESTRICT
		ON DELETE CASCADE
)ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
