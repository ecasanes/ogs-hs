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
   

    /* end get */




    


}

?>
