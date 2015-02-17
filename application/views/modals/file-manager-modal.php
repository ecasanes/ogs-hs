<div class="modal fade" id="file-manager-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div id="aciton-tracker-modal" class="modal-dialog modal-md">
    <div class="modal-content">
      <?php
            //$attributes = array( 'role'=>'form' , 'id' => 'create-action-tracker-form', 'class' => '' );
            //echo form_open('action-tracker/create', $attributes); 
            //echo form_hidden('ref_id_code', '');
      ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">File Manager</h4>
      </div>
      
      <div class="modal-body">



        <div role="tabpanel">

          <!-- Nav tabs -->
          <ul class="nav nav-pills" role="tablist">
            <li role="presentation" class="active"><a class="pill file-list-tab-button" href="#file-list" aria-controls="file-list" role="tab" data-toggle="pill">File List</a></li>
            <li role="presentation"><a class="pill" href="#upload-tab" aria-controls="upload" role="tab" data-toggle="pill">Upload</a></li>
            <!--<li role="presentation"><a class="pill" href="#document-files" aria-controls="document-files" role="tab" data-toggle="pill">Files in this document</a></li>-->
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="file-list">
              <?php $this->load->view('forms/file-list'); ?> 
            </div>
            <div role="tabpanel" class="tab-pane" id="upload-tab">
              <?php $this->load->view('forms/upload-form'); ?>
            </div>
            <!--<div role="tabpanel" class="tab-pane" id="document-files">c</div>-->
          </div>

        </div>        
      </div>

      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>
         <button id="user-save" class="btn btn-primary loading-button" data-toggle="tooltip" data-placement="top" title="Save and Upload Information"  type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
       </div> -->
       <?php //echo form_close(); ?> 
     </div>
   </div>
 </div>