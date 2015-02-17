<div class="row">
    <?php if($password_key == 'first-time'): ?>
        <div class="modal fade" id="first-time-login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div id="completion-check-modal" class="modal-dialog modal-sm">
            <div id="change-password-form" class="modal-content">
            <?php echo form_open(); ?>
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">It's your first time to login</h4>
              </div>
              <div class="modal-body">
                <p>You can change your default password to a much secure login.</p>
                <div class="form-group">
                    <label for="password" class="control-label">New Password</label>
                    <input class="form-control" type="password" name="password" value="" required />


                </div>

                <div class="form-group">    
                    <label for="confirm_password" class="control-label">Confirm Password</label>
                    <input class="form-control" type="password" name="confirm_password" value="" required />
                </div>

                <div id="alert-password" class="alert alert-danger alert-dismissible hidden" role="alert">
                  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  Password does not match.
                </div>
                
                
              </div>
              <div class="modal-footer">
                <button id="first-time-change-password" type="submit" class="btn btn-success go-yes"> Save</button>
              </div>
              <?php echo form_close(); ?>
            </div>

          </div>
        </div>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading" style="margin-bottom: 20px;">
                <h4 class="panel-title">Reliability &amp; Maintenance</h4>
                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6 col-sm-4 metro-padding">
                     <a href="<?php echo base_url('technical-bulletin/create'); ?>" class="create-document" data-title="Technical Bulletin" data-name="Doc Title" data-document-type="technical-bulletin">
                        <div class="panel panel-metric panel-metric-sm">
                            <div class="panel-body panel-body-primary">
                                <div class="metric-content metric-icon">
                                    <div class="value count-value"><?php echo $tb_count; ?></div>
                                    <!-- <div class="icon">
                                        <i class="fa fa-thumb-tack"></i>
                                    </div> -->
                                    <header>
                                        <h5 class="thin">Techinical Bulletin</h5>
                                    </header>
                                </div>
                            </div>
                        </div>      
                    </a>
                </div>
                <div class="col-xs-6 col-sm-4 metro-padding">
                 <a href="<?php echo base_url('technical-query/create'); ?>" class="create-document" data-title="Technical Query" data-name="Doc Title" data-document-type="technical-query">
                    <div class="panel panel-metric panel-metric-sm">
                        <div class="panel-body panel-body-success">
                            <div class="metric-content metric-icon">
                                <div class="value count-value"><?php echo $tq_count; ?></div>
                                <!-- <div class="icon">
                                    <i class="fa fa-refresh"></i>
                                </div> -->
                                <header>
                                    <h5 class="thin">Technical Query</h5>
                                </header>
                            </div>
                        </div>
                    </div> 
                </a>     
            </div>
            <div class="col-xs-6 col-sm-4 metro-padding">
            	<a href="<?php echo base_url('ofi/create'); ?>" class="create-document" data-title="Opportunity for Improvement" data-name="Name" data-document-type="ofi">
                    <div class="panel panel-metric panel-metric-sm">
                        <div class="panel-body panel-body-inverse">
                            <div class="metric-content metric-icon">
                                <div class="value count-value"><?php echo $ofi_count; ?></div>
                                <!-- <div class="icon">
                                    <i class="fa fa-road"></i>
                                </div> -->
                                <header>
                                    <h5 class="thin">Opportunity for Improvement</h5>
                                </header>
                            </div>
                        </div>
                    </div>   
                </a>   
            </div>
            <div class="col-xs-6 col-sm-4 metro-padding">
             <a href="<?php echo base_url('basic-decf/create'); ?>" class="create-document" data-title="Defect Elimination" data-name="Casefile Name" data-document-type="basic-decf">
                <div class="panel panel-metric panel-metric-sm">
                    <div class="panel-body panel-body-inverse">
                        <div class="metric-content metric-icon">
                            <div class="value count-value"><?php echo $basic_decf_count; ?></div>
                            <!-- <div class="icon">
                                <i class="fa fa-file"></i>
                            </div> -->
                            <header>
                                <h5 class="thin">Defect Elimination</h5>
                            </header>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xs-6 col-sm-4 metro-padding">
         <a href="<?php echo base_url('project-plan/create'); ?>" class="create-document" data-title="Project Work Pack" data-name="Project Name" data-document-type="project-plan">
            <div class="panel panel-metric panel-metric-sm">
                <div class="panel-body panel-body-danger">
                    <div class="metric-content metric-icon">
                        <div class="value count-value"><?php echo $pp_count; ?></div>
                        <!-- <div class="icon">
                            <i class="fa fa-flag"></i>
                        </div> -->
                        <header>
                            <h5 class="thin">Project Work Pack</h5>
                        </header>
                    </div>
                </div>
            </div>
        </a>      
    </div>
    <div class="col-xs-6 col-sm-4">
     <a href="<?php echo base_url('reliability-maintenance/project-tracker'); ?>" class="">
        <div class="panel panel-metric panel-metric-sm">
            <div class="panel-body panel-body-primary">
                <div class="metric-content metric-icon">
                    <div class="value count-value"><?php //echo $ws_count; ?></div>
                    <!-- <div class="icon">
                        <i class="fa fa-eye"></i>
                    </div> -->
                    <header>
                        <h5 class="thin">Project Tracker</h5>
                    </header>
                </div>
            </div>
        </div>
    </a>      
