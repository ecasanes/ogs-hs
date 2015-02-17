<div class="row">
    <div class="col-xs-12">

        <?php
            $attributes = array( 'role'=>'form' , 'id' => 'general_inspection', 'class' => 'form-horizontal' );
            echo form_open('integrity-management/gip-coating', $attributes);
            //echo form_hidden('current_user_id', $current_user_id);
        ?>


        <div class="panel panel-info collapsed">
            <div class="panel-heading">
                <h4 class="panel-title">Edit General Inspection</h4>
                <div class="panel-options">
                    <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
                </div>
            </div>
            <div class="panel-body">
                    <div class="row content">
                    <div class="col-xs-12">
                        <div class="page-header">
                            <h4 class="step-title">Coating</h4>
                        </div>
                    </div>
                    </div>

                    <div class="row-content">
                    <label for="" class="col-sm-2 col-xs-12" style="text-align: center;">General Coating Breakdown</label>
                    <div class="col-xs-8">
                        <div class="form-group" style="margin-left: 0px; margin-right: 0px">
                            <input type="text" class="form-control" name="general_coating" id="" placeholder="" value="">
                        </div>
                    </div>
                    <div class="col-xs-2">
                         <div class="form-group" style="margin-left: 0px; margin-right: 0px">
                            <select class="form-control" name="" id="">

                            </select>
                        </div>
                    </div>
                    </div>

                    <div class="row-content">
                    <label for="" class="col-sm-2 col-xs-12" style="text-align: center;">Coating Breakdown at free edge</label>
                    <div class="col-xs-8">
                        <div class="form-group" style="margin-left: 0px; margin-right: 0px">
                            <input type="text" class="form-control" name="coating_breakdown" id="" placeholder="" value="">
                        </div>
                    </div>
                    <div class="col-xs-2">
                         <div class="form-group" style="margin-left: 0px; margin-right: 0px">
                            <select class="form-control" name="" id="">

                            </select>
                        </div>
                    </div>
                    </div>

                    <div class="row-content">
                    <label for="" class="col-sm-2 col-xs-12" style="text-align: center;">Breakdown a long weld line</label>
                    <div class="col-xs-8">
                        <div class="form-group" style="margin-left: 0px; margin-right: 0px">
                            <input type="text" class="form-control" name="breakdown_long" id="" placeholder="" value="">
                        </div>
                    </div>
                    <div class="col-xs-2">
                         <div class="form-group" style="margin-left: 0px; margin-right: 0px">
                            <select class="form-control" name="" id="">

                            </select>
                        </div>
                    </div>
                    </div>

                    <div class="row-content">
                    <label for="" class="col-sm-2 col-xs-12" style="text-align: center;">Cracking</label>
                    <div class="col-xs-8">
                        <div class="form-group" style="margin-left: 0px; margin-right: 0px">
                            <input type="text" class="form-control" name="cracking" id="" placeholder="" value="">
                        </div>
                    </div>
                    <div class="col-xs-2">
                         <div class="form-group" style="margin-left: 0px; margin-right: 0px">
                            <select class="form-control" name="" id="">

                            </select>
                        </div>
                    </div>
                    </div>

                    <div class="row-content">
                    <label for="" class="col-sm-2 col-xs-12" style="text-align: center;">Blistering</label>
                    <div class="col-xs-8">
                        <div class="form-group" style="margin-left: 0px; margin-right: 0px">
                            <input type="text" class="form-control" name="blistering" id="" placeholder="" value="">
                        </div>
                    </div>
                    <div class="col-xs-2">
                         <div class="form-group" style="margin-left: 0px; margin-right: 0px">
                            <select class="form-control" name="" id="">

                            </select>
                        </div>
                    </div>
                    </div>

                    <div class="row-content">
                    <label for="" class="col-sm-2 col-xs-12" style="text-align: center;">Flaking</label>
                    <div class="col-xs-8">
                        <div class="form-group" style="margin-left: 0px; margin-right: 0px">
                            <input type="text" class="form-control" name="flaking" id="" placeholder="" value="">
                        </div>
                    </div>
                    <div class="col-xs-2">
                         <div class="form-group" style="margin-left: 0px; margin-right: 0px">
                            <select class="form-control" name="" id="">

                            </select>
                        </div>
                    </div>
            
                    </div>
            </div>
            <div id="inspection_submit" class="panel-footer">
                <div class="text-right">
                    <button class="btn btn-info btn-icon" type="submit"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                </div>
            </div>

        <?php echo form_close(); ?>

    </div>
</div>


