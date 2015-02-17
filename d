[1mdiff --git a/application/controllers/integrity_management.php b/application/controllers/integrity_management.php[m
[1mindex 5621ba4..615f2c7 100644[m
[1m--- a/application/controllers/integrity_management.php[m
[1m+++ b/application/controllers/integrity_management.php[m
[36m@@ -467,29 +467,6 @@[m [mclass Integrity_Management extends MY_Controller {[m
 	}[m
 [m
 [m
[31m-	public function ut(){[m
[31m-[m
[31m-		$user_model = $this->user_model;[m
[31m-		$main_model = $this->main_model;[m
[31m-		$document_model = $this->document_model;[m
[31m-		$document_primary = $this->document_primary;[m
[31m-[m
[31m-		$header_data = array([m
[31m-			'title' => 'Ultrasonic Inspection Report',[m
[31m-			'hidden' => ''[m
[31m-		);[m
[31m-[m
[31m-		$model_data = array();[m
[31m-		[m
[31m-		$user_id = $this->session->userdata( 'session' );[m
[31m-		$username = $user_model->get_value( $user_id, 'user_name' );[m
[31m-		$current_user_id = $user_id;[m
[31m-		//$this->load->view( 'layout/header', $header_data );[m
[31m-		$this->load->view( 'integrity_management/ut' );[m
[31m-		//$this->load->view( 'layout/footer' );[m
[31m-	}[m
[31m-[m
[31m-[m
 	public function gip_corrosion(){[m
 [m
 		$user_model = $this->user_model;[m
[36m@@ -598,13 +575,54 @@[m [mclass Integrity_Management extends MY_Controller {[m
 		$this->load->view( 'layout/footer' );[m
 	}[m
 [m
[31m-	public function inspection_type_dashboard(){[m
[32m+[m	[32mpublic function check_add_general_inspection()[m
[32m+[m	[32m{[m
[32m+[m		[32m// Model.[m
[32m+[m		[32m$this->load->model('general_inspection_model');[m
[32m+[m		[32m$general_inspection_model = new General_Inspection_Model();[m
[32m+[m
[32m+[m		[32m$report_no = 'R1423-GVI-008';[m
[32m+[m		[32m$customer = 'Transocean';[m
[32m+[m		[32m$location = 'Galaxy II';[m
[32m+[m		[32m$procedure = 'RMS-GVI-001';[m
[32m+[m		[32m$project = 'R1423';[m
[32m+[m		[32m$surface = 'As found';[m
[32m+[m		[32m$equiptment = 'Digital Camera';[m
[32m+[m		[32m$equiptment_serial_no = '';[m
[32m+[m		[32m$type_of_inspection = 'Derrick Sweep';[m
[32m+[m		[32m$item = 'Derrick Area';[m
[32m+[m		[32m$drawing_no = 'N/A';[m
[32m+[m		[32m$specification = 'Report All Findings';[m
[32m+[m		[32m$material = 'Carbon Steel';[m
[32m+[m		[32m$size = 'N/A';[m
[32m+[m		[32m$quantity = '';[m
[32m+[m		[32m$scope = 'A Derrick sweep was carried out as per instruction from the client to ascertain whether there were any potential dropped Objects...';[m
[32m+[m		[32m$extent_of_inspection = '100% of all areas were inspected, no restrictions encountered.';[m
[32m+[m		[32m$results = 'The above item was inspected in accordance with procedure. No potential dropped objects were foudn during this sweep;...';[m
[32m+[m		[32m$inspector = 'B. Quinn';[m
[32m+[m		[32m$date = 'now()';[m
[32m+[m		[32m$for_client_use = '';[m
[32m+[m		[32m$for_cert_auth = '';[m
[32m+[m		[32m$serial_no = '';[m
[32m+[m		[32m$signature = 'Image to be posted.';[m
[32m+[m
[32m+[m		[32mprint $general_inspection_model->add_general_inspection($report_no, $customer, $location, $procedure, $project, $surface,[m[41m [m
[32m+[m[32m                                    $equiptment, $equiptment_serial_no, $type_of_inspection, $item, $drawing_no,[m[41m [m
[32m+[m[32m                                    $specification, $material, $size, $quantity, $scope, $extent_of_inspection,[m[41m [m
[32m+[m[32m                                    $results, $inspector, $date, $for_client_use, $for_cert_auth, $serial_no,[m[41m [m
[32m+[m[32m                                    $signature);[m
[32m+[m
[32m+[m[41m		[m
[32m+[m	[32m}[m
[32m+[m
 [m
[31m-		$current_page_name = 'Inspection Type Dashboard';[m
[32m+[m	[32mpublic function submitInspection(){[m
[32m+[m[41m		[m
[32m+[m		[32m$current_page_name = 'MCDR Form';[m
 [m
 		$this->is_logged_in();[m
 		$user_model = $this->user_model;[m
[31m-		$user_model = new User_Model();[m
[32m+[m
 		$user_id = $this->session->userdata( 'session' );[m
 		$session_site_role = $user_model->get_value( $user_id, 'role' );[m
 [m
[36m@@ -618,12 +636,8 @@[m [mclass Integrity_Management extends MY_Controller {[m
 [m
 		$header_data['data'] = $header_data;[m
 		$model_data['data'] = $model_data;[m
[31m-[m
[31m-		$this->load->view( 'layout/header', $header_data );[m
[31m-		$this->load->view( 'integrity_management/inspection_type_dashboard' );[m
[31m-		$this->load->view( 'layout/footer' );[m
[31m-[m
 	}[m
[32m+[m
 }[m
 [m
 /* End of file integrity_management.php */[m
[1mdiff --git a/application/models/general_inspection_model.php b/application/models/general_inspection_model.php[m
[1mindex d035601..a3eeac6 100644[m
[1m--- a/application/models/general_inspection_model.php[m
[1m+++ b/application/models/general_inspection_model.php[m
[36m@@ -2,18 +2,76 @@[m
 [m
     class General_Inspection_Model extends MY_Model {[m
 [m
[32m+[m[32m        const DB_SCHEMA = 'iso_redesign';[m
     	const DB_TABLE = 'general_inspection';[m
         const DB_TABLE_PK = 'id';[m
         const DB_DOCUMENT_TYPE = 'general-inspection';[m
 [m
[31m-        public function add_general_inspection()[m
[32m+[m[32m        public function add_general_inspection($report_no, $customer, $location, $procedure, $project, $surface,[m[41m [m
[32m+[m[32m                                    $equiptment, $equiptment_serial_no, $type_of_inspection, $item, $drawing_no,[m[41m [m
[32m+[m[32m                                    $specification, $material, $size, $quantity, $scope, $extent_of_inspection,[m[41m [m
[32m+[m[32m                                    $results, $inspector, $date, $for_client_use, $for_cert_auth, $serial_no,[m[41m [m
[32m+[m[32m                                    $signature)[m
         {[m
[32m+[m[32m            $id = '';[m
[32m+[m[32m            $db_schema = $this::DB_SCHEMA;[m
[32m+[m[32m            $db_table = $this::DB_TABLE;[m
[32m+[m
[32m+[m[32m            $report_no = trim($report_no);[m
[32m+[m[32m            $customer = trim($customer);[m
[32m+[m[32m            $location = trim($location);[m
[32m+[m[32m            $procedure = trim($procedure);[m
[32m+[m[32m            $project = trim($project);[m
[32m+[m[32m            $surface = trim($surface);[m
[32m+[m[32m            $equiptment = trim($equiptment);[m
[32m+[m[32m            $equiptment_serial_no = trim($equiptment_serial_no);[m
[32m+[m[32m            $type_of_inspection = trim($type_of_inspection);[m
[32m+[m[32m            $item = trim($item);[m
[32m+[m[32m            $drawing_no = trim($drawing_no);[m
[32m+[m[32m            $specification = trim($specification);[m
[32m+[m[32m            $material = trim($material);[m
[32m+[m[32m            $size = trim($size);[m
[32m+[m[32m            $quantity = trim($quantity);[m
[32m+[m[32m            $scope = trim($scope);[m
[32m+[m[32m            $extent_of_inspection = trim($extent_of_inspection);[m
[32m+[m[32m            $results = trim($results);[m
[32m+[m[32m            $inspector = trim($inspector);[m
[32m+[m[32m            $date = trim($date);[m
[32m+[m[32m            $for_client_use = trim($for_client_use);[m
[32m+[m[32m            $for_cert_auth = trim($for_cert_auth);[m
[32m+[m[32m            $serial_no = trim($serial_no);[m
[32m+[m[32m            $signature = trim($signature);[m
[32m+[m
[32m+[m
[32m+[m[32m            $sql = "[m
[32m+[m[32m                    INSERT INTO `iso_redesign`.`general_inspection_report`[m
[32m+[m[32m                    ([m
[32m+[m[32m                        `report_no`,`customer`,`location`,`procedure`,`project`,`surface`,`equiptment`,[m
[32m+[m[32m                        `equiptment_serial_no`,`type_of_inspection`,`item`,`drawing_no`,`specification`,[m
[32m+[m[32m                        `material`,`size`,`quantity`,`scope`,`extent_of_inspection`,`results`,`inspector`,[m
[32m+[m[32m                        `date`,`for_client_use`,`for_cert_auth`,`serial_no`,`signature`[m
[32m+[m[32m                    )[m
[32m+[m[32m                    VALUES[m
[32m+[m[32m                    ([m
[32m+[m[32m                        '$report_no','$customer','$location','$procedure','$project','$surface',[m
[32m+[m[32m                        '$equiptment','$equiptment_serial_no','$type_of_inspection','$item','$drawing_no',[m
[32m+[m[32m                        '$specification','$material','$size','$quantity','$scope','$extent_of_inspection',[m
[32m+[m[32m                        '$results','$inspector','$date','$for_client_use','$for_cert_auth','$serial_no',[m
[32m+[m[32m                        '$signature'[m
[32m+[m[32m                    );[m
[32m+[m
[32m+[m[32m            ";[m[41m  [m
[32m+[m
[32m+[m[32m            $query = $this->db->query($sql);[m
[32m+[m
[32m+[m[32m            if($query) { $id = mysql_insert_id();  }[m
             [m
[32m+[m[32m            return $id;[m
         }[m
 [m
         public function update_general_inspection()[m
         {[m
[31m-            [m
[32m+[m
         }[m
 [m
     }[m
[1mdiff --git a/application/views/integrity_management/dpi.php b/application/views/integrity_management/dpi.php[m
[1mindex cc4a1b2..6b9095e 100644[m
[1m--- a/application/views/integrity_management/dpi.php[m
[1m+++ b/application/views/integrity_management/dpi.php[m
[36m@@ -1,296 +1,305 @@[m
[32m+[m[32m<?php[m
[32m+[m	[32m$attributes = array( 'role'=>'form' , 'id' => 'filter-remedial-action-register-form', 'class' => 'form-horizontal' );[m
[32m+[m	[32mecho form_open('', $attributes);[m
[32m+[m	[32m//echo form_hidden('current_user_id', $current_user_id);[m
[32m+[m[32m?>[m
 [m
 <div class="row-content">[m
[31m-        <label for="" class="col-sm-2 col-xs-12 control-label">Customer:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Location:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">P.O No:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Project</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Report No:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Surface:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Procedure:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-</div>[m
[31m-[m
[31m-<div class="row content">[m
[31m-    <div class="col-xs-12">[m
[31m-        <div class="page-header">[m
[31m-            [m
[31m-        </div>[m
[31m-    </div>[m
[31m-</div>[m
[31m-[m
[31m-<div class="row-content">[m
[31m-	<div class="col-xs-12" style="margin-left: 30px;">[m
[31m-		<div class="col-xs-6">[m
[31m-			<div class="col-xs-6">[m
[31m-				<label for="" class="col-sm-12 col-xs-12 control-label">Penetrant Type:</label>[m
[31m-				<div class="col-sm-12 col-xs-12">[m
[31m-					<div class="form-group">[m
[31m-	                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-	                </div>[m
[31m-				</div>[m
[31m-				<label for="" class="col-sm-12 col-xs-12 control-label">Visible:</label>[m
[31m-				<div class="col-sm-12 col-xs-12">[m
[31m-					<div class="form-group">[m
[31m-	                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-	                </div>[m
[32m+[m[32m                    <label for="" class="col-sm-2 col-xs-12 control-label">Customer:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Location:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">P.O No:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Project</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Report No:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Surface:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Procedure:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
 				</div>[m
[31m-				<label for="" class="col-sm-12 col-xs-12 control-label">Fluorescent:</label>[m
[31m-				<div class="col-sm-12 col-xs-12">[m
[31m-					<div class="form-group">[m
[31m-	                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-	                </div>[m
[31m-				</div>[m
[31m-			</div>[m
[31m-			<div class="col-xs-6">[m
[31m-				<label for="" class="col-sm-12 col-xs-12 control-label">Water Washable:</label>[m
[31m-				<div class="col-sm-12 col-xs-12">[m
[31m-					<div class="form-group">[m
[31m-	                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-	                </div>[m
[32m+[m
[32m+[m				[32m<div class="row content">[m
[32m+[m[32m                    <div class="col-xs-12">[m
[32m+[m[32m                        <div class="page-header">[m
[32m+[m[41m                            [m
[32m+[m[32m                        </div>[m
[32m+[m[32m                    </div>[m
[32m+[m[32m                </div>[m
[32m+[m
[32m+[m[32m                <div class="row-content">[m
[32m+[m[41m                [m	[32m<div class="col-xs-12" style="margin-left: 30px;">[m
[32m+[m[41m                [m		[32m<div class="col-xs-6">[m
[32m+[m[41m                [m			[32m<div class="col-xs-6">[m
[32m+[m[41m                [m				[32m<label for="" class="col-sm-12 col-xs-12 control-label">Penetrant Type:</label>[m
[32m+[m								[32m<div class="col-sm-12 col-xs-12">[m
[32m+[m									[32m<div class="form-group">[m
[32m+[m					[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m					[32m                </div>[m
[32m+[m								[32m</div>[m
[32m+[m								[32m<label for="" class="col-sm-12 col-xs-12 control-label">Visible:</label>[m
[32m+[m								[32m<div class="col-sm-12 col-xs-12">[m
[32m+[m									[32m<div class="form-group">[m
[32m+[m					[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m					[32m                </div>[m
[32m+[m								[32m</div>[m
[32m+[m								[32m<label for="" class="col-sm-12 col-xs-12 control-label">Fluorescent:</label>[m
[32m+[m								[32m<div class="col-sm-12 col-xs-12">[m
[32m+[m									[32m<div class="form-group">[m
[32m+[m					[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m					[32m                </div>[m
[32m+[m								[32m</div>[m
[32m+[m[41m                [m			[32m</div>[m
[32m+[m[41m                [m			[32m<div class="col-xs-6">[m
[32m+[m[41m                [m				[32m<label for="" class="col-sm-12 col-xs-12 control-label">Water Washable:</label>[m
[32m+[m								[32m<div class="col-sm-12 col-xs-12">[m
[32m+[m									[32m<div class="form-group">[m
[32m+[m					[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m					[32m                </div>[m
[32m+[m								[32m</div>[m
[32m+[m								[32m<label for="" class="col-sm-12 col-xs-12 control-label">Removable:</label>[m
[32m+[m								[32m<div class="col-sm-12 col-xs-12">[m
[32m+[m									[32m<div class="form-group">[m
[32m+[m					[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m					[32m                </div>[m
[32m+[m								[32m</div>[m
[32m+[m								[32m<label for="" class="col-sm-12 col-xs-12 control-label">Batch No 1:</label>[m
[32m+[m								[32m<div class="col-sm-12 col-xs-12">[m
[32m+[m									[32m<div class="form-group">[m
[32m+[m					[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m					[32m                </div>[m
[32m+[m								[32m</div>[m
[32m+[m[41m                [m			[32m</div>[m
[32m+[m[41m                [m		[32m</div>[m
[32m+[m[41m                [m		[32m<div class="col-xs-6">[m
[32m+[m[41m                [m			[32m<div class="col-xs-6">[m
[32m+[m[41m                [m				[32m<label for="" class="col-sm-12 col-xs-12 control-label">Developer:</label>[m
[32m+[m								[32m<div class="col-sm-12 col-xs-12">[m
[32m+[m									[32m<div class="form-group">[m
[32m+[m					[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m					[32m                </div>[m
[32m+[m								[32m</div>[m
[32m+[m[41m                [m			[32m</div>[m
[32m+[m[41m                [m			[32m<div class="col-xs-6">[m
[32m+[m[41m                [m				[32m<label for="" class="col-sm-12 col-xs-12 control-label">Remover:</label>[m
[32m+[m								[32m<div class="col-sm-12 col-xs-12">[m
[32m+[m									[32m<div class="form-group">[m
[32m+[m					[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m					[32m                </div>[m
[32m+[m								[32m</div>[m
[32m+[m[41m                [m			[32m</div>[m
[32m+[m[41m                [m		[32m</div>[m
[32m+[m[41m                [m	[32m</div>[m
 				</div>[m
[31m-				<label for="" class="col-sm-12 col-xs-12 control-label">Removable:</label>[m
[31m-				<div class="col-sm-12 col-xs-12">[m
[31m-					<div class="form-group">[m
[31m-	                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-	                </div>[m
[32m+[m
[32m+[m				[32m<div class="row content">[m
[32m+[m[32m                    <div class="col-xs-12">[m
[32m+[m[32m                        <div class="page-header">[m
[32m+[m[41m                            [m
[32m+[m[32m                        </div>[m
[32m+[m[32m                    </div>[m
[32m+[m[32m                </div>[m
[32m+[m
[32m+[m				[32m<div class="row-content">[m
[32m+[m[32m                    <label for="" class="col-sm-2 col-xs-12 control-label">Penetrant Dwell Time:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Light Type:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Developer Dwell Time:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Item</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Drawing No:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Acceptance Standard/Code:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Material:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Size:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Quantity:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Identification :</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
 				</div>[m
[31m-				<label for="" class="col-sm-12 col-xs-12 control-label">Batch No 1:</label>[m
[31m-				<div class="col-sm-12 col-xs-12">[m
[31m-					<div class="form-group">[m
[31m-	                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-	                </div>[m
[32m+[m
[32m+[m				[32m<div class="row-content">[m
[32m+[m					[32m<div class="row content">[m
[32m+[m[32m                    <div class="col-xs-12">[m
[32m+[m[32m                        <div class="page-header">[m
[32m+[m[32m                            <h4 class="step-title">Comments/Results:</h4>[m
[32m+[m[32m                        </div>[m
[32m+[m[32m                    </div>[m
[32m+[m[32m                </div>[m
[32m+[m
[32m+[m[32m                <div class="row content">[m
[32m+[m[32m                    <div class="col-xs-12">[m
[32m+[m[32m                        <div class="page-header">[m
[32m+[m[32m                            <h4 class="step-title">Scope:</h4>[m
[32m+[m[32m                        </div>[m
[32m+[m[32m                    </div>[m
[32m+[m[32m                </div>[m
[32m+[m
[32m+[m
[32m+[m[32m                    <div class="col-xs-12">[m
[32m+[m[32m                        <div class="form-group form-group-required">[m
[32m+[m[32m                            <textarea class="form-control textarea-editor medium" name="relevance"></textarea>[m
[32m+[m[32m                        </div>[m
[32m+[m[32m                    </div>[m
[32m+[m
[32m+[m[32m                    <div class="col-xs-12">[m
[32m+[m[32m                        <div class="page-header">[m
[32m+[m[32m                            <h4 class="step-title">Restrictions/Extent of Inspection:</h4>[m
[32m+[m[32m                        </div>[m
[32m+[m[32m                    </div>[m
[32m+[m
[32m+[m
[32m+[m[32m                    <div class="col-xs-12">[m
[32m+[m[32m                        <div class="form-group form-group-required">[m
[32m+[m[32m                            <textarea class="form-control textarea-editor medium" name="relevance"></textarea>[m
[32m+[m[32m                        </div>[m
[32m+[m[32m                    </div>[m
[32m+[m
[32m+[m[32m                <div class="row content">[m
[32m+[m[32m                    <div class="col-xs-12">[m
[32m+[m[32m                        <div class="page-header">[m
[32m+[m[32m                            <h4 class="step-title">Results:</h4>[m
[32m+[m[32m                        </div>[m
[32m+[m[32m                    </div>[m
[32m+[m[32m                </div>[m
[32m+[m
[32m+[m
[32m+[m[32m                    <div class="col-xs-12">[m
[32m+[m[32m                        <div class="form-group form-group-required">[m
[32m+[m[32m                            <textarea class="form-control textarea-editor medium" name="relevance"></textarea>[m
[32m+[m[32m                        </div>[m
[32m+[m[32m                    </div>[m
 				</div>[m
[31m-			</div>[m
[31m-		</div>[m
[31m-		<div class="col-xs-6">[m
[31m-			<div class="col-xs-6">[m
[31m-				<label for="" class="col-sm-12 col-xs-12 control-label">Developer:</label>[m
[31m-				<div class="col-sm-12 col-xs-12">[m
[31m-					<div class="form-group">[m
[31m-	                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-	                </div>[m
[32m+[m
[32m+[m
[32m+[m				[32m<div class="row-content">[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Inspector:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Signature:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">Date:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
 				</div>[m
[31m-			</div>[m
[31m-			<div class="col-xs-6">[m
[31m-				<label for="" class="col-sm-12 col-xs-12 control-label">Remover:</label>[m
[31m-				<div class="col-sm-12 col-xs-12">[m
[31m-					<div class="form-group">[m
[31m-	                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-	                </div>[m
[32m+[m
[32m+[m				[32m<div class="row-content">[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">For Client use:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
[32m+[m
[32m+[m					[32m<label for="" class="col-sm-2 col-xs-12 control-label">For Certifying Auth. use:</label>[m
[32m+[m					[32m<div class="col-sm-4 col-xs-12">[m
[32m+[m						[32m<div class="form-group">[m
[32m+[m		[32m                    <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[32m+[m		[32m                </div>[m
[32m+[m					[32m</div>[m
 				</div>[m
[31m-			</div>[m
[31m-		</div>[m
[31m-	</div>[m
[31m-</div>[m
[31m-[m
[31m-<div class="row content">[m
[31m-    <div class="col-xs-12">[m
[31m-        <div class="page-header">[m
[31m-            [m
[31m-        </div>[m
[31m-    </div>[m
[31m-</div>[m
[32m+[m[41m				[m
 [m
[31m-<div class="row-content">[m
[31m-    <label for="" class="col-sm-2 col-xs-12 control-label">Penetrant Dwell Time:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Light Type:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Developer Dwell Time:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Item</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Drawing No:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Acceptance Standard/Code:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Material:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Size:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Quantity:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Identification :</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-</div>[m
 [m
[31m-<div class="row-content">[m
[31m-	<div class="row content">[m
[31m-    <div class="col-xs-12">[m
[31m-        <div class="page-header">[m
[31m-            <h4 class="step-title">Comments/Results:</h4>[m
[31m-        </div>[m
[31m-    </div>[m
[31m-</div>[m
[31m-[m
[31m-<div class="row content">[m
[31m-    <div class="col-xs-12">[m
[31m-        <div class="page-header">[m
[31m-            <h4 class="step-title">Scope:</h4>[m
[31m-        </div>[m
[31m-    </div>[m
[31m-</div>[m
[31m-[m
[31m-[m
[31m-        <div class="col-xs-12">[m
[31m-            <div class="form-group form-group-required">[m
[31m-                <textarea class="form-control textarea-editor medium" name="relevance"></textarea>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-[m
[31m-        <div class="col-xs-12">[m
[31m-            <div class="page-header">[m
[31m-                <h4 class="step-title">Restrictions/Extent of Inspection:</h4>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-[m
[31m-[m
[31m-        <div class="col-xs-12">[m
[31m-            <div class="form-group form-group-required">[m
[31m-                <textarea class="form-control textarea-editor medium" name="relevance"></textarea>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-[m
[31m-    <div class="row content">[m
[31m-        <div class="col-xs-12">[m
[31m-            <div class="page-header">[m
[31m-                <h4 class="step-title">Results:</h4>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-    </div>[m
[31m-[m
[31m-[m
[31m-        <div class="col-xs-12">[m
[31m-            <div class="form-group form-group-required">[m
[31m-                <textarea class="form-control textarea-editor medium" name="relevance"></textarea>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-[m
[31m-	<div class="row-content">[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Inspector:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Signature:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Date:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-	</div>[m
[31m-[m
[31m-	<div class="row-content">[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">For Client use:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">For Certifying Auth. use:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-	</div>[m
[32m+[m[32m<?php echo form_close(); ?>[m
[1mdiff --git a/application/views/integrity_management/inspection_type.php b/application/views/integrity_management/inspection_type.php[m
[1mindex 8372bb2..01ccad6 100644[m
[1m--- a/application/views/integrity_management/inspection_type.php[m
[1m+++ b/application/views/integrity_management/inspection_type.php[m
[36m@@ -26,7 +26,7 @@[m
 		                    	<option data-id="<?php echo base_url('eddy_current_inspection/add'); ?>" value="2">Eddy Current Inspection</option>[m
 		                    	<option data-id="<?php echo base_url('dye_penetrant/add'); ?>" value="3">Dye Penetrant Inspection</option>[m
 		                    	<option data-id="<?php echo base_url('magnetic_particle/add'); ?>" value="4">Magnetic Particle Inspection</option>[m
[31m-		                    	<option data-id="<?php echo base_url('ultrasonic/add'); ?>" value="5">Ultrasonic Inspection</option>[m
[32m+[m		[41m                    [m	[32m<option data-id="<?php echo base_url('ultrasonic/add'); ?>" value="4">Ultrasonic Inspection</option>[m
 	                        </select>[m
 		                </div>[m
 					</div>[m
[36m@@ -55,7 +55,7 @@[m
         var data_controller = $(this).find("option:selected").data('id');[m
         var $form = $this.closest('form');[m
         var type = $(this).val();[m
[31m-		var type_array = ['select','gip','eci','dpi','mpi', 'ut'];[m
[32m+[m		[32mvar type_array = ['select','gip','eci','dpi','mpi'];[m
 [m
         $form.attr('action', data_controller);[m
 [m
[36m@@ -89,13 +89,6 @@[m
             $("#inspection_type").removeClass("hidden");[m
         }[m
         else [m
[31m-        if(result == 'ut') [m
[31m-        {[m
[31m-            $("#inspection_title").text("Ultrasonic Inspection Report");[m
[31m-            $("#inspection_submit").removeClass("hidden");[m
[31m-            $("#inspection_type").removeClass("hidden");[m
[31m-        }[m
[31m-        else [m
         if(result == 'select') [m
         {[m
             $("#inspection_title").text("Select Inspection Type");[m
[1mdiff --git a/application/views/integrity_management/inspection_type_dashboard.php b/application/views/integrity_management/inspection_type_dashboard.php[m
[1mdeleted file mode 100644[m
[1mindex 642b758..0000000[m
[1m--- a/application/views/integrity_management/inspection_type_dashboard.php[m
[1m+++ /dev/null[m
[36m@@ -1,220 +0,0 @@[m
[31m-<div class="row">[m
[31m-	<div class="col-xs-12">[m
[31m-[m
[31m-		<div class="panel panel-info collapsed">[m
[31m-			<div class="panel-heading">[m
[31m-				<h4 class="panel-title">General Inspection Report</h4>[m
[31m-				<div class="panel-options">[m
[31m-					<a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>[m
[31m-				</div>[m
[31m-			</div>[m
[31m-[m
[31m-			<div class="panel-body">[m
[31m-                <table class="table table-bordered">[m
[31m-                    <thead>[m
[31m-                        <tr>[m
[31m-                            <th>#</th>[m
[31m-                            <th>Username</th>[m
[31m-                            <th>Email Address</th>[m
[31m-                        </tr>[m
[31m-                    </thead>[m
[31m-                    <tbody>[m
[31m-                        <tr>[m
[31m-                            <td>1</td>[m
[31m-                            <td>Nicky Almera</td>[m
[31m-                            <td>nicky@hotmail.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>2</td>[m
[31m-                            <td>Edmund Wong</td>[m
[31m-                            <td>edmund@yahoo.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>3</td>[m
[31m-                            <td>Harvinder Singh</td>[m
[31m-                            <td>harvinder@gmail.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>4</td>[m
[31m-                            <td>Terry Khoo</td>[m
[31m-                            <td>terry@gmail.com</td>[m
[31m-                        </tr>[m
[31m-                    </tbody>[m
[31m-                </table>[m
[31m-			</div>[m
[31m-		</div>[m
[31m-[m
[31m-        <div class="panel panel-info collapsed">[m
[31m-            <div class="panel-heading">[m
[31m-                <h4 class="panel-title">Eddy Current Inspection Report</h4>[m
[31m-                <div class="panel-options">[m
[31m-                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>[m
[31m-                </div>[m
[31m-            </div>[m
[31m-[m
[31m-            <div class="panel-body">[m
[31m-                <table class="table table-bordered">[m
[31m-                    <thead>[m
[31m-                        <tr>[m
[31m-                            <th>#</th>[m
[31m-                            <th>Username</th>[m
[31m-                            <th>Email Address</th>[m
[31m-                        </tr>[m
[31m-                    </thead>[m
[31m-                    <tbody>[m
[31m-                        <tr>[m
[31m-                            <td>1</td>[m
[31m-                            <td>Nicky Almera</td>[m
[31m-                            <td>nicky@hotmail.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>2</td>[m
[31m-                            <td>Edmund Wong</td>[m
[31m-                            <td>edmund@yahoo.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>3</td>[m
[31m-                            <td>Harvinder Singh</td>[m
[31m-                            <td>harvinder@gmail.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>4</td>[m
[31m-                            <td>Terry Khoo</td>[m
[31m-                            <td>terry@gmail.com</td>[m
[31m-                        </tr>[m
[31m-                    </tbody>[m
[31m-                </table>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-[m
[31m-        <div class="panel panel-info collapsed">[m
[31m-            <div class="panel-heading">[m
[31m-                <h4 class="panel-title">Dye Penetrant Inspection Report</h4>[m
[31m-                <div class="panel-options">[m
[31m-                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>[m
[31m-                </div>[m
[31m-            </div>[m
[31m-[m
[31m-            <div class="panel-body">[m
[31m-                <table class="table table-bordered">[m
[31m-                    <thead>[m
[31m-                        <tr>[m
[31m-                            <th>#</th>[m
[31m-                            <th>Username</th>[m
[31m-                            <th>Email Address</th>[m
[31m-                        </tr>[m
[31m-                    </thead>[m
[31m-                    <tbody>[m
[31m-                        <tr>[m
[31m-                            <td>1</td>[m
[31m-                            <td>Nicky Almera</td>[m
[31m-                            <td>nicky@hotmail.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>2</td>[m
[31m-                            <td>Edmund Wong</td>[m
[31m-                            <td>edmund@yahoo.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>3</td>[m
[31m-                            <td>Harvinder Singh</td>[m
[31m-                            <td>harvinder@gmail.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>4</td>[m
[31m-                            <td>Terry Khoo</td>[m
[31m-                            <td>terry@gmail.com</td>[m
[31m-                        </tr>[m
[31m-                    </tbody>[m
[31m-                </table>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-[m
[31m-        <div class="panel panel-info collapsed">[m
[31m-            <div class="panel-heading">[m
[31m-                <h4 class="panel-title">Magnetic Particle Inspection Report</h4>[m
[31m-                <div class="panel-options">[m
[31m-                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>[m
[31m-                </div>[m
[31m-            </div>[m
[31m-[m
[31m-            <div class="panel-body">[m
[31m-                <table class="table table-bordered">[m
[31m-                    <thead>[m
[31m-                        <tr>[m
[31m-                            <th>#</th>[m
[31m-                            <th>Username</th>[m
[31m-                            <th>Email Address</th>[m
[31m-                        </tr>[m
[31m-                    </thead>[m
[31m-                    <tbody>[m
[31m-                        <tr>[m
[31m-                            <td>1</td>[m
[31m-                            <td>Nicky Almera</td>[m
[31m-                            <td>nicky@hotmail.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>2</td>[m
[31m-                            <td>Edmund Wong</td>[m
[31m-                            <td>edmund@yahoo.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>3</td>[m
[31m-                            <td>Harvinder Singh</td>[m
[31m-                            <td>harvinder@gmail.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>4</td>[m
[31m-                            <td>Terry Khoo</td>[m
[31m-                            <td>terry@gmail.com</td>[m
[31m-                        </tr>[m
[31m-                    </tbody>[m
[31m-                </table>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-[m
[31m-        <div class="panel panel-info collapsed">[m
[31m-            <div class="panel-heading">[m
[31m-                <h4 class="panel-title">Ultrasonic Inspection Report</h4>[m
[31m-                <div class="panel-options">[m
[31m-                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>[m
[31m-                </div>[m
[31m-            </div>[m
[31m-[m
[31m-            <div class="panel-body">[m
[31m-                <table class="table table-bordered">[m
[31m-                    <thead>[m
[31m-                        <tr>[m
[31m-                            <th>#</th>[m
[31m-                            <th>Username</th>[m
[31m-                            <th>Email Address</th>[m
[31m-                        </tr>[m
[31m-                    </thead>[m
[31m-                    <tbody>[m
[31m-                        <tr>[m
[31m-                            <td>1</td>[m
[31m-                            <td>Nicky Almera</td>[m
[31m-                            <td>nicky@hotmail.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>2</td>[m
[31m-                            <td>Edmund Wong</td>[m
[31m-                            <td>edmund@yahoo.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>3</td>[m
[31m-                            <td>Harvinder Singh</td>[m
[31m-                            <td>harvinder@gmail.com</td>[m
[31m-                        </tr>[m
[31m-                        <tr>[m
[31m-                            <td>4</td>[m
[31m-                            <td>Terry Khoo</td>[m
[31m-                            <td>terry@gmail.com</td>[m
[31m-                        </tr>[m
[31m-                    </tbody>[m
[31m-                </table>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-[m
[31m-	</div>[m
[31m-</div>[m
\ No newline at end of file[m
[1mdiff --git a/application/views/integrity_management/ut.php b/application/views/integrity_management/ut.php[m
[1mdeleted file mode 100644[m
[1mindex 25b6126..0000000[m
[1m--- a/application/views/integrity_management/ut.php[m
[1m+++ /dev/null[m
[36m@@ -1,359 +0,0 @@[m
[31m-[m
[31m-<div class="row-content">[m
[31m-        <label for="" class="col-sm-2 col-xs-12 control-label">Customer:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Location:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">P.O No:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Project</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Report No:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Surface:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Procedure:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Equipment:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Model:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Serial No:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Couplant:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-</div>[m
[31m-[m
[31m-<div class="row content">[m
[31m-    <div class="col-xs-12">[m
[31m-        <div class="page-header">[m
[31m-            [m
[31m-        </div>[m
[31m-    </div>[m
[31m-</div>[m
[31m-[m
[31m-<div class="row-content">[m
[31m-    <label for="" class="col-sm-2 col-xs-12 control-label">Probe Type:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Probe Angle:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Crystal Size:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Frequency</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Serial No:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Primary Sensitivity:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Transfer Correction:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Calibration Block:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Heat Treatment:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Reference Block:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Block Thickness:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Hole/Notch Size:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Sensitivity Setting-Comp:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Sensitivity Setting-Shear:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Time-Base Range Comp:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Time-Base Range Shear:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-</div>[m
[31m-[m
[31m-<div class="row content">[m
[31m-    <div class="col-xs-12">[m
[31m-        <div class="page-header">[m
[31m-            [m
[31m-        </div>[m
[31m-    </div>[m
[31m-</div>[m
[31m-[m
[31m-<div class="row-content">[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Technique:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Item:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Drawing No:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Acceptance Standard:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Material:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Size:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Quantity:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-	<label for="" class="col-sm-2 col-xs-12 control-label">Identification:</label>[m
[31m-	<div class="col-sm-4 col-xs-12">[m
[31m-		<div class="form-group">[m
[31m-            <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-        </div>[m
[31m-	</div>[m
[31m-</div>[m
[31m-[m
[31m-<div class="row-content">[m
[31m-	<div class="row content">[m
[31m-    <div class="col-xs-12">[m
[31m-        <div class="page-header">[m
[31m-            <h4 class="step-title">Comments/Results:</h4>[m
[31m-        </div>[m
[31m-    </div>[m
[31m-</div>[m
[31m-[m
[31m-<div class="row content">[m
[31m-    <div class="col-xs-12">[m
[31m-        <div class="page-header">[m
[31m-            <h4 class="step-title">Scope:</h4>[m
[31m-        </div>[m
[31m-    </div>[m
[31m-</div>[m
[31m-[m
[31m-[m
[31m-        <div class="col-xs-12">[m
[31m-            <div class="form-group form-group-required">[m
[31m-                <textarea class="form-control textarea-editor medium" name="relevance"></textarea>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-[m
[31m-        <div class="col-xs-12">[m
[31m-            <div class="page-header">[m
[31m-                <h4 class="step-title">Restrictions/Extent of Inspection:</h4>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-[m
[31m-[m
[31m-        <div class="col-xs-12">[m
[31m-            <div class="form-group form-group-required">[m
[31m-                <textarea class="form-control textarea-editor medium" name="relevance"></textarea>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-[m
[31m-    <div class="row content">[m
[31m-        <div class="col-xs-12">[m
[31m-            <div class="page-header">[m
[31m-                <h4 class="step-title">Results:</h4>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-    </div>[m
[31m-[m
[31m-[m
[31m-        <div class="col-xs-12">[m
[31m-            <div class="form-group form-group-required">[m
[31m-                <textarea class="form-control textarea-editor medium" name="relevance"></textarea>[m
[31m-            </div>[m
[31m-        </div>[m
[31m-	</div>[m
[31m-[m
[31m-[m
[31m-	<div class="row-content">[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Inspector:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Signature:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">Date:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-	</div>[m
[31m-[m
[31m-	<div class="row-content">[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">For Client use:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="customer" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-[m
[31m-		<label for="" class="col-sm-2 col-xs-12 control-label">For Certifying Auth. use:</label>[m
[31m-		<div class="col-sm-4 col-xs-12">[m
[31m-			<div class="form-group">[m
[31m-                <input type="text" class="form-control" name="location" id="" placeholder="" value="">[m
[31m-            </div>[m
[31m-		</div>[m
[31m-	</div>[m
