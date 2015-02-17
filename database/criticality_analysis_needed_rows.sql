INSERT INTO `formula_category` (`formula_category_id`, `name`, `code`) VALUES
(1, 'Likelihood', 'likelihood_1'),
(2, 'Likelihood', 'likelihood_2'),
(3, 'Likelihood', 'likelihood_3'),
(4, 'LIkelihood', 'likelihood_4');

INSERT INTO `formula` (`formula_id`, `formula_category_id`, `value`, `operation`, `operation_value`) VALUES
(1, 1, '1.00', 'multiply', '2.00'),
(2, 1, '2.00', 'multiply', '10.00'),
(3, 1, '3.00', 'multiply', '30.00'),
(4, 1, '4.00', 'multiply', '60.00'),
(5, 1, '5.00', 'multiply', '120.00'),
(6, 2, '1.00', 'multiply', '2.00'),
(7, 2, '2.00', 'multiply', '10.00'),
(8, 2, '3.00', 'multiply', '25.00'),
(9, 2, '4.00', 'multiply', '50.00'),
(10, 2, '5.00', 'multiply', '110.00'),
(11, 3, '1.00', 'multiply', '2.00'),
(12, 3, '2.00', 'multiply', '4.00'),
(13, 3, '3.00', 'multiply', '8.00'),
(14, 3, '4.00', 'multiply', '16.00'),
(15, 3, '5.00', 'multiply', '32.00'),
(16, 4, '1.00', 'multiply', '1.00'),
(17, 4, '2.00', 'multiply', '2.00'),
(18, 4, '3.00', 'multiply', '5.00'),
(19, 4, '4.00', 'multiply', '10.00'),
(20, 4, '5.00', 'multiply', '20.00');

INSERT INTO `ce_parent_sce` (`ce_parent_sce_id`, `name`, `ref`, `asset_id`) VALUES
(1, 'Tiffany Escape Routes', '1', 453),
(2, 'Blowdown', '3', 453),
(3, 'Combustible Gas Detection', '5', 453),
(4, 'Internal and External Communication Systems', '6,8', 453),
(5, 'Topsides Hydrocarbon & Hazardous Substance', '10', 453),
(6, 'Deluge (Process)', '11', 453),
(7, 'Emergency Electrical Power Supplies', '13', 453),
(8, 'Emergency Lightning', '14', 453),
(9, 'Emergency Shutdown', '15', 453),
(10, 'Pipelines Systems Hydrocarbon Containment', '16', 453),
(11, 'Fire and Smoke Detection', '17', 453),
(12, 'Fire pump & Fire Ring Main', '18', 453),
(13, 'Foam Systems', '19', 453);


INSERT INTO `ce_group` VALUES ('1', 'Tiffany Escape Routes', 'Not Applicable');
INSERT INTO `ce_group` VALUES ('2', 'Combustible Gas Detection 360KA', '360KA');
INSERT INTO `ce_group` VALUES ('3', 'Combustible Gas', ' M01-');
INSERT INTO `ce_group` VALUES ('4', 'Internal and External Communications Systems', '960-QX & QR & QVRB');
INSERT INTO `ce_group` VALUES ('5', 'Deluge Skid', 'SM01AM2');
INSERT INTO `ce_group` VALUES ('6', null, 'NO TAGS');
INSERT INTO `ce_group` VALUES ('7', 'Fire Pump', '730PH01');



INSERT INTO `critical_equipment` (`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`) VALUES ('1', null, 'NO TAGS', 'Fire Water Ring Main 12\\\" -  Module 2', 'PUGN', '1', null, null, null, null, '6', '1');


INSERT INTO `critical_equipment` 

(`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`)

 VALUES 

('5', null, 'NO TAGS', 'Fire Water Ring Main 12\" -  Module 2', 'PUGN', '1', null, null, null, null, '6', '1');


