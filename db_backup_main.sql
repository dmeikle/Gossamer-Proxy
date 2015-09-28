/*
SQLyog Community v12.01 (64 bit)
MySQL - 5.5.40-0ubuntu0.14.04.1-log : Database - phoenix_portal
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Table structure for table `AccessRoles` */

DROP TABLE IF EXISTS `AccessRoles`;

CREATE TABLE `AccessRoles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(30) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_UNIQUE` (`role`),
  KEY `UserAuthorizations_AccessRoles_clients_idx` (`Staff_id`),
  CONSTRAINT `UserAuthorizations_AccessRoles_clients` FOREIGN KEY (`Staff_id`) REFERENCES `StaffAuthorizations` (`Staff_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `AccessRoles` */

/*Table structure for table `ActionsPerformed` */

DROP TABLE IF EXISTS `ActionsPerformed`;

CREATE TABLE `ActionsPerformed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Departments_id` int(11) DEFAULT NULL,
  `ClaimPhases_id` int(11) DEFAULT NULL,
  `code` varchar(6) DEFAULT NULL,
  `layer` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ActionsPerformed_Departments_idx` (`Departments_id`),
  KEY `ActionsPerformed_ClaimPhases_idx` (`ClaimPhases_id`),
  CONSTRAINT `ActionsPerformed_ClaimPhases` FOREIGN KEY (`ClaimPhases_id`) REFERENCES `ClaimPhases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ActionsPerformed_Departments` FOREIGN KEY (`Departments_id`) REFERENCES `Departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ActionsPerformed` */

/*Table structure for table `ActionsPerformedI18n` */

DROP TABLE IF EXISTS `ActionsPerformedI18n`;

CREATE TABLE `ActionsPerformedI18n` (
  `ActionsPerformed_id` int(11) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `action` varchar(200) DEFAULT NULL,
  UNIQUE KEY `ActionsPerformedI18n_ActionsPerformed_locale_idx` (`ActionsPerformed_id`,`locale`),
  KEY `ActionsPerformedI18n_ActionsPerformed_idx` (`ActionsPerformed_id`),
  CONSTRAINT `ActionsPerformedI18n_ActionsPerformed` FOREIGN KEY (`ActionsPerformed_id`) REFERENCES `ActionsPerformed` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ActionsPerformedI18n` */

/*Table structure for table `AllowableIPAddresses` */

DROP TABLE IF EXISTS `AllowableIPAddresses`;

CREATE TABLE `AllowableIPAddresses` (
  `ipAddress` varchar(15) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `serverName` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ipAddress`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `AllowableIPAddresses` */

/*Table structure for table `BreakDownReportsTitles` */

DROP TABLE IF EXISTS `BreakDownReportsTitles`;

CREATE TABLE `BreakDownReportsTitles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `BreakDownReportsTitles` */

/*Table structure for table `BreakdownReports` */

DROP TABLE IF EXISTS `BreakdownReports`;

CREATE TABLE `BreakdownReports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimPhases_id` int(11) DEFAULT NULL,
  `SendToTypes_id` int(11) DEFAULT NULL,
  `sendToContacts_id` int(11) DEFAULT NULL,
  `attention` varchar(45) DEFAULT NULL,
  `opTypes_id` int(11) DEFAULT NULL,
  `hideOP` tinyint(1) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `BreakDownReportsTitles_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `BreakdownReports_Claims_idx` (`Claims_id`),
  KEY `BreakdownReports_ClaimPhases_idx` (`ClaimPhases_id`),
  CONSTRAINT `BreakdownReports_ClaimPhases` FOREIGN KEY (`ClaimPhases_id`) REFERENCES `ClaimPhases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `BreakdownReports_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `BreakdownReports` */

/*Table structure for table `BreakdownReportsItems` */

DROP TABLE IF EXISTS `BreakdownReportsItems`;

CREATE TABLE `BreakdownReportsItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quantity` float DEFAULT NULL,
  `rate` float DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `BreakdownReports_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `BreakdownReportsItems_BreakdownReports_idx` (`BreakdownReports_id`),
  CONSTRAINT `BreakdownReportsItems_BreakdownReports` FOREIGN KEY (`BreakdownReports_id`) REFERENCES `BreakdownReports` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `BreakdownReportsItems` */

/*Table structure for table `Categories` */

DROP TABLE IF EXISTS `Categories`;

CREATE TABLE `Categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `Categories` */

insert  into `Categories`(`id`,`dateModified`) values (1,'2014-10-24 14:40:00'),(2,'2014-10-24 14:40:00'),(3,'2014-10-24 14:40:00'),(4,'2014-10-24 14:40:00'),(5,'2014-10-24 14:40:00'),(6,'2014-10-24 14:40:00'),(7,'2014-10-24 14:40:00');

/*Table structure for table `CategoriesI18n` */

DROP TABLE IF EXISTS `CategoriesI18n`;

CREATE TABLE `CategoriesI18n` (
  `Categories_id` int(11) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  KEY `CategoriesI18n_Categories_idx` (`Categories_id`),
  CONSTRAINT `CategoriesI18n_Categories` FOREIGN KEY (`Categories_id`) REFERENCES `Categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `CategoriesI18n` */

insert  into `CategoriesI18n`(`Categories_id`,`locale`,`name`) values (1,'en_US','Drywall & Paint'),(2,'en_US','Plumbing & Cabinetry'),(3,'en_US','Baseboards & Trim'),(4,'en_US','Doors & Electrical'),(5,'en_US','Flooring'),(6,'en_US','General'),(7,'en_US','Notice');

/*Table structure for table `ClaimDocuments` */

DROP TABLE IF EXISTS `ClaimDocuments`;

CREATE TABLE `ClaimDocuments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `document` longblob,
  PRIMARY KEY (`id`),
  KEY `ClaimDocuments_claims_idx` (`Claims_id`),
  CONSTRAINT `ClaimDocuments_claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimDocuments` */

/*Table structure for table `ClaimPhases` */

DROP TABLE IF EXISTS `ClaimPhases`;

CREATE TABLE `ClaimPhases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimPhases` */

/*Table structure for table `ClaimPhasesI18n` */

DROP TABLE IF EXISTS `ClaimPhasesI18n`;

CREATE TABLE `ClaimPhasesI18n` (
  `ClaimPhases_id` int(11) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  KEY `ClaimPhases_ClaimPhasesI18n_idx` (`ClaimPhases_id`),
  CONSTRAINT `ClaimPhases_ClaimPhasesI18n` FOREIGN KEY (`ClaimPhases_id`) REFERENCES `ClaimPhases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimPhasesI18n` */

/*Table structure for table `ClaimScopeRoomDetailSpecifics` */

DROP TABLE IF EXISTS `ClaimScopeRoomDetailSpecifics`;

CREATE TABLE `ClaimScopeRoomDetailSpecifics` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this table is for things like:',
  `value` int(11) DEFAULT NULL,
  `ClaimScopeRoomDetailsValueTypes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimScopeRoomDetailSpecifics_valuetypes_idx` (`ClaimScopeRoomDetailsValueTypes_id`),
  CONSTRAINT `ClaimScopeRoomDetailSpecifics_valuetypes` FOREIGN KEY (`ClaimScopeRoomDetailsValueTypes_id`) REFERENCES `ClaimScopeRoomDetailsValueTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimScopeRoomDetailSpecifics` */

/*Table structure for table `ClaimScopeRoomDetailTypes` */

DROP TABLE IF EXISTS `ClaimScopeRoomDetailTypes`;

CREATE TABLE `ClaimScopeRoomDetailTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this is used to describe the room itself - not part of the scoping questions',
  `dateModified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimScopeRoomDetailTypes` */

/*Table structure for table `ClaimScopeRoomDetailTypesI18n` */

DROP TABLE IF EXISTS `ClaimScopeRoomDetailTypesI18n`;

CREATE TABLE `ClaimScopeRoomDetailTypesI18n` (
  `ClaimScopeRoomDetailTypes_id` int(11) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  KEY `ClaimScopeRoomDetailTypes_ClaimScopeRoomDetailTypesI18n_idx` (`ClaimScopeRoomDetailTypes_id`),
  CONSTRAINT `ClaimScopeRoomDetailTypes_ClaimScopeRoomDetailTypesI18n` FOREIGN KEY (`ClaimScopeRoomDetailTypes_id`) REFERENCES `ClaimScopeRoomDetailTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimScopeRoomDetailTypesI18n` */

/*Table structure for table `ClaimScopeRoomDetails` */

DROP TABLE IF EXISTS `ClaimScopeRoomDetails`;

CREATE TABLE `ClaimScopeRoomDetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this table uses a drop down, but you can manually enter something as well... use the ''other'' field',
  `ClaimScopeRooms_id` int(11) DEFAULT NULL,
  `ClaimScopeRoomDetailTypes_id` int(11) DEFAULT NULL,
  `other` varchar(500) DEFAULT NULL,
  `dateEntered` date DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `ClaimScopeRoomDetailSpecifics_id` int(11) DEFAULT NULL,
  `isPreExistingDamage` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimScopeRooms_ClaimScopeRoomDetails_idx` (`ClaimScopeRooms_id`),
  KEY `ClaimScopeRoomDetailTypes_ClaimScopeRoomDetails_idx` (`ClaimScopeRoomDetailTypes_id`),
  KEY `ClaimScopeRoomDetails_Staff_idx` (`Staff_id`),
  KEY `ClaimScopeRoomDetails_RoomDetailSpecifics_idx` (`ClaimScopeRoomDetailSpecifics_id`),
  CONSTRAINT `ClaimScopeRoomDetails_RoomDetailSpecifics` FOREIGN KEY (`ClaimScopeRoomDetailSpecifics_id`) REFERENCES `ClaimScopeRoomDetailSpecifics` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimScopeRoomDetails_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimScopeRoomDetailTypes_ClaimScopeRoomDetails` FOREIGN KEY (`ClaimScopeRoomDetailTypes_id`) REFERENCES `ClaimScopeRoomDetailTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimScopeRooms_ClaimScopeRoomDetails` FOREIGN KEY (`ClaimScopeRooms_id`) REFERENCES `ClaimScopeRooms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimScopeRoomDetails` */

/*Table structure for table `ClaimScopeRoomDetailsValueTypes` */

DROP TABLE IF EXISTS `ClaimScopeRoomDetailsValueTypes`;

CREATE TABLE `ClaimScopeRoomDetailsValueTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `ClaimScopeRoomDetailsValueTypes` */

insert  into `ClaimScopeRoomDetailsValueTypes`(`id`,`dateModified`) values (1,'2014-10-24 15:41:55'),(2,'2014-10-24 15:45:19'),(3,'2014-10-24 15:45:21');

/*Table structure for table `ClaimScopeRoomDetailsValueTypesI18n` */

DROP TABLE IF EXISTS `ClaimScopeRoomDetailsValueTypesI18n`;

CREATE TABLE `ClaimScopeRoomDetailsValueTypesI18n` (
  `ClaimScopeRoomDetailsValueTypes_id` int(11) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `valueType` varchar(45) DEFAULT NULL,
  UNIQUE KEY `ClaimScopeRoomDetailsValueTypes_id_UNIQUE` (`ClaimScopeRoomDetailsValueTypes_id`,`locale`),
  CONSTRAINT `ClaimScopesValueTypes` FOREIGN KEY (`ClaimScopeRoomDetailsValueTypes_id`) REFERENCES `ClaimScopeRoomDetailsValueTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimScopeRoomDetailsValueTypesI18n` */

insert  into `ClaimScopeRoomDetailsValueTypesI18n`(`ClaimScopeRoomDetailsValueTypes_id`,`locale`,`valueType`) values (1,'en_US','size'),(2,'en_US','R'),(3,'en_US','SF');

/*Table structure for table `ClaimScopeRooms` */

DROP TABLE IF EXISTS `ClaimScopeRooms`;

CREATE TABLE `ClaimScopeRooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClaimScopes_id` int(11) DEFAULT NULL,
  `RoomTypes_id` int(11) DEFAULT NULL,
  `length` float DEFAULT NULL,
  `width` float DEFAULT NULL,
  `roomTag` varchar(10) DEFAULT NULL COMMENT 'used by contents 101, 102, 102b..',
  PRIMARY KEY (`id`),
  KEY `ClaimScopes_ClaimScopesRooms_idx` (`ClaimScopes_id`),
  KEY `ClaimScopeRooms_RoomTypes_idx` (`RoomTypes_id`),
  CONSTRAINT `ClaimScopeRooms_RoomTypes` FOREIGN KEY (`RoomTypes_id`) REFERENCES `RoomTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimScopes_ClaimScopesRooms` FOREIGN KEY (`ClaimScopes_id`) REFERENCES `ClaimScopes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimScopeRooms` */

/*Table structure for table `ClaimScopes` */

DROP TABLE IF EXISTS `ClaimScopes`;

CREATE TABLE `ClaimScopes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ScopeRequests_id` int(11) DEFAULT NULL,
  `ScopeTypes_id` int(11) DEFAULT NULL,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `dateCreated` date DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimScopes_Claims_idx` (`Claims_id`),
  KEY `ClaimScopes_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `ScopeRequests_ClaimScopes_idx` (`ScopeTypes_id`),
  CONSTRAINT `ClaimScopes_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimScopes_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopeRequests_ClaimScopes` FOREIGN KEY (`ScopeTypes_id`) REFERENCES `ScopeTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimScopes` */

/*Table structure for table `ClaimStatusTypes` */

DROP TABLE IF EXISTS `ClaimStatusTypes`;

CREATE TABLE `ClaimStatusTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `ClaimStatusTypes` */

insert  into `ClaimStatusTypes`(`id`,`status`,`score`) values (1,'In Progress',2),(2,'Complete',0),(3,'On Hold',3),(4,'Delayed',4);

/*Table structure for table `ClaimTypes` */

DROP TABLE IF EXISTS `ClaimTypes`;

CREATE TABLE `ClaimTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `ClaimTypes` */

insert  into `ClaimTypes`(`id`,`dateModified`) values (1,'2014-10-10 15:56:33'),(2,'2014-10-10 15:56:33'),(3,'2014-10-10 15:56:41');

/*Table structure for table `ClaimTypesI18n` */

DROP TABLE IF EXISTS `ClaimTypesI18n`;

CREATE TABLE `ClaimTypesI18n` (
  `ClaimTypes_id` int(11) DEFAULT NULL,
  `typeOfClaim` varchar(45) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  UNIQUE KEY `ClaimTypes_id_locale_UNIQUE` (`ClaimTypes_id`,`locale`),
  KEY `ClaimTypesI18n_ClaimTypes_idx` (`ClaimTypes_id`),
  CONSTRAINT `ClaimTypesI18n_ClaimTypes` FOREIGN KEY (`ClaimTypes_id`) REFERENCES `ClaimTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimTypesI18n` */

insert  into `ClaimTypesI18n`(`ClaimTypes_id`,`typeOfClaim`,`locale`) values (2,'Fire Damage','en_US'),(1,'Water Damage','en_US'),(3,'Vehicle Impact','en_US');

/*Table structure for table `ClaimVisits` */

DROP TABLE IF EXISTS `ClaimVisits`;

CREATE TABLE `ClaimVisits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `visitDate` date DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `LocationVisits_Staff_idx` (`Staff_id`),
  KEY `LocationVisits_Claims_idx` (`Claims_id`),
  CONSTRAINT `ClaimVisits_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimVisits_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimVisits` */

/*Table structure for table `Claims` */

DROP TABLE IF EXISTS `Claims`;

CREATE TABLE `Claims` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `claimNumber` varchar(11) DEFAULT NULL,
  `Branches_id` int(11) DEFAULT NULL,
  `initialPhaseId` int(11) DEFAULT NULL,
  `estimatedRevenue` float DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `anticipatedInvDate` date DEFAULT NULL,
  `matchBid` tinyint(1) DEFAULT NULL,
  `bidAmount` float DEFAULT NULL,
  `sourceUnitClaimsLocations_id` int(11) DEFAULT NULL,
  `PropertyManagers_id` int(11) DEFAULT NULL,
  `InsuranceAdjusters_id` int(11) DEFAULT NULL,
  `deductable` tinyint(1) DEFAULT NULL,
  `policyNumber` varchar(25) DEFAULT NULL,
  `source` varchar(45) DEFAULT NULL,
  `buildingAge` int(11) DEFAULT NULL,
  `ClaimTypes_id` int(11) DEFAULT NULL,
  `ClaimTypes_other` varchar(45) DEFAULT NULL,
  `asbestosTest` tinyint(1) DEFAULT NULL,
  `fileNumber` varchar(45) DEFAULT NULL,
  `dateReceived` date DEFAULT NULL,
  `timeCalledIn` char(5) DEFAULT NULL,
  `am` tinyint(1) DEFAULT NULL,
  `timeArrivedOnSite` char(8) DEFAULT NULL,
  `receivedByStaffId` int(11) DEFAULT NULL,
  `workAuthorizationReceiveDate` date DEFAULT NULL,
  `calledInBy` varchar(45) DEFAULT NULL,
  `InsuranceCategories_id` int(11) DEFAULT NULL,
  `ProjectAddresses_id` int(11) DEFAULT NULL,
  `OnCallCallInstances_id` int(11) DEFAULT NULL,
  `parentClaims_id` int(11) DEFAULT NULL,
  `leadTechnicialStaff_id` int(11) DEFAULT NULL,
  `projectManager_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Claims_ProjectAddresses_idx` (`ProjectAddresses_id`),
  KEY `Claims_ClaimTypes_idx` (`ClaimTypes_id`),
  KEY `Claims_OnCallCallInstances_idx` (`OnCallCallInstances_id`),
  KEY `Claims_SourceUnitClaimsLocations_idx` (`sourceUnitClaimsLocations_id`),
  KEY `Claims_ReceiveByStaff_idx` (`receivedByStaffId`),
  KEY `Claims_InsuranceTypes_idx` (`InsuranceCategories_id`),
  KEY `Claims_LeatTechStaff_idx` (`leadTechnicialStaff_id`),
  KEY `Claims_InsuranceAdjusters_idx` (`InsuranceAdjusters_id`),
  KEY `Claims_PropertyManagers_idx` (`PropertyManagers_id`),
  KEY `Claims_projectManagers` (`projectManager_id`),
  CONSTRAINT `Claims_ClaimTypes` FOREIGN KEY (`ClaimTypes_id`) REFERENCES `ClaimTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Claims_InsuranceAdjusters` FOREIGN KEY (`InsuranceAdjusters_id`) REFERENCES `Contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Claims_InsuranceCategories` FOREIGN KEY (`InsuranceCategories_id`) REFERENCES `InsuranceCategories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Claims_LeatTechStaff` FOREIGN KEY (`leadTechnicialStaff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Claims_OnCallCallInstances` FOREIGN KEY (`OnCallCallInstances_id`) REFERENCES `OnCallCallInstances` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Claims_ProjectAddresses` FOREIGN KEY (`ProjectAddresses_id`) REFERENCES `ProjectAddresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Claims_projectManagers` FOREIGN KEY (`projectManager_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Claims_PropertyManagers` FOREIGN KEY (`PropertyManagers_id`) REFERENCES `Contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Claims_ReceiveByStaff` FOREIGN KEY (`receivedByStaffId`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Claims_SourceUnitClaimsLocations` FOREIGN KEY (`sourceUnitClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `Claims` */

/*Table structure for table `ClaimsClaimTypes` */

DROP TABLE IF EXISTS `ClaimsClaimTypes`;

CREATE TABLE `ClaimsClaimTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimTypes_id` int(11) DEFAULT NULL,
  `Departments_id` int(11) DEFAULT NULL,
  `isInsurable` tinyint(1) DEFAULT NULL,
  `ClaimContacts_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimsClaimTypes_Claims_idx` (`Claims_id`),
  KEY `ClaimsClaimTypes_ClaimTypes_idx` (`ClaimTypes_id`),
  KEY `ClaimsClaimTypes_Departments_idx` (`Departments_id`),
  KEY `ClaimsClaimTypes_ClaimContacts_idx` (`ClaimContacts_id`),
  CONSTRAINT `ClaimsClaimTypes_ClaimContacts` FOREIGN KEY (`ClaimContacts_id`) REFERENCES `ClaimsContacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsClaimTypes_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsClaimTypes_ClaimTypes` FOREIGN KEY (`ClaimTypes_id`) REFERENCES `ClaimTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsClaimTypes_Departments` FOREIGN KEY (`Departments_id`) REFERENCES `Departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsClaimTypes` */

/*Table structure for table `ClaimsContacts` */

DROP TABLE IF EXISTS `ClaimsContacts`;

CREATE TABLE `ClaimsContacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `ContactTypes_id` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `ManagementFirms_id` int(11) DEFAULT NULL,
  `InsuranceBrokers_id` int(11) DEFAULT NULL,
  `ClaimContactsIndividuals_id` int(11) DEFAULT NULL COMMENT 'this is non-business contacts... tenant, landlord, etc...',
  PRIMARY KEY (`id`),
  KEY `ClaimsContacts_Claims_idx` (`Claims_id`),
  KEY `ClaimsContacts_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `ClaimsContacts_ContactTypes_idx` (`ContactTypes_id`),
  KEY `ClaimsContacts_ClaimsContactIndividuals_idx` (`ClaimContactsIndividuals_id`),
  CONSTRAINT `ClaimsContacts_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsContacts_ClaimsContactIndividuals` FOREIGN KEY (`ClaimContactsIndividuals_id`) REFERENCES `Contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsContacts_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsContacts_ContactTypes` FOREIGN KEY (`ContactTypes_id`) REFERENCES `ContactTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsContacts` */

/*Table structure for table `ClaimsKeys` */

DROP TABLE IF EXISTS `ClaimsKeys`;

CREATE TABLE `ClaimsKeys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `receivedFrom` varchar(45) DEFAULT NULL,
  `returnTo` varchar(45) DEFAULT NULL,
  `KeyTypes_id` int(11) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  `isMissing` tinyint(1) DEFAULT '0',
  `photo` longblob,
  PRIMARY KEY (`id`),
  KEY `Claims_ClaimsKeys_idx` (`Claims_id`),
  KEY `KeyTypes_ClaimsKeys_idx` (`KeyTypes_id`),
  KEY `Locations_ClaimsKeys_idx` (`ClaimsLocations_id`),
  CONSTRAINT `Claims_ClaimsKeys` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `KeyTypes_ClaimsKeys` FOREIGN KEY (`KeyTypes_id`) REFERENCES `KeyTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Locations_ClaimsKeys` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsKeys` */

/*Table structure for table `ClaimsKeysIncidentDetails` */

DROP TABLE IF EXISTS `ClaimsKeysIncidentDetails`;

CREATE TABLE `ClaimsKeysIncidentDetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClaimsKeysIncidents_id` int(11) DEFAULT NULL,
  `ClaimsKeysIncidentTypes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimsKeysIncidentDetails_ClaimsKeysIncidents_idx` (`ClaimsKeysIncidents_id`),
  KEY `ClaimsKeysIncidentDetails_ClaimsKeysIncidentTypes_idx` (`ClaimsKeysIncidentTypes_id`),
  CONSTRAINT `ClaimsKeysIncidentDetails_ClaimsKeysIncidents` FOREIGN KEY (`ClaimsKeysIncidents_id`) REFERENCES `ClaimsKeysIncidents` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsKeysIncidentDetails_ClaimsKeysIncidentTypes` FOREIGN KEY (`ClaimsKeysIncidentTypes_id`) REFERENCES `ClaimsKeysIncidentTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsKeysIncidentDetails` */

/*Table structure for table `ClaimsKeysIncidentStatusTypes` */

DROP TABLE IF EXISTS `ClaimsKeysIncidentStatusTypes`;

CREATE TABLE `ClaimsKeysIncidentStatusTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `statusType` varchar(45) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsKeysIncidentStatusTypes` */

/*Table structure for table `ClaimsKeysIncidentStatuses` */

DROP TABLE IF EXISTS `ClaimsKeysIncidentStatuses`;

CREATE TABLE `ClaimsKeysIncidentStatuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClaimsKeysIncidents_id` int(11) DEFAULT NULL,
  `dateEntered` timestamp NULL DEFAULT NULL,
  `dateAddressed` date DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `notes` varchar(250) DEFAULT NULL,
  `ClaimsKeysIncidentStatusTypes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimsKeysIncidentStatuses_staff_idx` (`Staff_id`),
  KEY `ClaimsKeysIncidentStatuses_IncidentsStatusType_idx` (`ClaimsKeysIncidentStatusTypes_id`),
  CONSTRAINT `ClaimsKeysIncidentStatuses_IncidentsStatusType` FOREIGN KEY (`ClaimsKeysIncidentStatusTypes_id`) REFERENCES `ClaimsKeysIncidentStatusTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsKeysIncidentStatuses_staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsKeysIncidentStatuses` */

/*Table structure for table `ClaimsKeysIncidentTypes` */

DROP TABLE IF EXISTS `ClaimsKeysIncidentTypes`;

CREATE TABLE `ClaimsKeysIncidentTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incident` varchar(45) DEFAULT NULL,
  `score` int(11) DEFAULT NULL COMMENT 'eg:',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsKeysIncidentTypes` */

/*Table structure for table `ClaimsKeysIncidents` */

DROP TABLE IF EXISTS `ClaimsKeysIncidents`;

CREATE TABLE `ClaimsKeysIncidents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(11) DEFAULT NULL,
  `ClaimsKeys_id` int(11) DEFAULT NULL,
  `dateEntered` timestamp NULL DEFAULT NULL,
  `notes` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimsKeysIncidents_staff_idx` (`Staff_id`),
  KEY `ClaimsKeysIncidents_ClaimsKeys_idx` (`ClaimsKeys_id`),
  CONSTRAINT `ClaimsKeysIncidents_ClaimsKeys` FOREIGN KEY (`ClaimsKeys_id`) REFERENCES `ClaimsKeys` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsKeysIncidents_staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsKeysIncidents` */

/*Table structure for table `ClaimsLocations` */

DROP TABLE IF EXISTS `ClaimsLocations`;

CREATE TABLE `ClaimsLocations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `unitNumber` varchar(10) DEFAULT NULL,
  `ProjectAddressesFloorPlans_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimsLocations_Claims_idx` (`Claims_id`),
  KEY `ClaimsLocations_FloorPlans_idx` (`ProjectAddressesFloorPlans_id`),
  CONSTRAINT `ClaimsLocations_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsLocations_FloorPlans` FOREIGN KEY (`ProjectAddressesFloorPlans_id`) REFERENCES `ProjectAddressesFloorPlans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsLocations` */

insert  into `ClaimsLocations`(`id`,`Claims_id`,`unitNumber`,`ProjectAddressesFloorPlans_id`) values (23,NULL,'23',NULL);

/*Table structure for table `ClaimsLocationsContractors` */

DROP TABLE IF EXISTS `ClaimsLocationsContractors`;

CREATE TABLE `ClaimsLocationsContractors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SubcontractorContacts_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `expectedCompletionDate` date DEFAULT NULL,
  `actualCompletionDate` date DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimsLocationsContractors_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `ClaimsLocationsContractors_SubcontractorContacts_idx` (`SubcontractorContacts_id`),
  CONSTRAINT `ClaimsLocationsContractors_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsLocationsContractors_SubcontractorContacts` FOREIGN KEY (`SubcontractorContacts_id`) REFERENCES `SubcontractorContacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsLocationsContractors` */

/*Table structure for table `ClaimsLocationsDelayTypes` */

DROP TABLE IF EXISTS `ClaimsLocationsDelayTypes`;

CREATE TABLE `ClaimsLocationsDelayTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `delayType` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsLocationsDelayTypes` */

/*Table structure for table `ClaimsLocationsDelays` */

DROP TABLE IF EXISTS `ClaimsLocationsDelays`;

CREATE TABLE `ClaimsLocationsDelays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `ClaimsLocationsDelayTypes_id` int(11) DEFAULT NULL,
  `delayDate` date DEFAULT NULL,
  `approximateRecoveryDate` date DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimsLocationsDelays_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `ClaimsLocationsDelays_ClaimsLocationsDelayTypes_idx` (`ClaimsLocationsDelayTypes_id`),
  CONSTRAINT `ClaimsLocationsDelays_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsLocationsDelays_ClaimsLocationsDelayTypes` FOREIGN KEY (`ClaimsLocationsDelayTypes_id`) REFERENCES `ClaimsLocationsDelayTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsLocationsDelays` */

/*Table structure for table `ClaimsLocationsSamples` */

DROP TABLE IF EXISTS `ClaimsLocationsSamples`;

CREATE TABLE `ClaimsLocationsSamples` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `Locations_id` int(11) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `dateTaken` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ClaimsLocationsSamples_claims` (`Claims_id`),
  KEY `ClaimsLocationsSamples_locations` (`Locations_id`),
  KEY `ClaimsLocationsSamples_staff` (`Staff_id`),
  CONSTRAINT `ClaimsLocationsSamples_claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`),
  CONSTRAINT `ClaimsLocationsSamples_locations` FOREIGN KEY (`Locations_id`) REFERENCES `ClaimsLocations` (`id`),
  CONSTRAINT `ClaimsLocationsSamples_staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsLocationsSamples` */

/*Table structure for table `ClaimsLocationsSamplesItems` */

DROP TABLE IF EXISTS `ClaimsLocationsSamplesItems`;

CREATE TABLE `ClaimsLocationsSamplesItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClaimsLocationsSamples_id` int(11) DEFAULT NULL,
  `Samples_id` int(11) DEFAULT NULL,
  `other` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `LocationsSamplesItems_ClaimsSamples` (`ClaimsLocationsSamples_id`),
  KEY `LocationsSamplesItems_Samples` (`Samples_id`),
  CONSTRAINT `LocationsSamplesItems_ClaimsSamples` FOREIGN KEY (`ClaimsLocationsSamples_id`) REFERENCES `ClaimsLocationsSamples` (`id`),
  CONSTRAINT `LocationsSamplesItems_Samples` FOREIGN KEY (`Samples_id`) REFERENCES `Samples` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsLocationsSamplesItems` */

/*Table structure for table `ClaimsLocationsWorkPhases` */

DROP TABLE IF EXISTS `ClaimsLocationsWorkPhases`;

CREATE TABLE `ClaimsLocationsWorkPhases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `ClaimsPhases_id` int(11) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimsLocationsWorkPhases_ClaimPhases_idx` (`ClaimsPhases_id`),
  KEY `ClaimsLocationsWorkPhases_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `ClaimsLocationsWorkPhases_Staff_idx` (`Staff_id`),
  CONSTRAINT `ClaimsLocationsWorkPhases_ClaimPhases` FOREIGN KEY (`ClaimsPhases_id`) REFERENCES `ClaimPhases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsLocationsWorkPhases_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsLocationsWorkPhases_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsLocationsWorkPhases` */

/*Table structure for table `ClaimsPhasesHistory` */

DROP TABLE IF EXISTS `ClaimsPhasesHistory`;

CREATE TABLE `ClaimsPhasesHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimPhases_id` int(11) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL COMMENT 'staff_id is for which person entered this information',
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimsPhasesHistory_Claims_idx` (`Claims_id`),
  KEY `ClaimsPhasesHistory_ClaimsPhases_idx` (`ClaimPhases_id`),
  KEY `ClaimsPhasesHistory_Staff_idx` (`Staff_id`),
  CONSTRAINT `ClaimsPhasesHistory_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsPhasesHistory_ClaimsPhases` FOREIGN KEY (`ClaimPhases_id`) REFERENCES `ClaimPhases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsPhasesHistory_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsPhasesHistory` */

/*Table structure for table `ClaimsScheduling` */

DROP TABLE IF EXISTS `ClaimsScheduling`;

CREATE TABLE `ClaimsScheduling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `StatusTypes_id` int(11) DEFAULT NULL,
  `notes` varchar(300) DEFAULT NULL,
  `goDate` date DEFAULT NULL,
  `SupervisorStaff_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimsScheduling_Claims` (`Claims_id`),
  KEY `ClaimsScheduling_ClaimsLocations` (`ClaimsLocations_id`),
  KEY `ClaimsScheduling_Staff` (`SupervisorStaff_id`),
  CONSTRAINT `ClaimsScheduling_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`),
  CONSTRAINT `ClaimsScheduling_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`),
  CONSTRAINT `ClaimsScheduling_Staff` FOREIGN KEY (`SupervisorStaff_id`) REFERENCES `Staff` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsScheduling` */

/*Table structure for table `ClaimsSchedulingTasks` */

DROP TABLE IF EXISTS `ClaimsSchedulingTasks`;

CREATE TABLE `ClaimsSchedulingTasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClaimsSchedling_id` int(11) DEFAULT NULL,
  `WorkOrderDetails_id` int(11) DEFAULT NULL,
  `SubContractors_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimsSchedulingTasks_Claims` (`ClaimsSchedling_id`),
  KEY `ClaimsSchedulingTasks_WorkDetails` (`WorkOrderDetails_id`),
  KEY `ClaimsSchedulingTasks_Subcobtractors` (`SubContractors_id`),
  CONSTRAINT `ClaimsSchedulingTasks_Claims` FOREIGN KEY (`ClaimsSchedling_id`) REFERENCES `ClaimsScheduling` (`id`),
  CONSTRAINT `ClaimsSchedulingTasks_Subcobtractors` FOREIGN KEY (`SubContractors_id`) REFERENCES `Subcontractors` (`id`),
  CONSTRAINT `ClaimsSchedulingTasks_WorkDetails` FOREIGN KEY (`WorkOrderDetails_id`) REFERENCES `WorkOrderDetails` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsSchedulingTasks` */

/*Table structure for table `ClaimsStaff` */

DROP TABLE IF EXISTS `ClaimsStaff`;

CREATE TABLE `ClaimsStaff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(11) DEFAULT NULL,
  `Clams_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Staff_ClaimsStaff_idx` (`Staff_id`),
  KEY `Claims_ClaimsStaff_idx` (`Clams_id`),
  CONSTRAINT `Claims_ClaimsStaff` FOREIGN KEY (`Clams_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Staff_ClaimsStaff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsStaff` */

/*Table structure for table `ClaimsStatuses` */

DROP TABLE IF EXISTS `ClaimsStatuses`;

CREATE TABLE `ClaimsStatuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClaimStatusTypes_id` int(11) DEFAULT NULL,
  `Claims_id` int(11) DEFAULT NULL,
  `dateEntered` date DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClaimsStatuses_Staff_idx` (`Staff_id`),
  KEY `ClaimsStatuses_StatusTypes_idx` (`ClaimStatusTypes_id`),
  KEY `ClaimsStatuses_Claims_idx` (`Claims_id`),
  CONSTRAINT `ClaimsStatuses_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsStatuses_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ClaimsStatuses_StatusTypes` FOREIGN KEY (`ClaimStatusTypes_id`) REFERENCES `ClaimStatusTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ClaimsStatuses` */

/*Table structure for table `CmsPages` */

DROP TABLE IF EXISTS `CmsPages`;

CREATE TABLE `CmsPages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CmsSections_id` int(11) DEFAULT NULL,
  `lastModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `priority` int(11) DEFAULT '0',
  `permalink` varchar(200) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `summary` varchar(500) DEFAULT NULL,
  `isPublic` tinyint(1) DEFAULT NULL,
  `revision` int(11) DEFAULT '1',
  `isPublished` tinyint(1) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `CmsPages_CmsCategories_idx` (`CmsSections_id`),
  KEY `CmsPages_Staff_idx` (`Staff_id`),
  CONSTRAINT `CmsPages_CmsSections` FOREIGN KEY (`CmsSections_id`) REFERENCES `CmsSections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CmsPages_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `CmsPages` */

insert  into `CmsPages`(`id`,`CmsSections_id`,`lastModified`,`priority`,`permalink`,`Staff_id`,`summary`,`isPublic`,`revision`,`isPublished`,`isActive`) values (1,NULL,'2014-11-04 22:20:49',0,'qwe',2,'',1,0,1,1),(2,NULL,'2014-11-04 19:33:51',0,NULL,2,NULL,NULL,1,NULL,1),(3,NULL,'2014-11-04 22:41:07',0,NULL,2,NULL,NULL,1,NULL,1),(4,NULL,'2014-11-04 22:41:16',0,NULL,2,NULL,NULL,1,NULL,1),(5,NULL,'2014-11-04 22:41:48',0,NULL,2,NULL,NULL,1,NULL,1);

/*Table structure for table `CmsPagesI18n` */

DROP TABLE IF EXISTS `CmsPagesI18n`;

CREATE TABLE `CmsPagesI18n` (
  `CmsPages_id` int(11) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `content` text,
  `preview` text COMMENT 'this is the editable column where content is updated - once it''s published we move it to the content column for public viewing',
  `metaTitle` varchar(255) DEFAULT NULL,
  `metaDescription` varchar(255) DEFAULT NULL,
  UNIQUE KEY `CmsPagesI18n_id_locale` (`CmsPages_id`,`locale`),
  KEY `CmsPagesI18n_CmsPages_idx` (`CmsPages_id`),
  CONSTRAINT `CmsPagesI18n_CmsPages` FOREIGN KEY (`CmsPages_id`) REFERENCES `CmsPages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `CmsPagesI18n` */

insert  into `CmsPagesI18n`(`CmsPages_id`,`locale`,`content`,`preview`,`metaTitle`,`metaDescription`) values (1,'en_US','<p>this is a test - and even more</p>\r\n',NULL,NULL,NULL);

/*Table structure for table `CmsSections` */

DROP TABLE IF EXISTS `CmsSections`;

CREATE TABLE `CmsSections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `priority` int(11) DEFAULT '0',
  `slug` varchar(45) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `CmsSections` */

insert  into `CmsSections`(`id`,`lastModified`,`priority`,`slug`,`description`) values (1,'2014-11-04 23:33:58',NULL,NULL,NULL),(2,'2014-11-04 23:34:19',NULL,NULL,NULL),(3,'2014-11-04 23:36:57',NULL,NULL,NULL),(4,'2014-11-04 23:38:12',NULL,NULL,NULL),(5,'2014-11-04 23:40:38',NULL,NULL,NULL),(7,'2014-11-04 23:48:28',0,'qe','qwe'),(8,'2014-11-05 00:21:53',0,'qqq','qqq'),(9,'2014-11-05 00:25:10',0,'w','w'),(10,'2014-11-05 00:25:32',0,'w','w'),(11,'2014-11-05 00:26:02',0,'w','w'),(12,'2014-11-05 00:26:36',0,'qwe','qwe'),(13,'2014-11-05 00:30:21',0,'qwe','qwe'),(14,'2014-11-05 00:33:07',0,'qwe','qwe'),(15,'2014-11-05 00:33:23',0,'qwe','qwe');

/*Table structure for table `CmsSectionsI18n` */

DROP TABLE IF EXISTS `CmsSectionsI18n`;

CREATE TABLE `CmsSectionsI18n` (
  `CmsSections_id` int(11) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  KEY `CmsSectionsI18n_CmsSections_idx` (`CmsSections_id`),
  CONSTRAINT `CmsSectionsI18n_CmsSections` FOREIGN KEY (`CmsSections_id`) REFERENCES `CmsSections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `CmsSectionsI18n` */

insert  into `CmsSectionsI18n`(`CmsSections_id`,`locale`,`name`) values (7,'en_US','qqwe'),(8,'en_US','qqq'),(9,'en_US','w'),(10,'en_US','w'),(11,'en_US','w'),(12,'en_US','qwe'),(13,'en_US','qwe'),(14,'en_US','qwe'),(15,'en_US','qwe');

/*Table structure for table `Companies` */

DROP TABLE IF EXISTS `Companies`;

CREATE TABLE `Companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CompanyTypes_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `Provinces_id` int(11) DEFAULT NULL,
  `Countries_id` int(11) DEFAULT NULL,
  `postalCode` varchar(10) DEFAULT NULL,
  `telephone` varchar(12) DEFAULT NULL,
  `fax` varchar(12) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Companies_CompanyTypes_idx` (`CompanyTypes_id`),
  KEY `Companies_Provinces_idx` (`Provinces_id`),
  KEY `Companies_Countries_idx` (`Countries_id`),
  CONSTRAINT `Companies_CompanyTypes` FOREIGN KEY (`CompanyTypes_id`) REFERENCES `CompanyTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Companies_Countries` FOREIGN KEY (`Countries_id`) REFERENCES `Countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Companies_Provinces` FOREIGN KEY (`Provinces_id`) REFERENCES `Provinces` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `Companies` */

insert  into `Companies`(`id`,`CompanyTypes_id`,`name`,`address1`,`address2`,`city`,`Provinces_id`,`Countries_id`,`postalCode`,`telephone`,`fax`,`url`) values (1,NULL,'phoenix restorations','heere',NULL,'coquitlam',NULL,NULL,'v4v4v4','123','123','www.test.com');

/*Table structure for table `CompanyTypes` */

DROP TABLE IF EXISTS `CompanyTypes`;

CREATE TABLE `CompanyTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `CompanyTypes` */

/*Table structure for table `CompanyTypesI18n` */

DROP TABLE IF EXISTS `CompanyTypesI18n`;

CREATE TABLE `CompanyTypesI18n` (
  `CompanyTypes_id` int(11) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  KEY `CompanyTypesI18n_CompanyTypes_idx` (`CompanyTypes_id`),
  CONSTRAINT `CompanyTypesI18n_CompanyTypes` FOREIGN KEY (`CompanyTypes_id`) REFERENCES `CompanyTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `CompanyTypesI18n` */

/*Table structure for table `ComplaintNotes` */

DROP TABLE IF EXISTS `ComplaintNotes`;

CREATE TABLE `ComplaintNotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Complaints_id` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `damageCost` float DEFAULT NULL,
  `dateEntered` date DEFAULT NULL,
  `UrgencyTypes_id` int(11) DEFAULT NULL,
  `ComplaintTypes_id` int(11) DEFAULT NULL,
  `ComplaintStatuses_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ComplaintNotes_Complaints_idx` (`Complaints_id`),
  KEY `ComplaintNotes_ComplaintTypes_idx` (`ComplaintTypes_id`),
  KEY `ComplaintNotes_UrgencyTypes_idx` (`UrgencyTypes_id`),
  KEY `ComplaintNotes_ComplaintStatuses_idx` (`ComplaintStatuses_id`),
  CONSTRAINT `ComplaintNotes_Complaints` FOREIGN KEY (`Complaints_id`) REFERENCES `Complaints` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ComplaintNotes_ComplaintStatuses` FOREIGN KEY (`ComplaintStatuses_id`) REFERENCES `ComplaintStatuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ComplaintNotes_ComplaintTypes` FOREIGN KEY (`ComplaintTypes_id`) REFERENCES `ComplaintTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ComplaintNotes_UrgencyTypes` FOREIGN KEY (`UrgencyTypes_id`) REFERENCES `UrgencyTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ComplaintNotes` */

/*Table structure for table `ComplaintStatuses` */

DROP TABLE IF EXISTS `ComplaintStatuses`;

CREATE TABLE `ComplaintStatuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ComplaintStatuses` */

/*Table structure for table `ComplaintStatusesI18n` */

DROP TABLE IF EXISTS `ComplaintStatusesI18n`;

CREATE TABLE `ComplaintStatusesI18n` (
  `ComplaintStatuses_id` int(11) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  UNIQUE KEY `locale_UNIQUE` (`locale`),
  UNIQUE KEY `ComplaintStatuses_id_UNIQUE` (`ComplaintStatuses_id`),
  CONSTRAINT `ComplaintStatusesI18n_ComplaintStatuses` FOREIGN KEY (`ComplaintStatuses_id`) REFERENCES `ComplaintStatuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ComplaintStatusesI18n` */

/*Table structure for table `ComplaintTypes` */

DROP TABLE IF EXISTS `ComplaintTypes`;

CREATE TABLE `ComplaintTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ComplaintTypes` */

/*Table structure for table `ComplaintTypesI18n` */

DROP TABLE IF EXISTS `ComplaintTypesI18n`;

CREATE TABLE `ComplaintTypesI18n` (
  `ComplaintTypes_id` int(11) DEFAULT NULL,
  `complaintType` varchar(45) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  UNIQUE KEY `ComplaintTypes_id_UNIQUE` (`ComplaintTypes_id`),
  UNIQUE KEY `locale_UNIQUE` (`locale`),
  CONSTRAINT `ComplaintTypesI18n_ComplaintTypes` FOREIGN KEY (`ComplaintTypes_id`) REFERENCES `ComplaintTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ComplaintTypesI18n` */

/*Table structure for table `Complaints` */

DROP TABLE IF EXISTS `Complaints`;

CREATE TABLE `Complaints` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receivedByStaff_id` int(11) DEFAULT NULL,
  `receivedDate` date DEFAULT NULL,
  `ClaimsContacts_id` int(11) DEFAULT NULL,
  `otherComplainant` varchar(45) DEFAULT NULL,
  `telephone` varchar(12) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `Claims_id` int(11) DEFAULT NULL,
  `ComplaintsStatuses_id` int(11) DEFAULT NULL,
  `ManagementFirms_id` int(11) DEFAULT NULL,
  `assignedStaff_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Complaints_Staff_idx` (`receivedByStaff_id`),
  KEY `Complaints_ClaimsContacts_idx` (`ClaimsContacts_id`),
  KEY `Complaints_Claims_idx` (`Claims_id`),
  KEY `Complaints_ComplaintStatuses_idx` (`ComplaintsStatuses_id`),
  KEY `Complaints_AssignedStaff_idx` (`assignedStaff_id`),
  KEY `Complaints_ClaimsLocations_idx` (`ClaimsLocations_id`),
  CONSTRAINT `Complaints_AssignedStaff` FOREIGN KEY (`assignedStaff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Complaints_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Complaints_ClaimsContacts` FOREIGN KEY (`ClaimsContacts_id`) REFERENCES `ClaimsContacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Complaints_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Complaints_ComplaintStatuses` FOREIGN KEY (`ComplaintsStatuses_id`) REFERENCES `ComplaintStatuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Complaints_Staff` FOREIGN KEY (`receivedByStaff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `Complaints` */

/*Table structure for table `ComplaintsContactList` */

DROP TABLE IF EXISTS `ComplaintsContactList`;

CREATE TABLE `ComplaintsContactList` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Complaints_id` int(11) DEFAULT NULL,
  `ClaimsContact_id` int(11) DEFAULT NULL,
  `ComplaintsContactTypes_id` int(11) DEFAULT NULL,
  `attachReason` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ComplaintsContactList_Complaints_idx` (`Complaints_id`),
  KEY `ComplaintsContactList_ClaimsContacts_idx` (`ClaimsContact_id`),
  KEY `ComplaintsContactList_ComplaintsContactTypes_idx` (`ComplaintsContactTypes_id`),
  CONSTRAINT `ComplaintsContactList_ClaimsContacts` FOREIGN KEY (`ClaimsContact_id`) REFERENCES `ClaimsContacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ComplaintsContactList_Complaints` FOREIGN KEY (`Complaints_id`) REFERENCES `Complaints` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ComplaintsContactList_ComplaintsContactTypes` FOREIGN KEY (`ComplaintsContactTypes_id`) REFERENCES `ComplaintsContactTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ComplaintsContactList` */

/*Table structure for table `ComplaintsContactTypes` */

DROP TABLE IF EXISTS `ComplaintsContactTypes`;

CREATE TABLE `ComplaintsContactTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contactType` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ComplaintsContactTypes` */

/*Table structure for table `ContactAccessLogs` */

DROP TABLE IF EXISTS `ContactAccessLogs`;

CREATE TABLE `ContactAccessLogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Contacts_id` int(11) DEFAULT NULL,
  `ipAddress` varchar(15) DEFAULT NULL,
  `accessDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ContactAccessLogs_Contacts_idx` (`Contacts_id`),
  CONSTRAINT `ContactAccessLogs_Contacts` FOREIGN KEY (`Contacts_id`) REFERENCES `Contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContactAccessLogs` */

/*Table structure for table `ContactAuthorizations` */

DROP TABLE IF EXISTS `ContactAuthorizations`;

CREATE TABLE `ContactAuthorizations` (
  `id` int(11) NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `passwordHistory` varchar(300) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `lastModified` timestamp NULL DEFAULT NULL,
  `Contacts_id` int(11) DEFAULT NULL,
  `roles` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UserAuthorizations_username_unique` (`username`),
  KEY `UserAuthorizations_Contacts_idx` (`Contacts_id`),
  CONSTRAINT `ContactAuthorizations_Contacts` FOREIGN KEY (`Contacts_id`) REFERENCES `Contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContactAuthorizations` */

insert  into `ContactAuthorizations`(`id`,`username`,`password`,`passwordHistory`,`status`,`lastModified`,`Contacts_id`,`roles`) values (0,'q','$1$JEt2g2JS$bzzNiIu4XD0HLQKLwEq.P/','$1$JEt2g2JS$bzzNiIu4XD0HLQKLwEq.P/','active',NULL,39,'IS_MANAGER|IS_CLIENT|IS_CUSTOMER_SERVICE');

/*Table structure for table `ContactTypes` */

DROP TABLE IF EXISTS `ContactTypes`;

CREATE TABLE `ContactTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `ContactTypes` */

insert  into `ContactTypes`(`id`,`dateModified`) values (1,'2014-10-09 14:16:05'),(2,'2014-10-09 14:16:27'),(3,'2014-10-09 14:23:21'),(4,'2014-10-09 14:23:25'),(5,'2014-10-09 14:24:24'),(6,'2014-10-09 14:24:26'),(7,'2014-10-09 15:42:16'),(8,'2014-10-09 15:42:17'),(9,'2014-10-09 15:42:18'),(10,'2014-10-09 15:48:37'),(11,'2014-10-09 15:48:38'),(12,'2014-10-09 15:48:40');

/*Table structure for table `ContactTypesI18n` */

DROP TABLE IF EXISTS `ContactTypesI18n`;

CREATE TABLE `ContactTypesI18n` (
  `ContactTypes_id` int(11) DEFAULT NULL,
  `contactType` varchar(45) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  UNIQUE KEY `ContactTypes_id_locale_UNIQUE` (`locale`,`ContactTypes_id`),
  KEY `ContactTypesI18n_ContactTypes` (`ContactTypes_id`),
  CONSTRAINT `ContactTypesI18n_ContactTypes` FOREIGN KEY (`ContactTypes_id`) REFERENCES `ContactTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContactTypesI18n` */

insert  into `ContactTypesI18n`(`ContactTypes_id`,`contactType`,`locale`) values (1,'Insurance Company','en_US'),(2,'Property Management','en_US'),(3,'Building Management','en_US'),(4,'Strata','en_US'),(5,'Broker','en_US'),(6,'Adjuster','en_US'),(7,'Insurer','en_US'),(8,'Property Owner',NULL),(9,'Tenant / Customer',NULL);

/*Table structure for table `Contacts` */

DROP TABLE IF EXISTS `Contacts`;

CREATE TABLE `Contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Companies_id` int(11) DEFAULT NULL,
  `ContactTypes_id` int(11) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `home` varchar(12) DEFAULT NULL,
  `office` varchar(12) DEFAULT NULL,
  `extension` varchar(12) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Contacts_ContactYpes_idx` (`ContactTypes_id`),
  CONSTRAINT `Contacts_ContactTypes` FOREIGN KEY (`ContactTypes_id`) REFERENCES `ContactTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

/*Data for the table `Contacts` */

insert  into `Contacts`(`id`,`Companies_id`,`ContactTypes_id`,`firstname`,`lastname`,`email`,`mobile`,`home`,`office`,`extension`,`isActive`) values (39,0,NULL,'q','q','q','q','qwe','q','q',NULL);

/*Table structure for table `ContactsAuthorizationTokens` */

DROP TABLE IF EXISTS `ContactsAuthorizationTokens`;

CREATE TABLE `ContactsAuthorizationTokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `decayTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipAddress` char(15) DEFAULT NULL,
  `Contacts_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `UserAuthorizationTokens_Contacts_idx` (`Contacts_id`),
  CONSTRAINT `UserAuthorizationTokens_Contacts` FOREIGN KEY (`Contacts_id`) REFERENCES `Contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContactsAuthorizationTokens` */

/*Table structure for table `ContentLosses` */

DROP TABLE IF EXISTS `ContentLosses`;

CREATE TABLE `ContentLosses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ContentPackagesItems_id` int(11) DEFAULT NULL,
  `photo` longblob,
  `lossDate` date DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ContentLosses_ContentPackagesItems_idx` (`ContentPackagesItems_id`),
  KEY `ContentLosses_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `ContentLosses_Staff_idx` (`Staff_id`),
  CONSTRAINT `ContentLosses_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentLosses_ContentPackagesItems` FOREIGN KEY (`ContentPackagesItems_id`) REFERENCES `ContentPackagesItems` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentLosses_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentLosses` */

/*Table structure for table `ContentPackages` */

DROP TABLE IF EXISTS `ContentPackages`;

CREATE TABLE `ContentPackages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ContentProcessing_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `ClaimScopeRooms_id` int(11) DEFAULT NULL,
  `ContentPackageTypes_id` int(11) DEFAULT NULL,
  `PackedByStaff_id` int(11) DEFAULT NULL,
  `isFragile` tinyint(1) DEFAULT NULL,
  `specialInstructions` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ContentBoxes_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `ContentBoxes_ClaimScopeRooms_idx` (`ClaimScopeRooms_id`),
  KEY `ContentBoxes_Staff_idx` (`PackedByStaff_id`),
  KEY `ContentPackages_ContentPackageTypes_idx` (`ContentPackageTypes_id`),
  KEY `ContentPackages_ContentProcessing_idx` (`ContentProcessing_id`),
  CONSTRAINT `ContentPackages_ClaimScopeRooms` FOREIGN KEY (`ClaimScopeRooms_id`) REFERENCES `ClaimScopeRooms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentPackages_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentPackages_ContentPackageTypes` FOREIGN KEY (`ContentPackageTypes_id`) REFERENCES `ContentsPackageTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentPackages_ContentProcessing` FOREIGN KEY (`ContentProcessing_id`) REFERENCES `ContentProcessing` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentPackages_Staff` FOREIGN KEY (`PackedByStaff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentPackages` */

/*Table structure for table `ContentPackagesItems` */

DROP TABLE IF EXISTS `ContentPackagesItems`;

CREATE TABLE `ContentPackagesItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ContentProcessingItems_id` int(11) DEFAULT NULL,
  `manualDescription` varchar(100) DEFAULT NULL,
  `ContentsPackageTypes_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `ContentPackages_id` int(11) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ContentBoxesItems_ContentsPackageTypes_idx` (`ContentsPackageTypes_id`),
  KEY `ContentBoxesItems_ContentProcessingItems_idx` (`ContentProcessingItems_id`),
  KEY `ContentBoxesItems_ContentBoxes_idx` (`ContentPackages_id`),
  CONSTRAINT `ContentPackagesItems_ContentBoxes` FOREIGN KEY (`ContentPackages_id`) REFERENCES `ContentPackages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentPackagesItems_ContentProcessingItems` FOREIGN KEY (`ContentProcessingItems_id`) REFERENCES `ContentProcessingItems` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentPackagesItems_ContentsPackageTypes` FOREIGN KEY (`ContentsPackageTypes_id`) REFERENCES `ContentsPackageTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentPackagesItems` */

/*Table structure for table `ContentPackagesWarehouseLocations` */

DROP TABLE IF EXISTS `ContentPackagesWarehouseLocations`;

CREATE TABLE `ContentPackagesWarehouseLocations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ContentPackages_id` int(11) DEFAULT NULL,
  `WarehouseLocations_id` int(11) DEFAULT NULL,
  `datePlaced` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ContentPackagesWarehouseLocations_Packages_idx` (`ContentPackages_id`),
  KEY `ContentPackagesWarehouseLocations_locations_idx` (`WarehouseLocations_id`),
  CONSTRAINT `ContentPackagesWarehouseLocations_locations` FOREIGN KEY (`WarehouseLocations_id`) REFERENCES `WarehouseLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentPackagesWarehouseLocations_Packages` FOREIGN KEY (`ContentPackages_id`) REFERENCES `ContentPackages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentPackagesWarehouseLocations` */

/*Table structure for table `ContentProcessing` */

DROP TABLE IF EXISTS `ContentProcessing`;

CREATE TABLE `ContentProcessing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `supervisorStaff_id` int(11) DEFAULT NULL,
  `ContentProcessingTypes_id` int(11) DEFAULT NULL,
  `issuedDate` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ContentProcessing_ContentProcessingTypes_idx` (`ContentProcessingTypes_id`),
  KEY `ContentProcessing_Staff_idx` (`supervisorStaff_id`),
  KEY `ContentProcessing_Claims_idx` (`Claims_id`),
  CONSTRAINT `ContentProcessing_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentProcessing_ContentProcessingTypes` FOREIGN KEY (`ContentProcessingTypes_id`) REFERENCES `ContentProcessingTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentProcessing_Staff` FOREIGN KEY (`supervisorStaff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentProcessing` */

/*Table structure for table `ContentProcessingActionTypes` */

DROP TABLE IF EXISTS `ContentProcessingActionTypes`;

CREATE TABLE `ContentProcessingActionTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actionType` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentProcessingActionTypes` */

/*Table structure for table `ContentProcessingActionsStaff` */

DROP TABLE IF EXISTS `ContentProcessingActionsStaff`;

CREATE TABLE `ContentProcessingActionsStaff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(11) DEFAULT NULL,
  `ContentProcessingInstances_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ContentProcessingActionsStaff_Staff_idx` (`Staff_id`),
  KEY `ContentProcessingActionsStaff_ProcessingActions_idx` (`ContentProcessingInstances_id`),
  CONSTRAINT `ContentProcessingActionsStaff_ProcessingActions` FOREIGN KEY (`ContentProcessingInstances_id`) REFERENCES `ContentProcessingInstances` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentProcessingActionsStaff_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentProcessingActionsStaff` */

/*Table structure for table `ContentProcessingInstanceItems` */

DROP TABLE IF EXISTS `ContentProcessingInstanceItems`;

CREATE TABLE `ContentProcessingInstanceItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ContentProcessingInstances_id` int(11) DEFAULT NULL,
  `ContentPackagesItems_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ContentProcessingLaundryInstanceItems_ContentProcessingLaun_idx` (`ContentProcessingInstances_id`),
  KEY `ContentProcessingLaundryInstanceItems_LaundryItems_idx` (`ContentPackagesItems_id`),
  CONSTRAINT `ContentProcessingInstanceItems_Instances` FOREIGN KEY (`ContentProcessingInstances_id`) REFERENCES `ContentProcessingInstances` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentProcessingInstanceItems_Items` FOREIGN KEY (`ContentPackagesItems_id`) REFERENCES `ContentPackagesItems` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentProcessingInstanceItems` */

/*Table structure for table `ContentProcessingInstances` */

DROP TABLE IF EXISTS `ContentProcessingInstances`;

CREATE TABLE `ContentProcessingInstances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimPhases_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `datePerformed` date DEFAULT NULL,
  `ContentProcessingActionTypes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ContentProcessingLaundryInstances_Claims_idx` (`Claims_id`),
  KEY `ContentProcessingLaundryInstances_ClaimsPhases_idx` (`ClaimPhases_id`),
  KEY `ContentProcessingLaundryInstances_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `ContentProcessingInstances_ContentProcessingTypes_idx` (`ContentProcessingActionTypes_id`),
  CONSTRAINT `ContentProcessingInstances_ContentProcessingTypes` FOREIGN KEY (`ContentProcessingActionTypes_id`) REFERENCES `ContentProcessingActionTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentProcessingLaundryInstances_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentProcessingLaundryInstances_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentProcessingLaundryInstances_ClaimsPhases` FOREIGN KEY (`ClaimPhases_id`) REFERENCES `ClaimPhases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentProcessingInstances` */

/*Table structure for table `ContentProcessingItems` */

DROP TABLE IF EXISTS `ContentProcessingItems`;

CREATE TABLE `ContentProcessingItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `defaultContentsPackageTypes_id` int(11) DEFAULT NULL,
  `isLaunderable` tinyint(1) DEFAULT NULL,
  `photo` longblob,
  PRIMARY KEY (`id`),
  KEY `ContentProcessingItems_ContentsPackageTypes_idx` (`defaultContentsPackageTypes_id`),
  CONSTRAINT `ContentProcessingItems_ContentsPackageTypes` FOREIGN KEY (`defaultContentsPackageTypes_id`) REFERENCES `ContentsPackageTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentProcessingItems` */

/*Table structure for table `ContentProcessingItemsI18n` */

DROP TABLE IF EXISTS `ContentProcessingItemsI18n`;

CREATE TABLE `ContentProcessingItemsI18n` (
  `ContentProcessingItems_id` int(11) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  KEY `ContentProcessingItemsI18n_ContentProcessingItems_idx` (`ContentProcessingItems_id`),
  CONSTRAINT `ContentProcessingItemsI18n_ContentProcessingItems` FOREIGN KEY (`ContentProcessingItems_id`) REFERENCES `ContentProcessingItems` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentProcessingItemsI18n` */

/*Table structure for table `ContentProcessingTypes` */

DROP TABLE IF EXISTS `ContentProcessingTypes`;

CREATE TABLE `ContentProcessingTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `processingType` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentProcessingTypes` */

/*Table structure for table `ContentsPackageTypes` */

DROP TABLE IF EXISTS `ContentsPackageTypes`;

CREATE TABLE `ContentsPackageTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `packageType` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentsPackageTypes` */

/*Table structure for table `ContentsShipment` */

DROP TABLE IF EXISTS `ContentsShipment`;

CREATE TABLE `ContentsShipment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Subcontractors_id` int(11) DEFAULT NULL,
  `ContentsShipmentType_id` int(11) DEFAULT NULL COMMENT 'pickup or delivery',
  `shipmentDate` date DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ContentsShipment_Subcontractors_idx` (`Subcontractors_id`),
  KEY `ContentsShipment_ContentsShipmentType_idx` (`ContentsShipmentType_id`),
  KEY `ContentsShipment_ClaimsLocations_idx` (`ClaimsLocations_id`),
  CONSTRAINT `ContentsShipment_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentsShipment_ContentsShipmentType` FOREIGN KEY (`ContentsShipmentType_id`) REFERENCES `ContentsShipmentType` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentsShipment_Subcontractors` FOREIGN KEY (`Subcontractors_id`) REFERENCES `Subcontractors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentsShipment` */

/*Table structure for table `ContentsShipmentPackages` */

DROP TABLE IF EXISTS `ContentsShipmentPackages`;

CREATE TABLE `ContentsShipmentPackages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ContentsShipment_id` int(11) DEFAULT NULL,
  `ContentPackages_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ContentsShipmentPackages_ContentsShipment_idx` (`ContentsShipment_id`),
  KEY `ContentsShipmentPackages_ContentPackages_idx` (`ContentPackages_id`),
  CONSTRAINT `ContentsShipmentPackages_ContentPackages` FOREIGN KEY (`ContentPackages_id`) REFERENCES `ContentPackages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentsShipmentPackages_ContentsShipment` FOREIGN KEY (`ContentsShipment_id`) REFERENCES `ContentsShipment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentsShipmentPackages` */

/*Table structure for table `ContentsShipmentStaff` */

DROP TABLE IF EXISTS `ContentsShipmentStaff`;

CREATE TABLE `ContentsShipmentStaff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(11) DEFAULT NULL,
  `ContentsShipment_id` int(11) DEFAULT NULL,
  `isLead` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ContentsShipmentStaff_Staff_idx` (`Staff_id`),
  KEY `ContentsShipmentStaff_ContentsShipment_idx` (`ContentsShipment_id`),
  CONSTRAINT `ContentsShipmentStaff_ContentsShipment` FOREIGN KEY (`ContentsShipment_id`) REFERENCES `ContentsShipment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ContentsShipmentStaff_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentsShipmentStaff` */

/*Table structure for table `ContentsShipmentType` */

DROP TABLE IF EXISTS `ContentsShipmentType`;

CREATE TABLE `ContentsShipmentType` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pickup from location',
  `shipmentType` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ContentsShipmentType` */

/*Table structure for table `CostCardItemCategories` */

DROP TABLE IF EXISTS `CostCardItemCategories`;

CREATE TABLE `CostCardItemCategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `CostCardItemCategories` */

/*Table structure for table `CostCardItemTypes` */

DROP TABLE IF EXISTS `CostCardItemTypes`;

CREATE TABLE `CostCardItemTypes` (
  `id` int(11) NOT NULL,
  `itemType` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `CostCardItemTypes` */

/*Table structure for table `CostCardItems` */

DROP TABLE IF EXISTS `CostCardItems`;

CREATE TABLE `CostCardItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CostCards_id` int(11) DEFAULT NULL,
  `CostCardItemTypes_id` int(11) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `datePerformed` date DEFAULT NULL,
  `ClaimPhases_id` int(11) DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `chargeOut` float DEFAULT NULL,
  `CostCardItemCategories_id` int(11) DEFAULT NULL,
  `Departments_id` int(11) DEFAULT NULL,
  `BreakDownReports_id` int(11) DEFAULT NULL,
  `details` varchar(100) DEFAULT NULL,
  `isApproved` tinyint(1) DEFAULT NULL,
  `BreakDownReportsTitles_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `CostCardItems_CostCards_idx` (`CostCards_id`),
  KEY `CostCardItems_CostCardItemypes_idx` (`CostCardItemTypes_id`),
  KEY `CostCardItems_ClaimPhases_idx` (`ClaimPhases_id`),
  KEY `CostCardItems_Departments_idx` (`Departments_id`),
  KEY `CostCardItems_BreakDownReports_idx` (`BreakDownReports_id`),
  KEY `CostCardItems_BreakDownReportsTitles_id_idx` (`BreakDownReportsTitles_id`),
  KEY `CostCardItems_Staff_idx` (`Staff_id`),
  KEY `CostCardItems_CostCardItemCategories_idx` (`CostCardItemCategories_id`),
  CONSTRAINT `CostCardItems_BreakDownReports` FOREIGN KEY (`BreakDownReports_id`) REFERENCES `BreakdownReports` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CostCardItems_BreakDownReportsTitles_id` FOREIGN KEY (`BreakDownReportsTitles_id`) REFERENCES `BreakDownReportsTitles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CostCardItems_ClaimPhases` FOREIGN KEY (`ClaimPhases_id`) REFERENCES `ClaimPhases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CostCardItems_CostCardItemCategories` FOREIGN KEY (`CostCardItemCategories_id`) REFERENCES `CostCardItemCategories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CostCardItems_CostCardItemypes` FOREIGN KEY (`CostCardItemTypes_id`) REFERENCES `CostCardItemTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CostCardItems_CostCards` FOREIGN KEY (`CostCards_id`) REFERENCES `CostCards` (`Claims_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CostCardItems_Departments` FOREIGN KEY (`Departments_id`) REFERENCES `Departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CostCardItems_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `CostCardItems` */

/*Table structure for table `CostCards` */

DROP TABLE IF EXISTS `CostCards`;

CREATE TABLE `CostCards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `CostCards_Claims_idx` (`Claims_id`),
  CONSTRAINT `CostCards_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `CostCards` */

/*Table structure for table `Countries` */

DROP TABLE IF EXISTS `Countries`;

CREATE TABLE `Countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Country` varchar(45) DEFAULT NULL,
  `abbreviation` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `Countries` */

/*Table structure for table `CustomerCallNotes` */

DROP TABLE IF EXISTS `CustomerCallNotes`;

CREATE TABLE `CustomerCallNotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerCalls_id` int(11) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `dateEntered` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `CustomerCallNotes_CustomerCalls_idx` (`CustomerCalls_id`),
  KEY `CustomerCallNotes_Staff_idx` (`Staff_id`),
  CONSTRAINT `CustomerCallNotes_CustomerCalls` FOREIGN KEY (`CustomerCalls_id`) REFERENCES `CustomerCalls` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CustomerCallNotes_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `CustomerCallNotes` */

/*Table structure for table `CustomerCalls` */

DROP TABLE IF EXISTS `CustomerCalls`;

CREATE TABLE `CustomerCalls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClaimContacts_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telephone` varchar(12) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `callTime` timestamp NULL DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `CustomerCallsStatus` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `CustomerCalls_ClaimContacts_idx` (`ClaimContacts_id`),
  KEY `CustomerCalls_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `CustomerCalls_CustomerCallsStatus_idx` (`CustomerCallsStatus`),
  CONSTRAINT `CustomerCalls_ClaimContacts` FOREIGN KEY (`ClaimContacts_id`) REFERENCES `ClaimsContacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CustomerCalls_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CustomerCalls_CustomerCallsStatus` FOREIGN KEY (`CustomerCallsStatus`) REFERENCES `CustomerCallsStatus` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `CustomerCalls` */

/*Table structure for table `CustomerCallsStaffAttentions` */

DROP TABLE IF EXISTS `CustomerCallsStaffAttentions`;

CREATE TABLE `CustomerCallsStaffAttentions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(11) DEFAULT NULL,
  `CustomerCalls_id` int(11) DEFAULT NULL,
  `dateViewed` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `CustomerCallsStaffAttentions_Staff_idx` (`Staff_id`),
  KEY `CustomerCallsStaffAttentions_CustomerCalls_idx` (`CustomerCalls_id`),
  CONSTRAINT `CustomerCallsStaffAttentions_CustomerCalls` FOREIGN KEY (`CustomerCalls_id`) REFERENCES `CustomerCalls` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `CustomerCallsStaffAttentions_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `CustomerCallsStaffAttentions` */

/*Table structure for table `CustomerCallsStatus` */

DROP TABLE IF EXISTS `CustomerCallsStatus`;

CREATE TABLE `CustomerCallsStatus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `CustomerCallsStatus` */

/*Table structure for table `Deficiencies` */

DROP TABLE IF EXISTS `Deficiencies`;

CREATE TABLE `Deficiencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DeficiencyTypes_id` int(11) DEFAULT NULL,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `Contacts_id` int(11) DEFAULT NULL,
  `dateNotified` date DEFAULT NULL,
  `DeficiencyStatusCodes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Deficiencies_DeficiencyTypes_idx` (`DeficiencyTypes_id`),
  KEY `Deficiencies_Claims_idx` (`Claims_id`),
  KEY `Deficiencies_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `Deficiencies_Contacts_idx` (`Contacts_id`),
  KEY `Deficiencies_DeficienyStatusCodes_idx` (`DeficiencyStatusCodes_id`),
  CONSTRAINT `Deficiencies_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Deficiencies_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Deficiencies_Contacts` FOREIGN KEY (`Contacts_id`) REFERENCES `ClaimsContacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Deficiencies_DeficiencyTypes` FOREIGN KEY (`DeficiencyTypes_id`) REFERENCES `DeficiencyTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Deficiencies_DeficienyStatusCodes` FOREIGN KEY (`DeficiencyStatusCodes_id`) REFERENCES `DeficiencyStatusCodes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `Deficiencies` */

/*Table structure for table `DeficiencyHistories` */

DROP TABLE IF EXISTS `DeficiencyHistories`;

CREATE TABLE `DeficiencyHistories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Deficiencies_id` int(11) DEFAULT NULL,
  `DeficiencyStatusCodes_id` int(11) DEFAULT NULL,
  `DeficiencyTypes_id` int(11) DEFAULT NULL,
  `entryDate` date DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `DeficiencyHistories_Deficiencies_idx` (`Deficiencies_id`),
  KEY `DeficiencyHistories_DeficiencyStatusCodes_idx` (`DeficiencyStatusCodes_id`),
  KEY `DeficiencyHistories_DeficiencyTypes_idx` (`DeficiencyTypes_id`),
  KEY `DeficiencyHistories_Staff_idx` (`Staff_id`),
  CONSTRAINT `DeficiencyHistories_Deficiencies` FOREIGN KEY (`Deficiencies_id`) REFERENCES `Deficiencies` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `DeficiencyHistories_DeficiencyStatusCodes` FOREIGN KEY (`DeficiencyStatusCodes_id`) REFERENCES `DeficiencyStatusCodes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `DeficiencyHistories_DeficiencyTypes` FOREIGN KEY (`DeficiencyTypes_id`) REFERENCES `DeficiencyTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `DeficiencyHistories_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `DeficiencyHistories` */

/*Table structure for table `DeficiencyStatusCodes` */

DROP TABLE IF EXISTS `DeficiencyStatusCodes`;

CREATE TABLE `DeficiencyStatusCodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `DeficiencyStatusCodes` */

/*Table structure for table `DeficiencyTypes` */

DROP TABLE IF EXISTS `DeficiencyTypes`;

CREATE TABLE `DeficiencyTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `deficiency` varchar(100) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `DeficiencyTypes` */

/*Table structure for table `Departments` */

DROP TABLE IF EXISTS `Departments`;

CREATE TABLE `Departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `Departments` */

insert  into `Departments`(`id`,`name`) values (1,'Accounting'),(2,'Administration'),(3,'Content Processing'),(4,'Construction'),(5,'Emergency'),(6,'Scoping');

/*Table structure for table `EquipmentTransfers` */

DROP TABLE IF EXISTS `EquipmentTransfers`;

CREATE TABLE `EquipmentTransfers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `MaterialInventories_id` int(11) DEFAULT NULL,
  `fromClaims_id` int(11) DEFAULT NULL,
  `toClaims_id` int(11) DEFAULT NULL,
  `fromClaimsLocations_id` int(11) DEFAULT NULL,
  `toClaimsLocations_id` int(11) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `transferDate` date DEFAULT NULL,
  `Vehicles_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `EquipmentTransfers_MaterialInventories_idx` (`MaterialInventories_id`),
  KEY `EquipmentTransfers_FromClaims_idx` (`fromClaims_id`),
  KEY `EquipmentTransfers_ToClaims_idx` (`toClaims_id`),
  KEY `EquipmentTransfers_FromClaimsLocations_idx` (`fromClaimsLocations_id`),
  KEY `EquipmentTransfers_ToClaimsLocations_idx` (`toClaimsLocations_id`),
  KEY `EquipmentTransfers_Staff_idx` (`Staff_id`),
  KEY `EquipmentTransfers_FromVehicles_idx` (`Vehicles_id`),
  CONSTRAINT `EquipmentTransfers_FromClaims` FOREIGN KEY (`fromClaims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `EquipmentTransfers_FromClaimsLocations` FOREIGN KEY (`fromClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `EquipmentTransfers_FromVehicles` FOREIGN KEY (`Vehicles_id`) REFERENCES `Vehicles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `EquipmentTransfers_MaterialInventories` FOREIGN KEY (`MaterialInventories_id`) REFERENCES `MaterialInventories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `EquipmentTransfers_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `EquipmentTransfers_ToClaims` FOREIGN KEY (`toClaims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `EquipmentTransfers_ToClaimsLocations` FOREIGN KEY (`toClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `EquipmentTransfers` */

/*Table structure for table `InsuranceCategories` */

DROP TABLE IF EXISTS `InsuranceCategories`;

CREATE TABLE `InsuranceCategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `insurance` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `InsuranceCategories` */

/*Table structure for table `InventoryCategories` */

DROP TABLE IF EXISTS `InventoryCategories`;

CREATE TABLE `InventoryCategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `InventoryCategories` */

/*Table structure for table `InventoryCategoriesI18n` */

DROP TABLE IF EXISTS `InventoryCategoriesI18n`;

CREATE TABLE `InventoryCategoriesI18n` (
  `InventoryCategories_id` int(11) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  UNIQUE KEY `locale_UNIQUE` (`locale`),
  UNIQUE KEY `InventoryCategories_id_UNIQUE` (`InventoryCategories_id`),
  KEY `InventoryCategoriesI18n_InventoryCategories_idx` (`InventoryCategories_id`),
  CONSTRAINT `InventoryCategoriesI18n_InventoryCategories` FOREIGN KEY (`InventoryCategories_id`) REFERENCES `InventoryCategories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `InventoryCategoriesI18n` */

/*Table structure for table `InventoryInstanceCounts` */

DROP TABLE IF EXISTS `InventoryInstanceCounts`;

CREATE TABLE `InventoryInstanceCounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `InventoryInstances_id` int(11) DEFAULT NULL,
  `PackageTypes_id` int(11) DEFAULT NULL,
  `MaterialInventories_id` int(11) DEFAULT NULL,
  `WarehouseLocations_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `InventoryInstanceCounts_InventoryInstances_idx` (`InventoryInstances_id`),
  KEY `InventoryInstanceCounts_PackageTypes_idx` (`PackageTypes_id`),
  KEY `InventoryInstanceCounts_WarehouseLocations_idx` (`WarehouseLocations_id`),
  KEY `InventoryInstanceCounts_MaterialInventories_idx` (`MaterialInventories_id`),
  CONSTRAINT `InventoryInstanceCounts_InventoryInstances` FOREIGN KEY (`InventoryInstances_id`) REFERENCES `InventoryInstances` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `InventoryInstanceCounts_MaterialInventories` FOREIGN KEY (`MaterialInventories_id`) REFERENCES `MaterialInventories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `InventoryInstanceCounts_PackageTypes` FOREIGN KEY (`PackageTypes_id`) REFERENCES `PackageTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `InventoryInstanceCounts_WarehouseLocations` FOREIGN KEY (`WarehouseLocations_id`) REFERENCES `WarehouseLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `InventoryInstanceCounts` */

/*Table structure for table `InventoryInstances` */

DROP TABLE IF EXISTS `InventoryInstances`;

CREATE TABLE `InventoryInstances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventoryDate` date DEFAULT NULL,
  `InventoryReportTypes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `InventoryInstances_InventoryReportTypes_idx` (`InventoryReportTypes_id`),
  CONSTRAINT `InventoryInstances_InventoryReportTypes` FOREIGN KEY (`InventoryReportTypes_id`) REFERENCES `InventoryReportTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `InventoryInstances` */

/*Table structure for table `InventoryReportTypes` */

DROP TABLE IF EXISTS `InventoryReportTypes`;

CREATE TABLE `InventoryReportTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `Departments_id` int(11) DEFAULT NULL,
  `InventoryTypes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `InventoryReportTypes_Departments_idx` (`Departments_id`),
  KEY `InventoryReportTypes_InventoryTypes_idx` (`InventoryTypes_id`),
  CONSTRAINT `InventoryReportTypes_Departments` FOREIGN KEY (`Departments_id`) REFERENCES `Departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `InventoryReportTypes_InventoryTypes` FOREIGN KEY (`InventoryTypes_id`) REFERENCES `InventoryTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `InventoryReportTypes` */

/*Table structure for table `InventoryReportTypesItems` */

DROP TABLE IF EXISTS `InventoryReportTypesItems`;

CREATE TABLE `InventoryReportTypesItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `MaterialInventories_id` int(11) DEFAULT NULL,
  `InventoryReportTypes_id` int(11) DEFAULT NULL,
  `InventoryCategories_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `InventoryReportTypesItems_MaterialInventories_idx` (`MaterialInventories_id`),
  KEY `InventoryReportTypesItems_ReportTypes_idx` (`InventoryReportTypes_id`),
  KEY `InventoryReportTypesItems_InventoryCategories_idx` (`InventoryCategories_id`),
  CONSTRAINT `InventoryReportTypesItems_InventoryCategories` FOREIGN KEY (`InventoryCategories_id`) REFERENCES `InventoryCategories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `InventoryReportTypesItems_MaterialInventories` FOREIGN KEY (`MaterialInventories_id`) REFERENCES `MaterialInventories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `InventoryReportTypesItems_ReportTypes` FOREIGN KEY (`InventoryReportTypes_id`) REFERENCES `InventoryReportTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `InventoryReportTypesItems` */

/*Table structure for table `InventoryTypes` */

DROP TABLE IF EXISTS `InventoryTypes`;

CREATE TABLE `InventoryTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'is it equipment or materials?',
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `InventoryTypes` */

/*Table structure for table `KeyIncidentsNotificationList` */

DROP TABLE IF EXISTS `KeyIncidentsNotificationList`;

CREATE TABLE `KeyIncidentsNotificationList` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `KeyIncidentsNotificationList_Staff_idx` (`Staff_id`),
  CONSTRAINT `KeyIncidentsNotificationList_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `KeyIncidentsNotificationList` */

/*Table structure for table `KeyTypes` */

DROP TABLE IF EXISTS `KeyTypes`;

CREATE TABLE `KeyTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `KeyTypes` */

/*Table structure for table `KeysHistories` */

DROP TABLE IF EXISTS `KeysHistories`;

CREATE TABLE `KeysHistories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClaimsKeys_id` int(11) DEFAULT NULL,
  `fromStaff_id` int(11) DEFAULT NULL,
  `toStaff_id` int(11) DEFAULT NULL,
  `fromSubcontractors_id` int(11) DEFAULT NULL,
  `toSubContractors_id` int(11) DEFAULT NULL,
  `transferTime` timestamp NULL DEFAULT NULL,
  `photo` longblob,
  PRIMARY KEY (`id`),
  KEY `KeysHistories_fromStaff_idx` (`fromStaff_id`),
  KEY `KeysHistories_toStaff_idx` (`toStaff_id`),
  KEY `KeysHistories_fromContractor_idx` (`fromSubcontractors_id`),
  KEY `KeysHistories_toContractors_idx` (`toSubContractors_id`),
  CONSTRAINT `KeysHistories_fromContractor` FOREIGN KEY (`fromSubcontractors_id`) REFERENCES `SubcontractorContacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `KeysHistories_fromStaff` FOREIGN KEY (`fromStaff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `KeysHistories_toContractors` FOREIGN KEY (`toSubContractors_id`) REFERENCES `SubcontractorContacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `KeysHistories_toStaff` FOREIGN KEY (`toStaff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `KeysHistories` */

/*Table structure for table `Locales` */

DROP TABLE IF EXISTS `Locales`;

CREATE TABLE `Locales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` char(5) DEFAULT NULL,
  `isDefault` tinyint(1) DEFAULT NULL,
  `languageName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `Locales` */

insert  into `Locales`(`id`,`locale`,`isDefault`,`languageName`) values (1,'en_US',1,'English'),(2,'zh_CN',0,'Chinese - Simplified');

/*Table structure for table `LocationsNotes` */

DROP TABLE IF EXISTS `LocationsNotes`;

CREATE TABLE `LocationsNotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `entryDate` timestamp NULL DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `LocationsNotes_Staff_idx` (`Staff_id`),
  KEY `LocationsNotes_ClaimsLocations_idx` (`ClaimsLocations_id`),
  CONSTRAINT `LocationsNotes_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `LocationsNotes_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `LocationsNotes` */

/*Table structure for table `LocationsPhotos` */

DROP TABLE IF EXISTS `LocationsPhotos`;

CREATE TABLE `LocationsPhotos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(45) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `dateTaken` date DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `LocationsPhotos_Staff_idx` (`Staff_id`),
  KEY `LocationsPhotos_ClaimsLocations_idx` (`ClaimsLocations_id`),
  CONSTRAINT `LocationsPhotos_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `LocationsPhotos_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

/*Data for the table `LocationsPhotos` */

insert  into `LocationsPhotos`(`id`,`description`,`photo`,`ClaimsLocations_id`,`dateTaken`,`Staff_id`,`notes`) values (8,NULL,'/var/www/phoenix-portal/htdocs/../locationImages/2/23/rsz_1rsz_1logo.png',23,NULL,2,NULL),(9,NULL,'/var/www/phoenix-portal/htdocs/../locationImages/2/23/rsz_1rsz_1logo.png',23,NULL,2,NULL),(10,NULL,'/var/www/phoenix-portal/htdocs/../locationImages/2/23/rsz_1rsz_1logo.png',23,NULL,2,NULL),(11,NULL,'/var/www/phoenix-portal/htdocs/../locationImages/2/23/rsz_1rsz_1logo.png',23,NULL,2,NULL),(12,NULL,'/var/www/phoenix-portal/htdocs/../locationImages/2/23/rsz_1rsz_1logo.png',23,NULL,2,NULL),(13,NULL,'/var/www/phoenix-portal/htdocs/../locationImages/2/23/Hydrangeas.jpg',23,NULL,2,NULL),(14,NULL,'/var/www/phoenix-portal/htdocs/../locationImages/2/23/Hydrangeas.jpg',23,NULL,2,NULL),(15,NULL,'/var/www/phoenix-portal/htdocs/../locationImages/2/23/Hydrangeas.jpg',23,NULL,2,NULL),(16,NULL,'/var/www/phoenix-portal/htdocs/../locationImages/2/23/Hydrangeas.jpg',23,NULL,2,NULL),(17,NULL,'/var/www/phoenix-portal/htdocs/../locationImages/2/23/Hydrangeas.jpg',23,NULL,2,NULL),(18,NULL,'/var/www/phoenix-portal/htdocs/../locationImages/2/23/Hydrangeas.jpg',23,NULL,2,NULL),(19,NULL,'/var/www/phoenix-portal/htdocs/../locationImages/2/23/Chrysanthemum.jpg',23,NULL,2,NULL);

/*Table structure for table `LocationsWork` */

DROP TABLE IF EXISTS `LocationsWork`;

CREATE TABLE `LocationsWork` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `workPerformed` varchar(500) DEFAULT NULL,
  `LocationsWorkStatuses_id` int(11) DEFAULT NULL,
  `WorkTypes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `LocationsWork_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `LocationsWork_Staff_idx` (`Staff_id`),
  KEY `LocationsWork_LocationsWorkStatuses_idx` (`LocationsWorkStatuses_id`),
  KEY `LocationsWork_workTypes_idx` (`WorkTypes_id`),
  CONSTRAINT `LocationsWork_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `LocationsWork_LocationsWorkStatuses` FOREIGN KEY (`LocationsWorkStatuses_id`) REFERENCES `LocationsWorkStatuses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `LocationsWork_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `LocationsWork_workTypes` FOREIGN KEY (`WorkTypes_id`) REFERENCES `WorkTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `LocationsWork` */

/*Table structure for table `LocationsWorkStatuses` */

DROP TABLE IF EXISTS `LocationsWorkStatuses`;

CREATE TABLE `LocationsWorkStatuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  `notifyPM` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `LocationsWorkStatuses` */

/*Table structure for table `MaterialInventories` */

DROP TABLE IF EXISTS `MaterialInventories`;

CREATE TABLE `MaterialInventories` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this table is simply a list of items that we keep in stock. it is the ''master list'' to choose from for our basic inventory reports. it is NOT a count of inventory in stock - that is inventoryInstanceCounts table',
  `name` varchar(45) DEFAULT NULL,
  `productCode` varchar(12) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `minOrderQuantity` int(11) DEFAULT NULL,
  `maxQuantity` int(11) DEFAULT NULL,
  `PackageTypes_id` int(11) DEFAULT NULL,
  `InventoryTypes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `MaterialInventory_PackageTypes_idx` (`PackageTypes_id`),
  KEY `MaterialInventories_InventoryTypes_idx` (`InventoryTypes_id`),
  CONSTRAINT `MaterialInventories_InventoryTypes` FOREIGN KEY (`InventoryTypes_id`) REFERENCES `InventoryTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MaterialInventories_PackageTypes` FOREIGN KEY (`PackageTypes_id`) REFERENCES `PackageTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `MaterialInventories` */

/*Table structure for table `MaterialInventoriesVariantGroups` */

DROP TABLE IF EXISTS `MaterialInventoriesVariantGroups`;

CREATE TABLE `MaterialInventoriesVariantGroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `MaterialInventories_id` int(11) DEFAULT NULL,
  `VariantGroups_id` int(11) DEFAULT NULL,
  `VariantOptions_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `MaterialInventoryVariantGroups_MaterialInventory_idx` (`MaterialInventories_id`),
  KEY `MaterialInventoryVariantGroups_VariantGroups_idx` (`VariantGroups_id`),
  KEY `MaterialInventoryVariantGroups_VariantOptions_idx` (`VariantOptions_id`),
  CONSTRAINT `MaterialInventoriesVariantGroups_MaterialInventory` FOREIGN KEY (`MaterialInventories_id`) REFERENCES `MaterialInventories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MaterialInventoriesVariantGroups_VariantGroups` FOREIGN KEY (`VariantGroups_id`) REFERENCES `VariantGroups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MaterialInventoriesVariantGroups_VariantOptions` FOREIGN KEY (`VariantOptions_id`) REFERENCES `VariantOptions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `MaterialInventoriesVariantGroups` */

/*Table structure for table `MaterialInventoriesVendors` */

DROP TABLE IF EXISTS `MaterialInventoriesVendors`;

CREATE TABLE `MaterialInventoriesVendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `MaterialInventories_id` int(11) DEFAULT NULL,
  `Vendors_id` int(11) DEFAULT NULL,
  `isPrimary` tinyint(1) DEFAULT NULL,
  `leadTime` varchar(8) DEFAULT NULL,
  `deliveryFee` float DEFAULT NULL,
  `brandName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `MaterialInventoryVendors_Vendors_idx` (`Vendors_id`),
  KEY `MaterialInventoriesVendors_MaterialInventory` (`MaterialInventories_id`),
  CONSTRAINT `MaterialInventoriesVendors_MaterialInventory` FOREIGN KEY (`MaterialInventories_id`) REFERENCES `MaterialInventories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MaterialInventoriesVendors_Vendors` FOREIGN KEY (`Vendors_id`) REFERENCES `Vendors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `MaterialInventoriesVendors` */

/*Table structure for table `MaterialInventorySuppliesUsed` */

DROP TABLE IF EXISTS `MaterialInventorySuppliesUsed`;

CREATE TABLE `MaterialInventorySuppliesUsed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `ClaimPhases_id` int(11) DEFAULT NULL,
  `dateUsed` date DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `Vehicles_id` int(11) DEFAULT NULL,
  `Departments_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `MaterialInventorySuppliesUsed_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `MaterialInventorySuppliesUsed_ClaimsPhases_idx` (`ClaimPhases_id`),
  KEY `MaterialInventorySuppliesUsed_Staff_idx` (`Staff_id`),
  KEY `MaterialInventorySuppliesUsed_Departments_idx` (`Departments_id`),
  KEY `MaterialInventorySuppliesUsed_Vehicles_idx` (`Vehicles_id`),
  CONSTRAINT `MaterialInventorySuppliesUsed_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MaterialInventorySuppliesUsed_ClaimsPhases` FOREIGN KEY (`ClaimPhases_id`) REFERENCES `ClaimPhases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MaterialInventorySuppliesUsed_Departments` FOREIGN KEY (`Departments_id`) REFERENCES `Departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MaterialInventorySuppliesUsed_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MaterialInventorySuppliesUsed_Vehicles` FOREIGN KEY (`Vehicles_id`) REFERENCES `Vehicles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `MaterialInventorySuppliesUsed` */

/*Table structure for table `MaterialInventorySuppliesUsedInstances` */

DROP TABLE IF EXISTS `MaterialInventorySuppliesUsedInstances`;

CREATE TABLE `MaterialInventorySuppliesUsedInstances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `MaterialInventories_id` int(11) DEFAULT NULL,
  `PackageTypes_id` int(11) DEFAULT NULL,
  `InventoryCategories_id` int(11) DEFAULT NULL,
  `MaterialInventorySuppliesUsed_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `MaterialInventorySuppliesUsedInstances_MaterialInventories_idx` (`MaterialInventories_id`),
  KEY `MaterialInventorySuppliesUsedInstances_PackageTypes_idx` (`PackageTypes_id`),
  KEY `MaterialInventorySuppliesUsedInstances_InventoryCategories_idx` (`InventoryCategories_id`),
  KEY `MaterialInventorySuppliesUsedInstances_MaterialInventorySup_idx` (`MaterialInventorySuppliesUsed_id`),
  CONSTRAINT `MaterialInventorySuppliesUsedInstances_InventoryCategories` FOREIGN KEY (`InventoryCategories_id`) REFERENCES `InventoryCategories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MaterialInventorySuppliesUsedInstances_MaterialInventories` FOREIGN KEY (`MaterialInventories_id`) REFERENCES `MaterialInventories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MaterialInventorySuppliesUsedInstances_MaterialUsed` FOREIGN KEY (`MaterialInventorySuppliesUsed_id`) REFERENCES `MaterialInventorySuppliesUsed` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `MaterialInventorySuppliesUsedInstances_PackageTypes` FOREIGN KEY (`PackageTypes_id`) REFERENCES `PackageTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `MaterialInventorySuppliesUsedInstances` */

/*Table structure for table `NavigationActions` */

DROP TABLE IF EXISTS `NavigationActions`;

CREATE TABLE `NavigationActions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `NavigationActions` */

/*Table structure for table `OnCallCallInstances` */

DROP TABLE IF EXISTS `OnCallCallInstances`;

CREATE TABLE `OnCallCallInstances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `onCallDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `projectManagerStaff_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `OnCallCallInstances_Staff_idx` (`projectManagerStaff_id`),
  CONSTRAINT `OnCallCallInstances_Staff` FOREIGN KEY (`projectManagerStaff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

/*Data for the table `OnCallCallInstances` */

insert  into `OnCallCallInstances`(`id`,`onCallDate`,`projectManagerStaff_id`) values (1,NULL,NULL),(2,'2014-10-14 14:04:29',2),(3,'2014-10-14 11:09:23',NULL),(4,'2014-10-15 11:09:33',NULL);

/*Table structure for table `OnCallTechnicians` */

DROP TABLE IF EXISTS `OnCallTechnicians`;

CREATE TABLE `OnCallTechnicians` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(11) DEFAULT NULL,
  `onCallDate` date DEFAULT NULL,
  `OnCallTypes_id` int(11) DEFAULT NULL,
  `fromTime` varchar(45) DEFAULT NULL COMMENT 'based on calendar display from outlook',
  `toTime` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `OnCallTechnicians_Staff_idx` (`Staff_id`),
  KEY `OnCallTechnicians_OnCallTypes_idx` (`OnCallTypes_id`),
  CONSTRAINT `OnCallTechnicians_OnCallTypes` FOREIGN KEY (`OnCallTypes_id`) REFERENCES `OnCallTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `OnCallTechnicians_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `OnCallTechnicians` */

/*Table structure for table `OnCallTechniciansCallMatrix` */

DROP TABLE IF EXISTS `OnCallTechniciansCallMatrix`;

CREATE TABLE `OnCallTechniciansCallMatrix` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `callingStaff_id` int(11) DEFAULT NULL,
  `technicianStaff_id` int(11) DEFAULT NULL,
  `callTime` varchar(45) DEFAULT NULL,
  `techResponded` tinyint(1) DEFAULT NULL,
  `techArrivedOntime` tinyint(1) DEFAULT NULL,
  `techResponseType_id` int(11) DEFAULT NULL,
  `pmReturnedCallTimely` tinyint(1) DEFAULT NULL,
  `comments` varchar(500) DEFAULT NULL,
  `Subcontractors_id` int(11) DEFAULT NULL,
  `subcontractorResponseTime` int(11) DEFAULT NULL,
  `subcontractorArrivalTime` int(11) DEFAULT NULL,
  `OnCallInstances_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `OnCallTechniciansCallMatrix_CallingStaff_idx` (`callingStaff_id`),
  KEY `OnCallTechniciansCallMatrix_TechStaff_idx` (`technicianStaff_id`),
  KEY `OnCallTechniciansCallMatrix_ResponseTypes_idx` (`techResponseType_id`),
  KEY `OnCallTechniciansCallMatrix_OnCallInstances_idx` (`OnCallInstances_id`),
  CONSTRAINT `OnCallTechniciansCallMatrix_CallingStaff` FOREIGN KEY (`callingStaff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `OnCallTechniciansCallMatrix_OnCallInstances` FOREIGN KEY (`OnCallInstances_id`) REFERENCES `OnCallCallInstances` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `OnCallTechniciansCallMatrix_ResponseTypes` FOREIGN KEY (`techResponseType_id`) REFERENCES `ResponseTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `OnCallTechniciansCallMatrix_TechStaff` FOREIGN KEY (`technicianStaff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `OnCallTechniciansCallMatrix` */

insert  into `OnCallTechniciansCallMatrix`(`id`,`callingStaff_id`,`technicianStaff_id`,`callTime`,`techResponded`,`techArrivedOntime`,`techResponseType_id`,`pmReturnedCallTimely`,`comments`,`Subcontractors_id`,`subcontractorResponseTime`,`subcontractorArrivalTime`,`OnCallInstances_id`) values (1,2,2,'12:15am',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2),(2,2,2,'12:20am',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,3),(3,2,2,'1:15pm',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,4);

/*Table structure for table `OnCallTypes` */

DROP TABLE IF EXISTS `OnCallTypes`;

CREATE TABLE `OnCallTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'on-call P.M.',
  `position` varchar(45) DEFAULT NULL,
  `backgroundColor` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `OnCallTypes` */

/*Table structure for table `PackageTypes` */

DROP TABLE IF EXISTS `PackageTypes`;

CREATE TABLE `PackageTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `PackageTypes` */

/*Table structure for table `ProjectAddresses` */

DROP TABLE IF EXISTS `ProjectAddresses`;

CREATE TABLE `ProjectAddresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this table is used because 1 building can have multiple claims over the years. This way techs don''t have to keep re-entering the information.',
  `buildingName` varchar(45) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `Provinces_id` int(11) DEFAULT NULL,
  `postalCode` varchar(7) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ProjectAddresses_Provinces_idx` (`Provinces_id`),
  CONSTRAINT `ProjectAddresses_Provinces` FOREIGN KEY (`Provinces_id`) REFERENCES `Provinces` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `ProjectAddresses` */

insert  into `ProjectAddresses`(`id`,`buildingName`,`address1`,`address2`,`city`,`Provinces_id`,`postalCode`,`notes`) values (2,'Test Building','1234 university place',NULL,'surrey',1,'v3r 5t3','this is a test of the project addresses'),(3,'another building ','216 - 500 royal ave','test','new westminster',1,'v3v 0e4','this is a place in new west');

/*Table structure for table `ProjectAddressesFloorPlans` */

DROP TABLE IF EXISTS `ProjectAddressesFloorPlans`;

CREATE TABLE `ProjectAddressesFloorPlans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `floorPlan` longblob,
  `ProjectAddresses_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ProjectAddressesFloorPlans_ProjectAddresses_idx` (`ProjectAddresses_id`),
  CONSTRAINT `ProjectAddressesFloorPlans_ProjectAddresses` FOREIGN KEY (`ProjectAddresses_id`) REFERENCES `ProjectAddresses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ProjectAddressesFloorPlans` */

/*Table structure for table `Provinces` */

DROP TABLE IF EXISTS `Provinces`;

CREATE TABLE `Provinces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `province` varchar(45) DEFAULT NULL,
  `abbreviation` char(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `Provinces` */

insert  into `Provinces`(`id`,`province`,`abbreviation`) values (1,'Alberta','AB'),(2,'British Columbia','BC');

/*Table structure for table `PurchaseOrders` */

DROP TABLE IF EXISTS `PurchaseOrders`;

CREATE TABLE `PurchaseOrders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimPhases_id` int(11) DEFAULT NULL,
  `Departments_id` int(11) DEFAULT NULL,
  `Subcontractors_id` int(11) DEFAULT NULL,
  `Vendors_id` int(11) DEFAULT NULL,
  `orderDate` date DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `subTotal` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `poNumber` varchar(10) DEFAULT NULL,
  `PurchaseOrdersTypes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PurchaseOrders_PurchaseOrders_idx` (`Claims_id`),
  KEY `PurchaseOrders_ClaimPhases_idx` (`ClaimPhases_id`),
  KEY `PurchaseOrders_Departments_idx` (`Departments_id`),
  KEY `PurchaseOrders_Subcontractors_idx` (`Subcontractors_id`),
  KEY `Vendors_id_idx` (`Vendors_id`),
  KEY `PurchaseOrders_PurchaseOrdersTypes_idx` (`PurchaseOrdersTypes`),
  CONSTRAINT `PurchaseOrders_ClaimPhases` FOREIGN KEY (`ClaimPhases_id`) REFERENCES `ClaimPhases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `PurchaseOrders_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `PurchaseOrders_Departments` FOREIGN KEY (`Departments_id`) REFERENCES `Departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `PurchaseOrders_PurchaseOrdersTypes` FOREIGN KEY (`PurchaseOrdersTypes`) REFERENCES `PurchaseOrdersTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `PurchaseOrders_Subcontractors` FOREIGN KEY (`Subcontractors_id`) REFERENCES `SubcontractorTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Vendors_id` FOREIGN KEY (`Vendors_id`) REFERENCES `Vendors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `PurchaseOrders` */

/*Table structure for table `PurchaseOrdersItems` */

DROP TABLE IF EXISTS `PurchaseOrdersItems`;

CREATE TABLE `PurchaseOrdersItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemName` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `unitPrice` float DEFAULT NULL,
  `TaxTypes` int(11) DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `PurchaseOrdersItems_id` int(11) DEFAULT NULL,
  `MaterialInventories_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PurchaseOrdersItems_PurchaseOrders_idx` (`PurchaseOrdersItems_id`),
  KEY `PurchaseOrdersItems_MaterialInventories_idx` (`MaterialInventories_id`),
  CONSTRAINT `PurchaseOrdersItems_MaterialInventories` FOREIGN KEY (`MaterialInventories_id`) REFERENCES `MaterialInventories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `PurchaseOrdersItems_PurchaseOrders` FOREIGN KEY (`PurchaseOrdersItems_id`) REFERENCES `PurchaseOrders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `PurchaseOrdersItems` */

/*Table structure for table `PurchaseOrdersItemsReceived` */

DROP TABLE IF EXISTS `PurchaseOrdersItemsReceived`;

CREATE TABLE `PurchaseOrdersItemsReceived` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PurchaseOrdersItems_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `dateReceived` timestamp NULL DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `addedToInventoryDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PurchaseOrdersItemsReceived_PurchaseOrdersItems_idx` (`PurchaseOrdersItems_id`),
  KEY `PurchaseOrdersItemsReceived_Staff_idx` (`Staff_id`),
  CONSTRAINT `PurchaseOrdersItemsReceived_PurchaseOrdersItems` FOREIGN KEY (`PurchaseOrdersItems_id`) REFERENCES `PurchaseOrdersItems` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `PurchaseOrdersItemsReceived_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `PurchaseOrdersItemsReceived` */

/*Table structure for table `PurchaseOrdersTypes` */

DROP TABLE IF EXISTS `PurchaseOrdersTypes`;

CREATE TABLE `PurchaseOrdersTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderType` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `PurchaseOrdersTypes` */

/*Table structure for table `ResponseTypes` */

DROP TABLE IF EXISTS `ResponseTypes`;

CREATE TABLE `ResponseTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `response` varchar(45) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ResponseTypes` */

/*Table structure for table `RoomTypes` */

DROP TABLE IF EXISTS `RoomTypes`;

CREATE TABLE `RoomTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `RoomTypes` */

/*Table structure for table `RoomTypesI18n` */

DROP TABLE IF EXISTS `RoomTypesI18n`;

CREATE TABLE `RoomTypesI18n` (
  `RoomTypes_id` int(11) DEFAULT NULL,
  `room` varchar(45) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  KEY `RoomTypes_RoomTypesI18n_idx` (`RoomTypes_id`),
  CONSTRAINT `RoomTypes_RoomTypesI18n` FOREIGN KEY (`RoomTypes_id`) REFERENCES `RoomTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `RoomTypesI18n` */

/*Table structure for table `Samples` */

DROP TABLE IF EXISTS `Samples`;

CREATE TABLE `Samples` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `Samples` */

/*Table structure for table `ScopeIncidentTypes` */

DROP TABLE IF EXISTS `ScopeIncidentTypes`;

CREATE TABLE `ScopeIncidentTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` date DEFAULT NULL COMMENT 'this table is for delay type - unable to contact, not home.. etc',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ScopeIncidentTypes` */

/*Table structure for table `ScopeIncidentTypesI18n` */

DROP TABLE IF EXISTS `ScopeIncidentTypesI18n`;

CREATE TABLE `ScopeIncidentTypesI18n` (
  `ScopeIncidentTypes_id` int(11) DEFAULT NULL,
  `incidentType` varchar(45) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  KEY `ScopeIncidentTypesI18n_ScopeIncidentTypes_idx` (`ScopeIncidentTypes_id`),
  CONSTRAINT `ScopeIncidentTypesI18n_ScopeIncidentTypes` FOREIGN KEY (`ScopeIncidentTypes_id`) REFERENCES `ScopeIncidentTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ScopeIncidentTypesI18n` */

/*Table structure for table `ScopeIncidents` */

DROP TABLE IF EXISTS `ScopeIncidents`;

CREATE TABLE `ScopeIncidents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `incidentDate` date DEFAULT NULL,
  `ScopeIncidentTypes_id` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `ScopeRequests_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ScopeIncidents_ScopeIncidentTypes_idx` (`ScopeIncidentTypes_id`),
  KEY `ScopeIncidents_ScopeRequests_idx` (`ScopeRequests_id`),
  CONSTRAINT `ScopeIncidents_ScopeIncidentTypes` FOREIGN KEY (`ScopeIncidentTypes_id`) REFERENCES `ScopeIncidentTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopeIncidents_ScopeRequests` FOREIGN KEY (`ScopeRequests_id`) REFERENCES `ScopeRequests` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ScopeIncidents` */

/*Table structure for table `ScopeMaterialTakeoffs` */

DROP TABLE IF EXISTS `ScopeMaterialTakeoffs`;

CREATE TABLE `ScopeMaterialTakeoffs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `MaterialInventories_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `other` varchar(45) DEFAULT NULL,
  `dateEntered` date DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ScopeMaterialTakeoffs_Staff_idx` (`Staff_id`),
  KEY `ScopeMaterialTakeoffs_Claims_idx` (`Claims_id`),
  KEY `ScopeMaterialTakeoffs_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `ScopeMaterialTakeoffs_MaterialInventories_idx` (`MaterialInventories_id`),
  CONSTRAINT `ScopeMaterialTakeoffs_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopeMaterialTakeoffs_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopeMaterialTakeoffs_MaterialInventories` FOREIGN KEY (`MaterialInventories_id`) REFERENCES `MaterialInventories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopeMaterialTakeoffs_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ScopeMaterialTakeoffs` */

/*Table structure for table `ScopeRequestContacts` */

DROP TABLE IF EXISTS `ScopeRequestContacts`;

CREATE TABLE `ScopeRequestContacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ScopeRequests_id` int(11) DEFAULT NULL,
  `Contact_id` int(11) DEFAULT NULL,
  `ContactType_id` int(11) DEFAULT NULL COMMENT 'which table are they coming from ?',
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ScopeRequests_Contacts_idx` (`ScopeRequests_id`),
  KEY `ScopeRequestsContacts_locations_idx` (`ClaimsLocations_id`),
  CONSTRAINT `ScopeRequestsContacts_locations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopeRequestsContacts_Requests` FOREIGN KEY (`ScopeRequests_id`) REFERENCES `ScopeRequests` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ScopeRequestContacts` */

/*Table structure for table `ScopeRequests` */

DROP TABLE IF EXISTS `ScopeRequests`;

CREATE TABLE `ScopeRequests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobNumber` varchar(11) DEFAULT NULL,
  `requestDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `scopeDate` timestamp NULL DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `ScopeTypes_id` int(11) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  `ProjectAddresses_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ScopeRequests_ScopeTypes_idx` (`ScopeTypes_id`),
  KEY `ScopeRequests_Staff_idx` (`Staff_id`),
  CONSTRAINT `ScopeRequests_ScopeTypes` FOREIGN KEY (`ScopeTypes_id`) REFERENCES `ScopeTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopeRequests_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

/*Data for the table `ScopeRequests` */

insert  into `ScopeRequests`(`id`,`jobNumber`,`requestDate`,`scopeDate`,`source`,`Staff_id`,`notes`,`ScopeTypes_id`,`isActive`,`ProjectAddresses_id`) values (1,'MV-14JS123','0000-00-00 00:00:00','2014-10-09 13:13:36','sprinkler head in main hallway',NULL,'looks like someone hangs their laundry on it',NULL,NULL,2),(2,'1233','0000-00-00 00:00:00','0000-00-00 00:00:00','asdad',NULL,'aasd',NULL,NULL,2),(3,'','0000-00-00 00:00:00','0000-00-00 00:00:00','',NULL,'',NULL,NULL,2),(4,'123123','0000-00-00 00:00:00','0000-00-00 00:00:00','adad',NULL,'4',NULL,NULL,2),(5,'5','0000-00-00 00:00:00','0000-00-00 00:00:00','5',NULL,'5',NULL,NULL,3),(6,'6','0000-00-00 00:00:00','0000-00-00 00:00:00','6',NULL,'6',NULL,NULL,3),(7,'6','0000-00-00 00:00:00','0000-00-00 00:00:00','6',NULL,'6',NULL,NULL,3),(8,'123','0000-00-00 00:00:00','0000-00-00 00:00:00','',NULL,'123',NULL,NULL,3),(9,'qwe','0000-00-00 00:00:00','0000-00-00 00:00:00','qwe',NULL,'qew',NULL,NULL,2),(10,'qwe','0000-00-00 00:00:00','0000-00-00 00:00:00','qwe',NULL,'qew',NULL,NULL,2),(11,'qwe','0000-00-00 00:00:00','0000-00-00 00:00:00','qwe',NULL,'qew',NULL,NULL,2),(12,'qwe','0000-00-00 00:00:00','0000-00-00 00:00:00','qwe',NULL,'qew',NULL,NULL,2),(13,'qwe','0000-00-00 00:00:00','0000-00-00 00:00:00','qwe',NULL,'qew',NULL,NULL,2),(14,'qwe','0000-00-00 00:00:00','0000-00-00 00:00:00','qwe',NULL,'qew',NULL,NULL,2),(15,'qwe','0000-00-00 00:00:00','0000-00-00 00:00:00','qwe',NULL,'qwe',NULL,NULL,2),(16,'qwe','0000-00-00 00:00:00','0000-00-00 00:00:00','qwe',NULL,'qwe',NULL,NULL,2),(17,'qwe','0000-00-00 00:00:00','0000-00-00 00:00:00','qwe',NULL,'qwe',NULL,NULL,2),(18,'qwe','0000-00-00 00:00:00','0000-00-00 00:00:00','qwe',NULL,'qwe',NULL,NULL,2),(19,'qwe','0000-00-00 00:00:00','0000-00-00 00:00:00','qwe',NULL,'qwe',NULL,NULL,2),(20,'qwe','0000-00-00 00:00:00','0000-00-00 00:00:00','qwe',NULL,'qwe',NULL,NULL,2),(21,'','0000-00-00 00:00:00','0000-00-00 00:00:00','',NULL,'',NULL,NULL,0),(22,'','0000-00-00 00:00:00','0000-00-00 00:00:00','',NULL,'',NULL,NULL,0),(23,'','0000-00-00 00:00:00','0000-00-00 00:00:00','',NULL,'',NULL,NULL,0),(24,'','0000-00-00 00:00:00','0000-00-00 00:00:00','',NULL,'',NULL,NULL,0),(25,'','0000-00-00 00:00:00','0000-00-00 00:00:00','',NULL,'',NULL,NULL,0),(26,'q','0000-00-00 00:00:00','0000-00-00 00:00:00','q',NULL,'q',NULL,NULL,0),(27,'','0000-00-00 00:00:00','0000-00-00 00:00:00','',NULL,'',NULL,NULL,0);

/*Table structure for table `ScopeTypes` */

DROP TABLE IF EXISTS `ScopeTypes`;

CREATE TABLE `ScopeTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	';

/*Data for the table `ScopeTypes` */

/*Table structure for table `ScopeTypesI18n` */

DROP TABLE IF EXISTS `ScopeTypesI18n`;

CREATE TABLE `ScopeTypesI18n` (
  `ScopeTypes_id` int(11) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  KEY `ScopeTypes_ScopeTypesI18n_idx` (`ScopeTypes_id`),
  CONSTRAINT `ScopeTypes_ScopeTypesI18n` FOREIGN KEY (`ScopeTypes_id`) REFERENCES `ScopeTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ScopeTypesI18n` */

/*Table structure for table `ScopingFormResponses` */

DROP TABLE IF EXISTS `ScopingFormResponses`;

CREATE TABLE `ScopingFormResponses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `ScopingForms_id` int(11) DEFAULT NULL,
  `ScopingFormSheetQuestions_id` int(11) DEFAULT NULL,
  `ScopingFormSheetQuestionSelections_id` int(11) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `dateEntered` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ScopingFormResponses_Claims_idx` (`Claims_id`),
  KEY `ScopingFormResponses_Locations_idx` (`ClaimsLocations_id`),
  KEY `ScopingFormResponses_Questions_idx` (`ScopingFormSheetQuestions_id`),
  KEY `ScopingFormResponses_Selections_idx` (`ScopingFormSheetQuestionSelections_id`),
  KEY `ScopingFormResponses_Staff_idx` (`Staff_id`),
  KEY `ScopingFormResponses_ScopingForms_idx` (`ScopingForms_id`),
  CONSTRAINT `ScopingFormResponses_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopingFormResponses_Locations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopingFormResponses_Questions` FOREIGN KEY (`ScopingFormSheetQuestions_id`) REFERENCES `ScopingFormsSheetQuestions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopingFormResponses_ScopingForms` FOREIGN KEY (`ScopingForms_id`) REFERENCES `ScopingForms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopingFormResponses_Selections` FOREIGN KEY (`ScopingFormSheetQuestionSelections_id`) REFERENCES `ScopingFormSheetSelections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopingFormResponses_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ScopingFormResponses` */

/*Table structure for table `ScopingFormResponsesNotes` */

DROP TABLE IF EXISTS `ScopingFormResponsesNotes`;

CREATE TABLE `ScopingFormResponsesNotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ScopingFormResponses_id` int(11) DEFAULT NULL,
  `notes` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ScopingFormResponsesNotes__idx` (`ScopingFormResponses_id`),
  CONSTRAINT `ScopingFormResponsesNotes_Responses` FOREIGN KEY (`ScopingFormResponses_id`) REFERENCES `ScopingFormResponses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ScopingFormResponsesNotes` */

/*Table structure for table `ScopingFormSheetQuestionSelections` */

DROP TABLE IF EXISTS `ScopingFormSheetQuestionSelections`;

CREATE TABLE `ScopingFormSheetQuestionSelections` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this is the selections to display on the form for scope writer to choose from',
  `ScopingFormSheetQuestions_id` int(11) DEFAULT NULL,
  `ScopingFormSheetSelections_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `QuestionSelections_questions_idx` (`ScopingFormSheetQuestions_id`),
  KEY `QuestionSelections_selections_idx` (`ScopingFormSheetSelections_id`),
  CONSTRAINT `QuestionSelections_questions` FOREIGN KEY (`ScopingFormSheetQuestions_id`) REFERENCES `ScopingFormsSheetQuestions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `QuestionSelections_selections` FOREIGN KEY (`ScopingFormSheetSelections_id`) REFERENCES `ScopingFormSheetSelections` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ScopingFormSheetQuestionSelections` */

/*Table structure for table `ScopingFormSheetSelections` */

DROP TABLE IF EXISTS `ScopingFormSheetSelections`;

CREATE TABLE `ScopingFormSheetSelections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ScopingFormSheetQuestions_id` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ScopingFormSheetSelections_questions` (`ScopingFormSheetQuestions_id`),
  CONSTRAINT `ScopingFormSheetSelections_questions` FOREIGN KEY (`ScopingFormSheetQuestions_id`) REFERENCES `ScopingFormsSheetQuestions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ScopingFormSheetSelections` */

/*Table structure for table `ScopingFormSheetSelectionsI18n` */

DROP TABLE IF EXISTS `ScopingFormSheetSelectionsI18n`;

CREATE TABLE `ScopingFormSheetSelectionsI18n` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ScopingFormSheetSelections_id` int(11) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `selection` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ScopingFormSheetSelections_locale` (`ScopingFormSheetSelections_id`,`locale`),
  CONSTRAINT `ScopingFormSheetSelectionsI18n_ibfk_1` FOREIGN KEY (`ScopingFormSheetSelections_id`) REFERENCES `ScopingFormSheetSelections` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ScopingFormSheetSelectionsI18n` */

/*Table structure for table `ScopingForms` */

DROP TABLE IF EXISTS `ScopingForms`;

CREATE TABLE `ScopingForms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `ScopingForms` */

insert  into `ScopingForms`(`id`,`name`,`isActive`,`dateModified`) values (1,'Master',NULL,NULL);

/*Table structure for table `ScopingFormsSheetQuestions` */

DROP TABLE IF EXISTS `ScopingFormsSheetQuestions`;

CREATE TABLE `ScopingFormsSheetQuestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this is the container to hold questions within a form, in their various categories',
  `ScopingForms_id` int(11) DEFAULT NULL,
  `SheetQuestions_id` int(11) DEFAULT NULL,
  `Categories_id` int(11) DEFAULT NULL,
  `ClaimScopeRoomDetailTypes_id` int(11) DEFAULT NULL COMMENT 'R16, width: 20" etc...',
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ScopingFormsSheetQuestions_ScopingForms_idx` (`ScopingForms_id`),
  KEY `ScopingFormsSheetQuestions_SheetQuestions_idx` (`SheetQuestions_id`),
  KEY `ScopingFormsSheetQuestions_Categories_idx` (`Categories_id`),
  KEY `ScopingFormsSheetQuestions_RoomDetailTypes_idx` (`ClaimScopeRoomDetailTypes_id`),
  CONSTRAINT `ScopingFormsSheetQuestions_Categories` FOREIGN KEY (`Categories_id`) REFERENCES `Categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopingFormsSheetQuestions_RoomDetailTypes` FOREIGN KEY (`ClaimScopeRoomDetailTypes_id`) REFERENCES `ClaimScopeRoomDetailTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopingFormsSheetQuestions_ScopingForms` FOREIGN KEY (`ScopingForms_id`) REFERENCES `ScopingForms` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopingFormsSheetQuestions_SheetQuestions` FOREIGN KEY (`SheetQuestions_id`) REFERENCES `SheetQuestions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `ScopingFormsSheetQuestions` */

insert  into `ScopingFormsSheetQuestions`(`id`,`ScopingForms_id`,`SheetQuestions_id`,`Categories_id`,`ClaimScopeRoomDetailTypes_id`,`priority`) values (1,1,1,1,NULL,0);

/*Table structure for table `ScopingFormsSheetQuestionsRoomSpecifics` */

DROP TABLE IF EXISTS `ScopingFormsSheetQuestionsRoomSpecifics`;

CREATE TABLE `ScopingFormsSheetQuestionsRoomSpecifics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ScopingFormsSheetQuestions_id` int(11) DEFAULT NULL,
  `ClaimScopeRoomDetailsSpecifics_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ScopingFormsSheetQuestionsRoomSpecifics_questions_idx` (`ScopingFormsSheetQuestions_id`),
  KEY `ScopingFormsSheetQuestionsRoomSpecifics_DetailTypes_idx` (`ClaimScopeRoomDetailsSpecifics_id`),
  CONSTRAINT `ScopingFormsSheetQuestionsRoomSpecifics_DetailTypes` FOREIGN KEY (`ClaimScopeRoomDetailsSpecifics_id`) REFERENCES `ClaimScopeRoomDetailsValueTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `ScopingFormsSheetQuestionsRoomSpecifics_questions` FOREIGN KEY (`ScopingFormsSheetQuestions_id`) REFERENCES `ScopingFormsSheetQuestions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `ScopingFormsSheetQuestionsRoomSpecifics` */

/*Table structure for table `ServerAuthenticationTokens` */

DROP TABLE IF EXISTS `ServerAuthenticationTokens`;

CREATE TABLE `ServerAuthenticationTokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serverName` varchar(45) DEFAULT NULL,
  `ipAddress` char(15) DEFAULT NULL,
  `token` varchar(45) DEFAULT NULL,
  `expirationTime` timestamp NULL DEFAULT NULL,
  `lastRequestTime` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `ServerAuthenticationTokens` */

insert  into `ServerAuthenticationTokens`(`id`,`serverName`,`ipAddress`,`token`,`expirationTime`,`lastRequestTime`) values (1,'phoenix-portal','192.168.2.146','bQd18aba1df45jk7858c8ae88a57fa30','2014-10-02 21:27:59','0000-00-00 00:00:00'),(2,'rest-client','192.168.2.120','bQd18aba1df45jk7858c8ae88a57fa30','2014-10-02 21:27:59','0000-00-00 00:00:00');

/*Table structure for table `SheetQuestions` */

DROP TABLE IF EXISTS `SheetQuestions`;

CREATE TABLE `SheetQuestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'these are the questions to display to the user',
  `question` varchar(200) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `SheetQuestions` */

insert  into `SheetQuestions`(`id`,`question`,`dateModified`) values (1,'S/I Insulation to Walls','2014-10-24 15:39:29');

/*Table structure for table `Staff` */

DROP TABLE IF EXISTS `Staff`;

CREATE TABLE `Staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `StaffTypes_id` int(11) DEFAULT NULL,
  `firstname` varchar(45) DEFAULT NULL,
  `lastname` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `isActive` tinyint(1) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `Provinces_id` int(11) DEFAULT NULL,
  `postalCode` varchar(7) DEFAULT NULL,
  `Departments_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `StaffTypes_id_idx` (`StaffTypes_id`),
  KEY `Staff_Provinces_idx` (`Provinces_id`),
  CONSTRAINT `StaffTypes_id` FOREIGN KEY (`StaffTypes_id`) REFERENCES `StaffTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Staff_Provinces` FOREIGN KEY (`Provinces_id`) REFERENCES `Provinces` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8;

/*Data for the table `Staff` */

insert  into `Staff`(`id`,`StaffTypes_id`,`firstname`,`lastname`,`telephone`,`mobile`,`email`,`isActive`,`address1`,`address2`,`city`,`Provinces_id`,`postalCode`,`Departments_id`,`title`) values (2,1,'dave','m','123-123-1234','778-706-6627','davem@phoenixrestorations.com',NULL,NULL,NULL,NULL,NULL,NULL,1,'Software Architect'),(82,1,'q','q','q',NULL,'q',NULL,'q','q','q',2,'q',2,NULL),(84,1,'q','q','q',NULL,'q',NULL,'q','q','q',2,'q',2,NULL),(93,NULL,'Julie','Wilson','123-123-1233',NULL,'juliew@phoenixrestorations.com',NULL,'','','',2,'',2,NULL),(102,NULL,'Rhonda','Shiho','',NULL,'rhondas@phoenixrestorations.com',NULL,'','','',2,'',1,NULL);

/*Table structure for table `StaffAccessLogs` */

DROP TABLE IF EXISTS `StaffAccessLogs`;

CREATE TABLE `StaffAccessLogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(11) DEFAULT NULL,
  `ipAddress` varchar(15) DEFAULT NULL,
  `accessDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `StaffAccessLogs_Staff_idx` (`Staff_id`),
  CONSTRAINT `StaffAccessLogs_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8;

/*Data for the table `StaffAccessLogs` */

insert  into `StaffAccessLogs`(`id`,`Staff_id`,`ipAddress`,`accessDate`) values (1,2,'192.168','2014-10-30 11:52:20'),(2,2,'192.168','2014-10-30 11:52:54'),(3,2,'192.168','2014-10-30 12:59:16'),(4,2,'192.168','2014-10-30 14:02:04'),(5,2,'192.168','2014-10-30 14:02:44'),(6,2,'192.168','2014-10-30 14:02:52'),(7,2,'192.168','2014-10-30 14:04:37'),(8,2,'192.168','2014-10-30 14:09:35'),(9,2,'192.168','2014-10-30 14:09:50'),(10,2,'192.168','2014-10-30 14:12:52'),(11,2,'192.168','2014-10-30 15:09:01'),(12,2,'192.168','2014-10-30 15:11:53'),(13,2,'192.168','2014-10-30 15:18:04'),(14,2,'192.168','2014-10-30 15:18:27'),(15,2,'192.168','2014-10-30 15:18:32'),(16,2,'192.168','2014-10-30 15:18:46'),(17,2,'192.168','2014-10-30 15:29:06'),(18,2,'192.168','2014-10-30 15:32:55'),(19,2,'192.168','2014-10-30 15:34:08'),(20,2,'192.168','2014-10-30 15:34:15'),(21,2,'192.168','2014-10-30 15:34:19'),(22,2,'192.168','2014-10-30 15:37:05'),(23,2,'192.168','2014-10-30 15:37:45'),(24,2,'192.168','2014-10-30 15:37:57'),(25,2,'192.168','2014-10-30 15:38:58'),(26,2,'192.168','2014-10-30 15:45:03'),(27,2,'192.168','2014-10-30 15:48:02'),(28,2,'192.168','2014-10-30 15:48:15'),(29,2,'192.168','2014-10-30 15:51:45'),(30,2,'192.168','2014-10-30 15:56:09'),(31,2,'192.168','2014-10-30 15:56:41'),(32,2,'192.168','2014-10-30 15:56:57'),(33,2,'192.168','2014-10-30 15:57:51'),(34,2,'192.168','2014-10-30 16:06:18'),(35,2,'192.168','2014-10-30 16:07:25'),(36,2,'192.168','2014-10-30 16:07:58'),(37,2,'192.168','2014-10-30 16:08:23'),(38,2,'192.168','2014-10-30 16:18:35'),(39,2,'192.168','2014-10-30 16:33:31'),(40,2,'192.168','2014-10-30 16:46:03'),(41,2,'192.168','2014-10-31 08:28:16'),(42,2,'192.168','2014-10-31 08:28:29'),(43,2,'192.168','2014-10-31 08:30:55'),(44,2,'192.168','2014-10-31 08:31:11'),(45,2,'192.168','2014-10-31 08:31:22'),(46,2,'192.168','2014-10-31 08:31:45'),(47,2,'192.168','2014-10-31 08:35:31'),(48,2,'192.168','2014-10-31 08:35:41'),(49,2,'192.168','2014-10-31 08:35:50'),(50,2,'192.168','2014-10-31 08:37:46'),(51,2,'192.168','2014-10-31 08:48:57'),(52,2,'192.168','2014-10-31 08:50:23'),(53,2,'192.168','2014-10-31 08:50:47'),(54,2,'192.168','2014-10-31 08:51:02'),(55,2,'192.168','2014-10-31 08:51:15'),(56,2,'192.168','2014-10-31 08:51:40'),(57,2,'192.168','2014-10-31 08:56:39'),(58,2,'192.168','2014-10-31 09:04:41'),(59,2,'192.168','2014-10-31 09:05:25'),(60,2,'192.168','2014-10-31 09:06:03'),(61,2,'192.168','2014-10-31 09:07:18'),(62,2,'192.168','2014-10-31 09:09:27'),(63,2,'192.168','2014-10-31 09:09:32'),(64,2,'192.168','2014-10-31 09:35:47'),(65,2,'192.168','2014-10-31 10:28:41'),(66,2,'192.168','2014-10-31 11:52:10'),(67,2,'192.168','2014-10-31 11:52:14'),(68,2,'192.168','2014-10-31 12:57:11'),(69,2,'192.168','2014-10-31 12:57:19'),(70,2,'192.168','2014-10-31 12:57:35'),(71,2,'192.168','2014-10-31 13:44:50'),(72,2,'192.168','2014-10-31 13:45:02'),(73,2,'192.168','2014-10-31 15:34:50'),(74,2,'192.168','2014-10-31 15:34:53'),(75,2,'192.168','2014-11-03 08:18:51'),(76,2,'192.168','2014-11-03 08:18:56'),(77,2,'192.168','2014-11-03 10:45:37'),(78,2,'192.168','2014-11-03 10:45:50'),(79,102,'192.168','2014-11-03 11:18:19'),(80,2,'192.168','2014-11-03 11:20:37'),(81,2,'192.168','2014-11-03 11:24:38'),(82,2,'192.168','2014-11-03 11:27:35'),(83,2,'192.168','2014-11-03 11:31:12'),(84,2,'192.168','2014-11-03 11:31:59'),(85,2,'192.168','2014-11-03 11:32:11'),(86,2,'192.168','2014-11-03 11:32:38'),(87,2,'192.168','2014-11-03 11:34:40'),(88,2,'192.168','2014-11-03 11:37:16'),(89,2,'192.168','2014-11-03 11:39:14'),(90,2,'192.168','2014-11-03 11:40:15'),(91,2,'192.168','2014-11-03 11:42:38'),(92,2,'192.168','2014-11-03 11:44:12'),(93,2,'192.168','2014-11-03 11:45:41'),(94,2,'192.168','2014-11-03 11:46:36'),(95,2,'192.168','2014-11-03 11:50:07'),(96,2,'192.168','2014-11-03 11:51:15'),(97,2,'192.168','2014-11-03 11:52:32'),(98,2,'192.168','2014-11-03 11:53:22'),(99,2,'192.168','2014-11-03 11:54:51'),(100,2,'192.168','2014-11-03 11:55:33'),(101,2,'192.168','2014-11-03 11:55:52'),(102,2,'192.168','2014-11-03 11:57:03'),(103,2,'192.168','2014-11-03 11:57:35'),(104,2,'192.168','2014-11-03 11:58:55'),(105,2,'192.168','2014-11-03 11:59:20'),(106,2,'192.168','2014-11-03 11:59:36'),(107,2,'192.168','2014-11-03 11:59:56'),(108,2,'192.168','2014-11-03 12:01:27'),(109,2,'192.168','2014-11-03 12:01:39'),(110,2,'192.168','2014-11-03 12:02:06'),(111,2,'192.168','2014-11-03 12:02:30'),(112,2,'192.168','2014-11-03 12:02:41'),(113,2,'192.168','2014-11-03 13:05:48'),(114,2,'192.168','2014-11-03 13:37:26'),(115,2,'192.168','2014-11-03 13:37:32'),(116,2,'192.168','2014-11-04 10:00:59'),(117,2,'192.168','2014-11-04 10:44:23'),(118,2,'192.168','2014-11-04 16:57:34'),(119,2,'192.168','2014-11-04 17:28:37'),(120,2,'192.168','2014-11-04 19:11:35'),(121,2,'192.168','2014-11-04 22:40:55');

/*Table structure for table `StaffActions` */

DROP TABLE IF EXISTS `StaffActions`;

CREATE TABLE `StaffActions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(11) DEFAULT NULL,
  `NavigationActions_id` int(11) DEFAULT NULL,
  `actionTime` timestamp NULL DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `AccessLogs_id` int(11) DEFAULT NULL,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `ClaimContacts_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `StaffActions_Staff_idx` (`Staff_id`),
  KEY `StaffActions_AccessLogs_idx` (`AccessLogs_id`),
  KEY `StaffActions_NavigationActions_idx` (`NavigationActions_id`),
  KEY `StaffActions_Claims_idx` (`Claims_id`),
  KEY `StaffActions_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `StaffActions_ClaimsContacts_idx` (`ClaimContacts_id`),
  CONSTRAINT `StaffActions_AccessLogs` FOREIGN KEY (`AccessLogs_id`) REFERENCES `StaffAccessLogs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `StaffActions_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `StaffActions_ClaimsContacts` FOREIGN KEY (`ClaimContacts_id`) REFERENCES `ClaimsContacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `StaffActions_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `StaffActions_NavigationActions` FOREIGN KEY (`NavigationActions_id`) REFERENCES `NavigationActions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `StaffActions_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `StaffActions` */

/*Table structure for table `StaffAuthorizationTokens` */

DROP TABLE IF EXISTS `StaffAuthorizationTokens`;

CREATE TABLE `StaffAuthorizationTokens` (
  `token` varchar(40) NOT NULL,
  `decayTime` timestamp NULL DEFAULT NULL,
  `ipAddress` char(15) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`token`),
  KEY `AuthorizationTokens_Staff_idx` (`Staff_id`),
  CONSTRAINT `AuthorizationTokens_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
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
  `lastModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Staff_id` int(11) DEFAULT NULL,
  `roles` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `Clients_UserAuthorizations_client_idx` (`Staff_id`),
  CONSTRAINT `StaffAuthorizations_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8;

/*Data for the table `StaffAuthorizations` */

insert  into `StaffAuthorizations`(`id`,`username`,`password`,`passwordHistory`,`status`,`lastModified`,`Staff_id`,`roles`) values (34,'qaab','$1$ZNJVddJl$wlPuSJc7L9blG9/XfmcS5/','$1$ZNJVddJl$wlPuSJc7L9blG9/XfmcS5/','active','2014-10-16 09:53:24',84,'IS_CUSTOMER_SERVICE|IS_DEPT_MANAGER|IS_ESTIMATOR|IS_POWER_USER|IS_PROJECT_COORDINATOR|IS_PROJECT_MANAGER|IS_PM_ASSISTANT|IS_MARKETING'),(47,'juliew','$1$FSGGfoPB$ehpN9z5EhpJu8x8odbRux0','$1$FSGGfoPB$ehpN9z5EhpJu8x8odbRux0','active','2014-10-16 14:22:26',93,'IS_MANAGER|IS_POWER_USER'),(48,'davem@phoenixrestorations.com',NULL,NULL,'active','2014-10-16 14:54:39',2,'IS_ADMINISTRATOR|IS_CLIENT|IS_CUSTOMER_SERVICE|IS_POWER_USER'),(57,'rhondas','$1$IHHMvIpU$DWGgj7rFId997..f.BBjB/','$1$IHHMvIpU$DWGgj7rFId997..f.BBjB/','active','2014-10-28 16:44:27',102,'IS_ACCOUNTING|IS_ACOUNTS_PAYABLE|IS_ADMINISTRATOR|IS_MANAGER|IS_POWER_USER|IS_PROJECT_MANAGER|IS_PM_ASSISTANT');

/*Table structure for table `StaffDepartments` */

DROP TABLE IF EXISTS `StaffDepartments`;

CREATE TABLE `StaffDepartments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Staff_id` int(11) DEFAULT NULL,
  `Departments_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `StaffDepartments_Staff_idx` (`Staff_id`),
  KEY `StaffDepartments_Departments_idx` (`Departments_id`),
  CONSTRAINT `StaffDepartments_Departments` FOREIGN KEY (`Departments_id`) REFERENCES `Departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `StaffDepartments_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `StaffDepartments` */

/*Table structure for table `StaffNotificationTypes` */

DROP TABLE IF EXISTS `StaffNotificationTypes`;

CREATE TABLE `StaffNotificationTypes` (
  `id` int(11) NOT NULL,
  `notificationType` varchar(45) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `StaffNotificationTypes` */

/*Table structure for table `StaffNotifications` */

DROP TABLE IF EXISTS `StaffNotifications`;

CREATE TABLE `StaffNotifications` (
  `id` int(11) NOT NULL,
  `StaffNotificationTypes_id` int(11) DEFAULT NULL,
  `fromStaff_id` int(11) DEFAULT NULL,
  `toStaff_id` int(11) DEFAULT NULL,
  `entryDate` timestamp NULL DEFAULT NULL,
  `actionRequired` tinyint(1) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `viewed` tinyint(1) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `StaffNotifications_StaffNotificationTypes_idx` (`StaffNotificationTypes_id`),
  KEY `StaffNotifications_fromStaff_idx` (`fromStaff_id`),
  KEY `StaffNotifications_toStaff_idx` (`toStaff_id`),
  CONSTRAINT `StaffNotifications_fromStaff` FOREIGN KEY (`fromStaff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `StaffNotifications_StaffNotificationTypes` FOREIGN KEY (`StaffNotificationTypes_id`) REFERENCES `StaffNotificationTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `StaffNotifications_toStaff` FOREIGN KEY (`toStaff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `StaffNotifications` */

/*Table structure for table `StaffScheduling` */

DROP TABLE IF EXISTS `StaffScheduling`;

CREATE TABLE `StaffScheduling` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateOnSite` date DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `Claims_id` int(11) DEFAULT NULL,
  `WorkTypes_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `StaffScheduling_Staff_idx` (`Staff_id`),
  KEY `StaffScheduling_Claims_idx` (`Claims_id`),
  KEY `StaffScheduling_WorkTypes` (`WorkTypes_id`),
  CONSTRAINT `StaffScheduling_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `ClaimsStaff` (`Clams_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `StaffScheduling_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `ClaimsStaff` (`Staff_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `StaffScheduling_WorkTypes` FOREIGN KEY (`WorkTypes_id`) REFERENCES `WorkTypes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `StaffScheduling` */

/*Table structure for table `StaffTypes` */

DROP TABLE IF EXISTS `StaffTypes`;

CREATE TABLE `StaffTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeOfStaff` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `StaffTypes` */

insert  into `StaffTypes`(`id`,`typeOfStaff`) values (1,'test');

/*Table structure for table `SubContactorWorkRatingsQuestions` */

DROP TABLE IF EXISTS `SubContactorWorkRatingsQuestions`;

CREATE TABLE `SubContactorWorkRatingsQuestions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `SubContactorWorkRatingsQuestions` */

/*Table structure for table `SubcontractorAuthorizations` */

DROP TABLE IF EXISTS `SubcontractorAuthorizations`;

CREATE TABLE `SubcontractorAuthorizations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `passwordHistory` varchar(500) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `lastModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Subcontractors_id` int(11) DEFAULT NULL,
  `roles` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `SubcontractorAuthorizations_username_unique` (`username`),
  KEY `SubcontractorAuthorizations_Subcontractors_idx` (`Subcontractors_id`),
  CONSTRAINT `SubcontractorAuthorizations_Subcontractors` FOREIGN KEY (`Subcontractors_id`) REFERENCES `Subcontractors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `SubcontractorAuthorizations` */

/*Table structure for table `SubcontractorContacts` */

DROP TABLE IF EXISTS `SubcontractorContacts`;

CREATE TABLE `SubcontractorContacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `hours` varchar(45) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `Subcontractors_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `SubcontractorContacts_Subcontractors_idx` (`Subcontractors_id`),
  CONSTRAINT `SubcontractorContacts_Subcontractors` FOREIGN KEY (`Subcontractors_id`) REFERENCES `Subcontractors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='		';

/*Data for the table `SubcontractorContacts` */

insert  into `SubcontractorContacts`(`id`,`name`,`email`,`mobile`,`telephone`,`hours`,`rating`,`notes`,`Subcontractors_id`) values (1,'dave','here','123','123','8:00am - 5:00pm',NULL,NULL,1);

/*Table structure for table `SubcontractorTokens` */

DROP TABLE IF EXISTS `SubcontractorTokens`;

CREATE TABLE `SubcontractorTokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(40) DEFAULT NULL,
  `decayTime` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ipAddress` char(15) DEFAULT NULL,
  `Subcontractors_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `SubcontractorTokens_Subcontractor_idx` (`Subcontractors_id`),
  CONSTRAINT `SubcontractorTokens_Subcontractor` FOREIGN KEY (`Subcontractors_id`) REFERENCES `Subcontractors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `SubcontractorTokens` */

/*Table structure for table `SubcontractorTypes` */

DROP TABLE IF EXISTS `SubcontractorTypes`;

CREATE TABLE `SubcontractorTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contractorType` varchar(45) DEFAULT NULL COMMENT 'plumbing, dry cleaning....',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `SubcontractorTypes` */

insert  into `SubcontractorTypes`(`id`,`contractorType`) values (1,'Plumbing'),(2,'Electrical'),(3,'Material Supply'),(4,'Equipment Supply'),(5,'Dry Cleaning');

/*Table structure for table `SubcontractorWorkRatings` */

DROP TABLE IF EXISTS `SubcontractorWorkRatings`;

CREATE TABLE `SubcontractorWorkRatings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SubcontractorContacts_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `evaluationDate` date DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `overallRating` float DEFAULT NULL,
  `comments` varchar(500) DEFAULT NULL,
  `futureRecommendation` tinyint(1) DEFAULT NULL,
  `largerSmallerRecommendation` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `SubcontractorWorkRatings_Subcontractors_idx` (`SubcontractorContacts_id`),
  KEY `SubcontractorWorkRatings_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `SubcontractorWorkRatings_Staff_idx` (`Staff_id`),
  CONSTRAINT `SubcontractorWorkRatings_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SubcontractorWorkRatings_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SubcontractorWorkRatings_Subcontractors` FOREIGN KEY (`SubcontractorContacts_id`) REFERENCES `SubcontractorContacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `SubcontractorWorkRatings` */

/*Table structure for table `SubcontractorWorkRatingsResponses` */

DROP TABLE IF EXISTS `SubcontractorWorkRatingsResponses`;

CREATE TABLE `SubcontractorWorkRatingsResponses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SubcontractorWorkRatings_id` int(11) DEFAULT NULL,
  `SubcontractorWorkRatingsQuestions_id` int(11) DEFAULT NULL,
  `response` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `SubcontractorWorkRatingsResponses_SubcontractorWorkRatings_idx` (`SubcontractorWorkRatings_id`),
  KEY `SubcontractorWorkRatingsResponses_SubcontractorWorkRatingsQ_idx` (`SubcontractorWorkRatingsQuestions_id`),
  CONSTRAINT `SubcontractorWorkRatingsResponses_Questions` FOREIGN KEY (`SubcontractorWorkRatingsQuestions_id`) REFERENCES `SubContactorWorkRatingsQuestions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SubcontractorWorkRatingsResponses_Ratings` FOREIGN KEY (`SubcontractorWorkRatings_id`) REFERENCES `SubcontractorWorkRatings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `SubcontractorWorkRatingsResponses` */

/*Table structure for table `Subcontractors` */

DROP TABLE IF EXISTS `Subcontractors`;

CREATE TABLE `Subcontractors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyName` varchar(100) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `Provinces_id` int(11) DEFAULT NULL,
  `postalCode` varchar(7) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `SubcontractorTypes_id` int(11) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `isPreferred` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Subcontractors_SubcontractorsTypes_idx` (`SubcontractorTypes_id`),
  KEY `Subcontractors_Provinces_idx` (`Provinces_id`),
  CONSTRAINT `Subcontractors_Provinces` FOREIGN KEY (`Provinces_id`) REFERENCES `Provinces` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Subcontractors_SubcontractorsTypes` FOREIGN KEY (`SubcontractorTypes_id`) REFERENCES `SubcontractorTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `Subcontractors` */

insert  into `Subcontractors`(`id`,`companyName`,`email`,`url`,`telephone`,`fax`,`address1`,`address2`,`city`,`Provinces_id`,`postalCode`,`notes`,`SubcontractorTypes_id`,`rating`,`isPreferred`) values (1,'test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2,NULL,NULL),(2,'joe`s plumbing','test@jp.com','www.test.com','123-123-1233',NULL,'1234 main st',NULL,'Vancouver',1,'v4v4v4',NULL,3,NULL,1);

/*Table structure for table `SuppliesUsed` */

DROP TABLE IF EXISTS `SuppliesUsed`;

CREATE TABLE `SuppliesUsed` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this table is for inventory used on a job that can be tracked for cost cards',
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimPhases_id` int(11) DEFAULT NULL,
  `dateUsed` date DEFAULT NULL,
  `Vehicles_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `Departments_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `SuppliesUsed_Claims_idx` (`Claims_id`),
  KEY `SuppliesUsed_ClaimPhases_idx` (`ClaimPhases_id`),
  KEY `SuppliesUsed_Vehicles_idx` (`Vehicles_id`),
  KEY `SuppliesUsed_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `SuppliesUsed_Staff_idx` (`Staff_id`),
  KEY `SuppliesUsed_Departments_idx` (`Departments_id`),
  CONSTRAINT `SuppliesUsed_ClaimPhases` FOREIGN KEY (`ClaimPhases_id`) REFERENCES `ClaimPhases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SuppliesUsed_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SuppliesUsed_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SuppliesUsed_Departments` FOREIGN KEY (`Departments_id`) REFERENCES `Departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SuppliesUsed_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SuppliesUsed_Vehicles` FOREIGN KEY (`Vehicles_id`) REFERENCES `Vehicles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `SuppliesUsed` */

/*Table structure for table `SuppliesUsedInventoryItems` */

DROP TABLE IF EXISTS `SuppliesUsedInventoryItems`;

CREATE TABLE `SuppliesUsedInventoryItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SuppliesUsed_id` int(11) DEFAULT NULL,
  `MaterialInventories_id` int(11) DEFAULT NULL,
  `VariantOptions_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `manualDescription` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `SuppliesUsedInventoryItems_SuppliesUsed_idx` (`SuppliesUsed_id`),
  KEY `SuppliesUsedInventoryItems_MaterialInventories_idx` (`MaterialInventories_id`),
  KEY `SuppliesUsedInventoryItems_VariantOptions_idx` (`VariantOptions_id`),
  CONSTRAINT `SuppliesUsedInventoryItems_MaterialInventories` FOREIGN KEY (`MaterialInventories_id`) REFERENCES `MaterialInventories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SuppliesUsedInventoryItems_SuppliesUsed` FOREIGN KEY (`SuppliesUsed_id`) REFERENCES `SuppliesUsed` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SuppliesUsedInventoryItems_VariantOptions` FOREIGN KEY (`VariantOptions_id`) REFERENCES `VariantOptions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `SuppliesUsedInventoryItems` */

/*Table structure for table `SupplySheets` */

DROP TABLE IF EXISTS `SupplySheets`;

CREATE TABLE `SupplySheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'this table tracks supply sheets for vehicles.',
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimPhases_id` int(11) DEFAULT NULL,
  `dateReceived` date DEFAULT NULL,
  `Vehicles_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `Departments_id` int(11) DEFAULT NULL COMMENT 'this would be either:',
  PRIMARY KEY (`id`),
  KEY `SupplySheets_Claims_idx` (`Claims_id`),
  KEY `SupplySheets_ClaimsPhases_idx` (`ClaimPhases_id`),
  KEY `SupplySheets_Vehicles_idx` (`Vehicles_id`),
  KEY `SupplySheets_ClaimsLocations_idx` (`ClaimsLocations_id`),
  KEY `SupplySheets_Staff_idx` (`Staff_id`),
  KEY `SupplySheets_Departments_idx` (`Departments_id`),
  CONSTRAINT `SupplySheets_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SupplySheets_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SupplySheets_ClaimsPhases` FOREIGN KEY (`ClaimPhases_id`) REFERENCES `ClaimPhases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SupplySheets_Departments` FOREIGN KEY (`Departments_id`) REFERENCES `Departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SupplySheets_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SupplySheets_Vehicles` FOREIGN KEY (`Vehicles_id`) REFERENCES `Vehicles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `SupplySheets` */

/*Table structure for table `SupplySheetsInventoryItems` */

DROP TABLE IF EXISTS `SupplySheetsInventoryItems`;

CREATE TABLE `SupplySheetsInventoryItems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SupplySheets_id` int(11) DEFAULT NULL,
  `MaterialInventories_id` int(11) DEFAULT NULL,
  `VariantOptions_id` int(11) DEFAULT NULL COMMENT 'this is for S, M , L, XL etc...',
  `quantity` float DEFAULT NULL,
  `manualDescription` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `SupplySheetsInventoryItems_SupplySheets_idx` (`SupplySheets_id`),
  KEY `SupplySheetsInventoryItems_MaterialInventories_idx` (`MaterialInventories_id`),
  KEY `SupplySheetsInventoryItems_VariantOptions_idx` (`VariantOptions_id`),
  CONSTRAINT `SupplySheetsInventoryItems_MaterialInventories` FOREIGN KEY (`MaterialInventories_id`) REFERENCES `MaterialInventories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SupplySheetsInventoryItems_SupplySheets` FOREIGN KEY (`SupplySheets_id`) REFERENCES `SupplySheets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `SupplySheetsInventoryItems_VariantOptions` FOREIGN KEY (`VariantOptions_id`) REFERENCES `VariantOptions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `SupplySheetsInventoryItems` */

/*Table structure for table `UrgencyTypes` */

DROP TABLE IF EXISTS `UrgencyTypes`;

CREATE TABLE `UrgencyTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `urgency` varchar(45) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `UrgencyTypes` */

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

/*Table structure for table `VariantGroups` */

DROP TABLE IF EXISTS `VariantGroups`;

CREATE TABLE `VariantGroups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `VariantGroups` */

/*Table structure for table `VariantGroupsI18n` */

DROP TABLE IF EXISTS `VariantGroupsI18n`;

CREATE TABLE `VariantGroupsI18n` (
  `VariantGroups_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  UNIQUE KEY `VariantGroups_id_UNIQUE` (`VariantGroups_id`),
  UNIQUE KEY `locale_UNIQUE` (`locale`),
  CONSTRAINT `VariantGroupsI18n_VariantGroups` FOREIGN KEY (`VariantGroups_id`) REFERENCES `VariantGroups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `VariantGroupsI18n` */

/*Table structure for table `VariantOptions` */

DROP TABLE IF EXISTS `VariantOptions`;

CREATE TABLE `VariantOptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `VariantOptions` */

/*Table structure for table `VariantOptionsI18n` */

DROP TABLE IF EXISTS `VariantOptionsI18n`;

CREATE TABLE `VariantOptionsI18n` (
  `VariantOptions_id` int(11) DEFAULT NULL,
  `option` varchar(45) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  UNIQUE KEY `VariantOptions_id_UNIQUE` (`VariantOptions_id`),
  UNIQUE KEY `locale_UNIQUE` (`locale`),
  CONSTRAINT `VariantOptionsI18n_VariantOptions` FOREIGN KEY (`VariantOptions_id`) REFERENCES `VariantOptions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `VariantOptionsI18n` */

/*Table structure for table `Vehicles` */

DROP TABLE IF EXISTS `Vehicles`;

CREATE TABLE `Vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Departments_id` int(11) DEFAULT NULL,
  `Staff_id` int(11) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `licensePlate` char(7) DEFAULT NULL,
  `isPrivateOwned` tinyint(1) DEFAULT NULL,
  `internalNumber` char(3) DEFAULT NULL,
  `externalNumber` char(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Vehicles_Staff_idx` (`Staff_id`),
  KEY `Vehicles_Departments_idx` (`Departments_id`),
  CONSTRAINT `Vehicles_Departments` FOREIGN KEY (`Departments_id`) REFERENCES `Departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `Vehicles_Staff` FOREIGN KEY (`Staff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `Vehicles` */

/*Table structure for table `Vendors` */

DROP TABLE IF EXISTS `Vendors`;

CREATE TABLE `Vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(45) DEFAULT NULL,
  `url` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `tollFree` varchar(45) DEFAULT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `address2` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `Provinces_id` int(11) DEFAULT NULL,
  `postalCode` varchar(7) DEFAULT NULL,
  `accountId` varchar(45) DEFAULT NULL,
  `salesRep` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `Vendors` */

/*Table structure for table `WarehouseLocations` */

DROP TABLE IF EXISTS `WarehouseLocations`;

CREATE TABLE `WarehouseLocations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parentId` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `WarehouseLocations` */

/*Table structure for table `WorkOrderDetails` */

DROP TABLE IF EXISTS `WorkOrderDetails`;

CREATE TABLE `WorkOrderDetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Departments_id` int(11) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `ClaimPhases_id` int(11) DEFAULT NULL,
  `WorkOrders_id` int(11) DEFAULT NULL,
  `PurchaseOrders_id` int(11) DEFAULT NULL,
  `SubContractors_id` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `value` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `WorkOrderDetails_WorkOrders_idx` (`WorkOrders_id`),
  KEY `WorkOrderDetails_Departments_idx` (`Departments_id`),
  KEY `WorkOrderDetails_SubContractors_idx` (`SubContractors_id`),
  CONSTRAINT `WorkOrderDetails_Departments` FOREIGN KEY (`Departments_id`) REFERENCES `Departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `WorkOrderDetails_SubContractors` FOREIGN KEY (`SubContractors_id`) REFERENCES `Subcontractors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `WorkOrderDetails_WorkOrders` FOREIGN KEY (`WorkOrders_id`) REFERENCES `WorkOrders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `WorkOrderDetails` */

/*Table structure for table `WorkOrderRequests` */

DROP TABLE IF EXISTS `WorkOrderRequests`;

CREATE TABLE `WorkOrderRequests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) DEFAULT NULL,
  `additionalInstructions` varchar(500) DEFAULT NULL,
  `requestDate` date DEFAULT NULL,
  `entryStaff_id` int(11) DEFAULT NULL,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `WorkOrderRequests_Staff_idx` (`entryStaff_id`),
  KEY `WorkOrderRequests_Claims_idx` (`Claims_id`),
  KEY `WorkOrderRequests_ClaimsLocations_idx` (`ClaimsLocations_id`),
  CONSTRAINT `WorkOrderRequests_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `WorkOrderRequests_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `WorkOrderRequests_Staff` FOREIGN KEY (`entryStaff_id`) REFERENCES `Staff` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `WorkOrderRequests` */

/*Table structure for table `WorkOrderRequestsDetails` */

DROP TABLE IF EXISTS `WorkOrderRequestsDetails`;

CREATE TABLE `WorkOrderRequestsDetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Departments_id` int(11) DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `ClaimPhases_id` int(11) DEFAULT NULL,
  `WorkOrderRequests_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `WorkOrderRequestsDetails_Departments_idx` (`Departments_id`),
  KEY `WorkOrderRequestsDetails_ClaimPhases_idx` (`ClaimPhases_id`),
  KEY `WorkOrderRequestsDetails_WorkOrderRequests_idx` (`WorkOrderRequests_id`),
  CONSTRAINT `WorkOrderRequestsDetails_ClaimPhases` FOREIGN KEY (`ClaimPhases_id`) REFERENCES `ClaimPhases` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `WorkOrderRequestsDetails_Departments` FOREIGN KEY (`Departments_id`) REFERENCES `Departments` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `WorkOrderRequestsDetails_WorkOrderRequests` FOREIGN KEY (`WorkOrderRequests_id`) REFERENCES `WorkOrderRequests` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `WorkOrderRequestsDetails` */

/*Table structure for table `WorkOrders` */

DROP TABLE IF EXISTS `WorkOrders`;

CREATE TABLE `WorkOrders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateIssued` date DEFAULT NULL,
  `WorkOrderRequests_id` int(11) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `additionalInstructions` varchar(200) DEFAULT NULL,
  `Claims_id` int(11) DEFAULT NULL,
  `ClaimsLocations_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `WorkOrders_WorkOrderRequests_idx` (`WorkOrderRequests_id`),
  KEY `WorkOrders_Claims_idx` (`Claims_id`),
  KEY `WorkOrders_ClaimsLocations_idx` (`ClaimsLocations_id`),
  CONSTRAINT `WorkOrders_Claims` FOREIGN KEY (`Claims_id`) REFERENCES `Claims` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `WorkOrders_ClaimsLocations` FOREIGN KEY (`ClaimsLocations_id`) REFERENCES `ClaimsLocations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `WorkOrders_WorkOrderRequests` FOREIGN KEY (`WorkOrderRequests_id`) REFERENCES `WorkOrderRequests` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `WorkOrders` */

/*Table structure for table `WorkTypes` */

DROP TABLE IF EXISTS `WorkTypes`;

CREATE TABLE `WorkTypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `layer` int(11) DEFAULT NULL,
  `Departments_id` int(11) DEFAULT NULL,
  `ClaimPhases_id` int(11) DEFAULT NULL,
  `dateModified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `code` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `WorkTypes` */

/*Table structure for table `WorkTypesI18n` */

DROP TABLE IF EXISTS `WorkTypesI18n`;

CREATE TABLE `WorkTypesI18n` (
  `WorkTypes_id` int(11) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  `work` varchar(200) DEFAULT NULL,
  UNIQUE KEY `WorkTypesI18n_locale_worktypes_idx` (`WorkTypes_id`,`locale`),
  CONSTRAINT `WorkTypesI18n_workTypes` FOREIGN KEY (`WorkTypes_id`) REFERENCES `WorkTypes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `WorkTypesI18n` */

/*Table structure for table `WorkTypesI18n_deprecated` */

DROP TABLE IF EXISTS `WorkTypesI18n_deprecated`;

CREATE TABLE `WorkTypesI18n_deprecated` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `WorkTypes_id` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `locale` char(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `WorkTypesI18n_deprecated` */

/*Table structure for table `WorkTypes_deprecated` */

DROP TABLE IF EXISTS `WorkTypes_deprecated`;

CREATE TABLE `WorkTypes_deprecated` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateModified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `code` varbinary(6) DEFAULT NULL,
  `Departments_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `WorkTypes_deprecated` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
