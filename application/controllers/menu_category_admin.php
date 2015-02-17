<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Menu_Category_Admin extends MY_Controller {

	//user: Adrian Sangil
	//email: adrian.sangil01@gmail.com
	public function __construct() {

		parent::__construct();
		$this->controller_uri = 'uri';

		$main_model_str = 'Menu_Category_Model';
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

		$user_model = $this->user_model;
		$form_model = $this->main_model;

		$this->load->view( 'layout/header', $header_data );
		$this->load->view( 'admin/menu-category-admin', $model_data );
		$this->load->view( 'layout/footer' );
	}

	public function ajax_menu_category_list()
	{

		//echo 'ok';
		$user_model = $this->user_model;
		$form_model = $this->main_model;


		$results = $form_model->get_menu_records();
		$menu_results = $form_model->get_menu_category_records();

		$model_data['results'] = $results;
		$model_data['categories'] = $menu_results;

		echo $this->load->view( 'admin/menu-admin-category-table', $model_data );
	}

	public function modal_create()
	{
		$user_model = $this->user_model;
		$form_model = $this->main_model;


		$results = $form_model->get_menu_records();
		$menu_results = $form_model->get_menu_category_records();

		$model_data['results'] = $results;
		$model_data['categories'] = $menu_results;

		echo $this->load->view('admin/add-menu-admin-category', $model_data);
	}

	public function save() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			//var_dump($data);

			$form_model = $this->main_model;

			$form_model->update_menu( $name, $value, $description, $secondary_description, $color_class, $code, $order, $level, $menu_category_id, $id );

			redirect( 'menu-category-admin' );
		}

	}

	public function create() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$form_model = $this->main_model;

			$insert = $form_model->create_menu( $name, $value, $description, $secondary_description, $color_class, $code, $order, $level, $menu_category_id );


			if ( $insert ) {
				$result = $form_model->getLastEntryData();

				echo json_encode( $result );

				redirect(base_url('menu_category_admin'));
			}
		}
	}

	public function edit($id)
	{
		$user_model = $this->user_model;
		$form_model = $this->main_model;


		$results = $form_model->get_menu($id);
		$menu_results = $form_model->get_menu_category_records();

		$model_data['results'] = $results;
		$model_data['categories'] = $menu_results;

		echo $this->load->view('admin/edit-menu-admin-category', $model_data);
	}

	public function update()
	{
		$data = $this->input->post();

		var_dump($data);

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$form_model = $this->main_model;

			$update = $form_model->update_menu($menu_id, $name, $value, $description, $secondary_description, $color_class, $code, $order, $level, $menu_category_id);


			if ( $update ) 
			{
				redirect(base_url('menu_category_admin'));
			}
			else
			{
				die('executed');
			}
		}
	}

}