</div>
<div class="col-xs-12 col-sm-4">
 <a href="<?php echo base_url('weekly-plan'); ?>" class="">
    <div class="panel panel-metric panel-metric-sm">
        <div class="panel-body panel-body-success">
            <div class="metric-content metric-icon">
                <div class="value count-value">
                </div>
                <!-- <div class="icon">
                    <i class="fa fa-calendar"></i>
                </div> -->
                <header>
                    <h5 class="thin">Weekly Plan</h5>
                </header>
            </div>
        </div>
    </div>
</a>      
</div>

<div class="col-xs-12 col-sm-4">
 <a href="<?php echo base_url('reliability-maintenance/condition-monitoring'); ?>" class="">
    <div class="panel panel-metric panel-metric-sm">
        <div class="panel-body panel-body-primary">
            <div class="metric-content metric-icon">
                <div class="value">
                </div>
                <!-- <div class="icon">
                    <i class="fa fa-calendar"></i>
                </div> -->
                <header>
                    <h5 class="thin">Condition Monitoring</h5>
                </header>
            </div>
        </div>
    </div>
</a>      
</div>

<div class="col-xs-12 col-sm-4">
 <a href="<?php echo base_url('criticality-analysis/history-availability'); ?>" class="">
    <div class="panel panel-metric panel-metric-sm">
        <div class="panel-body panel-body-danger">
            <div class="metric-content metric-icon">
                <div class="value">
                </div>
                <!-- <div class="icon">
                    <i class="fa fa-calendar"></i>
                </div> -->
                <header>
                    <h5 class="thin">History of Availability</h5>
                </header>
            </div>
        </div>
    </div>
</a>      
</div>

</div>
</div>
</div>
</div>
<!-- <div class="col-xs-12 col-sm-6">
    <div id="activity-panel" class="panel panel-info">
        <div class="panel-heading">
            <h4 class="panel-title">Recent Documents</h4>

            <div class="panel-options">
                <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th width="10%">ID</th>
                        <th width="20%">Code</th>
                        <th width="50%">Document Name</th>
                        <th width="20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                 <?php 
                 foreach($recent_documents as $document): 
                   $id = $document['id'];
               $code = $document['code'];
               $name = $document['name'];
               $document_type = $document['document_type'];

               if(empty($name) || $name == ''){
                 $name = '[unnamed]';
             }

             $document_link = base_url($document_type.'/view/'.$id);
             ?>
             <tr>
                 <td><?php echo $id; ?></td>
                 <td><?php echo $code; ?></td>
                 <td><?php echo truncate($name, $length = 15, $dots = "..."); ?></td>
                 <td class="valign-middle">
                    <a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="View" href="<?php echo $document_link; ?>"><i class="fa fa-reorder"></i></a>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>
</div>
        </div>
