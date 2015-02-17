<?php
  
  if($session_site_role != 'siteadmin'){
    $create_display = 'hidden';
  }else{
    $create_display = '';
  }

?>
<div class="panel panel-default">
  <?php
            $attributes = array( 'role'=>'form' , 'id' => 'criticality-criteria-form', 'class' => 'form-horizontal form-group');
            echo form_open('', $attributes);
            echo form_hidden('current_user_id', $current_user_id);
            echo form_close();
          ?>
  <div class="panel-heading">
    <h4 class="panel-title"></h4>
    
  </div>

  <div id="criticality-criteria" class="panel-body">
                        
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="row-table table-responsive">
                                      <table id="criticality-redundancy" class="criticality-criteria table table-bordered criteria-table sticky-thead">
                                        <thead>
                                          <tr>
                                            <th class="sub-title"></th>
                                            <th class="value">Criticality</th>
                                            <th class="option-name">Selection</th>
                                            <th class="description">Reliability / Redundancy degree definition</th>
                                            <th class="action">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                      </table>
                                  </div>
                                </div>
                              </div>
                                
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="row-table table-responsive">
                                    <table id="criticality-safety" class="criticality-criteria table table-bordered criteria-table sticky-thead">
                                      <thead>
                                        <tr>
                                          <th class="sub-title"></th>
                                          <th class="value">Rating</th>
                                          <th class="option-name">Selection</th>
                                          <th class="description">Consequences</th>
                                          <th class="action">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>    
                                                                  
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="row-table table-responsive">
                                    <table id="criticality-environment" class="criticality-criteria table table-bordered criteria-table sticky-thead">
                                      <thead>
                                        <tr>
                                          <th class="sub-title"></th>
                                          <th class="value">Rating</th>
                                          <th class="option-name">Selection</th>
                                          <th class="description">Consequences</th>
                                          <th class="action">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                                  
                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="row-table table-responsive">
                                    <table id="criticality-operation" class="criticality-criteria table table-bordered criteria-table sticky-thead">
                                      <thead>
                                        <tr>
                                          <th class="sub-title"></th>
                                          <th class="value">Rating</th>
                                          <th class="option-name">Selection</th>
                                          <th class="description">Consequences</th>
                                          <th class="action">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>                           

                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="row-table table-responsive">
                                    <table id="criticality-reinstatement" class="criticality-criteria table table-bordered criteria-table sticky-thead">
                                      <thead>
                                        <tr>
                                          <th class="sub-title"></th>
                                          <th class="value">Rating</th>
                                          <th class="option-name">Selection</th>
                                          <th class="description">Consequences</th>
                                          <th class="action">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>   

                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="row-table table-responsive">
                                    <table id="criticality-status" class="criticality-criteria table table-bordered criteria-table sticky-thead">
                                      <thead>
                                        <tr>
                                          <th class="sub-title"></th>
                                          <th class="value">Rating</th>
                                          <th class="option-name">Selection</th>
                                          <th class="description">Consequences</th>
                                          <th class="action">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>

                              <div class="row">
                                <div class="col-xs-12">
                                  <div class="row-table table-responsive">
                                    <table id="criticality-status-separate" class="criticality-criteria table table-bordered criteria-table sticky-thead">
                                      <thead>
                                        <tr>
                                          <th class="sub-title"></th>
                                          <th class="value">Rating</th>
                                          <th class="option-name">Selection</th>
                                          <th class="description">Consequences</th>
                                          <th class="action">Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr id="data-row-<?php echo $spf_id; ?>" class="data-row">
                                          <td rowspan="2">
                                            Status
                                          </td>
                                          <td class="value">
                                            <input class="form-control" type="text" name="value" value="<?php echo $spf_value; ?>">
                                          </td>
                                          <td class="option-name">
                                            <input class="form-control" type="text" name="option_name" value="SPF" disabled>
                                          </td>
                                          <td class="description">
                                            <input class="form-control" type="text" name="description" value="<?php echo $spf_description; ?>">
                                          </td>
                                          <td class="text-center">
                                              <a href="#" class="btn btn-primary edit-menu">
                                                <span class="glyphicon glyphicon-floppy-disk"></span>
                                              </a>
                                              <p class="menu-id hidden"><?php echo $spf_id; ?></p>
                                              <p class="menu-category-id hidden"><?php echo $spf_menu_category_id; ?></p>
                                          </td>
                                        </tr>
                                        <tr id="data-row-<?php echo $obs_id; ?>" class="data-row">
                                          <td class="value">
                                            <input class="form-control" type="text" name="value" value="<?php echo $obs_value; ?>">
                                          </td>
                                          <td class="option-name">
                                            <input class="form-control" type="text" name="option_name" value="OBS" disabled>
                                          </td>
                                          <td class="description">
                                            <input class="form-control" type="text" name="description" value="<?php echo $obs_description; ?>">
                                          </td>
                                          <td class="text-center">
                                              <a href="#" class="btn btn-primary edit-menu">
                                                <span class="glyphicon glyphicon-floppy-disk"></span>
                                              </a>
                                              <p class="menu-id hidden"><?php echo $obs_id; ?></p>
                                              <p class="menu-category-id hidden"><?php echo $obs_menu_category_id; ?></p>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                                  


                                  

                                

                                <!-- Criticlity Analysis Scoring -->
                                <div class="row">
                                  <div class="col-xs-12">
                                    <h4>Criticality Analysis Scoring</h4>
                                  </div>
                                </div>
                                
                                <div class="row">
                                  <div class="col-xs-12">
                                    <div class="row-table table-responsive">
                                      <table id="criticality-analysis-scoring"  class="table table-bordered criteria-table sticky-thead">
                                        <thead>
                                          <tr>
                                            <th>Result</th>
                                            <th>Frequency</th>
                                            <th class="action">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                                    
                                
                                <!-- End -->
  </div>
                            
</div>