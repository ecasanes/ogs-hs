

<div class="row content">
  <div class="col-sm-10">
    <div class="col-sm-5 no-padding"><label>Event</label></div>
    <div class="col-sm-7">
      <div class="row">
        <div class="col-sm-2 no-padding" style="margin-right:10px;"><label>Time</label></div>
        <div class="col-sm-6 no-padding" ><label>Date</label></div>
        <div class="col-sm-3"><label>Status</label></div>
      </div>
      
    </div>
    
  </div>
  <div class="col-sm-2"></div>
    
</div>


<div id="timeline-table" class="dynamic-row">

    <?php 

    $main_details_length = count($timelines);

    $main_details_counter = 1;

    foreach($timelines as $detail){ 

      $id = $detail['id'];
      $month = $detail['month'];
      $day = $detail['day'];
      $year = $detail['year'];
      $event = $detail['event'];
      $status = $detail['status'];
      $time = $detail['time'];
      $row_order = $detail['row_order'];


      if($main_details_counter < $main_details_length){
        $last = '';
      }else{
        $last = 'last';
      }
      
      
    ?>

          
          <div class="row content main-row" id="file-<?php echo $id; ?>">
            <div class="col-sm-10">
              <div class="row">
                  <div class="col-sm-5">
                    <div class="form-group form-group-required">
                          <?php echo form_hidden('row_count', $main_details_counter); ?>
                          <?php echo form_hidden('row_order', $row_order); ?>
                          <textarea class="form-control no-resize" name="event[]" cols="30" rows="3"><?php echo $event; ?></textarea>
                    </div>
                  </div>
                  <div class="col-sm-7">
                    <div class="row">
                      <div class="col-sm-2 no-padding" style="margin-right:10px;">
                        <div class="form-group">
                      <input type="text" name="time[]" class="form-control input-sm" value="<?php echo $time; ?>" placeholder="00:00 AM">
                    </div>
                      </div>
                      <div class="col-sm-6 no-padding">
                          
                    <div class="input-group">
                     <select name="month[]" class="form-control date-dropdown month no-padding input-sm">
                        <?php echo $month; ?>
                      </select>
                      <select name="day[]" class="form-control date-dropdown day no-padding input-sm" >
                        <?php echo $day; ?>
                      </select>
                      <input type="text" name="year[]" class="form-control date-dropdown year no-padding input-sm" value="<?php echo $year; ?>" placeholder="YYYY" />
                    </div>

                      </div>
                      <div class="col-sm-3 no-padding">
                        <div class="form-group">
                      <select name="status[]" class="form-control no-padding input-sm">
                        <?php echo default_select($status); ?>
                        <option value="confirmed">Confirmed</option>
                        <option value="suspected">Suspected</option>
                      </select>
                    </div>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="col-sm-2">
               <button type="button" class="btn btn-danger text-right remove">
                <span class="glyphicon glyphicon-minus"></span>
              </button> 
              <button type="button" class="btn btn-primary text-right add <?php echo $last; ?>">
                <span class="glyphicon glyphicon-plus"></span>
              </button>
            </div>
          </div>
            
            
          










      <!-- <div class="form-group file-row main-row" >
      
        <div class="col-xs-8">
          
          <div class="fileinput input-group form-file-input" data-provides="fileinput"><input type="hidden" value="" name="" data-bv-field="">
      
            <div class="form-control form-control-file" data-trigger="fileinput">
              <i class="glyphicon glyphicon-file"></i>
              <span class="fileinput-filename"><?php echo $row_order; ?></span>
            </div>
      
            <span class="input-group-addon btn btn-default btn-file" data-original-title="" title="">
              <span class="glyphicon glyphicon-paperclip"></span>
              <span class="fileinput-exists glyphicon glyphicon-paperclip"></span>
              <input type="file" name="userfile[]" data-bv-field="userfile[]">
            </span>
            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"></a>
          </div>
        </div>
        <div class="col-xs-4 no-padding">
              <button type="button" class="btn btn-danger text-right remove">
                <span class="glyphicon glyphicon-minus"></span>
              </button> 
              <button type="button" class="btn btn-primary text-right add <?php echo $last; ?>">
                <span class="glyphicon glyphicon-plus"></span>
              </button>
        </div>
      
      </div> -->

      <?php $main_details_counter++; ?>

    <?php } ?>

</div>