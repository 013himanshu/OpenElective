-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2018 at 08:52 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `oe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
  `uid` int(50) unsigned NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `user_type` varchar(30) DEFAULT NULL,
  `add_date` varchar(20) NOT NULL DEFAULT 'Not Available',
  `add_time` varchar(20) NOT NULL DEFAULT 'Not Available'
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`uid`, `username`, `name`, `password`, `user_type`, `add_date`, `add_time`) VALUES
(109, '013himanshu', 'Himanshu Kumawat', 'hello', 'superuser', '2017-04-03', '01:43pm'),
(119, 'test', 'test', 'sdfsdf', 'superuser', '2017-04-04', '12:40pm'),
(120, 'jojo', 'jojo', 'jjojo', 'user', '2017-04-04', '12:54pm'),
(121, 'momo', 'new momo', 'momo1', 'superuser', '2017-04-04', '12:54pm');

-- --------------------------------------------------------

--
-- Table structure for table `cgpa`
--

CREATE TABLE IF NOT EXISTS `cgpa` (
  `RegistrationNo` int(10) NOT NULL,
  `CGPA` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cgpa`
--

INSERT INTO `cgpa` (`RegistrationNo`, `CGPA`) VALUES
(159105058, 8),
(159109106, 6);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `DepId` int(11) unsigned NOT NULL,
  `DepName` varchar(20) NOT NULL,
  `add_date` varchar(10) DEFAULT NULL,
  `add_time` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DepId`, `DepName`, `add_date`, `add_time`) VALUES
(1, 'SCIT', NULL, NULL),
(2, 'CIVIL', NULL, NULL),
(3, 'SCI', NULL, NULL),
(5, 'EEE', '2017-04-13', '11:14pm'),
(6, 'AUTOMOBILE', '2017-04-13', '11:15pm'),
(7, 'ECE', '2017-04-13', '11:15pm'),
(8, 'MECHATRONICS', '2017-04-13', '11:16pm'),
(9, 'Dept of Language', '2017-04-15', '11:57am'),
(10, 'MATHEMATICS', '2017-04-15', '11:58am'),
(11, 'Dept of Arts', '2017-04-15', '11:58am'),
(12, 'PHYSICS', '2017-04-15', '11:58am'),
(13, 'ECONOMICS', '2017-04-15', '11:58am'),
(14, 'HOTEL MGMT', '2017-04-15', '11:59am'),
(15, 'COMMERCE', '2017-04-15', '11:59am'),
(17, 'JOURNALISM', '2017-04-15', '11:59am'),
(18, 'CHEMISTRY', '2017-04-15', '12:00pm'),
(19, 'Psychology', '2017-04-15', '12:00pm'),
(20, 'Management', '2017-04-15', '12:00pm'),
(21, 'Language', '2017-04-15', '12:01pm');

-- --------------------------------------------------------

--
-- Table structure for table `electivealloted`
--

CREATE TABLE IF NOT EXISTS `electivealloted` (
  `Rg_No` int(11) NOT NULL DEFAULT '0',
  `SubjectAlloted` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `electivealloted`
--

INSERT INTO `electivealloted` (`Rg_No`, `SubjectAlloted`) VALUES
(139111340, 'MA1490-BIO STATISTICS (MATHEMATICS)????????? '),
(149111694, 'CV1691-ENVIRONMENTAL MANAGEMENT (CIVIL)'),
(159102113, 'CS1490-DATA STRUCTURES (IT)'),
(159102123, 'EE1491-RENEWABLE ENERGY SOURCES (EEE)');

-- --------------------------------------------------------

--
-- Table structure for table `oechoice`
--

CREATE TABLE IF NOT EXISTS `oechoice` (
  `oeid` int(11) unsigned NOT NULL,
  `oename` varchar(100) DEFAULT NULL,
  `Semester` int(11) DEFAULT NULL,
  `Department` varchar(20) DEFAULT NULL,
  `add_date` varchar(10) DEFAULT NULL,
  `add_time` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `oechoice`
--

INSERT INTO `oechoice` (`oeid`, `oename`, `Semester`, `Department`, `add_date`, `add_time`) VALUES
(1, 'EC1490- INTRODUCTION TO COMMUNICATION SYSTEM (ECE)', 4, 'ECE', NULL, NULL),
(2, ' EC1690-MEMS TECHNOLOGY (ECE)', 4, 'ECE', NULL, NULL),
(3, 'EC1691-MICROCONTROLLERS AND APPLICATIONS (ECE)', 4, 'ECE', NULL, NULL),
(4, 'ME1491-INTRODUCTION OF NANOTECHNOLOGY (MECHANICAL)', 4, 'MECHANICAL', NULL, NULL),
(5, 'ME1492-SMART MATERIALS (MECHANICAL)', 4, 'MECHANICAL', NULL, NULL),
(6, 'ME1690-COMPOSITE MATERIALS (MECHANICAL) ', 4, 'MECHANICAL', NULL, NULL),
(7, 'ME1691-OPERATIONS RESEARCH (MECHANICAL) ', 4, 'MECHANICAL', NULL, NULL),
(8, 'CS1491-OOPS USING JAVA (CSE)', 4, 'SCIT', NULL, NULL),
(9, 'CS1696-DATABASE MANAGEMENT SYSTEMS (SCE)', 4, 'SCIT', NULL, NULL),
(10, 'CS1490-DATA STRUCTURES (IT)', 4, 'SCIT', NULL, NULL),
(11, 'IT1691-E-COMMERCE (IT)', 4, 'SCIT', NULL, NULL),
(12, 'CS1499-INTRODUCTION TO LINUX PROGRAMMING (CCE)', 4, 'SCIT', NULL, NULL),
(13, 'EE1491-RENEWABLE ENERGY SOURCES (EEE)', 4, 'EEE', NULL, NULL),
(14, 'EE1690-ELECTRIC DRIVES (EEE)', 4, 'EEE', NULL, NULL),
(15, 'EE1693-MICROPROCESSORS & MICROCONTROLLERS (EEE)', 4, 'EEE', NULL, NULL),
(16, 'CV1691-ENVIRONMENTAL MANAGEMENT (CIVIL)', 4, 'CIVIL', NULL, NULL),
(17, 'CV2291-ENVIRONMENTAL ENGINEERING (CIVIL)', 4, 'CIVIL', NULL, NULL),
(18, 'AU1490-FUNDAMENTALS OF AUTOMOBILE ENGINEERING (AUTOMOBILE) ', 4, 'AUTOMOBILE', NULL, NULL),
(19, 'AU1491-ELECTRICAL AND HYBRID VEHICLE (AUTOMOBILE)', 4, 'AUTOMOBILE', NULL, NULL),
(20, 'AU1492-ENGINE EMISSIONS AND? CONTROL (AUTOMOBILE)', 4, 'AUTOMOBILE', NULL, NULL),
(21, 'AU1690-VEHICLE? MAINTENANCE AND GARAGE PRACTICE (AUTOMOBILE)', 4, 'AUTOMOBILE', NULL, NULL),
(22, 'AU1691-AUTOMOTIVE SAFETY SYSTEMS (AUTOMOBILE)', 4, 'AUTOMOBILE', NULL, NULL),
(23, 'AU1692-AUTOTRONICS (AUTOMOBILE)', 4, 'AUTOMOBILE', NULL, NULL),
(24, 'MC1492-NETWORK AND PROJECT MANAGEMENT (MECHATRONICS)', 4, 'MECHATRONICS', NULL, NULL),
(25, 'MC1493-INTRODUCTION TO MECHATRONICS SYSTEM (MECHATRONICS)', 4, 'MECHATRONICS', NULL, NULL),
(26, 'MC1690-INTRODUCTION TO ROBOTICS (MECHATRONICS)', 4, 'MECHATRONICS', NULL, NULL),
(27, 'MC1691-ENGINEERING ASPECTS OF INTELLECTUAL PROPERTY RIGHTS (MECHATRONICS)', 4, 'MECHATRONICS', NULL, NULL),
(28, 'MC1692-RELIABILITY ENGINEERING (MECHATRONICS)                         ', 4, 'MECHATRONICS', NULL, NULL),
(29, 'FR1490-FRENCH (Dept of Language)', 4, 'Dept of Language', NULL, NULL),
(30, 'HI3101-VYAVAHARIC HINDI (Dept of Language)', 4, 'Dept of Language', NULL, NULL),
(31, 'GR1490-GERMAN (Dept of Language)', 4, 'Dept of Language', NULL, NULL),
(32, 'MA1490-BIO STATISTICS (MATHEMATICS)????????? ', 4, 'MATHEMATICS', NULL, NULL),
(33, 'MA1690-OPTIMIZATION TECHNIQUES?(MATHEMATICS)????????????? ', 4, 'MATHEMATICS', NULL, NULL),
(34, 'PE1491?-PHYSICAL, HEALTH AND SPORTS EDUCATION (Dept of Arts)', 4, 'Dept of Arts', NULL, NULL),
(35, 'PH1490-ECOPHILOSOPHY (Dept of Arts)', 4, 'Dept of Arts', NULL, NULL),
(36, 'P01490-INTERNATIONAL RELATIONS (Dept of Arts)', 4, 'Dept of Arts', NULL, NULL),
(37, 'PY1490-INTRODUCTION TO NANOSCIENCE AND ITS APPLICATIONS (PHYSICS)', 4, 'PHYSICS', NULL, NULL),
(38, 'PY1492-BIOINFORMATICS FOR ENGINEERS (PHYSICS)', 4, 'PHYSICS', NULL, NULL),
(39, 'PY1491-PLASMA AND ITS TECHNOLOGICAL APPLICATION (PHYSICS)', 4, 'PHYSICS', NULL, NULL),
(40, 'EO1491-SUSTAINABLE DEVELOPMENT (ECONOMICS)', 4, 'ECONOMICS', NULL, NULL),
(41, 'HA1603-TRAVEL & TOURISM (HOTEL MGMT)', 4, 'HOTEL MGMT', NULL, NULL),
(42, 'CM1490-BASICS OF ACCOUNTING (COMMERCE)', 4, 'COMMERCE', NULL, NULL),
(43, 'CM1491-BASICS OF FINANCIAL MARKETS (COMMERCE)', 4, 'COMMERCE', NULL, NULL),
(44, 'CM1492-BUSINESS ETHICS AND CORPORATE GOVERNANCE (COMMERCE)', 4, 'COMMERCE', NULL, NULL),
(45, 'CM1493-SOCIAL ENTREPRENEURSHIP (COMMERCE)', 4, 'COMMERCE', NULL, NULL),
(46, 'JC1490-INTRODUCTION TO MASS COMMUNICATION (JOURNALISM)', 4, 'JOURNALISM', NULL, NULL),
(47, 'CY1490-GREEN CHEMISTRY (CHEMISTRY)', 4, 'CHEMISTRY', NULL, NULL),
(48, 'CY1491-WATER TREATMENT AND SAFE STORAGE (CHEMISTRY)', 4, 'CHEMISTRY', NULL, NULL),
(49, 'PS1490-FOUNDATIONS OF POSITIVE PSYCHOLOGY (Psychology)', 4, 'Psychology', NULL, NULL),
(50, 'MB2609-BUSINESS LANDSCAPE (Management)', 4, 'Management', NULL, NULL),
(51, 'MB2610-FUNDAMENTALS OF MARKETING MANAGEMENT (Management)', 4, 'Management', NULL, NULL),
(52, 'EN2295-PROFESSIONAL LANGUAGE SKILLS AND GRAMMAR COMPETENCE (Language)', 4, 'Language', NULL, NULL),
(53, 'EC1490- INTRODUCTION TO COMMUNICATION SYSTEM (ECE)', 6, 'ECE', NULL, NULL),
(54, ' EC1690-MEMS TECHNOLOGY (ECE)', 6, 'ECE', NULL, NULL),
(55, 'EC1691-MICROCONTROLLERS AND APPLICATIONS (ECE)', 6, 'ECE', NULL, NULL),
(56, 'ME1491-INTRODUCTION OF NANOTECHNOLOGY (MECHANICAL)', 6, 'MECHANICAL', NULL, NULL),
(57, 'ME1492-SMART MATERIALS (MECHANICAL)', 6, 'MECHANICAL', NULL, NULL),
(58, 'ME1690-COMPOSITE MATERIALS (MECHANICAL) ', 6, 'MECHANICAL', NULL, NULL),
(59, 'ME1691-OPERATIONS RESEARCH (MECHANICAL) ', 6, 'MECHANICAL', NULL, NULL),
(60, 'CS1491-OOPS USING JAVA (CSE)', 6, 'SCIT', NULL, NULL),
(61, 'CS1696-DATABASE MANAGEMENT SYSTEMS (SCE)', 6, 'SCIT', NULL, NULL),
(62, 'CS1490-DATA STRUCTURES (IT)', 6, 'SCIT', NULL, NULL),
(63, 'IT1691-E-COMMERCE (IT)', 6, 'SCIT', NULL, NULL),
(64, 'CS1499-INTRODUCTION TO LINUX PROGRAMMING (CCE)', 6, 'SCIT', NULL, NULL),
(65, 'EE1491-RENEWABLE ENERGY SOURCES (EEE)', 6, 'EEE', NULL, NULL),
(66, 'EE1690-ELECTRIC DRIVES (EEE)', 6, 'EEE', NULL, NULL),
(67, 'EE1693-MICROPROCESSORS & MICROCONTROLLERS (EEE)', 6, 'EEE', NULL, NULL),
(68, 'CV1691-ENVIRONMENTAL MANAGEMENT (CIVIL)', 6, 'CIVIL', NULL, NULL),
(69, 'CV2291-ENVIRONMENTAL ENGINEERING (CIVIL)', 6, 'CIVIL', NULL, NULL),
(70, 'AU1490-FUNDAMENTALS OF AUTOMOBILE ENGINEERING (AUTOMOBILE) ', 6, 'AUTOMOBILE', NULL, NULL),
(71, 'AU1491-ELECTRICAL AND HYBRID VEHICLE (AUTOMOBILE)', 6, 'AUTOMOBILE', NULL, NULL),
(72, 'AU1492-ENGINE EMISSIONS AND? CONTROL (AUTOMOBILE)', 6, 'AUTOMOBILE', NULL, NULL),
(73, 'AU1690-VEHICLE? MAINTENANCE AND GARAGE PRACTICE (AUTOMOBILE)', 6, 'AUTOMOBILE', NULL, NULL),
(74, 'AU1691-AUTOMOTIVE SAFETY SYSTEMS (AUTOMOBILE)', 6, 'AUTOMOBILE', NULL, NULL),
(75, 'AU1692-AUTOTRONICS (AUTOMOBILE)\r\n', 6, 'AUTOMOBILE', NULL, NULL),
(76, 'MC1492-NETWORK AND PROJECT MANAGEMENT (MECHATRONICS)', 6, 'MECHATRONICS', NULL, NULL),
(77, 'MC1493-INTRODUCTION TO MECHATRONICS SYSTEM (MECHATRONICS)', 6, 'MECHATRONICS', NULL, NULL),
(78, 'MC1690-INTRODUCTION TO ROBOTICS (MECHATRONICS)', 6, 'MECHATRONICS', NULL, NULL),
(79, 'MC1691-ENGINEERING ASPECTS OF INTELLECTUAL PROPERTY RIGHTS (MECHATRONICS)', 6, 'MECHATRONICS', NULL, NULL),
(80, 'MC1692-RELIABILITY ENGINEERING (MECHATRONICS)                         ', 6, 'MECHATRONICS', NULL, NULL),
(81, 'FR1490-FRENCH (Dept of Language)', 6, 'Dept of Language', NULL, NULL),
(82, 'HI3101-VYAVAHARIC HINDI (Dept of Language)', 6, 'Dept of Language', NULL, NULL),
(83, 'GR1490-GERMAN (Dept of Language)', 6, 'Dept of Language', NULL, NULL),
(84, 'MA1490-BIO STATISTICS (MATHEMATICS)????????? ', 6, 'MATHEMATICS', NULL, NULL),
(85, 'MA1690-OPTIMIZATION TECHNIQUES?(MATHEMATICS)????????????? ', 6, 'MATHEMATICS', NULL, NULL),
(86, 'PE1491?-PHYSICAL, HEALTH AND SPORTS EDUCATION (Dept of Arts)', 6, 'Dept of Arts', NULL, NULL),
(87, 'PH1490-ECOPHILOSOPHY (Dept of Arts)', 6, 'Dept of Arts', NULL, NULL),
(88, 'P01490-INTERNATIONAL RELATIONS (Dept of Arts)', 6, 'Dept of Arts', NULL, NULL),
(89, 'PY1490-INTRODUCTION TO NANOSCIENCE AND ITS APPLICATIONS (PHYSICS)', 6, 'PHYSICS', NULL, NULL),
(90, 'PY1492-BIOINFORMATICS FOR ENGINEERS (PHYSICS)', 6, 'PHYSICS', NULL, NULL),
(91, 'PY1491-PLASMA AND ITS TECHNOLOGICAL APPLICATION (PHYSICS)', 6, 'PHYSICS', NULL, NULL),
(92, 'EO1491-SUSTAINABLE DEVELOPMENT (ECONOMICS)', 6, 'ECONOMICS', NULL, NULL),
(93, 'HA1603-TRAVEL & TOURISM (HOTEL MGMT)', 6, 'HOTEL MGMT', NULL, NULL),
(94, 'CM1490-BASICS OF ACCOUNTING (COMMERCE)', 6, 'COMMERCE', NULL, NULL),
(95, 'CM1491-BASICS OF FINANCIAL MARKETS (COMMERCE)', 6, 'COMMERCE', NULL, NULL),
(96, 'CM1492-BUSINESS ETHICS AND CORPORATE GOVERNANCE (COMMERCE)', 6, 'COMMERCE', NULL, NULL),
(97, 'CM1493-SOCIAL ENTREPRENEURSHIP (COMMERCE)', 6, 'COMMERCE', NULL, NULL),
(98, 'JC1490-INTRODUCTION TO MASS COMMUNICATION (JOURNALISM)', 6, 'JOURNALISM', NULL, NULL),
(99, 'CY1490-GREEN CHEMISTRY (CHEMISTRY)', 6, 'CHEMISTRY', NULL, NULL),
(100, 'CY1491-WATER TREATMENT AND SAFE STORAGE (CHEMISTRY)', 6, 'CHEMISTRY', NULL, NULL),
(101, 'PS1490-FOUNDATIONS OF POSITIVE PSYCHOLOGY (Psychology)', 6, 'Psychology', NULL, NULL),
(102, 'MB2609-BUSINESS LANDSCAPE (Management)', 6, 'Management', NULL, NULL),
(103, 'MB2610-FUNDAMENTALS OF MARKETING MANAGEMENT (Management)', 6, 'Management', NULL, NULL),
(104, 'EN2295-PROFESSIONAL LANGUAGE SKILLS AND GRAMMAR COMPETENCE (Language)', 6, 'Language', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
  `SemID` int(11) unsigned NOT NULL,
  `Semester` int(11) NOT NULL,
  `add_date` varchar(10) DEFAULT NULL,
  `add_time` varchar(10) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`SemID`, `Semester`, `add_date`, `add_time`) VALUES
(1, 3, NULL, NULL),
(2, 4, NULL, NULL),
(3, 5, NULL, NULL),
(4, 6, NULL, NULL),
(6, 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `studentinfo`
--

CREATE TABLE IF NOT EXISTS `studentinfo` (
  `RegistrationNo` int(11) NOT NULL,
  `Department` varchar(20) NOT NULL,
  `Semester` int(11) NOT NULL,
  `OE1` varchar(50) NOT NULL,
  `OE2` varchar(50) NOT NULL,
  `OE3` varchar(50) NOT NULL,
  `OE4` varchar(50) NOT NULL,
  `OE5` varchar(50) NOT NULL,
  `OE6` varchar(50) NOT NULL,
  `CGPA` decimal(4,2) NOT NULL,
  `CGPA1` decimal(4,2) NOT NULL,
  `EntryTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentinfo`
--

INSERT INTO `studentinfo` (`RegistrationNo`, `Department`, `Semester`, `OE1`, `OE2`, `OE3`, `OE4`, `OE5`, `OE6`, `CGPA`, `CGPA1`, `EntryTime`) VALUES
(139111340, 'CIVIL', 4, 'AU1492-ENGINE EMISSIONS AND? CONTROL (AUTOMOBILE)', 'AU1491-ELECTRICAL AND HYBRID VEHICLE (AUTOMOBILE)', 'EE1693-MICROPROCESSORS & MICROCONTROLLERS (EEE)', 'AU1690-VEHICLE? MAINTENANCE AND GARAGE PRACTICE (A', 'CS1499-INTRODUCTION TO LINUX PROGRAMMING (CCE)', 'EE1491-RENEWABLE ENERGY SOURCES (EEE)', '6.80', '7.00', '2017-04-17 19:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `studentinforanked`
--

CREATE TABLE IF NOT EXISTS `studentinforanked` (
  `RegistrationNo` int(11) NOT NULL,
  `Department` varchar(20) NOT NULL,
  `Semester` int(11) NOT NULL,
  `OE1` varchar(50) NOT NULL,
  `OE2` varchar(50) NOT NULL,
  `OE3` varchar(50) NOT NULL,
  `OE4` varchar(50) NOT NULL,
  `OE5` varchar(50) NOT NULL,
  `OE6` varchar(50) NOT NULL,
  `CGPA` decimal(4,2) NOT NULL,
  `CGPA1` decimal(4,2) NOT NULL,
  `EntryTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `studentinforanked`
