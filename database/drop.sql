# ---------------------------------------------------------------------- #
# Script generated with: DeZign for Databases v6.1.3                     #
# Target DBMS:           MySQL 5                                         #
# Project file:          iso14224.dez                                    #
# Project name:                                                          #
# Author:                                                                #
# Script type:           Database drop script                            #
# Created on:            2015-02-13 19:16                                #
# ---------------------------------------------------------------------- #


# ---------------------------------------------------------------------- #
# Drop foreign key constraints                                           #
# ---------------------------------------------------------------------- #

ALTER TABLE `document` DROP FOREIGN KEY `document_type_document`;

ALTER TABLE `decf` DROP FOREIGN KEY `document_decf`;

ALTER TABLE `timeline` DROP FOREIGN KEY `document_timeline`;

ALTER TABLE `equipment_profile` DROP FOREIGN KEY `document_equipment_profile`;

ALTER TABLE `failure_impact` DROP FOREIGN KEY `document_failure_impact`;

ALTER TABLE `equipment_history_answer` DROP FOREIGN KEY `equipment_history_question_equipment_history_answer`;

ALTER TABLE `equipment_history_answer` DROP FOREIGN KEY `document_equipment_history_answer`;

ALTER TABLE `equipment_history_question` DROP FOREIGN KEY `equipment_history_category_equipment_history_question`;

ALTER TABLE `failure_cause` DROP FOREIGN KEY `document_failure_cause`;

ALTER TABLE `ofi` DROP FOREIGN KEY `document_ofi`;

ALTER TABLE `document_owner` DROP FOREIGN KEY `user_document_owner`;

ALTER TABLE `document_owner` DROP FOREIGN KEY `document_document_owner`;

ALTER TABLE `file` DROP FOREIGN KEY `document_file`;

ALTER TABLE `file` DROP FOREIGN KEY `action_tracker_file`;

ALTER TABLE `file` DROP FOREIGN KEY `subaction_tracker_file`;

ALTER TABLE `project_plan` DROP FOREIGN KEY `document_project_plan`;

ALTER TABLE `menu` DROP FOREIGN KEY `menu_category_menu`;

ALTER TABLE `menu_subcategory` DROP FOREIGN KEY `menu_menu_subcategory`;

ALTER TABLE `menu_deep_subcategory` DROP FOREIGN KEY `menu_subcategory_menu_deep_subcategory`;

ALTER TABLE `user_preference` DROP FOREIGN KEY `user_preference_category_user_preference`;

ALTER TABLE `user_preference` DROP FOREIGN KEY `user_user_preference`;

ALTER TABLE `type_of_improvement` DROP FOREIGN KEY `document_type_of_improvement`;

ALTER TABLE `benefits_breakdown` DROP FOREIGN KEY `document_benefits_breakdown`;

ALTER TABLE `cost_breakdown` DROP FOREIGN KEY `document_cost_breakdown`;

ALTER TABLE `prerequisite` DROP FOREIGN KEY `document_prerequisite`;

ALTER TABLE `dependency` DROP FOREIGN KEY `document_dependency`;

ALTER TABLE `enabler` DROP FOREIGN KEY `document_enabler`;

ALTER TABLE `constraints` DROP FOREIGN KEY `document_constraints`;

ALTER TABLE `next_step` DROP FOREIGN KEY `document_next_step`;

ALTER TABLE `maintenance_activity` DROP FOREIGN KEY `document_maintenance_activity`;

ALTER TABLE `test_process` DROP FOREIGN KEY `document_test_process`;

ALTER TABLE `rate_of_success` DROP FOREIGN KEY `document_rate_of_success`;

ALTER TABLE `technical_bulletin` DROP FOREIGN KEY `document_technical_bulletin`;

ALTER TABLE `document_ranking` DROP FOREIGN KEY `user_document_ranking`;

ALTER TABLE `document_ranking` DROP FOREIGN KEY `document_document_ranking`;

ALTER TABLE `notification` DROP FOREIGN KEY `notification_category_notification`;

ALTER TABLE `erp` DROP FOREIGN KEY `document_erp`;

ALTER TABLE `witness_statement` DROP FOREIGN KEY `document_witness_statement`;

ALTER TABLE `responsible_party` DROP FOREIGN KEY `document_responsible_party`;

