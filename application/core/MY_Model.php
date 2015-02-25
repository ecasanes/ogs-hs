<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class MY_Model extends CI_Model {
    const DB_TABLE = 'abstract';
    const DB_TABLE_PK = 'abstract';

    public function verify_form_permission( $document_id, $user_id ) {

        $db_table = $this::DB_TABLE;
        $db_primary =$this::DB_TABLE_PK;

        if ( $user_id > 0 ) {
            $sql = "SELECT * FROM document_owner WHERE document_id = ? AND user_id = ?";
            $query = $this->db->query( $sql, array( $document_id, $user_id ) );

            if ( $query->num_rows() > 0 ) {
                return true;
            } else {
                return false;
            }

        }else {
            return false;
        }
    }

    public function get_value( $id, $value = '*', $table_name = null, $db_primary = null ) {

        if ( empty( $db_primary ) ) {
            $db_primary = $this::DB_TABLE_PK;
        }

        if ( empty($id) || $id == '' ) {
            $value = '';
            //echo 'test';
        }else {

            if ( $table_name == null ) {
                $table_name = $this::DB_TABLE;
            }

            $this->db->select( $value );
            $this->db->from( $table_name );
            $this->db->where( array( $db_primary => $id ) );
            $query = $this->db->get();

            //echo $this->db->last_query();

            if ( $query->num_rows() > 0 ) {
                $row = $query->row();
                $value = $row->$value;
            }else {
                $value = '';
            }


        }

        //var_dump($value);




        return $value;
    }

}
