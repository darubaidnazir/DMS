-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2022 at 06:01 PM
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
  `updatepermission` varchar(100) NOT NULL DEFAULT '0',
  `assignedstatus` varchar(10) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignedsubject`
--

INSERT INTO `assignedsubject` (`subjectid`, `semesterid`, `teacherid`, `updatepermission`, `assignedstatus`) VALUES
(901061, 901061, 701055, '0', 'active'),
(901062, 901061, 701058, '0', 'active'),
(901063, 901061, 701056, '0', 'active'),
(901064, 901061, 701057, '0', 'active'),
(901065, 901061, 701059, '0', 'active'),
(901066, 901062, 701060, '0', 'active'),
(901067, 901062, 701060, '0', 'active'),
(901068, 901064, 701061, '0', 'active'),
(901070, 901084, 701063, '0', 'active'),
(901070, 901073, 701063, '0', 'active'),
(901072, 901073, 701064, '0', 'active'),
(901075, 901073, 701065, '0', 'active'),
(901076, 901073, 701066, '0', 'active'),
(901074, 901073, 701063, '0', 'active'),
(901061, 901065, 701055, '0', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `assignedsyllabus`
--

CREATE TABLE `assignedsyllabus` (
  `syllabusid` int(100) NOT NULL,
  `batchid` int(100) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `subjectid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assignedsyllabus`
--

INSERT INTO `assignedsyllabus` (`syllabusid`, `batchid`, `creationdate`, `subjectid`) VALUES
(18, 301077, '2022-12-08 04:01:40', 901070),
(21, 301076, '2022-12-08 05:35:26', 901061),
(29, 301076, '2022-12-08 05:37:08', 901064);

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
(301059, 2018, 4, '2022-09-13 13:51:02', 201058, '1'),
(301061, 2019, 2, '2022-09-10 11:11:19', 201058, '1'),
(301064, 2019, 1, '2022-09-17 15:08:02', 201061, '1'),
(301065, 2018, 4, '2022-12-07 14:31:06', 201062, '0'),
(301066, 2020, 1, '2022-09-22 16:56:36', 201063, '1'),
(301067, 2021, 1, '2022-09-22 17:16:29', 201063, '1'),
(301073, 2018, 1, '2022-09-24 12:48:51', 201065, '1'),
(301076, 2019, 1, '2022-09-30 10:14:48', 201062, '1'),
(301077, 2018, 8, '2022-11-23 15:04:01', 201067, '1'),
(301078, 2019, 6, '2022-11-23 15:04:29', 201067, '1'),
(301079, 2020, 3, '2022-11-23 15:04:38', 201067, '1'),
(301080, 2017, 1, '2022-11-23 15:04:41', 201067, '1'),
(301081, 2021, 1, '2022-11-23 15:04:55', 201066, '1');

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
(201062, 'Mtech', '4', '2022-09-18 16:35:01.000000', 101025),
(201063, 'MTech CSE', '4', '2022-09-22 16:56:23.000000', 101026),
(201065, 'MTech CSE', '4', '2022-09-24 12:28:22.000000', 101027),
(201066, 'MTech. CSE', '4', '2022-11-23 15:02:31.000000', 101028),
(201067, 'BTech CSE', '8', '2022-11-23 15:02:44.000000', 101028);

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
(101025, 'Khalid Hussain', 'khalid.hussain@uok.edu.in', '9622655422', 'Computer Science and Engineering', '$2y$10$KVFVX2Kbu2esjFUutpArN.bLjzLQcWpkCoKpBajNwg8dUfMzObjjG', '2022-09-18 16:34:07'),
(101026, 'Admin', 'admin@gmail.com', '9622922604', 'Computer Science', '$2y$10$jPXn6z8hlE8W.FtyhzzkNet3kRkNDOMhGkk1kO6Hg5haO/SRraMDS', '2022-09-22 16:55:53'),
(101027, 'admin', 'admin@admin.com', '9622922604', 'CSE', '$2y$10$HYDNyexqgBtAF.at7/DI4OlfBp/0T6Ylw16eT5NoqpcZKKJjczBXS', '2022-09-24 12:25:47'),
(101028, 'Khalid Hussain', 'khalidhussain@uok.com', '9622858595', 'Computer Science', '$2y$10$w//xN0YSjLpOJGBbJcJLyejdhZUCI2JRuq.bFloPdPSMOG.VIVs/i', '2022-11-23 15:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `extraattendance`
--

CREATE TABLE `extraattendance` (
  `studentid` int(100) NOT NULL,
  `semesterid` int(100) NOT NULL,
  `percentage` int(100) NOT NULL,
  `remark` varchar(100) NOT NULL,
  `currentdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `extraattendance`