ALTER TABLE `interested_party` DROP FOREIGN KEY `document_interested_party`;

ALTER TABLE `organisation` DROP FOREIGN KEY `document_organisation`;

ALTER TABLE `reporting` DROP FOREIGN KEY `document_reporting`;

ALTER TABLE `meeting` DROP FOREIGN KEY `document_meeting`;

ALTER TABLE `expectation` DROP FOREIGN KEY `document_expectation`;

ALTER TABLE `deliverable` DROP FOREIGN KEY `document_deliverable`;

ALTER TABLE `action_log` DROP FOREIGN KEY `document_action_log`;

ALTER TABLE `follow_user` DROP FOREIGN KEY `user_follow_user`;

ALTER TABLE `milestone` DROP FOREIGN KEY `document_milestone`;

ALTER TABLE `process_step` DROP FOREIGN KEY `document_process_step`;

ALTER TABLE `quality_control_step` DROP FOREIGN KEY `document_quality_control_step`;

ALTER TABLE `action_tracker` DROP FOREIGN KEY `document_action_tracker`;

ALTER TABLE `action_tracker` DROP FOREIGN KEY `criticality_analysis_stage_action_tracker`;

ALTER TABLE `technical_query` DROP FOREIGN KEY `document_technical_query`;

ALTER TABLE `document_status` DROP FOREIGN KEY `document_document_status`;

ALTER TABLE `weekly_plan` DROP FOREIGN KEY `user_weekly_plan`;

ALTER TABLE `hired_equipment_register` DROP FOREIGN KEY `user_hired_equipment_register`;

ALTER TABLE `criticality_analysis` DROP FOREIGN KEY `user_criticality_analysis`;

ALTER TABLE `criticality_analysis_history` DROP FOREIGN KEY `criticality_analysis_criticality_analysis_history`;

ALTER TABLE `criticality_analysis_category` DROP FOREIGN KEY `criticality_analysis_criticality_analysis_category`;

ALTER TABLE `criticality_analysis_category` DROP FOREIGN KEY `menu_criticality_analysis_category`;

ALTER TABLE `equipment_history_category_answer` DROP FOREIGN KEY `document_equipment_history_category_answer`;

ALTER TABLE `subaction_tracker` DROP FOREIGN KEY `action_tracker_subaction_tracker`;

ALTER TABLE `mcdr` DROP FOREIGN KEY `document_mcdr`;

ALTER TABLE `moc` DROP FOREIGN KEY `document_moc`;

ALTER TABLE `document_follower` DROP FOREIGN KEY `document_document_follower`;

ALTER TABLE `document_follower` DROP FOREIGN KEY `user_document_follower`;

ALTER TABLE `floorplan` DROP FOREIGN KEY `document_floorplan`;

ALTER TABLE `floorplan_detail` DROP FOREIGN KEY `floorplan_floorplan_detail`;

ALTER TABLE `document_update` DROP FOREIGN KEY `document_document_update`;

ALTER TABLE `document_update` DROP FOREIGN KEY `document_owner_document_update`;

ALTER TABLE `document_update_comment` DROP FOREIGN KEY `document_update_document_update_comment`;

ALTER TABLE `document_update_comment` DROP FOREIGN KEY `user_document_update_comment`;

ALTER TABLE `field_storage_item` DROP FOREIGN KEY `field_storage_field_storage_item`;

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

ALTER TABLE `ca_redundancy` DROP FOREIGN KEY `critical_equipment_ca_redundancy`;

ALTER TABLE `ca_redundancy` DROP FOREIGN KEY `criticality_analysis_stage_ca_redundancy`;

# ---------------------------------------------------------------------- #
# Drop table "file"                                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `file` MODIFY `file_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `file` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `file`;

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
# Drop table "subaction_tracker"                                         #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `subaction_tracker` MODIFY `subaction_tracker_id` INTEGER(11) UNSIGNED NOT NULL;

# Drop constraints #

ALTER TABLE `subaction_tracker` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `subaction_tracker`;

# ---------------------------------------------------------------------- #
# Drop table "action_tracker"                                            #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `action_tracker` MODIFY `action_tracker_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `action_tracker` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `action_tracker`;

# ---------------------------------------------------------------------- #
# Drop table "equipment_history_answer"                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `equipment_history_answer` MODIFY `equipment_history_answer_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `equipment_history_answer` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `equipment_history_answer`;

