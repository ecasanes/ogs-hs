<?php

class Teacher_Model extends MY_Model {

    const DB_TABLE = 'teacher';
    const DB_TABLE_PK = 'teacher_id';

    public function create_teacher($firstname, $lastname, $user_id, $middlename = ''){

        $sql = "INSERT INTO teacher (teacher_fname, teacher_mname, teacher_lname, user_id) VALUES (?, ?, ?, ?)";

        $escaped_values = array($firstname, $middlename, $lastname, $user_id);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }


    public function search_list($search_key){

        $sql = "SELECT * FROM teacher WHERE CONCAT_WS(' ', teacher_fname,teacher_lname) LIKE '%{$search_key}%' OR teacher_fname LIKE '%{$search_key}%' OR teacher_lname LIKE '%{$search_key}%'";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }


}

?>
