<!-- Edit Criticality Analysis Modal -->
<div class="modal fade" id="edit-criticality-analysis" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php
            $attributes = array( 'role'=>'form' , 'id' => 'edit-criticality-analysis-form', 'class' => '' );
            echo form_open('criticality-analysis/update', $attributes);
            echo form_hidden('criticality_analysis_id', '');
          ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Criticality Analysis</h4>
      </div>
      
       <div class="modal-body">
        
          
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Asset</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Tag Number</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select name="asset" id="" class="form-control">
                <?php echo $criticality_asset; ?>
              </select>
            </div>
            <div class="col-xs-6">
              <input type="text" class="form-control " name="tag_number" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-12">
              <p class="strong">Description:</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input class="form-control" type="text" name="description" value="">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Reliability Redundancy</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Safety Health Criticality</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select name="reliability_redundancy" class="form-control">
                <?php echo $criticality_redundancy; ?>
              </select>
            </div>
            <div class="col-xs-6">
              <select name="safety_health_criticality" class="form-control">
                <?php echo $criticality_safety; ?>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Environmental Criticality</p>
            </div>
            <div class="col-xs-6">
              <p class="strong">Operational Criticality</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select name="environmental_criticality" id="" class="form-control">
                <?php echo $criticality_environment; ?>
              </select>
            </div>
            <div class="col-xs-6">
              <select name="operational_criticality" class="form-control">
                <?php echo $criticality_operation; ?>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-xs-6">
              <p class="strong">Reinstatement</p>
            </div>
          </div>
          <div class="row">
            <div class="col-xs-6">
              <select name="reinstatement" class="form-control">
                <?php echo $criticality_reinstatement; ?>
              </select>
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