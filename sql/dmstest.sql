-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2022 at 08:10 PM
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
(901032, 901040, 701031);

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
(301038, 2019, 1, '2022-08-15 15:23:23', 201037, '1'),
(301041, 2024, 0, '2022-08-15 16:02:43', 201038, '0'),
(301042, 2018, 1, '2022-08-15 16:52:32', 201043, '1'),
(301043, 2019, 2, '2022-08-15 18:06:57', 201043, '1'),
(301044, 2020, 1, '2022-08-15 16:52:36', 201043, '1'),
(301045, 2021, 1, '2022-08-15 16:52:44', 201043, '1'),
(301046, 2021, 1, '2022-08-15 16:52:45', 201042, '1');

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
(901034, 1, 301038, '2022-08-15 15:23:23', NULL, '1'),
(901035, 1, 301042, '2022-08-15 16:52:31', NULL, '1'),
(901036, 1, 301043, '2022-08-15 16:52:34', '2022-08-15 18:06:57', '0'),
(901037, 1, 301044, '2022-08-15 16:52:36', NULL, '1'),
(901038, 1, 301045, '2022-08-15 16:52:44', NULL, '1'),
(901039, 1, 301046, '2022-08-15 16:52:45', NULL, '1'),
(901040, 2, 301043, '2022-08-15 18:06:57', NULL, '1');

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
(501065, NULL, NULL, NULL, 'mesh@gmail.com', NULL, '80157', 'inactive', '2022-08-15 16:55:49', 301046),
(501066, NULL, NULL, NULL, 'zamin@gmail.com', NULL, '40124', 'inactive', '2022-08-15 16:55:54', 301046),
(501067, NULL, NULL, NULL, 'ubaid@gmail.com', NULL, '93907', 'inactive', '2022-08-15 16:56:00', 301046),
(501068, NULL, NULL, NULL, 'junaid@gmail.com', NULL, '38303', 'inactive', '2022-08-15 16:56:50', 301042),
(501069, NULL, NULL, NULL, 'aamir@gmail.com', NULL, '13419', 'inactive', '2022-08-15 18:00:50', 301043),
(501070, NULL, NULL, NULL, 'huda@uok.edu', NULL, '73212', 'inactive', '2022-08-15 18:01:03', 301043),
(501071, NULL, NULL, NULL, 'mansha@uok.edu', NULL, '86823', 'inactive', '2022-08-15 18:01:17', 301043),
(501072, NULL, NULL, NULL, 'farhan@uok.edu', NULL, '82119', 'inactive', '2022-08-15 18:01:30', 301043),
(501073, NULL, NULL, NULL, 'rehan@uok.edu', NULL, '99220', 'inactive', '2022-08-15 18:01:50', 301044),
(501074, NULL, NULL, NULL, 'anum@uok.edu', NULL, '58308', 'inactive', '2022-08-15 18:02:01', 301044),
(501075, NULL, NULL, NULL, 'imaz@uok.edu', NULL, '52998', 'inactive', '2022-08-15 18:02:08', 301044),
(501076, NULL, NULL, NULL, 'yusra@uok.edu', NULL, '87714', 'inactive', '2022-08-15 18:02:17', 301044),
(501077, NULL, NULL, NULL, 'aqib@uok.edu', NULL, '73333', 'inactive', '2022-08-15 18:02:24', 301044),
(501078, NULL, NULL, NULL, 'irfan@uok.edu', NULL, '90218', 'inactive', '2022-08-15 18:02:40', 301045),
(501079, NULL, NULL, NULL, 'yasir@uok.edu', NULL, '79856', 'inactive', '2022-08-15 18:02:50', 301045),
(501080, NULL, NULL, NULL, 'junaid@uok.edu', NULL, '41677', 'inactive', '2022-08-15 18:02:56', 301045),
(501081, NULL, NULL, NULL, 'umeer@uok.edu', NULL, '43921', 'inactive', '2022-08-15 18:03:07', 301045);

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
(901040, 'Machine Learning', 'CSE-8866', '101019', '2022-08-15 16:48:34');

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
(701036, 'YousufMir', 'CSE-C-0007', '7004785161', 2, '100000', '2022-08-15 16:43:06', 101019, 'active');

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
  MODIFY `batchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301047;

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
  MODIFY `semesterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901041;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501082;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901041;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=701037;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
