<?php

class MCDR_Model extends MY_Model {

	const DB_TABLE = 'mcdr';
    const DB_TABLE_PK = 'mcdr_id';
    const DB_DOCUMENT_TYPE = 'mcdr';

    public function update_step_0( $id, $installation, $id_tag_line_no, $maximo_wo_no, $date_reported, $module, $pressure_design, $pressure_operating, $temp_design, $temp_operating, $flow_design, $flow_operating, $location, $system, $safety_critical, $mcdr_raised_by, $date_of_last_inspection, $estimated_time_of_service, $other_mcdr, $ps_no, $process, $related_reports, $material_type, $component_size, $schedule, $nwt, $dca, $ps_mawt, $equipment_type, $component, $area_on_component, $coating_system_details, $insulated_class, $degradation_type, $degradation_mechanism, $pitting_depth, $extent, $area, $mrwt, $corrosion_grading, $other_remarks, $leak, $deferment, $added_to_mcdr_register, $temp_repair_applied, $type_of_repair, $leaking, $temp_repair_reg_no, $remedial_action_type, $fabric_maint_priority, $target_close_out_date, $drawings_pid_etc, $mcdr_additional_info, $maint_superintendent ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET installation = ?, id_tag_line_no = ?, maximo_wo_no = ?, date_reported = ?, module = ?, pressure_design = ?, pressure_operating = ?, temp_design = ?, temp_operating = ?, flow_design = ?, flow_operating = ?, location = ?, system = ?, safety_critical = ?, mcdr_raised_by = ?, date_of_last_inspection = ?, estimated_time_of_service = ?, other_mcdr = ?, ps_no = ?, process = ?, related_reports = ?, material_type = ?, component_size = ?, schedule = ?, nwt = ?, dca = ?, ps_mawt = ?, equipment_type = ?, component = ?, area_on_component = ?, coating_system_details = ?, insulated_class = ?, degradation_type = ?, degradation_mechanism = ?, pitting_depth = ?, extent = ?, area = ?, mrwt = ?, corrosion_grading = ?, other_remarks = ?, leak = ?, deferment = ?, added_to_mcdr_register = ?, temp_repair_applied = ?, type_of_repair = ?, leaking = ?, temp_repair_reg_no = ?, remedial_action_type = ?, fabric_maint_priority = ?, target_close_out_date = ?, drawings_pid_etc = ?, mcdr_additional_info = ?, maint_superintendent = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $installation, $id_tag_line_no, $maximo_wo_no, $date_reported, $module, $pressure_design, $pressure_operating, $temp_design, $temp_operating, $flow_design, $flow_operating, $location, $system, $safety_critical, $mcdr_raised_by, $date_of_last_inspection, $estimated_time_of_service, $other_mcdr, $ps_no, $process, $related_reports, $material_type, $component_size, $schedule, $nwt, $dca, $ps_mawt, $equipment_type, $component, $area_on_component, $coating_system_details, $insulated_class, $degradation_type, $degradation_mechanism, $pitting_depth, $extent, $area, $mrwt, $corrosion_grading, $other_remarks, $leak, $deferment, $added_to_mcdr_register, $temp_repair_applied, $type_of_repair, $leaking, $temp_repair_reg_no, $remedial_action_type, $fabric_maint_priority, $target_close_out_date, $drawings_pid_etc, $mcdr_additional_info, $maint_superintendent, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }


