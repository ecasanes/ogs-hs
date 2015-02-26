-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2015 at 06:16 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spc_ogs`
--
CREATE DATABASE IF NOT EXISTS `spc_ogs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `spc_ogs`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assignment`
--

CREATE TABLE IF NOT EXISTS `tbl_assignment` (
  `AID` int(10) NOT NULL AUTO_INCREMENT,
  `a_item` int(10) NOT NULL,
  `term` varchar(10) NOT NULL,
  `subj_offerid` int(10) NOT NULL,
  `atag` int(10) NOT NULL,
  PRIMARY KEY (`AID`),
  KEY `subj_offerid` (`subj_offerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=177 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_enroll_student`
--

CREATE TABLE IF NOT EXISTS `tbl_enroll_student` (
  `offer_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  KEY `offer_id` (`offer_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_exam`
--

CREATE TABLE IF NOT EXISTS `tbl_exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `subj_offerid` int(10) NOT NULL,
  `term` varchar(10) NOT NULL,
  `e_item` int(10) NOT NULL,
  `etag` int(10) NOT NULL,
  PRIMARY KEY (`exam_id`),
  KEY `subj_offerid` (`subj_offerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_column`
--

CREATE TABLE IF NOT EXISTS `tbl_grade_column` (
  `subj_offerid` int(10) NOT NULL,
  `QC` int(10) NOT NULL,
  `RC` int(10) NOT NULL,
  `AC` int(10) NOT NULL,
  `PC` int(10) NOT NULL,
  `Term` varchar(10) NOT NULL,
  KEY `subj_offerid` (`subj_offerid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_level`
--

CREATE TABLE IF NOT EXISTS `tbl_grade_level` (
  `gl_id` int(10) NOT NULL AUTO_INCREMENT,
  `sy_start` int(5) NOT NULL,
  `sy_end` int(5) NOT NULL,
  `grade_level` varchar(10) NOT NULL,
  PRIMARY KEY (`gl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tbl_grade_level`
--

INSERT INTO `tbl_grade_level` (`gl_id`, `sy_start`, `sy_end`, `grade_level`) VALUES
(1, 2019, 2020, '1'),
(2, 2019, 2020, '2'),
(3, 2019, 2020, '3'),
(9, 2019, 2020, '4'),
(14, 2015, 2016, '1'),
(15, 2015, 2016, '2'),
(16, 2015, 2016, '3'),
(17, 2015, 2016, '4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_section`
--

CREATE TABLE IF NOT EXISTS `tbl_grade_section` (
  `offer_id` int(10) NOT NULL AUTO_INCREMENT,
  `gl_id` int(10) NOT NULL,
  `section` varchar(15) NOT NULL,
  PRIMARY KEY (`offer_id`),
  KEY `gl_id` (`gl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbl_grade_section`
--

INSERT INTO `tbl_grade_section` (`offer_id`, `gl_id`, `section`) VALUES
(1, 1, 'Section 1'),
(2, 2, 'Section 2'),
(3, 3, 'Section 2'),
(4, 1, 'Section 2'),
(5, 2, 'Section 3'),
(6, 14, 'Mabuti');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_subj`
--

CREATE TABLE IF NOT EXISTS `tbl_grade_subj` (
  `gl_id` int(10) NOT NULL,
  `subj_id` int(10) NOT NULL,
  KEY `subj_id` (`subj_id`),
  KEY `gl_id` (`gl_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grade_subj`
--

INSERT INTO `tbl_grade_subj` (`gl_id`, `subj_id`) VALUES
(14, 1),
(14, 2),
(14, 3),
(14, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_system`
--

CREATE TABLE IF NOT EXISTS `tbl_grade_system` (
  `subj_offerid` int(10) NOT NULL,
  `QW` int(10) NOT NULL,
  `RW` int(10) NOT NULL,
  `AW` int(10) NOT NULL,
  `PW` int(10) NOT NULL,
  `EW` int(10) NOT NULL,
  `Term` varchar(10) NOT NULL,
  KEY `subj_offerid` (`subj_offerid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE IF NOT EXISTS `tbl_project` (
  `PID` int(10) NOT NULL AUTO_INCREMENT,
  `p_item` int(10) NOT NULL,
  `term` varchar(10) NOT NULL,
  `subj_offerid` int(10) NOT NULL,
  `ptag` int(10) NOT NULL,
  PRIMARY KEY (`PID`),
  KEY `subj_offerid` (`subj_offerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz`
--

CREATE TABLE IF NOT EXISTS `tbl_quiz` (
  `QID` int(10) NOT NULL AUTO_INCREMENT,
  `q_item` int(10) NOT NULL,
  `term` varchar(10) NOT NULL,
  `subj_offerid` int(10) NOT NULL,
  `qtag` int(10) NOT NULL,
  PRIMARY KEY (`QID`),
  KEY `subj_offerid` (`subj_offerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=197 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recitation`
--

CREATE TABLE IF NOT EXISTS `tbl_recitation` (
  `RID` int(10) NOT NULL AUTO_INCREMENT,
  `r_item` int(10) NOT NULL,
  `term` int(10) NOT NULL,
  `subj_offerid` int(10) NOT NULL,
  `rtag` int(10) NOT NULL,
  PRIMARY KEY (`RID`),
  KEY `subj_offerid` (`subj_offerid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=129 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_assignment`
--

CREATE TABLE IF NOT EXISTS `tbl_student_assignment` (
  `user_id` int(10) NOT NULL,
  `AID` int(10) NOT NULL,
  `ascore` int(10) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `AID` (`AID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_exam`
--

CREATE TABLE IF NOT EXISTS `tbl_student_exam` (
  `user_id` int(10) NOT NULL,
  `exam_id` int(10) NOT NULL,
  `t1exam` int(10) NOT NULL,
  `t2exam` int(10) NOT NULL,
  `t3exam` int(10) NOT NULL,
  `t4exam` int(10) NOT NULL,
  `escore` int(10) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `exam_id` (`exam_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_project`
--

CREATE TABLE IF NOT EXISTS `tbl_student_project` (
  `user_id` int(10) NOT NULL,
  `PID` int(10) NOT NULL,
  `pscore` int(10) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `PID` (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_quiz`
--

CREATE TABLE IF NOT EXISTS `tbl_student_quiz` (
  `user_id` int(10) NOT NULL,
  `QID` int(10) NOT NULL,
  `qscore` int(10) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `QID` (`QID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student_recitation`
--

CREATE TABLE IF NOT EXISTS `tbl_student_recitation` (
  `user_id` int(10) NOT NULL,
  `RID` int(10) NOT NULL,
  `rscore` int(10) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `RID` (`RID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE IF NOT EXISTS `tbl_subject` (
  `subj_id` int(10) NOT NULL AUTO_INCREMENT,
  `subj_code` varchar(20) NOT NULL,
  `subj_desc` varchar(20) NOT NULL,
  `subj_unit` smallint(5) DEFAULT NULL,
  PRIMARY KEY (`subj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`subj_id`, `subj_code`, `subj_desc`, `subj_unit`) VALUES
(1, 'CSC101', 'Computer Science 1', 3),
(2, 'Math101', 'dfdf', 3),
(3, 'Math101t', 'sfsdf', 1),
(14, 'Math101a', 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subj_offering`
--

CREATE TABLE IF NOT EXISTS `tbl_subj_offering` (
  `subj_offerid` int(10) NOT NULL AUTO_INCREMENT,
  `offer_id` int(10) NOT NULL,
  `subj_id` int(10) NOT NULL,
  PRIMARY KEY (`subj_offerid`),
  KEY `offer_id` (`offer_id`),
  KEY `subj_id` (`subj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_subj_offering`
--

INSERT INTO `tbl_subj_offering` (`subj_offerid`, `offer_id`, `subj_id`) VALUES
(9, 6, 1),
(10, 6, 2),
(11, 6, 3),
(12, 6, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher_subj`
--

CREATE TABLE IF NOT EXISTS `tbl_teacher_subj` (
  `subj_offerid` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  KEY `subj_offerid` (`subj_offerid`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_teacher_subj`
--

INSERT INTO `tbl_teacher_subj` (`subj_offerid`, `user_id`) VALUES
(9, 2),
(10, 2),
(11, 3),
(12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_type` int(10) NOT NULL,
  `fname` varchar(15) NOT NULL,
  `mname` varchar(10) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `age` int(5) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `address` varchar(30) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `password`, `user_type`, `fname`, `mname`, `lname`, `age`, `gender`, `address`) VALUES
(1, 'ernest.casanes', '63f69f3c6ea97828332ce9bf86616069', 1, 'Admin 1', 'Cilocilo', 'Casanes', 24, 'male', 'Del Carmen, Iligan City'),
(2, 'ecasanes', 'bc65f426282a1a198804b1d7602b25d4', 2, 'Instructor 1', 'Casanes', 'Lastname', 24, 'male', 'test'),
(3, 'ecasanes2', 'bc65f426282a1a198804b1d7602b25d4', 2, 'Instructor 2', 'Test', 'Lastname', 24, 'male', 'test'),
(4, 'abcd', '187ef4436122d1cc2f40dc2b92f0eba0', 2, 'Instructor 3', 'Hello', 'Lastname', 24, 'male', 'sfsf'),
(5, 'abcdtest', '202cb962ac59075b964b07152d234b70', 3, 'Student 1', 'Casanes', 'Lastname', 13, 'male', 'sfsf'),
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
  ADD CONSTRAINT `tbl_assignment_ibfk_1` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`);

--
-- Constraints for table `tbl_enroll_student`
--
ALTER TABLE `tbl_enroll_student`
  ADD CONSTRAINT `tbl_enroll_student_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `tbl_grade_section` (`offer_id`),
  ADD CONSTRAINT `tbl_enroll_student_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Constraints for table `tbl_exam`
--
ALTER TABLE `tbl_exam`
  ADD CONSTRAINT `tbl_exam_ibfk_1` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`);

--
-- Constraints for table `tbl_grade_column`
--
ALTER TABLE `tbl_grade_column`
  ADD CONSTRAINT `tbl_grade_column_ibfk_1` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`);

--
-- Constraints for table `tbl_grade_section`
--
ALTER TABLE `tbl_grade_section`
  ADD CONSTRAINT `tbl_grade_section_ibfk_1` FOREIGN KEY (`gl_id`) REFERENCES `tbl_grade_level` (`gl_id`);

--
-- Constraints for table `tbl_grade_subj`
--
ALTER TABLE `tbl_grade_subj`
  ADD CONSTRAINT `tbl_grade_subj_ibfk_1` FOREIGN KEY (`subj_id`) REFERENCES `tbl_subject` (`subj_id`),
  ADD CONSTRAINT `tbl_grade_subj_ibfk_2` FOREIGN KEY (`gl_id`) REFERENCES `tbl_grade_level` (`gl_id`);

--
-- Constraints for table `tbl_grade_system`
--
ALTER TABLE `tbl_grade_system`
  ADD CONSTRAINT `tbl_grade_system_ibfk_1` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`);

--
-- Constraints for table `tbl_project`
--
ALTER TABLE `tbl_project`
  ADD CONSTRAINT `tbl_project_ibfk_1` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`);

--
-- Constraints for table `tbl_quiz`
--
ALTER TABLE `tbl_quiz`
  ADD CONSTRAINT `tbl_quiz_ibfk_1` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`);

--
-- Constraints for table `tbl_recitation`
--
ALTER TABLE `tbl_recitation`
  ADD CONSTRAINT `tbl_recitation_ibfk_1` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`);

--
-- Constraints for table `tbl_student_assignment`
--
ALTER TABLE `tbl_student_assignment`
  ADD CONSTRAINT `tbl_student_assignment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_student_assignment_ibfk_2` FOREIGN KEY (`AID`) REFERENCES `tbl_assignment` (`AID`);

--
-- Constraints for table `tbl_student_exam`
--
ALTER TABLE `tbl_student_exam`
  ADD CONSTRAINT `tbl_student_exam_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_student_exam_ibfk_2` FOREIGN KEY (`exam_id`) REFERENCES `tbl_exam` (`exam_id`);

--
-- Constraints for table `tbl_student_project`
--
ALTER TABLE `tbl_student_project`
  ADD CONSTRAINT `tbl_student_project_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_student_project_ibfk_2` FOREIGN KEY (`PID`) REFERENCES `tbl_project` (`PID`);

--
-- Constraints for table `tbl_student_quiz`
--
ALTER TABLE `tbl_student_quiz`
  ADD CONSTRAINT `tbl_student_quiz_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_student_quiz_ibfk_2` FOREIGN KEY (`QID`) REFERENCES `tbl_quiz` (`QID`);

--
-- Constraints for table `tbl_student_recitation`
--
ALTER TABLE `tbl_student_recitation`
  ADD CONSTRAINT `tbl_student_recitation_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`),
  ADD CONSTRAINT `tbl_student_recitation_ibfk_2` FOREIGN KEY (`RID`) REFERENCES `tbl_recitation` (`RID`);

--
-- Constraints for table `tbl_subj_offering`
--
ALTER TABLE `tbl_subj_offering`
  ADD CONSTRAINT `tbl_subj_offering_ibfk_1` FOREIGN KEY (`offer_id`) REFERENCES `tbl_grade_section` (`offer_id`),
  ADD CONSTRAINT `tbl_subj_offering_ibfk_2` FOREIGN KEY (`subj_id`) REFERENCES `tbl_subject` (`subj_id`);

--
-- Constraints for table `tbl_teacher_subj`
--
ALTER TABLE `tbl_teacher_subj`
  ADD CONSTRAINT `tbl_teacher_subj_ibfk_1` FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`),
  ADD CONSTRAINT `tbl_teacher_subj_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
