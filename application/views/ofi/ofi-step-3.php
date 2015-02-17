<div class="panel panel-default">
  <?php $this->load->view('includes/initialize-form', $data); ?>

  <div class="panel-heading">
      <h4 class="panel-title"><?php echo $step_title; ?></h4>
      <div class="panel-options">
            <span class="panel-code"><?php echo $document_header_name; ?></span>
        </div>
  </div>

  <div class="panel-body">
    <?php $this->load->view('includes/steps', $data); ?>
    <?php $this->load->view('includes/completion-status', $data); ?>

     

      <!-- <div class="row">
        <div class="col-xs-12">
          <div class="page-header">
            <h4>Risks and Threats <i class="fa fa-question-circle text-success risks-and-threats-popover"></i></h4>
          </div>
        </div>
      </div>
      
      
      
                              <div class="row content">
                                
                                <div class="col-xs-12">
                                          <div class="form-group">
                                                <textarea class="form-control textarea-editor medium" name="risks" id="risks" cols="30" rows="10" required><?php echo $risks; ?></textarea>
                                          </div>
                                </div>
                              </div> -->









                              

                              <div class="row">
        <div class="col-xs-12">
          <div class="page-header">
            <h4>Risks and Threats <i class="fa fa-question-circle text-success constraints-popover"></i></h4>
          </div>
        </div>
      </div>



                              <div class="row content text-left hidden-xs">
                                <div class="col-sm-4">
                                  <label>Risk</label>
                                </div>
                                <div class="col-sm-4 text-left">
                                  <label>Mitigating Action</label>
                                </div>
                                <div class="col-sm-4 text-left">
                                  <label>Owner</label>
                                </div>
                              </div>


                              <div id="constraints-table" class="dynamic-row">
                                <?php foreach($constraints as $constraint){
                                    $risk = $constraint['constraints'];
                                    $mitigating_action = $constraint['mitigating_action'];
                                    $responsible_dropdown = $constraint['responsible_dropdown'];
                                    $responsible = $constraint['responsible'];

                                 ?>
                                  <div class="row content text-left">
                                    <label for="" class="col-xs-12 control-label visible-xs">Constraint</label>
                                    <div class="col-sm-4 col-xs-12">
                                      <div class="form-group">
                                        <textarea class="form-control" name="constraints[]" rows="2"><?php echo $risk; ?></textarea>
                                      </div>
                                    </div>
                                    <label for="" class="col-xs-12 control-label visible-xs">Mitigating Action</label>
                                    <div class="col-sm-4 text-left col-xs-12">
                                      <div class="form-group">
                                        <textarea class="form-control" name="mitigating_actions[]" rows="2"><?php echo $mitigating_action; ?></textarea>
                                      </div>
                                    </div>
                                    <label for="" class="col-xs-12 control-label visible-xs">Owner</label>
                                    <div class="col-sm-4 text-left col-xs-12">
                                      <div class="alternate-select-input input-group">
                                          <input type="text" class="form-control alternate-input" name="responsible[]" placeholder="New Owner" value="<?php echo $responsible; ?>">
                                          <select class="form-control alternate-select select2-dropdown" name="responsible[]">
                                              <?php echo $responsible_dropdown; ?>
                                          </select>
                                          <span class="input-group-btn">
                                              <button class="btn btn-success alternate-button alt-select" type="button" title="add new">
                                                  <i class="fa fa-plus-circle fa-lg"></i>
                                              </button>
                                          </span>
                                      </div>
                                    </div>
                                    <div class="row visible-xs">
                                      <div class="col-xs-12"><hr></div>
                                    </div>
                                  </div>
                                <?php } ?>
                                  
                              </div>

    

</div>
  <?php $this->load->view('includes/casefile-footer', $data); ?>
  <?php echo form_close(); ?>
</div>