<?php

class Document_Model extends MY_Model {

    const DB_TABLE = 'document';
    const DB_TABLE_PK = 'document_id';


    public function get_document_type($document_id, $return_result = 'code'){

        $db_table = "document_type";
        $db_primary = "document_type_id";

        if($return_result == 'code'){
            $selection = "document_type.document_code";
        }else if($return_result == 'name'){
            $selection = "document_type.document_name";
        }

        $sql = "SELECT {$selection} as document_type FROM document, document_type WHERE document_id = ? AND document.document_type_id = document_type.document_type_id";

        $escaped_values = array($document_id);

        $query = $this->db->query($sql, $escaped_values);

        if($query->num_rows() > 0){
            $result = $query->row()->document_type;
        }else{
            $result = 'none';
        }

        return $result;
    }


    public function get_document_type_id($document_code){

        $db_table = "document_type";
        $db_primary = "document_type_id";

        $sql = "SELECT {$db_primary} FROM {$db_table} WHERE document_code = ?";

        $query = $this->db->query($sql, array($document_code));

        if($query->num_rows() > 0){
            $result = $query->row()->document_type_id;
        }else{
            $result = null;
        }

        return $result;

    }

    public function get_document_types(){

        $db_table = "document_type";

        $sql = "SELECT * FROM {$db_table}";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    //INITIALIZE FUNCTIONS
    public function generate() {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $decf_table = 'step_0_case_file';
        $ofi_table = 'ofi_0_profile';
        $pp_table = 'pp_0_project_plan';
        $tb_table = 'tb_0_main';
        $ws_table = 'witness_statement_0';
        $erp_table = 'erp_0_profile';

        $results_decf = $this->get_all_records( $decf_table );
        $results_ofi = $this->get_all_records( $ofi_table );
        $results_pp = $this->get_all_records( $pp_table );
        $results_tb = $this->get_all_records( $tb_table );
        $results_ws = $this->get_all_records( $ws_table );
        $results_erp = $this->get_all_records( $erp_table );



        foreach ( $results_ws as $result ) {
            $document_type = 'ws';
            $id = $result->id;
            $code = $result->code;
            $ref_id = $result->ref_id;
            $name = $result->installation;

            $sql = "INSERT INTO {$db_table} (document_type, document_id, code, ref_id, name, date_created, date_modified) VALUES (?, ?, ?, ?, ?, NOw(), NOW())";
            $escaped_values = array( $document_type, $id, $code, $ref_id, $name );
            $query = $this->db->query( $sql, $escaped_values );
        }


        foreach ( $results_erp as $result ) {
            $document_type = 'erp';
            $id = $result->id;
            $code = $result->code;
            $ref_id = $result->ref_id;
            $name = $result->erp_equipment_description;

            $sql = "INSERT INTO {$db_table} (document_type, document_id, code, ref_id, name, date_created, date_modified) VALUES (?, ?, ?, ?, ?, NOw(), NOW())";
            $escaped_values = array( $document_type, $id, $code, $ref_id, $name );
            $query = $this->db->query( $sql, $escaped_values );
        }

        foreach ( $results_ofi as $result ) {
            $document_type = 'ofi';
            $id = $result->id;
            $code = $result->code;
            $ref_id = $result->ref_id;
            $name = $result->name;

            $sql = "INSERT INTO {$db_table} (document_type, document_id, code, ref_id, name, date_created, date_modified) VALUES (?, ?, ?, ?, ?, NOw(), NOW())";
            $escaped_values = array( $document_type, $id, $code, $ref_id, $name );
            $query = $this->db->query( $sql, $escaped_values );
        }

        foreach ( $results_pp as $result ) {
            $document_type = 'pp';
            $id = $result->id;
            $code = $result->code;
            $ref_id = $result->ref_id;
            $name = $result->name;

            $sql = "INSERT INTO {$db_table} (document_type, document_id, code, ref_id, name, date_created, date_modified) VALUES (?, ?, ?, ?, ?, NOw(), NOW())";
            $escaped_values = array( $document_type, $id, $code, $ref_id, $name );
            $query = $this->db->query( $sql, $escaped_values );
        }


        foreach ( $results_decf as $result ) {
            $document_type = 'decf';
            $id = $result->id;
            $code = $result->code;
            $ref_id = $result->ref_id;
            $name = $result->name;

            $sql = "INSERT INTO {$db_table} (document_type, document_id, code, ref_id, name, date_created, date_modified) VALUES (?, ?, ?, ?, ?, NOw(), NOW())";
            $escaped_values = array( $document_type, $id, $code, $ref_id, $name );
            $query = $this->db->query( $sql, $escaped_values );
        }


        foreach ( $results_tb as $result ) {
            $document_type = 'tb';
            $id = $result->id;
            $code = $result->code;
            $ref_id = $result->ref_id;
            $name = $result->doc_title;

            //echo $name;
            //echo '<br/>';

            $sql = "INSERT INTO {$db_table} (document_type, document_id, code, ref_id, name, date_created, date_modified) VALUES (?, ?, ?, ?, ?, NOw(), NOW())";
            $escaped_values = array( $document_type, $id, $code, $ref_id, $name );
            $query = $this->db->query( $sql, $escaped_values );
        }
    }

    public function create_empty( $document_type_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "INSERT INTO {$db_table} (document_type_id, date_created, last_modified) VALUES (?, NOW(), NOW())";

        $escaped_values = array( $document_type_id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function initialize_document( $document_id, $code, $ref_id, $document_status = 407 ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET code = ?, ref_id = ?, document_status = ? WHERE document_id = ?";

        $escaped_values = array( $code, $ref_id, $document_status, $document_id );

        $query = $this->db->query( $sql, $escaped_values );
    }


    public function create_empty_equipment_history_answer( $document_id ) {

        $db_primary = "equipment_history_question_id";

        $equipment_history_questions = $this->get_all_equipment_history_questions();

        foreach ( $equipment_history_questions as $question ) {

            $question_id = $question->equipment_history_question_id;

            $sql = "INSERT INTO equipment_history_answer (document_id, equipment_history_question_id) VALUES (?, ?)";
            $escaped_values = array( $document_id, $question_id );
            $query = $this->db->query( $sql, $escaped_values );

        }

    }


    /*public function create_empty_equipment_history_answer($document_id){

        $db_primary = "equipment_history_question_id";

        $equipment_history_categories = $this->get_equipment_history_categories();

        $menu_id = $this->get_menu_id_by_value(0, 'generic_yes_no', 'menu');

        foreach($equipment_history_categories as $equipment_category){

            $category_id = $equipment_category->category_id;

            $sql = "INSERT INTO equipment_history_answer (document_id, equipment_history_category_id) VALUES (?, ?)";
            $escaped_values = array($document_id, $category_id);
            $query = $this->db->query($sql, $escaped_values);

            $sql = "INSERT INTO equipment_history_category_answer (document_id, equipment_history_category_id, answer) VALUES (?, ?, ?)";
            $escaped_values = array($document_id, $category_id, $menu_id);
            $query = $this->db->query($sql, $escaped_values);

        }



    }*/

    public function create_specific_equipment_history_answer( $document_id, $question_id ) {

        $sql = "INSERT INTO equipment_history_answer (document_id, equipment_history_question_id ) VALUES (?, ?)";
        $escaped_values = array( $document_id, $question_id );
        $query = $this->db->query( $sql, $escaped_values );


    }

    public function create_specific_equipment_history_category_answer( $document_id, $category_id ) {

        $sql = "INSERT INTO equipment_history_answer (document_id, equipment_history_category_id ) VALUES (?, ?)";

        $escaped_values = array( $document_id, $category_id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function create_action_tracker( $document_id, $ref_id_code, $action_process, $action_tracker_status, $owner, $due_date, $comments ) {

        $sql = "INSERT INTO action_tracker (document_id, reference, action_process_step, status, owner, due_date, comments) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $escaped_values = array( $document_id, $ref_id_code, $action_process, $action_tracker_status, $owner, $due_date, $comments );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function create_master_action_tracker( $document_id, $ref_id_code, $action_process, $action_tracker_status, $owner, $due_date, $comments, $author ) {

        $sql = "INSERT INTO action_tracker (document_id, reference, action_process_step, status, owner, due_date, comments, author) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $escaped_values = array( $document_id, $ref_id_code, $action_process, $action_tracker_status, $owner, $due_date, $comments, $author );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function create_subaction_tracker( $action_tracker_id, $owner,$author ) {

        $sql = "INSERT INTO subaction_tracker (action_tracker_id, subaction_owner, author) VALUES (?, ?, ?)";

        $escaped_values = array( $action_tracker_id, $owner, $author );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function create_weekly_plan( $work_order, $job_description, $specialist_requirement, $date, $comments, $status, $owner ) {

        $sql = "INSERT INTO weekly_plan (work_order, job_description, specialist_requirement, date, comments, status, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $escaped_values = array( $work_order, $job_description, $specialist_requirement, $date, $comments, $status, $owner );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function create_hired_equipment_register( $po_number, $equipment, $on_hire_to, $quantity, $duration, $cost, $total, $status, $owner, $off_hire_due_date, $user_id ) {

        $sql = "INSERT INTO hired_equipment_register (po_number, equipment, on_hire_to, quantity, duration, cost, total, status, owner, off_hire_due_date, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $escaped_values = array( $po_number, $equipment, $on_hire_to, $quantity, $duration, $cost, $total, $status, $owner, $off_hire_due_date, $user_id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();

    }

    public function update_document_action_tracker( $action_tracker_id, $action_process, $action_tracker_status, $owner, $due_date, $comments, $document_id, $reference ){

        $sql = "UPDATE action_tracker SET action_process_step = ?, status = ?, owner = ?, due_date = ?, comments = ?, document_id = ?, reference = ?, last_update = NOW() WHERE action_tracker_id = ?";

        $escaped_values = array( $action_process, $action_tracker_status, $owner, $due_date, $comments, $document_id, $reference, $action_tracker_id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();

    }

    public function update_single_action_tracker( $action_tracker_id, $action_process, $action_tracker_status, $owner, $due_date, $entry_date, $comments, $document_id = null, $group_id = null, $reference_code = '', $improvement, $location, $progress, $criticality_analysis_id, $author ) {

        /*if($document_id == null){
            $sql = "UPDATE action_tracker SET action_process_step = ?, status = ?, owner = ?, due_date = ?, entry_date = ?, comments = ?, category = ?, criticality_analysis = ?, improvement_type = ? WHERE action_tracker_id = ?";

            $escaped_values = array($action_process, $action_tracker_status, $owner, $due_date, $entry_date, $comments, $group_id, $criticality_analysis_id, $improvement, $action_tracker_id);
        }
        else{*/

        $sql = "UPDATE action_tracker SET action_process_step = ?, status = ?, owner = ?, due_date = ?, entry_date = ?, comments = ?, document_id = ?, category = ?, reference = ?, criticality_analysis = ?, improvement_type = ?, location = ?, pg = ?, author = ? WHERE action_tracker_id = ?";

        $escaped_values = array( $action_process, $action_tracker_status, $owner, $due_date, $entry_date, $comments, $document_id, $group_id, $reference_code, $criticality_analysis_id, $improvement, $location, $progress, $author, $action_tracker_id );
        //}

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function update_single_subaction_tracker( $subaction_tracker_id, $action_process, $action_tracker_status, $owner, $due_date, $entry_date, $comments, $document_id = null, $group_id = null, $reference_code = '', $improvement, $location, $progress ) {

        $sql = "UPDATE subaction_tracker SET subaction_process_step = ?, subaction_status = ?, subaction_owner = ?, subaction_due_date = ?, subaction_entry_date = ?, subaction_comments = ?, document_id = ?, subaction_group = ?, subaction_reference = ?, subaction_improvement_type = ?, subaction_location = ?, subaction_progress = ? WHERE subaction_tracker_id = ?";

        $escaped_values = array( $action_process, $action_tracker_status, $owner, $due_date, $entry_date, $comments, $document_id, $group_id, $reference_code, $improvement, $location, $progress, $subaction_tracker_id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function update_single_weekly_plan( $weekly_plan_id, $work_order, $job_description, $specialist_requirement, $category, $date, $comments, $status ) {

        $sql = "UPDATE weekly_plan SET work_order = ?, job_description = ?, specialist_requirement = ?, category = ?, date = ?, comments = ?, status = ? WHERE weekly_plan_id = ?";

        $escaped_values = array( $work_order, $job_description, $specialist_requirement, $category, $date, $comments, $status, $weekly_plan_id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function update_single_equipment_register( $hired_equipment_register_id, $po_number, $equipment, $on_hire_to, $quantity, $duration, $cost, $total, $status, $owner, $off_hire_due_date ) {

        $sql = "UPDATE hired_equipment_register SET po_number = ?, equipment = ?, on_hire_to = ?, quantity = ?, duration = ?, cost = ?, total = ?, status = ?, owner = ?, off_hire_due_date = ? WHERE hired_equipment_register_id = ?";

        $escaped_values = array( $po_number, $equipment, $on_hire_to, $quantity, $duration, $cost, $total, $status, $owner, $off_hire_due_date, $hired_equipment_register_id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();

    }





    //GET FUNCTIONS
    public function get_user_documents( $user_id = null ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "SELECT * FROM {$db_table} a, user b, document_owner c WHERE a.{$db_primary} = c.{$db_primary} AND c.user_id = b.user_id AND b.user_id = ? ORDER BY a.code";

        if ( $user_id == null ) {
            $sql = "SELECT * FROM {$db_table} a, user b, document_owner c WHERE a.{$db_primary} = c.{$db_primary} AND c.user_id = b.user_id AND b.user_id IS NOT NULL ORDER BY a.code";
        }

        $escaped_values = array( $user_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result =  $query->result();

        return $result;

    }

    public function get_completed_documents( $document_complete_status = 1, $notification_sent = 'false' ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "SELECT * FROM {$db_table} WHERE document_completed = ? AND notification_sent = ?";

        $escaped_values = array( $document_complete_status, $notification_sent );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_recent_documents( $user_id, $limit = 0 ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "SELECT * FROM {$db_table} a, document_owner b, document_type d_type WHERE d_type.document_type_id = a.document_type_id AND a.{$db_primary} = b.{$db_primary} AND b.user_id = ? ORDER BY a.{$db_primary} DESC";

        if ( $limit > 0 ) {
            $sql .= " limit 0,{$limit}";
        }

        $escaped_values = array( $user_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_document_owners( $document_id, $owner_type = 'all' ) {

        $db_table = "document_owner";

        if ( $owner_type == 'all' ) {
            $sql = "SELECT * FROM  document_owner a LEFT OUTER JOIN  user b ON a.user_id = b.user_id WHERE a.document_id = ? UNION SELECT * FROM document_owner a RIGHT OUTER JOIN  user b ON a.user_id = b.user_id WHERE a.document_id = ?";
            $escaped_values = array( $document_id, $document_id );
        }else if ( $owner_type == 'all_not_empty' || $owner_type == 'all not empty' ) {
                $sql = "SELECT * FROM  document_owner a LEFT OUTER JOIN  user b ON a.user_id = b.user_id WHERE a.document_id = ? AND a.user_id IS NOT null UNION SELECT * FROM document_owner a RIGHT OUTER JOIN  user b ON a.user_id = b.user_id WHERE a.document_id = ? AND a.user_id IS NOT NULL";
                $escaped_values = array( $document_id, $document_id );
            }else {
            if ( $owner_type == null ) {
                $sql = "SELECT * FROM {$db_table} a LEFT JOIN  user b on a.user_id = b.user_id   WHERE a.document_id = ? AND a.document_owner_type IS ?";
            }else {
                $sql = "SELECT * FROM {$db_table} a LEFT JOIN  user b on a.user_id = b.user_id   WHERE a.document_id = ? AND a.document_owner_type = ?";
            }

            $escaped_values = array( $document_id, $owner_type );
        }

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_equipment_history_questions_by_category( $category_id, $question_level = '2', $type = 'object' ) {

        $db_table = "equipment_history_question";
        $db_primary = "equipment_history_question_id";

        $sql = "SELECT * FROM {$db_table} a, equipment_history_category b WHERE a.equipment_history_category_id = b.equipment_history_category_id AND b.equipment_history_category_id = ? AND a.question_level IN ('both', ?)";

        $sql .= " ORDER BY b.order";

        $query = $this->db->query( $sql, array( $category_id, $question_level ) );

        if ( $type == 'array' ) {
            $result = $query->result_array();
        }else {
            $result = $query->result();
        }


        return $result;

    }

    public function get_equipment_history_categories( $question_level = '2', $type = 'object' ) {

        $db_table = "equipment_history_question";
        $db_primary = "equipment_history_question_id";

        $sql = "SELECT DISTINCT(d.equipment_history_category_id) as category_id, a.name as category_name, a.description, a.`order` FROM equipment_history_question d, equipment_history_category a WHERE a.equipment_history_category_id = d.equipment_history_category_id AND d.question_level IN(?,'both')";

        $query = $this->db->query( $sql, array( $question_level ) );

        if ( $type == 'array' ) {
            $result = $query->result_array();
        }else {
            $result = $query->result();
        }


        return $result;
    }

    public function get_all_equipment_history_questions() {

        $db_table = "equipment_history_question";
        $db_primary = "equipment_history_question_id";

        $sql = "SELECT * FROM {$db_table}";

        $escaped_values = array( $document_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_all_equipment_history_questions_with_answer( $document_id, $question_level = '2' ) {

        $db_table = "equipment_history_question";
        $db_primary = "equipment_history_question_id";

        $sql = "SELECT * FROM {$db_table} a, equipment_history_answer b WHERE a.equipment_history_question_id = b.equipment_history_question_id AND b.document_id = ? AND a.question_level IN ('both', ?)";

        $escaped_values = array( $document_id, $question_level );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;

    }


    public function get_equipment_history_questions( $document_id, $question_level = '2', $type = 'object' ) {

        $db_table = "equipment_history_question";
        $db_primary = "equipment_history_question_id";

        $sql = "SELECT * FROM {$db_table} a, equipment_history_category b, equipment_history_answer c WHERE (a.equipment_history_category_id = b.equipment_history_category_id AND c.document_id = ? AND c.{$db_primary} = a.{$db_primary}) AND a.question_level IN ('both', ?)";

        $sql .= " ORDER BY b.order";

        $query = $this->db->query( $sql, array( $document_id, $question_level ) );

        if ( $type == 'array' ) {
            $result = $query->result_array();
        }else {
            $result = $query->result();
        }


        return $result;
    }


    public function get_equipment_history_questions_with_answer( $document_id, $question_level = '2', $type = 'object' ) {

        $db_table = "equipment_history_question";
        $db_primary = "equipment_history_question_id";

        $answer = "yes";

        $sql = "SELECT * FROM {$db_table} a, equipment_history_category b, equipment_history_answer c WHERE (a.equipment_history_category_id = b.equipment_history_category_id AND c.document_id = ? AND c.{$db_primary} = a.{$db_primary}) AND a.question_level IN ('both', ?) AND c.answer = ?";

        $sql .= " ORDER BY b.order";

        $query = $this->db->query( $sql, array( $document_id, $question_level, $answer ) );

        if ( $type == 'array' ) {
            $result = $query->result_array();
        }else {
            $result = $query->result();
        }


        return $result;
    }


    public function get_equipment_history_answers_by_category( $document_id, $category_id, $type = 'object' ) {

        $db_table = "equipment_history_question";
        $db_primary = "equipment_history_question_id";

        $sql = "SELECT * FROM equipment_history_answer WHERE document_id = ? AND equipment_history_category_id = ?";

        $query = $this->db->query( $sql, array( $document_id, $category_id ) );

        if ( $type == 'array' ) {
            $result = $query->result_array();
        }else {
            $result = $query->result();
        }


        return $result;
    }


    public function get_equipment_history_category_answer( $document_id, $category_id ) {

        $db_table = "equipment_history_question";
        $db_primary = "equipment_history_question_id";

        $sql = "SELECT * FROM equipment_history_category_answer WHERE document_id = ? AND equipment_history_category_id = ?";

        $query = $this->db->query( $sql, array( $document_id, $category_id ) );

        $result = $query->result();


        return $result;
    }


    public function get_equipment_history_answer_by_category( $document_id, $category_id ) {

        $db_table = "equipment_history_question";
        $db_primary = "equipment_history_question_id";

        $sql = "SELECT * FROM equipment_history_answer a, equipment_history_question b WHERE a.document_id = ? AND b.equipment_history_category_id = ? AND a.equipment_history_question_id = b.equipment_history_question_id AND a.answer = ?";

        $query = $this->db->query( $sql, array( $document_id, $category_id, 'yes' ) );

        $result = $query->result();


        return $result;

    }


    public function get_equipment_history_categories_with_answer( $document_id ) {

        $answer = 'yes';

        $sql = "SELECT DISTINCT(a.equipment_history_category_id), a.equipment_history_category_id as category_id, a.name as category_name, a.* FROM equipment_history_category a, equipment_history_answer b, equipment_history_question c WHERE c.equipment_history_category_id = a.equipment_history_category_id AND b.equipment_history_question_id = c.equipment_history_question_id AND b.document_id = ? AND b.answer = ?";

        $query = $this->db->query( $sql, array( $document_id, $answer ) );

        $result = $query->result();

        return $result;

    }


    /*public function get_equipment_history_categories_with_answer($document_id){

        $menu_id = $this->get_menu_id_by_value(1, 'generic_yes_no', 'menu');

        $sql = "SELECT distinct(a.equipment_history_category_id) as category_id, b.name as category_name  FROM equipment_history_answer a, equipment_history_category b WHERE a.equipment_history_category_id = b.equipment_history_category_id AND a.`comment` NOT IN('',' ','  ') AND a.equipment_history_category_id IN(SELECT DISTINCT(d.equipment_history_category_id) FROM equipment_history_category_answer d WHERE d.answer = ? AND d.document_id = ?) AND a.document_id = ?";

        $query = $this->db->query($sql, array($menu_id, $document_id, $document_id));

        $result = $query->result();

        return $result;
    }*/


    public function get_all_documents_empty_equipment_history() {

        $document_types = "'basic-decf','case-file'";

        $sql = "SELECT DISTINCT (c.document_id) FROM document c WHERE c.document_id NOT IN(SELECT DISTINCT(b.document_id) FROM equipment_history_category_answer b WHERE b.document_id IN(SELECT DISTINCT(a.document_id) FROM document a WHERE a.document_type IN ({$document_types}))) AND c.document_type IN({$document_types})";

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;

    }



    public function five_why_count( $document_id, $answer = 'yes' ) {

        $sql = "SELECT count(answer) as count FROM equipment_history_answer WHERE document_id = ? AND answer = ?;";

        $escaped_values = array( $document_id, 'yes' );

        $query = $this->db->query( $sql, $escaped_values );

        $row = $query->row();

        return $row->count;
    }

    public function search_document( $user_name = null, $name = null, $code = null, $user_date = null, $asset_type = null, $justification = null, $date_of_issue = null, $system = null, $system_subcategory = null, $equipment_category = null, $equipment_class = null, $equipment_description = null, $equipment_tag_number = null, $equipment_unique_id = null, $equipment_manufacturer = null, $equipment_model = null, $equipment_power_output = null, $equipment_failed_component = null ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        if ( $asset_type != null || $justification != null || $user_date != null || $date_of_issue != null ) {
            $search_sql = "SELECT DISTINCT(a.{$db_primary}), a.* FROM {$db_table} a, user b, decf c WHERE a.document_completed = 1 AND c.{$db_primary} = a.{$db_primary} ";
        }else if ( $system != null || $system_subcategory != null || $equipment_category != null || $equipment_class != null || $equipment_description != null || $equipment_tag_number != null || $equipment_unique_id != null || $equipment_manufacturer != null || $equipment_model != null || $equipment_power_output != null || $equipment_failed_component != null ) {

                $search_sql = "SELECT DISTINCT(a.{$db_primary}), a.* FROM {$db_table} a, user b, equipment_profile c WHERE a.document_completed = 1 AND c.{$db_primary} = a.{$db_primary}";

            }else {
            $search_sql = "SELECT DISTINCT(a.{$db_primary}), a.* FROM {$db_table} a, user b WHERE a.document_completed = 1 ";
        }



        if ( $user_name != null ) {
            $search_sql .= " AND (b.user_name LIKE '%{$user_name}%' OR b.first_name LIKE '%{$user_name}%' OR b.last_name LIKE '%{$user_name}%' OR CONCAT_WS(' ', b.first_name, b.last_name) LIKE '%{$user_name}%')";
        }

        if ( $name != null ) {
            $search_sql .= " AND a.name LIKE '%{$name}%'";
        }

        if ( $code != null ) {
            $search_sql .= " AND a.code LIKE '%{$code}%'";
        }

        if ( $asset_type != null ) {
            $search_sql .= " AND c.asset_type = {$asset_type}";
        }

        if ( $justification != null ) {
            $search_sql .= " AND c.justification = {$justification}";
        }

        if ( $system != null ) {
            $search_sql .= " AND c.system_id = {$system}";
        }

        if ( $system_subcategory != null ) {
            $search_sql .= " AND c.system_subcategory_id = {$system_subcategory}";
        }

        if ( $equipment_category != null ) {
            $search_sql .= " AND c.equipment_category_id = {$equipment_category}";
        }

        if ( $equipment_class != null ) {
            $search_sql .= " AND c.equipment_class_id = {$equipment_class}";
        }

        if ( $equipment_description != null ) {
            $search_sql .= " AND c.equipment_description_id = {$equipment_description}";
        }

        if ( $equipment_tag_number != null ) {
            $search_sql .= " AND c.tag_number LIKE '%{$equipment_tag_number}%'";
        }

        if ( $equipment_unique_id != null ) {
            $search_sql .= " AND c.unique_id LIKE '%{$equipment_unique_id}%'";
        }

        if ( $equipment_manufacturer != null ) {
            $search_sql .= " AND c.manufacturer LIKE '%{$equipment_manufacturer}%'";
        }

        if ( $equipment_model != null ) {
            $search_sql .= " AND c.model LIKE '%{$equipment_model}%'";
        }

        if ( $equipment_power_output != null ) {
            $search_sql .= " AND c.power_output LIKE '%{$equipment_power_output}%'";
        }

        if ( $equipment_failed_component != null ) {
            $search_sql .= " AND c.failed_component LIKE '%{$equipment_failed_component}%'";
        }


        //DATES

        if ( $date_of_issue != null ) {
            $search_sql .= " AND c.date_of_issue = '{$date_of_issue}'";
        }

        if ( $user_date != null ) {
            $search_sql .= " AND c.decf_date = '{$user_date}'";
        }



        $query = $this->db->query( $search_sql );

        //echo $this->db->last_query();

        $result = $query->result();

        return $result;
    }

    public function search_document_new($author = null, $document_name = null, $document_type = null, $document_status =null, $start_date = null, $end_date = null, $system = null, $system_subcategory = null, $equipment_category = null, $equipment_class = null, $equipment_description = null, $equipment_tag_number = null, $equipment_unique_id = null, $equipment_manufacturer = null, $equipment_model = null, $equipment_power_output = null, $equipment_failed_component = null ) {

        $sql = "SELECT * FROM document a, document_owner b, document_type d WHERE a.document_id = b.document_id AND b.document_owner_type = 'owner' ";

        if ( $system != null || $system_subcategory != null || $equipment_category != null || $equipment_class != null || $equipment_description != null || $equipment_tag_number != null || $equipment_unique_id != null || $equipment_manufacturer != null || $equipment_model != null || $equipment_power_output != null || $equipment_failed_component != null ) {
            $sql = "SELECT * FROM document a, document_owner b, equipment_profile c, document_type d WHERE a.document_id = b.document_id AND a.document_id = c.document_id AND b.document_owner_type = 'owner' ";

            if ( $system != null ) {
                $sql .= " AND c.system_id = {$system}";
            }

            if ( $system_subcategory != null ) {
                $sql .= " AND c.system_subcategory_id = {$system_subcategory}";
            }

            if ( $equipment_category != null ) {
                $sql .= " AND c.equipment_category_id = {$equipment_category}";
            }

            if ( $equipment_class != null ) {
                $sql .= " AND c.equipment_class_id = {$equipment_class}";
            }

            if ( $equipment_description != null ) {
                $sql .= " AND c.equipment_description_id = {$equipment_description}";
            }

            if ( $equipment_tag_number != null ) {
                $sql .= " AND c.tag_number LIKE '%{$equipment_tag_number}%'";
            }

            if ( $equipment_unique_id != null ) {
                $sql .= " AND c.unique_id LIKE '%{$equipment_unique_id}%'";
            }

            if ( $equipment_manufacturer != null ) {
                $sql .= " AND c.manufacturer LIKE '%{$equipment_manufacturer}%'";
            }

            if ( $equipment_model != null ) {
                $sql .= " AND c.model LIKE '%{$equipment_model}%'";
            }

            if ( $equipment_power_output != null ) {
               $sql .= " AND c.power_output LIKE '%{$equipment_power_output}%'";
            }

            if ( $equipment_failed_component != null ) {
               $sql .= " AND c.failed_component LIKE '%{$equipment_failed_component}%'";
            }
        }

        if($author != null){
            $sql .= " AND b.user_id = {$author} ";
        }

        if($document_name != null){
            $sql .= " AND a.`name` LIKE '%{$document_name}%' ";
        }

        if($document_type != null){
            $sql .= " AND d.document_code = '{$document_type}' AND a.document_type_id = d.document_type_id ";
        }else{
            $sql .= "  AND a.document_type_id = d.document_type_id ";
        }

        if($document_status != null){
            $sql .= " AND a.document_status = {$document_status} ";
        }

        if($start_date != null || $start_date != ''){

            if($end_date == null || $end_date == ''){
                $sql .= " AND a.date_created > '{$start_date}' ";
            }
            else{
                $sql .= " AND a.date_created < '{$end_date}' ";   
            }
            
        }

        $query = $this->db->query( $sql );

        //echo $this->db->last_query();

        $result = $query->result();

        return $result;
    }

    public function get_single_action_tracker($action_tracker_id){ //document connected only

        $sql = "SELECT document_type.document_name, action_join_document.* FROM (SELECT 
action_tracker_table.*, 
document.`name`,
document.`code`,
document.date_created,
document.document_completed,
document.document_status,
document.document_type_id,
document.notification_sent
  FROM 
(SELECT * FROM action_tracker WHERE action_tracker_id = ?) as action_tracker_table LEFT JOIN document ON document.document_id = action_tracker_table.document_id) as action_join_document LEFT JOIN document_type ON document_type.document_type_id = action_join_document.document_type_id LIMIT 1";

        $escaped_values = array($action_tracker_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row();

        return $result;

    }

    //for action trackers linked to documents
    public function get_action_tracker( $user_id, $document_id = null, $status = null, $reference_id = null ) {
        //TODO:
        $db_table = 'action_tracker';
        $db_primary = 'document_id';

        $action_tracker_sql = "SELECT a.*, b.`code`, b.`name`,c.user_id  FROM action_tracker a, document b, document_owner c WHERE a.document_id = b.document_id AND b.document_id = c.document_id AND c.user_id = {$user_id}";

        if ( $document_id != null ) {
            $action_tracker_sql .= " AND a.document_id = {$document_id}";
        }

        if ( $status != null ) {
            $action_tracker_sql .= " AND a.status = {$status}";
        }

        if ( $reference_id != null || $reference_id != '' ) {
            $action_tracker_sql .= " AND a.reference LIKE '%{$reference_id}%'";
        }

        $action_tracker_sql .= " ORDER BY b.`code`";

        $query = $this->db->query( $action_tracker_sql );

        $result = $query->result();

        return $result;
    }


    public function get_master_action_tracker( $main_filter, $sub_filter, $optional_filter = null ) {

        $db_table = 'action_tracker';

        $action_tracker_sql = "SELECT a.*,b.`name`,b.`code` AS doc_code FROM action_tracker a LEFT JOIN document b ON a.document_id = b.document_id";

        if ( $owner != 'none' ) {
            $action_tracker_sql .= " WHERE a.`owner` = {$owner}";
        }
        else {
            $action_tracker_sql .= " WHERE a.`owner` IS NOT NULL AND a.`owner` != ''";
        }

        if ( $status != 'none' && $status != '' ) {
            $action_tracker_sql .= " AND a.`status` = {$status}";
        }

        $criticality_analysis_start_sql = "SELECT e.*,tracker.* FROM (";

        $criticality_analysis_end_sql  = ") as tracker LEFT JOIN criticality_analysis e ON tracker.criticality_analysis = e.criticality_analysis_id ORDER BY tracker.due_date ASC";

        //final sql
        $action_tracker_sql = $criticality_analysis_start_sql . $action_tracker_sql . $criticality_analysis_end_sql;

        $query = $this->db->query( $action_tracker_sql );

        $result = $query->result();

        return $result;
    }


    //master action tracker
    public function get_master_action_tracker_old( $owner = 'none', $status = null ) {

        $db_table = 'action_tracker';

        $action_tracker_sql = "SELECT a.*,b.`name`,b.`code` AS doc_code FROM action_tracker a LEFT JOIN document b ON a.document_id = b.document_id";

        if ( $owner != 'none' ) {
            $action_tracker_sql .= " WHERE a.`owner` = {$owner}";
        }
        else {
            $action_tracker_sql .= " WHERE a.`owner` IS NOT NULL AND a.`owner` != ''";
        }

        if ( $status != 'none' && $status != '' ) {
            $action_tracker_sql .= " AND a.`status` = {$status}";
        }

        $criticality_analysis_start_sql = "SELECT e.*,tracker.* FROM (";

        $criticality_analysis_end_sql  = ") as tracker LEFT JOIN criticality_analysis e ON tracker.criticality_analysis = e.criticality_analysis_id ORDER BY tracker.due_date ASC";

        //final sql
        $action_tracker_sql = $criticality_analysis_start_sql . $action_tracker_sql . $criticality_analysis_end_sql;

        $query = $this->db->query( $action_tracker_sql );

        $result = $query->result();

        return $result;
    }

    public function get_subaction_tracker( $action_tracker_id = null ) {
        $db_table = 'subaction_tracker';

        if ( $action_tracker_id != null ) {

            $sql = "SELECT a.*,b.`name`,b.`code` AS doc_code FROM subaction_tracker a LEFT JOIN document b ON a.document_id = b.document_id WHERE a.action_tracker_id = {$action_tracker_id}";
        }
        else {

            $sql = "SELECT a.*,b.`name`,b.`code` AS doc_code FROM subaction_tracker a LEFT JOIN document b ON a.document_id = b.document_id";

        }

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function get_single_master_action_tracker( $action_tracker_id ) {

        $db_table = 'action_tracker';

        $action_tracker_sql = "SELECT a.*,b.`name`,b.`code` AS doc_code FROM action_tracker a LEFT JOIN document b ON a.document_id = b.document_id WHERE a.action_tracker_id = {$action_tracker_id} ";

        $criticality_analysis_start_sql = "SELECT e.*,tracker.* FROM (";

        $criticality_analysis_end_sql  = ") as tracker LEFT JOIN criticality_analysis e ON tracker.criticality_analysis = e.criticality_analysis_id ORDER BY tracker.due_date ASC";

        //final sql
        $action_tracker_sql = $criticality_analysis_start_sql . $action_tracker_sql . $criticality_analysis_end_sql;

        $query = $this->db->query( $action_tracker_sql );

        $result = $query->row();

        return $result;
    }

    //get list of equipment for action tracker
    public function get_master_action_tracker_equipment() {

        $db_table = 'criticality_analysis';

        $sql = "SELECT criticality_analysis_id, description FROM {$db_table}";

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function get_hired_equipment_register( $user_id, $status = null ) {
        //TODO:
        $db_table = 'hired_equipment_registers';
        $db_primary = 'document_id';

        $equipment_register_sql = "SELECT a.* FROM hired_equipment_register a, `user` c WHERE a.user_id = c.user_id AND c.user_id = {$user_id}";

        if ( $status != null ) {
            $equipment_register_sql .= " AND a.status = {$status}";
        }

        $equipment_register_sql .= " ORDER BY a.hired_equipment_register_id";

        $query = $this->db->query( $equipment_register_sql );

        $result = $query->result();

        return $result;

    }

    public function count_user_document_status( $document_id ){

        $sql = "SELECT count(*) as count FROM document_status WHERE document_id = ?";

        $escaped_values = array( $document_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row()->count;

        return $result;

    }

    public function get_user_document_status( $document_id, $limit, $offset ) {

        $sql = "SELECT b.`name` as status_name, c.first_name,c.last_name, a.status_date FROM document_status a, menu b, `user` c WHERE a.`status` = b.menu_id AND a.status_initiator = c.user_id AND a.document_id = ?  ORDER BY a.document_status_id DESC LIMIT {$limit} OFFSET {$offset} ";

        $escaped_values = array( $document_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_weekly_plan( $user_id ) {

        $sql = "SELECT *, b.`name` as status_name FROM weekly_plan a LEFT JOIN menu b ON a.user_id = ? AND b.menu_id = a.status";

        $escaped_values = array( $user_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        //var_dump($result);

        return $result;
    }


    //UPDATE FUNCTIONS
    public function update( $id, $name ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET name = ? WHERE {$db_primary} = ?";

        $escaped_values = array( $name, $id );

        $query = $this->db->query( $sql, $escaped_values );
    }

    public function update_equipment_profile( $id, $system, $system_subcategory, $equipment_category, $equipment_class, $equipment_description, $equipment_tag_number, $equipment_unique_id, $equipment_manufacturer, $equipment_model, $equipment_power_output, $equipment_failed_component ) {

        $db_table = 'equipment_profile';
        $db_primary = 'document_id';

        $sql = "UPDATE {$db_table} SET system_id = ?, system_subcategory_id = ?, equipment_category_id = ?, equipment_class_id = ?, equipment_description_id = ?, tag_number = ?, unique_id = ?, manufacturer = ?, model = ?, power_output = ?, failed_component = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $system, $system_subcategory, $equipment_category, $equipment_class, $equipment_description, $equipment_tag_number, $equipment_unique_id, $equipment_manufacturer, $equipment_model, $equipment_power_output, $equipment_failed_component, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_document_owner( $document_id, $user_ids, $main_user_id ) {

        $db_table = 'document_owner';
        $db_primary = 'document_id';

        //$user_exception = "AND (user_id != {$main_user_id} OR user_id is null)";

        $id_results = $this->get_document_owners( $document_id, null );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->document_owner_id;
            $user_id = $user_ids[$i];




            if ( $user_id != $main_user_id ) {
                if ( $user_id == '' || $user_id == ' ' ) {
                    $user_id = null;
                    continue;
                }else {
                    $sql = "UPDATE {$db_table} SET user_id = ? WHERE document_owner_id = ?";
                    $query = $this->db->query( $sql, array( $user_id, $id ) );
                }

            }

            $i++;
        }
    }

    public function update_file( $document_id, $step_no, $filenames ) {

        $db_table = "file";
        $db_primary = "document_id";

        $id_results = $this->get_sub_table_step( $document_id, $db_table, $db_primary, $step_no );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->file_id;
            $filename = $filenames[$i];

            if ( $filename != '' || !empty( $filename ) ) {
                $sql = "UPDATE {$db_table} SET filename = ? WHERE file_id = ?";
                $query = $this->db->query( $sql, array( $filename, $id ) );
            }

            $i++;
        }
    }


    public function update_file_item( $document_id, $step_no, $filenames ) {

        $db_table = "file";
        $db_primary = "document_id";

        $id_results = $this->get_sub_table_step( $document_id, $db_table, $db_primary, $step_no );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->file_id;
            $filename = $filenames[$i];

            if ( $filename != '' || !empty( $filename ) ) {
                $sql = "UPDATE {$db_table} SET file_item_id = ? WHERE file_id = ?";
                $query = $this->db->query( $sql, array( $filename, $id ) );
            }

            $i++;
        }
    }

    public function create_file_action_tracker( $action_tracker_id = null, $subaction_tracker_id = null, $filenames ) {
        $db_table = "file";
        $db_primary = "document_id";

        $i = 0;

        foreach ( $filenames as $file ) {
            $filename = $file;

            if ( $filename != '' || !empty( $filename ) ) {
                $sql = "INSERT INTO {$db_table} (action_tracker_id,subaction_tracker_id,filename) VALUES (?, ?, ?)";

                $escaped_values = array( $action_tracker_id, $subaction_tracker_id, $filename );
                $query = $this->db->query( $sql, $escaped_values );
            }

            $i++;
        }
    }

    public function update_why( $answer_id, $why_1, $why_2, $why_3, $why_4, $why_5, $five_why_answer, $six_why_answer, $six_why_1, $six_why_2, $six_why_3, $six_why_4, $six_why_5, $six_why_6 ) {

        $db_table = "equipment_history_answer";
        $db_primary = "equipment_history_answer_id";

        $sql = "UPDATE {$db_table} SET why_1 = ?, why_2 = ?, why_3 = ?, why_4 = ?, why_5 = ?, five_why_answer = ?, six_why_answer = ?, six_why_1 = ?, six_why_2 = ?, six_why_3 = ?, six_why_4 = ?, six_why_5 = ?, six_why_6 = ? WHERE {$db_primary} = ?";

        $escaped_values = array( $why_1, $why_2, $why_3, $why_4, $why_5, $five_why_answer, $six_why_answer, $six_why_1, $six_why_2, $six_why_3, $six_why_4, $six_why_5, $six_why_6, $answer_id );

        $query = $this->db->query( $sql, $escaped_values );
    }

    public function update_answer( $document_id, $question_id, $select_answer, $comment, $start_date, $end_date, $start_date_dropdown, $end_date_dropdown, $duration ) {

        $db_table = "equipment_history_answer";
        $db_primary = "equipment_history_answer_id";

        $sql = "UPDATE {$db_table} SET answer = ?, comment = ?, start_date = ?, end_date = ?, start_date_dropdown = ?, end_date_dropdown = ?, duration = ? WHERE document_id = ? AND {$db_primary} = ?";

        $escaped_values = array( $select_answer, $comment, $start_date, $end_date, $start_date_dropdown, $end_date_dropdown, $duration, $document_id, $question_id );

        $query = $this->db->query( $sql, $escaped_values );
    }

    public function update_category_answer( $category_answer_id, $category_answer ) {

        $sql = "UPDATE equipment_history_category_answer SET answer = ? WHERE equipment_history_category_answer_id = ?";

        $escaped_values = array( $category_answer, $category_answer_id );

        $query = $this->db->query( $sql, $escaped_values );

    }

    public function update_organisation( $document_id, $names, $roles, $other, $mobiles, $emails, $commitments ) {

        $db_table = "organisation";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET name = ?, role = ?, other = ?, mobile = ?, email = ?, commitment = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $names[$i], $roles[$i], $other[$i], $mobiles[$i], $emails[$i], $commitments[$i], $id ) );
            $i++;
        }
    }

    public function update_action_tracker( $document_id, $reference, $action_process_step, $status, $owner, $due_date, $comments, $change_status ) {

        $db_table = "action_tracker";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;

            if ( $result->document_id != null ) {
                $reference = $this->get_value( $result->document_id, 'code', 'document', 'document_id' );
                $ref_array = explode( "-", $reference );
                array_pop( $ref_array );
                $reference_code = implode( "-", $ref_array );
                $reference_code = strtoupper( $reference_code ).'-'.$id;
                //$document_model->update_value($id, 'reference', $reference_code, 'action_tracker', 'action_tracker_id');
            }

            $sql = "UPDATE {$db_table} SET reference = ?, action_process_step = ?, status = ?, owner = ?, due_date = ?, comments = ?, change_status = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $reference_code, $action_process_step[$i], $status[$i], $owner[$i], $due_date[$i], $comments[$i], $change_status[$i], $id ) );
            $i++;
        }
    }

    public function update_reporting( $document_id, $originator, $receiver, $frequency, $format ) {

        $db_table = "reporting";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET originator = ?, receiver = ?, frequency_id = ?, format_id = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $originator[$i], $receiver[$i], $frequency[$i], $format[$i], $id ) );
            $i++;
        }
    }

    public function update_meeting( $document_id, $attendees, $agenda, $frequency, $location ) {

        $db_table = "meeting";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET attendees = ?, agenda = ?, frequency_id = ?, location = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $attendees[$i], $agenda[$i], $frequency[$i], $location[$i], $id ) );
            $i++;
        }
    }

    public function update_deliverable( $document_id, $deliverable_descriptions, $location, $responsible, $start_dates, $due_dates ) {

        $db_table = "deliverable";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;

            if($start_dates[$i] == ''){
                $end_date = '';
            }
            else{
                $end_date = $due_dates[$i];

                if($due_dates[$i] == '' || $due_dates[$i] == null){
                    $end_date = $start_dates[$i];
                }
            }

                

            $sql = "UPDATE {$db_table} SET description = ?, location = ?, responsible = ?, start_date = ?, due_date = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $deliverable_descriptions[$i], $location[$i], $responsible[$i], $start_dates[$i], $end_date, $id ) );
            $i++;
        }
    }

    public function update_expectation( $document_id, $supplier, $input, $process_deliverable, $output, $receiver ) {

        $db_table = "expectation";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET supplier = ?, input = ?, process_deliverable = ?, output = ?, receiver = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $supplier[$i], $input[$i], $process_deliverable[$i], $output[$i], $receiver[$i], $id ) );
            $i++;
        }
    }

    public function update_action_log( $document_id, $action, $action_party, $due_date, $status ) {

        $db_table = "action_log";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET action = ?, action_party = ?, due_date = ?, status_id = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $action[$i], $action_party[$i], $due_date[$i], $status[$i], $id ) );
            $i++;
        }
    }

    public function update_milestone( $document_id, $event, $milestone_date, $milestone_status ) {

        $db_table = "milestone";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET event = ?, milestone_date = ?, milestone_status = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $event[$i], $milestone_date[$i], $milestone_status[$i], $id ) );
            $i++;
        }

    }

    public function update_change_management( $document_id, $event, $responsible_party, $due_date, $area_of_authority ) {

        $db_table = "change_management";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET event = ?, responsible_party = ?, due_date = ?, area_of_authority = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $event[$i], $responsible_party[$i], $due_date[$i], $area_of_authority[$i], $id ) );
            $i++;
        }

    }

