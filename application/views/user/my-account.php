<?php

	$user_photo_properties = array(
		'width' => 145,
		'height' => 145,
		'src' => $user_photo
	);

	$cover_photo_properties = array(
		'width' => 145,
		'height' => 145,
		'src' => $cover_photo
	);

?>


<div class="modal fade" id="confirm-delete-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="completion-check-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">You are about to delete a form</h4>
      </div>
      <div class="modal-body">
        <p>Do you still want to continue?</p> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary go-no" data-dismiss="modal"> No</button>
        <button type="button" class="btn btn-danger go-yes"> Yes</button>
      </div>
    </div>
  </div>
</div>
<?php 
        $attributes=array( 'role'=>'form', 'id' => 'my-account-form' ); 
        	echo form_open_multipart('user/save', $attributes);
        	echo form_hidden('form_id', $user_id);
        ?>
<div class="modal fade" id="change-photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="change-photo-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Change Photo</h4>
      </div>
      
      <div class="modal-body">
      	<p class="strong">Cover Photo</p>
        <p class="col-xs-12">
        	<?php 
				$data['single_upload'] = true;
				$data['file_value'] = $cover_filename;
				$data['upload_name'] = 'cover_image';
				$this->load->view('includes/casefile-upload', $data); 
			?>
		</p>
		<p class="strong">Profile Photo</p>
		<p class="col-xs-12">
			<?php 
				$data['single_upload'] = true;
				$data['file_value'] = $upload_filename;
				$data['upload_name'] = 'user_image';
				$this->load->view('includes/casefile-upload', $data);
			?>
		</p>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
         <button id="user-save" class="btn btn-primary loading-button" data-toggle="tooltip" data-placement="top" title="Save and Upload Information"  type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
      </div>
    </div>
  </div>
</div>




