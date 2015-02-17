<div class="row">
	<div class="col-xs-12">

		<?php
			$attributes = array( 'role'=>'form' , 'id' => 'general_inspection', 'class' => 'form-horizontal' );
			echo form_open('', $attributes);
		?>

		<div class="panel panel-info collapsed">
			<div class="panel-heading">
				<h4 id="inspection_title" class="panel-title">Select Inspection Type</h4>
				<div class="panel-options">
					<a href="#" data-rel="collapse"><i class="fa fa-fw fa-plus"></i></a>
				</div>
			</div>

			<div class="panel-body">

				<div class="row-content">
					<label for="" class="col-sm-2 col-xs-12 control-label">Inspection Type:</label>
					<div class="col-sm-10 col-xs-12">
						<div class="form-group">
		                    <select id="inspection" class="form-control" id="" required>
		                    	<option data-id="none" value="0">Select</option>
		                    	<option data-id="<?php echo base_url('general-inspection/add'); ?>" value="1">General Inspection</option>
		                    	<option data-id="<?php echo base_url('eddy_current_inspection/add'); ?>" value="2">Eddy Current Inspection</option>
		                    	<option data-id="<?php echo base_url('dye_penetrant/add'); ?>" value="3">Dye Penetrant Inspection</option>
		                    	<option data-id="<?php echo base_url('magnetic_particle/add'); ?>" value="4">Magnetic Particle Inspection</option>
		                    	<option data-id="<?php echo base_url('ultrasonic/add'); ?>" value="5">Ultrasonic Inspection</option>
	                        </select>
		                </div>
					</div>
				</div>
				<div id="inspection_type">
						
				</div>
			</div>
			<div id="inspection_submit" class="panel-footer hidden">
				<div class="text-right">
					<button class="btn btn-info btn-icon" type="submit">Next <span class="glyphicon glyphicon-chevron-right"></span></button>
				</div>
			</div>
		</div>


		<?php echo form_close(); ?>

	</div>
</div>

<script type="text/javascript">
	$("select#inspection").on('change', function(){
        var $this = $(this);
        // Get id.
        var data_controller = $(this).find("option:selected").data('id');
        var $form = $this.closest('form');
        var type = $(this).val();
		var type_array = ['select','gip','eci','dpi','mpi', 'ut'];

        $form.attr('action', data_controller);

        var result = type_array[type];

        if(result == 'gip') 
        {
            $("#inspection_title").text("General Inspection");
            $("#inspection_submit").removeClass("hidden");
            $("#inspection_type").removeClass("hidden");
        }
        else 
        if(result == 'eci') 
        {
            $("#inspection_title").text("Eddy Current Inspection");
            $("#inspection_submit").removeClass("hidden");
            $("#inspection_type").removeClass("hidden");
        }
        else 
        if(result == 'dpi') 
        {
            $("#inspection_title").text("Dye Penetrant Inspection");
            $("#inspection_submit").removeClass("hidden");
            $("#inspection_type").removeClass("hidden");
        }
        else 
        if(result == 'mpi') 
        {
            $("#inspection_title").text("Magnetic Particle Inspection Report");
            $("#inspection_submit").removeClass("hidden");
            $("#inspection_type").removeClass("hidden");
        }
        else 
        if(result == 'ut') 
        {
            $("#inspection_title").text("Ultrasonic Inspection Report");
            $("#inspection_submit").removeClass("hidden");
            $("#inspection_type").removeClass("hidden");
        }
        else 
        if(result == 'select') 
        {
            $("#inspection_title").text("Select Inspection Type");
            $("#inspection_submit").addClass("hidden");
            $("#inspection_type").addClass("hidden");
        }


        getInspectionType(type_array[type]);

    });
</script>