# ---------------------------------------------------------------------- #
# Drop table "ca_redundancy"                                             #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `ca_redundancy` MODIFY `ca_redundancy_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `ca_redundancy` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `ca_redundancy`;

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
# Drop table "document_update_comment"                                   #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `document_update_comment` MODIFY `document_update_comment_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `document_update_comment` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `document_update_comment`;

# ---------------------------------------------------------------------- #
# Drop table "document_update"                                           #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `document_update` MODIFY `document_update_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `document_update` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `document_update`;

# ---------------------------------------------------------------------- #
# Drop table "floorplan_detail"                                          #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `floorplan_detail` MODIFY `floorplan_detail_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `floorplan_detail` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `floorplan_detail`;

# ---------------------------------------------------------------------- #
# Drop table "floorplan"                                                 #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `floorplan` MODIFY `floorplan_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `floorplan` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `floorplan`;

# ---------------------------------------------------------------------- #
# Drop table "document_follower"                                         #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `document_follower` MODIFY `document_follower_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `document_follower` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `document_follower`;

# ---------------------------------------------------------------------- #
# Drop table "moc"                                                       #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `moc` MODIFY `moc_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `moc` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `moc`;

# ---------------------------------------------------------------------- #
# Drop table "mcdr"                                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `mcdr` MODIFY `mcdr_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `mcdr` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `mcdr`;

# ---------------------------------------------------------------------- #
# Drop table "equipment_history_category_answer"                         #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `equipment_history_category_answer` MODIFY `equipment_history_category_answer_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `equipment_history_category_answer` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `equipment_history_category_answer`;

# ---------------------------------------------------------------------- #
# Drop table "document_status"                                           #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `document_status` MODIFY `document_status_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `document_status` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `document_status`;

# ---------------------------------------------------------------------- #
# Drop table "technical_query"                                           #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `technical_query` MODIFY `technical_query_id` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `technical_query` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `technical_query`;

# ---------------------------------------------------------------------- #
# Drop table "quality_control_step"                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `quality_control_step` MODIFY `quality_control_step_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `quality_control_step` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `quality_control_step`;

# ---------------------------------------------------------------------- #
# Drop table "process_step"                                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `process_step` MODIFY `process_step_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `process_step` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `process_step`;

# ---------------------------------------------------------------------- #
# Drop table "milestone"                                                 #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `milestone` MODIFY `milestone_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `milestone` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `milestone`;

# ---------------------------------------------------------------------- #
# Drop table "action_log"                                                #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `action_log` MODIFY `action_log_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `action_log` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `action_log`;

# ---------------------------------------------------------------------- #
# Drop table "deliverable"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `deliverable` MODIFY `deliverable_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `deliverable` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `deliverable`;

# ---------------------------------------------------------------------- #
# Drop table "expectation"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `expectation` MODIFY `expectation_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `expectation` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `expectation`;

# ---------------------------------------------------------------------- #
# Drop table "meeting"                                                   #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `meeting` MODIFY `meeting_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `meeting` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `meeting`;

# ---------------------------------------------------------------------- #
# Drop table "reporting"                                                 #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `reporting` MODIFY `reporting_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `reporting` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `reporting`;

# ---------------------------------------------------------------------- #
# Drop table "organisation"                                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `organisation` MODIFY `organisation_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `organisation` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `organisation`;

# ---------------------------------------------------------------------- #
# Drop table "interested_party"                                          #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `interested_party` MODIFY `interested_party_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `interested_party` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `interested_party`;

# ---------------------------------------------------------------------- #
# Drop table "responsible_party"                                         #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `responsible_party` MODIFY `responsible_party_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `responsible_party` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `responsible_party`;

# ---------------------------------------------------------------------- #
# Drop table "witness_statement"                                         #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `witness_statement` MODIFY `witness_statement_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `witness_statement` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `witness_statement`;

# ---------------------------------------------------------------------- #
# Drop table "erp"                                                       #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `erp` MODIFY `erp_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `erp` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `erp`;

# ---------------------------------------------------------------------- #
# Drop table "notification"                                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `notification` MODIFY `notification_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `notification` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `notification`;

