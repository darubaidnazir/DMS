-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2022 at 02:11 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dmstest`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignedsubject`
--

CREATE TABLE `assignedsubject` (
  `subjectid` int(100) NOT NULL,
  `semesterid` int(100) NOT NULL,
  `teacherid` int(100) NOT NULL,
  `updatepermission` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignedsubject`
--

INSERT INTO `assignedsubject` (`subjectid`, `semesterid`, `teacherid`, `updatepermission`) VALUES
(901025, 901032, 701025, '0'),
(901028, 901039, 701030, '0'),
(901031, 901039, 701034, '0'),
(901040, 901039, 701036, '0'),
(901038, 901035, 701032, '0'),
(901031, 901035, 701034, '0'),
(901035, 901036, 701033, '0'),
(901029, 901036, 701035, '0'),
(901028, 901037, 701033, '0'),
(901032, 901040, 701031, '0'),
(901024, 901033, 701037, '0'),
(901025, 901034, 701037, '0'),
(901026, 901034, 701037, '0'),
(901027, 901034, 701037, '0'),
(901026, 901041, 701037, '0'),
(901030, 901040, 701038, '0'),
(901028, 901040, 701038, '0'),
(901035, 901039, 701038, '2'),
(901026, 901033, 701045, '0'),
(901043, 901033, 701046, '0'),
(901045, 901050, 701047, '0'),
(901045, 901051, 701047, '0'),
(901030, 901039, 701038, '2'),
(901048, 901052, 701048, '0');

-- --------------------------------------------------------

--
-- Table structure for table `batch`
--

CREATE TABLE `batch` (
  `batchid` int(11) NOT NULL,
  `batchyear` int(10) NOT NULL,
  `currentsemester` int(10) NOT NULL DEFAULT 0,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `branchid` int(100) NOT NULL,
  `batchstatus` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batchid`, `batchyear`, `currentsemester`, `creationdate`, `branchid`, `batchstatus`) VALUES
(301037, 2018, 2, '2022-08-15 12:24:57', 201037, '1'),
(301038, 2019, 2, '2022-08-19 05:56:25', 201037, '1'),
(301041, 2024, 0, '2022-08-15 16:02:43', 201038, '0'),
(301042, 2018, 1, '2022-08-15 16:52:32', 201043, '1'),
(301043, 2019, 2, '2022-08-15 18:06:57', 201043, '1'),
(301044, 2020, 1, '2022-08-15 16:52:36', 201043, '1'),
(301045, 2021, 1, '2022-08-15 16:52:44', 201043, '1'),
(301046, 2021, 1, '2022-08-15 16:52:45', 201042, '1'),
(301049, 2018, 2, '2022-08-22 13:50:42', 201049, '1'),
(301050, 2019, 2, '2022-08-22 13:49:55', 201049, '1'),
(301051, 2020, 4, '2022-08-22 13:51:37', 201049, '0'),
(301052, 2021, 2, '2022-08-22 18:52:42', 201050, '1'),
(301054, 2018, 1, '2022-08-31 12:52:06', 201053, '1'),
(301055, 2022, 1, '2022-08-31 12:52:10', 201054, '1');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branchid` int(100) NOT NULL,
  `branchname` varchar(100) NOT NULL,
  `totalsemester` varchar(100) NOT NULL,
  `creationdate` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `coordinatorid` bigint(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branchid`, `branchname`, `totalsemester`, `creationdate`, `coordinatorid`) VALUES
