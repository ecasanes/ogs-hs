<?php

class Document_Tracker_Model extends MY_Model {

    const DB_TABLE = 'action_tracker';
    const DB_TABLE_PK = 'action_tracker_id';

    public function get_action_tracker_past_due_date(){

    	$db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "SELECT * FROM action_tracker a, user b WHERE a.owner = b.user_id AND a.due_date <= CURDATE() AND UNIX_TIMESTAMP(a.`due_date`) != 0 ORDER BY a.due_date ASC";

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function add_action_track($user_id, $action)
    {
        $sql = "
                INSERT INTO `iso_redesign`.`document_tracker` (
                  `user_id`,
                  `action`,
                  `action_date`
                ) 
                VALUES
                  (
                    $user_id,
                    '$action',
                    now()
                  ) ;
        ";

        $result = $this->db->query($sql);

        if( ! $result ) { die('Action Tracker Adding Failed.'); }
    }

    public function delete_action_track($document_tracker_id)
    {
        $sql = "
                DELETE FROM `iso_redesign`.`document_tracker` 
                WHERE 
                document_tracker_id = $document_tracker_id
        ";

        $result = $this->db->query($sql);

        if( ! $result ) { die('Action Tracker Deletion Failed.'); }
    }

    public function get_name_by_id($document_id)
    {
        $result = array();

        $document_id = trim(intval($document_id));

        $sql = "
            SELECT 
              CASE
                WHEN `name` IS NULL 
                THEN 'Unnamed' 
                ELSE `name`
              END AS `name` 
            FROM
              iso_redesign.`document` 
            WHERE document_id = $document_id 
        ";

        $result = $this->db->query($sql);

        if($result) { $result = $result->row()->name; }
        
        return $result;
    }

    public function get_action_tracks($limit = false, $offset = false)
    {
        $result = array();

        if( is_numeric( trim($limit) ) ) { $limit = $limit; }
        else { $limit = 5; }

        if( is_numeric( trim($offset) ) ) { $offset = $offset; }
        else { $offset = 0; }

        $user_id = $this->session->userdata('session');

        $sql = "
                SELECT 
                  CASE
                    WHEN `action` IS NULL 
                    THEN 'Unnamed' 
                    WHEN `action` = '' 
                    THEN 'Unnamed' 
                    ELSE `action` 
                  END AS `action`,
                  DATE_FORMAT(action_date, '%M %d, %Y') AS `action_date`,
                  action_date as order_action_date
                FROM
                  `iso_redesign`.`document_tracker` 
                WHERE user_id = $user_id 
                ORDER BY order_action_date DESC 
                LIMIT $limit OFFSET $offset   
        ";   

        $sql_count = "
                SELECT 
                  count(document_tracker_id) as count
                FROM
                  `iso_redesign`.`document_tracker` 
                WHERE user_id = $user_id 
                ORDER BY action_date DESC 
        ";   

        $query = $this->db->query($sql);
        $query_count = $this->db->query($sql_count)->row()->count;
        
        if( $query ) { $result = $query->result_array(); }

        $result['count'] = $query_count;
        /*$result['sql'] = $sql;*/
        return $result;
    }

    public function get_all_action_tracks($limit = false, $offset = false)
    {
        $result = array();

        $search_limit = 5;
        $search_offset = 0;

        // Change limits and offsets if the are valid.
        if( is_numeric( trim($limit) ) ) { $search_limit = $limit; }
        if( is_numeric( trim($offset) ) ) { $search_offset = $offset; }

        $user_id = $this->session->userdata('session');

        $sql = "
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
                LIMIT $search_limit OFFSET $search_offset  
        ";   

        $sql_count = "
                SELECT 
                  count(*) as count
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
        ";   

        $query = $this->db->query($sql);
        $query_count = $this->db->query($sql_count)->row()->count;
        
        if( $query ) { $result = $query->result_array(); }

        $result['count'] = $query_count;
        /*$result['sql'] = $sql;*/
        return $result;
    }
}