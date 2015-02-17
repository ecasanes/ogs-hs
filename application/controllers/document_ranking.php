<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Document_Ranking extends MY_Controller {

	public function __construct() {

		parent::__construct();
		$this->controller_uri = 'document-ranking';

		$main_model_str = 'DocumentRanking_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

		$this->model_table_array = array(
			'document_ranking'
		);

		$this->model_main_table = 'document_ranking';
	}


	public function save() {

		if ( $this->input->post() ) {

			$main_model = $this->main_model;

			$ranking_comment = $this->input->post( 'ranking_comment' );
			$ranking_like = $this->input->post( 'ranking_like' );
			$ranking_id = $this->input->post( 'ranking_id' );
			$ranking = $this->input->post( 'ranking' );

			$main_model->update( $ranking_id, $ranking_comment, $ranking_like, $ranking );

			echo 'success';
		}
	}

	public function get_likes( $document_id = null, $display = true, $with_text = false ) {

		$text_result = '';

		$post_data = $this->input->post();

		if ( $post_data && $document_id == null ) {
			$document_id = $this->input->post( 'document_id' );
			$with_text = $this->input->post( 'with_like_text' );
		}

		$main_model = $this->main_model;

		$no_of_likes = $main_model->get_likes( $document_id );

		if ( $with_text ) {
			if ( $no_of_likes > 1 ) {
				$text_result .= ' '. $no_of_likes . ' likes';
			}else {
				$text_result .= ' '. $no_of_likes . ' like';
			}
		}else {
			$text_result = $no_of_likes;
		}

		if ( $display ) {
			echo $text_result;
		}else {
			return $text_result;
		}

	}


	public function get_comments( $document_id = null, $display = true, $with_text = false ) {

		$text_result = '';

		$post_data = $this->input->post();

		if ( $post_data && $document_id == null ) {
			$document_id = $this->input->post( 'document_id' );
			$with_text = $this->input->post( 'with_like_text' );
		}

		$main_model = $this->main_model;



		$no_of_comments = $main_model->get_comments( $document_id );

		if ( $with_text ) {
			if ( $no_of_comments > 1 ) {
				$text_result .= ' '. $no_of_comments . ' comments';
			}else {
				$text_result .= ' '. $no_of_comments . ' comment';
			}
		}else {
			$text_result = $no_of_comments;
		}


		if ( $display ) {
			echo $text_result;
		}else {
			return $text_result;
		}


	}


	public function get_ranking_details() {

		if ( $this->input->post() ) {

			$uploads_folder = $this->uploads_folder;

			$json_array = array();
			$table_data = array();
			$user_info = array();
			$table_info = array();

			$main_model = $this->main_model;
			$user_model = $this->user_model;

			$document_id = $this->input->post( 'document_id' );
			$limit = $this->input->post( 'limit' );
			$offset = $this->input->post( 'offset' );

			$current_user_id = $this->session->userdata( 'session' );

			$session_site_role = $user_model->get_value( $current_user_id, 'role' );
			$session_asset_role = $user_model->get_value( $current_user_id, 'asset_role' );

			$user_info['session_site_role'] = $session_site_role;
			$user_info['session_asset_role'] = $session_asset_role;
			$user_info['current_user_id'] = $current_user_id;

			$results = $main_model->get_ranking_details( $document_id, $limit, $offset );
			$count = $main_model->count_ranking( $document_id );

			$table_info['document_id'] = $document_id;
			$table_info['last_query'] = $this->db->last_query();
			$table_info['likes_raw'] = $this->get_likes( $document_id, false, false );
			$table_info['likes'] = $this->get_likes( $document_id, false, true );
			$table_info['comments_raw'] = $this->get_comments( $document_id, false, false );
			$table_info['comments'] = $this->get_comments( $document_id, false, true );
			$table_info['limit'] = $limit;
			$table_info['offset'] = $offset;
			$table_info['count'] = $count;

			foreach ( $results as $result ) {

				$temp_array = array();

				$user_photo = $result->user_photo;
				$full_name = $result->first_name.' '.$result->last_name;
				$ranking_date_raw = $result->ranking_date;
				$ranking_date = convert_date_to_string( $ranking_date_raw );
				$ranking_comment = $result->ranking_comment;

				$user_image_path = base_url( $uploads_folder.'/'.$user_photo );
				if ( check_image_exist( $user_image_path ) ) {
					$temp_array['user_image_path'] = $user_image_path;
				}else {
					$temp_array['user_image_path'] = base_url( 'images/user-icon.png' );
				}


				$temp_array['full_name'] = $full_name;
				$temp_array['ranking_date_raw'] = $ranking_date_raw;
				$temp_array['ranking_date'] = $ranking_date;
				$temp_array['ranking_comment'] = $ranking_comment;

				$table_data[] = $temp_array;
			}

			$json_array = array(
				'table_data' => $table_data,
				'user_info' => $user_info,
				'table_info' => $table_info
			);

			echo json_encode( $json_array );

		}

	}




}

/* End of file page.php */
/* Location: ./application/controllers/page.php */
