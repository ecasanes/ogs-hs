<?php

class Curiculum_Model extends MY_Model {

    public function create_grade_level($sy_start, $sy_end, $grade_level){ //grade_level

        $sql  = "INSERT INTO tbl_grade_level (sy_start, sy_end, grade_level) VALUES (?, ?, ?)";

        $escaped_values = array($sy_start, $sy_end, $grade_level);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }


    public function count_grade_level($grade_level, $sy_start, $sy_end){

        $sql = "SELECT count(*) as count FROM tbl_grade_level WHERE grade_level = ? AND sy_start = ? AND sy_end = ?";

        $escaped_values = array($grade_level, $sy_start, $sy_end);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->count;

        return $result;
    }


}

?>
