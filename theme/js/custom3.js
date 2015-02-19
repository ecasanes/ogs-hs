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




Module.User = (function() {

	function add_user(){

		var $form = $('#add-user-form');

		$form.submit(function(e){
			e.preventDefault();
			var $this = $(this);
			
			var post_data = $this.serializeArray();

			console.log(post_data);

			$.ajax({
				url: base_url + controller + '/create_user',
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
						$this.find('.success-message').text(success_message).fadeOut(3000);
						$this.find('input,select').not('[type=submit], input[type=hidden]').val('');
						refresh_user_list(true);
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


	function search_user(){

		var $search_user = $('#search-user');
		var $search_results = $search_user.find('.search-results');
		var $search_input = $search_user.find('[name=search]');

		
		var $loading = $search_user.find('.loading');

		$(document).on('keyup', '#search-user-input', function(e){

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


	function refresh_user_list(retain_height){

		var retain_height = retain_height || false;

		var $search_user = $('#search-user');
		var $search_results = $search_user.find('.search-results');
		
		var $loading = $search_user.find('.loading');
		
		if(retain_height){
			var height = $search_results.height();
		}
		

		$.ajax({
				url: base_url + controller + '/data_list',
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
		add_user: add_user,
		search_user: search_user,
		refresh_user_list: refresh_user_list
	}

})();


Module.Subject = (function() {

	function add_subject(){

		var $form = $('#add-subject-form');

		$form.submit(function(e){
			e.preventDefault();
			var $this = $(this);
			
			var post_data = $this.serializeArray();

			console.log(post_data);

			$.ajax({
				url: base_url + controller + '/create_subject',
				method: "post",
				dataType: "json",
				data: post_data,
				beforeSend: function(data){
					
				},
				success: function(data) {
					console.log(data);

					var subject_code = data.subject_code;
					var subject_code_message = data.subject_code_message;
					var success_message = data.success_message;
					var result = data.result;

					var $subject_code = $this.find('[name=subject_code]');

					$this.find('.error-message').text('');
					$this.find('.success-message').text('');

					if(subject_code == 'failed'){
						$subject_code.addClass('error');
						$this.find('.error-message').append(subject_code_message);
					}else{
						$subject_code.removeClass('error');
					}

					

					if(result != 'failed'){
						$this.find('.success-message').text(success_message).fadeOut(3000);
						$this.find('input,select').not('[type=submit], input[type=hidden]').val('');
						refresh_subject_list(true);
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


	function refresh_subject_list(retain_height){

		var retain_height = retain_height || false;

		var $search_subject = $('#search-subject');
		var $search_results = $search_subject.find('.search-results');
		
		var $loading = $search_subject.find('.loading');
		
		if(retain_height){
			var height = $search_results.height();
		}
		

		$.ajax({
				url: base_url + controller + '/data_list',
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
		add_subject: add_subject,
		refresh_subject_list: refresh_subject_list
	}

})();


Module.Curiculum = (function() {

	function add_grade_level(){

		var $form = $('#add-grade-level-form');

		$form.submit(function(e){
			e.preventDefault();
			var $this = $(this);
			
			var post_data = $this.serializeArray();

			console.log(post_data);

			$.ajax({
				url: base_url + controller + '/create_grade_level',
				method: "post",
				dataType: "json",
				data: post_data,
				beforeSend: function(data){
					
				},
				success: function(data) {
					console.log(data);

					var grade_level = data.grade_level;
					var grade_level_message = data.grade_level_message;
					var success_message = data.success_message;
					var result = data.result;

					var $grade_level = $this.find('[name=grade_level]');
					var $sy_start = $this.find('[name=sy_start]');
					var $sy_end = $this.find('[name=sy_end]');

					$this.find('.error-message').text('');
					$this.find('.success-message').text('');

					if(grade_level == 'failed'){
						$grade_level.addClass('error');
						$sy_start.addClass('error');
						$sy_end.addClass('error');
						$this.find('.error-message').append(grade_level_message);
					}else{
						$grade_level.removeClass('error');
						$sy_start.removeClass('error');
						$sy_end.removeClass('error');
					}

					

					if(result != 'failed'){
						$this.find('.success-message').text(success_message).fadeOut(3000);
						$this.find('input,select').not('[type=submit], input[type=hidden]').val('');
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




	return {
		add_grade_level: add_grade_level
	}

})();
