/*
SQLyog Community v12.01 (64 bit)
MySQL - 5.5.40-0ubuntu0.14.04.1-log : Database - phoenix_repo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`phoenix_repo` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `phoenix_repo`;

/*Table structure for table `ContactAuthorizations` */

DROP TABLE IF EXISTS `ContactAuthorizations`;

CREATE TABLE `ContactAuthorizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `passwordHistory` varchar(500) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `lastModified` timestamp NULL DEFAULT NULL,
  `Contacts_id` int(11) DEFAULT NULL,
  `roles` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_username_UNIQUE` (`username`),
  KEY `Clients_UserAuthorizations_client_idx` (`Contacts_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

/*Data for the table `ContactAuthorizations` */

insert  into `ContactAuthorizations`(`id`,`username`,`password`,`passwordHistory`,`status`,`lastModified`,`Contacts_id`,`roles`) values (16,'q','$1$JEt2g2JS$bzzNiIu4XD0HLQKLwEq.P/','$1$JEt2g2JS$bzzNiIu4XD0HLQKLwEq.P/','active',NULL,39,'IS_MANAGER|IS_CLIENT|IS_CUSTOMER_SERVICE');

/*Table structure for table `Contacts` */

DROP TABLE IF EXISTS `Contacts`;

CREATE TABLE `Contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `Contacts` */

insert  into `Contacts`(`id`,`name`) values (1,'dave meikle');

/*Table structure for table `Locales` */

DROP TABLE IF EXISTS `Locales`;

CREATE TABLE `Locales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` char(5) DEFAULT NULL,
  `isDefault` tinyint(1) DEFAULT NULL,
  `languageName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `Locales` */

/*Table structure for table `LocationsPhotos` */

DROP TABLE IF EXISTS `LocationsPhotos`;

CREATE TABLE `LocationsPhotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  `photo` longblob,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `dateTaken` date DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `LocationsPhotos_Staff_idx` (`Staff_id`),
  CONSTRAINT `LocationsPhotos_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `LocationsPhotos` */

insert  into `LocationsPhotos`(`id`,`description`,`photo`,`ClaimsLocations_id`,`dateTaken`,`Staff_id`,`notes`) values (1,'','',23,NULL,1,''),(2,'','',23,NULL,1,''),(3,'','',23,NULL,1,''),(4,'','',23,NULL,1,'');

/*Table structure for table `Provinces` */

DROP TABLE IF EXISTS `Provinces`;

CREATE TABLE `Provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` varchar(45) DEFAULT NULL,
  `abbreviation` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `Provinces` */

/*Table structure for table `Staff` */

DROP TABLE IF EXISTS `Staff`;

CREATE TABLE `Staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `StaffTypes_id` int(11) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `Provinces_id` int(11) DEFAULT NULL,
  `postalCode` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `StaffTypes_id_idx` (`StaffTypes_id`),
  KEY `Staff_Provinces_idx` (`Provinces_id`),
  CONSTRAINT `StaffTypes_id` FOREIGN KEY (`StaffTypes_id`) REFERENCES `StaffTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Staff_Provinces` FOREIGN KEY (`Provinces_id`) REFERENCES `Provinces` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `Staff` */

insert  into `Staff`(`id`,`StaffTypes_id`,`firstname`,`lastname`,`telephone`,`email`,`isActive`,`address1`,`address2`,`city`,`Provinces_id`,`postalCode`) values (1,1,'dave','m',NULL,'davem@phoenixrestorations.com',1,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `StaffAuthorizationTokens` */

DROP TABLE IF EXISTS `StaffAuthorizationTokens`;

CREATE TABLE `StaffAuthorizationTokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(40) NOT NULL,
  `decayTime` timestamp NULL DEFAULT NULL,
  `ipAddress` char(15) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `AuthorizationTokens_Staff_idx` (`Staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `StaffAuthorizationTokens` */

/*Table structure for table `StaffAuthorizations` */

DROP TABLE IF EXISTS `StaffAuthorizations`;

CREATE TABLE `StaffAuthorizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `passwordHistory` varchar(500) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `lastModified` timestamp NULL DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `roles` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stff_username_UNIQUE` (`username`),
  KEY `Clients_StaffAuthorizations_client_idx` (`Staff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

/*Data for the table `StaffAuthorizations` */

insert  into `StaffAuthorizations`(`id`,`username`,`password`,`passwordHistory`,`status`,`lastModified`,`Staff_id`,`roles`) values (1,'davem@phoenixrestorations.com','$1$Yh3z0eVB$xK9EMmy53LcyTabxt2ddv.',NULL,'active',NULL,2,'IS_ADMINISTRATOR|IS_CLIENT|IS_CUSTOMER_SERVICE|IS_POWER_USER'),(4,'qaa','$1$stbE5jpa$N1H1Ej/xfbYW3QbxIW4rG/','$1$stbE5jpa$N1H1Ej/xfbYW3QbxIW4rG/','active',NULL,82,NULL),(6,'qaab','$1$ZNJVddJl$wlPuSJc7L9blG9/XfmcS5/','$1$ZNJVddJl$wlPuSJc7L9blG9/XfmcS5/','active',NULL,84,'IS_CUSTOMER_SERVICE|IS_DEPT_MANAGER|IS_ESTIMATOR|IS_POWER_USER|IS_PROJECT_COORDINATOR|IS_PROJECT_MANAGER|IS_PM_ASSISTANT|IS_MARKETING'),(16,'juliew@phoenixrestorations.com','$1$FSGGfoPB$ehpN9z5EhpJu8x8odbRux0','$1$FSGGfoPB$ehpN9z5EhpJu8x8odbRux0','active',NULL,93,'IS_MANAGER|IS_POWER_USER'),(25,'rhondas@phoenixrestorations.com','$1$IHHMvIpU$DWGgj7rFId997..f.BBjB/','$1$IHHMvIpU$DWGgj7rFId997..f.BBjB/','active',NULL,102,'IS_ACCOUNTING|IS_ACOUNTS_PAYABLE|IS_ADMINISTRATOR|IS_MANAGER|IS_POWER_USER|IS_PROJECT_MANAGER|IS_PM_ASSISTANT');

/*Table structure for table `StaffTypes` */

DROP TABLE IF EXISTS `StaffTypes`;

CREATE TABLE `StaffTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeOfStaff` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `StaffTypes` */

insert  into `StaffTypes`(`id`,`typeOfStaff`) values (1,'test');

/*Table structure for table `UserPreferences` */

DROP TABLE IF EXISTS `UserPreferences`;

CREATE TABLE `UserPreferences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(11) DEFAULT NULL,
  `defaultLocale_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Clients_UserPreferences_locale_idx` (`Staff_id`),
  KEY `Locales_UserPreferences_locale_idx` (`defaultLocale_id`),
  CONSTRAINT `Locales_UserPreferences_locale` FOREIGN KEY (`defaultLocale_id`) REFERENCES `Locales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Staff_UserPreferences_staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `UserPreferences` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
