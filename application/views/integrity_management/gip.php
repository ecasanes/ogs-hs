
<?php if($confirm_msg): ?>
    <div class="alert alert-warning alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php print($confirm_msg) ?>
    </div>
<?php endif ?>

<?php echo form_open(); ?>

<!-- Prints the validation errors in case the user entered an invalid amount -->
<small class="text-error">
    <?php print(validation_errors()) ?>
</small>

<!-- Corrosion Modal -->
<div class="modal fade" tabindex="-1" id="corrosion_id" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Corrosion</h4>
    </div>
    <?php echo form_open('', array('id' => 'corrosion')); ?>
    <div class="modal-body">
        <div class="row" style="text-align: center;">
            <div class="col-sm-4 col-xs-12">
                <label><strong>Parameters</strong></label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <label><strong>Recording</strong></label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <label><strong>Rating</strong></label>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>General Surface</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Edge</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Groove</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Pitting</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Crack</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Buckling</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Cathodic Protection Depletion</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Indents</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Missing</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Sediment</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Wear</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
    </div>
    <?php echo form_close(); ?>
</div>
</div>
</div>

<!-- Coating Modal -->
<div class="modal fade" id="coating" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Coating</h4>
    </div>
    <div class="modal-body">
        <div class="row" style="text-align: center;">
            <div class="col-sm-4 col-xs-12">
                <label><strong>Parameters</strong></label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <label><strong>Recording</strong></label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <label><strong>Rating</strong></label>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>General Coating Breakdown</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Coating Breakdown at Free Edge</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Breakdown along Weld Line</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Cracking</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Blistering</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <label>Flaking</label>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="" placeholder="" value="<?php //echo $customer; ?>">
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <select class="form-control" name="" id="">

                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-info"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
    </div>
</div>
</div>
</div>

<!-- End of Coating Modal -->


<div class="row">
    <div class="col-sm-2 col-xs-12" style="margin-left: 13px; margin-bottom: 20px;">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#corrosion_id"><i class="fa fa-plus"></i> Add Corrosion</button>
    </div>

    <div class="col-sm-2 col-xs-12">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#coating"><i class="fa fa-plus"></i> Add Coating</button>
    </div>
</div>

<div class="panel panel-info collapsed">

    <div class="panel-heading">
        <h4 id="inspection_title" class="panel-title">General Inspection Report</h4>
        <div class="panel-options">
            <a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
        </div>
    </div>

    <div class="panel-body">
        <div class="row-content">
            <label for="" class="col-sm-2 col-xs-12 control-label">Customer:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="customer" id="customer" placeholder="" value="<?php print($customer) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Location:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="location" id="" placeholder="" value="<?php print($location) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">P.O No:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="purchase_no" id="" placeholder="" value="<?php print($purchase_no) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Project</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="project" id="" placeholder="" value="<?php print($project) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Report No:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="report_no" id="" placeholder="" value="<?php print($report_no) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Surface:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="surface" id="" placeholder="" value="<?php print($surface) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Procedure:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="procedure" id="" placeholder="" value="<?php print($procedure) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Equipment :</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="equipment" id="" placeholder="" value="<?php print($equipment) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Equipment Serial No:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="equipment_serial_no" id="" placeholder="" value="<?php print($equipment_serial_no) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Type of Inspection</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="type_of_inspection" id="" placeholder="" value="<?php print($type_of_inspection) ?>">
                </div>
            </div>
        </div>

        <div class="row content">
            <div class="col-xs-12">
                <div class="page-header">

                </div>
            </div>
        </div>

        <div class="row-content">
            <label for="" class="col-sm-2 col-xs-12 control-label">Item :</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="item" id="" placeholder="" value="<?php print($item) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Drawing  No:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="drawing_no" id="" placeholder="" value="<?php print($drawing_no) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Specification</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="specification" id="" placeholder="" value="<?php print($specification) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Material :</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="material" id="" placeholder="" value="<?php print($material) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Size/Thickness :</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="size" id="" placeholder="" value="<?php print($size) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Quantity :</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="quantity" id="" placeholder="" value="<?php print($quantity) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Identification / Serial No:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="serial_no" id="" placeholder="" value="<?php print($serial_no) ?>">
                </div>
            </div>
        </div>

        <div class="row-content">
            <div class="row content">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h4 class="step-title">Comments/Results:</h4>
                    </div>
                </div>
            </div>

            <div class="col-xs-12">
                <div class="page-header">
                    <h4 class="step-title">Scope</h4>
                    <input type="hidden" id="scope" name="scope"  value="">
                </div>

                <div class="form-group form-group-required">
                    <input type="text" name="scope" class="form-control textarea-editor medium" value="<?php print($scope) ?>">
                </div>
            </div>

            <div class="col-xs-12">
                <div class="page-header">
                    <h4 class="step-title">Restrictions</h4>
                    <!-- <input type="hidden" id="restriction" name="scope" value=""> -->
                </div>

                <div class="form-group form-group-required">
                    <input class="form-control textarea-editor medium" name="restrictions" value="<?php print($restrictions) ?>">
                </div>
            </div>

            <div class="col-xs-12">
                <div class="page-header">
                    <h4 class="step-title">Inspection Results</h4>
                    <!-- <input type="hidden" id="inspection_results" name="inspection_results" value=""> -->
                </div>

                <div class="form-group form-group-required">
                    <input class="form-control textarea-editor medium" name="inspection_results" value="<?php print($inspection_results) ?>">
                </div>
            </div>
        </div>


        <div class="row-content">
            <label for="" class="col-sm-2 col-xs-12 control-label">Inspector:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="inspector" id="" placeholder="" value="<?php print($inspector) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Qual:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="qual" id="" placeholder="" value="<?php print($qual) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">Signature:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="signature" id="" placeholder="" value="<?php print($signature) ?>">
                </div>
            </div>
            <label for="" class="col-sm-2 col-xs-12 control-label">Date:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="date" id="" placeholder="" value="<?php print($date) ?>">
                </div>
            </div>
        </div>

        <div class="row-content">
            <label for="" class="col-sm-2 col-xs-12 control-label">For Client use:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="for_client_use" id="" placeholder="" value="<?php print($for_client_use) ?>">
                </div>
            </div>

            <label for="" class="col-sm-2 col-xs-12 control-label">For Certifying Auth. use:</label>
            <div class="col-sm-4 col-xs-12">
                <div class="form-group">
                    <input type="text" class="form-control" name="for_cert_auth" id="" placeholder="" value="<?php print($for_cert_auth) ?>">
                </div>
            </div>
        </div>
    </div>

    <div id="inspection_submit" class="panel-footer">
        <div class="text-right">
            <button class="btn btn-info btn-icon" type="submit">Save <span class="glyphicon glyphicon-floppy-disk"></span></button>
        </div>
    </div>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    $('#corrosion').submit(function() {
        // get all the inputs into an array.
        var $inputs = $('#myForm :input');

        // not sure if you wanted this, but I thought I'd add it.
        // get an associative array of just the values.
        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        });

        event.preventDefault();
    });
</script>