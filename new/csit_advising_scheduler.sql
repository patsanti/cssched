-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 07, 2018 at 01:50 PM
-- Server version: 10.1.34-MariaDB-0ubuntu0.18.04.1
-- PHP Version: 7.2.7-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_join`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(255) NOT NULL,
  `account_usern` varchar(11) NOT NULL,
  `account_pass` varchar(255) NOT NULL,
  `acc_fname` varchar(255) NOT NULL,
  `acc_lname` varchar(255) NOT NULL,
  `acc_type_id` int(255) NOT NULL,
  `acc_status` tinyint(2) NOT NULL COMMENT '0 for inactive; 1 for active; 2 for deactivated'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `acc_type`
--

CREATE TABLE `acc_type` (
  `acc_type_id` int(255) NOT NULL,
  `acc_type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acc_type`
--

INSERT INTO `acc_type` (`acc_type_id`, `acc_type_name`) VALUES
(1, 'Adviser');

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
(1, 'BSCS 1A'),
(2, 'BSCS 1B'),
(3, 'BSCS 4A'),
(4, 'BSCS 4B'),
(5, 'BSIT 1A'),
(6, 'BSIT 1B');

-- --------------------------------------------------------

--
-- Table structure for table `college`
--

CREATE TABLE `college` (
  `college_id` int(255) NOT NULL,
  `college_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `college`
--

