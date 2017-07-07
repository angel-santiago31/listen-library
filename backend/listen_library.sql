/*
SQLyog Community v12.4.1 (64 bit)
MySQL - 10.1.21-MariaDB : Database - listen_library
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`listen_library` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `listen_library`;

/*Table structure for table `audiobook` */

DROP TABLE IF EXISTS `audiobook`;

CREATE TABLE `audiobook` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Audiobook Id',
  `title` varchar(64) NOT NULL COMMENT 'Title',
  `genre` int(11) NOT NULL COMMENT 'Genre',
  `is_fiction` int(11) NOT NULL COMMENT 'Is Fiction?',
  `author_id` int(11) NOT NULL COMMENT 'Author Id',
  `narrator_id` int(11) NOT NULL COMMENT 'Narrator Id',
  `length` varchar(18) NOT NULL COMMENT 'Length',
  `release_date` int(8) NOT NULL COMMENT 'Release Date',
  `publisher_id` int(11) NOT NULL COMMENT 'Publisher Id',
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `narrator_id` (`narrator_id`),
  KEY `publisher_id` (`publisher_id`),
  CONSTRAINT `audiobook_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `audiobook_ibfk_2` FOREIGN KEY (`narrator_id`) REFERENCES `narrator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `audiobook_ibfk_3` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `audiobook` */

/*Table structure for table `author` */

DROP TABLE IF EXISTS `author`;

CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Author Id',
  `first_name` varchar(18) NOT NULL COMMENT 'First Name',
  `last_name` varchar(18) NOT NULL COMMENT 'Last Name',
  `initial` char(1) DEFAULT NULL COMMENT 'Initial',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `author` */

/*Table structure for table `contains` */

DROP TABLE IF EXISTS `contains`;

CREATE TABLE `contains` (
  `order_id` int(11) NOT NULL COMMENT 'Order Id',
  `audiobook_id` int(11) NOT NULL COMMENT 'Audiobook Id',
  KEY `order_id` (`order_id`),
  KEY `audiobook_id` (`audiobook_id`),
  CONSTRAINT `contains_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contains_ibfk_2` FOREIGN KEY (`audiobook_id`) REFERENCES `audiobook` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `contains` */

/*Table structure for table `credit_card` */

DROP TABLE IF EXISTS `credit_card`;

CREATE TABLE `credit_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Credit Card Id',
  `customer_id` int(11) NOT NULL COMMENT 'Customer Id',
  `card_last_digits` int(4) NOT NULL COMMENT 'Card Last Digits',
  `expiration_date` int(4) NOT NULL COMMENT 'Expiration Date',
  `card_type` varchar(18) NOT NULL COMMENT 'Card Type',
  PRIMARY KEY (`id`,`card_last_digits`),
  KEY `customer_id` (`customer_id`),
  CONSTRAINT `credit_card_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `credit_card` */

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Customer Id',
  `first_name` varchar(18) NOT NULL COMMENT 'First Name',
  `last_name` varchar(18) NOT NULL COMMENT 'Last Name',
  `initial` char(1) DEFAULT NULL COMMENT 'Initial',
  `age` int(11) NOT NULL COMMENT 'Age',
  `email` varchar(64) NOT NULL COMMENT 'E-mail',
  `phone_number_1` int(10) NOT NULL COMMENT 'Primary Phone Number',
  `phone_number_2` int(10) DEFAULT NULL COMMENT 'Secondary Phone Number(Optional)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `customer` */

/*Table structure for table `narrator` */

DROP TABLE IF EXISTS `narrator`;

CREATE TABLE `narrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Narrator Id',
  `first_name` varchar(18) NOT NULL COMMENT 'First Name',
  `last_name` varchar(18) NOT NULL COMMENT 'Last Name',
  `initial` char(1) DEFAULT NULL COMMENT 'Initial',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `narrator` */

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Order Id',
  `item_quantity` int(11) NOT NULL COMMENT 'Items in Order',
  `date` int(11) NOT NULL COMMENT 'Order Date',
  `status` varchar(18) NOT NULL COMMENT 'Order Status',
  `customer_id` int(11) NOT NULL COMMENT 'Customer Id',
  `card_last_digits` int(4) NOT NULL COMMENT 'Card Last Digits',
  `price_total` float NOT NULL COMMENT 'Price Total',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `card_last_digits` (`card_last_digits`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`card_last_digits`) REFERENCES `credit_card` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `order` */

/*Table structure for table `publisher` */

DROP TABLE IF EXISTS `publisher`;

CREATE TABLE `publisher` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Publisher Id',
  `name` varchar(64) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `publisher` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
