<div class="row">
    <div class="col-xs-12">
        <ul class="timeline">
            <?php 
                $timeline_counter = 0; 
                $timeline_class = "";
            ?>
            <?php if(empty($document_updates)): ?>
                <h2>No Updates Yet...</h2>
            <?php else: ?>
                <?php foreach($document_updates as $update): ?>
                <?php 
                    $uploads_folder = $update['uploads_folder'];
                    $title = $update['title'];
                    $description = $update['description'];
                    $update_date = $update['update_date'];
                    $document_update_id = $update['document_update_id'];
                    $user_photo = $update['user_photo'];
                    $first_name = $update['first_name'];
                    $last_name = $update['last_name'];
                    $document_update_comments = $update['document_update_comments'];

                    if($timeline_counter == 0){
                        $timeline_class = "";
                        $timeline_counter++;
                    }else{
                        $timeline_class = "timeline-inverted";
                        $timeline_counter = 0;
                    }
                ?>
                <li class="single-timeline <?php echo $timeline_class; ?>">
                  
                    <img class="timeline-badge" src="<?php echo $user_photo; ?>">
                  
                  <div class="timeline-panel">
                    <div class="timeline-heading">
                      <h4 class="timeline-title"><?php echo $title; ?></h4>
                      <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> <?php echo $update_date; ?> by <?php echo $first_name .' '. $last_name; ?></small></p>
                    </div>
                    <div class="timeline-body">
                        <?php echo $description; ?>
                    </div>
                    <div class="timeline-footer">
                        <span class="loading-comments content hidden">
                            <i class="fa fa-w fa-lg fa-refresh fa-spin"></i> Loading Comments...
                        </span>
                        <div class="content comments-container">

                            <?php include('update-comments.php'); ?>
                            
                        </div>
                    </div>
                    <div class="timeline-footer comment-text-container">
                        <div class="content">
                            <div class="row">
                                <div class="col-xs-12">
                                    <textarea name="comment" class="comment-textarea form-control" required></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 text-right">

                                    <button data-id="<?php echo $document_update_id; ?>" class="refresh-comment btn btn-success" data-toggle="tooltip" data-placement="left" title="Refresh Comments">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                    <button data-id="<?php echo $document_update_id; ?>" class="submit-comment btn btn-primary">Comment</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </li>
            <?php endforeach; ?>
            <?php endif; ?>
            
        </ul>
    </div>
</div>
        
