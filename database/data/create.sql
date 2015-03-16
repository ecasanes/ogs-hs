# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases v6.1.3                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          hs_ogs.dez                                      #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database creation script                        #
# Created on:            2015-03-08 09:17                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Tables                                                                 #
# ---------------------------------------------------------------------- #

# ---------------------------------------------------------------------- #
# Add table "tbl_assignment"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_assignment` (
    `AID` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `a_item` INTEGER(11),
    `term` INTEGER(11),
    `atag` INTEGER(11),
    `subj_offerid` INTEGER(11),
    PRIMARY KEY (`AID`)
)
 ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81;

CREATE INDEX `tbl_subj_offering_tbl_assignment` ON `tbl_assignment` (`subj_offerid`);

# ---------------------------------------------------------------------- #
# Add table "tbl_enroll_student"                                         #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_enroll_student` (
    `offer_id` INTEGER(11),
    `user_id` INTEGER(11)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX `tbl_grade_section_tbl_enroll_student` ON `tbl_enroll_student` (`offer_id`);

CREATE INDEX `tbl_user_tbl_enroll_student` ON `tbl_enroll_student` (`user_id`);

# ---------------------------------------------------------------------- #
# Add table "tbl_exam"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_exam` (
    `exam_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `e_item` INTEGER(11),
    `term` INTEGER(11),
    `etag` INTEGER(11),
    `subj_offerid` INTEGER(11),
    PRIMARY KEY (`exam_id`)
)
 ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17;

CREATE INDEX `tbl_subj_offering_tbl_exam` ON `tbl_exam` (`subj_offerid`);

# ---------------------------------------------------------------------- #
# Add table "tbl_grade_column"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_grade_column` (
    `QC` INTEGER(10),
    `RC` INTEGER(10),
    `AC` INTEGER(10),
    `PC` INTEGER(10),
    `Term` INTEGER(11),
    `subj_offerid` INTEGER(11)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX `tbl_subj_offering_tbl_grade_column` ON `tbl_grade_column` (`subj_offerid`);

# ---------------------------------------------------------------------- #
# Add table "tbl_grade_level"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_grade_level` (
    `gl_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `sy_start` INTEGER(5),
    `sy_end` INTEGER(5),
    `grade_level` INTEGER(2),
    PRIMARY KEY (`gl_id`)
)
 ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22;

# ---------------------------------------------------------------------- #
# Add table "tbl_grade_section"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_grade_section` (
    `offer_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `section` VARCHAR(50),
    `gl_id` INTEGER(11),
    PRIMARY KEY (`offer_id`)
)
 ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11;

CREATE INDEX `tbl_grade_level_tbl_grade_section` ON `tbl_grade_section` (`gl_id`);

# ---------------------------------------------------------------------- #
# Add table "tbl_grade_subj"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_grade_subj` (
    `subj_id` INTEGER(11),
    `gl_id` INTEGER(11)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX `tbl_subject_tbl_grade_subj` ON `tbl_grade_subj` (`subj_id`);

CREATE INDEX `tbl_grade_level_tbl_grade_subj` ON `tbl_grade_subj` (`gl_id`);

# ---------------------------------------------------------------------- #
# Add table "tbl_grade_system"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_grade_system` (
    `QW` INTEGER(11),
    `RW` INTEGER(11),
    `AW` INTEGER(11),
    `PW` INTEGER(11),
    `EW` INTEGER(11),
    `Term` INTEGER(11),
    `subj_offerid` INTEGER(11)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX `tbl_subj_offering_tbl_grade_system` ON `tbl_grade_system` (`subj_offerid`);

# ---------------------------------------------------------------------- #
# Add table "tbl_project"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_project` (
    `PID` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `p_item` INTEGER(11),
    `term` INTEGER(11),
    `ptag` INTEGER(11),
    `subj_offerid` INTEGER(11),
    PRIMARY KEY (`PID`)
)
 ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33;

CREATE INDEX `tbl_subj_offering_tbl_project` ON `tbl_project` (`subj_offerid`);

# ---------------------------------------------------------------------- #
# Add table "tbl_quiz"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_quiz` (
    `QID` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `q_item` INTEGER(11),
    `term` INTEGER(11),
    `qtag` INTEGER(11),
    `subj_offerid` INTEGER(11),
    PRIMARY KEY (`QID`)
)
 ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97;

CREATE INDEX `tbl_subj_offering_tbl_quiz` ON `tbl_quiz` (`subj_offerid`);

# ---------------------------------------------------------------------- #
# Add table "tbl_recitation"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_recitation` (
    `RID` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `r_item` INTEGER(11),
    `term` INTEGER(11),
    `rtag` INTEGER(11),
    `subj_offerid` INTEGER(11),
    PRIMARY KEY (`RID`)
)
 ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=65;

