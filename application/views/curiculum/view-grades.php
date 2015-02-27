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
      <input id="search-class-record" type="submit" value="Search" class="btn btn-success">
    </div>
  </div>
</div>


<div class="loading hidden">
  <i class="fa fa-spin fa-refresh"></i> Loading ...
</div>
<div id="class-record-container">

</div> 
</div>
