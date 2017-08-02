/*
SQLyog Community v12.4.3 (64 bit)
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

/*Table structure for table `admin` */

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `admin` */

insert  into `admin`(`id`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`) values 
(11,'5RrSqB7TSdA4adsz3YwuO199zllvrlNI','$2y$13$9fAJ0luQ7GcMcoyc9bZtM.LG2M/NJa0n4pBDtvs8ZFdHzkdqgb8lm','crIxZKYBsipcpWcYHkjk3qEUv95tjavk_1501170550','samuel.reyes@listen-library.com',10,1501170550,1501262312);

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
  `release_date` varchar(11) NOT NULL COMMENT 'Release Date',
  `publisher_id` int(11) NOT NULL COMMENT 'Publisher Id',
  `price` float(4,2) NOT NULL COMMENT 'Price',
  `cost` float(4,2) NOT NULL COMMENT 'Production Cost',
  `picture` varchar(256) NOT NULL COMMENT 'Picture',
  `picture2` varchar(256) NOT NULL COMMENT 'Picture 2',
  `summary` varchar(256) NOT NULL COMMENT 'Summary',
  `active` int(11) DEFAULT '10' COMMENT 'Active',
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`),
  KEY `narrator_id` (`narrator_id`),
  KEY `publisher_id` (`publisher_id`),
  CONSTRAINT `audiobook_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `audiobook_ibfk_2` FOREIGN KEY (`narrator_id`) REFERENCES `narrator` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `audiobook_ibfk_3` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `audiobook` */

insert  into `audiobook`(`id`,`title`,`genre`,`is_fiction`,`author_id`,`narrator_id`,`length`,`release_date`,`publisher_id`,`price`,`cost`,`picture`,`picture2`,`summary`,`active`) values 
(3,'Harry Potter and the Sorcerer\'s Stone, Book 1',1,1,1,1,'8 hrs and 34 mins','Nov-20-2015',1,29.99,50.00,'https://images-na.ssl-images-amazon.com/images/I/61+nk5cUSiL._SL300_.jpg','http://ecx.images-amazon.com/images/I/61+nk5cUSiL._SL150_.jpg','Harry Potter has never even heard of Hogwarts when the letters start dropping on the doormat at number four, Privet Drive. Addressed in green ink on yellowish parchment with a purple seal, they are swiftly confiscated by his grisly aunt and uncle. ',10);

/*Table structure for table `author` */

DROP TABLE IF EXISTS `author`;

CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Author Id',
  `name` varchar(18) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `author` */

insert  into `author`(`id`,`name`) values 
(1,'J.K. Rowling');

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

insert  into `contains`(`order_id`,`audiobook_id`) values 
(25,3),
(26,3),
(27,3);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `credit_card` */

insert  into `credit_card`(`id`,`customer_id`,`card_last_digits`,`expiration_date`,`card_type`) values 
(1,6,9999,9999,'Chase'),
(2,7,9999,9999,'Chase'),
(3,8,9999,9999,'Chase'),
(4,9,9999,9999,'Chase');

/*Table structure for table `customer` */

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Customer Id',
  `first_name` varchar(18) NOT NULL COMMENT 'First Name',
  `last_name` varchar(18) NOT NULL COMMENT 'Last Name',
  `initial` char(1) DEFAULT NULL COMMENT 'Initial',
  `age` varchar(18) NOT NULL COMMENT 'Age',
  `email` varchar(255) NOT NULL COMMENT 'E-mail',
  `phone_number_1` bigint(20) NOT NULL COMMENT 'Primary Phone Number',
  `phone_number_2` bigint(20) DEFAULT NULL COMMENT 'Secondary Phone Number(Optional)',
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `customer` */

insert  into `customer`(`id`,`first_name`,`last_name`,`initial`,`age`,`email`,`phone_number_1`,`phone_number_2`,`auth_key`,`password_hash`,`status`,`created_at`,`updated_at`) values 
(5,'Test','Customer','T','18-25','customer@customer.com',9999999999,NULL,'zMj3GB-2trtNEuXxaSRoWgD3MMXZJgu3','$2y$13$8lAzC0dsCapPyO5qmWyiwuDSrtbss6iFBwr80HeCHasvNIMWx0hDG',10,1499611547,1501195299),
(6,'Samuel','Reyes','J','18-25','samuel@customer.com',9999999999,NULL,'vlP5BGL0bMUEulXhlPWqBUx5c4cfLKou','$2y$13$LAj73a9INVFjhm7eLz.S9u4kJmjzOIMLyESaKyezltAZ9m4ZP8EAG',10,1500827281,1501195497),
(7,'jhggjg','kjbjkg','e','18-25','sammy@customer.com',9999999999,NULL,'LE2pnJPYjepljwBzI62UeYOiJHeF0TDT','$2y$13$uysDfsU/ik7i3ADxpniFbu12WlxU27Z5sKM0EgS5CBo2lPcg0Ss6y',10,1500830217,1500830217),
(8,'Customer','Customer','C','26-30','customer1@customer.com',9999999999,9999999999,'V0OBY_XACcEBfLT7VoAZsfXtMXSub2GC','$2y$13$r9Si9.g0VA9mZWWNSP7rtOwvdh/ejJOB8ecc5QQOOEHTaRAlihQxi',10,1500836751,1500836877),
(9,'Samuel','Reyes','','18-25','samuel.reyes@listen-library.com',9999999999,NULL,'V5EztksWDm6RF4XyoX9U5ZQ_e_8ZayCL','$2y$13$BEuCEvI75I40TBXyDCzJPePctVPXWgX6OIGQU62BuK4k8uYdGmkNu',10,1501262468,1501631623);

/*Table structure for table `genre` */

DROP TABLE IF EXISTS `genre`;

CREATE TABLE `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `genre` varchar(18) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `genre` */

insert  into `genre`(`id`,`genre`) values 
(1,'Fantasy');

/*Table structure for table `migration` */

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `migration` */

insert  into `migration`(`version`,`apply_time`) values 
('m000000_000000_base',1499472031),
('m130524_201442_init',1499472038);

/*Table structure for table `narrator` */

DROP TABLE IF EXISTS `narrator`;

CREATE TABLE `narrator` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Narrator Id',
  `name` varchar(18) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `narrator` */

insert  into `narrator`(`id`,`name`) values 
(1,'Jim Dale');

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Order Id',
  `item_quantity` int(11) NOT NULL COMMENT 'Items in Order',
  `date` int(11) NOT NULL COMMENT 'Order Date',
  `status` varchar(18) NOT NULL COMMENT 'Order Status',
  `customer_id` int(11) NOT NULL COMMENT 'Customer Id',
  `credit_card` int(11) NOT NULL COMMENT 'Card Last Digits',
  `price_total` float NOT NULL COMMENT 'Price Total',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `card_last_digits` (`credit_card`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`credit_card`) REFERENCES `credit_card` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

/*Data for the table `order` */

insert  into `order`(`id`,`item_quantity`,`date`,`status`,`customer_id`,`credit_card`,`price_total`) values 
(25,1,1501631366,'Active',9,4,29.99),
(26,2,1501632463,'Active',9,4,59.98),
(27,1,1501632758,'Active',9,4,29.99);

/*Table structure for table `publisher` */

DROP TABLE IF EXISTS `publisher`;

CREATE TABLE `publisher` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Publisher Id',
  `name` varchar(64) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `publisher` */

insert  into `publisher`(`id`,`name`) values 
(1,'Pottermore from J.K. Rowling');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
