<?php

	if($action == 'rank'){
		$uri_string = uri_string();
		$this->session->set_userdata('redirect_link', $uri_string);
		$ranking_detail = $this->rank_document($id);

		//var_dump($ranking_detail);
		//foreach($ranking_details as $ranking_detail){
			$ranking_id = $ranking_detail->document_ranking_id;
			$ranking = $ranking_detail->ranking;
			$ranking_like = $ranking_detail->ranking_like;
			$ranking_comment = $ranking_detail->ranking_comment;
		//}

		$model_data['ranking_id'] = $ranking_id;
		$model_data['ranking'] = $ranking;
		$model_data['ranking_like'] = $ranking_like;
		$model_data['ranking_comment'] = $ranking_comment;
		$model_data['ranking_user_id'] = $current_user_id;
	}

?>