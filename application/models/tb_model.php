<?php

class TB_Model extends MY_Model {

    const DB_TABLE = 'technical_bulletin';
    const DB_TABLE_PK = 'technical_bulletin_id';
    const DB_DOCUMENT_TYPE = 'technical-bulletin';


    public function update_step_0( $id, $author, $doc_date, $purpose, $relevance, $summary, $recommendations, $next_steps, $image_1, $image_2, $image_3, $image_4, $image_5, $image_6, $image_1_caption, $image_2_caption, $image_3_caption, $image_4_caption, $image_5_caption, $image_6_caption ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET author = ?, date = ?, purpose = ?, relevance = ?, summary_of_events = ?, recommendations = ?, next_steps = ?,  upload_1_filename = ?,  upload_2_filename = ?,  upload_3_filename = ?,  upload_4_filename = ?,  upload_5_filename = ?,  upload_6_filename = ?, upload_1_caption = ?, upload_2_caption = ?, upload_3_caption = ?, upload_4_caption = ?, upload_5_caption = ?, upload_6_caption = ? WHERE {$db_primary} = ?";

        $escaped_values = array(
            $author, $doc_date, $purpose, $relevance, $summary, $recommendations, $next_steps, $image_1, $image_2, $image_3, $image_4, $image_5, $image_6, $image_1_caption, $image_2_caption, $image_3_caption, $image_4_caption, $image_5_caption, $image_6_caption, $id
        );

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }


}

?>