# ---------------------------------------------------------------------- #
# Drop table "document_ranking"                                          #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `document_ranking` MODIFY `document_ranking_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `document_ranking` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `document_ranking`;

# ---------------------------------------------------------------------- #
# Drop table "technical_bulletin"                                        #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `technical_bulletin` MODIFY `technical_bulletin_id` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `technical_bulletin` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `technical_bulletin`;

# ---------------------------------------------------------------------- #
# Drop table "rate_of_success"                                           #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `rate_of_success` MODIFY `rate_of_success_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `rate_of_success` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `rate_of_success`;

# ---------------------------------------------------------------------- #
# Drop table "test_process"                                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `test_process` MODIFY `test_process_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `test_process` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `test_process`;

# ---------------------------------------------------------------------- #
# Drop table "maintenance_activity"                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `maintenance_activity` MODIFY `maintenance_activity_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `maintenance_activity` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `maintenance_activity`;

# ---------------------------------------------------------------------- #
# Drop table "next_step"                                                 #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `next_step` MODIFY `next_step_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `next_step` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `next_step`;

# ---------------------------------------------------------------------- #
# Drop table "constraints"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `constraints` MODIFY `constraints_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `constraints` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `constraints`;

# ---------------------------------------------------------------------- #
# Drop table "enabler"                                                   #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `enabler` MODIFY `enabler_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `enabler` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `enabler`;

# ---------------------------------------------------------------------- #
# Drop table "dependency"                                                #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `dependency` MODIFY `dependency_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `dependency` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `dependency`;

# ---------------------------------------------------------------------- #
# Drop table "prerequisite"                                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `prerequisite` MODIFY `prerequisite_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `prerequisite` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `prerequisite`;

# ---------------------------------------------------------------------- #
# Drop table "cost_breakdown"                                            #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `cost_breakdown` MODIFY `cost_breakdown_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `cost_breakdown` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `cost_breakdown`;

# ---------------------------------------------------------------------- #
# Drop table "benefits_breakdown"                                        #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `benefits_breakdown` MODIFY `benefits_breakdown_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `benefits_breakdown` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `benefits_breakdown`;

# ---------------------------------------------------------------------- #
# Drop table "type_of_improvement"                                       #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `type_of_improvement` MODIFY `type_of_improvement_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `type_of_improvement` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `type_of_improvement`;

# ---------------------------------------------------------------------- #
# Drop table "user_preference"                                           #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `user_preference` MODIFY `user_preference_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `user_preference` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `user_preference`;

# ---------------------------------------------------------------------- #
# Drop table "project_plan"                                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `project_plan` MODIFY `project_plan_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `project_plan` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `project_plan`;

# ---------------------------------------------------------------------- #
# Drop table "document_owner"                                            #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `document_owner` MODIFY `document_owner_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `document_owner` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `document_owner`;

# ---------------------------------------------------------------------- #
# Drop table "ofi"                                                       #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `ofi` MODIFY `ofi_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `ofi` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `ofi`;

# ---------------------------------------------------------------------- #
# Drop table "failure_cause"                                             #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `failure_cause` MODIFY `failure_cause_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `failure_cause` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `failure_cause`;

# ---------------------------------------------------------------------- #
# Drop table "equipment_history_question"                                #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `equipment_history_question` MODIFY `equipment_history_question_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `equipment_history_question` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `equipment_history_question`;

# ---------------------------------------------------------------------- #
# Drop table "failure_impact"                                            #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `failure_impact` MODIFY `failure_impact_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `failure_impact` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `failure_impact`;

# ---------------------------------------------------------------------- #
# Drop table "equipment_profile"                                         #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `equipment_profile` MODIFY `equipment_profile_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `equipment_profile` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `equipment_profile`;

# ---------------------------------------------------------------------- #
# Drop table "timeline"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `timeline` MODIFY `timeline_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `timeline` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `timeline`;

# ---------------------------------------------------------------------- #
# Drop table "decf"                                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `decf` MODIFY `decf_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `decf` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `decf`;

# ---------------------------------------------------------------------- #
# Drop table "document"                                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `document` MODIFY `document_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `document` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `document`;

# ---------------------------------------------------------------------- #
# Drop table "inspection_periodicity"                                    #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `inspection_periodicity` MODIFY `inspection_periodicity_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `inspection_periodicity` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `inspection_periodicity`;