    public function update_step_1( $id, $oie_integrity_coordinator_recommendation, $oie_integrity_coordinator, $oie_integrity_date, $technical_authority_recommendation, $technical_authority, $technical_authority_date, $closed_out, $closed_out_coordinator, $closed_out_date) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET oie_integrity_coordinator_recommendation = ?, oie_integrity_coordinator = ?, oie_integrity_date = ?, technical_authority_recommendation = ?, technical_authority = ?, technical_authority_date = ?, closed_out = ?, closed_out_coordinator = ?, closed_out_date = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $oie_integrity_coordinator_recommendation, $oie_integrity_coordinator, $oie_integrity_date, $technical_authority_recommendation, $technical_authority, $technical_authority_date, $closed_out, $closed_out_coordinator, $closed_out_date, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }


    public function update_step_2( $id, $oie_integrity_coordinator_recommendation, $oie_integrity_coordinator, $oie_integrity_date, $technical_authority_recommendation, $technical_authority, $technical_authority_date, $closed_out, $closed_out_coordinator, $closed_out_date) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET oie_integrity_coordinator_recommendation = ?, oie_integrity_coordinator = ?, oie_integrity_date = ?, technical_authority_recommendation = ?, technical_authority = ?, technical_authority_date = ?, closed_out = ?, closed_out_coordinator = ?, closed_out_date = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $oie_integrity_coordinator_recommendation, $oie_integrity_coordinator, $oie_integrity_date, $technical_authority_recommendation, $technical_authority, $technical_authority_date, $closed_out, $closed_out_coordinator, $closed_out_date, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }


    public function update_step_3( $id, $can_location, $can_date, $can_job_no, $can_report_no, $client_order_no, $can_sheet, $can_sheet_of, $component_description_drawing, $material, $procedure_work_instruction, $equipment_make_model, $probe_type_frequency, $couplant, $surface_condition, $acceptance_standard, $material_serial_no, $test_blocks, $calibration_range, $can_results, $associative_reports, $can_feature, $can_type, $can_scan, $can_min, $can_min_location, $can_line_number, $can_inspector_sign, $can_inspector_name, $can_inspector_quals, $issuing_authority_sign, $issuing_authority_name, $issuing_authority_date, $client_sign, $client_name, $client_date) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET can_location = ?, can_date = ?, can_job_no = ?, can_report_no = ?, client_order_no = ?, can_sheet = ?, can_sheet_of = ?, component_description_drawing = ?, material = ?, procedure_work_instruction = ?, equipment_make_model = ?, probe_type_frequency = ?, couplant = ?, surface_condition = ?, acceptance_standard = ?, material_serial_no = ?, test_blocks = ?, calibration_range = ?, can_results = ?, associative_reports = ?, can_feature = ?, can_type = ?, can_scan = ?, can_min = ?, can_min_location = ?, can_line_number = ?, can_inspector_sign = ?, can_inspector_name = ?, can_inspector_quals = ?, issuing_authority_sign = ?, issuing_authority_name = ?, issuing_authority_date = ?, client_sign = ?, client_name = ?, client_date = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $can_location, $can_date, $can_job_no, $can_report_no, $client_order_no, $can_sheet, $can_sheet_of, $component_description_drawing, $material, $procedure_work_instruction, $equipment_make_model, $probe_type_frequency, $couplant, $surface_condition, $acceptance_standard, $material_serial_no, $test_blocks, $calibration_range, $can_results, $associative_reports, $can_feature, $can_type, $can_scan, $can_min, $can_min_location, $can_line_number, $can_inspector_sign, $can_inspector_name, $can_inspector_quals, $issuing_authority_sign, $issuing_authority_name, $issuing_authority_date, $client_sign, $client_name, $client_date, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }


    public function update_step_4( $id, $cont_location, $cont_date, $cont_job_no, $cont_report_no, $cont_client_no, $cont_sheet, $cont_sheet_of, $cont_component_description, $cont_image_caption, $cont_inspector_sign, $cont_inspector_name, $cont_inspector_quals, $cont_issuing_authority_sign, $cont_issuing_authority_name, $cont_issuing_authority_date, $cont_client_sign, $cont_client_name, $cont_client_date) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET cont_location = ?, cont_date = ?, cont_job_no = ?, cont_report_no = ?, cont_client_no = ?, cont_sheet = ?, cont_sheet_of = ?, cont_component_description = ?, cont_image_caption = ?, cont_inspector_sign = ?, cont_inspector_name = ?, cont_inspector_quals = ?, cont_issuing_authority_sign = ?, cont_issuing_authority_name = ?, cont_issuing_authority_date = ?, cont_client_sign = ?, cont_client_name = ?, cont_client_date = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $cont_location, $cont_date, $cont_job_no, $cont_report_no, $cont_client_no, $cont_sheet, $cont_sheet_of, $cont_component_description, $cont_image_caption, $cont_inspector_sign, $cont_inspector_name, $cont_inspector_quals, $cont_issuing_authority_sign, $cont_issuing_authority_name, $cont_issuing_authority_date, $cont_client_sign, $cont_client_name, $cont_client_date, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }


    public function update_step_5( $id, $module_plot_plan) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET module_plot_plan = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $module_plot_plan, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }


    public function update_step_6( $id, $pid_iso) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET pid_iso = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $pid_iso, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }
	

    public function get_floor_plans($document_id){

        $sql = "SELECT * FROM floorplan WHERE document_id = ?";

        $escaped_values = array($document_id);

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_specific_floor_plan($floor_plan_id){

        $sql = "SELECT * FROM floorplan WHERE floorplan_id = ?";

        $escaped_values = array($floor_plan_id);

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row();

        return $result;

    }

    public function create_floor_plan($document_id){

        $sql = "INSERT INTO floorplan (document_id) VALUES (?)";

        $escaped_values = array( $document_id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function create_file_path($filename, $floor_plan_id){

        $sql = "UPDATE floorplan SET filename = ? WHERE floorplan_id = ?";

        $escaped_values = array( $filename, $floor_plan_id);

        $query = $this->db->query( $sql, $escaped_values );

        return $floor_plan_id;

    }

    public function get_floor_plan_file($floor_plan_id){

        $sql = "SELECT * FROM floorplan WHERE floorplan_id = ?";

        $escaped_values = array($floor_plan_id);

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row();

        return $result;
    }

    public function get_plot_points($floor_plan_id){

        $sql = "SELECT * FROM floorplan_detail WHERE floorplan_id = ?";

        $escaped_values = array($floor_plan_id);

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

}