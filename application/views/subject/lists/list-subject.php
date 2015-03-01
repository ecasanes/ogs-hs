<!-- start panel -->
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">List of Subjects</h3>
    <div class="panel-options">
    </div>
  </div>
  <div id="search-subject" class="panel-body">
    <div class="form-horizontal filter">
      <div class="row">
        <div class="col-sm-12 col-xs-12">
          School Year: 
          <select name="grade_level" id="">
            <option value="">All</option>
            <?php echo $school_year_dropdown; ?>
          </select>
          Year Level: 
          <select name="grade_level" id="">
            <option value="">All</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
          </select>
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-xs-12">
        <span class="loading hidden">
          <i class="fa fa-spin fa-refresh"></i> Loading...
        </span>
        <div class="search-results">

        </div>
      </div>
    </div>
  </div>
</div>
<!-- end panel -->