INSERT INTO `college` (`college_id`, `college_name`) VALUES
(1, 'BUCS - Bicol University College of Science');

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE `curriculum` (
  `curriculum_id` int(255) NOT NULL,
  `college_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `curriculum`
--

INSERT INTO `curriculum` (`curriculum_id`, `college_name`) VALUES
(1, 'BSCS - Bachelor of Science in Computer Science'),
(2, 'BSIT - Bachelor of Science in Information Technology'),
(3, 'BSBIO - Bachelor of Science in Biology'),
(4, 'BSCHEM - Bachelor of Science in Chemistry'),
(5, 'BSMETEO - Bachelor of Science in Meteorology');

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
(1, 'Laarni', NULL, 'Pancho'),
(2, 'Christian', 'Y.', 'Sy'),
(3, 'Lea', 'P.', 'Austero'),
(4, 'Benedicto', 'B.', 'Balilo'),
(5, 'Rodel', 'N.', 'Naz'),
(6, 'Mary Joy', 'P.', 'Canon'),
(7, 'Noli', 'B.', 'Lucila Jr.'),
(8, 'Rolando', NULL, 'Mendones'),
(9, 'Franklin', NULL, 'Miranda'),
(10, 'Arlene', NULL, 'Satuito');

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
(1, 'B2-101'),
(2, 'B2-105'),
(3, 'B2-201'),
(4, 'B2-205'),
(5, 'B2-206');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sched_no` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `day` varchar(20) NOT NULL,
  `start_time` time(6) NOT NULL,
  `end_time` time(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sched_no`, `subject_id`, `prof_id`, `room_id`, `class_id`, `day`, `start_time`, `end_time`) VALUES
(1, 5, 4, 1, 3, '2', '14:30:00.000000', '16:00:00.000000'),
(2, 5, 4, 1, 3, '4', '14:30:00.000000', '16:00:00.000000'),
(3, 5, 4, 1, 4, '2', '13:00:00.000000', '14:30:00.000000'),
(4, 5, 4, 1, 4, '4', '13:00:00.000000', '14:30:00.000000'),
(5, 2, 6, 4, 5, '2', '13:00:00.000000', '15:00:00.000000'),
(6, 6, 7, 1, 3, '2', '10:30:00.000000', '12:00:00.000000'),
(7, 6, 7, 1, 3, '5', '10:30:00.000000', '12:00:00.000000'),
(8, 2, 7, 4, 6, '5', '13:00:00.000000', '15:00:00.000000'),
(9, 1, 8, 5, 1, '5', '09:00:00.000000', '12:00:00.000000'),
(10, 1, 8, 5, 2, '5', '13:00:00.000000', '00:00:00.000000'),
(11, 7, 9, 3, 4, '2', '10:30:00.000000', '12:00:00.000000'),
(12, 7, 9, 3, 4, '5', '10:30:00.000000', '12:00:00.000000'),
(13, 1, 9, 3, 5, '5', '13:00:00.000000', '16:00:00.000000'),
(14, 1, 9, 3, 6, '2', '13:00:00.000000', '16:00:00.000000'),
(15, 7, 5, 3, 3, '2', '09:00:00.000000', '10:30:00.000000'),
(16, 7, 5, 3, 3, '5', '09:00:00.000000', '10:30:00.000000'),
(17, 2, 10, 5, 1, '2', '10:00:00.000000', '12:00:00.000000'),
(18, 2, 10, 5, 2, '2', '13:00:00.000000', '16:00:00.000000'),
(19, 3, 2, 2, 3, '3', '09:00:00.000000', '12:00:00.000000'),
(20, 3, 2, 2, 4, '3', '13:00:00.000000', '16:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_fname` varchar(256) NOT NULL,
  `student_lname` varchar(256) NOT NULL,
  `student_yrlvl` int(255) NOT NULL,
  `student_pict` varchar(255) NOT NULL,
  `college_id` int(255) NOT NULL,
  `curriculum_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_schlyr`
--

CREATE TABLE `student_schlyr` (
  `student_schlyr_id` int(255) NOT NULL,
  `student_schlyr` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_subject`
--

CREATE TABLE `student_subject` (
  `student_id` int(255) NOT NULL,
  `subject_id` int(255) NOT NULL,
  `subject_grade` int(255) NOT NULL,
  `student_schlyr_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(255) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `subject_description` varchar(255) NOT NULL,
  `lecture_unit` int(255) DEFAULT NULL,
  `lab_unit` int(5) DEFAULT NULL,
  `credit_unit` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`, `subject_description`, `lecture_unit`, `lab_unit`, `credit_unit`) VALUES
(1, 'CS101', 'Introduction to Computing', 3, 0, 3),
(2, 'CS 102', 'Computer Programming 1', 2, 1, 3),
(3, 'CS 28', 'Special Problem 1', 3, 0, 3),
(4, 'CS 29', 'Software Engineering', 3, 0, 3),
(5, 'CS Elec 3', 'CS Elective 3', 3, 0, 3),
(6, 'CS Elec 4', 'CS Elective 4', 3, 0, 3),
(7, 'Free Elec 2', 'Free Elective 2', 3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject_curriculum`
--

CREATE TABLE `subject_curriculum` (
  `subject_id` int(255) NOT NULL,
  `curriculum_id` int(255) NOT NULL,
  `subject_yrlvl` int(255) NOT NULL,
  `subject_semester` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject_preq`
--

CREATE TABLE `subject_preq` (
  `subject_id` int(11) NOT NULL,
  `subject_id_preq` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `acc_type`
--
ALTER TABLE `acc_type`
  ADD PRIMARY KEY (`acc_type_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `college`
--
ALTER TABLE `college`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`curriculum_id`);

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
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sched_no`),
  ADD KEY `sched_course` (`subject_id`),
  ADD KEY `sched_prof` (`prof_id`),
  ADD KEY `sched_room` (`room_id`),
  ADD KEY `sched_class` (`class_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_schlyr`
--
ALTER TABLE `student_schlyr`
  ADD PRIMARY KEY (`student_schlyr_id`);

--
-- Indexes for table `student_subject`
--
ALTER TABLE `student_subject`
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `subject_id` (`subject_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `subject_curriculum`
--
ALTER TABLE `subject_curriculum`
  ADD UNIQUE KEY `subject_id` (`subject_id`),
  ADD UNIQUE KEY `curriculum_id` (`curriculum_id`);

--
-- Indexes for table `subject_preq`
--
ALTER TABLE `subject_preq`
  ADD UNIQUE KEY `subject_id_preq` (`subject_id_preq`),
  ADD UNIQUE KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `acc_type`
--
ALTER TABLE `acc_type`
  MODIFY `acc_type_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `college`
--
ALTER TABLE `college`
  MODIFY `college_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `curriculum_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `prof_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `student_schlyr`
--
ALTER TABLE `student_schlyr`
  MODIFY `student_schlyr_id` int(255) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `sched_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sched_course` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sched_prof` FOREIGN KEY (`prof_id`) REFERENCES `professor` (`prof_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sched_room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
