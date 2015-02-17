<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class MY_Model extends CI_Model {
    const DB_TABLE = 'abstract';
    const DB_TABLE_PK = 'abstract';

    public function array_from_post( $fields ) {

        $data = array();

        foreach ( $fields as $field ) {
            $data[$field] = $this->input->post( $field );
        }

        return $data;

        //ex. $this->user_model->array_from_post(array('name','email','password'));
    }

    public function get_preferences( $preference_type ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT * FROM user_preference_category a, user_preference b WHERE a.user_preference_category_id = b.user_preference_category_id AND ";
    }

    public function get_main_menu( $menu_type, $menu_level = "menu", $visibility_level = null ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        if ( $visibility_level == null ) {
            $sql = "SELECT DISTINCT(a.menu_id), a.* FROM menu a, menu_category b WHERE a.menu_category_id = b.menu_category_id AND b.menu_type = ? ORDER BY a.order";
            $escaped_values = array( $menu_type );
        }else {
            $sql = "SELECT DISTINCT(a.menu_id), a.* FROM menu a, menu_category b WHERE a.menu_category_id = b.menu_category_id AND b.menu_type = ? AND a.level IN('both', ?) ORDER BY a.order";
            $escaped_values = array( $menu_type, $visibility_level );
        }


        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_all_subcategories($menu_type){

        $sql = "SELECT menu_subcategory.menu_id, menu_table.`name` as menu_name, menu_subcategory.menu_subcategory_id, menu_subcategory.`name`, menu_table.color_class FROM (SELECT DISTINCT(a.menu_id), a.`name`, a.color_class FROM menu a, menu_category b WHERE a.menu_category_id = b.menu_category_id AND b.menu_type = ? ORDER BY a.order) as menu_table JOIN menu_subcategory ON menu_subcategory.menu_id = menu_table.menu_id";

        $escaped_values = array($menu_type);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;

    }

    public function get_notification_info( $notification_type ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT DISTINCT(a.notification_id), a.* FROM notification a, notification_category b WHERE a.notification_category_id = b.notification_category_id AND b.name = ?";

        $escaped_values = array( $notification_type );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_menu_subcategory( $menu_id, $menu_type, $visibility_level = null ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        if ( $visibility_level == null ) {
            $sql = "SELECT * FROM menu_category a, menu b, menu_subcategory c WHERE a.menu_type = ? AND b.menu_id = ? AND a.menu_category_id = b.menu_category_id AND b.menu_id = c.menu_id ORDER BY c.order";

            $escaped_values = array( $menu_type, $menu_id );
        }else {
            $sql = "SELECT * FROM menu_category a, menu b, menu_subcategory c WHERE a.menu_type = ? AND b.menu_id = ? AND a.menu_category_id = b.menu_category_id AND b.menu_id = c.menu_id AND c.level IN('both', ?) ORDER BY c.order";

            $escaped_values = array( $menu_type, $menu_id, $visibility_level );
        }

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_menu_deep_subcategory( $menu_subcategory_id, $menu_type, $visibility_level = null ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        if ( $visibility_level == null ) {
            $sql = "SELECT * FROM menu_category a, menu b, menu_subcategory c, menu_deep_subcategory d WHERE a.menu_type = ? AND a.menu_category_id = b.menu_category_id AND b.menu_id = c.menu_id AND c.menu_subcategory_id = ? AND c.menu_subcategory_id = d.menu_subcategory_id ORDER BY d.order";

            $escaped_values = array( $menu_type, $menu_subcategory_id );
        }else {
            $sql = "SELECT * FROM menu_category a, menu b, menu_subcategory c, menu_deep_subcategory d WHERE a.menu_type = ? AND a.menu_category_id = b.menu_category_id AND b.menu_id = c.menu_id AND c.menu_subcategory_id = ? AND c.menu_subcategory_id = d.menu_subcategory_id AND d.level IN('both',?) ORDER BY d.order";

            $escaped_values = array( $menu_type, $menu_subcategory_id, $visibility_level );
        }


        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_menu_value( $id, $menu_type, $menu_level, $menu_detail ) {

        switch ( $menu_level ) {
        case 'menu':

            $sql = "SELECT a.{$menu_detail} FROM menu a, menu_category b WHERE a.menu_category_id = b.menu_category_id AND b.menu_type = ? AND a.menu_id = ?";

            $escaped_values = array( $menu_type, $id );

            break;

        case 'subcategory':

            $sql = "SELECT c.{$menu_detail} FROM menu_category a, menu b, menu_subcategory c WHERE a.menu_type = ? AND a.menu_category_id = b.menu_category_id AND b.menu_id = c.menu_id AND c.menu_subcategory_id = ?";

            $escaped_values = array( $menu_type, $id );

            break;

        case 'deep_subcategory':

            $sql = "SELECT d.{$menu_detail} FROM menu_category a, menu b, menu_subcategory c, menu_deep_subcategory d WHERE a.menu_type = ? AND a.menu_category_id = b.menu_category_id AND b.menu_id = c.menu_id AND c.menu_subcategory_id = d.menu_subcategory_id AND d.menu_deep_subcategory_id = ?";

            $escaped_values = array( $menu_type, $id );

            break;


        default:
            // code...
            break;
        }


        $query = $this->db->query( $sql, $escaped_values );

        $num_rows = $query->num_rows();

        if ( $num_rows == 0 ) {
            $result = '';
        }else {
            $row = $query->row();
            $result = $row->$menu_detail;
        }

        return $result;
    }

    public function get_key_value_subcategory( $foreign_key_id, $foreign_key_column, $table_name, $column_name, $key_value ) {

        $sql = "SELECT * FROM {$table_name} WHERE {$foreign_key_column} = ? ORDER BY {$column_name}";

        $query = $this->db->query( $sql, array( $foreign_key_id ) );

        $result = $query->result();

        $new_result = array();



        if ( $key_value ) {
            foreach ( $result as $row ) {
                $new_result[$row->id] = $row->{$column_name};
            }
        }else {
            foreach ( $result as $row ) {
                $new_result[] = $row->{$column_name};
            }
        }

        return $new_result;
    }

    public function get_key_value( $table_name, $column_name, $key_value ) {

        $sql = "SELECT * FROM {$table_name}";

        $query = $this->db->query( $sql );

        $result = $query->result();

        $new_result = array();



        if ( $key_value ) {
            foreach ( $result as $row ) {
                $new_result[$row->id] = $row->{$column_name};
            }
        }else {
            foreach ( $result as $row ) {
                $new_result[] = $row->{$column_name};
            }
        }

        return $new_result;
    }

    public function get_all_records( $table_name = null ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        if ( !empty( $table_name ) ) {
            $db_table = $table_name;
        }

        $sql = "SELECT * FROM {$db_table}";
        $query = $this->db->query( $sql );

        $admin_data_results = $query->result();

        return $admin_data_results;
    }

    // To FIX.
    // get row instead of result.
    public function get_record( $id ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "SELECT * FROM {$db_table} WHERE {$db_primary} = ?";

        $query = $this->db->query( $sql, array( $id ) );

        $result = $query->result();

        return $result;
    }

    public function count_record( $id ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "SELECT count({$db_primary}) as count FROM {$db_table} WHERE {$db_primary} = ?";

        $query = $this->db->query( $sql, array( $id ) );

        //$result = $query->result();
        $row = $query->row();
        $result = $row->count;

        return $result;
    }

    public function get_record_subcategory( $subcategory_id, $subcategory_table_name, $subcategory_column_name, $column_to_select = '*', $specific = false, $code = null, $current_step_no = null, $has_ref_id = false, $sql_last_query_string = false, $last_query_string = 'ORDER BY row_order ASC, id DESC' ) {

        if ( $specific ) {
            if ( $has_ref_id ) {
                if ( $sql_last_query_string ) {
                    $sql = "SELECT {$column_to_select} FROM {$subcategory_table_name} WHERE {$subcategory_column_name} = ? AND code = ? {$last_query_string}";
                }else {
                    $sql = "SELECT {$column_to_select} FROM {$subcategory_table_name} WHERE {$subcategory_column_name} = ? AND code = ?";
                }
                $query = $this->db->query( $sql, array( $subcategory_id, $code ) );
            }else {
                if ( $sql_last_query_string ) {
                    $sql = "SELECT {$column_to_select} FROM {$subcategory_table_name} WHERE {$subcategory_column_name} = ? AND code = ? AND current_step_no = ? {$last_query_string}";
                }else {
                    $sql = "SELECT {$column_to_select} FROM {$subcategory_table_name} WHERE {$subcategory_column_name} = ? AND code = ? AND current_step_no = ?";
                }

                $query = $this->db->query( $sql, array( $subcategory_id, $code, $current_step_no ) );
            }


        }else {
            $sql = "SELECT {$column_to_select} FROM {$subcategory_table_name} WHERE {$subcategory_column_name} = ?";
            $query = $this->db->query( $sql, array( $subcategory_id ) );
        }

        $result = $query->result();

        return $result;
    }

    public function get_record_by_code( $ref_id = null, $code = null, $column_name = '*', $code_column_name = 'code' ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        if ( $ref_id == null ) {
            $sql = "SELECT {$column_name} FROM {$db_table} WHERE {$code_column_name} = ?";
            $query = $this->db->query( $sql, array( $code ) );
        }else if ( $code == null ) {
                $sql = "SELECT {$column_name} FROM {$db_table} WHERE ref_id = ?";
                $query = $this->db->query( $sql, array( $ref_id ) );
            }else {
            $sql = "SELECT {$column_name} FROM {$db_table} WHERE ref_id = ? AND {$code_column_name} = ?";
            $query = $this->db->query( $sql, array( $ref_id, $code ) );
        }

        if ( $column_name == '*' ) {
            $result = $query->result();
        }else {
            $row = $query->row();
            $result = $row->$column_name;
        }

        //echo $sql;


        return $result;
    }

    public function get_value( $id, $value = '*', $table_name = null, $db_primary = null ) {

        if ( empty( $db_primary ) ) {
            $db_primary = $this::DB_TABLE_PK;
        }

        if ( empty($id) || $id == '' ) {
            $value = '';
            //echo 'test';
        }else {

            if ( $table_name == null ) {
                $table_name = $this::DB_TABLE;
            }

            $this->db->select( $value );
            $this->db->from( $table_name );
            $this->db->where( array( $db_primary => $id ) );
            $query = $this->db->get();

            //echo $this->db->last_query();

            if ( $query->num_rows() > 0 ) {
                $row = $query->row();
                $value = $row->$value;
            }else {
                $value = '';
            }


        }

        //var_dump($value);




        return $value;
    }

    public function get_record_by_column_value( $column_name, $column_value, $value = '*', $table_name = null ) {

        if ( $table_name == null ) {
            $table_name = $this::DB_TABLE;
        }

        $this->db->select( $value );
        $this->db->from( $table_name );
        $this->db->where( array( $column_name => $column_value ) );
        $query = $this->db->get();

        if ( $value == '*' ) {

            if ( $query->num_rows() > 0 ) {
                $result = $query->row();
            }else {
                $result = '';

            }
            //echo 'test';


            return $result;

        }else {

            if ( $query->num_rows() == 1 ) {

                $row = $query->row();
                $value = $row->$value;

            }else if ( $query->num_rows() > 1 ) {
                    $value = $query->result();
                }else {
                $value = '';
            }


            return $value;

        }
    }

    public function get_value_multiple_var( $id1_name, $id2_name, $id1_value, $id2_value, $value = '*', $table_name = null ) {

        if ( $id1_value == null || $id2_value == null || $id1_value == '' || $id2_value == '' || $id1_value == 0 || $id2_value == 0 ) {
            $value = '';
        }else {

            if ( $table_name == null ) {
                $table_name = $this::DB_TABLE;
            }

            $this->db->select( $value );
            $this->db->from( $table_name );
            $this->db->where( array( $id1_name => $id1_value, $id2_name => $id2_value ) );
            $query = $this->db->get();

            $result = $query->num_rows();

            if ( $result>0 ) {
                $row = $query->row();
                $value = $row->$value;
            }else {
                $value = '';
            }


            if ( empty( $value ) ) {
                $value = '';
            }

        }




        return $value;
    }

    public function get_sub_table_same_value( $code, $column_name, $value, $table_name ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $db_table = $table_name;

        $sql = "SELECT {$column_name} FROM {$db_table} WHERE code = ? AND {$column_name} = ?";
        $query = $this->db->query( $sql, array( $code, $value ) );

        $result = $query->result();

        return $result;
    }

    public function update_value( $id, $column_name, $value, $table_name = null, $new_db_primary = null ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        if ( $table_name != null ) {
            $db_table = $table_name;
        }

        if ( $new_db_primary != null ) {
            $db_primary = $new_db_primary;
        }

        $sql = "UPDATE {$db_table} SET {$column_name} = ? WHERE {$db_primary} = ?";
        $query = $this->db->query( $sql, array( $value, $id ) );

        //echo $this->db->last_query();
    }

    public function delete_value( $id, $table_name = null, $column_name = null ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        if ( $table_name != null ) {
            $db_table = $table_name;
        }

        if ( $column_name != null ) {
            $db_primary = $column_name;
        }

        $sql = "DELETE FROM {$db_table} WHERE {$db_primary} = ?";
        $query = $this->db->query( $sql, array( $id ) );
    }

    public function delete_record_by_column_value( $column_name, $column_value, $table_name = null ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        if ( $table_name != null ) {
            $db_table = $table_name;
        }

        $sql = "DELETE FROM {$db_table} WHERE {$column_name} = ?";
        $query = $this->db->query( $sql, array( $column_value ) );
    }

    public function get_form_status( $form_id, $document_id, $no_of_step, $just_get_status = false ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $form_status = 0;

        for ( $i=1;$i<=$no_of_step;$i++ ) {
            $step_status = $this->get_value( $form_id, 'step_'.$i.'_completed' );
            if ( $step_status == 0 ) {
                $form_status = 0;
                break;
            }else {
                $form_status = 1;
                continue;
            }
        }

        if ( !$just_get_status ) {
            if ( $form_status == 1 ) {

                $this->load->model( 'Document_Model' );
                $document_model = new Document_Model();

                $document_model->update_value( $document_id, 'document_completed', $form_status );

                return $form_status;
            }
        }else {
            return $form_status;
        }
    }

    /**
     * Create record.
     */
    private function insert() {
        $this->db->insert( $this::DB_TABLE, $this );
        $this->{$this::DB_TABLE_PK} = $this->db->insert_id();
    }

    /**
     * Update record.
     */
    private function update() {
        $this->db->update( $this::DB_TABLE, $this, $this::DB_TABLE_PK );
    }

    /**
     * Populate from an array or standard class.
     *
     * @param mixed   $row
     */
    public function populate( $row ) {
        foreach ( $row as $key => $value ) {
            $this->$key = $value;
        }
    }

    /**
     * Load from the database.
     *
     * @param int     $id
     */
    public function load( $id ) {
        $query = $this->db->get_where( $this::DB_TABLE, array(
                $this::DB_TABLE_PK => $id,
            ) );
        $this->populate( $query->row() );
    }

    /**
     * Delete the current record.
     */
    public function delete() {
        $this->db->delete( $this::DB_TABLE, array(
                $this::DB_TABLE_PK => $this->{$this::DB_TABLE_PK},
            ) );
        unset( $this->{$this::DB_TABLE_PK} );
    }

    /**
     * Save the record.
     */
    public function save() {
        if ( isset( $this->{$this::DB_TABLE_PK} ) ) {
            $this->update();
        }
        else {
            $this->insert();
        }
    }

    /**
     * Get an array of Models with an optional limit, offset.
     *
     * @param int     $limit  Optional.
     * @param int     $offset Optional; if set, requires $limit.
     * @return array Models populated by database, keyed by PK.
     */
    public function get( $limit = 0, $offset = 0 ) {
        if ( $limit ) {
            $query = $this->db->get( $this::DB_TABLE, $limit, $offset );
        }
        else {
            $query = $this->db->get( $this::DB_TABLE );
        }
        $ret_val = array();
        $class = get_class( $this );
        foreach ( $query->result() as $row ) {
            $model = new $class;
            $model->populate( $row );
            $ret_val[$row->{$this::DB_TABLE_PK}] = $model;
        }
        return $ret_val;
    }

    public function row_count() {
        return $this->db->count_all( $this::DB_TABLE );
    }

    public function check_duplicate( $column_name, $value, $data_type = 'string' ) {

        $table_name = $this::DB_TABLE;

        if ( $data_type == 'string' ) {
            $sql = "SELECT $column_name FROM $table_name WHERE {$column_name} = '$value'";
        }else {
            $sql = "SELECT $column_name FROM $table_name WHERE {$column_name} = $value";
        }

        $query = $this->db->query( $sql );
        $result = $query->num_rows();

        if ( $result > 0 ) {
            return true;
        }else {
            return false;
        }
    }

    //SUB TABLE METHODS

    public function get_user_sub_table( $user_id, $db_table, $document_type = 'all', $additional_sql = '' ) {

        if ( $document_type != 'all' ) {
            $sql = "SELECT * FROM action_tracker a, document b, document_owner c WHERE a.document_id = b.document_id AND b.document_id = c.document_id AND c.user_id = ? AND b.document_type = ? ORDER BY b.code";
            $sql .= ' '.$additional_sql;
            $escaped_values = array( $user_id, $document_type );
        }else {
            $sql = "SELECT * FROM action_tracker a, document b, document_owner c WHERE a.document_id = b.document_id AND b.document_id = c.document_id AND c.user_id = ? ORDER BY b.code";
            $sql .= ' '.$additional_sql;
            $escaped_values = array( $user_id );
        }

        $query = $this->db->query( $sql, $escaped_values );

        return $query->result();

        return $result;
    }

    public function get_sub_table( $id, $db_table, $db_primary = 'document_id', $additional_sql = '' ) {


        $sql = "SELECT * FROM {$db_table} WHERE {$db_primary} = ?";
        $sql .= ' '.$additional_sql;
        $escaped_values = array( $id );


        $query = $this->db->query( $sql, $escaped_values );

        return $query->result();

        return $result;
    }

    public function get_sub_table_step( $id, $db_table, $db_primary = 'document_id', $step_no, $additional_sql = '' ) {


        $sql = "SELECT * FROM {$db_table} WHERE {$db_primary} = ? AND step_no = ?";
        $sql .= ' '.$additional_sql;
        $escaped_values = array( $id, $step_no );


        $query = $this->db->query( $sql, $escaped_values );

        return $query->result();

        //return $result;
    }

    public function get_files_by_document_step($document_id, $step_no){

        $sql = "SELECT file.*, file_item.filename as file_item_name FROM file LEFT JOIN file_item on file.file_item_id = file_item.file_item_id WHERE file.document_id = ? AND file.step_no = ?";

        //$sql = "SELECT file_type.name, file_info.* FROM file_type,(SELECT file.*, file_item.filename as file_item_name, file_item.type FROM file LEFT JOIN file_item on file.file_item_id = file_item.file_item_id WHERE file.document_id = ? AND file.step_no = ?) as file_info WHERE file_info.type = file_type.file_type_id";

        $escaped_values = array($document_id, $step_no);

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_tb_files_by_column($document_id, $upload_column){

        $sql = "SELECT tb.{$upload_column}, file_item.filename as file_item_name FROM technical_bulletin  AS tb LEFT JOIN file_item on tb.{$upload_column} = file_item.file_item_id WHERE tb.document_id = ?";

        $escaped_values = array($document_id);

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row();

        return $result;
    }

    public function get_filename($file_item_id){

        $sql = "SELECT filename FROM file_item WHERE file_item_id = ?";

        $escaped_values = array($file_item_id);

        $query = $this->db->query($sql, $escaped_values);

        if ( $query->num_rows() > 0 ) {
            $result = $query->row()->filename;
        }else{
            $result = '';
        }

        return $result;

    }

    public function get_files_master_action_tracker( $action_tracker_id = null, $subaction_tracker_id = null ) {

        $sql = "SELECT * FROM file WHERE ";

        if ( $action_tracker_id != null ) {
            $sql .= "action_tracker_id = {$action_tracker_id}";
        }else {
            $sql .= "subaction_tracker_id = {$subaction_tracker_id}";
        }

        $query = $this->db->query( $sql );

        return $query->result();
    }

    public function create_empty_sub_table( $id, $db_table, $count = 1, $db_primary = 'document_id' ) {


        $sql = "INSERT INTO {$db_table} ({$db_primary}) VALUES (?)";
        $escaped_values = array( $id );



        for ( $i = 0;$i<$count;$i++ ) {
            $query = $this->db->query( $sql, $escaped_values );
        }

        return $this->db->insert_id();
    }

    public function create_empty_sub_table_step( $id, $db_table, $count = 1, $db_primary = 'document_id', $step_no ) {


        $sql = "INSERT INTO {$db_table} ({$db_primary}, step_no) VALUES (?, ?)";
        $escaped_values = array( $id, $step_no );



        for ( $i = 0;$i<$count;$i++ ) {
            $query = $this->db->query( $sql, $escaped_values );
        }

        return $this->db->insert_id();
    }

    public function delete_sub_table( $id, $db_table, $count = 1, $db_primary = 'document_id', $last_row = true ) {


        if ( $last_row ) {
            $sql = "DELETE FROM {$db_table} WHERE {$db_primary} = {$id} ORDER BY {$db_table}_id DESC LIMIT {$count}";
        }else {
            $sql = "DELETE FROM {$db_table} WHERE {$db_primary} = {$id}";
        }

        $query = $this->db->query( $sql );

        //echo $sql;
    }

    public function delete_sub_table_step( $id, $db_table, $count = 1, $db_primary = 'document_id', $step_no , $last_row = true ) {


        if ( $last_row ) {
            $sql = "DELETE FROM {$db_table} WHERE {$db_primary} = {$id} AND step_no = {$step_no} ORDER BY {$db_table}_id DESC LIMIT {$count}";
        }else {
            $sql = "DELETE FROM {$db_table} WHERE {$db_primary} = {$id} AND step_no = {$step_no}";
        }


        $query = $this->db->query( $sql );

        //echo $sql;
    }

    public function empty_sub_table( $document_id, $db_table ) {

        $sql = "DELETE FROM {$db_table} WHERE document_id = ?";
        $query = $this->db->query( $sql, array( $document_id ) );
    }

    //DUPLICATE FUNCTIONS
    public function duplicate( $id, $db_table = null, $db_primary = null) {

        if($db_table === null){
            $db_table = $this::DB_TABLE;
        }

        if($db_primary === null){
            $db_primary =$this::DB_TABLE_PK;
        }
        
        //echo $db_primary;

        $where = "{$db_primary} = {$id}";

        $this->db->query( "DROP TEMPORARY TABLE IF EXISTS tmp;" );
        $this->db->query( "CREATE TEMPORARY TABLE tmp SELECT * from {$db_table} WHERE ( " . $where . " );" );
        $this->db->query( "ALTER TABLE tmp drop {$db_primary};" );
        $this->db->query( "INSERT INTO {$db_table} SELECT null,tmp.* FROM tmp; " );

        //echo '<br>';
        //echo $this->db->last_query();
        $form_id = $this->db->insert_id();

        $this->db->query( "DROP TABLE tmp;" );


        return $form_id;
    }

    public function duplicate_sub_table( $sub_table = null, $old_document_id, $new_document_id, $sub_primary = "document_id" ) {


        $db_table = $this::DB_TABLE;
        $db_primary = $sub_table.'_id';

        if ( empty( $sub_table ) ) {
            $sub_table = $db_table;
            $db_primary = $this::DB_TABLE_PK;
        }

        $where = "{$sub_primary} = {$old_document_id}";

        $this->db->query( "DROP TEMPORARY TABLE IF EXISTS tmp;" );
        $this->db->query( "CREATE TEMPORARY TABLE tmp SELECT * from {$sub_table} WHERE ( " . $where . " );" );
        $this->db->query( "ALTER TABLE tmp drop {$db_primary};" );
        $this->db->query( "ALTER TABLE tmp drop {$sub_primary}" );
        $this->db->query( "INSERT INTO {$sub_table} SELECT null,tmp.*,{$new_document_id} FROM tmp; " );

        //$form_id = $this->db->insert_id();

        $this->db->query( "DROP TABLE tmp;" );


        //return $form_id;
    }

    /* USER */

    public function get_user_form( $cust_id, $code_like = null ) {

        //get documents owned/contributed by user

        $db_table = $this::DB_TABLE;
        $db_primary = 'document_id';

        if ( empty( $code_like ) ) {
            $sql = "SELECT *, d.name as document_status_value, b.name as document_name, b.code as code FROM {$db_table} a, document b, document_owner c, menu d, document_type d_type WHERE d_type.document_type_id = b.document_type_id AND a.{$db_primary} = b.{$db_primary} AND c.user_id = ? AND c.{$db_primary} = b.{$db_primary} AND d.menu_id = b.document_status";
            $escaped_values = array( $cust_id );
        }else {
            $sql = "SELECT *, d.name as document_status_value, b.name as document_name, b.code as code FROM {$db_table} a, document b, document_owner c, menu d, document_type d_type WHERE d_type.document_type_id = b.document_type_id AND a.{$db_primary} = b.{$db_primary} AND c.user_id = ? AND c.{$db_primary} = b.{$db_primary} AND b.code LIKE ? AND d.menu_id = b.document_status";
            $escaped_values = array( $cust_id, $code_like.'%' );
        }

        $query = $this->db->query( $sql, $escaped_values );

        return $query->result();

        echo '<br>';
        echo $this->db->last_query();
    }

    public function verify_form_permission( $document_id, $user_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        if ( $user_id > 0 ) {
            $sql = "SELECT * FROM document_owner WHERE document_id = ? AND user_id = ?";
            $query = $this->db->query( $sql, array( $document_id, $user_id ) );

            if ( $query->num_rows() > 0 ) {
                return true;
            } else {
                return false;
            }

        }else {
            return false;
        }
    }


    /* DOCUMENT */

    public function get_owner_details_of_document($document_id){
        $sql = "SELECT * FROM document_owner, `user` WHERE document_owner.document_owner_type = 'owner' AND document_owner.document_id = {$document_id} AND `user`.user_id = document_owner.user_id";

        $query = $this->db->query($sql);

        $result = $query->row();

        return $result;
    }

    public function get_document( $document_id, $get_form_id = false ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;
        $document_primary = 'document_id';


        $sql = "SELECT * FROM {$db_table} a, document b, equipment_profile c, document_type d_type WHERE b.{$document_primary} = ? AND a.{$document_primary} = b.{$document_primary} AND a.{$document_primary} = c.{$document_primary} AND d_type.document_type_id = b.document_type_id";

        $escaped_values = array(
            $document_id
        );

        $query = $this->db->query( $sql, $escaped_values );

        if ( $get_form_id ) {
            return $query->row()->{$db_primary};
        }else {
            return $query->row();
        }
    }

    public function create_empty_document( $document_type_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;
        

        $this->load->model( 'Document_Model' );
        $document_model = new Document_Model();

        $document_id = $document_model->create_empty( $document_type_id );

        $sql = "INSERT INTO {$db_table} (document_id) VALUES (?)";

        $escaped_values = array( $document_id );

        $query = $this->db->query( $sql, $escaped_values );
        return $document_id;
    }

    public function check_doc_with_no_subtable( $table_name, $id_name = 'document_id' ) {
        $db_table = $table_name;
        $db_primary = $id_name;

        $sql = "SELECT a.{$db_primary} FROM document a where a.{$db_primary} not in (SELECT {$db_primary} from {$db_table})";

        $query = $this->db->query( $sql );

        return $query->result();
    }

    public function check_doc_with_null_status() {
        $db_table = 'document';
        $db_primary = 'document_status';

        $sql = "SELECT * FROM {$db_table} WHERE {$db_primary} IS NULL";

        $query = $this->db->query( $sql );

        return $query->result();
    }

    public function add_document_status( $document_id ) {

        $sql = "SELECT a.menu_id FROM menu a,menu_category b WHERE a.menu_category_id = b.menu_category_id AND b.menu_type = ? AND a.`name` = ?";

        $escaped_values = array( 'document_status', 'In Progress' );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row();

        $in_progress = $result->menu_id;

        $db_table = 'document';
        $column_name = 'document_status';
        $db_primary = 'document_id';

        $sql = "UPDATE {$db_table} SET {$column_name} = ? WHERE {$db_primary} = ?";

        $escaped_values_2 = array( $in_progress, $document_id );

        $query_2 = $this->db->query( $sql, $escaped_values_2 );
    }

    public function update_costbreakdown_fields( $model_id ) {

        $db_table = 'document';
        $db_primary = 'document_id';


        $sql = "SELECT actual_subtotal, estimated_subtotal FROM cost_breakdown WHERE {$db_primary} = ?";

        $escaped_values = array( $model_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        $actual_subtotal = 0;
        $estimated_subtotal = 0;

        foreach ( $result as $item ) {
            $actual_subtotal += floatval( $item->actual_subtotal );
            $estimated_subtotal += floatval( $item->estimated_subtotal );
        }

        $c_actual_total = $actual_subtotal;
        $c_estimated_total = $estimated_subtotal;


        $c_variation = abs( floatval( $c_actual_total ) - floatval( $c_estimated_total ) );

        $c_actual_total = number_format( $c_actual_total, 2, '.', ' ' );
        $c_estimated_total = number_format( $c_estimated_total, 2, '.', ' ' );
        $c_variation = number_format( $c_variation, 2, '.', ' ' );

        $sql = "UPDATE {$db_table} SET cost_breakdown_estimated_total = ?, cost_breakdown_actual_total =?, cost_breakdown_variation = ? WHERE {$db_primary} = ?";

        $escaped_values_2 = array( $c_estimated_total, $c_actual_total, $c_variation, $model_id );

        $query_2 = $this->db->query( $sql, $escaped_values_2 );

        $c_estimated_total = floatval( $c_estimated_total );

        $data = array(
            'c_actual_total'=>$c_actual_total,
            'c_variation' => $c_variation,
            'c_estimated_total' => $c_estimated_total
        );

        return $data;
    }

    public function get_menu_id_by_value( $value, $menu_type, $menu_level, $menu_name = null ) {
        switch ( $menu_level ) {
        case 'menu':

            $sql = "SELECT a.* FROM menu a, menu_category b WHERE a.menu_category_id = b.menu_category_id AND b.menu_type = ? AND a.value = ?";

            $escaped_values = array( $menu_type, $value );

            if ( $menu_name != null ) {
                $sql .= " AND a.name = ?";
                array_push( $escaped_values, $menu_name );
            }

            break;

        case 'subcategory':

            $sql = "SELECT c.* FROM menu_category a, menu b, menu_subcategory c WHERE a.menu_type = ? AND a.menu_category_id = b.menu_category_id AND b.menu_id = c.menu_id AND c.value = ?";

            $escaped_values = array( $menu_type, $value );

            break;

        case 'deep_subcategory':

            $sql = "SELECT d.* FROM menu_category a, menu b, menu_subcategory c, menu_deep_subcategory d WHERE a.menu_type = ? AND a.menu_category_id = b.menu_category_id AND b.menu_id = c.menu_id AND c.menu_subcategory_id = d.menu_subcategory_id AND d.value = ?";

            $escaped_values = array( $menu_type, $value );

            break;

        default:
            // code...
            break;
        }



        $query = $this->db->query( $sql, $escaped_values );


        $row = $query->row();
        $menu_level .= '_id';
        $result = $row->$menu_level;

        //var_dump($result);



        return $result;
    }

    public function get_menu_id_by_code( $value, $menu_type, $menu_level, $menu_name = null ) {
        switch ( $menu_level ) {
        case 'menu':

            $sql = "SELECT a.menu_id as menu_type_id FROM menu a, menu_category b WHERE a.menu_category_id = b.menu_category_id AND b.menu_type = ? AND a.code = ?";

            $escaped_values = array( $menu_type, $value );

            if ( $menu_name != null ) {
                $sql .= " AND a.name = ?";
                array_push( $escaped_values, $menu_name );
            }

            break;

        case 'subcategory':

            $sql = "SELECT c.menu_subcategory_id as menu_type_id FROM menu_category a, menu b, menu_subcategory c WHERE a.menu_type = ? AND a.menu_category_id = b.menu_category_id AND b.menu_id = c.menu_id AND c.code = ?";

            $escaped_values = array( $menu_type, $value );

            break;

        case 'deep_subcategory':

            $sql = "SELECT d.menu_deep_subcategory_id as menu_type_id FROM menu_category a, menu b, menu_subcategory c, menu_deep_subcategory d WHERE a.menu_type = ? AND a.menu_category_id = b.menu_category_id AND b.menu_id = c.menu_id AND c.menu_subcategory_id = d.menu_subcategory_id AND d.code = ?";

            $escaped_values = array( $menu_type, $value );

            break;

        default:
            // code...
            break;
        }



        $query = $this->db->query( $sql, $escaped_values );


        $row = $query->row();
        $result = $row->menu_type_id;

        //var_dump($result);



        return $result;
    }

    public function get_view( $view_name ) {

        $db_table = 'view';
        $db_primary = "`name`";

        $sql = "SELECT json FROM {$db_table} WHERE {$db_primary} = ? LIMIT 1";

        $query = $this->db->query( $sql, array( $view_name ) );

        if ( $query->num_rows() > 0 ) {
            $result = $query->row()->json;
        }else {
            $result = null;
        }

        return $result;
    }

    public function update_view( $view_name, $json_data ) {

        $db_table = 'view';
        $db_primary = 'name';

        $sql = "UPDATE {$db_table} SET json = ? WHERE `name` = ?";

        $query = $this->db->query( $sql, array( $json_data, $view_name ) );

        $result = $this->db->insert_id();

        return $result;
    }

    public function multiple_database_test() {

        $this->db = $this->load->database( 'sample', TRUE );

        $sql = "INSERT INTO user (first_name, last_name) VALUES (?, ?)";

        $query = $this->db->query( $sql, array( 'sample_db', 'sample_db' ) );

        echo $this->db->last_query();
    }

    public function get_field_storage($code){

        $db_table = "field_storage_item";
        $db_primary = "field_storage_item_id";

        $sql = "SELECT * FROM {$db_table} a, field_storage b WHERE b.code = ? AND a.field_storage_id = b.field_storage_id";

        $query = $this->db->query($sql, array($code));

        $result = $query->result();

        //echo $this->db->last_query();

        return $result;
    }

    public function add_field_storage_item($id, $value){

        echo $id;

        $db_table = "field_storage_item";
        $db_primary = "field_storage_item_id";

        $sql = "INSERT INTO {$db_table} (`value`, `field_storage_id`) VALUES (?,?)";

        $escaped_values = array($value, $id);

        $query = $this->db->query($sql, $escaped_values);

        echo $this->db->last_query();
    }

    public function check_field_storage_duplicate($id, $value){


        $db_table = "field_storage_item";
        $db_primary = "field_storage_item_id";

        $sql = "SELECT count(value) as count FROM {$db_table} WHERE value = LOWER(?) AND field_storage_id = ?";

        $escaped_values = array($value, $id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->count;



        return $result;
    }

    public function get_file_type($extension){

        $db_table = "file_type";
        $db_primary = "file_type_id";

        $sql = "SELECT * FROM file_type WHERE extensions LIKE '%{$extension}%' LIMIT 1";

        $escaped_values = array($extension);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->$db_primary;

        return $result;
    }

}
