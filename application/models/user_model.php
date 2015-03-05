<?php

class User_Model extends MY_Model {

    const DB_TABLE = 'tbl_user';
    const DB_TABLE_PK = 'user_id';


    public function get_users(){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql  = "SELECT * FROM {$db_table}";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_users_by_type($user_type = 1){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql  = "SELECT * FROM {$db_table} WHERE user_type = ?";

        $escaped_values = array($user_type);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    /* start CRUD */
    public function create_user($username, $password, $fname, $lname, $age, $gender, $address, $user_type, $mname='', $year_level = null){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "INSERT INTO {$db_table} (username, password, fname, lname, age, gender, address, user_type, mname, year_level) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $escaped_values = array($username, md5($password), $fname, $lname, $age, $gender, $address, $user_type, $mname, $year_level);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function get_user_by_type($user_type){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT * FROM {$db_table} WHERE user_type = ?";

        $escaped_values = array($user_type);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function search_list($search_key, $user_type){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT * FROM {$db_table} WHERE user_type = ? AND CONCAT_WS(' ', fname,lname) LIKE '%{$search_key}%'";

        $escaped_values = array($user_type);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }




















    public function get_user($id){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT a.{$db_primary}, a.first_name, a.last_name, a.username, a.email_address, a.`status`, a.`database`, a.date_created, a.user_photo, a.discipline, a.position, a.years_of_service, a.area_of_operations, a.highest_qualification, a.last_worked_on, a.forward_emails, a.notification_sent, a.role, a.cover_photo, a.notify_technical_bulletin, a.notify_case_file, a.asset, a.asset_role FROM `{$db_table}` a WHERE a.{$db_primary} = ?";

        $escaped_values = array($id);

        $query = $this->db->query($sql, $escaped_values);

        if($query->num_rows() > 0){
            $result = $query->row();
        }else{
            $result = 0;
        }
        

        return $result;
    }

    public function update_user(){

    }

    public function delete_user(){

    }
    /* end CRUD */

    

    public function search_by_name( $name ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT * FROM {$db_table} WHERE CONCAT_WS(' ', first_name,last_name) LIKE '%{$name}%' OR first_name LIKE '%{$name}%' OR last_name LIKE '%{$name}%' OR username LIKE '%{$name}%' AND status = '1'";
        $query = $this->db->query( $sql );

        $result = $query->result_array();

        return $result;
    }

    public function has_permission( $role, $current_page ) {

        if ( $role == 'superadmin' || $current_page == '' ) {

            $boolean_result = false;

        }

        else if ( $role == '' || empty( $role ) ) {

                $sql = "SELECT count(id) as permission_count FROM ilo_pages WHERE role IS NULL AND page_uri_segment = '$current_page' AND status = 'restricted'";
                $query = $this->db->query( $sql );

                $result_count = $query->row()->permission_count;

                if ( $result_count > 0 ) {
                    $boolean_result = true;
                }else {
                    $boolean_result = false;
                }

            }

        else {

            $sql = "SELECT count(id) as permission_count FROM ilo_pages WHERE role = '$role' AND page_uri_segment = '$current_page' AND status = 'restricted'";

            $query = $this->db->query( $sql );

            $result_count = $query->row()->permission_count;

            if ( $result_count > 0 ) {
                $boolean_result = true;
            }else {
                $boolean_result = false;
            }
        }

        return $boolean_result;
    }

    public function get_user_by_login( $username, $column_name = 'email_address' ) {

        $where_sql = "username = '{$username}' OR email_address = '{$username}'";

        $this->db->select( $column_name );
        $this->db->from( $this::DB_TABLE );
        $this->db->where( $where_sql );
        $query = $this->db->get();
        $row = $query->row();
        return $row->$column_name;
    }

    public function is_valid_user( $username ) {

        $where_sql = "username = '{$username}'";

        $this->db->where( $where_sql );

        $query = $this->db->get( $this::DB_TABLE );

        if ( $query->num_rows() == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function can_login( $username, $password ) {

        $where_sql = "username = '{$username}' AND password = '{$password}'";

        $this->db->where( $where_sql );

        $query = $this->db->get( $this::DB_TABLE );

        if ( $query->num_rows() == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function get_id_by_credentials( $username, $password ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT {$db_primary} FROM {$db_table} WHERE (username = '{$username}') AND password = '{$password}'";
        $query = $this->db->query( $sql );

        if ( $query->num_rows() > 0 ) {
            $row = $query->row();
            return $row->{$db_primary};
        }else {
            return null;
        }
    }

    public function verify_duplicate( $id, $username ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $current_username = $this->get_current_username( $id );


        if ( $current_username != $username ) {
            $this->db->select( "count({$db_table}) as user_count" );
            $this->db->from( $db_table );
            $this->db->where( array( 'username' => $username ) );
            $query = $this->db->get();
            $row = $query->row();
            $user_count = $row->user_count;
        }else {
            $user_count = 0;
        }


        if ( $user_count > 0 ) {
            return true;
        }else {
            return false;
        }
    }

    public function get_user_password( $id ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT password FROM user WHERE user_id = ?";

        $escaped_values = array( $id );

        $query = $this->db->query( $sql, $escaped_values );

        $count = $query->num_rows();

        if ( $count > 0 ) {
            $result = $query->row()->password;
            return $result;
        }else {
            return '';
        }

    }


    public function update_photo($id, $cover_photo, $user_profile_photo){

        $db_table = User_Model::DB_TABLE;
        $db_primary = User_Model::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET user_photo = ?, cover_photo = ? WHERE user_id = ?";

        $escaped_values = array($cover_photo, $user_profile_photo, $id);

        $query = $this->db->query($sql, $escaped_values);

    }

    public function get_user_preferences( $preference_type ) {

        $table_name = "user_preference";

        $sql = "SELECT * FROM {$table_name} a, {$table_name}_category b WHERE a.{$table_name}_category_id = b.{$table_name}_category_id AND b.name = ? GROUP BY a.menu_id";

        $escaped_value = array( $preference_type );

        $query = $this->db->query( $sql, $escaped_value );

        $result = $query->result();

        return $result;
    }


    public function get_student_fullname( $user_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "SELECT b.stud_fname, b.stud_mname, b.stud_lname FROM user a, student b WHERE a.user_id = b.user_id";

        $escaped_values = array( $user_id );

        $query = $this->db->query( $sql, $escaped_values );

        $count = $query->num_rows();

        if ( $count > 0 ) {
            $first_name = $query->row()->stud_fnmae;
            $middle_name = $query->row()->stud_mname;
            $last_name =$query->row()->last_name;

            return $first_name.' '.$middle_name.' '.$last_name;
        }else {
            return '';
        }
    }


    public function get_teacher_fullname( $user_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "SELECT b.teacher_fname, b.teacher_mname, b.teacher_lname FROM user a, teacher b WHERE a.user_id = b.user_id";

        $escaped_values = array( $user_id );

        $query = $this->db->query( $sql, $escaped_values );

        $count = $query->num_rows();

        if ( $count > 0 ) {
            $first_name = $query->row()->teacher_fname;
            $middle_name = $query->row()->teacher_mname;
            $last_name =$query->row()->teacher_lname;

            return $first_name.' '.$middle_name.' '.$last_name;
        }else {
            return '';
        }
    }

    public function get_short_name( $user_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "SELECT first_name, last_name FROM {$db_table} WHERE {$db_primary} = ?";

        $escaped_values = array( $user_id );

        $query = $this->db->query( $sql, $escaped_values );

        $count = $query->num_rows();

        if ( $count > 0 ) {
            $first_name = $query->row()->first_name;
            $first_name = explode( " ", $first_name );
            $short_name = '';
            foreach ( $first_name as $name ) {
                $short_name .= $name[0] .'. ';
            }
            $last_name =$query->row()->last_name;

            return $short_name.$last_name;
        }else {
            return '';
        }
    }

    


}
