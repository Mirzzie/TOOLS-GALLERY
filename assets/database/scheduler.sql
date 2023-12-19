-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 13, 2023 at 04:19 PM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `alloc_tb`
--

DROP TABLE IF EXISTS `alloc_tb`;
CREATE TABLE IF NOT EXISTS `alloc_tb` (
  `al_id` int(11) NOT NULL AUTO_INCREMENT,
  `table_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `fid` int(11) NOT NULL,
  PRIMARY KEY (`al_id`),
  KEY `class` (`class_id`),
  KEY `table_id` (`table_id`),
  KEY `fac` (`fid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alloc_tb`
--

INSERT INTO `alloc_tb` (`al_id`, `table_id`, `class_id`, `fid`) VALUES
(12, 8, 2, 16);

-- --------------------------------------------------------

--
-- Table structure for table `classroom_tb`
--

DROP TABLE IF EXISTS `classroom_tb`;
CREATE TABLE IF NOT EXISTS `classroom_tb` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_no` varchar(20) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classroom_tb`
--

INSERT INTO `classroom_tb` (`class_id`, `room_no`) VALUES
(1, '201'),
(2, '301');

-- --------------------------------------------------------

--
-- Table structure for table `dep_tb`
--

DROP TABLE IF EXISTS `dep_tb`;
CREATE TABLE IF NOT EXISTS `dep_tb` (
  `depid` int(11) NOT NULL AUTO_INCREMENT,
  `dname` varchar(200) NOT NULL,
  PRIMARY KEY (`depid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dep_tb`
--

INSERT INTO `dep_tb` (`depid`, `dname`) VALUES
(1, 'Bachelor of Computer Application'),
(2, 'Management studies'),
(3, 'Mathematics'),
(4, 'Statistics'),
(5, 'Hindi'),
(6, 'Malayalam'),
(7, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `desig_tb`
--

DROP TABLE IF EXISTS `desig_tb`;
CREATE TABLE IF NOT EXISTS `desig_tb` (
  `des_id` int(11) NOT NULL,
  `desig_name` varchar(100) NOT NULL,
  PRIMARY KEY (`des_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `desig_tb`
--

INSERT INTO `desig_tb` (`des_id`, `desig_name`) VALUES
(1, 'Head of Department'),
(2, 'Faculty member');

-- --------------------------------------------------------

--
-- Table structure for table `exam_tb`
--

DROP TABLE IF EXISTS `exam_tb`;
CREATE TABLE IF NOT EXISTS `exam_tb` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `exam_name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `sem_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`exam_id`),
  KEY `semID` (`sem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exam_tb`
--

INSERT INTO `exam_tb` (`exam_id`, `exam_name`, `start_date`, `end_date`, `sem_id`, `status`) VALUES
(13, 'BSc DEGREE EXAMINATION 2022', '2022-11-02', '2022-12-11', 4, 1),
(14, 'DEGREE EXAMINATION MARCH,2023', '2022-11-12', '2022-11-30', 1, 1),
(46, 'BCA CBCS REGULA EXAM NOV 22', '2022-12-12', '2023-01-05', 5, 1),
(50, 'abc', '2022-12-18', '2022-12-22', 2, 1),
(51, 'nami', '2023-01-04', '2022-12-19', 2, 1),
(52, 'mirzzie', '2022-12-18', '2022-12-23', 3, 1),
(53, 'bvv', '2023-01-18', '2023-01-21', 2, 1),
(54, 'BCA CBCS REGULA EXAM NOV 23', '2023-01-28', '2023-07-22', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fac_tb`
--

DROP TABLE IF EXISTS `fac_tb`;
CREATE TABLE IF NOT EXISTS `fac_tb` (
  `fid` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `des_id` int(11) NOT NULL,
  `depid` int(11) NOT NULL,
  `uname` varchar(35) NOT NULL,
  `passw` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`fid`),
  KEY `des_id` (`des_id`),
  KEY `dep` (`depid`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fac_tb`
--

INSERT INTO `fac_tb` (`fid`, `fname`, `phone`, `des_id`, `depid`, `uname`, `passw`, `status`) VALUES
(2, 'Roshna C P', 963852743, 2, 1, 'roshna', 'rosh', 1),
(16, 'Reseena Mol N A', 123456789, 1, 1, 'abcd@gmail.com', 'abcd', 1),
(24, 'Shifaz Khan', 9945689786, 2, 1, 'shifu', 'Shifu123#', 1),
(25, 'Sadiya Mol PA', 9863245876, 2, 1, 'Sadiya', 'Sadya123#', 1),
(26, 'BOSS', 9956854231, 1, 2, 'boss', 'Ae1245698#', 1);

-- --------------------------------------------------------

--
-- Table structure for table `leave_list`
--

DROP TABLE IF EXISTS `leave_list`;
CREATE TABLE IF NOT EXISTS `leave_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL,
  `leave_type_id` int(30) NOT NULL,
  `date` date NOT NULL,
  `reason` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_approved` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `F` (`fid`),
  KEY `L` (`leave_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_list`
--

INSERT INTO `leave_list` (`id`, `fid`, `leave_type_id`, `date`, `reason`, `status`, `date_created`, `date_approved`) VALUES
(4, 2, 2, '2022-12-15', 'ghmghmg', 1, '2022-12-26 17:48:16', '2022-12-26 17:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

DROP TABLE IF EXISTS `leave_type`;
CREATE TABLE IF NOT EXISTS `leave_type` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `leave_type` text NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`id`, `leave_type`, `description`) VALUES
(1, 'Vacation Leave (VL)', 'Vacation Leave'),
(2, 'SL', 'Sick Leave'),
(3, 'EL', 'Emergency Leave');

-- --------------------------------------------------------

--
-- Table structure for table `sem_tb`
--

DROP TABLE IF EXISTS `sem_tb`;
CREATE TABLE IF NOT EXISTS `sem_tb` (
  `sem_id` int(11) NOT NULL AUTO_INCREMENT,
  `sem_name` varchar(25) NOT NULL,
  PRIMARY KEY (`sem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sem_tb`
--

INSERT INTO `sem_tb` (`sem_id`, `sem_name`) VALUES
(1, 'Semester 1'),
(2, 'Semester 2'),
(3, 'Semester 3'),
(4, 'Semester 4'),
(5, 'Semester 5'),
(6, 'Semester 6');

-- --------------------------------------------------------

--
-- Table structure for table `sub_tb`
--

DROP TABLE IF EXISTS `sub_tb`;
CREATE TABLE IF NOT EXISTS `sub_tb` (
  `sub_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_name` varchar(100) NOT NULL,
  `depid` int(11) NOT NULL,
  `sem_id` int(11) NOT NULL,
  PRIMARY KEY (`sub_id`),
  KEY `depid` (`depid`),
  KEY `sem_id` (`sem_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_tb`
--

INSERT INTO `sub_tb` (`sub_id`, `sub_name`, `depid`, `sem_id`) VALUES
(1, 'ENGLISH-I', 1, 1),
(2, 'MATHEMATICS', 1, 1),
(3, 'BASIC STATISTICS', 1, 1),
(4, 'CA1CRT01-COMPUTER FUNDAMENTALS AND DIGITAL PRINCIPLES', 1, 1),
(5, 'CA1CRT01-METHODOLOGY OF PROGRAMMING AND C LANGUAGE', 1, 1),
(6, 'ENGLISH-II', 1, 1),
(8, 'DISCRETE MATHEMATICS', 1, 1),
(9, 'CA2CRT03-DATABASE MANAGEMENT SYSTEMS', 1, 1),
(10, 'CA2CRT04-COMPUTER ORGANIZATION AND ARCHITECTURE', 1, 1),
(11, 'CA2CRT05-OBJECT ORIENTED PROGRAMMING USING C++', 1, 1),
(13, 'ST3CMT32-ADVANCED SSSTATISTICAL METHODS', 1, 1),
(14, 'CA3CRT06-COMPUTERR GRAPHICS', 1, 1),
(15, 'CA3CRT07-MICROPROCESSOR AND PC HARDWARE', 1, 1),
(16, 'CA3CRT08-OPERATING SYSTEMS', 1, 1),
(17, 'CA3CRT09-DATA STUCTURE USING C++', 1, 1),
(19, 'MM4CMT03-OPERATIONAL RESEARCH', 1, 1),
(20, 'CA4CRT10-DEIGN AND ANALYSIS OF ALGORITHMS', 1, 1),
(21, 'CA4CRT11-SYSTEM ANALYSIS & SOFTWARE ENGINEERING', 1, 1),
(22, 'CA4CRT12-LINUX ADMINISTRATION', 1, 1),
(23, 'CA4CRT13-WEB PROGRAMMING USING PHP', 1, 1),
(25, 'CS5CRT12-COMPUTER NETWORKS', 1, 1),
(26, 'CS5CRT13-IT AND ENVIRONMENT', 1, 1),
(27, 'CS5CRT14-JAVA PROGRAMMING USING LINUX', 1, 1),
(28, 'CO5OPT03-FUNDAMENTALS OF ACCOUNTING', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `x_table_tb`
--

DROP TABLE IF EXISTS `x_table_tb`;
CREATE TABLE IF NOT EXISTS `x_table_tb` (
  `table_id` int(11) NOT NULL AUTO_INCREMENT,
  `sub_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `x_date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`table_id`),
  KEY `Foreign key` (`exam_id`),
  KEY `sub` (`sub_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `x_table_tb`
--

INSERT INTO `x_table_tb` (`table_id`, `sub_id`, `exam_id`, `x_date`, `time`) VALUES
(7, 8, 52, '2022-12-10', '17:18:00'),
(8, 9, 53, '2023-01-22', '09:36:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alloc_tb`
--
ALTER TABLE `alloc_tb`
  ADD CONSTRAINT `class` FOREIGN KEY (`class_id`) REFERENCES `classroom_tb` (`class_id`),
  ADD CONSTRAINT `fac` FOREIGN KEY (`fid`) REFERENCES `fac_tb` (`fid`),
  ADD CONSTRAINT `table_id` FOREIGN KEY (`table_id`) REFERENCES `x_table_tb` (`table_id`);

--
-- Constraints for table `exam_tb`
--
ALTER TABLE `exam_tb`
  ADD CONSTRAINT `semID` FOREIGN KEY (`sem_id`) REFERENCES `sem_tb` (`sem_id`);

--
-- Constraints for table `fac_tb`
--
ALTER TABLE `fac_tb`
  ADD CONSTRAINT `Department` FOREIGN KEY (`depid`) REFERENCES `dep_tb` (`depid`),
  ADD CONSTRAINT `Designation` FOREIGN KEY (`des_id`) REFERENCES `desig_tb` (`des_id`);

--
-- Constraints for table `leave_list`
--
ALTER TABLE `leave_list`
  ADD CONSTRAINT `F` FOREIGN KEY (`fid`) REFERENCES `fac_tb` (`fid`),
  ADD CONSTRAINT `L` FOREIGN KEY (`leave_type_id`) REFERENCES `leave_type` (`id`);

--
-- Constraints for table `sub_tb`
--
ALTER TABLE `sub_tb`
  ADD CONSTRAINT `dep` FOREIGN KEY (`depid`) REFERENCES `dep_tb` (`depid`),
  ADD CONSTRAINT `sem` FOREIGN KEY (`sem_id`) REFERENCES `sem_tb` (`sem_id`);

--
-- Constraints for table `x_table_tb`
--
ALTER TABLE `x_table_tb`
  ADD CONSTRAINT `exam` FOREIGN KEY (`exam_id`) REFERENCES `exam_tb` (`exam_id`),
  ADD CONSTRAINT `sub` FOREIGN KEY (`sub_id`) REFERENCES `sub_tb` (`sub_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
