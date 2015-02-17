<?php

class ERP_Model extends MY_Model {

    const DB_TABLE = 'erp';
    const DB_TABLE_PK = 'erp_id';
    const DB_DOCUMENT_TYPE = 'erp';


    public function update_step_0( $id, $repair_criticality_id, $date_of_raised, $criticality_justification_id, $date_required_on_board, $work_order_number, $equipment_repair_history, $asset_type_id, $justification_id, $date_of_issue ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET repair_criticality_id = ?, date_of_raised = ?, criticality_justification_id = ?, date_required_on_board = ?, work_order_number = ?, equipment_repair_history = ?, asset_type_id = ?, justification_id = ?, date_of_issue = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $repair_criticality_id, $date_of_raised, $criticality_justification_id, $date_required_on_board, $work_order_number, $equipment_repair_history, $asset_type_id, $justification_id, $date_of_issue, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_1( $id, $notes ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET notes = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $notes, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_2( $id, $receiver, $cc, $current_status, $message_board_summary ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET receiver = ?, cc = ?, current_status = ?, message_board_summary = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $receiver, $cc, $current_status, $message_board_summary, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_3( $id, $scope, $quality_control_summary, $pass_or_fail ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET scope = ?, quality_control_summary = ?, pass_or_fail = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $scope, $quality_control_summary, $pass_or_fail, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_4( $id, $findings, $summary, $recommendations ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET findings = ?, summary = ?, recommendations = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $findings, $summary, $recommendations, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }
}
