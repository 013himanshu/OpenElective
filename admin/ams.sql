-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2017 at 05:51 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ams`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_child`
--

CREATE TABLE IF NOT EXISTS `attendance_child` (
  `id` bigint(20) NOT NULL,
  `attend_id` bigint(20) NOT NULL,
  `regno` int(11) NOT NULL,
  `status` varchar(15) DEFAULT NULL COMMENT 'absent or present.'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_parent`
--

CREATE TABLE IF NOT EXISTS `attendance_parent` (
  `attend_id` bigint(20) NOT NULL,
  `teach_id` bigint(20) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `branch_id` bigint(20) NOT NULL,
  `branch_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `total_classes` int(11) DEFAULT '0',
  `deptcode` varchar(2) CHARACTER SET utf8 NOT NULL,
  `prog_id` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `cid` varchar(10) NOT NULL,
  `optionid` varchar(5) DEFAULT NULL,
  `coursename` varchar(255) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `deptcode` varchar(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE IF NOT EXISTS `faculty` (
  `facno` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phoneno` varchar(15) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `pincode` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `deptcode` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `programme`
--

CREATE TABLE IF NOT EXISTS `programme` (
  `prog_id` bigint(20) NOT NULL,
  `prog_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `sid` int(11) NOT NULL,
  `sname` varchar(255) NOT NULL,
  `faculty` varchar(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1014 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `sec_id` bigint(20) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `section` varchar(5) CHARACTER SET utf8 NOT NULL,
  `status` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `regno` int(11) NOT NULL,
  `adno` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phoneno` varchar(15) NOT NULL,
  `joiningyear` int(11) NOT NULL,
  `prog_id` bigint(20) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `sec_id` bigint(20) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `dob` date NOT NULL,
  `parentname` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` text NOT NULL,
  `state` text NOT NULL,
  `pincode` int(11) NOT NULL,
  `pphoneno` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pemail` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `teaching`
--

CREATE TABLE IF NOT EXISTS `teaching` (
  `teach_id` bigint(20) NOT NULL,
  `facno` int(11) NOT NULL,
  `cid` varchar(10) CHARACTER SET utf8 NOT NULL,
  `prog_id` bigint(20) NOT NULL,
  `branch_id` bigint(20) NOT NULL,
  `sec_id` bigint(20) NOT NULL,
  `joinyear` int(11) NOT NULL,
  `status` varchar(15) CHARACTER SET utf8 NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE IF NOT EXISTS `user_login` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(1) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_child`
--
ALTER TABLE `attendance_child`
  ADD PRIMARY KEY (`id`), ADD KEY `attend_id` (`attend_id`);

--
-- Indexes for table `attendance_parent`
--
ALTER TABLE `attendance_parent`
  ADD PRIMARY KEY (`attend_id`), ADD KEY `teach_id` (`teach_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`), ADD KEY `prog_id` (`prog_id`), ADD KEY `deptcode` (`deptcode`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`deptcode`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`facno`);

--
-- Indexes for table `programme`
--
ALTER TABLE `programme`
  ADD PRIMARY KEY (`prog_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sec_id`), ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`regno`), ADD UNIQUE KEY `adno` (`adno`), ADD KEY `prog_id` (`prog_id`), ADD KEY `branch_id` (`branch_id`), ADD KEY `sec_id` (`sec_id`);

--
-- Indexes for table `teaching`
--
ALTER TABLE `teaching`
  ADD PRIMARY KEY (`teach_id`), ADD KEY `facno` (`facno`), ADD KEY `cid` (`cid`), ADD KEY `sec_id` (`sec_id`), ADD KEY `prog_id` (`prog_id`), ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_child`
--
ALTER TABLE `attendance_child`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `attendance_parent`
--
ALTER TABLE `attendance_parent`
  MODIFY `attend_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `programme`
--
ALTER TABLE `programme`
  MODIFY `prog_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1014;
--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `sec_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `teaching`
--
ALTER TABLE `teaching`
  MODIFY `teach_id` bigint(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_child`
--
ALTER TABLE `attendance_child`
ADD CONSTRAINT `attendance_child_ibfk_1` FOREIGN KEY (`attend_id`) REFERENCES `attendance_parent` (`attend_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance_parent`
--
ALTER TABLE `attendance_parent`
ADD CONSTRAINT `attendance_parent_ibfk_1` FOREIGN KEY (`teach_id`) REFERENCES `teaching` (`teach_id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `branch`
--
ALTER TABLE `branch`
ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`prog_id`) REFERENCES `programme` (`prog_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `branch_ibfk_2` FOREIGN KEY (`deptcode`) REFERENCES `department` (`deptcode`) ON DELETE CASCADE;

--
-- Constraints for table `section`
--
ALTER TABLE `section`
ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`prog_id`) REFERENCES `programme` (`prog_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `student_ibfk_4` FOREIGN KEY (`sec_id`) REFERENCES `section` (`sec_id`) ON UPDATE CASCADE;

--
-- Constraints for table `teaching`
--
ALTER TABLE `teaching`
ADD CONSTRAINT `teaching_ibfk_1` FOREIGN KEY (`facno`) REFERENCES `faculty` (`facno`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `teaching_ibfk_2` FOREIGN KEY (`cid`) REFERENCES `courses` (`cid`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `teaching_ibfk_4` FOREIGN KEY (`sec_id`) REFERENCES `section` (`sec_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
ADD CONSTRAINT `teaching_ibfk_5` FOREIGN KEY (`prog_id`) REFERENCES `programme` (`prog_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `teaching_ibfk_6` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