<section id="main-content">
	<div class="container">

		<div class="row">
			<div class="col-xs-12">
				<div id="casefile-view-header" class="page-header">
					<div class="row">
						<div class="col-sm-3">
							<h1 class="align-title">My Account</h1>
						</div>
						<div class="col-sm-9 text-right">
							<a href="<?php echo base_url('page/tech-help'); ?>" class="btn btn-success btn-larger" data-toggle="tooltip" data-placement="left" title="Tech Help"><span class="glyphicon glyphicon-question-sign"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="row">
			<div class="col-sm-12">
				<div id="my-account-panel" class="panel panel-primary">

				<div class="row">
			        <div class="col-xs-12">
						<?php
							$activation_success = $this->session->flashdata('activation_success');
						?>

			            <?php if($upload_error): ?>
			                <div class="alert alert-danger fade in">
			                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                  <strong>Error Uploading File</strong> <?php echo $upload_error; ?>
			                </div>
			            <?php endif; ?>

			            <?php if($activation_success): ?>
			                <div class="alert alert-success fade in">
			                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
			                  <strong>You've successfully activated your account</strong> <br/>You can add new profile information below.
			                </div>
			            <?php endif; ?>

			
			        </div>
			    </div>
			    
		<div class="row profile-details">

			<div class="col-sm-3 col-sm-offset-1">
				<div class="col-sm-12">
					<div class="row centered">
						<!-- Cover Photo -->
						<?php echo image_exist($cover_photo_properties, 'cover'); ?>

						<!-- Profile Photo -->
            			<?php echo image_exist($user_photo_properties, 'circle'); ?>
            			<!-- Name -->
			            <div class="covername col-sm-12">
			            	<?php echo $fullname; ?>
			            </div>
			            <!-- Change button -->
			            <a class="btn btn-primary coverbutton"><span class="glyphicon glyphicon-picture"></span> Change Photo</a>
					</div>
				</div>
			</div>

			<div class="col-sm-8">
				<div id="my-account-input" class="row">
					<div class="col-sm-12">
				
						
						<div class="row">
							<div class="col-sm-5 column-label">
								<p class="strong">Discipline:</p>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
                                    <select class="form-control" name="discipline" id="discipline">
                                        <?php echo $discipline_dropdown; ?>
                                    </select>
                                </div>
							</div>
							
						</div>
						
						<div class="row">
							<div class="col-sm-5 column-label">
								<p class="strong">Position:</p>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
                                    <select class="form-control" name="position" id="position">
                                        <?php echo $position_dropdown; ?>
                                    </select>
                                </div>
							</div>
							
						</div>
						
						<div class="row">
							<div class="col-sm-5 column-label">
								<p class="strong">Years of Service:</p>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
                                    <select class="form-control" name="years_of_service" id="years_of_service">
                                        <?php echo $years_of_service_dropdown; ?>
                                    </select>
                                </div>
							</div>
							
						</div>
						<div class="row">
							<div class="col-sm-5 column-label">
								<p class="strong">Area of Operations:</p>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
                                    <select class="form-control" name="area_of_operation" id="area_of_operation">
                                        <?php echo $area_of_operation_dropdown; ?>
                                    </select>
                                </div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-5 column-label">
								<p class="strong">Highest Qualifications:</p>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
                                    <select class="form-control" name="highest_qualification" id="highest_qualification">
                                        <?php echo $highest_qualification_dropdown; ?>
                                    </select>
                                </div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-sm-5 column-label">
							</div>
							<div class="col-sm-5">
								<div class="form-group text-right">
	                    
	                                <button id="user-save" class="btn btn-primary loading-button" data-toggle="tooltip" data-placement="top" title="Save and Upload Information"  type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
	                            </div>
							</div>
						</div>
					</div>
				</div> <!-- .row -->

				
			</div>
		</div> <!-- .row -->

		
		<div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h2 class="step-title">Follow Users</h2>
                </div>
            </div>
        </div>

		<div class="row">
			<div class="col-sm-10 col-sm-offset-1">
				<div class="row">
			        <div id="follow-user" class="dynamic-row">
			            <?php 
			                $user_counter = 0;
			                foreach($followed_users	 as $user){ 
			                    $first_name = $user->first_name;
			                    $last_name = $user->last_name;
			                    $full_name = $first_name . '&nbsp; ' . $last_name;
			                    if($full_name == ' '){
			                        $full_name = '';
			                    }
			                    $user_id = $user->user_id;
			                    $user_name = $user->user_name;
			                    $email_address = $user->email_address;

			                    if($user_counter == 0){
			                        $user_class = 'left';
			                        $user_counter++;
			                    }else if($user_counter == 1){
			                        $user_class = '';
			                        $user_counter = 0;
			                    }
			            ?>
			            <div class="col-row col-sm-5 additional-user ajax-autocomplete">
			                <div class="form-group">
			                    <select name="additional_user_id[]" id="document_name" class="form-control new-user select2-dropdown">
			                    	<option value=" <?php echo $user_id; ?>"><?php echo $full_name; ?></option> 
                                  <?php echo $user_option ?>
          						</select>
			                    
			                </div>
			                <div class="autosuggest form-group">
			                    <ul class="user-suggest">

			                    </ul>
			                </div>
			            </div>
			            <?php } ?>
			            
			        </div>
			    </div>
			</div>
			
		</div>
		<div class="row">
			<div class="col-sm-7 col-sm-offset-3 no-padding">
				<div class="form-group text-right">
	            	<button id="user-save" class="btn btn-primary loading-button" data-toggle="tooltip" data-placement="top" title="" type="submit" data-original-title="Save and Upload Information"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
	            </div>
			</div>
		</div>
        




		<div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h2 class="step-title">Lessons to be learned</h2>
                </div>
            </div>
        </div>
        <div class="row">
			<div class="col-sm-5 col-sm-offset-1 column-label">
				 <p class="strong">Do you want to receive Defect Elimination Case Files?</p>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
                    <select name="notify_case_file" id="notify_case_file"  class="form-control colored-select <?php echo get_color_class($notify_case_file, 'swap_yes_no'); ?>">
                        <?php echo comment_question_dropdown($notify_case_file, 'normal_option','- SELECT -', 'reversed'); ?>
                    </select>
                </div>
			</div>
		</div>
        <div class="row">
			<div class="col-sm-5 col-sm-offset-1 column-label">
				 <p class="strong">Do you want to receive Technical Bulletins?</p>
			</div>
			<div class="col-sm-4">
				<div class="form-group">
                    <select name="notify_technical_bulletin" id="notify_technical_bulletin"  class="form-control colored-select <?php echo get_color_class($notify_technical_bulletin, 'swap_yes_no'); ?>">
                        <?php echo comment_question_dropdown($notify_technical_bulletin, 'normal_option','- SELECT -', 'reversed'); ?>
                    </select>
                </div>
			</div>
		</div>
        
        <div class="row">
            <div class="col-sm-5 col-sm-offset-1 column-label">
                <label for="equipment_category">What Equipment Category are you interested in?</label>
            </div>
            <div class="col-xs-6">
            	<div class="row">
            	<?php 
            	

            	$equipment_category_counter = 0;
            	foreach($preferred_equipment_categories as $category){
            		$category_id = $category['id'];
            		
            		$category_name = $category['name'];
            		$notify = $category['notify'];
            		if($notify == 1){
            			$notify_checked = "checked=checked";
            		}else{
            			$notify_checked = '';
            			$notify = 0;
            		}
            	?>
            		<div class="col-xs-6 checkbox-item">
            			<input type="hidden" name="equipment_category_id[<?php echo $equipment_category_counter; ?>]" value="<?php echo $category_id; ?>" />
            			<input class="equipment-category" type="hidden" name="equipment_category[<?php echo $equipment_category_counter; ?>]" value="<?php echo $notify; ?>" />
            			<div class="checkbox">
					        <label>
					          <input name="equipment_category_value[<?php echo $equipment_category_counter; ?>]" type="checkbox" value="<?php echo $notify; ?>" <?php echo $notify_checked; ?>> <?php echo $category_name; ?>
					        </label>
					    </div>
            		</div>

            	<?php
            		$equipment_category_counter++;
            	 } 
            	?>
            	</div>
            </div>

            
            
        </div>
        

        <div class="row">
        	<div class="col-sm-11 text-right">
        		<button id="user-save" class="btn btn-primary loading-button" data-toggle="tooltip" data-placement="top" title="Save and Upload Information"  type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
        	</div>
        </div>
		<?php echo form_close(); ?>

		<br>


		<div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#basic-decf-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">Level 1 DECF </h2>
                </div>
                <div class="col-sm-6 no-padding">
					<a class="btn btn-primary pull-right" href="<?php echo base_url('basic-decf/create'); ?>"><span class="glyphicon glyphicon-plus"></span></a></p>
                </div>
                <div class="col-sm-1">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="basic-decf-container" class="table-container collapse in">

			<?php if(empty($basic_decf_results)): ?>
				<p>There are no Basic DECF created. <a href="<?php echo base_url('basic-decf/create'); ?>">Create One</a></p>
			<?php else: ?>
				<div class="row-table table-responsive">
					<table class="table table-bordered my-account" id="basic-decf-json">
					<thead>
					    <th class="id" data-dynatable-column="document_id">ID</th>
					    <th class="code" data-dynatable-column="document_code">Code</th>
					    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
					    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
					    <th class="document-status" data-dynatable-column="document_status_value"><span class="glyphicon glyphicon-flag"></span> Status</th>
					    <th class="likes" data-dynatable-column="no_of_likes"><span class="glyphicon glyphicon-thumbs-up"></span> likes </th>
					    <th class="action duplicate" data-dynatable-column="action"><span class="glyphicon glyphicon-cog"></span> Actions</th>

					</thead>
					<tbody>
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
	    </div>




	    <div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#decf-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">Level 2 Forensic DECF</h2>
                </div>
                <div class="col-sm-6 no-padding">
					<a class="btn btn-primary pull-right" href="<?php echo base_url('case-file/create'); ?>"><span class="glyphicon glyphicon-plus"></span></a></p>
                </div>
                <div class="col-sm-1">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="decf-container" class="table-container collapse in">

			<?php if(empty($decf_results)): ?>
				<p>There are no DECF created. <a href="<?php echo base_url('case-file/create'); ?>">Create One</a></p>
			<?php else: ?>
				<div class="row-table table-responsive">
					<table class="table table-bordered my-account" id="decf-json">
					<thead>
					    <th class="id" data-dynatable-column="document_id">ID</th>
					    <th class="code" data-dynatable-column="document_code">Code</th>
					    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
					    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
					    <th class="document-status" data-dynatable-column="document_status_value"><span class="glyphicon glyphicon-flag"></span> Status</th>
					    <th class="likes" data-dynatable-column="no_of_likes"><span class="glyphicon glyphicon-thumbs-up"></span> likes </th>
					    <th class="action duplicate" data-dynatable-column="action"><span class="glyphicon glyphicon-cog"></span> Actions</th>

					</thead>
					<tbody>
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
    	</div>




    	<div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#ofi-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">OFI</h2>
                </div>
                <div class="col-sm-6 no-padding">
					<a class="btn btn-primary pull-right" href="<?php echo base_url('ofi/create'); ?>"><span class="glyphicon glyphicon-plus"></span></a></p>
                </div>
                <div class="col-sm-1">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="ofi-container" class="table-container collapse in">

			<?php if(empty($ofi_results)): ?>
				<p>There are no OFI created. <a href="<?php echo base_url('ofi/create'); ?>">Create One</a></p>
			<?php else: ?>
				<div class="row-table table-responsive">
					<table class="table table-bordered my-account" id="ofi-json">
					<thead>
					    <th class="id" data-dynatable-column="document_id">ID</th>
					    <th class="code" data-dynatable-column="document_code">Code</th>
					    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
					    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
					    <th class="document-status" data-dynatable-column="document_status_value"><span class="glyphicon glyphicon-flag"></span> Status</th>
					    <th class="likes" data-dynatable-column="no_of_likes"><span class="glyphicon glyphicon-thumbs-up"></span> likes </th>
					    <th class="action duplicate" data-dynatable-column="action"><span class="glyphicon glyphicon-cog"></span> Actions</th>

					</thead>
					<tbody>
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
    	</div>



    	<div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#pp-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">Project Plan</h2>
                </div>
                <div class="col-sm-6 no-padding">
					<a class="btn btn-primary pull-right" href="<?php echo base_url('project-plan/create'); ?>"><span class="glyphicon glyphicon-plus"></span></a></p>
                </div>
                <div class="col-sm-1">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="pp-container" class="table-container collapse in">

			<?php if(empty($pp_results)): ?>
				<p>There are no Project Plan created. <a href="<?php echo base_url('project-plan/create'); ?>">Create One</a></p>
			<?php else: ?>
				<div class="row-table table-responsive">
					<table class="table table-bordered my-account" id="project-plan-json">
					<thead>
					    <th class="id" data-dynatable-column="document_id">ID</th>
					    <th class="code" data-dynatable-column="document_code">Code</th>
					    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
					    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
					    <th class="document-status" data-dynatable-column="document_status_value"><span class="glyphicon glyphicon-flag"></span> Status</th>
					    <th class="likes" data-dynatable-column="no_of_likes"><span class="glyphicon glyphicon-thumbs-up"></span> likes </th>
					    <th class="action duplicate" data-dynatable-column="action"><span class="glyphicon glyphicon-cog"></span> Actions</th>

					</thead>
					<tbody>
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
    	</div>




    	<div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#tb-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">Technical Bulletin</h2>
                </div>
                <div class="col-sm-6 no-padding">
					<a class="btn btn-primary pull-right" href="<?php echo base_url('technical-bulletin/create'); ?>"><span class="glyphicon glyphicon-plus"></span></a></p>
                </div>
                <div class="col-sm-1">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="tb-container" class="table-container collapse in">

			<?php if(empty($tb_results)): ?>
				<p>There are no Technical Bulletin created. <a href="<?php echo base_url('technical-bulletin/create'); ?>">Create One</a></p>
			<?php else: ?>
				<div class="row-table table-responsive">
					<table class="table table-bordered my-account" id="technical-bulletin-json">
					<thead>
					    <th class="id" data-dynatable-column="document_id">ID</th>
					    <th class="code" data-dynatable-column="document_code">Code</th>
					    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
					    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
					    <th class="document-status" data-dynatable-column="document_status_value"><span class="glyphicon glyphicon-flag"></span> Status</th>
					    <th class="likes" data-dynatable-column="no_of_likes"><span class="glyphicon glyphicon-thumbs-up"></span> likes </th>
					    <th class="action duplicate" data-dynatable-column="action"><span class="glyphicon glyphicon-cog"></span> Actions</th>

					</thead>
					<tbody>
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
    	</div>

		<div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#ws-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">Witness Statement</h2>
                </div>
                <div class="col-sm-6 no-padding">
					<a class="btn btn-primary pull-right" href="<?php echo base_url('witness-statement/create'); ?>"><span class="glyphicon glyphicon-plus"></span></a></p>
                </div>
                <div class="col-sm-1">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="ws-container" class="table-container collapse in">

			<?php if(empty($ws_results)): ?>
				<p>There are no Witness Statement created. <a href="<?php echo base_url('witness-statement/create'); ?>">Create One</a></p>
			<?php else: ?>
				<div class="row-table table-responsive">
					<table class="table table-bordered my-account" id="witness-statement-json">
					<thead>
					    <th class="id" data-dynatable-column="document_id">ID</th>
					    <th class="code" data-dynatable-column="document_code">Code</th>
					    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
					    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
					    <th class="document-status" data-dynatable-column="document_status_value"><span class="glyphicon glyphicon-flag"></span> Status</th>
					    <th class="likes" data-dynatable-column="no_of_likes"><span class="glyphicon glyphicon-thumbs-up"></span> likes </th>
					    <th class="action duplicate" data-dynatable-column="action"><span class="glyphicon glyphicon-cog"></span> Actions</th>

					</thead>
					<tbody>
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
    	</div>

		<div class="page-header accordion my-account collapsed" data-toggle="collapse" data-target="#tq-container">
			<div class="row content">
                <div class="col-sm-5">
                    <h2 class="step-title">Technical Query</h2>
                </div>
                <div class="col-sm-6 no-padding">
					<a class="btn btn-primary pull-right" href="<?php echo base_url('technical-query/create'); ?>"><span class="glyphicon glyphicon-plus"></span></a></p>
                </div>
                <div class="col-sm-1">
                    <span class="accordion-btn btn btn-success" data-original-title="" title=""><span class="glyphicon glyphicon-chevron-down"></span></span>
                </div>
            </div>
		</div>

		<div id="tq-container" class="table-container collapse in">

			<?php if(empty($tq_results)): ?>
				<p>There are no Technical Query created. <a href="<?php echo base_url('technical-query/create'); ?>">Create One</a></p>
			<?php else: ?>
				<div class="row-table table-responsive">
					<table class="table table-bordered my-account" id="technical-query-json">
					<thead>
					    <th class="id" data-dynatable-column="document_id">ID</th>
					    <th class="code" data-dynatable-column="document_code">Code</th>
					    <th class="case-file" data-dynatable-column="document_name">Case File Name</th>
					    <th class="viewable duplicate" data-dynatable-column="viewable"><span class="glyphicon glyphicon-eye-open"></span> Complete</th>
					    <th class="document-status" data-dynatable-column="document_status_value"><span class="glyphicon glyphicon-flag"></span> Status</th>
					    <th class="likes" data-dynatable-column="no_of_likes"><span class="glyphicon glyphicon-thumbs-up"></span> likes </th>
					    <th class="action duplicate" data-dynatable-column="action"><span class="glyphicon glyphicon-cog"></span> Actions</th>

					</thead>
					<tbody>
						<!-- Javascript is working here with ajax data table generated -->
					</tbody>
					</table>
			    </div>
	    	<?php endif; ?> 
    	</div>


		






    	

    	<br>
    	<br>
				





		</div>
	</div>
</div>



	</div>


	<!-- modal-->
	<div class="modal fade bs-example-modal-sm" id="loading-animation" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm spin-modal">
	    <div class="modal-content text-center">
	    	<br />
	      <span class="icon-spin-size-25px">Duplicating </span> <br />

	      <i class="fa fa-cog fa-spin icon-spin-size-40px"></i>
	      <i class="fa fa-cog fa-spin icon-spin-size-20px icon-spin-reverse"></i>

	      <br />
	      <br />
	    </div>
	  </div>
	</div>
</section>