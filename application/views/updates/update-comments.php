
<?php if(empty($document_update_comments)): ?>
                                no comments yet...
                            <?php else: ?>
                                <?php foreach($document_update_comments as $comment): ?>
                                <?php
                                    $comment_user_photo = $comment->user_photo;
                                    $comment_user_photo = image_exist(base_url($uploads_folder.'/'.$comment_user_photo), 'circle', 'url');
                                    $comment_date = convert_date_to_string( $comment->comment_date, false, false, "M j, Y - g:i A" );
                                    $comment_first_name = $comment->first_name;
                                    $comment_last_name = $comment->last_name;
                                    $comment_text = $comment->comment;

                                ?>

                                    <div class="single-comment row">
                                        <div class="col-xs-2">
                                            <img src="<?php echo $comment_user_photo; ?>" alt="" class="pull-right img-timeline-comment img-responsive img-circle">
                                        </div>
                                        <div class="col-xs-10">
                                            <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> <?php echo $comment_date; ?> by <?php echo $comment_first_name .' '. $comment_last_name; ?></small></p>
                                            <p><?php echo $comment_text; ?>
                                        </div>
                                    </div>

                                <?php endforeach; ?>
                            <?php endif; ?>