CREATE INDEX `tbl_subj_offering_tbl_recitation` ON `tbl_recitation` (`subj_offerid`);

# ---------------------------------------------------------------------- #
# Add table "tbl_student_assignment"                                     #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_student_assignment` (
    `ascore` INTEGER(11) NOT NULL,
    `AID` INTEGER(11),
    `user_id` INTEGER(11)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX `tbl_assignment_tbl_student_assignment` ON `tbl_student_assignment` (`AID`);

CREATE INDEX `tbl_user_tbl_student_assignment` ON `tbl_student_assignment` (`user_id`);

# ---------------------------------------------------------------------- #
# Add table "tbl_student_exam"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_student_exam` (
    `escore` INTEGER(11),
    `exam_id` INTEGER(11),
    `user_id` INTEGER(11)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX `tbl_exam_tbl_student_exam` ON `tbl_student_exam` (`exam_id`);

CREATE INDEX `tbl_user_tbl_student_exam` ON `tbl_student_exam` (`user_id`);

# ---------------------------------------------------------------------- #
# Add table "tbl_student_project"                                        #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_student_project` (
    `pscore` INTEGER(11),
    `PID` INTEGER(11),
    `user_id` INTEGER(11)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX `tbl_project_tbl_student_project` ON `tbl_student_project` (`PID`);

CREATE INDEX `tbl_user_tbl_student_project` ON `tbl_student_project` (`user_id`);

# ---------------------------------------------------------------------- #
# Add table "tbl_student_quiz"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_student_quiz` (
    `qscore` INTEGER(11),
    `QID` INTEGER(11),
    `user_id` INTEGER(11)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX `tbl_quiz_tbl_student_quiz` ON `tbl_student_quiz` (`QID`);

CREATE INDEX `tbl_user_tbl_student_quiz` ON `tbl_student_quiz` (`user_id`);

# ---------------------------------------------------------------------- #
# Add table "tbl_student_recitation"                                     #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_student_recitation` (
    `rscore` INTEGER(11),
    `RID` INTEGER(11),
    `user_id` INTEGER(11)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX `tbl_recitation_tbl_student_recitation` ON `tbl_student_recitation` (`RID`);

CREATE INDEX `tbl_user_tbl_student_recitation` ON `tbl_student_recitation` (`user_id`);

# ---------------------------------------------------------------------- #
# Add table "tbl_subject"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_subject` (
    `subj_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `subj_code` VARCHAR(40),
    `subj_desc` VARCHAR(40),
    `subj_unit` INTEGER(5),
    PRIMARY KEY (`subj_id`)
)
 ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5;

# ---------------------------------------------------------------------- #
# Add table "tbl_subj_offering"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_subj_offering` (
    `subj_offerid` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `offer_id` INTEGER(11),
    `subj_id` INTEGER(11),
    PRIMARY KEY (`subj_offerid`)
)
 ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5;

CREATE INDEX `tbl_grade_section_tbl_subj_offering` ON `tbl_subj_offering` (`offer_id`);

CREATE INDEX `tbl_subject_tbl_subj_offering` ON `tbl_subj_offering` ();

# ---------------------------------------------------------------------- #
# Add table "tbl_teacher_subj"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE `tbl_teacher_subj` (
    `subj_offerid` INTEGER(11),
    `user_id` INTEGER(11)
)
 ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX `tbl_subj_offering_tbl_teacher_subj` ON `tbl_teacher_subj` (`subj_offerid`);

