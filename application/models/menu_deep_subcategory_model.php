<?php

class Menu_Deep_Subcategory_Model extends MY_Model {

    const DB_TABLE = 'menu_deep_subcategory';
    const DB_TABLE_PK = 'menu_deep_subcategory_id';

    //user: Adrian Sangil
    //email: adrian.sangil01@gmail.com

    public function get_menu_deep_sub_records() {

        $db_table1 = 'menu_deep_subcategory';
        $db_table2 = 'menu_subcategory';

        $sql = "SELECT a.*,b.description AS menu_desc,b.name as menu_name FROM {$db_table1} AS a,{$db_table2} AS b WHERE a.menu_subcategory_id = b.menu_subcategory_id ORDER BY a.menu_deep_subcategory_id DESC";
        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;

    }

    public function get_menu_sub_records() {

        $db_table = 'menu_subcategory';
        $sql = "SELECT * FROM {$db_table}";
        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function update_menu( $name, $description, $color_class, $code, $menu_subcategory_id, $id ) {
        $db_table = 'menu_deep_subcategory';
        $db_primary = 'menu_subcategory_id';

        $sql = "UPDATE {$db_table} SET name = ?, description = ?, color_class = ?, code = ?, menu_subcategory_id = ? WHERE menu_deep_subcategory_id = ?";

        $escaped_values = array(
            $name, $description, $color_class, $code, $menu_subcategory_id, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function create_menu( $name, $description, $color_class, $code, $menu_subcategory_id ) {
        $db_table = 'menu_deep_subcategory';

        $sql = "INSERT INTO {$db_table} (name, description, color_class, code, menu_subcategory_id) VALUES (?, ?, ?, ?, ?)";

        $escaped_values = array(
            $name, $description, $color_class, $code, $menu_subcategory_id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function getLastEntryData() {
        $sql = "SELECT * from menu_deep_subcategory order by menu_deep_subcategory_id desc limit 1";

        $query = $this->db->query( $sql );

        $result= $query->result();

        return $result;
    }
}
