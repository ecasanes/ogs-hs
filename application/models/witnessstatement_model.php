<?php

class WitnessStatement_Model extends MY_Model {

    const DB_TABLE = 'witness_statement';
    const DB_TABLE_PK = 'witness_statement_id';
    const DB_DOCUMENT_TYPE = 'witness-statement';


    public function update_step_0( $id, $time, $date, $conducted_by, $conducted_email, $recorded_by, $recorded_email, $witness_name, $witness_email, $accompanied_by, $accompanied_email, $witness_position, $employer, $witness_nickname, $witness_street_1, $witness_street_2, $witness_city, $witness_country, $witness_postal_code, $incident_title, $incident_number, $incident_description, $statement, $signature ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET  `time` = ?, `date` = ?, conducted_by = ?, conducted_email = ?, recorded_by =?, recorded_email =?, witness_name = ?, witness_email = ?, accompanied_by = ?, accompanied_email = ?, witness_position = ?, employer = ?, witness_nickname = ?, witness_street_1 = ?, witness_street_2 = ?, witness_city = ?, witness_country = ?, witness_postal_code = ?, incident_title = ?, incident_number = ?, incident_description = ?, statement = ?, signature = ?  WHERE {$db_primary} = ?";

        $escaped_values = array(
            $time, $date, $conducted_by, $conducted_email, $recorded_by, $recorded_email, $witness_name, $witness_email, $accompanied_by, $accompanied_email, $witness_position, $employer, $witness_nickname, $witness_street_1, $witness_street_2, $witness_city, $witness_country, $witness_postal_code, $incident_title, $incident_number, $incident_description, $statement, $signature, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }



}
