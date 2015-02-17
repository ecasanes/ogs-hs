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
<span class="hidden"><input type="hidden" name="current_user_id" value="<?php echo $current_user_id;?>"></span>
<div class="container-fluid-md">
    <div class="row">
        <div class="col-sm-8 col-xs-12">
            <div class="panel panel-default panel-profile-details" id="user-info-panel">
                <div class="panel-body">
                    <div class="col-sm-5 text-center">
                        <!-- <img alt="image" class="img-circle img-profile" width="128" height="128" src="<?php echo $user_photo_url; ?>"> -->
                        <?php echo image_exist($user_photo_url, 'circle'); ?>
                    </div>
                    <div class="col-sm-7 profile-details">
                        <h3><?php echo $fullname; ?></h3>
                        <h4 id="user-position-value" class="thin view-user-info"><?php echo $position_value; ?></h4>
                        <select class="form-control input-sm edit-user-info hidden" name="position">
                            <?php echo $position_dropdown; ?>
                        </select>
                        <p>
                            <a href="<?php echo image_exist($cover_photo, 'normal', 'url'); ?>" class="text-gray text-no-decoration img-lightbox" data-lightbox="cover-image">
                                <i class="fa fa-fw fa-image"></i>
                                View Cover Photo
                            </a>
                        </p>
                        
                        <p>
                            <a href="javascript:;" class="text-gray text-no-decoration change-user-photo">
                                <i class="fa fa-fw fa-image"></i>
                                Upload Photo
                            </a>
                        </p>

                        <p>
                            <a href="javascript:;" class="text-gray text-no-decoration edit-user-information">
                                <i class="fa fa-fw fa-pencil"></i>
                                Edit Profile
                            </a>
                        </p>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-sm-5">
                        <dl>
                            <dt>Discipline</dt>
                            <dd id="user-discipline-value" class="view-user-info discipline-value"><?php echo $discipline_value; ?></dd>
                            <dd class="edit-user-info hidden">
                                <select name="discipline" class="form-control input-sm">
                                    <?php echo $discipline_dropdown; ?>
                                </select>
                            </dd>
                        </dl>
                        <dl class="margin-sm-bottom">
                            <dt>Years of Service</dt>
                            <dd id="user-years-of-service-value" class="view-user-info"><?php echo $years_of_service_value; ?></dd>
                            <dd class="edit-user-info hidden">
                                <select name="years_of_service" class="form-control input-sm">
                                    <?php echo $years_of_service_dropdown; ?>
                                </select>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-sm-7">
                        <dl>
                            <dt>Area of Operation</dt>
                            <dd id="user-area-of-operation-value" class="view-user-info"><?php echo $area_of_operation_value; ?></dd>
                            <dd class="edit-user-info hidden">
                                <select name="area_of_operation" class="form-control input-sm">
                                    <?php echo $area_of_operation_dropdown; ?>
                                </select>
                            </dd>
                        </dl>
                        <dl class="margin-sm-bottom">
                            <dt>Highest Qualification</dt>
                            <dd id="user-highest-qualification-value" class="view-user-info"><?php echo $highest_qualification_value; ?></dd>
                            <dd class="edit-user-info hidden">
                                <select name="highest_qualification" class="form-control input-sm">
                                    <?php echo $highest_qualification_dropdown; ?>
                                </select>
                            </dd>
                        </dl>
                    </div>
                    <div class="col-sm-5">
                        <dl>
                            <dt>Current Asset Operation</dt>
                            <dd id="user-current-asset-operation-value" class="view-user-info"><?php echo $asset_operation_value; ?></dd>
                            <dd class="edit-user-info hidden">
                                <select name="current_asset_operation" class="form-control input-sm">
                                    <?php echo $asset_operation_dropdown; ?>
                                </select>
                            </dd>
                        </dl>
                        
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-sm-5">
                        <dl class="">
                            <dt>Email</dt>
                            <dd id="user-email-address-value" class="view-user-info"><?php echo $email_address; ?></dd>
                            <dd class="edit-user-info hidden">
                                <input type="hidden" name="original_email_address" value="<?php echo $email_address; ?>" />
                                <input type="text" name="email_address" class="form-control input-sm" value="<?php echo $email_address; ?>" />
                            </dd>
                        </dl>
                    </div>
                    <div class="col-sm-7 edit-user-info hidden">
                        <dl class="">
                            <dt class="view-user-info">&nbsp;</dt>
                            <dt class="edit-user-info hidden">Confirm Email</dt>
                            <dd class="view-user-info">&nbsp;</dd>
                            <dd class="edit-user-info hidden">
                                <input type="text" name="confirm_email_address" class="form-control input-sm" />
                            </dd>
                        </dl>
                    </div>
                    <!-- <div class="col-sm-5">
                        <dl class="margin-sm-bottom">
                            <dt>Password</dt>
                            <dd class="view-user-info">***************</dd>
                            <dd class="edit-user-info hidden">
                                <input type="text" name="password" class="form-control input-sm" value="" />
                            </dd>
                        </dl>
                    </div>
                    <div class="col-sm-7 edit-user-info hidden">
                        <dl class="margin-sm-bottom">
                            <dt class="view-user-info">&nbsp;</dt>
                            <dt class="edit-user-info hidden">Confirm Password</dt>
                            <dd class="view-user-info">&nbsp;</dd>
                            <dd class="edit-user-info hidden">
                                <input type="text" name="confirm_password" class="form-control input-sm" />
                            </dd>
                        </dl>
                    </div> -->
                    <div class="col-sm-12 hidden" id="save-user-info">
                        <div class="text-right">
                            <span class="save-animation hidden">
                                <i class="fa fa-refresh fa-spin"></i> Saving... &nbsp;
                            </span>
                            <span id="my-account-error" class="text-danger hidden"></span>
                            &nbsp;<button class="btn btn-default btn-sm cancel-button" >Cancel</button>
                            <button class="btn btn-primary btn-sm save-button" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-4 col-xs-12">
            <div id="document-statistics" class="panel panel-info">
                <div class="panel-heading">
                    <h1 class="panel-title">
                        Document Statistics
                    </h1>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                    </div>
                </div>
                <div class="panel-body no-padding">
                    <table class="table">
                        <tr>
                            <td>
                                DECF
                            </td>
                            <td class="valign-middle">
                                <?php echo $basic_decf_count; ?>
                            </td>
                        </tr>
                        <!-- <tr>
                            <td>
                                Level 2 Forensic DECF
                            </td>
                            <td class="valign-middle">
                                <?php echo $decf_count; ?>
                            </td>
                        </tr> -->
                        <tr>
                            <td>
                                OFI
                            </td>
                            <td class="valign-middle">
                                <?php echo $ofi_count; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Project Work Pack
                            </td>
                            <td class="valign-middle">
                                <?php echo $pp_count; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Technical Bulletin
                            </td>
                            <td class="valign-middle">
                                <?php echo $tb_count; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Witness Statement
                            </td>
                            <td class="valign-middle">
                                <?php echo $ws_count; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Technical Query
                            </td>
                            <td class="valign-middle">
                                <?php echo $tq_count; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ERP
                            </td>
                            <td class="valign-middle">
                                <?php echo $erp_count; ?>
                            </td>
                        </tr>
                    </table>
                </div>
                    
                
                
            </div>
        </div>

    </div>
        <div class="row">
            <div class="col-xs-12 col-sm-8">
                
                <div class="row">
                    <div class="col-xs-12">
                        <!-- <div class="col-sm-8 col-xs-12"> -->
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <h1 class="panel-title">Lessons to be Learned</h1>
                                    <div class="panel-options">
                                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                                    </div>
                                </div>
                                <div class="panel-body" id="notifications-and-preferences">

                                    <div class="row">

                                        <div class="col-sm-8">
                                            <dl>
                                                <dt>Do you want to receive Defect Elimination Case Files?</dt>
                                            </dl>
                                        </div>
                                        <div class="col-sm-4">
                                            <input <?php if($notify_case_file == 'yes'){ echo 'checked';}?> class="boot-switch" name="case_file_checkbox" type="checkbox" data-on-color="success"  data-off-color="danger" data-on-text="YES" data-off-text="NO">
                                        </div>
                                        <div class="col-sm-8">
                                            <dl>
                                                <dt>Do you want to receive Technical Bulletins?</dt>
                                            </dl>
                                        </div>
                                        <div class="col-sm-4">
                                            <input <?php if($notify_technical_bulletin == 'yes'){ echo 'checked';}?> class="boot-switch" name="tb_checkbox" type="checkbox" data-on-color="success"  data-off-color="danger" data-on-text="YES" data-off-text="NO">
                                        </div>
                                        <div class="col-sm-12">
                                            <h4>What Equipment Category are you interested in?</h4>
                                        </div>
                                        <div class="col-sm-12">
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
                                                <div class="col-sm-6 col-xs-12">
                                                   <div class="checkbox">
                                                        <label>
                                                            <input type="hidden" class="equipment-category-id" name="equipment_category_id[<?php echo $equipment_category_counter; ?>]" value="<?php echo $category_id; ?>" />
                                                            <input class="equipment-category" type="hidden" name="equipment_category[<?php echo $equipment_category_counter; ?>]" value="<?php echo $notify; ?>" />
                                                            <input type="checkbox" class="icheck square-blue equipment-category-box" name="equipment_category_value[<?php echo $equipment_category_counter; ?>]" value="<?php echo $notify; ?>" <?php echo $notify_checked; ?>>
                                                            <?php echo $category_name; ?>
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
                                        <div id="lessons-learned-save" class="col-xs-12 col-sm-4 pull-right text-right"> &nbsp;
                                            <span class="save-animation hidden">
                                                <i class="fa fa-refresh fa-spin"></i> Saving... &nbsp;
                                            </span>
                                            <span class="saved text-success hidden">
                                                Saved! <i class="fa fa-check"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-4">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- <div class="col-sm-4 col-xs-12"> -->
                            <div class="panel panel-inverse">
                                <div class="panel-heading">
                                    <h1 class="panel-title">Follow Users</h1>

                                    <div class="panel-options">
                                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                                    </div>
                                </div>
                                <div class="panel-body" id="my-account-follow-users">

                                        <div class="hidden hidden-clone">
                                            <select name="additional_user_id[]" class="form-control new-user">
                                                    <option value="0" selected></option>
                                                    <?php echo $user_option ?>
                                            </select>
                                            <span class="input-group-btn">
                                                <button class="btn btn-danger remove-user-button" type="button" data-toggle="tooltip" data-original-title="Remove User">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </button>
                                                <input type="hidden" class="follow_user_id" name="follow_user" value="" />
                                            </span>
                                        </div>

                                    <?php 
                                            $user_counter = 0;
                                            foreach($followed_users  as $user){ 
                                                $follow_user_id = $user->follow_user_id;
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

                                        <div class="input-group">
                                            <select name="additional_user_id[]" class="form-control new-user select2-dropdown">
                                                    <option value="<?php echo $user_id; ?>" selected><?php echo $full_name; ?></option> 
                                                  <?php echo $user_option ?>
                                            </select>
                                            <span class="input-group-btn">
                                                <button class="btn btn-danger remove-user-button" type="button" data-toggle="tooltip" data-original-title="Remove User">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </button>
                                                <input type="hidden" class="follow_user_id" name="follow_user" value="<?php echo $follow_user_id; ?>" />
                                            </span>
                                        </div>

                                    <?php } ?>

                                    <div class="input-group pull-right add-remove-buttons">
                                        <a class="btn btn-primary add-follower">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </a>
                                    </div>
                                    
                                    

                                </div>
                            </div>
                        <!-- </div> -->
                    </div>
                </div>
            </div>
        </div>




        

        <div class="row">

        <div class="col-xs-12">
            <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        DECF
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="basic-decf-container" class="panel-body" style="display:none;">

                    <?php if(empty($basic_decf_results)): ?>
                        <p>There are no Basic DECF created. <a href="<?php echo base_url('basic-decf/create'); ?>">Create One</a></p>
                    <?php else: ?>
                        <div class="row-table table-responsive">
                            <table class="table table-bordered my-account table-condensed" id="basic-decf-json">
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
            </div>

            <!-- <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Level 2 Forensic DECF
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="decf-container" class="panel-body" style="display:none;">
                    <?php if(empty($decf_results)): ?>
                        <p>There are no DECF created. <a href="<?php echo base_url('case-file/create'); ?>">Create One</a></p>
                    <?php else: ?>
                        <div class="row-table table-responsive">
                            <table class="table table-bordered my-account table-condensed" id="decf-json">
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
                               
                            </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div> -->

            <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        OFI
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="ofi-container" class="panel-body" style="display:none;">
                    <?php if(empty($ofi_results)): ?>
                        <p>There are no OFI created. <a href="<?php echo base_url('ofi/create'); ?>">Create One</a></p>
                    <?php else: ?>
                        <div class="row-table table-responsive">
                            <table class="table table-bordered my-account table-condensed" id="ofi-json">
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
            </div>

            <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Project Work Pack
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="pp-container" class="panel-body" style="display:none;">
                    <?php if(empty($pp_results)): ?>
                        <p>There are no Project Work Pack created. <a href="<?php echo base_url('project-plan/create'); ?>">Create One</a></p>
                    <?php else: ?>
                        <div class="row-table table-responsive">
                            <table class="table table-bordered my-account table-condensed" id="project-plan-json">
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
            </div>

            <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Technical Bulletin
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="tb-container" class="panel-body" style="display:none;">
                    <?php if(empty($tb_results)): ?>
                        <p>There are no Technical Bulletin created. <a href="<?php echo base_url('technical-bulletin/create'); ?>">Create One</a></p>
                    <?php else: ?>
                        <div class="row-table table-responsive">
                            <table class="table table-bordered my-account table-condensed" id="technical-bulletin-json">
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
            </div>

            <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Witness Statement
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="ws-container" class="panel-body" style="display:none;">
                    <?php if(empty($ws_results)): ?>
                        <p>There are no Witness Statement created. <a href="<?php echo base_url('witness-statement/create'); ?>">Create One</a></p>
                    <?php else: ?>
                        <div class="row-table table-responsive">
                            <table class="table table-bordered my-account table-condensed" id="witness-statement-json">
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
            </div>

            <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Technical Query
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="tq-container" class="panel-body" style="display:none;">
                    <?php if(empty($tq_results)): ?>
                        <p>There are no Technical Query created. <a href="<?php echo base_url('technical-query/create'); ?>">Create One</a></p>
                    <?php else: ?>
                        <div class="row-table table-responsive">
                            <table class="table table-bordered my-account table-condensed" id="technical-query-json">
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
            </div>

            <div class="panel panel-inverse collapsed">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        MCDR
                    </h2>
                    <div class="panel-options">
                        <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                    </div>
                </div>
                <div id="mcdr-container" class="panel-body" style="display:none;">
                    <?php if(empty($mcdr_results)): ?>
                        <p>There are no MCDR created. <a href="<?php echo base_url('mcdr/create'); ?>">Create One</a></p>
                    <?php else: ?>
                        <div class="row-table table-responsive">
                            <table class="table table-bordered my-account table-condensed" id="mcdr-json">
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
            </div>
        </div>   

        </div>  


        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Document Followers</h4>
                        <div class="panel-options">
                            <a class="refresh-table" href="#">
                                <i class="fa fa-lg fa-refresh"></i>
                            </a>
                            <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="document-followers" class="table-responsive">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h4 class="panel-title">Your Followers</h4>
                        <div class="panel-options">
                            <a class="refresh-table" href="#">
                                <i class="fa fa-lg fa-refresh"></i>
                            </a>
                            <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div id="user-followers" class="table-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</div>