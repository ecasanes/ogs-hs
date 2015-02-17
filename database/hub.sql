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
    `criticality_analysis_id` INTEGER(11),
    CONSTRAINT `PK_action_tracker` PRIMARY KEY (`action_tracker_id`)
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


ALTER TABLE `file` ADD CONSTRAINT `action_tracker_file` 
    FOREIGN KEY (`action_tracker_id`) REFERENCES `action_tracker` (`action_tracker_id`) ON DELETE CASCADE;

ALTER TABLE `file` ADD CONSTRAINT `subaction_tracker_file` 
    FOREIGN KEY (`subaction_tracker_id`) REFERENCES `subaction_tracker` (`subaction_tracker_id`) ON DELETE CASCADE;

ALTER TABLE `action_tracker` ADD CONSTRAINT `document_action_tracker` 
    FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`) ON DELETE CASCADE;

ALTER TABLE `action_tracker` ADD CONSTRAINT `criticality_analysis_stage_action_tracker` 
    FOREIGN KEY (`criticality_analysis_id`) REFERENCES `criticality_analysis_stage` (`criticality_analysis_id`);

ALTER TABLE `subaction_tracker` ADD CONSTRAINT `action_tracker_subaction_tracker` 
    FOREIGN KEY (`action_tracker_id`) REFERENCES `action_tracker` (`action_tracker_id`) ON DELETE CASCADE;