INSERT INTO `critical_equipment` (`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`) VALUES ('6', null, 'NO TAGS', 'Sub-Fire Water Ring Main 6\" -  Module 2 - Level 4', 'PUGN', '1', null, null, null, null, '6', '1');
INSERT INTO `critical_equipment` (`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`) VALUES ('7', null, '730PH01A', 'Fire Pump ', 'PUGN', '1', null, null, null, null, '7', '12');
INSERT INTO `critical_equipment` (`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`) VALUES ('8', null, '730PH01B', 'Fire Pump ', 'PUGN', '1', null, null, null, null, '7', '12');
INSERT INTO `critical_equipment` (`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`) VALUES ('9', null, '730PH01C', 'Fire Pump ', 'PUGN', '1', null, null, null, null, '7', '12');
INSERT INTO `critical_equipment` (`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`) VALUES ('10', null, '730PH01D', ' Fire Pump ', 'PUGN', '1', null, null, null, null, '7', '12');
INSERT INTO `critical_equipment` (`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`) VALUES ('11', null, '740MP01', 'Firewater System ', 'PUGN', '1', null, null, null, null, '7', '11');
INSERT INTO `critical_equipment` (`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`) VALUES ('12', null, '750-PA01 A', 'Jockey Pump ', 'PUGN', '1', null, '100.00', null, null, '7', '12');
INSERT INTO `critical_equipment` (`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`) VALUES ('13', null, '750-PA01 B', 'Jockey Pump ', 'PUGN', '1', null, '100.00', null, null, '7', '12');
INSERT INTO `critical_equipment` (`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`) VALUES ('14', null, 'NO TAGS', 'Fire Hydrants', 'LCHY', '1', null, null, null, null, '6', '1');
INSERT INTO `critical_equipment` (`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`) VALUES ('15', null, 'NO TAGS', 'High Capacity Hosereels (External)', 'LCHR', '1', null, null, null, null, '6', '5');
INSERT INTO `critical_equipment` (`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`) VALUES ('16', null, 'NO TAGS', 'Normal Hosereels (accomadation)', 'LCHR', '1', null, null, null, null, '6', '12');
INSERT INTO `critical_equipment` (`critical_equipment_id`, `ref`, `tag_number`, `subsystem_component`, `code`, `quantity`, `conflict`, `availability`, `rule_set`, `source_of_information`, `ce_group_id`, `ce_parent_sce_id`) VALUES ('17', null, 'NO TAGS', 'Hosereels', 'LCHR', '1', null, null, null, null, '6', '12');


INSERT INTO `ca_question_category` (`ca_question_category_id`, `name`, `code`, `description`, `general_question`, `formula_category_id`) VALUES
(1, 'Safety', 'safety', NULL, 'Does this equipment have the potential to cause harm to personnel upon / during failure?', 1),
(2, 'Environmental', 'environmental', '(calculated over a 12 hr period)', 'Does this equipment have the potential to cause harm to the environment upon / during failure?', 2),
(3, 'Production', 'production', NULL, 'Does this equipment have the potential to impact production upon / during failure?', 3),
(4, 'Equipment Downtime', 'equipment_downtime', NULL, 'Is equipment downtime expected upon / during failure?', 3),
(5, 'Corrective Financial Costs', 'corrective_financial_costs', NULL, 'Is there likely to be a financial cost to correct this failure? (includes environmental / development / training)', 3),
(6, 'Secondary Damage', 'secondary_damage', NULL, 'Is this equipment likely to cause secondary damage upon failure', 4);


INSERT INTO `ca_question` (`ca_question_id`, `question`, `value`, `description`, `ca_question_category_id`) VALUES
(1, 'Minimal perceived hazard to personnel / full integrity of safety systems', '2.00', NULL, 1),
(2, 'Potential hazard to personnel / safety systems integrity impaired', '10.00', NULL, 1),
(3, 'Significant risk to personnel / safety systems integrity severely impaired', '30.00', NULL, 1),
(4, 'Life threatening risk to personnel', '60.00', NULL, 1),
(5, 'Multiple fatalities / total loss of integrity', '120.00', NULL, 1),
(6, 'Minimal/normal emissions (no release/within planned limits)', '2.00', NULL, 2),
(7, 'Localised/controlled release (small spillage cleaned up, short term emission > limits, 1 week flaring)', '10.00', NULL, 2),
(8, 'Spillage into sea (clean up leaves long term damage, emission > limits for hrs/day, 1 month flaring)', '25.00', NULL, 2),
(9, 'Major spillage (long term clean up, major emission, direct damage, significant potential damage)', '50.00', NULL, 2),
(10, 'Widespread environmental damage', '110.00', NULL, 2),
(11, 'Little effect (by-pass/standby/spare capacity available)', '2.00', NULL, 3),
(12, 'Process availability compromised', '4.00', NULL, 3),
(13, 'Short - mid term delay to process throughput/performance', '8.00', NULL, 3),
(14, 'Significant impact on production', '16.00', NULL, 3),
(15, 'Severe/total long term loss of production', '32.00', NULL, 3),
(16, 'Very Low (< 12 hrs)', '2.00', NULL, 4),
(17, 'Low (12-24hrs)', '4.00', NULL, 4),
(18, 'Medium (24 - 48 hrs)', '8.00', NULL, 4),
(19, 'High ( 48 - 72hrs)', '16.00', NULL, 4),
(20, 'Very High (72hrs)', '32.00', NULL, 4),
(21, 'Minimal (< £1k)', '2.00', NULL, 5),
(22, 'Small (< 50K)', '4.00', NULL, 5),
(23, 'Medium (< 500K)', '8.00', NULL, 5),
(24, 'High (< 500M)', '16.00', NULL, 5),
(25, 'Very High (> 500M)', '32.00', NULL, 5),
(26, 'Negligible', '1.00', NULL, 6),
(27, 'Minor', '2.00', NULL, 6),
(28, 'Moderate', '5.00', NULL, 6),
(29, 'Severe', '10.00', NULL, 6),
(30, 'Extensive', '20.00', NULL, 6);

