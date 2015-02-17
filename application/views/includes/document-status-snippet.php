<div id="document-status" class="document-status panel-body panel-body-default">
    <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
            <div class="row">
                <label class="control-label hidden-xs col-sm-2">Document Status</label>
                <label class="col-xs-12 visible-xs control-label">Document Status</label>
                <div class="col-xs-12 col-sm-7">
                    <div class="form-group">
                        <?php echo form_hidden('document_status_submit', base_url($controller.'/update-document-status')); ?>
                        <?php echo form_hidden('published_by', $published_by); ?>
                        <?php echo form_hidden('published_date', $published_date); ?>
                        <?php echo form_hidden('document_status_value', $document_status_value); ?>
                        <?php echo form_hidden('current_user_id', $current_user_id); ?>
                        <?php echo form_hidden('current_user_name', $current_user_name); ?>
                        <select class="form-control" name="document_status" required>
                            <?php echo $document_status; ?>
                        </select>
                        <small data-bv-validator="notEmpty" class="help-block" style="display: none;"></small>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-1 hidden-xs">
                    <div class="form-group">
                        <button id="update-document-status" type="submit" name="update_status" class="btn btn-bordered btn-info btn-block" data-original-title="Update Document Status" title="" data-bv-field="update_status" data-toggle="tooltip" data-placement="right">
                            <i class="fa pe-7s-upload fa-lg"></i>
                        </button>
                    </div>
                </div>
            </div>


            <div id="reviewed-by-row" class="row content document-status-row <?php echo $reviewed_state; ?>">
                <label for="author" class="control-label col-xs-12 col-sm-2">Reviewed by</label>
                <div class="col-row col-xs-12 col-sm-5 ajax-autocomplete">
                    <div class="form-group">
                        <input type="text" class="form-control new-user" name="reviewed_by_name" placeholder="Firstname Lastname" value="<?php echo $reviewed_by_name; ?>" autocomplete="off" disabled>
                        <input type="hidden" class="new-user-id" name="reviewed_by" value="<?php echo $reviewed_by; ?>">
                    </div>
                    <!-- <div class="autosuggest form-group">
                        <ul class="user-suggest">
                    
                        </ul>
                    </div> -->
                </div>
                <label for="author" class="control-label col-xs-12 col-sm-2 text-left">Date</label>
                <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                        <input type="text" name="reviewed_date" class="form-control datepicker" placeholder="Select the Date" value="<?php echo $approved_date; ?>">
                    </div>
                </div>
            </div>

            <div id="approved-by-row" class="row content document-status-row <?php echo $approved_state; ?>">
                <div class="col-xs-12 col-sm-2 control-label">
                    <label for="author">Approved by</label>
                </div>
                <div class="col-row col-xs-12 col-sm-5 ajax-autocomplete">
                    <div class="form-group">
                        <input type="text" class="form-control new-user" name="approved_by_name" placeholder="Firstname Lastname" value="<?php echo $approved_by_name; ?>" autocomplete="off" disabled>
                        <input type="hidden" class="new-user-id" name="approved_by" value="<?php echo $approved_by; ?>">
                    </div>
                    <!-- <div class="autosuggest form-group">
                        <ul class="user-suggest">
                    
                        </ul>
                    </div> -->
                </div>

                <div class="col-xs-12 col-sm-2 control-label">
                    <label for="date">Date</label>
                </div>
                <div class="col-xs-12 col-sm-3">
                    <div class="form-group">
                        <input type="text" name="approved_date" class="form-control datepicker" placeholder="Select the Date" value="<?php echo $approved_date; ?>">
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-xs-12 visible-xs">
                    <div class="form-group">
                        <button id="update-document-status" type="submit" name="update_status" class="btn btn-info btn-block" data-original-title="" title="" data-bv-field="update_status">Update Status</button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>



<!-- Document Status History -->
<br>
<div class="row">
    <div id="document-status-container" class="col-xs-12">
        <div class="page-header">
            <h4>Document Status History</h4>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table id="document-status-history" class="table table-bordered my-account">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="document-status-list">

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <a id="more-document-status" href="#" data-offset="5" data-limit="5" data-id="<?php print($id) ?>" class="btn btn-primary btn-bordered btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>
            </div>
        </div>
    </div>

</div>