    //case file level 2 cost breakdown
    public function update_simple_cost_breakdown( $document_id, $item_id, $description ) {

        $db_table = "cost_breakdown";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET item_id = ?, description = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $item_id[$i], $description[$i], $id ) );
            $i++;
        }
    }

    public function update_cost_breakdown( $document_id, $item_id, $description, $estimated_unit_cost = "", $estimated_volume = "", $estimated_subtotal = "", $status = "" ) {

        $db_table = "cost_breakdown";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET item_id = ?, description = ?, estimated_unit_cost = ?, estimated_volume = ?, estimated_subtotal = ?, status = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $item_id[$i], $description[$i], $estimated_unit_cost[$i], $estimated_volume[$i], $estimated_subtotal[$i], $status[$i], $id ) );
            $i++;
        }
    }

    public function update_cost_breakdown_total_actual( $document_id, $description, $estimated_unit_cost = "", $estimated_volume = "", $estimated_subtotal = "", $actual_unit_cost ="", $actual_volume = "", $actual_subtotal = "" ) {

        $db_table = "cost_breakdown";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET description = ?, estimated_unit_cost = ?, estimated_volume = ?, estimated_subtotal = ?, actual_unit_cost = ?, actual_volume = ?, actual_subtotal = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $description[$i], $estimated_unit_cost[$i], $estimated_volume[$i], $estimated_subtotal[$i], $actual_unit_cost[$i], $actual_volume[$i], $actual_subtotal[$i], $id ) );
            $i++;
        }
    }

    //simple benefits breakdown case file level 2
    public function update_simple_benefits_breakdown( $document_id, $item_id, $description ) {

        $db_table = "benefits_breakdown";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET item_id = ?, description = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $item_id[$i], $description[$i], $id ) );
            $i++;
        }
    }

    public function update_benefits_breakdown( $document_id, $item_id, $description, $unit_cost = "", $volume = "", $subtotal = "", $status = "" ) {

        $db_table = "benefits_breakdown";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET item_id = ?, description = ?, unit_cost = ?, volume = ?, subtotal = ?, status = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $item_id[$i], $description[$i], $unit_cost[$i], $volume[$i], $subtotal[$i], $status[$i], $id ) );
            $i++;
        }
    }

    public function update_enablers( $document_id, $special_requirements, $description, $responsible, $due_date ) {

        $db_table = "enabler";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET specialist_requirement_id = ?, description = ?, responsible = ?, due_date = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $special_requirements[$i], $description[$i], $responsible[$i], $due_date[$i], $id ) );
            $i++;
        }
    }

    public function update_enablers_prerequisite( $document_id, $prerequisites ) {

        $db_table = "prerequisite";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET description = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $prerequisites[$i], $id ) );
            $i++;
        }
    }

    public function update_enablers_dependencies( $document_id, $dependencies ) {

        $db_table = "dependency";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET description = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $dependencies[$i], $id ) );
            $i++;
        }
    }

    public function update_constraints( $document_id, $constraints, $mitigating_actions, $action_parties, $due_date ) {

        $db_table = "constraints";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET constraints = ?, mitigating_action = ?, action_party = ?, due_date_on_status = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $constraints[$i], $mitigating_actions[$i], $action_parties[$i], $due_date[$i], $id ) );
            $i++;
        }
    }

    public function update_next_steps( $document_id, $process_steps, $process_responsible ) {

        $db_table = "next_step";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET process_step = ?, responsible = ? WHERE  {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $process_steps[$i], $process_responsible[$i], $id ) );
            $i++;
        }
    }

    public function update_rate_of_success( $document_id, $areas_of_impact, $results ) {

        $db_table = "rate_of_success";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET area_of_impact_id = ?, result_id = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $areas_of_impact[$i], $results[$i], $id ) );
            $i++;
        }
    }

    public function update_test_process( $document_id, $events, $responsibles ) {

        $db_table = "test_process";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET event = ?, responsible = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $events[$i], $responsibles[$i], $id ) );
            $i++;
        }
    }

    public function update_process_step( $document_id, $events, $responsibles ) {

        $db_table = "process_step";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET event = ?, responsible = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $events[$i], $responsibles[$i], $id ) );
            $i++;
        }
    }

    public function update_quality_control_step( $document_id, $events, $responsibles ) {

        $db_table = "quality_control_step";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET event = ?, responsible = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $events[$i], $responsibles[$i], $id ) );
            $i++;
        }
    }

    public function update_responsible_party( $document_id, $events, $responsibles ) {

        $db_table = "responsible_party";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET role_id = ?, name_id = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $events[$i], $responsibles[$i], $id ) );
            $i++;
        }
    }

    public function update_responsible_party_role( $document_id, $role_id, $name_id ) {

        $db_table = "responsible_party";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET role_id = ?, name_id = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $role_id[$i], $name_id[$i], $id ) );
            $i++;
        }
    }

    public function update_interested_party( $document_id, $events, $responsibles ) {

        $db_table = "interested_party";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET role_id = ?, name_id = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $events[$i], $responsibles[$i], $id ) );
            $i++;
        }
    }

    public function update_interested_party_role( $document_id, $role_id, $name_id ) {

        $db_table = "interested_party";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET role_id = ?, name_id = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $role_id[$i], $name_id[$i], $id ) );
            $i++;
        }
    }

    public function update_timeline( $document_id, $events, $times, $dates, $status ) {

        $db_table = "timeline";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET event = ?, time = ?, date = ?, status = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $events[$i], $times[$i], $dates[$i], $status[$i], $id ) );
            $i++;
        }
    }

    public function update_type_of_improvement( $document_id, $type_of_improvements ) {

        $db_table = "type_of_improvement";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET type_of_improvement = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $type_of_improvements[$i], $id ) );
            $i++;
        }
    }

    public function update_failure_cause( $document_id, $failure_causes, $sub_divisions ) {

        $db_table = "failure_cause";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET failure_cause_category_id = ?, failure_cause_subdivision_id = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $failure_causes[$i], $sub_divisions[$i], $id ) );
            $i++;
        }
    }

    public function update_failure_impact( $document_id, $areas_of_impact, $consequences ) {

        $db_table = "failure_impact";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $area_of_impact_description_id = $this->get_value_multiple_var( 'area_of_impact_id', 'consequence_id', $areas_of_impact[$i], $consequences[$i], 'area_of_impact_consequence_id', 'area_of_impact_consequence' );
            $sql = "UPDATE {$db_table} SET area_of_impact_id = ?, consequence_id = ?, area_of_impact_consequence_id = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $areas_of_impact[$i], $consequences[$i], $area_of_impact_description_id, $id ) );
            $i++;
        }
    }

    public function update_maintenance_activity( $document_id, $maintenance_activities ) {

        $db_table = "maintenance_activity";
        $db_primary = "{$db_table}_id";

        $id_results = $this->get_sub_table( $document_id, $db_table );

        $i = 0;
        foreach ( $id_results as $result ) {
            $id = $result->$db_primary;
            $sql = "UPDATE {$db_table} SET activity_id = ? WHERE {$db_primary} = ?";
            $query = $this->db->query( $sql, array( $maintenance_activities[$i], $id ) );
            $i++;
        }
    }

    public function update_review_status( $document_id, $document_status, $reviewed_by, $reviewed_date ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET document_status = ?, reviewed_by = ?, reviewed_date = ? WHERE {$db_primary} = ?";

        $escaped_values = array( $document_status, $reviewed_by, $reviewed_date, $document_id );

        $query = $this->db->query( $sql, $escaped_values );
    }

    public function update_approve_status( $document_id, $document_status, $approved_by, $approved_date ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET document_status = ?, approved_by = ?, approved_date = ? WHERE {$db_primary} = ?";

        $escaped_values = array( $document_status, $approved_by, $approved_date, $document_id );

        $query = $this->db->query( $sql, $escaped_values );
    }

    public function update_publish_status( $document_id, $document_status, $published_by, $published_date ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET document_status = ?, published_by = ?, published_date = ? WHERE {$db_primary} = ?";

        $escaped_values = array( $document_status, $published_by, $published_date, $document_id );

        $query = $this->db->query( $sql, $escaped_values );
    }

    public function update_document_status( $document_id, $document_status ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET document_status = ? WHERE {$db_primary} = ?";

        $escaped_values = array( $document_status, $document_id );

        $query = $this->db->query( $sql, $escaped_values );
    }

    public function new_document_status( $model_id, $document_status, $status_initiator, $status_date ) {

        $db_table = 'document_status';
        $db_primary = 'document_status_id';

        $sql = "INSERT INTO document_status (document_id, status, status_initiator, status_date ) VALUES (?, ?, ?, NOW())";

        $escaped_values = array( $model_id, $document_status, $status_initiator );

        $query = $this->db->query( $sql, $escaped_values );
    }

    public function update_document_cost_breakdown( $document_id, $cost_breakdown_estimated_total, $cost_breakdown_actual_total ='', $cost_breakdown_variation = '' ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        if ( $cost_breakdown_actual_total == '' ) {
            $sql = "SELECT cost_breakdown_actual_total FROM {$db_table} WHERE {$db_primary} = ?";

            $escaped_values = array( $document_id );

            $query = $this->db->query( $sql, $escaped_values );

            $result = $query->row();

            $cost_breakdown_actual_total = $result->cost_breakdown_actual_total;

        }

        $cost_breakdown_variation = abs( floatval( $cost_breakdown_estimated_total ) - floatval( $cost_breakdown_actual_total ) );

        //put two decimal places on the total values
        $cost_breakdown_variation = number_format( $cost_breakdown_variation, 2, '.', ' ' );

        $cost_breakdown_actual_total = number_format( $cost_breakdown_actual_total, 2, '.', ' ' );

        $sql = "UPDATE {$db_table} SET cost_breakdown_estimated_total = ?, cost_breakdown_actual_total = ?, cost_breakdown_variation = ? WHERE {$db_primary} = ?";

        $escaped_values = array( $cost_breakdown_estimated_total, $cost_breakdown_actual_total, $cost_breakdown_variation, $document_id );

        $query = $this->db->query( $sql, $escaped_values );
    }

    public function update_document_benefits_breakdown_total( $document_id, $benefits_breakdown_total ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET benefits_breakdown_total = ? WHERE {$db_primary} = ?";

        $escaped_values = array( $benefits_breakdown_total, $document_id );

        $query = $this->db->query( $sql, $escaped_values );
    }



    //DELETE FUNCTIONS
    public function delete( $id ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "DELETE FROM {$db_table} WHERE {$db_primary} = ?";

        $escaped_values = array( $id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->last_query();
    }



    public function count_document_per_type( $user_id, $db_table, $code_like = null ) {
        $table_id = $db_table.'_id';

        if ( empty( $code_like ) ) {
            $sql = "SELECT COUNT(a.{$table_id}) AS doc_count FROM {$db_table} a, document_owner b WHERE  b.user_id = ? AND a.document_id = b.document_id";

            $escaped_values = array( $user_id );
        }else {
            $sql = "SELECT COUNT(a.{$table_id}) AS doc_count FROM {$db_table} a, document_owner b, document c WHERE  a.document_id = b.document_id AND b.document_id = c.document_id  AND b.user_id = ? AND c.code LIKE ?";

            $escaped_values = array( $user_id, $code_like.'%' );
        }

        $query = $this->db->query( $sql, $escaped_values );

        return $query->row()->doc_count;

    }

    public function count_document($document_type){

        $table_id = 'document_id';

        $sql = "SELECT COUNT({$table_id}) AS doc_count FROM document a, document_type d_type WHERE d_type.document_type_id = a.document_type_id AND d_type.document_code = ?";

        $escaped_values = array($document_type);

        $query = $this

        ->db->query( $sql, $escaped_values );

        return $query->row()->doc_count;

    } 


    public function get_document_follower_id($document_id, $user_id){

        $db_table = "document_follower";
        $db_primary = "document_follower_id";

        $sql = "SELECT {$db_primary} FROM {$db_table} WHERE document_id = ? AND user_id = ?";

        $escaped_values = array($document_id, $user_id);

        $query = $this->db->query($sql, $escaped_values);

        if ( $query->num_rows() > 0 ) {
            $result = $query->row()->{$db_primary};
        }else{
            $result = null;
        }

        return $result;

    }


    public function follow_document($document_id, $user_id){

        $db_table = "document_follower";
        $db_primary = "document_follower_id";

        $sql = "INSERT INTO {$db_table} (document_id, user_id) VALUES(?,?)";

        $escaped_values = array($document_id, $user_id);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();

    }


    public function unfollow_document($document_id, $user_id){


        $db_table = "document_follower";
        $db_primary = "document_follower_id";

        $sql = "DELETE FROM {$db_table} WHERE document_id = ? AND user_id = ?";

        $escaped_values = array($document_id, $user_id);

        $query = $this->db->query($sql, $escaped_values);


    }


    public function get_user_document_follow_status($document_id, $user_id){

        $db_table = "document_follower";
        $db_primary = "document_follower_id";

        $sql = "SELECT {$db_primary} FROM {$db_table} WHERE document_id = ? AND user_id = ?";

        $escaped_values = array($document_id, $user_id);

        $query = $this->db->query($sql, $escaped_values);

        //echo $this->db->last_query();

        if ( $query->num_rows() > 0 ) {
            $result = 1;
        }else{
            $result = 0;
        }

        return $result;

    }

    //TODO: get followers for equipment category

    public function get_document_followers_by_user($user_id){

        $db_table = "document_follower";
        $db_primary = "document_follower_id";

        $sql = "SELECT document_owner_followers_with_names.*, document.name as document_name FROM document JOIN (SELECT document_owner_followers.document_id, document_owner_followers.user_id, `user`.first_name, `user`.last_name, `user`.email_address FROM `user` JOIN (SELECT document_owner.document_id, document_follower.user_id
            from document_owner
            JOIN document_follower 
            ON document_owner.document_id = document_follower.document_id 
            where document_owner.user_id = ?) as document_owner_followers ON `user`.user_id = document_owner_followers.user_id) as document_owner_followers_with_names ON document_owner_followers_with_names.document_id = document.document_id";

        $query = $this->db->query($sql, array($user_id));

        $result = $query->result();

        return $result;
    }

    public function get_document_followers($document_id){

        $db_table = "document_follower";
        $db_primary = "document_follower_id";

        $sql = "SELECT a.*,b.first_name,b.last_name,b.email_address,c.`name`, c.`code`, d_type.document_code FROM {$db_table} a, `user` b, document c, document_type d_type WHERE d_type.document_type_id = c.document_type_id AND a.user_id = b.user_id AND a.document_id = c.document_id AND a.document_id = ?";

        $escaped_values = array($document_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }



    public function update_document($document_id, $document_owner_id, $title, $description){

        $db_table = "document_update";
        $db_primary = "document_update_id";

        $sql = "INSERT INTO {$db_table} (title, description, document_id, document_owner_id, update_date) VALUES(?,?,?,?,NOW())";

        $escaped_values = array($title, $description, $document_id, $document_owner_id);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();

    }


    public function update_document_comment($document_update_id, $comment, $user_id){

        $db_table = "document_update_comment";
        $db_primary = "document_update_comment_id";

        $sql = "INSERT INTO {$db_table} (comment, user_id, document_update_id, comment_date) VALUES(?,?,?,NOW())";

        $escaped_values = array($comment, $user_id, $document_update_id);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();

    }


    public function get_document_updates($document_id){

        $db_table = "document_update";
        $db_primary = "document_update_id";

        $sql = "SELECT distinct(c.{$db_primary}), c.title, c.description, b.first_name, b.last_name, b.user_photo, c.update_date from document_owner a, user b, {$db_table} c WHERE a.document_id = ? AND a.document_owner_id = c.document_owner_id AND a.user_id = b.user_id ORDER BY c.{$db_primary} DESC";

        $escaped_values = array($document_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;

    }

    public function get_document_update_comments($document_update_id){

        $db_table = "document_update_comment";
        $db_primary = "document_update_comment_id";

        $sql = "SELECT DISTINCT(a.document_update_comment_id), a.comment, a.comment_date, a.user_id, b.user_photo, b.first_name, b.last_name  FROM {$db_table} a, user b WHERE document_update_id = ? AND a.user_id = b.user_id";

        $escaped_values = array($document_update_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;

    }


    public function get_document_owner_id($document_id, $user_id){

        $db_table = "document_owner";
        $db_primary = "document_owner_id";

        $sql = "SELECT {$db_primary} FROM {$db_table} WHERE document_id = ? AND user_id = ?";

        $escaped_values = array($document_id, $user_id);

        $query = $this->db->query($sql, $escaped_values);

        if ( $query->num_rows() > 0 ) {
            $row = $query->row();
            $result = $row->document_owner_id;
        }else{
            $result = null;
        }

        return $result;

    }


    public function get_documents_by_type($document_type){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT * FROM {$db_table} a, document_type b WHERE b.document_code = ? AND b.document_type_id = a.document_type_id AND name NOT IN('', ' ') AND name IS NOT null";

        $escaped_values = array($document_type);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;

    }

    public function get_allowed_documents_for_action_tracker(){

        $sql = "SELECT * FROM allowed_action_tracker_document_type a, document_type b WHERE a.document_type_id = b.document_type_id";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;

    }


    //public function 
}
?>
