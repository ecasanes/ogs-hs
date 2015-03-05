<?php

class Student_Model extends MY_Model {

    const DB_TABLE = 'tbl_student';
    const DB_TABLE_PK = 'student_id';

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

    
}

?>
