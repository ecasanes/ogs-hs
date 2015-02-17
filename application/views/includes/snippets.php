<?php


/*public function create_empty_cost_breakdown($code, $current_step_no, $step_id){

        $db_table = 'cost_breakdown';
        $db_primary = $this::DB_TABLE_PK;

        $cost_breakdown_sql = "INSERT INTO {$db_table} (code, current_step_no, step_id) VALUES (?, ?, ?)";
        $item_sql = "INSERT INTO cost_breakdown_item (cost_breakdown_id, code, current_step_no, step_id) VALUES (?, ?, ?, ?)";

        $query = $this->db->query($cost_breakdown_sql, array($code, $current_step_no, $step_id));
        $last_insert_id = $this->db->insert_id();

        $this->update_value($step_id, 'cost_breakdown', $last_insert_id);
        
        for($i = 0;$i<14;$i++){
            $query = $this->db->query($item_sql, array($last_insert_id, $code, $current_step_no, $step_id));
        }
        
    }*/


/*public function create_empty_enablers($code, $current_step_no, $step_id){

        $db_table = 'enablers';
        $db_primary = $this::DB_TABLE_PK;

        $sql = "INSERT INTO {$db_table} (code, current_step_no, step_id) VALUES (?,?,?)";

        for($i = 0;$i<8;$i++){
            $query = $this->db->query($sql, array($code, $current_step_no, $step_id));
        }
    }*/

/*public function create_empty_constraints($code, $current_step_no, $step_id){

        $db_table = 'constraints';
        $db_primary = $this::DB_TABLE_PK;

        $sql = "INSERT INTO {$db_table} (code, current_step_no, step_id) VALUES (?, ?, ?)";

        for($i = 0;$i<5;$i++){
            $query = $this->db->query($sql, array($code, $current_step_no, $step_id));
        }
    }*/

/*public function create_empty_meeting($code, $current_step_no, $step_id){

        $db_table = 'meeting';
        $db_primary = 'id';

        $sql = "INSERT INTO {$db_table} (code, current_step_no, step_id) VALUES (?, ?, ?)";

        for($i = 0;$i<6;$i++){
            $query = $this->db->query($sql, array($code, $current_step_no, $step_id));
        }
    }*/

/*public function create_empty_reporting($code, $current_step_no, $step_id){

        $db_table = 'reporting';
        $db_primary = 'id';

        $sql = "INSERT INTO {$db_table} (code, current_step_no, step_id) VALUES (?, ?, ?)";

        for($i = 0;$i<6;$i++){
            $query = $this->db->query($sql, array($code, $current_step_no, $step_id));
        }
    }*/

/*public function create_empty_organisation($code, $current_step_no, $step_id){

        $db_table = 'organisation';
        $db_primary = 'id';

        $sql = "INSERT INTO {$db_table} (code, current_step_no, step_id) VALUES (?, ?, ?)";

        for($i = 0;$i<8;$i++){
            $query = $this->db->query($sql, array($code, $current_step_no, $step_id));
        }
    }*/

/*public function create_empty_raci($code, $current_step_no, $step_id){

        $db_table = 'raci';
        $db_table_secondary = 'raci_name';
        $db_primary = 'id';

        $raci_sql = "INSERT INTO {$db_table} (code, current_step_no, step_id) VALUES (?, ?, ?)";
        $raci_name_sql = "INSERT INTO {$db_table_secondary} (code, current_step_no, step_id) VALUES (?, ?, ?)";

        for($i = 0;$i<10;$i++){
            $query = $this->db->query($raci_sql, array($code, $current_step_no, $step_id));
        }

        for($i = 0;$i<8;$i++){
            $query = $this->db->query($raci_name_sql, array($code, $current_step_no, $step_id));
        }
        
    }*/




?>