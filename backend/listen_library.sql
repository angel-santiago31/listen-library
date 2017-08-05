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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `admin` */

insert  into `admin`(`id`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`created_at`,`updated_at`) values 
(11,'5RrSqB7TSdA4adsz3YwuO199zllvrlNI','$2y$13$9fAJ0luQ7GcMcoyc9bZtM.LG2M/NJa0n4pBDtvs8ZFdHzkdqgb8lm','crIxZKYBsipcpWcYHkjk3qEUv95tjavk_1501170550','samuel.reyes@listen-library.com',10,1501170550,1501262312),
(12,'Qv7uDCMjrs7eFCHMCLkmQT50oyFDM7bv','$2y$13$Ctt09AkGiG6eTExq26hQ6uizllhxkNDL3CVbA4BR/UsUlMsiJ2mRq','Tp0wwusDsyXAjFK7a1cft9ebfq7u-lSy_1501950014','sddsgs@esgsdg.com',10,1501950015,1501950015);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `audiobook` */

insert  into `audiobook`(`id`,`title`,`genre`,`is_fiction`,`author_id`,`narrator_id`,`length`,`release_date`,`publisher_id`,`price`,`cost`,`picture`,`picture2`,`summary`,`active`) values 
(3,'Harry Potter and the Sorcerer\'s Stone, Book 1',1,1,1,1,'8 hrs and 34 mins','Nov-20-2015',1,29.99,50.00,'https://images-na.ssl-images-amazon.com/images/I/61+nk5cUSiL._SL300_.jpg','http://ecx.images-amazon.com/images/I/61+nk5cUSiL._SL150_.jpg','Harry Potter has never even heard of Hogwarts when the letters start dropping on the doormat at number four, Privet Drive. Addressed in green ink on yellowish parchment with a purple seal, they are swiftly confiscated by his grisly aunt and uncle. ',10),
(4,'Harry Potter and the Chamber of Secrets, Book 2',1,1,1,1,'9 hrs and 24 mins ','Nov-15-2015',1,29.99,20.00,'https://images-na.ssl-images-amazon.com/images/I/61NePgI8YzL._SL300_.jpg','http://ecx.images-amazon.com/images/I/61NePgI8YzL._SL150_.jpg','\"\'There is a plot, Harry Potter. A plot to make most terrible things happen at Hogwarts School of Witchcraft and Wizardry this year.\'\"\r\nHarry Potter\'s summer has includ',10),
(5,'Harry Potter and the Prisoner of Azkaban, Book 3',1,1,1,1,'12 hrs and 15 min','Nov-20-2015',1,29.99,20.00,'https://images-na.ssl-images-amazon.com/images/I/61X-FUaMk2L._SL300_.jpg','http://ecx.images-amazon.com/images/I/61X-FUaMk2L._SL150_.jpg','When the Knight Bus crashes through the darkness and screeches to a halt in front of him, it\'s the start of another far from ordinary year at Hogwarts for Harry Potter.',10),
(6,'Undercover',2,0,2,2,'8 hrs and 16 mins ','Aug-01-2015',2,27.29,15.34,'https://images-na.ssl-images-amazon.com/images/I/510QoX8SEwL._SL300_.jpg','http://ecx.images-amazon.com/images/I/510QoX8SEwL._SL150_.jpg','For DEA Special Agent Marshall Everett, life as he knows it is over once a gunshot wound renders his arm useless. Barred forever from the undercover work he loves, he has nothing - no close friends, no family, no hometown or base, and no desire to settle f',10);

/*Table structure for table `author` */

DROP TABLE IF EXISTS `author`;

