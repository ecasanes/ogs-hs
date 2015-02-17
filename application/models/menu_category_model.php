<?php

class Menu_Category_Model extends MY_Model {

    const DB_TABLE = 'menu_category';
    const DB_TABLE_PK = 'menu_category_id';

    //user: Adrian Sangil
    //email: adrian.sangil01@gmail.com

    public function get_menu_records() {

        $db_table1 = 'menu';
        $db_table2 = 'menu_category';

        $sql = "SELECT a.*,b.description AS menu_desc,b.menu_type FROM {$db_table1} AS a,{$db_table2} AS b WHERE a.menu_category_id = b.menu_category_id ORDER BY a.menu_id DESC";
        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;

    }

    public function get_menu($id)
    {
        $sql = "SELECT * FROM menu WHERE menu_id = '$id'";
        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function get_menu_category_records() {

        $db_table = 'menu_category';
        $sql = "SELECT menu_category_id, menu_type FROM {$db_table}";
        $query = $this->db->query( $sql );

        $result = $query->result();

        return $result;
    }

    public function update_dynamic_menu( $id, $menu_category_id, $name, $value, $description, $secondary_description, $color_class, $code, $order, $level ) {
        $db_table = 'menu';
        $db_primary = 'menu_category_id';

        $escaped_values = array();

        $sql = "UPDATE {$db_table} SET menu_category_id = ? ";
        $escaped_values[] = $menu_category_id;

        if ( $name != null ) {
            $sql .= " , `name` = ? ";
            $escaped_values[] = $name;
        }

        if ( $value != null ) {
            $sql .= " , `value` = ? ";
            $escaped_values[] = $value;
        }

        if ( $description != null ) {
            $sql .= " , description = ? ";
            $escaped_values[] = $description;
        }

        if ( $secondary_description != null ) {
            $sql .= " , secondary_description = ? ";
            $escaped_values[] = $secondary_description;
        }

        if ( $color_class != null ) {
            $sql .= " , color_class = ? ";
            $escaped_values[] = $color_class;
        }

        if ( $code != null ) {
            $sql .= " , `code` = ? ";
            $escaped_values[] = $code;
        }

        if ( $order != null ) {
            $sql .= " , `order` = ? ";
            $escaped_values[] = $order;
        }

        if ( $level != null ) {
            $sql .= " , `level` = ? ";
            $escaped_values[] = $level;
        }

        $sql .= "  WHERE menu_id = ?";
        $escaped_values[] = $id;

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_menu($menu_id, $name, $value, $description, $secondary_description, $color_class, $code, $order, $level, $menu_category_id) {
       
       //var_dump($menu_id, $name, $value, $description, $secondary_description, $color_class, $code, $order, $level, $menu_category_id);

        $db_table = 'menu';
        $db_primary = 'menu_category_id';

        $sql = "UPDATE {$db_table} SET `name` = ?, `value` = ?, description = ?, secondary_description = ?, color_class = ?, `code` = ?, `order` = ?, `level` = ?, menu_category_id = ? WHERE menu_id = ?";

        $escaped_values = array(
            $name, $value, $description, $secondary_description, $color_class, $code, $order, $level, $menu_category_id, $menu_id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $query;
    }

    public function create_menu( $name, $value, $description, $secondary_description, $color_class, $code, $order, $level, $menu_category_id ) {
        $db_table = 'menu';

        $sql = "INSERT INTO {$db_table} (`name`, `value`, description, secondary_description, color_class, `code`, `order`, `level`, menu_category_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $escaped_values = array(
            $name, $value, $description, $secondary_description, $color_class, $code, $order, $level, $menu_category_id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function getLastEntryData() {
        $sql = "SELECT * from menu order by menu_id desc limit 1";

        $query = $this->db->query( $sql );

        $result= $query->result();

        return $result;
    }
}
