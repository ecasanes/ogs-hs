<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Menu_Admin extends MY_Controller {


	public function __construct() {

		parent::__construct();
		$this->controller_uri = 'uri';

		$main_model_str = 'Menu_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

	}

	public function index() {

		$header_data = array(
			'title' => 'Create a Menu Category',
			'hidden' => ''
		);

		$model_data = array(

		);

		$form_model = $this->main_model;

		$results = $form_model->get_all_records( 'menu_category' );

		$model_data['results'] = $results;
		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'admin/menu-admin', $model_data );
		$this->load->view( 'layout/footer' );

	}


	public function ajax_menu_list()
	{
		$form_model = $this->main_model;

		$results = $form_model->get_all_records( 'menu_category' );

		$model_data['results'] = $results;

		echo $this->load->view('admin/menu-admin-table', $model_data);
	}


	public function modal_create()
	{
		echo $this->load->view('admin/add-menu-admin');
	
	}



	public function create() {

		$data = $this->input->post();

		//var_dump($data);

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$form_model = $this->main_model;

			$insert = $form_model->create_menu_category( $menu_type, $description );

			//redirect('menu_admin');

			if ( $insert ) {
				$result = $form_model->getLastEntryData();

				echo json_encode( $result );

				redirect(base_url('menu-admin'));
			}

		}
	}

	public function edit( $id ) {

		$main_model = $this->main_model;

		$form_details = $main_model->get_record( $id );

		//var_dump($form_details);

		$model_data['results'] = $form_details;

		echo $this->load->view('admin/edit-menu-admin', $model_data);

	}

	public function delete( $id ) {

		$form_model = $this->main_model;

		$form_model->delete_menu_category( $id );

		//redirect('menu-admin');

	}

	public function save() {

		$data = $this->input->post();

		//var_dump($data);
		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$form_model = $this->main_model;

			$form_model->update_menu_category( $menu_category_id, $menu_type, $description );

			redirect( 'menu-admin' );
		}
	}
}