# ---------------------------------------------------------------------- #
# Drop table "formula"                                                   #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `formula` MODIFY `formula_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `formula` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `formula`;

# ---------------------------------------------------------------------- #
# Drop table "formula_category"                                          #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `formula_category` MODIFY `formula_category_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `formula_category` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `formula_category`;

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

# ---------------------------------------------------------------------- #
# Drop table "field_storage_item"                                        #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `field_storage_item` MODIFY `field_storage_item_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `field_storage_item` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `field_storage_item`;

# ---------------------------------------------------------------------- #
# Drop table "field_storage"                                             #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `field_storage` MODIFY `field_storage_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `field_storage` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `field_storage`;

# ---------------------------------------------------------------------- #
# Drop table "document_type"                                             #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `document_type` MODIFY `document_type_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `document_type` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `document_type`;

# ---------------------------------------------------------------------- #
# Drop table "remedial_action_tracker"                                   #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `remedial_action_tracker` MODIFY `remedial_action_tracker_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `remedial_action_tracker` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `remedial_action_tracker`;

# ---------------------------------------------------------------------- #
# Drop table "criticality_analysis_category"                             #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `criticality_analysis_category` MODIFY `criticality_analysis_category_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `criticality_analysis_category` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `criticality_analysis_category`;

# ---------------------------------------------------------------------- #
# Drop table "criticality_analysis_history"                              #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `criticality_analysis_history` MODIFY `criticality_analysis_history_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `criticality_analysis_history` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `criticality_analysis_history`;

# ---------------------------------------------------------------------- #
# Drop table "criticality_analysis"                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `criticality_analysis` MODIFY `criticality_analysis_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `criticality_analysis` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `criticality_analysis`;

# ---------------------------------------------------------------------- #
# Drop table "hired_equipment_register"                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `hired_equipment_register` MODIFY `hired_equipment_register_id` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `hired_equipment_register` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `hired_equipment_register`;

# ---------------------------------------------------------------------- #
# Drop table "weekly_plan"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `weekly_plan` MODIFY `weekly_plan_id` INTEGER NOT NULL;

# Drop constraints #

ALTER TABLE `weekly_plan` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `weekly_plan`;

# ---------------------------------------------------------------------- #
# Drop table "follow_user"                                               #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `follow_user` MODIFY `follow_user_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `follow_user` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `follow_user`;

# ---------------------------------------------------------------------- #
# Drop table "notification_category"                                     #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `notification_category` MODIFY `notification_category_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `notification_category` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `notification_category`;

# ---------------------------------------------------------------------- #
# Drop table "user_preference_category"                                  #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `user_preference_category` MODIFY `user_preference_category_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `user_preference_category` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `user_preference_category`;

# ---------------------------------------------------------------------- #
# Drop table "menu_deep_subcategory"                                     #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `menu_deep_subcategory` MODIFY `menu_deep_subcategory_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `menu_deep_subcategory` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `menu_deep_subcategory`;

# ---------------------------------------------------------------------- #
# Drop table "menu_subcategory"                                          #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `menu_subcategory` MODIFY `menu_subcategory_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `menu_subcategory` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `menu_subcategory`;

# ---------------------------------------------------------------------- #
# Drop table "menu"                                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `menu` MODIFY `menu_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `menu` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `menu`;

# ---------------------------------------------------------------------- #
# Drop table "menu_category"                                             #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `menu_category` MODIFY `menu_category_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `menu_category` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `menu_category`;

# ---------------------------------------------------------------------- #
# Drop table "user"                                                      #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `user` MODIFY `user_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `user` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `user`;

# ---------------------------------------------------------------------- #
# Drop table "equipment_history_category"                                #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `equipment_history_category` MODIFY `equipment_history_category_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `equipment_history_category` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `equipment_history_category`;

# ---------------------------------------------------------------------- #
# Drop table "area_of_impact_consequence"                                #
# ---------------------------------------------------------------------- #

# Remove autoinc for PK drop #

ALTER TABLE `area_of_impact_consequence` MODIFY `area_of_impact_consequence_id` INTEGER(11) NOT NULL;

# Drop constraints #

ALTER TABLE `area_of_impact_consequence` DROP PRIMARY KEY;

# Drop table #

DROP TABLE `area_of_impact_consequence`;
