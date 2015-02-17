<?php
	$tb_count = $document_model->count_document('technical-bulletin');
	$decf_count = $document_model->count_document('case-file');
	$basic_decf_count = $document_model->count_document('basic-decf');
	$ws_count = $document_model->count_document('witness-statement');
	$ofi_count = $document_model->count_document('ofi');
	$tq_count = $document_model->count_document('technical-query');
	$pp_count = $document_model->count_document('project-plan');
	$erp_count = $document_model->count_document('erp');

	$document_count = array(
		'tb_count' => $tb_count,
		'tq_count' => $tq_count,
		'pp_count' => $pp_count,
		'decf_count' => $decf_count,
		'basic_decf_count' => $basic_decf_count,
		'ws_count' => $ws_count,
		'ofi_count' => $ofi_count,
		'erp_count' => $erp_count
	);
?>