<div class="row">
  <div class="col-xs-12">
    <input name="search_file" class="form-control" type="text" value="" placeholder="Search...">
  </div>
</div>

<br>

<div class="row">
  <div class="col-sm-6 col-xs-12">
    <select name="file_type" id="" class="form-control">
      <option value="">Select File Type</option>
      <option value="new">New</option>
      <option value="images">Images</option>
      <option value="text">Text</option>
      <option value="documents">Documents</option>
      <option value="others">Others</option>
    </select>
  </div>
  <div class="row visible-xs">
    <div class="col-xs-12"> <br>
    </div>
  </div>
  <div class="col-sm-3 col-xs-12">
    <select name="order" id="" class="form-control">
      <option value="">Order</option>
      <option value="ASC">Ascending</option>
      <option value="DESC">Descending</option>
    </select>
  </div>
  <div class="row visible-xs">
    <div class="col-xs-12"> <br>
    </div>
  </div>
  <div class="col-sm-3 col-xs-12">
    <button class="btn btn-primary btn-block" id="filter-file-list">Filter</button>
  </div>
</div>

<br>

<div class="row">
  <div id="file-list-container" class="col-xs-12">

  </div>
</div> 