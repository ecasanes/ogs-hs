<?php
	foreach($documents as $document):
		echo '<option value="'.$document->document_id.'">';
		echo $document->code . ': ' . $document->name;
		echo '</option>';
	endforeach;
?>

