var Module = {};

Module.Paginate_Action_Tracks = (function() {
	// Listener for paginated links.
	// Listen again.
	function listen_pagination_links() {
		$('#paginated-links a').click(function() {
			// Get link url.
			console.log(this);
		
			/*var $page = $(this).html();
			alert($page);*/

			var $data = {"limit": 0, "offset": 5 };

			// Change dom.
			/*$.ajax({
				url: base_url + 'action_tracker/ajax_action_tracker',
			

			});*/

			return false;
		});
	}

	function change_action_tracks(limit, offset) {

	}

	return {
		listen_pagination_links: listen_pagination_links
	}
	
})();