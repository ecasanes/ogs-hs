<?php

class Student_Model extends MY_Model {

    const DB_TABLE = 'tbl_student';
    const DB_TABLE_PK = 'student_id';

    public function get_student_info($user_id){

        $sql = "SELECT * FROM tbl_user WHERE user_id = ? LIMIT 1";

        $escaped_values = array($user_id);

        $query = $this->db->query($sql, $escaped_values);

        $result = $query->row();

        return $result;
    }

    public function get_student_by_search_key_and_year_level($search_key, $year_level){

    	if($year_level == ""){

    		$sql = "SELECT 
				  * 
				FROM
				  tbl_user 
				WHERE CONCAT(fname, ' ', lname) LIKE '%{$search_key}%' AND user_type = 3";

			$escaped_values = array();

    	}else{

    		$sql = "SELECT 
				  * 
				FROM
				  tbl_user 
				WHERE CONCAT(fname, ' ', lname) LIKE '%{$search_key}%' 
				  AND year_level = ? AND user_type = 3";

			$escaped_values = array($year_level);
    	}

    	

		$query = $this->db->query($sql, $escaped_values);

		$result = $query->result();

		return $result;
    }

    public function update_student_year_level($user_id, $year_level){

    	$sql = "UPDATE tbl_user SET year_level = ? WHERE user_id = ?";

    	$escaped_values = array($year_level, $user_id);

    	$query = $this->db->query($sql, $escaped_values);

    	return $this->db->insert_id();
    }

    
}

?>
