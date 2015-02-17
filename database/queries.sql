/*DEFECT ELIMINATION CASE 
*/------------------------------------------------------------------------------
/*1. - Main Filter (All Actions)*/

	SELECT 
	`at`.`reference`,
	`dt`.`document_name`,
	`at`.`action_process_step`,
	m.`name`,
	CONCAT(
	`u`.`first_name`,
	' ',
	`u`.`last_name`
	),
	DATE_FORMAT(`at`.`due_date`, '%d/%m/%Y') AS `due_date`,
	`at`.`comments` 
	FROM
	action_tracker `at` 
	INNER JOIN document `d` 
	ON `d`.`document_id` = `at`.`document_id` 
	INNER JOIN document_type `dt` 
	ON `dt`.`document_type_id` = `d`.`document_type_id` 
	INNER JOIN menu `m` 
	ON `m`.`menu_id` = `at`.`status` 
	INNER JOIN `user` `u` 
	ON `u`.`user_id` = `at`.`owner` 
	ORDER BY `at`.`due_date` DESC

/*2. Defect Elimination Case File - (N/A)*/

	SELECT 
	`at`.`reference`,
	`dt`.`document_name`,
	`at`.`action_process_step`,
	m.`name`,
	CONCAT(
	`u`.`first_name`,
	' ',
	`u`.`last_name`
	),
	DATE_FORMAT(`at`.`due_date`, '%d/%m/%Y') AS `due_date`,
	`at`.`comments` 
	FROM
	action_tracker `at` 
	INNER JOIN document `d` 
	ON `d`.`document_id` = `at`.`document_id` 
	INNER JOIN document_type `dt` 
	ON `dt`.`document_type_id` = `d`.`document_type_id` AND `dt`.`document_code` = 'basic-decf'
	INNER JOIN menu `m` 
	ON `m`.`menu_id` = `at`.`status` 
	INNER JOIN `user` `u` 
	ON `u`.`user_id` = `at`.`owner` 
	ORDER BY `at`.`due_date` DESC

/*3. Defect Elimination Case File - (Due Now; Less than a week(7))*/

	SELECT 
	  `at`.`reference`,
	  `dt`.`document_name`,
	  `at`.`action_process_step`,
	  m.`name`,
	  CONCAT(
	    `u`.`first_name`,
	    ' ',
	    `u`.`last_name`
	  ) AS `full_name`,
	  DATE_FORMAT(`at`.`due_date`, '%d/%m/%Y') AS `due_date`,
	  `at`.`comments`
	FROM
	  action_tracker `at` 
	  INNER JOIN document `d` 
	    ON `d`.`document_id` = `at`.`document_id` 
	  INNER JOIN document_type `dt` 
	    ON `dt`.`document_type_id` = `d`.`document_type_id` 
	    AND `dt`.`document_code` = 'basic-decf'
	    AND  (SELECT DATEDIFF(`at`.`due_date`, NOW()) AS DiffDate) < 7
	  INNER JOIN menu `m` 
	    ON `m`.`menu_id` = `at`.`status` 
	  INNER JOIN `user` `u` 
	    ON `u`.`user_id` = `at`.`owner` 
	ORDER BY `at`.`due_date` DESC 

/*4. Defect Elimination Case File - (Overdue)*/

	SELECT 
	  `at`.`reference`,
	  `dt`.`document_name`,
	  `at`.`action_process_step`,
	  m.`name`,
	  CONCAT(
	    `u`.`first_name`,
	    ' ',
	    `u`.`last_name`
	  ) AS `full_name`,
	  DATE_FORMAT(`at`.`due_date`, '%d/%m/%Y') AS `due_date`,
	  `at`.`comments`
	FROM
	  action_tracker `at` 
	  INNER JOIN document `d` 
	    ON `d`.`document_id` = `at`.`document_id` 
	  INNER JOIN document_type `dt` 
	    ON `dt`.`document_type_id` = `d`.`document_type_id` 
	    AND `dt`.`document_code` = 'basic-decf'
	    AND  (SELECT DATEDIFF(`at`.`due_date`, NOW()) AS DiffDate) <= 0
	  INNER JOIN menu `m` 
	    ON `m`.`menu_id` = `at`.`status` 
	  INNER JOIN `user` `u` 
	    ON `u`.`user_id` = `at`.`owner` 
	ORDER BY `at`.`due_date` DESC 

/*5.  Defect Elimination Case File - Subsystem*/
	SELECT 
	  `at`.`reference`,
	  `dt`.`document_name`,
	  `at`.`action_process_step`,
	  m.`name`,
	  CONCAT(
	    `u`.`first_name`,
	    ' ',
	    `u`.`last_name`
	  ) AS `full_name`,
	  DATE_FORMAT(`at`.`due_date`, '%d/%m/%Y') AS `due_date`,
	  `at`.`comments`
	FROM
	  action_tracker `at` 
	  INNER JOIN document `d` 
	    ON `d`.`document_id` = `at`.`document_id` 
	  INNER JOIN document_type `dt` 
	    ON `dt`.`document_type_id` = `d`.`document_type_id` 
	    AND `dt`.`document_code` = 'basic-decf' 
	  INNER JOIN menu `m` 
	    ON `m`.`menu_id` = `at`.`status` 
	  INNER JOIN `user` `u` 
	    ON `u`.`user_id` = `at`.`owner` 
	  INNER JOIN equipment_profile ep 
	    ON ep.`document_id` = `at`.`document_id` 
	    AND ep.`system_subcategory_id` = 435 
	ORDER BY `at`.`due_date` DESC 

