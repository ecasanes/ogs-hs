-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2015 at 03:15 PM
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tbl_grade_level`
--

INSERT INTO `tbl_grade_level` (`gl_id`, `sy_start`, `sy_end`, `grade_level`) VALUES
(30, 2014, 2015, 1),
(31, 2014, 2015, 2),
(32, 2014, 2015, 3),
(33, 2014, 2015, 4);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `tbl_grade_section`
--

INSERT INTO `tbl_grade_section` (`offer_id`, `section`, `gl_id`) VALUES
(3, 'St. Anthony', 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_subj`
--

CREATE TABLE IF NOT EXISTS `tbl_grade_subj` (
  `subj_id` int(11) DEFAULT NULL,
  `gl_id` int(11) DEFAULT NULL,
  `lock_status` int(11) NOT NULL,
  KEY `tbl_subject_tbl_grade_subj` (`subj_id`),
  KEY `tbl_grade_level_tbl_grade_subj` (`gl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grade_subj`
--

INSERT INTO `tbl_grade_subj` (`subj_id`, `gl_id`, `lock_status`) VALUES
(8, 30, 0),
(10, 30, 0),
(11, 30, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE IF NOT EXISTS `tbl_subject` (
  `subj_id` int(11) NOT NULL AUTO_INCREMENT,
  `subj_code` varchar(40) DEFAULT NULL,
  `subj_desc` varchar(40) DEFAULT NULL,
  `subj_unit` int(5) DEFAULT NULL,
  `year_level` int(11) DEFAULT NULL,
  PRIMARY KEY (`subj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`subj_id`, `subj_code`, `subj_desc`, `subj_unit`, `year_level`) VALUES
(8, 'Math1', 'Mathematics 101', 3, 1),
(10, 'Sci1', 'Science 101', 2, 1),
(11, 'Hist1', 'History 101', 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `user_type`, `fname`, `mname`, `lname`, `age`, `gender`, `address`, `year_level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'Admin 1', 'Cilocilo', 'Casanes', 24, 'male', 'Del Carmen, Iligan City', NULL),
(10, 'teacher', '8d788385431273d11e8b43bb78f3aa41', 2, 'Teacher', '', 'Teacher Last', 30, 'male', 'Test', NULL),
(11, 'student', 'cd73502828457d15655bbd7a63fb0bc8', 3, 'Student', '', 'lastname', 13, 'male', 'test', 1),
(12, 'student2', '213ee683360d88249109c2f92789dbc3', 3, 'Test', '', 'Lastname', 14, 'male', 'tst', 1),
(13, 'teacher2', '8d788385431273d11e8b43bb78f3aa41', 2, 'Teacher fname', '', 'Teacher lname', 30, 'male', 'test', NULL),
(14, 'teacher3', '8d788385431273d11e8b43bb78f3aa41', 2, 'Teacher fname', '', 'Teacher lname', 30, 'male', 'test', NULL),
(15, 'teachers', 'ad7d0e29419cc0843e35c6fe93b14d09', 2, 'teachers', '', 'teachers', 24, 'male', 'dsfasdfd', NULL),
(16, 'teacherssss', 'ad7d0e29419cc0843e35c6fe93b14d09', 2, 'teachers', '', 'teachers', 24, 'male', 'dsfasdfd', NULL),
(17, 'asd', 'ad7d0e29419cc0843e35c6fe93b14d09', 2, 'teachers', '', 'teachers', 24, 'male', 'dsfasdfd', NULL),
(18, 'ddfdf', 'ad7d0e29419cc0843e35c6fe93b14d09', 2, 'teachers', '', 'teachers', 24, 'male', 'dsfasdfd', NULL),
(19, 'test', '900150983cd24fb0d6963f7d28e17f72', 3, 'sdfsdf', '', 'sdfsdf', 34, 'male', 'sdfsdf', 2),
(20, 'abc', '900150983cd24fb0d6963f7d28e17f72', 3, 'abc', '', 'abc', 23, 'male', '343', 1),
(21, 'cdf', '0117c830058d9adffb859f1b167d4acc', 3, 'cdf', '', 'cdf', 324, 'male', 'sdfsdf', 1);

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
  ADD CONSTRAINT `tbl_grade_section_tbl_enroll_student` FOREIGN KEY (`offer_id`) REFERENCES `tbl_grade_section` (`offer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_user_tbl_enroll_student` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `tbl_assignment_tbl_student_assignment` FOREIGN KEY (`AID`) REFERENCES `tbl_assignment` (`AID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_user_tbl_student_assignment` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_student_exam`
--
ALTER TABLE `tbl_student_exam`
  ADD CONSTRAINT `tbl_exam_tbl_student_exam` FOREIGN KEY (`exam_id`) REFERENCES `tbl_exam` (`exam_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_user_tbl_student_exam` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_student_project`
--
ALTER TABLE `tbl_student_project`
  ADD CONSTRAINT `tbl_project_tbl_student_project` FOREIGN KEY (`PID`) REFERENCES `tbl_project` (`PID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_user_tbl_student_project` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_student_quiz`
--
ALTER TABLE `tbl_student_quiz`
  ADD CONSTRAINT `tbl_quiz_tbl_student_quiz` FOREIGN KEY (`QID`) REFERENCES `tbl_quiz` (`QID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_user_tbl_student_quiz` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_student_recitation`
--
ALTER TABLE `tbl_student_recitation`
  ADD CONSTRAINT `tbl_recitation_tbl_student_recitation` FOREIGN KEY (`RID`) REFERENCES `tbl_recitation` (`RID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_user_tbl_student_recitation` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_subj_offering`
--
ALTER TABLE `tbl_subj_offering`
  ADD CONSTRAINT `tbl_grade_section_tbl_subj_offering` FOREIGN KEY (`offer_id`) REFERENCES `tbl_grade_section` (`offer_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_subject_tbl_subj_offering` FOREIGN KEY (`subj_id`) REFERENCES `tbl_subject` (`subj_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_teacher_subj`
--
ALTER TABLE `tbl_teacher_subj`
  ADD CONSTRAINT `tbl_subj_offering_tbl_teacher_subj` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_user_tbl_teacher_subj` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
