<?php

class Teacher_Model extends MY_Model {

    const DB_TABLE = 'tbl_teacher';
    const DB_TABLE_PK = 'teacher_id';


    /*

	TEACHER
	
	add project

	select school year
	select grade level

	ADMIN

    */


    

    /* start get */
    public function get_assigned_year_levels($user_id){



    }

    public function get_assigned_subjects($user_id){

    	$sql = "SELECT 
			  * 
			FROM
			  tbl_teacher_subj a,
			  tbl_subj_offering b,
			  tbl_user c,
			  tbl_subject d 
			WHERE b.subj_offerid = a.subj_offerid 
			  AND c.user_id = a.user_id 
			  AND b.subj_id = d.subj_id 
			  AND c.user_id = ? ";

		$escaped_values = array($user_id);

		$query = $this->db->query($sql, $escaped_values);

		$result = $query->result();

		return $result;
    }

    public function get_project($subj_offerid){

    	$sql = "SELECT * FROM tbl_project WHERE subj_offerid = ?";

    	$escaped_values = array($subj_offerid);

    	$query = $this->db->query($sql, $escaped_values);

    	$result = $query->result();

    	return $result;
    }

    public function get_quiz($subj_offerid){

    	$sql = "SELECT * FROM tbl_quiz WHERE subj_offerid = ?";

    	$escaped_values = array($subj_offerid);

    	$query = $this->db->query($sql, $escaped_values);

    	$result = $query->result();

    	return $result;
    }

    public function get_recitation($subj_offerid){

    	$sql = "SELECT * FROM tbl_recitation WHERE subj_offerid = ?";

    	$escaped_values = array($subj_offerid);

    	$query = $this->db->query($sql, $escaped_values);

    	$result = $query->result();

    	return $result;
    }

    public function get_assignment($subj_offerid){

    	$sql = "SELECT * FROM tbl_assignment WHERE subj_offerid = ?";

    	$escaped_values = array($subj_offerid);

    	$query = $this->db->query($sql, $escaped_values);

    	$result = $query->result();

    	return $result;
    }

    public function get_exam($subj_offerid){

    	$sql = "SELECT * FROM tbl_quiz WHERE subj_offerid = ?";

    	$escaped_values = array($subj_offerid);

    	$query = $this->db->query($sql, $escaped_values);

    	$result = $query->result();

    	return $result;
    }

    /* end get */

    /* start add */
    public function add_project($subj_offerid, $no_of_items, $term, $tag){

    	$sql = "INSERT INTO tbl_project (subj_offerid, p_item, term, ptag) VALUES (?, ?, ?, ?)";

    	$escaped_values = array($subj_offerid, $no_of_items, $term, $tag);

    	$query = $this->db->query($sql, $escaped_values);

    	return $this->db->insert_id();

    }

    public function add_quiz($subj_offerid, $no_of_items, $term, $tag){

    	$sql = "INSERT INTO tbl_quiz (subj_offerid, q_item, term, qtag) VALUES (?, ?, ?, ?)";

    	$escaped_values = array($subj_offerid, $no_of_items, $term, $tag);

    	$query = $this->db->query($sql, $escaped_values);

    	return $this->db->insert_id();

    }

    public function add_recitation($subj_offerid, $no_of_items, $term, $tag){

    	$sql = "INSERT INTO tbl_recitation (subj_offerid, r_item, term, rtag) VALUES (?, ?, ?, ?)";

    	$escaped_values = array($subj_offerid, $no_of_items, $term, $tag);

    	$query = $this->db->query($sql, $escaped_values);

    	return $this->db->insert_id();

    }

    public function add_assignment($subj_offerid, $no_of_items, $term, $tag){

    	$sql = "INSERT INTO tbl_assignment (subj_offerid, a_item, term, atag) VALUES (?, ?, ?, ?)";

    	$escaped_values = array($subj_offerid, $no_of_items, $term, $tag);

    	$query = $this->db->query($sql, $escaped_values);

    	return $this->db->insert_id();

    }


    public function add_exam($subj_offerid, $no_of_items, $term){

    	$sql = "INSERT INTO tbl_exam (subj_offerid, e_item, term) VALUES (?, ?, ?)";

    	$escaped_values = array($subj_offerid, $no_of_items, $term);

    	$query = $this->db->query($sql, $escaped_values);

    	return $this->db->insert_id();

    }

    /* end get */




    


}

?>