</div>
</div> -->
    <!-- <div class="col-xs-12 col-sm-6">
        <div id="activity-panel" class="panel panel-info">
            <div class="panel-heading">
                <h4 class="panel-title">Top Rated Bulletin</h4>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                </div>
            </div>

            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="20%">Code</th>
                                <th width="50%">Name</th>
                                <th width="10%">Likes</th>
                                <th width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($top_rated_documents as $top_rated): 
                            $id = $top_rated['id'];
                            $code = $top_rated['code'];
                            $name = $top_rated['name'];
                            $likes = $top_rated['likes'];

                            if(empty($name) || $name == ''){
                                $name = '[unnamed]';
                            }

                            $document_link = base_url('technical-bulletin/view/'.$id);
                            ?>
                            <tr>
                                <td><?php echo $code; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $likes; ?></td>
                                <td class="valign-middle">
                                    <a href="<?php echo $document_link; ?>" class="btn btn-success"><i class="fa fa-reorder"></i></a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> -->

<div class="col-xs-12 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading" style="margin-bottom: 20px;">
                <h4 class="panel-title">Performance Dashboard</h4>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6 col-sm-4">
                        <a href="<?php echo base_url('performance-dashboard/current-availability'); ?>">
                            <div class="panel panel-metric panel-metric-sm">
                                <div class="panel-body panel-body-primary">
                                    <div class="metric-content metric-icon">
                                        <div class="value">   </div>
                                        <!-- <div class="icon">
                                            <i class="fa fa-barcode"></i>
                                        </div> -->
                                        <header>
                                            <h5 class="thin">Current Availability</h5>
                                        </header>
                                    </div>
                                </div>
                            </div>
                        </a>      
                    </div>
                    
                <div class="col-xs-6 col-sm-4">
                    <a href="<?php echo base_url('criticality-analysis/compliance-dashboard'); ?>">
                     <div class="panel panel-metric panel-metric-sm">
                        <div class="panel-body panel-body-success">
                            <div class="metric-content metric-icon">
                                <div class="value count-value">   </div>
                                <!-- <div class="icon">
                                    <i class="fa fa-thumbs-up"></i>
                                </div> -->
                                <header>
                                    <h5 class="thin">Compliance</h5>
                                </header>
                            </div>
                        </div>
                    </div>  
                </a>    
            </div>
            <div class="col-xs-6 col-sm-4">
                <a href="<?php echo base_url('criticality-analysis/data-input'); ?>">
                 <div class="panel panel-metric panel-metric-sm">
                    <div class="panel-body panel-body-inverse">
                        <div class="metric-content metric-icon">
                            <div class="value">   </div>
                            <!-- <div class="icon">
                                <i class="fa fa-refresh"></i>
                            </div> -->
                            <header>
                                <h5 class="thin">Equipment Status Update</h5>
                            </header>
                        </div>
                    </div>
                </div> 
            </a>     
        </div>
        <div class="col-xs-6 col-sm-4">
            <a href="<?php echo base_url('criticality-analysis/single-index-of-failing-equipment'); ?>">
             <div class="panel panel-metric panel-metric-sm">
                <div class="panel-body panel-body-danger">
                    <div class="metric-content metric-icon">
                        <div class="value">   </div>
                        <div class="icon">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div>
                        <header>
                            <h5 class="thin">Single Index of Failing <br>Equipment</h5>
                        </header>
                    </div>
                </div>
            </div>  
        </a>    
    </div>
    <div class="col-xs-6 col-sm-4">
    <a href="<?php echo base_url('action-tracker'); ?>">
     <div class="panel panel-metric panel-metric-sm">
        <div class="panel-body panel-body-inverse">
            <div class="metric-content metric-icon">

                <!-- <div class="icon">
                    <i class="fa fa-random"></i>
                </div> -->
                <header>
                    <h5 class="thin">Hub</h5>
                </header>
            </div>
        </div>
    </div>  
</a>    
</div>
    <div class="col-xs-6 col-sm-4">
        <a href="<?php echo base_url('criticality-analysis/failure-rate'); ?>">
         <div class="panel panel-metric panel-metric-sm">
            <div class="panel-body panel-body-danger">
                <div class="metric-content metric-icon">
                    <div class="value">   </div>
                    <!-- <div class="icon">
                        <i class="fa fa-exclamation-circle"></i>
                    </div> -->
                    <header>
                        <h5 class="thin">Failure Rate</h5>
                    </header>
                </div>
            </div>
        </div>      
    </a>
