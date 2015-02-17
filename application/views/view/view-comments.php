<section id="main-content">

    <div class="container">


        <div class="row">
            <div class="col-sm-12">
                <?php
                    echo form_open();
                    echo form_hidden('document_id', $document_id);
                    echo form_hidden('current_user_id', $current_user_id);
                    echo form_close();
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-5">
                            <h1>Document Name: <?php echo $document_name; ?></h1>
                        </div>
                        <div class="col-sm-7">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>


        



        <div class="row">

            <div class="panel panel-default widget">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-comment"></span>
                    <h3 class="panel-title">Recent Comments</h3>
                    <!-- Number of Comments -->
                  	<p class="pull-right"><span id="comment-container"></span> | <span id="like-container"></span></p>
                </div>
                <div class="panel-body">

                    <div class="row">
                        <div class="col-sm-12">
                            <div id="no-search-found">
                              <p>There are no comments found. </p>
                            </div>

                            <div id="loading">
                              <i class="fa fa-refresh fa-spin"></i>  Loading Comments...
                            </div>
                        </div>
                    </div>

                    <ul id="single-document-comments" class="list-group comment">
                        <!-- <li class="list-group-item comment-item">
                            <div class="row">
                                <div class="col-xs-2">
                                    <img src="http://placehold.it/80" class="img-circle img-responsive user-img" alt="" />
                                </div>
                                <div class="col-xs-10 col-md-10">
                                    <div class="comment-body">
                                        <p class="strong">This document is very usefull</p>
                                        <div class="mic-info">
                                            By: <a href="#">Bhaumik Patel</a> on 2 Aug 2013
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li> -->
                    </ul>

                    <a id="more-comments" href="#" class="btn btn-primary btn-sm btn-block" role="button"><span class="glyphicon glyphicon-refresh"></span> More</a>
                </div>
            </div>

        </div>
    </div>

</section>