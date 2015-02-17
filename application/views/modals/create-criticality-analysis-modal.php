<!-- Create Criticality Analysis Modal -->
<div class="modal fade" id="create-criticality-analysis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'create-criticality-analysis-form', 'class' => '' );
            echo form_open('criticality-analysis/create', $attributes); 
            echo form_hidden('current_user_id', $current_user_id);
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Criticality Analysis</h4>
      </div>
      
      <div class="modal-body">
        
          
          <div class="row">
            <div class="col-xs-4">
              <p class="strong">Asset</p>
            </div>
            <div class="col-xs-8">
              <p class="strong">Category</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <select name="asset" id="" class="form-control">
                <?php echo $criticality_asset; ?>
              </select>
            </div>
            <div class="col-xs-8">
              <div class="row">

                <div class="col-sm-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="pce" value="1"> <p class="strong">PCE</p>
                    </label>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="sce" value="1"> <p class="strong">SCE</p>
                    </label>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="ece" value="1"> <p class="strong">ECE</p>
                    </label>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="sis" value="1"> <p class="strong">SiS</p>
                    </label>
                  </div>
                </div>

              </div>
            </div>
          </div>

          <br>

          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Tag Number</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Description</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <input type="text" class="form-control" name="tag_number" value="" required>
            </div>
            <div class="col-xs-6">
              <input type="text" class="form-control" name="description" value="" required>
            </div>
          </div>
          <br>

          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Equipment Code</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Group</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <input type="text" class="form-control" name="equipment_code" value="">
            </div>
            <div class="col-xs-6">
              <select name="group" id="group" class="form-control" required>
                <?php echo $group_dropdown; ?>
                <option value="other">Other</option>
              </select>
              <div id="freetext" class="input-group hidden">
                <input name="new_group" type="text" class="form-control" required>
                <span id="backtoselect" class="input-group-addon btn" data-toggle="tooltip" data-placement="top" title="Back to Select">X</span>
              </div>
            </div>
          </div>
          <br>
          
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
         <button id="user-save" class="btn btn-primary loading-button" data-toggle="tooltip" data-placement="top" title="Save and Upload Information"  type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
      </div>
      <?php echo form_close(); ?> 
    </div>
  </div>
</div>
<!-- End Create Modal -->