--

INSERT INTO `extraattendance` (`studentid`, `semesterid`, `percentage`, `remark`, `currentdate`) VALUES
(502403, 901061, 50, 'jj', '2022-10-02 04:26:07');

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
  `timeslotend` varchar(100) NOT NULL,
  `teacherid` int(100) NOT NULL,
  `groups` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lectureplan`
--

INSERT INTO `lectureplan` (`semesterid`, `subjectid`, `lecturedate`, `lecturehour`, `lecturetopic`, `creationtime`, `timeslotstart`, `timeslotend`, `teacherid`, `groups`) VALUES
(901061, 901061, '2022-09-18', 1, 'INTRODUCTION', '2022-09-18', '10:30', '11:30', 701055, 'BOTH'),
(901061, 901063, '2022-09-18', 1, 'INTRODUCTION', '2022-09-18', '11:30', '12:30', 701056, 'BOTH'),
(901061, 901064, '2022-09-18', 2, 'INTRODUCTION TO PROGRMMING', '2022-09-18', '14:00', '16:00', 701057, 'G1'),
(901061, 901061, '2022-09-20', 1, '1', '2022-09-20', '10:30', '11:30', 701055, 'BOTH'),
(901061, 901064, '2022-09-20', 1, '2', '2022-09-20', '12:30', '13:30', 701057, 'G1'),
(901062, 901066, '2022-09-21', 2, 'ji', '2022-09-22', '10:30', '12:30', 701060, 'BOTH'),
(901061, 901061, '2022-09-24', 1, 'ssss', '2022-09-24', '10:05', '11:05', 701055, 'BOTH'),
(901084, 901070, '2022-11-23', 1, 'mdsnkfgkj', '2022-11-23', '09:40', '10:40', 701063, 'BOTH');

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
(901061, 1, 301065, '2022-09-18 16:40:27', '2022-12-07 14:30:55', '0'),
(901062, 1, 301066, '2022-09-22 16:56:36', NULL, '1'),
(901063, 1, 301067, '2022-09-22 17:16:28', NULL, '1'),
(901064, 1, 301073, '2022-09-24 12:48:51', NULL, '1'),
(901065, 1, 301076, '2022-09-30 10:14:48', NULL, '1'),
(901066, 1, 301077, '2022-11-23 15:03:37', '2022-11-23 15:03:40', '0'),
(901067, 2, 301077, '2022-11-23 15:03:40', '2022-11-23 15:03:43', '0'),
(901068, 3, 301077, '2022-11-23 15:03:43', '2022-11-23 15:03:46', '0'),
(901069, 4, 301077, '2022-11-23 15:03:46', '2022-11-23 15:03:49', '0'),
(901070, 5, 301077, '2022-11-23 15:03:50', '2022-11-23 15:03:53', '0'),
(901071, 6, 301077, '2022-11-23 15:03:53', '2022-11-23 15:03:57', '0'),
(901072, 7, 301077, '2022-11-23 15:03:57', '2022-11-23 15:04:01', '0'),
(901073, 8, 301077, '2022-11-23 15:04:01', NULL, '1'),
(901074, 1, 301078, '2022-11-23 15:04:07', '2022-11-23 15:04:09', '0'),
(901075, 2, 301078, '2022-11-23 15:04:09', '2022-11-23 15:04:12', '0'),
(901076, 3, 301078, '2022-11-23 15:04:12', '2022-11-23 15:04:16', '0'),
(901077, 4, 301078, '2022-11-23 15:04:16', '2022-11-23 15:04:26', '0'),
(901078, 5, 301078, '2022-11-23 15:04:26', '2022-11-23 15:04:29', '0'),
(901079, 6, 301078, '2022-11-23 15:04:29', NULL, '1'),
(901080, 1, 301079, '2022-11-23 15:04:32', '2022-11-23 15:04:35', '0'),
(901081, 2, 301079, '2022-11-23 15:04:35', '2022-11-23 15:04:38', '0'),
(901082, 3, 301079, '2022-11-23 15:04:38', NULL, '1'),
(901083, 1, 301080, '2022-11-23 15:04:41', NULL, '1'),
(901084, 1, 301081, '2022-11-23 15:04:55', NULL, '1'),
(901085, 2, 301065, '2022-12-07 14:30:55', '2022-12-07 14:30:59', '0'),
(901086, 3, 301065, '2022-12-07 14:30:59', '2022-12-07 14:31:02', '0'),
(901087, 4, 301065, '2022-12-07 14:31:02', '2022-12-07 14:31:06', '0');

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
  `batchid` int(11) NOT NULL,
  `group_id` varchar(10) NOT NULL DEFAULT 'NA'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `studentname`, `studentregno`, `studentrollno`, `studentemail`, `studentdob`, `studentpassword`, `studentstatus`, `creationtime`, `batchid`, `group_id`) VALUES
(502403, 'zamin ahmad dar', NULL, '18048112002', 'zaminahmaddar@gmail.com', NULL, '54522', 'active', '2022-09-18 16:37:44', 301065, 'G1'),
(502404, 'darubi', NULL, '18048112009', 'darubaidnazir@gmail.com', NULL, '$2y$10$GG9eojd14GsKHtSP3CFJH.YfsPcr.nH9g1mqe2YB30cEcnGn8a0LK', 'active', '2022-09-18 16:37:59', 301065, 'G1'),
(502405, NULL, NULL, '18048112015', 'mehwish@gmail.com', NULL, '28169', 'inactive', '2022-09-18 16:38:10', 301065, 'G2'),
(502406, NULL, NULL, '18048112017', 'farhan@gmail.com', NULL, '43965', 'inactive', '2022-09-18 16:38:20', 301065, 'G1'),
(502407, NULL, NULL, '18048112031', 'nadiya@gmail.com', NULL, '34265', 'inactive', '2022-09-18 16:38:31', 301065, 'G2'),
(502408, NULL, NULL, '18048112061', 'areeba@gmail.com', NULL, '48922', 'inactive', '2022-09-18 16:38:48', 301065, 'G1'),
(502409, NULL, NULL, NULL, '01@gmail.com', NULL, '24133', 'inactive', '2022-09-22 16:58:43', 301066, 'G1'),
(502410, NULL, NULL, NULL, '02@gmail.com', NULL, '14844', 'inactive', '2022-09-22 16:58:50', 301066, 'G1'),
(502411, NULL, NULL, NULL, '03@gmail.com', NULL, '42300', 'inactive', '2022-09-22 16:58:55', 301066, 'G2'),
(502412, NULL, NULL, NULL, '04@gmail.com', NULL, '12372', 'inactive', '2022-09-22 16:59:04', 301066, 'G2'),
(502413, NULL, NULL, '18048112001', 'umeer@uok.edu', NULL, '88519', 'inactive', '2022-09-24 05:59:39', 301065, 'G1'),
(502414, NULL, NULL, NULL, 'gtt@gmail.com', NULL, '12369', 'inactive', '2022-09-24 06:01:33', 301065, 'G2'),
(502415, NULL, NULL, NULL, 'umesser@uok.edu', NULL, '68047', 'inactive', '2022-09-24 12:58:50', 301073, 'NA'),
(502416, NULL, NULL, '18048112009', 'darubaidnazi786@gmail.com', NULL, '92506', 'inactive', '2022-11-23 15:05:54', 301077, 'NA'),
(502417, NULL, NULL, '18048112002', 'zaminahmaddar1@gmail.com', NULL, '61020', 'inactive', '2022-11-23 15:06:15', 301077, 'NA'),
(502418, NULL, NULL, '18048112004', 'parvaizahmad@gmail.com', NULL, '70775', 'inactive', '2022-11-23 15:06:31', 301077, 'NA'),
(502419, NULL, NULL, '18048112006', 'imaz@gmail.com', NULL, '63164', 'inactive', '2022-11-23 15:06:47', 301077, 'NA'),
(502420, NULL, NULL, '18048112008', 'anam@gmail.com', NULL, '57745', 'inactive', '2022-11-23 15:07:00', 301077, 'NA'),
(502421, NULL, NULL, '18048112015', 'mesh@gmail.com', NULL, '59818', 'inactive', '2022-11-23 15:07:18', 301077, 'NA'),
(502422, NULL, NULL, '18048112017', 'farhan1@gmail.com', NULL, '12479', 'inactive', '2022-11-23 15:07:32', 301077, 'NA'),
(502423, NULL, NULL, '18048112018', 'Zubair@gmail.com', NULL, '44152', 'inactive', '2022-11-23 15:07:43', 301077, 'NA'),
(502424, NULL, NULL, '18048112030', 'Nadiya2@gmail.com', NULL, '50666', 'inactive', '2022-11-23 15:08:34', 301077, 'NA'),
(502425, NULL, NULL, '18048112051', 'huda@gmail.com', NULL, '37846', 'inactive', '2022-11-23 15:09:00', 301077, 'NA'),
(502426, NULL, NULL, '18048112061', 'areeba2@gmail.com', NULL, '82969', 'inactive', '2022-11-23 15:09:19', 301077, 'NA'),
(502427, NULL, NULL, '21048122001', 'Mehak@gmail.com', NULL, '20943', 'inactive', '2022-11-23 15:10:05', 301081, 'NA'),
(502428, NULL, NULL, '21048122002', 'Uzam@uok.edu', NULL, '53186', 'inactive', '2022-11-23 15:10:14', 301081, 'NA'),
(502429, NULL, NULL, '21048122003', 'Kamran@gmail.com', NULL, '$2y$10$xXnA7QxWxtMcN34G5Qdeb.qJzvqddKd7WD8ADyPYTSmtgSJto1bne', 'active', '2022-11-23 15:10:23', 301081, 'NA'),
(502430, NULL, NULL, '21048122004', 'Maniya@gmail.com', NULL, '54791', 'inactive', '2022-11-23 15:10:31', 301081, 'NA'),
(502431, NULL, NULL, '21048122005', 'Shahid@rediffmail.com', NULL, '48235', 'inactive', '2022-11-23 15:10:56', 301081, 'NA');

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
(502403, 901061, 901061, '2022-09-18', 1),
(502406, 901063, 901061, '2022-09-18', 1),
(502404, 901064, 901061, '2022-09-18', 2),
(502408, 901061, 901061, '2022-09-20', 1),
(502407, 901061, 901061, '2022-09-24', 1),
(502429, 901070, 901084, '2022-11-23', 1),
(502430, 901070, 901084, '2022-11-23', 1),
(502427, 901070, 901084, '2022-11-23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subjectid` int(11) NOT NULL,
  `subjectname` varchar(100) NOT NULL,
  `subjectcode` varchar(100) NOT NULL,
  `coordinatorid` varchar(100) NOT NULL,
  `creationtime` timestamp NOT NULL DEFAULT current_timestamp(),
  `subjectlevel` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subjectid`, `subjectname`, `subjectcode`, `coordinatorid`, `creationtime`, `subjectlevel`) VALUES
(901061, 'Machine Learning', 'CSE-8866', '101025', '2022-09-18 16:35:43', 'T'),
(901062, 'Database Management System', 'CSE-1718', '101025', '2022-09-18 16:35:52', 'T'),
(901063, 'Compiler Design', 'CSE-1918', '101025', '2022-09-18 16:35:59', 'T'),
(901064, 'C Plus Plus Lab', 'CSE-1718L', '101025', '2022-09-18 16:36:14', 'L'),
(901065, 'Computer Graphics', 'CSE-8888L', '101025', '2022-09-18 16:36:37', 'L'),
(901066, 'Compiler design', 'CSE 1231', '101026', '2022-09-22 16:57:32', 'T'),
(901067, 'DataBase Lab', 'CSE 1231L', '101026', '2022-09-22 16:58:07', 'L'),
(901068, 'Micoprocesser', 'CSE 1231', '101027', '2022-09-24 12:48:45', 'T'),
(901069, 'C plus plus', 'CSE-5452', '101027', '2022-09-24 12:49:21', 'T'),
(901070, 'DataBase System', 'CSE-5452', '101028', '2022-11-23 15:18:49', 'T'),
(901071, 'Micoprocesser', 'CSE 1232', '101028', '2022-11-23 15:35:51', 'T'),
(901072, 'Micoprocesser Lab', 'CSE 1221', '101028', '2022-11-23 15:36:04', 'L'),
(901073, 'Database System Lab', 'CSE 1231L', '101028', '2022-11-23 15:36:36', 'L'),
(901074, 'C plus plus', 'CSE 1244', '101028', '2022-11-23 15:36:48', 'T'),
(901075, 'Artificial Intelligence', 'CSE 7895', '101028', '2022-11-23 15:37:41', 'T'),
(901076, 'Java Programming', 'CSE 3535', '101028', '2022-11-23 15:38:06', 'T'),
(901077, 'Java Programming Lab', 'CSE-5452L', '101028', '2022-11-23 15:38:21', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `syllabus`
--

CREATE TABLE `syllabus` (
  `syllabusid` int(100) NOT NULL,
  `subjectid` int(100) NOT NULL,
  `syllabusdetails` varchar(1000) NOT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `syllabus`
--

INSERT INTO `syllabus` (`syllabusid`, `subjectid`, `syllabusdetails`, `creationdate`) VALUES
(18, 901070, 'INtr0duction', '2022-12-08 03:57:41'),
(19, 901070, 'ML', '2022-12-08 03:57:49'),
(20, 901070, 'DL', '2022-12-08 03:57:53'),
(21, 901061, 'gdfdhfbdhjbgfjhbdjhbgfhjbdshbjdhbgjhdbfhjgbjhdbfgjhbdhjfbgjhbdfghbdjhfbgjhbdfjghbjdfh\njfjadgjhdhjfg\njnfjdsngjndsf\ngdjfn', '2022-12-08 05:32:51'),
(22, 901061, 'gdfdhfbdhjbgfjhbdjhbgfhjbdshbjdhbgjhdbfhjgbjhdbfgjhbdhjfbgjhbdfghbdjhfbgjhbdfjghbjdfh\njfjadgjhdhjfg\njnfjdsngjndsf\ngdjfn', '2022-12-08 05:32:54'),
(23, 901061, 'gdfdhfbdhjbgfjhbdjhbgfhjbdshbjdhbgjhdbfhjgbjhdbfgjhbdhjfbgjhbdfghbdjhfbgjhbdfjghbjdfh\njfjadgjhdhjfg\njnfjdsngjndsf\ngdjfn', '2022-12-08 05:32:56'),
(24, 901061, 'gdfdhfbdhjbgfjhbdjhbgfhjbdshbjdhbgjhdbfhjgbjhdbfgjhbdhjfbgjhbdfghbdjhfbgjhbdfjghbjdfh\njfjadgjhdhjfg\njnfjdsngjndsf\ngdjfn', '2022-12-08 05:32:57'),
(25, 901061, 'gfdngkjnjdkfnkjdnfjkndfjgnkdjfngjksdfjbnjkdsn\ngjnvsakkjjkgkjdnbkjnakjgnjkvnka dv\nkv  skv jkzd bkjvz', '2022-12-08 05:33:57'),
(26, 901061, 'gfdngkjnjdkfnkjdnfjkndfjgnkdjfngjksdfjbnjkdsn\ngjnvsakkjjkgkjdnbkjnakjgnjkvnka dv\nkv  skv jkzd bkjvz', '2022-12-08 05:34:02'),
(27, 901061, 'ndvkjndjkfvndjkfbvndfbjnvdjnvjdfnvjdf\nsfdjnnfkjnsvjksnvkjnsjnv\njsdnv', '2022-12-08 05:34:35'),
(28, 901064, '1', '2022-12-08 05:36:38'),
(29, 901064, '2', '2022-12-08 05:36:42');

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
(701055, 'Khalid_hussain', 'CSE-0003', '1234567898', 1, '$2y$10$soEHD/u8OdMZ7g51CbP2IuMZ.I5MAkqK4GWxszwEu1F2J6xf5dzbO', '2022-09-18 16:37:10', 101025, 'active'),
(701056, 'harisqazi', 'CSE-0005', '7845968574', 1, '$2y$10$ljRMTnIdlGAPgYiCuiyYd.fYIKOS0iz4BYyZTifrFDlzJxyLQL8ZC', '2022-09-18 16:41:05', 101025, 'active'),
(701057, 'SumairaMehraj', 'CSE-0004', '9865232598', 2, '$2y$10$4.MbA0sF7OyA0U.PHwH0FuaQm1.hoG621xvgewrV5gE/bg16b9F3.', '2022-09-18 16:41:20', 101025, 'active'),
(701058, 'YousufMir', 'CSE-C-0007', '7539517485', 2, '$2y$10$kiG5kfNXLXsOpg5F4W8zy.IkQkcYffeUqEiaRxUNwdB9kGcUnMqhG', '2022-09-18 16:41:33', 101025, 'active'),
(701059, 'Waseem', 'CSE-0004', '7845968574', 1, '$2y$10$SwVLgfjDzPG6G9.tmbZNEepyP/4c.Bm8VESY6yUg1.N4GSeFdbS/m', '2022-09-18 16:42:25', 101025, 'active'),
(701060, 'Hesam_akhter', 'EMP -2015', '7845965412', 1, '$2y$10$FS/gvpfJDGyQi4UUtpg9Se75RE5VVJ4AyUPLgVV3y3lR7NooH02jm', '2022-09-22 16:58:24', 101026, 'active'),
(701061, 'Hesam_akhter_', 'EMP -2015', '1254789685', 2, '$2y$10$Xq3cWVbbte21FnD2ElFu/eInF.qInlBXj9M.cY3pNXPgIdYjyp4oS', '2022-09-24 12:48:31', 101027, 'active'),
(701062, 'Khalid_Hussainww', 'CSE 502', '4556789852', 1, '$2y$10$ZVgkeBmaz.N1167U6ys7neFHJDTqI7cdXw8XSqzAaMFHmWTq4NiTC', '2022-09-24 12:49:46', 101027, 'active'),
(701063, 'Hesam_akhter_uok', 'EMP -2010', '7898748595', 1, '$2y$10$FQfA51v/E6x/sI0TJiYSW.s/Jd3WbKdLRQEUI9nxsBzNEB4I2dkuy', '2022-11-23 15:15:43', 101028, 'active'),
(701064, 'Waseem_Bakshi_uok', 'CSE 502', '9585741526', 1, '$2y$10$35uuSOQcLJg6GqNfVZJS/OJmxhNiAl7VCK91cq4Ir8fht6U99m/C.', '2022-11-23 15:15:59', 101028, 'active'),
(701065, 'Khalid_Hussain_uok', 'emp121', '7815236954', 1, '$2y$10$4dQK6Di8SkJMqXvZoMKsD.TZjm9BB.ekjJLs39TxRcxKv5iL.zdS2', '2022-11-23 15:16:22', 101028, 'active'),
(701066, 'Umer_uok', 'EMP -2015', '8792485855', 2, '$2y$10$NW0GCB35IyUSp/UH1TvGsuPRfFnbIFCWwF9s.YMspeZG7VHARkGuW', '2022-11-23 15:17:23', 101028, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `start` varchar(10) NOT NULL,
  `end` varchar(10) NOT NULL,
  `coordinatorid` int(100) NOT NULL,
  `updateattendance` int(10) NOT NULL DEFAULT 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`start`, `end`, `coordinatorid`, `updateattendance`) VALUES
('10:00', '17:00', 101025, 3),
('10:00', '16:00', 101026, 3),
('09:00', '13:55', 101028, 3);

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
  `updatedate` varchar(100) NOT NULL,
  `updatedby` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `updateattendance`
--

INSERT INTO `updateattendance` (`studentid`, `semesterid`, `subjectid`, `message`, `action`, `time`, `updatedate`, `updatedby`) VALUES
(502427, 901084, 901070, 'mmdm', 0, '2022-11-23 15:24:28', '2022-11-23', 1);

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
-- Indexes for table `syllabus`
--
ALTER TABLE `syllabus`
  ADD PRIMARY KEY (`syllabusid`);

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
  MODIFY `batchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301082;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201068;

--
-- AUTO_INCREMENT for table `coordinator`
--
ALTER TABLE `coordinator`
  MODIFY `coordinatiorid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101029;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semesterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901088;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502432;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901078;

--
-- AUTO_INCREMENT for table `syllabus`
--
ALTER TABLE `syllabus`
  MODIFY `syllabusid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=701067;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
