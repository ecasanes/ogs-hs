# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases v6.1.3                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          iso14224_single_criticality_analysis.dez        #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database creation script                        #
# Created on:            2015-02-14 14:42                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Tables                                                                 #
# ---------------------------------------------------------------------- #

# ---------------------------------------------------------------------- #
# Add table "document"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `document` (
    `document_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(20),
    `ref_id` INTEGER(11),
    `name` VARCHAR(255),
    `document_type` VARCHAR(50),
    `document_completed` VARCHAR(40),
    `notification_sent` VARCHAR(40),
    `last_modified` DATETIME,
    `date_created` DATETIME,
    `reviewed_by` INTEGER(11),
    `approved_by` INTEGER(11),
    `published_by` INTEGER(11),
    `reviewed_date` DATETIME,
    `approved_date` DATETIME,
    `published_date` DATETIME,
    `document_status` INTEGER(11),
    `cost_breakdown_estimated_total` VARCHAR(255),
    `benefits_breakdown_total` VARCHAR(255),
    `cost_breakdown_actual_total` VARCHAR(255),
    `cost_breakdown_variation` VARCHAR(255),
    `document_type_id` INTEGER(11),
    CONSTRAINT `PK_document` PRIMARY KEY (`document_id`)
);

# ---------------------------------------------------------------------- #
# Add table "decf"                                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE `decf` (
    `decf_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `decf_date` DATETIME,
    `brief_summary` TEXT,
    `asset_type` INTEGER(11),
    `justification` INTEGER(11),
    `date_of_issue` DATETIME,
    `problem_definition` TEXT,
    `notification` INTEGER(11),
    `notification_date` DATETIME,
    `notification_description` TEXT,
    `notification_details` TEXT,
    `failure_mode_notification` INTEGER(11),
    `failure_mode_description` INTEGER(11),
    `failure_mechanism` INTEGER(11),
    `failure_mechanism_subdivision` INTEGER(11),
    `definitive_statement` TEXT,
    `detection` TEXT,
    `prevention` TEXT,
    `improvement_summary` TEXT,
    `risks_and_threats` TEXT,
    `next_steps` TEXT,
    `quality_control_summary` TEXT,
    `pass_or_fail` TEXT,
    `evaluate_results` TEXT,
    `findings` TEXT,
    `share_summary` TEXT,
    `recommendations` TEXT,
    `step_0_completed` VARCHAR(40),
    `step_1_completed` VARCHAR(40),
    `step_2_completed` VARCHAR(40),
    `step_3_completed` VARCHAR(40),
    `step_4_completed` VARCHAR(40),
    `step_5_completed` VARCHAR(40),
    `step_6_completed` VARCHAR(40),
    `step_7_completed` VARCHAR(40),
    `document_id` INTEGER(11) NOT NULL,
    CONSTRAINT `PK_decf` PRIMARY KEY (`decf_id`, `document_id`)
);

# ---------------------------------------------------------------------- #
# Add table "timeline"                                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `timeline` (
    `timeline_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `event` TEXT,
    `time` TIME,
    `date` DATETIME,
    `status` VARCHAR(40),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_timeline` PRIMARY KEY (`timeline_id`)
);

# ---------------------------------------------------------------------- #
# Add table "equipment_profile"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE `equipment_profile` (
    `equipment_profile_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `system_id` INTEGER(11),
    `system_subcategory_id` INTEGER(11),
    `equipment_category_id` INTEGER(11),
    `equipment_class_id` INTEGER(11),
    `equipment_description_id` INTEGER(11),
    `tag_number` VARCHAR(255),
    `unique_id` VARCHAR(255),
    `manufacturer` VARCHAR(255),
    `model` VARCHAR(255),
    `power_output` VARCHAR(255),
    `failed_component` VARCHAR(255),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_equipment_profile` PRIMARY KEY (`equipment_profile_id`)
);

# ---------------------------------------------------------------------- #
# Add table "failure_impact"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE `failure_impact` (
    `failure_impact_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `area_of_impact_id` INTEGER(11),
    `consequence_id` INTEGER(11),
    `area_of_impact_consequence_id` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_failure_impact` PRIMARY KEY (`failure_impact_id`)
);

# ---------------------------------------------------------------------- #
# Add table "area_of_impact_consequence"                                 #
# ---------------------------------------------------------------------- #

CREATE TABLE `area_of_impact_consequence` (
    `area_of_impact_consequence_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `description` TEXT,
    `area_of_impact_id` INTEGER(11),
    `consequence_id` INTEGER(11),
    CONSTRAINT `PK_area_of_impact_consequence` PRIMARY KEY (`area_of_impact_consequence_id`)
);

# ---------------------------------------------------------------------- #
# Add table "equipment_history_answer"                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `equipment_history_answer` (
    `equipment_history_answer_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `answer` TEXT,
    `comment` TEXT,
    `start_date` DATETIME,
    `end_date` DATETIME,
    `start_date_dropdown` VARCHAR(40),
    `end_date_dropdown` VARCHAR(40),
    `why_1` TEXT,
    `why_2` TEXT,
    `why_3` TEXT,
    `why_4` TEXT,
    `why_5` TEXT,
    `why_question` VARCHAR(40),
    `five_why_answer` VARCHAR(255),
    `six_why_answer` VARCHAR(255),
    `six_why_1` TEXT,
    `six_why_2` TEXT,
    `six_why_3` TEXT,
    `six_why_4` TEXT,
    `six_why_5` TEXT,
    `six_why_6` TEXT,
    `equipment_history_category_id` INTEGER(11),
    `equipment_history_question_id` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_equipment_history_answer` PRIMARY KEY (`equipment_history_answer_id`)
);

# ---------------------------------------------------------------------- #
# Add table "equipment_history_question"                                 #
# ---------------------------------------------------------------------- #

CREATE TABLE `equipment_history_question` (
    `equipment_history_question_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `question` TEXT,
    `dropdown_type` VARCHAR(40),
    `field_type` VARCHAR(40),
    `five_why_text` TEXT,
    `six_why_text` TEXT,
    `exclude_date` VARCHAR(40),
    `question_level` VARCHAR(255),
    `equipment_history_category_id` INTEGER(11),
    CONSTRAINT `PK_equipment_history_question` PRIMARY KEY (`equipment_history_question_id`)
);

# ---------------------------------------------------------------------- #
# Add table "equipment_history_category"                                 #
# ---------------------------------------------------------------------- #

CREATE TABLE `equipment_history_category` (
    `equipment_history_category_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `order` INTEGER(11),
    `description` TEXT,
    CONSTRAINT `PK_equipment_history_category` PRIMARY KEY (`equipment_history_category_id`)
);

# ---------------------------------------------------------------------- #
# Add table "failure_cause"                                              #
# ---------------------------------------------------------------------- #

CREATE TABLE `failure_cause` (
    `failure_cause_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `failure_cause_category_id` INTEGER(11),
    `failure_cause_subdivision_id` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_failure_cause` PRIMARY KEY (`failure_cause_id`)
);

# ---------------------------------------------------------------------- #
# Add table "ofi"                                                        #
# ---------------------------------------------------------------------- #

CREATE TABLE `ofi` (
    `ofi_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `brief_summary` TEXT,
    `asset_type` INTEGER(11),
    `area_of_focus` INTEGER(11),
    `date_of_issue` DATETIME,
    `improvement_summary` TEXT,
    `risks_and_threats` TEXT,
    `next_steps` TEXT,
    `step_0_completed` VARCHAR(40),
    `step_1_completed` VARCHAR(40),
    `step_2_completed` VARCHAR(40),
    `step_3_completed` VARCHAR(40),
    `date` DATETIME,
    `document_id` INTEGER(11) NOT NULL,
    CONSTRAINT `PK_ofi` PRIMARY KEY (`ofi_id`)
);

