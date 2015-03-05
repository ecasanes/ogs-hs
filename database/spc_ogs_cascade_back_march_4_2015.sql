-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2015 at 01:50 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spc_ogs_cascade`
--
CREATE DATABASE IF NOT EXISTS `spc_ogs_cascade` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `spc_ogs_cascade`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assignment`
--

CREATE TABLE IF NOT EXISTS `tbl_assignment` (
  `AID` int(11) NOT NULL AUTO_INCREMENT,
  `a_item` int(11) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `atag` int(11) DEFAULT NULL,
  `subj_offerid` int(11) DEFAULT NULL,
  PRIMARY KEY (`AID`),
  KEY `tbl_subj_offering_tbl_assignment` (`subj_offerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `tbl_assignment`
--

INSERT INTO `tbl_assignment` (`AID`, `a_item`, `term`, `atag`, `subj_offerid`) VALUES
(1, 0, 1, 1, 1),
(2, 0, 1, 2, 1),
(3, 0, 1, 3, 1),
(4, 0, 1, 4, 1),
(5, 0, 1, 5, 1),
(6, 0, 2, 1, 1),
(7, 0, 2, 2, 1),
(8, 0, 2, 3, 1),
(9, 0, 2, 4, 1),
(10, 0, 2, 5, 1),
(11, 0, 3, 1, 1),
(12, 0, 3, 2, 1),
(13, 0, 3, 3, 1),
(14, 0, 3, 4, 1),
(15, 0, 3, 5, 1),
(16, 0, 4, 1, 1),
(17, 0, 4, 2, 1),
(18, 0, 4, 3, 1),
(19, 0, 4, 4, 1),
(20, 0, 4, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enroll_student`
--

CREATE TABLE IF NOT EXISTS `tbl_enroll_student` (
  `offer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `tbl_grade_section_tbl_enroll_student` (`offer_id`),
  KEY `tbl_user_tbl_enroll_student` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_enroll_student`
--

INSERT INTO `tbl_enroll_student` (`offer_id`, `user_id`) VALUES
(6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam`
--

CREATE TABLE IF NOT EXISTS `tbl_exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_item` int(11) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `etag` int(11) DEFAULT NULL,
  `subj_offerid` int(11) DEFAULT NULL,
  PRIMARY KEY (`exam_id`),
  KEY `tbl_subj_offering_tbl_exam` (`subj_offerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_exam`
--

INSERT INTO `tbl_exam` (`exam_id`, `e_item`, `term`, `etag`, `subj_offerid`) VALUES
(1, 0, 1, 1, 1),
(2, 0, 2, 2, 1),
(3, 0, 3, 3, 1),
(4, 0, 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_column`
--

CREATE TABLE IF NOT EXISTS `tbl_grade_column` (
  `QC` int(10) DEFAULT NULL,
  `RC` int(10) DEFAULT NULL,
  `AC` int(10) DEFAULT NULL,
  `PC` int(10) DEFAULT NULL,
  `Term` int(11) DEFAULT NULL,
  `subj_offerid` int(11) DEFAULT NULL,
  KEY `tbl_subj_offering_tbl_grade_column` (`subj_offerid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grade_column`
--

INSERT INTO `tbl_grade_column` (`QC`, `RC`, `AC`, `PC`, `Term`, `subj_offerid`) VALUES
(6, 4, 5, 2, 1, 1),
(6, 4, 5, 2, 2, 1),
(6, 4, 5, 2, 3, 1),
(6, 4, 5, 2, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_level`
--

CREATE TABLE IF NOT EXISTS `tbl_grade_level` (
  `gl_id` int(11) NOT NULL AUTO_INCREMENT,
  `sy_start` int(5) DEFAULT NULL,
  `sy_end` int(5) DEFAULT NULL,
  `grade_level` int(2) DEFAULT NULL,
  PRIMARY KEY (`gl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_grade_level`
--

INSERT INTO `tbl_grade_level` (`gl_id`, `sy_start`, `sy_end`, `grade_level`) VALUES
(1, 2019, 2020, 1),
(2, 2019, 2020, 2),
(3, 2019, 2020, 3),
(9, 2019, 2020, 4),
(14, 2015, 2016, 1),
(15, 2015, 2016, 2),
(16, 2015, 2016, 3),
(17, 2015, 2016, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_section`
--

CREATE TABLE IF NOT EXISTS `tbl_grade_section` (
  `offer_id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(50) DEFAULT NULL,
  `gl_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`offer_id`),
  KEY `tbl_grade_level_tbl_grade_section` (`gl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_grade_section`
--

INSERT INTO `tbl_grade_section` (`offer_id`, `section`, `gl_id`) VALUES
(1, 'Section 1', 1),
(2, 'Section 2', 2),
(3, 'Section 2', 3),
(4, 'Section 2', 1),
(5, 'Section 3', 2),
(6, 'Mabuti', 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_subj`
--

CREATE TABLE IF NOT EXISTS `tbl_grade_subj` (
  `subj_id` int(11) DEFAULT NULL,
  `gl_id` int(11) DEFAULT NULL,
  KEY `tbl_subject_tbl_grade_subj` (`subj_id`),
  KEY `tbl_grade_level_tbl_grade_subj` (`gl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grade_subj`
--

INSERT INTO `tbl_grade_subj` (`subj_id`, `gl_id`) VALUES
(1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_system`
--

CREATE TABLE IF NOT EXISTS `tbl_grade_system` (
  `QW` int(11) DEFAULT NULL,
  `RW` int(11) DEFAULT NULL,
  `AW` int(11) DEFAULT NULL,
  `PW` int(11) DEFAULT NULL,
  `EW` int(11) DEFAULT NULL,
  `Term` int(11) DEFAULT NULL,
  `subj_offerid` int(11) DEFAULT NULL,
  KEY `tbl_subj_offering_tbl_grade_system` (`subj_offerid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grade_system`
--

INSERT INTO `tbl_grade_system` (`QW`, `RW`, `AW`, `PW`, `EW`, `Term`, `subj_offerid`) VALUES
(NULL, NULL, NULL, NULL, NULL, 1, 1),
(NULL, NULL, NULL, NULL, NULL, 2, 1),
(NULL, NULL, NULL, NULL, NULL, 3, 1),
(NULL, NULL, NULL, NULL, NULL, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE IF NOT EXISTS `tbl_project` (
  `PID` int(11) NOT NULL AUTO_INCREMENT,
  `p_item` int(11) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `ptag` int(11) DEFAULT NULL,
  `subj_offerid` int(11) DEFAULT NULL,
  PRIMARY KEY (`PID`),
  KEY `tbl_subj_offering_tbl_project` (`subj_offerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_project`
--

INSERT INTO `tbl_project` (`PID`, `p_item`, `term`, `ptag`, `subj_offerid`) VALUES
(1, 0, 1, 1, 1),
(2, 0, 1, 2, 1),
(3, 0, 2, 1, 1),
(4, 0, 2, 2, 1),
(5, 0, 3, 1, 1),
(6, 0, 3, 2, 1),
(7, 0, 4, 1, 1),
(8, 0, 4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz`
--

CREATE TABLE IF NOT EXISTS `tbl_quiz` (
  `QID` int(11) NOT NULL AUTO_INCREMENT,
  `q_item` int(11) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `qtag` int(11) DEFAULT NULL,
  `subj_offerid` int(11) DEFAULT NULL,
  PRIMARY KEY (`QID`),
  KEY `tbl_subj_offering_tbl_quiz` (`subj_offerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_quiz`
--

INSERT INTO `tbl_quiz` (`QID`, `q_item`, `term`, `qtag`, `subj_offerid`) VALUES
(1, 1, 1, 1, 1),
(2, 0, 1, 2, 1),
(3, 0, 1, 3, 1),
(4, 0, 1, 4, 1),
(5, 0, 1, 5, 1),
(6, 0, 1, 6, 1),
(7, 0, 2, 1, 1),
(8, 0, 2, 2, 1),
(9, 0, 2, 3, 1),
(10, 0, 2, 4, 1),
(11, 0, 2, 5, 1),
(12, 0, 2, 6, 1),
(13, 0, 3, 1, 1),
(14, 0, 3, 2, 1),
(15, 0, 3, 3, 1),
(16, 0, 3, 4, 1),
(17, 0, 3, 5, 1),
(18, 0, 3, 6, 1),
(19, 0, 4, 1, 1),
(20, 0, 4, 2, 1),
(21, 0, 4, 3, 1),
(22, 0, 4, 4, 1),
(23, 0, 4, 5, 1),
(24, 0, 4, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recitation`
--

CREATE TABLE IF NOT EXISTS `tbl_recitation` (
  `RID` int(11) NOT NULL AUTO_INCREMENT,
  `r_item` int(11) DEFAULT NULL,
  `term` int(11) DEFAULT NULL,
  `rtag` int(11) DEFAULT NULL,
  `subj_offerid` int(11) DEFAULT NULL,
  PRIMARY KEY (`RID`),
  KEY `tbl_subj_offering_tbl_recitation` (`subj_offerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_recitation`
--

INSERT INTO `tbl_recitation` (`RID`, `r_item`, `term`, `rtag`, `subj_offerid`) VALUES
(1, 0, 1, 1, 1),
(2, 0, 1, 2, 1),
(3, 0, 1, 3, 1),
(4, 0, 1, 4, 1),
(5, 0, 2, 1, 1),
(6, 0, 2, 2, 1),
(7, 0, 2, 3, 1),
(8, 0, 2, 4, 1),
(9, 0, 3, 1, 1),
(10, 0, 3, 2, 1),
(11, 0, 3, 3, 1),
(12, 0, 3, 4, 1),
(13, 0, 4, 1, 1),
(14, 0, 4, 2, 1),
(15, 0, 4, 3, 1),
(16, 0, 4, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_assignment`
--

CREATE TABLE IF NOT EXISTS `tbl_student_assignment` (
  `ascore` int(11) NOT NULL,
  `AID` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `tbl_assignment_tbl_student_assignment` (`AID`),
  KEY `tbl_user_tbl_student_assignment` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student_assignment`
--

INSERT INTO `tbl_student_assignment` (`ascore`, `AID`, `user_id`) VALUES
(0, 1, 5),
(0, 2, 5),
(0, 3, 5),
(0, 4, 5),
(0, 5, 5),
(0, 6, 5),
(0, 7, 5),
(0, 8, 5),
(0, 9, 5),
(0, 10, 5),
(0, 11, 5),
(0, 12, 5),
(0, 13, 5),
(0, 14, 5),
(0, 15, 5),
(0, 16, 5),
(0, 17, 5),
(0, 18, 5),
(0, 19, 5),
(0, 20, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_exam`
--

CREATE TABLE IF NOT EXISTS `tbl_student_exam` (
  `escore` int(11) DEFAULT NULL,
  `exam_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `tbl_exam_tbl_student_exam` (`exam_id`),
  KEY `tbl_user_tbl_student_exam` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student_exam`
--

INSERT INTO `tbl_student_exam` (`escore`, `exam_id`, `user_id`) VALUES
(NULL, 1, 5),
(NULL, 2, 5),
(NULL, 3, 5),
(NULL, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_project`
--

CREATE TABLE IF NOT EXISTS `tbl_student_project` (
  `pscore` int(11) DEFAULT NULL,
  `PID` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `tbl_project_tbl_student_project` (`PID`),
  KEY `tbl_user_tbl_student_project` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student_project`
--

INSERT INTO `tbl_student_project` (`pscore`, `PID`, `user_id`) VALUES
(NULL, 1, 5),
(NULL, 2, 5),
(NULL, 3, 5),
(NULL, 4, 5),
(NULL, 5, 5),
(NULL, 6, 5),
(NULL, 7, 5),
(NULL, 8, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_quiz`
--

CREATE TABLE IF NOT EXISTS `tbl_student_quiz` (
  `qscore` int(11) DEFAULT NULL,
  `QID` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `tbl_quiz_tbl_student_quiz` (`QID`),
  KEY `tbl_user_tbl_student_quiz` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student_quiz`
--

INSERT INTO `tbl_student_quiz` (`qscore`, `QID`, `user_id`) VALUES
(1, 1, 5),
(NULL, 2, 5),
(NULL, 3, 5),
(NULL, 4, 5),
(NULL, 5, 5),
(NULL, 6, 5),
(NULL, 7, 5),
(NULL, 8, 5),
(NULL, 9, 5),
(NULL, 10, 5),
(NULL, 11, 5),
(NULL, 12, 5),
(NULL, 13, 5),
(NULL, 14, 5),
(NULL, 15, 5),
(NULL, 16, 5),
(NULL, 17, 5),
(NULL, 18, 5),
(NULL, 19, 5),
(NULL, 20, 5),
(NULL, 21, 5),
(NULL, 22, 5),
(NULL, 23, 5),
(NULL, 24, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_recitation`
--

CREATE TABLE IF NOT EXISTS `tbl_student_recitation` (
  `rscore` int(11) DEFAULT NULL,
  `RID` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `tbl_recitation_tbl_student_recitation` (`RID`),
  KEY `tbl_user_tbl_student_recitation` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student_recitation`
--

INSERT INTO `tbl_student_recitation` (`rscore`, `RID`, `user_id`) VALUES
(NULL, 1, 5),
(NULL, 2, 5),
(NULL, 3, 5),
(NULL, 4, 5),
(NULL, 5, 5),
(NULL, 6, 5),
(NULL, 7, 5),
(NULL, 8, 5),
(NULL, 9, 5),
(NULL, 10, 5),
(NULL, 11, 5),
(NULL, 12, 5),
(NULL, 13, 5),
(NULL, 14, 5),
(NULL, 15, 5),
(NULL, 16, 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE IF NOT EXISTS `tbl_subject` (
  `subj_id` int(11) NOT NULL AUTO_INCREMENT,
  `subj_code` varchar(40) DEFAULT NULL,
  `subj_desc` varchar(40) DEFAULT NULL,
  `subj_unit` int(5) DEFAULT NULL,
  PRIMARY KEY (`subj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`subj_id`, `subj_code`, `subj_desc`, `subj_unit`) VALUES
(1, 'CSC101', 'Computer Science 1', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subj_offering`
--

CREATE TABLE IF NOT EXISTS `tbl_subj_offering` (
  `subj_offerid` int(11) NOT NULL AUTO_INCREMENT,
  `offer_id` int(11) DEFAULT NULL,
  `subj_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`subj_offerid`),
  KEY `tbl_grade_section_tbl_subj_offering` (`offer_id`),
  KEY `tbl_subject_tbl_subj_offering` (`subj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_subj_offering`
--

INSERT INTO `tbl_subj_offering` (`subj_offerid`, `offer_id`, `subj_id`) VALUES
(1, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher_subj`
--

CREATE TABLE IF NOT EXISTS `tbl_teacher_subj` (
  `subj_offerid` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  KEY `tbl_subj_offering_tbl_teacher_subj` (`subj_offerid`),
  KEY `tbl_user_tbl_teacher_subj` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teacher_subj`
--

INSERT INTO `tbl_teacher_subj` (`subj_offerid`, `user_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `age` int(5) DEFAULT NULL,
  `gender` varchar(7) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `year_level` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `user_type`, `fname`, `mname`, `lname`, `age`, `gender`, `address`) VALUES
(1, 'ernest.casanes', '63f69f3c6ea97828332ce9bf86616069', 1, 'Admin 1', 'Cilocilo', 'Casanes', 24, 'male', 'Del Carmen, Iligan City'),
(2, 'ecasanes', '63f69f3c6ea97828332ce9bf86616069', 2, 'Instructor 1', 'Casanes', 'Lastname', 24, 'male', 'test'),
(3, 'ecasanes2', 'bc65f426282a1a198804b1d7602b25d4', 2, 'Instructor 2', 'Test', 'Lastname', 24, 'male', 'test'),
(4, 'abcd', '187ef4436122d1cc2f40dc2b92f0eba0', 2, 'Instructor 3', 'Hello', 'Lastname', 24, 'male', 'sfsf'),
(5, 'student', '63f69f3c6ea97828332ce9bf86616069', 3, 'Student 1', 'Casanes', 'Lastname', 13, 'male', 'sfsf'),
(6, 'student1', '5e5545d38a68148a2d5bd5ec9a89e327', 3, 'Student 1', '', 'Test', 13, 'male', 'dfsfd'),
(7, 'student2', '213ee683360d88249109c2f92789dbc3', 3, 'Student 2', '', 'Test', 12, 'male', 'lskjfsldfkj'),
(8, 'student3', '8e4947690532bc44a8e41e9fb365b76a', 3, 'Student 3', '', 'Test', 14, 'male', 'kljsdfljsdf'),
(9, 'student4', '166a50c910e390d922db4696e4c7747b', 3, 'Student 4', '', 'Test', 15, 'male', 'dsfsdf');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_assignment`
--
ALTER TABLE `tbl_assignment`
  ADD CONSTRAINT `tbl_subj_offering_tbl_assignment` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_enroll_student`
--
ALTER TABLE `tbl_enroll_student`
  ADD CONSTRAINT `tbl_user_tbl_enroll_student` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_grade_section_tbl_enroll_student` FOREIGN KEY (`offer_id`) REFERENCES `tbl_grade_section` (`offer_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  ADD CONSTRAINT `tbl_subj_offering_tbl_exam` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_grade_column`
--
ALTER TABLE `tbl_grade_column`
  ADD CONSTRAINT `tbl_subj_offering_tbl_grade_column` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_grade_section`
--
ALTER TABLE `tbl_grade_section`
  ADD CONSTRAINT `tbl_grade_level_tbl_grade_section` FOREIGN KEY (`gl_id`) REFERENCES `tbl_grade_level` (`gl_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_grade_subj`
--
ALTER TABLE `tbl_grade_subj`
  ADD CONSTRAINT `tbl_grade_level_tbl_grade_subj` FOREIGN KEY (`gl_id`) REFERENCES `tbl_grade_level` (`gl_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_subject_tbl_grade_subj` FOREIGN KEY (`subj_id`) REFERENCES `tbl_subject` (`subj_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_grade_system`
--
ALTER TABLE `tbl_grade_system`
  ADD CONSTRAINT `tbl_subj_offering_tbl_grade_system` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD CONSTRAINT `tbl_subj_offering_tbl_project` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  ADD CONSTRAINT `tbl_subj_offering_tbl_quiz` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_recitation`
--
ALTER TABLE `tbl_recitation`
  ADD CONSTRAINT `tbl_subj_offering_tbl_recitation` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_student_assignment`
--
ALTER TABLE `tbl_student_assignment`
  ADD CONSTRAINT `tbl_user_tbl_student_assignment` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_assignment_tbl_student_assignment` FOREIGN KEY (`AID`) REFERENCES `tbl_assignment` (`AID`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_student_exam`
--
ALTER TABLE `tbl_student_exam`
  ADD CONSTRAINT `tbl_user_tbl_student_exam` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_exam_tbl_student_exam` FOREIGN KEY (`exam_id`) REFERENCES `tbl_exam` (`exam_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_student_project`
--
ALTER TABLE `tbl_student_project`
  ADD CONSTRAINT `tbl_user_tbl_student_project` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_project_tbl_student_project` FOREIGN KEY (`PID`) REFERENCES `tbl_project` (`PID`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_student_quiz`
--
ALTER TABLE `tbl_student_quiz`
  ADD CONSTRAINT `tbl_user_tbl_student_quiz` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_quiz_tbl_student_quiz` FOREIGN KEY (`QID`) REFERENCES `tbl_quiz` (`QID`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_student_recitation`
--
ALTER TABLE `tbl_student_recitation`
  ADD CONSTRAINT `tbl_user_tbl_student_recitation` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_recitation_tbl_student_recitation` FOREIGN KEY (`RID`) REFERENCES `tbl_recitation` (`RID`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_subj_offering`
--
ALTER TABLE `tbl_subj_offering`
  ADD CONSTRAINT `tbl_subject_tbl_subj_offering` FOREIGN KEY (`subj_id`) REFERENCES `tbl_subject` (`subj_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_grade_section_tbl_subj_offering` FOREIGN KEY (`offer_id`) REFERENCES `tbl_grade_section` (`offer_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_teacher_subj`
--
ALTER TABLE `tbl_teacher_subj`
  ADD CONSTRAINT `tbl_user_tbl_teacher_subj` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_subj_offering_tbl_teacher_subj` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
