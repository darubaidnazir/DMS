-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2022 at 01:18 PM
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
  `branchid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `batch`
--

INSERT INTO `batch` (`batchid`, `batchyear`, `currentsemester`, `creationdate`, `branchid`) VALUES
(301010, 2018, 1, '2022-08-11 09:19:31', 201017),
(301016, 2019, 0, '2022-08-12 09:31:43', 201020);

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
(201017, 'Mtech', '4', '2022-08-11 09:18:22.000000', 101013),
(201020, 'hdbhd', '5', '2022-08-11 13:56:08.000000', 101013),
(201022, 'MTech CSE', '4', '2022-08-11 14:30:52.000000', 101018);

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
(101000, 'Khalid Hussain ', 'khalidhussain@gmail.com', '9696859585', 'Computer Science ', '123456789', '2022-08-09 10:19:35'),
(101011, 'zamin', 'zamin@gmail.com', '9622922604', 'cse', '$2y$10$qpmRgV8bJkny.qmjhVroC.ATAq7WuG7nAlXacAivltVYPi2ltEuPC', '2022-08-10 05:17:10'),
(101012, 'areeba', 'areeba@gmail.com', '9622922604', 'cse', '$2y$10$4u.frJ.uM9U4Ih9ZY/wB3O2MpViNRP1iLwPn45N5YeAwaITQwlKM2', '2022-08-10 05:19:01'),
(101013, 'darubaidnazir786', 'darubaidnazir786@gmail.com', '9622922604', 'cse', '$2y$10$XK6aHSh/55oW9Ox/M7SNrusuJgOJxQUe3uI/xAhRylP5vycjnHVya', '2022-08-10 05:20:59'),
(101014, 'darubaidnazir786', 'darubaidazir786@gmail.com', '9622922604', 'cse', '$2y$10$Qeur0USM1W4.y/nx4vj2ruIcnt1DNQXvVDTjIxUpTTeeRbLkKta.q', '2022-08-10 05:28:12'),
(101015, 'darubaidna', 'daruidnazir786@gmail.com', '9622922604', 'cse', '$2y$10$MXazMlHDP9moCCBaXxlkmOAbIEzxU1GZU3h1wd.7ess1yT61UnHfS', '2022-08-10 09:29:53'),
(101016, 'zamin ahmad', 'zaminahmad2614@gmail.com', '9622922604', 'Btech', '$2y$10$iZbpCSqyIV8UdwpYw9Oa4uULy6xp7wXh1qF76QEVLqkaoRfBKEmUW', '2022-08-10 12:21:25'),
(101017, 'dad', 'dasf@gmail.com', '1235458595', 'cse', '$2y$10$zDdpHIFRwddhZSkJOihbM.4E/4gwpKuLU8wfnNtI/yv2wq3M.R/oW', '2022-08-11 14:26:07'),
(101018, 'Hesham Akhter', 'hesham@gmail.com', '9622655422', 'Computer Science', '$2y$10$a1/7WOktpid9.8nRW8tFVOpaQh7SLiemgjRruWQrqNuJxfQnc/2RS', '2022-08-11 14:28:47');

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
(501000, 'Some', 'd', NULL, 's', NULL, '', 'inactive', '2022-08-12 05:20:40', 0),
(501001, NULL, NULL, NULL, 'gtt@gmail.com', NULL, '56975', 'inactive', '2022-08-12 06:46:36', 301010),
(501002, NULL, NULL, NULL, 'dar@gmail.com', NULL, '84067', 'inactive', '2022-08-12 06:51:46', 301010),
(501003, NULL, NULL, NULL, 'dasr@gmail.com', NULL, '61348', 'inactive', '2022-08-12 06:52:19', 301010),
(501004, NULL, NULL, NULL, 'areeba@gmail.com', NULL, '37375', 'inactive', '2022-08-12 09:32:14', 301016),
(501005, NULL, NULL, NULL, 'mesh@gmail.com', NULL, '77510', 'inactive', '2022-08-12 09:32:25', 301016),
(501006, NULL, NULL, NULL, 'gttee@gmail.com', NULL, '22240', 'inactive', '2022-08-12 10:42:54', 301010),
(501007, NULL, NULL, NULL, 'gtteeee@gmail.com', NULL, '86725', 'inactive', '2022-08-12 10:42:58', 301010),
(501008, NULL, NULL, NULL, 'gtteeeeee@gmail.com', NULL, '10837', 'inactive', '2022-08-12 10:43:03', 301010),
(501009, NULL, NULL, NULL, 'gtteeeeeeeee@gmail.com', NULL, '56862', 'inactive', '2022-08-12 10:43:06', 301010),
(501010, NULL, NULL, NULL, 'gtteeeeeeeeeee@gmail.com', NULL, '81120', 'inactive', '2022-08-12 10:43:10', 301010),
(501011, NULL, NULL, NULL, 'gtteeeeeeeeeeeeee@gmail.com', NULL, '82673', 'inactive', '2022-08-12 10:43:14', 301010),
(501012, NULL, NULL, NULL, 'gfftt@gmail.com', NULL, '95383', 'inactive', '2022-08-12 11:09:38', 301010),
(501013, NULL, NULL, NULL, 'gfftffft@gmail.com', NULL, '45062', 'inactive', '2022-08-12 11:09:43', 301010),
(501014, NULL, NULL, NULL, 'gfffffftffft@gmail.com', NULL, '80358', 'inactive', '2022-08-12 11:09:47', 301010),
(501015, NULL, NULL, NULL, 'fff@gmail.com', NULL, '10747', 'inactive', '2022-08-12 11:09:52', 301010),
(501016, NULL, NULL, NULL, 'ffffff@gmail.com', NULL, '37993', 'inactive', '2022-08-12 11:09:57', 301010),
(501017, NULL, NULL, NULL, 'fffffffff@gmail.com', NULL, '85308', 'inactive', '2022-08-12 11:10:02', 301010),
(501018, NULL, NULL, NULL, 'fffffffffffff@gmail.com', NULL, '32981', 'inactive', '2022-08-12 11:10:07', 301010),
(501019, NULL, NULL, NULL, 'fffffffffffffffff@gmail.com', NULL, '21120', 'inactive', '2022-08-12 11:10:12', 301010);

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
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `batchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301017;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201024;

--
-- AUTO_INCREMENT for table `coordinator`
--
ALTER TABLE `coordinator`
  MODIFY `coordinatiorid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101019;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=501020;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