# ---------------------------------------------------------------------- #
# Add table "user"                                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE `user` (
    `user_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `first_name` VARCHAR(50),
    `last_name` VARCHAR(50),
    `user_name` VARCHAR(50),
    `email_address` VARCHAR(255),
    `password` VARCHAR(255),
    `activation_key` VARCHAR(255),
    `password_key` VARCHAR(255),
    `status` INTEGER(11),
    `date_created` DATETIME,
    `user_photo` VARCHAR(255),
    `discipline` VARCHAR(40),
    `position` VARCHAR(40),
    `years_of_service` VARCHAR(40),
    `area_of_operations` VARCHAR(40),
    `asset_operation` INTEGER(11),
    `highest_qualification` VARCHAR(40),
    `last_worked_on` VARCHAR(255),
    `forward_emails` VARCHAR(40),
    `notification_sent` VARCHAR(40),
    `role` VARCHAR(40),
    `cover_photo` VARCHAR(255),
    `notify_technical_bulletin` VARCHAR(40),
    `notify_case_file` VARCHAR(40),
    `asset_role` VARCHAR(255),
    `asset` VARCHAR(255),
    CONSTRAINT `PK_user` PRIMARY KEY (`user_id`)
);

# ---------------------------------------------------------------------- #
# Add table "document_owner"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE `document_owner` (
    `document_owner_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `document_owner_type` VARCHAR(40),
    `user_id` INTEGER(11),
    `document_id` INTEGER(11) NOT NULL,
    CONSTRAINT `PK_document_owner` PRIMARY KEY (`document_owner_id`)
);

# ---------------------------------------------------------------------- #
# Add table "file"                                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE `file` (
    `file_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `filename` TEXT,
    `step_no` INTEGER(11),
    `document_id` INTEGER(11),
    `action_tracker_id` INTEGER(11),
    `subaction_tracker_id` INTEGER(11),
    CONSTRAINT `PK_file` PRIMARY KEY (`file_id`)
);

# ---------------------------------------------------------------------- #
# Add table "project_plan"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `project_plan` (
    `project_plan_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `author` VARCHAR(255),
    `project_plan_date` DATETIME,
    `person_in_charge` VARCHAR(255),
    `brief_summary` TEXT,
    `justification_id` INTEGER(11),
    `costs` VARCHAR(40),
    `associated_documents` TEXT,
    `about_the_project` TEXT,
    `purpose` TEXT,
    `drivers` TEXT,
    `success_criteria` TEXT,
    `locations` TEXT,
    `estimated_project_duration` VARCHAR(40),
    `estimated_start_date` DATETIME,
    `first_day_offshore` VARCHAR(255),
    `last_day_offshore` VARCHAR(255),
    `benefits` TEXT,
    `risks_and_threats` TEXT,
    `boundaries` TEXT,
    `assumptions` TEXT,
    `quality_control_summary` TEXT,
    `pass_or_fail` TEXT,
    `chart` TEXT,
    `lesson_learned` TEXT,
    `project_condition_id` INTEGER(11),
    `work_party_id` INTEGER(11),
    `step_0_completed` VARCHAR(40),
    `step_1_completed` VARCHAR(40),
    `step_2_completed` VARCHAR(40),
    `step_3_completed` VARCHAR(40),
    `step_4_completed` VARCHAR(40),
    `step_5_completed` VARCHAR(40),
    `step_6_completed` VARCHAR(40),
    `step_7_completed` VARCHAR(40),
    `document_id` INTEGER(11) NOT NULL,
    CONSTRAINT `PK_project_plan` PRIMARY KEY (`project_plan_id`)
);

# ---------------------------------------------------------------------- #
# Add table "menu_category"                                              #
# ---------------------------------------------------------------------- #

CREATE TABLE `menu_category` (
    `menu_category_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `menu_type` VARCHAR(255),
    `description` TEXT,
    CONSTRAINT `PK_menu_category` PRIMARY KEY (`menu_category_id`)
);

# ---------------------------------------------------------------------- #
# Add table "menu"                                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE `menu` (
    `menu_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `value` VARCHAR(255),
    `description` TEXT,
    `secondary_description` VARCHAR(255),
    `color_class` VARCHAR(255),
    `code` VARCHAR(255),
    `order` INTEGER(11),
    `level` VARCHAR(255),
    `menu_category_id` INTEGER(11),
    CONSTRAINT `PK_menu` PRIMARY KEY (`menu_id`)
);

# ---------------------------------------------------------------------- #
# Add table "menu_subcategory"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE `menu_subcategory` (
    `menu_subcategory_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `value` VARCHAR(255),
    `description` TEXT,
    `secondary_description` VARCHAR(255),
    `color_class` VARCHAR(255),
    `code` VARCHAR(255),
    `order` INTEGER(11),
    `level` VARCHAR(255),
    `menu_id` INTEGER(11),
    CONSTRAINT `PK_menu_subcategory` PRIMARY KEY (`menu_subcategory_id`)
);

# ---------------------------------------------------------------------- #
# Add table "menu_deep_subcategory"                                      #
# ---------------------------------------------------------------------- #

CREATE TABLE `menu_deep_subcategory` (
    `menu_deep_subcategory_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `value` VARCHAR(255),
    `description` TEXT,
    `secondary_description` VARCHAR(255),
    `color_class` VARCHAR(255),
    `code` VARCHAR(255),
    `order` INTEGER(11),
    `level` VARCHAR(255),
    `menu_subcategory_id` INTEGER(11),
    CONSTRAINT `PK_menu_deep_subcategory` PRIMARY KEY (`menu_deep_subcategory_id`)
);

# ---------------------------------------------------------------------- #
# Add table "user_preference"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE `user_preference` (
    `user_preference_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `menu_id` INTEGER(11),
    `name` VARCHAR(255),
    `value` VARCHAR(255),
    `notify` INTEGER(11),
    `user_preference_category_id` INTEGER(11),
    `user_id` INTEGER(11),
    CONSTRAINT `PK_user_preference` PRIMARY KEY (`user_preference_id`)
);

# ---------------------------------------------------------------------- #
# Add table "user_preference_category"                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `user_preference_category` (
    `user_preference_category_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `menu_category_id` INTEGER(11),
    `name` VARCHAR(255),
    CONSTRAINT `PK_user_preference_category` PRIMARY KEY (`user_preference_category_id`)
);

# ---------------------------------------------------------------------- #
# Add table "type_of_improvement"                                        #
# ---------------------------------------------------------------------- #

CREATE TABLE `type_of_improvement` (
    `type_of_improvement_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `type_of_improvement` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_type_of_improvement` PRIMARY KEY (`type_of_improvement_id`)
);

# ---------------------------------------------------------------------- #
# Add table "benefits_breakdown"                                         #
# ---------------------------------------------------------------------- #

CREATE TABLE `benefits_breakdown` (
    `benefits_breakdown_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `item_id` INTEGER(11),
    `description` TEXT,
    `unit_cost` VARCHAR(255),
    `volume` VARCHAR(255),
    `subtotal` VARCHAR(255),
    `status` VARCHAR(255),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_benefits_breakdown` PRIMARY KEY (`benefits_breakdown_id`)
);

