-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 11, 2018 at 07:18 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs_classsched`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_day`
--

CREATE TABLE IF NOT EXISTS `class_day` (
  `no` int(11) NOT NULL,
  `day` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_day`
--

INSERT INTO `class_day` (`no`, `day`) VALUES
(5, 'F'),
(1, 'M'),
(2, 'T'),
(4, 'Th'),
(3, 'W');

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE IF NOT EXISTS `professor` (
  `prof_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`prof_name`) VALUES
('Austero, L.'),
('Balilo, B.'),
('Balmadrid, D.'),
('Canon, M.J.'),
('Lucila, N.'),
('Mendones, R.'),
('Miranda, F.'),
('Naz, R.'),
('Pancho, L.'),
('Satuito, A.'),
('Sy, C.');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `room` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room`) VALUES
('B2-101'),
('B2-102'),
('B2-105'),
('B2-201'),
('B2-205'),
('B2-206');

-- --------------------------------------------------------

--
-- Table structure for table `sched`
--

CREATE TABLE IF NOT EXISTS `sched` (
  `sched_no` int(11) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `prof_name` varchar(50) NOT NULL,
  `class` varchar(20) NOT NULL,
  `day` varchar(10) NOT NULL,
  `room` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sched`
--

INSERT INTO `sched` (`sched_no`, `course_code`, `start_time`, `end_time`, `prof_name`, `class`, `day`, `room`) VALUES
(1, 'CS Elec 3', '13:00:00', '14:30:00', 'Balilo, B.', 'BSCS 4B', '2', 'B2-101'),
(2, 'CS Elec 3', '13:00:00', '14:30:00', 'Balilo, B.', 'BSCS 4B', '4', 'B2-101'),
(3, 'CS Elec 3', '14:30:00', '16:00:00', 'Balilo, B.', 'BSCS 4A', '2', 'B2-101'),
(4, 'CS Elec 3', '14:30:00', '16:00:00', 'Balilo, B.', 'BSCS 4A', '4', 'B2-101'),
(5, 'CS 102', '13:00:00', '15:00:00', 'Canon, M.J.', 'BSIT 1A', '2', 'B2-205'),
(6, 'CS Elec 4', '10:30:00', '12:00:00', 'Lucila, N.', 'BSCS 4A', '2', 'B2-101'),
(7, 'CS Elec 4', '10:30:00', '12:00:00', 'Lucila, N.', 'BSCS 4A', '5', 'B2-101'),
(8, 'CS 102', '13:00:00', '15:00:00', 'Lucila, N.', 'BSIT 1B', '5', 'B2-205'),
(9, 'CS 101', '09:00:00', '12:00:00', 'Mendones, R.', 'BSCS 1A', '5', 'B2-206'),
(10, 'CS 101', '13:00:00', '16:00:00', 'Mendones, R.', 'BSCS 1B', '5', 'B2-206'),
(11, 'Free Elec 2', '10:30:00', '12:00:00', 'Miranda, F.', 'BSCS 4B', '2', 'B2-201'),
(12, 'Free Elec 2', '10:30:00', '12:00:00', 'Miranda, F.', 'BSCS 4B', '5', 'B2-201'),
(13, 'CS 101', '13:00:00', '16:00:00', 'Miranda, F.', 'BSIT 1B', '2', 'B2-201'),
(14, 'CS 101', '13:00:00', '16:00:00', 'Miranda, F.', 'BSIT 1A', '5', 'B2-201'),
(15, 'Free Elec 2', '09:00:00', '10:30:00', 'Naz, R.', 'BSCS 4A', '2', 'B2-201'),
(16, 'Free Elec 2', '09:00:00', '10:30:00', 'Naz, R.', 'BSCS 4A', '5', 'B2-201'),
(17, 'CS 102', '10:00:00', '12:00:00', 'Satuito, A.', 'BSCS 1A', '2', 'B2-206'),
(18, 'CS 102', '13:00:00', '16:00:00', 'Satuito, A.', 'BSCS 1B', '2', 'B2-206'),
(19, 'CS 28', '09:00:00', '12:00:00', 'Sy, C.', 'BSCS 4A', '3', 'B2-105'),
(20, 'CS 28', '13:00:00', '16:00:00', 'Sy, C.', 'BSCS 4B', '3', 'B2-105'),
(21, '', '00:00:00', '00:00:00', '', '', '', ''),
(22, '', '00:00:00', '00:00:00', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `course_code` varchar(20) NOT NULL,
  `desc_title` varchar(50) NOT NULL,
  `lec_unit` int(5) NOT NULL,
  `lab_unit` int(5) NOT NULL,
  `cred_units` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`course_code`, `desc_title`, `lec_unit`, `lab_unit`, `cred_units`) VALUES
('CS 101', 'Introduction to Computing', 3, 0, 3),
('CS 102', 'Computer Programming 1', 2, 1, 3),
('CS 28', 'Special Problem 1', 3, 0, 3),
('CS 29', 'Software Engineering', 3, 0, 3),
('CS Elec 3', 'CS Elective 3', 3, 0, 3),
('CS Elec 4', 'CS Elective 3', 3, 0, 3),
('Free Elec 2', 'Free Elective 2', 3, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_day`
--
ALTER TABLE `class_day`
  ADD PRIMARY KEY (`day`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`prof_name`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room`);

--
-- Indexes for table `sched`
--
ALTER TABLE `sched`
  ADD PRIMARY KEY (`sched_no`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`course_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sched`
--
ALTER TABLE `sched`
  MODIFY `sched_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
