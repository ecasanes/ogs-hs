<?php
  
  if($session_site_role != 'siteadmin'){
    $create_display = 'hidden';
  }else{
    $create_display = '';
  }

?>


<section id="main-content">
    <div class="container">
        <div class="row custom-tooltip-container step-tooltip">
            <div class="custom-tooltip">
            </div>
            <div class="col-xs-12">
                <div class="page-header">
                  <div class="row">
                    <div class="col-sm-4">
                      <h2 class="step-title align-title">History of Availability </h2>
                    </div>
                    <div class="col-sm-8"></div>
                  </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>


<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-primary">

                
                    <div class="panel-body">
                        <div class="tab-content form-tabs">
                            <div class="tab-pane active" id="tab1">

                              
                            <div id="no-criticality-analysis" class="hidden">
                              <p>There are no Criticality Analysis created.</p>
                            </div>

                            <div id="no-search-found" class="hidden">
                              <p>There are no Criticality Analysis found. </p>
                            </div>

                            <div id="loading-criticality-analysis" class="hidden">
                              <i class="fa fa-refresh fa-spin"></i>  Loading Criticality Analysis...
                            </div>



                              <div id="history-of-availability-table" class="row-table table-responsive">
                                <table  class="table table-bordered my-account sticky-thead">
                                  <thead>
                                     
                                    <tr>
                                      <th>Asset</th>
                                      <th>Tag Number</th>
                                      <th>Description</th>
                                      <th>ARN?</th>
                                      <th>Alert</th>
                                      <th colspan="2">Jan</th>
                                      <th colspan="2">Feb</th>
                                      <th colspan="2">Mar</th>
                                      <th colspan="2">Apr</th>
                                      <th colspan="2">May</th>
                                      <th colspan="2">Jun</th>
                                      <th colspan="2">Jul</th>
                                      <th colspan="2">Aug</th>
                                      <th colspan="2">Sep</th>
                                      <th colspan="2">Oct</th>
                                      <th colspan="2">Nov</th>
                                      <th colspan="2">Dec</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <!-- <tr>
                                      <td>TIF</td>
                                      <td>050EG01</td>
                                      <td>Makesafe Generator</td>
                                      <td>Y</td>
                                      <td>N</td>
                                      <td>100%</td>
                                      <td>Y</td>
                                      <td>100%</td>
                                      <td>N</td>
                                      <td>100%</td>
                                      <td>Y</td>
                                      <td>100%</td>
                                      <td>Y</td>
                                      <td>100%</td>
                                      <td>Y</td>
                                      <td>100%</td>
                                      <td>Y</td>
                                      <td>100%</td>
                                      <td>Y</td>
                                      <td>100%</td>
                                      <td>Y</td>
                                      <td>100%</td>
                                      <td>Y</td>
                                      <td>100%</td>
                                      <td>Y</td>
                                      <td>100%</td>
                                      <td>Y</td>
                                      <td>100%</td>
                                      <td>Y</td>
                                    </tr>
                                    <tr>
                                      <td>TIF</td>
                                      <td>120PD03A/B</td>
                                      <td>Methanol Injection Pumps</td>
                                      <td>Y</td>
                                      <td>N</td>
                                      <td>100%</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                    </tr> -->
                                  
                                  </tbody>
                                </table>
                              </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</section>