# ---------------------------------------------------------------------- #
# Add table "cost_breakdown"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE `cost_breakdown` (
    `cost_breakdown_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `item_id` INTEGER(11),
    `description` TEXT,
    `estimated_unit_cost` VARCHAR(255),
    `estimated_volume` VARCHAR(255),
    `estimated_subtotal` VARCHAR(255),
    `status` VARCHAR(255),
    `actual_unit_cost` VARCHAR(255),
    `actual_volume` VARCHAR(255),
    `actual_subtotal` VARCHAR(255),
    `supplier` VARCHAR(255),
    `due_date_on_platform` DATE,
    `waiting_status` INTEGER(11),
    `po_number` VARCHAR(255),
    `component_location` VARCHAR(255),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_cost_breakdown` PRIMARY KEY (`cost_breakdown_id`)
);

# ---------------------------------------------------------------------- #
# Add table "prerequisite"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `prerequisite` (
    `prerequisite_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `description` TEXT,
    `document_id` INTEGER(11),
    CONSTRAINT `PK_prerequisite` PRIMARY KEY (`prerequisite_id`)
);

# ---------------------------------------------------------------------- #
# Add table "dependency"                                                 #
# ---------------------------------------------------------------------- #

CREATE TABLE `dependency` (
    `dependency_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `description` TEXT,
    `document_id` INTEGER(11),
    CONSTRAINT `PK_dependency` PRIMARY KEY (`dependency_id`)
);

# ---------------------------------------------------------------------- #
# Add table "enabler"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `enabler` (
    `enabler_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `specialist_requirement_id` INTEGER(11),
    `commitment_id` INTEGER(11),
    `description` TEXT,
    `due_date` DATE,
    `responsible` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_enabler` PRIMARY KEY (`enabler_id`)
);

# ---------------------------------------------------------------------- #
# Add table "constraints"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `constraints` (
    `constraints_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `constraints` TEXT,
    `mitigating_action` TEXT,
    `action_party` TEXT,
    `document_id` INTEGER(11),
    CONSTRAINT `PK_constraints` PRIMARY KEY (`constraints_id`)
);

# ---------------------------------------------------------------------- #
# Add table "next_step"                                                  #
# ---------------------------------------------------------------------- #

CREATE TABLE `next_step` (
    `next_step_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `process_step` TEXT,
    `responsible` TEXT,
    `document_id` INTEGER(11),
    CONSTRAINT `PK_next_step` PRIMARY KEY (`next_step_id`)
);

# ---------------------------------------------------------------------- #
# Add table "maintenance_activity"                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE `maintenance_activity` (
    `maintenance_activity_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `activity_id` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_maintenance_activity` PRIMARY KEY (`maintenance_activity_id`)
);

# ---------------------------------------------------------------------- #
# Add table "test_process"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `test_process` (
    `test_process_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `event` TEXT,
    `responsible` TEXT,
    `document_id` INTEGER(11),
    CONSTRAINT `PK_test_process` PRIMARY KEY (`test_process_id`)
);

# ---------------------------------------------------------------------- #
# Add table "rate_of_success"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE `rate_of_success` (
    `rate_of_success_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `area_of_impact_id` INTEGER(11),
    `result_id` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_rate_of_success` PRIMARY KEY (`rate_of_success_id`)
);

# ---------------------------------------------------------------------- #
# Add table "technical_bulletin"                                         #
# ---------------------------------------------------------------------- #

CREATE TABLE `technical_bulletin` (
    `technical_bulletin_id` INTEGER NOT NULL AUTO_INCREMENT,
    `author` VARCHAR(255),
    `date` DATETIME,
    `purpose` TEXT,
    `relevance` TEXT,
    `summary_of_events` TEXT,
    `recommendations` TEXT,
    `next_steps` TEXT,
    `upload_1_filename` VARCHAR(255),
    `upload_2_filename` VARCHAR(255),
    `upload_3_filename` VARCHAR(255),
    `upload_4_filename` VARCHAR(255),
    `upload_5_filename` VARCHAR(255),
    `upload_6_filename` VARCHAR(255),
    `upload_1_caption` TEXT,
    `upload_2_caption` TEXT,
    `upload_3_caption` TEXT,
    `upload_4_caption` TEXT,
    `upload_5_caption` TEXT,
    `upload_6_caption` TEXT,
    `step_0_completed` VARCHAR(40),
    `document_id` INTEGER(11) NOT NULL,
    CONSTRAINT `PK_technical_bulletin` PRIMARY KEY (`technical_bulletin_id`)
);

# ---------------------------------------------------------------------- #
# Add table "document_ranking"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE `document_ranking` (
    `document_ranking_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `ranking` INTEGER(11),
    `ranking_like` INTEGER(11),
    `ranking_comment` TEXT,
    `user_id` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_document_ranking` PRIMARY KEY (`document_ranking_id`)
);

# ---------------------------------------------------------------------- #
# Add table "notification"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `notification` (
    `notification_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `controller` VARCHAR(255),
    `table_name` VARCHAR(255),
    `email_subject` VARCHAR(255),
    `email_form_name` VARCHAR(255),
    `user_notification_column_name` VARCHAR(255),
    `notification_category_id` INTEGER(11),
    CONSTRAINT `PK_notification` PRIMARY KEY (`notification_id`)
);

# ---------------------------------------------------------------------- #
# Add table "notification_category"                                      #
# ---------------------------------------------------------------------- #

CREATE TABLE `notification_category` (
    `notification_category_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `description` TEXT,
    CONSTRAINT `PK_notification_category` PRIMARY KEY (`notification_category_id`)
);

# ---------------------------------------------------------------------- #
# Add table "erp"                                                        #
# ---------------------------------------------------------------------- #

CREATE TABLE `erp` (
    `erp_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `repair_criticality_id` INTEGER(11),
    `date_of_raised` DATE,
    `criticality_justification_id` INTEGER(11),
    `date_required_on_board` DATE,
    `work_order_number` VARCHAR(255),
    `equipment_repair_history` TEXT,
    `asset_type_id` INTEGER(11),
    `justification_id` INTEGER(11),
    `step_0_completed` VARCHAR(255),
    `to` INTEGER(11),
    `cc` INTEGER(11),
    `current_status` INTEGER(11),
    `date_of_issue` DATETIME,
    `message_board_summary` TEXT,
    `quality_control_summary` TEXT,
    `pass_or_fail` TEXT,
    `findings` TEXT,
    `summary` TEXT,
    `recommendations` TEXT,
    `notes` TEXT,
    `step_1_completed` VARCHAR(255),
    `step_2_completed` VARCHAR(255),
    `step_3_completed` VARCHAR(255),
    `step_4_completed` VARCHAR(255),
    `document_id` INTEGER(11) NOT NULL,
    CONSTRAINT `PK_erp` PRIMARY KEY (`erp_id`)
);