INSERT INTO `criticality_analysis_stage` (`ref`, `notes`, `spof_answer`, `se_answer`, `sce`, `ece`, `pce`, `ex`, `sis`, `spof_value`, `se_value`, `risk_total`, `overall_criticality`, `overall_reliability_score`, `status_value_adjustment`, `inspection_periodicity_hrs`, `spf_criticality`, `cas`, `critical_equipment_id`, `criticality_analysis_id`) VALUES
('123', NULL, 1, 1, 1, 1, 1, 1, 1, '2.00', '2.00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1);

INSERT INTO `ca_q_category_answer` (`ca_q_category_answer_id`, `answer`, `total`, `ca_question_category_id`, `criticality_analysis_id`) VALUES
(1, 1, NULL, 1, 1),
(2, 1, NULL, 2, 1),
(3, 1, NULL, 3, 1),
(4, 1, NULL, 4, 1),
(5, 1, NULL, 5, 1),
(6, 1, NULL, 6, 1);


INSERT INTO `ca_answer` (`ca_answer_id`, `value`, `total`, `ca_question_id`, `ca_q_category_answer_id`) VALUES
(1, '1.00', 2, 1, 1),
(2, '3.00', 90, 2, 1),
(3, '3.00', 90, 3, 1),
(4, '5.00', 600, 4, 1),
(5, '2.00', 20, 5, 1),
(6, '3.00', 75, 6, 2),
(7, '3.00', 75, 7, 2),
(8, '1.00', 2, 8, 2),
(9, '1.00', 2, 9, 2),
(10, '2.00', 20, 10, 2),
(11, '4.00', 64, 11, 3),
(12, '1.00', 2, 12, 3),
(13, '3.00', 24, 13, 3),
(14, '4.00', 64, 14, 3),
(15, '5.00', 160, 15, 3),
(16, '3.00', 24, 16, 4),
(17, '3.00', 24, 17, 4),
(18, '1.00', 2, 18, 4),
(19, '3.00', 24, 19, 4),
(20, '5.00', 160, 20, 4),
(21, '5.00', 160, 21, 5),
(22, '2.00', 8, 22, 5),
(23, '3.00', 24, 23, 5),
(24, '2.00', 8, 24, 5),
(25, '1.00', 2, 25, 5),
(26, '1.00', 1, 26, 6),
(27, '5.00', 100, 27, 6),
(28, '3.00', 15, 28, 6),
(29, '2.00', 4, 29, 6),
(30, '1.00', 1, 30, 6);



-- ----------------------------
-- Records of inspection_periodicity
-- ----------------------------
INSERT INTO `inspection_periodicity` VALUES ('1', '91', '100', 'A', '6', '0.50', '< 1', null, null);
INSERT INTO `inspection_periodicity` VALUES ('2', '81', '90', 'B', '12', '1', '5', null, null);
INSERT INTO `inspection_periodicity` VALUES ('3', '71', '80', 'C', '24', '2', '10', null, null);
INSERT INTO `inspection_periodicity` VALUES ('4', '61', '70', 'D', '48', '4', '20', null, null);
INSERT INTO `inspection_periodicity` VALUES ('5', '51', '60', 'E', '72', '6', '40', null, null);
INSERT INTO `inspection_periodicity` VALUES ('6', '41', '50', 'F', '96', '8', '10', null, null);
INSERT INTO `inspection_periodicity` VALUES ('7', '31', '40', 'G', '120', '10', '5', null, null);
INSERT INTO `inspection_periodicity` VALUES ('8', '21', '30', 'H', '144', '12', '3', null, null);
INSERT INTO `inspection_periodicity` VALUES ('9', '11', '20', 'I', '168', '14', '2', null, null);
INSERT INTO `inspection_periodicity` VALUES ('10', '0', '10', 'J', 'Over', '> 14', '< 1', null, null);


