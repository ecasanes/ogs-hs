<?php

class OFI_Model extends MY_Model {

    const DB_TABLE = 'ofi';
    const DB_TABLE_PK = 'ofi_id';
    const DB_DOCUMENT_TYPE = 'ofi';


    public function update_step_0( $id, $date, $brief_summary, $asset_type, $area_of_focus, $date_of_issue ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET date = ?, brief_summary = ?, asset_type = ?, area_of_focus = ?, date_of_issue = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $date, $brief_summary, $asset_type, $area_of_focus, $date_of_issue, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }


    public function update_step_1( $id, $improvement_summary ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET improvement_summary = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $improvement_summary, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_2( $id, $risks_and_threats ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET risks_and_threats = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $risks_and_threats, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_3( $id ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET improvement_summary = ?, risks_and_threats = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $improvement_summary, $risks_and_threats, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }



}