# ---------------------------------------------------------------------- #
# Add table "witness_statement"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE `witness_statement` (
    `witness_statement_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `time` DATETIME,
    `date` DATETIME,
    `conducted_by` VARCHAR(255),
    `conducted_email` VARCHAR(255),
    `recorded_by` VARCHAR(255),
    `recorded_email` VARCHAR(255),
    `witness_name` VARCHAR(255),
    `witness_email` VARCHAR(255),
    `accompanied_by` VARCHAR(255),
    `accompanied_email` VARCHAR(255),
    `witness_position` VARCHAR(255),
    `employer` VARCHAR(255),
    `witness_nickname` VARCHAR(255),
    `witness_street_1` TEXT,
    `witness_street_2` TEXT,
    `witness_city` VARCHAR(255),
    `witness_country` VARCHAR(255),
    `witness_postal_code` VARCHAR(40),
    `incident_title` VARCHAR(255),
    `incident_number` VARCHAR(255),
    `incident_description` TEXT,
    `statement` TEXT,
    `signature` TEXT,
    `step_0_completed` VARCHAR(255),
    `document_id` INTEGER(11) NOT NULL,
    CONSTRAINT `PK_witness_statement` PRIMARY KEY (`witness_statement_id`)
);

# ---------------------------------------------------------------------- #
# Add table "responsible_party"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE `responsible_party` (
    `responsible_party_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `role_id` INTEGER(11),
    `name_id` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_responsible_party` PRIMARY KEY (`responsible_party_id`)
);

# ---------------------------------------------------------------------- #
# Add table "interested_party"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE `interested_party` (
    `interested_party_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `role_id` INTEGER(11),
    `name_id` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_interested_party` PRIMARY KEY (`interested_party_id`)
);

# ---------------------------------------------------------------------- #
# Add table "organisation"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `organisation` (
    `organisation_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `role` VARCHAR(255),
    `mobile` VARCHAR(255),
    `email` VARCHAR(255),
    `commitment` VARCHAR(255),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_organisation` PRIMARY KEY (`organisation_id`)
);

# ---------------------------------------------------------------------- #
# Add table "reporting"                                                  #
# ---------------------------------------------------------------------- #

CREATE TABLE `reporting` (
    `reporting_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `originator` VARCHAR(255),
    `receiver` VARCHAR(255),
    `frequency_id` INTEGER(11),
    `format_id` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_reporting` PRIMARY KEY (`reporting_id`)
);

# ---------------------------------------------------------------------- #
# Add table "meeting"                                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `meeting` (
    `meeting_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `attendees` TEXT,
    `agenda` TEXT,
    `frequency_id` INTEGER(11),
    `location` TEXT,
    `document_id` INTEGER(11),
    CONSTRAINT `PK_meeting` PRIMARY KEY (`meeting_id`)
);

# ---------------------------------------------------------------------- #
# Add table "expectation"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `expectation` (
    `expectation_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `supplier` VARCHAR(255),
    `input` TEXT,
    `process_deliverable` TEXT,
    `output` TEXT,
    `receiver` VARCHAR(255),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_expectation` PRIMARY KEY (`expectation_id`)
);

# ---------------------------------------------------------------------- #
# Add table "deliverable"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `deliverable` (
    `deliverable_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `description` TEXT,
    `due_date` DATETIME,
    `location` VARCHAR(255),
    `responsible` INTEGER,
    `document_id` INTEGER(11),
    CONSTRAINT `PK_deliverable` PRIMARY KEY (`deliverable_id`)
);

# ---------------------------------------------------------------------- #
# Add table "action_log"                                                 #
# ---------------------------------------------------------------------- #

CREATE TABLE `action_log` (
    `action_log_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `action` TEXT,
    `action_party` VARCHAR(255),
    `due_date` DATETIME,
    `status_id` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_action_log` PRIMARY KEY (`action_log_id`)
);

# ---------------------------------------------------------------------- #
# Add table "follow_user"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `follow_user` (
    `follow_user_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `user_id` INTEGER(11),
    `followed_user_id` INTEGER(11),
    CONSTRAINT `PK_follow_user` PRIMARY KEY (`follow_user_id`)
);

# ---------------------------------------------------------------------- #
# Add table "milestone"                                                  #
# ---------------------------------------------------------------------- #

CREATE TABLE `milestone` (
    `milestone_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `event` VARCHAR(255),
    `milestone_date` DATETIME,
    `milestone_status` INTEGER,
    `document_id` INTEGER(11),
    CONSTRAINT `PK_milestone` PRIMARY KEY (`milestone_id`)
);

# ---------------------------------------------------------------------- #
# Add table "process_step"                                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `process_step` (
    `process_step_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `event` TEXT,
    `responsible` TEXT,
    `document_id` INTEGER(11),
    CONSTRAINT `PK_process_step` PRIMARY KEY (`process_step_id`)
);

# ---------------------------------------------------------------------- #
# Add table "quality_control_step"                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE `quality_control_step` (
    `quality_control_step_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `event` TEXT,
    `responsible` TEXT,
    `document_id` INTEGER(11),
    CONSTRAINT `PK_quality_control_step` PRIMARY KEY (`quality_control_step_id`)
);

# ---------------------------------------------------------------------- #
# Add table "action_tracker"                                             #
# ---------------------------------------------------------------------- #

CREATE TABLE `action_tracker` (
    `action_tracker_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `reference` VARBINARY(255),
    `action_process_step` INTEGER(11),
    `status` INTEGER(11),
    `owner` INTEGER(11),
    `due_date` DATETIME,
    `duration` TEXT,
    `comments` TEXT,
    `category` INTEGER(11),
    `entry_date` DATE,
    `last_update` DATETIME,
    `improvement_type` INTEGER(11),
    `location` INTEGER(11),
    `pg` VARCHAR(255),
    `re` VARCHAR(255),
    `de` DECIMAL,
    `pp` DECIMAL,
    `tb` DECIMAL,
    `notification_status` INTEGER(11),
    `author` INTEGER(11),
    `reply` VARCHAR(255),
    `proposed_date` DATE,
    `due_date_notification_sent` INTEGER(11),
    `change_status` INTEGER(11),
    `document_id` INTEGER(11),
    `critical_equipment_id` INTEGER(11),
    CONSTRAINT `PK_action_tracker` PRIMARY KEY (`action_tracker_id`)
);

# ---------------------------------------------------------------------- #
# Add table "technical_query"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE `technical_query` (
    `technical_query_id` INTEGER NOT NULL AUTO_INCREMENT,
    `technical_query_date` DATE,
    `question` TEXT,
    `upload_1_filename` VARCHAR(40),
    `upload_2_filename` VARCHAR(40),
    `upload_3_filename` VARCHAR(40),
    `upload_1_caption` TEXT,
    `upload_2_caption` TEXT,
    `upload_3_caption` TEXT,
    `step_0_completed` VARCHAR(40),
    `document_id` INTEGER NOT NULL,
    CONSTRAINT `PK_technical_query` PRIMARY KEY (`technical_query_id`)
);

# ---------------------------------------------------------------------- #
# Add table "document_status"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE `document_status` (
    `document_status_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `status` INTEGER(11),
    `document_status_name` VARCHAR(255),
    `status_initiator` INTEGER(11),
    `status_date` VARCHAR(255),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_document_status` PRIMARY KEY (`document_status_id`)
);

# ---------------------------------------------------------------------- #
# Add table "weekly_plan"                                                #
# ---------------------------------------------------------------------- #

CREATE TABLE `weekly_plan` (
    `weekly_plan_id` INTEGER NOT NULL AUTO_INCREMENT,
    `work_order` TEXT,
    `job_description` TEXT,
    `specialist_requirement` INTEGER,
    `date` DATETIME,
    `comments` TEXT,
    `status` INTEGER,
    `category` INTEGER(11),
    `user_id` INTEGER(11),
    CONSTRAINT `PK_weekly_plan` PRIMARY KEY (`weekly_plan_id`)
);

# ---------------------------------------------------------------------- #
# Add table "hired_equipment_register"                                   #
# ---------------------------------------------------------------------- #

CREATE TABLE `hired_equipment_register` (
    `hired_equipment_register_id` INTEGER NOT NULL AUTO_INCREMENT,
    `po_number` INTEGER,
    `equipment` VARCHAR(255),
    `on_hire_to` TEXT,
    `quantity` VARCHAR(255),
    `duration` VARCHAR(255),
    `cost` VARCHAR(255),
    `total` VARCHAR(255),
    `status` INTEGER,
    `owner` INTEGER,
    `off_hire_due_date` DATETIME,
    `user_id` INTEGER(11),
    CONSTRAINT `PK_hired_equipment_register` PRIMARY KEY (`hired_equipment_register_id`)
);

