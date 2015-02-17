<?php

class Project_Tracker_Model extends MY_Model {

	const DB_TABLE = 'cost_breakdown';
    const DB_TABLE_PK = 'cost_breakdown_id';
    const DB_DOCUMENT_TYPE = '';

    public function get_project_tracker_list($project_name = null, $project_number = null, $author = null, $start_date = null, $project_condition = null, $work_party = null) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        //to do (right now its just a template
        $project_tracker_sql = "SELECT a.*,b.`code`, b.cost_breakdown_estimated_total,b.cost_breakdown_actual_total, b.`name` as project_name FROM project_plan a, document b WHERE a.document_id = b.document_id";

        if ( $project_name != null ) {
            $project_tracker_sql .= " AND b.`name` LIKE '%{$project_name}%'";
        }

        if ( $project_number != null ) {
            $project_tracker_sql .= " AND b.`code` = '{$project_number}'";
        }
        
        if ( $author != null ) {
            $project_tracker_sql .= " AND a.author LIKE '%{$author}%'";
        }
        
        if ( $start_date != null ) {

            $start_date = convert_string_to_date($start_date);

            $project_tracker_sql .= " AND a.estimated_start_date = '{$start_date}'";
        }

        if ( $project_condition != null ) {
            $project_tracker_sql .= " AND a.project_condition_id = '{$project_condition}'";
        }

        if ( $work_party != null ) {
            $project_tracker_sql .= " AND a.work_party_id = {$work_party}";
        }
        
        $project_tracker_sql .= " ORDER BY a.document_id";

        $query = $this->db->query( $project_tracker_sql );

        $result = $query->result();

        return $result;
    }

    public function get_cost_breakdown($document_id){

        $sql = "SELECT * FROM cost_breakdown WHERE document_id = ?";

        $escaped_values = array($document_id);

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;

    }

    public function get_specialist_requirement($document_id){

        $sql = "SELECT * FROM enabler WHERE document_id = ?";

        $escaped_values = array($document_id);

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;

    }

    public function update_cost_breakdown($cost_breakdown_id, $c_supplier, $c_due_date, $c_status, $c_po_number, $c_component_location){

        $sql = "UPDATE cost_breakdown SET supplier = ?, due_date_on_platform = ?, waiting_status = ?, po_number = ?, component_location = ? WHERE cost_breakdown_id = ?";

        $escaped_values = array($c_supplier, $c_due_date, $c_status, $c_po_number, $c_component_location, $cost_breakdown_id);

        $query = $this->db->query( $sql, $escaped_values );

    }

    public function get_project_tracker_gantt_chart(){

        $sql = "SELECT a.document_id,a.project_plan_id,a.estimated_project_duration, b.`code`, a.estimated_start_date, b.`name` as project_name FROM project_plan a, document b WHERE a.document_id = b.document_id AND a.estimated_start_date IS NOT NULL";

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function get_single_project_tracker_gantt_chart($document_id){

        $sql = "SELECT a.document_id,a.project_plan_id,a.estimated_project_duration, b.`code`, a.estimated_start_date, b.`name` as project_name FROM project_plan a, document b WHERE a.document_id = b.document_id AND a.document_id = ?";

        $escaped_values = array($document_id);

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row();

        return $result;
    }

    public function count_project($document_id){

        $sql = "SELECT * FROM project_plan WHERE document_id = ?";

        $escaped_values = array($document_id);

        $query = $this->db->query($sql,$escaped_values);

        $result = $query->row();

        return $result;
    }
	
}