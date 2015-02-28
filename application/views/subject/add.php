<div class="row">
  <div class="col-xs-12">

    <!-- start panel -->
    <div class="panel panel-primary">
      
      <div class="panel-heading">
        <h3 class="panel-title">Add Subject</h3>
        <div class="panel-options">
          
        </div>
      </div>
      <?php echo form_open('', array('id'=>'add-subject-form')); ?>
      <div class="panel-body">
        <div class="form-horizontal">
          <div class="row">
            <!-- <div class="form-group">
              <label for="school_year" class="control-label col-sm-2 col-xs-12">School Year</label>
              <div class="col-sm-3 col-xs-12">
                <select name="school_year" id="" class="form-control" required>
                  <option value="">Select</option>
                  <?php echo $school_year_dropdown; ?>
                </select>
              </div>
            
             
            </div>
            
            <div class="form-group">
              <label for="school_year" class="control-label col-sm-2 col-xs-12">Grade Level</label>
                <div class="col-sm-3 col-xs-12">
                  <select name="grade_level" id="" class="form-control" required>
                    <option value="">Select</option>
                    <?php echo $grade_level_dropdown; ?>
                  </select>
                </div>
            </div> -->


            <div class="form-group">
              <label for="username" class="control-label col-sm-2 col-xs-12">Subject Code</label>
              <div class="col-sm-3 col-xs-12">
                <input type="text" class="form-control" name="subject_code" placeholder="Code" required>
              </div>
            </div>

            <div class="form-group">
              <label for="username" class="control-label col-sm-2 col-xs-12">Subject Unit</label>
              <div class="col-sm-3 col-xs-12">
                <select name="subject_unit" class="form-control" required>
                  <option value="">Select</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="username" class="control-label col-sm-2 col-xs-12">Subject Description</label>
              <div class="col-sm-5 col-xs-12">
                <textarea name="subject_description" class="form-control" placeholder="Subject Description" required></textarea>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="col-sm-10">
            <span class="error-message"></span>
            <span class="success-message"></span>
          </div>
          <div class="col-sm-2">
            <input type="submit" class="pull-right btn btn-success submit-form" value="Add">
          </div>
        </div>
      </div>
      <?php echo form_close(); ?>
    </div>
    <!-- end panel -->


    <!-- start panel -->
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title">List of Subjects</h3>
        <div class="panel-options">
          
        </div>
      </div>
      <div id="search-subject" class="panel-body">
        <div class="form-horizontal">
          <div class="row">
            
              <!-- <div class="col-sm-4 col-xs-12">
                <input id="search-subject-input" type="text" class="form-control" placeholder="Find Subject by typing name" name="search">
              </div> -->
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-12">
            <span class="loading hidden">
            <i class="fa fa-spin fa-refresh"></i> Loading...
            </span>
            <div class="search-results">

            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end panel -->
  </div>
</div>



<div class="modal fade" id="delete-subject-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Modify <span class="tag"></span></h4>
      </div>
      <?php echo form_open('', array('id' => 'delete-subject-form')); ?>
      <?php echo form_hidden('id', ''); ?>
      <div class="modal-body">

        <p>Delete Subject?</p>
        

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary go-no" data-dismiss="modal"> Cancel</button>
        <button type="submit" class="btn btn-danger go-delete"> Confirm</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>