# ---------------------------------------------------------------------- #
# Add table "criticality_analysis"                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE `criticality_analysis` (
    `criticality_analysis_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `asset` INTEGER,
    `tag_number` VARCHAR(255),
    `description` TEXT,
    `code` VARCHAR(255),
    `group` VARCHAR(255),
    `last_review_date` INTEGER(11),
    `category` INTEGER(11),
    `reliability_redundancy` INTEGER(11),
    `safety_health_criticality` INTEGER(11),
    `environmental_criticality` INTEGER(11),
    `operational_criticality` INTEGER(11),
    `reinstatement` INTEGER(11),
    `status` INTEGER(11),
    `cas` INTEGER(11),
    `frequency` INTEGER(11),
    `alert` INTEGER(11),
    `spf` INTEGER(11),
    `obs` INTEGER(11),
    `cv` VARCHAR(40),
    `hours` VARCHAR(255),
    `availability` INTEGER(11),
    `sis_id` INTEGER(11),
    `performance_standard` VARCHAR(255),
    `unit_currently_available` VARCHAR(255),
    `resultant_availability` VARCHAR(255),
    `compliant` VARCHAR(255),
    `defect_elimination` INTEGER(11),
    `project_plan` INTEGER(11),
    `technical_bulletin` INTEGER(11),
    `failure_rate` VARCHAR(255),
    `mtbf` VARCHAR(255),
    `mttr` VARCHAR(255),
    `fail_date` DATETIME,
    `repair_date` DATETIME,
    `estimated_repair_time` VARCHAR(255),
    `actual_repair_time` VARCHAR(255),
    `user_id` INTEGER(11),
    CONSTRAINT `PK_criticality_analysis` PRIMARY KEY (`criticality_analysis_id`)
);

# ---------------------------------------------------------------------- #
# Add table "criticality_analysis_history"                               #
# ---------------------------------------------------------------------- #

CREATE TABLE `criticality_analysis_history` (
    `criticality_analysis_history_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `day` VARCHAR(255),
    `month` VARCHAR(255),
    `year` VARCHAR(255),
    `day_spf` INTEGER(11),
    `day_obs` INTEGER(11),
    `day_availability` INTEGER(11),
    `day_status` INTEGER(11),
    `hours` VARCHAR(255),
    `day_cv` VARCHAR(255),
    `criticality_analysis_id` INTEGER(11),
    CONSTRAINT `PK_criticality_analysis_history` PRIMARY KEY (`criticality_analysis_history_id`)
);

# ---------------------------------------------------------------------- #
# Add table "criticality_analysis_category"                              #
# ---------------------------------------------------------------------- #