CREATE INDEX `tbl_user_tbl_teacher_subj` ON `tbl_teacher_subj` (`user_id`);

# ---------------------------------------------------------------------- #
# Add table "tbl_user"                                                   #
# ---------------------------------------------------------------------- #

INSERT INTO tbl_user (username, PASSWORD, user_type, fname, mname, lname) VALUES ('admin', MD5('admin'), 1, 'Admin', 'Mname', 'Lname')
CREATE TABLE `tbl_user` (
    `user_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(32),
    `password` VARCHAR(32),
    `user_type` INTEGER(11),
    `fname` VARCHAR(50),
    `mname` VARCHAR(50),
    `lname` VARCHAR(50),
    `age` INTEGER(5),
    `gender` VARCHAR(7),
    `address` VARCHAR(50),
    `year_level` INTEGER(11),
    PRIMARY KEY (`user_id`)
)
 ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13;

# ---------------------------------------------------------------------- #
# Foreign key constraints                                                #
# ---------------------------------------------------------------------- #

ALTER TABLE `tbl_assignment` ADD CONSTRAINT `tbl_subj_offering_tbl_assignment` 
    FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_enroll_student` ADD CONSTRAINT `tbl_grade_section_tbl_enroll_student` 
    FOREIGN KEY (`offer_id`) REFERENCES `tbl_grade_section` (`offer_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_exam` ADD CONSTRAINT `tbl_subj_offering_tbl_exam` 
    FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_grade_column` ADD CONSTRAINT `tbl_subj_offering_tbl_grade_column` 
    FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_grade_section` ADD CONSTRAINT `tbl_grade_level_tbl_grade_section` 
    FOREIGN KEY (`gl_id`) REFERENCES `tbl_grade_level` (`gl_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_grade_subj` ADD CONSTRAINT `tbl_grade_level_tbl_grade_subj` 
    FOREIGN KEY (`gl_id`) REFERENCES `tbl_grade_level` (`gl_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_grade_system` ADD CONSTRAINT `tbl_subj_offering_tbl_grade_system` 
    FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_project` ADD CONSTRAINT `tbl_subj_offering_tbl_project` 
    FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_quiz` ADD CONSTRAINT `tbl_subj_offering_tbl_quiz` 
    FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_recitation` ADD CONSTRAINT `tbl_subj_offering_tbl_recitation` 
    FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_student_assignment` ADD CONSTRAINT `tbl_assignment_tbl_student_assignment` 
    FOREIGN KEY (`AID`) REFERENCES `tbl_assignment` (`AID`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_student_exam` ADD CONSTRAINT `tbl_exam_tbl_student_exam` 
    FOREIGN KEY (`exam_id`) REFERENCES `tbl_exam` (`exam_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_student_project` ADD CONSTRAINT `tbl_project_tbl_student_project` 
    FOREIGN KEY (`PID`) REFERENCES `tbl_project` (`PID`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_student_quiz` ADD CONSTRAINT `tbl_quiz_tbl_student_quiz` 
    FOREIGN KEY (`QID`) REFERENCES `tbl_quiz` (`QID`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_student_recitation` ADD CONSTRAINT `tbl_recitation_tbl_student_recitation` 
    FOREIGN KEY (`RID`) REFERENCES `tbl_recitation` (`RID`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_subj_offering` ADD CONSTRAINT `tbl_grade_section_tbl_subj_offering` 
    FOREIGN KEY (`offer_id`) REFERENCES `tbl_grade_section` (`offer_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

ALTER TABLE `tbl_subj_offering` ADD CONSTRAINT `tbl_subject_tbl_subj_offering` 
    FOREIGN KEY (`subj_id`) REFERENCES `tbl_subject` (`subj_id`) ON DELETE CASCADE;

ALTER TABLE `tbl_teacher_subj` ADD CONSTRAINT `tbl_subj_offering_tbl_teacher_subj` 
    FOREIGN KEY (`subj_offerid`) REFERENCES `tbl_subj_offering` (`subj_offerid`) ON DELETE CASCADE ON UPDATE RESTRICT;
