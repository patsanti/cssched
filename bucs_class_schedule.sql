-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2018 at 05:08 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bucs_class_schedule`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `class_yr_blk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_yr_blk`) VALUES
(1, 'BSCS 4A');

-- --------------------------------------------------------

--
-- Table structure for table `class_day`
--

CREATE TABLE `class_day` (
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
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `course_code` varchar(225) NOT NULL,
  `course_title` varchar(225) NOT NULL,
  `lecture_unit` int(2) NOT NULL,
  `lab_unit` int(2) NOT NULL,
  `credit_unit` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='contains information about offered courses';

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_code`, `course_title`, `lecture_unit`, `lab_unit`, `credit_unit`) VALUES
(1, 'CS Elec 4', 'CS Elective 3', 3, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `prof_id` int(11) NOT NULL,
  `prof_fname` varchar(50) NOT NULL,
  `prof_mname` varchar(2) DEFAULT NULL,
  `prof_lname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`prof_id`, `prof_fname`, `prof_mname`, `prof_lname`) VALUES
(1, 'Laarni', NULL, 'Pancho');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`) VALUES
(1, 'B2-101');

-- --------------------------------------------------------

--
-- Table structure for table `sched`
--

CREATE TABLE `sched` (
  `sched_no` int(11) NOT NULL,
  `course_code` varchar(20) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `prof_name` varchar(50) NOT NULL,
  `class` varchar(20) NOT NULL,
  `day` varchar(10) NOT NULL,
  `room` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sched_no` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `start_time` time(6) NOT NULL,
  `end_time` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
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
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_day`
--
ALTER TABLE `class_day`
  ADD PRIMARY KEY (`day`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`prof_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `sched`
--
ALTER TABLE `sched`
  ADD PRIMARY KEY (`sched_no`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sched_no`),
  ADD KEY `sched_course` (`course_id`),
  ADD KEY `sched_prof` (`prof_id`),
  ADD KEY `sched_room` (`room_id`),
  ADD KEY `sched_class` (`class_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`course_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `prof_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sched`
--
ALTER TABLE `sched`
  MODIFY `sched_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_no` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `sched_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sched_course` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sched_prof` FOREIGN KEY (`prof_id`) REFERENCES `professor` (`prof_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sched_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
