<?php

	

	if(!isset($current_page_name)){
		$current_page_name = '';
	}

	$breadcrumbs = $this->generate_breadcrumbs($this->parent_name, $this->parent_uri, $current_page_name);

	$header_data['breadcrumbs'] = $breadcrumbs;

	$header_data['current_page_name'] = $current_page_name;
	

?>