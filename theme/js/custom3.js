// Make array var.
var Module = {};

$.ajaxSetup({
    data: {
        "9s8fjshd324hd98s": $.cookie('k34lk3sdf08sdf34ddfr0')
    }
});


(function($) {
    $.fn.outerHTML = function() {
        return $(this).clone().wrap('<div></div>').parent().html();
    };
})(jQuery);

function error_input_keyup(){

	var $error = $('.error');

	$(document).on('keyup', '.error', function() {
		console.log('error');
		var $this = $(this);
		$this.removeClass('error');
	});
}

error_input_keyup();




Module.Instructor = (function() {

	function add_instructor(){

		var $form = $('#add-instructor-form');

		$form.submit(function(e){
			e.preventDefault();
			var $this = $(this);
			
			var post_data = $this.serializeArray();

			$.ajax({
				url: base_url + 'teacher/insert',
				method: "post",
				dataType: "json",
				data: post_data,
				beforeSend: function(data){
					
				},
				success: function(data) {
					console.log(data);

					var username = data.username;
					var confirm_password = data.confirm_password;
					var username_message = data.username_message;
					var password_message = data.password_message;
					var success_message = data.success_message;
					var result = data.result;

					console.log(username);

					var $username = $this.find('[name=username]');
					var $password = $this.find('[name=password]');
					var $confirm_password = $this.find('[name=confirm_password]');

					$this.find('.error-message').text('');
					$this.find('.success-message').text('');

					if(username == 'failed'){
						$username.addClass('error');
						$this.find('.error-message').append(username_message);
					}else{
						$username.removeClass('error');
					}

					if(confirm_password == 'failed'){
						$password.addClass('error');
						$confirm_password.addClass('error');
						$this.find('.error-message').append(password_message);
					}else{
						$password.removeClass('error');
						$confirm_password.removeClass('error');
					}

					

					if(result != 'failed'){
						$this.find('.success-message').text(success_message);
						$this.find('input,select').not('[type=submit]').val('');
						refresh_instructor_list(true);
					}


				},
				complete: function(data){
					
				},
				error: function(error, data){
					console.log(error.responseText);
				}

			});
		});
	}


	function search_instructor(){

		var $search_instructor = $('#search-instructor');
		var $search_results = $search_instructor.find('.search-results');
		var $search_input = $search_instructor.find('[name=search]');

		
		var $loading = $search_instructor.find('.loading');

		$(document).on('keyup', '#search-instructor-input', function(e){

			var $this = $(this);
			var search_key = $this.val();
			
			$.ajax({
				url: base_url + 'teacher/search_list',
				method: "get",
				data: {"search": search_key},
				dataType: "html",
				beforeSend: function(data){
					
					$search_results.html('');

					$loading.removeClass('hidden');
				},
				success: function(data) {
					$search_results.html(data);
				},
				complete: function(data){
					$loading.addClass('hidden');
				},
				error: function(error, data){
					console.log(error.responseText);
				}

			});

		});
		
	}


	function refresh_instructor_list(retain_height){

		var retain_height = retain_height || false;

		var $search_instructor = $('#search-instructor');
		var $search_results = $search_instructor.find('.search-results');
		
		var $loading = $search_instructor.find('.loading');
		
		if(retain_height){
			var height = $search_results.height();
		}
		

		$.ajax({
				url: base_url + 'teacher/data_list',
				method: "post",
				dataType: "html",
				beforeSend: function(data){

					if(retain_height){
						$search_results.height(height);
					}
					
					$search_results.html('');

					$loading.removeClass('hidden');
				},
				success: function(data) {
					$search_results.html(data);
				},
				complete: function(data){
					$loading.addClass('hidden');
					$search_results.height('auto');
				},
				error: function(error, data){
					console.log(error.responseText);
				}

			});

	}




	return {
		add_instructor: add_instructor,
		search_instructor: search_instructor,
		refresh_instructor_list: refresh_instructor_list
	}

})();