</div>


<div class="col-xs-6 col-sm-4">
    <a href="<?php echo base_url('performance-dashboard/my-actions'); ?>">
     <div class="panel panel-metric panel-metric-sm">
        <div class="panel-body panel-body-success">
            <div class="metric-content metric-icon">
                <div class="value">   </div>
                <!-- <div class="icon">
                    <i class="fa fa-wrench"></i>
                </div> -->
                <header>
                    <h5 class="thin">My Actions</h5>
                </header>
            </div>
        </div>
    </div> 
</a>     
</div>

<div class="col-xs-6 col-sm-4">
    <a href="<?php echo base_url('performance-dashboard/priority-actions'); ?>">
     <div class="panel panel-metric panel-metric-sm">
        <div class="panel-body panel-body-primary">
            <div class="metric-content metric-icon">
                <div class="value">   </div>
                <!-- <div class="icon">
                    <i class="fa fa-wrench"></i>
                </div> -->
                <header>
                    <h5 class="thin">Priority Actions</h5>
                </header>
            </div>
        </div>
    </div> 
</a>     
</div>

<div class="col-xs-6 col-sm-4">
    <a href="<?php echo base_url('performance-dashboard/risk-register'); ?>">
     <div class="panel panel-metric panel-metric-sm">
        <div class="panel-body panel-body-success">
            <div class="metric-content metric-icon">
                <div class="value">   </div>
                <!-- <div class="icon">
                    <i class="fa fa-wrench"></i>
                </div> -->
                <header>
                    <h5 class="thin">Risk Register</h5>
                </header>
            </div>
        </div>
    </div> 
</a>     
</div>

</div>
</div>
</div>
</div>



<div class="col-xs-12 col-sm-6">
    <div class="panel panel-info">
        <div class="panel-heading" style="margin-bottom: 20px;">
            <h4 class="panel-title">Quality Management</h4>

            <div class="panel-options">
                <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-6 col-sm-4">
                    <a href="<?php echo base_url('criticality-analysis/criticality-criteria'); ?>">
                        <div class="panel panel-metric panel-metric-sm">
                            <div class="panel-body panel-body-primary">
                                <div class="metric-content metric-icon">
                                    <div class="value">   </div>
                                    <!-- <div class="icon">
                                        <i class="fa fa-bookmark"></i>
                                    </div> -->
                                    <header>
                                        <h5 class="thin">Criticality Criteria</h5>
                                    </header>
                                </div>
                            </div>
                        </div>
                    </a>      
                </div>
                <div class="col-xs-6 col-sm-4">
                    <a href="<?php echo base_url('criticality-analysis'); ?>">
                     <div class="panel panel-metric panel-metric-sm">
                        <div class="panel-body panel-body-success">
                            <div class="metric-content metric-icon">
                                <div class="value count-value">   </div>
                                <!-- <div class="icon">
                                    <i class="fa fa-bullhorn"></i>
                                </div> -->
                                <header>
                                    <h5 class="thin">Criticality Analysis</h5>
                                </header>
                            </div>
                        </div>
                    </div>   
                </a>   
            </div>
            <div class="col-xs-6 col-sm-4">
                <a href="<?php echo base_url('criticality-analysis/spare-analysis'); ?>">
                 <div class="panel panel-metric panel-metric-sm">
                    <div class="panel-body panel-body-inverse">
                        <div class="metric-content metric-icon">
                            <div class="value">   </div>
                            <!-- <div class="icon">
                                <i class="fa fa-cog"></i>
                            </div> -->
                            <header>
                                <h5 class="thin">Spares Analysis</h5>
                            </header>
                        </div>
                    </div>
                </div>  
            </a>    
        </div>
        <div class="col-xs-6 col-sm-4">
            <a href="<?php echo base_url('report//handover-report'); ?>">
             <div class="panel panel-metric panel-metric-sm">
                <div class="panel-body panel-body-danger">
                    <div class="metric-content metric-icon">
                        <div class="value">   </div>
                        <!-- <div class="icon">
                            <i class="fa fa-list"></i>
                        </div> -->
                        <header>
                            <h5 class="thin">Department Handover Report</h5>
                        </header>
                    </div>
                </div>
            </div> 
        </a>     
    </div>
    <div class="col-xs-6 col-sm-4">
    <a href="<?php echo base_url('quality-management/performance-report'); ?>">
     <div class="panel panel-metric panel-metric-sm">
        <div class="panel-body panel-body-primary">
            <div class="metric-content metric-icon">
                <div class="value">   </div>
                <!-- <div class="icon">
                    <i class="fa fa-signal"></i>
                </div> -->
                <header>
                    <h5 class="thin">Performance Report</h5>
                </header>
            </div>
        </div>
    </div>      
