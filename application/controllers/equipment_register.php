<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Equipment_Register extends MY_Controller {

	public function __construct() {

		parent::__construct();

		$this->document_code = 'EQUIPMENT_REGISTER';
		$this->document_primary = 'document_id';
		$this->form_primary = 'hired_equipment_register_id';

		$this->load->model( 'Document_Model' );
		$this->document_model = new Document_Model();

		$this->no_of_steps = 1;
	}

	public function index() {

		$this->is_logged_in();
		$data = $this->input->post();



		//$main_model = $this->main_model;
		$document_model = $this->document_model;
		$user_model = $this->user_model;

		$user_id = $this->session->userdata( 'session' );

		$header_data = array(
			'hidden' => ''
		);

		$model_data = array();

		$model_data['current_user_id'] = $user_id;
		$model_data['user_option'] = '';
		$model_data['existing_document_name_dropdown'] = '<option value="">&nbsp;</option>';
		$model_data['document_name_dropdown'] = '<option value="">&nbsp;</option>';



		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$hired_equipment_register = $document_model->get_hired_equipment_register( $user_id, $status );

		}else {
			$hired_equipment_register = $document_model->get_hired_equipment_register( $user_id );
		}



		$user_documents = $document_model->get_user_documents( $user_id );

		foreach ( $user_documents as $document ) {
			$model_data['existing_document_name_dropdown'] .= '<option value="'.$document->document_id.'">'.$document->code.': '.$document->name.'&nbsp;</option>';
		}

		//ACTION TRACKER ARRAY
		$hired_equipment_register_array = array();

		$hired_equipment_register_counter = 0;
		foreach ( $hired_equipment_register as $item ) {

			$full_name = $user_model->get_full_name( $item->owner );

			$hired_equipment_register_id = $item->hired_equipment_register_id;
			$po_number = $item->po_number;
			$equipment = $item->equipment;
			$on_hire_to = $item->on_hire_to;
			$quantity = $item->quantity;
			$duration = $item->duration;
			$cost = $item->cost;
			$total = $item->total;
			$status_id = $item->status;
			$status = $this->get_menu_detail_value( $status_id, 'equipment_register_status', 'menu', 'name' );

			/*if($action_process == '' && $status == ''){
              continue;
            }*/

			$hired_equipment_register_array[$hired_equipment_register_counter] = array();

			$hired_equipment_register_array[$hired_equipment_register_counter]['hired_equipment_register_id'] = $hired_equipment_register_id;
			$hired_equipment_register_array[$hired_equipment_register_counter]['po_number'] = $po_number;
			$hired_equipment_register_array[$hired_equipment_register_counter]['equipment'] = $equipment;
			$hired_equipment_register_array[$hired_equipment_register_counter]['on_hire_to'] = $on_hire_to;
			$hired_equipment_register_array[$hired_equipment_register_counter]['quantity'] = $quantity;
			$hired_equipment_register_array[$hired_equipment_register_counter]['duration'] = $duration;
			$hired_equipment_register_array[$hired_equipment_register_counter]['cost'] = $cost;
			$hired_equipment_register_array[$hired_equipment_register_counter]['total'] = $total;
			$hired_equipment_register_array[$hired_equipment_register_counter]['status'] = $status;
			$hired_equipment_register_array[$hired_equipment_register_counter]['status_id'] = $status_id;
			$hired_equipment_register_array[$hired_equipment_register_counter]['owner'] = $item->owner;
			$hired_equipment_register_array[$hired_equipment_register_counter]['off_hire_due_date'] = convert_date_to_string( $item->off_hire_due_date );
			$hired_equipment_register_array[$hired_equipment_register_counter]['full_name'] = $full_name.'&nbsp;';

			$hired_equipment_register_counter++;
		}

		$model_data['hired_equipment_registers'] = $hired_equipment_register_array;
		$model_data['upload_error'] = '';

		$model_data['status_dropdown'] = $this->get_dropdown_menu( null, 'equipment_register_status', 'menu', true, false, '' );

		$model_data['user_option'] = '';

		$userdata = $user_model->get_all_records();

		$userdata_counter = 0;
		foreach ( $userdata as $result ) {
			//var_dump($result);

			$full_name = $result->first_name. ' ' .$result->last_name;

			$userdata_array[$userdata_counter] = array();

			$model_data['user_option'] .= '<option value="'.$result->user_id.'">'.$full_name.'</option>';
		}

		$header_data['data'] = $header_data;
		$model_data['data'] = $model_data;

		$this->load->view( 'includes/header', $header_data );
		$this->load->view( 'equipment/equipment-register-list', $model_data );
		$this->load->view( 'includes/footer' );
	}

	public function create() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			//var_dump($data);

			$off_hire_due_date = convert_string_to_date( $off_hire_due_date );

			$equipment_register_id = $document_model->create_hired_equipment_register( $po_number, $equipment, $on_hire_to, $quantity, $duration, $cost, $total, $equipment_register_status, $owner, $off_hire_due_date, $current_user_id );

			//$new_reference = $ref_id_code.'-'.$action_tracker_id;

			//$document_model->update_value($action_tracker_id, 'reference', $new_reference, 'action_tracker', $form_primary);

			redirect( 'equipment-register' );



		}
	}

	public function update() {

		$data = $this->input->post();

		if ( $data ) {

			extract( $data, EXTR_SKIP );

			$document_model = $this->document_model;
			$form_primary = $this->form_primary;

			//var_dump($data);

			$due_date = convert_string_to_date( $due_date );

			$document_model->update_single_equipment_register( $hired_equipment_register_id, $po_number, $equipment, $on_hire_to, $quantity, $duration, $cost, $total, $equipment_register_status, $owner, $off_hire_due_date );

			redirect( 'equipment-register' );



		}
	}



}

/* End of file action_tracker.php */
/* Location: ./application/controllers/action_tracker.php */
