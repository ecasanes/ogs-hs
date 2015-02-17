<?php

class Floorplan_Model extends MY_Model {

    const DB_TABLE = 'floorplan';
    const DB_TABLE_PK = 'floorplan_id';


    public function add_floorplan_position( $floorplan_id, $x_position, $y_position, $note ){
        
        $db_table = 'floorplan_detail';
        $db_primary = 'floorplan_detail_id';

        $sql = "INSERT INTO {$db_table} (x_position, y_position, note, floorplan_id) VALUES (?,?,?,?)";

        $escaped_values = array(
            $x_position, $y_position, $note, $floorplan_id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $floorplan_id;

    }


    public function remove_floorplan_position_by_detail( $floorplan_id, $x_position, $y_position ){
        
        $db_table = 'floorplan_detail';
        $db_primary = 'floorplan_detail_id';

        $sql = "DELETE FROM {$db_table} WHERE floorplan_id = ? AND x_position = ? AND y_position = ?";

        $escaped_values = array(
            $floorplan_id, $x_position, $y_position
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $floorplan_id;

    }


    public function update_floorplan( $id, $name, $description, $filename ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET `name` = ?, description = ?, filename = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $name, $description, $filename, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }


    public function update_floorplan_detail_by_position( $floorplan_id, $x_position, $y_position, $note ) {

        $db_table = 'floorplan_detail';
        $db_primary = 'floorplan_detail_id';

        $sql = "UPDATE {$db_table} SET `note` = ? WHERE x_position = ? AND y_position = ? AND floorplan_id = ?";

        $escaped_values = array(
            $note, $x_position, $y_position, $floorplan_id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }




    public function update_floorplan_position( $id, $x_position, $y_position ){
        
        $db_table = 'floorplan_detail';
        $db_primary = 'floorplan_detail_id';

        $sql = "UPDATE {$db_table} SET x_position = ?, y_position = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $x_position, $y_position, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;

    }


    public function get_floorplan_details($floorplan_id){

        $db_table = 'floorplan_detail';
        $db_primary = 'floorplan_detail_id';

        $sql = "SELECT * FROM {$db_table} WHERE floorplan_id = ?";

        $escaped_values = array( $floorplan_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result =  $query->result();

        return $result;

    }

    public function get_floorplan_positions($floorplan_id){

        $db_table = 'floorplan_detail';
        $db_primary = 'floorplan_detail_id';

        $sql = "SELECT x_position as x, y_position as y, note FROM {$db_table} WHERE floorplan_id = ? ORDER BY {$db_primary}";

        $escaped_values = array( $floorplan_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result =  $query->result();

        return $result;

    }
}
