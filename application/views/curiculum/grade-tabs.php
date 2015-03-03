<div class="row">
    <div class="col-xs-12">
            <div id="grading-percentage" class="panel panel-primary" data-id="<?php echo $subj_offerid; ?>">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $subj_code; ?> - Grading Percentage</h3>
                    <span class="pull-right">
                        <!-- Tabs -->
                        <ul class="nav panel-tabs">
                            <li class="active"><a href="#first-grading" class="term-grading" data-term="1" data-toggle="tab">1st Grading</a></li>
                            <li><a href="#second-grading" class="term-grading" data-term="2" data-toggle="tab">2nd Grading</a></li>
                            <li><a href="#third-grading" class="term-grading" data-term="3" data-toggle="tab">3rd Grading</a></li>
                            <li><a href="#fourth-grading" class="term-grading" data-term="4" data-toggle="tab">4th Grading</a></li>
                        </ul>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="tab-content">

                        <div class="loading hidden">
                            <i class="fa fa-spin fa-loading"></i> Loading...
                        </div>
                
                        <div class="tab-pane fade in active" id="first-grading">
                        </div>

                        <div class="tab-pane fade" id="second-grading">  
                        </div>

                        <div class="tab-pane fade" id="third-grading">  
                        </div>

                        <div class="tab-pane fade" id="fourth-grading">  
                        </div>


                    </div>
                </div>
            </div>
        </div>
  </div>



