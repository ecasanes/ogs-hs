<?php

class Eddy_Current_Inspection_Model extends MY_Model {

	const DB_TABLE = 'eddy_current_inspection';
    const DB_TABLE_PK = 'id';
    const DB_DOCUMENT_TYPE = 'eddy-current-inspection';

	public function update_general_inspection( $id, $customer, $location, $po_num, $project, $report_num, $surface, $procede, 
                    $equipment, $serial_num, $client, $item, $drawing_num, $acceptance_standard, $material, $size, $quantity, 
            		$identification, $absolute_freq, $absolute_gain, $absolute_phase, $absolute_calibration, $absolute_serial, 
                    $bridge_freq, $bridge_gain, $bridge_phase, $bridge_calibration, $bridge_serial, $coating, $geometry, $heat_treatment,
                    $welding_process, $joint_type, $calibration_block, $scope, $restrictions, $results, $inspector, $signature, 
                    $date, $for_client, $for_certify ) {

                $db_table = $this::DB_TABLE;
                $db_primary = $this::DB_TABLE_PK;

                $sql = "UPDATE {$db_table} SET customer = ?, location = ?, po_num = ?, project = ?, report_num = ?, surface = ?, 
                        procede = ?,  equipment = ?,  inspection_type = ?,  serial_num = ?,  client = ?,  item = ?,  drawing_num = ?, 
                        acceptance_standard = ?, material = ?, size = ?, quantity = ?, identification = ?, absolute_freq = ?, 
                        absolute_gain = ?, absolute_phase = ?, absolute_calibration = ?, absolute_serial = ?, bridge_freq = ?, 
                        bridge_gain = ?, bridge_phase = ?, bridge_calibration = ?, bridge_serial = ?, coating = ?, geometry = ?,
                        heat_treatment = ?, welding_process = ?, joint_type = ?, calibration_block = ?, scope = ?, restrictions = ?,
                        results = ?, inspector = ?, signature = ?, date = ?, for_client = ?, for_certify = ?
                        WHERE {$db_primary} = ?";

                $escaped_values = array($customer, $location, $po_num, $project, $report_num, $surface, $procede, 
                        $equipment, $serial_num, $client, $item, $drawing_num, $acceptance_standard, $material, $size, $quantity, 
                        $identification, $absolute_freq, $absolute_gain, $absolute_phase, $absolute_calibration, $absolute_serial, 
                        $bridge_freq, $bridge_gain, $bridge_phase, $bridge_calibration, $bridge_serial, $coating, $geometry, $heat_treatment,
                        $welding_process, $joint_type, $calibration_block, $scope, $restrictions, $results, $inspector, $signature, 
                        $date, $for_client, $for_certify);

        $query = $this->db->query( $sql, $escaped_values );

        return $id;
    }


    public function add_eddy_current($customer, $location, $po_num, $project, $report_num, $surface, $procede, 
                    $equipment, $serial_num, $client, $item, $drawing_num, $acceptance_standard, $material, $size, $quantity, 
                    $identification, $absolute_freq, $absolute_gain, $absolute_phase, $absolute_calibration, $absolute_serial, 
                    $bridge_freq, $bridge_gain, $bridge_phase, $bridge_calibration, $bridge_serial, $coating, $geometry, $heat_treatment,
                    $welding_process, $joint_type, $calibration_block, $scope, $restrictions, $results, $inspector, $signature, 
                    $date, $for_client, $for_certify){

    	$db_table = $this::DB_TABLE;
        $db_primary = $this::DB_TABLE_PK;

        $sql = "INSERT INTO {$db_table} (customer, location, po_num, project, report_num, surface, procede, equipment,
                                        serial_num, client, item, drawing_num, acceptance_standard, material, size, quantity, 
                                        identification, absolute_freq, absolute_gain, absolute_phase, absolute_calibration, absolute_serial, 
                                        bridge_freq, bridge_gain, bridge_phase, bridge_calibration, bridge_serial, coating, geometry, heat_treatment,
                                        welding_process, joint_type, joint_type, calibration_block, scope, restrictions, results, inspector, signature,
                                        date, for_client, for_certify)
                VALUES (?, ?, ?, ?, ?, ? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,? ,?)";
           
           $escaped_values = array($customer, $location, $po_num, $project, $report_num, $surface, $procede, 
                        $equipment, $serial_num, $client, $item, $drawing_num, $acceptance_standard, $material, $size, $quantity, 
                        $identification, $absolute_freq, $absolute_gain, $absolute_phase, $absolute_calibration, $absolute_serial, 
                        $bridge_freq, $bridge_gain, $bridge_phase, $bridge_calibration, $bridge_serial, $coating, $geometry, $heat_treatment,
                        $welding_process, $joint_type, $calibration_block, $scope, $restrictions, $results, $inspector, $signature, 
                        $date, $for_client, $for_certify);

            $query = $this->db->query( $sql, $escaped_values );

            $last_insert_id = $this->db->insert_id();

            return $last_insert_id;
    }

}

?>