CREATE TABLE `criticality_analysis_category` (
    `criticality_analysis_category_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `criticality_analysis_id` INTEGER(11),
    `menu_id` INTEGER(11),
    CONSTRAINT `PK_criticality_analysis_category` PRIMARY KEY (`criticality_analysis_category_id`)
);

# ---------------------------------------------------------------------- #
# Add table "equipment_history_category_answer"                          #
# ---------------------------------------------------------------------- #

CREATE TABLE `equipment_history_category_answer` (
    `equipment_history_category_answer_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `answer` INTEGER(11),
    `equipment_history_category_id` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_equipment_history_category_answer` PRIMARY KEY (`equipment_history_category_answer_id`)
);

# ---------------------------------------------------------------------- #
# Add table "subaction_tracker"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE `subaction_tracker` (
    `subaction_tracker_id` INTEGER(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `subaction_entry_date` DATE,
    `subaction_improvement_type` INTEGER(11),
    `subaction_process_step` VARCHAR(255),
    `subaction_status` INTEGER(11),
    `subaction_reference` VARCHAR(255),
    `subaction_owner` INTEGER(11),
    `subaction_location` INTEGER(11),
    `subaction_group` INTEGER,
    `subaction_due_date` DATE,
    `subaction_progress` INTEGER,
    `subaction_comments` VARCHAR(255),
    `document_id` INTEGER(11),
    `author` INTEGER(11),
    `reply` VARCHAR(255),
    `proposed_date` DATE,
    `action_tracker_id` INTEGER(11),
    CONSTRAINT `PK_subaction_tracker` PRIMARY KEY (`subaction_tracker_id`)
);

# ---------------------------------------------------------------------- #
# Add table "mcdr"                                                       #
# ---------------------------------------------------------------------- #

CREATE TABLE `mcdr` (
    `mcdr_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `installation` VARCHAR(255),
    `id_tag_line_no` VARCHAR(255),
    `maximo_wo_no` VARCHAR(255),
    `date_reported` DATE,
    `module` VARCHAR(255),
    `pressure_design` VARCHAR(40),
    `pressure_operating` VARCHAR(40),
    `temp_design` VARCHAR(40),
    `temp_operating` VARCHAR(40),
    `flow_design` VARCHAR(40),
    `flow_operating` VARCHAR(40),
    `location` VARCHAR(40),
    `system` VARCHAR(40),
    `safety_critical` VARCHAR(40),
    `mcdr_raised_by` VARCHAR(40),
    `date_of_last_inspection` VARCHAR(40),
    `estimated_time_of_service` VARCHAR(40),
    `other_mcdr` VARCHAR(40),
    `ps_no` VARCHAR(40),
    `process` VARCHAR(40),
    `related_reports` VARCHAR(40),
    `material_type` VARCHAR(40),
    `component_size` VARCHAR(40),
    `schedule` VARCHAR(40),
    `nwt` VARCHAR(40),
    `dca` VARCHAR(40),
    `ps_mawt` VARCHAR(40),
    `equipment_type` VARCHAR(40),
    `component` VARCHAR(40),
    `area_on_component` VARCHAR(40),
    `coating_system_details` VARCHAR(40),
    `insulated_class` VARCHAR(40),
    `degradation_type` VARCHAR(40),
    `degradation_mechanism` VARCHAR(40),
    `pitting_depth` VARCHAR(40),
    `extent` VARCHAR(40),
    `area` VARCHAR(40),
    `mrwt` VARCHAR(40),
    `corrosion_grading` VARCHAR(40),
    `other_remarks` VARCHAR(40),
    `leak` VARCHAR(40),
    `deferment` VARCHAR(40),
    `added_to_mcdr_register` VARCHAR(40),
    `temp_repair_applied` VARCHAR(40),
    `type_of_repair` VARCHAR(40),
    `leaking` VARCHAR(40),
    `temp_repair_reg_no` VARCHAR(40),
    `remedial_action_type` VARCHAR(40),
    `fabric_maint_priority` VARCHAR(40),
    `target_close_out_date` VARCHAR(40),
    `drawings_pid_etc` VARCHAR(40),
    `mcdr_additional_info` VARCHAR(40),
    `maint_superintendent` VARCHAR(40),
    `oie_integrity_coordinator_recommendation` VARCHAR(40),
    `oie_integrity_coordinator` VARCHAR(40),
    `oie_integrity_date` VARCHAR(40),
    `technical_authority_recommendation` VARCHAR(40),
    `technical_authority` VARCHAR(40),
    `technical_authority_date` VARCHAR(40),
    `closed_out` VARCHAR(40),
    `closed_out_coordinator` VARCHAR(40),
    `closed_out_date` VARCHAR(40),
    `step_0_completed` VARCHAR(255),
    `step_1_completed` VARCHAR(255),
    `step_2_completed` VARCHAR(255),
    `step_3_completed` VARCHAR(255),
    `step_4_completed` VARCHAR(255),
    `step_5_completed` VARCHAR(255),
    `step_6_completed` VARCHAR(255),
    `can_location` VARCHAR(255),
    `can_date` VARCHAR(255),
    `can_job_no` VARCHAR(255),
    `can_report_no` VARCHAR(255),
    `client_order_no` VARCHAR(255),
    `can_sheet` VARCHAR(255),
    `can_sheet_of` VARCHAR(255),
    `component_description_drawing` VARCHAR(255),
    `material` VARCHAR(255),
    `procedure_work_instruction` VARCHAR(255),
    `equipment_make_model` VARCHAR(255),
    `probe_type_frequency` VARCHAR(255),
    `couplant` VARCHAR(255),
    `surface_condition` VARCHAR(255),
    `acceptance_standard` VARCHAR(255),
    `material_serial_no` VARCHAR(255),
    `test_blocks` VARCHAR(255),
    `calibration_range` VARCHAR(255),
    `can_results` VARCHAR(255),
    `associative_reports` VARCHAR(255),
    `can_feature` VARCHAR(255),
    `can_type` VARCHAR(255),
    `can_scan` VARCHAR(255),
    `can_min` VARCHAR(255),
    `can_min_location` VARCHAR(255),
    `can_line_number` VARCHAR(255),
    `can_inspector_sign` VARCHAR(255),
    `can_inspector_name` VARCHAR(255),
    `can_inspector_quals` VARCHAR(255),
    `issuing_authority_sign` VARCHAR(255),
    `issuing_authority_name` VARCHAR(255),
    `issuing_authority_date` VARCHAR(255),
    `client_sign` VARCHAR(255),
    `client_name` VARCHAR(255),
    `client_date` VARCHAR(255),
    `cont_location` VARCHAR(255),
    `cont_job_no` VARCHAR(255),
    `cont_client_no` VARCHAR(255),
    `cont_report_no` VARCHAR(255),
    `cont_sheet` VARCHAR(255),
    `cont_sheet_of` VARCHAR(255),
    `cont_component_description` VARCHAR(255),
    `cont_image_caption` VARCHAR(255),
    `cont_inspector_sign` VARCHAR(255),
    `cont_inspector_name` VARCHAR(255),
    `cont_inspector_quals` VARCHAR(255),
    `cont_issuing_authority_sign` VARCHAR(255),
    `cont_issuing_authority_name` VARCHAR(255),
    `cont_issuing_authority_date` VARCHAR(255),
    `cont_client_sign` VARCHAR(255),
    `cont_client_name` VARCHAR(255),
    `cont_client_date` VARCHAR(255),
    `module_plot_plan` VARCHAR(255),
    `pid_iso` VARCHAR(255),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_mcdr` PRIMARY KEY (`mcdr_id`)
);

# ---------------------------------------------------------------------- #
# Add table "moc"                                                        #
# ---------------------------------------------------------------------- #

CREATE TABLE `moc` (
    `moc_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `rm_no` VARCHAR(40),
    `rev` VARCHAR(40),
    `moc_date` VARCHAR(40),
    `priority` VARCHAR(40),
    `rm_title` VARCHAR(40),
    `name originator` VARCHAR(40),
    `description_of_the_modification` VARCHAR(40),
    `shutdown_required` VARCHAR(40),
    `shutdown_type` VARCHAR(40),
    `justification` VARCHAR(40),
    `justification_type` VARCHAR(40),
    `attached_information` VARCHAR(40),
    `oim` VARCHAR(40),
    `sign` VARCHAR(40),
    `oim_date` VARCHAR(40),
    `oim_reason` VARCHAR(40),
    `rm_execution_through` VARCHAR(40),
    `engineering_by` VARCHAR(40),
    `procurement_by` VARCHAR(40),
    `manufactured_by` VARCHAR(40),
    `installation_by` VARCHAR(40),
    `pm_pe_hrs` VARCHAR(40),
    `pm_pe_usd` VARCHAR(40),
    `planning_hrs` VARCHAR(40),
    `planning_usd` VARCHAR(40),
    `flights_expenses_hrs` VARCHAR(40),
    `flights_expenses_usd` VARCHAR(40),
    `design_hrs` VARCHAR(40),
    `design_usd` VARCHAR(40),
    `owp_preparation_hrs` VARCHAR(40),
    `owp_preparation_usd` VARCHAR(40),
    `material_1_hrs` VARCHAR(40),
    `material_2_hrs` VARCHAR(40),
    `material_3_hrs` VARCHAR(40),
    `material_1_usd` VARCHAR(40),
    `material_2_usd` VARCHAR(40),
    `material_3_usd` VARCHAR(40),
    `offshore_work_execution_hrs` VARCHAR(40),
    `offshore_work_execution_usd` VARCHAR(40),
    `installation_down_time_hrs` VARCHAR(40),
    `installation_down_time_usd` VARCHAR(40),
    `contingency_hrs` VARCHAR(40),
    `contingency_usd` VARCHAR(40),
    `totals_hrs` VARCHAR(40),
    `totals_usd` VARCHAR(40),
    `cost_recoverable_from_client` VARCHAR(40),
    `safety_review_requirement` VARCHAR(40),
    `hazid_hira_requirement` VARCHAR(40),
    `hazop_requirement` VARCHAR(40),
    `safety_case_impact_requirement` VARCHAR(40),
    `sil_review_requirement` VARCHAR(40),
    `fmea_eta_fta_requirement` VARCHAR(40),
    `flag_state_requirement` VARCHAR(40),
    `verification_body_requirement` VARCHAR(40),
    `class_society_requirement` VARCHAR(40),
    `coastal_government_requirement` VARCHAR(40),
    `client_requirement` VARCHAR(40),
    `others_1_requirement` VARCHAR(40),
    `others_2_requirement` VARCHAR(40),
    `others_3_requirement` VARCHAR(40),
    `safety_review_rp` VARCHAR(40),
    `hazid_hira_rp` VARCHAR(40),
    `hazop_rp` VARCHAR(40),
    `safety_case_impact_rp` VARCHAR(40),
    `sil_review_rp` VARCHAR(40),
    `fmea_eta_fta_rp` VARCHAR(40),
    `flag_state_rp` VARCHAR(40),
    `verification_body_rp` VARCHAR(40),
    `class_society_rp` VARCHAR(40),
    `coastal_government_rp` VARCHAR(40),
    `client_rp` VARCHAR(40),
    `others_1_rp` VARCHAR(40),
    `others_2_rp` VARCHAR(40),
    `others_3_rp` VARCHAR(40),
    `asset_manager` VARCHAR(40),
    `asset_manager_date` VARCHAR(40),
    `hseq_manager` VARCHAR(40),
    `hseq_manager_date` VARCHAR(40),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_moc` PRIMARY KEY (`moc_id`)
);

# ---------------------------------------------------------------------- #
# Add table "remedial_action_tracker"                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `remedial_action_tracker` (
    `remedial_action_tracker_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `asset` INTEGER(11),
    `sce_ref` INTEGER(11),
    `ps_ref` INTEGER(11),
    `rar` INTEGER(11),
    `topic` VARCHAR(20),
    `issue` TEXT,
    `recommendation` TEXT,
    `action` TEXT,
    `status` INTEGER(11),
    `owner` INTEGER(11),
    `due_date` DATE,
    `comments` TEXT,
    CONSTRAINT `PK_remedial_action_tracker` PRIMARY KEY (`remedial_action_tracker_id`)
);

# ---------------------------------------------------------------------- #
# Add table "document_follower"                                          #
# ---------------------------------------------------------------------- #

