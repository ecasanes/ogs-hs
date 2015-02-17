<div class="panel panel-default">
	<?php $this->load->view('includes/initialize-form', $data); ?>
	<div class="panel-heading">
        <h4 class="panel-title"><?php echo $step_title; ?></h4>

        <div class="panel-options">
        </div>
    </div>

    <div class="panel-body">
    	<?php $this->load->view('includes/completion-status', $data); ?>
        <?php $this->load->view('includes/document-status-snippet', $data); ?>

        <div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h4>Interview</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-sm-2 col-xs-12">Installation/Location:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="name" id="code" class="form-control" value="<?php echo $name; ?>">
                </div>
            </div>
            <label class="control-label col-sm-1 col-xs-12">Time:</label>
            <div class="col-xs-12 col-sm-2">
                <div class="form-group">
                    <input type="text" name="time" id="code" class="form-control timepicker" value="<?php echo $time; ?>">
                </div>
            </div>
            <label class="control-label col-sm-1 col-xs-12">Date:</label>
            <div class="col-xs-12 col-sm-2">
                <div class="form-group">
                    <input type="text" id="date-of..-raised" name="user_date" class="form-control datepicker" placeholder="Select the Date" value="<?php echo $user_date; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-sm-2 col-xs-12">Conducted By:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="conducted_by" id="code" class="form-control" value="<?php echo $conducted_by; ?>">
                </div>
            </div>
            <label class="control-label col-sm-1 col-xs-12">Email:</label>
            <div class="col-xs-12 col-sm-5">
                <div class="form-group">
                    <input type="text" name="conducted_email" id="code" class="form-control" value="<?php echo $conducted_email; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-sm-2 col-xs-12">Recorded By:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="recorded_by" id="code" class="form-control" value="<?php echo $recorded_by; ?>">
                </div>
            </div>
            <label class="control-label col-sm-1 col-xs-12">Email:</label>
            <div class="col-xs-12 col-sm-5">
                <div class="form-group">
                    <input type="text" name="recorded_email" id="code" class="form-control" value="<?php echo $recorded_email; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h4>Witness Details</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-sm-2 col-xs-12">Witness Name:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="witness_name" id="code" class="form-control" value="<?php echo $witness_name; ?>">
                </div>
            </div>

            <label class="control-label col-sm-1 col-xs-12">Email:</label>
            <div class="col-xs-12 col-sm-5">
                <div class="form-group">
                    <input type="text" name="witness_email" id="code" class="form-control" value="<?php echo $witness_email ; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-sm-2 col-xs-12">Accompanied By:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="accompanied_by" id="code" class="form-control" value="<?php echo $accompanied_by; ?>">
                </div>
            </div>

            <label class="control-label col-sm-1 col-xs-12">Email:</label>
            <div class="col-xs-12 col-sm-5">
                <div class="form-group">
                    <input type="text" name="accompanied_email" id="code" class="form-control" value="<?php echo $accompanied_email; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-sm-2 col-xs-12">Witness Position:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="witness_position" id="code" class="form-control" value="<?php echo $witness_position; ?>">
                </div>
            </div>

            <label class="control-label col-sm-1 col-xs-12">Employer:</label>
            <div class="col-xs-12 col-sm-5">
                <div class="form-group">
                    <input type="text" name="employer" id="code" class="form-control" value="<?php echo $employer; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-sm-2 col-xs-12">Witness Nickname:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="witness_nickname" id="code" class="form-control" value="<?php echo $witness_nickname; ?>">
                </div>
            </div>
            <div style="visibility: hidden;" class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <!-- <input type="text" name="witness_nickname" id="code" class="form-control" value="<?php echo $witness_nickname; ?>"> -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h4>Witness Address</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-sm-2 col-xs-12">Street 1:</label>
            <div class="col-xs-12 col-sm-10">
                <div class="form-group">
                    <input type="text" name="witness_street_1" id="code" class="form-control" value="<?php echo $witness_street_1; ?>">
                </div>
            </div>
        </div>
        <div class="row">
            <label class="control-label col-sm-2 col-xs-12">Street 2:</label>
            <div class="col-xs-12 col-sm-10">
                <div class="form-group">
                    <input type="text" name="witness_street_2" id="code" class="form-control" value="<?php echo $witness_street_2; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-sm-2 col-xs-12">City:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="witness_city" id="code" class="form-control" value="<?php echo $witness_city; ?>">
                </div>
            </div>
            <label class="control-label col-sm-2 col-xs-12">Country:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="witness_country" id="code" class="form-control" value="<?php echo $witness_country; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <label class="control-label col-sm-2 col-xs-12">Postal/Zip Code:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="witness_postal_code" id="code" class="form-control decimal-only" value="<?php echo $witness_postal_code; ?>">
                </div>
            </div>

            <div style="visibility: hidden;" class="col-xs-12 col-sm-6">
                <div class="form-group">
                    <!-- <input type="text" name="witness_postal_code" id="code" class="form-control" value="<?php echo $witness_postal_code; ?>"> -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h4>Incident</h4>
                </div>
            </div>
        </div>


        <div class="row">
            <label class="control-label col-sm-2 col-xs-12">Title:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="incident_title" id="code" class="form-control" value="<?php echo $incident_title; ?>">
                </div>
            </div>
            <label class="control-label col-sm-2 col-xs-12">Number:</label>
            <div class="col-xs-12 col-sm-4">
                <div class="form-group">
                    <input type="text" name="incident_number" id="code" class="form-control" value="<?php echo $incident_number; ?>">
                </div>
            </div>

        </div>

        <div class="row">
            <label class="control-label col-sm-2 col-xs-12 required-input">Description:</label>
            <div class="col-sm-10 col-xs-12">
               <div class="form-group">
                  <textarea class="form-control" name="incident_description" id="case-summary" cols="30" rows="5" required><?php echo $incident_description; ?></textarea>
              </div>
          </div>
      </div>

      <div class="row">
        <div class="col-xs-12">
            <div class="page-header">
                <h4 class="required-input">Statement</h4>
            </div>
        </div>
    </div>


    <div class="row">
        

        <div class="col-xs-12">
           <div class="form-group">
              <textarea class="form-control" name="statement" id="case-summary" cols="30" rows="5" required><?php echo $statement; ?></textarea>
          </div>
      </div>
  </div>

  <div class="row">
    <label class="control-label col-sm-2 col-xs-12">Signature:</label>
    <div class="col-xs-12 col-sm-3">
        <div class="form-group">
            <input type="text" name="signature" id="code" class="form-control" value="<?php echo $signature; ?>">
        </div>
    </div>
</div>

</div>
<?php $this->load->view('includes/casefile-footer', $data); ?>
<?php echo form_close(); ?>
</div>