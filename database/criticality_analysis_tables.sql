# ---------------------------------------------------------------------- #
# Add table "ca_question_category"                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE `ca_question_category` (
    `ca_question_category_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `code` VARCHAR(255),
    `description` TEXT,
    `general_question` TEXT,
    `formula_category_id` INTEGER(11),
    CONSTRAINT `PK_ca_question_category` PRIMARY KEY (`ca_question_category_id`)
);

# ---------------------------------------------------------------------- #
# Add table "ca_question"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `ca_question` (
    `ca_question_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `question` TEXT,
    `value` DECIMAL(11,2),
    `description` TEXT,
    `ca_question_category_id` INTEGER(11),
    CONSTRAINT `PK_ca_question` PRIMARY KEY (`ca_question_id`)
);

# ---------------------------------------------------------------------- #
# Add table "critical_equipment"                                         #
# ---------------------------------------------------------------------- #

CREATE TABLE `critical_equipment` (
    `critical_equipment_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `ref` TEXT,
    `tag_number` VARCHAR(255),
    `subsystem_component` VARCHAR(255),
    `code` VARCHAR(255),
    `quantity` INTEGER(11),
    `conflict` VARCHAR(255),
    `availability` DECIMAL(11,2),
    `rule_set` VARCHAR(255),
    `source_of_information` VARCHAR(255),
    `ce_group_id` INTEGER(11),
    `ce_parent_sce_id` INTEGER(11),
    CONSTRAINT `PK_critical_equipment` PRIMARY KEY (`critical_equipment_id`)
);

# ---------------------------------------------------------------------- #
# Add table "criticality_analysis_stage"                                 #
# ---------------------------------------------------------------------- #

CREATE TABLE `criticality_analysis_stage` (
    `criticality_analysis_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `ref` VARCHAR(255),
    `notes` TEXT,
    `spof_answer` INTEGER(11),
    `se_answer` INTEGER(11),
    `multi_answer` INTEGER(11),
    `sce` INTEGER(11),
    `ece` INTEGER(11),
    `pce` INTEGER(11),
    `ex` INTEGER(11),
    `sis` INTEGER(11),
    `spof_value` DECIMAL(11,2),
    `se_value` DECIMAL(11,2),
    `spof_result` DECIMAL(11,2),
    `se_result` DECIMAL(11,2),
    `risk_total` DECIMAL(11,2),
    `overall_criticality` DECIMAL(11,2),
    `overall_reliability_score` DECIMAL(11,2),
    `status_value_adjustment` DECIMAL(11,2),
    `inspection_periodicity_hrs` DECIMAL(11,2),
    `spf_criticality` DECIMAL(11,2),
    `cas` DECIMAL(11,2),
    `critical_equipment_id` INTEGER(11),
    CONSTRAINT `PK_criticality_analysis_stage` PRIMARY KEY (`criticality_analysis_id`)
);

# ---------------------------------------------------------------------- #
# Add table "ce_parent_sce"                                              #
# ---------------------------------------------------------------------- #

CREATE TABLE `ce_parent_sce` (
    `ce_parent_sce_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `ref` VARCHAR(255),
    `asset_id` INTEGER(11),
    CONSTRAINT `PK_ce_parent_sce` PRIMARY KEY (`ce_parent_sce_id`)
);

# ---------------------------------------------------------------------- #
# Add table "ce_group"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `ce_group` (
    `ce_group_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `match_tag_number` VARCHAR(255),
    CONSTRAINT `PK_ce_group` PRIMARY KEY (`ce_group_id`)
);

# ---------------------------------------------------------------------- #
# Add table "ca_answer"                                                  #
# ---------------------------------------------------------------------- #

CREATE TABLE `ca_answer` (
    `ca_answer_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `value` DECIMAL(11,2),
    `total` INTEGER(11),
    `ca_question_id` INTEGER(11),
    `ca_q_category_answer_id` INTEGER(11),
    CONSTRAINT `PK_ca_answer` PRIMARY KEY (`ca_answer_id`)
);

# ---------------------------------------------------------------------- #
# Add table "ca_role"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `ca_role` (
    `ca_role_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `role_id` INTEGER(11),
    `role_type` VARCHAR(255),
    `criticality_analysis_id` INTEGER(11),
    CONSTRAINT `PK_ca_role` PRIMARY KEY (`ca_role_id`)
);

# ---------------------------------------------------------------------- #
# Add table "ca_q_category_answer"                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE `ca_q_category_answer` (
    `ca_q_category_answer_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `answer` INTEGER(11),
    `total` INTEGER(11),
    `ca_question_category_id` INTEGER(11),
    `criticality_analysis_id` INTEGER(11),
    CONSTRAINT `PK_ca_q_category_answer` PRIMARY KEY (`ca_q_category_answer_id`)
);

# ---------------------------------------------------------------------- #
# Add table "formula_category"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE `formula_category` (
    `formula_category_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` TEXT,
    `code` VARCHAR(255),
    CONSTRAINT `PK_formula_category` PRIMARY KEY (`formula_category_id`)
);

# ---------------------------------------------------------------------- #
# Add table "formula"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `formula` (
    `formula_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `value` DECIMAL(11,2),
    `operation` VARCHAR(255),
    `operation_value` DECIMAL(11,2),
    `formula_category_id` INTEGER(11),
    CONSTRAINT `PK_formula` PRIMARY KEY (`formula_id`)
);


