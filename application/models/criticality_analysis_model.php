<?php

class Criticality_Analysis_Model extends MY_Model {

    const DB_TABLE = 'critical_equipment';
    const DB_TABLE_PK = 'critical_equipment_id';


    public function get_all_groups() 
    {
        $result = array();
        $sql = "SELECT * FROM ce_group ";

        $result = $this->db->query($sql);

        if($result) { $result = $result->result_array(); }

        return $result;
    }

    public function drop_criticality_analysis_tables(){

        $sql = "";

        $query = $this->db->query($sql);

        $result = $query->result();
    }

    public function get_all_parent_sce($asset_id)
    {
        $sql = "SELECT * FROM ce_parent_sce WHERE asset_id = $asset_id";
        $result = array();

        $result = $this->db->query($sql);
        if($result) { $result = $result->result_array(); }

        return $result;
    }

    public function get_criticality_analysis_groups() {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "SELECT DISTINCT(`group`) FROM {$db_table}";

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function get_criticaly_equipments() {

        $db_table = 'critical_equipment';

        /*$sql = "SELECT 
                  ce.`critical_equipment_id`,
                  ce.`ref`,
                  cp.`name`,
                  ce.`tag_number`,
                  ce.`subsystem_component`,
                  ce.`code`,
                  ce.`quantity`,
                  ce.
                FROM
                  critical_equipment ce 
                  INNER JOIN ce_parent_sce cp 
                    ON ce.`ce_parent_sce_id` = cp.`ce_parent_sce_id` ";*/

        $sql = "SELECT 
                  ce.`critical_equipment_id`,
                  ce.`ref`,
                  cp.`name`,
                  ce.`tag_number`,
                  ce.`subsystem_component`,
                  ce.`code`,
                  ce.`quantity`,
                  m.`name` as asset_code
                FROM
                  critical_equipment ce 
                  INNER JOIN ce_parent_sce cp 
                    ON ce.`ce_parent_sce_id` = cp.`ce_parent_sce_id`
                                    INNER JOIN menu m
                                        ON cp.asset_id = m.menu_id";

        $query = $this->db->query( $sql );

        $result = $query->result_array();

        return $result;
    }

    public function get_all_roles()
    {
        $result = array();

        $sql = "SELECT * FROM ca_role";

        $result = $this->db->query($sql);

        if($result) { $result = $result->result_array(); }

        return $result;
    }

    public function get_scoring_detail_totals($critical_equipment_id) 
    {
        $sql = "SELECT 
              NAME,
              CASE
                WHEN total IS NULL 
                THEN 0 
                ELSE total 
              END AS total 
            FROM
              ca_question_category cac 
              LEFT JOIN ca_q_category_answer cq 
                ON cq.ca_question_category_id = cac.ca_question_category_id 
                AND critical_equipment_id = $critical_equipment_id ";

        $result = array();
        $result = $this->db->query($sql);

        if($result) { $result = $result->result_array(); }
        return $result;
    }

    public function add_critical_analysis_stage($ref, $notes, $cas, $spof, $critical_equipment_id, $ca_role_id, 
                                                $sce, $ece, $pce, $ex, $sis) 
    {
        $sql = "
            INSERT INTO `iso_redesign`.`critical_equipment` (
              `ref`,`notes`,`cas`,`spof`,`ca_role_id`,`sce`,`ece`,`pce`,`ex`,`sis`
            ) 
            VALUES
            (
              '$ref',
              '$notes',
              '$cas',
              '$spof',
              '$ca_role_id',
              '$sce',
              '$ece',
              '$pce',
              '$ex',
              '$sis'
            ) ;
        ";

        $result = $this->db->query($sql);

        if($result) { $result = mysql_insert_id(); }

        return $result;
    }

    public function get_criticality_stage($criticality_analysis_id)
    {
        $result = array();

        $sql = "SELECT * FROM `iso_redesign`.`critical_equipment`";

        $result = $this->db->query($sql);

        if($result) { $result = $result->row(); }

        return $result;
    }


    public function update_group( $id, $group_name ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET `group` = ? WHERE {$db_primary} = ?";

        $escaped_values = array( $group_name, $id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $this->db->insert_id();

        return $result;
    }

    public function get_criticality_analysis( $role, $asset = null, $category = null, $code = null, $last_review_date = null, $status = null, $categories = null, $user = null, $new_order_sql = null ) {

        $db_table = 'criticality_analysis';

        $sql = "SELECT a.*, b.day_status FROM criticality_analysis a LEFT JOIN (SELECT x.criticality_analysis_id, x.day_status from criticality_analysis_history x, (SELECT criticality_analysis_id,MAX(`day`) AS max_day,MAX(`month`) AS max_month, MAX(`year`) AS max_year FROM criticality_analysis_history GROUP BY criticality_analysis_id) AS z WHERE x.criticality_analysis_id = z.criticality_analysis_id AND x.`day` = z.max_day AND x.`month` = z.max_month AND x.`year` = z.max_year) AS b ON a.criticality_analysis_id = b.criticality_analysis_id WHERE a.asset IS NOT NULL ";

        if ( $asset != null || $asset != '' ) {
            $sql .= " AND a.asset = {$asset} ";
        }

        if ( $category != null || $category != '' ) {
            $sql .= " AND a.category = {$category} ";
        }

        if ( $code != null || $code != '' ) {
            $sql .= " AND a.code = '{$code}' ";
        }

        if ( $status != null || $status != '' ) {
            $sql .= " AND b.day_status = {$status} ";
        }

        if ( $user != null || $user != '' ) {
            $sql .= " AND a.user_id = {$user} ";
        }


        //status checkbox
        /*if($status != null || $status != ''){
            $status_list = "";
            foreach($status as $stat){
                $status_list .= $stat.',';
            }

            $status_list = rtrim($status_list, ",");

            $sql .= " AND b.day_status in ({$status_list}) ";
        }*/

        if ( $last_review_date != null || $last_review_date != '' ) {

            switch ( $last_review_date ) {

            case '0':
                $sql .= " AND a.last_review_date IS NULL ";
                break;

            case '<1':
                $sql .= " AND a.last_review_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR) ";
                break;

            case '1-2':
                $sql .= " AND
                            a.last_review_date <= DATE_SUB(NOW(),INTERVAL 1 YEAR)
                            AND
                            a.last_review_date >= DATE_SUB(NOW(),INTERVAL 2 YEAR) ";
                break;

            case '2-3':
                $sql .= " AND
                            a.last_review_date <= DATE_SUB(NOW(),INTERVAL 2 YEAR)
                            AND
                            a.last_review_date >= DATE_SUB(NOW(),INTERVAL 3 YEAR) ";
                break;

            case '3-4':
                $sql .= " AND
                            a.last_review_date <= DATE_SUB(NOW(),INTERVAL 3 YEAR)
                            AND
                            a.last_review_date >= DATE_SUB(NOW(),INTERVAL 4 YEAR) ";
                break;

            case '4-5':
                $sql .= " AND
                            a.last_review_date <= DATE_SUB(NOW(),INTERVAL 4 YEAR)
                            AND
                            a.last_review_date >= DATE_SUB(NOW(),INTERVAL 5 YEAR) ";
                break;

            case '>5':
                $sql .= " AND a.last_review_date <= DATE_SUB(NOW(),INTERVAL 5 YEAR) ";
                break;
            }


        }

        //to do

        if ( !empty( $new_order_sql ) ) {
            $sql .= $new_order_sql;
        }else {
            $sql .= " ORDER BY a.asset,a.criticality_analysis_id ";
        }

        if ( $categories != null || $categories != '' ) {
            $start_category_sql = "SELECT i.* FROM criticality_analysis_category j,(";
            $category_items = '';
            foreach ( $categories as $category ) {
                $category_items .= $category.",";
            }

            $category_items = rtrim( $category_items, ',' );

            $end_category_sql = ") as i WHERE i.criticality_analysis_id = j.criticality_analysis_id  AND j.menu_id in ({$category_items}) AND j.`value` = 1 group by i.criticality_analysis_id order by i.asset,i.criticality_analysis_id";

            $sql = $start_category_sql.$sql.$end_category_sql;
        }

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function get_current_day_criticality_analysis( $role, $asset = null, $category = null, $code = null, $last_review_date = null, $status = null, $categories = null, $user = null ) {

        $db_table = 'criticality_analysis';

        $current_day = date( 'j' );
        $current_month = date( 'n' );
        $current_year = date( 'Y' );

        $sql = "SELECT a.*,b.day_status FROM criticality_analysis AS a LEFT JOIN (SELECT y.* FROM criticality_analysis AS x, criticality_analysis_history AS y WHERE x.criticality_analysis_id = y.criticality_analysis_id AND y.`day` = {$current_day} AND y.`month` = {$current_month} AND y.`year` = {$current_year}) AS b ON a.criticality_analysis_id = b.criticality_analysis_id WHERE a.asset IS NOT NULL ";

        if ( $asset != null || $asset != '' ) {
            $sql .= " AND a.asset = {$asset} ";
        }

        if ( $category != null || $category != '' ) {
            $sql .= " AND a.category = {$category} ";
        }

        if ( $code != null || $code != '' ) {
            $sql .= " AND a.code = '{$code}' ";
        }

        if ( $user != null || $user != '' ) {
            $sql .= " AND a.user_id = {$user} ";
        }



        if ( $status != null || $status != '' ) {
            $status_list = "";
            foreach ( $status as $stat ) {
                $status_list .= $stat.',';
            }

            $status_list = rtrim( $status_list, "," );

            $sql .= " AND b.day_status in ({$status_list}) ";
        }

        if ( $last_review_date != null || $last_review_date != '' ) {

            switch ( $last_review_date ) {

            case '0':
                $sql .= " AND a.last_review_date IS NULL ";
                break;

            case '<1':
                $sql .= " AND a.last_review_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR) ";
                break;

            case '1-2':
                $sql .= " AND
                            a.last_review_date <= DATE_SUB(NOW(),INTERVAL 1 YEAR)
                            AND
                            a.last_review_date >= DATE_SUB(NOW(),INTERVAL 2 YEAR) ";
                break;

            case '2-3':
                $sql .= " AND
                            a.last_review_date <= DATE_SUB(NOW(),INTERVAL 2 YEAR)
                            AND
                            a.last_review_date >= DATE_SUB(NOW(),INTERVAL 3 YEAR) ";
                break;

            case '3-4':
                $sql .= " AND
                            a.last_review_date <= DATE_SUB(NOW(),INTERVAL 3 YEAR)
                            AND
                            a.last_review_date >= DATE_SUB(NOW(),INTERVAL 4 YEAR) ";
                break;

            case '4-5':
                $sql .= " AND
                            a.last_review_date <= DATE_SUB(NOW(),INTERVAL 4 YEAR)
                            AND
                            a.last_review_date >= DATE_SUB(NOW(),INTERVAL 5 YEAR) ";
                break;

            case '>5':
                $sql .= " AND a.last_review_date <= DATE_SUB(NOW(),INTERVAL 5 YEAR) ";
                break;
            }


        }

        $sql .= " ORDER BY a.asset,a.criticality_analysis_id ";

        if ( $categories != null || $categories != '' ) {
            $start_category_sql = "SELECT i.* FROM criticality_analysis_category j,(";
            $category_items = '';
            foreach ( $categories as $category ) {
                $category_items .= $category.",";
            }

            $category_items = rtrim( $category_items, ',' );

            $end_category_sql = ") as i WHERE i.criticality_analysis_id = j.criticality_analysis_id  AND j.menu_id in ({$category_items}) AND j.`value` = 1 group by i.criticality_analysis_id order by i.asset,i.criticality_analysis_id";

            $sql = $start_category_sql.$sql.$end_category_sql;
        }

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function create_criticality_analysis( $asset, $sis_id, $code, $last_review_date, $reliability_redundancy, $safety, $environmental, $operational, $reinstatement, $status, $cas, $frequency, $user_id ) {

        $sql = "INSERT INTO criticality_analysis (asset, sis_id, code, last_review_date, reliability_redundancy, safety_health_criticality, environmental_criticality, operational_criticality, reinstatement, status, cas, frequency, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $escaped_values = array( $asset, $sis_id, $code, $last_review_date, $reliability_redundancy, $safety, $environmental, $operational, $reinstatement, $status, $cas, $frequency, $user_id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function create_simple_criticality_analysis( $asset, $category, $tag_number, $description, $code, $last_review_date = null, $user_id ) {

        $sql = "INSERT INTO criticality_analysis (asset, category, tag_number, description, code, last_review_date, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $escaped_values = array( $asset, $category, $tag_number, $description, $code, $last_review_date, $user_id );

        $query = $this->db->query( $sql, $escaped_values );

        //echo $this->db->last_query();

        return $this->db->insert_id();
    }

    public function update_single_criticality_analysis( $criticality_analysis_id, $asset, $tag_number, $description, $reliability_redundancy, $safety, $environmental, $operational, $reinstatement, $status, $cas, $frequency ) {

        $sql = "UPDATE criticality_analysis SET asset = ?, tag_number = ?, description = ?, reliability_redundancy = ?, safety_health_criticality = ?, environmental_criticality = ?, operational_criticality = ?, reinstatement = ?, `status` = ?, cas = ?, frequency = ? WHERE criticality_analysis_id = ?";

        $escaped_values = array( $asset, $tag_number, $description, $reliability_redundancy, $safety, $environmental, $operational, $reinstatement, $status, $cas, $frequency, $criticality_analysis_id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function update_failure_rate( $criticality_analysis_id, $asset, $tag_number, $description, $start_date, $failure_rate, $mtbf, $mttr, $fail_date, $repair_date, $estimated_repair_time, $actual_repair_time ) {

        $sql = "UPDATE criticality_analysis SET asset = ?, tag_number = ?, description = ?, start_date = ?, failure_rate = ?, mtbf = ?, mttr = ?, fail_date = ?, repair_date = ?, estimated_repair_time = ?, actual_repair_time = ? WHERE criticality_analysis_id = ?";

        $escaped_values = array( $asset, $tag_number, $description, $start_date, $failure_rate, $mtbf, $mttr, $fail_date, $repair_date, $estimated_repair_time, $actual_repair_time, $criticality_analysis_id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function delete_single_criticality_analysis( $criticality_analysis_id ) {

        $db_table = 'criticality_analysis';
        $db_primary = 'criticality_analysis_id';

        $sql = "DELETE FROM {$db_table} WHERE {$db_primary} = ?";

        $query = $this->db->query( $sql, $criticality_analysis_id );
    }

    public function get_critical_analysis_history_list() {
        $sql = "SELECT a.* FROM criticality_analysis a ORDER BY a.asset";

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function get_critical_analysis_history_daily_values( $day, $month, $year ) {
        $sql = "SELECT c.criticality_analysis_id AS c_analysis_id ,d.* FROM criticality_analysis AS c LEFT JOIN (SELECT b.* FROM criticality_analysis a LEFT JOIN criticality_analysis_history b ON a.criticality_analysis_id = b.criticality_analysis_id WHERE b.`day` = {$day} AND b.`month` = {$month} AND b.`year` = {$year}) AS d ON c.criticality_analysis_id = d.criticality_analysis_id";

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function get_critical_analysis_history_daily_values_new( $day, $month, $year, $role, $asset = null, $category = null, $code = null, $last_review_date = null, $categories = null, $user = null ) {

        $asset_sql = '';
        $category_sql = '';
        $code_sql = '';
        $last_review_date_sql = '';
        $asset_order_sql = '';

        $sql = "SELECT c.criticality_analysis_id AS c_analysis_id ,d.*
        FROM criticality_analysis AS c
        LEFT JOIN
        (SELECT b.* FROM criticality_analysis a
            LEFT JOIN criticality_analysis_history b ON a.criticality_analysis_id = b.criticality_analysis_id
            WHERE
            b.`day` = {$day}
            AND b.`month` = {$month}
            AND b.`year` = {$year}) AS d ON c.criticality_analysis_id = d.criticality_analysis_id";


        if ( $asset != null || $asset != '' ) {
            $asset_sql = " AND c.asset = {$asset} ";
        }

        if ( $category != null || $category != '' ) {
            $category_sql = " AND c.category = {$category} ";
        }

        if ( $code != null || $code != '' ) {
            $code_sql = " AND c.code = '{$code}' ";
        }

        if ( $user != null || $user != '' ) {
            $sql .= " AND c.user_id = {$user} ";
        }



        if ( $last_review_date != null || $last_review_date != '' ) {

            switch ( $last_review_date ) {

            case '0':
                $last_review_date_sql = " AND c.last_review_date IS NULL ";
                break;

            case '<1':
                $last_review_date_sql = " AND c.last_review_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR) ";
                break;

            case '1-2':
                $last_review_date_sql = " AND
                            c.last_review_date <= DATE_SUB(NOW(),INTERVAL 1 YEAR)
                            AND
                            c.last_review_date >= DATE_SUB(NOW(),INTERVAL 2 YEAR) ";
                break;

            case '2-3':
                $last_review_date_sql = " AND
                            c.last_review_date <= DATE_SUB(NOW(),INTERVAL 2 YEAR)
                            AND
                            c.last_review_date >= DATE_SUB(NOW(),INTERVAL 3 YEAR) ";
                break;

            case '3-4':
                $last_review_date_sql = " AND
                            c.last_review_date <= DATE_SUB(NOW(),INTERVAL 3 YEAR)
                            AND
                            c.last_review_date >= DATE_SUB(NOW(),INTERVAL 4 YEAR) ";
                break;

            case '4-5':
                $last_review_date_sql = " AND
                            c.last_review_date <= DATE_SUB(NOW(),INTERVAL 4 YEAR)
                            AND
                            c.last_review_date >= DATE_SUB(NOW(),INTERVAL 5 YEAR) ";
                break;

            case '>5':
                $last_review_date_sql = " AND c.last_review_date <= DATE_SUB(NOW(),INTERVAL 5 YEAR) ";
                break;
            }


        }


        $asset_order_sql = " ORDER BY c.asset,c.criticality_analysis_id ";


        $sql .= " WHERE c.asset IS NOT NULL ";
        $sql .= $asset_sql;
        $sql .= $category_sql;
        $sql .= $code_sql;
        $sql .= $last_review_date_sql;
        $sql .= $asset_order_sql;

        if ( $categories != null || $categories != '' ) {
            $start_category_sql = "SELECT i.* FROM criticality_analysis_category j,(";
            $category_items = '';
            foreach ( $categories as $category ) {
                $category_items .= $category.",";
            }

            $category_items = rtrim( $category_items, ',' );

            $end_category_sql = ") as i WHERE i.c_analysis_id = j.criticality_analysis_id  AND j.menu_id in ({$category_items}) AND j.`value` = 1 group by i.c_analysis_id";

            $sql = $start_category_sql.$sql.$end_category_sql;
        }





        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function get_critical_analysis_history_monthly_values( $start_day, $end_day, $month, $year, $role, $asset = null, $category = null, $code = null, $last_review_date = null, $categories = null, $user = null ) {
        $asset_sql = '';
        $category_sql = '';
        $code_sql = '';
        $last_review_date_sql = '';
        $asset_order_sql = '';

        $sql = "SELECT c.criticality_analysis_id AS c_analysis_id ,d.*
        FROM criticality_analysis AS c
        LEFT JOIN
        (SELECT b.* FROM criticality_analysis a
            LEFT JOIN criticality_analysis_history b ON a.criticality_analysis_id = b.criticality_analysis_id
            WHERE  (b.`day` between {$start_day} AND {$end_day}) AND b.`month` = {$month}
            AND b.`year` = {$year}) AS d ON c.criticality_analysis_id = d.criticality_analysis_id";


        if ( $asset != null || $asset != '' ) {
            $asset_sql = " AND c.asset = {$asset} ";
        }

        if ( $category != null || $category != '' ) {
            $category_sql = " AND c.category = {$category} ";
        }

        if ( $code != null || $code != '' ) {
            $code_sql = " AND c.code = '{$code}' ";
        }

        if ( $user != null || $user != '' ) {
            $sql .= " AND c.user_id = {$user} ";
        }



        if ( $last_review_date != null || $last_review_date != '' ) {

            switch ( $last_review_date ) {

            case '0':
                $last_review_date_sql = " AND c.last_review_date IS NULL ";
                break;

            case '<1':
                $last_review_date_sql = " AND c.last_review_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR) ";
                break;

            case '1-2':
                $last_review_date_sql = " AND
                            c.last_review_date <= DATE_SUB(NOW(),INTERVAL 1 YEAR)
                            AND
                            c.last_review_date >= DATE_SUB(NOW(),INTERVAL 2 YEAR) ";
                break;

            case '2-3':
                $last_review_date_sql = " AND
                            c.last_review_date <= DATE_SUB(NOW(),INTERVAL 2 YEAR)
                            AND
                            c.last_review_date >= DATE_SUB(NOW(),INTERVAL 3 YEAR) ";
                break;

            case '3-4':
                $last_review_date_sql = " AND
                            c.last_review_date <= DATE_SUB(NOW(),INTERVAL 3 YEAR)
                            AND
                            c.last_review_date >= DATE_SUB(NOW(),INTERVAL 4 YEAR) ";
                break;

            case '4-5':
                $last_review_date_sql = " AND
                            c.last_review_date <= DATE_SUB(NOW(),INTERVAL 4 YEAR)
                            AND
                            c.last_review_date >= DATE_SUB(NOW(),INTERVAL 5 YEAR) ";
                break;

            case '>5':
                $last_review_date_sql = " AND c.last_review_date <= DATE_SUB(NOW(),INTERVAL 5 YEAR) ";
                break;
            }


        }


        $asset_order_sql = " ORDER BY c.asset, c.criticality_analysis_id ";


        $sql .= " WHERE c.asset IS NOT NULL ";
        $sql .= $asset_sql;
        $sql .= $category_sql;
        $sql .= $code_sql;
        $sql .= $last_review_date_sql;
        $sql .= $asset_order_sql;

        if ( $categories != null || $categories != '' ) {
            $start_category_sql = "SELECT i.* FROM criticality_analysis_category j,(";
            $category_items = '';
            foreach ( $categories as $category ) {
                $category_items .= $category.",";
            }

            $category_items = rtrim( $category_items, ',' );

            $end_category_sql = ") as i WHERE i.c_analysis_id = j.criticality_analysis_id  AND j.menu_id in ({$category_items}) AND j.`value` = 1";

            $sql = $start_category_sql.$sql.$end_category_sql;
        }




        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function count_critical_analysis( $role, $asset = null, $category = null, $code = null, $last_review_date = null, $categories = null ) {

        $sql = "SELECT criticality_analysis_id as sis_id FROM criticality_analysis a WHERE a.asset IS NOT NULL ";

        if ( $asset != null || $asset != '' ) {
            $sql .= " AND a.asset = {$asset} ";
        }

        if ( $category != null || $category != '' ) {
            $sql .= " AND a.category = {$category} ";
        }

        if ( $code != null || $code != '' ) {
            $sql .= " AND a.code = '{$code}' ";
        }



        if ( $last_review_date != null || $last_review_date != '' ) {

            switch ( $last_review_date ) {

            case '0':
                $sql .= " AND a.last_review_date IS NULL ";
                break;

            case '<1':
                $sql .= " AND a.last_review_date >= DATE_SUB(NOW(),INTERVAL 1 YEAR) ";
                break;

            case '1-2':
                $sql .= " AND
                            a.last_review_date <= DATE_SUB(NOW(),INTERVAL 1 YEAR)
                            AND
                            a.last_review_date >= DATE_SUB(NOW(),INTERVAL 2 YEAR) ";
                break;

            case '2-3':
                $sql .= " AND
                            a.last_review_date <= DATE_SUB(NOW(),INTERVAL 2 YEAR)
                            AND
                            a.last_review_date >= DATE_SUB(NOW(),INTERVAL 3 YEAR) ";
                break;

            case '3-4':
                $sql .= " AND
                            a.last_review_date <= DATE_SUB(NOW(),INTERVAL 3 YEAR)
                            AND
                            a.last_review_date >= DATE_SUB(NOW(),INTERVAL 4 YEAR) ";
                break;

            case '4-5':
                $sql .= " AND
                            a.last_review_date <= DATE_SUB(NOW(),INTERVAL 4 YEAR)
                            AND
                            a.last_review_date >= DATE_SUB(NOW(),INTERVAL 5 YEAR) ";
                break;

            case '>5':
                $sql .= " AND a.last_review_date <= DATE_SUB(NOW(),INTERVAL 5 YEAR) ";
                break;
            }


        }

        $sql .= " ORDER BY a.asset,a.criticality_analysis_id ";

        if ( $categories != null || $categories != '' ) {
            $start_category_sql = "SELECT i.* FROM criticality_analysis_category j,(";
            $category_items = '';
            foreach ( $categories as $category ) {
                $category_items .= $category.",";
            }

            $category_items = rtrim( $category_items, ',' );

            $end_category_sql = ") as i WHERE i.sis_id = j.criticality_analysis_id  AND j.menu_id in ({$category_items}) AND j.`value` = 1 group by i.sis_id";

            $sql = $start_category_sql.$sql.$end_category_sql;
        }

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function check_criticality_analysis_history_row( $day, $month, $year, $criticality_analysis_id ) {

        $sql = "SELECT criticality_analysis_history_id AS num_record FROM criticality_analysis_history WHERE `day` = {$day} AND `month` = {$month} AND `year`  = {$year} AND criticality_analysis_id = {$criticality_analysis_id}";

        $query = $this->db->query( $sql );

        $result = $query->row();

        if ( count( $result ) >0 ) {

            $row_id = $result->num_record;

            return $row_id;

        }

        return false;
    }

    public function create_criticality_analysis_history_row( $day, $month, $year, $day_spf, $day_availability, $day_status, $hours, $day_obs = null, $criticality_analysis_id, $day_cv ) {

        $db_primary = 'criticality_analysis_history';
        $sql = "INSERT INTO {$db_primary} (`day`, `month`, `year`, day_spf, day_availability, day_status, hours, day_obs, day_cv, criticality_analysis_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $escaped_values = array( $day, $month, $year, $day_spf, $day_availability, $day_status, $hours, $day_obs, $day_cv, $criticality_analysis_id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function update_single_criticality_analysis_history_row( $row_exist, $day_spf, $day_availability, $day_status, $hours, $day_obs = null, $day_cv ) {

        $db_primary = 'criticality_analysis_history';

        $sql = "UPDATE criticality_analysis_history SET day_spf = ?, day_obs = ?, day_availability = ?, day_status = ?, hours = ?, day_cv = ? WHERE criticality_analysis_history_id = ?";

        $escaped_values = array( $day_spf, $day_obs, $day_availability, $day_status, $hours, $day_cv, $row_exist );

        $query = $this->db->query( $sql, $escaped_values );
    }

    public function get_cv_value( $day, $month, $year ) {
        $db_primary = 'criticality_analysis_history';

        $current_month = date( 'n' );
        $current_year = date( 'Y' );

        if ( $month == $current_month && $year == $current_year ) {

            $sql = "SELECT criticality_analysis_id,day_cv,`day` FROM {$db_primary} WHERE `day` = {$day} AND `month` = {$month} AND `year` = {$year}";

            $query = $this->db->query( $sql );

            $result = $query->result();

            return $result;

        }

        $sql = "SELECT criticality_analysis_id,day_cv,`day` FROM {$db_primary} WHERE `day` <= 31 AND `month` = {$month} AND `year` = {$year}";

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function get_criticality_analysis_history_current_day_values( $criticality_analysis_id ) {
        $db_primary = 'criticality_analysis_history';

        $day = date( 'j' );
        $month = date( 'n' );
        $year = date( 'Y' );

        $sql = "SELECT * FROM {$db_primary} WHERE `day` = {$day} AND `month` = {$month} AND `year` = {$year} AND criticality_analysis_id = {$criticality_analysis_id}";

        $query = $this->db->query( $sql );

        $result = $query->row();

        return $result;
    }

    public function get_availability_hour_value( $month, $year ) {
        $db_primary = 'criticality_analysis_history';

        $month = intval( $month );
        $year = intval( $year );

        $current_month = intval( date( 'n' ) );
        $current_year = intval( date( 'Y' ) );

        if ( $month == $current_month && $year == $current_year ) {

            $current_day = date( 'j' );
            $sql = "SELECT criticality_analysis_id,day_availability,hours FROM criticality_analysis_history WHERE `month` = {$month} AND `year` = {$year} AND `day` <= {$current_day}";

            $query = $this->db->query( $sql );

            $result = $query->result();

            return $result;
        }

        $sql = "SELECT criticality_analysis_id,day_availability,hours FROM criticality_analysis_history WHERE `month` = {$month} AND `year` = {$year} AND `day` <= 31";

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function update_compliance( $id, $performance_standard ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET performance_standard = ? WHERE {$db_primary} = ?";

        $escaped_values = array( $performance_standard, $id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function get_equipment_with_multiple_status( $criticality_analysis_id, $first_menu_id, $second_menu_id, $start_date ) {

        $db_table = 'criticality_analysis_history';
        $db_primary = 'criticality_analysis_history_id';

        $sql = "SELECT STR_TO_DATE(CONCAT(a.month,'/',a.day,'/',a.year), '%m/%d/%Y') as date_test, a.* FROM criticality_analysis_history a WHERE a.criticality_analysis_id = ? AND a.day_status IN(?,?) HAVING date_test > ? ORDER BY a.month,a.day,a.year";

        $escaped_values = array( $criticality_analysis_id, $first_menu_id, $second_menu_id, $start_date );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_equipment_with_status( $criticality_analysis_id, $menu_id, $start_date ) {

        $db_table = 'criticality_analysis_history';
        $db_primary = 'criticality_analysis_history_id';

        $sql = "SELECT STR_TO_DATE(CONCAT(a.month,'/',a.day,'/',a.year), '%m/%d/%Y') as date_test, a.* FROM criticality_analysis_history a WHERE a.criticality_analysis_id = ? AND a.day_status = ? HAVING date_test > ? ORDER BY a.month,a.day,a.year";

        $escaped_values = array( $criticality_analysis_id, $menu_id, $start_date );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }

    public function get_last_equipment_with_status( $criticality_analysis_id, $menu_id, $start_date ) {

        $db_table = 'criticality_analysis_history';
        $db_primary = 'criticality_analysis_history_id';

        $sql = "SELECT STR_TO_DATE(CONCAT(a.month,'/',a.day,'/',a.year), '%m/%d/%Y') as criticality_date, a.* FROM criticality_analysis_history a WHERE a.criticality_analysis_id = ? AND a.day_status = ? HAVING criticality_date > ? ORDER BY criticality_date DESC";

        $escaped_values = array( $criticality_analysis_id, $menu_id, $start_date );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row();

        return $result;
    }

    public function get_latest_equipment_availability( $criticality_analysis_id, $month, $year ) {

        $db_table = 'criticality_analysis_history';
        $db_primary = 'criticality_analysis_history_id';

        $sql = "SELECT STR_TO_DATE(CONCAT(a.month,'/',a.day,'/',a.year), '%m/%d/%Y') as criticality_date, a.day_availability, a.day FROM criticality_analysis_history a WHERE a.criticality_analysis_id = ? AND a.year = ? AND a.month = ? AND a.day_availability IS NOT NULL ORDER BY criticality_date DESC limit 1";

        $escaped_values = array( $criticality_analysis_id, $year, $month );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row();

        return $result;
    }

    public function get_latest_equipment_availability_month( $criticality_analysis_id, $year ) {

        $db_table = 'criticality_analysis_history';
        $db_primary = 'criticality_analysis_history_id';

        $sql = "SELECT STR_TO_DATE(CONCAT(a.month,'/',a.day,'/',a.year), '%m/%d/%Y') as criticality_date, a.month FROM criticality_analysis_history a WHERE a.criticality_analysis_id = ? AND a.year = ? AND a.day_availability IS NOT NULL ORDER BY criticality_date DESC limit 1";

        $escaped_values = array( $criticality_analysis_id, $year );

        $query = $this->db->query( $sql, $escaped_values );

        $num_rows = $query->num_rows();

        if ( $num_rows > 0 ) {
            $result = $query->row()->month;
        }else {
            $result = null;
        }


        return $result;
    }

    public function get_monthly_availability_percentage( $criticality_analysis_id, $month, $year ) {

        $yes_availability = $this->get_menu_id_by_value( '1', 'criticality_avail', 'menu' );
        $no_availability = $this->get_menu_id_by_value( '0', 'criticality_avail', 'menu' );

        $db_table = 'criticality_analysis_history';
        $db_primary = 'criticality_analysis_history_id';

        $sql = "SELECT if(not_available>0, available/(available+not_available), available/available) as availability FROM

            (SELECT

            sum(case when a.day_availability = ? then 1 else 0 end) as available,
            sum(case when a.day_availability = ? then 1 else 0 end) as not_available

            FROM criticality_analysis_history a WHERE a.criticality_analysis_id = ? AND a.year = ? AND a.month = ? AND a.day_availability IS NOT NULL) as month_table";

        $escaped_values = array( $yes_availability, $no_availability, $criticality_analysis_id, $year, $month );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row()->availability;

        return $result;
    }

    public function update_single_index( $id, $owner, $defect_elimination, $project_plan, $technical_bulletin ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET user_id = ?, defect_elimination = ?, project_plan = ?, technical_bulletin = ? WHERE {$db_primary} = ?";

        $escaped_values = array( $owner, $defect_elimination, $project_plan, $technical_bulletin, $id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function get_business_criticality_category_results( $criticality_analysis_id ) {

        $db_table = 'criticality_analysis_category';
        $db_primary = 'criticality_analysis_id';

        $sql = "SELECT * FROM {$db_table} WHERE {$db_primary} = {$criticality_analysis_id}";

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function update_single_business_criticality_category( $criticality_analysis_id, $pce = null, $sce= null, $ece= null, $sis = null, $atex_m = null, $atex_e = null ) {

        $db_table = 'criticality_analysis_category';


        //pce
        if ( $pce != null ) {
            $pce_id = $this->get_menu_id_by_value( '', 'criticality_equipment_category', 'menu', 'Production Critical Equipment' );

            $sql = "SELECT * FROM criticality_analysis_category WHERE criticality_analysis_id = {$criticality_analysis_id} AND menu_id = {$pce_id}";

            $query = $this->db->query( $sql );

            $result = $query->row();

            if ( count( $result ) > 0 ) {
                $update_sql = "UPDATE criticality_analysis_category SET value = ? WHERE criticality_analysis_id = {$criticality_analysis_id} AND menu_id = {$pce_id}";

                $escaped_values = array( $pce );

                $update_query = $this->db->query( $update_sql, $escaped_values );
            }
            else {
                $create_sql = "INSERT INTO {$db_table} (criticality_analysis_id, menu_id, value) VALUES (?, ?, ?)";

                $escaped_values = array( $criticality_analysis_id, $pce_id, $pce );

                $query = $this->db->query( $create_sql, $escaped_values );
            }
        }

        //sce
        if ( $sce != null ) {
            $sce_id = $this->get_menu_id_by_value( '', 'criticality_equipment_category', 'menu', 'Safety Critical Equipment' );

            $sql = "SELECT * FROM criticality_analysis_category WHERE criticality_analysis_id = {$criticality_analysis_id} AND menu_id = {$sce_id}";

            $query = $this->db->query( $sql );

            $result = $query->row();

            if ( count( $result ) > 0 ) {
                $update_sql = "UPDATE criticality_analysis_category SET value = ? WHERE criticality_analysis_id = {$criticality_analysis_id} AND menu_id = {$sce_id}";

                $escaped_values = array( $sce );

                $update_query = $this->db->query( $update_sql, $escaped_values );
            }
            else {
                $create_sql = "INSERT INTO {$db_table} (criticality_analysis_id, menu_id, value) VALUES (?, ?, ?)";

                $escaped_values = array( $criticality_analysis_id, $sce_id, $sce );

                $query = $this->db->query( $create_sql, $escaped_values );
            }
        }

        //ece
        if ( $ece != null ) {
            $ece_id = $this->get_menu_id_by_value( '', 'criticality_equipment_category', 'menu', 'Environment Critical Equipment' );

            $sql = "SELECT * FROM criticality_analysis_category WHERE criticality_analysis_id = {$criticality_analysis_id} AND menu_id = {$ece_id}";

            $query = $this->db->query( $sql );

            $result = $query->row();

            if ( count( $result ) > 0 ) {
                $update_sql = "UPDATE criticality_analysis_category SET value = ? WHERE criticality_analysis_id = {$criticality_analysis_id} AND menu_id = {$ece_id}";

                $escaped_values = array( $ece );

                $update_query = $this->db->query( $update_sql, $escaped_values );
            }
            else {
                $create_sql = "INSERT INTO {$db_table} (criticality_analysis_id, menu_id, value) VALUES (?, ?, ?)";

                $escaped_values = array( $criticality_analysis_id, $ece_id, $ece );

                $query = $this->db->query( $create_sql, $escaped_values );
            }
        }

        if ( $sis != null ) {
            $sis_id = $this->get_menu_id_by_value( '', 'criticality_equipment_category', 'menu', 'Safety Instrumented System' );

            $sql = "SELECT * FROM criticality_analysis_category WHERE criticality_analysis_id = {$criticality_analysis_id} AND menu_id = {$sis_id}";

            $query = $this->db->query( $sql );

            $result = $query->row();

            if ( count( $result ) > 0 ) {
                $update_sql = "UPDATE criticality_analysis_category SET value = ? WHERE criticality_analysis_id = {$criticality_analysis_id} AND menu_id = {$sis_id}";

                $escaped_values = array( $sis );

                $update_query = $this->db->query( $update_sql, $escaped_values );
            }
            else {
                $create_sql = "INSERT INTO {$db_table} (criticality_analysis_id, menu_id, value) VALUES (?, ?, ?)";

                $escaped_values = array( $criticality_analysis_id, $sis_id, $sis );

                $query = $this->db->query( $create_sql, $escaped_values );
            }
        }

        //atex_m
        if ( $atex_m != null ) {
            $atex_m_id = $this->get_menu_id_by_value( '', 'criticality_equipment_category', 'menu', 'Mechanical ATEX Equipment' );

            $sql = "SELECT * FROM criticality_analysis_category WHERE criticality_analysis_id = {$criticality_analysis_id} AND menu_id = {$atex_m_id}";

            $query = $this->db->query( $sql );

            $result = $query->row();

            if ( count( $result ) > 0 ) {
                $update_sql = "UPDATE criticality_analysis_category SET value = ? WHERE criticality_analysis_id = {$criticality_analysis_id} AND menu_id = {$atex_m_id}";

                $escaped_values = array( $atex_m );

                $update_query = $this->db->query( $update_sql, $escaped_values );
            }
            else {
                $create_sql = "INSERT INTO {$db_table} (criticality_analysis_id, menu_id, value) VALUES (?, ?, ?)";

                $escaped_values = array( $criticality_analysis_id, $atex_m_id, $atex_m );

                $query = $this->db->query( $create_sql, $escaped_values );
            }
        }

        //atex_e
        if ( $atex_e != null ) {
            $atex_e_id = $this->get_menu_id_by_value( '', 'criticality_equipment_category', 'menu', 'Electrical ATEX Equipment' );

            $sql = "SELECT * FROM criticality_analysis_category WHERE criticality_analysis_id = {$criticality_analysis_id} AND menu_id = {$atex_e_id}";

            $query = $this->db->query( $sql );

            $result = $query->row();

            if ( count( $result ) > 0 ) {
                $update_sql = "UPDATE criticality_analysis_category SET value = ? WHERE criticality_analysis_id = {$criticality_analysis_id} AND menu_id = {$atex_e_id}";

                $escaped_values = array( $atex_e );

                $update_query = $this->db->query( $update_sql, $escaped_values );
            }
            else {
                $create_sql = "INSERT INTO {$db_table} (criticality_analysis_id, menu_id, value) VALUES (?, ?, ?)";

                $escaped_values = array( $criticality_analysis_id, $atex_e_id, $atex_e );

                $query = $this->db->query( $create_sql, $escaped_values );
            }
        }
    }

    public function update_failure_rate_calculations( $id, $failure_rate, $mtbf, $mttr, $fail_date, $repair_date, $estimated_repair_time ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET failure_rate = ?, mtbf = ?, mttr = ?, fail_date = ?, repair_date = ?, estimated_repair_time = ? WHERE {$db_primary} = ?";

        $escaped_values = array( $failure_rate, $mtbf, $mttr, $fail_date, $repair_date, $estimated_repair_time, $id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    //get previous day values
    public function get_previous_day_criticality_analysis_values() {

        $yesterdate = date( 'd-m-Y', strtotime( ' -1 day' ) );
        $yesterday = explode( "-", $yesterdate );
        $day = $yesterday[0];
        $month = $yesterday[1];
        $year = $yesterday[2];

        $sql = "SELECT b.* FROM criticality_analysis a LEFT JOIN criticality_analysis_history b ON a.criticality_analysis_id = b.criticality_analysis_id WHERE b.`day` = {$day} AND b.`month` = {$month} AND b.`year` = {$year} AND b.day_spf is not null AND b.day_status IS NOT NULL AND b.day_availability IS NOT NULL";

        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function get_critical_equipment(){

        $sql = "SELECT *, (SELECT ref FROM ce_parent_sce WHERE ce_parent_sce_id = ce.ce_parent_sce_id) as ref  FROM critical_equipment ce";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_parent_sce_ref($parent_sce)
    {
        $parent_sce = intval(trim($parent_sce));
        $sql = "SELECT ref FROM ce_parent_sce WHERE ce_parent_sce_id = $parent_sce";
        
        $result = $this->db->query($sql)->row->ref;

        return $result;
    }

    public function update_critical_equipment($data){
        foreach ($data as $key => $value) {
             $$key = $value;
        }

        $sql = "
            UPDATE 
              `iso_redesign`.`critical_equipment` 
            SET
              `critical_equipment_id` = '$critical_equipment_id',
              `tag_number` = '$tag_number',
              `subsystem_component` = '$subsystem_component',
              `code` = '$code',
              `quantity` = '$quantity',
              `conflict` = '$conflict',
              `availability` = '$availability',
              `rule_set` = '$rule_set',
              `source_of_information` = '$source_of_information',
              `ce_group_id` = '$ce_group_id',
              `ce_parent_sce_id` = '$ce_parent_sce_id' 
            WHERE `critical_equipment_id` = '$critical_equipment_id' ;
        ";

        $result = $this->db->query($sql);

        if($result) { return true; }
        else { return false; }
    }


    public function get_single_critical_equipment($critical_equipment_id){
        $sql = "SELECT *, (SELECT ref FROM ce_parent_sce WHERE ce_parent_sce_id = ce.ce_parent_sce_id) as ref
                    FROM critical_equipment ce WHERE critical_equipment_id = $critical_equipment_id";

        $query = $this->db->query($sql);

        $result = $query->row_array();

        return $result;
    }

    public function get_ca_questions(){

        $sql = "SELECT * FROM ca_question_category, ca_question 
                    WHERE 
                        ca_question_category.ca_question_category_id = ca_question.ca_question_category_id";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }


    public function get_ca_questions_by_category($category_id){

        $sql = "SELECT * FROM ca_question_category, ca_question 
                    WHERE 
                        ca_question_category.ca_question_category_id = ca_question.ca_question_category_id 
                        AND ca_question_category.ca_question_category_id = ?";

        $escaped_values = array($category_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_ca_question_categories(){

        $sql = "SELECT * FROM ca_question_category";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_ca_question_categories_by_ce($ce_id){

        $sql = "SELECT * FROM ca_question_category a, `ca_q_category_answer` b WHERE a.`ca_question_category_id` = b.`ca_question_category_id` AND b.`critical_equipment_id` = ?";

        $escaped_values = array($ce_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_formula_by_category_code($category_id){

        $sql = "SELECT * FROM formula, formula_category WHERE formula_category.formula_category_id = ?";

        $escaped_values = array($category_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_operation_value($formula_category_id, $value){

        $sql = "SELECT 
                  * 
                FROM
                  formula,
                  formula_category 
                WHERE formula_category.formula_category_id = ?
                  AND formula.value = ?
                  AND formula_category.formula_category_id = formula.formula_category_id 
                LIMIT 1";

        $escaped_values = array($formula_category_id, $value);

        $query = $this->db->query($sql, $escaped_values);

        $num_rows = $query->num_rows();

        if ( $num_rows > 0 ) {
            $result = $query->row();
        }else {
            $result = 1;
        }

        return $result;
    }

    public function add_ce($ref, $tag_number, $subsystem_component, $code, $quantity, $conflict, 
                        $availability, $rule_set, $source_of_information, $ce_group_id, $ce_parent_sce_id){

        $sql = "
                INSERT INTO `iso_redesign`.`critical_equipment` (
                  `ref`,`tag_number`,`subsystem_component`,`code`,`quantity`,`conflict`,`availability`,
                  `rule_set`,
                  `source_of_information`,`ce_group_id`,`ce_parent_sce_id`
                ) 
                VALUES
                  (
                    '$ref',
                    '$tag_number',
                    '$subsystem_component',
                    '$code',
                    '$quantity',
                    '$conflict',
                    '$availability',
                    '$rule_set',
                    '$source_of_information',
                    '$ce_group_id',
                    '$ce_parent_sce_id'
                  ) ;
        ";

        $query = $this->db->query($sql);

        if($query) { return mysql_insert_id(); }
        else { return false; }
    }

    public function get_ce_id($critical_equipment_id){

        $sql = "SELECT * FROM critical_equipment WHERE critical_equipment_id = '$critical_equipment_id' LIMIT 1";

        $query = $this->db->query($sql);

        $result = $query->row();

        return $result;
    }

    public function update_ca_answer_total($ca_answer_id, $computed_result){

        $sql = "UPDATE ca_answer SET total = ? WHERE ca_answer_id = ?";

        $escaped_values = array($computed_result, $ca_answer_id);

        $query = $this->db->query($sql, $escaped_values);
    }

    public function update_category_answer_total($cat_ans_id, $sum_total){

        $sql = "UPDATE ca_q_category_answer SET total = ? WHERE ca_q_category_answer_id = ?";

        $escaped_values = array($sum_total, $cat_ans_id);

        $query = $this->db->query($sql, $escaped_values);
    }

    public function get_risk_total($criticality_analysis_id){

        $sql = "SELECT SUM(total) as risk_total FROM ca_q_category_answer where critical_equipment_id = ?";

        $escaped_values = array($criticality_analysis_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->risk_total;

        return $result;
    }

    public function get_pc_total($critical_equipment_id, $sum_group){

        $sql = "SELECT SUM(a.total) as pc_total FROM ca_q_category_answer a, ca_question_category b where a.critical_equipment_id = ? and b.sum_group = ? and b.ca_question_category_id = a.ca_question_category_id";

        $escaped_values = array($critical_equipment_id, $sum_group);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->pc_total;

        return $result;
    }

    public function update_risk_total($risk_total, $criticality_analysis_id){

        $sql = "UPDATE critical_equipment SET risk_total = ? WHERE critical_equipment_id = ?";

        $escaped_values = array($risk_total, $criticality_analysis_id);

        $query = $this->db->query($sql, $escaped_values);
    }

    public function get_ca_category_totals($criticality_analysis_id){

        $sql = "SELECT a.*, (select sum(total) from ca_answer where ca_q_category_answer_id = a.ca_q_category_answer_id) as sum_total from ca_q_category_answer a WHERE a.critical_equipment_id = ?";

        $escaped_values = array($criticality_analysis_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_ca_answers($criticality_analysis_id){

        /*$sql = "SELECT 
                  *,
                  ans.`value` AS ans_value,
                  q.`value` AS q_value,
                  cat_ans.`total` as cat_ans_total,
                  ans.`total` as ans_total
                FROM
                  ca_answer ans,
                  ca_q_category_answer cat_ans,
                  ca_question q,
                  ca_question_category cat_q 
                WHERE ans.ca_q_category_answer_id = cat_ans.ca_q_category_answer_id 
                  AND cat_ans.criticality_analysis_id 
                  AND q.`ca_question_id` = ans.`ca_question_id` 
                  AND cat_q.ca_question_category_id = cat_ans.ca_question_category_id 
                  AND cat_ans.criticality_analysis_id = ? ";*/

        $sql = "SELECT 
  *,
  ans.`value` AS ans_value,
  q.`value` AS q_value,
  cat_ans.`total` AS cat_ans_total,
  ans.`total` AS ans_total 
FROM
  ca_answer ans,
  ca_q_category_answer cat_ans,
  ca_question q,
  ca_question_category cat_q 
WHERE ans.ca_q_category_answer_id = cat_ans.ca_q_category_answer_id 
  AND q.`ca_question_id` = ans.`ca_question_id` 
  AND cat_q.ca_question_category_id = cat_ans.ca_question_category_id 
  AND cat_ans.critical_equipment_id = ?";

        $escaped_values = array($criticality_analysis_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function initialize_criticality_analysis($ref, $notes, $spof_answer, $se_answer, $multi_answer,  $sce, $ece, $pce, $ex, $sis, $inspection_periodicity_hrs, $spof_value, $se_value, $ce_id){

        $sql = "INSERT INTO critical_equipment (ref, notes, spof_answer, se_answer, multi_answer, sce, ece, pce, ex, sis, inspection_periodicity_hrs, spof_value, se_value) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $escaped_values = array($ref, $notes, $spof_answer, $se_answer, $multi_answer, $sce, $ece, $pce, $ex, $sis, $inspection_periodicity_hrs, $spof_value, $se_value);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function insert_criticality_analysis($ref, $notes, $spof_answer, $se_answer, $multi_answer, $sce, $ece, $pce, $ex, $sis, $spof_value, $se_value, $spof_result, $se_result, $risk_total, $overall_criticality, $overall_reliability_score, $status_value_adjustment, $inspection_periodicity_hrs, $spf_criticality, $cas, $critical_equipment_id ){

        $sql = "INSERT INTO critical_equipment (ref, notes, spof_answer, se_answer, multi_answer, sce, ece, pce, ex, sis, spof_value, se_value, spof_result, se_result, risk_total, overall_criticality, overall_reliability_score, status_value_adjustment, inspection_periodicity_hrs, spf_criticality, cas) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,? , ?, ?, ?, ?, ?, ?, ? ,?)";

        $escaped_values = array($ref, $notes, $spof_answer, $se_answer, $multi_answer, $sce, $ece, $pce, $ex, $sis, $spof_value, $se_value, $spof_result, $se_result, $risk_total, $overall_criticality, $overall_reliability_score, $status_value_adjustment, $inspection_periodicity_hrs, $spf_criticality, $cas);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();

    }


    public function update_critical_equipment_redundancy($critical_equipment_id, $ref, $notes, $spof_answer, $se_answer, $multi_answer, $sce, $ece, $pce, $ex, $sis, $spof_value, $se_value, $spof_result, $se_result, $risk_total, $overall_criticality, $overall_reliability_score, $status_value_adjustment, $inspection_periodicity_hrs, $spf_criticality, $cas ){

        $sql = "UPDATE critical_equipment SET ref = ?, notes = ?, spof_answer = ?, se_answer = ?, multi_answer = ?, sce = ?, ece = ?, pce = ?, ex = ?, sis = ?, spof_value = ?, se_value = ?, spof_result = ?, se_result = ?, risk_total = ?, overall_criticality = ?, overall_reliability_score = ?, status_value_adjustment = ?, inspection_periodicity_hrs = ?, spf_criticality = ?, cas = ? WHERE critical_equipment_id = ?";

        $escaped_values = array($ref, $notes, $spof_answer, $se_answer, $multi_answer, $sce, $ece, $pce, $ex, $sis, $spof_value, $se_value, $spof_result, $se_result, $risk_total, $overall_criticality, $overall_reliability_score, $status_value_adjustment, $inspection_periodicity_hrs, $spf_criticality, $cas, $critical_equipment_id);

        $query = $this->db->query($sql, $escaped_values);

        return $critical_equipment_id;

    }

    public function update_criticality_analysis($id, $ref, $notes, $spof_answer, $se_answer, $multi_answer, $sce, $ece, $pce, $ex, $sis, $inspection_periodicity_hrs, $spof_value, $se_value){

        $sql = "UPDATE critical_equipment SET ref = ?, notes = ?, spof_answer = ?, se_answer = ?, multi_answer = ?, sce = ?, ece = ?, pce = ?, ex = ?, sis = ?, inspection_periodicity_hrs = ?, spof_value = ?, se_value = ? WHERE critical_equipment_id = ?";

        $escaped_values = array($ref, $notes, $spof_answer, $se_answer, $multi_answer, $sce, $ece, $pce, $ex, $sis, $inspection_periodicity_hrs, $spof_value, $se_value, $id);

        $query = $this->db->query($sql, $escaped_values);

        return $id;
    }


    public function delete_category_answer($ca_id){

        $sql = "DELETE from ca_q_category_answer where critical_equipment_id = ?";

        $escaped_values = array($ca_id);

        $query = $this->db->query($sql, $escaped_values);

        if($query){
            return true;
        }else{
            return false;
        }
    }

    public function insert_category_answer($ca_id, $category_id, $category_answer, $total = 0){

        $sql = "INSERT INTO ca_q_category_answer (answer, ca_question_category_id, critical_equipment_id, total) VALUES (?, ?, ?, ?)";

        $escaped_values = array($category_answer, $category_id, $ca_id, $total);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function delete_ca_answer($category_answer_id){

        $sql = "DELETE from ca_answer where ca_q_category_answer_id = ?";

        $escaped_values = array($category_answer_id);

        $query = $this->db->query($sql, $escaped_values);
    }

    public function insert_ca_answer($question_id, $category_answer_id, $ca_answer, $total = 0){

        $sql = "INSERT INTO ca_answer (value, ca_question_id, ca_q_category_answer_id, total) VALUES (?, ?, ?, ?)";

        $escaped_values = array($ca_answer, $question_id, $category_answer_id, $total);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function update_criticality_analysis_computations($id, $spof_result, $se_result, $risk_total, $overall_criticality, $cas){

        $sql = "UPDATE critical_equipment SET spof_result = ?, se_result = ?, risk_total = ?, overall_criticality = ?, cas = ? WHERE critical_equipment_id = ?";

        $escaped_values = array($spof_result, $se_result, $risk_total, $overall_criticality, $cas, $id);

        $query = $this->db->query($sql, $escaped_values);
    }


    public function get_roles($criticality_analysis_id){

        $sql = "SELECT a.*,b.* from ca_role a, menu b, critical_equipment c WHERE a.role_id = b.menu_id AND c.critical_equipment_id = a.critical_equipment_id AND c.critical_equipment_id = ?";

        $escaped_values = array($criticality_analysis_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }
    
    public function edit_ce($id, $asset_id, $ref, $tag_number, $subsystem_component, $code, $quantity, $conflict, $availability, $rule_set, $source_of_information, $ce_group_id){

        $sql = "UPDATE critical_equipment SET asset_id = '$asset_id', ref = '$ref', tag_number = '$tag_number', subsystem_component = '$subsystem_component', code = '$code', quantity = '$quantity',
                        conflict = '$conflict', availability = '$availability', rule_set = '$rule_set', source_of_information = '$source_of_information', ce_group_id = '$ce_group_id'
                WHERE critical_equipment_id = '$id'";

        $query = $this->db->query($sql);
    }

    public function delete_ce($id){

        $sql = "DELETE FROM critical_equipment WHERE critical_equipment_id = '$id'";

        $query = $this->db->query($sql);
    }

    public function get_asset_ce(){

        $sql = "SELECT * FROM ce_parent_sce";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_ce_not_analysed(){

        /*$sql = "SELECT 
              b.*,
              c.`name`,
              c.ref AS ref,
              c.asset_id,
              d.`name` AS asset_code,
              'N/A' as role_name,
              'N/A' as cas,
              '' as criticality_analysis_id,
              'N/A' as ip_letter,
              CASE
                WHEN b.tag_number IS NULL OR b.tag_number = ''
                THEN 'NO TAGS'
                ELSE b.tag_number
              END AS tag_number,
                            CASE
                WHEN b.`code` IS NULL OR b.`code` = ''
                THEN 'ZZZZ'
                ELSE b.`code`
              END AS code_order
            FROM
              critical_equipment b,
              ce_parent_sce c,
              menu d 
            WHERE c.ce_parent_sce_id = b.ce_parent_sce_id 
              AND c.asset_id = d.menu_id 
              AND b.`critical_equipment_id` NOT IN 
              (SELECT 
                `critical_equipment_id` 
              FROM
                (SELECT DISTINCT 
                  (critical_equipment_id),
                  (SELECT 
                    MAX(criticality_analysis_id) 
                  FROM
                    criticality_analysis_stage 
                  WHERE critical_equipment_id = a1.critical_equipment_id) AS criticality_analysis_id 
                FROM
                  criticality_analysis_stage a1) AS a) ORDER BY code_order"*/;

        $sql = "SELECT 
  CASE
    WHEN ce.cas IS NULL 
    THEN 'N/A' 
    ELSE ce.cas 
  END AS cas,
  CASE
    WHEN ce.tag_number IS NULL 
    OR ce.tag_number = '' 
    THEN 'NO TAGS' 
    ELSE ce.tag_number 
  END AS tag_number,
  CASE
    WHEN ce.`code` IS NULL 
    OR ce.`code` = '' 
    THEN 'ZZZ' 
    ELSE ce.`code` 
  END AS code_order,
  'N/A' AS ip_letter,
  ce.`critical_equipment_id`,
  ce.`tag_number`,
  ce.`subsystem_component`,
  ce.`code`,
  sce.`name` AS sce_name,
  scem.name AS asset_code,
  'N/A' AS role_name
FROM
  critical_equipment ce,
  ce_parent_sce sce,
  menu scem 
WHERE ce.`ce_parent_sce_id` = sce.`ce_parent_sce_id` 
  AND sce.`asset_id` = scem.`menu_id` AND ce.cas IS NULL
ORDER BY code_order ASC";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_ca_list(){

        /*$sql = "SELECT b.ce_parent_sce_id, b.ref, b.tag_number, b.subsystem_component, b.`code`, b.quantity, a.cas, c.`name`, c.ref, c.asset_id, d.`name` as asset_code, f.`name` as role_name
                    FROM 
                        criticality_analysis_stage a, 
                        critical_equipment b, 
                        ce_parent_sce c,
                        menu d,
                        ca_role e,
                        menu f
                    WHERE a.critical_equipment_id = b.critical_equipment_id
                    AND c.ce_parent_sce_id = b.ce_parent_sce_id
                    AND c.asset_id = d.menu_id
                    AND e.criticality_analysis_id = a.criticality_analysis_id
                    AND e.role_type = 'main'
                    AND f.menu_id = e.role_id
                    ";*/

        /*$sql = "SELECT 
          role_menu_join.*,
          m.name AS asset_code 
        FROM
          menu m 
          INNER JOIN 
            (SELECT 
              role_join.*,
              men.name AS role_name 
            FROM
              menu men 
              INNER JOIN 
                (SELECT 
                  test.*,
                  `ca_r`.`ca_role_id`,
                  `ca_r`.`role_id`,
                  ca_r.`role_type` 
                FROM
                  `ca_role` ca_r 
                  LEFT JOIN 
                    (SELECT 
                      a.`criticality_analysis_id`,
                      b.ce_parent_sce_id,
                      b.tag_number,
                      b.subsystem_component,
                      b.`code`,
                      b.quantity,
                      a.cas,
                      c.`name`,
                      c.ref,
                      c.asset_id 
                    FROM
                      criticality_analysis_stage a,
                      critical_equipment b,
                      ce_parent_sce c,
                      menu d 
                    WHERE a.critical_equipment_id = b.critical_equipment_id 
                      AND c.ce_parent_sce_id = b.ce_parent_sce_id 
                      AND c.asset_id = d.menu_id) AS test 
                    ON test.criticality_analysis_id = ca_r.`criticality_analysis_id`) AS role_join 
                ON role_join.role_id = men.menu_id WHERE role_join.role_type = 'main') role_menu_join 
            ON role_menu_join.asset_id = m.menu_id ";*/

        /*$sql = "SELECT *,
                CASE
                    WHEN a.tag_number IS NULL 
                    OR a.tag_number = '' 
                    THEN 'NO TAGS' 
                    ELSE a.tag_number 
                  END AS tag_number,
                (SELECT ip_letter FROM inspection_periodicity WHERE a.cas BETWEEN cas_range_low AND cas_range_high) AS ip_letter
                 FROM
            (SELECT 
             role_menu_join.*,
             m.name AS asset_code 
            FROM
             menu m 
             INNER JOIN 
               (SELECT 
                 role_join.*,
                 men.name AS role_name 
               FROM
                 menu men 
                 INNER JOIN 
                   (SELECT 
                     test.*,
                     `ca_r`.`ca_role_id`,
                     `ca_r`.`role_id`,
                     ca_r.`role_type` 
                   FROM
                     `ca_role` ca_r 
                     LEFT JOIN 
                       (SELECT 
                         a.`criticality_analysis_id`,
                         b.ce_parent_sce_id,
                         b.tag_number,
                         b.subsystem_component,
                         b.`code`,
                         b.quantity,
                         a.cas,
                         c.`name`,
                         c.ref,
                         c.asset_id
                       FROM
                         criticality_analysis_stage a,
                         critical_equipment b,
                         ce_parent_sce c,
                         menu d 
                       WHERE a.critical_equipment_id = b.critical_equipment_id 
                         AND c.ce_parent_sce_id = b.ce_parent_sce_id 
                         AND c.asset_id = d.menu_id) AS test 
                       ON test.criticality_analysis_id = ca_r.`criticality_analysis_id`) AS role_join 
                   ON role_join.role_id = men.menu_id 
               WHERE role_join.role_type = 'main') role_menu_join 
               ON role_menu_join.asset_id = m.menu_id) AS a
               
               INNER JOIN (SELECT DISTINCT 
             (critical_equipment_id),
             (SELECT 
               MAX(criticality_analysis_id) 
             FROM
               criticality_analysis_stage 
             WHERE critical_equipment_id = a1.critical_equipment_id) AS criticality_analysis_id 
            FROM
             criticality_analysis_stage a1 ) AS b
             
             ON a.criticality_analysis_id = b.criticality_analysis_id";*/


        /*$sql = "SELECT 
              *,
              CASE
                WHEN a.tag_number IS NULL 
                OR a.tag_number = '' 
                THEN 'NO TAGS' 
                ELSE a.tag_number 
              END AS tag_number,
              (SELECT 
                ip_letter 
              FROM
                inspection_periodicity 
              WHERE FLOOR(a.cas) BETWEEN cas_range_low 
                AND cas_range_high) AS ip_letter 
            FROM
              (SELECT 
                role_menu_join.*,
                m.name AS asset_code 
              FROM
                menu m 
                INNER JOIN 
                  (SELECT 
                    role_join.*,
                    men.name AS role_name 
                  FROM
                    menu men 
                    INNER JOIN 
                      (SELECT 
                        test.*,
                        `ca_r`.`ca_role_id`,
                        `ca_r`.`role_id`,
                        ca_r.`role_type` 
                      FROM
                        `ca_role` ca_r 
                        LEFT JOIN 
                          (SELECT 
                            a.`criticality_analysis_id`,
                            b.ce_parent_sce_id,
                            b.tag_number,
                            b.subsystem_component,
                            b.`code`,
                            b.quantity,
                            a.cas,
                            c.`name`,
                            c.ref,
                            c.asset_id,
                            CASE
                              WHEN b.`code` IS NULL 
                              OR b.`code` = '' 
                              THEN 'ZZZ' 
                              ELSE b.`code` 
                            END AS code_order 
                          FROM
                            criticality_analysis_stage a,
                            critical_equipment b,
                            ce_parent_sce c,
                            menu d 
                          WHERE a.critical_equipment_id = b.critical_equipment_id 
                            AND c.ce_parent_sce_id = b.ce_parent_sce_id 
                            AND c.asset_id = d.menu_id 
                          ORDER BY code_order) AS test 
                          ON test.criticality_analysis_id = ca_r.`criticality_analysis_id`) AS role_join 
                      ON role_join.role_id = men.menu_id 
                  WHERE role_join.role_type = 'main') role_menu_join 
                  ON role_menu_join.asset_id = m.menu_id) AS a 
              INNER JOIN 
                (SELECT DISTINCT 
                  (critical_equipment_id),
                  (SELECT 
                    MAX(criticality_analysis_id) 
                  FROM
                    criticality_analysis_stage 
                  WHERE critical_equipment_id = a1.critical_equipment_id) AS criticality_analysis_id 
                FROM
                  criticality_analysis_stage a1) AS b 
                ON a.criticality_analysis_id = b.criticality_analysis_id ";*/



        /*$sql = "SELECT 
 b.criticality_analysis_id,
 asset_code,
 `name`,
 subsystem_component,
 `code`,
 CASE
   WHEN cas > 100 
   THEN 100 
   ELSE cas 
 END AS casp,
 cas,
 role_name,
 CASE
   WHEN a.tag_number IS NULL 
   OR a.tag_number = '' 
   THEN 'NO TAGS' 
   ELSE a.tag_number 
 END AS tag_number,
 (SELECT 
   ip_letter 
 FROM
   inspection_periodicity 
 WHERE FLOOR(casp) BETWEEN cas_range_low 
   AND cas_range_high) AS ip_letter 
FROM
 (SELECT 
   role_menu_join.*,
   m.name AS asset_code 
 FROM
   menu m 
   INNER JOIN 
     (SELECT 
       role_join.*,
       men.name AS role_name 
     FROM
       menu men 
       INNER JOIN 
         (SELECT 
           test.*,
           `ca_r`.`ca_role_id`,
           `ca_r`.`role_id`,
           ca_r.`role_type` 
         FROM
           `ca_role` ca_r 
           LEFT JOIN 
             (SELECT 
               a.`criticality_analysis_id`,
               b.ce_parent_sce_id,
               b.tag_number,
               b.subsystem_component,
               b.`code`,
               b.quantity,
               a.cas,
               c.`name`,
               c.ref,
               c.asset_id,
               CASE
                 WHEN b.`code` IS NULL 
                 OR b.`code` = '' 
                 THEN 'ZZZ' 
                 ELSE b.`code` 
               END AS code_order 
             FROM
               criticality_analysis_stage a,
               critical_equipment b,
               ce_parent_sce c,
               menu d 
             WHERE a.critical_equipment_id = b.critical_equipment_id 
               AND c.ce_parent_sce_id = b.ce_parent_sce_id 
               AND c.asset_id = d.menu_id 
             ORDER BY code_order) AS test 
             ON test.criticality_analysis_id = ca_r.`criticality_analysis_id`) AS role_join 
         ON role_join.role_id = men.menu_id 
     WHERE role_join.role_type = 'main') role_menu_join 
     ON role_menu_join.asset_id = m.menu_id) AS a 
 INNER JOIN 
   (SELECT DISTINCT 
     (critical_equipment_id),
     (SELECT 
       MAX(criticality_analysis_id) 
     FROM
       criticality_analysis_stage 
     WHERE critical_equipment_id = a1.critical_equipment_id) AS criticality_analysis_id 
   FROM
     criticality_analysis_stage a1) AS b 
   ON a.criticality_analysis_id = b.criticality_analysis_id";*/


        /*$sql = "SELECT 
                b.criticality_analysis_id,
                asset_code,
                `name`,
                subsystem_component,
                `code`,
                CASE
                  WHEN cas > 100 
                  THEN 100 
                  ELSE cas 
                END AS casp,
                cas,
                role_name,
                CASE
                  WHEN a.tag_number IS NULL 
                  OR a.tag_number = '' 
                  THEN 'NO TAGS' 
                  ELSE a.tag_number 
                END AS tag_number,
                (SELECT 
                  ip_letter 
                FROM
                  inspection_periodicity 
                WHERE FLOOR(casp) BETWEEN cas_range_low 
                  AND cas_range_high) AS ip_letter FROM 
                (SELECT 
                  role_menu_join.*,
                  m.name AS asset_code 
                FROM
                  menu m 
                  INNER JOIN 
                    (SELECT 
                      role_join.*,
                      men.name AS role_name 
                    FROM
                      menu men 
                      INNER JOIN 
                        (SELECT 
                          test.*,
                          `ca_r`.`ca_role_id`,
                          `ca_r`.`role_id`,
                          ca_r.`role_type` 
                        FROM
                          `ca_role` ca_r 
                          LEFT JOIN 
                            (SELECT 
                              a.`criticality_analysis_id`,
                              b.ce_parent_sce_id,
                              b.tag_number,
                              b.subsystem_component,
                              b.`code`,
                              b.quantity,
                              a.cas,
                              c.`name`,
                              c.ref,
                              c.asset_id,
                              CASE
                                WHEN b.`code` IS NULL 
                                OR b.`code` = '' 
                                THEN 'ZZZ' 
                                ELSE b.`code` 
                              END AS code_order 
                            FROM
                              criticality_analysis_stage a,
                              critical_equipment b,
                              ce_parent_sce c,
                              menu d 
                            WHERE a.critical_equipment_id = b.critical_equipment_id 
                              AND c.ce_parent_sce_id = b.ce_parent_sce_id 
                              AND c.asset_id = d.menu_id) AS test 
                            ON test.criticality_analysis_id = ca_r.`criticality_analysis_id`) AS role_join 
                        ON role_join.role_id = men.menu_id 
                    WHERE role_join.role_type = 'main') role_menu_join 
                    ON role_menu_join.asset_id = m.menu_id) AS a 
                INNER JOIN 
                  (SELECT DISTINCT 
                    (critical_equipment_id),
                    (SELECT 
                      MAX(criticality_analysis_id) 
                    FROM
                      criticality_analysis_stage 
                    WHERE critical_equipment_id = a1.critical_equipment_id) AS criticality_analysis_id 
                  FROM
                    criticality_analysis_stage a1) AS b 
                  ON a.criticality_analysis_id = b.criticality_analysis_id 
                ORDER BY casp DESC,
                a.code_order ASC  ";*/



        $sql = "SELECT 
  DISTINCT(ce.critical_equipment_id),
  CASE
    WHEN ce.cas > 100 
    THEN 100 
    ELSE ce.cas 
  END AS casp,
  ce.cas,
  CASE
    WHEN ce.tag_number IS NULL 
    OR ce.tag_number = '' 
    THEN 'NO TAGS' 
    ELSE ce.tag_number 
  END AS tag_number,
  CASE
    WHEN ce.`code` IS NULL 
    OR ce.`code` = '' 
    THEN 'ZZZ' 
    ELSE ce.`code` 
  END AS code_order,
  (SELECT 
    ip_letter 
  FROM
    inspection_periodicity 
  WHERE FLOOR(casp) BETWEEN cas_range_low 
    AND cas_range_high) AS ip_letter,
  ce.`critical_equipment_id`,
  ce.`tag_number`,
  ce.`subsystem_component`,
  ce.`code`,
  r.`role_type`,
  rm.`name` AS role_name,
  sce.`name` AS sce_name,
  scem.name AS asset_code 
FROM
  critical_equipment ce,
  ca_role r,
  menu rm,
  ce_parent_sce sce,
  menu scem 
WHERE ce.critical_equipment_id = r.critical_equipment_id 
  AND r.role_type = 'main' 
  AND rm.menu_id = r.`role_id` 
  AND ce.`ce_parent_sce_id` = sce.`ce_parent_sce_id` 
  AND sce.`asset_id` = scem.`menu_id` 
ORDER BY ce.cas DESC,
  code_order ASC";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_ce_list(){

        $sql = "SELECT b.*, c.`name`, c.ref as parent_sce_ref, c.asset_id, d.`name` as asset_code
                    FROM 
                        critical_equipment b, 
                        ce_parent_sce c,
                        menu d
                    WHERE c.ce_parent_sce_id = b.ce_parent_sce_id
                    AND c.asset_id = d.menu_id";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_ce($id){

        $sql = "SELECT b.*, c.`name`, c.ref as parent_sce_ref, c.asset_id, d.`name` as asset_code
                    FROM 
                        critical_equipment b, 
                        ce_parent_sce c,
                        menu d
                    WHERE c.ce_parent_sce_id = b.ce_parent_sce_id
                    AND c.asset_id = d.menu_id and b.critical_equipment_id = ?";

        $escaped_values = array($id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row();

        return $result;
    }

    public function get_critical_analysis_stage_totals($id){
    }


    public function get_ca_simple($id){

        $sql = "SELECT * FROM critical_equipment WHERE critical_equipment_id = ?";

        $escaped_values = array($id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row();

        return $result;

    }

    public function get_ca($id){

        /*$sql = "SELECT a.*, b.ce_group_id, b.ce_parent_sce_id, b.ref, b.tag_number, b.subsystem_component, b.`code`, b.quantity, c.`name`, c.ref as parent_sce_ref, c.asset_id, d.`name` as asset_code, f.`name` as role_name
                    FROM 
                        criticality_analysis_stage a, 
                        critical_equipment b, 
                        ce_parent_sce c,
                        menu d,
                        ca_role e,
                        menu f
                    WHERE a.critical_equipment_id = b.critical_equipment_id
                    AND c.ce_parent_sce_id = b.ce_parent_sce_id
                    AND c.asset_id = d.menu_id
                    AND e.criticality_analysis_id = a.criticality_analysis_id
                    AND e.role_type = 'main'
                    AND f.menu_id = e.role_id
                                        AND a.criticality_analysis_id = ?";*/

        $sql = "SELECT 
  b.*,
  b.ce_group_id,
  b.ce_parent_sce_id,
  b.ref,
  b.tag_number,
  b.subsystem_component,
  b.`code`,
  b.quantity,
  c.`name`,
  c.ref AS parent_sce_ref,
  c.asset_id,
  d.`name` AS asset_code,
  f.`name` AS role_name 
FROM
  critical_equipment b,
  ce_parent_sce c,
  menu d,
  ca_role e,
  menu f 
WHERE 
  c.ce_parent_sce_id = b.ce_parent_sce_id 
  AND c.asset_id = d.menu_id 
  AND e.role_type = 'main' 
  AND f.menu_id = e.role_id 
  AND b.`critical_equipment_id` = ?";

        $escaped_values = array($id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row();

        return $result;
    }

    public function get_ca_role($ca_id, $role_type = null){

        $result = null;

        if($role_type == 'all'){
            $sql = "SELECT * from ca_role a, menu b where critical_equipment_id = ? and a.role_id = b.menu_id";
            $escaped_values = array($ca_id);
            $query = $this->db->query($sql, $escaped_values);
            $result = $query->result();
        }else if($role_type == 'secondary'){
            $sql = "SELECT * from ca_role a, menu b where critical_equipment_id = ? and a.role_id = b.menu_id AND a.role_type IS NULL";
            $escaped_values = array($ca_id);
            $query = $this->db->query($sql, $escaped_values);
            $result = $query->result();
        }else{
            $sql = "SELECT * from ca_role a, menu b where critical_equipment_id = ? and a.role_id = b.menu_id AND a.role_type = ?";
            $escaped_values = array($ca_id, $role_type);
            $query = $this->db->query($sql, $escaped_values);
            $result = $query->row();
        }

        return $result;
    }

    public function insert_role($criticality_analysis_id, $ca_role_id, $role_type){

        $sql = "INSERT INTO ca_role (role_id, role_type, critical_equipment_id) VALUES (?, ?, ?)";

        $escaped_values = array($ca_role_id, $role_type, $criticality_analysis_id);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function update_role($ca_id, $role_id, $role_type){

        $sql = "UPDATE ca_role SET role_id = ? WHERE critical_equipment_id = ? AND role_type = ? LIMIT 1";

        $escaped_values = array($role_id, $ca_id, $role_type);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    # Scoring Module:
    # @Created: 02/07/2015
    # 
    # ----------------------------------------------------------------------
    public function get_ce_by_group_id($code, $critical_equipment_id)
    {
        $code = trim($code);

        // $sql = "SELECT * FROM critical_equipment where ce_group_id = ?";
        $sql = " SELECT * FROM critical_equipment WHERE `code` = '$code' AND `critical_equipment_id` != '$critical_equipment_id' ORDER BY (CODE = ''), CODE ASC ";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_ce_by_exclusion($code, $critical_equipment_id) 
    {
        $code = trim($code);

        $sql = "
            SELECT 
              * 
            FROM
              critical_equipment 
            WHERE `code` <> '$code' AND `critical_equipment_id` != '$critical_equipment_id' ORDER BY (CODE = ''), CODE ASC ";

        $query = $this->db->query($sql);

        $result = $query->result();
        /*var_dump($result);*/
        return $result;
    }

    public function add_ce_redundancy($critical_equipment_id, $critical_equipment_id_redundant)
    {
        $critical_equipment_id = intval( trim($critical_equipment_id) );
        $critical_equipment_id_redundant = intval( trim($critical_equipment_id_redundant) );

        $sql = "
            INSERT INTO `iso_redesign`.`ce_available_redundancy` (
              `critical_equipment_id`,
              `critical_equipment_id_redundant`
            ) 
            VALUES
              (
                '$critical_equipment_id',
                '$critical_equipment_id_redundant'
              ) ;
        ";

        // Run insert.
        $result = $this->db->query($sql);

        return $result;
    }
    # ----------------------------------------------------------------------

    public function get_redundancy_count($id){

        $sql = "SELECT count(*) as count FROM critical_equipment where ce_group_id = ?";

        $escaped_values = array($id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->count;

        return $result;
    }


    public function get_category_answers($ca_id){

        $sql = "SELECT * FROM ca_q_category_answer WHERE criticality_analysis_id = ?";

        $escaped_values = array($ca_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;

    }

    public function get_category_answer($cat_id, $ca_id){

        $sql = "SELECT answer from ca_q_category_answer where critical_equipment_id = ? and ca_question_category_id = ? LIMIT 1";

        $escaped_values = array($ca_id, $cat_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->answer;

        return $result;
    }


    public function get_ca_answers_by_id($ca_id, $can_ans_id){

        $sql = "SELECT a.* from ca_answer a, ca_q_category_answer b where b.criticality_analysis_id = ? and a.ca_q_category_answer_id = b.ca_q_category_answer_id and a.ca_q_category_answer_id = ?";

        $escaped_values = array($ca_id, $can_ans_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;

    }

    public function get_ca_answer($question_id, $ca_id){
            
        $sql = "SELECT b.`value` as answer from ca_question a, ca_answer b, ca_q_category_answer c where a.ca_question_id = ? and a.ca_question_id = b.ca_question_id and c.critical_equipment_id = ? and a.ca_question_id = b.ca_question_id and b.ca_q_category_answer_id = c.ca_q_category_answer_id LIMIT 1";

        $escaped_values = array($question_id, $ca_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->answer;

        //echo $this->db->last_query();

        return $result;
    }

    public function get_ca_role_empty_checkbox(){

        $sql = "SELECT 
              *,
              a.name AS role_name,
              0 AS checked 
            FROM
              menu a,
              menu_category b 
            WHERE b.`menu_type` = 'ca_role' 
              AND b.`menu_category_id` = a.`menu_category_id` ";

        //$escaped_values = array($question_id, $ca_id);

        $query = $this->db->query($sql);

        $result = $query->result();

        //echo $this->db->last_query();

        return $result;
    }

    public function get_ca_role_checkbox($ca_id){

        /*$sql = "SELECT 
              *,
              a.name AS role_name,
              CASE
                WHEN b.NAME IS NULL 
                THEN 0 
                ELSE 1 
              END AS checked 
            FROM
              (SELECT 
                a.menu_id,
                a.name 
              FROM
                menu a,
                menu_category b 
              WHERE a.menu_category_id = b.menu_category_id 
                AND b.menu_type = 'ca_role') AS a 
              LEFT JOIN 
                (SELECT 
                  men.`menu_category_id` AS cat_id,
                  a.`role_id`,
                  cat.`menu_type`,
                  men.`name` 
                FROM
                  ca_role a,
                  menu men,
                  `menu_category` cat 
                WHERE `criticality_analysis_id` = ? 
                  AND men.`menu_id` = a.`role_id` 
                  AND a.`role_type` IS NULL 
                  AND cat.`menu_category_id` = men.`menu_category_id`) AS b 
                ON a.menu_id = b.role_id ";*/

        $sql = "SELECT 
  *,
  a.name AS role_name,
  CASE
    WHEN b.NAME IS NULL 
    THEN 0 
    ELSE 1 
  END AS checked 
FROM
  (SELECT 
    a.menu_id,
    a.name 
  FROM
    menu a,
    menu_category b 
  WHERE a.menu_category_id = b.menu_category_id 
    AND b.menu_type = 'ca_role') AS a 
  LEFT JOIN 
    (SELECT 
      men.`menu_category_id` AS cat_id,
      a.`role_id`,
      cat.`menu_type`,
      men.`name` 
    FROM
      ca_role a,
      menu men,
      `menu_category` cat 
    WHERE `critical_equipment_id` = ?
      AND men.`menu_id` = a.`role_id` 
      AND a.`role_type` IS NULL 
      AND cat.`menu_category_id` = men.`menu_category_id`) AS b 
    ON a.menu_id = b.role_id ";

        $escaped_values = array($ca_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function delete_ca_role($ca_id){

        $sql = "DELETE  FROM ca_role WHERE critical_equipment_id = ? AND role_type IS NULL OR role_type = ''";

        $escaped_values = array($ca_id);

        $query = $this->db->query($sql, $escaped_values);

        //$result = $query->result();

        //return $result;
    }

    public function insert_ca_role($ca_id, $role_id){

        $sql = "INSERT INTO ca_role (critical_equipment_id, role_id) VALUES (?, ?)";

        $escaped_values = array($ca_id, $role_id);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();

        //$result = $query->result();

        //return $result;
    }

    public function get_ip_letter($cas){

        $sql = "SELECT ip_letter from inspection_periodicity where floor(?) between cas_range_low and cas_range_high LIMIT 1";

        $escaped_values = array($cas);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->ip_letter;

        return $result;
    }

    public function get_cas_ip($cas){
    }

    public function get_ce_by_code($code){

        $sql = "SELECT 
              * 
            FROM
              critical_equipment a,
              ce_parent_sce b,
              menu c 
            WHERE a.`code` LIKE '%?%' 
            AND b.`ce_parent_sce_id` = a.`ce_parent_sce_id`
            AND c.menu_id = b.asset_id";

        $escaped_values = array($code);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_ce_not_like_code($code){

        $sql = "SELECT 
          * 
        FROM
          critical_equipment a,
          ce_parent_sce b,
          menu c 
        WHERE a.`code` NOT LIKE '%?%' 
        AND b.`ce_parent_sce_id` = a.`ce_parent_sce_id`
        AND c.menu_id = b.asset_id";

        $escaped_values = array($code);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_ip_list(){

        $sql = "SELECT * FROM inspection_periodicity";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }


    public function get_ce_redundancy_count($code){

        $sql = "SELECT COUNT(*) as count
            FROM
              critical_equipment a,
              ce_parent_sce b,
              menu c 
            WHERE a.`code` LIKE '%{$code}%' 
            AND b.`ce_parent_sce_id` = a.`ce_parent_sce_id`
            AND c.menu_id = b.asset_id";

        //$escaped_values = array("%".$code."%");

        $query = $this->db->query($sql);

        $result = $query->row()->count;

        return $result;
    }


    public function count_specific_redundancy_count($ce_id, $ce_id_r){

        $sql = "SELECT count(*) as r_count FROM ca_redundancy WHERE critical_equipment_id = ? AND ce_id_redundant = ?";

        $escaped_values = array($ce_id, $ce_id_r);

        $query = $this->db->query($sql, $escaped_values);

        $count = $query->row()->r_count;

        return $count;
    }


    public function get_ca_redundancy($ca_id){

        $sql = "SELECT * FROM ca_redundancy WHERE critical_equipment_id = ?";

        $escaped_values = array($ca_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }


    public function remove_ca_redundancy($ca_id){

        $sql = "DELETE FROM ca_redundancy WHERE critical_equipment_id = ?";

        $escaped_values = array($ca_id);

        $query = $this->db->query($sql, $escaped_values);

    }

    public function remove_specific_redundancy($ce_id, $ce_id_r){

        $sql = "DELETE FROM ca_redundancy WHERE critical_equipment_id = ? AND ce_id_redundant = ?";

        $escaped_values = array($ce_id, $ce_id_r);

        $query = $this->db->query($sql, $escaped_values);
    }


    public function insert_ca_redundancy($ce_id_fk, $ce_id){

        $sql = "INSERT INTO ca_redundancy (critical_equipment_id, ce_id_redundant) VALUES (?, ?)";

        $escaped_values = array($ce_id_fk, $ce_id);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function get_redundancy_with_ids($ce_ids, $code){

        if(empty($ce_ids)){
            $result = null;
        }else{
            $sql = "SELECT a.critical_equipment_id, c.name as asset_code, a.tag_number, a.subsystem_component, a.`code` from critical_equipment a, ce_parent_sce b, menu c where a.critical_equipment_id IN($ce_ids) and a.ce_parent_sce_id = b.ce_parent_sce_id and c.menu_id = b.asset_id and a.`code` = ?";

            $escaped_values = array($code);

            $query = $this->db->query($sql, $escaped_values);

            $result = $query->result();
        }  

        return $result;
    }


    public function ca_role_exist($ce_id, $role_type){

        $sql = "SELECT COUNT(*) AS role_count FROM ca_role WHERE critical_equipment_id = ? AND role_type = ?";

        $escaped_values = array($ce_id, $role_type);

        $query = $this->db->query($sql, $escaped_values);

        $role_count = $query->row()->role_count;

        if($role_count > 0){
            return true;
        }else{
            return false;
        }
    }

    public function get_group_sum($sum_group){

        $sql = "";

    }

    public function get_inspected_ce_count(){

        $sql = "SELECT count(*) as ce_count
                FROM
                critical_equipment ce
                WHERE 
                ce.cas IS NOT NULL";

        $query = $this->db->query($sql);

        $result = $query->row()->ce_count;

        return $result;


    }


    public function get_inspection_periodicity_with_calculations(){

        $sql = "SELECT 
              a.calculated_items_per_inspection_period / a.shifts AS calculated_average_items,
              a.* 
            FROM
              (SELECT 
                (SELECT 
                  COUNT(*) 
                FROM
                  `critical_equipment` ce 
                WHERE FLOOR(ce.cas) BETWEEN cas_range_low 
                  AND cas_range_high) AS cas_range_ce_count,
                  (SELECT 
                      COUNT(*) AS ce_count
                    FROM
                      critical_equipment ce 
                    WHERE ce.cas IS NOT NULL) AS ce_count,
                CASE
                  WHEN `cas_range_low` = 91 
                  AND `cas_range_high` = 100 
                  OR `cas_range_low` = 0 
                  AND `cas_range_high` = 10 
                  THEN 'Negligible'
                  ELSE (
                    (SELECT 
                      COUNT(*) AS ce_count
                    FROM
                      critical_equipment ce 
                    WHERE ce.cas IS NOT NULL) / 
                    (SELECT 
                      COUNT(*) 
                    FROM
                      `critical_equipment` ce 
                    WHERE FLOOR(ce.cas) BETWEEN cas_range_low 
                      AND cas_range_high)
                  ) * `estimated_equipment_percentage` 
                END AS calculated_items_per_inspection_period,
                cas_range_low,
                cas_range_high,
                shifts 
              FROM
                inspection_periodicity) AS a ";

    $query = $this->db->query($sql);

    $result = $query->result();

    return $result;



    }


}
