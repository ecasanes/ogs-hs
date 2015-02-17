<?php

	$id = $this->uri->segment(3);
	$cover_title = "Menu";





?>
<section id="main-content">
	<div class="container">

		<div class="row">
			<div class="col-xs-12">
				<div id="casefile-view-header" class="page-header">
					<div class="row">
						<div class="col-sm-3">
							<h1>Menu Admin</h1>
						</div>
						<div class="col-sm-9 text-right">
							<a href="<?php echo base_url('page/tech-help'); ?>" class="btn btn-success btn-larger" data-toggle="tooltip" data-placement="left" title="Tech Help"><span class="glyphicon glyphicon-question-sign"></span></a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- add menu-->
		<div id="case-file-table" class="row">
			<div class="col-xs-12">
				<div class="page-header">
				  <h1>Add Menu Deep Subcategory</h1>
				</div>
				<div class="row">
						<form class="" role="form" id="add_menu_deep_subcategory">
							<div class="form-group col-md-2">
						    	<label class="sr-only" for="">Name</label>
						    	<input type="" class="form-control" name="name" placeholder="Name">
						  	</div>
						  	<div class="form-group col-md-2">
						    	<label  class="sr-only" for="">Description</label>
						    	<input type="" class="form-control" name="description" placeholder="description">
						  	</div>
						  	<div class="form-group col-md-2">
						    	<label class="sr-only" for="">Color Class</label>
						    	<input type="" class="form-control" name="color_class" placeholder="color class">
						  	</div>
						  	<div class="form-group col-md-2">
						    	<label class="sr-only" for="">Code</label>
						    	<input type="" class="form-control" name="code" placeholder="code">
						  	</div>
						  	<div class="form-group col-md-2">
						    	<label class="sr-only"  for="">Menu Subcategory</label>
						    	<select class="form-control" name="menu_category_id">
						           	<?php
						           		foreach($menu_subcategory_records as $menu_record){
						          			$cat_id = $menu_record->menu_subcategory_id;
						         			$type = $menu_record->name;
						         			?>
						           		<option value="<?php echo $cat_id ?>" 
						           			><?php echo $type ?></option>
						           	<?php } ?>
								</select>
						  	</div>
		                                
		                    <div class="form-group col-md-2">
		                        <input class="btn btn-primary" type="submit"></input>
		                    </div>
		                </form>

		        </div>    
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div id="my-account-panel" class="panel panel-primary">


		<!-- CASE FILES -->
		<div id="case-file-table" class="row">
			<div class="col-xs-12">
				<div class="page-header">
				  <h1>Menu Deep Subcategory</h1>
				</div>
			</div>
		</div>

		<!-- dropdown selector -->
		<div class="row">
			<div class="col-sm-3 col-sm-offset-9">
				<select class="form-control input-sm" name="menu_category_id" id="selectMenuCategory">
					<?php
						foreach($menu_subcategory_records as $menu_record){
							$cat_id = $menu_record->menu_subcategory_id;
							$type = $menu_record->name;
				           	?>
				        <option value="<?php echo $cat_id?>"><?php  echo $type ?></option>
					<?php } ?>
				</select>
			</div>
		</div> 

		<br />
		<div class="row-table table-responsive">
		<!--testing add form -->
		<form role="form">	
	      <table id="menu_table" class="table table-bordered my-account">
	        <thead>
	          <tr>
	            <th class="id">ID</th>
	            <th class="case-file">Name</th>
	            <th class="code">Description</th>
	            <th class="code">Color Class</th>
	            <th class="code">Code</th>
	            <th class="case-file">Menu</th>
	            <th class="code">Action</th>
	          </tr>
	        </thead>
	        <tbody>
	        	<?php

	        	//var_dump($results);

	        		foreach($results as $result){

						$menu_deep_subcategory_id = $result->menu_deep_subcategory_id;
						$name = $result->name;
						$description = $result->description;
						$color_class = $result->color_class;
						$code = $result->code;
						$name = $result->name;
						$menu_subcategory_id = $result->menu_subcategory_id;
						?>

						<tr id="data-row-<?php echo $menu_deep_subcategory_id ?>">
				           <td><?php echo $menu_deep_subcategory_id; ?></td>
				           <td><div class="form-group">
				           		<input type="" class="form-control input-sm" name="name" id="" placeholder="name" value="<?php echo $name; ?>">
				           	</div>
				           </td>
				           <td><div class="form-group">
				           		<input type="" class="form-control input-sm" name="description" id="" placeholder="description" value="<?php echo $description; ?>">
				           	</div>
				           </td>
				           <td><div class="form-group">
				           		<input type="" class="form-control input-sm" name="color_class" id="" placeholder="color class" value="<?php echo $color_class; ?>">
				           	</div>
				           	</td>
				           <td><div class="form-group">
				           		<input type="" class="form-control input-sm" name="code" id="" placeholder="code" value="<?php echo $code; ?>">
				           	</div>
				           	</td>
				           <td><select class="form-control input-sm" name="menu_category_id">
				           		<?php
				           			foreach($menu_subcategory_records as $menu_record){
				           				$cat_id = $menu_record->menu_subcategory_id;
				           				$type = $menu_record->name;
				           				?>
				           			<option value="<?php echo $cat_id?>" 
				           				<?php 
				           					if($menu_subcategory_id==$cat_id){
				           						echo 'selected';
				           					}
				           				?>
				           				><?php echo $type ?></option>
				           			<?php }
				           		?>
								</select>
							</td>
							<td>
								<input class="btn btn-primary btn-sm btn-update-deep-subcategory" type="submit"></input>
							</td>
				        </tr>

					<?php } ?>
	          
	         
	        </tbody>
	      </table>
	  	</form>
	      <br>
	    
	     
    	</div>

		</div>
	</div>
</div>



	</div>
</section>