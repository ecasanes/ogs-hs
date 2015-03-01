<div class="row">
  <div class="col-sm-6 col-xs-12">

    <!-- start panel -->
    <div class="panel panel-primary">
      
      <div class="panel-heading">
        <h3 class="panel-title">Add Subject</h3>
        <div class="panel-options">
        </div>
      </div>
      <?php include('forms/add-form.php'); ?>
    </div>
    <!-- end panel -->


    
  </div>

  <div class="col-sm-6 col-xs-12">
    <?php include('lists/list-subject.php'); ?>
  </div>
</div>




<?php include('modals/delete-subject.php'); ?>
<?php include('modals/edit-subject.php'); ?>