CREATE TABLE `document_follower` (
    `document_follower_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `document_id` INTEGER(11),
    `user_id` INTEGER(11),
    PRIMARY KEY (`document_follower_id`)
);

# ---------------------------------------------------------------------- #
# Add table "floorplan"                                                  #
# ---------------------------------------------------------------------- #

CREATE TABLE `floorplan` (
    `floorplan_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `description` TEXT,
    `filename` VARCHAR(255),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_floorplan` PRIMARY KEY (`floorplan_id`)
);

# ---------------------------------------------------------------------- #
# Add table "floorplan_detail"                                           #
# ---------------------------------------------------------------------- #

CREATE TABLE `floorplan_detail` (
    `floorplan_detail_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `x_position` VARCHAR(255),
    `y_position` VARCHAR(255),
    `note` TEXT,
    `floorplan_id` INTEGER(11),
    CONSTRAINT `PK_floorplan_detail` PRIMARY KEY (`floorplan_detail_id`)
);

# ---------------------------------------------------------------------- #
# Add table "document_update"                                            #
# ---------------------------------------------------------------------- #

CREATE TABLE `document_update` (
    `document_update_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255),
    `description` TEXT,
    `update_date` DATETIME,
    `document_owner_id` INTEGER(11),
    `document_id` INTEGER(11),
    CONSTRAINT `PK_document_update` PRIMARY KEY (`document_update_id`)
);

# ---------------------------------------------------------------------- #
# Add table "document_update_comment"                                    #
# ---------------------------------------------------------------------- #

CREATE TABLE `document_update_comment` (
    `document_update_comment_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `comment` TEXT,
    `comment_date` DATETIME,
    `document_update_id` INTEGER(11),
    `user_id` INTEGER(11),
    CONSTRAINT `PK_document_update_comment` PRIMARY KEY (`document_update_comment_id`)
);

# ---------------------------------------------------------------------- #
# Add table "document_type"                                              #
# ---------------------------------------------------------------------- #

CREATE TABLE `document_type` (
    `document_type_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `document_code` VARCHAR(255),
    `document_name` VARCHAR(255),
    CONSTRAINT `PK_document_type` PRIMARY KEY (`document_type_id`)
);

# ---------------------------------------------------------------------- #
# Add table "field_storage"                                              #
# ---------------------------------------------------------------------- #

CREATE TABLE `field_storage` (
    `field_storage_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `code` VARCHAR(255),
    CONSTRAINT `PK_field_storage` PRIMARY KEY (`field_storage_id`)
);

# ---------------------------------------------------------------------- #
# Add table "field_storage_item"                                         #
# ---------------------------------------------------------------------- #

