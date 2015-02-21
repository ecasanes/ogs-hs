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

function select_enhancements(){

    $('.select2-dropdown').select2();
}

select_enhancements();
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

	function manage_grades(){

		var $form = $('#manage-grade-form');
		var $school_year = $form.find('[name=school_year]');
		var $grade_level = $form.find('[name=grade_level]');
		var $section = $form.find('[name=section]');
		var $subject = $form.find('[name=subject]');
		var $user = $form.find('[name=student]');

		var $section_container = $form.find('.section');
		var $subject_container = $form.find('.subject');

		$school_year.change(function(e){

			var $this = $(this);

			var school_year = $this.val();
			var grade_level = $grade_level.val();

			if(grade_level != null && grade_level != null){

				get_section_dropdown($section_container, school_year, grade_level);

			}else{
				get_section_dropdown($section_container);
			}
		});


		$grade_level.change(function(e){

			var $this = $(this);

			var school_year = $school_year.val();
			var grade_level = $this.val();

			if(school_year != null && grade_level != null){

				get_section_dropdown($section_container, school_year, grade_level);

			}else{
				get_section_dropdown($section_container);
			}
		});

		$section.change(function(e){

			var $this = $(this);

			var section = $section.val();

			if(section != null){

				get_subject_dropdown($subject_container, section, null, null, "offered");

			}else{
				get_subject_dropdown($subject_container, null, null, null, "offered");
			}
		});
	}

	function enroll_student(){

		var $form = $('#enroll-student-form');
		var $school_year = $form.find('[name=school_year]');
		var $grade_level = $form.find('[name=grade_level]');
		var $section = $form.find('[name=section]');
		var $user = $form.find('[name=student]');

		var $section_container = $form.find('.section');

		$school_year.change(function(e){

			var $this = $(this);

			var school_year = $this.val();
			var grade_level = $grade_level.val();

			if(grade_level != null && grade_level != null){

				get_section_dropdown($section_container, school_year, grade_level);

			}else{
				get_section_dropdown($section_container);
			}
		});


		$grade_level.change(function(e){

			var $this = $(this);

			var school_year = $school_year.val();
			var grade_level = $this.val();

			if(school_year != null && grade_level != null){

				get_section_dropdown($section_container, school_year, grade_level);

			}else{
				get_section_dropdown($section_container);
			}
		});
	}

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

					//var $grade_level = $this.find('[name=grade_level]');
					var $sy_start = $this.find('[name=sy_start]');
					var $sy_end = $this.find('[name=sy_end]');

					$this.find('.error-message').text('');
					$this.find('.success-message').text('');

					if(grade_level == 'failed'){
						//$grade_level.addClass('error');
						$sy_start.addClass('error');
						$sy_end.addClass('error');
						$this.find('.error-message').append(grade_level_message);
					}else{
						//$grade_level.removeClass('error');
						$sy_start.removeClass('error');
						$sy_end.removeClass('error');
					}

					

					if(result != 'failed'){
						$this.find('.success-message').text(success_message).fadeOut(5000);
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

	function offer_subject(){

		var $form = $('#assign-subject-to-section-form');
		var $school_year = $form.find('[name=school_year]');
		var $grade_level = $form.find('[name=grade_level]');
		var $section = $form.find('[name=section]');
		var $subject = $form.find('[name=subject]');

		var $section_container = $form.find('.section');
		var $subject_container = $form.find('.subject');

		$school_year.change(function(e){

			var $this = $(this);

			var school_year = $this.val();
			var grade_level = $grade_level.val();

			if(grade_level != null && grade_level != null){

				get_section_dropdown($section_container, school_year, grade_level);

			}else{
				get_section_dropdown($section_container);
			}
		});


		$grade_level.change(function(e){

			var $this = $(this);

			var school_year = $school_year.val();
			var grade_level = $this.val();

			if(school_year != null && grade_level != null){

				get_section_dropdown($section_container, school_year, grade_level);

			}else{
				get_section_dropdown($section_container);
			}
		});


		$section.change(function(e){

			var $this = $(this);

			var section = $section.val();

			if(section != null){

				get_subject_dropdown($subject_container, section);

			}else{
				get_subject_dropdown($subject_container);
			}
		});
	}

	function assign_instructor(){

		var $form = $('#assign-instructor-form');
		var $school_year = $form.find('[name=school_year]');
		var $grade_level = $form.find('[name=grade_level]');
		var $section = $form.find('[name=section]');
		var $subject = $form.find('[name=subject]');
		var $user = $form.find('[name=user]');

		var $section_container = $form.find('.section');
		var $subject_container = $form.find('.subject');
		var $user_container = $form.find('.user');

		$school_year.change(function(e){

			var $this = $(this);

			var school_year = $this.val();
			var grade_level = $grade_level.val();

			if(grade_level != null && grade_level != null){

				get_section_dropdown($section_container, school_year, grade_level);

			}else{
				get_section_dropdown($section_container);
			}
		});


		$grade_level.change(function(e){

			var $this = $(this);

			var school_year = $school_year.val();
			var grade_level = $this.val();

			if(school_year != null && grade_level != null){

				get_section_dropdown($section_container, school_year, grade_level);

			}else{
				get_section_dropdown($section_container);
			}
		});


		$section.change(function(e){

			var $this = $(this);

			var section = $this.val();
			var school_year = $school_year.val();
			var grade_level = $grade_level.val();

			if(section != null){

				get_subject_dropdown($subject_container, section, school_year, grade_level,  "not_assigned");

			}else{
				get_subject_dropdown($subject_container, null, null, null, "not_assigned");
			}
		});


		$subject.change(function(e){

			var $this = $(this);

			var section = $section.val();
			var subject = $this.val();

			if(section != null && subject != null){

				get_user_dropdown($user_container, section, subject);

			}else{
				get_user_dropdown($user_container);
			}
		});
	} 

	function get_section_dropdown($section_container, school_year, grade_level){

		var school_year = school_year || null;
		var grade_level = grade_level || null;

		$loading = $section_container.find('.loading');
		$requirements = $section_container.find('.requirements');
		$not_found = $section_container.find('.not-found');
		$select = $section_container.find('[name=section]');

		if(school_year === null && grade_level === null){
			$not_found.addClass('hidden');
			$loading.addClass('hidden');
			$requirements.removeClass('hidden');
			$select.addClass('hidden');
			$select.prop('disabled', true);
		}else{
			$.ajax({
				url: base_url + 'curiculum/section_dropdown_by_info',
				method: "get",
				data: {"school_year": school_year, "grade_level":grade_level },
				dataType: "json",
				beforeSend: function(data){

					$loading.removeClass('hidden');
					$requirements.addClass('hidden');

				},
				success: function(data) {

					console.log(data);

					var content = data.html;
					var success = data.success;

					if(success){
						$select.html(content);
						$not_found.addClass('hidden');
						$select.prop('disabled', false);
						$select.removeClass('hidden');
						$loading.addClass('hidden');
						$requirements.addClass('hidden');
					}else{
						$not_found.removeClass('hidden');
						$loading.addClass('hidden');
						$requirements.addClass('hidden');
						$select.addClass('hidden');
						$select.prop('disabled', true);
					}
					
				},
				complete: function(data){
					
				},
				error: function(error, data){
					console.log(error.responseText);
				}

			});
		}
	}

	function get_subject_dropdown($subject_container, section, school_year, grade_level, type){

		var section = section || null;
		var type = type || 'not_offered';

		var ajax_url = "";
		var ajax_data;

		switch(type){
			case "not_offered":
				ajax_url = base_url + "curiculum/subjects_not_offered_dropdown_by_info";
				ajax_data = {"section": section };
				break;

			case "not_assigned":
				ajax_url = base_url + "curiculum/subjects_not_assigned_dropdown_by_info";
				ajax_data = {"section": section, "school_year": school_year, "grade_level": grade_level };
				break;

			case "offered":
				ajax_url = base_url + "curiculum/subjects_offered_dropdown_by_info";
				ajax_data = {"section": section };
				break;
		}

		$loading = $subject_container.find('.loading');
		$requirements = $subject_container.find('.requirements');
		$not_found = $subject_container.find('.not-found');
		$select = $subject_container.find('[name=subject]');

		if(section === null){
			$not_found.addClass('hidden');
			$loading.addClass('hidden');
			$requirements.removeClass('hidden');
			$select.addClass('hidden');
			$select.prop('disabled', true);
		}else{
			$.ajax({
				url: ajax_url,
				method: "get",
				data: ajax_data,
				dataType: "json",
				beforeSend: function(data){

					$loading.removeClass('hidden');
					$requirements.addClass('hidden');

				},
				success: function(data) {

					var content = data.html;
					var success = data.success;

					if(success){
						$select.html(content);
						$not_found.addClass('hidden');
						$select.prop('disabled', false);
						$select.removeClass('hidden');
						$loading.addClass('hidden');
						$requirements.addClass('hidden');
					}else{
						$not_found.removeClass('hidden');
						$loading.addClass('hidden');
						$requirements.addClass('hidden');
						$select.addClass('hidden');
						$select.prop('disabled', true);
					}
					
				},
				complete: function(data){
					
				},
				error: function(error, data){
					console.log(error.responseText);
				}

			});
		}
	}

	function get_user_dropdown($user_container, section, subject){

		var section = section || null;
		var subject = subject || null;

		$loading = $user_container.find('.loading');
		$requirements = $user_container.find('.requirements');
		$not_found = $user_container.find('.not-found');
		$select = $user_container.find('[name=user]');

		if(section === null && subject === null){
			$not_found.addClass('hidden');
			$loading.addClass('hidden');
			$requirements.removeClass('hidden');
			$select.addClass('hidden');
			$select.prop('disabled', true);
		}else{
			$.ajax({
				url: base_url + 'curiculum/unassigned_instructors_dropdown_by_info',
				method: "get",
				data: {"section": section, "subject":subject },
				dataType: "json",
				beforeSend: function(data){

					$loading.removeClass('hidden');
					$requirements.addClass('hidden');

				},
				success: function(data) {

					console.log(data);

					var content = data.html;
					var success = data.success;

					if(success){
						$select.html(content);
						$not_found.addClass('hidden');
						$select.prop('disabled', false);
						$select.removeClass('hidden');
						$loading.addClass('hidden');
						$requirements.addClass('hidden');
					}else{
						$not_found.removeClass('hidden');
						$loading.addClass('hidden');
						$requirements.addClass('hidden');
						$select.addClass('hidden');
						$select.prop('disabled', true);
					}
					
				},
				complete: function(data){
					
				},
				error: function(error, data){
					console.log(error.responseText);
				}

			});
		}
	}

	return {
		add_grade_level: add_grade_level,
		offer_subject: offer_subject,
		assign_instructor: assign_instructor,
		enroll_student: enroll_student,
		manage_grades: manage_grades
	}

})();