CREATE TABLE `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Author Id',
  `name` varchar(18) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `author` */

insert  into `author`(`id`,`name`) values 
(1,'J.K. Rowling'),
(2,'Danielle Steel');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `credit_card` */

insert  into `credit_card`(`id`,`customer_id`,`card_last_digits`,`expiration_date`,`card_type`) values 
(1,6,9999,9999,'Chase'),
(2,7,9999,9999,'Chase'),
(3,8,9999,9999,'Chase'),
(4,9,9999,9999,'Chase'),
(5,10,9999,9999,'Chase'),
(6,11,9999,9999,'Visa'),
(7,12,6547,5754,'Master Card'),
(8,13,9999,3423,'Master Card');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

/*Data for the table `customer` */

insert  into `customer`(`id`,`first_name`,`last_name`,`initial`,`age`,`email`,`phone_number_1`,`phone_number_2`,`auth_key`,`password_hash`,`status`,`created_at`,`updated_at`) values 
(5,'Test','Customer','T','18-25','customer@customer.com',9999999999,NULL,'zMj3GB-2trtNEuXxaSRoWgD3MMXZJgu3','$2y$13$2d0hky4CHw2bIddTf7V8DOryO/.7VczBUmiNdwmfx0J0rnJbGYPgG',10,1499611547,1501949692),
(6,'Samuel','Reyes','J','18-25','samuel@customer.com',9999999999,NULL,'vlP5BGL0bMUEulXhlPWqBUx5c4cfLKou','$2y$13$LAj73a9INVFjhm7eLz.S9u4kJmjzOIMLyESaKyezltAZ9m4ZP8EAG',10,1500827281,1501195497),
(7,'jhggjg','kjbjkg','e','18-25','sammy@customer.com',9999999999,NULL,'LE2pnJPYjepljwBzI62UeYOiJHeF0TDT','$2y$13$uysDfsU/ik7i3ADxpniFbu12WlxU27Z5sKM0EgS5CBo2lPcg0Ss6y',10,1500830217,1500830217),
(8,'Customer','Customer','C','26-30','customer1@customer.com',9999999999,9999999999,'V0OBY_XACcEBfLT7VoAZsfXtMXSub2GC','$2y$13$r9Si9.g0VA9mZWWNSP7rtOwvdh/ejJOB8ecc5QQOOEHTaRAlihQxi',10,1500836751,1500836877),
(9,'Samuel','Reyes','','18-25','samuel.reyes@listen-library.com',9999999999,NULL,'V5EztksWDm6RF4XyoX9U5ZQ_e_8ZayCL','$2y$13$BEuCEvI75I40TBXyDCzJPePctVPXWgX6OIGQU62BuK4k8uYdGmkNu',10,1501262468,1501947261),
(10,'Test','Test','T','18-25','test@listen-library.com',9999999999,NULL,'77lWrmisaLzNY6gl2dP9MAP64I1qngWy','$2y$13$JdY/Gw1yh85B/hHpnki7lexQ7yobfbfn27j6IrLogTdZgms0cfRTK',10,1501947425,1501947425),
(11,'fdsg','sdfgf','f','18-25','dfdsfs@email.com',9999999999,NULL,'GwEO4mXMGYcRhwPPulxZU1o6wWK3_HnP','$2y$13$Si6cELtYx2dCgzpuh2zxdOZCqoaLjrxCTF0.R.PfDFZVSi1JegfSy',10,1501947657,1501947657),
(12,'dfgdg','dsgsdgsdgsd','','18-25','gdgd@dsgdsg.com',6658776745,NULL,'c4G8boxA_ZbK7Jy1IfSCYdD-ybpPaYKg','$2y$13$XSzxUa/jFA0IWHZO./z.T.QbTQkYmcpf27lDqzn01Rq8uKFTZi1Le',10,1501948249,1501948249),
(13,'dsgdsgds','dsgsdgs','','18-25','asfsf@gdsgds.com',4344524525,NULL,'BmHEbmDz5To98EwY0UwF89Qpb0Vx3oDC','$2y$13$WIL.DvzQC06IOcz.IzYqGOWg9wtiADRq18hV/o5aSRfXMshQlMT4G',10,1501949767,1501949767);

/*Table structure for table `genre` */

DROP TABLE IF EXISTS `genre`;

CREATE TABLE `genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `genre` varchar(18) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `genre` */

