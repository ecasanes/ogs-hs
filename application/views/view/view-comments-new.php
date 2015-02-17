<?php
    echo form_open();
    echo form_hidden('document_id', $document_id);
    echo form_hidden('current_user_id', $current_user_id);
    echo form_close();
?>
<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <i class="fa fa-lg fa-comments"></i> Recent Comments
                <div class="panel-options">
                    <p class="pull-right"><span id="comment-container"></span> | <span id="like-container"></span></p>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div id="no-search-found">
                          <p>There are no comments found. </p>
                        </div>

                        <div id="loading">
                          <i class="fa fa-refresh fa-spin"></i>  Loading Comments...
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <ul id="single-document-comments" class="list-group comment">
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <a id="more-comments" href="#" class="btn btn-primary btn-sm btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>
                    </div>
                </div>

                    

                    
                
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <i class="fa fa-lg fa-info"></i> Document Information
                <div class="panel-options">
                    
                </div>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label col-sm-4">Document Name:</label>
                    <div class="controls col-sm-8">
                        <p>
                            <?php echo $document_name; ?>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4">Document Code:</label>
                    <div class="controls col-sm-8">
                        <p>
                            <?php echo $document_code; ?>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4">Date Created:</label>
                    <div class="controls col-sm-8">
                        <p>
                            <?php echo $date_created; ?>
                        </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-4">Document Status:</label>
                    <div class="controls col-sm-8">
                        <p>
                            <?php echo $document_status; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
