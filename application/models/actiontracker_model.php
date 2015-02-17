<?php

class ActionTracker_Model extends MY_Model {

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


    //TODO: queries

    //document_type_code = basic-decf, ofi, pwp
    public function get_action_tracker_by_document_type($document_type_code, $limit = false, $offset = false){

        $result = array();

        $search_limit = 20;
        $search_offset = 0;

        // Change limits and offsets if the are valid.
        if( is_numeric( trim($limit) ) ) { $search_limit = $limit; }
        if( is_numeric( trim($offset) ) ) { $search_offset = $offset; }

        $sql_count = "SELECT 
        count(`at`.action_tracker_id) as `count`
        FROM
        action_tracker `at` 
        INNER JOIN document `d` 
        ON `d`.`document_id` = `at`.`document_id` 
        INNER JOIN document_type `dt` 
        ON `dt`.`document_type_id` = `d`.`document_type_id` AND `dt`.`document_code` = '$document_type_code'
        INNER JOIN menu `m` 
        ON `m`.`menu_id` = `at`.`status` 
        INNER JOIN `user` `u` 
        ON `u`.`user_id` = `at`.`owner` 
        ORDER BY `at`.`due_date` DESC";

        $sql = "SELECT 
        `at`.action_tracker_id,
        `at`.`reference`,
        `dt`.`document_name` as document_type_name,
        `at`.`action_process_step`,
        m.`name` as action_status,
        CONCAT(
        `u`.`first_name`,
        ' ',
        `u`.`last_name`
        ) as full_name,
        DATE_FORMAT(`at`.`due_date`, '%d/%m/%Y') AS `due_date`,
        `at`.`comments`,
        `m`.color_class as status_color
        FROM
        action_tracker `at` 
        INNER JOIN document `d` 
        ON `d`.`document_id` = `at`.`document_id` 
        INNER JOIN document_type `dt` 
        ON `dt`.`document_type_id` = `d`.`document_type_id` AND `dt`.`document_code` = ?
        INNER JOIN menu `m` 
        ON `m`.`menu_id` = `at`.`status` 
        INNER JOIN `user` `u` 
        ON `u`.`user_id` = `at`.`owner` 
        ORDER BY `at`.`due_date` DESC
        LIMIT $search_limit OFFSET $search_offset";

        

        $escaped_values = array($document_type_code);

        $count = $this->db->query($sql_count)->row()->count;
        $query = $this->db->query($sql, $escaped_values);
        $result = $query->result();
        $result['count'] = $count;
        

        return $result;
    }

