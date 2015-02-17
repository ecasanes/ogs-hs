<?php //var_dump($list); ?>
<table class="table table-condensed table-bordered">
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
    <?php 
      foreach($list as $ca):
        $cas = $ca->cas;
        $ce_id = $ca->critical_equipment_id;
        $asset_code = $ca->asset_code;
        $sce_name = $ca->sce_name;
        $tag_number = $ca->tag_number;
        $subsystem = $ca->subsystem_component;
        $code = $ca->code;
        $role_name = $ca->role_name;
        $ip_letter = $ca->ip_letter;
        if($cas == 'N/A'){
          $action = 'create/'.$ce_id;
        }else{
          $action = 'edit/'.$ce_id;
        }
    ?>

        <tr>
          <td><?php echo $asset_code; ?></td>
          <td><?php echo $sce_name; ?></td>
          <td><a href="<?php echo base_url('criticality-analysis/scoring/'.$action); ?>" data-id="<?php echo $ce_id; ?>"><?php echo $tag_number; ?></a></td>
          <td><?php echo $subsystem; ?></td>
          <td><?php echo $code; ?></td>
          <td><?php echo $role_name; ?></td>
          <td><?php echo $ip_letter; ?></td>
          <td>
            <?php
            if($cas == 'N/A'){
              ?>
                <?php echo $cas; ?>
              <?php
            }else{
              ?>
                <a href="" class="ca-details" data-id="<?php echo $ce_id; ?>" data-toggle="modal" data-target="#cas-details"><?php echo $cas; ?></a>
              <?php
            }
            ?>
            </td>
        </tr>
    <?php
      endforeach;
    ?>
    
  </tbody>
</table>