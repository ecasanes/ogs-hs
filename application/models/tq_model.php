<?php

class TQ_Model extends MY_Model {

    const DB_TABLE = 'technical_query';
    const DB_TABLE_PK = 'technical_query_id';
    const DB_DOCUMENT_TYPE = 'technical-query';


    public function update_step_0( $id, $doc_date, $question,  $image_1_caption, $image_2_caption, $image_3_caption ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET  technical_query_date = ?, question = ?,  upload_1_caption = ?, upload_2_caption = ?, upload_3_caption = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $doc_date, $question, $image_1_caption, $image_2_caption, $image_3_caption, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }


}

?>
