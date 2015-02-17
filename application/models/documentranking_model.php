<?php

class DocumentRanking_Model extends MY_Model {

    const DB_TABLE = 'document_ranking';
    const DB_TABLE_PK = 'document_ranking_id';

    public function delete( $code ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "DELETE FROM {$db_table} WHERE code = ?";

        $escaped_values = array( $code );

        $query = $this->db->query( $sql, $escaped_values );
    }

    public function get_document_ranking( $document_id, $ranking_user_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT * FROM {$db_table} WHERE user_id = ? AND document_id = ?";

        $escaped_values = array( $ranking_user_id, $document_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row();

        return $result;
    }

    public function get_ranking_details( $document_id, $limit, $offset = 0 ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT c.user_photo, c.first_name, c.last_name, a.document_ranking_id, a.ranking_like, a.ranking_comment, a.ranking_date  FROM {$db_table} a, user c WHERE a.document_id = ? AND a.user_id = c.user_id AND a.ranking_comment NOT IN('',' ','  ') AND a.ranking_comment IS NOT NULL ORDER BY a.ranking_date ASC LIMIT {$offset}, {$limit}";

        $escaped_values = array( $document_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->result();

        return $result;
    }


    public function count_ranking( $id ) {

        $db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "SELECT count(a.document_id) as count  FROM {$db_table} a, user c WHERE a.document_id = ? AND a.user_id = c.user_id AND a.ranking_comment NOT IN('',' ','  ') AND a.ranking_comment IS NOT NULL";

        $query = $this->db->query( $sql, array( $id ) );

        //$result = $query->result();
        $row = $query->row();
        $result = $row->count;

        return $result;
    }

    public function create_document_ranking( $document_id, $ranking_user_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "INSERT INTO {$db_table} (user_id, document_id) VALUES (?, ?)";

        $escaped_values = array( $ranking_user_id, $document_id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function update( $id, $comment, $like, $ranking ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "UPDATE {$db_table} SET ranking_comment = ?, ranking_like = ?, ranking = ?, ranking_date = NOW() WHERE {$db_primary} = ?";

        $escaped_values = array( $comment, $like, $ranking, $id );

        $query = $this->db->query( $sql, $escaped_values );

        return $this->db->insert_id();
    }

    public function get_top_document( $document_type = null, $limit = 0 ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        if ( empty( $document_type ) ) {


            $sql = "SELECT DISTINCT(a.{$db_primary}), a.document_id, b.name, b.code, count(a.ranking_like) AS like_count FROM document_ranking a, document b WHERE a.ranking_like = 1 AND a.document_id = b.document_id GROUP BY b.code ORDER BY like_count DESC";

        }else {

            $sql = "SELECT DISTINCT(a.{$db_primary}), a.document_id, b.name, b.code, count(a.ranking_like) AS like_count FROM document_ranking a, document b, document_type d_type WHERE d_type.document_type_id = b.document_type_id AND a.ranking_like = 1 AND d_type.document_code = ? AND a.document_id = b.document_id GROUP BY b.code ORDER BY like_count DESC";


        }

        if ( $limit > 0 ) {
            $sql .= " limit 0,{$limit}";
        }

        if ( empty( $document_type ) ) {
            $query = $this->db->query( $sql );
        }else {

            $escaped_values = array( $document_type );
            $query = $this->db->query( $sql, $escaped_values );
        }


        $result = $query->result();

        return $result;
    }

    public function get_likes( $document_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT count(document_id) as like_count FROM {$db_table} WHERE ranking_like = ? AND document_id = ?";

        $escaped_values = array( 1, $document_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row()->like_count;

        return $result;
    }


    public function get_comments( $document_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        $sql = "SELECT count(document_id) as comment_count FROM {$db_table} WHERE document_id = ? AND document_id AND ranking_comment IS NOT NULL AND ranking_comment NOT IN('',' ','  ')";

        $escaped_values = array( $document_id );

        $query = $this->db->query( $sql, $escaped_values );

        $result = $query->row()->comment_count;

        return $result;
    }



}

?>
