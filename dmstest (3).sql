-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2022 at 01:48 PM
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
(901050, 901054, 701052, '0', 'active'),
(901054, 901054, 701054, '0', 'disabled'),
(901053, 901054, 701054, '0', 'active'),
(901054, 901054, 701053, '0', 'active');

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
(301059, 2018, 1, '2022-09-10 08:22:29', 201058, '1'),
(301061, 2019, 2, '2022-09-10 11:11:19', 201058, '1'),
(301062, 2020, 0, '2022-09-10 11:30:24', 201058, '0'),
(301063, 2018, 0, '2022-09-10 11:31:21', 201060, '0');

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
(201060, 'BTECH CSE', '8', '2022-09-10 11:31:11.000000', 101024);

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
  `teacherid` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lectureplan`
--

INSERT INTO `lectureplan` (`semesterid`, `subjectid`, `lecturedate`, `lecturehour`, `lecturetopic`, `creationtime`, `timeslotstart`, `timeslotend`, `teacherid`) VALUES
(901054, 901053, '2022-09-10', 1, 'INTRODUCTION TO DATABASE LAB', '2022-09-10', '10:30', '11:30', 701054),
(901054, 901054, '2022-09-10', 2, 'INTRODUCTION TO MATH', '2022-09-10', '11:30', '13:30', 701054);

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
(901054, 1, 301059, '2022-09-10 08:22:29', NULL, '1'),
(901055, 1, 301061, '2022-09-10 11:11:06', '2022-09-10 11:11:19', '0'),
(901056, 2, 301061, '2022-09-10 11:11:19', NULL, '1');

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
(502321, NULL, NULL, NULL, 'darubaidnazir@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502322, NULL, NULL, NULL, 'zamin@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502323, NULL, NULL, NULL, 'areeba@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502324, NULL, NULL, NULL, 'mesh@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502325, NULL, NULL, NULL, 'exam@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502326, NULL, NULL, NULL, 'masma@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502327, NULL, NULL, NULL, 'mamsa@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502328, NULL, NULL, NULL, 'mamaa@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502329, NULL, NULL, NULL, 'massma@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502330, NULL, NULL, NULL, 'mamaaaa@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502331, NULL, NULL, NULL, 'mamaee@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502332, NULL, NULL, NULL, 'mafffma@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502333, NULL, NULL, NULL, 'mfffama@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502334, NULL, NULL, NULL, 'mwwama@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502335, NULL, NULL, NULL, 'a122@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502336, NULL, NULL, NULL, 'shanie61@hotmail.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502337, NULL, NULL, NULL, 'keshaun40@green.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502338, NULL, NULL, NULL, 'jkris@batz.com', NULL, '', 'inactive', '2022-09-10 08:40:24', 301059),
(502339, NULL, NULL, NULL, 'bokuneva@kreiger.org', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502340, NULL, NULL, NULL, 'semard@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502341, NULL, NULL, NULL, 'rhills@krajcik.info', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502342, NULL, NULL, NULL, 'yfadel@hotmail.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502343, NULL, NULL, NULL, 'trevion.little@stokes.net', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502344, NULL, NULL, NULL, 'hershel.lebsack@yahoo.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502345, NULL, NULL, NULL, 'durward40@hegmann.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502346, NULL, NULL, NULL, 'smayert@yahoo.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502347, NULL, NULL, NULL, 'amari.torp@kuvalis.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502348, NULL, NULL, NULL, 'xswift@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502349, NULL, NULL, NULL, 'carter.ines@hotmail.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502350, NULL, NULL, NULL, 'walton.rodriguez@heathcote.net', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502351, NULL, NULL, NULL, 'trey.rowe@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502352, NULL, NULL, NULL, 'harmony02@yahoo.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502353, NULL, NULL, NULL, 'peter18@yahoo.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502354, NULL, NULL, NULL, 'pansy.corkery@weissnat.org', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502355, NULL, NULL, NULL, 'npowlowski@torp.biz', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502356, NULL, NULL, NULL, 'stefan31@smitham.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502357, NULL, NULL, NULL, 'beaulah.roberts@yahoo.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502358, NULL, NULL, NULL, 'shania.leannon@hodkiewicz.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502359, NULL, NULL, NULL, 'sporer.zack@feest.org', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502360, NULL, NULL, NULL, 'drussel@gleichner.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502361, NULL, NULL, NULL, 'bergnaum.genoveva@hotmail.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502362, NULL, NULL, NULL, 'mary14@stracke.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502363, NULL, NULL, NULL, 'esmeralda.reichel@wilkinson.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502364, NULL, NULL, NULL, 'hyatt.lois@hotmail.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502365, NULL, NULL, NULL, 'rodriguez.adrienne@spencer.net', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502366, NULL, NULL, NULL, 'kurtis.bartell@streich.com', NULL, '', 'inactive', '2022-09-10 08:40:25', 301059),
(502367, NULL, NULL, NULL, 'brown.viva@vandervort.biz', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502368, NULL, NULL, NULL, 'morissette.harmony@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502369, NULL, NULL, NULL, 'palma.reynolds@yahoo.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502370, NULL, NULL, NULL, 'oren21@wuckert.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502371, NULL, NULL, NULL, 'fhowell@hotmail.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502372, NULL, NULL, NULL, 'willow74@rogahn.info', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502373, NULL, NULL, NULL, 'weimann.giovani@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502374, NULL, NULL, NULL, 'ondricka.silas@hotmail.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502375, NULL, NULL, NULL, 'lenny.stanton@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502376, NULL, NULL, NULL, 'tracy.goyette@carroll.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502377, NULL, NULL, NULL, 'kblanda@schoen.biz', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502378, NULL, NULL, NULL, 'abbott.joana@kuvalis.info', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502379, NULL, NULL, NULL, 'dillan.ullrich@gmail.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502380, NULL, NULL, NULL, 'von.bennie@yahoo.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502381, NULL, NULL, NULL, 'flossie29@zboncak.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502382, NULL, NULL, NULL, 'courtney.nitzsche@williamson.org', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502383, NULL, NULL, NULL, 'noemie.vandervort@yahoo.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502384, NULL, NULL, NULL, 'benjamin.padberg@hotmail.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502385, NULL, NULL, NULL, 'nienow.charlene@huel.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502386, NULL, NULL, NULL, 'annalise32@fahey.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502387, NULL, NULL, NULL, 'bayer.albin@kris.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502388, NULL, NULL, NULL, 'jlueilwitz@swaniawski.biz', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502389, NULL, NULL, NULL, 'kiehn.victoria@hotmail.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502390, NULL, NULL, NULL, 'cassin.velva@torphy.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502391, NULL, NULL, NULL, 'ophelia.cruickshank@towne.info', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502392, NULL, NULL, NULL, 'ellis59@mills.net', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502393, NULL, NULL, NULL, 'davis.ima@mohr.org', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502394, NULL, NULL, NULL, 'larkin.rigoberto@hotmail.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502395, NULL, NULL, NULL, 'mclaughlin.howell@senger.com', NULL, '', 'inactive', '2022-09-10 08:40:26', 301059),
(502396, NULL, NULL, NULL, 'umeer@uok.edu', NULL, '73783', 'inactive', '2022-09-10 11:28:45', 301061);

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
(502346, 901053, 901054, '2022-09-10', 1),
(502358, 901053, 901054, '2022-09-10', 1),
(502372, 901053, 901054, '2022-09-10', 1),
(502373, 901053, 901054, '2022-09-10', 1),
(502384, 901053, 901054, '2022-09-10', 1),
(502324, 901054, 901054, '2022-09-10', 2),
(502326, 901054, 901054, '2022-09-10', 2),
(502332, 901054, 901054, '2022-09-10', 2),
(502350, 901054, 901054, '2022-09-10', 2),
(502352, 901054, 901054, '2022-09-10', 2),
(502358, 901054, 901054, '2022-09-10', 2),
(502359, 901054, 901054, '2022-09-10', 2),
(502376, 901054, 901054, '2022-09-10', 2),
(502385, 901054, 901054, '2022-09-10', 2),
(502321, 901053, 901054, '2022-09-10', 1);

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
(901054, 'MATH', 'CSE 1232', '101024', '2022-09-10 08:09:01', 'T');

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
-- Dumping data for table `updateattendance`
--

INSERT INTO `updateattendance` (`studentid`, `semesterid`, `subjectid`, `message`, `action`, `time`, `updatedate`, `updatedby`) VALUES
(502321, 901054, 901053, 'Cricket match', 1, '2022-09-10 09:07:20', '2022-09-10', 0),
(502321, 901054, 901053, 'Mistake ', 0, '2022-09-10 09:07:54', '2022-09-10', 0);

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
  MODIFY `batchid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301064;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201061;

--
-- AUTO_INCREMENT for table `coordinator`
--
ALTER TABLE `coordinator`
  MODIFY `coordinatiorid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101025;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `semesterid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901057;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=502397;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subjectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=901055;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacherid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=701055;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
