
  

  <div class="modal-body">
        
        <table class="table table-bordered">
          <?php foreach ($total_scoring_details as $data): ?>
            <tr>
              <td><?php print($data['NAME']) ?></td>
              <td><?php print($data['total']) ?></td>
            </tr>
          <?php endforeach ?>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a class="btn btn-success" href="<?php echo base_url('criticality_analysis/scoring/edit/'.$id); ?>" data-id="" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
      </div>