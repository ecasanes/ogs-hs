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

function error_input_keyup() {

    var $error = $('.error');

    $(document).on('keyup', '.error', function() {
        console.log('error');
        var $this = $(this);
        $this.removeClass('error');
    });
}

function bootstrap_enhancements() {

    $('.select2-dropdown').select2();
    $('.list-tooltip').tooltip({
        'html': true
    });
    /*$('.list-tooltip').on('shown.bs.tooltip', function () {
	  var $this = $(this);
	  $this.next().find('ul').addClass('list-unstyled');
	});*/
}

function numberEffects() {

    $(document).on('keydown', ".number-only", function(e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
            // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
            // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


    $(document).on('keydown', ".decimal-only", function() {


        if (event.shiftKey == true) {
            event.preventDefault();
        }

        if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

        } else {
            event.preventDefault();
        }

        if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
            event.preventDefault();

    });

    $(document).on('keydown', ".less-hundred", function() {

        var number_value = parseFloat($(this).val());



        var number_absolute = Math.abs(number_value - 100);

        console.log(number_absolute);

        var number_check = number_value + number_absolute;

        if (number_value > 99.99) {
            if (event.keyCode != 8) {
                $(this).val(100);
                return false;
            }
        }

        if (number_check > 100) {
            if (event.keyCode != 8) {
                return false;
            }
        }



    });
}

bootstrap_enhancements();
error_input_keyup();
numberEffects();


Module.GradeLock = (function() {

    function filter_grade_lock() {

        var $form = $('#search-grade-lock');
        var $grade_lock_form = $('#grade-lock-form');
        var $search_results = $grade_lock_form.find('.panel-body');
        var $loading = $('.loading');

        //select year level
        $(document).on('submit', '#search-grade-lock', function(e){
            e.preventDefault();

            var $this = $(this);

            //console.log($search_results.html());

            var post_data = $this.serializeArray();

            $.ajax({
                url: base_url + 'curiculum/display_grade_lock',
                method: "get",
                data: post_data,
                dataType: "json",
                beforeSend: function(data) {

                    $search_results.html('');

                    $loading.removeClass('hidden');
                },
                success: function(data) {
                    
                    console.log(data);
                    
                    $search_results.html(data.html);
                    //console.log($search_results.html());
                    
                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });

        //lock all subjects
        $(document).on('click', '#lock-all-subjects', function(e){

           e.preventDefault();

            var $this = $(this);

            var gl_id = $this.data('gl');
            var subj_id = null;
            var lock_status = 1;

            var $lock_subject = $grade_lock_form.find('.lock-subject');

            $.ajax({
                url: base_url + 'curiculum/change_lock_status',
                method: "post",
                data: {"gl_id": gl_id, "lock_status": lock_status},
                dataType: "json",
                beforeSend: function(data) {
                },
                success: function(data) {

                    console.log(data);
                    
                    if(data.result){
                        console.log('success');
                        $lock_subject.removeClass('lock-subject');
                        $lock_subject.addClass('unlock-subject');

                        $lock_subject.removeClass('btn-primary');
                        $lock_subject.addClass('btn-danger');

                        $lock_subject.find('.fa').removeClass('fa-unlock');
                        $lock_subject.find('.fa').addClass('fa-lock');
                        $lock_subject.find('.lock-status-text').text('Unlock Grades');
                    }
                    
                },
                complete: function(data) {
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });

        });

        //unlock all subjects
        $(document).on('click', '#unlock-all-subjects', function(e){

           e.preventDefault();

            var $this = $(this);

            var gl_id = $this.data('gl');
            var subj_id = null;
            var lock_status = 0;

            var $lock_subject = $grade_lock_form.find('.unlock-subject');

            $.ajax({
                url: base_url + 'curiculum/change_lock_status',
                method: "post",
                data: {"gl_id": gl_id, "lock_status": lock_status},
                dataType: "json",
                beforeSend: function(data) {
                },
                success: function(data) {

                    console.log(data);
                    
                    if(data.result){
                        console.log('success');
                        $lock_subject.removeClass('unlock-subject');
                        $lock_subject.addClass('lock-subject');

                        $lock_subject.removeClass('btn-danger');
                        $lock_subject.addClass('btn-primary');

                        $lock_subject.find('.fa').removeClass('fa-lock');
                        $lock_subject.find('.fa').addClass('fa-unlock');
                        $lock_subject.find('.lock-status-text').text('Lock Grades');
                    }
                    
                },
                complete: function(data) {
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });

        });

        //lock subject
        $(document).on('click', '.lock-subject', function(e){

            e.preventDefault();

            var $this = $(this);

            var gl_id = $this.data('gl');
            var subj_id = $this.data('id');
            var lock_status = 1;

            $.ajax({
                url: base_url + 'curiculum/change_lock_status',
                method: "post",
                data: {"gl_id": gl_id, "subj_id": subj_id, "lock_status": lock_status},
                dataType: "json",
                beforeSend: function(data) {
                },
                success: function(data) {
                    
                    if(data.result){
                        console.log('success');
                        $this.removeClass('lock-subject');
                        $this.removeClass('btn-primary');

                        $this.addClass('unlock-subject');
                        $this.addClass('btn-danger');

                        $this.find('.fa').removeClass('fa-unlock');
                        $this.find('.fa').addClass('fa-lock');
                        $this.find('.lock-status-text').text('Unlock Grades');
                    }
                    
                },
                complete: function(data) {
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });

        });

        //unlock subject
        $(document).on('click', '.unlock-subject', function(e){

            e.preventDefault();

            var $this = $(this);

            var gl_id = $this.data('gl');
            var subj_id = $this.data('id');
            var lock_status = 0;

            $.ajax({
                url: base_url + 'curiculum/change_lock_status',
                method: "post",
                data: {"gl_id": gl_id, "subj_id": subj_id, "lock_status": lock_status},
                dataType: "json",
                beforeSend: function(data) {
                },
                success: function(data) {
                    
                    if(data.result){
                        console.log('success');
                        $this.removeClass('unlock-subject');
                        $this.removeClass('btn-danger');

                        $this.addClass('lock-subject');
                        $this.addClass('btn-primary');

                        $this.find('.fa').addClass('fa-unlock');
                        $this.find('.fa').removeClass('fa-lock');
                        $this.find('.lock-status-text').text('Lock Grades');
                    }
                    

                    
                    //console.log($search_results.html());
                    
                },
                complete: function(data) {
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });

        });


    }



    return {
        filter_grade_lock: filter_grade_lock,
    }

})();

Module.Section = (function() {

    function filter_section() {

        var $search_section = $('#search-section');
        var $search_results = $search_section.find('.search-results');
        var $school_year = $search_section.find('[name=school_year]');
        var $loading = $search_section.find('.loading');

        //select year level
        $school_year.change(function(e) {
            e.preventDefault();
            var $this = $(this);
            var school_year = $this.val();

            search_section(school_year);
        });
    }

    function search_section(school_year) {

    	

        var $search_section = $('#search-section');
        var $search_results = $search_section.find('.search-results');
        var $school_year = $search_section.find('[name=school_year]');
        var $loading = $search_section.find('.loading');

        var school_year = school_year || $school_year.val();

        $.ajax({
            url: base_url + 'curiculum/display_sections_by_grade_level',
            method: "get",
            data: {
                "school_year": school_year
            },
            dataType: "html",
            beforeSend: function(data) {

                $search_results.html('');

                $loading.removeClass('hidden');
            },
            success: function(data) {
                //console.log(data);
                $search_results.html(data);
                
            },
            complete: function(data) {
                $loading.addClass('hidden');
            },
            error: function(error, data) {
                console.log(error.responseText);
            }

        });
    }

    return {
        filter_section: filter_section,
        search_section: search_section
    }

})();


Module.Student = (function() {

    function filter_student() {

        var $search_user = $('#search-user');
        var $search_results = $search_user.find('.search-results');
        var $year_level = $search_user.find('[name=year_level]');
        var $search_input = $search_user.find('[name=search]');
        var $loading = $search_user.find('.loading');

        //keyp search key
        $(document).on('keyup', '#search-user-input', function(e) {

            var $this = $(this);
            var search_key = $this.val();
            var year_level = $year_level.val();

            search_student(year_level, search_key);


        });

        //select year level
        $year_level.change(function(e) {
            e.preventDefault();
            var $this = $(this);
            var search_key = $("#search-user-input").val();
            var year_level = $this.val();

            search_student(year_level, search_key);
        });
    }

    function search_student(year_level, search_key) {

        var year_level = year_level || '';
        var search_key = search_key || '';

        var $search_user = $('#search-user');
        var $search_results = $search_user.find('.search-results');
        var $year_level = $search_user.find('[name=year_level]');
        var $search_input = $search_user.find('[name=search]');
        var $loading = $search_user.find('.loading');

        $.ajax({
            url: base_url + 'student/filter_student',
            method: "get",
            data: {
                "search": search_key,
                "year_level": year_level
            },
            dataType: "html",
            beforeSend: function(data) {

                $search_results.html('');

                $loading.removeClass('hidden');
            },
            success: function(data) {
                //console.log(data);
                $search_results.html(data);
                edit_student();
            },
            complete: function(data) {
                $loading.addClass('hidden');
            },
            error: function(error, data) {
                console.log(error.responseText);
            }

        });
    }

    function edit_student() {

        var $form = $('#edit-student-form');

        var $search_user = $('#search-user');
        var $search_results = $search_user.find('.search-results');
        var $year_level = $search_user.find('[name=year_level]');
        var $search_input = $search_user.find('[name=search]');
        var $loading = $search_user.find('.loading');

        var $modal = $('#edit-student-modal');


        $(document).on('click', '.edit-student', function(e) {
            e.preventDefault();


            var $this = $(this);

            $modal.modal();

            var user_id = $this.data('id');
            var username = $this.data('username');
            var firstname = $this.data('firstname');
            var lastname = $this.data('lastname');
            var year = $this.data('year');

            console.log(user_id);
            console.log(year);

            $modal.find('[name=user_id]').val(user_id);
            $modal.find('[name=username]').val(username);
            $modal.find('[name=firstname]').val(firstname);
            $modal.find('[name=lastname]').val(lastname);
            $modal.find('[name=year_level]').val(year);
        });

        $form.submit(function(e) {
            e.preventDefault();
            var $this = $(this);

            var post_data = $this.serializeArray();

            $.ajax({
                url: base_url + 'student/update_student',
                method: "post",
                data: post_data,
                dataType: "html",
                beforeSend: function(data) {

                    $search_results.html('');

                    $loading.removeClass('hidden');
                },
                success: function(data) {
                    //console.log(data);
                    //$search_results.html(data);
                    search_student();
                },
                complete: function(data) {
                    $modal.modal('hide');
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });

        });
    }

    return {
        filter_student: filter_student,
        search_student: search_student
    }

})();

Module.User = (function() {

    function add_user() {

        var $form = $('#add-user-form');

        $form.submit(function(e) {
            e.preventDefault();
            var $this = $(this);

            var post_data = $this.serializeArray();

            console.log(post_data);

            $.ajax({
                url: base_url + controller + '/create_user',
                method: "post",
                dataType: "json",
                data: post_data,
                beforeSend: function(data) {

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

                    if (username == 'failed') {
                        $username.addClass('error');
                        $this.find('.error-message').append(username_message);
                    } else {
                        $username.removeClass('error');
                    }

                    if (confirm_password == 'failed') {
                        $password.addClass('error');
                        $confirm_password.addClass('error');
                        $this.find('.error-message').append(password_message);
                    } else {
                        $password.removeClass('error');
                        $confirm_password.removeClass('error');
                    }



                    if (result != 'failed') {
                        $this.find('.success-message').text(success_message).fadeOut(3000);
                        $this.find('input,select').not('[type=submit], input[type=hidden]').val('');
                        refresh_user_list(true);
                    }


                },
                complete: function(data) {

                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });
    }

    function search_user() {

        var $search_user = $('#search-user');
        var $search_results = $search_user.find('.search-results');
        var $search_input = $search_user.find('[name=search]');


        var $loading = $search_user.find('.loading');

        $(document).on('keyup', '#search-user-input', function(e) {

            var $this = $(this);
            var search_key = $this.val();

            $.ajax({
                url: base_url + 'teacher/search_list',
                method: "get",
                data: {
                    "search": search_key
                },
                dataType: "html",
                beforeSend: function(data) {

                    $search_results.html('');

                    $loading.removeClass('hidden');
                },
                success: function(data) {
                    $search_results.html(data);
                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });

        });
    }

    function refresh_user_list(retain_height) {

        var retain_height = retain_height || false;

        var $search_user = $('#search-user');
        var $search_results = $search_user.find('.search-results');

        var $loading = $search_user.find('.loading');

        if (retain_height) {
            var height = $search_results.height();
        }


        $.ajax({
            url: base_url + controller + '/data_list',
            method: "post",
            dataType: "html",
            beforeSend: function(data) {

                if (retain_height) {
                    $search_results.height(height);
                }

                $search_results.html('');

                $loading.removeClass('hidden');
            },
            success: function(data) {
                $search_results.html(data);
            },
            complete: function(data) {
                $loading.addClass('hidden');
                $search_results.height('auto');
            },
            error: function(error, data) {
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


Module.Teacher = (function() {


    function manage_grades() {

        var $form = $('#manage-grade-form');

        var $school_year = $form.find('[name=school_year]');
        var $grade_level = $form.find('[name=grade_level]');
        var $section = $form.find('[name=section]');
        var $subject = $form.find('[name=subject]');
        var $user = $form.find('[name=student]');

        var $section_container = $form.find('.section');
        var $subject_container = $form.find('.subject');

        //school year select
        $school_year.change(function(e) {

            var $this = $(this);

            var school_year = $this.val();
            var grade_level = $grade_level.val();

            if (grade_level != null && grade_level != null) {

                get_section_dropdown($section_container, school_year, grade_level);

            } else {
                get_section_dropdown($section_container);
            }
        });


        //grade level select
        $grade_level.change(function(e) {

            var $this = $(this);

            var school_year = $school_year.val();
            var grade_level = $this.val();

            if (school_year != null && grade_level != null) {

                get_section_dropdown($section_container, school_year, grade_level);

            } else {
                get_section_dropdown($section_container);
            }
        });

        //section select
        $section.change(function(e) {

            var $this = $(this);

            var section = $section.val();

            if (section != null) {

                get_subject_dropdown($subject_container, section, null, null, "offered");

            } else {
                get_subject_dropdown($subject_container, null, null, null, "offered");
            }
        });

        //submit form
        $form.submit(function(e) {

            e.preventDefault();
            var $this = $(this);
            var $activity_form = $('#activity-form');
            var $loading = $activity_form.find('.loading');

            var activity_id = $activity_form.find('.tab-pane.active').attr('id');
            var activity_type = $activity_form.find('.tab-pane.active').data('id');

            var post_data = $this.serialize();
            console.log(post_data);

            $.ajax({
                url: base_url + controller + '/submit_manage_grades_ajax/' + activity_type,
                method: "get",
                dataType: "json",
                data: post_data,
                beforeSend: function(data) {
                    $loading.removeClass('hidden');
                    $('#' + activity_id).html('');
                },
                success: function(data) {

                    var content = data.content
                    var school_year = data.school_year;
                    var grade_level = data.grade_level;
                    var section = data.section;
                    var subject = data.subject;
                    var term = data.term;
                    var subj_offerid = data.subj_offerid;

                    var activity_weight = data.activity_weight;
                    var activity_column = data.activity_column;
                    var activity_type = data.activity_type;
                    if (activity_column == 0) {
                        activity_column = '';
                    }

                    $activity_form.find('input[name=activity_weight]').val(activity_weight);
                    if (activity_type == 'exam') {
                        $activity_form.find('select[name=activity_column]')
                            .prop('disabled', true)
                            .val(activity_column)
                            .data('id', activity_column);
                    } else {
                        $activity_form.find('select[name=activity_column]')
                            .prop('disabled', false)
                            .val(activity_column)
                            .data('id', activity_column);
                    }

                    //console.log(data);
                    $('#' + activity_id).html(content);
                    $activity_form.find('input[name=school_year]').val(school_year);
                    $activity_form.find('input[name=grade_level]').val(grade_level);
                    $activity_form.find('input[name=section]').val(section);
                    $activity_form.find('input[name=subject]').val(subject);
                    $activity_form.find('input[name=term]').val(term);
                    $activity_form.find('input[name=subj_offerid]').val(subj_offerid);

                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });

        $(document).on('click', '#submit-activity-settings', function(e) {

            e.preventDefault();
            var $this = $(this);

            var $form = $this.closest('form'); //activity-form
            //var $activity_form = $('#activity-form');

            var activity_type = $form.find('.tab-pane.active').data('id');
            var $activity_weight = $form.find('input[name=activity_weight]');
            var $activity_column = $form.find('select[name=activity_column]');

            var activity_weight = $activity_weight.val();
            var activity_column = $activity_column.val();

            console.log(activity_weight);
            console.log(activity_column);

            var post_data = $form.serializeArray();

            var activity_id = $form.find('.tab-pane.active').attr('id');
            var activity_type = $form.find('.tab-pane.active').data('id');

            $settings_success = $('#settings-success');

            console.log(post_data);

            $.ajax({
                url: base_url + controller + '/process_activity_settings/' + activity_type,
                method: "get",
                dataType: "json",
                data: post_data,
                beforeSend: function(data) {
                    //$loading.removeClass('hidden');
                    //$('#'+activity_id).html('');
                    //console.log(post_data);
                    $settings_success.text('');
                },
                success: function(data) {

                    console.log(data);
                    $settings_success.text(data.message).fadeOut(4000);



                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });
    }

    return {
        manage_grades: manage_grades
    }

})();


Module.AssignSubject = (function(){

    function get_subject_per_year_level(){

        var $form = $('#assign-subject-grade-level-form');
        var $school_year = $form.find('select[name=school_year]');
        var $year_level = $form.find('select[name=grade_level]');
        var $subject_container = $form.find('.subject');

        $year_level.change(function(e) {

            var $this = $(this);

            var year_level = $this.val();
            var school_year = $school_year.val();

            if (year_level != null) {

                get_subject_checkbox($subject_container, year_level, school_year);

            } else {

                get_section_dropdown($subject_container);
            }
        });


        $school_year.change(function(e) {

            var $this = $(this);

            var year_level = $year_level.val();
            var school_year = $this.val();

            if (year_level != null) {

                get_subject_checkbox($subject_container, year_level, school_year);

            } else {

                get_section_dropdown($subject_container);
            }
        });
    }

    function get_subject_checkbox($subject_container, year_level, school_year) {

        console.log('get subject checkbox');

        var year_level = year_level || null;
        var school_year = school_year || null;

        var ajax_url = base_url + controller + "/ajax_subjects_by_year_level/checkbox";
        var ajax_data = { "year_level" : year_level, "school_year" : school_year };

        $loading = $subject_container.find('.loading');
        $requirements = $subject_container.find('.requirements');
        $not_found = $subject_container.find('.not-found');
        $select = $subject_container.find('.subject-checkbox');

        if (school_year === null || year_level === null) {
            $not_found.addClass('hidden');
            $loading.addClass('hidden');
            $requirements.removeClass('hidden');
            $select.addClass('hidden');
        } else {
            $.ajax({
                url: ajax_url,
                method: "get",
                data: ajax_data,
                dataType: "json",
                beforeSend: function(data) {

                    $loading.removeClass('hidden');
                    $requirements.addClass('hidden');

                },
                success: function(data) {

                    var content = data.html;
                    var success = data.success;

                    if (success) {
                        $select.html(content);
                        $not_found.addClass('hidden');
                        $select.removeClass('hidden');
                        $loading.addClass('hidden');
                        $requirements.addClass('hidden');
                    } else {
                        $not_found.removeClass('hidden');
                        $loading.addClass('hidden');
                        $requirements.addClass('hidden');
                        $select.addClass('hidden');
                    }

                },
                complete: function(data) {

                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        }
    }

    return {
        get_subject_per_year_level: get_subject_per_year_level
    }
    

})();

Module.Subject = (function() {

    var $search_subject = $('#search-subject');
    var $search_results = $search_subject.find('.search-results');

    var $loading = $search_subject.find('.loading');

    function add_subject() {

        var $form = $('#add-subject-form');

        $form.submit(function(e) {
            e.preventDefault();
            var $this = $(this);

            var post_data = $this.serializeArray();

            console.log(post_data);

            //start - before ajax

            var $subject_code = $this.find('[name=subject_code]');
            var $school_year = $this.find('[name=school_year]');
            var $year_level = $this.find('[name=grade_level]');

            var $submit_message = $('.submit-message');

            //end - before ajax

            $.ajax({
                url: base_url + controller + '/create_subject',
                method: "post",
                dataType: "json",
                data: post_data,
                beforeSend: function(data) {

                },
                success: function(data) {
                    console.log(data);

                    var message = data.message;
                    var result = data.result;
                    var field_group = data.field_group;




                    if (result == 'success') {
                        $this.find('input,select').removeClass('error');
                        $this.find('input,select').not('[type=submit], input[type=hidden]').val('');
                        $submit_message.removeClass('error-message');
                        $submit_message.addClass('success-message');
                        refresh_subject_list(true);
                    } else {
                        switch (field_group) {
                            case "subject_code":
                                $subject_code.addClass('error');
                                break;
                            case "school_year":
                                $school_year.addClass('error');
                                $year_level.addClass('error');
                                break;
                        }
                        $submit_message.addClass('error-message');
                        $submit_message.removeClass('success-message');
                    }

                    $submit_message
                        .show()
                        .text(message)
                        .fadeOut(10000);


                },
                complete: function(data) {

                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });
    }

    function edit_subject() {

        $search_results.on('click', '.btn-edit', function(e) {
            e.preventDefault();
            console.log('edit');
        });


        $search_results.on('click', '.btn-delete', function(e) {

            e.preventDefault();

            var $this = $(this);
            var id = $this.data('id');


            $('#delete-subject-modal').modal();
            $('#delete-subject-modal').find('input[name=id]').val(id);

        });


        $search_results.on('click', '.btn-edit', function(e) {

            e.preventDefault();

            var $this = $(this);
            var id = $this.data('id');
            var code = $this.data('code');
            var name = $this.data('name');
            var unit = $this.data('unit');

            var $modal = $('#edit-subject-modal');

            $modal.modal();
            $modal.find('input[name=id]').val(id);
            $modal.find('input[name=subj_code]').val(code);
            $modal.find('input[name=subj_desc]').val(name);
            $modal.find('input[name=subj_unit]').val(unit);

        });

        $('#delete-subject-form').submit(function(e) {

            e.preventDefault();

            var $this = $(this);
            var id = $this.find('input[name=id]').val();

            $this.closest('.modal').modal('hide');

            $.ajax({
                url: base_url + controller + '/remove',
                method: "post",
                dataType: "json",
                data: {
                    "id": id
                },
                beforeSend: function(data) {},
                success: function(data) {
                    console.log(data);
                    refresh_subject_list(true);
                },
                complete: function(data) {},
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });

        });


        $('#edit-subject-form').submit(function(e) {

            e.preventDefault();

            var $this = $(this);

            var post_data = $this.serializeArray();

            $this.closest('.modal').modal('hide');

            $.ajax({
                url: base_url + controller + '/update',
                method: "post",
                dataType: "json",
                data: post_data,
                beforeSend: function(data) {},
                success: function(data) {
                    console.log(data);
                    refresh_subject_list(true);
                },
                complete: function(data) {},
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });

        });
    }

    function refresh_subject_list(retain_height) {

        var retain_height = retain_height || false;

        if (retain_height) {
            var height = $search_results.height();
        }


        $.ajax({
            url: base_url + controller + '/data_list',
            method: "post",
            dataType: "html",
            beforeSend: function(data) {

                if (retain_height) {
                    $search_results.height(height);
                }

                $search_results.html('');

                $loading.removeClass('hidden');
            },
            success: function(data) {
                $search_results.html(data);
            },
            complete: function(data) {
                $loading.addClass('hidden');
                $search_results.height('auto');
            },
            error: function(error, data) {
                console.log(error.responseText);
            }

        });
    }

    function filter_subject() {

        var $form = $('#filter-subject-form');

        $form.submit(function(e) {
            e.preventDefault();
            var $this = $(this);

            //console.log('test');
            var school_year = $this.find('select[name=school_year]').val();
            var year_level = $this.find('select[name=grade_level]').val();
            var post_data = $this.serializeArray();

            //console.log(post_data);

            if (school_year == '' && year_level == '') {
                console.log('refresh');
                refresh_subject_list(true);
            } else {
                console.log('filter');
                //filter
                $.ajax({
                    url: base_url + controller + '/filter_subject',
                    method: "get",
                    dataType: "html",
                    data: post_data,
                    beforeSend: function(data) {

                        $search_results.html('');
                        $loading.removeClass('hidden');
                    },
                    success: function(data) {
                        $search_results.html(data);
                    },
                    complete: function(data) {
                        $loading.addClass('hidden');
                    },
                    error: function(error, data) {
                        console.log(error.responseText);
                    }

                });
            }
        });
    }

    function filter_offered_subject() {

        var $search_subject = $('#search-offered-subjects');
        var $search_results = $search_subject.find('.search-results');
        var $school_year = $search_subject.find('[name=school_year]');
        var $loading = $search_subject.find('.loading');
        var $submit_button = $search_subject.find('[type=submit]');

        //select year level
        $school_year.change(function(e) {
            e.preventDefault();
            var $this = $(this);
            var school_year = $this.val();

            search_offered_subject(school_year);
        });

        $submit_button.click(function(e){
            e.preventDefault();
            var $this = $(this);
            var school_year = $school_year.val();

            search_offered_subject(school_year);
        });
    }

    function search_offered_subject(school_year) {

    	

        var $search_subject = $('#search-offered-subjects');
        var $search_results = $search_subject.find('.search-results');
        var $school_year = $search_subject.find('[name=school_year]');
        var $loading = $search_subject.find('.loading');

        var school_year = school_year || $school_year.val();

        $.ajax({
            url: base_url + 'curiculum/display_offered_subjects_by_section_and_school_year',
            method: "get",
            data: {
                "school_year": school_year
            },
            dataType: "html",
            beforeSend: function(data) {

                $search_results.html('');

                $loading.removeClass('hidden');
            },
            success: function(data) {
                //console.log(data);
                $search_results.html(data);
                
            },
            complete: function(data) {
                $loading.addClass('hidden');
            },
            error: function(error, data) {
                console.log(error.responseText);
            }

        });
    }

    return {
        add_subject: add_subject,
        refresh_subject_list: refresh_subject_list,
        edit_subject: edit_subject,
        filter_subject: filter_subject,
        filter_offered_subject: filter_offered_subject,
        search_offered_subject: search_offered_subject
    }

})();


Module.Curiculum = (function() {

    function view_class_record() {

        var $container = $('#class-record-container');
        var $tab = $('#view-class-record');

        var $school_year = $tab.find('[name=school_year]');
        var $loading = $tab.find('.loading');

        var $search_class_record = $('#search-class-record');

        var $activity_grade_panel = $('#term-activity-grade');
        var $activity_form = $activity_grade_panel.find('#activity-form');

        //school year select
        $search_class_record.click(function(e) {

            var school_year = $school_year.val();

            $.ajax({
                url: base_url + controller + '/view_all_sections_per_grade_level/',
                method: "get",
                dataType: "html",
                data: {
                    "school_year": school_year
                },
                beforeSend: function(data) {
                    $loading.removeClass('hidden');
                    $container.html('');
                    $activity_grade_panel.addClass('hidden');
                },
                success: function(data) {

                    $container.html(data);

                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });

        $(document).on('click', '.view-section-record', function(e) {

            e.preventDefault();

            var $this = $(this);
            var offer_id = $this.data('id');

            $.ajax({
                url: base_url + controller + '/display_student_grades/' + offer_id,
                method: "get",
                dataType: "html",
                beforeSend: function(data) {
                    $loading.removeClass('hidden');
                    $container.html('');
                },
                success: function(data) {

                    $container.html(data);

                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });

        $(document).on('click', '.view-section-subject-record', function(e) {

            e.preventDefault();

            var $this = $(this);
            var subj_offerid = $this.data('subject');
            var offer_id = $this.data('section');

            $.ajax({
                url: base_url + controller + '/display_student_grade_per_subject_term',
                method: "get",
                dataType: "html",
                data: {
                    "subj_offerid": subj_offerid,
                    "offer_id": offer_id
                },
                beforeSend: function(data) {
                    $loading.removeClass('hidden');
                    $container.html('');
                },
                success: function(data) {

                    $container.html(data);
                    bootstrap_enhancements();

                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });

        $(document).on('click', '.view-grade-book', function(e){
            e.preventDefault();

            var $this = $(this);
            var subject = $this.data('subject');
            var offer_id = $this.data('section');
            var term = $this.data('term');
            var gl_id = $this.data('gl');
            var term_title = $this.data('title');
            var user_type = $this.data('user');
            var school_year = $this.data('sy');
            var grade_level = $this.data('grade_level')

            var ajax_url;

            
            
            
            var $container = $activity_grade_panel.find('.tab-pane.active');

            var activity_id = $activity_form.find('.tab-pane.active').attr('id');
            var activity_type = $activity_form.find('.tab-pane.active').data('id');

            console.log(activity_id);
            console.log(activity_type);

            if(user_type == 3){
                ajax_url = base_url + controller + '/get_student_subject_grades/' + activity_type;
            }else{
                ajax_url = base_url + controller + '/submit_manage_grades_ajax/' + activity_type;
            }

            $.ajax({
                url: ajax_url, 
                method: "get",
                dataType: "json",
                data: {
                    "subject": subject,
                    "section": offer_id,
                    "term": term,
                    "grade_level_id": gl_id,
                    "school_year" : school_year,
                    "grade_level" : grade_level
                },
                beforeSend: function(data) {
                    $loading.removeClass('hidden');
                    $('#' + activity_id).html('');
                },
                success: function(data) {

                    console.log(data);

                    $activity_grade_panel.removeClass('hidden');
                    $activity_grade_panel.find('.term-title').text('for ' + term_title);

                    var content = data.content
                    var grade_level = data.grade_level;
                    var section = data.section;
                    var subject = data.subject;
                    var term = data.term;
                    var subj_offerid = data.subj_offerid;
                    var grade_level_id = data.grade_level_id;

                    var activity_weight = data.activity_weight;
                    var activity_column = data.activity_column;
                    var activity_type = data.activity_type;
                    if (activity_column == 0) {
                        activity_column = '';
                    }

                    $activity_form.find('input[name=activity_weight]').val(activity_weight);
                    if (activity_type == 'exam') {
                        $activity_form.find('select[name=activity_column]')
                            .prop('disabled', true)
                            .val(activity_column)
                            .data('id', activity_column);
                    } else {
                        $activity_form.find('select[name=activity_column]')
                            .prop('disabled', false)
                            .val(activity_column)
                            .data('id', activity_column);
                    }

                    //console.log(data);
                    $('#' + activity_id).html(content);
                    $activity_form.find('input[name=grade_level]').val(grade_level);
                    $activity_form.find('input[name=section]').val(section);
                    $activity_form.find('input[name=subject]').val(subject);
                    $activity_form.find('input[name=term]').val(term);
                    $activity_form.find('input[name=subj_offerid]').val(subj_offerid);
                    $activity_form.find('input[name=grade_level_id]').val(grade_level_id);

                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });

        //click on individual tab
        $('.activity-tab').click(function(e) {

            e.preventDefault();
            var $this = $(this);

            var grade_level = $activity_form.find('input[name=grade_level]').val();
            var grade_level_id = $activity_form.find('input[name=grade_level_id]').val();
            var section = $activity_form.find('input[name=section]').val();
            var subject = $activity_form.find('input[name=subject]').val();
            var term = $activity_form.find('input[name=term]').val();

            var activity_id = $this.attr('href');
            var activity_type = $this.data('id');

            var post_data = {
                "grade_level": grade_level,
                "section": section,
                "subject": subject,
                "term": term,
                "grade_level_id": grade_level_id
            };

            console.log(post_data);


            $.ajax({
                url: base_url + controller + '/get_student_subject_grades/' + activity_type,
                method: "get",
                dataType: "json",
                data: post_data,
                beforeSend: function(data) {
                    $loading.removeClass('hidden');
                    $(activity_id).html('');
                },
                success: function(data) {

                    var content = data.content
                    var school_year = data.school_year;
                    var grade_level = data.grade_level;
                    var section = data.section;
                    var subject = data.subject;
                    var term = data.term;
                    var subj_offerid = data.subj_offerid;

                    var activity_weight = data.activity_weight;
                    var activity_column = data.activity_column;
                    var activity_type = data.activity_type;
                    if (activity_column == 0) {
                        activity_column = '';
                    }

                    $activity_form.find('input[name=activity_weight]').val(activity_weight);
                    if (activity_type == 'exam') {
                        $activity_form.find('select[name=activity_column]')
                            .prop('disabled', true)
                            .val(activity_column)
                            .data('id', activity_column);
                    } else {
                        $activity_form.find('select[name=activity_column]')
                            .prop('disabled', false)
                            .val(activity_column)
                            .data('id', activity_column);
                    }

                    $activity_form.find('input[name=subj_offerid]').val(subj_offerid);


                    console.log(data);
                    $(activity_id).html(content);

                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });

        });

        
    }

    function refresh_grades() {

        //e.preventDefault();
        //var $this = $(this);
        var $activity_form = $('#activity-form');
        var $loading = $activity_form.find('.loading');

        var school_year = $activity_form.find('input[name=school_year]').val();
        var grade_level = $activity_form.find('input[name=grade_level]').val();
        var section = $activity_form.find('input[name=section]').val();
        var subject = $activity_form.find('input[name=subject]').val();
        var term = $activity_form.find('input[name=term]').val();

        var activity_id = $activity_form.find('.tab-pane.active').attr('id');
        var activity_type = $activity_form.find('.tab-pane.active').data('id');

        console.log(school_year);
        console.log(activity_id);
        console.log(activity_type);

        var post_data = {
            "school_year": school_year,
            "grade_level": grade_level,
            "section": section,
            "subject": subject,
            "term": term
        };

        console.log(post_data);


        $.ajax({
            url: base_url + controller + '/submit_manage_grades_ajax/' + activity_type,
            method: "get",
            dataType: "json",
            data: post_data,
            beforeSend: function(data) {
                $loading.removeClass('hidden');
                $('#' + activity_id).html('');
            },
            success: function(data) {

                var content = data.content
                var school_year = data.school_year;
                var grade_level = data.grade_level;
                var section = data.section;
                var subject = data.subject;
                var term = data.term;

                console.log(data);
                $('#' + activity_id).html(content);

            },
            complete: function(data) {
                $loading.addClass('hidden');
            },
            error: function(error, data) {
                console.log('error');
                console.log(error.responseText);
            }

        });
    }

    function modify_grades() {

        console.log('modify grades');

        var $form = $('#activity-form');
        var $modify_grades_modal = $('#activity-modal');

        var $edit_activity_container = $('#edit-activity-container');
        var $edit_activity_form = $('#edit-activity-form');
        var $activity_tab = $form.find('.activity-tab');

        var $no_of_items = $form.find('.activity-toggle');

        //click on items to popup modal
        $(document).on('click', '#activity-form .activity-toggle', function(e) {



            e.preventDefault();
            var activity_type = $form.find('.tab-pane.active').data('id');
            var $this = $(this);
            var activity_id = $this.data('id');
            var section = $this.data('section');
            var subject = $this.data('subject');

            $modify_grades_modal.modal();
            var $edit_activity_form = $edit_activity_container.closest('form');

            $.ajax({
                url: base_url + controller + '/get_single_activity_form/' + activity_type,
                method: "get",
                dataType: "html",
                data: {
                    "activity_id": activity_id,
                    "section": section,
                    "subject": subject
                },
                beforeSend: function(data) {
                    //$loading.removeClass('hidden');
                    $edit_activity_container.html('');
                },
                success: function(data) {

                    console.log(data);
                    $edit_activity_container.html(data);
                    //console.log($edit_activity_form.find('input[name=activity_id]'));
                    $edit_activity_form.find('input[name=activity_id]').val(activity_id);
                    $edit_activity_form.find('input[name=activity_type]').val(activity_type);
                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });

        //click on individual tab
        $('.activity-tab').click(function(e) {

            e.preventDefault();
            var $this = $(this);
            var $activity_form = $form;
            var $loading = $activity_form.find('.loading');

            var school_year = $activity_form.find('input[name=school_year]').val();
            var grade_level = $activity_form.find('input[name=grade_level]').val();
            var section = $activity_form.find('input[name=section]').val();
            var subject = $activity_form.find('input[name=subject]').val();
            var term = $activity_form.find('input[name=term]').val();

            var activity_id = $this.attr('href');
            var activity_type = $this.data('id');

            var post_data = {
                "school_year": school_year,
                "grade_level": grade_level,
                "section": section,
                "subject": subject,
                "term": term
            };

            console.log(post_data);


            $.ajax({
                url: base_url + controller + '/submit_manage_grades_ajax/' + activity_type,
                method: "get",
                dataType: "json",
                data: post_data,
                beforeSend: function(data) {
                    $loading.removeClass('hidden');
                    $(activity_id).html('');
                },
                success: function(data) {

                    var content = data.content
                    var school_year = data.school_year;
                    var grade_level = data.grade_level;
                    var section = data.section;
                    var subject = data.subject;
                    var term = data.term;
                    var subj_offerid = data.subj_offerid;

                    var activity_weight = data.activity_weight;
                    var activity_column = data.activity_column;
                    var activity_type = data.activity_type;
                    if (activity_column == 0) {
                        activity_column = '';
                    }

                    $activity_form.find('input[name=activity_weight]').val(activity_weight);
                    if (activity_type == 'exam') {
                        $activity_form.find('select[name=activity_column]')
                            .prop('disabled', true)
                            .val(activity_column)
                            .data('id', activity_column);
                    } else {
                        $activity_form.find('select[name=activity_column]')
                            .prop('disabled', false)
                            .val(activity_column)
                            .data('id', activity_column);
                    }

                    $activity_form.find('input[name=subj_offerid]').val(subj_offerid);


                    console.log(data);
                    $(activity_id).html(content);

                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });

        //click submit on modal
        $edit_activity_form.submit(function(e) {

            e.preventDefault();
            var $this = $(this);
            var post_data = $this.serializeArray();

            var $activity_form = $('#activity-form');
            var $loading = $activity_form.find('.loading');

            var activity_id = $activity_form.find('.tab-pane.active').attr('id');
            var activity_type = $activity_form.find('.tab-pane.active').data('id');

            $.ajax({
                url: base_url + controller + '/update_activity',
                method: "post",
                dataType: "html",
                data: post_data,
                beforeSend: function(data) {},
                success: function(data) {
                    refresh_grades();

                },
                complete: function(data) {},
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });
    }

    function manage_grades() {

        var $form = $('#manage-grade-form');

        var $school_year = $form.find('[name=school_year]');
        var $grade_level = $form.find('[name=grade_level]');
        var $section = $form.find('[name=section]');
        var $subject = $form.find('[name=subject]');
        var $user = $form.find('[name=student]');

        var $section_container = $form.find('.section');
        var $subject_container = $form.find('.subject');

        //school year select
        $school_year.change(function(e) {

            var $this = $(this);

            var school_year = $this.val();
            var grade_level = $grade_level.val();

            if (grade_level != null && grade_level != null) {

                get_section_dropdown($section_container, school_year, grade_level);

            } else {
                get_section_dropdown($section_container);
            }
        });


        //grade level select
        $grade_level.change(function(e) {

            var $this = $(this);

            var school_year = $school_year.val();
            var grade_level = $this.val();

            if (school_year != null && grade_level != null) {

                get_section_dropdown($section_container, school_year, grade_level);

            } else {
                get_section_dropdown($section_container);
            }
        });

        //section select
        $section.change(function(e) {

            var $this = $(this);

            var section = $section.val();

            if (section != null) {

                get_subject_dropdown($subject_container, section, null, null, "offered");

            } else {
                get_subject_dropdown($subject_container, null, null, null, "offered");
            }
        });

        //submit form
        $form.submit(function(e) {

            e.preventDefault();
            var $this = $(this);
            var $activity_form = $('#activity-form');
            var $loading = $activity_form.find('.loading');

            var activity_id = $activity_form.find('.tab-pane.active').attr('id');
            var activity_type = $activity_form.find('.tab-pane.active').data('id');

            var post_data = $this.serialize();
            console.log(post_data);

            $.ajax({
                url: base_url + controller + '/submit_manage_grades_ajax/' + activity_type,
                method: "get",
                dataType: "json",
                data: post_data,
                beforeSend: function(data) {
                    $loading.removeClass('hidden');
                    $('#' + activity_id).html('');
                },
                success: function(data) {

                    var content = data.content
                    var school_year = data.school_year;
                    var grade_level = data.grade_level;
                    var section = data.section;
                    var subject = data.subject;
                    var term = data.term;
                    var subj_offerid = data.subj_offerid;

                    var activity_weight = data.activity_weight;
                    var activity_column = data.activity_column;
                    var activity_type = data.activity_type;
                    if (activity_column == 0) {
                        activity_column = '';
                    }

                    $activity_form.find('input[name=activity_weight]').val(activity_weight);
                    if (activity_type == 'exam') {
                        $activity_form.find('select[name=activity_column]')
                            .prop('disabled', true)
                            .val(activity_column)
                            .data('id', activity_column);
                    } else {
                        $activity_form.find('select[name=activity_column]')
                            .prop('disabled', false)
                            .val(activity_column)
                            .data('id', activity_column);
                    }

                    //console.log(data);
                    $('#' + activity_id).html(content);
                    $activity_form.find('input[name=school_year]').val(school_year);
                    $activity_form.find('input[name=grade_level]').val(grade_level);
                    $activity_form.find('input[name=section]').val(section);
                    $activity_form.find('input[name=subject]').val(subject);
                    $activity_form.find('input[name=term]').val(term);
                    $activity_form.find('input[name=subj_offerid]').val(subj_offerid);

                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });

        $(document).on('click', '#submit-activity-settings', function(e) {

            e.preventDefault();
            var $this = $(this);

            var $form = $this.closest('form'); //activity-form
            //var $activity_form = $('#activity-form');

            var activity_type = $form.find('.tab-pane.active').data('id');
            var $activity_weight = $form.find('input[name=activity_weight]');
            var $activity_column = $form.find('select[name=activity_column]');

            var activity_weight = $activity_weight.val();
            var activity_column = $activity_column.val();

            console.log(activity_weight);
            console.log(activity_column);

            var post_data = $form.serializeArray();

            var activity_id = $form.find('.tab-pane.active').attr('id');
            var activity_type = $form.find('.tab-pane.active').data('id');

            $settings_success = $('#settings-success');

            console.log(post_data);

            $.ajax({
                url: base_url + controller + '/process_activity_settings/' + activity_type,
                method: "get",
                dataType: "json",
                data: post_data,
                beforeSend: function(data) {
                    //$loading.removeClass('hidden');
                    //$('#'+activity_id).html('');
                    //console.log(post_data);
                    $settings_success.text('');
                },
                success: function(data) {

                    console.log(data);
                    $settings_success.text(data.message).fadeOut(4000);



                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });
    }

    function get_student_checkboxes($student_container, school_year, grade_level) {

        var school_year = school_year || null;
        var grade_level = grade_level || null;

        var $loading = $student_container.find('.loading');
        var $requirements = $student_container.find('.requirements');
        var $not_found = $student_container.find('.not-found');
        var $search_result = $student_container.find('.search-result');

        if (school_year === null && grade_level === null) {
            $not_found.addClass('hidden');
            $loading.addClass('hidden');
            $requirements.removeClass('hidden');
            $search_result.addClass('hidden');
        } else {
            $.ajax({
                url: base_url + 'curiculum/student_checkboxes_by_info',
                method: "post",
                data: {
                    "school_year": school_year,
                    "grade_level": grade_level
                },
                dataType: "json",
                beforeSend: function(data) {

                    $loading.removeClass('hidden');
                    $requirements.addClass('hidden');

                },
                success: function(data) {

                    console.log(data);

                    var content = data.html;
                    var success = data.success;

                    if (success) {
                        $search_result.html(content);
                        $not_found.addClass('hidden');
                        $search_result.removeClass('hidden');
                        $loading.addClass('hidden');
                        $requirements.addClass('hidden');
                    } else {
                        $not_found.removeClass('hidden');
                        $loading.addClass('hidden');
                        $requirements.addClass('hidden');
                        $search_result.addClass('hidden');
                    }

                },
                complete: function(data) {

                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        }
    }

    function enroll_student() {

        var $form = $('#enroll-student-form');
        var $school_year = $form.find('[name=school_year]');
        var $grade_level = $form.find('[name=grade_level]');
        var $section = $form.find('[name=section]');

        var $section_container = $form.find('.section');
        var $student_container = $form.find('.student');

        $school_year.change(function(e) {

            var $this = $(this);

            var school_year = $this.val();
            var grade_level = $grade_level.val();

            if (grade_level !== '' && school_year !== '') {

                get_section_dropdown($section_container, school_year, grade_level);
                get_student_checkboxes($student_container, school_year, grade_level);

            } else {
                get_section_dropdown($section_container);
            }
        });


        $grade_level.change(function(e) {

            var $this = $(this);

            var school_year = $school_year.val();
            var grade_level = $this.val();

            if (school_year !== '' && grade_level !== '') {

                get_section_dropdown($section_container, school_year, grade_level);
                get_student_checkboxes($student_container, school_year, grade_level);

            } else {
                get_section_dropdown($section_container);
            }
        });
    }

    function add_grade_level() {

        var $form = $('#add-grade-level-form');

        $form.submit(function(e) {
            e.preventDefault();
            var $this = $(this);

            var post_data = $this.serializeArray();

            console.log(post_data);

            $.ajax({
                url: base_url + controller + '/create_grade_level',
                method: "post",
                dataType: "json",
                data: post_data,
                beforeSend: function(data) {

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

                    if (grade_level == 'failed') {
                        //$grade_level.addClass('error');
                        $sy_start.addClass('error');
                        $sy_end.addClass('error');
                        $this.find('.error-message').append(grade_level_message);
                    } else {
                        //$grade_level.removeClass('error');
                        $sy_start.removeClass('error');
                        $sy_end.removeClass('error');
                    }



                    if (result != 'failed') {
                        $this.find('.success-message').text(success_message).fadeOut(5000);
                        $this.find('input,select').not('[type=submit], input[type=hidden]').val('');
                    }


                },
                complete: function(data) {

                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });
    }

    function offer_subject() {

        var $form = $('#assign-subject-to-section-form');
        var $school_year = $form.find('[name=school_year]');
        var $grade_level = $form.find('[name=grade_level]');
        var $section = $form.find('[name=section]');
        var $subject = $form.find('[name=subject]');

        var $section_container = $form.find('.section');
        var $subject_container = $form.find('.subject');

        $school_year.change(function(e) {

            var $this = $(this);

            var school_year = $this.val();
            var grade_level = $grade_level.val();

            if (grade_level != null && grade_level != null) {

                get_section_dropdown($section_container, school_year, grade_level);

            } else {
                get_section_dropdown($section_container);
            }
        });


        $grade_level.change(function(e) {

            var $this = $(this);

            var school_year = $school_year.val();
            var grade_level = $this.val();

            if (school_year != null && grade_level != null) {

                get_section_dropdown($section_container, school_year, grade_level);

            } else {
                get_section_dropdown($section_container);
            }
        });


        $section.change(function(e) {

            var $this = $(this);

            var section = $section.val();

            if (section != null) {

                get_subject_checkbox($subject_container, section);

            } else {
                get_subject_checkbox($subject_container);
            }
        });
    }

    function assign_instructor() {

        var $form = $('#assign-instructor-form');
        var $school_year = $form.find('[name=school_year]');
        var $grade_level = $form.find('[name=grade_level]');
        var $section = $form.find('[name=section]');
        var $subject = $form.find('[name=subject]');
        var $user = $form.find('[name=user]');

        var $section_container = $form.find('.section');
        var $subject_container = $form.find('.subject');
        var $user_container = $form.find('.user');

        $school_year.change(function(e) {

            var $this = $(this);

            var school_year = $this.val();
            var grade_level = $grade_level.val();

            if (grade_level != null && grade_level != null) {

                get_section_dropdown($section_container, school_year, grade_level);

            } else {
                get_section_dropdown($section_container);
            }
        });


        $grade_level.change(function(e) {

            var $this = $(this);

            var school_year = $school_year.val();
            var grade_level = $this.val();

            if (school_year != null && grade_level != null) {

                get_section_dropdown($section_container, school_year, grade_level);

            } else {
                get_section_dropdown($section_container);
            }
        });


        $section.change(function(e) {

            var $this = $(this);

            var section = $this.val();
            var school_year = $school_year.val();
            var grade_level = $grade_level.val();

            if (section != null) {

                get_subject_dropdown($subject_container, section, school_year, grade_level, "not_assigned");

            } else {
                get_subject_dropdown($subject_container, null, null, null, "not_assigned");
            }
        });


        $subject.change(function(e) {

            var $this = $(this);

            var section = $section.val();
            var subject = $this.val();

            if (section != null && subject != null) {

                get_user_dropdown($user_container, section, subject);

            } else {
                get_user_dropdown($user_container);
            }
        });
    }

    function get_section_dropdown($section_container, school_year, grade_level) {

        var school_year = school_year || null;
        var grade_level = grade_level || null;

        var $loading = $section_container.find('.loading');
        var $requirements = $section_container.find('.requirements');
        var $not_found = $section_container.find('.not-found');
        var $select = $section_container.find('[name=section]');

        if (school_year === null && grade_level === null) {
            $not_found.addClass('hidden');
            $loading.addClass('hidden');
            $requirements.removeClass('hidden');
            $select.addClass('hidden');
            $select.prop('disabled', true);
        } else {
            $.ajax({
                url: base_url + 'curiculum/section_dropdown_by_info',
                method: "get",
                data: {
                    "school_year": school_year,
                    "grade_level": grade_level
                },
                dataType: "json",
                beforeSend: function(data) {

                    $loading.removeClass('hidden');
                    $requirements.addClass('hidden');

                },
                success: function(data) {

                    console.log(data);

                    var content = data.html;
                    var success = data.success;

                    if (success) {
                        $select.html(content);
                        $not_found.addClass('hidden');
                        $select.prop('disabled', false);
                        $select.removeClass('hidden');
                        $loading.addClass('hidden');
                        $requirements.addClass('hidden');
                    } else {
                        $not_found.removeClass('hidden');
                        $loading.addClass('hidden');
                        $requirements.addClass('hidden');
                        $select.addClass('hidden');
                        $select.prop('disabled', true);
                    }

                },
                complete: function(data) {

                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        }
    }

    function get_subject_checkbox($subject_container, section, school_year, grade_level, type) {

        console.log('get subject checkbox');

        var section = section || null;
        var type = type || 'not_offered';

        var ajax_url = "";
        var ajax_data;

        switch (type) {
            case "not_offered":
                ajax_url = base_url + "curiculum/subjects_not_offered_dropdown_by_info/checkbox";
                ajax_data = {
                    "section": section
                };
                break;

            case "not_assigned":
                ajax_url = base_url + "curiculum/subjects_not_assigned_dropdown_by_info/checkbox";
                ajax_data = {
                    "section": section,
                    "school_year": school_year,
                    "grade_level": grade_level
                };
                break;

            case "offered":
                ajax_url = base_url + "curiculum/subjects_offered_dropdown_by_info/checkbox";
                ajax_data = {
                    "section": section
                };
                break;
        }

        $loading = $subject_container.find('.loading');
        $requirements = $subject_container.find('.requirements');
        $not_found = $subject_container.find('.not-found');
        $select = $subject_container.find('.subject-checkbox');

        if (section === null) {
            $not_found.addClass('hidden');
            $loading.addClass('hidden');
            $requirements.removeClass('hidden');
            $select.addClass('hidden');
        } else {
            $.ajax({
                url: ajax_url,
                method: "get",
                data: ajax_data,
                dataType: "json",
                beforeSend: function(data) {

                    $loading.removeClass('hidden');
                    $requirements.addClass('hidden');

                },
                success: function(data) {

                    var content = data.html;
                    var success = data.success;

                    if (success) {
                        $select.html(content);
                        $not_found.addClass('hidden');
                        $select.removeClass('hidden');
                        $loading.addClass('hidden');
                        $requirements.addClass('hidden');
                    } else {
                        $not_found.removeClass('hidden');
                        $loading.addClass('hidden');
                        $requirements.addClass('hidden');
                        $select.addClass('hidden');
                    }

                },
                complete: function(data) {

                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        }
    }

    function get_subject_dropdown($subject_container, section, school_year, grade_level, type) {

        var section = section || null;
        var type = type || 'not_offered';

        var ajax_url = "";
        var ajax_data;

        switch (type) {
            case "not_offered":
                ajax_url = base_url + "curiculum/subjects_not_offered_dropdown_by_info";
                ajax_data = {
                    "section": section
                };
                break;

            case "not_assigned":
                ajax_url = base_url + "curiculum/subjects_not_assigned_dropdown_by_info";
                ajax_data = {
                    "section": section,
                    "school_year": school_year,
                    "grade_level": grade_level
                };
                break;

            case "offered":
                ajax_url = base_url + "curiculum/subjects_offered_dropdown_by_info";
                ajax_data = {
                    "section": section
                };
                break;
        }

        $loading = $subject_container.find('.loading');
        $requirements = $subject_container.find('.requirements');
        $not_found = $subject_container.find('.not-found');
        $select = $subject_container.find('[name=subject]');

        if (section === null) {
            $not_found.addClass('hidden');
            $loading.addClass('hidden');
            $requirements.removeClass('hidden');
            $select.addClass('hidden');
            $select.prop('disabled', true);
        } else {
            $.ajax({
                url: ajax_url,
                method: "get",
                data: ajax_data,
                dataType: "json",
                beforeSend: function(data) {

                    $loading.removeClass('hidden');
                    $requirements.addClass('hidden');

                },
                success: function(data) {

                    var content = data.html;
                    var success = data.success;

                    if (success) {
                        $select.html(content);
                        $not_found.addClass('hidden');
                        $select.prop('disabled', false);
                        $select.removeClass('hidden');
                        $loading.addClass('hidden');
                        $requirements.addClass('hidden');
                    } else {
                        $not_found.removeClass('hidden');
                        $loading.addClass('hidden');
                        $requirements.addClass('hidden');
                        $select.addClass('hidden');
                        $select.prop('disabled', true);
                    }

                },
                complete: function(data) {

                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        }
    }

    function get_user_dropdown($user_container, section, subject) {

        var section = section || null;
        var subject = subject || null;

        $loading = $user_container.find('.loading');
        $requirements = $user_container.find('.requirements');
        $not_found = $user_container.find('.not-found');
        $select = $user_container.find('[name=user]');

        if (section === null && subject === null) {
            $not_found.addClass('hidden');
            $loading.addClass('hidden');
            $requirements.removeClass('hidden');
            $select.addClass('hidden');
            $select.prop('disabled', true);
        } else {
            $.ajax({
                url: base_url + 'curiculum/unassigned_instructors_dropdown_by_info',
                method: "get",
                data: {
                    "section": section,
                    "subject": subject
                },
                dataType: "json",
                beforeSend: function(data) {

                    $loading.removeClass('hidden');
                    $requirements.addClass('hidden');

                },
                success: function(data) {

                    console.log(data);

                    var content = data.html;
                    var success = data.success;

                    if (success) {
                        $select.html(content);
                        $not_found.addClass('hidden');
                        $select.prop('disabled', false);
                        $select.removeClass('hidden');
                        $loading.addClass('hidden');
                        $requirements.addClass('hidden');
                    } else {
                        $not_found.removeClass('hidden');
                        $loading.addClass('hidden');
                        $requirements.addClass('hidden');
                        $select.addClass('hidden');
                        $select.prop('disabled', true);
                    }

                },
                complete: function(data) {

                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        }
    }

    function manage_grading_system() {

        $sy_search_button = $('#search-grade-system');
        $search_results = $('#grade-system-container');



        $loading = $('.loading');

        $sy_search_button.click(function(e) {
            e.preventDefault();
            var $this = $(this);

            var school_year = $this.closest('.form-group').find('select[name=school_year]').val();

            $.ajax({
                url: base_url + controller + '/display_assigned_subjects_per_year_level',
                method: "get",
                data: {
                    "school_year": school_year
                },
                dataType: "html",
                beforeSend: function(data) {

                    $search_results.html('');
                    $loading.removeClass('hidden');
                },
                success: function(data) {
                    $search_results.html(data);
                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });

        $(document).on('click', '.view-subject-grade-system', function(e) {
            e.preventDefault();

            var $this = $(this);
            var subj_offerid = $this.data('id');
            var subj_code = $this.data('code');


            $.ajax({
                url: base_url + controller + '/display_grading_system_tabs',
                method: "get",
                data: {
                    "subj_offerid": subj_offerid,
                    "subj_code": subj_code
                },
                dataType: "html",
                beforeSend: function(data) {

                    $search_results.html('');
                    $loading.removeClass('hidden');
                },
                success: function(data) {
                    $search_results.html(data);
                    display_grading_system(subj_offerid, 1, 'edit');
                },
                complete: function(data) {
                    $loading.addClass('hidden');
                },
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        });

        $(document).on('click', '.term-grading', function(e) {
            e.preventDefault();

            var $this = $(this);

            var active_panel_id = $this.attr('href');
            var $active_panel = $(active_panel_id);
            var $grading_percentage = $('#grading-percentage');

            var $loading = $this.closest('.tab-content').find('.loading');

            var subj_offerid = $grading_percentage.data('id');
            var term = $this.data('term');

            /*console.log(subj_offerid);
            console.log(term);*/

            display_grading_system(subj_offerid, term, 'edit', $this);

        });
    }

    function check_grading_system_columns($this){

        var $active_panel = $('.active.tab-pane');
        var active_panel_id = $active_panel.attr('id');
        var post_data = $this.serializeArray();

        var subj_offerid = $this.find('input[name=subj_offerid]').val();
        var term = $this.find('input[name=term]').val();

        var result = true;

        //console.log(post_data);

        $.ajax({
            url: base_url + controller + '/check_grading_system_columns',
            method: "post",
            data: post_data,
            dataType: "json",
            async:false,
            beforeSend: function(data) {},
            success: function(data) {

                console.log(data);

                result = data.result;
                var message = data.message;

                if(result){
                }else{
                    $('#column-modal').modal();
                    $('#column-modal').find('.modal-body').html(message);
                }

            },
            complete: function(data) {},
            error: function(error, data) {
                console.log(error.responseText);
            }

        });

        return result;

    }

    function update_grading_system() {

        //$form = $('#edit-grading-system-form');

        $(document).on('submit', '.tab-pane.active .edit-grading-system-form', function(e){

            e.preventDefault();

            var $this = $(this);

            var bypass_check = false;

            commence_update_grading_system(bypass_check, $this);
        });

        $(document).on('click', '#column-modal .go-yes', function(e){

            e.preventDefault();

            var $this = $(this);

            var $grade_system_container = $('#grade-system-container');
            var $active_tab = $grade_system_container.find('.active.tab-pane');
            var $form = $active_tab.find('.edit-grading-system-form');

            $('#column-modal').modal('hide');

            var bypass_check = true;

            commence_update_grading_system(bypass_check, $form);
        });
    }

    function commence_update_grading_system(bypass_check, $form){

        var bypass_check = bypass_check || false;

        var $this = $form;

        var $active_panel = $('.active.tab-pane');
        var active_panel_id = $active_panel.attr('id');
        var post_data = $active_panel.find('.edit-grading-system-form').serializeArray();

        var subj_offerid = $this.find('input[name=subj_offerid]').val();
        var term = $this.find('input[name=term]').val();

        var column_check = true;

        if(!bypass_check){
            column_check = check_grading_system_columns($this);
        }

        console.log(post_data);
        

        if(column_check){
            $.ajax({
                url: base_url + controller + '/update_grading_system',
                method: "post",
                data: post_data,
                dataType: "json",
                beforeSend: function(data) {},
                success: function(data) {

                    console.log(data);

                    if (data.result == 'success') {
                        display_grading_system(subj_offerid, term, 'edit', null, data.result);
                        
                    } else if (data.result == 'failed') {
                        $active_panel.find('.message').removeClass('success-message').addClass(data.message_class).text(data.message);
                    }

                },
                complete: function(data) {},
                error: function(error, data) {
                    console.log(error.responseText);
                }

            });
        }

    }

    function display_grading_system(subj_offerid, term, action, $this, success) {

        console.log('display grading system called');

        var $this = $this || null;
        var success = success || false;

        if ($this !== null) {
            var active_panel_id = $this.attr('href');
            var $active_panel = $(active_panel_id);
        } else {
            var $active_panel = $('.active.tab-pane');
            var active_panel_id = $active_panel.attr('id');
        }

        console.log(active_panel_id);


        var $grading_percentage = $('#grading-percentage');

        var $loading = $active_panel.closest('.tab-content').find('.loading');

        //console.log($active_panel.html());

        $.ajax({
            url: base_url + controller + '/display_grading_system/' + action,
            method: "get",
            data: {
                "term": term,
                "subj_offerid": subj_offerid
            },
            dataType: "html",
            beforeSend: function(data) {

                $active_panel.html('');
                $loading.removeClass('hidden');
            },
            success: function(data) {
                $active_panel.html(data);
                //$form = $('#edit-grading-system-form');
                //$form.unbind();
                update_grading_system();
                if(success == 'success'){
                    $active_panel.find('.message').removeClass('error-message').addClass('success-message').text('Grading System successfully updated.');
                }
                
            },
            complete: function(data) {
                $loading.addClass('hidden');
            },
            error: function(error, data) {
                console.log(error.responseText);
            }

        });
    }

    return {
        add_grade_level: add_grade_level,
        offer_subject: offer_subject,
        assign_instructor: assign_instructor,
        enroll_student: enroll_student,
        manage_grades: manage_grades,
        modify_grades: modify_grades,
        view_class_record: view_class_record,
        manage_grading_system: manage_grading_system
    }

})();
