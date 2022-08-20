-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2022 at 06:41 PM
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
  `teacherid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignedsubject`
--

INSERT INTO `assignedsubject` (`subjectid`, `semesterid`, `teacherid`) VALUES
(901025, 901032, 701025),
(901028, 901039, 701030),
(901031, 901039, 701034),
(901040, 901039, 701036),
(901038, 901035, 701032),
(901031, 901035, 701034),
(901035, 901036, 701033),
(901029, 901036, 701035),
(901028, 901037, 701033),
(901032, 901040, 701031),
(901024, 901033, 701037),
(901025, 901034, 701037),
(901026, 901034, 701037),
(901027, 901034, 701037),
(901026, 901041, 701037),
(901030, 901040, 701038),
(901028, 901040, 701038),
(901035, 901039, 701038);

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
(301047, 2018, 0, '2022-08-19 15:04:39', 201040, '0');

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
(201043, 'Btech', '8', '2022-08-15 16:49:34.000000', 101019);

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
(101019, 'Er Khalid Hussain', 'khalid.hussain@uok.edu.in', '9419090444', 'Computer Science and Engineering', '$2y$10$bMFr7hw5wEhQt7EP0fNC..g9sNfuZmgdCwuL3l9BkkTDIocLCzzu.', '2022-08-15 16:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `lectureplan`
--

CREATE TABLE `lectureplan` (
  `semesterid` int(100) NOT NULL,
  `subjectid` int(100) NOT NULL,
  `lecturedate` date NOT NULL,
  `lecturehour` int(100) NOT NULL,
  `lecturetopic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lectureplan`
--

INSERT INTO `lectureplan` (`semesterid`, `subjectid`, `lecturedate`, `lecturehour`, `lecturetopic`) VALUES
(901040, 901028, '2022-08-20', 3, 'jfnjd'),
(901040, 901028, '2022-08-21', 1, 'osmjjd'),
(901040, 901028, '2022-08-22', 1, 'osmjjdjjsjs');

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
(901041, 2, 301038, '2022-08-19 05:56:25', NULL, '1');

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
(501259, NULL, NULL, NULL, 'darubaidnazir@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501260, NULL, NULL, NULL, 'zamin@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501261, NULL, NULL, NULL, 'areeba@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501262, NULL, NULL, NULL, 'mesh@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501263, NULL, NULL, NULL, 'exam@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501264, NULL, NULL, NULL, 'masma@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501265, NULL, NULL, NULL, 'mamsa@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501266, NULL, NULL, NULL, 'mamaa@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501267, NULL, NULL, NULL, 'massma@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501268, NULL, NULL, NULL, 'mamaaaa@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501269, NULL, NULL, NULL, 'mamaee@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501270, NULL, NULL, NULL, 'mafffma@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501271, NULL, NULL, NULL, 'mfffama@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501272, NULL, NULL, NULL, 'mwwama@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501273, NULL, NULL, NULL, 'a122@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501274, NULL, NULL, NULL, 'shanie61@hotmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501275, NULL, NULL, NULL, 'keshaun40@green.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501276, NULL, NULL, NULL, 'jkris@batz.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501277, NULL, NULL, NULL, 'bokuneva@kreiger.org', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501278, NULL, NULL, NULL, 'semard@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501279, NULL, NULL, NULL, 'rhills@krajcik.info', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501280, NULL, NULL, NULL, 'yfadel@hotmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501281, NULL, NULL, NULL, 'trevion.little@stokes.net', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501282, NULL, NULL, NULL, 'hershel.lebsack@yahoo.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501283, NULL, NULL, NULL, 'durward40@hegmann.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501284, NULL, NULL, NULL, 'smayert@yahoo.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501285, NULL, NULL, NULL, 'amari.torp@kuvalis.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501286, NULL, NULL, NULL, 'xswift@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501287, NULL, NULL, NULL, 'carter.ines@hotmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501288, NULL, NULL, NULL, 'walton.rodriguez@heathcote.net', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501289, NULL, NULL, NULL, 'trey.rowe@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501290, NULL, NULL, NULL, 'harmony02@yahoo.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501291, NULL, NULL, NULL, 'peter18@yahoo.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501292, NULL, NULL, NULL, 'pansy.corkery@weissnat.org', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501293, NULL, NULL, NULL, 'npowlowski@torp.biz', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501294, NULL, NULL, NULL, 'stefan31@smitham.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501295, NULL, NULL, NULL, 'beaulah.roberts@yahoo.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501296, NULL, NULL, NULL, 'shania.leannon@hodkiewicz.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501297, NULL, NULL, NULL, 'sporer.zack@feest.org', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501298, NULL, NULL, NULL, 'drussel@gleichner.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501299, NULL, NULL, NULL, 'bergnaum.genoveva@hotmail.com', NULL, '', 'inactive', '2022-08-20 09:13:25', 301046),
(501300, NULL, NULL, NULL, 'mary14@stracke.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501301, NULL, NULL, NULL, 'esmeralda.reichel@wilkinson.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501302, NULL, NULL, NULL, 'hyatt.lois@hotmail.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501303, NULL, NULL, NULL, 'rodriguez.adrienne@spencer.net', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501304, NULL, NULL, NULL, 'kurtis.bartell@streich.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501305, NULL, NULL, NULL, 'brown.viva@vandervort.biz', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501306, NULL, NULL, NULL, 'morissette.harmony@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501307, NULL, NULL, NULL, 'palma.reynolds@yahoo.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501308, NULL, NULL, NULL, 'oren21@wuckert.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501309, NULL, NULL, NULL, 'fhowell@hotmail.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501310, NULL, NULL, NULL, 'willow74@rogahn.info', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501311, NULL, NULL, NULL, 'weimann.giovani@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501312, NULL, NULL, NULL, 'ondricka.silas@hotmail.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501313, NULL, NULL, NULL, 'lenny.stanton@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501314, NULL, NULL, NULL, 'tracy.goyette@carroll.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501315, NULL, NULL, NULL, 'kblanda@schoen.biz', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501316, NULL, NULL, NULL, 'abbott.joana@kuvalis.info', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501317, NULL, NULL, NULL, 'dillan.ullrich@gmail.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501318, NULL, NULL, NULL, 'von.bennie@yahoo.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501319, NULL, NULL, NULL, 'flossie29@zboncak.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501320, NULL, NULL, NULL, 'courtney.nitzsche@williamson.org', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501321, NULL, NULL, NULL, 'noemie.vandervort@yahoo.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501322, NULL, NULL, NULL, 'benjamin.padberg@hotmail.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501323, NULL, NULL, NULL, 'nienow.charlene@huel.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501324, NULL, NULL, NULL, 'annalise32@fahey.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501325, NULL, NULL, NULL, 'bayer.albin@kris.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501326, NULL, NULL, NULL, 'jlueilwitz@swaniawski.biz', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501327, NULL, NULL, NULL, 'kiehn.victoria@hotmail.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501328, NULL, NULL, NULL, 'cassin.velva@torphy.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501329, NULL, NULL, NULL, 'ophelia.cruickshank@towne.info', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501330, NULL, NULL, NULL, 'ellis59@mills.net', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501331, NULL, NULL, NULL, 'davis.ima@mohr.org', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501332, NULL, NULL, NULL, 'larkin.rigoberto@hotmail.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501333, NULL, NULL, NULL, 'mclaughlin.howell@senger.com', NULL, '', 'inactive', '2022-08-20 09:13:26', 301046),
(501334, NULL, NULL, NULL, 'some@gmail.com', NULL, '55074', 'inactive', '2022-08-20 11:27:27', 301043),
(501335, NULL, NULL, NULL, 'some1@gmail.com', NULL, '59687', 'inactive', '2022-08-20 11:27:31', 301043),
(501336, NULL, NULL, NULL, 'some3@gmail.com', NULL, '67483', 'inactive', '2022-08-20 11:27:36', 301043);

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
(501335, 901028, 901040, '2022-08-20', 3),
(501334, 901028, 901040, '2022-08-21', 1),
(501334, 901028, 901040, '2022-08-22', 1),
(501336, 901028, 901040, '2022-08-22', 1);

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
(901041, 'Urdu', 'CSE-5452', '101019', '2022-08-18 16:00:03');

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
(701030, 'waseemjeelani', 'CSE-0001', '1232121232', 1, '100000', '2022-08-15 16:38:55', 101019, 'active'),
(701031, 'hesamakhter', 'CSE-0002', '1232121232', 1, '100000', '2022-08-15 16:39:14', 101019, 'active'),
(701032, 'suhailakhter', 'CSE-0003', '9696857412', 1, '100000', '2022-08-15 16:39:48', 101019, 'active'),
(701033, 'harisqazi', 'CSE-0004', '9696857896', 1, '100000', '2022-08-15 16:40:52', 101019, 'active'),
(701034, 'Khalid_hussain', 'CSE-0005', '7007845621', 1, '100000', '2022-08-15 16:41:54', 101019, 'active'),
(701035, 'SumairaMehraj', 'CSE-C-0006', '7004785161', 2, '100000', '2022-08-15 16:42:41', 101019, 'active'),
(701036, 'YousufMir', 'CSE-C-0007', '7004785161', 2, '100000', '2022-08-15 16:43:06', 101019, 'active'),
(701037, 'darubi', 'emp121', '1234567895', 1, '$2y$10$4PXVlVxVpKQ7wDeJgIYFi.m0/m0KOK4RwoOkXPCCJLEYPGn25Urxu', '2022-08-18 12:29:55', 101013, 'active'),
(701038, 'Hesam_akhter', 'EMP -2015', '1245789865', 1, '$2y$10$tPUC/nrQQo8zBupn/IfKpOL.P04pX0l9uE9gFimPofjwS5kKK1fNW', '2022-08-20 09:09:04', 101019, 'active');

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
  MODIFY `batchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301048;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201044;

--
-- AUTO_INCREMENT for table `coordinator`
--
ALTER TABLE `coordinator`
  MODIFY `coordinatiorid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101020;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semesterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901042;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501337;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901042;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=701039;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
