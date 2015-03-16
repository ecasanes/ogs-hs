<?php echo form_open('', array('id'=>'add-subject-form')); ?>
      <div class="panel-body">
        <div class="form-horizontal">
          <div class="row">


            <div class="form-group">
              <label for="username" class="control-label col-sm-4 col-xs-12">Subject Code</label>
              <div class="col-sm-6 col-xs-12">
                <input type="text" class="form-control" name="subject_code" placeholder="Code" required>
              </div>
            </div>

            <div class="form-group">
              <label for="username" class="control-label col-sm-4 col-xs-12">Subject Unit</label>
              <div class="col-sm-6 col-xs-12">
                <select name="subject_unit" class="form-control" required>
                  <option value="">Select</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="username" class="control-label col-sm-4 col-xs-12">Subject Description</label>
              <div class="col-sm-6 col-xs-12">
                <textarea name="subject_description" class="form-control" placeholder="Subject Description" required></textarea>
              </div>
            </div>


            <!-- <div class="form-group">
              <label for="username" class="control-label col-sm-4 col-xs-12">School Year</label>
              <div class="col-sm-6 col-xs-12">
                <select name="school_year" class="form-control">
                  <option value="">Select</option>
                  <?php echo $school_year_dropdown; ?>
                </select>
              </div>
            </div> -->


            <div class="form-group">
              <label for="username" class="control-label col-sm-4 col-xs-12">Year Level</label>
              <div class="col-sm-6 col-xs-12">
                <select name="grade_level" class="form-control">
                  <option value="">Select</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <div class="row">
          <div class="col-sm-10">
            <span class="submit-message"></span>
          </div>
          <div class="col-sm-2">
            <input type="submit" class="pull-right btn btn-success submit-form" value="Add">
          </div>
        </div>
      </div>
      <?php echo form_close(); ?>