<?php if($editable): ?>
    <div id="update-document-panel" class="panel panel-default">
        
        
        <div class="panel-heading">
            Document Update
            <?php if($name != null || $name != ''): ?>
                or <?php echo $name; ?>
            <?php endif; ?>
            <div class="panel-options">
                <span class="panel-code"><?php echo $code; ?></span>
            </div>
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="">Title:</label>
                        <input type="text" class="update-title form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Update Details:</label>
                        <textarea class="update-description form-control"></textarea>
                    </div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-xs-12 text-right">
                    <button class="btn btn-primary update-document">Update</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<span id="loading-updates">
    <i class="fa fa-w fa-lg fa-refresh fa-spin"></i> Loading Updates...
</span>

<div id="document-update-container" data-id="<?php echo $document_id; ?>">

</div>