<?php


  $id = $this->uri->segment(3);
  $edit_mcdr = base_url('mcdr/edit/'.$id);
  $cover_title = "Material/Corrosion Damage Report";
  $edit_form = base_url('mcdr/edit/'.$id);

  $edit_text = '<span class="glyphicon glyphicon-pencil"></span>';
  $edit_button_type = 'button';

  $edit_step_0_title = array('title' => 'Edit MCDR');

  $edit_step_0_link = display_link($edit_form.'/0', $edit_text, $edit_button_type, $editable, $edit_step_0_title);
?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title">View Material/Corrosion Damage Report</h4>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-sm-12">
        <div class="page-header">
          <div class="col-sm-12">
            <p class="visible-print content-title" align="center" style="size: 20px;">
              <?php echo $name; ?>
            </p>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-10">
        <h4 class="content-title">MCDR</h4>
      </div>
      <div class="col-xs-2 text-right">
        <p class="btn btn-print">Page 2 of 6</p>
        <?php echo $edit_step_0_link; ?>
      </div>
    </div>

    <div class="row-table table-responsive">
      <table class="table table-bordered view-casefile mcdr-view-table">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary" colspan="2"><b>Installation</b></td>
            <td class="table-label label-large bg-grey-primary" colspan="3"><b>I.d. Tag / Line No.</b></td>
            <td class="table-label label-large bg-grey-primary"><b>Maximo WO No.</b></td>
            <td class="table-label label-medium bg-grey-primary"><b>Date Reported</b></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo $installation; ?></td>
            <td colspan="3"><?php echo $id_tag_line_no; ?></td>
            <td><?php echo $maximo_wo_no; ?></td>
            <td><?php echo $date_reported; ?></td>
          </tr>
          <tr>
            <td class="fixed-medium-width">Module</td>
            <td class="fixed-medium-width"><?php  echo $module; ?></td>
            <td><i>From ACET</i></td>
            <td>Design</td>
            <td>Operating</td>
            <td>MCDR raised by</td>
            <td><?php  echo $mcdr_raised_by; ?></td>
          </tr>
          <tr>
            <td>Location <i>(next to)</i></td>
            <td><?php echo $location; ?></td>
            <td>Pressure <i>(barg)</i></td>
            <td><?php echo $pressure_design; ?></td>
            <td><?php echo $pressure_operating; ?></td>
            <td>Date of last inspection</td>
            <td><?php echo $date_of_last_inspection; ?></td>
          </tr>
          <tr>
            <td>System</td>
            <td><?php echo $system; ?></td>
            <td>Temp (<i>&deg;C</i>)</td>
            <td><?php echo $temp_design; ?></td>
            <td><?php echo $temp_operating; ?></td>
            <td>Est. Time in service <i>(yrs)</i></td>
            <td><?php echo $estimated_time_of_service; ?></td>
          </tr>
          <tr>
            <td>Safety Critical <i>(Y/N)</i></td>
            <td><?php echo $safety_critical; ?></td>
            <td>Flow <i>(m/s)</i></td>
            <td><?php echo $flow_design; ?></td>
            <td><?php echo $flow_operating; ?></td>
            <td>Other MCDR's</td>
            <td><?php echo $other_mcdr; ?></td>
          </tr>
          <tr>
            <td>PS No.</td>
            <td><?php echo $ps_no; ?></td>
            <td>Process</td>
            <td colspan="2"><?php echo $process; ?></td>
            <td>Related Reports</td>
            <td><?php echo $related_reports; ?></td>
          </tr>
        </tbody>
      </table>

      <table class="table table-bordered view-casefile mcdr-view-table">
        <tbody>
          <tr>
            <td class="table-label label-large bg-grey-primary" colspan="2"><b>Details of Anomaly Item (<i>from ACET</i>)</b></td>
            <td class="table-label label-large bg-grey-primary" colspan="2"><b>Details of Future</b></td>
            <td class="table-label label-large bg-grey-primary" colspan="2"><b>Current Status</b></td>
          </tr>
          <tr>
            <td class="fixed-medium-width">Material Type</td>
            <td><?php echo $material_type; ?></td>
            <td class="fixed-large-width">Degradation Type</td>
            <td><?php echo $degradation_type; ?></td>
            <td class="fixed-large-width">Added to MCDR Register (<i>Y/N</i>)</td>
            <td><?php echo $added_to_mcdr_register; ?></td>
          </tr>
          <tr>
            <td>Component Size <i>(mm)</i></td>
            <td><?php echo $component_size; ?></td>
            <td>Degradation Mechanism</td>
            <td><?php echo $degradation_mechanism; ?></td>
            <td>Temp Repair Applied <i>(Y/N)</i></td>
            <td><?php echo $temp_repair_applied; ?></td>
          </tr>
          <tr>
            <td>Schedule</td>
            <td><?php echo $schedule; ?></td>
            <td>Pitting Depth</td>
            <td><?php echo $pitting_depth; ?></td>
            <td>Type of Repair</td>
            <td><?php echo $type_of_repair; ?></td>
          </tr>
          <tr>
            <td>NWT <i>(mm)</i></td>
            <td><?php echo $nwt; ?></td>
            <td>Extent</td>
            <td><?php echo $extent; ?></td>
            <td>Leaking <i>(Y/N)</i></td>
            <td><?php echo $leaking; ?></td>
          </tr>
          <tr>
            <td>DCA <i>(mm)</i></td>
            <td><?php echo $dca; ?></td>
            <td>Area <i>(mm&sup2;)</i></td>
            <td><?php echo $area; ?></td>
            <td>Temp. Repair Reg. No.</td>
            <td><?php echo $temp_repair_reg_no; ?></td>
          </tr>
          <tr>
            <td>PS MAWT <i>(mm)</i></td>
            <td><?php echo $ps_mawt; ?></td>
            <td>MRWT <i>(mm)</i></td>
            <td><?php echo $mrwt; ?></td>
            <td>Remedial Action Type</td>
            <td><?php echo $remedial_action_type; ?></td>
          </tr>
          <tr>
            <td>Equipment Type</td>
            <td><?php echo $equipment_type; ?></td>
            <td>Corrosion Grading <i>(A,B,C,D)</i></td>
            <td><?php echo $corrosion_grading; ?></td>
            <td>Fabric maint. priority <i>(H,M,L)</i></td>
            <td><?php echo $fabric_maint_priority; ?></td>
          </tr>
          <tr>
            <td>Component</td>
            <td><?php echo $component; ?></td>
            <td>Other Remarks</td>
            <td><?php echo $other_remarks ?></td>
            <td>Target Close-out Date <i>(MMYY)</i></td>
            <td><?php echo $target_close_out_date; ?></td>
          </tr>
          <tr>
            <td>Area on component</td>
            <td><?php echo $area_on_component; ?></td>
            <td class="table-label label-large bg-grey-primary" colspan="2"><b>Key Performance Indicators</b></td>
            <td class="table-label label-large bg-grey-primary" colspan="2"><b>Drawings, P&amp;ID, etc</b></td>
          </tr>
          <tr>
            <td>Coating System Details</td>
            <td><?php echo $coating_system_details; ?></td>
            <td>Leak</td>
            <td><?php echo $leak; ?></td>
            <td colspan="2"><?php echo $drawings_pid_etc; ?></td>
          </tr>
          <tr>
            <td>Insulated / Class</td>
            <td><?php echo $insulated_class; ?></td>
            <td>Deferment</td>
            <td><?php echo $deferment; ?></td>
            <td colspan="2"><?php  ?></td>
          </tr>
        </tbody>
      </table>
    </div>


  </div>
</div>