<?php

class Subject_Model extends MY_Model {

    const DB_TABLE = 'tbl_subject';
    const DB_TABLE_PK = 'subject_id';

    public function get_subjects(){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql  = "SELECT * FROM {$db_table}";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function create_subject($subject_code, $subject_unit, $subject_description){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "INSERT INTO {$db_table} (subj_code, subj_unit, subj_desc) VALUES (?, ?, ?)";

        $escaped_values = array($subject_code, $subject_unit, $subject_description);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }


}

?>
