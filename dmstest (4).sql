-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2022 at 11:08 AM
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
(901050, 901059, 701054, '0', 'active'),
(901052, 901059, 701054, '0', 'active'),
(901053, 901059, 701054, '0', 'active'),
(901057, 901059, 701054, '0', 'active'),
(901060, 901059, 701054, '0', 'active');

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
(301064, 2019, 1, '2022-09-17 15:08:02', 201061, '1');

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
(201058, 'MTECH CSE', '4', '2022-09-10 08:21:39.000000', 101024),
(201061, 'BTech CSE', '8', '2022-09-17 15:07:30.000000', 101024);

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
(101024, 'Khalid Hussain', 'khalid@gmail.com', '7894561232', 'CSE', '$2y$10$Uu8e3brSNKSKUSnDv3omLudinAHJMF6gHjlyNPbLTtw6yB1a0M0ba', '2022-09-10 08:06:14');

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
(901059, 901060, '2022-09-18', 1, 'Lb', '2022-09-18', '10:30', '11:30', 701054, 'G1'),
(901059, 901052, '2022-09-18', 2, 'dsnjsd', '2022-09-18', '12:00', '14:00', 701054, 'BOTH');

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
(901054, 1, 301059, '2022-09-10 08:22:29', '2022-09-13 13:50:55', '0'),
(901055, 1, 301061, '2022-09-10 11:11:06', '2022-09-10 11:11:19', '0'),
(901056, 2, 301061, '2022-09-10 11:11:19', NULL, '1'),
(901057, 2, 301059, '2022-09-13 13:50:55', '2022-09-13 13:50:58', '0'),
(901058, 3, 301059, '2022-09-13 13:50:58', '2022-09-13 13:51:02', '0'),
(901059, 4, 301059, '2022-09-13 13:51:02', NULL, '1'),
(901060, 1, 301064, '2022-09-17 15:08:02', NULL, '1');

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
(502399, NULL, NULL, NULL, '01@gmil.com', NULL, '80937', 'inactive', '2022-09-18 06:42:54', 301059, 'G1'),
(502400, NULL, NULL, NULL, '02@gmil.com', NULL, '10841', 'inactive', '2022-09-18 06:43:00', 301059, 'G1'),
(502401, NULL, NULL, NULL, '03@gmil.com', NULL, '36344', 'inactive', '2022-09-18 06:43:05', 301059, 'G2'),
(502402, NULL, NULL, NULL, '04@gmil.com', NULL, '82517', 'inactive', '2022-09-18 06:43:12', 301059, 'G2');

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
(502399, 901060, 901059, '2022-09-18', 1),
(502401, 901052, 901059, '2022-09-18', 2);

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
(901050, 'AI', 'CSE 1231', '101024', '2022-09-10 08:07:33', 'T'),
(901052, 'Database', 'CSE 7895', '101024', '2022-09-10 08:08:08', 'T'),
(901053, 'Database-Lab', 'CSE 1231L', '101024', '2022-09-10 08:08:30', 'L'),
(901054, 'MATH', 'CSE 1232', '101024', '2022-09-10 08:09:01', 'T'),
(901055, 'C plus plus', 'CSE-5452', '101024', '2022-09-15 14:42:28', 'T'),
(901056, 'Uudu', 'CSE 7896', '101024', '2022-09-15 14:42:45', 'T'),
(901057, 'Micoprocesser', 'ff', '101024', '2022-09-15 14:42:53', 'T'),
(901059, 'AI', 'CSE 1231a', '101024', '2022-09-15 14:43:21', 'L'),
(901060, 'COJSBN', 'CSE 1231saa', '101024', '2022-09-15 14:43:29', 'L');

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
(701052, 'Khalid_Hussain', 'CSE 502', '1231231232', 1, '$2y$10$BACrQBo5wt8Sd52OzY5TBudoTOJgKRv9NLEUHVV4h5BFmgu6TrM1m', '2022-09-10 08:09:39', 101024, 'active'),
(701053, 'Hesam_akhter', 'emp121', '1212121212', 2, '$2y$10$TOXrbQiWmUs0GPmpbRXWsum7asA6ST/6OsuLu8uw4UY8rogFqzlza', '2022-09-10 08:09:59', 101024, 'active'),
(701054, 'Waseem_Bakshi', 'EMP -2015', '1245456987', 1, '$2y$10$9PxOtnr3kzjwwqjuNHa3Bu9panuusgFhaGyBGFWrTiLV5T/Sii4xq', '2022-09-10 08:10:26', 101024, 'active');

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
('10:00', '16:00', 101024, 3);

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
  MODIFY `batchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301065;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201062;

--
-- AUTO_INCREMENT for table `coordinator`
--
ALTER TABLE `coordinator`
  MODIFY `coordinatiorid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101025;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semesterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901061;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502403;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901061;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=701055;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