(201037, 'Mtech', '4', '2022-08-15 12:20:31.000000', 101013),
(201038, 'Btech', '4', '2022-08-15 15:39:40.000000', 101013),
(201039, 'Mtechx', '4', '2022-08-15 15:41:14.000000', 101013),
(201040, 'xmm', '4', '2022-08-15 15:43:06.000000', 101013),
(201042, 'Mtech', '4', '2022-08-15 16:49:20.000000', 101019),
(201043, 'Btech', '8', '2022-08-15 16:49:34.000000', 101019),
(201049, 'Mtech', '4', '2022-08-22 13:39:50.000000', 101020),
(201050, 'M. Tech. CSE', '4', '2022-08-22 18:35:25.000000', 101021),
(201051, 'B. Tech. CSE', '8', '2022-08-22 18:36:07.000000', 101021),
(201052, 'Ctech', '3', '2022-08-24 11:52:17.000000', 101019),
(201053, 'Btech', '8', '2022-08-31 12:50:36.000000', 101023),
(201054, 'Mtech', '4', '2022-08-31 12:51:15.000000', 101023);

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `coordinatiorid` int(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenumber` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `createdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`coordinatiorid`, `fullname`, `email`, `phonenumber`, `department`, `password`, `createdate`) VALUES
(101013, 'darubaidnazir786', 'darubaidnazir786@gmail.com', '9622922604', 'cse', '$2y$10$XK6aHSh/55oW9Ox/M7SNrusuJgOJxQUe3uI/xAhRylP5vycjnHVya', '2022-08-10 05:20:59'),
(101019, 'Er Khalid Hussain', 'khalid.hussain@uok.edu.in', '9419090444', 'Computer Science and Engineering', '$2y$10$bMFr7hw5wEhQt7EP0fNC..g9sNfuZmgdCwuL3l9BkkTDIocLCzzu.', '2022-08-15 16:35:59'),
(101020, 'Umer Farooq', 'umer@gmail.com', '7898789878', 'COMPUTER', '$2y$10$iVAgS4t0TdkMD3RrwQXoSOxqbYViMrvPZ6Qm29bp/OkLky03bwd7i', '2022-08-22 13:21:14'),
(101021, 'Khalid Hussain', 'khalidhussain@gmail.com', '9622922604', 'CSE', '$2y$10$BNkZS7CZAg93K.a9Ln4S4ewdcKyHK3Nv0y54fKHAWQVEKSLvU/lKa', '2022-08-22 18:07:54'),
(101022, 'farhan Farooq', 'farhan@gmail.com', '9622922604', 'CSE', '$2y$10$RgBdsd0t/SoSfBZdmJ8Vou4cI7cygMGa2RYqVgXOVLsaVqORTzUo.', '2022-08-31 12:41:05'),
(101023, 'farhan Farooq', 'farhan1@gmail.com', '9622922604', 'CSE', '$2y$10$yrB58RMT4JxzsfmzYMo9t.Y4PD0mXLIVjzxK4/A/Ii6T.G4DsjbOC', '2022-08-31 12:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `lectureplan`
--

CREATE TABLE `lectureplan` (
  `semesterid` int(100) NOT NULL,
  `subjectid` int(100) NOT NULL,
  `lecturedate` date NOT NULL,
  `lecturehour` int(100) NOT NULL,
  `lecturetopic` varchar(100) NOT NULL,
  `creationtime` date NOT NULL DEFAULT current_timestamp(),
  `timeslotstart` varchar(100) NOT NULL,
  `timeslotend` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lectureplan`
--

INSERT INTO `lectureplan` (`semesterid`, `subjectid`, `lecturedate`, `lecturehour`, `lecturetopic`, `creationtime`, `timeslotstart`, `timeslotend`) VALUES
(901039, 901035, '2022-08-30', 1, 'first test', '2022-08-24', '', ''),
(901039, 901035, '2022-08-31', 1, 'second', '2022-08-24', '', ''),
(901039, 901039, '2022-08-03', 1, 'FHGDFHDGF', '2022-08-25', '', ''),
(901039, 901035, '2022-08-03', 1, 'dffddf', '2022-08-25', '', ''),
(901039, 901035, '2022-08-27', 1, 'kdksks', '2022-08-27', '10:00', '11:00'),
(901039, 901030, '2022-08-27', 2, 'some', '2022-08-27', '11:00', '13:00'),
(901040, 901030, '2022-08-27', 1, 'xs', '2022-08-27', '11:00', '12:00'),
(901052, 901048, '2022-08-29', 1, 'html', '2022-08-31', '11:00', '12:00');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `semesterid` int(11) NOT NULL,
  `semesterno` int(100) NOT NULL,
  `batchid` int(11) NOT NULL,
  `opendate` timestamp NOT NULL DEFAULT current_timestamp(),
  `closedate` timestamp NULL DEFAULT NULL,
  `semesterstatus` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`semesterid`, `semesterno`, `batchid`, `opendate`, `closedate`, `semesterstatus`) VALUES
(901032, 1, 301037, '2022-08-15 12:22:02', '2022-08-15 12:24:57', '0'),
(901033, 2, 301037, '2022-08-15 12:24:57', NULL, '1'),
(901034, 1, 301038, '2022-08-15 15:23:23', '2022-08-19 05:56:25', '0'),
(901035, 1, 301042, '2022-08-15 16:52:31', NULL, '1'),
(901036, 1, 301043, '2022-08-15 16:52:34', '2022-08-15 18:06:57', '0'),
(901037, 1, 301044, '2022-08-15 16:52:36', NULL, '1'),
(901038, 1, 301045, '2022-08-15 16:52:44', NULL, '1'),
(901039, 1, 301046, '2022-08-15 16:52:45', NULL, '1'),
(901040, 2, 301043, '2022-08-15 18:06:57', NULL, '1'),
(901041, 2, 301038, '2022-08-19 05:56:25', NULL, '1'),
(901042, 1, 301049, '2022-08-22 13:41:46', '2022-08-22 13:50:42', '0'),
(901043, 1, 301050, '2022-08-22 13:49:47', '2022-08-22 13:49:55', '0'),
(901044, 2, 301050, '2022-08-22 13:49:55', NULL, '1'),
(901045, 2, 301049, '2022-08-22 13:50:42', NULL, '1'),
(901046, 1, 301051, '2022-08-22 13:51:17', '2022-08-22 13:51:24', '0'),
(901047, 2, 301051, '2022-08-22 13:51:25', '2022-08-22 13:51:28', '0'),
(901048, 3, 301051, '2022-08-22 13:51:28', '2022-08-22 13:51:32', '0'),
(901049, 4, 301051, '2022-08-22 13:51:32', '2022-08-22 13:51:37', '0'),
(901050, 1, 301052, '2022-08-22 18:37:56', '2022-08-22 18:52:42', '0'),
(901051, 2, 301052, '2022-08-22 18:52:42', NULL, '1'),
(901052, 1, 301054, '2022-08-31 12:52:06', NULL, '1'),
(901053, 1, 301055, '2022-08-31 12:52:10', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentid` int(11) NOT NULL,
  `studentname` varchar(100) DEFAULT NULL,
  `studentregno` varchar(100) DEFAULT NULL,
  `studentrollno` varchar(100) DEFAULT NULL,
  `studentemail` varchar(100) DEFAULT NULL,
  `studentdob` varchar(100) DEFAULT NULL,
  `studentpassword` varchar(100) NOT NULL,
  `studentstatus` varchar(100) NOT NULL DEFAULT 'inactive',
  `creationtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `batchid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `studentname`, `studentregno`, `studentrollno`, `studentemail`, `studentdob`, `studentpassword`, `studentstatus`, `creationtime`, `batchid`) VALUES
(502245, NULL, NULL, NULL, 'darubaidnazir@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:12', 301037),
(502246, NULL, NULL, NULL, 'zamin@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:12', 301037),
(502247, NULL, NULL, NULL, 'areeba@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:12', 301037),
(502248, NULL, NULL, NULL, 'mesh@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:12', 301037),
(502249, NULL, NULL, NULL, 'exam@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:12', 301037),
(502250, NULL, NULL, NULL, 'masma@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502251, NULL, NULL, NULL, 'mamsa@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502252, NULL, NULL, NULL, 'mamaa@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502253, NULL, NULL, NULL, 'massma@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502254, NULL, NULL, NULL, 'mamaaaa@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502255, NULL, NULL, NULL, 'mamaee@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502256, NULL, NULL, NULL, 'mafffma@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502257, NULL, NULL, NULL, 'mfffama@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502258, NULL, NULL, NULL, 'mwwama@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502259, NULL, NULL, NULL, 'a122@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502260, NULL, NULL, NULL, 'shanie61@hotmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502261, NULL, NULL, NULL, 'keshaun40@green.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502262, NULL, NULL, NULL, 'jkris@batz.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502263, NULL, NULL, NULL, 'bokuneva@kreiger.org', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502264, NULL, NULL, NULL, 'semard@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502265, NULL, NULL, NULL, 'rhills@krajcik.info', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502266, NULL, NULL, NULL, 'yfadel@hotmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502267, NULL, NULL, NULL, 'trevion.little@stokes.net', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502268, NULL, NULL, NULL, 'hershel.lebsack@yahoo.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502269, NULL, NULL, NULL, 'durward40@hegmann.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502270, NULL, NULL, NULL, 'smayert@yahoo.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502271, NULL, NULL, NULL, 'amari.torp@kuvalis.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502272, NULL, NULL, NULL, 'xswift@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502273, NULL, NULL, NULL, 'carter.ines@hotmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502274, NULL, NULL, NULL, 'walton.rodriguez@heathcote.net', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502275, NULL, NULL, NULL, 'trey.rowe@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502276, NULL, NULL, NULL, 'harmony02@yahoo.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502277, NULL, NULL, NULL, 'peter18@yahoo.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502278, NULL, NULL, NULL, 'pansy.corkery@weissnat.org', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502279, NULL, NULL, NULL, 'npowlowski@torp.biz', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502280, NULL, NULL, NULL, 'stefan31@smitham.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502281, NULL, NULL, NULL, 'beaulah.roberts@yahoo.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502282, NULL, NULL, NULL, 'shania.leannon@hodkiewicz.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502283, NULL, NULL, NULL, 'sporer.zack@feest.org', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502284, NULL, NULL, NULL, 'drussel@gleichner.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502285, NULL, NULL, NULL, 'bergnaum.genoveva@hotmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502286, NULL, NULL, NULL, 'mary14@stracke.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502287, NULL, NULL, NULL, 'esmeralda.reichel@wilkinson.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502288, NULL, NULL, NULL, 'hyatt.lois@hotmail.com', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502289, NULL, NULL, NULL, 'rodriguez.adrienne@spencer.net', NULL, '', 'inactive', '2022-09-04 12:09:13', 301037),
(502290, NULL, NULL, NULL, 'kurtis.bartell@streich.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502291, NULL, NULL, NULL, 'brown.viva@vandervort.biz', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502292, NULL, NULL, NULL, 'morissette.harmony@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502293, NULL, NULL, NULL, 'palma.reynolds@yahoo.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502294, NULL, NULL, NULL, 'oren21@wuckert.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502295, NULL, NULL, NULL, 'fhowell@hotmail.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502296, NULL, NULL, NULL, 'willow74@rogahn.info', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502297, NULL, NULL, NULL, 'weimann.giovani@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502298, NULL, NULL, NULL, 'ondricka.silas@hotmail.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502299, NULL, NULL, NULL, 'lenny.stanton@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502300, NULL, NULL, NULL, 'tracy.goyette@carroll.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502301, NULL, NULL, NULL, 'kblanda@schoen.biz', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502302, NULL, NULL, NULL, 'abbott.joana@kuvalis.info', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502303, NULL, NULL, NULL, 'dillan.ullrich@gmail.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502304, NULL, NULL, NULL, 'von.bennie@yahoo.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502305, NULL, NULL, NULL, 'flossie29@zboncak.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502306, NULL, NULL, NULL, 'courtney.nitzsche@williamson.org', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502307, NULL, NULL, NULL, 'noemie.vandervort@yahoo.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502308, NULL, NULL, NULL, 'benjamin.padberg@hotmail.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502309, NULL, NULL, NULL, 'nienow.charlene@huel.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502310, NULL, NULL, NULL, 'annalise32@fahey.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502311, NULL, NULL, NULL, 'bayer.albin@kris.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502312, NULL, NULL, NULL, 'jlueilwitz@swaniawski.biz', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502313, NULL, NULL, NULL, 'kiehn.victoria@hotmail.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502314, NULL, NULL, NULL, 'cassin.velva@torphy.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502315, NULL, NULL, NULL, 'ophelia.cruickshank@towne.info', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502316, NULL, NULL, NULL, 'ellis59@mills.net', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502317, NULL, NULL, NULL, 'davis.ima@mohr.org', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502318, NULL, NULL, NULL, 'larkin.rigoberto@hotmail.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037),
(502319, NULL, NULL, NULL, 'mclaughlin.howell@senger.com', NULL, '', 'inactive', '2022-09-04 12:09:14', 301037);

-- --------------------------------------------------------

--
-- Table structure for table `studentabsent`
--

CREATE TABLE `studentabsent` (
  `studentid` int(100) NOT NULL,
  `subjectid` int(100) NOT NULL,
  `semesterid` int(100) NOT NULL,
  `markdate` varchar(100) NOT NULL,
  `lecturehour` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentabsent`
--

INSERT INTO `studentabsent` (`studentid`, `subjectid`, `semesterid`, `markdate`, `lecturehour`) VALUES
(501260, 901035, 901039, '2022-08-30', 1),
(501268, 901035, 901039, '2022-08-30', 1),
(501271, 901035, 901039, '2022-08-30', 1),
(501272, 901035, 901039, '2022-08-30', 1),
(501276, 901035, 901039, '2022-08-30', 1),
(501291, 901035, 901039, '2022-08-30', 1),
(501305, 901035, 901039, '2022-08-30', 1),
(501314, 901035, 901039, '2022-08-30', 1),
(501320, 901035, 901039, '2022-08-30', 1),
(501324, 901035, 901039, '2022-08-30', 1),
(501260, 901035, 901039, '2022-08-31', 1),
(501261, 901035, 901039, '2022-08-31', 1),
(501262, 901035, 901039, '2022-08-31', 1),
(501263, 901035, 901039, '2022-08-31', 1),
(501264, 901035, 901039, '2022-08-31', 1),
(501265, 901035, 901039, '2022-08-31', 1),
(501266, 901035, 901039, '2022-08-31', 1),
(501267, 901035, 901039, '2022-08-31', 1),
(501268, 901035, 901039, '2022-08-31', 1),
(501269, 901035, 901039, '2022-08-31', 1),
(501270, 901035, 901039, '2022-08-31', 1),
(501271, 901035, 901039, '2022-08-31', 1),
(501272, 901035, 901039, '2022-08-31', 1),
(501273, 901035, 901039, '2022-08-31', 1),
(501274, 901035, 901039, '2022-08-31', 1),
(501275, 901035, 901039, '2022-08-31', 1),
(501276, 901035, 901039, '2022-08-31', 1),
(501277, 901035, 901039, '2022-08-31', 1),
(501278, 901035, 901039, '2022-08-31', 1),
(501279, 901035, 901039, '2022-08-31', 1),
(501280, 901035, 901039, '2022-08-31', 1),
(501281, 901035, 901039, '2022-08-31', 1),
(501282, 901035, 901039, '2022-08-31', 1),
(501283, 901035, 901039, '2022-08-31', 1),
(501284, 901035, 901039, '2022-08-31', 1),
(501285, 901035, 901039, '2022-08-31', 1),
(501286, 901035, 901039, '2022-08-31', 1),
(501287, 901035, 901039, '2022-08-31', 1),
(501288, 901035, 901039, '2022-08-31', 1),
(501290, 901035, 901039, '2022-08-31', 1),
(501291, 901035, 901039, '2022-08-31', 1),
(501292, 901035, 901039, '2022-08-31', 1),
(501294, 901035, 901039, '2022-08-31', 1),
(501295, 901035, 901039, '2022-08-31', 1),
(501296, 901035, 901039, '2022-08-31', 1),
(501299, 901035, 901039, '2022-08-31', 1),
(501300, 901035, 901039, '2022-08-31', 1),
(501301, 901035, 901039, '2022-08-31', 1),
(501302, 901035, 901039, '2022-08-31', 1),
(501303, 901035, 901039, '2022-08-31', 1),
(501304, 901035, 901039, '2022-08-31', 1),
(501305, 901035, 901039, '2022-08-31', 1),
(501306, 901035, 901039, '2022-08-31', 1),
(501307, 901035, 901039, '2022-08-31', 1),
(501308, 901035, 901039, '2022-08-31', 1),
(501309, 901035, 901039, '2022-08-31', 1),
(501310, 901035, 901039, '2022-08-31', 1),
(501311, 901035, 901039, '2022-08-31', 1),
(501312, 901035, 901039, '2022-08-31', 1),
(501313, 901035, 901039, '2022-08-31', 1),
(501314, 901035, 901039, '2022-08-31', 1),
(501315, 901035, 901039, '2022-08-31', 1),
(501316, 901035, 901039, '2022-08-31', 1),
(501317, 901035, 901039, '2022-08-31', 1),
(501318, 901035, 901039, '2022-08-31', 1),
(501319, 901035, 901039, '2022-08-31', 1),
(501320, 901035, 901039, '2022-08-31', 1),
(501321, 901035, 901039, '2022-08-31', 1),
(501322, 901035, 901039, '2022-08-31', 1),
(501323, 901035, 901039, '2022-08-31', 1),
(501324, 901035, 901039, '2022-08-31', 1),
(501325, 901035, 901039, '2022-08-31', 1),
(501326, 901035, 901039, '2022-08-31', 1),
(501327, 901035, 901039, '2022-08-31', 1),
(501328, 901035, 901039, '2022-08-31', 1),
(501329, 901035, 901039, '2022-08-31', 1),
(501330, 901035, 901039, '2022-08-31', 1),
(501331, 901035, 901039, '2022-08-31', 1),
(501332, 901035, 901039, '2022-08-31', 1),
(501333, 901035, 901039, '2022-08-31', 1),
(501418, 901035, 901039, '2022-08-12', 2),
(501444, 901035, 901039, '2022-08-12', 2),
(501444, 901035, 901039, '2022-08-27', 1),
(501417, 901030, 901039, '2022-08-27', 2),
(501443, 901030, 901039, '2022-08-27', 2),
(501493, 901048, 901052, '2022-08-29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectid` int(11) NOT NULL,
  `subjectname` varchar(100) NOT NULL,
  `subjectcode` varchar(100) NOT NULL,
  `coordinatorid` varchar(100) NOT NULL,
  `creationtime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectid`, `subjectname`, `subjectcode`, `coordinatorid`, `creationtime`) VALUES
(901024, 'C plus plus', 'CSE 1231', '101013', '2022-08-15 12:23:57'),
(901025, 'mm', 'CSE 1231s', '101013', '2022-08-15 12:24:18'),
(901026, 'AI', 'CSE 7895', '101013', '2022-08-15 13:29:31'),
(901027, 'AI', 'ffsssssssssssss', '101013', '2022-08-15 13:30:40'),
(901028, 'C Programming', 'CSE-1716', '101019', '2022-08-15 16:44:11'),
(901029, 'C Plus Plus', 'CSE-1718', '101019', '2022-08-15 16:44:34'),
(901030, 'JAVA', 'CSE-1818', '101019', '2022-08-15 16:44:47'),
(901031, 'Database Management System', 'CSE-1918', '101019', '2022-08-15 16:45:12'),
(901032, 'Compiler Design', 'CSE-2058', '101019', '2022-08-15 16:45:34'),
(901033, 'Java Lab', 'CSE-3018L', '101019', '2022-08-15 16:45:59'),
(901034, 'C Programming Lab', 'CSE-2018L', '101019', '2022-08-15 16:46:17'),
(901035, 'Operating System', 'CSE-2019', '101019', '2022-08-15 16:47:13'),
(901036, 'Computer Network', 'CSE-3568', '101019', '2022-08-15 16:47:34'),
(901037, 'Computer Network Lab', 'CSE-3568L', '101019', '2022-08-15 16:47:45'),
(901038, 'Computer Network  and Security', 'CSE-8596', '101019', '2022-08-15 16:48:07'),
(901039, 'Al', 'CSE-8896', '101019', '2022-08-15 16:48:16'),
(901040, 'Machine Learning', 'CSE-8866', '101019', '2022-08-15 16:48:34'),
(901041, 'Urdu', 'CSE-5452', '101019', '2022-08-18 16:00:03'),
(901042, 'Machine Learning', 'CSE-8866', '101020', '2022-08-22 14:39:00'),
(901043, 'C plus plusfd', 'CSE 1231sd', '101013', '2022-08-22 14:47:40'),
(901044, 'ff', 'CSE 7898', '101013', '2022-08-22 14:50:41'),
(901045, 'Machine Learning', 'CSE-8866', '101021', '2022-08-22 18:42:34'),
(901046, 'Database Management System', 'CSE-8888', '101021', '2022-08-22 18:45:37'),
(901047, 'Compiler Design', 'CSE-8887', '101021', '2022-08-22 18:45:54'),
(901048, 'iwt', 'cse-1103', '101023', '2022-08-31 14:46:16');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacherid` int(11) NOT NULL,
  `teacherusername` varchar(100) NOT NULL,
  `teacherempid` varchar(100) NOT NULL,
  `teacherphonenumber` varchar(100) NOT NULL,
  `teacherposition` int(100) NOT NULL,
  `teacherpassword` varchar(100) NOT NULL,
  `creationtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `coordinatorid` int(100) NOT NULL,
  `teacherstatus` varchar(100) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacherid`, `teacherusername`, `teacherempid`, `teacherphonenumber`, `teacherposition`, `teacherpassword`, `creationtime`, `coordinatorid`, `teacherstatus`) VALUES
(701025, 'Waseem_Bakshi', 'emp121', '1234567898', 1, '100000', '2022-08-15 10:44:34', 101013, 'disabled'),
(701030, 'waseemjeelani', 'CSE-0001', '1232121232', 1, '100000', '2022-08-15 16:38:55', 101019, 'disabled'),
(701031, 'hesamakhter', 'CSE-0002', '1232121232', 1, '100000', '2022-08-15 16:39:14', 101019, 'active'),
(701032, 'suhailakhter', 'CSE-0003', '9696857412', 1, '100000', '2022-08-15 16:39:48', 101019, 'active'),
(701033, 'harisqazi', 'CSE-0004', '9696857896', 1, '100000', '2022-08-15 16:40:52', 101019, 'active'),
(701034, 'Khalid_hussain', 'CSE-0005', '7007845621', 1, '100000', '2022-08-15 16:41:54', 101019, 'active'),
(701035, 'SumairaMehraj', 'CSE-C-0006', '7004785161', 2, '100000', '2022-08-15 16:42:41', 101019, 'active'),
(701036, 'YousufMir', 'CSE-C-0007', '7004785161', 2, '100000', '2022-08-15 16:43:06', 101019, 'active'),
(701037, 'darubi', 'emp121', '1234567895', 1, '$2y$10$4PXVlVxVpKQ7wDeJgIYFi.m0/m0KOK4RwoOkXPCCJLEYPGn25Urxu', '2022-08-18 12:29:55', 101013, 'disabled'),
(701038, 'Hesam_akhter', 'EMP -2015', '1245789865', 1, '$2y$10$tPUC/nrQQo8zBupn/IfKpOL.P04pX0l9uE9gFimPofjwS5kKK1fNW', '2022-08-20 09:09:04', 101019, 'active'),
(701045, 'Umersdfsd', 'sdfsdf', '1234567898', 1, '$2y$10$OKcw.6QHPaMNAT7TMNFp1eHLYjRNCbxtmRcXRh9yQ0z11a6x8e95i', '2022-08-22 14:54:15', 101013, 'disabled'),
(701046, 'Khalid_Hussainss', 'dmsn', '1234567897', 1, '$2y$10$wD6.aITRrY.pL4YUW9GnSu61cvoejazwfuvMtU./o625EMPdvvTpK', '2022-08-22 15:00:01', 101013, 'active'),
(701047, 'suhailakhterk', 'CSE-0004', '1236547898', 2, '$2y$10$klMw0iPLvFC1ea51BRuIWuhGW3YjDoCBt25KarH8h5Tei8KT4NfRi', '2022-08-22 18:41:56', 101021, 'active'),
(701048, 'Khalid_Hussainn', 'Emp-01', '1234567890', 1, '$2y$10$QvA0QRBKRzFEKE8lv0GWteOJHfT1CQcmeMWoCqtY.jreld0pSQjbG', '2022-08-31 14:45:34', 101023, 'disabled'),
(701049, 'hesam', 'emp121', '1234567890', 1, '$2y$10$bsjuSYS8avQC4OKPo7K8d.kOuE6tUMnLZk5EQkRzZSeUZfcRILXrW', '2022-08-31 15:11:54', 101023, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `start` varchar(10) NOT NULL,
  `end` varchar(10) NOT NULL,
  `coordinatorid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`start`, `end`, `coordinatorid`) VALUES
('9:30', '15:30', 101019),
('9:00', '15:00', 101023);

-- --------------------------------------------------------

--
-- Table structure for table `updateattendance`
--

CREATE TABLE `updateattendance` (
  `studentid` int(100) NOT NULL,
  `semesterid` int(100) NOT NULL,
  `subjectid` int(11) NOT NULL,
  `message` varchar(100) NOT NULL,
  `action` int(100) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `updateattendance`
--

INSERT INTO `updateattendance` (`studentid`, `semesterid`, `subjectid`, `message`, `action`, `time`, `updatedate`) VALUES
(501416, 901039, 901035, 'hi', 1, '2022-08-24 07:31:30', '2022-08-30'),
(501491, 901052, 901048, 'emet', 1, '2022-08-31 15:07:35', '2022-08-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batch`
--
ALTER TABLE `batch`
  ADD PRIMARY KEY (`batchid`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branchid`);

--
-- Indexes for table `coordinator`
--
ALTER TABLE `coordinator`
  ADD PRIMARY KEY (`coordinatiorid`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`semesterid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subjectid`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacherid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `batchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301056;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201055;

--
-- AUTO_INCREMENT for table `coordinator`
--
ALTER TABLE `coordinator`
  MODIFY `coordinatiorid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101024;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semesterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901054;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502320;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901049;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=701050;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
