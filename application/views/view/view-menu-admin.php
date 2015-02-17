<?php 

	$attributes	=	array('method' => 'POST');
	$base_url = base_url('menu-admin/save/'.$menu_category_id);


 ?>
<section id="main-content">
    <div class="container">
        <div class="row custom-tooltip-container step-tooltip">
            <div class="custom-tooltip">
                <p>
                    Please take the time to complete the profile in detail. This is a reflection of your professionalism and commitment to attaining and sustaining excellence in your workplace. Once completed it will enable you and others to share and learn from your experience.
                    If you want to save and return later, simply click "save" at the bottom of the page.
                </p>
                <p>
                    If you want to attach any media or documents please save them as a PDF if possible and remember to take the opportunity to label them and any photos accurately, highlight areas of specific interest with arrows, descriptions, etc.
                </p>
                <p>
                    It is important to document all the activities involved in dealing with this particular issue and sharing the results in order for others to benefit fully.
                </p>
                <p>
                    This will be rated by others and you should be able to point to this submission with a level of satisfaction and pride in future when involved in either personal appraisals or when discussing promotion.
                </p>
            </div>
            <div class="col-xs-12">
                <div class="page-header">
                    <h2 class="step-title">Edit Menu Category <span class="tooltip-toggle help-icon"></span></h2>
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
                            <?php echo form_open($base_url, $attributes);  ?>
                                <div class="row content">
                                    <div class="col-xs-2 column-label">
                                        <label>Menu Type <span class="text-required">*</span></label>
                                    </div>
                                    <input type="hidden" name="menu_category_id" value="<?php echo $menu_category_id; ?>"></input>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <input type="text" name="menu_type" value="<?php echo $menu_type; ?>"class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-2 column-label">
                                        <label for="code">Description</label>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <input type="text" name="description" id="code" class="form-control" value="<?php echo $description; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <div class="col-sm-12">
								<div class="form-group text-right">
				                   <input type="submit" class="btn btn-primary"></input>
				                 </div>
							</div>
							</form>
                        </div>
                    </div>
                </div>
               
            </div>	

        </div>



    </div>
</section>