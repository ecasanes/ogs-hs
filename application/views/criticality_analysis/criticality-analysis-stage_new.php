<table class="table table-condensed table-bordered data-table">
  <thead>
    <tr>
      <th>Asset</th>
      <th>Parent SCE</th>
      <th>Tag No</th>
      <th>Sub System / Equipment Description</th>
      <th>Code</th>
      <th>Primary Role</th>
      <th>Inspection Frequency</th>
      <th>CAS</th>
    </tr>
  </thead>

  <tbody>
    <?php foreach ($result as $data): ?>
      <tr>
        
        <td><?php print($data->asset_code) ?></td>

        <td><?php print($data->sce_name) ?></td>

        <td><?php print($data->tag_number) ?></td>

        <td><?php print($data->subsystem_component) ?></td>
        <!--  -->
        <td><?php print($data->code) ?></td>

        <td><?php print($data->role_name) ?></td>

        <td><?php print($data->ip_letter) ?></td>

        <td><?php print($data->cas == 'N/A' ? $data->cas : '<a>'.$data->cas.'</a>') ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<script type="text/javascript">
  $(document).ready(function() {
    $('.data-table').dataTable();
  });
</script>