# ---------------------------------------------------------------------- #
# Add table "inspection_periodicity"                                     #
# ---------------------------------------------------------------------- #

CREATE TABLE `inspection_periodicity` (
    `inspection_periodicity_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `cas_range_low` INTEGER(11),
    `cas_range_high` INTEGER(11i),
    `ip_letter` VARCHAR(255),
    `pi_value` VARCHAR(255),
    `shifts` VARCHAR(255),
    `estimated_equipment_percentage` VARCHAR(255),
    `items_per_inspection_period` DECIMAL(11,2),
    `average_item_per_twelve_hr_shift` DECIMAL(11,2),
    CONSTRAINT `PK_inspection_periodicity` PRIMARY KEY (`inspection_periodicity_id`)
);

# ---------------------------------------------------------------------- #
# Add table "ca_redundancy"                                              #
# ---------------------------------------------------------------------- #

CREATE TABLE `ca_redundancy` (
    `ca_redundancy_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `critical_equipment_id` INTEGER(11),
    `criticality_analysis_id` INTEGER(11),
    CONSTRAINT `PK_ca_redundancy` PRIMARY KEY (`ca_redundancy_id`)
);

# ---------------------------------------------------------------------- #
# Foreign key constraints                                                #
# ---------------------------------------------------------------------- #

ALTER TABLE `ca_question_category` ADD CONSTRAINT `formula_category_ca_question_category` 
    FOREIGN KEY (`formula_category_id`) REFERENCES `formula_category` (`formula_category_id`) ON DELETE CASCADE;

ALTER TABLE `ca_question` ADD CONSTRAINT `ca_question_category_ca_question` 
    FOREIGN KEY (`ca_question_category_id`) REFERENCES `ca_question_category` (`ca_question_category_id`) ON DELETE CASCADE;

ALTER TABLE `critical_equipment` ADD CONSTRAINT `ce_group_critical_equipment` 
    FOREIGN KEY (`ce_group_id`) REFERENCES `ce_group` (`ce_group_id`) ON DELETE CASCADE;

ALTER TABLE `critical_equipment` ADD CONSTRAINT `ce_parent_sce_critical_equipment` 
    FOREIGN KEY (`ce_parent_sce_id`) REFERENCES `ce_parent_sce` (`ce_parent_sce_id`) ON DELETE CASCADE;

ALTER TABLE `criticality_analysis_stage` ADD CONSTRAINT `critical_equipment_criticality_analysis_stage` 
    FOREIGN KEY (`critical_equipment_id`) REFERENCES `critical_equipment` (`critical_equipment_id`) ON DELETE CASCADE;

ALTER TABLE `ca_answer` ADD CONSTRAINT `ca_question_ca_answer` 
    FOREIGN KEY (`ca_question_id`) REFERENCES `ca_question` (`ca_question_id`) ON DELETE CASCADE;

ALTER TABLE `ca_answer` ADD CONSTRAINT `ca_q_category_answer_ca_answer` 
    FOREIGN KEY (`ca_q_category_answer_id`) REFERENCES `ca_q_category_answer` (`ca_q_category_answer_id`) ON DELETE CASCADE;

ALTER TABLE `ca_role` ADD CONSTRAINT `criticality_analysis_stage_ca_role` 
    FOREIGN KEY (`criticality_analysis_id`) REFERENCES `criticality_analysis_stage` (`criticality_analysis_id`);

ALTER TABLE `ca_q_category_answer` ADD CONSTRAINT `ca_question_category_ca_q_category_answer` 
    FOREIGN KEY (`ca_question_category_id`) REFERENCES `ca_question_category` (`ca_question_category_id`) ON DELETE CASCADE;

ALTER TABLE `ca_q_category_answer` ADD CONSTRAINT `criticality_analysis_stage_ca_q_category_answer` 
    FOREIGN KEY (`criticality_analysis_id`) REFERENCES `criticality_analysis_stage` (`criticality_analysis_id`) ON DELETE CASCADE;

ALTER TABLE `formula` ADD CONSTRAINT `formula_category_formula` 
    FOREIGN KEY (`formula_category_id`) REFERENCES `formula_category` (`formula_category_id`) ON DELETE CASCADE;

ALTER TABLE `ca_redundancy` ADD CONSTRAINT `critical_equipment_ca_redundancy` 
    FOREIGN KEY (`critical_equipment_id`) REFERENCES `critical_equipment` (`critical_equipment_id`) ON DELETE CASCADE;

ALTER TABLE `ca_redundancy` ADD CONSTRAINT `criticality_analysis_stage_ca_redundancy` 
    FOREIGN KEY (`criticality_analysis_id`) REFERENCES `criticality_analysis_stage` (`criticality_analysis_id`) ON DELETE CASCADE;

