<?php

class CaseFile_Model extends MY_Model {

    const DB_TABLE = 'decf';
    const DB_TABLE_PK = 'decf_id';
    const DB_DOCUMENT_TYPE = 'case-file';

    public function update_step_0( $id, $decf_date, $brief_summary, $asset_type, $justification, $date_of_issue ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET decf_date = ?, brief_summary = ?, asset_type = ?, justification = ?, date_of_issue = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $decf_date, $brief_summary, $asset_type, $justification, $date_of_issue, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_2( $id, $problem_definition, $notification, $notification_date, $notification_details, $failure_mode_notification, $failure_mode_description ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET problem_definition = ?, notification = ?, notification_date = ?, notification_details = ?, failure_mode_notification = ?, failure_mode_description = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $problem_definition, $notification, $notification_date, $notification_details, $failure_mode_notification, $failure_mode_description, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_3( $id, $failure_mechanism, $failure_mechanism_subdivision, $definitive_statement ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET failure_mechanism = ?, failure_mechanism_subdivision = ?, definitive_statement = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $failure_mechanism, $failure_mechanism_subdivision, $definitive_statement, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_4( $id, $improvement_summary, $risks_and_threats ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET improvement_summary = ?, risks_and_threats = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $improvement_summary, $risks_and_threats, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_5( $id, $pass_or_fail ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET pass_or_fail =? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $pass_or_fail, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_6( $id, $evaluate_results ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET evaluate_results = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $evaluate_results, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }

    public function update_step_7( $id, $findings ="", $share_summary = "", $detection ="", $prevention = "", $recommendations ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET findings = ?, share_summary = ?, detection = ?, prevention = ?, recommendations = ?  WHERE {$db_primary} = ?";

        $escaped_values = array(
            $findings, $share_summary, $detection, $prevention, $recommendations, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }
}
