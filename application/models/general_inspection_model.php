<?php

    class General_Inspection_Model extends MY_Model {

        const DB_SCHEMA = 'iso_redesign';
    	const DB_TABLE = 'general_inspection';
        const DB_TABLE_PK = 'id';
        const DB_DOCUMENT_TYPE = 'general-inspection';

        public function add_general_inspection($data)
        {
            $id = '';
            $db_schema = $this::DB_SCHEMA;
            $db_table = $this::DB_TABLE;

            $report_no = trim($data['report_no']);
            $customer = trim($data['customer']);
            $location = trim($data['location']);
            $procedure = trim($data['procedure']);
            $project = trim($data['project']);
            $surface = trim($data['surface']);
            $equipment = trim($data['equipment']);
            $equipment_serial_no = trim($data['equipment_serial_no']);
            $type_of_inspection = trim($data['type_of_inspection']);
            $item = trim($data['item']);
            $drawing_no = trim($data['drawing_no']);
            $specification = trim($data['specification']);

            $material = trim($data['material']);
            $size = trim($data['size']);
            $quantity = trim($data['quantity']);
            $scope = trim($data['scope']);
            $restrictions = trim($data['restrictions']);
            $inspection_results = trim($data['inspection_results']);
            $inspector = trim($data['inspector']);

            $date = trim($data['date']);
            $qual = trim($data['qual']);
            $for_client_use = trim($data['for_client_use']);
            $for_cert_auth = trim($data['for_cert_auth']);
            $serial_no = trim($data['serial_no']);
            $signature = trim($data['signature']);
            $purchase_no = trim($data['purchase_no']);
            

            $sql = "
                    INSERT INTO `iso_redesign`.`general_inspection_report`
                    (
                        `report_no`,`customer`,`location`,`procedure`,`project`,`surface`,`equipment`,`equipment_serial_no`,
                        `type_of_inspection`,`item`,`drawing_no`,`specification`,`material`,`size`,`quantity`,`scope`,`restrictions`,
                        `inspection_results`,`inspector`,`date`,`qual`,`for_client_use`,`for_cert_auth`,`serial_no`,`signature`,`purchase_no`)
                    VALUES
                    (
                        '$report_no','$customer','$location','$procedure','$project','$surface','$equipment','$equipment_serial_no',
                        '$type_of_inspection','$item','$drawing_no','$specification','$material','$size','$quantity','$scope','$restrictions',
                        '$inspection_results','$inspector','$date','$qual','$for_client_use','$for_cert_auth','$serial_no','$signature',
                        '$purchase_no'
                    );
            ";  

            $query = $this->db->query($sql);

            if($query) { $result = $report_no;  }
            else { $result = false; }
            
            return $result;
        }

        public function get_general_inspection($report_no)
        {
            $report_no = trim($report_no);

            $sql = "SELECT * FROM `iso_redesign`.`general_inspection_report` WHERE report_no = '$report_no'";
            $result = $this->db->query($sql)->row_array();

            return $result;
        }

        public function update_general_inspection($data)
        {
            // Get data.
            $db_schema = $this::DB_SCHEMA;
            $db_table = $this::DB_TABLE;

            $report_no = trim($data['report_no']);
            $customer = trim($data['customer']);
            $location = trim($data['location']);
            $procedure = trim($data['procedure']);
            $project = trim($data['project']);
            $surface = trim($data['surface']);
            $equipment = trim($data['equipment']);
            $equipment_serial_no = trim($data['equipment_serial_no']);
            $type_of_inspection = trim($data['type_of_inspection']);
            $item = trim($data['item']);
            $drawing_no = trim($data['drawing_no']);
            $specification = trim($data['specification']);

            $material = trim($data['material']);
            $size = trim($data['size']);
            $quantity = trim($data['quantity']);
            $scope = trim($data['scope']);
            $restrictions = trim($data['restrictions']);
            $inspection_results = trim($data['inspection_results']);
            $inspector = trim($data['inspector']);

            $date = trim($data['date']);
            $qual = trim($data['qual']);
            $for_client_use = trim($data['for_client_use']);
            $for_cert_auth = trim($data['for_cert_auth']);
            $serial_no = trim($data['serial_no']);
            $signature = trim($data['signature']);
            $purchase_no = trim($data['purchase_no']);
            
            // UPDATE statement.
            $sql = "
                   UPDATE `iso_redesign`.`general_inspection_report`
                    SET
                    `customer` = '$customer',
                    `location` = '$location',
                    `procedure` = '$procedure',
                    `project` = '$project',
                    `surface` = '$surface',
                    `equipment` = '$equipment',
                    `equipment_serial_no` = '$equipment_serial_no',
                    `type_of_inspection` = '$type_of_inspection',
                    `item` = '$item',
                    `drawing_no` = '$drawing_no',
                    `specification` = '$specification',
                    `material` = '$material',
                    `size` = '$size',
                    `quantity` = '$quantity',
                    `scope` = '$scope',
                    `restrictions` = '$restrictions',
                    `inspection_results` = '$inspection_results',
                    `inspector` = '$inspector',
                    `date` = '$date',
                    `qual` = '$qual',
                    `for_client_use` = '$for_client_use',
                    `for_cert_auth` = '$for_cert_auth',
                    `serial_no` = '$serial_no',
                    `signature` = '$signature',
                    `purchase_no` = '$purchase_no'

                    WHERE `report_no` = '$report_no';

            ";

            $result = $this->db->query($sql);

            return $result;
        }

    }
?>