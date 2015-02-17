<?php

class User_Model extends MY_Model {

    const DB_TABLE = 'user';
    const DB_TABLE_PK = 'user_id';

    public function get_user($id){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT a.{$db_primary}, a.first_name, a.last_name, a.user_name, a.email_address, a.`status`, a.`database`, a.date_created, a.user_photo, a.discipline, a.position, a.years_of_service, a.area_of_operations, a.highest_qualification, a.last_worked_on, a.forward_emails, a.notification_sent, a.role, a.cover_photo, a.notify_technical_bulletin, a.notify_case_file, a.asset, a.asset_role FROM `{$db_table}` a WHERE a.{$db_primary} = ?";

        $escaped_values = array($id);

        $query = $this->db->query($sql, $escaped_values);

        if($query->num_rows() > 0){
            $result = $query->row();
        }else{
            $result = 0;
        }
        

        return $result;

    }

    // Function to call image name.
    public function get_image_name($id) {
        $result = array();

        $sql = "
                SELECT filename FROM `file_item` WHERE file_item_id = '$id'
        ";

        $result = $this->db->query($sql);
        $result = $result->row_array();

        // Fix if empty return none.
        if( isset( $result['filename'] ) )
        {
            $result = $result['filename'];    
        }

        // Set empty.
        if( empty($result) ) { $result = ''; }

        return $result;
    }

    # Date Created: 1/13/2015
    # Author: Abella, Demby M.
    # Description: Get single accnt cover photo.
    public function get_account_cover_photo($user_id)
    {
        $result = array();

        $sql = "
                SELECT file_item_id, user_photo, filename 

                FROM `file_item` fi INNER JOIN `user` u 
                ON 
                u.cover_photo = fi.file_item_id AND  
                u.user_id = $user_id
        ";

        $result = $this->db->query($sql)->row();

        return $result;
    }

    # Date Created: 1/13/2015
    # Author: Abella, Demby M.
    # Description: Get single accnt cover photo.
    public function get_account_profile_photo($user_id)
    {
        $result = array();
        
        $sql = "
                SELECT file_item_id, user_photo, filename 

                FROM `file_item` fi INNER JOIN `user` u 
                ON 
                u.user_photo = fi.file_item_id AND  
                u.user_id = $user_id
        ";

        $result = $this->db->query($sql)->row();

        return $result;
    }

    public function get_file_item_name($file_item_id)
    {
        $result = array();

        $sql = "SELECT filename FROM file_item WHERE file_item_id = $file_item_id";
        $result = $this->db->query($sql)->row_array();

        return $result;
    }

