<section id="main-content">
  <div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="dashboard-menu panel panel-primary maintenance">
              <h3 class="panel-heading-title" style="height: 50px;">Reliability &amp; Maintenance</h3>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                          <a href="<?php echo base_url('technical-bulletin/create'); ?>" class="menu btn btn-default  border-blue" role="button" data-toggle="tooltip" data-placement="top" title="Used to share information, alerts and warnings with other users"><span class="glyphicon glyphicon-pushpin"></span> <br/>Technical</br> Bulletin</a>
                          <a href="<?php echo base_url('technical-query/create'); ?>" class="menu btn btn-default  border-light-red" role="button" data-toggle="tooltip" data-placement="top" title="Used to request advice or clarification"><span class="glyphicon glyphicon-repeat"></span><br/>Technical</br> Query</a>
                          <a href="<?php echo base_url('ofi/create'); ?>" class="menu btn btn-default  border-light-blue" role="button" data-toggle="tooltip" data-placement="top" title="Used for a requesting investment and change"><span class="glyphicon glyphicon-road"></span> <br/>Oppurtunity for<br>Improvement</a>
                          <a href="<?php echo base_url('basic-decf/create'); ?>" class="menu btn btn-default  border-purple" role="button" data-toggle="tooltip" data-placement="top" title="Used for Simple Failure Analysis"><span class="glyphicon glyphicon-file"></span> </br>Defect<br>Elimination</a>
                          <!-- <a href="<?php echo base_url('case-file/create'); ?>" class="menu btn btn-default  border-light-yellow" role="button" data-toggle="tooltip" data-placement="top" title="Used for Complex Failure Analysis"><span class="glyphicon glyphicon-file"></span> </br>LEVEL 2<br>Forensic DECF </a> -->
                          <a href="<?php echo base_url('project-plan/create'); ?>" class="menu btn btn-default  border-light-violet" role="button" data-toggle="tooltip" data-placement="top" title="Used for collecting the full details of a project "><span class="glyphicon glyphicon-flag"></span> <br/>Project<br>Plan</a>
                          <a href="<?php echo base_url('witness-statement/create'); ?>" class="menu btn btn-default  border-light-green" role="button" data-toggle="tooltip" data-placement="top" title="Used to help a witness collect and record the details of an important event"><span class="glyphicon glyphicon-eye-open"></span><br/>Witness<br>Statement</a>
                          <a href="<?php echo base_url('weekly-plan'); ?>" class="menu btn btn-default border-orange" role="button"><span class="glyphicon glyphicon-calendar"></span> <br/>Weekly</br>Plan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dashboard-menu panel panel-primary create-dashboard">
              <h3 class="panel-heading-title">Quality Management</h3>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                          <a href="<?php echo base_url('criticality-analysis/criticality-criteria'); ?>" class="menu btn btn-default  border-light-yellow" role="button" data-toggle="tooltip" data-placement="top" title=""><span class="glyphicon glyphicon-bookmark"></span> </br>Criticality</br> Criteria</a>
                          <a href="<?php echo base_url('criticality-analysis'); ?>" class="menu btn btn-default  border-light-violet" role="button"><span class="glyphicon glyphicon-bullhorn"></span> <br/>Criticality</br>Analysis</a>
                          <a href="<?php echo base_url('criticality-analysis/spare-analysis'); ?>" class="menu btn btn-default  border-light-orange" role="button"><span class="glyphicon glyphicon-cog"></span> <br/>Spares</br>Analysis</a>
                          <a href="<?php echo base_url('report/handover-report'); ?>" class="menu btn btn-default  border-light-grey" role="button" data-toggle="tooltip" data-placement="top" title="Used to share the current status with others and remind you of the situation when you left  "><span class="glyphicon glyphicon-list-alt"></span> <br>Department<br/>Handover</br>Report</a>
                          <a href="<?php echo base_url('compliance-report/create'); ?>" class="menu btn btn-default  border-light-purple" role="button" data-toggle="tooltip" data-placement="top" title="Used to share information about a failure to comply with governance"><span class="glyphicon glyphicon-lock"></span>  <br/>Non</br>Compliance</br>Report</a>
                          <a href="<?php echo base_url('performance-report/create'); ?>" class="menu btn btn-default  border-blue" role="button" data-toggle="tooltip" data-placement="top" title="Used to compile the maintenance performance report on business critical risks"><span class="glyphicon glyphicon-signal"></span>  <br/>Performance</br>Report</a>
                          <a href="<?php echo base_url('master-data'); ?>" class="menu btn btn-default  border-red" role="button" data-toggle="tooltip" data-placement="top" title=""><span class="glyphicon glyphicon-flag"></span> <br/>Master </br>Data</a>
                          <a href="<?php echo base_url('hired-equipment'); ?>" class="menu btn btn-default  border-light-blue" role="button" data-toggle="tooltip" data-placement="top" title=""><span class="glyphicon glyphicon-tasks"></span><br/>Hired</br>Equipment<br>Report</a>
                          <a href="<?php echo base_url('history-availability'); ?>" class="menu btn btn-default  border-light-green" role="button" data-toggle="tooltip" data-placement="top" title=""><span class="glyphicon glyphicon-hdd"></span><br/>History of</br>Availability<br>Report</a>
                          
                          
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="panel panel-primary dashboard-menu">
              <h3 class="panel-heading-title">Recent Document <a class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="" href="<?php echo base_url('window-status'); ?>" data-original-title="Document Status" style="margin-left: 160px;"><span class="glyphicon glyphicon-th-large"></span>&nbsp; Document Status</a></h3>
              <div id="recent-documents">
                <div class="panel-body">
                    <div class="row"> 
                        <div class="col-xs-12">
                          <div class="table-responsive">
                            <table class="table">
                               <table class="table table-bordered my-account">
                                <thead>
                                  <tr>
                                    <th class="id">ID</th>
                                    <th class="code">Code</th>
                                    <th class="case-file">Document Name</th>
                                    <th class="document-action"><span class="glyphicon glyphicon-cog"></span> Actions</th>
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
                                       <td class="text-center">
                                        <a class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="View" href="<?php echo $document_link; ?>"><span class="glyphicon glyphicon-list"></span></a>
                                        </td>
                                    </tr>
                                  <?php endforeach; ?>
                                  
                                </tbody>
                              </table>
                          </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
             <div id="dashboard-bottom" class="panel panel-primary dashboard-menu">
              <h3 class="panel-heading-title">Performance Dashboard</h3>
                <div class="panel-body" style="padding-bottom:2px;">
                    <div class="row"> 
                        <div class="col-xs-12">
                          <a href="<?php echo base_url('current-availability'); ?>" class="menu btn btn-default  border-grey" role="button"><span class="glyphicon glyphicon-stats"></span> <br/>Current </br>Availability</a>
                          <a href="<?php echo base_url('criticality-analysis/history-availability'); ?>" class="menu btn btn-default  border-grey" role="button"><span class="glyphicon glyphicon-folder-close"></span> <br/>History of </br>Availability</a>
                          <a href="<?php echo base_url('criticality-analysis/compliance-dashboard'); ?>" class="menu btn btn-default  border-grey" role="button"><span class="glyphicon glyphicon-filter"></span><br>Compliance</a>
                          <a href="<?php echo base_url('criticality-analysis/data-input'); ?>" class="menu btn btn-fill-green border-grey" role="button"><span class="glyphicon glyphicon-refresh"></span><br>Equipment</br>Status<br>Update</a>
                          <a href="<?php echo base_url('criticality-analysis/single-index-of-failing-equipment'); ?>" class="menu btn btn-fill-red  border-grey" role="button" data-toggle="tooltip" data-placement="top" title="Single Index of Failing Equipment"><span class="glyphicon glyphicon-exclamation-sign"></span></br>Single</br>Index of Failing </br>Equipment</a>
                          <a href="<?php echo base_url('criticality-analysis/failure-rate'); ?>" class="menu btn btn-default  border-grey" role="button"><img src="../images/lambda.png" width="30" height="30"><br/>Failure</br>Rate</a>
                          <a href="<?php echo base_url('erp'); ?>" class="menu btn btn-default  border-grey" role="button"><span class="glyphicon glyphicon-wrench"></span> <br/>Equipment</br> Repairs</a>
                          <a href="<?php echo base_url('action-tracker'); ?>" class="menu btn btn-default  border-grey" role="button"><span class="glyphicon glyphicon-random"></span> <br/>Master<br/>Action</br>Tracker</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
