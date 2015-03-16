# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases v6.1.3                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          hs_ogs.dez                                      #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database drop script                            #
# Created on:            2015-03-08 09:17                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Drop foreign key constraints                                           #
# ---------------------------------------------------------------------- #

ALTER TABLE `tbl_assignment` DROP FOREIGN KEY `tbl_subj_offering_tbl_assignment`;

ALTER TABLE `tbl_enroll_student` DROP FOREIGN KEY `tbl_grade_section_tbl_enroll_student`;

ALTER TABLE `tbl_exam` DROP FOREIGN KEY `tbl_subj_offering_tbl_exam`;

ALTER TABLE `tbl_grade_column` DROP FOREIGN KEY `tbl_subj_offering_tbl_grade_column`;

ALTER TABLE `tbl_grade_section` DROP FOREIGN KEY `tbl_grade_level_tbl_grade_section`;

ALTER TABLE `tbl_grade_subj` DROP FOREIGN KEY `tbl_grade_level_tbl_grade_subj`;

ALTER TABLE `tbl_grade_system` DROP FOREIGN KEY `tbl_subj_offering_tbl_grade_system`;

ALTER TABLE `tbl_project` DROP FOREIGN KEY `tbl_subj_offering_tbl_project`;

ALTER TABLE `tbl_quiz` DROP FOREIGN KEY `tbl_subj_offering_tbl_quiz`;

ALTER TABLE `tbl_recitation` DROP FOREIGN KEY `tbl_subj_offering_tbl_recitation`;

ALTER TABLE `tbl_student_assignment` DROP FOREIGN KEY `tbl_assignment_tbl_student_assignment`;

ALTER TABLE `tbl_student_exam` DROP FOREIGN KEY `tbl_exam_tbl_student_exam`;

ALTER TABLE `tbl_student_project` DROP FOREIGN KEY `tbl_project_tbl_student_project`;

ALTER TABLE `tbl_student_quiz` DROP FOREIGN KEY `tbl_quiz_tbl_student_quiz`;

ALTER TABLE `tbl_student_recitation` DROP FOREIGN KEY `tbl_recitation_tbl_student_recitation`;

ALTER TABLE `tbl_subj_offering` DROP FOREIGN KEY `tbl_grade_section_tbl_subj_offering`;

ALTER TABLE `tbl_subj_offering` DROP FOREIGN KEY `tbl_subject_tbl_subj_offering`;

ALTER TABLE `tbl_teacher_subj` DROP FOREIGN KEY `tbl_subj_offering_tbl_teacher_subj`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_student_recitation"                                    #
# ---------------------------------------------------------------------- #

# Drop constraints #

# Drop table #

DROP TABLE `tbl_student_recitation`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_student_quiz"                                          #
# ---------------------------------------------------------------------- #

# Drop constraints #

# Drop table #

DROP TABLE `tbl_student_quiz`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_student_project"                                       #
# ---------------------------------------------------------------------- #

# Drop constraints #

# Drop table #

DROP TABLE `tbl_student_project`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_student_exam"                                          #
# ---------------------------------------------------------------------- #

# Drop constraints #

# Drop table #

DROP TABLE `tbl_student_exam`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_student_assignment"                                    #
# ---------------------------------------------------------------------- #

# Drop constraints #

# Drop table #

DROP TABLE `tbl_student_assignment`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_recitation"                                            #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `tbl_recitation` MODIFY `RID` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `tbl_recitation` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `tbl_recitation`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_quiz"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `tbl_quiz` MODIFY `QID` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `tbl_quiz` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `tbl_quiz`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_project"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `tbl_project` MODIFY `PID` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `tbl_project` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `tbl_project`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_grade_system"                                          #
# ---------------------------------------------------------------------- #

# Drop constraints #

# Drop table #

DROP TABLE `tbl_grade_system`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_grade_column"                                          #
# ---------------------------------------------------------------------- #

# Drop constraints #

# Drop table #

DROP TABLE `tbl_grade_column`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_exam"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `tbl_exam` MODIFY `exam_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `tbl_exam` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `tbl_exam`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_enroll_student"                                        #
# ---------------------------------------------------------------------- #

# Drop constraints #

# Drop table #

DROP TABLE `tbl_enroll_student`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_assignment"                                            #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `tbl_assignment` MODIFY `AID` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `tbl_assignment` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `tbl_assignment`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_user"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `tbl_user` MODIFY `user_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `tbl_user` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `tbl_user`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_teacher_subj"                                          #
# ---------------------------------------------------------------------- #

# Drop constraints #

# Drop table #

DROP TABLE `tbl_teacher_subj`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_subj_offering"                                         #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `tbl_subj_offering` MODIFY `subj_offerid` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `tbl_subj_offering` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `tbl_subj_offering`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_subject"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `tbl_subject` MODIFY `subj_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `tbl_subject` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `tbl_subject`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_grade_subj"                                            #
# ---------------------------------------------------------------------- #

# Drop constraints #

# Drop table #

DROP TABLE `tbl_grade_subj`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_grade_section"                                         #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `tbl_grade_section` MODIFY `offer_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `tbl_grade_section` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `tbl_grade_section`;

# ---------------------------------------------------------------------- #
# Drop table "tbl_grade_level"                                           #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `tbl_grade_level` MODIFY `gl_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `tbl_grade_level` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `tbl_grade_level`;
