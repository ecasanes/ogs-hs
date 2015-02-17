<?php

class PP_Model extends MY_Model {

    const DB_TABLE = 'project_plan';
    const DB_TABLE_PK = 'project_plan_id';
    const DB_DOCUMENT_TYPE = 'project-plan';


    public function update_step_0( $id, $author, $project_plan_date, $person_in_charge, $justification_id, $costs, $estimated_start_date, $project_condition, $work_party, $estimated_project_duration ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET author = ?, project_plan_date = ?, person_in_charge = ?, justification_id = ?, costs = ?, estimated_start_date = ?, project_condition_id = ?, work_party_id = ?, estimated_project_duration = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $author, $project_plan_date, $person_in_charge, $justification_id, $costs, $estimated_start_date, $project_condition, $work_party, $estimated_project_duration, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_1( $id, $about_the_project, $purpose, $drivers, $success_criteria, $locations, $first_day_offshore, $last_day_offshore ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET about_the_project = ?, purpose = ?, drivers = ?, success_criteria = ?, locations = ?,  first_day_offshore = ?, last_day_offshore = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $about_the_project, $purpose, $drivers, $success_criteria, $locations, $first_day_offshore, $last_day_offshore, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_2( $id, $benefits ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET benefits = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $benefits, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_3( $id, $boundaries, $assumptions ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET boundaries = ?, assumptions = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $boundaries, $assumptions, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_5( $id, $quality_control_summary, $pass_or_fail ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET quality_control_summary = ?, pass_or_fail = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $quality_control_summary, $pass_or_fail, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_6( $id, $chart ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET chart = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $chart, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_7( $id, $lesson_learned ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET lesson_learned = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $lesson_learned, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_due_date($form_id, $new_start_date, $old_start_date, $project_end_date, $db_primary = 'document_id', $table , $table_primary, $date_column){
        $db_table = 'enabler';
        $db_primary = 'document_id';

        $difference_in_date = date_diff($old_start_date, $new_start_date);

        if($table == 'deliverable'){
            $sql = "SELECT {$table_primary} as primary_table, start_date, {$date_column} as due_date_column FROM {$table} WHERE {$db_primary} = ?";
        }
        else{
            $sql = "SELECT {$table_primary} as primary_table, {$date_column} as due_date_column FROM {$table} WHERE {$db_primary} = ?";
        }

        $escaped_values = array($form_id);

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        foreach($result as $res){

            $convert = convert_date_to_string($res->due_date_column, true);

            if($table == 'deliverable'){

                $convert_start = convert_date_to_string($res->start_date, true);

                if($convert_start != null || $convert_start != ''){
                    $prev_start = new DateTime($res->start_date);

                    $prev_start = $new_start_date;
                    
                    $b = date_format($prev_start,"Y-m-d");

                    $primary_id = $res->primary_table;

                    $update_sql = "UPDATE {$table} SET start_date = ? WHERE {$table_primary} = ?";

                    $update_escaped_values = array($b, $primary_id);

                    $query = $this->db->query( $update_sql, $update_escaped_values );
                }
            }

            if($convert != null || $convert != ''){
                $prev = new DateTime($res->due_date_column);


                $prev = date_add($prev, $difference_in_date);

                //check if new due date is greater than project duration
                if($prev > $project_end_date){
                    $prev = $project_end_date;
                }

                $a = date_format($prev,"Y-m-d");
                $primary_id = $res->primary_table;

                $update_sql = "UPDATE {$table} SET {$date_column} = ? WHERE {$table_primary} = ?";

                $update_escaped_values = array($a, $primary_id);

                $query = $this->db->query( $update_sql, $update_escaped_values );
            }  
        }
    }

    public function update_specialist_due_date($form_id, $new_start_date, $old_start_date){
        $db_table = 'enabler';
        $db_primary = 'document_id';

        $difference_in_date = date_diff($old_start_date, $new_start_date);

        $sql = "SELECT enabler_id, due_date FROM {$db_table} WHERE {$db_primary} = ?";

        $escaped_values = array($form_id);

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        foreach($result as $res){

            $convert = convert_date_to_string($res->due_date, true);

            if($convert != null || $convert != ''){
                $prev = new DateTime($res->due_date);

                $prev = date_add($prev, $difference_in_date);
                $a = date_format($prev,"Y-m-d");
                $enabler_id = $res->enabler_id;

                $update_sql = "UPDATE {$db_table} SET due_date = ? WHERE enabler_id = ?";

                $update_escaped_values = array($a, $enabler_id);

                $query = $this->db->query( $update_sql, $update_escaped_values );
            }
           
        }
        
    }
}

?>