    public function get_document_completed_followers( $doc_id ) {

        $sql = "SELECT table3.*,follow.user_id AS follower_id FROM (SELECT a.document_id, d_type.document_code, a.code, a.name, a.document_completed, a.notification_sent,b.document_owner_type,b.user_id FROM document a,document_owner b, document_type d_type WHERE a.document_type_id = d_type.document_type_id AND a.document_id = b.document_id AND a.document_id = ? AND b.user_id IS NOT NULL GROUP BY a.document_id, b.user_id) AS table3, follow_user AS follow WHERE table3.user_id = follow.followed_user_id";

        $escaped_values = array( $doc_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_file_list($filename = null, $type = null, $order = 'ASC'){
        $sql = "SELECT a.*, b.name as file_type_name FROM file_item a, file_type b";

        if($filename != null){
            $sql .= " WHERE a.filename LIKE '%{$filename}%'";
        }

        

        if($type != null){

            if( $filename != null){
                $sql .= " AND a.extension = '{$type}'";

            }else{
                $sql .= " WHERE a.extension = '{$type}'";
            }
            
            $sql .= " AND a.type = b.file_type_id ";

        }else{

             if($filename != null){
                 $sql .= " AND a.type = b.file_type_id ";
            }else{
                $sql .= " WHERE a.type = b.file_type_id ";
            }

        }


       



        

        $sql .= " ORDER BY a.filename {$order}";

        $query = $this->db->query( $sql);

        $result = $query->result();

        return $result;
    }

    public function get_completed_document_owners( $document_completed_status = '1' ) {

        $sql = "SELECT a.document_owner_type, a.user_id, a.document_id, b.first_name, b.last_name, b.email_address, d_type.document_code, c.code, c.name  from document_owner a, user b, document c, document_type d_type WHERE d_type.document_type_id = c.document_type_id AND a.user_id is not null AND a.user_id = b.user_id AND a.document_id = c.document_id AND c.notification_sent is NULL AND c.document_completed = ?";

        $escaped_values = array( $document_completed_status );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function check_document_owner_count( $user_id, $document_id ) {

        $db_table = "document_owner";

        $sql = "SELECT count(document_owner_id) as document_owner_count FROM {$db_table} WHERE user_id = ? AND document_id = ?";

        $escaped_values = array( $user_id, $document_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row()->document_owner_count;

        return $result;
    }

    

    public function get_document_preference( $preference_id ) {

        $sql = "SELECT * from (select c.user_id, d.menu_id, c.first_name,c.last_name,c.email_address from `user` c, user_preference d where c.user_id = d.user_id and d.notify = 1) as table1
         left JOIN (select a.document_id,a.equipment_category_id,b.notification_sent, b.document_completed,b.code,d_type.document_code,b.name from equipment_profile a, document b, document_type d_type where b.document_type_id = d_type.document_type_id AND a.document_id = b.document_id) as table2
        on table1.menu_id = table2.equipment_category_id
        where table1.menu_id = ?
        and table2.notification_sent is null
        and table2.document_completed = ?";

        $escaped_values = array( $preference_id, 1 );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_followers( $user_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT a.*,b.* FROM follow_user a, {$db_table} b WHERE a.followed_user_id = ? AND a.{$db_primary} = b.{$db_primary} GROUP BY a.{$db_primary}";

        $escaped_values = array( $user_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_followed_user( $user_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT * FROM follow_user a LEFT JOIN {$db_table}  b ON a.followed_user_id = b.{$db_primary} WHERE a.{$db_primary} = ?";

        $escaped_values = array( $user_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function search_by_name( $name ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT * FROM {$db_table} WHERE CONCAT_WS(' ', first_name,last_name) LIKE '%{$name}%' OR first_name LIKE '%{$name}%' OR last_name LIKE '%{$name}%' OR user_name LIKE '%{$name}%' AND status = '1'";
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

        $where_sql = "user_name = '{$username}' OR email_address = '{$username}'";

        $this->db->select( $column_name );
        $this->db->from( $this::DB_TABLE );
        $this->db->where( $where_sql );
        $query = $this->db->get();
        $row = $query->row();
        return $row->$column_name;
    }

    public function get_user_by_role($role){

        $sql = "SELECT * FROM user WHERE role = '{$role}'";

        $query = $this->db->query( $sql);

        $result = $query->result();

        return $result;
    }

    public function is_valid_user( $username ) {

        $where_sql = "user_name = '{$username}' OR email_address = '{$username}'";

        $this->db->where( $where_sql );

        $query = $this->db->get( $this::DB_TABLE );

        if ( $query->num_rows() == 1 ) {
            return true;
        } else {
            return false;
        }
    }

    public function can_login( $username, $password ) {

        $where_sql = "user_name = '{$username}' OR email_address = '{$username}' AND password = '{$password}'";

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

        $sql = "SELECT {$db_primary} FROM {$db_table} WHERE (user_name = '{$username}' OR email_address = '{$username}') AND password = '{$password}'";
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
            $this->db->where( array( 'user_name' => $username ) );
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

    /* CRUD */
    public function create( $first_name, $last_name, $user_name, $email_id, $password, $status ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "INSERT INTO {$db_table} (last_name, first_name, user_name, email_address, password, status, date_created) VALUES (?, ?, ?, ?, ?, ?, NOW())";

        $query = $this->db->query( $sql, array( $last_name, $first_name, $user_name, $email_id, $password, $status ) );

        $last_insert_id = $this->db->insert_id();

        return $last_insert_id;
    }

    public function insert_file_item( $filename, $name, $extension, $type, $user_id){

        $db_table = "file_item";
        $db_primary = "file_item_id";

        $sql = "INSERT INTO {$db_table} (filename, name, extension, type, user_id, date_uploaded, date_modified) VALUES (?, ?, ?, ?, ?, NOW(), NOW())";

        $query = $this->db->query( $sql, array( $filename, $name, $extension, $type, $user_id ) );

        $last_insert_id = $this->db->insert_id();

        return $last_insert_id;

    }

    public function update_file_item_name( $id, $name, $extension ){

        $db_table = "file_item";
        $db_primary = "file_item_id";

        $filename = $name.'.'.$extension;

        $sql = "UPDATE {$db_table} SET filename = ?, name = ?, date_modified = NOW() WHERE {$db_primary} = ?";

        $query = $this->db->query( $sql, array($filename, $name, $id ) );
    }
    

    public function delete_file_item($id){
        $db_table = 'file_item';
        $db_primary = 'file_item_id';

        $sql = "DELETE FROM {$db_table} WHERE {$db_primary} = {$id}";

        $query = $this->db->query( $sql );
    }

    //Temp function for admin
    public function create_user( $first_name, $last_name, $user_name, $role, $email_address, $password, $asset, $asset_role, $database_name, $password_key ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "INSERT INTO {$db_table} (last_name, first_name, user_name, role, email_address, `password`, asset, asset_role, `status`, `database`, password_key) VALUES (?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?)";

        $query = $this->db->query( $sql, array( $last_name, $first_name, $user_name, $role, $email_address, $password, $asset, $asset_role, 1, $database_name, $password_key ) );

        $last_insert_id = $this->db->insert_id();

        return $last_insert_id;
    }

    public function edit_user( $id, $first_name, $last_name, $user_name, $role, $email_address, $password, $asset, $asset_role, $database_name ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        if ( $password == '' || $password == null ) {

            $sql = "UPDATE {$db_table} SET first_name = ?, last_name = ?, user_name = ?, role = ?, email_address = ?, asset = ?, asset_role = ?, `database` = ? WHERE {$db_primary} = ?";
            $escaped_values = array(
                $first_name,
                $last_name,
                $user_name,
                $role,
                $email_address,
                $asset,
                $asset_role,
                $database_name,
                $id
            );

        }else {
            $sql = "UPDATE {$db_table} SET first_name = ?, last_name = ?, user_name = ?, role = ?, `password` = ?, email_address = ?, asset = ?, asset_role = ?, `database` = ? WHERE {$db_primary} = ?";
            $escaped_values = array(
                $first_name,
                $last_name,
                $user_name,
                $role,
                $password,
                $email_address,
                $asset,
                $asset_role,
                $database_name,
                $id
            );
        }




        $query = $this->db->query( $sql, $escaped_values );

        return $id;

    }

    /*End of TEMP admin user functions*/

    public function update_profile( $id, $discipline, $position, $years_of_service, $area_of_operation, $highest_qualification, $forward_emails, $notify_technical_bulletin, $notify_case_file ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET discipline = ?, position = ?, years_of_service = ?, area_of_operations = ?, highest_qualification = ?, forward_emails = ?, notify_technical_bulletin = ?, notify_case_file = ? WHERE {$db_primary} = ?";

        $query = $this->db->query( $sql, array( $discipline, $position, $years_of_service, $area_of_operation, $highest_qualification, $forward_emails, $notify_technical_bulletin, $notify_case_file, $id ) );
    }

    public function update_followed_user( $user_id, $followed_user_ids ) {

        $db_table = 'follow_user';
        $db_primary = 'follow_user_id';

        //$user_exception = "AND (user_id != {$main_user_id} OR user_id is null)";

        $id_results = $this->get_followed_user( $user_id, null );

        $i = 0;

        foreach ( $id_results as $result ) {
            $id = $result->{$db_primary};
            $followed_user_id = $followed_user_ids[$i];

            if ( $followed_user_id == '' ) {
                $followed_user_id = null;
            }

            if ( $followed_user_id != $user_id ) {
                $sql = "UPDATE {$db_table} SET followed_user_id = ? WHERE {$db_primary} = ?";
                $query = $this->db->query( $sql, array( $followed_user_id, $id ) );
            }

            $i++;
        }
    }


    public function update_photo($id, $cover_photo, $user_profile_photo){

        $db_table = User_Model::DB_TABLE;
        $db_primary = User_Model::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET user_photo = ?, cover_photo = ? WHERE user_id = ?";

        $escaped_values = array($cover_photo, $user_profile_photo, $id);

        $query = $this->db->query($sql, $escaped_values);

    }


    public function update( $id, $first_name, $last_name, $user_name, $email_id, $password, $status, $date_registered ) {

        $db_table = User_Model::DB_TABLE;
        $db_primary = User_Model::DB_TABLE_PK;

        if ( $password == '' ) {
            $sql = "UPDATE {$db_table} SET first_name = ?, last_name = ?, user_name = ?, status = ? WHERE {$db_primary} = ?";
            $escaped_values = array(
                $first_name,
                $last_name,
                $user_name,
                $status,
                $id
            );
        }else {
            $sql = "UPDATE {$db_table} SET first_name = ?, last_name = ?, user_name = ?, password = ?, status = ? WHERE {$db_primary} = ?";
            $escaped_values = array(
                $first_name,
                $last_name,
                $user_name,
                $password,
                $status,
                $id
            );
        }



        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_information( $id, $position, $discipline, $area_of_operation, $years_of_service, $highest_qualification, $email_address, $password, $asset_operation ) {

        $db_table = User_Model::DB_TABLE;
        $db_primary = User_Model::DB_TABLE_PK;

        if ( $password == '' || empty($password) ) {
            $sql = "UPDATE {$db_table} SET position = ?, discipline = ?, area_of_operations = ?, years_of_service = ?, asset_operation = ?, highest_qualification = ?, email_address = ? WHERE {$db_primary} = ?";
            $escaped_values = array(
                $position,
                $discipline,
                $area_of_operation,
                $years_of_service,
                $asset_operation,
                $highest_qualification,
                $email_address,
                $id
            );
        }else {
            $sql = "UPDATE {$db_table} SET position = ?, discipline = ?, area_of_operations = ?, years_of_service = ?, asset_operation = ?, highest_qualification = ?, email_address = ?, password = ? WHERE {$db_primary} = ?";
            $escaped_values = array(
                $position,
                $discipline,
                $area_of_operation,
                $years_of_service,
                $asset_operation,
                $highest_qualification,
                $email_address,
                $password, 
                $id
            );
        }

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function assign_document_owner( $document_id, $user_id, $document_owner_type = 'owner' ) { //owner - contributor

        $db_table = 'document_owner';
        $db_primary = 'document_owner_id';

        $sql = "INSERT INTO {$db_table} (document_owner_type, user_id, document_id) VALUES (?, ?, ?)";

        $query = $this->db->query( $sql, array( $document_owner_type, $user_id, $document_id ) );

        $last_insert_id = $this->db->insert_id();

        return $last_insert_id;
    }

    public function create_empty_user_preference( $results, $user_id, $notify_status, $user_preference_category_id ) {

        $table_name = 'user_preference';

        foreach ( $results as $result ) {

            $menu_id = $result->menu_id;

            $escaped_value = array( $menu_id, $user_id, $notify_status );

            $sql = "INSERT INTO {$table_name} (menu_id, user_id, notify) VALUES (?, ?, ?)";

            $query = $this->db->query( $sql, $escaped_value );
        }
    }

    public function create_user_preference( $user_id, $equipment_category_id, $notify, $user_preference_category_id ) {

        $db_table  = 'user_preference';

        $escaped_value = array( $user_id, $equipment_category_id, $notify );

        $sql = "INSERT INTO {$db_table} (user_id, menu_id, notify) VALUES (?, ?, ?)";

        $query = $this->db->query( $sql, $escaped_value );
    }

    public function get_user_preferences( $preference_type ) {

        $table_name = "user_preference";

        $sql = "SELECT * FROM {$table_name} a, {$table_name}_category b WHERE a.{$table_name}_category_id = b.{$table_name}_category_id AND b.name = ? GROUP BY a.menu_id";

        $escaped_value = array( $preference_type );

        $query = $this->db->query( $sql, $escaped_value );

        $result = $query->result();

        return $result;
    }

    public function get_full_name( $user_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "SELECT first_name, last_name FROM {$db_table} WHERE {$db_primary} = ?";

        $escaped_values = array( $user_id );

        $query = $this->db->query( $sql, $escaped_values );

        $count = $query->num_rows();

        if ( $count > 0 ) {
            $first_name = $query->row()->first_name;
            $last_name =$query->row()->last_name;

            return $first_name.' '.$last_name;
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

    public function get_user_preferences_doc( $selected_document ) {

        $sql = "SELECT  table3.*, d.first_name,d.last_name,d.email_address 
                FROM (SELECT table2.*,c.notify,c.user_preference_category_id,c.user_id 
                        FROM (SELECT a.document_id,a.`code`,a.`name`,a.document_type_id,d_type.document_code,b.equipment_category_id  
                                FROM document a,equipment_profile b, document_type d_type
                                WHERE a.document_id = b.document_id AND d_type.document_type_id = a.document_type_id and a.document_id = ?) AS table2, user_preference as c 
                        WHERE table2.equipment_category_id = c.menu_id and c.notify = '1') AS table3, `user` as d 
                WHERE table3.user_id = d.user_id";

        $escaped_value = array( $selected_document );

        $query = $this->db->query( $sql, $escaped_value );

        $result = $query->result();

        return $result;
    }

    public function check_if_preference_exist($user_id, $menu_id){

        $db_table = "user_preference";

        $sql = "SELECT {$db_table}_id  FROM {$db_table} WHERE user_id = ? AND menu_id = ?";

        $escaped_values = array($user_id, $menu_id);

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row();

        return $result;
        
    }

    public function update_single_preference($user_id, $menu_id, $notify, $id){

        $db_table = "user_preference";

        $sql = "UPDATE {$db_table} SET user_id = ?, menu_id = ?, notify = ? WHERE {$db_table}_id = ?";

        $escaped_values = array($user_id, $menu_id, $notify, $id);

        $query = $this->db->query( $sql, $escaped_values );
    }

    public function check_if_already_follow_row_exist($follow_user_id){

        $db_table = "follow_user";

        $sql = "SELECT {$db_table}_id  FROM {$db_table} WHERE follow_user_id = ?";

        $escaped_values = array($follow_user_id);

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row();

        return $result;
    }

    public function create_follow_user( $user_id, $followed_id ) {

        $db_table  = 'follow_user';

        $escaped_value = array( $user_id, $followed_id );

        $sql = "INSERT INTO {$db_table} (user_id, followed_user_id) VALUES (?, ?)";

        $query = $this->db->query( $sql, $escaped_value );

        $last_insert_id = $this->db->insert_id();

        return $last_insert_id;
    }

    public function update_single_follow_user($user_id, $followed_id, $id){

        $db_table = "follow_user";

        $sql = "UPDATE {$db_table} SET user_id = ?, followed_user_id = ? WHERE {$db_table}_id = ?";

        $escaped_values = array($user_id, $followed_id, $id);

        $query = $this->db->query( $sql, $escaped_values );
    }



}
