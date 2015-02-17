<?php

class Menu_Model extends MY_Model {

    const DB_TABLE = 'menu_category';
    const DB_TABLE_PK = 'menu_category_id';


    public function delete_menu_category( $menu_category_id ) {

        $db_table = 'menu_category';
        $db_primary = 'menu_category_id';

        $menu_category_sql = "DELETE FROM {$db_table} WHERE {$db_primary} = ?";

        $escaped_values = array( $menu_category_id );

        $menu_category_query = $this->db->query( $menu_category_sql, $escaped_values );
    }



    public function create_menu_category( $menu_type, $description ) {

        $db_table = 'menu_category';

        $sql = "INSERT INTO {$db_table} (menu_type, description) VALUES (?, ?)";

        $escaped_values = array( $menu_type, $description );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function getLastEntryData() {

        $db_table = 'menu_category';
        $db_primary = 'menu_category_id';

        $sql = "SELECT * FROM {$db_table} ORDER BY {$db_primary} DESC LIMIT 1";

        $query = $this->db->query( $sql );

        $result= $query->result();

        return $result;
    }


    public function update_menu_category( $menu_category_id, $menu_type, $description ) {

        $db_table = 'menu_category';
        $db_primary = 'menu_category_id';

        $sql = "UPDATE {$db_table} SET menu_type = ?, description = ? WHERE menu_category_id = ?";

        $escaped_values = array(
            $menu_type, $description, $menu_category_id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $menu_category_id;
    }


    public function get_menu_category( $menu_category_id, $menu_type, $description ) {

        $db_table = 'menu_category';
        $db_primary = 'menu_category_id';

        $sql = "SELECT * FROM {$db_table} WHERE menu_category_id = ? AND menu_type = ?  AND description = ?";
        $query = $this->db->query( $sql, array( $code ) );

        $result = $query->result();

        return $result;

    }



}
