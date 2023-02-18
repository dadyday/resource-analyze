SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `entity`;
CREATE TABLE `entity` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`handle` varchar(40) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
	`name` varchar(60) NOT NULL,
	`layer_id` int(11) unsigned DEFAULT NULL,
	`income` int(11) DEFAULT NULL,
	`costs` int(11) DEFAULT NULL,
	PRIMARY KEY (`id`),
	KEY `layer_id` (`layer_id`),
	CONSTRAINT `entity_ibfk_3` FOREIGN KEY (`layer_id`) REFERENCES `layer` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `layer`;
CREATE TABLE `layer` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
	`name` varchar(60) NOT NULL,
	`order` int(10) unsigned NOT NULL,
	PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `relation`;
CREATE TABLE `relation` (
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`from_id` int(10) unsigned DEFAULT NULL,
	`to_id` int(10) unsigned DEFAULT NULL,
	`value` double NOT NULL,
	`unit` enum('count','currency','percent','hour','days','months') NOT NULL,
	`income_part` double NOT NULL,
	`costs_part` double NOT NULL,
	PRIMARY KEY (`id`),
	KEY `from_id` (`from_id`),
	KEY `to_id` (`to_id`),
	CONSTRAINT `relation_ibfk_1` FOREIGN KEY (`from_id`) REFERENCES `entity` (`id`) ON DELETE SET NULL,
	CONSTRAINT `relation_ibfk_2` FOREIGN KEY (`to_id`) REFERENCES `entity` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