<?php if($role == 'siteadmin'){ ?>
<section id="main-content">
  <div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="dashboard-menu panel panel-primary">
              <h3 class="panel-heading-title">Welcome Admin</h3>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12">
                          <a href="<?php echo base_url('menu-admin'); ?>" class="menu btn btn-default  border-blue" role="button" data-toggle="tooltip" data-placement="top" title="Used to share information, alerts and warnings with other users"><span class="glyphicon glyphicon-list"></span> <br/>Menu </br> Admin</a>
                          <a href="<?php echo base_url('menu-category-admin'); ?>" class="menu btn btn-default  border-light-red" role="button" data-toggle="tooltip" data-placement="top" title="Used to request advice or clarification"><span class="glyphicon glyphicon-list-alt"></span><br/>Menu</br> Category</br>Admin</a>
                          <a href="<?php echo base_url('menu-subcategory-admin'); ?>" class="menu btn btn-default  border-purple" role="button" data-toggle="tooltip" data-placement="top" title="Used for Simple Failure Analysis"><span class="glyphicon glyphicon-file"></span> </br>Menu<br/>Subcategory</br> Admin</a>
                          <a href="<?php echo base_url('menu-deep-subcategory-admin'); ?>" class="menu btn btn-default  border-light-yellow" role="button" data-toggle="tooltip" data-placement="top" title="Used for Complex Failure Analysis"><span class="glyphicon glyphicon-th"></span> </br>Menu <br/>Deep</br> Subcategory</a>
                          <a href="<?php echo base_url('user/admin'); ?>" class="menu btn btn-default  border-light-blue" role="button" data-toggle="tooltip" data-placement="top" title="Used for a requesting investment and change"><span class="glyphicon glyphicon-user"></span> <br/>User</br>Admin</a>
                          <a href="<?php echo base_url('criticality-analysis/data-input'); ?>" class="menu btn btn-default  border-light-purple" role="button" data-toggle="tooltip" data-placement="top" title="Used to share information about a failure to comply with governance"><span class="glyphicon glyphicon-backward"></span>  <br/>Criticality</br>Analysis</br>History</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
<?php } ?>
</section>