</a>
</div>
    <div class="col-xs-6 col-sm-4">
        <a href="<?php echo base_url('quality-management/non-compliance-report'); ?>">
         <div class="panel panel-metric panel-metric-sm">
            <div class="panel-body panel-body-danger">
                <div class="metric-content metric-icon">
                    <div class="value">   </div>
                    <!-- <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div> -->
                    <header>
                        <h5 class="thin">Non Compliance<br> Report</h5>
                    </header>
                </div>
            </div>
        </div>  
    </a>    
</div>


<div class="col-xs-6 col-sm-4">
    <a href="<?php echo base_url('quality-management/temporary-equipment'); ?>">
     <div class="panel panel-metric panel-metric-sm">
        <div class="panel-body panel-body-inverse">
            <div class="metric-content metric-icon">

                <!-- <div class="icon">
                    <i class="fa fa-tasks"></i>
                </div> -->
                <header>
                    <h5 class="thin">Temporary Equipment </h5>
                </header>
            </div>
        </div>
    </div>  
</a>    
</div>
<div class="col-xs-6 col-sm-4">
    <a href="<?php echo base_url('quality-management/audit-report'); ?>">
     <div class="panel panel-metric panel-metric-sm">
        <div class="panel-body panel-body-success">
            <div class="metric-content metric-icon">
                <div class="value">   </div>
                <!-- <div class="icon">
                    <i class="fa fa-clock-o"></i>
                </div> -->
                <header>
                    <h5 class="thin">Audit Report </h5>
                </header>
            </div>
        </div>
    </div>  
</a>    
</div>
<div class="col-xs-6 col-sm-4">
    <a href="<?php echo base_url('quality-management/master-data'); ?>">
     <div class="panel panel-metric panel-metric-sm">
        <div class="panel-body panel-body-inverse">
            <div class="metric-content metric-icon">
                <div class="value">   </div>
                <!-- <div class="icon">
                    <i class="fa fa-flag"></i>
                </div> -->
                <header>
                    <h5 class="thin">Master Data</h5>
                </header>
            </div>
        </div>
    </div> 
</a>     
</div>
</div>
</div>
</div>
</div>