--
DELIMITER $$
CREATE TRIGGER `trg_insert2` AFTER INSERT ON `studentinforanked`
 FOR EACH ROW BEGIN
declare RN int default 0;
declare Elective varchar(50) default ' ';
declare seatsfilled numeric(10) default 0;
select NEW.RegistrationNo into RN;
select NEW.OE1 into Elective;
select SeatsAllotted into seatsfilled from subseatposition where sub_code = Elective ;
if (seatsfilled <=59 )  then begin
	insert into electivealloted (Rg_No, SubjectAlloted) values(RN, Elective);
       	set seatsfilled =  seatsfilled +1;
	update subseatposition set SeatsAllotted = seatsfilled where sub_code = Elective ;
	end;
else begin
    select NEW.OE2 into Elective;
   select SeatsAllotted into seatsfilled from subseatposition where sub_code = Elective ;
    if (seatsfilled <=59)  then begin
		insert into electivealloted (Rg_No, SubjectAlloted) values(RN, Elective);
                             set seatsfilled =  seatsfilled +1;
		update subseatposition set SeatsAllotted = seatsfilled where sub_code = Elective ;
		end;
 else begin
       select NEW.OE3 into Elective;
      select SeatsAllotted into seatsfilled from subseatposition where sub_code = Elective ;
      if (seatsfilled <=59)  then begin
		insert into electivealloted (Rg_No, SubjectAlloted) values(RN, Elective);

                             set seatsfilled =  seatsfilled +1;
		update subseatposition set SeatsAllotted = seatsfilled where sub_code = Elective ;
		end;
     else begin
            select NEW.OE4 into Elective;
            select SeatsAllotted into seatsfilled from subseatposition where sub_code = Elective ;
            if (seatsfilled <=59)  then begin
		insert into electivealloted (Rg_No, SubjectAlloted) values(RN, Elective);
                             set seatsfilled =  seatsfilled +1;
		update subseatposition set SeatsAllotted = seatsfilled where sub_code = Elective ;
		end;
          else begin
                   select NEW.OE5 into Elective;
                   select SeatsAllotted into seatsfilled from subseatposition where sub_code = Elective ;
                     if (seatsfilled <=59)  then begin
		insert into electivealloted (Rg_No, SubjectAlloted) values(RN, Elective);
                             set seatsfilled =  seatsfilled +1;
		update subseatposition set SeatsAllotted = seatsfilled where sub_code = Elective ;
		end;
                     else begin
        select NEW.OE6 into Elective;
        select SeatsAllotted into seatsfilled from subseatposition where sub_code = Elective ;
        insert into electivealloted (Rg_No, SubjectAlloted) values(RN, Elective);
        set seatsfilled =  seatsfilled +1;
       update subseatposition set SeatsAllotted = seatsfilled where sub_code = Elective ;
                             end;
                  end if;
          end;
 end if;
