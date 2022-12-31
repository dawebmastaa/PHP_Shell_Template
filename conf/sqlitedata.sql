CREATE TABLE `AdminSiteLinks` (
                                  `SiteLinkID` int(11) NOT NULL,
                                  `SectionID` int(11) NOT NULL DEFAULT 0,
                                  `LinkText` varchar(255) NOT NULL DEFAULT '',
                                  `Link` varchar(255) NOT NULL DEFAULT '',
                                  `LinkTitle` varchar(255) NOT NULL DEFAULT '',
                                  `FileName` varchar(255) NOT NULL DEFAULT '',
                                  `PageTitle` varchar(255) NOT NULL DEFAULT '',
                                  `PageKeywords` varchar(255) DEFAULT NULL,
                                  `PageDescription` varchar(255) DEFAULT NULL
);

--
-- Dumping data for table `AdminSiteLinks`
--

INSERT INTO `AdminSiteLinks` (`SiteLinkID`, `SectionID`, `LinkText`, `Link`, `LinkTitle`, `FileName`, `PageTitle`, `PageKeywords`, `PageDescription`) VALUES
(1, 1, 'Add A User', 'control/usermanager/index/content/adduser/', 'Add A User', 'adduser', 'User Manager: Add A User', NULL, NULL),
(2, 1, 'Manage Users', 'control/usermanager/index/content/edituser/', 'Manage Users', 'edituser', 'User Manager: Manage Users', NULL, NULL),
(7, 3, 'Manage Site Content', 'control/sitemanager/index/content/editpages/', 'Manage Site Content', 'editpages', 'Site Manager: Manage Site Content', NULL, NULL);


CREATE TABLE `AdminSiteSections` (
                                     `SectionID` int(11) NOT NULL,
                                     `RoleID` int(3) NOT NULL DEFAULT 0,
                                     `Section` varchar(255) NOT NULL DEFAULT '',
                                     `Directory` varchar(40) NOT NULL DEFAULT '',
                                     `SectionTitle` varchar(100) DEFAULT NULL,
                                     `DisplayOrder` int(3) DEFAULT NULL,
                                     `MakeLive` varchar(1) NOT NULL DEFAULT 'N',
                                     `MenuWidth` varchar(255) DEFAULT NULL
);

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
                                        `SiteLinkID` varchar(100) NOT NULL DEFAULT '',
                                        `SectionID` int(11) DEFAULT NULL,
                                        `LinkText` varchar(255) NOT NULL DEFAULT '',
                                        `Link` varchar(255) NOT NULL DEFAULT '',
                                        `LinkTitle` varchar(255) NOT NULL DEFAULT '',
                                        `FileName` varchar(255) NOT NULL DEFAULT '',
                                        `PageTitle` varchar(255) NOT NULL DEFAULT '',
                                        `PageKeywords` varchar(255) DEFAULT NULL,
                                        `PageDescription` varchar(255) DEFAULT NULL);


CREATE TABLE `SiteLinks` (
                             `SiteLinkID` int(11) NOT NULL,
                             `SectionID` int(11) NOT NULL DEFAULT 0,
                             `LinkText` varchar(255) NOT NULL DEFAULT '',
                             `Link` varchar(255) NOT NULL DEFAULT '',
                             `LinkTitle` varchar(255) NOT NULL DEFAULT '',
                             `FileName` varchar(255) NOT NULL DEFAULT '',
                             `PageTitle` varchar(255) DEFAULT NULL,
                             `PageKeywords` varchar(255) DEFAULT NULL,
                             `PageDescription` varchar(255) DEFAULT NULL,
                             `PageRobots` varchar(255) DEFAULT NULL,
                             `MakeLive` varchar(1) NOT NULL DEFAULT 'N'
) ;

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
                                `Section` varchar(255) NOT NULL DEFAULT '',
                                `Directory` varchar(40) NOT NULL DEFAULT '',
                                `SectionTitle` varchar(100) DEFAULT NULL,
                                `SectionKeywords` varchar(255) DEFAULT NULL,
                                `SectionDescription` varchar(255) DEFAULT NULL,
                                `SectionRobots` varchar(255) DEFAULT NULL,
                                `DisplayOrder` int(3) DEFAULT 0,
                                `MakeLive` varchar(1) NOT NULL DEFAULT 'N',
                                `MenuWidth` varchar(255) DEFAULT NULL
) ;

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
                                   `SiteLinkID` varchar(100) DEFAULT NULL,
                                   `SubNavLinkID` varchar(100) DEFAULT NULL,
                                   `SectionID` int(11) DEFAULT 0,
                                   `LinkText` varchar(255) NOT NULL DEFAULT '',
                                   `Link` varchar(255) NOT NULL DEFAULT '',
                                   `LinkTitle` varchar(255) NOT NULL DEFAULT '',
                                   `FileName` varchar(255) NOT NULL DEFAULT '',
                                   `PageTitle` varchar(255) DEFAULT NULL,
                                   `PageKeywords` varchar(255) DEFAULT NULL,
                                   `PageDescription` varchar(255) DEFAULT NULL,
                                   `PageRobots` varchar(255) DEFAULT NULL,
                                   `MakeLive` varchar(1) DEFAULT 'N'
);

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
                             `Role` varchar(50) NOT NULL DEFAULT ''
) ;

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
                         `FirstName` varchar(25) NOT NULL DEFAULT '',
                         `LastName` varchar(25) NOT NULL DEFAULT '',
                         `UserName` varchar(25) NOT NULL DEFAULT '',
                         `Password` varchar(75) NOT NULL DEFAULT '',
                         `EmailAddress` varchar(50) NOT NULL DEFAULT '',
                         `Admin` varchar(1) NOT NULL DEFAULT 'N',
                         `RoleID` int(3) NOT NULL DEFAULT 0
);

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `FirstName`, `LastName`, `UserName`, `Password`, `EmailAddress`, `Admin`, `RoleID`) VALUES
(4, 'Mike', 'Alberts', 'dawebmasta', '*D58D8A65798F2C17A0F11BE5F6305FA338158932', 'mikealberts@gmail.com', 'Y', 1),
(6, 'General', 'User', 'generaluser', '', 'm_alberts@hotmail.com', 'N', 3);