<div class="col-xs-12 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading" style="margin-bottom: 20px;">
                <h4 class="panel-title">Integrity Management</h4>

                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-minus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6 col-sm-4">
                        <a href="<?php echo base_url('integrity-management/mcdr'); ?>">
                            <div class="panel panel-metric panel-metric-sm">
                                <div class="panel-body panel-body-primary">
                                    <div class="metric-content metric-icon">
                                        <div class="value">   </div>
                                        <!-- <div class="icon">
                                            <i class="fa fa-barcode"></i>
                                        </div> -->
                                        <header>
                                            <h5 class="thin"> MCDR Dashboard </h5>
                                        </header>
                                    </div>
                                </div>
                            </div>
                        </a>      
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <a href="<?php echo base_url('integrity-management/temporary-repair-register'); ?>">
                         <div class="panel panel-metric panel-metric-sm">
                            <div class="panel-body panel-body-success">
                                <div class="metric-content metric-icon">
                                    <div class="value">   </div>
                                    <!-- <div class="icon">
                                        <i class="fa fa-folder"></i>
                                    </div> -->
                                    <header>
                                        <h5 class="thin">Temporary Repair Register </h5>
                                    </header>
                                </div>
                            </div>
                        </div>   
                    </a>   
                </div>
                <div class="col-xs-6 col-sm-4">
                    <a href="<?php echo base_url('integrity-management/temporary-refuge-and-loss-control'); ?>">
                     <div class="panel panel-metric panel-metric-sm">
                        <div class="panel-body panel-body-inverse">
                            <div class="metric-content metric-icon">
                                <div class="value count-value">   </div>
                                <!-- <div class="icon">
                                    <i class="fa fa-thumbs-up"></i>
                                </div> -->
                                <header>
                                    <h5 class="thin">Temporary Refuge &amp; Loss Control</h5>
                                </header>
                            </div>
                        </div>
                    </div>  
                </a>    
            </div>
            <div class="col-xs-6 col-sm-4">
                <a href="<?php echo base_url('integrity-management/psv'); ?>">
                 <div class="panel panel-metric panel-metric-sm">
                    <div class="panel-body panel-body-inverse">
                        <div class="metric-content metric-icon">
                            <div class="value">   </div>
                            <!-- <div class="icon">
                                <i class="fa fa-refresh"></i>
                            </div> -->
                            <header>
                                <h5 class="thin">PSV and Pressure Vessels </h5>
                            </header>
                        </div>
                    </div>
                </div> 
            </a>     
        </div>
        <div class="col-xs-6 col-sm-4">
            <a href="<?php echo base_url('integrity-management/certification'); ?>">
             <div class="panel panel-metric panel-metric-sm">
                <div class="panel-body panel-body-danger">
                    <div class="metric-content metric-icon">
                        <div class="value">   </div>
                        <!-- <div class="icon">
                            <i class="fa fa-exclamation-triangle"></i>
                        </div> -->
                        <header>
                            <h5 class="thin"> Certification</h5>
                        </header>
                    </div>
                </div>
            </div>  
        </a>    
    </div>
    <div class="col-xs-6 col-sm-4">
        <a href="<?php echo base_url('integrity-management/flexible-hoses'); ?>">
         <div class="panel panel-metric panel-metric-sm">
            <div class="panel-body panel-body-primary">
                <div class="metric-content metric-icon">
                    <div class="value">   </div>
                    <!-- <div class="icon">
                        <i class="fa fa-exclamation-circle"></i>
                    </div> -->
                    <header>
                        <h5 class="thin">Flexible hoses</h5>
                    </header>
                </div>
            </div>
        </div>      
    </a>
</div>

<div class="col-xs-6 col-sm-4">
    <a href="<?php echo base_url('integrity-management/atex'); ?>">
     <div class="panel panel-metric panel-metric-sm">
        <div class="panel-body panel-body-inverse">
            <div class="metric-content metric-icon">

                <!-- <div class="icon">
                    <i class="fa fa-random"></i>
                </div> -->
                <header>
                    <h5 class="thin">ATEX </h5>
                </header>
            </div>
        </div>
    </div>  
</a>    
</div>

 <div class="col-xs-6 col-sm-4">
        <a href="<?php echo base_url('integrity-management/remedial-action-register'); ?>">
         <div class="panel panel-metric panel-metric-sm">
            <div class="panel-body panel-body-success">
                <div class="metric-content metric-icon">
                    <div class="value">   </div>
                    <!-- <div class="icon">
                        <i class="fa fa-exclamation-circle"></i>
                    </div> -->
                    <header>
                        <h5 class="thin">Remedial Action Register </h5>
                    </header>
                </div>
            </div>
        </div>      
    </a>
</div>

<div class="col-xs-6 col-sm-4">
    <a href="<?php echo base_url('integrity-management/management-of-change'); ?>">
         <div class="panel panel-metric panel-metric-sm">
            <div class="panel-body panel-body-success">
                <div class="metric-content metric-icon">
                    <div class="value">   </div>
                    <!-- <div class="icon">
                        <i class="fa fa-wrench"></i>
                    </div> -->
                    <header>
                        <h5 class="thin">Management of Change </h5>
                    </header>
                </div>
            </div>
        </div> 
    </a>     
</div>

</div>


</div>
</div>
</div>

</div>

