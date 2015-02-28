<?php

class Subject_Model extends MY_Model {

    const DB_TABLE = 'tbl_subject';
    const DB_TABLE_PK = 'subject_id';

    /*

    offer id -      tbl_grade_section ----- section
    subj_id         tbl_subject
    subj_offerid    tbl_subj_offering

    */

    /* get */
    public function get_subjects(){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql  = "SELECT * FROM {$db_table}";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_offered_subjects($offer_id){ //section

        $sql = "SELECT * FROM tbl_subj_offering a, tbl_subject b WHERE a.offer_id = ? AND b.subj_id = a.subj_id";

        $escaped_values = array($offer_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->result();

        return $result;
    }

    public function get_subjects_with_no_grade_level(){

        $sql = "SELECT 
          * 
        FROM
          tbl_subject 
        WHERE subj_id NOT IN 
          (SELECT 
            a.subj_id 
          FROM
            tbl_subject a,
            tbl_grade_level b,
            tbl_grade_subj c 
          WHERE b.`gl_id` = c.`gl_id` 
            AND a.`subj_id` = c.`subj_id`)";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    public function get_subjects_with_grade_level(){

        $sql = "SELECT 
            DISTINCT(a.subj_id),
            a.*,
            b.*,
            c.* 
          FROM
            tbl_subject a,
            tbl_grade_level b,
            tbl_grade_subj c 
          WHERE b.`gl_id` = c.`gl_id` 
            AND a.`subj_id` = c.`subj_id`";

        $query = $this->db->query($sql);

        $result = $query->result();

        return $result;
    }

    /* count */
    public function count_subject_by_grade_level($sy_start, $sy_end, $grade_level, $subj_id){

        $sql = "SELECT 
          COUNT(DISTINCT(c.subj_id)) AS count_subject
        FROM
          tbl_subject a,
          tbl_grade_level b,
          tbl_grade_subj c 
        WHERE a.subj_id = ? 
          AND b.grade_level = ? 
          AND b.sy_start = ? 
          AND b.`sy_end` = ? 
          AND b.`gl_id` = c.`gl_id`
          AND a.subj_id = c.`subj_id`";

        $escaped_values = array($subj_id, $grade_level, $sy_start, $sy_end);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row()->count_subject;

        return $result;
    }

    /* create */
    public function create_subject($subject_code, $subject_unit, $subject_description){

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "INSERT INTO {$db_table} (subj_code, subj_unit, subj_desc) VALUES (?, ?, ?)";

        $escaped_values = array($subject_code, $subject_unit, $subject_description);

        $query = $this->db->query($sql, $escaped_values);

        return $this->db->insert_id();
    }

    public function add_subject_grade_level($subj_id, $grade_level){

        $sql = "INSERT INTO tbl_grade_subj (subj_id, gl_id) VALUES (?, ?)";

        $escaped_values = array($subj_id, $grade_level);

        $query = $this->db->query($sql, $escaped_values);
    }

    public function get_subj_offerid_by_subject($subj_id){

         $sql = "SELECT subj_offerid FROM subj_offering WHERE subj_id = ?";

         $escaped_values = array($subj_id);

         $query = $this->db->query($sql, $escaped_values);

         $num_rows = $query->num_rows();

        if ( $num_rows > 0 ) {
            $result = $query->row()->subj_offerid;
        }else {
            $result = 0;
        }

        return $result;
    }

    //delete


    public function remove_subject($id){

        $sql = "DELETE FROM tbl_subject WHERE subj_id = ?";

        $escaped_values = array($id);

        $query = $this->db->query($sql, $escaped_values);
    }

    //update
    public function update_subject($id, $subj_code, $subj_desc, $unit){

        $sql = "UPDATE tbl_subject SET subj_code = ?, subj_desc = ?, unit = ? WHERE subj_id = ?";

        $escaped_values = array($subj_code, $subj_desc, $unit, $id);

        $query = $this->db->query($sql, $escaped_values);

        return $id;
    }


    


}

?>