end;
end if;
end;
end if;
end;
end if;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `subseatposition`
--

CREATE TABLE IF NOT EXISTS `subseatposition` (
  `sub_code` varchar(100) NOT NULL DEFAULT '',
  `SeatsAllotted` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `CGPA` decimal(4,2) NOT NULL,
  `CGPA1` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `name`, `password`, `CGPA`, `CGPA1`) VALUES
('139111340', 'AAYUSH GUPTA', 'AAYUSH GUPTA', '6.80', '7.00'),
('149111694', 'HARSH SINGH', 'HARSH SINGH', '5.30', '7.35'),
('159102010', 'ABHISHEK SINGH', 'ABHISHEK SINGH', '8.20', '6.80'),
('159102112', 'ADITYA AGARWAL', 'ADITYA AGARWAL', '7.94', '6.64'),
('159102113', 'ADITYA ANKUR YADAV', 'ADITYA ANKUR YADAV', '9.43', '7.30'),
('159102114', 'ADITYA SHUBHAM', 'ADITYA SHUBHAM', '8.30', '7.72'),
('159102115', 'AJAY BUNDELA', 'AJAY BUNDELA', '7.20', '4.35'),
('159102116', 'AKASH SHARMA', 'AKASH SHARMA', '8.90', '7.70'),
('159102118', 'AMOGH TANDON', 'AMOGH TANDON', '7.20', '7.77'),
('159102119', 'ANAMIKA GUPTA', 'ANAMIKA GUPTA', '7.00', '7.44'),
('159102120', 'ANIMESH SRIVASTAVA', 'ANIMESH SRIVASTAVA', '7.61', '7.63'),
('159102121', 'ANKAN KUMAR DEOGHARIA', 'ANKAN KUMAR DEOGHARIA', '7.51', '6.30'),
('159102123', 'ANURAG CHATURVEDI', 'ANURAG CHATURVEDI', '7.23', '9.03'),
('159102124', 'ARNEESH AIMA', 'ARNEESH AIMA', '8.58', '9.62'),
('159102125', 'ARPIT HANDUJA', 'ARPIT HANDUJA', '5.70', '8.90'),
('159102126', 'ARUNIMA MISHRA', 'ARUNIMA MISHRA', '8.20', '7.23'),
('159102127', 'ARYAMAAN CHAUHAN', 'ARYAMAAN CHAUHAN', '3.56', '7.45'),
('159102128', 'ASHISH SHUKLA', 'ASHISH SHUKLA', '7.60', '6.80'),
('159102129', 'ASHWIN CHOPRA', 'ASHWIN CHOPRA', '7.80', '7.01'),
('159102130', 'AYUSH CHAURASIA', 'AYUSH CHAURASIA', '8.12', '4.50'),
('159102131', 'BHARAT RAJ MULCHANDANI', 'BHARAT RAJ MULCHANDANI', '9.27', '6.70'),
('159102133', 'DEEPESH SOLANKI', 'DEEPESH SOLANKI', '7.50', '7.80'),
('159102135', 'DEVANSH SINGH', 'DEVANSH SINGH', '7.73', '7.47'),
('159102136', 'DISHANT THAKUR', 'DISHANT THAKUR', '7.88', '7.13'),
('159102137', 'DIVYANGI SINGH', 'DIVYANGI SINGH', '7.82', '7.31'),
('159102138', 'GARVIT KUMAR', 'GARVIT KUMAR', '7.19', '9.55'),
('159102139', 'GEETIKA MITTAL', 'GEETIKA MITTAL', '7.88', '6.92'),
('159102141', 'GOBIND SINGH', 'GOBIND SINGH', '8.39', '8.14'),
('159102142', 'HARSH KAKROO', 'HARSH KAKROO', '6.76', '6.60'),
('159102143', 'HARSHA JALAN', 'HARSHA JALAN', '8.24', '7.98'),
('159102145', 'HARSHAL RAJAN', 'HARSHAL RAJAN', '8.25', '6.75'),
('159102146', 'HIMMANSHU SATBIR SHARRMA', 'HIMMANSHU SATBIR SHARRMA', '3.74', '8.43'),
('159102147', 'HRIDAY KRISHNA KEYAL', 'HRIDAY KRISHNA KEYAL', '9.08', '5.50'),
('159102148', 'ISHAN GARG', 'ISHAN GARG', '7.50', '9.23'),
('159102150', 'ISHAN SHARMA', 'ISHAN SHARMA', '7.64', '6.21'),
('159102151', 'ISHITA MITTAL', 'ISHITA MITTAL', '8.60', '7.80'),
('159102152', 'JAIMEET SINGH SURI', 'JAIMEET SINGH SURI', '7.12', '7.80'),
('159102153', 'TANVEE SHEKHAR GAIKWAD', 'TANVEE SHEKHAR GAIKWAD', '8.88', '7.30'),
('159102154', 'UTKARSH DARBARI', 'UTKARSH DARBARI', '7.57', '7.09'),
('159102155', 'AASHUTOSH RANJAN', 'AASHUTOSH RANJAN', '6.20', '6.80'),
('159102156', 'AASHI KAPOOR', 'AASHI KAPOOR', '7.50', '6.76'),
('159102157', 'Ananta Arora', 'Ananta Arora', '7.56', '6.00'),
('159102158', 'ANKIT KUMAR', 'ANKIT KUMAR', '6.63', '7.88'),
('159102159', 'ANKUR KUMAR SINGH', 'ANKUR KUMAR SINGH', '6.80', '8.14'),
('159102160', 'HARSH BALOT', 'HARSH BALOT', '6.50', '7.00'),
('159102161', 'AJAY SINGH SOLANKI', 'AJAY SINGH SOLANKI', '5.68', '7.90'),
('159102162', 'JAI DOSAJH', 'JAI DOSAJH', '7.50', '8.65'),
('159102163', 'AWINASH SINGH', 'AWINASH SINGH', '4.90', '7.01'),
('159102164', 'ANUSH DAYANAND ANCHAN', 'ANUSH DAYANAND ANCHAN', '7.57', '6.34'),
('159102170', 'AYUSH SHARMA', 'AYUSH SHARMA', '7.61', '7.20'),
('159103057', 'ABHIJEET SINGH', 'ABHIJEET SINGH', '6.50', '7.70'),
('159103071', 'AMAN PRAKASH', 'AMAN PRAKASH', '8.48', '6.00'),
('159103073', 'ANKIT DESHMUKH', 'ANKIT DESHMUKH', '7.04', '6.34'),
('159103101', 'ANKIT KUMAR', 'ANKIT KUMAR', '7.37', '6.50'),
('159105058', 'ANKIT KUMAR SINGH', 'ANKIT KUMAR SINGH', '6.74', '7.11'),
('159108111', 'ANUBHAV GOGOI', 'ANUBHAV GOGOI', '5.62', '6.40'),
('159108117', 'ANURAAG KOTNALA', 'ANURAAG KOTNALA', '6.50', '8.45'),
('159108147', 'DAMERA NIKHIL', 'DAMERA NIKHIL', '7.10', '8.70'),
('159109106', 'HARDIK BHOJWANI', 'HARDIK BHOJWANI', '7.86', '7.74');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`uid`), ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cgpa`
--
ALTER TABLE `cgpa`
  ADD PRIMARY KEY (`RegistrationNo`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`DepId`), ADD UNIQUE KEY `DepName` (`DepName`);

--
-- Indexes for table `electivealloted`
--
ALTER TABLE `electivealloted`
  ADD PRIMARY KEY (`Rg_No`);

--
-- Indexes for table `oechoice`
--
ALTER TABLE `oechoice`
  ADD PRIMARY KEY (`oeid`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`SemID`), ADD UNIQUE KEY `Semester` (`Semester`);

--
-- Indexes for table `studentinfo`
--
ALTER TABLE `studentinfo`
  ADD PRIMARY KEY (`RegistrationNo`);

--
-- Indexes for table `studentinforanked`
--
ALTER TABLE `studentinforanked`
  ADD PRIMARY KEY (`RegistrationNo`);

--
-- Indexes for table `subseatposition`
--
ALTER TABLE `subseatposition`
  ADD PRIMARY KEY (`sub_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `uid` int(50) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=122;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `DepId` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `oechoice`
--
ALTER TABLE `oechoice`
  MODIFY `oeid` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=105;
--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `SemID` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