insert  into `genre`(`id`,`genre`) values 
(1,'Fantasy'),
(2,'Romance');

/*Table structure for table `item_in_order` */

DROP TABLE IF EXISTS `item_in_order`;

CREATE TABLE `item_in_order` (
  `order_id` int(11) NOT NULL COMMENT 'Order Id',
  `audiobook_id` int(11) NOT NULL COMMENT 'Audiobook Id',
  KEY `order_id` (`order_id`),
  KEY `audiobook_id` (`audiobook_id`),
  CONSTRAINT `item_in_order_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `item_in_order_ibfk_2` FOREIGN KEY (`audiobook_id`) REFERENCES `audiobook` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `item_in_order` */

insert  into `item_in_order`(`order_id`,`audiobook_id`) values 
(39,5),
(39,6),
(40,6),
(41,4),
(42,3),
(43,4),
(44,4),
(45,4),
(46,4),
(47,3),
(48,5);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `narrator` */

insert  into `narrator`(`id`,`name`) values 
(1,'Jim Dale'),
(2,'Alexander Cendese');

/*Table structure for table `orders` */

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Order Id',
  `item_quantity` int(11) NOT NULL COMMENT 'Items in Order',
  `purchase_date` int(11) NOT NULL COMMENT 'Order Date',
  `status` varchar(18) NOT NULL COMMENT 'Order Status',
  `customer_id` int(11) NOT NULL COMMENT 'Customer Id',
  `credit_card` int(11) NOT NULL COMMENT 'Card Last Digits',
  `price_total` float NOT NULL COMMENT 'Price Total',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `card_last_digits` (`credit_card`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`credit_card`) REFERENCES `credit_card` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

/*Data for the table `orders` */

insert  into `orders`(`id`,`item_quantity`,`purchase_date`,`status`,`customer_id`,`credit_card`,`price_total`) values 
(39,2,1501865167,'Active',9,4,57.28),
(40,1,1501865172,'Active',9,4,27.29),
(41,1,1501943483,'Active',9,4,29.99),
(42,1,1501944101,'Active',9,4,29.99),
(43,1,1501944159,'Active',9,4,29.99),
(44,1,1501944196,'Active',9,4,29.99),
(45,1,1501944224,'Active',9,4,29.99),
(46,1,1501944237,'Active',9,4,29.99),
(47,1,1501944279,'Active',9,4,29.99),
(48,1,1501944296,'Active',9,4,29.99);

/*Table structure for table `publisher` */

DROP TABLE IF EXISTS `publisher`;

CREATE TABLE `publisher` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Publisher Id',
  `name` varchar(64) NOT NULL COMMENT 'Name',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `publisher` */

insert  into `publisher`(`id`,`name`) values 
(1,'Pottermore from J.K. Rowling'),
(2,'Brilliance Audio');

/*Table structure for table `report` */

DROP TABLE IF EXISTS `report`;

CREATE TABLE `report` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `description` text,
  `type` varchar(11) NOT NULL,
  `from_date` int(11) DEFAULT NULL,
  `to_date` int(11) DEFAULT NULL,
  `refers_to` varchar(58) DEFAULT NULL,
  `item_selected` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

/*Data for the table `report` */

insert  into `report`(`id`,`title`,`description`,`type`,`from_date`,`to_date`,`refers_to`,`item_selected`) values 
(46,'Romance Sales','Text...','SALES',1501804800,1501890900,'2','6'),
(47,'Harry Potter Revenue','Text...','REVENUE',1501804800,1501890900,'1','5'),
(48,'Test Notifications','dzddgsd','REVENUE',1501891200,1501977300,'1','4'),
(49,'Test Notifications','dzddgsd','REVENUE',1501891200,1501977300,'1','4'),
(50,'TESTNOTI','nfnfgdn','REVENUE',1501891200,1501977300,'1','6');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