/*CRITICAL EQUIPTMENT (N/A)*/
------------------------------------------------------------------

SELECT 
  ac_t.`reference`,
  'CF',
  ac_t.`action_process_step`,
  CONCAT(
    `u`.`first_name`,
    ' ',
    `u`.`last_name`
  ) AS `full_name`,
  DATE_FORMAT(ac_t.`due_date`, '%d/%m/%Y') AS `due_date`,
  `ac_t`.`comments` 
FROM
  criticality_analysis ca 
  INNER JOIN action_tracker ac_t 
    ON ac_t.`criticality_analysis` = ca.`criticality_analysis_id` 
  INNER JOIN `user` `u` 
    ON `u`.`user_id` = ac_t.`owner` 

/*CRITICAL EQUIPTMENT (Tag_no)*/
------------------------------------------------------------------

SELECT 
  ac_t.`reference`,
  'CF',
  ac_t.`action_process_step`,
  CONCAT(
    `u`.`first_name`,
    ' ',
    `u`.`last_name`
  ) AS `full_name`,
  DATE_FORMAT(ac_t.`due_date`, '%d/%m/%Y') AS `due_date`,
  `ac_t`.`comments`, ca.`tag_number`
FROM
  criticality_analysis ca 
  INNER JOIN action_tracker ac_t 
    ON ac_t.`criticality_analysis` = ca.`criticality_analysis_id`  
    AND ca.`tag_number` = 'TIF-SIS-FGD- 03'
  INNER JOIN `user` `u` 
    ON `u`.`user_id` = ac_t.`owner` 

/*CRITICAL EQUIPTMENT (Production) - NA */
------------------------------------------------------------------

SELECT 
  ac_t.`reference`,
  'CF',
  ac_t.`action_process_step`,
  CONCAT(
    `u`.`first_name`,
    ' ',
    `u`.`last_name`
  ) AS `full_name`,
  DATE_FORMAT(ac_t.`due_date`, '%d/%m/%Y') AS `due_date`,
  `ac_t`.`comments`,
  ca.`tag_number`, m.`name` AS menu_name, m.`menu_id` AS menu_id
FROM
  criticality_analysis ca 
  INNER JOIN action_tracker ac_t 
    ON ac_t.`criticality_analysis` = ca.`criticality_analysis_id` 
  INNER JOIN `user` `u` 
    ON `u`.`user_id` = ac_t.`owner` 
  INNER JOIN criticality_analysis_category ca_c 
    ON ca_c.`criticality_analysis_id` = ca.`criticality_analysis_id` 
    AND ca_c.`value` = 0 -- or 1 d
  INNER JOIN menu m ON m.`menu_id` = ca_c.`menu_id` 
  AND m.`menu_id` = 520 

/*CRITICAL EQUIPTMENT (Production) Either Yes or No*/
------------------------------------------------------------------

SELECT 
  * 
FROM
  (SELECT 
    `at`.`reference`,
    `dt`.`document_name`,
    `at`.`action_process_step`,
    m.`name`,
    CONCAT(
      `u`.`first_name`,
      ' ',
      `u`.`last_name`
    ) AS full_name,
    DATE_FORMAT(`at`.`due_date`, '%d/%m/%Y') AS `due_date`,
    `at`.`comments` 
  FROM
    action_tracker `at` 
    INNER JOIN document `d` 
      ON `d`.`document_id` = `at`.`document_id` 
    INNER JOIN document_type `dt` 
      ON `dt`.`document_type_id` = `d`.`document_type_id` 
    INNER JOIN menu `m` 
      ON `m`.`menu_id` = `at`.`status` 
    INNER JOIN `user` `u` 
      ON `u`.`user_id` = `at`.`owner` 
  UNION
  ALL 
  SELECT 
    ac_t.`reference`,
    'CF' AS document_name,
    ac_t.`action_process_step`,
    m.`name`,
    CONCAT(
      `u`.`first_name`,
      ' ',
      `u`.`last_name`
    ) AS `full_name`,
    DATE_FORMAT(ac_t.`due_date`, '%d/%m/%Y') AS `due_date`,
    `ac_t`.`comments` 
  FROM
    criticality_analysis ca 
    INNER JOIN action_tracker ac_t 
      ON ac_t.`criticality_analysis` = ca.`criticality_analysis_id` 
    INNER JOIN `user` `u` 
      ON `u`.`user_id` = ac_t.`owner` 
    INNER JOIN menu `m` 
      ON `m`.`menu_id` = `ac_t`.`status`) AS joined_table 
ORDER BY due_date DESC

# ------------------------------------
CREATE TABLE `ce_available_redundancy` (
  `ce_r_id` int(11) NOT NULL AUTO_INCREMENT,
  `critical_equipment_id` int(11) DEFAULT NULL,
  `critical_equipment_id_redundant` int(11) DEFAULT NULL,
  PRIMARY KEY (`ce_r_id`),
  UNIQUE KEY `critical_equipment_id_2` (`critical_equipment_id`,`critical_equipment_id_redundant`),
  KEY `critical_equipment_id` (`critical_equipment_id`),
  KEY `critical_equipment_id_redundant` (`critical_equipment_id_redundant`),
  CONSTRAINT `ce_available_redundancy_ibfk_1` FOREIGN KEY (`critical_equipment_id`) REFERENCES `critical_equipment` (`critical_equipment_id`),
  CONSTRAINT `ce_available_redundancy_ibfk_2` FOREIGN KEY (`critical_equipment_id_redundant`) REFERENCES `critical_equipment` (`critical_equipment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1