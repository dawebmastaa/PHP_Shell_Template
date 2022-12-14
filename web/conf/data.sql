-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 25, 2020 at 01:59 PM
-- Server version: 10.2.31-MariaDB-1:10.2.31+maria~bionic
-- PHP Version: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shell`
--

-- --------------------------------------------------------

--
-- Table structure for table `AdminSiteLinks`
--

CREATE TABLE `AdminSiteLinks` (
                                  `SiteLinkID` int(11) NOT NULL,
                                  `SectionID` int(11) NOT NULL DEFAULT 0,
                                  `LinkText` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                  `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                  `LinkTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                  `FileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                  `PageTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                  `PageKeywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                  `PageDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AdminSiteLinks`
--

INSERT INTO `AdminSiteLinks` (`SiteLinkID`, `SectionID`, `LinkText`, `Link`, `LinkTitle`, `FileName`, `PageTitle`, `PageKeywords`, `PageDescription`) VALUES
(1, 1, 'Add A User', 'control/usermanager/index/content/adduser/', 'Add A User', 'adduser', 'User Manager: Add A User', NULL, NULL),
(2, 1, 'Manage Users', 'control/usermanager/index/content/edituser/', 'Manage Users', 'edituser', 'User Manager: Manage Users', NULL, NULL),
(7, 3, 'Manage Site Content', 'control/sitemanager/index/content/editpages/', 'Manage Site Content', 'editpages', 'Site Manager: Manage Site Content', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `AdminSiteSections`
--

CREATE TABLE `AdminSiteSections` (
                                     `SectionID` int(11) NOT NULL,
                                     `RoleID` int(3) NOT NULL DEFAULT 0,
                                     `Section` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                     `Directory` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                     `SectionTitle` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
                                     `DisplayOrder` int(3) DEFAULT NULL,
                                     `MakeLive` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
                                     `MenuWidth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `AdminSiteSections`
--

INSERT INTO `AdminSiteSections` (`SectionID`, `RoleID`, `Section`, `Directory`, `SectionTitle`, `DisplayOrder`, `MakeLive`, `MenuWidth`) VALUES
(1, 1, 'User Manager', 'usermanager', 'Site Admin: User Manager', 1, 'N', '150'),
(3, 3, 'Site Manager', 'sitemanager', 'Site Admin: Site Manager', 3, 'N', '150');

-- --------------------------------------------------------

--
-- Table structure for table `AdminSiteSubNavLinks`
--

CREATE TABLE `AdminSiteSubNavLinks` (
                                        `SubNavID` int(11) NOT NULL,
                                        `SiteLinkID` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                        `SectionID` int(11) DEFAULT NULL,
                                        `LinkText` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                        `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                        `LinkTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                        `FileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                        `PageTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                        `PageKeywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                        `PageDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `SiteLinks`
--

CREATE TABLE `SiteLinks` (
                             `SiteLinkID` int(11) NOT NULL,
                             `SectionID` int(11) NOT NULL DEFAULT 0,
                             `LinkText` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                             `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                             `LinkTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                             `FileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                             `PageTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                             `PageKeywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                             `PageDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                             `PageRobots` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                             `MakeLive` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `SiteLinks`
--

INSERT INTO `SiteLinks` (`SiteLinkID`, `SectionID`, `LinkText`, `Link`, `LinkTitle`, `FileName`, `PageTitle`, `PageKeywords`, `PageDescription`, `PageRobots`, `MakeLive`) VALUES
(106, 75, 'About Us', 'company/index/content/about/', 'About Us', 'about', 'About Us', 'About Us', 'About Us', '', 'Y'),
(107, 75, 'Contact Us', 'company/index/content/contact/', 'Contact Us', 'contact', 'Contact Us', 'ssarawe ', 'aeras srrvser', '', 'Y'),
(109, 99, 'Product4', 'products/index/content/product4/', 'MouseOver Text', 'product4', 'Dis Be Da Page Title', 'asldjf alsjfalsjkf asldjfslafj asdfj  dasd as as asdf sdfad', 'sdf asf ddas fasf asdffd sadf asdf', '', 'Y'),
(110, 99, 'Product 6', 'products/index/content/product6/', 'mouseover title for product 6', 'product6', 'meta title tag', 'keywords, keywords, keywords', 'dis be da meta description', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `SiteSections`
--

CREATE TABLE `SiteSections` (
                                `SectionID` int(11) NOT NULL,
                                `Section` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                `Directory` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                `SectionTitle` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
                                `SectionKeywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                `SectionDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                `SectionRobots` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                `DisplayOrder` int(3) DEFAULT 0,
                                `MakeLive` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
                                `MenuWidth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `SiteSections`
--

INSERT INTO `SiteSections` (`SectionID`, `Section`, `Directory`, `SectionTitle`, `SectionKeywords`, `SectionDescription`, `SectionRobots`, `DisplayOrder`, `MakeLive`, `MenuWidth`) VALUES
(1, 'Home', 'main', 'Shell Setup Home Page Title', 'keywords, keywords,  keywords', 'Home page description for demo purposes', 'index, follow', 1, 'N', '150'),
(75, 'Company Information', 'company', 'Company Information', 'keywords, keywords, keywords', 'sadfasfe', '', 2, 'Y', '100'),
(99, 'Products', 'products', 'This Is The Products Page Title', 'asdf asf as fasf sf asdfd', 'sad fsdaf sdaf asdf ', '', 3, 'Y', '100'),
(100, 'Services', 'services', 'This Is The Services Page Title', 'service1 service2 blah blah blah', 'a meta description', '', 4, 'Y', '');

-- --------------------------------------------------------

--
-- Table structure for table `SiteSubNavLinks`
--

CREATE TABLE `SiteSubNavLinks` (
                                   `SubNavID` int(11) NOT NULL,
                                   `SiteLinkID` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
                                   `SubNavLinkID` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
                                   `SectionID` int(11) DEFAULT 0,
                                   `LinkText` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                   `Link` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                   `LinkTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                   `FileName` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                                   `PageTitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                   `PageKeywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                   `PageDescription` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                   `PageRobots` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
                                   `MakeLive` enum('N','Y') COLLATE utf8_unicode_ci DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `SiteSubNavLinks`
--

INSERT INTO `SiteSubNavLinks` (`SubNavID`, `SiteLinkID`, `SubNavLinkID`, `SectionID`, `LinkText`, `Link`, `LinkTitle`, `FileName`, `PageTitle`, `PageKeywords`, `PageDescription`, `PageRobots`, `MakeLive`) VALUES
(1, '/106/ /107/ ', NULL, 75, 'SubPage 1', 'company/index/content/subpage1', 'Just A Title', 'subpage1', 'This is the META title', 'some keywords', 'the meta description', '', 'Y'),
(2, '/106/ /107/ ', NULL, 75, 'SubPage 2', 'company/index/content/subpage2', 'Just A Title', 'subpage2', 'This is the META title 2', 'asf sadljf slfjk f', 'asfas sd earase aeraer ras ', '', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `UserRoles`
--

CREATE TABLE `UserRoles` (
                             `RoleID` int(3) NOT NULL,
                             `Role` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `UserRoles`
--

INSERT INTO `UserRoles` (`RoleID`, `Role`) VALUES
(1, 'Site Admin'),
(2, 'Link Admin'),
(3, 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
                         `UserID` int(10) NOT NULL,
                         `FirstName` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                         `LastName` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                         `UserName` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                         `Password` varchar(75) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                         `EmailAddress` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
                         `Admin` enum('N','Y') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
                         `RoleID` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `UserName`, `Password`, `EmailAddress`, `Admin`, `RoleID`) VALUES
(4, 'Mike', 'Alberts', 'dawebmasta', '*D58D8A65798F2C17A0F11BE5F6305FA338158932', 'mikealberts@gmail.com', 'Y', 1),
(6, 'General', 'User', 'generaluser', '', 'm_alberts@hotmail.com', 'N', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `AdminSiteLinks`
--
ALTER TABLE `AdminSiteLinks`
    ADD PRIMARY KEY (`SiteLinkID`);

--
-- Indexes for table `AdminSiteSections`
--
ALTER TABLE `AdminSiteSections`
    ADD PRIMARY KEY (`SectionID`),
    ADD KEY `MakeLive` (`MakeLive`);

--
-- Indexes for table `AdminSiteSubNavLinks`
--
ALTER TABLE `AdminSiteSubNavLinks`
    ADD PRIMARY KEY (`SubNavID`);

--
-- Indexes for table `SiteLinks`
--
ALTER TABLE `SiteLinks`
    ADD PRIMARY KEY (`SiteLinkID`);

--
-- Indexes for table `SiteSections`
--
ALTER TABLE `SiteSections`
    ADD PRIMARY KEY (`SectionID`),
    ADD KEY `MakeLive` (`MakeLive`);

--
-- Indexes for table `SiteSubNavLinks`
--
ALTER TABLE `SiteSubNavLinks`
    ADD PRIMARY KEY (`SubNavID`);

--
-- Indexes for table `UserRoles`
--
ALTER TABLE `UserRoles`
    ADD PRIMARY KEY (`RoleID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
    ADD PRIMARY KEY (`UserID`),
    ADD KEY `RoleID` (`RoleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `AdminSiteLinks`
--
ALTER TABLE `AdminSiteLinks`
    MODIFY `SiteLinkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `AdminSiteSections`
--
ALTER TABLE `AdminSiteSections`
    MODIFY `SectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `AdminSiteSubNavLinks`
--
ALTER TABLE `AdminSiteSubNavLinks`
    MODIFY `SubNavID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `SiteLinks`
--
ALTER TABLE `SiteLinks`
    MODIFY `SiteLinkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
--
-- AUTO_INCREMENT for table `SiteSections`
--
ALTER TABLE `SiteSections`
    MODIFY `SectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `SiteSubNavLinks`
--
ALTER TABLE `SiteSubNavLinks`
    MODIFY `SubNavID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `UserRoles`
--
ALTER TABLE `UserRoles`
    MODIFY `RoleID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
    MODIFY `UserID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;