    public function get_action_tracker_due_now($document_type_code){
        
        $sql = "SELECT 
          `at`.action_tracker_id,
            `at`.`reference`,
            `dt`.`document_name` as document_type_name,
            `at`.`action_process_step`,
            m.`name` as action_status,
            CONCAT(
            `u`.`first_name`,
            ' ',
            `u`.`last_name`
            ) as full_name,
            DATE_FORMAT(`at`.`due_date`, '%d/%m/%Y') AS `due_date`,
            `at`.`comments`,
            `m`.color_class as status_color
        FROM
          action_tracker `at` 
          INNER JOIN document `d` 
            ON `d`.`document_id` = `at`.`document_id` 
          INNER JOIN document_type `dt` 
            ON `dt`.`document_type_id` = `d`.`document_type_id` 
            AND `dt`.`document_code` = ?
            AND  (SELECT DATEDIFF(NOW(), `at`.`due_date`) AS DiffDate) < 7
          INNER JOIN menu `m` 
            ON `m`.`menu_id` = `at`.`status` 
          INNER JOIN `user` `u` 
            ON `u`.`user_id` = `at`.`owner` 
        ORDER BY `at`.`due_date` DESC";

        $escaped_values = array($document_type_code);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_action_tracker_overdue($document_type_code){

        $sql = "SELECT 
          `at`.action_tracker_id,
            `at`.`reference`,
            `dt`.`document_name` as document_type_name,
            `at`.`action_process_step`,
            m.`name` as action_status,
            CONCAT(
            `u`.`first_name`,
            ' ',
            `u`.`last_name`
            ) as full_name,
            DATE_FORMAT(`at`.`due_date`, '%d/%m/%Y') AS `due_date`,
            `at`.`comments`,
            `m`.color_class as status_color
        FROM
          action_tracker `at` 
          INNER JOIN document `d` 
            ON `d`.`document_id` = `at`.`document_id` 
          INNER JOIN document_type `dt` 
            ON `dt`.`document_type_id` = `d`.`document_type_id` 
            AND `dt`.`document_code` = ?
            AND  (SELECT DATEDIFF(`at`.`due_date`, NOW()) AS DiffDate) <= 0
          INNER JOIN menu `m` 
            ON `m`.`menu_id` = `at`.`status` 
          INNER JOIN `user` `u` 
            ON `u`.`user_id` = `at`.`owner` 
        ORDER BY `at`.`due_date` DESC ";

        $escaped_values = array($document_type_code);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_action_tracker_by_system($document_type_code, $system = null){

        $sql = "SELECT 
              `at`.action_tracker_id,
            `at`.`reference`,
            `dt`.`document_name` as document_type_name,
            `at`.`action_process_step`,
            m.`name` as action_status,
            CONCAT(
            `u`.`first_name`,
            ' ',
            `u`.`last_name`
            ) as full_name,
            DATE_FORMAT(`at`.`due_date`, '%d/%m/%Y') AS `due_date`,
            `at`.`comments`,
                `m`.color_class as status_color
            FROM
              action_tracker `at` 
              INNER JOIN document `d` 
                ON `d`.`document_id` = `at`.`document_id` 
              INNER JOIN document_type `dt` 
                ON `dt`.`document_type_id` = `d`.`document_type_id` 
                AND `dt`.`document_code` = ?
              INNER JOIN menu `m` 
                ON `m`.`menu_id` = `at`.`status` 
              INNER JOIN `user` `u` 
                ON `u`.`user_id` = `at`.`owner` 
              INNER JOIN equipment_profile ep 
                ON ep.`document_id` = `at`.`document_id`";

        if($system === null){
            $sql .= "AND ep.`system_id` IS NOT NULL ";
        }else{
           $sql .= "AND ep.`system_id` = ? "; 
        }
        

        $sql .= "ORDER BY `at`.`due_date` DESC ";

        $escaped_values = array($document_type_code, $system);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_action_tracker_by_subsystem($document_type_code, $subsystem){

        $sql = "SELECT 
              `at`.action_tracker_id,
            `at`.`reference`,
            `dt`.`document_name` as document_type_name,
            `at`.`action_process_step`,
            m.`name` as action_status,
            CONCAT(
            `u`.`first_name`,
            ' ',
            `u`.`last_name`
            ) as full_name,
            DATE_FORMAT(`at`.`due_date`, '%d/%m/%Y') AS `due_date`,
            `at`.`comments`,
                `m`.color_class as status_color
            FROM
              action_tracker `at` 
              INNER JOIN document `d` 
                ON `d`.`document_id` = `at`.`document_id` 
              INNER JOIN document_type `dt` 
                ON `dt`.`document_type_id` = `d`.`document_type_id` 
                AND `dt`.`document_code` = ?
              INNER JOIN menu `m` 
                ON `m`.`menu_id` = `at`.`status` 
              INNER JOIN `user` `u` 
                ON `u`.`user_id` = `at`.`owner` 
              INNER JOIN equipment_profile ep 
                ON ep.`document_id` = `at`.`document_id` 
                AND ep.`system_subcategory_id` = ?
            ORDER BY `at`.`due_date` DESC ";

        $escaped_values = array($document_type_code, $subsystem);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_action_tracker_critical_equipment_all(){

        $sql = "SELECT 
              `ac_t`.action_tracker_id,
                `ac_t`.`reference`,
                            'Critical Equipment' as document_type_name,
                            m.`name` as action_status,
                `ac_t`.`action_process_step`,
                CONCAT(
                `u`.`first_name`,
                ' ',
                `u`.`last_name`
                ) as full_name,
                DATE_FORMAT(`ac_t`.`due_date`, '%d/%m/%Y') AS `due_date`,
                `ac_t`.`comments`,
                            m.color_class as status_color
            FROM
              criticality_analysis ca 
              INNER JOIN action_tracker ac_t 
                ON ac_t.`criticality_analysis` = ca.`criticality_analysis_id` 
              INNER JOIN `user` `u` 
                ON `u`.`user_id` = ac_t.`owner`
                        INNER JOIN menu m
                            ON m.menu_id = ac_t.`status`";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_action_tracker_critical_equipment_category($category_id, $value = null){

        if($value === null){
            $sql = "SELECT 
              `ac_t`.action_tracker_id,
            `ac_t`.`reference`,
            'Critical Equipment' as document_type_name,
            `ac_t`.`action_process_step`,
            m_two.`name` as action_status,
            CONCAT(
            `u`.`first_name`,
            ' ',
            `u`.`last_name`
            ) as full_name,
            DATE_FORMAT(`ac_t`.`due_date`, '%d/%m/%Y') AS `due_date`,
            `ac_t`.`comments`,
                m_two.color_class as status_color
            FROM
              criticality_analysis ca 
              INNER JOIN action_tracker ac_t 
                ON ac_t.`criticality_analysis` = ca.`criticality_analysis_id` 
              INNER JOIN `user` `u` 
                ON `u`.`user_id` = ac_t.`owner` 
              INNER JOIN criticality_analysis_category ca_c 
                ON ca_c.`criticality_analysis_id` = ca.`criticality_analysis_id` 
                 AND ca_c.`value` = ?
              INNER JOIN menu m ON m.`menu_id` = ca_c.`menu_id` 
              AND m.`menu_id` = ? 
              INNER JOIN menu m_two ON m_two.menu_id = ac_t.status";

            $escaped_values = array(1, $category_id);

            $query = $this->db->query($sql, $escaped_values);

            $result = $query->result();

            return $result;

        }else{

            $sql = "SELECT 
              `ac_t`.action_tracker_id,
            `ac_t`.`reference`,
            'Critical Equipment' as document_type_name,
            `ac_t`.`action_process_step`,
            m_two.`name` as action_status,
            CONCAT(
            `u`.`first_name`,
            ' ',
            `u`.`last_name`
            ) as full_name,
            DATE_FORMAT(`ac_t`.`due_date`, '%d/%m/%Y') AS `due_date`,
            `ac_t`.`comments`,
                m_two.color_class as status_color
            FROM
              criticality_analysis ca 
              INNER JOIN action_tracker ac_t 
                ON ac_t.`criticality_analysis` = ca.`criticality_analysis_id` 
              INNER JOIN `user` `u` 
                ON `u`.`user_id` = ac_t.`owner` 
              INNER JOIN criticality_analysis_category ca_c 
                ON ca_c.`criticality_analysis_id` = ca.`criticality_analysis_id` 
                 AND ca_c.`value` = ?
              INNER JOIN menu m ON m.`menu_id` = ca_c.`menu_id` 
              AND m.`menu_id` = ? 
              INNER JOIN menu m_two ON m_two.menu_id = ac_t.status";

            $escaped_values = array($value, $category_id);

            $query = $this->db->query($sql, $escaped_values);

            $result = $query->result();

            return $result;

        }

    }

    public function get_action_tracker_critical_equipment_tag_no($tag_number){

        $sql = "SELECT 
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
            AND ca.`tag_number` = ?
          INNER JOIN `user` `u` 
            ON `u`.`user_id` = ac_t.`owner` ";

        $escaped_values = array($tag_number);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;

    }

    public function get_action_tracker_all(){

        $sql = "SELECT 
            `at`.action_tracker_id,
            `at`.`reference`,
            `dt`.`document_name` as document_type_name,
            `at`.`action_process_step`,
            m.`name` as action_status,
            CONCAT(
            `u`.`first_name`,
            ' ',
            `u`.`last_name`
            ) as full_name,
            DATE_FORMAT(`at`.`due_date`, '%d/%m/%Y') AS `due_date`,
            `at`.`comments`,
                `m`.color_class as status_color
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
            ORDER BY `at`.`due_date` DESC";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }




    


}