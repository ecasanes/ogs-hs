<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Menu_Deep_Subcategory_Admin extends MY_Controller {

	//user: Adrian Sangil
	//email: adrian.sangil01@gmail.com
	public function __construct() {

		parent::__construct();
		$this->controller_uri = 'uri';

		$main_model_str = 'Menu_Deep_Subcategory_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

	}

	public function index() {

		$header_data = array(
			'title' => 'Create a Menu Deep SubCategory',
			'hidden' => ''
		);

		$model_data = array(

		);

		$user_model = $this->user_model;
		$form_model = $this->main_model;


		$results = $form_model->get_menu_deep_sub_records();
		$menu_results = $form_model->get_menu_sub_records();

		$model_data['results'] = $results;
		$model_data['menu_subcategory_records'] = $menu_results;
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'admin/menu-deep-subcategory-admin', $model_data );
		$this->load->view( 'includes/footer' );
	}

	public function save() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$form_model = $this->main_model;

			$form_model->update_menu( $name, $description, $color_class, $code, $menu_subcategory_id, $id );

			redirect( 'menu-deep-subcategory-admin' );
		}

	}

	public function create() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$form_model = $this->main_model;

			$insert = $form_model->create_menu( $name, $description, $color_class, $code, $menu_subcategory_id );


			if ( $insert ) {
				$result = $form_model->getLastEntryData();

				echo json_encode( $result );
			}
		}
	}

}
