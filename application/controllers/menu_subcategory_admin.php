<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Menu_Subcategory_Admin extends MY_Controller {

	//user: Adrian Sangil
	//email: adrian.sangil01@gmail.com
	public function __construct() {

		parent::__construct();
		$this->controller_uri = 'uri';

		$main_model_str = 'Menu_Subcategory_Model';
		$this->load->model( $main_model_str );
		$this->main_model = new $main_model_str;

	}

	public function index() {

		$header_data = array(
			'title' => 'Create a Menu SubCategory',
			'hidden' => ''
		);

		$model_data = array(

		);

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'admin/menu-subcategory-admin', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function ajax_menu_subcategory_list()
	{
		$user_model = $this->user_model;
		$form_model = $this->main_model;


		$results = $form_model->get_menu_sub_records();
		$menu_results = $form_model->get_menu_records();

		$model_data['results'] = $results;
		$model_data['menu_records'] = $menu_results;

		echo $this->load->view('admin/menu-subcategory-table', $model_data);
	}

	public function create_modal()
	{
		$form_model = $this->main_model;

		$menu_results = $form_model->get_menu_records();

		$model_data['menu_records'] = $menu_results; 

		echo $this->load->view('admin/add-menu-subcategory', $model_data);
	}

	public function save() {

		$data = $this->input->post();

		var_dump($data);

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$form_model = $this->main_model;

			$form_model->update_menu( $name, $description, $color_class, $code, $menu_id, $menu_subcategory_id );

			redirect( 'menu-subcategory-admin' );
		}

	}

	public function edit($id)
	{
		$user_model = $this->user_model;
		$form_model = $this->main_model;


		$results = $form_model->get_menu_subcategory($id);
		$menu_results = $form_model->get_menu_records();

		$model_data['results'] = $results;
		$model_data['menu_records'] = $menu_results;


		//var_dump($results); 

		echo $this->load->view('admin/edit-menu-subcategory', $model_data);
	}

	public function create() {

		$data = $this->input->post();

		//var_dump($data);

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$form_model = $this->main_model;

			$insert = $form_model->create_menu( $name, $description, $color_class, $code, $menu_id );


			if ( $insert ) {
				$result = $form_model->getLastEntryData();

				echo json_encode( $result );

				redirect( 'menu-subcategory-admin' );
			}
		}
	}

}
