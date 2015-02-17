<?php

class Sis_Model extends MY_Model {

    const DB_TABLE = 'sis';
    const DB_TABLE_PK = 'sis_id';

    //user: Adrian Sangil
    //email: adrian.sangil01@gmail.com

    public function get_sis_records() {

        $db_table = 'sis';
        $sql = "SELECT * FROM {$db_table}";
        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function update_single_sis( $id, $tag_number, $description, $code ) {
        $db_table = 'sis';
        $db_primary = 'sis_id';

        $sql = "UPDATE {$db_table} SET tag_number = ?, description = ?, code = ? WHERE sis_id = ?";

        $escaped_values = array(
            $tag_number, $description, $code, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function create_sis( $tag_number, $description, $code ) {
        $db_table = 'sis';

        $sql = "INSERT INTO {$db_table} (tag_number, description, code) VALUES (?, ?, ?)";

        $escaped_values = array(
            $tag_number, $description, $code
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();


    }
}
