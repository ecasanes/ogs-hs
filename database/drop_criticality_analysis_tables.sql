ALTER TABLE `ca_question_category` DROP FOREIGN KEY `formula_category_ca_question_category`;

ALTER TABLE `ca_question` DROP FOREIGN KEY `ca_question_category_ca_question`;

ALTER TABLE `critical_equipment` DROP FOREIGN KEY `ce_group_critical_equipment`;

ALTER TABLE `critical_equipment` DROP FOREIGN KEY `ce_parent_sce_critical_equipment`;

ALTER TABLE `criticality_analysis_stage` DROP FOREIGN KEY `critical_equipment_criticality_analysis_stage`;

ALTER TABLE `ca_answer` DROP FOREIGN KEY `ca_question_ca_answer`;

ALTER TABLE `ca_answer` DROP FOREIGN KEY `ca_q_category_answer_ca_answer`;

ALTER TABLE `ca_role` DROP FOREIGN KEY `criticality_analysis_stage_ca_role`;

ALTER TABLE `ca_q_category_answer` DROP FOREIGN KEY `ca_question_category_ca_q_category_answer`;

ALTER TABLE `ca_q_category_answer` DROP FOREIGN KEY `criticality_analysis_stage_ca_q_category_answer`;

ALTER TABLE `formula` DROP FOREIGN KEY `formula_category_formula`;

# ---------------------------------------------------------------------- #
# Drop table "ca_answer"                                                 #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `ca_answer` MODIFY `ca_answer_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `ca_answer` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `ca_answer`;

# ---------------------------------------------------------------------- #
# Drop table "ca_q_category_answer"                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `ca_q_category_answer` MODIFY `ca_q_category_answer_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `ca_q_category_answer` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `ca_q_category_answer`;

# ---------------------------------------------------------------------- #
# Drop table "ca_role"                                                   #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `ca_role` MODIFY `ca_role_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `ca_role` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `ca_role`;

# ---------------------------------------------------------------------- #
# Drop table "criticality_analysis_stage"                                #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `criticality_analysis_stage` MODIFY `criticality_analysis_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `criticality_analysis_stage` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `criticality_analysis_stage`;

# ---------------------------------------------------------------------- #
# Drop table "critical_equipment"                                        #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `critical_equipment` MODIFY `critical_equipment_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `critical_equipment` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `critical_equipment`;

# ---------------------------------------------------------------------- #
# Drop table "ca_question"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `ca_question` MODIFY `ca_question_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `ca_question` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `ca_question`;

# ---------------------------------------------------------------------- #
# Drop table "ca_question_category"                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `ca_question_category` MODIFY `ca_question_category_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `ca_question_category` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `ca_question_category`;

# ---------------------------------------------------------------------- #
# Drop table "ce_group"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `ce_group` MODIFY `ce_group_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `ce_group` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `ce_group`;

# ---------------------------------------------------------------------- #
# Drop table "ce_parent_sce"                                             #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `ce_parent_sce` MODIFY `ce_parent_sce_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `ce_parent_sce` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `ce_parent_sce`;