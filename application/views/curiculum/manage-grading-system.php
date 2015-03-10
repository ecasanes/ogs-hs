<div id="view-class-record">
  <div class="form-horizontal">
  <div class="form-group">
    <label for="school_year" class="control-label col-sm-2 col-xs-12">School Year</label>
    <div class="col-sm-2 col-xs-12">
      <select name="school_year" id="" class="form-control" required>
        <?php echo $school_year_dropdown; ?>
      </select>
    </div>

    <div class="col-sm-1 col-xs-12">
      <input id="search-grade-system" type="submit" value="Search" class="btn btn-success">
    </div>
  </div>
</div>


<div class="loading hidden">
  <i class="fa fa-spin fa-refresh"></i> Loading ...
</div>
<div id="grade-system-container">

</div> 
</div>


<div class="modal fade" id="column-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Would you like to contiue? <span class="tag"></span></h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary go-no" data-dismiss="modal"> No</button>
        <button type="submit" class="btn btn-danger go-yes"> Yes</button>
      </div>
    </div>
  </div>
</div>
