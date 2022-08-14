-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2022 at 07:17 AM
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
(301025, 2022, 4, '2022-08-14 04:48:37', 201027, '0'),
(301026, 2019, 4, '2022-08-14 05:15:33', 201027, '0'),
(301027, 2020, 1, '2022-08-14 05:15:49', 201027, '1'),
(301028, 2020, 2, '2022-08-14 04:57:42', 201028, '1'),
(301029, 2023, 1, '2022-08-14 05:16:57', 201028, '1');

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
(201027, 'Mtech', '4', '2022-08-14 04:40:24.000000', 101013),
(201028, 'Btech', '3', '2022-08-14 04:50:48.000000', 101013);

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
(101013, 'darubaidnazir786', 'darubaidnazir786@gmail.com', '9622922604', 'cse', '$2y$10$XK6aHSh/55oW9Ox/M7SNrusuJgOJxQUe3uI/xAhRylP5vycjnHVya', '2022-08-10 05:20:59');

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
(901016, 1, 301025, '2022-08-14 04:43:07', '2022-08-14 04:43:52', '0'),
(901017, 2, 301025, '2022-08-14 04:43:52', '2022-08-14 04:47:55', '0'),
(901018, 3, 301025, '2022-08-14 04:47:55', '2022-08-14 04:48:18', '0'),
(901019, 4, 301025, '2022-08-14 04:48:18', '2022-08-14 04:48:36', '0'),
(901020, 1, 301028, '2022-08-14 04:51:29', '2022-08-14 04:57:42', '0'),
(901021, 2, 301028, '2022-08-14 04:57:42', NULL, '1'),
(901022, 1, 301026, '2022-08-14 04:58:05', '2022-08-14 05:13:29', '0'),
(901023, 2, 301026, '2022-08-14 05:13:29', '2022-08-14 05:14:56', '0'),
(901024, 3, 301026, '2022-08-14 05:14:56', '2022-08-14 05:15:09', '0'),
(901025, 4, 301026, '2022-08-14 05:15:09', '2022-08-14 05:15:33', '0'),
(901026, 1, 301027, '2022-08-14 05:15:49', NULL, '1'),
(901027, 1, 301029, '2022-08-14 05:16:57', NULL, '1');

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
  `coordinatorid` int(100) NOT NULL
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
  MODIFY `batchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301030;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201029;

--
-- AUTO_INCREMENT for table `coordinator`
--
ALTER TABLE `coordinator`
  MODIFY `coordinatiorid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101019;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semesterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901028;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501048;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901012;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=701011;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
