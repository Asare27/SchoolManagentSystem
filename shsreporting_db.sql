-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2019 at 08:32 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shsreporting_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblaccounttype`
--

CREATE TABLE IF NOT EXISTS `tblaccounttype` (
  `typeid` varchar(30) NOT NULL,
  `accounttype` varchar(80) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `recordedby` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblaccounttype`
--

INSERT INTO `tblaccounttype` (`typeid`, `accounttype`, `datetimeentry`, `recordedby`, `status`) VALUES
('20191027111013_28AmwlNtYJ', 'Equipment A/C', '2019-10-27 15:39:22', 'MB_2019/1', 'active'),
('20191027111032_wSnX6qJlRs', 'Expense A/C', '2019-10-27 15:38:35', 'MB_2019/1', 'active'),
('20191027111035_qMWSr937hu', 'Bank A/C', '2019-10-27 15:38:48', 'MB_2019/1', 'active'),
('20191027111048_rUPnsRfDA3', 'Cash A/C', '2019-10-27 15:39:13', 'MB_2019/1', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `tbladministration`
--

CREATE TABLE IF NOT EXISTS `tbladministration` (
  `messageid` varchar(30) NOT NULL,
  `messages` varchar(5000) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `sentby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblbatch`
--

CREATE TABLE IF NOT EXISTS `tblbatch` (
  `batchid` varchar(30) NOT NULL,
  `batch` varchar(30) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblbranch`
--

CREATE TABLE IF NOT EXISTS `tblbranch` (
  `branchid` varchar(30) NOT NULL,
  `companyid` varchar(30) NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `telephone1` varchar(15) DEFAULT NULL,
  `telephone2` varchar(15) DEFAULT NULL,
  `createdby` varchar(80) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `status` varchar(15) DEFAULT NULL,
  `initials` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbranch`
--

INSERT INTO `tblbranch` (`branchid`, `companyid`, `address`, `location`, `telephone1`, `telephone2`, `createdby`, `datetimeentry`, `status`, `initials`) VALUES
('201911160727_6551378', '201911160727_2853022', 'Box 35  ', 'Akyerebi', '0245700000', '0256744444', 'MB_2019/1', '2019-11-16 03:28:37', 'active', 'AK_');

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

CREATE TABLE IF NOT EXISTS `tblclass` (
  `classid` varchar(30) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `class_entryid` varchar(40) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `recordedby` varchar(30) NOT NULL,
  `status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblclassentry`
--

CREATE TABLE IF NOT EXISTS `tblclassentry` (
  `class_entryid` varchar(30) NOT NULL,
  `class_name` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE IF NOT EXISTS `tblcompany` (
  `companyid` varchar(30) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`companyid`, `fullname`, `datetimeentry`, `status`, `recordedby`) VALUES
('201911160727_2853022', 'Ayirebi Senior High School', '2019-11-16 03:27:51', 'active', 'MB_2019/1');

-- --------------------------------------------------------

--
-- Table structure for table `tblcurrency`
--

CREATE TABLE IF NOT EXISTS `tblcurrency` (
  `currencyname` varchar(30) NOT NULL,
  `symbol` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcurrency`
--

INSERT INTO `tblcurrency` (`currencyname`, `symbol`) VALUES
('cedis', 'GHC');

-- --------------------------------------------------------

--
-- Table structure for table `tbldeductions`
--

CREATE TABLE IF NOT EXISTS `tbldeductions` (
  `deductionid` varchar(30) NOT NULL,
  `deductionname` varchar(60) NOT NULL,
  `percent` double NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblitem`
--

CREATE TABLE IF NOT EXISTS `tblitem` (
  `itemid` varchar(30) NOT NULL,
  `itemname` varchar(40) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `recordedby` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmark`
--

CREATE TABLE IF NOT EXISTS `tblmark` (
  `markid` varchar(30) NOT NULL,
  `assignmentid` varchar(30) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `testtype` varchar(40) NOT NULL,
  `mark` double NOT NULL,
  `totalmark` double NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmessages`
--

CREATE TABLE IF NOT EXISTS `tblmessages` (
  `messageid` varchar(30) NOT NULL,
  `messages` varchar(5000) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `sentby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmodule`
--

CREATE TABLE IF NOT EXISTS `tblmodule` (
  `moduleid` varchar(30) NOT NULL,
  `module` varchar(60) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblport`
--

CREATE TABLE IF NOT EXISTS `tblport` (
  `port` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblport`
--

INSERT INTO `tblport` (`port`) VALUES
('com8');

-- --------------------------------------------------------

--
-- Table structure for table `tblpreferences`
--

CREATE TABLE IF NOT EXISTS `tblpreferences` (
  `preferenceid` varchar(30) NOT NULL,
  `moduleid` varchar(30) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsalarydetails`
--

CREATE TABLE IF NOT EXISTS `tblsalarydetails` (
  `salarydetailid` varchar(30) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `grosssalary` double NOT NULL,
  `allowance` double NOT NULL,
  `totaldeduction` double NOT NULL,
  `netpay` double NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblschoolinfo`
--

CREATE TABLE IF NOT EXISTS `tblschoolinfo` (
  `infoid` varchar(30) NOT NULL,
  `batchid` varchar(30) NOT NULL,
  `termname` int(11) NOT NULL,
  `schoolcloses` date DEFAULT NULL,
  `schoolresumes` date DEFAULT NULL,
  `datetimeentry` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsmsalert`
--

CREATE TABLE IF NOT EXISTS `tblsmsalert` (
  `smsenabled` tinyint(1) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `companyid` varchar(60) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `recordedby` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsmsexamresults`
--

CREATE TABLE IF NOT EXISTS `tblsmsexamresults` (
  `smsexamid` varchar(40) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `batchid` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `examresults` varchar(150) DEFAULT NULL,
  `entrydatetime` datetime NOT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentterminalreport`
--

CREATE TABLE IF NOT EXISTS `tblstudentterminalreport` (
  `terminalid` varchar(30) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `batchid` varchar(30) NOT NULL,
  `roll` int(11) NOT NULL,
  `attendance` int(11) NOT NULL,
  `totalattendance` int(11) NOT NULL,
  `promotedto` varchar(30) NOT NULL,
  `conduct` varchar(100) NOT NULL,
  `interest` varchar(100) NOT NULL,
  `class_teacher_remark` varchar(100) NOT NULL,
  `head_teacher_remark` varchar(100) NOT NULL,
  `recordedby` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `datetimeentry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsubject`
--

CREATE TABLE IF NOT EXISTS `tblsubject` (
  `subjectid` varchar(30) NOT NULL,
  `subject` varchar(40) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectassignment`
--

CREATE TABLE IF NOT EXISTS `tblsubjectassignment` (
  `assignmentid` varchar(30) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `classid` varchar(30) NOT NULL,
  `classificationid` varchar(30) NOT NULL,
  `batchid` varchar(30) NOT NULL,
  `termname` int(11) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjectclassification`
--

CREATE TABLE IF NOT EXISTS `tblsubjectclassification` (
  `classificationid` varchar(30) NOT NULL,
  `classid` varchar(30) NOT NULL,
  `subjectid` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblsystemuser`
--

CREATE TABLE IF NOT EXISTS `tblsystemuser` (
  `userid` varchar(30) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `othernames` varchar(40) DEFAULT NULL,
  `gender` varchar(8) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(11) NOT NULL,
  `postaladdress` varchar(100) DEFAULT NULL,
  `homeaddress` varchar(100) DEFAULT NULL,
  `hometown` varchar(100) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `relationship` varchar(30) NOT NULL,
  `nextofkin_fullname` varchar(80) NOT NULL,
  `nextofkin_contact` varchar(20) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `verificationcode` varchar(15) NOT NULL,
  `mobile` varchar(29) NOT NULL,
  `registereddatetime` datetime NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accesslevel` varchar(30) NOT NULL,
  `systemtype` varchar(30) NOT NULL,
  `staffstatus` varchar(30) NOT NULL,
  `filename` varchar(60) NOT NULL,
  `signature` varchar(60) NOT NULL,
  `uploadeddatetime` datetime NOT NULL,
  `branchid` varchar(30) NOT NULL,
  `smsalert` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsystemuser`
--

INSERT INTO `tblsystemuser` (`userid`, `firstname`, `surname`, `othernames`, `gender`, `birthday`, `age`, `postaladdress`, `homeaddress`, `hometown`, `religion`, `relationship`, `nextofkin_fullname`, `nextofkin_contact`, `email`, `verificationcode`, `mobile`, `registereddatetime`, `status`, `username`, `password`, `accesslevel`, `systemtype`, `staffstatus`, `filename`, `signature`, `uploadeddatetime`, `branchid`, `smsalert`) VALUES
('MB_2019/1', 'Moses', 'Appiah', 'Oketenchey', 'male', '0000-00-00', 36, 'Box KF 2334 Koforidua', 'OK42, Okorase, Koforidua', '', 'Christian', 'Father', 'David Kweku Appiah', '0244992073', 'moses.appiah0242602522@gmail.com', '49263', '02426025255', '2019-07-11 05:00:00', 'active', 'moses', '3b18b33812c24be9ce50368b00bd46ec', 'administrator', 'super_user', '', '20180521_233553.jpg', 'signature.jpg', '2019-10-14 21:56:32', '201911140254_5706115', 0),
('MB_2019/2', 'Thomas', 'Appiah', '', 'male', '1992-11-18', 27, 'Box 53 Tafo', 'Tafo', 'Tafo', 'Christian', 'Father', 'Frank Appiah', '0242602522', 'appiahthomas97@gmail.com', '', '+233242602522', '2019-11-16 03:42:23', 'active', 'thomas', 'e10adc3949ba59abbe56e057f20f883e', 'administrator', 'normal_user', 'Teaching Staff', '', '', '0000-00-00 00:00:00', '201911160727_6551378', 0),
('MB_2019/8', 'Benjamin', 'Larbi', '', 'male', '1988-11-16', 31, 'Box 55 Koforidua', 'Ak3', 'Koforidua', 'Christian', 'Father', 'Patrick Agyei', '0298543434', 'ben@yahoo.com', '', '0233342292', '2019-11-29 03:36:15', 'active', 'ben', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'Teacher', 'Teaching Staff', '', '', '0000-00-00 00:00:00', '201911160727_6551378', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbltermregistry`
--

CREATE TABLE IF NOT EXISTS `tbltermregistry` (
  `termid` varchar(30) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `class_entryid` varchar(30) NOT NULL,
  `termname` int(11) NOT NULL,
  `batchid` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL,
  `datetimeentry` datetime NOT NULL,
  `recordedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltimetable`
--

CREATE TABLE IF NOT EXISTS `tbltimetable` (
  `timeid` varchar(30) NOT NULL,
  `subjectid` varchar(60) NOT NULL,
  `tablestarttime` time NOT NULL,
  `tableendtime` time NOT NULL,
  `tabledate` date NOT NULL,
  `class_entryid` varchar(30) NOT NULL,
  `termname` int(11) NOT NULL,
  `batchid` varchar(30) NOT NULL,
  `recordedby` varchar(30) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbltransaction`
--

CREATE TABLE IF NOT EXISTS `tbltransaction` (
  `transactionid` varchar(30) NOT NULL,
  `userid` varchar(30) NOT NULL,
  `datetimepayment` datetime NOT NULL,
  `recordedby` varchar(30) NOT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_systemusers`
--
CREATE TABLE IF NOT EXISTS `vw_systemusers` (
`userid` varchar(30)
,`firstname` varchar(40)
,`surname` varchar(40)
,`othernames` varchar(40)
,`gender` varchar(8)
,`birthday` date
,`age` int(11)
,`postaladdress` varchar(100)
,`homeaddress` varchar(100)
,`hometown` varchar(100)
,`religion` varchar(30)
,`relationship` varchar(30)
,`nextofkin_fullname` varchar(80)
,`nextofkin_contact` varchar(20)
,`registereddatetime` datetime
,`status` varchar(20)
,`username` varchar(100)
,`password` varchar(255)
,`accesslevel` varchar(30)
,`systemtype` varchar(30)
,`filename` varchar(60)
);
-- --------------------------------------------------------

--
-- Structure for view `vw_systemusers`
--
DROP TABLE IF EXISTS `vw_systemusers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_systemusers` AS select `tblsystemuser`.`userid` AS `userid`,`tblsystemuser`.`firstname` AS `firstname`,`tblsystemuser`.`surname` AS `surname`,`tblsystemuser`.`othernames` AS `othernames`,`tblsystemuser`.`gender` AS `gender`,`tblsystemuser`.`birthday` AS `birthday`,`tblsystemuser`.`age` AS `age`,`tblsystemuser`.`postaladdress` AS `postaladdress`,`tblsystemuser`.`homeaddress` AS `homeaddress`,`tblsystemuser`.`hometown` AS `hometown`,`tblsystemuser`.`religion` AS `religion`,`tblsystemuser`.`relationship` AS `relationship`,`tblsystemuser`.`nextofkin_fullname` AS `nextofkin_fullname`,`tblsystemuser`.`nextofkin_contact` AS `nextofkin_contact`,`tblsystemuser`.`registereddatetime` AS `registereddatetime`,`tblsystemuser`.`status` AS `status`,`tblsystemuser`.`username` AS `username`,`tblsystemuser`.`password` AS `password`,`tblsystemuser`.`accesslevel` AS `accesslevel`,`tblsystemuser`.`systemtype` AS `systemtype`,`tblsystemuser`.`filename` AS `filename` from `tblsystemuser` where ((`tblsystemuser`.`systemtype` = 'User') or (`tblsystemuser`.`systemtype` = 'super_user'));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblaccounttype`
--
ALTER TABLE `tblaccounttype`
 ADD PRIMARY KEY (`typeid`), ADD KEY `recordedby` (`recordedby`);

--
-- Indexes for table `tbladministration`
--
ALTER TABLE `tbladministration`
 ADD PRIMARY KEY (`messageid`), ADD KEY `sentby` (`sentby`);

--
-- Indexes for table `tblbatch`
--
ALTER TABLE `tblbatch`
 ADD PRIMARY KEY (`batchid`), ADD KEY `recordedby` (`recordedby`);

--
-- Indexes for table `tblbranch`
--
ALTER TABLE `tblbranch`
 ADD PRIMARY KEY (`branchid`), ADD UNIQUE KEY `branchid` (`branchid`), ADD KEY `companyid` (`companyid`);

--
-- Indexes for table `tblclass`
--
ALTER TABLE `tblclass`
 ADD PRIMARY KEY (`classid`), ADD KEY `recordedby` (`recordedby`), ADD KEY `userid` (`userid`), ADD KEY `class_entryid` (`class_entryid`);

--
-- Indexes for table `tblclassentry`
--
ALTER TABLE `tblclassentry`
 ADD PRIMARY KEY (`class_entryid`), ADD UNIQUE KEY `class_name` (`class_name`), ADD KEY `recordedby` (`recordedby`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
 ADD PRIMARY KEY (`companyid`), ADD KEY `recorded_fk` (`recordedby`);

--
-- Indexes for table `tblcurrency`
--
ALTER TABLE `tblcurrency`
 ADD PRIMARY KEY (`currencyname`);

--
-- Indexes for table `tbldeductions`
--
ALTER TABLE `tbldeductions`
 ADD PRIMARY KEY (`deductionid`), ADD KEY `recordedby` (`recordedby`);

--
-- Indexes for table `tblitem`
--
ALTER TABLE `tblitem`
 ADD PRIMARY KEY (`itemid`), ADD UNIQUE KEY `itemname` (`itemname`), ADD KEY `recordedby` (`recordedby`);

--
-- Indexes for table `tblmark`
--
ALTER TABLE `tblmark`
 ADD PRIMARY KEY (`markid`), ADD KEY `userid` (`userid`), ADD KEY `assignmentid` (`assignmentid`), ADD KEY `recordedby` (`recordedby`);

--
-- Indexes for table `tblmessages`
--
ALTER TABLE `tblmessages`
 ADD PRIMARY KEY (`messageid`), ADD KEY `sentby` (`sentby`);

--
-- Indexes for table `tblmodule`
--
ALTER TABLE `tblmodule`
 ADD PRIMARY KEY (`moduleid`), ADD KEY `recordedby` (`recordedby`);

--
-- Indexes for table `tblpreferences`
--
ALTER TABLE `tblpreferences`
 ADD PRIMARY KEY (`preferenceid`), ADD KEY `userid` (`userid`), ADD KEY `recordedby` (`recordedby`), ADD KEY `moduleid` (`moduleid`);

--
-- Indexes for table `tblsalarydetails`
--
ALTER TABLE `tblsalarydetails`
 ADD PRIMARY KEY (`salarydetailid`), ADD KEY `userid` (`userid`), ADD KEY `recordedby` (`recordedby`);

--
-- Indexes for table `tblschoolinfo`
--
ALTER TABLE `tblschoolinfo`
 ADD PRIMARY KEY (`infoid`), ADD KEY `recordedby` (`recordedby`), ADD KEY `batchid` (`batchid`);

--
-- Indexes for table `tblsmsalert`
--
ALTER TABLE `tblsmsalert`
 ADD KEY `companyid` (`companyid`);

--
-- Indexes for table `tblsmsexamresults`
--
ALTER TABLE `tblsmsexamresults`
 ADD PRIMARY KEY (`smsexamid`), ADD KEY `batchid` (`batchid`), ADD KEY `recordedby` (`recordedby`);

--
-- Indexes for table `tblstudentterminalreport`
--
ALTER TABLE `tblstudentterminalreport`
 ADD PRIMARY KEY (`terminalid`), ADD KEY `recordedby` (`recordedby`), ADD KEY `batchid` (`batchid`);

--
-- Indexes for table `tblsubject`
--
ALTER TABLE `tblsubject`
 ADD PRIMARY KEY (`subjectid`), ADD KEY `recordedby` (`recordedby`);

--
-- Indexes for table `tblsubjectassignment`
--
ALTER TABLE `tblsubjectassignment`
 ADD PRIMARY KEY (`assignmentid`), ADD KEY `userid` (`userid`), ADD KEY `classificationid` (`classificationid`), ADD KEY `recordedby` (`recordedby`), ADD KEY `classid` (`classid`), ADD KEY `batchid` (`batchid`);

--
-- Indexes for table `tblsubjectclassification`
--
ALTER TABLE `tblsubjectclassification`
 ADD PRIMARY KEY (`classificationid`), ADD KEY `classid` (`classid`), ADD KEY `subjectid` (`subjectid`), ADD KEY `recordedby` (`recordedby`);

--
-- Indexes for table `tblsystemuser`
--
ALTER TABLE `tblsystemuser`
 ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `tbltermregistry`
--
ALTER TABLE `tbltermregistry`
 ADD PRIMARY KEY (`termid`), ADD KEY `userid` (`userid`), ADD KEY `class_entryid` (`class_entryid`), ADD KEY `batchid` (`batchid`);

--
-- Indexes for table `tbltimetable`
--
ALTER TABLE `tbltimetable`
 ADD PRIMARY KEY (`timeid`), ADD KEY `subjectid` (`subjectid`), ADD KEY `class_entryid` (`class_entryid`), ADD KEY `batchid` (`batchid`), ADD KEY `recordedby` (`recordedby`);

--
-- Indexes for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
 ADD PRIMARY KEY (`transactionid`), ADD UNIQUE KEY `transactionid` (`transactionid`), ADD KEY `userid` (`userid`), ADD KEY `recordedby` (`recordedby`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblaccounttype`
--
ALTER TABLE `tblaccounttype`
ADD CONSTRAINT `tblaccounttype_ibfk_1` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tbladministration`
--
ALTER TABLE `tbladministration`
ADD CONSTRAINT `tbladministration_ibfk_1` FOREIGN KEY (`sentby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tblbatch`
--
ALTER TABLE `tblbatch`
ADD CONSTRAINT `tblbatch_ibfk_1` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tblbranch`
--
ALTER TABLE `tblbranch`
ADD CONSTRAINT `tblbranch_ibfk_1` FOREIGN KEY (`companyid`) REFERENCES `tblcompany` (`companyid`);

--
-- Constraints for table `tblclass`
--
ALTER TABLE `tblclass`
ADD CONSTRAINT `tblclass_ibfk_1` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`),
ADD CONSTRAINT `tblclass_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `tblsystemuser` (`userid`),
ADD CONSTRAINT `tblclass_ibfk_3` FOREIGN KEY (`class_entryid`) REFERENCES `tblclassentry` (`class_entryid`);

--
-- Constraints for table `tblclassentry`
--
ALTER TABLE `tblclassentry`
ADD CONSTRAINT `tblclassentry_ibfk_1` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tblcompany`
--
ALTER TABLE `tblcompany`
ADD CONSTRAINT `company_fk` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tbldeductions`
--
ALTER TABLE `tbldeductions`
ADD CONSTRAINT `tbldeductions_ibfk_1` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tblitem`
--
ALTER TABLE `tblitem`
ADD CONSTRAINT `tblitem_ibfk_1` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tblmark`
--
ALTER TABLE `tblmark`
ADD CONSTRAINT `tblmark_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tblsystemuser` (`userid`),
ADD CONSTRAINT `tblmark_ibfk_2` FOREIGN KEY (`assignmentid`) REFERENCES `tblsubjectassignment` (`assignmentid`),
ADD CONSTRAINT `tblmark_ibfk_3` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tblmessages`
--
ALTER TABLE `tblmessages`
ADD CONSTRAINT `tblmessages_ibfk_1` FOREIGN KEY (`sentby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tblmodule`
--
ALTER TABLE `tblmodule`
ADD CONSTRAINT `tblmodule_ibfk_1` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tblpreferences`
--
ALTER TABLE `tblpreferences`
ADD CONSTRAINT `tblpreferences_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tblsystemuser` (`userid`),
ADD CONSTRAINT `tblpreferences_ibfk_2` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`),
ADD CONSTRAINT `tblpreferences_ibfk_3` FOREIGN KEY (`moduleid`) REFERENCES `tblmodule` (`moduleid`);

--
-- Constraints for table `tblsalarydetails`
--
ALTER TABLE `tblsalarydetails`
ADD CONSTRAINT `tblsalarydetails_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tblsystemuser` (`userid`),
ADD CONSTRAINT `tblsalarydetails_ibfk_2` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tblschoolinfo`
--
ALTER TABLE `tblschoolinfo`
ADD CONSTRAINT `tblschoolinfo_ibfk_1` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`),
ADD CONSTRAINT `tblschoolinfo_ibfk_2` FOREIGN KEY (`batchid`) REFERENCES `tblbatch` (`batchid`);

--
-- Constraints for table `tblsmsalert`
--
ALTER TABLE `tblsmsalert`
ADD CONSTRAINT `tblsmsalert_ibfk_1` FOREIGN KEY (`companyid`) REFERENCES `tblcompany` (`companyid`);

--
-- Constraints for table `tblsmsexamresults`
--
ALTER TABLE `tblsmsexamresults`
ADD CONSTRAINT `tblsmsexamresults_ibfk_1` FOREIGN KEY (`batchid`) REFERENCES `tblbatch` (`batchid`),
ADD CONSTRAINT `tblsmsexamresults_ibfk_2` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tblstudentterminalreport`
--
ALTER TABLE `tblstudentterminalreport`
ADD CONSTRAINT `tblstudentterminalreport_ibfk_1` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`),
ADD CONSTRAINT `tblstudentterminalreport_ibfk_2` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`),
ADD CONSTRAINT `tblstudentterminalreport_ibfk_3` FOREIGN KEY (`batchid`) REFERENCES `tblbatch` (`batchid`);

--
-- Constraints for table `tblsubject`
--
ALTER TABLE `tblsubject`
ADD CONSTRAINT `tblsubject_ibfk_1` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tblsubjectassignment`
--
ALTER TABLE `tblsubjectassignment`
ADD CONSTRAINT `tblsubjectassignment_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tblsystemuser` (`userid`),
ADD CONSTRAINT `tblsubjectassignment_ibfk_2` FOREIGN KEY (`classificationid`) REFERENCES `tblsubjectclassification` (`classificationid`),
ADD CONSTRAINT `tblsubjectassignment_ibfk_3` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`),
ADD CONSTRAINT `tblsubjectassignment_ibfk_4` FOREIGN KEY (`classid`) REFERENCES `tblclassentry` (`class_entryid`),
ADD CONSTRAINT `tblsubjectassignment_ibfk_5` FOREIGN KEY (`batchid`) REFERENCES `tblbatch` (`batchid`);

--
-- Constraints for table `tblsubjectclassification`
--
ALTER TABLE `tblsubjectclassification`
ADD CONSTRAINT `tblsubjectclassification_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `tblclassentry` (`class_entryid`),
ADD CONSTRAINT `tblsubjectclassification_ibfk_2` FOREIGN KEY (`subjectid`) REFERENCES `tblsubject` (`subjectid`),
ADD CONSTRAINT `tblsubjectclassification_ibfk_3` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tbltermregistry`
--
ALTER TABLE `tbltermregistry`
ADD CONSTRAINT `tbltermregistry_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tblsystemuser` (`userid`),
ADD CONSTRAINT `tbltermregistry_ibfk_2` FOREIGN KEY (`class_entryid`) REFERENCES `tblclassentry` (`class_entryid`),
ADD CONSTRAINT `tbltermregistry_ibfk_3` FOREIGN KEY (`batchid`) REFERENCES `tblbatch` (`batchid`);

--
-- Constraints for table `tbltimetable`
--
ALTER TABLE `tbltimetable`
ADD CONSTRAINT `tbltimetable_ibfk_1` FOREIGN KEY (`subjectid`) REFERENCES `tblsubject` (`subjectid`),
ADD CONSTRAINT `tbltimetable_ibfk_2` FOREIGN KEY (`class_entryid`) REFERENCES `tblclassentry` (`class_entryid`),
ADD CONSTRAINT `tbltimetable_ibfk_3` FOREIGN KEY (`batchid`) REFERENCES `tblbatch` (`batchid`),
ADD CONSTRAINT `tbltimetable_ibfk_4` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

--
-- Constraints for table `tbltransaction`
--
ALTER TABLE `tbltransaction`
ADD CONSTRAINT `tbltransaction_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `tblsystemuser` (`userid`),
ADD CONSTRAINT `tbltransaction_ibfk_2` FOREIGN KEY (`recordedby`) REFERENCES `tblsystemuser` (`userid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
