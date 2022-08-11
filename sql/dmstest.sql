-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2022 at 06:31 PM
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
(301013, 2020, 0, '2022-08-11 10:53:01', 201017);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batch`
--
ALTER TABLE `batch`
  MODIFY `batchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301016;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
