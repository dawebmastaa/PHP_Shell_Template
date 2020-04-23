-- MySQL dump 10.13  Distrib 5.1.42, for mandriva-linux-gnu (i586)
--
-- Host: localhost    Database: ShellData
-- ------------------------------------------------------
-- Server version	5.1.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `AdminSiteLinks`
--

DROP TABLE IF EXISTS `AdminSiteLinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AdminSiteLinks` (
  `SiteLinkID` int(11) NOT NULL AUTO_INCREMENT,
  `SectionID` int(11) NOT NULL DEFAULT '0',
  `LinkText` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `LinkTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `PageTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `PageKeywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PageDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`SiteLinkID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AdminSiteLinks`
--

LOCK TABLES `AdminSiteLinks` WRITE;
/*!40000 ALTER TABLE `AdminSiteLinks` DISABLE KEYS */;
INSERT INTO `AdminSiteLinks` VALUES (1,1,'Add A User','control/usermanager/index/content/adduser/','Add A User','adduser','User Manager: Add A User',NULL,NULL),(2,1,'Manage Users','control/usermanager/index/content/edituser/','Manage Users','edituser','User Manager: Manage Users',NULL,NULL),(3,2,'Add A Link','control/linkmanager/index/content/addlink/','Add A Link','addlink','Link Manager: Add A Link',NULL,NULL),(4,2,'Manage Links','control/linkmanager/index/content/editlinks/','Manage Links','editlinks','Link Manager: Manage Links',NULL,NULL),(5,2,'Manage Link Categories','control/linkmanager/index/content/editlinkcategories/','Manage Link Categories','editlinkcategories','Link Manager: Manage Link Categories',NULL,NULL),(6,2,'Manager Link Partners','control/linkmanager/index/content/editlinkpartners/','Manage Link Partners','editlinkpartners','Link Manager: Manage Link Partners',NULL,NULL),(7,3,'Manage Site Content','control/sitemanager/index/content/editpages/','Manage Site Content','editpages','Site Manager: Manage Site Content',NULL,NULL);
/*!40000 ALTER TABLE `AdminSiteLinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AdminSiteSections`
--

DROP TABLE IF EXISTS `AdminSiteSections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AdminSiteSections` (
  `SectionID` int(11) NOT NULL AUTO_INCREMENT,
  `RoleID` int(3) NOT NULL DEFAULT '0',
  `Section` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Directory` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `SectionTitle` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DisplayOrder` int(3) DEFAULT NULL,
  `MakeLive` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `MenuWidth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`SectionID`),
  KEY `MakeLive` (`MakeLive`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AdminSiteSections`
--

LOCK TABLES `AdminSiteSections` WRITE;
/*!40000 ALTER TABLE `AdminSiteSections` DISABLE KEYS */;
INSERT INTO `AdminSiteSections` VALUES (1,1,'User Manager','usermanager','Site Admin: User Manager',1,'N','150'),(2,2,'Link Manager','linkmanager','Site Admin: Link Manager',2,'N','150'),(3,3,'Site Manager','sitemanager','Site Admin: Site Manager',3,'N','150');
/*!40000 ALTER TABLE `AdminSiteSections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `AdminSiteSubNavLinks`
--

DROP TABLE IF EXISTS `AdminSiteSubNavLinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AdminSiteSubNavLinks` (
  `SubNavID` int(11) NOT NULL AUTO_INCREMENT,
  `SiteLinkID` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `SectionID` int(11) DEFAULT NULL,
  `LinkText` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `LinkTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `PageTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `PageKeywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PageDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`SubNavID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AdminSiteSubNavLinks`
--

LOCK TABLES `AdminSiteSubNavLinks` WRITE;
/*!40000 ALTER TABLE `AdminSiteSubNavLinks` DISABLE KEYS */;
/*!40000 ALTER TABLE `AdminSiteSubNavLinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LinkCategories`
--

DROP TABLE IF EXISTS `LinkCategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LinkCategories` (
  `CategoryID` int(6) NOT NULL AUTO_INCREMENT,
  `Category` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LinkCategories`
--

LOCK TABLES `LinkCategories` WRITE;
/*!40000 ALTER TABLE `LinkCategories` DISABLE KEYS */;
INSERT INTO `LinkCategories` VALUES (62,'Test Category');
/*!40000 ALTER TABLE `LinkCategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LinkPartners`
--

DROP TABLE IF EXISTS `LinkPartners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LinkPartners` (
  `PartnerID` int(6) NOT NULL AUTO_INCREMENT,
  `PartnerName` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `PartnerEmail` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`PartnerID`)
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LinkPartners`
--

LOCK TABLES `LinkPartners` WRITE;
/*!40000 ALTER TABLE `LinkPartners` DISABLE KEYS */;
INSERT INTO `LinkPartners` VALUES (204,'Some Link Partner','someone@somewhere.com');
/*!40000 ALTER TABLE `LinkPartners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LinkSubCategories`
--

DROP TABLE IF EXISTS `LinkSubCategories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LinkSubCategories` (
  `SubCategoryID` int(6) NOT NULL AUTO_INCREMENT,
  `SubCategory` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `CategoryID` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`SubCategoryID`),
  KEY `CategoryID` (`CategoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LinkSubCategories`
--

LOCK TABLES `LinkSubCategories` WRITE;
/*!40000 ALTER TABLE `LinkSubCategories` DISABLE KEYS */;
INSERT INTO `LinkSubCategories` VALUES (40,'Test Link Category',62);
/*!40000 ALTER TABLE `LinkSubCategories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Links`
--

DROP TABLE IF EXISTS `Links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Links` (
  `LinkID` int(6) NOT NULL AUTO_INCREMENT,
  `CategoryID` int(6) NOT NULL DEFAULT '0',
  `SubCategoryID` int(6) DEFAULT '0',
  `PartnerID` int(6) NOT NULL DEFAULT '0',
  `IsReciprocal` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `HasReciprocated` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `ReciprocalLinkAddress` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SiteName` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `SiteDescription` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `DisplayCode` text COLLATE utf8_unicode_ci NOT NULL,
  `WebAddress` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ShowLink` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`LinkID`),
  KEY `CategoryID` (`CategoryID`),
  KEY `SubCategoryID` (`SubCategoryID`),
  KEY `PartnerID` (`PartnerID`)
) ENGINE=InnoDB AUTO_INCREMENT=280 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Links`
--

LOCK TABLES `Links` WRITE;
/*!40000 ALTER TABLE `Links` DISABLE KEYS */;
INSERT INTO `Links` VALUES (279,62,40,204,'N','N','','Some Link Site','','<a href=\"http://www.somewhere.com\">Click Here</a>',NULL,'Y');
/*!40000 ALTER TABLE `Links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SiteLinks`
--

DROP TABLE IF EXISTS `SiteLinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SiteLinks` (
  `SiteLinkID` int(11) NOT NULL AUTO_INCREMENT,
  `SectionID` int(11) NOT NULL DEFAULT '0',
  `LinkText` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `LinkTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `PageTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PageKeywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PageDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PageRobots` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MakeLive` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  PRIMARY KEY (`SiteLinkID`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SiteLinks`
--

LOCK TABLES `SiteLinks` WRITE;
/*!40000 ALTER TABLE `SiteLinks` DISABLE KEYS */;
INSERT INTO `SiteLinks` VALUES (106,75,'About Us','company/index/content/about/','About Us','about','About Us','About Us','About Us','','Y'),(107,75,'Contact Us','company/index/content/contact/','Contact Us','contact','Contact Us','ssarawe ','aeras srrvser','','Y');
/*!40000 ALTER TABLE `SiteLinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SiteSections`
--

DROP TABLE IF EXISTS `SiteSections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SiteSections` (
  `SectionID` int(11) NOT NULL AUTO_INCREMENT,
  `Section` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Directory` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `SectionTitle` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SectionKeywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SectionDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SectionRobots` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DisplayOrder` int(3) DEFAULT '0',
  `MakeLive` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `MenuWidth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`SectionID`),
  KEY `MakeLive` (`MakeLive`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SiteSections`
--

LOCK TABLES `SiteSections` WRITE;
/*!40000 ALTER TABLE `SiteSections` DISABLE KEYS */;
INSERT INTO `SiteSections` VALUES (1,'Home','main','Timeshare Broker Services -Sell &amp; Buy Timeshares on the Timeshare Resale Market and Save!','Timeshare Broker, Timeshare Brokerage, Timeshare Brokers, Buy Timeshare Real Estate, Sell Timeshare Broker Resales, Brokers buying timeshares, rent timeshare rental services','Buy resale timeshare and save! Timeshare resales are great vacation options. Check out our timeshare resales and rentals! Timeshare resale properties are the way to go!','index, follow',1,'N','150'),(75,'Company Information','company','Company Information','asdf','sadfasfe','',0,'Y','100');
/*!40000 ALTER TABLE `SiteSections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SiteSubNavLinks`
--

DROP TABLE IF EXISTS `SiteSubNavLinks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SiteSubNavLinks` (
  `SubNavID` int(11) NOT NULL AUTO_INCREMENT,
  `SiteLinkID` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SubNavLinkID` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SectionID` int(11) DEFAULT '0',
  `LinkText` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `LinkTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `FileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `PageTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PageKeywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PageDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PageRobots` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `MakeLive` enum('N','Y') COLLATE utf8_unicode_ci DEFAULT 'N',
  PRIMARY KEY (`SubNavID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SiteSubNavLinks`
--

LOCK TABLES `SiteSubNavLinks` WRITE;
/*!40000 ALTER TABLE `SiteSubNavLinks` DISABLE KEYS */;
/*!40000 ALTER TABLE `SiteSubNavLinks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserRoles`
--

DROP TABLE IF EXISTS `UserRoles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserRoles` (
  `RoleID` int(3) NOT NULL AUTO_INCREMENT,
  `Role` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserRoles`
--

LOCK TABLES `UserRoles` WRITE;
/*!40000 ALTER TABLE `UserRoles` DISABLE KEYS */;
INSERT INTO `UserRoles` VALUES (1,'Site Admin'),(2,'Link Admin'),(3,'General User');
/*!40000 ALTER TABLE `UserRoles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `UserID` int(10) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `LastName` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `UserName` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Password` varchar(75) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `EmailAddress` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `Admin` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `RoleID` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`UserID`),
  KEY `RoleID` (`RoleID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (4,'Mike','Alberts','DaWebMasta','','m_alberts@hotmail.com','Y',1),(5,'Link','Monkey','linkmonkey','','mikealberts@metrocast.net','N',2),(6,'General','User','generaluser','','m_alberts@hotmail.com','N',3);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'ShellData'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-01-26 13:53:24