CREATE TABLE `field_storage_item` (
    `field_storage_item_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `value` TEXT,
    `field_storage_id` INTEGER(11),
    CONSTRAINT `PK_field_storage_item` PRIMARY KEY (`field_storage_item_id`)
);

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
    `date_created` DATETIME,
    `date_modified` DATETIME,
    `tag_number` VARCHAR(255),
    `subsystem_component` VARCHAR(255),
    `code` VARCHAR(255),
    `quantity` INTEGER(11),
    `conflict` VARCHAR(255),
    `availability` DECIMAL(11,2),
    `rule_set` VARCHAR(255),
    `source_of_information` VARCHAR(255),
    `ce_parent_sce_id` INTEGER(11),
    `ce_group_id` INTEGER(11),
    `load_file_id` INTEGER(11),
    CONSTRAINT `PK_critical_equipment` PRIMARY KEY (`critical_equipment_id`)
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
    `critical_equipment_id` INTEGER(11),
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
    `critical_equipment_id` INTEGER(11),
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
    `ce_id_redundant` INTEGER(11),
    `critical_equipment_id` INTEGER(11),
    CONSTRAINT `PK_ca_redundancy` PRIMARY KEY (`ca_redundancy_id`)
);

# ---------------------------------------------------------------------- #
# Add table "load_file"                                                  #
# ---------------------------------------------------------------------- #

CREATE TABLE `load_file` (
    `load_file_id` INTEGER(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255),
    `filename` VARCHAR(255),
    `date_loaded` DATETIME,
    CONSTRAINT `PK_load_file` PRIMARY KEY (`load_file_id`)
);

# ---------------------------------------------------------------------- #
# Foreign key constraints                                                #
# ---------------------------------------------------------------------- #

ALTER TABLE `document` ADD CONSTRAINT `document_type_document` 
    FOREIGN KEY (`document_type_id`) REFERENCES `document_type` (`document_type_id`);

ALTER TABLE `decf` ADD CONSTRAINT `document_decf` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `timeline` ADD CONSTRAINT `document_timeline` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `equipment_profile` ADD CONSTRAINT `document_equipment_profile` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `failure_impact` ADD CONSTRAINT `document_failure_impact` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `equipment_history_answer` ADD CONSTRAINT `equipment_history_question_equipment_history_answer` 
    FOREIGN KEY (`equipment_history_question_id`) REFERENCES `equipment_history_question` (`equipment_history_question_id`) ON DELETE CASCADE;

ALTER TABLE `equipment_history_answer` ADD CONSTRAINT `document_equipment_history_answer` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `equipment_history_question` ADD CONSTRAINT `equipment_history_category_equipment_history_question` 
    FOREIGN KEY (`equipment_history_category_id`) REFERENCES `equipment_history_category` (`equipment_history_category_id`) ON DELETE CASCADE;

ALTER TABLE `failure_cause` ADD CONSTRAINT `document_failure_cause` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `ofi` ADD CONSTRAINT `document_ofi` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `document_owner` ADD CONSTRAINT `user_document_owner` 
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL;

ALTER TABLE `document_owner` ADD CONSTRAINT `document_document_owner` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `file` ADD CONSTRAINT `document_file` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `file` ADD CONSTRAINT `action_tracker_file` 
    FOREIGN KEY (`action_tracker_id`) REFERENCES `action_tracker` (`action_tracker_id`) ON DELETE CASCADE;

ALTER TABLE `file` ADD CONSTRAINT `subaction_tracker_file` 
    FOREIGN KEY (`subaction_tracker_id`) REFERENCES `subaction_tracker` (`subaction_tracker_id`) ON DELETE CASCADE;

ALTER TABLE `project_plan` ADD CONSTRAINT `document_project_plan` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `menu` ADD CONSTRAINT `menu_category_menu` 
    FOREIGN KEY (`menu_category_id`) REFERENCES `menu_category` (`menu_category_id`) ON DELETE CASCADE;

ALTER TABLE `menu_subcategory` ADD CONSTRAINT `menu_menu_subcategory` 
    FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE;

ALTER TABLE `menu_deep_subcategory` ADD CONSTRAINT `menu_subcategory_menu_deep_subcategory` 
    FOREIGN KEY (`menu_subcategory_id`) REFERENCES `menu_subcategory` (`menu_subcategory_id`) ON DELETE CASCADE;

ALTER TABLE `user_preference` ADD CONSTRAINT `user_preference_category_user_preference` 
    FOREIGN KEY (`user_preference_category_id`) REFERENCES `user_preference_category` (`user_preference_category_id`) ON DELETE CASCADE;

ALTER TABLE `user_preference` ADD CONSTRAINT `user_user_preference` 
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `type_of_improvement` ADD CONSTRAINT `document_type_of_improvement` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `benefits_breakdown` ADD CONSTRAINT `document_benefits_breakdown` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `cost_breakdown` ADD CONSTRAINT `document_cost_breakdown` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `prerequisite` ADD CONSTRAINT `document_prerequisite` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `dependency` ADD CONSTRAINT `document_dependency` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `enabler` ADD CONSTRAINT `document_enabler` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `constraints` ADD CONSTRAINT `document_constraints` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `next_step` ADD CONSTRAINT `document_next_step` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `maintenance_activity` ADD CONSTRAINT `document_maintenance_activity` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `test_process` ADD CONSTRAINT `document_test_process` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `rate_of_success` ADD CONSTRAINT `document_rate_of_success` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `technical_bulletin` ADD CONSTRAINT `document_technical_bulletin` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `document_ranking` ADD CONSTRAINT `user_document_ranking` 
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

ALTER TABLE `document_ranking` ADD CONSTRAINT `document_document_ranking` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `notification` ADD CONSTRAINT `notification_category_notification` 
    FOREIGN KEY (`notification_category_id`) REFERENCES `notification_category` (`notification_category_id`) ON DELETE CASCADE;

ALTER TABLE `erp` ADD CONSTRAINT `document_erp` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `witness_statement` ADD CONSTRAINT `document_witness_statement` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `responsible_party` ADD CONSTRAINT `document_responsible_party` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `interested_party` ADD CONSTRAINT `document_interested_party` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `organisation` ADD CONSTRAINT `document_organisation` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `reporting` ADD CONSTRAINT `document_reporting` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `meeting` ADD CONSTRAINT `document_meeting` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `expectation` ADD CONSTRAINT `document_expectation` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `deliverable` ADD CONSTRAINT `document_deliverable` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `action_log` ADD CONSTRAINT `document_action_log` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `follow_user` ADD CONSTRAINT `user_follow_user` 
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `milestone` ADD CONSTRAINT `document_milestone` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `process_step` ADD CONSTRAINT `document_process_step` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `quality_control_step` ADD CONSTRAINT `document_quality_control_step` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `action_tracker` ADD CONSTRAINT `document_action_tracker` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `action_tracker` ADD CONSTRAINT `critical_equipment_action_tracker` 
    FOREIGN KEY (`critical_equipment_id`) REFERENCES `critical_equipment` (`critical_equipment_id`) ON DELETE CASCADE;

ALTER TABLE `technical_query` ADD CONSTRAINT `document_technical_query` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `document_status` ADD CONSTRAINT `document_document_status` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `weekly_plan` ADD CONSTRAINT `user_weekly_plan` 
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `hired_equipment_register` ADD CONSTRAINT `user_hired_equipment_register` 
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `criticality_analysis` ADD CONSTRAINT `user_criticality_analysis` 
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `criticality_analysis_history` ADD CONSTRAINT `criticality_analysis_criticality_analysis_history` 
    FOREIGN KEY (`criticality_analysis_id`) REFERENCES `criticality_analysis` (`criticality_analysis_id`) ON DELETE CASCADE;

ALTER TABLE `criticality_analysis_category` ADD CONSTRAINT `criticality_analysis_criticality_analysis_category` 
    FOREIGN KEY (`criticality_analysis_id`) REFERENCES `criticality_analysis` (`criticality_analysis_id`) ON DELETE CASCADE;

ALTER TABLE `criticality_analysis_category` ADD CONSTRAINT `menu_criticality_analysis_category` 
    FOREIGN KEY (`menu_id`) REFERENCES `menu` (`menu_id`) ON DELETE SET NULL;

ALTER TABLE `equipment_history_category_answer` ADD CONSTRAINT `document_equipment_history_category_answer` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `subaction_tracker` ADD CONSTRAINT `action_tracker_subaction_tracker` 
    FOREIGN KEY (`action_tracker_id`) REFERENCES `action_tracker` (`action_tracker_id`) ON DELETE CASCADE;

ALTER TABLE `mcdr` ADD CONSTRAINT `document_mcdr` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `moc` ADD CONSTRAINT `document_moc` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `document_follower` ADD CONSTRAINT `document_document_follower` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `document_follower` ADD CONSTRAINT `user_document_follower` 
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `floorplan` ADD CONSTRAINT `document_floorplan` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE SET NULL;

ALTER TABLE `floorplan_detail` ADD CONSTRAINT `floorplan_floorplan_detail` 
    FOREIGN KEY (`floorplan_id`) REFERENCES `floorplan` (`floorplan_id`) ON DELETE CASCADE;

ALTER TABLE `document_update` ADD CONSTRAINT `document_document_update` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `document_update` ADD CONSTRAINT `document_owner_document_update` 
    FOREIGN KEY (`document_owner_id`) REFERENCES `document_owner` (`document_owner_id`) ON DELETE CASCADE;

ALTER TABLE `document_update_comment` ADD CONSTRAINT `document_update_document_update_comment` 
    FOREIGN KEY (`document_update_id`) REFERENCES `document_update` (`document_update_id`) ON DELETE CASCADE;

ALTER TABLE `document_update_comment` ADD CONSTRAINT `user_document_update_comment` 
    FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `field_storage_item` ADD CONSTRAINT `field_storage_field_storage_item` 
    FOREIGN KEY (`field_storage_id`) REFERENCES `field_storage` (`field_storage_id`) ON DELETE CASCADE;

ALTER TABLE `ca_question_category` ADD CONSTRAINT `formula_category_ca_question_category` 
    FOREIGN KEY (`formula_category_id`) REFERENCES `formula_category` (`formula_category_id`) ON DELETE CASCADE;

ALTER TABLE `ca_question` ADD CONSTRAINT `ca_question_category_ca_question` 
    FOREIGN KEY (`ca_question_category_id`) REFERENCES `ca_question_category` (`ca_question_category_id`) ON DELETE CASCADE;

ALTER TABLE `critical_equipment` ADD CONSTRAINT `ce_parent_sce_critical_equipment` 
    FOREIGN KEY (`ce_parent_sce_id`) REFERENCES `ce_parent_sce` (`ce_parent_sce_id`) ON DELETE CASCADE;

ALTER TABLE `critical_equipment` ADD CONSTRAINT `ce_group_critical_equipment` 
    FOREIGN KEY (`ce_group_id`) REFERENCES `ce_group` (`ce_group_id`) ON DELETE CASCADE;

ALTER TABLE `critical_equipment` ADD CONSTRAINT `load_file_critical_equipment` 
    FOREIGN KEY (`load_file_id`) REFERENCES `load_file` (`load_file_id`) ON DELETE CASCADE;

ALTER TABLE `ca_answer` ADD CONSTRAINT `ca_question_ca_answer` 
    FOREIGN KEY (`ca_question_id`) REFERENCES `ca_question` (`ca_question_id`) ON DELETE CASCADE;

ALTER TABLE `ca_answer` ADD CONSTRAINT `ca_q_category_answer_ca_answer` 
    FOREIGN KEY (`ca_q_category_answer_id`) REFERENCES `ca_q_category_answer` (`ca_q_category_answer_id`) ON DELETE CASCADE;

ALTER TABLE `ca_role` ADD CONSTRAINT `critical_equipment_ca_role` 
    FOREIGN KEY (`critical_equipment_id`) REFERENCES `critical_equipment` (`critical_equipment_id`);

ALTER TABLE `ca_q_category_answer` ADD CONSTRAINT `ca_question_category_ca_q_category_answer` 
    FOREIGN KEY (`ca_question_category_id`) REFERENCES `ca_question_category` (`ca_question_category_id`) ON DELETE CASCADE;

ALTER TABLE `ca_q_category_answer` ADD CONSTRAINT `critical_equipment_ca_q_category_answer` 
    FOREIGN KEY (`critical_equipment_id`) REFERENCES `critical_equipment` (`critical_equipment_id`) ON DELETE CASCADE;

ALTER TABLE `formula` ADD CONSTRAINT `formula_category_formula` 
    FOREIGN KEY (`formula_category_id`) REFERENCES `formula_category` (`formula_category_id`) ON DELETE CASCADE;

ALTER TABLE `ca_redundancy` ADD CONSTRAINT `critical_equipment_ca_redundancy` 
    FOREIGN KEY (`critical_equipment_id`) REFERENCES `critical_equipment` (`critical_equipment_id`) ON DELETE CASCADE;
