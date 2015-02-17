            <?php $attributes = array( 'id' => 'upload-general-files');
            echo form_open_multipart('user/upload', $attributes);?>
            <div class="upload-file-list-form">
              <div class="upload-errors">
              </div>
              <input type="hidden" name="hidden_upload" value="">
              <div class="uploading-progress text-center hidden">
                <span>Uploading ...</span><br>
                <i class="fa fa-cog fa-spin" style="font-size: 30px !important"></i>
              </div>
              <div class="attach-files-container">
                <div class="attach-files">
                  <div class="row">
                    <div class="col-sm-offset-1 col-sm-8">
                      <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                        <div class="form-control action-tracker-upload" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                        <span class="input-group-addon btn btn-default btn-file"><span class="glyphicon glyphicon-paperclip"></span><input type="file" name="userfile[]" ></span>
                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-remove"></span></a>


                      </div>
                    </div>
                    
                  </div>
                </div>
                <div class="hidden-item"></div>
                <div class="clone-attach-files-row">
                  <div class="row">
                    <div class="col-sm-offset-1 col-sm-8">
                      <button type="button" class="btn btn-primary clone-attach-files btn-sm" data-original-title="" title="">Add another file</button>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12 text-right">
                    <button type="button" class="btn btn-primary go-no" data-dismiss="modal"> No</button>
                    <button type="submit" value="upload" class="btn btn-danger go-yes"> Upload</button>
                  </div>
                </div>
              </div>
            </div>
            <?php echo form_close(); ?>
              