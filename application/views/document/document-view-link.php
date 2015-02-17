<?php

$document_type = $controller;
$id = $this->uri->segment(3, '');
$view_url = base_url($document_type.'/view/'.$id);

?>
<div class="panel-options">
    <a href="<?php echo $view_url; ?>" data-toggle="tooltip" data-original-title="View Document"><i class="fa fa-lg fa-th-list text-success"></i></a>
</div>