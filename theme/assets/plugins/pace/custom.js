(function($) {
    $.fn.outerHTML = function() {
        return $(this).clone().wrap('<div></div>').parent().html();
    }
})(jQuery);

//global variables
var toolbar_settings = [
    ['style', ['bold', 'italic', 'underline']],
    ['para', ['ul', 'ol', 'paragraph', 'removeformat']]
];

var validator_date_validation = {

    validators: {
        date: {
            format: 'DD/MM/YYYY',
            message: 'The value is not a valid date'
        }
    }
}

var required_field_properties = {
    message: '',
    feedbackIcons: {
        valid: '',
        invalid: '',
        validating: ''
    },
    submitButtons: 'button[type="submit"]',
    submitHandler: function(validator, form, submitButton) {

        if (submitButton.hasClass('nexttab')) {
            next_link = form.find('input[name=next_link]').val();
            link_to = form.find('input[name=link_to]').val(next_link);
        }

        if (validateRequiredInput(form)) {
            validator.defaultSubmit();
        } else {
            goToByScroll('first-required');
        }



    },
    fields: {
        user_date: validator_date_validation,
        date_of_issue: validator_date_validation,
        detection_date: validator_date_validation,
        date: validator_date_validation,
        estimated_start_date: validator_date_validation
    }
};

function remove_empty_user_field() {
    $(document).on('keyup', '.new-user', function() {
        $new_user = $(this);

        if ($new_user.val() == '') {
            $new_user.closest('.form-group').find('.new-user-id').val('');
        }

    });
}

function getRowOptions(option_type, classes) {

    var classes = classes || 'col-sm-4 col-sm-offset-8';
    var option_type = option_type || 'normal';

    var row_options;

    if (option_type == 'raci') {

        row_options = '<tr class="row-options-container">';
        row_options += '<td></td>';
        row_options += '<td colspan="8">';
        row_options += '<div class="row">';
        row_options += '<div class="' + classes + ' text-right">';
        row_options += '<button type="button" class="btn btn-danger text-right remove-row"><span class="glyphicon glyphicon-minus"></span></button> <button type="button" class="btn btn-primary text-right add-row"><span class="glyphicon glyphicon-plus"></span></button>';
        row_options += '</div>';
        row_options += '</div>';
        row_options += '</td>';
        row_options += '</tr>';

    } else if (option_type == 'normal') {
        row_options = '<div class="row content text-right row-options-container">';
        row_options += '<div class="' + classes + '">';
        row_options += '<button type="button" class="btn btn-danger text-right remove-row"><span class="glyphicon glyphicon-minus"></span></button>';
        row_options += ' <button type="button" class="btn btn-primary text-right add-row"><span class="glyphicon glyphicon-plus"></span></button>';
        row_options += '</div>';
        row_options += '</div>';
    }

    return row_options;
}

function addValidator(html_string) {

    $object = $($.parseHTML(html_string));

    $inputs = $object.find('[name]');

    $inputs.each(function() {
        input_name = $(this).attr('name');
        $(this).attr('data-bv-field', input_name);
    });

    return $object.outerHTML();
}

function dynamicRow(container_id, table_name, row_class, include_current_step, second_container_id, custom_row_options_classes, db_primary) {

    var db_primary = db_primary || 'document_id';
    var row_class = row_class || '.row.content';
    var second_container_id = second_container_id || '';
    var custom_row_options_classes = custom_row_options_classes || 'col-sm-4 col-sm-offset-8';
    var row_options = '';
    var include_current_step = include_current_step || false;
    var clone_row;
    var new_clone_id;
    var new_clone_id_split = null;
    var ajax_row_id;

    var $main_container = $('#' + container_id);

    if ($main_container.length > 0) {

        if (container_id == 'raci-item-table') {
            row_options = getRowOptions('raci', 'col-sm-12');
        } else if (container_id == 'file-table') {
            row_options = getRowOptions('normal', 'col-sm-12 no-padding');
        } else if (custom_row_options_classes != 'col-sm-4 col-sm-offset-8') {
            row_options = getRowOptions('normal', custom_row_options_classes);
        } else {
            row_options = getRowOptions('normal', "col-sm-4 col-sm-offset-8");
        }

        if (second_container_id != '') {
            var $secondary_container = $('#' + second_container_id);
            var secondary_clone = $secondary_container.find(row_class).not('.row-options-container').outerHTML();

            $secondary_container.append(row_options);

            var $secondary_button_container = $secondary_container.find('.row-options-container');
            $secondary_button_container.hide();
        }

        $main_container.append(row_options);


        var $add_row_button = $main_container.find('.add-row');
        var $remove_row_button = $main_container.find('.remove-row');
        var $button_container = $main_container.find('.row-options-container');



        var $clone_row = $main_container.find(row_class).not('.row-options-container');
        var $new_clone_row = $clone_row.clone();



        //$new_clone_row.find('.fileinput-filename, textarea, .note-editable').text('');
        $new_clone_row.find('[selected=selected]').removeAttr('selected');
        $new_clone_row.find('input[type=text]').attr('value', '');
        $new_clone_row.find('input[type=hidden]').attr('value', '');


        //var $new_clone_row = $clone_row.clone().find('[value]').attr('value', '').end();

        //var user_clone_row = $user_clone_row.outerHTML();

        ///var clone_row = $new_clone_row.outerHTML();

        $add_row_button.click(function(e) {

            var add_row_flag = true;
            //check file upload
            if ($(this).parents('#file-table').length) {
                var a_upload = $(this).closest('.row-options-container');
                var b_upload = $(a_upload).prev();
                var c_upload = $(b_upload).find('.fileinput-filename').text();

                if (c_upload == "") {
                    add_row_flag = false;
                }
            }

            if (add_row_flag == true) {
                if (second_container_id != '') {
                    $secondary_button_container.before(secondary_clone);
                }

                ///clone_row = addValidator(clone_row);


                ajax_row_id = ajax_add_row(controller + '/add_row', table_name, include_current_step, 1, db_primary);
                //console.log(ajax_row_id);
                //console.log($new_clone_row);
                new_clone_id = $new_clone_row.attr('id');

                //console.log(new_clone_id);

                if (new_clone_id === undefined) {

                } else {
                    if (new_clone_id.indexOf('-') != -1) {
                        //console.log('before')
                        new_clone_id_split = new_clone_id.split('-');
                        //console.log('test');
                    }
                }

                //console.log('before test');

                if (new_clone_id_split !== undefined || new_clone_id_split !== null) {
                    if (row_class == '.file-row') {
                        new_clone_prefix = 'file-row-';
                    } else {
                        new_clone_prefix = '';
                    }
                } else {
                    new_clone_prefix = '';
                }

                //console.log('after');

                $new_clone_row.attr('id', new_clone_prefix + ajax_row_id);
                clone_row = $new_clone_row.outerHTML();
                clone_row = addValidator(clone_row);
                $button_container.before(clone_row);

                //console.log('after 2');
                autoReferenceId(ajax_row_id);
                select_with_search();



                ajax_autocomplete('.new-user', '.additional-user', 'user/search_all', '.user-suggest', '.autosuggest');

                //console.log('after 3');

                textareaEffects();
                dateEffects();
                organisation_role();


                //console.log('after 3.5');


                $remove_row_button.prop('disabled', false);

            }
            //console.log('after 4');

        });

        $remove_row_button.click(function(e) {

            var row_length = $main_container.find(row_class).not('.row-options-container').length;

            if (row_length > 1) {


                ajax_add_row(controller + '/remove_row', table_name, include_current_step, 1, db_primary);



                $button_container.prev().remove();
                //$secondary_button_container.prev().remove();

                update_document_cost_breakdown();
            } else {
                $remove_row_button.prop('disabled', true);
            }


        });

    }
}

function myAccountEffects() {

    $checkbox_container = $('.checkbox-item');

    $checkbox_container.change(function() {

        $checkbox = $(this).find('input[type=checkbox]');
        $equipment_category = $(this).find('.equipment-category');

        if ($checkbox.is(':checked')) {
            $equipment_category.val(1);
        } else {
            $equipment_category.val(0);
        }
    });
}

function updateResult(data) {
    result = data;
    //console.log(result);
    return result;
}

function ajax_add_row(function_url, table_name, include_current_step, row_count, db_primary) {

    var row_count = row_count || 1;
    var token = $("input[name=9s8fjshd324hd98s]").val();
    var current_step = $("input[name=current_step]").val();
    var step_id = $("input[name=model_id]").val();
    var id = $("input[name=form_id]").val();
    var db_primary = db_primary || 'document_id';
    var include_current_step = include_current_step || false;
    var row_id;

    //alert(include_current_step);

    if (!include_current_step) {
        current_step = null;
    }

    //alert(id);
    //alert(table_name);
    //alert(row_count);
    //alert(db_primary);
    //alert(current_step);

    var dataString = {
        "9s8fjshd324hd98s": token,
        "id": id,
        "current_step": current_step,
        "model_id": step_id,
        "table_name": table_name,
        "row_count": row_count,
        "db_primary": db_primary
    };

    var ajax_url = base_url + function_url;


    $.ajax({
        async: false,
        type: "POST",
        url: ajax_url,
        data: dataString,
        dataType: "html",
        success: function(data) {
            row_id = data;
        }
    });

    return row_id;
}

function requiredNoteEditables() {


    var $required_editable = $('.form-group-required .note-editable');

    $required_editable.addClass('note-required');
}

function numberEffects() {

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

    actualCostBreakDown();

    estimatedCostBreakDown();

    costVariationBreakdown();
}

function actualCostBreakDown() {
    $(document).on('keyup', '.auto-calc', function() {

        //console.log($(this).closest('.cost-breakdown-table').html());

        var unit_cost;
        var volume;
        var $subtotal;
        var subtotal_calc;
        var total = 0;

        if ($(this).hasClass('unit-cost')) {
            unit_cost = $(this).val();
            volume = $(this).closest('.cost-breakdown-row').find('.volume').val();
        } else {
            volume = $(this).val();
            unit_cost = $(this).closest('.cost-breakdown-row').find('.unit-cost').val();
        }

        $subtotal = $(this).closest('.cost-breakdown-row').find('.subtotal');

        if (volume != '' && unit_cost != '') {
            subtotal_calc = parseFloat(volume) * parseFloat(unit_cost);

            $subtotal.val(subtotal_calc.toFixed(2));
        } else {
            $subtotal.val(0.00);
        }



        $(this).closest('.cost-breakdown-table').find('.subtotal').each(function() {

            var subtotal = $(this).val();

            if (subtotal != '') {
                total += parseFloat(subtotal);
            }
        });

        $(this).closest('.cost-breakdown-table').find('#actual_cost_breakdown_total').val(total.toFixed(2));


    });
}

function estimatedCostBreakDown() {
    $(document).on('keyup', '.auto-calc-estimate', function() {

        //console.log($(this).closest('.cost-breakdown-table').html());

        var unit_cost;
        var volume;
        var $subtotal;
        var subtotal_calc;
        var total = 0;

        if ($(this).hasClass('estimated-unit-cost')) {
            unit_cost = $(this).val();
            volume = $(this).closest('.cost-breakdown-row').find('.estimated-volume').val();
        } else {
            volume = $(this).val();
            unit_cost = $(this).closest('.cost-breakdown-row').find('.estimated-unit-cost').val();
        }

        $subtotal = $(this).closest('.cost-breakdown-row').find('.estimated-subtotal');

        if (volume != '' && unit_cost != '') {
            subtotal_calc = parseFloat(volume) * parseFloat(unit_cost);

            $subtotal.val(subtotal_calc.toFixed(2));
        } else {
            $subtotal.val(0.00);
        }



        $(this).closest('.cost-breakdown-table').find('.estimated-subtotal').each(function() {

            var subtotal = $(this).val();

            if (subtotal != '') {
                total += parseFloat(subtotal);
            }
        });

        $(this).closest('.cost-breakdown-table').find('#estimated_cost_breakdown_total').val(total.toFixed(2));


    });
}

function costVariationBreakdown() {
    var estimated_cost;
    var actual_cost;
    $(document).on('keyup', '.auto-calc-estimate', function() {
        estimated_cost = $(this).closest('.cost-breakdown-table').find('#estimated_cost_breakdown_total').val();
        actual_cost = $(this).closest('.cost-breakdown-table').find('#actual_cost_breakdown_total').val();

        estimated_cost = parseFloat(estimated_cost);
        actual_cost = parseFloat(actual_cost);

        var variation = Math.abs(estimated_cost - actual_cost);

        if (isNaN(variation)) {
            variation = 0;
        }

        $('.cost-breakdown-table').find('#cost_breakdown_variation').val(variation.toFixed(2));
    });

    $(document).on('keyup', '.auto-calc', function() {
        actual_cost = $(this).closest('.cost-breakdown-table').find('#actual_cost_breakdown_total').val();
        estimated_cost = $(this).closest('.cost-breakdown-table').find('#estimated_cost_breakdown_total').val();

        estimated_cost = parseFloat(estimated_cost);
        actual_cost = parseFloat(actual_cost);

        var variation = Math.abs(estimated_cost - actual_cost);

        if (isNaN(variation)) {
            variation = 0;
        }

        $('.cost-breakdown-table').find('#cost_breakdown_variation').val(variation.toFixed(2));
    });
}

function hide_plus_minus_button() {
    $('.hide-plus-minus-buttons').find('.row-options-container').hide();
}

function fiveWhyQuestionEffects() {

    $('.why-question').on('change', function() {
        $why_questions = $(this).closest('.five-why-row').find('.five-why-questions');
        if ($(this).val() != 'yes') {
            
            $why_questions.removeClass('hidden');
            $why_questions.addClass('hidden');
        } else {
            $why_questions.removeClass('hidden');
            
        }

        $six_why_questions = $(this).closest('.six-why-row').find('.six-why-questions');
        if ($(this).val() != 'yes') {
            
            $six_why_questions.removeClass('hidden');
            $six_why_questions.addClass('hidden');
        } else {
            $six_why_questions.removeClass('hidden');
            
        }
    });


    /*$(document).on('keyup', '.five-why-textarea', function(){

        var six_why_display = true;

        var $five_why_textarea = $(this);

        var $textareas = $five_why_textarea.closest('.five-why-row').find('.five-why-textarea');

        $textareas.each(function(index, value){
            var $textarea = $(this);
            var textarea_value = $textarea.val();
            if(textarea_value == '' || textarea_value == ' ' || textarea_value == '  '){
                six_why_display = false;
            }
        });

        if(six_why_display){
            console.log(true);
            $five_why_textarea.closest('.panel-body').find('.six-why-row').removeClass('hidden');
        }else{
            console.log(false);
            $five_why_textarea.closest('.panel-body').find('.six-why-row').addClass('hidden');
        }

    });*/
}

function checkForCompletedForms(check_selector) {

    if ($(check_selector).length) {

        var notifyInterval = setInterval(function() {
            ajax_execute(check_selector, 'notify_owners', null);
        }, 5 * 1000);


        setTimeout(function() {
            clearInterval(notifyInterval);
        }, 15 * 10 * 1000);

    }
}

function ajax_execute(check_selector, method, dataString) {



    if (dataString == null) {
        dataString = {};
    }

    if ($(check_selector).length) {



        var token = $("input[name=9s8fjshd324hd98s]").val();
        var form_id = $('input[name=form_id]').val();

        var function_url = controller + '/' + method;

        dataString["9s8fjshd324hd98s"] = token;

        /*var dataString = {
                    "9s8fjshd324hd98s": token,

                };*/
        var ajax_url = base_url + function_url;


        $.ajax({
            type: "POST",
            url: ajax_url,
            data: dataString,
            dataType: "html",
            success: function(data) {
                //console.log(data);
            }
        });


    }
}

function rank_document() {


    $('#rank-document').submit(function(e) {

        e.preventDefault(); //STOP default action



        var btn = $(this).find('button[type=submit]');
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");

        var ajax_url = 'document-ranking/save';


        btn.button('loading');
        $.ajax({
            type: "POST",
            url: formURL,
            data: postData,
            dataType: "html",
            success: function(data) {
                get_ranking_like();
                $('#like-button').attr('disabled', 'disabled');
                $('textarea[name=ranking_comment]').attr('disabled', 'disabled');
            }
        }).always(function() {
            btn.hide();
        });



    });
}

function checkHistoryAnswer() {

    var required_append = '<p class="help-block"><span class="text-danger" style="font-size:13px !important;">Please add details and dates regarding this anomly before progressing</span></p>';
    var date_append = '<p class="help-block"><span class="text-danger">Please provide the start and end dates if relevant</span></p>';

    $equipment_history_select = $('.equipment-history-question select');

    if ($equipment_history_select.length > 0) {

        $equipment_history_select.each(function() {
            select_value = $(this).val();
            select_class = $(this).parent().attr('class').split(' ')[1];
            $select_textarea = $(this).closest('.equipment-history-question').find('textarea');
            if (select_class != 'none') {
                if (select_class == 'normal' || select_class == 'no_partial') {
                    if (select_value == 'yes' || select_value == 'partial' || select_value == 'suspected') {
                        $select_textarea.addClass('required');
                        $select_textarea.removeClass('hidden');
                    } else {
                        $select_textarea.removeClass('required');
                    }
                } else if (select_class == 'reversed') {
                    if (select_value == 'no' || select_value == 'partial' || select_value == 'suspected') {
                        $select_textarea.addClass('required');
                        $select_textarea.removeClass('hidden');
                    } else {
                        $select_textarea.removeClass('required');
                    }
                }
            }
        });

        $equipment_history_select.on('change', function() {
            selected_value = $(this).val();
            selected_class = $(this).parent().attr('class').split(' ')[1];
            $equipment_history_question = $(this).closest('.equipment-history-question');
            $textarea = $equipment_history_question.find('textarea');
            $dates = $equipment_history_question.find('.help-info');
            $equipment_history_date = $equipment_history_question.find('.equipment-history-date');
            $textarea_form = $textarea.parent();
            if (selected_class != 'none') {
                if (selected_class == 'normal' || selected_class == 'no_partial') {
                    if (selected_value == 'yes' || selected_value == 'partial' || selected_value == 'suspected') {
                        $textarea
                            .addClass('required')
                            .addClass('border-red');
                        $textarea.removeClass('hidden');
                        $textarea.parent().append(required_append);
                        $equipment_history_date.removeClass('hidden');
                    } else {
                        $textarea
                            .removeClass('required')
                            .removeClass('border-red');
                        $textarea.addClass('hidden');
                        $textarea.parent().find('.help-block').hide();
                        $equipment_history_date.addClass('hidden');
                    }
                } else if (selected_class == 'reversed') {
                    if (selected_value == 'no' || selected_value == 'partial' || selected_value == 'suspected') {
                        $textarea
                            .addClass('required')
                            .addClass('border-red');
                        $textarea.removeClass('hidden');
                        $textarea.parent().append(required_append);
                        $equipment_history_date.removeClass('hidden');
                    } else {
                        $textarea
                            .removeClass('required')
                            .removeClass('border-red');
                        $textarea.addClass('hidden');
                        $textarea.parent().find('.help-block').hide();
                        $equipment_history_date.addClass('hidden');
                    }
                }
            }
        });

    }
}

function validateRequiredInput($form) {

    var notification = '<small data-bv-validator="notEmpty" class="text-danger appended"></small>';
    var required_validate = false;
    var required_editable_validate = false;

    var $required = $form.find('.required');
    var required_count = $required.length;

    var $required_editable = $form.find('.form-group-required .note-editable');

    var required_editable_count = $required_editable.length;

    $required.first().attr('id', 'first-required');
    $required_editable.first().attr('id', 'first-required');


    if ($required.length > 0) {
        $required.each(function() {
            var $single_required = $(this);
            var required_value = $single_required.val();


            if (required_value == '') {

                var required_id = $single_required.attr('id');
                $required.addClass('border-red');
                $required.parent().find('.appended').remove();
                $required.parent().append(notification);

                return false;
            } else {
                required_validate = true;
            }


        });
    } else {
        required_validate = true;
    }


    if ($required_editable.length > 0) {
        $required_editable.each(function() {
            var $single_required_editable = $(this);
            var required_editable_value = $single_required_editable.html();

            if (required_editable_value == "<p><br></p>" || required_editable_value == "") {

                $required_editable.addClass('border-red');
                $required_editable.closest('.form-group').find('.appended').remove();
                $required_editable.closest('.form-group').append(notification);

                return false;

            } else {
                required_editable_validate = true;
            }
        });
    } else {
        required_editable_validate = true;
    }


    if (required_validate && required_editable_validate) {
        return true;
    }
}

function textareaOnKeyUp($note_editable) {

    var note_editable_value = $note_editable.html();
    var $note_codable = $note_editable.parent().find('.note-codable');
    var $main_textarea = $note_editable.closest('.form-group').find('.textarea-editor');


    $note_codable.text(note_editable_value);
    $main_textarea.text(note_editable_value);

    if ($note_editable.hasClass('note-required')) {
        if (note_editable_value == "<p><br></p>" || note_editable_value == "") {
            $note_editable.removeClass('border-green');
            $note_editable.addClass('border-red');
            $('button[type=submit]').prop("disabled", true);
        } else {
            $note_editable.removeClass('border-red');
            $note_editable.addClass('border-green');
            $('button[type=submit]').prop("disabled", false);
        }
    }
}

function determineEditorHeight($editor) {

    var height = 50;

    var xxs = $editor.is('.textarea-editor.xxs');
    var extra_small = $editor.is('.textarea-editor.xs');
    var small = $editor.is('.textarea-editor.small');
    var medium = $editor.is('.textarea-editor.medium');
    var large = $editor.is('.textarea-editor.large');
    var extra_large = $editor.is('textarea-editor.extra-large');
    var extra_larger = $editor.is('textarea-editor.extra-larger');


    if (extra_small) {
        height = 80;
    } else if (xxs) {
        height = 20;
    } else if (small) {
        height = 135;
    } else if (medium) {
        height = 185;
    } else if (large) {
        height = 500;
    } else if (extra_large) {
        height = 1000;
    } else if (extra_larger) {
        height = 2000;
    }

    return height;
}

function determineTextareaEditor($editor) {

    var selector = '.textarea-editor.xs';

    xxs = $editor.is('.textarea-editor.xxs');
    extra_small = $editor.is('.textarea-editor.xs');
    small = $editor.is('.textarea-editor.small');
    medium = $editor.is('.textarea-editor.medium');
    large = $editor.is('.textarea-editor.large');
    extra_large = $editor.is('textarea-editor.extra-large');
    extra_larger = $editor.is('textarea-editor.extra-larger');

    if (extra_small) {
        selector = '.textarea-editor.xs';
    } else if (xxs) {
        selector = '.textarea-editor.xxs';
    } else if (small) {
        selector = '.textarea-editor.small';
    } else if (medium) {
        selector = '.textarea-editor.medium';
    } else if (large) {
        selector = '.textarea-editor.large';
    } else if (extra_large) {
        selector = '.textarea-editor.extra-large';
    } else if (extra_larger) {
        selector = '.textarea-editor.extra-larger';
    }

    return selector;
}

function textareaEffects() {

    $textareas = $('#summary, .textarea-editor, #case-summary');

    $textareas.each(function() {

        $single_textarea = $(this);

        if ($single_textarea.attr('id') == '#summary') {
            selector_text = '#summary';
        } else if ($single_textarea.attr('id') == '#case-summary') {
            selector_text = '#case-summary';
        } else {

        }

        tinymce.init({
            selector: determineTextareaEditor($single_textarea),
            height: determineEditorHeight($single_textarea),
            menubar: false,
            statusbar: false,
            resize: true,
            toolbar: "bold italic | bullist numlist outdent indent | removeformat formatselect",
            content_css: base_url + 'css/tinymce_custom.css'

        });



    });


    $(this).closest('.form-group').find('iframe').html();
}

function documentUploadModal() {

    $('.btn-upload-modal').click(function(e) {

        e.preventDefault();

        $('#document-upload-modal').modal();

    });
}

function checkIfSaved() {
    $('a').not('.nexttab, .btn-upload-modal, .img-lightbox, .lb-close, .lb-next, .lb-prev').click(function(e) {

        var link = $(this).attr('href');
        var form_data;
        var $form;
        var ajax_url;
        var dataString;

        if (link == 'window.print();') {
            e.preventDefault();
            window.print();
            return;
        }

        if ($(this).hasClass('fileinput-exists')) {}



        $('input[name=link_to]').val(link);

        if ($('form.check-submit').length > 0) {

            $form = $('form.check-submit');
            ajax_url = $form.attr('action');

            e.preventDefault();

            $('#submit-check-modal ').modal();

            $('#submit-check-modal .go-link').on('click', function() {

                $(this).closest('.modal').modal('hide');

            });


            $('#submit-check-modal .submit').on('click', function(e) {

                window.location = link;

            });
        }
    });
}

function confirmDelete() {

    var $delete_form = $('a.delete-form');
    var $delete_form_modal = $('#confirm-delete-form');
    var $delete_form_modal_delete_yes = $delete_form_modal.find('.go-yes');
    var $delete_form_modal_delete_no = $delete_form_modal.find('.go-no');

    $(document).on('click', 'a.delete-form', function(e) {
        //$delete_form.click(function(e) {

        var $delete_button = $(this);

        var link = $(this).attr('href');
        var link_array = link.split('/');

        var link_array_length = link_array.length;
        var id = link_array[link_array_length - 1];

        e.preventDefault();

        $delete_form_modal.modal();

        $delete_form_modal_delete_no.on('click', function(e) {

            $(this).closest('.modal').modal('hide');

        });

        $delete_form_modal_delete_yes.on('click', function(e) {

            delete_ajax(link, id, $delete_button, $(this));

        });
    });
}

function goToByScroll(id) {

    id = id.replace("link", "");

    $(window).scrollTop($("#" + id).offset().top);
}

function casefileNexts() {

    var form_data;
    var $form;
    var ajax_url;
    var dataString;

    $('.btn-icon.casefile').click(function(e) {
        e.preventDefault();
        $form = $(this).closest('form');

        var is_required_valid = validateRequiredInput($form);

        if (is_required_valid) {
            var is_valid = $form.data('bootstrapValidator').validate().isValid();
            $form.submit();
        } else {
            goToByScroll('first-required');
        }


    });

    $('.nexttab.casefile').click(function(e) {
        e.preventDefault();
        $form = $(this).closest('form');

        var is_required_valid = validateRequiredInput($form);

        if (is_required_valid) {
            next_link = $form.find('input[name=next_link]').val();
            link_to = $form.find('input[name=link_to]').val(next_link);

            var is_valid = $form.data('bootstrapValidator').validate().isValid();

            if (is_valid) {
                $form.submit();
            }


        } else {
            goToByScroll('first-required');
        }




    });
}

function validateSteps() {

    $('.check-submit.check-completed').bootstrapValidator(required_field_properties);
}

function carouselEffects() {
    $('.carousel').carousel({
        interval: 7000
    });
}

function alertEffects() {
    //$(".alert").alert();
}

function sectionEffects() {
    $('.collapse').collapse();

    $(document).on('click', '.page-header.accordion', function() {


        var $page_header = $(this);
        var $page_header_button = $(this).find('.accordion-btn .glyphicon');
        var $page_header_title = $(this).find('.secondary-title');

        $page_header_button.toggleClass('glyphicon-chevron-up');

        if ($page_header_button.hasClass('glyphicon-chevron-up')) {
            $page_header_button.removeClass('glyphicon-chevron-down');
            $page_header_title.show();
        }

        if (!$page_header_button.hasClass('glyphicon-chevron-up')) {
            $page_header_button.addClass('glyphicon-chevron-down');
            $page_header_title.hide();
        }


    });
}

function bootstrapTooltipEffects() {
    $('.btn, .tooltip-effect').tooltip();
}

function customTooltipEffects() {
    $('.custom-tooltip, .custom-tooltip-small, .upload-tooltip').append('<div class="close-button">x</div>');
    $('.close-button').click(function() {
        $(this).parent().fadeOut();
    });
}

function tooltipToggle() {
    $('.tooltip-toggle').click(function() {
        $('.custom-tooltip, .custom-tooltip-small').hide('slow');
        if ($(this).closest('.custom-tooltip-container').find('.custom-tooltip').length) {
            $(this).closest('.custom-tooltip-container').find('.custom-tooltip').show();
        } else if ($(this).closest('.custom-tooltip-container').find('.custom-tooltip-small').length) {
            $(this).closest('.custom-tooltip-container').find('.custom-tooltip-small').show();
        } else {
            $(this).closest('.custom-tooltip-container').find('.upload-tooltip').show();
        }

    });
}

function coloredSelectEffects() {


    $(document).on('change', '.color-select', function() {

        var selected_option_color = $('option:selected', this).attr('class').split(' ').pop();
        var container_class = $(this).attr('class');
        var color_class = container_class.split(' ').pop();

        $(this).removeClass(color_class);
        $(this).addClass(selected_option_color);

    });



    $(document).on('change', '.colored-select', function() {

        if ($(this).hasClass('consequence-priority')) {

            var container_class = 'consequence-priority form-control colored-select';

            $('.colored-select option:selected').each(function() {

                var select_value = $(this).val();
                var select_text = $(this).text();
                var select_class = $(this).attr('class');

                if (typeof select_class != 'undefined') {
                    var select_class_split = select_class.split(' ');
                    var select_class_color = select_class_split[2];
                } else {
                    var select_class_color = 'bg-white'
                }



                $(this).parent().attr('class', '');
                $(this).parent().attr('class', container_class + ' ' + select_class_color);

            });

        } else {

            var container_class = 'form-control colored-select';

            $('.colored-select option:selected').each(function() {

                var select_value = $(this).val();
                var select_text = $(this).text();
                var select_class = $(this).attr('class');

                if (typeof select_class != 'undefined') {
                    var select_class_split = select_class.split(' ');
                    var select_class_color = select_class_split[1];
                } else {
                    var select_class_color = 'bg-white'
                }


                $(this).parent().attr('class', '');
                $(this).parent().attr('class', container_class + ' ' + select_class_color);

            });

        }



    });
}

function option1Checker() {

    $(document).on('change', '.consequence-area-impact', function() {

        var highest_consequence = ajax_area_impact();



        var token = $("input[name=9s8fjshd324hd98s]").val();

        var function_url = 'case-file/get_consequence_description';

        var consequence_area_impact = $(this).val();
        var consequence_priority_value = $(this).closest('.consequence').find('.consequence-priority').val();
        var $consequence_description = $(this).closest('.consequence').find('.consequence-description');

        var $consequence_priority = $(this).closest('.consequence').find('.consequence-priority');
        var consequence_priority_classes = $consequence_priority.attr('class').split(' ');

        var ajax_url = base_url + function_url;

        if (consequence_area_impact == 7) {

            var highest_consequence_id = highest_consequence[0];
            var highest_consequence_value = highest_consequence[1];
            var highest_consequence_class = highest_consequence[2];

            $consequence_priority.val(highest_consequence_id);
            $consequence_priority.children(':selected').text(highest_consequence_value);
            $consequence_priority.not('option').removeClass(consequence_priority_classes[3]);
            $consequence_priority.not('option').addClass(highest_consequence_class);
            $consequence_description.html('');



        } else {

            var dataString = {
                "area_impact": consequence_area_impact,
                "priority_value": consequence_priority_value,
                "9s8fjshd324hd98s": token
            };

            $.ajax({
                type: "POST",
                url: ajax_url,
                data: dataString,
                dataType: "html",
                success: function(data) {
                    if (data == null || data == '' || data == undefined) {
                        $consequence_description.html('');
                    } else {
                        $consequence_description.html(data);
                    }



                }
            });

        }




    });
}

function option2Checker() {

    $(document).on('change', '.consequence-priority', function() {

        var token = $("input[name=9s8fjshd324hd98s]").val();

        var function_url = 'case-file/get_consequence_description';

        var consequence_priority_value = $(this).val();

        var consequence_area_impact = $(this).closest('.consequence').find('.consequence-area-impact').val();
        var $consequence_description = $(this).closest('.consequence').find('.consequence-description');



        var dataString = {
            "area_impact": consequence_area_impact,
            "priority_value": consequence_priority_value,
            "9s8fjshd324hd98s": token
        };
        var ajax_url = base_url + function_url;


        $.ajax({
            type: "POST",
            url: ajax_url,
            data: dataString,
            dataType: "html",
            success: function(data) {
                if (data == null || data == '' || data == undefined) {
                    $consequence_description.html('');
                } else {
                    $consequence_description.html(data);
                }
            }
        });



    });
}

function dateEffects() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        orientation: 'auto left'
    }).on('changeDate', function(e) {
        $(this).datepicker('hide');
    });

    $('.datepicker-action-tracker').datepicker({
        format: 'd/m/yy',
        orientation: 'auto left'
    }).on('changeDate', function(e) {
        $(this).datepicker('hide');
    });
    $('.timepicker').timepicker();
}

function tabEffects() {
    var $tabs = $('.panel-tabs li');

    $('.prevtab').on('click', function() {
        $tabs.filter('.active').prev('li').find('a[data-toggle="tab"]').tab('show');
    });

    $('.nexttab').on('click', function() {
        $tabs.filter('.active').next('li').find('a[data-toggle="tab"]').tab('show');
    });
}

function selectEffects() {
    //$("#filter-status-dropdown").select2({ maximumSelectionSize: 3 });
}

function iCheckEffects() {
    $('input').iCheck({
        checkboxClass: 'icheckbox_flat',
        radioClass: 'iradio_flat'
    });
}

function change_image_hover(image_map_selector, image_selector) {

    $(image_map_selector).hover(function() {
        $(image_selector).attr('src', start_activity_hover);
    }, function() {
        $(image_selector).attr('src', start_activity_normal);
    });
}

function ajax_select(change_selector, function_url, menu_type, output_selector, parent_selector, menu_level, menu_detail) {

    //$('.equipment-select').hide();

    var token = $("input[name=9s8fjshd324hd98s]").val();
    var parent_selector = parent_selector || null;
    var menu_level = menu_level || 'menu';
    var menu_detail = menu_detail || 'code';

    var $output_element = $(output_selector);

    if ($(change_selector).length > 0) {

        $(document).on('change', change_selector, function() {

            var $change_element = $(this);

            var id = $change_element.val();

            var dataString = {
                "id": id,
                "9s8fjshd324hd98s": token,
                "menu_type": menu_type,
                "menu_level": menu_level,
                "menu_detail": menu_detail
            };
            var ajax_url = base_url + function_url;
            //console.log('on change');


            $.ajax({
                type: "POST",
                url: ajax_url,
                data: dataString,
                dataType: "html",
                success: function(data) {
                    //console.log('success');
                    //console.log(data);
                    if (data == '<option value="" class="bg-white">- Select -</option>' || data == '<option value="" class="bg-white">- Select from Main Category -</option>') {
                        $output_element.closest('.equipment-select').slideUp();
                        $output_element.closest('.equipment-select').next('.equipment-select').slideUp();
                    } else {
                        $output_element.closest('.equipment-select').slideDown();
                    }

                    if (parent_selector == null) {
                        if ($(output_selector).is('input')) {
                            $output_element.val(data);
                        } else {
                            $output_element.html(data);
                        }
                    } else {

                        $output_element = $change_element.closest(parent_selector).find(output_selector);

                        if ($(output_selector).is('input')) {
                            $output_element.val(data);
                        } else {
                            $output_element.html(data);
                        }
                    }
                }
            });

        });
    }
}

function ajax_load(ajax_url, dataString, output_container) {
    $.ajax({
        type: "POST",
        url: ajax_url,
        data: dataString,
        dataType: "html",
        success: function(data) {
            $(output_container).html(data);
        }
    });
    //alert('ajax_load happened');
}

function getDynamicRow(controller_name, view_name, output_container, table_name) {

    var ajax_url = base_url + controller + '/' + 'get-dynamic-row';
    var token = $("input[name=9s8fjshd324hd98s]").val();
    var model_id = $("input[name=model_id]").val();
    var form_id = $("input[name=form_id]").val();
    var current_step = $("input[name=current_step]").val();


    var dataString = {
        "model_id": model_id,
        "form_id": form_id,
        "9s8fjshd324hd98s": token,
        "current_step": current_step,
        "table_name": table_name,
        "view_name": view_name,
        "controller_name": controller_name
    };


    ajax_load(ajax_url, dataString, output_container);




    $(document).on('click', '.add', function() {
        var is_last = $(this).hasClass('last');
        var $main_row = $(this).closest('.main-row');
        var row_id = $main_row.attr('id');
        var row_count = $main_row.find('input[name=row_count]').val();
        var row_order = $main_row.find('input[name=row_order]').val();
        var add_url = base_url + controller + '/' + 'add_ordered_row';

        dataString.row_count = row_count;
        dataString.row_id = row_id;
        dataString.is_last = '' + is_last + '';

        //alert(row_id);
        //alert(dataString.table_name);
        //alert(is_last);
        if (row_count != 0) {
            $.ajax({
                type: "POST",
                url: add_url,
                data: dataString,
                dataType: "html",
                success: function(data) {
                    ajax_load(ajax_url, dataString, output_container);
                    //alert(data);
                },
                error: function(data) {
                    //alert(data);
                }
            });
        } else {

        }



    });

    $(document).on('click', '.remove', function() {
        var row_id = $(this).closest('.main-row').attr('id');
        var remove_url = base_url + controller + '/' + 'remove_ordered_row';

        dataString.row_id = row_id;

        //alert(row_id);

        $.ajax({
            type: "POST",
            url: remove_url,
            data: dataString,
            dataType: "html",
            success: function(data) {
                //alert(data);
                ajax_load(ajax_url, dataString, output_container);
            },
            error: function(data) {
                //alert(data);
            }
        });
    });
}

function ajax_autocomplete(change_selector, autocomplete_container, function_url, output_selector, output_container) {


    var token = $("input[name=9s8fjshd324hd98s]").val();

    var $change_selector = $(change_selector);

    var $autosuggest_options;

    if ($change_selector.length) {

        $(document).on('keyup', change_selector, function() {

            $change_selector = $(this);

            var $autocomplete_container = $change_selector.closest(autocomplete_container);
            var $output_selector = $autocomplete_container.find(output_selector);

            var $options = $output_selector.closest(output_container);

            if ($(this).val() != '') {

                var id = $(this).val();
                var dataString = {
                    "id": id,
                    "9s8fjshd324hd98s": token
                };
                var ajax_url = base_url + function_url;

                $.ajax({
                    type: "POST",
                    url: ajax_url,
                    data: dataString,
                    dataType: "html",
                    success: function(data) {

                        if (data == '') {
                            $options.fadeOut('fast');
                        } else {
                            $options.show();
                        }



                        if ($output_selector.is('input')) {
                            $output_selector.val(data);
                        } else {
                            $output_selector.html(data);
                        }

                        $autosuggest_options = $('.autosuggest-options');


                        $autosuggest_options.click(function() {
                            var autosuggest_value = $(this).attr('id');
                            var autosuggest_text = $(this).text();
                            $change_selector.val(autosuggest_text);
                            $change_selector.closest('.form-group').find('input[type=hidden]').val(autosuggest_value);
                            $options.fadeOut('fast');
                        });



                    }
                });



            } else {
                $options.fadeOut('fast');
            }




        });
    }
}

function selectSuggestion(click_selector) {

    $(click_selector).click(function() {

        var text = $(this).text();
        var id = $(this).attr('id');
        var $input_value = $(this).closest('.autosuggest-container').find('.autosuggest-input');
        var $input_hidden = $input_value.next('.autosuggest-input-hidden');

        $input_value.val(text);
        $input_hidden.val(id);

        $(this).parent().hide();

    });
}

function ajax_area_impact() {

    var area_impact_consequence = [];
    var consequence_highest_value = [];
    var area_impact = [];
    var consequence = [];
    var area_impact_value = [];
    var consequence_value = [];
    var consequence_class = [];

    $('.consequence').each(function() {

        var single_row = [];
        var single_area_of_impact;
        var single_consequence;
        var single_area_of_impact_value;
        var single_consequence_value;

        $(this).find('select').each(function(index, value) {
            if (index === 0) {
                single_area_of_impact = $(this).val();
                single_area_of_impact_value = $(this).children(':selected').text();


            }
            if (index === 1) {
                single_consequence = $(this).val();
                single_consequence_value = $(this).children(':selected').text();

                single_consequence_classes = $(this).children(':selected').attr('class');

                if (typeof single_consequence_classes != 'undefined') {
                    single_consequence_classes_split = single_consequence_classes.split(' ');
                    single_consequence_class = single_consequence_classes_split[2];
                } else {
                    single_consequence_class = 'bg-white';
                }




            }
        });

        if (single_area_of_impact != 5) {
            area_impact.push(single_area_of_impact);

            consequence.push(single_consequence);

            single_row.push(single_area_of_impact);

            area_impact_consequence[single_area_of_impact] = single_consequence;
            consequence_highest_value[single_area_of_impact] = single_consequence_value;
            consequence_class[single_area_of_impact] = single_consequence_class;

        }

    });

    area_impact.sort(function(a, b) {
        return a - b;
    });

    return [area_impact_consequence[area_impact[0]],
        consequence_highest_value[area_impact[0]],
        consequence_class[area_impact[0]]
    ];
}

function capitaliseFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function deleteFileInView() {
    $(document).on('click', '.delete-file-view', function() {

        var token = $("input[name=9s8fjshd324hd98s]").val();

        var $file_row = $(this).closest('.file-row');
        var file_id = $file_row.attr('id').split('-')[1];

        var file_name = $file_row.find('.file-name').val();

        $file_row.hide();


        var controller = 'case-file';
        var method = 'unlink-file';
        var table = 'file';

        var function_url = controller + '/' + method;

        var dataString = {
            "9s8fjshd324hd98s": token,
            'id': file_id,
            'table': table,
            'file_name': file_name
        };


        var ajax_url = base_url + function_url;


        $.ajax({
            type: "POST",
            url: ajax_url,
            data: dataString,
            dataType: "html",
            success: function(data) {
                //alert(data);
            }
        });




    });
}

function tb_ranking() {


    $("#feedback_button").click(function() {

        $(this).find('.glyphicon').toggleClass("glyphicon-chevron-down");
        $(this).closest('#ranking-container').find('.form').slideToggle();

    });


    $(document).on('click', "#like-button", function() {

        $ranking_like = $(this).closest('#ranking-container').find('input[name=ranking_like]');
        ranking_like_value = $ranking_like.val();

        $(this).toggleClass("btn-like");
        //alert(ranking_like_value);
        if (ranking_like_value == 1) {
            $ranking_like.val(0);
        } else {
            $ranking_like.val(1);
        }

    });
}

function scroll_top() {
    $.scrollUp({
        scrollName: 'scrollUp', // Element ID
        topDistance: '300', // Distance from top before showing element (px)
        topSpeed: 300, // Speed back to top (ms)
        animation: 'fade', // Fade, slide, none
        animationInSpeed: 200, // <a href="http://www.jqueryscript.net/animation/">Animation</a> in speed (ms)
        animationOutSpeed: 200, // Animation out speed (ms)
        scrollText: 'Scroll to top', // Text for element
        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
    });

    $('#scrollUp').html('<span class="glyphicon glyphicon-chevron-up"></span>');
}

function delete_ajax(link, id, $delete_button, $modal) {

    var token = $("input[name=9s8fjshd324hd98s]").val();

    var $data_row = $delete_button.closest('#data-row-' + id);

    var dataString = {
        "9s8fjshd324hd98s": token,
        'id': id
    };


    $data_row.fadeOut(500);


    $.ajax({
        type: "POST",
        url: link,
        data: dataString,
        dataType: "html",
        success: function(response) {

            //console.log(response);



        },
        error: function() {
            //alert('Error while request..');
        }
    });


    $modal.closest('.modal').modal('hide');
}

function update_menu() {
    $('input.btn.btn-sm.btn-update-menu').click(function(e) {
        e.preventDefault();
        var $row = $(this).closest('tr');
        var row_id = $row.attr('id');

        row_id = row_id.split('-');
        var id = row_id[row_id.length - 1];

        var name;
        var description;
        var color_class;
        var code;
        var menu_category_id;
        var token;
        var order;
        var secondary_description;
        var value;
        var level;

        token = $('input[name=9s8fjshd324hd98s]').val();
        name = $row.find('input[name=name]').val();
        value = $row.find('input[name=value]').val();
        description = $row.find('input[name=description]').val();
        secondary_description = $row.find('input[name=secondary_description]').val();
        color_class = $row.find('input[name=color_class]').val();
        code = $row.find('input[name=code]').val();
        order = $row.find('input[name=order]').val();
        level = $row.find('input[name=level]').val();
        menu_category_id = $row.find('select[name=menu_category_id]').val();

        var url = 'menu-category-admin/save';
        var dataString = {
            "id": id,
            "name": name,
            "value": value,
            "description": description,
            "secondary_description": secondary_description,
            "color_class": color_class,
            "code": code,
            "order": order,
            "level": level,
            "menu_category_id": menu_category_id,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: url,
            data: dataString,

        });

    });
}

function add_menu() {
    $('#add_menu').submit(function(e) {
        e.preventDefault();
        var $row = $('table tr:last');
        var row_id = $row.attr('id');

        row_id = row_id.split('-');
        var id = parseInt(row_id[row_id.length - 1]) + 1;

        var name;
        var description;
        var color_class;
        var code;
        var menu_category_id;
        var token;
        var order;
        var secondary_description;
        var value;
        var level;

        var $form = $(this);

        token = $('input[name=9s8fjshd324hd98s]').val();
        name = $form.find('input[name=name]').val(),
        value = $form.find('input[name=value]').val();
        description = $form.find('input[name=description]').val();
        secondary_description = $form.find('input[name=secondary_description]').val();
        color_class = $form.find('input[name=color_class]').val();
        code = $form.find('input[name=code]').val();
        order = $form.find('input[name=order]').val();
        level = $form.find('input[name=level]').val();
        menu_category_id = $form.find('select[name=menu_category_id]').val();

        var url = 'menu-category-admin/create';

        var dataString = {
            "name": name,
            "value": value,
            "description": description,
            "secondary_description": secondary_description,
            "color_class": color_class,
            "code": code,
            "order": order,
            "level": level,
            "menu_category_id": menu_category_id,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: url,
            data: dataString,

            success: function(data) {
                var item = JSON.parse(data);

                var clone = jQuery("#menu_table tr:last").clone(true);
                clone[0].setAttribute('id', 'data-row-' + item[0].menu_id);
                clone.find('td:first').text(item[0].menu_id);
                clone.find('input[name=name]').val(item[0].name);
                clone.find('input[name=value]').val(item[0].value);
                clone.find('input[name=description]').val(item[0].description);
                clone.find('input[name=secondary_description]').val(item[0].secondary_description);
                clone.find('input[name=color_class]').val(item[0].color_class);
                clone.find('input[name=code]').val(item[0].code);
                clone.find('input[name=order]').val(item[0].order);
                clone.find('input[name=level]').val(item[0].level);
                clone.find('select[name=menu_category_id]').val(item[0].menu_category_id);
                clone.insertBefore("#menu_table > tbody >tr:first").show();

            }
        });
    });
}

function update_menu_category() {

    $('a.btn-update').click(function(e) {

        e.preventDefault();
        var $row = $(this).closest('tr');
        var row_id = $row.attr('id');

        row_id = row_id.split('-');
        var id = row_id[row_id.length - 1];

        //alert('id');

        var menu_type;
        var description;
        var token;

        token = $('input[name=9s8fjshd324hd98s]').val();
        menu_type = $row.find('input[name=menu_type]').val();
        description = $row.find('input[name=description]').val();

        var url = 'menu-admin/save';
        var dataString = {
            "menu_category_id": id,
            "menu_type": menu_type,
            "description": description,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: url,
            data: dataString,
            success: function(data) {
                //console.log(data);
            }
        });

    });
}

function add_menu_category() {

    $('#add-menu-category').submit(function(e) {

        e.preventDefault();
        var $row = $('table tr:last');
        var row_id = $row.attr('id');

        row_id = row_id.split('-');
        var id = parseInt(row_id[row_id.length - 1]) + 1;

        var name;
        var description;
        var token;

        var $form = $(this);

        token = $('input[name=9s8fjshd324hd98s]').val();
        name = $form.find('input[name=menu_type]').val(),
        description = $form.find('input[name=description]').val();

        var url = 'menu-admin/create';

        var dataString = {
            "menu_type": name,
            "description": description,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: url,
            data: dataString,

            //success: function(data) {
            //var item = JSON.parse(data);
            //alert('test');
            //var clone = jQuery("#table-menu-category tr:last").clone(true);
            /*clone[0].setAttribute('id', 'data-row-'+id); 
                    clone.find( 'td:first').text(item[0].menu_category_id);   
                    clone.find( 'input[name=menu_type]').val(item[0].name);
                    clone.find( 'input[name=description]').val(item[0].description);*/
            //clone.insertAfter("#table-menu-category tr:last");

            //}
            success: function(data) {
                var item = JSON.parse(data);

                //console.log(data);

                var clone = jQuery("#table-menu-category tr:last").clone(true);
                clone[0].setAttribute('id', 'data-row-' + id);
                clone.find('td:first').text(item[0].menu_category_id);
                clone.find('input[name=menu_type]').val(item[0].menu_type);
                clone.find('input[name=description]').val(item[0].description);
                clone.insertAfter("#table-menu-category tr:last");

                //alert('ok');

            }
        });

    });
}

function menu_dropdown_selector() {
    //select based on dropdown
    $('#selectMenuCategory').change(function() {
        var selectval = $(this).val();
        $('#menu_table tr:not(:first)').each(
            function() {
                if ($(this).find('select[name=menu_category_id]').val() !== selectval) {
                    $(this).closest('tr').hide();
                } else {
                    $(this).closest('tr').show();
                }
            });
    });
}

//add and update menu subcategory
function add_menu_subcategory() {
    $('#add_menu_subcategory').submit(function(e) {
        e.preventDefault();
        var $row = $('table tr:last');
        var row_id = $row.attr('id');

        row_id = row_id.split('-');
        var id = parseInt(row_id[row_id.length - 1]) + 1;

        var name;
        var description;
        var color_class;
        var code;
        var menu_id;
        var token;

        var $form = $(this);

        token = $('input[name=9s8fjshd324hd98s]').val();
        name = $form.find('input[name=name]').val(),
        description = $form.find('input[name=description]').val();
        color_class = $form.find('input[name=color_class]').val();
        code = $form.find('input[name=code]').val();
        menu_id = $form.find('select[name=menu_category_id]').val();

        var url = 'menu-subcategory-admin/create';

        var dataString = {
            "name": name,
            "description": description,
            "color_class": color_class,
            "code": code,
            "menu_id": menu_id,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: url,
            data: dataString,

            success: function(data) {
                var item = JSON.parse(data);

                var clone = jQuery("#menu_table tr:last").clone(true);
                clone[0].setAttribute('id', 'data-row-' + item[0].menu_subcategory_id);
                clone.find('td:first').text(item[0].menu_subcategory_id);
                clone.find('input[name=name]').val(item[0].name);
                clone.find('input[name=description]').val(item[0].description);
                clone.find('input[name=color_class]').val(item[0].color_class);
                clone.find('input[name=code]').val(item[0].code);
                clone.find('select[name=menu_category_id]').val(item[0].menu_id);
                clone.insertBefore("#menu_table > tbody >tr:first").show();

            }
        });
    });
}

function update_menu_subcategory() {
    $('input.btn.btn-sm.btn-update-subcategory').click(function(e) {
        e.preventDefault();
        var $row = $(this).closest('tr');
        var row_id = $row.attr('id');

        row_id = row_id.split('-');
        var id = row_id[row_id.length - 1];

        var name;
        var description;
        var color_class;
        var code;
        var menu_id;
        var token;

        token = $('input[name=9s8fjshd324hd98s]').val();
        name = $row.find('input[name=name]').val();
        description = $row.find('input[name=description]').val();
        color_class = $row.find('input[name=color_class]').val();
        code = $row.find('input[name=code]').val();
        menu_id = $row.find('select[name=menu_category_id]').val();

        var url = 'menu-subcategory-admin/save';
        var dataString = {
            "id": id,
            "name": name,
            "description": description,
            "color_class": color_class,
            "code": code,
            "menu_id": menu_id,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: url,
            data: dataString,
        });

    });
}

//add and update menu deep subcategory
function add_menu_deep_subcategory() {
    $('#add_menu_deep_subcategory').submit(function(e) {
        e.preventDefault();
        var $row = $('table tr:last');
        var row_id = $row.attr('id');

        row_id = row_id.split('-');
        var id = parseInt(row_id[row_id.length - 1]) + 1;

        var name;
        var description;
        var color_class;
        var code;
        var menu_id;
        var token;

        var $form = $(this);

        token = $('input[name=9s8fjshd324hd98s]').val();
        name = $form.find('input[name=name]').val(),
        description = $form.find('input[name=description]').val();
        color_class = $form.find('input[name=color_class]').val();
        code = $form.find('input[name=code]').val();
        menu_subcategory_id = $form.find('select[name=menu_category_id]').val();

        var url = 'menu-deep-subcategory-admin/create';

        var dataString = {
            "name": name,
            "description": description,
            "color_class": color_class,
            "code": code,
            "menu_subcategory_id": menu_subcategory_id,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: url,
            data: dataString,

            success: function(data) {
                var item = JSON.parse(data);

                var clone = jQuery("#menu_table tr:last").clone(true);
                clone[0].setAttribute('id', 'data-row-' + item[0].menu_deep_subcategory_id);
                clone.find('td:first').text(item[0].menu_deep_subcategory_id);
                clone.find('input[name=name]').val(item[0].name);
                clone.find('input[name=description]').val(item[0].description);
                clone.find('input[name=color_class]').val(item[0].color_class);
                clone.find('input[name=code]').val(item[0].code);
                clone.find('select[name=menu_category_id]').val(item[0].menu_subcategory_id);
                clone.insertBefore("#menu_table > tbody >tr:first").show();


            }
        });
    });
}

function update_menu_deep_subcategory() {
    $('input.btn.btn-sm.btn-update-deep-subcategory').click(function(e) {
        e.preventDefault();
        var $row = $(this).closest('tr');
        var row_id = $row.attr('id');

        row_id = row_id.split('-');
        var id = row_id[row_id.length - 1];

        var name;
        var description;
        var color_class;
        var code;
        var menu_subcategory_id;
        var token;

        token = $('input[name=9s8fjshd324hd98s]').val();
        name = $row.find('input[name=name]').val();
        description = $row.find('input[name=description]').val();
        color_class = $row.find('input[name=color_class]').val();
        code = $row.find('input[name=code]').val();
        menu_subcategory_id = $row.find('select[name=menu_category_id]').val();

        var url = 'menu-deep-subcategory-admin/save';
        var dataString = {
            "id": id,
            "name": name,
            "description": description,
            "color_class": color_class,
            "code": code,
            "menu_subcategory_id": menu_subcategory_id,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: url,
            data: dataString,
        });

    });
}

function changePhoto() {
    var $change_photo = $('a.coverbutton');
    var $change_photo_modal = $('#change-photo');



    $change_photo.click(function(e) {
        $change_photo_modal.modal();
    });

    /*
            var $change_photo_modal = $('#change-photo');
            var $change_photo_modal_change_yes = $change_photo_modal.find('.change');
            var $change_photo_modal_change_no = $change_photo_modal.find('.notchange');*/
}

function document_status() {

    var $document_status_box = $('#document_status');
    var $reviewed_box = $('#reviewed-by-row');
    var $approved_box = $('#approved-by-row');





    //document status on change
    $(document).on('change', 'select[name=document_status]', function() {
        var $document_status_dropdown = $(this);
        var document_status = $document_status_dropdown.val();
        var document_status_text = $document_status_dropdown.find('option:selected').text();

        var $document_status_value = $('input[name=document_status_value]');

        $document_status_value.val(document_status_text.toLowerCase());

        if (document_status_text == 'Reviewed') {
            $reviewed_box.removeClass('hidden');
            $approved_box.addClass('hidden');
        } else if (document_status_text.indexOf('Approved') != -1) {
            $reviewed_box.addClass('hidden');
            $approved_box.removeClass('hidden');
        } else {
            $reviewed_box.addClass('hidden');
            $approved_box.addClass('hidden');
        }

    });

    //update document status
    $(document).on('click', '#update-document-status', function(event) {
        //alert('test');
        event.preventDefault();

        //update document status history table


        var btn = $(this);
        var post_data = $(this).closest('form').serializeArray();

        //console.log(post_data);

        var data_object = {};

        $(post_data).each(function(i, field) {
            data_object[field.name] = field.value;
        });

        //console.log(data_object.document_status_submit);

        //console.log(post_data);

        var ajax_url = data_object["document_status_submit"];

        //alert(ajax_url);



        btn.button('loading');
        btn.text('Updating...');
        $.ajax({
            type: "POST",
            url: ajax_url,
            data: post_data,
            dataType: "html",
            success: function(data) {
                //console.log(data);
                user_document_status();
            }
        }).always(function() {
            btn.addClass('btn-success');
            btn.button('reset');
            btn.removeClass('btn-success');
        });
    });




    //update-document-status-window
    $(document).on('click', '#update-document-status-window', function(event) {
        event.preventDefault();

        //update document status history table


        var btn = $(this);
        var update_document_status = btn.closest('tr').find('select[name=document_status]').val();
        var update_document_id = btn.closest('tr').attr('id').split('-').pop();
        var post_data = $(this).closest('form').serializeArray();

        var data_object = {};

        data_object["update_document_status"] = update_document_status;
        data_object["update_document_id"] = update_document_id;
        data_object["from_status_window"] = true;

        $(post_data).each(function(i, field) {
            data_object[field.name] = field.value;
        });

        //console.log(data_object.document_status_submit);

        //console.log(data_object);

        //console.log(update_document_status);

        var ajax_url = data_object["document_status_submit"];



        btn.button('loading');
        btn.text('Updating...');
        $.ajax({
            type: "POST",
            url: ajax_url,
            data: data_object,
            dataType: "html",
            success: function(data) {
                //console.log(data);
            }
        }).always(function() {
            btn.addClass('btn-success');
            btn.button('reset');
            btn.removeClass('btn-success');
        });
    });
}

function get_ranking_like() {

    $ranking_container = $('#ranking-container');

    if ($ranking_container.length > 0) {

        var token = $("input[name=9s8fjshd324hd98s]").val();
        var document_id = $('input[name=document_id]').val();

        var function_url = 'document_ranking/get_likes';

        var dataString = {

            "9s8fjshd324hd98s": token,
            "document_id": document_id,
            "with_like_text": true

        };

        var ajax_url = base_url + function_url;


        $.ajax({
            type: "POST",
            url: ajax_url,
            data: dataString,
            dataType: "html",
            success: function(data) {
                $('.like-count').text(data);
            }
        });

    }
}

/*function other_to_textfield() {
    $(document).on('change', '.other-select', function() {
        var result = $(this).find('option:selected').text();
        //console.log(result);

        if (result == 'Other') {
            //console.log('ok');
            var result2 = $(this).next();
            var a = $(result2).find('input').prop('readonly', false);

            //console.log(result);

        } else {
            var result = $(this).next();
            $(result).find('input').prop('readonly', true);
            var c = $(result).find('input').val('');
            //console.log(c);
        }
    });
}

function check_other_textfield() {
    $('.other-select').each(function() {
        var result = $(this).find('option:selected').text();
        if (result == 'Other') {
            var result2 = $(this).next();
            $(result2).find('input').prop('readonly', false);
        }
    });
}*/

function video_js() {

    $.each($('.video-js'), function(index, value) {
        video_id = $(this).attr('id');
        videojs(video_id, {}, function() {
            // Player (this) is initialized and ready.
        });
    });
}

function defaultRowWriter(rowIndex, record, columns, cellWriter) {
    var tr = '';

    // grab the record's attribute for each column
    for (var i = 0, len = columns.length; i < len; i++) {
        tr += cellWriter(columns[i], record);
    }

    return '<tr id="data-row-' + record.document_id + '">' + tr + '</tr>';
}

function autoReferenceId(rowid) {
    var $container = $('#action-tracker-table').find('.row, .content:first');
    var $ref_code_row = $container.find('.form-group:last');
    var ref_code = $ref_code_row.find('input').val();

    $('#action-tracker-table').find('.row, .content').each(function(e) {
        var $ref = $(this).find('.form-group:first');
        if ($ref.find('input').val() == '') {
            $ref.find('input').val(ref_code + '-' + (rowid));
        }
    });
}

function getDataTable(table_id, controller, table_document_code) {

    var token = $('input[name=9s8fjshd324hd98s]').val();
    var user_id = $('input[name=form_id]').val();
    var to_json = true;
    var table_document_code = table_document_code || '';
    //console.log(user_id);


    var function_url = controller + '/get-user-form';

    var ajax_url = base_url + function_url;

    var dataString = {

        "user_id": user_id,
        "to_json": to_json,
        "9s8fjshd324hd98s": token,
        "table_document_code": table_document_code,

    };

    $.ajax({
        type: 'post',
        url: ajax_url,
        data: dataString,
        dataType: 'json',
        success: function(data) {
            //var item = JSON.parse(data);
            //console.log(data);
            //fn(data);
            $('#' + table_id).dynatable({
                dataset: {
                    records: data,
                    perPageDefault: 5,
                    perPageOptions: [5, 10, 20, 30]
                },
                inputs: {
                    paginationClass: 'pagination pagination-sm pull-right',
                    paginationLinkClass: 'dynatable-page-link',
                    paginationPrevClass: 'dynatable-page-prev',
                    paginationNextClass: 'dynatable-page-next',
                    paginationActiveClass: 'dynatable-active-page',
                    paginationDisabledClass: 'dynatable-disabled-page',
                    paginationPrev: 'Previous',
                    paginationNext: 'Next',
                    recordCountTemplate: '<div id="dynatable-record-count-{elementId}" class="dynatable-record-count">{textTemplate}</div>'
                },
                writers: {
                    _rowWriter: defaultRowWriter
                }
            });
        }
    });
}



function upload_file(){

    $(document).on('click', '.btn-upload-file', function(e){

        e.preventDefault();

        var file_row_class = '.file-row';
        var token = $("input[name=9s8fjshd324hd98s]").val();

        var controller = 'document';
        var method = 'unlink-file';
        var table = 'file';

        $upload_button = $(this);
        $file_row = $(this).closest(file_row_class);

        var form_id = $upload_button.closest('form').attr('id');
            
        var options = { 

            beforeSend: function() 
            {
                $('#upload-message').text('test');
                /*$("#progress").show();
                //clear everything
                $("#bar").width('0%');
                $("#message").html("");
                $("#percent").html("0%");*/
            },
            uploadProgress: function(event, position, total, percentComplete) 
            {
                /*$("#bar").width(percentComplete+'%');
                $("#percent").html(percentComplete+'%');*/
            },
            success: function() 
            {
                /*$("#bar").width('100%');
                $("#percent").html('100%');*/
                $("#upload-message").text('upload successful');
                alert('test');
            },
            complete: function(response) 
            {
                $("#upload-message").text("<font color='green'>"+response.responseText+"</font>");
            },
            error: function()
            {
                $("#upload-message").text("<font color='red'> ERROR: unable to upload files</font>");

            }
         
        }; 

        console.log(options);

        /*$('#'+form_id)[0].ajaxForm(options);

        //$('#'+form_id)[0].ajaxForm(function() { 
        //        alert("Thank you for your comment!"); 
        //    }); */
        

    });

}




function delete_file_row() {

    $(document).on('click', '.btn-delete-file', function(e) {

        var file_row_class = '.file-row';
        var token = $("input[name=9s8fjshd324hd98s]").val();

        var controller = 'document';
        var method = 'unlink-file';
        var table = 'file';

        $delete_button = $(this);
        $file_row = $(this).closest(file_row_class);

        if ($(file_row_class).length > 1) {
            $file_row.remove();

            file_name = $file_row.find('.fileinput-filename').text();
            file_container_id = $file_row.attr('id');
            file_id = file_container_id.split('-').pop();
            //alert('test');




            var function_url = controller + '/' + method;

            var dataString = {
                "9s8fjshd324hd98s": token,
                'id': file_id,
                'table': table,
                'file_name': file_name
            };


            var ajax_url = base_url + function_url;


            $.ajax({
                type: "POST",
                url: ajax_url,
                data: dataString,
                dataType: "html",
                success: function(data) {
                    //alert(data);
                }
            });
        }





    });
}

function show_on_select(class_onchange, class_change) {

    $(document).on('change', class_onchange, function() {
        var result = $(this).find('option').length;
        //console.log(result);
        if (result > 1) {

            $(class_change).slideDown();
        }
    });
}

function hidden_on_select(class_index, class_hidden) {

    var result = $(class_index).find('option:selected').val();
    //console.log(result);

    if (result == '') {
        $(class_hidden).hide();
    } else {
        $(class_hidden).show();
    }
}

function collapse_equipment_profile() {
    //initialize class, description, and code as hidden.
    hidden_on_select(".equipment-category", ".equipment-class");
    hidden_on_select(".equipment-class", ".equipment-description");
    hidden_on_select(".equipment-description", ".equipment-code");
    hidden_on_select(".system", ".system_subcategory");
    /*
    show_on_select(".equipment-category", ".equipment-class");
    show_on_select(".equipment-class", ".equipment-description");
    show_on_select(".equipment-description", ".equipment-code");
    show_on_select(".system", ".system_subcategory");*/
}

function select_with_search() {

    $('.select2-dropdown').select2();
}

function my_action_tracker() {

    $(document).on('change', '#document-id-ref', function() {
        $document_id_ref = $(this);
        $ref_id = $('input[name=ref_id_code]');

        selected_document_code = $document_id_ref.find('option:selected').text().split(':')[0];
        selected_document_id = selected_document_code.split('-').pop();

        selected_document_code_raw = selected_document_code.split('-' + selected_document_id)[0];

        $ref_id.val(selected_document_code_raw);
    });
}

function editActionTrackerModal() {


    var $edit_action = $('a.edit-action');
    var $down_edit_modal = $('#action-tracker');


    $(document).on('click', 'a.edit-action', function(e) {

        var $edit_button = $(this);
        var $row_data = $(this).closest('.data-row');
        var $edit_action_tracker_form = $('#edit-action-tracker-form');

        e.preventDefault();
        $down_edit_modal.modal();
        var datePicker = $('body').find('.datepicker');
        $(datePicker).css('z-index', '10000');

        var action_tracker_id = $row_data.find('.action-tracker-id').text();
        var ref_id = $row_data.find('.ref-id').text();
        var action_step = $row_data.find('.action-process').text();
        var status = $row_data.find('.status').text();
        var status_id = $row_data.find('.status-id').text();
        var owner = $row_data.find('.owner').text();
        var due_date = $row_data.find('.due-date').text();
        var comment = $row_data.find('.comment').text();

        var $form_action_tracker_id = $edit_action_tracker_form.find('input[name=action_tracker_id]');
        var $form_ref_id = $edit_action_tracker_form.find('.reference');
        var $form_action_step = $edit_action_tracker_form.find('.action-process');
        var $form_status = $edit_action_tracker_form.find('.action-tracker-status');
        var $form_owner = $edit_action_tracker_form.find('.owner');
        var $form_due_date = $edit_action_tracker_form.find('.due-date');
        var $form_comments = $edit_action_tracker_form.find('.comments');


        $form_action_tracker_id.val(action_tracker_id);

        $form_ref_id.val(ref_id);
        $form_action_step.val(action_step);
        $form_due_date.val(due_date);
        $form_comments.val(comment);

        $form_owner.select2('val', owner);

        $form_status.val(status_id);
        $form_status.addClass(status);



    });
}

function editWeeklyPlanModal() {


    var $edit_action = $('a.edit-weekly-plan');
    var $down_edit_modal = $('#edit-weekly-plan');


    $(document).on('click', 'a.edit-weekly-plan', function(e) {

        var $edit_button = $(this);
        var $row_data = $(this).closest('.data-row');
        var $edit_form = $('#edit-weekly-plan-form');

        e.preventDefault();
        $down_edit_modal.modal();
        var datePicker = $('body').find('.datepicker');
        $(datePicker).css('z-index', '10000');

        var weekly_plan_id = $row_data.find('.weekly-plan-id').text();
        var work_order = $row_data.find('.work-order').text();
        var job_description = $row_data.find('.job-description').text();
        var specialist_requirement = $row_data.find('.specialist-requirement-id').text();
        var date = $row_data.find('.date').text();
        var comments = $row_data.find('.comments').text();
        var status = $row_data.find('.status-id').text();

        var $weekly_plan_id = $edit_form.find('input[name=weekly_plan_id]');
        var $work_order = $edit_form.find('input[name=work_order]');
        var $job_description = $edit_form.find('input[name=job_description]');
        var $specialist_requirement = $edit_form.find('select[name=specialist_requirement]');
        var $date = $edit_form.find('input[name=date]');
        var $comments = $edit_form.find('input[name=comments]');
        var $status = $edit_form.find('select[name=status]');

        $weekly_plan_id.val(weekly_plan_id);

        $work_order.val(work_order);
        $job_description.val(job_description);
        $specialist_requirement.val(specialist_requirement);
        $date.val(date);
        $comments.val(comments);
        $status.val(status);



    });
}

function createActionTrackerModal() {
    var $create_action = $('a.create-action');
    var $down_create_modal = $('#create-action-tracker');

    $(document).on('click', 'a.create-action', function(e) {

        //console.log('test');
        $down_create_modal.modal();
        var datePicker = $('body').find('.datepicker');
        $(datePicker).css('z-index', '10000');

        /*$down_create_modal.submit(function(e){
            if($down_create_modal.find('select[name=document_id]').val() == ''){
                return false;
            }
        });
*/

    });
}

function editEquipmentRegisterModal() {


    var $edit_action = $('a.edit-equipment-register');
    var $down_edit_modal = $('#hired-equipment-register');


    $(document).on('click', 'a.edit-equipment-register', function(e) {

        var $edit_button = $(this);
        var $row_data = $(this).closest('.data-row');
        var $edit_equipment_register_form = $('#edit-equipment-register-form');

        e.preventDefault();
        $down_edit_modal.modal();
        var datePicker = $('body').find('.datepicker');
        $(datePicker).css('z-index', '10000');

        var equipment_register_id = $row_data.find('.equipment-register-id').text();
        var on_hire = $row_data.find('.on-hire').text();
        var po_number = $row_data.find('.po-number').text();
        var equipment = $row_data.find('.equipment-register').text();
        var duration = $row_data.find('.duration').text();
        var status = $row_data.find('.status').text();
        var status_id = $row_data.find('.status-id').text();
        var owner = $row_data.find('.owner').text();
        var due_date = $row_data.find('.due-date').text();
        var cost = $row_data.find('.cost').text();
        var quantity = $row_data.find('.quantity').text();
        var total = $row_data.find('.total').text();
        var duration = $row_data.find('.duration').text();
        var owner = $row_data.find('.owner').text();


        var $form_equipment_register_id = $edit_equipment_register_form.find('input[name=hired_equipment_register_id]');
        var $form_on_hire = $edit_equipment_register_form.find('.on-hire');
        var $form_po_number = $edit_equipment_register_form.find('.po-number');
        var $form_equipment = $edit_equipment_register_form.find('.equipment');
        var $form_cost = $edit_equipment_register_form.find('.cost');
        var $form_quantity = $edit_equipment_register_form.find('.quantity');
        var $form_total = $edit_equipment_register_form.find('.total');
        var $form_status = $edit_equipment_register_form.find('.er-status');
        var $form_due_date = $edit_equipment_register_form.find('.due-date');
        var $form_duration = $edit_equipment_register_form.find('.duration');
        var $form_owner = $edit_equipment_register_form.find('.owner');



        $form_equipment_register_id.val(equipment_register_id);

        $form_on_hire.val(on_hire);
        $form_po_number.val(po_number);
        $form_equipment.val(equipment);
        $form_duration.val(duration);
        $form_due_date.val(due_date);
        $form_cost.val(cost);
        $form_quantity.val(quantity);
        $form_total.val(total);

        $form_owner.select2('val', owner);

        $form_status.val(status_id);
        $form_status.addClass(status);



    });
}


function createEquipmentRegisterModal() {
    var $create_equipment_register = $('a.create-equipment-register');
    var $down_create_modal = $('#create-equipment-register');

    $(document).on('click', 'a.create-equipment-register', function(e) {

        //console.log('test');
        $down_create_modal.modal();
        var datePicker = $('body').find('.datepicker');
        $(datePicker).css('z-index', '10000');

    });
}

function createWeeklyPlanModal() {

    var $create_weekly_plan = $('a.create-weekly-plan');
    var $down_create_weekly = $('#create-weekly-plan');

    $(document).on('click', 'a.create-weekly-plan', function(e) {

        //console.log('test');
        ///$down_create_weekly.modal();
        //var datePicker = $('body').find('.datepicker');
        //$(datePicker).css('z-index', '10000');

        var token = $('input[name=9s8fjshd324hd98s]').val();

        var function_url = 'weekly_plan/create_empty';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "data_post": true
        };


        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: "html",
            success: function(data){
                user_weekly_plan();
            }
        });

    });
}

function createCriticalityAnalysis() {

    var $create_criticality_analysis = $('a.create-criticality-analysis');
    var $down_criticality_analysis = $('#create-criticality-analysis');
    var $table_tbody = $('#my-criticality-analysis tbody');

    $(document).on('click', 'a.create-criticality-analysis', function(e) {

        //console.log('test');
        $down_criticality_analysis.modal();
        var datePicker = $('body').find('.datepicker');
        $(datePicker).css('z-index', '10000');

    });


    $(document).on('submit', '#create-criticality-analysis-form', function(e) {

        e.preventDefault();
        $down_criticality_analysis.modal('hide');

        var $form = $(this);
        var post_data = $form.serializeArray();



        var function_url = 'criticality-analysis/create';
        var ajax_url = base_url + function_url;

        $table_tbody.html('');


        $.ajax({
            type: 'post',
            url: ajax_url,
            data: post_data,
            success: function(data) {
                user_criticality_analysis();
                user_single_index();
            }
        });

    });
}

function edit_criticality_analysis() {

    var $table_tbody = $('#my-criticality-analysis tbody');
    var $edit_action = $('a.edit-criticality-analysis');
    var $down_edit_modal = $('#edit-criticality-analysis');


    $(document).on('click', 'a.edit-criticality-analysis', function(e) {

        $table_tbody.html('');

        var $edit_button = $(this);
        var $row_data = $(this).closest('.data-row');
        //var $edit_form = $('#edit-criticality-analysis-form');

        e.preventDefault();
        //$down_edit_modal.modal();
        //var datePicker = $('body').find('.datepicker');
        //$(datePicker).css('z-index', '10000');

        var criticality_analysis_id = $row_data.find('.criticality-analysis-id').text();
        var asset = $row_data.find('.asset-id').text();
        var tag_number = $row_data.find('.tag-number').text();
        var description = $row_data.find('.description').text();
        var redundancy = $row_data.find('select[name=redundancy]').val();
        var safety = $row_data.find('select[name=safety]').val();
        var environment = $row_data.find('select[name=environment]').val();
        var operation = $row_data.find('select[name=operation]').val();
        var reinstatement = $row_data.find('select[name=reinstatement]').val();
        var pce_value = $row_data.find('select[name=pce]').val();
        var sce_value = $row_data.find('select[name=sce]').val();
        var ece_value = $row_data.find('select[name=ece]').val();
        var sis_value = $row_data.find('select[name=sis]').val();
        var cas = $row_data.find('.cas-id').text();

        token = $('input[name=9s8fjshd324hd98s]').val();

        var function_url = 'criticality-analysis/update';
        var ajax_url = base_url + function_url;
        var dataString = {
            "criticality_analysis_id": criticality_analysis_id,
            "asset": asset,
            "tag_number": tag_number,
            "description": description,
            "reliability_redundancy": redundancy,
            "safety_health_criticality": safety,
            "environmental_criticality": environment,
            "operational_criticality": operation,
            "reinstatement": reinstatement,
            "status": "",
            "cas": cas,
            "frequency": "",
            "pce": pce_value,
            "sce": sce_value,
            "ece": ece_value,
            "sis": sis_value,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            //dataType: 'html',
            success: function(data) {

                user_criticality_analysis();
                user_single_index();
            }
        });


    });
}

function edit_failure_rate() {

    var $table_tbody = $('#failure-rate tbody');
    var $edit_action = $('a.edit-failure-rate');
    var $down_edit_modal = $('#edit-failure-rate');


    $(document).on('click', 'a.edit-failure-rate', function(e) {

        $table_tbody.html('');

        var $edit_button = $(this);
        var $row_data = $(this).closest('.data-row');
        //var $edit_form = $('#edit-criticality-analysis-form');

        e.preventDefault();
        //$down_edit_modal.modal();
        //var datePicker = $('body').find('.datepicker');
        //$(datePicker).css('z-index', '10000');

        var criticality_analysis_id = $row_data.find('.criticality-analysis-id').text();
        var asset = $row_data.find('.asset-id').text();
        var tag_number = $row_data.find('.tag-number').text();
        var description = $row_data.find('.description').text();
        
        var start_date = $row_data.find('input[name=start_date]').val();

        var failure_rate = $row_data.find('input[name=failure_rate]').val();
        var mtbf = $row_data.find('input[name=mtbf]').val();
        var mttr = $row_data.find('input[name=mttr]').val();
        var fail_date = $row_data.find('input[name=fail_date]').val();
        var repair_date = $row_data.find('input[name=repair_date]').val();
        var estimated_repair_time = $row_data.find('input[name=estimated_repair_time]').val();
        var actual_repair_time = $row_data.find('input[name=actual_repair_time]').val();



        var cas = $row_data.find('.cas-id').text();

        var token = $('input[name=9s8fjshd324hd98s]').val();

        var function_url = 'criticality-analysis/update_failure_rate';
        var ajax_url = base_url + function_url;
        var dataString = {
            "criticality_analysis_id": criticality_analysis_id,
            "asset": asset,
            "tag_number": tag_number,
            "description": description,

            "start_date": start_date,
            
            "failure_rate": failure_rate,
            "mtbf": mtbf,
            "mttr": mttr,
            "fail_date": fail_date,
            "repair_date": repair_date,
            "estimated_repair_time": estimated_repair_time,
            "actual_repair_time": actual_repair_time,

            "9s8fjshd324hd98s": token
        };

        //console.log(dataString);

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            //dataType: 'html',
            success: function(data) {
                console.log(data);
                user_failure_rate();
            }
        });


    });
}

function delete_criticality_analysis() {

    var $table_tbody = $('#my-criticality-analysis tbody');
    var $edit_action = $('a.delete-criticality-analysis');

    $(document).on('click', 'a.delete-criticality-analysis', function(e) {

        $table_tbody.html('');

        var $edit_button = $(this);
        var $row_data = $(this).closest('.data-row');
        //var $edit_form = $('#edit-criticality-analysis-form');

        e.preventDefault();
        //$down_edit_modal.modal();
        //var datePicker = $('body').find('.datepicker');
        //$(datePicker).css('z-index', '10000');

        var criticality_analysis_id = $row_data.find('.criticality-analysis-id').text();

        token = $('input[name=9s8fjshd324hd98s]').val();

        var function_url = 'criticality-analysis/delete';
        var ajax_url = base_url + function_url;
        var dataString = {
            "criticality_analysis_id": criticality_analysis_id,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            success: function(data) {

                user_criticality_analysis();
                user_single_index();
            }
        });


    });
}

function delete_failure_rate() {

    var $table_tbody = $('#failure-rate tbody');
    var $edit_action = $('a.delete-failure-rate');

    $(document).on('click', 'a.delete-failure-rate', function(e) {

        $table_tbody.html('');

        var $edit_button = $(this);
        var $row_data = $(this).closest('.data-row');

        e.preventDefault();

        var criticality_analysis_id = $row_data.find('.criticality-analysis-id').text();

        token = $('input[name=9s8fjshd324hd98s]').val();

        var function_url = 'criticality-analysis/delete';
        var ajax_url = base_url + function_url;
        var dataString = {
            "criticality_analysis_id": criticality_analysis_id,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            success: function(data) {

                user_failure_rate();
            }
        });


    });
}

function filterCriticalityAnalysis() {



    $(document).on('submit', '#filter-criticality-analysis-form', function(e) {

        var $filter_criticality_analysis = $(this);
        var $table_body;

        //initialize tables to be filtered
        var $criticality_analysis_table = $('#my-criticality-analysis');
        var $single_index_table = $('#single-index-of-failing-equipment');
        var $user_compliance_dashboard = $('#compliance-dashboard');
        var category = null;



        var filter_asset = $filter_criticality_analysis.find('select[name=filter_asset]').val();
        //var filter_category = $filter_criticality_analysis.find('select[name=filter_category]').val();
        var filter_code = $filter_criticality_analysis.find('input[name=filter_code]').val();
        var filter_last_review_date = $filter_criticality_analysis.find('select[name=filter_last_review_date]').val();
        var filter_owner = $filter_criticality_analysis.find('select[name=filter_owner]').val();
        var status_checked = $filter_criticality_analysis.find("input:checked[name='filter_status[]']");
        var category_checked = $filter_criticality_analysis.find("input:checked[name='filter_category[]']");

        var filter_status = [];
        status_checked.each(function(index) {
            filter_status.push($(this).val());
        });

        if(category_checked.length > 0){
        var filter_category = [];
        category_checked.each(function(index) {
            filter_category.push($(this).val());
        });
        }
        else{
            filter_category = null;
        }

        e.preventDefault();

        if ($criticality_analysis_table.length > 0) {
            $table_body = $criticality_analysis_table.find('tbody');
            $table_body.html('');
            user_criticality_analysis(filter_asset, category, filter_code, filter_last_review_date, filter_category, filter_owner);
        } else if ($single_index_table.length > 0) {
            $table_body = $single_index_table.find('tbody');
            $table_body.html('');
            user_single_index(filter_asset, category, filter_code, filter_last_review_date, filter_status, filter_category, filter_owner);
        } else if ($user_compliance_dashboard.length > 0) {
            $table_body = $user_compliance_dashboard.find('tbody');
            $table_body.html('');
            user_compliance_dashboard(filter_asset, category, filter_code, filter_last_review_date, filter_category, filter_owner);
        }

    });
}

function createUserAdmin() {

    var $create_user_admin = $('a.create-user-admin');
    var $down_user_admin = $('#create-user-admin');

    $(document).on('click', 'a.create-user-admin', function(e) {

        //console.log('test');
        $down_user_admin.modal();

    });

    $(document).on('submit', '#create-user-admin form', function(e) {
        var $form = $(this);

        var post_data = $form.serializeArray();
        var $password = $form.find('input[name=password]');
        var $confirm_password = $form.find('input[name=confirm_password]');

        var password_value = $password.val();
        var confirm_password_value = $confirm_password.val();

        if (password_value == '' || confirm_password_value == '') {
            e.preventDefault();
            $password.focus().closest('div').addClass('has-error').append('<p class="text-danger">please input password.</p>');
            $confirm_password.closest('div').addClass('has-error');

            return false;
        }

        if (password_value != confirm_password_value) {
            e.preventDefault();
            $password.next('.text-danger').remove();
            $password.focus().closest('div').addClass('has-error').append('<p class="text-danger">password does not match.</p>');
            $confirm_password.closest('div').addClass('has-error');

            return false;

        } else {
            $form.submit();
        }
    });
}

function validateOldPassword($old_password) {
    //var $old_password = $(this);
    var $current_user_id = $old_password.closest('form').find('input[name=user_id]');

    var old_password = $old_password.val();
    var current_user_id = $current_user_id.val();

    var token = $("input[name=9s8fjshd324hd98s]").val();
    var url = base_url + 'user/check_user_password';

    var dataString = {
        "current_user_id": current_user_id,
        "old_password": old_password,
        "9s8fjshd324hd98s": token
    };

    $.ajax({
        type: 'post',
        url: url,
        data: dataString,
        dataType: 'json',
        success: function(data) {
            var verified_password = data.verified_password;
            if (verified_password) {
                $old_password.next('.text-danger').remove();
                $old_password.closest('div').removeClass('has-error').addClass('has-success');
            } else {
                $old_password.next('.text-danger').remove();
                $old_password.focus().closest('div').addClass('has-error').append('<p class="text-danger">old password does not match.</p>');
                $old_password.closest('div').addClass('has-error');
            }
        }
    });
}

function editUserAdminModal() {

    var $edit_user_form = $('#edit-user-admin-form');
    var $edit_user = $('a.edit-user-admin');
    var $down_edit_modal = $('#edit-user-admin');


    $(document).on('submit', '#edit-user-admin form', function(e) {

        var $form = $(this);

        var post_data = $form.serializeArray();
        var $old_password = $form.find('input[name=old_password]');
        var $password = $form.find('input[name=new_password]');
        var $confirm_password = $form.find('input[name=confirm_password]');

        var old_password_value = $old_password.val();
        var password_value = $password.val();
        var confirm_password_value = $confirm_password.val();

        /*if(password_value == '' || confirm_password_value == ''){
            e.preventDefault();
            $password.focus().closest('div').addClass('has-error').append('<p class="text-danger">please input password.</p>');
            $confirm_password.closest('div').addClass('has-error');

            return false;
        }*/
        /*if(password_value != '' || confirm_password_value != '' || old_password_value != ''){
            

            return false;
        }
*/
        if (password_value != confirm_password_value) {
            e.preventDefault();
            $password.next('.text-danger').remove();
            $password.focus().closest('div').addClass('has-error').append('<p class="text-danger">password does not match.</p>');
            $confirm_password.closest('div').addClass('has-error');

            return false;
        } else {

            $form.submit();

        }

    });


    $(document).on('keyup', 'input[name=old_password]', function() {
        validateOldPassword($(this));
    });

    var $old_password_field = $edit_user_form.find('input[name=old_password]');

    $(document).on('keyup', 'input[name=new_password],input[confirm_password]', function() {
        validateOldPassword($old_password_field);
    });


    $(document).on('click', 'a.edit-user-admin', function(e) {

        var $edit_button = $(this);
        var $row_data = $(this).closest('.data-row');
        var $edit_form = $('#edit-user-admin');

        e.preventDefault();
        $down_edit_modal.modal();

        var user_id = $row_data.find('.user-admin-id').text();
        var first_name = $row_data.find('.first-name').text();
        var last_name = $row_data.find('.last-name').text();
        var user_name = $row_data.find('.user-name').text();

        //var password = $row_data.find('.password').text();
        var role = $row_data.find('.role').text();
        var database = $row_data.find('.database').text();
        var email_address = $row_data.find('.email-address').text();
        var asset = $row_data.find('.asset-id').text();
        var asset_role = $row_data.find('.asset-role').text();

        var $user_id = $edit_form.find('input[name=user_id]');

        var $first_name = $edit_form.find('input[name=first_name]');
        var $last_name = $edit_form.find('input[name=last_name]');
        var $user_name = $edit_form.find('input[name=user_name]');

        var $password = $edit_form.find('input[name=password]');
        var $role = $edit_form.find('select[name=role]');
        var $database = $edit_form.find('select[name=database_name]');
        var $email_address = $edit_form.find('input[name=email_address]');
        var $asset = $edit_form.find('select[name=asset]');
        var $asset_role = $edit_form.find('select[name=asset_role]');

        $user_id.val(user_id);

        $first_name.val(first_name);
        $last_name.val(last_name);
        $user_name.val(user_name);

        //$password.val(password);

        $email_address.val(email_address);

        $asset_role.val(asset_role);

        if (role == 'null') {
            $role.val('');
        } else {
            $role.val(role);
        }

        if (database == 'null' || database == 'default' || database == null) {
            $database.val('');
        } else {
            $database.val(database);
        }

        if (asset == 0) {
            $asset.val('');
        } else {
            $asset.val(asset);
        }


    });
}

function update_document_cost_breakdown() {

    if ($('#cost-breakdown-table').find('.estimated-subtotal')) {

        var model_id = $("input[name=model_id]").val();
        var token = $("input[name=9s8fjshd324hd98s]").val();
        var url = base_url + 'project-plan/update_costbreakdown_fields';

        var dataString = {
            "model_id": model_id,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: url,
            data: dataString,

            success: function(data) {
                var item = JSON.parse(data);

                var estimated_subtotal = 0;
                var actual_subtotal = 0;
                $('#cost-breakdown-table').find('.estimated-subtotal').each(function(e) {
                    var a = $(this).val();
                    estimated_subtotal += parseFloat(a);
                });

                $('#cost-breakdown-table').find('.subtotal').each(function(e) {
                    var a = $(this).val();
                    actual_subtotal += parseFloat(a);
                });

                var variation = Math.abs(actual_subtotal - estimated_subtotal);

                $('.cost-breakdown-table').find('#estimated_cost_breakdown_total').val((estimated_subtotal).toFixed(2));
                $('.cost-breakdown-table').find('#actual_cost_breakdown_total').val((actual_subtotal).toFixed(2));
                $('.cost-breakdown-table').find('#cost_breakdown_variation').val((variation).toFixed(2));


            }
        });
    }
}

function user_document_status() {

    var $document_status_history = $('#document-status-history').find('tbody');

    var token = $('input[name=9s8fjshd324hd98s]').val();
    var document_id = $('input[name=model_id]').val();

    var function_url = 'document/get_user_document_status';

    var ajax_url = base_url + function_url;

    var dataString = {

        "9s8fjshd324hd98s": token,
        "document_id": document_id

    };

    $.ajax({
        type: 'post',
        url: ajax_url,
        data: dataString,
        dataType: 'json',
        success: function(data) {
            var tables = '';

            if (data.length < 1) {
                $('#document-status-history').parents('#document-status-container').hide();
            } else {
                $('#document-status-history').parents('#document-status-container').show();
                $.each(data, function(index, status_item) {
                    tables += '<tr>';
                    tables += '<td>';
                    tables += status_item.fullname;
                    tables += '</td>';
                    tables += '<td>';
                    tables += status_item.status;
                    tables += '</td>';
                    tables += '<td>';
                    tables += status_item.date;
                    tables += '</td>';
                    tables += '</tr>';
                });

                $document_status_history.html(tables);
            }
        }
    });
}

function filter_action_tracker() {

    var $filter_action_tracker_form = $('#filter-action-tracker-form');

    $filter_action_tracker_form.submit(function(e) {

        e.preventDefault();

        var document_id = $filter_action_tracker_form.find('select[name=document_id]').val();
        var status = $filter_action_tracker_form.find('select[name=status]').val();
        var reference = $filter_action_tracker_form.find('input[name=reference]').val();

        user_action_tracker(document_id, status, reference);

    });
}

function user_action_tracker(document_id, status, reference) {

    var $action_tracker = $('#my-action-tracker');
    if ($action_tracker.length > 0) {
        var $action_tracker_body = $action_tracker.find('tbody');
        var $action_tracker_loading = $('#loading-action-tracker');

        var $no_action_tracker = $('#no-action-tracker');
        var $no_search_found = $('#no-search-found');

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();
        var document_id = document_id || null;
        var status = status || null;
        var reference = reference || null;

        var function_url = 'document/get_action_tracker';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "document_id": document_id,
            "status": status,
            "reference": reference


        };

        $action_tracker_loading.removeClass('hidden');
        $action_tracker.hide();

        $no_search_found.addClass('hidden');
        $no_action_tracker.addClass('hidden');

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {
                var tables = '';

                if (data.length < 1) {

                    $action_tracker_loading.addClass('hidden');
                    $action_tracker.hide();

                    if (document_id != null || status != null || reference != null) {
                        $no_search_found.removeClass('hidden');
                    } else {
                        $no_action_tracker.removeClass('hidden');
                    }


                } else {

                    $action_tracker_loading.addClass('hidden');
                    $action_tracker.show();

                    $.each(data, function(index, item) {

                        if (item.action_process == null) {
                            return true;
                        }
                        tables += '<tr id="data-row-' + item.action_tracker_id + '" class="data-row">';
                        tables += '<td class="ref-id">';
                        tables += item.ref_id;
                        tables += '</td>';
                        tables += '<td class="document-id">';
                        tables += item.document_code;
                        tables += '</td>';
                        tables += '<td class="document-name">';
                        if (item.document_name != null) {
                            tables += item.document_name;
                        } else {
                            tables += "";
                        }
                        tables += '</td>';
                        tables += '<td class="action-process">';
                        tables += item.action_process;
                        tables += '</td>';
                        tables += '<td class="' + item.status_color + '">';
                        tables += '<p class="action-tracker-id hidden">' + item.action_tracker_id + '</p>';
                        tables += '<p class="status hidden">' + item.status_color + '</p>';
                        tables += '<p class="status-id hidden">' + item.status_id + '</p>';
                        tables += '<p class="owner hidden">' + item.owner + '</p>';
                        tables += '<p class="due-date hidden">' + item.due_date + '</p>';
                        tables += '<p class="comment hidden">' + item.comment + '</p>';
                        tables += '</td>';
                        tables += '<td class="text-center">';
                        tables += '<a href="#" class="btn btn-primary edit-action"><span class="glyphicon glyphicon-pencil"></span></a>';
                        tables += '</td>';
                        tables += '</tr>';
                    });

                    $action_tracker_body.html(tables);
                }
            }
        });
    }
}

//equipment register
function user_equipment_register(status) {

    var $equipment_register = $('#my-equipment-register');

    if ($equipment_register.length > 0) {
        var $equipment_register_body = $equipment_register.find('tbody');
        var $equipment_register_loading = $('#loading-equipment-register');

        var $no_equipment_register = $('#no-equipment-register');
        var $no_search_found = $('#no-search-found');

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();
        var status = status || null;

        var function_url = 'document/get_hired_equipment_register';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "status": status


        };

        $equipment_register_loading.removeClass('hidden');
        $equipment_register.hide();

        $no_search_found.addClass('hidden');
        $no_equipment_register.addClass('hidden');

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {
                var tables = '';

                if (data.length < 1) {

                    $equipment_register_loading.addClass('hidden');
                    $equipment_register.hide();

                    if (status != null) {
                        $no_search_found.removeClass('hidden');
                    } else {
                        $no_equipment_register.removeClass('hidden');
                    }


                } else {

                    $equipment_register_loading.addClass('hidden');
                    $equipment_register.show();

                    $.each(data, function(index, item) {

                        if (item.equipment == null) {
                            return true;
                        }
                        tables += '<tr id="data-row-' + item.hired_equipment_register_id + '" class="data-row">';
                        tables += '<td class="po-number">';
                        tables += item.po_number;
                        tables += '</td>';
                        tables += '<td class="equipment-register">';
                        tables += item.equipment;
                        tables += '</td>';
                        tables += '<td class="on-hire">';
                        tables += item.on_hire_to;
                        tables += '</td>';
                        tables += '<td class="due-date">';
                        tables += item.off_hire_due_date;
                        tables += '</td>';
                        tables += '<td class="">';
                        tables += item.status_value;
                        tables += '<p class="equipment-register-id hidden">' + item.hired_equipment_register_id + '</p>';
                        //tables += '<p class="status hidden">'+item.status_value+'</p>';
                        tables += '<p class="status-id hidden">' + item.status_id + '</p>';
                        tables += '<p class="owner hidden">' + item.owner + '</p>';
                        tables += '<p class="cost hidden">' + item.cost + '</p>';
                        tables += '<p class="quantity hidden">' + item.quantity + '</p>';
                        tables += '<p class="total hidden">' + item.total + '</p>';
                        tables += '<p class="duration hidden">' + item.duration + '</p>';
                        tables += '</td>';
                        tables += '<td class="text-center">';
                        tables += '<a href="#" class="btn btn-primary edit-equipment-register"><span class="glyphicon glyphicon-pencil"></span></a>';
                        tables += '</td>';
                        tables += '</tr>';
                    });

                    $equipment_register_body.html(tables);
                }
            }
        });

    }
}



function equipment_history_category_option(){

    var $option = $('select[name="equipment_history_category_answer[]"]');

    $option.change(function(){
        var $selected_option = $(this);
        var selected_option_value = $selected_option.find('option:selected').text().toLowerCase();
        var $next_answer_container = $selected_option.closest('.category-body').find('.category-answer');

        if(selected_option_value == 'yes'){
            $next_answer_container.removeClass('hidden');
        }else{
            $next_answer_container.addClass('hidden');
        }
    });

}



function equipment_answer_clone(){

    var main_container = '.category-answer';
    var loading_str = '#loading-weekly-plan';
    var no_search_str = '#no-search-found';

    var options_container = '.row-options-container';
    var remove_row_str = '.remove-row';
    var add_row_str = '.add-row';

    var $table_container = $(main_container);
    
    var $loading = $(loading_str);
    var $no_search_found = $(no_search_str);

    var $row_options_container = $table_container.find(options_container);

    $(document).on('click', main_container+' '+options_container+' '+add_row_str, function(e) {

        e.preventDefault();

        var $add_row = $(this);
        var $remove_row = $(this).closest('.button-container').find('.remove-row');

        var $table_body = $add_row.closest('.category-answer').find('.answer-container');

        $rows = $table_body.find('.answer-row');
        $last_child = $rows.last();

        if($rows.length < 1){
            $remove_row.attr('disabled','disabled');
        }else{
            $remove_row.removeAttr('disabled');
        }

        var $clone_row = $table_body.find('.answer-row:last-child').clone();

        //console.log($clone_row);

        $clone_row.find('input').val('');
        $clone_row.find('select').val('');
        $clone_row.find('textarea').text('');

        

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var category_id = $add_row.closest('.category-answer').find('input[name="category_id[]"]').val();
        var document_id = $('input[name=model_id]').val();

        var function_url = 'document/add_equipment_history_answer';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "data_post": true,
            "category_id": category_id,
            "document_id": document_id
        };

        //console.log(dataString);


        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: "html",
            success: function(data){
                $clone_row.find('input[name="answer_id[]"]').val(data);
                $table_body.append($clone_row);
            }
        });


    });


    $(document).on('click', main_container+' '+options_container+' '+remove_row_str, function(e) {

        var remove_flag = false;
        var refresh_flag = false;

        e.preventDefault();

        var $remove_row = $(this);

        var $table_body = $remove_row.closest('.category-answer').find('.answer-container');

        $rows = $table_body.find('.answer-row');
        $last_child = $rows.last();

        if($rows.length <= 1){
            //$last_child.remove();
            remove_flag = false;
            refresh_flag = false;
            $remove_row.attr('disabled','disabled');
        }else{
            $last_child.remove();
            remove_flag = true;
            $remove_row.removeAttr('disabled');
            
        }

        if(remove_flag){

            var token = $('input[name=9s8fjshd324hd98s]').val();
            var $row_id = $last_child.find('input[name="answer_id[]"]');

            var row_id_value = $row_id.val();

            var function_url = 'document/remove_equipment_history_answer';

            var ajax_url = base_url + function_url;

            var dataString = {

                "9s8fjshd324hd98s": token,
                "answer_id": row_id_value
            };


            $.ajax({
                type: 'post',
                url: ajax_url,
                data: dataString,
                dataType: "html",
                success: function(data){
                    console.log(data);
                }
            });

        }


        if(refresh_flag){
            //user_weekly_plan();
        }

        


    });

}




function user_weekly_plan() {

    var $weekly_plan = $('#my-weekly-plan');
    var $weekly_plan_body = $weekly_plan.find('tbody');
    var $weekly_plan_loading = $('#loading-weekly-plan');

    if($weekly_plan.length > 0){

        var $no_weekly_plan = $('#no-weekly-plan');
        var $no_search_found = $('#no-search-found');

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var user_id = $('input[name=current_user_id]').val();

        var function_url = 'document/get_weekly_plan';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "user_id": user_id,

        };

        $weekly_plan_loading.removeClass('hidden');
        $weekly_plan.hide();

        $no_search_found.addClass('hidden');
        $no_weekly_plan.addClass('hidden');



        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                //console.log(data);

                var table_data = data.table_data;
                var table_info = data.table_info;
                var user_info = data.user_info;

                var session_user_id = user_info.user_id;

                if (table_data.length < 1) {

                    $weekly_plan_loading.addClass('hidden');
                    $weekly_plan.hide();

                    $no_weekly_plan.removeClass('hidden');

                } else {

                    

                    $weekly_plan_loading.addClass('hidden');
                    $weekly_plan.show();

                    $.each(table_data, function(index, item) {

                        var row_html = '';

                        row_html += '<tr id="data-row-' + item.weekly_plan_id + '" class="data-row">';
                        row_html += '<td class="work-order">';
                            row_html += '<input class="form-control" type="text" name="work_order" value="'+item.work_order+'"';
                        row_html += '</td>';
                        row_html += '<td class="job-description">';
                            row_html += '<input class="form-control" type="text" name="job_description" value="'+item.job_description+'"';
                        row_html += '</td>';
                        row_html += '<td class="specialist-requirement">';
                            row_html += '<select name="specialist_requirement" class="form-control">';
                            row_html += table_info.specialist_requirement_dropdown;
                            row_html += '</select>';
                        row_html += '</td>';
                        row_html += '<td class="category">';
                            row_html += '<select name="category" class="form-control">';
                            row_html += table_info.category_dropdown;
                            row_html += '</select>';
                        row_html += '</td>';
                        row_html += '<td class="date">';
                            row_html += '<input class="form-control datepicker" type="text" name="weekly_plan_date" value="'+item.date+'"';
                        row_html += '</td>';
                        row_html += '<td class="comment">';
                            row_html += '<input class="form-control" type="text" name="comment" value="'+item.comments+'"';
                        row_html += '</td>';
                        row_html += '<td class="status">';
                            row_html += '<select name="status" class="form-control">';
                            row_html += table_info.status_dropdown;
                            row_html += '</select>';
                        row_html += '</td>';
                        row_html += '<td class="text-center">';
                        row_html += '<a href="#" class="btn btn-danger delete-weekly-plan"><span class="glyphicon glyphicon-minus"></span></a> ';
                        row_html += '<a href="#" class="btn btn-primary update-weekly-plan"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
                        row_html += '<p class="comments hidden">' + item.comments + '</p>';
                        row_html += '<p class="owner hidden">' + item.owner + '</p>';
                        row_html += '<p class="weekly-plan-id hidden">' + item.weekly_plan_id + '</p>';
                        row_html += '<p class="status-id hidden">' + item.status_id + '</p>';
                        row_html += '<p class="owner-fullname hidden">' + item.owner_fullname + '</p>';
                        row_html += '<p class="specialist-requirement-id hidden">' + item.specialist_requirement_id + '</p>';
                        row_html += '<p class="category-id hidden">' + item.category_id + '</p>';
                        row_html += '</td>';
                        row_html += '</tr>';

                        $weekly_plan_body.append(row_html);

                        var $row_data = $(row_html);
                        var row_id = '#' + $row_data.attr('id') + ' ';

                        var $specialist_requirement_dropdown = $weekly_plan_body.find('select[name=specialist_requirement]');
                        var $category_dropdown = $weekly_plan_body.find('select[name=category]');
                        var $status_dropdown = $weekly_plan_body.find('select[name=status]');

                        $specialist_requirement_dropdown.val(item.specialist_requirement_id);
                        $category_dropdown.val(item.category_id);
                        $status_dropdown.val(item.status_id);
                    });


                    

                    dateEffects();
                }
            }
        });
    }

    
}

function update_weekly_plan(){

    var $table_container = $('#my-weekly-plan');
    var $table_body = $table_container.find('tbody');
    var $edit_button = $table_container.find('.update-weekly-plan');
    var $loading = $('#loading-weekly-plan');
    var $no_search_found = $('#no-search-found');

    $(document).on('click', '#my-weekly-plan .update-weekly-plan', function(e) {

        e.preventDefault();

        var $row = $(this).closest('.data-row');

        var $work_order = $row.find('input[name=work_order]');
        var $job_description = $row.find('input[name=job_description]');
        var $specialist_requirement = $row.find('select[name=specialist_requirement]');
        var $category = $row.find('select[name=category]');
        var $weekly_plan_date = $row.find('input[name=weekly_plan_date]');
        var $status = $row.find('select[name=status]');
        var $weekly_plan_id = $row.find('.weekly-plan-id');
        var $comment = $row.find('input[name=comment]');


        var work_order_value = $work_order.val();
        var job_description_value = $job_description.val();
        var specialist_requirement_value = $specialist_requirement.val();
        var category_value = $category.val();
        var weekly_plan_date_value = $weekly_plan_date.val();
        var status_value = $status.val();
        var weekly_plan_id_value = $weekly_plan_id.text();
        var comment_value = $comment.val();

        var token = $('input[name=9s8fjshd324hd98s]').val();

        var function_url = 'weekly_plan/update';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "weekly_plan_id": weekly_plan_id_value,
            "work_order": work_order_value,
            "job_description": job_description_value,
            "specialist_requirement": specialist_requirement_value,
            "category": category_value,
            "date": weekly_plan_date_value,
            "comment": comment_value,
            "status": status_value
        };

        //console.log(dataString);

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'html',
            success: function(data) {
                console.log(dataString);
                console.log(data);
                /*console.log(dataString);
                console.log(data);*/
                /*$table_body.html('');
                user_single_index();*/
            }
        });


    });
}

function remove_weekly_plan(){

    var $table_container = $('#my-weekly-plan');
    var $table_body = $table_container.find('tbody');
    var $edit_button = $table_container.find('.delete-weekly-plan');
    var $loading = $('#loading-weekly-plan');
    var $no_search_found = $('#no-search-found');

    $(document).on('click', '#my-weekly-plan .delete-weekly-plan', function(e) {

        e.preventDefault();

        var $row = $(this).closest('.data-row');

        $row.fadeOut('fast');

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var $weekly_plan_id = $row.find('.weekly-plan-id');

        var weekly_plan_id_value = $weekly_plan_id.text();

        var function_url = 'weekly_plan/remove';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "weekly_plan_id": weekly_plan_id_value
        };

        //console.log(dataString);

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'html',
            success: function(data) {
                console.log(dataString);
                console.log(data);
            },
            error: function(data){
                console.log(data.responseText);
            }
        });


    });
}



function weekly_plan_clone(){

    var main_container = '#my-weekly-plan';
    var loading_str = '#loading-weekly-plan';
    var no_search_str = '#no-search-found';

    var options_container = '.row-options-container';
    var remove_row_str = '.remove-row';
    var add_row_str = '.add-row';

    var $table_container = $(main_container);
    var $table_body = $table_container.find('tbody');
    var $edit_button = $table_container.find('.delete-weekly-plan');
    var $loading = $(loading_str);
    var $no_search_found = $(no_search_str);

    var $row_options_container = $table_container.find(options_container);
    //var $remove_row = $row_options_container.find(remove_row_str);
    //var $add_row = $row_options_container.find(add_row_str);

    $(document).on('click', main_container+' '+options_container+' '+add_row_str, function(e) {

        e.preventDefault();

        var $add_row = $(this);

        var $clone_row = $table_body.find('tr:last-child').clone();

        $clone_row.find('input').val('');
        $clone_row.find('select').val('');

        $table_body.append($clone_row);

        var token = $('input[name=9s8fjshd324hd98s]').val();

        var function_url = 'weekly_plan/create_empty';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "data_post": true
        };


        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: "html",
            success: function(data){
                console.log(data);
            }
        });


    });


    $(document).on('click', main_container+' '+options_container+' '+remove_row_str, function(e) {

        var remove_flag = false;
        var refresh_flag = false;

        e.preventDefault();

        $rows = $table_body.find('tr');
        $last_child = $rows.last();

        if($rows.length <= 1){
            $last_child.remove();
            remove_flag = true;
            refresh_flag = true;
        }else{
            $last_child.fadeOut(function(){
                $(this).remove();
            });
            remove_flag = true;
        }

        if(remove_flag){

            var token = $('input[name=9s8fjshd324hd98s]').val();
            var $weekly_plan_id = $last_child.find('.weekly-plan-id');

            var weekly_plan_id_value = $weekly_plan_id.text();

            var function_url = 'weekly_plan/remove';

            var ajax_url = base_url + function_url;

            var dataString = {

                "9s8fjshd324hd98s": token,
                "weekly_plan_id": weekly_plan_id_value
            };


            $.ajax({
                type: 'post',
                url: ajax_url,
                data: dataString,
                dataType: "html",
                success: function(data){
                    console.log(data);
                }
            });

        }


        if(refresh_flag){
            user_weekly_plan();
        }

        


    });

}



function get_criticality_analysis(query_type){

    var get_url = "get_criticality_analysis";
    var query_type = query_type || null;

    var json_data = "";

    var token = $('input[name=9s8fjshd324hd98s]').val();
    var asset = asset || null;
    var category = category || null;
    var code = code || null;
    var last_review_date = last_review_date || null;
    var category_list = category_list || null;
    var owner_id = owner_id || null;

    var function_url = 'criticality-analysis/'+get_url;

    var ajax_url = base_url + function_url;

    var dataString = {

        "9s8fjshd324hd98s": token,
        "asset": asset,
        "category": category,
        "code": code,
        "last_review_date": last_review_date,
        "category_list": category_list,
        "owner_id": owner_id,
        "query_type": query_type
    };

    $.ajax({
        type: 'post',
        async: false,
        url: ajax_url,
        data: dataString,
        dataType: 'html',
        success: function(data) {
            json_data = data;
        }
    });

    return json_data;
}

function get_json_view(json_view_name){

    var json_view_name = json_view_name || "criticality_analysis";

    var json_data = {};

    var token = $('input[name=9s8fjshd324hd98s]').val();

    var function_url = 'criticality-analysis/get_view';

    var ajax_url = base_url + function_url;

    var dataString = {

        "9s8fjshd324hd98s": token,
        "json_view_name": json_view_name
    };

    $.ajax({
        type: 'post',
        async: false,
        url: ajax_url,
        data: dataString,
        dataType: 'json',
        success: function(data){
            json_data = data;
        }
    });

    return json_data;
}

function update_criticality_analysis_view(json_view_name, query_type){

    var json_view_name = json_view_name || "criticality_analysis";
    var query_type = query_type || null;
    var token = $('input[name=9s8fjshd324hd98s]').val();

    var json_data = get_criticality_analysis(query_type);

    var function_url = 'criticality-analysis/update_view';

    var ajax_url = base_url + function_url;

    var dataString = {

        "9s8fjshd324hd98s": token,
        "json_view_name": json_view_name,
        "json_view_data": json_data
    };

    $.ajax({
        type: 'post',
        url: ajax_url,
        data: dataString
    });
}


function user_criticality_analysis(asset, category, code, last_review_date, category_list, owner_id, get_csv) {

    var $criticality_analysis = $('#my-criticality-analysis');
    var $create_criticality_analysis = $('.create-criticality-analysis');

    if ($criticality_analysis.length > 0) {
        var $criticality_analysis_body = $criticality_analysis.find('tbody');
        var $criticality_analysis_loading = $('#loading-criticality-analysis');

        var $no_criticality_analysis = $('#no-criticality-analysis');
        var $no_search_found = $('#no-search-found');

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();
        var asset = asset || null;
        var category = category || null;
        var code = code || null;
        var last_review_date = last_review_date || null;
        var category_list = category_list || null;
        var owner_id = owner_id || null;
        var get_csv = get_csv || false;

        var function_url = 'criticality-analysis/get_criticality_analysis';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "asset": asset,
            "category": category,
            "code": code,
            "last_review_date": last_review_date,
            "category_list": category_list,
            "owner_id": owner_id
        };



        if (!get_csv) {
            $criticality_analysis_loading.removeClass('hidden');
            $criticality_analysis.hide();

            $no_search_found.addClass('hidden');
            $no_criticality_analysis.addClass('hidden');
        }


        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                console.log(data);

                var csv_data = [];

                var table_data = data.table_data;
                var table_info = data.table_info;
                var user_info = data.user_info;

                var session_user_id = user_info.user_id;
                var session_asset_role = user_info.asset_role;
                var session_asset = user_info.asset;
                var session_site_role = user_info.site_role;

                if (get_csv) {

                    var date = new Date();

                    $.each(table_data, function(index, item) {
                        csv_data[index] = {
                            "ASSET": item.asset,
                            "TAG NUMBER": item.tag_number,
                            "DESCRIPTION": item.description,
                            "REDUNDANCY": item.reliability_redundancy_value,
                            "SAFETY": item.safety_health_criticality_value,
                            "ENVIRONMENT": item.environmental_criticality_value,
                            "OPERATION": item.operational_criticality_value,
                            "REINSTATEMENT": item.reinstatement_value,
                            "CAS": item.cas,
                            "FREQUENCY": item.frequency_value
                        };
                    });

                    JSONtoCSV(csv_data, "criticality_analysis_" + date, true);


                } else {
                    if (session_asset_role != 'superuser') {
                        $('th.action').remove();
                    }

                    if (session_site_role != 'siteadmin') {
                        $create_criticality_analysis.remove();
                    }

                    var tables = '';

                    if (table_data.length < 1) {

                        $criticality_analysis_loading.addClass('hidden');
                        $criticality_analysis.hide();

                        if (asset != null) {
                            $no_search_found.removeClass('hidden');
                        } else {
                            $no_criticality_analysis.removeClass('hidden');
                        }
                    } else {

                        //console.log(table_data);

                        $criticality_analysis_loading.addClass('hidden');
                        $criticality_analysis.show();

                        $.each(table_data, function(index, item) {



                            var row_html = '';

                            if (session_asset_role != 'superuser') {

                                //console.log('not superuser');

                                row_html += '<tr id="data-row-' + item.criticality_analysis_id + '" class="data-row">';
                                row_html += '<td class="asset">';
                                row_html += item.asset;
                                row_html += '</td>';
                                row_html += '<td class="tag-number">';
                                row_html += item.tag_number;
                                row_html += '</td>';
                                row_html += '<td class="description">';
                                row_html += item.description;
                                row_html += '</td>';
                                row_html += '<td class="redundancy">';
                                row_html += item.reliability_redundancy_value;
                                row_html += '</td>';
                                row_html += '<td class="safety">';
                                row_html += item.safety_health_criticality_value;
                                row_html += '</td>';
                                row_html += '<td class="environment" class="table-select">';
                                row_html += item.environmental_criticality_value;
                                row_html += '</td>';
                                row_html += '<td class="operation">';
                                row_html += item.operational_criticality_value;
                                row_html += '</td>';
                                row_html += '<td class="reinstatement">';
                                row_html += item.reinstatement_value;
                                row_html += '</td>';
                                row_html += '<td class="cas">';
                                row_html += item.cas;
                                row_html += '</td>';
                                row_html += '<td class="frequency">';
                                row_html += item.frequency_value;
                                row_html += '</td>';
                                row_html += '<td class="pce">';
                                row_html += item.pce;
                                row_html += '</td>';
                                row_html += '<td class="sce">';
                                row_html += item.sce;
                                row_html += '</td>';
                                row_html += '<td class="ece">';
                                row_html += item.ece;
                                row_html += '</td>';
                                row_html += '<td class="sis">';
                                row_html += item.sis;
                                row_html += '</td>';

                                /*row_html += '<td>';
                                    row_html += '';
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += '';
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += '';
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += '';
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += '';
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += '';
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += '';
                                row_html += '</td>';*/


                                row_html += '</tr>';

                            } else {

                                //console.log('superuser');

                                row_html += '<tr id="data-row-' + item.criticality_analysis_id + '" class="data-row">';
                                row_html += '<td class="asset">';
                                if (session_site_role != 'siteadmin' && session_site_role != 'sample') {
                                    row_html += item.asset;
                                } else {
                                    row_html += '<select name="asset" class="table-select">' + table_info.criticality_asset_dropdown + '</select>';
                                }
                                row_html += '</td>';
                                row_html += '<td class="tag-number">';
                                row_html += item.tag_number;
                                row_html += '</td>';
                                row_html += '<td class="description">';
                                row_html += item.description;
                                row_html += '</td>';
                                row_html += '<td class="redundancy">';
                                row_html += '<select name="redundancy" class="table-select">' + table_info.criticality_redundancy_dropdown + '</select>';
                                row_html += '</td>';
                                row_html += '<td class="safety">';
                                row_html += '<select name="safety" class="table-select">' + table_info.criticality_safety_dropdown + '</select>';
                                row_html += '</td>';
                                row_html += '<td class="environment" class="table-select">';
                                row_html += '<select name="environment" class="table-select">' + table_info.criticality_environment_dropdown + '</select>';
                                row_html += '</td>';
                                row_html += '<td class="operation">';
                                row_html += '<select name="operation" class="table-select">' + table_info.criticality_operation_dropdown + '</select>';
                                row_html += '</td>';
                                row_html += '<td class="reinstatement">';
                                row_html += '<select name="reinstatement" class="table-select">' + table_info.criticality_reinstatement_dropdown + '</select>';
                                row_html += '</td>';
                                row_html += '<td class="cas">';
                                row_html += item.cas;
                                row_html += '</td>';
                                row_html += '<td class="frequency">';
                                row_html += item.frequency_value;
                                row_html += '</td>';
                                row_html += '<td class="pce">';
                                row_html += table_info.pce_dropdown;
                                row_html += '</td>';
                                row_html += '<td class="sce">';
                                row_html += table_info.sce_dropdown;
                                row_html += '</td>';
                                row_html += '<td class="ece">';
                                row_html += table_info.ece_dropdown;
                                row_html += '</td>';
                                row_html += '<td class="sis">';
                                row_html += table_info.sis_dropdown;
                                row_html += '</td>';

                                /*row_html += '<td class="failure-rate">';
                                    row_html += '<input type="text" class="form-control" value="">';
                                row_html += '</td>';

                                row_html += '<td class="mtbf">';
                                    row_html += '<input type="text" class="form-control" value="">';
                                row_html += '</td>';

                                row_html += '<td class="mttr">';
                                    row_html += '<input type="text" class="form-control" value="">';
                                row_html += '</td>';

                                row_html += '<td class="fail-date">';
                                    row_html += '<input type="text" class="datepicker form-control" name="fail_date" value="'+item.fail_date+'" >';
                                row_html += '</td>';

                                row_html += '<td class="repair-date">';
                                    row_html += '<input type="text" class="datepicker form-control" name="repair_date" value="'+item.repair_date+'" >';
                                row_html += '</td>';

                                row_html += '<td class="estimated-repair-time">';
                                    row_html += '<input type="text" class="timepicker form-control" name="estimated_repair_time" value="'+item.estimated_repair_time+'" >';
                                row_html += '</td>';

                                row_html += '<td class="actual-repair-time">';
                                    row_html += '<input type="text" class="timepicker form-control" name="actual_repair_time" value="'+item.actual_repair_time+'" >';
                                row_html += '</td>';*/

                                row_html += '<td class="text-center">';
                                row_html += '<a href="#" class="btn btn-primary edit-criticality-analysis"><span class="glyphicon glyphicon-floppy-disk"></span></a>';

                                if(session_site_role == 'siteadmin'){
                                    row_html += ' &nbsp;<a href="#" class="btn btn-danger delete-criticality-analysis"><span class="glyphicon glyphicon-trash"></span></a>';
                                }
                                row_html += '<p class="criticality-analysis-id hidden">' + item.criticality_analysis_id + '</p>';
                                row_html += '<p class="asset-id hidden">' + item.asset_id + '</p>';
                                row_html += '<p class="redundancy-id hidden">' + item.reliability_redundancy_id + '</p>';
                                row_html += '<p class="safety-id hidden">' + item.safety_health_criticality_id + '</p>';
                                row_html += '<p class="environment-id hidden">' + item.environmental_criticality_id + '</p>';
                                row_html += '<p class="operation-id hidden">' + item.operational_criticality_id + '</p>';
                                row_html += '<p class="reinstatement-id hidden">' + item.reinstatement_id + '</p>';

                                row_html += '<p class="redundancy-value hidden">' + item.reliability_redundancy_value + '</p>';
                                row_html += '<p class="safety-value hidden">' + item.safety_health_criticality_value + '</p>';
                                row_html += '<p class="environment-value hidden">' + item.environmental_criticality_value + '</p>';
                                row_html += '<p class="operation-value hidden">' + item.operational_criticality_value + '</p>';
                                row_html += '<p class="reinstatement-value hidden">' + item.reinstatement_value + '</p>';

                                row_html += '<p class="cas-id hidden">' + item.cas_id + '</p>';
                                row_html += '<p class="user-id hidden">' + item.user_id + '</p>';
                                row_html += '</td>';
                                row_html += '</tr>';

                            }


                            $criticality_analysis_body.append(row_html);

                            var $row_data = $(row_html);
                            var row_id = '#' + $row_data.attr('id') + ' ';

                            var $asset_dropdown = $criticality_analysis_body.find(row_id + 'select[name=asset]');
                            var $redundancy_dropdown = $criticality_analysis_body.find(row_id + 'select[name=redundancy]');
                            var $safety_dropdown = $criticality_analysis_body.find(row_id + 'select[name=safety]');
                            var $environment_dropdown = $criticality_analysis_body.find(row_id + 'select[name=environment]');
                            var $operation_dropdown = $criticality_analysis_body.find(row_id + 'select[name=operation]');
                            var $reinstatement_dropdown = $criticality_analysis_body.find(row_id + 'select[name=reinstatement]');
                            var $pce_dropdown = $criticality_analysis_body.find(row_id + 'select[name=pce]');
                            var $sce_dropdown = $criticality_analysis_body.find(row_id + 'select[name=sce]');
                            var $ece_dropdown = $criticality_analysis_body.find(row_id + 'select[name=ece]');
                            var $sis_dropdown = $criticality_analysis_body.find(row_id + 'select[name=sis]');

                            $asset_dropdown.val(item.asset_id);
                            $redundancy_dropdown.val(item.reliability_redundancy_id);
                            $safety_dropdown.val(item.safety_health_criticality_id);
                            $environment_dropdown.val(item.environmental_criticality_id);
                            $operation_dropdown.val(item.operational_criticality_id);
                            $reinstatement_dropdown.val(item.reinstatement_id);
                            $pce_dropdown.val(item.pce_value);
                            $sce_dropdown.val(item.sce_value);
                            $ece_dropdown.val(item.ece_value);
                            $sis_dropdown.val(item.sis_value);

                        }); // end .each


                    } //end else

                }


                //end success  
                scrollToData("#my-criticality-analysis table");
                dateEffects();
            }
        });

        //}//end get_csv else
    }
}

function user_history_of_availability(asset, category, code, last_review_date, category_list, owner_id, get_csv){

    var $criticality_analysis = $('#history-of-availability-table');
    var $create_criticality_analysis = $('.create-criticality-analysis');

    if ($criticality_analysis.length > 0) {
        var $criticality_analysis_body = $criticality_analysis.find('tbody');
        var $criticality_analysis_loading = $('#loading-criticality-analysis');

        var $no_criticality_analysis = $('#no-criticality-analysis');
        var $no_search_found = $('#no-search-found');

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();
        var asset = asset || null;
        var category = category || null;
        var code = code || null;
        var last_review_date = last_review_date || null;
        var category_list = category_list || null;
        var owner_id = owner_id || null;
        var get_csv = get_csv || false;

        var function_url = 'criticality-analysis/get_criticality_analysis';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "asset": asset,
            "category": category,
            "code": code,
            "last_review_date": last_review_date,
            "category_list": category_list,
            "owner_id": owner_id
        };



        if (!get_csv) {
            $criticality_analysis_loading.removeClass('hidden');
            $criticality_analysis.hide();

            $no_search_found.addClass('hidden');
            $no_criticality_analysis.addClass('hidden');
        }


        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                console.log(data);

                var csv_data = [];

                var table_data = data.table_data;
                var table_info = data.table_info;
                var user_info = data.user_info;

                var session_user_id = user_info.user_id;
                var session_asset_role = user_info.asset_role;
                var session_asset = user_info.asset;
                var session_site_role = user_info.site_role;

                if (get_csv) {

                    var date = new Date();

                    $.each(table_data, function(index, item) {
                        csv_data[index] = {
                            "ASSET": item.asset,
                            "TAG NUMBER": item.tag_number,
                            "DESCRIPTION": item.description,
                            "REDUNDANCY": item.reliability_redundancy_value,
                            "SAFETY": item.safety_health_criticality_value,
                            "ENVIRONMENT": item.environmental_criticality_value,
                            "OPERATION": item.operational_criticality_value,
                            "REINSTATEMENT": item.reinstatement_value,
                            "CAS": item.cas,
                            "FREQUENCY": item.frequency_value
                        };
                    });

                    JSONtoCSV(csv_data, "criticality_analysis_" + date, true);


                } else {
                    if (session_asset_role != 'superuser') {
                        $('th.action').remove();
                    }

                    if (session_site_role != 'siteadmin') {
                        $create_criticality_analysis.remove();
                    }

                    var tables = '';

                    if (table_data.length < 1) {

                        $criticality_analysis_loading.addClass('hidden');
                        $criticality_analysis.hide();

                        if (asset != null) {
                            $no_search_found.removeClass('hidden');
                        } else {
                            $no_criticality_analysis.removeClass('hidden');
                        }
                    } else {

                        //console.log(table_data);

                        $criticality_analysis_loading.addClass('hidden');
                        $criticality_analysis.show();

                        $.each(table_data, function(index, item) {


                            var row_html = '';

                            row_html += '<tr>';
                            row_html += '<td>'+item.asset+'</td>';
                            row_html += '<td>'+item.tag_number+'</td>';
                            row_html += '<td>'+item.description+'</td>';
                            row_html += '<td class="'+item.arn_color+'">'+item.available_right_now+'</td>';
                            row_html += '<td class="'+item.alert_color+'">'+item.alert+'</td>';

                            var availability_info = item.availability_info;

                            $.each(availability_info, function(info_index, info_item){

                                var single_availability_percentage = info_item.availability_percentage;
                                var single_availability_record = info_item.availability_record;
                                var single_availability_record_color = info_item.availability_record_color;
                                var percentage_color = info_item.percentage_color;

                                row_html += '<td class="'+percentage_color+'">'+single_availability_percentage+'</td>';
                                row_html += '<td class="'+single_availability_record_color+'">'+single_availability_record+'</td>';

                            });

                            row_html += '</tr>';

                            $criticality_analysis_body.append(row_html);

                        }); // end .each


                    } //end else

                }
            }
        });

        //}//end get_csv else
    }

}

function user_failure_rate(asset, category, code, last_review_date, category_list, owner_id, get_csv) {

    var $criticality_analysis = $('#failure-rate');

    if ($criticality_analysis.length > 0) {
        var $criticality_analysis_body = $criticality_analysis.find('tbody');
        var $criticality_analysis_loading = $('#loading-criticality-analysis');

        var $no_criticality_analysis = $('#no-criticality-analysis');
        var $no_search_found = $('#no-search-found');

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();
        var asset = asset || null;
        var category = category || null;
        var code = code || null;
        var last_review_date = last_review_date || null;
        var category_list = category_list || null;
        var owner_id = owner_id || null;
        var get_csv = get_csv || false;

        var function_url = 'criticality-analysis/get_criticality_analysis';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "asset": asset,
            "category": category,
            "code": code,
            "last_review_date": last_review_date,
            "category_list": category_list,
            "owner_id": owner_id
        };



        if (!get_csv) {
            $criticality_analysis_loading.removeClass('hidden');
            $criticality_analysis.hide();

            $no_search_found.addClass('hidden');
            $no_criticality_analysis.addClass('hidden');
        }


        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                var csv_data = [];

                var table_data = data.table_data;
                var table_info = data.table_info;
                var user_info = data.user_info;

                var session_user_id = user_info.user_id;
                var session_asset_role = user_info.asset_role;
                var session_asset = user_info.asset;
                var session_site_role = user_info.site_role;

                if (get_csv) {

                    var date = new Date();

                    $.each(table_data, function(index, item) {
                        csv_data[index] = {
                            "ASSET": item.asset,
                            "TAG NUMBER": item.tag_number,
                            "DESCRIPTION": item.description,
                            "REDUNDANCY": item.reliability_redundancy_value,
                            "SAFETY": item.safety_health_criticality_value,
                            "ENVIRONMENT": item.environmental_criticality_value,
                            "OPERATION": item.operational_criticality_value,
                            "REINSTATEMENT": item.reinstatement_value,
                            "CAS": item.cas,
                            "FREQUENCY": item.frequency_value
                        };
                    });

                    JSONtoCSV(csv_data, "criticality_analysis_" + date, true);


                } else {
                    if (session_asset_role != 'superuser') {
                        $('th.action').remove();
                    }

                    var tables = '';

                    if (table_data.length < 1) {

                        $criticality_analysis_loading.addClass('hidden');
                        $criticality_analysis.hide();

                        if (asset != null) {
                            $no_search_found.removeClass('hidden');
                        } else {
                            $no_criticality_analysis.removeClass('hidden');
                        }
                    } else {

                        //console.log(table_data);

                        $criticality_analysis_loading.addClass('hidden');
                        $criticality_analysis.show();

                        $.each(table_data, function(index, item) {



                            var row_html = '';

                            if (session_asset_role != 'superuser') {

                                //console.log('not superuser');

                                row_html += '<tr id="data-row-' + item.criticality_analysis_id + '" class="data-row">';
                                row_html += '<td class="asset">';
                                row_html += item.asset;
                                row_html += '</td>';
                                row_html += '<td class="tag-number">';
                                row_html += item.tag_number;
                                row_html += '</td>';
                                row_html += '<td class="description">';
                                row_html += item.description;
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += item.start_date;
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += item.failure_rate;
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += item.mtbf;
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += item.mttr;
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += item.fail_date;
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += item.repair_date;
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += item.estimated_repair_time;
                                row_html += '</td>';

                                row_html += '<td>';
                                    row_html += item.actual_repair_time;
                                row_html += '</td>';


                                row_html += '</tr>';

                            } else {

                                //console.log('superuser');

                                row_html += '<tr id="data-row-' + item.criticality_analysis_id + '" class="data-row">';
                                row_html += '<td class="asset">';
                                if (session_site_role != 'siteadmin' && session_site_role != 'sample') {
                                    row_html += item.asset;
                                } else {
                                    row_html += '<select name="asset" class="table-select">' + table_info.criticality_asset_dropdown + '</select>';
                                }
                                row_html += '</td>';
                                row_html += '<td class="tag-number">';
                                row_html += item.tag_number;
                                row_html += '</td>';
                                row_html += '<td class="description">';
                                row_html += item.description;
                                row_html += '</td>';

                                row_html += '<td class="start-date">';
                                    row_html += '<input type="text" class="form-control datepicker" name="start_date" value="'+item.start_date+'">';
                                row_html += '</td>';

                                row_html += '<td class="failure-rate">';
                                    row_html += '<input type="text" class="form-control" name="failure_rate" value="'+item.failure_rate+'">';
                                row_html += '</td>';

                                row_html += '<td class="mtbf">';
                                    row_html += '<input type="text" class="form-control" name="mtbf" value="'+item.mtbf+'">';
                                row_html += '</td>';

                                row_html += '<td class="mttr">';
                                    row_html += '<input type="text" class="form-control" name="mttr" value="'+item.mttr+'">';
                                row_html += '</td>';

                                row_html += '<td class="fail-date">';
                                    row_html += '<input type="text" class="datepicker form-control" name="fail_date" value="'+item.fail_date+'" >';
                                row_html += '</td>';

                                row_html += '<td class="repair-date">';
                                    row_html += '<input type="text" class="datepicker form-control" name="repair_date" value="'+item.repair_date+'" >';
                                row_html += '</td>';

                                row_html += '<td class="estimated-repair-time">';
                                    row_html += '<input type="text" class=" form-control" name="estimated_repair_time" value="'+item.estimated_repair_time+'" >';
                                row_html += '</td>';

                                row_html += '<td class="actual-repair-time">';
                                    row_html += '<input type="text" class=" form-control" name="actual_repair_time" value="'+item.actual_repair_time+'" >';
                                row_html += '</td>';

                                row_html += '<td class="text-center">';
                                row_html += '<a href="#" class="btn btn-primary edit-failure-rate"><span class="glyphicon glyphicon-floppy-disk"></span></a>';

                                if(session_site_role == 'siteadmin'){
                                    row_html += ' &nbsp;<a href="#" class="btn btn-danger delete-failure-rate"><span class="glyphicon glyphicon-trash"></span></a>';
                                }
                                row_html += '<p class="criticality-analysis-id hidden">' + item.criticality_analysis_id + '</p>';
                                row_html += '<p class="asset-id hidden">' + item.asset_id + '</p>';
                                row_html += '<p class="redundancy-id hidden">' + item.reliability_redundancy_id + '</p>';
                                row_html += '<p class="safety-id hidden">' + item.safety_health_criticality_id + '</p>';
                                row_html += '<p class="environment-id hidden">' + item.environmental_criticality_id + '</p>';
                                row_html += '<p class="operation-id hidden">' + item.operational_criticality_id + '</p>';
                                row_html += '<p class="reinstatement-id hidden">' + item.reinstatement_id + '</p>';

                                row_html += '<p class="redundancy-value hidden">' + item.reliability_redundancy_value + '</p>';
                                row_html += '<p class="safety-value hidden">' + item.safety_health_criticality_value + '</p>';
                                row_html += '<p class="environment-value hidden">' + item.environmental_criticality_value + '</p>';
                                row_html += '<p class="operation-value hidden">' + item.operational_criticality_value + '</p>';
                                row_html += '<p class="reinstatement-value hidden">' + item.reinstatement_value + '</p>';

                                row_html += '<p class="cas-id hidden">' + item.cas_id + '</p>';
                                row_html += '<p class="user-id hidden">' + item.user_id + '</p>';
                                row_html += '</td>';
                                row_html += '</tr>';

                            }


                            $criticality_analysis_body.append(row_html);

                            var $row_data = $(row_html);
                            var row_id = '#' + $row_data.attr('id') + ' ';

                            var $asset_dropdown = $criticality_analysis_body.find(row_id + 'select[name=asset]');

                            $asset_dropdown.val(item.asset_id);

                            /*var $redundancy_dropdown = $criticality_analysis_body.find(row_id + 'select[name=redundancy]');
                            var $safety_dropdown = $criticality_analysis_body.find(row_id + 'select[name=safety]');
                            var $environment_dropdown = $criticality_analysis_body.find(row_id + 'select[name=environment]');
                            var $operation_dropdown = $criticality_analysis_body.find(row_id + 'select[name=operation]');
                            var $reinstatement_dropdown = $criticality_analysis_body.find(row_id + 'select[name=reinstatement]');
                            var $pce_dropdown = $criticality_analysis_body.find(row_id + 'select[name=pce]');
                            var $sce_dropdown = $criticality_analysis_body.find(row_id + 'select[name=sce]');
                            var $ece_dropdown = $criticality_analysis_body.find(row_id + 'select[name=ece]');
                            var $sis_dropdown = $criticality_analysis_body.find(row_id + 'select[name=sis]');

                            
                            $redundancy_dropdown.val(item.reliability_redundancy_id);
                            $safety_dropdown.val(item.safety_health_criticality_id);
                            $environment_dropdown.val(item.environmental_criticality_id);
                            $operation_dropdown.val(item.operational_criticality_id);
                            $reinstatement_dropdown.val(item.reinstatement_id);
                            $pce_dropdown.val(item.pce_value);
                            $sce_dropdown.val(item.sce_value);
                            $ece_dropdown.val(item.ece_value);
                            $sis_dropdown.val(item.sis_value);*/

                        }); // end .each


                    } //end else

                }


                //end success  
                scrollToData("#failure-rate table");
                dateEffects();
            }
        });

        //}//end get_csv else
    }
}

function export_csv() {

    $(document).on('click', '#export-criticality-analysis', function() {

        var $export_button = $(this);
        var $filter_form = $(this).closest('form');

        var filter_asset = $filter_form.find('select[name=filter_asset]').val();
        var filter_category = $filter_form.find('select[name=filter_category]').val();
        var filter_code = $filter_form.find('input[name=filter_code]').val();
        var filter_last_review_date = $filter_form.find('select[name=filter_last_review_date]').val();
        var filter_owner = $filter_form.find('select[name=filter_owner]').val();

        user_criticality_analysis(filter_asset, filter_category, filter_code, filter_last_review_date, filter_owner, true);
    });

    $(document).on('click', '#export-single-index', function() {

        var $export_button = $(this);
        var $filter_form = $(this).closest('form');

        var filter_asset = $filter_form.find('select[name=filter_asset]').val();
        var filter_category = $filter_form.find('select[name=filter_category]').val();
        var filter_code = $filter_form.find('input[name=filter_code]').val();
        var filter_last_review_date = $filter_form.find('select[name=filter_last_review_date]').val();
        var filter_owner = $filter_form.find('select[name=filter_category]').val();
        var status_checked = $filter_form.find("input:checked[name='filter_status[]']");

        var filter_status = [];
        status_checked.each(function(index) {
            filter_status.push($(this).val());
        });

        user_single_index(filter_asset, filter_category, filter_code, filter_last_review_date, filter_status, filter_owner, true);
    });
}

function user_single_index(asset, category, code, last_review_date, status, category_list, owner_id, get_csv) {

    //console.log(arguments)

    var $criticality_analysis = $('#single-index-of-failing-equipment');
    var $create_criticality_analysis = $('.create-criticality-analysis');

    if ($criticality_analysis.length > 0) {
        var $criticality_analysis_body = $criticality_analysis.find('tbody');
        var $criticality_analysis_loading = $('#loading-criticality-analysis');

        var $no_criticality_analysis = $('#no-criticality-analysis');
        var $no_search_found = $('#no-search-found');

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();
        var asset = asset || null;
        var category = category || null;
        var code = code || null;
        var last_review_date = last_review_date || null;
        var status = status || null;
        var owner_id = owner_id || null;
        var get_csv = get_csv || false;
        var category_list = category_list || null;


        var function_url = 'criticality-analysis/get_criticality_analysis';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "asset": asset,
            "category": category,
            "code": code,
            "last_review_date": last_review_date,
            "status": status,
            "category_list": category_list,
            "single_index_of_failing_equipment": 'true',
            "owner_id": owner_id
        };

        if (!get_csv) {
            $criticality_analysis_loading.removeClass('hidden');
            $criticality_analysis.hide();

            $no_search_found.addClass('hidden');
            $no_criticality_analysis.addClass('hidden');
        }

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                console.log(data);

                var csv_data = [];

                var table_data = data.table_data;
                var table_info = data.table_info;
                var user_info = data.user_info;
                var cv_values = data.table_cv;

                var session_user_id = user_info.user_id;
                var session_asset_role = user_info.asset_role;
                var session_asset = user_info.asset;
                var session_site_role = user_info.site_role;

                if (get_csv) {

                    var date = new Date();

                    $.each(table_data, function(index, item) {
                        csv_data[index] = {
                            "ASSET": item.asset,
                            "TAG NUMBER": item.tag_number,
                            "DESCRIPTION": item.description,
                            "CODE": item.code,
                            "PCE": item.pce,
                            "SCE": item.sce,
                            "ECE": item.ece,
                            "SIS": item.sis,
                            "ALERT": item.alert,
                            "CRITICALITY VALUE": item.cv,
                            "CAS": item.cas,
                            "STATUS": item.day_status
                        };
                    });

                    JSONtoCSV(csv_data, "single_index_of_failing_equipment_" + date, true);

                } else {
                    
                    if (session_asset_role != 'superuser') {
                        $('th.action').remove();
                    }

                    if (session_site_role != 'siteadmin') {
                        $create_criticality_analysis.remove();
                    }

                    var tables = '';

                    if (table_data.length < 1) {

                        $criticality_analysis_loading.addClass('hidden');
                        $criticality_analysis.hide();

                        if (asset != null) {
                            $no_search_found.removeClass('hidden');
                        } else {
                            $no_criticality_analysis.removeClass('hidden');
                        }

                    } else {

                        //console.log(table_data);

                        $criticality_analysis_loading.addClass('hidden');
                        $criticality_analysis.show();

                        $.each(table_data, function(index, item) {

                            if(item.cv_greater_than_cas){
                                var row_html = '';

                                row_html += '<tr id="data-row-' + item.criticality_analysis_id + '" class="data-row">';

                                row_html += '<td class="asset">';
                                row_html += item.asset;
                                row_html += '</td>';

                                row_html += '<td class="tag-number">';
                                row_html += item.tag_number;
                                row_html += '</td>';

                                row_html += '<td class="description">';
                                row_html += item.description;
                                row_html += '</td>';

                                row_html += '<td class="code">';
                                row_html += item.code;
                                row_html += '</td>';

                                row_html += '<td class="pce">';
                                row_html += item.pce;
                                row_html += '</td>';

                                row_html += '<td class="sce">';
                                row_html += item.sce;
                                  row_html += '</td>';

                                row_html += '<td class="ece">';
                                row_html += item.ece;
                                row_html += '</td>';

                                row_html += '<td class="sis">';
                                row_html += item.sis;
                                row_html += '</td>';



                                row_html += '<td class="day-status ' + item.day_status_color + ' ">';
                                row_html += item.day_status;
                                row_html += '</td>';

                                row_html += '<td class="criticality-value">';
                                row_html += item.cv;
                                row_html += '</td>';
                                row_html += '<td class="cas">';
                                row_html += item.cas;
                                row_html += '</td>';

                                row_html += '<td class="owner">';
                                    if(session_asset_role != 'superuser'){
                                        row_html += item.user_value;
                                    }else{
                                        row_html += '<select name="owner" class="form-control">';
                                        row_html += table_info.user_dropdown;
                                        row_html += '</select>';
                                    }
                                row_html += '</td>';


                                row_html += '<td class="defect-elimination">';
                                    if(session_asset_role != 'superuser'){
                                        row_html += item.defect_elimination_value;
                                    }else{
                                        row_html += '<select name="defect_elimination" class="table-select">';
                                        row_html += table_info.criticality_defect_elimination_dropdown;
                                        row_html += '</select>';
                                    }
                                row_html += '</td>';

                                row_html += '<td class="project-plan">';
                                    if(session_asset_role != 'superuser'){
                                        row_html += item.project_plan_value;
                                    }else{
                                        row_html += '<select name="project_plan" class="table-select">';
                                        row_html += table_info.criticality_project_plan_dropdown;
                                        row_html += '</select>';
                                    }
                                row_html += '</td>';

                                row_html += '<td class="technical-bulletin">';
                                    if(session_asset_role != 'superuser'){
                                        row_html += item.technical_bulletin_value;
                                    }else{
                                        row_html += '<select name="technical_bulletin" class="table-select">';
                                        row_html += table_info.criticality_technical_bulletin_dropdown;
                                        row_html += '</select>';
                                    }
                                row_html += '</td>';

                                if (session_asset_role == 'superuser') {
                                row_html += '<td class="text-center">';
                                    row_html += '<a href="#" class="btn btn-primary edit-criticality-analysis"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
                                }
                                row_html += '<p class="criticality-analysis-id hidden">' + item.criticality_analysis_id + '</p>';
                                row_html += '<p class="asset-id hidden">' + item.asset_id + '</p>';
                                row_html += '<p class="cas-id hidden">' + item.cas_id + '</p>';
                                row_html += '<p class="user-id hidden">' + item.user_id + '</p>';
                                row_html += '</td>';
                                

                                row_html += '</tr>';

                                $criticality_analysis_body.append(row_html);

                                //select_with_search();

                                var $row_data = $(row_html);
                                var row_id = '#' + $row_data.attr('id') + ' ';

                                var $owner_dropdown = $criticality_analysis_body.find(row_id + 'select[name=owner]');
                                var $defect_elimination_dropdown = $criticality_analysis_body.find(row_id + 'select[name=defect_elimination]');
                                var $project_plan_dropdown = $criticality_analysis_body.find(row_id + 'select[name=project_plan]');
                                var $technical_bulletin_dropdown = $criticality_analysis_body.find(row_id + 'select[name=technical_bulletin]');

                                //$owner_dropdown.select2('val', item.user_id);
                                $owner_dropdown.val(item.user_id);
                                $defect_elimination_dropdown.val(item.defect_elimination);
                                $project_plan_dropdown.val(item.project_plan);
                                $technical_bulletin_dropdown.val(item.technical_bulletin);
                            }

                        });
                    }
                }
                
                scrollToData('#single-index-of-failing-equipment table');    
            }
        });
    }
}

function update_user_compliance() {

    var $table_container = $('#compliance-dashboard');
    var $table_body = $table_container.find('tbody');
    var $edit_button = $table_container.find('.edit-criticality-analysis');
    var $loading = $('#loading-criticality-analysis');
    var $no_search_found = $('#no-search-found');

    $(document).on('click', '#compliance-dashboard .edit-criticality-analysis', function(e) {

        e.preventDefault();

        $row = $(this).closest('.data-row');

        var $performance_standard = $row.find('input[name=performance_standard]');
        var $criticality_analysis_id = $row.find('p.criticality-analysis-id');

        var performance_standard_value = $performance_standard.val();
        var criticality_analysis_id_value = $criticality_analysis_id.text();
        var token = $('input[name=9s8fjshd324hd98s]').val();

        var function_url = 'criticality-analysis/update-compliance';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "performance_standard": performance_standard_value,
            "criticality_analysis_id": criticality_analysis_id_value
        };

        console.log(dataString);


        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'html',
            success: function(data) {
                console.log(data);
                $table_body.html('');
                user_compliance_dashboard();
            }
        });


    });
}

function update_user_single_index(){

    var $table_container = $('#single-index-of-failing-equipment');
    var $table_body = $table_container.find('tbody');
    var $edit_button = $table_container.find('.edit-criticality-analysis');
    var $loading = $('#loading-criticality-analysis');
    var $no_search_found = $('#no-search-found');

    $(document).on('click', '#single-index-of-failing-equipment .edit-criticality-analysis', function(e) {

        e.preventDefault();

        $row = $(this).closest('.data-row');

        var $owner = $row.find('select[name=owner]');
        var $defect_elimination = $row.find('select[name=defect_elimination]');
        var $project_plan = $row.find('select[name=project_plan]');
        var $technical_bulletin = $row.find('select[name=technical_bulletin]');
        var $criticality_analysis_id = $row.find('p.criticality-analysis-id');

        var owner_value = $owner.val();
        var defect_elimination_value = $defect_elimination.val();
        var project_plan_value = $project_plan.val();
        var technical_bulletin_value = $technical_bulletin.val();
        var criticality_analysis_id_value = $criticality_analysis_id.text();
        var token = $('input[name=9s8fjshd324hd98s]').val();

        var function_url = 'criticality-analysis/update_single_index';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "owner": owner_value,
            "defect_elimination": defect_elimination_value,
            "project_plan": project_plan_value,
            "technical_bulletin": technical_bulletin_value,
            "criticality_analysis_id": criticality_analysis_id_value
        };

        console.log(dataString);

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'html',
            success: function(data) {
                console.log(data);
                $table_body.html('');
                user_single_index();
            }
        });


    });
}

function user_compliance_dashboard(asset, category, code, last_review_date, category_list, owner_id) {

    //console.log(arguments)

    var $criticality_analysis = $('#compliance-dashboard');
    var $create_criticality_analysis = $('.create-criticality-analysis');

    if ($criticality_analysis.length > 0) {
        var $criticality_analysis_body = $criticality_analysis.find('tbody');
        var $criticality_analysis_loading = $('#loading-criticality-analysis');

        var $no_criticality_analysis = $('#no-criticality-analysis');
        var $no_search_found = $('#no-search-found');

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();
        var asset = asset || null;
        var category = category || null;
        var code = code || null;
        var last_review_date = last_review_date || null;
        var owner_id = owner_id || null;
        var category_list = category_list || null;

        var function_url = 'criticality-analysis/get_criticality_analysis';
        var query_type = "compliance";

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "asset": asset,
            "category": category,
            "code": code,
            "last_review_date": last_review_date,
            "category_list": category_list,
            "owner_id": owner_id,
            "query_type": query_type
        };

        $criticality_analysis_loading.removeClass('hidden');
        $criticality_analysis.hide();

        $no_search_found.addClass('hidden');
        $no_criticality_analysis.addClass('hidden');



        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                //console.log(data);

                var table_data = data.table_data;
                var table_info = data.table_info;
                var user_info = data.user_info;

                var session_user_id = user_info.user_id;
                var session_asset_role = user_info.asset_role;
                var session_asset = user_info.asset;
                var session_site_role = user_info.site_role;

                //console.log(data);

                if (session_asset_role != 'superuser') {
                    $('th.action').remove();
                }

                if (session_site_role != 'siteadmin') {
                    $create_criticality_analysis.remove();
                }

                var tables = '';

                if (table_data.length < 1) {

                    $criticality_analysis_loading.addClass('hidden');
                    $criticality_analysis.hide();

                    if (asset != null) {
                        $no_search_found.removeClass('hidden');
                    } else {
                        $no_criticality_analysis.removeClass('hidden');
                    }



                } else {



                    $criticality_analysis_loading.addClass('hidden');
                    $criticality_analysis.show();

                    //console.log(table_data);

                    $.each(table_data, function(index, item) {

                        var resultant = item.resultant_raw;
                        var average_performance_standard = item.average_performance_standard;
                        var compliant = item.compliant;
                        var compliant_color = item.compliant_color;

                        var row_html = '';

                        row_html += '<tr id="data-row-' + item.criticality_analysis_id + '" class="data-row">';
                        row_html += '<td class="asset">';
                        row_html += item.asset;
                        row_html += '</td>';
                        row_html += '<td class="tag-number">';
                        row_html += item.tag_number;
                        row_html += '</td>';
                        row_html += '<td class="description">';
                        row_html += item.description;
                        row_html += '</td>';
                        row_html += '<td class="pce">';
                        row_html += item.pce;
                        row_html += '</td>';

                        row_html += '<td class="sce">';
                        row_html += item.sce;
                        row_html += '</td>';

                        row_html += '<td class="ece">';
                        row_html += item.ece;
                        row_html += '</td>';

                        row_html += '<td class="sis">';
                        row_html += item.sis;
                        row_html += '</td>';
                        row_html += '<td class="performance-standard ">';
                        if (session_asset_role != 'superuser') {
                            row_html += item.performance_standard;
                        } else {
                            row_html += '<input type="text" class="form-control decimal-only less-hundred" name="performance_standard" value="' + item.performance_standard + '">';
                        }
                        row_html += '</td>';
                        row_html += '<td class="unit-currently-available">';
                        row_html += item.available_right_now;
                        row_html += '</td>';

                        if(item.group_rowspan != null){
                            row_html += '<td class="resultant-availability text-middle text-center" rowspan="'+item.group_rowspan+'">';
                            row_html += item.resultant;
                            row_html += '</td>';

                            row_html += '<td class="compliant text-middle text-center '+compliant_color+'" rowspan="'+item.group_rowspan+'">';
                            row_html += compliant;
                            row_html += '</td>';
                        }
                        
                        

                        row_html += '<td class="text-center">';
                        if (session_asset_role == 'superuser') {
                            row_html += '<a href="#" class="btn btn-primary edit-criticality-analysis"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
                        }
                        row_html += '<p class="criticality-analysis-id hidden">' + item.criticality_analysis_id + '</p>';
                        row_html += '<p class="asset-id hidden">' + item.asset_id + '</p>';
                        row_html += '<p class="cas-id hidden">' + item.cas_id + '</p>';
                        row_html += '<p class="user-id hidden">' + item.user_id + '</p>';
                        row_html += '</td>';

                        row_html += '</tr>';

                        $criticality_analysis_body.append(row_html);

                    });
                }

                scrollToData('#compliance-dashboard table');
            }
        });
    }
}

function user_admin() {

    var $user_admin = $('#user-admin');
    var $user_admin_body = $user_admin.find('tbody');
    var $user_admin_loading = $('#loading-user-admin');

    var $no_user = $('#no-user');
    var $no_search_found = $('#no-search-found');

    var token = $('input[name=9s8fjshd324hd98s]').val();
    //var current_user_id = $('input[name=current_user_id]').val();
    //var document_id = document_id || null;
    //var status = status || null;
    //var reference = reference || null;

    var function_url = 'user/get_user_data';

    var ajax_url = base_url + function_url;

    var dataString = {

        "9s8fjshd324hd98s": token,
        //"current_user_id": current_user_id,
        //"document_id": document_id,
        //"status": status,
        //"reference": reference


    };

    $user_admin_loading.removeClass('hidden');
    $user_admin.hide();

    $no_search_found.addClass('hidden');
    $no_user.addClass('hidden');



    $.ajax({
        type: 'post',
        url: ajax_url,
        data: dataString,
        dataType: 'json',
        success: function(data) {
            //console.log(data);

            var tables = '';

            if (data.length < 1) {

                $user_admin_loading.addClass('hidden');
                $user_admin.hide();

                //if (document_id != null || status != null || reference != null) {
                //    $no_search_found.removeClass('hidden');
                //} else {
                $no_weekly_plan.removeClass('hidden');
                //}


            } else {

                $user_admin_loading.addClass('hidden');
                $user_admin.show();

                $.each(data, function(index, item) {

                    /*if (item.action_process == null) {
                        return true;
                    }*/

                    tables += '<tr id="data-row-' + item.admin_user_id + '" class="data-row">';
                    tables += '<td class="first-name">';
                    tables += item.first_name;
                    tables += '</td>';
                    tables += '<td class="last-name">';
                    tables += item.last_name;
                    tables += '</td>';
                    tables += '<td class="user-name">';
                    tables += item.user_name;
                    tables += '</td>';
                    tables += '<td class="role">';
                    tables += item.role;
                    tables += '</td>';
                    tables += '<td class="database">';
                    tables += item.database;
                    tables += '</td>';
                    tables += '<td class="email-address hidden">';
                    tables += item.email_address;
                    tables += '</td>';
                    tables += '<td class="asset">';
                    tables += item.asset;
                    tables += '</td>';
                    tables += '<td class="asset-role">';
                    tables += item.asset_role;
                    tables += '</td>';
                    tables += '<td class="text-center">';
                    tables += '<p class="user-admin-id hidden">' + item.user_id + '</p>';
                    tables += '<p class="asset-id hidden">' + item.asset_id + '</p>';
                    tables += '<a href="#" class="btn btn-primary edit-user-admin"><span class="glyphicon glyphicon-pencil"></span></a>';
                    tables += '</td>';
                    tables += '</tr>';
                });

                $user_admin_body.html(tables);
            }


        }
    });

}

function spin_loading() {
    $(document).on('click', '.duplicate-btn', function() {
        $('#loading-animation').modal();
    });
}

function addSis() {

    var $add_sis = $('a.add-sis');
    var $down_sis_modal = $('#safety-instrumented-system');
    //var $table_tbody = $('#my-criticality-analysis tbody');

    $(document).on('click', 'a.add-sis', function(e) {

        //console.log('test');
        $down_sis_modal.modal();
        var datePicker = $('body').find('.datepicker');
        //$(datePicker).css('z-index', '10000');

    });
}

function getSisList() {

    var $sis = $('#sis-list');

    if ($sis.length > 0) {
        var $sis_body = $sis.find('tbody');
        var $sis_loading = $('#loading-sis');

        var $no_sis = $('#no-sis');
        var $no_search_found = $('#no-search-found');

        var token = $('input[name=9s8fjshd324hd98s]').val();
        //var current_user_id = $('input[name=current_user_id]').val();
        //var asset = asset || null;
        //var status = status || null;
        //var reference = reference || null;

        var function_url = 'sis/get_sis_list';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            //"current_user_id": current_user_id,
            //"asset": 454,
            //"asset_role": 'superuser'
            //"status": status,
            //"reference": reference
            "sis_list": '1'


        };

        $sis_loading.removeClass('hidden');
        $sis.hide();

        $no_search_found.addClass('hidden');
        $no_sis.addClass('hidden');



        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                var table_data = data;



                var tables = '';

                if (table_data.length < 1) {

                    $sis_loading.addClass('hidden');
                    $sis.hide();

                    if (asset != null) {
                        $no_search_found.removeClass('hidden');
                    } else {
                        $no_sis.removeClass('hidden');
                    }



                } else {

                    $sis_loading.addClass('hidden');
                    $sis.show();

                    $.each(table_data, function(index, item) {

                        var row_html = '';

                        row_html += '<tr id="data-row-' + item.sis_id + '" class="data-row">';
                        row_html += '<td class="tag-number">';
                        row_html += '<input class="form-control" type="text" name="tag_number" value="' + item.tag_number + '">';
                        row_html += '</td>';
                        row_html += '<td class="description">';
                        row_html += '<input class="form-control" type="text" name="description" value="' + item.description + '">';
                        row_html += '</td>';
                        row_html += '<td class="code">';
                        row_html += '<input class="form-control" type="text" name="code" value="' + item.code + '">';
                        row_html += '</td>';
                        row_html += '<td class="text-center">';
                        row_html += '<a href="#" class="btn btn-primary edit-sis"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
                        row_html += '<p class="sis-id hidden">' + item.sis_id + '</p>';
                        row_html += '</td>';
                        row_html += '</tr>';

                        $sis_body.append(row_html);

                    });
                }
            }
        });
    }
}

function editSis() {

    var $table_tbody = $('#sis-list tbody');
    var $edit_action = $('a.edit-sis');
    //var $down_edit_modal = $('#edit-criticality-analysis');


    $(document).on('click', 'a.edit-sis', function(e) {

        $table_tbody.html('');

        var $edit_button = $(this);
        var $row_data = $(this).closest('.data-row');
        //var $edit_form = $('#edit-criticality-analysis-form');

        e.preventDefault();
        //$down_edit_modal.modal();
        //var datePicker = $('body').find('.datepicker');
        //$(datePicker).css('z-index', '10000');

        var sis_id = $row_data.find('.sis-id').text();
        var tag_number = $row_data.find('input[name=tag_number]').val();
        var description = $row_data.find('input[name=description]').val();
        var code = $row_data.find('input[name=code]').val();

        token = $('input[name=9s8fjshd324hd98s]').val();

        var function_url = 'sis/update';
        var ajax_url = base_url + function_url;
        var dataString = {
            "sis_id": sis_id,
            "tag_number": tag_number,
            "description": description,
            "code": code,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            success: function(data) {

                //console.log(data);
                //alert(data);

                getSisList();
            }
        });


    });
}


function getCriticalityAnalysisHistoryDailyValues(start_day, end_day, current_month, current_year, asset_role, asset, category, code, last_review_date, category_list, owner_id, get_csv){
    
    //console.log(arguments);

    var $cahd = $('#criticality-analysis-per-day'); //left table
    var $cah = $('#my-criticality-analysis-history'); // right table

    var $nosearch = $('#no-search-found');


    var $cah_loading = $('#loading-criticality-analysis-history');
    var $criticality_analysis_history_loading = $('#loading-criticality-analysis-history_values');

    $('a.glyphicon-arrow-left').addClass('hidden');
    $('a.glyphicon-arrow-right').addClass('hidden');

    if ($cahd.length > 0) {
        
        var $cah_body = $cah.find('tbody'); //left table

        var $cahd_body = $cahd.find('tbody');
        var $cahd_head = $cahd.find('thead');
        var $cahd_date_today = $cahd.find('.date-today');

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();
        var date = new Date();
        var start_day = start_day || null;
        var end_day = end_day || null;
        var month = current_month || null;
        var year = current_year || null;
        var asset = asset || null;
        var category = category || null;
        var code = code || null;
        var last_review_date = last_review_date || null;
        var font_style = "'FontAwesome'";
        var get_csv = get_csv || false;
        var category_list = category_list || null;
        var owner_id = owner_id || null;

        if (start_day == null) {
            start_day = date.getDate();
        }

        if (end_day == null) {
            end_day = date.getDate();
        }

        if (month == null) {
            month = date.getMonth() + 1;
        }

        if (year == null) {
            year = date.getFullYear();
        }

        start_day = parseInt(start_day);
        end_day = parseInt(end_day);
        year = parseInt(year);
        month = parseInt(month);

        //console.log(start_day);
        //var asset = asset || null;
        //var status = status || null;
        //var reference = reference || null;

        //ajax function for specific day
        if (start_day == end_day && month && year) {

            if($nosearch.find('.hidden').length < 1){
                $nosearch.addClass('hidden');
            }
            
            var function_url = 'criticality_analysis/get_criticality_analysis_history_daily';

            var ajax_url = base_url + function_url;

            var dataString = {

                "9s8fjshd324hd98s": token,
                "current_user_id": current_user_id,
                "day": start_day,
                "month": month,
                "year": year,
                "asset": asset,
                "category": category,
                "code": code,
                "last_review_date": last_review_date,
                "category_list": category_list,
                "owner_id": owner_id
                //"asset": 454,
                //"asset_role": 'superuser'
                //"status": status,
                //"reference": reference



            };
            //loading for left table
            $cah_loading.removeClass('hidden');
            $cah.hide();

            $cahd.hide();
            $criticality_analysis_history_loading.removeClass('hidden');

            $.ajax({
                type: 'post',
                url: ajax_url,
                data: dataString,
                dataType: 'json',
                success: function(data) {

                    //console.log(data);
                    $cahd.removeClass('width-2-days');
                    $cahd.removeClass('width-monthly');

                    //alert(data.table_data);

                    var table_data = data.table_data;
                    var table_info = data.table_info;
                    var item_list = data.item_list;

                    $criticality_analysis_history_loading.addClass('hidden');
                    $cahd.show();
                    $cah_body.html('');
                    $cahd_body.html('');
                    $cahd_head.html('');
                    //$table_tbody.html('');
                    $cah_loading.addClass('hidden');


                    var tables = '';

                    if (table_data.length < 1) {
                        $cahd.hide();
                        $cah.hide();
                        $nosearch.removeClass('hidden');

                    } else {

                        //left table

                        $cah_loading.addClass('hidden');
                        $cah.show();
                        $.each(item_list, function(index, item_list) {

                            var row_html = '';

                            row_html += '<tr id="data-row-' + item_list.criticality_analysis_id + '" class="data-row">';
                            row_html += '<td class="asset">';
                            row_html += item_list.asset;
                            row_html += '</td>';
                            row_html += '<td class="tag-number">';
                            row_html += item_list.tag_number;
                            row_html += '</td>';
                            row_html += '<td class="description">';
                            row_html += item_list.description;
                            row_html += '</td>';

                            row_html += '<td class="pce">';
                            row_html += item_list.pce;
                            row_html += '</td>';
                            row_html += '<td class="sce">';
                            row_html += item_list.sce;
                            row_html += '</td>';
                            row_html += '<td class="ece">';
                            row_html += item_list.ece;
                            row_html += '</td>';
                            row_html += '<td class="sis">';
                            row_html += item_list.sis;
                            row_html += '</td>';
                            row_html += '<td class="code">';
                            row_html += item_list.alert;
                            row_html += '</td>';
                            row_html += '<td class="cv">';
                            //get the cv value
                            /*var cv_flag = 0;
                                    $.each(cv_values, function(index, cv) {
                                        if(item.criticality_analysis_id == cv.criticality_analysis_id){
                                            if(cv.day_cv != null){
                                            row_html += cv.day_cv;
                                            }
                                            else{
                                                row_html += '0';
                                            }
                                            cv_flag = 1;
                                            return cv.day_cv;
                                        }
                                        
                                    });
                                    if(cv_flag == 0){
                                        row_html += '0';
                                    }*/
                            row_html += item_list.cv;
                            row_html += '</td>';
                            row_html += '<td class="code">';
                            row_html += '<select name="obs" class="table-select color-select ' + item_list.obs_color + '">' + table_info.criticality_obs_dropdown + '</select>';
                            row_html += '</td>';
                            row_html += '<td class="code">';
                            row_html += item_list.cas;
                            row_html += '</td>';
                            row_html += '<td class="code">';
                            row_html += item_list.hours;
                            row_html += '</td>';
                            row_html += '<td class="code">';
                            row_html += item_list.availability;
                            row_html += '</td>';
                            row_html += '</tr>';

                            $cah_body.append(row_html);

                            var $row_data = $(row_html);
                            var row_id = '#' + $row_data.attr('id') + ' ';

                            var $obs_dropdown = $cah_body.find(row_id + 'select[name=obs]');

                            $obs_dropdown.val(item_list.obs);

                        });
                        //end left table

                        var csv_data = [];

                        var date_today = start_day + '-' + month + '-' + year;

                        var row_day_head = '<tr>';

                        row_day_head += '<th class="text-center" colspan=5>' + date_today + '</th>';
                        row_day_head += '</tr>';
                        row_day_head += '<tr>';
                        row_day_head += '<th class="data-input-row-columns-daily">SPF</th>';
                        row_day_head += '<th class="data-input-row-columns-daily">Avail</th>';
                        row_day_head += '<th class="data-input-status-columns-daily">Status &nbsp;<a class="mini-tooltip status-mini-tooltip" data-toggle="popover"><i class="fa fa-question-circle"></i></a></th>';
                        row_day_head += '<th class="data-input-hour-column-daily">Hours</th>';
                        row_day_head += '<th class="data-input-action-column-daily text-center">Action</th>';
                        row_day_head += '</tr>';

                        $cahd_head.append(row_day_head);

                        $.each(table_data, function(index, item) {

                            //console.log(item.day_status);



                            var row_html = '';

                            row_html += '<tr id="data-row-' + item.criticality_analysis_id + '" class="data-row">';
                            row_html += '<td class="day_spf_' + start_day + '">';
                            row_html += '<div class=""><select name="spf" class="table-select color-select ' + item.day_spf_color + '">' + table_info.criticality_spf_dropdown + '</select></div>'; //spf dropdown here item.day_spf
                            row_html += '</td>';
                            row_html += '<td class="day_availability_' + start_day + '">';
                            row_html += '<div class=""><select name="avail" class="table-select color-select ' + item.day_availability_color + '">' + table_info.criticality_avail_dropdown + '</select></div>'; // availability dropdown here item.day_availability
                            row_html += '</td>';
                            row_html += '<td class="day_status_' + start_day + '">';
                            row_html += '<div class=""><select name="status" style="font-family:lato,' + font_style + '; font-size: 16px;" class="table-select color-select ' + item.day_status_color + '">' + table_info.criticality_status_dropdown + '</select></div>'; //status dropdown here item.day_status
                            row_html += '</td>';
                            row_html += '<td class="day_hours_' + start_day + '">';
                            if (item.day_hours == null || item.day_hours == 'null') {
                                row_html += '<div class=""><input type="text" class="form-control" name="hours" value=""></div>';

                            } else {
                                row_html += '<div class=""><input type="text" class="form-control" name="hours" value="' + item.day_hours + '"></div>';
                            }
                            row_html += '</td>';
                            row_html += '<td class="action text-center">';
                            row_html += '<a href="#" class="btn btn-primary edit-daily-value day-value-' + start_day + '"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
                            row_html += '<p class="sis-id hidden">' + item.criticality_analysis_id + '</p>';
                            row_html += '<p class="button-day hidden">' + start_day + '</p>';
                            row_html += '<p class="button-month hidden">' + month + '</p>';
                            row_html += '<p class="button-year hidden">' + year + '</p>';
                            row_html += '</td>';
                            row_html += '</tr>';

                            $cahd_body.append(row_html);

                            var $row_data = $(row_html);
                            var row_id = '#' + $row_data.attr('id') + ' ';

                            var $spf_dropdown = $cahd_body.find(row_id + 'select[name=spf]');
                            var $avail_dropdown = $cahd_body.find(row_id + 'select[name=avail]');
                            var $status_dropdown = $cahd_body.find(row_id + 'select[name=status]');

                            if (item.day_spf != 0) {
                                $spf_dropdown.val(item.day_spf);
                            }

                            if (item.day_availability != 0) {
                                $avail_dropdown.val(item.day_availability);
                            }
                            if (item.day_status != 0) {
                                $status_dropdown.val(item.day_status);
                            }
                            //console.log(item.day_cv);
                            var left_table_row = $('#criticality-analysis-data-input').find('tr#data-row-' + item.criticality_analysis_id);
                            if (item.day_cv != null) {
                                left_table_row.find('.cv').val(item.day_cv);
                            } else {
                                left_table_row.find('.cv').val(0);
                            }

                            //csv
                            if(get_csv){

                                $.each(item_list, function(index, item_listed) {
                                    if(item_listed.criticality_analysis_id == item.criticality_analysis_id){
                                        csv_data[index] = {
                                            "ASSET": item_listed.asset,
                                            "TAG NUMBER": item_listed.tag_number,
                                            "DESCRIPTION": item_listed.description,
                                            "ALERT": item_listed.alert,
                                            "CV": item_listed.cv,
                                            "OBS": item_listed.obs,
                                            "CAS": item_listed.cas,
                                            "TOTAL HOURS": item_listed.hours,
                                            "AVAILABILITY": item_listed.availability
                                        };
                                        return false;
                                    }   
                                });
                            
                                
                                csv_data[index].SPF = item.day_spf_value;
                                csv_data[index].AVAIL = item.day_availability_value;
                                csv_data[index].STATUS = item.day_status_value;
                                csv_data[index].HOURS = item.day_hours;
                                
                            }

                            
                            

                        });
                        //console.log(csv_data);
                        //JSONtoCSV(csv_data, "criticality_analysis_values", true);
                        if(get_csv){
                        JSONtoCSV(csv_data,"sample",true);
                        }
                    }

                    mini_tooltip();
                    scrollToData("#criticality-analysis-data-input");
                }
            });
        }

        //ajax function for no specified day but month and year is specified
        else if (start_day != end_day && month && year) {

            $cahd.removeClass('width-2-days');
            $cahd.removeClass('width-monthly');

            if($nosearch.find('.hidden').length < 1){
                $nosearch.addClass('hidden');
            }

            start_day = parseInt(start_day);
            end_day = parseInt(end_day);

            //check if date range is less than 3 days
            if (end_day - start_day < 2) {
                $cahd.addClass('width-2-days');
            } else {
                $cahd.addClass('width-monthly');
            }
            var function_url = 'criticality_analysis/get_criticality_analysis_history_monthly';

            var ajax_url = base_url + function_url;

            var dataString = {

                "9s8fjshd324hd98s": token,
                "current_user_id": current_user_id,
                "month": month,
                "start_day": start_day,
                "end_day": end_day,
                "year": year,
                "asset": asset,
                "category": category,
                "code": code,
                "last_review_date": last_review_date,
                "category_list": category_list,
                "owner_id": owner_id
                //"asset": 454,
                //"asset_role": 'superuser'
                //"status": status,
                //"reference": reference



            };

            $cahd.hide();
            $criticality_analysis_history_loading.removeClass('hidden');

            //loading for left table
            $cah_loading.removeClass('hidden');
            $cah.hide();

            $.ajax({
                type: 'post',
                url: ajax_url,
                data: dataString,
                dataType: 'json',
                success: function(data) {


                    //console.log(data);
                    var csv_data = [];

                    $criticality_analysis_history_loading.addClass('hidden');
                    $cahd.show();
                    $cah_body.html('');
                    $cahd_body.html('');
                    $cahd_head.html('');

                    var table_data = data.table_data;
                    var sis_list = data.sis_count;
                    var table_info = data.table_info;
                    var item_list = data.item_list;

                    $cah_loading.addClass('hidden');
                    $cah.show();


                    //left table
                        $.each(item_list, function(index, item_list) {

                            var row_html = '';

                            row_html += '<tr id="data-row-' + item_list.criticality_analysis_id + '" class="data-row">';
                            row_html += '<td class="asset">';
                            row_html += item_list.asset;
                            row_html += '</td>';
                            row_html += '<td class="tag-number">';
                            row_html += item_list.tag_number;
                            row_html += '</td>';
                            row_html += '<td class="description">';
                            row_html += item_list.description;
                            row_html += '</td>';
                            row_html += '<td class="pce">';
                            row_html += item_list.pce;
                            row_html += '</td>';
                            row_html += '<td class="sce">';
                            row_html += item_list.sce;
                            row_html += '</td>';
                            row_html += '<td class="ece">';
                            row_html += item_list.ece;
                            row_html += '</td>';
                            row_html += '<td class="sis">';
                            row_html += item_list.sis;
                            row_html += '</td>';                      
                            row_html += '<td class="code">';
                            row_html += item_list.alert;
                            row_html += '</td>';
                            row_html += '<td class="cv">';
                            //get the cv value
                            /*var cv_flag = 0;
                                    $.each(cv_values, function(index, cv) {
                                        if(item.criticality_analysis_id == cv.criticality_analysis_id){
                                            if(cv.day_cv != null){
                                            row_html += cv.day_cv;
                                            }
                                            else{
                                                row_html += '0';
                                            }
                                            cv_flag = 1;
                                            return cv.day_cv;
                                        }
                                        
                                    });
                                    if(cv_flag == 0){
                                        row_html += '0';
                                    }*/
                            row_html += item_list.cv;
                            row_html += '</td>';
                            row_html += '<td class="code">';
                            row_html += '<select name="obs" class="table-select color-select ' + item_list.obs_color + '">' + table_info.criticality_obs_dropdown + '</select>';
                            row_html += '</td>';
                            row_html += '<td class="code">';
                            row_html += item_list.cas;
                            row_html += '</td>';
                            row_html += '<td class="code">';
                            row_html += item_list.hours;
                            row_html += '</td>';
                            row_html += '<td class="code">';
                            row_html += item_list.availability;
                            row_html += '</td>';
                            row_html += '</tr>';

                            $cah_body.append(row_html);

                            var $row_data = $(row_html);
                            var row_id = '#' + $row_data.attr('id') + ' ';

                            var $obs_dropdown = $cah_body.find(row_id + 'select[name=obs]');

                            $obs_dropdown.val(item_list.obs);

                        });
                    //console.log(data.table_info.criticality_spf_dropdown);

                    var tables = '';

                    if (table_data.length < 1) {
                        $nosearch.removeClass('hidden');
                        $cahd.hide();
                        $cah.hide();


                    } else {

                        

                        if (end_day - start_day > 2) {
                            $('a.glyphicon-arrow-left').removeClass('hidden');
                            $('a.glyphicon-arrow-right').removeClass('hidden');
                        }

                        var row_day_head = '<tr>';

                        var number_of_days = daysInMonth(month, year);

                        for (var i = start_day; i <= end_day; i++) {
                            row_day_head += '<th class="data-input-row-header-column text-center" colspan=5>&nbsp;<span class="">' + i + '-' + month + '-' + year + '</span>&nbsp;</th>';
                        }
                        row_day_head += '</tr>';

                        $cahd_head.append(row_day_head);


                        var row_head = '<tr>';

                        for (var i = start_day; i <= end_day; i++) {
                            row_head += '<th class="data-input-row-columns">SPF</th>';
                            row_head += '<th class="data-input-row-columns">Avail</th>';
                            row_head += '<th class="data-input-row-columns">Status <a class="mini-tooltip status-mini-tooltip" data-toggle="popover"><i class="fa fa-question-circle"></i></a></th>';
                            row_head += '<th class="data-input-row-columns">Hours</th>';
                            row_head += '<th class="data-input-action-column text-center">Action</th>';
                        }

                        row_head += '</tr>';

                        $cahd_head.append(row_head);

                        $.each(sis_list, function(index, sis_item) {

                            var current_index = index;
                            //console.log(sis_item.sis_id);
                            //csv
                            if(get_csv){
                                $.each(item_list, function(index, item_listed) {
                                    if(item_listed.criticality_analysis_id == sis_item.sis_id){
                                        csv_data[index] = {
                                            "ASSET": item_listed.asset,
                                            "TAG NUMBER": item_listed.tag_number,
                                            "DESCRIPTION": item_listed.description,
                                            "ALERT": item_listed.alert,
                                            "CV": item_listed.cv,
                                            "OBS": item_listed.obs,
                                            "CAS": item_listed.cas,
                                            "TOTAL HOURS": item_listed.hours,
                                            "AVAILABILITY": item_listed.availability
                                        };
                                        return false;
                                    }   
                                });
                            }


                            var row_html = '';

                            row_html += '<tr id="data-row-' + sis_item.sis_id + '" class="data-row">';

                            var daily_value = [];

                            for (var a = 0; a < start_day; a++) {
                                daily_value.push('none');
                            }



                            for (var i = start_day; i <= end_day; i++) {

                                var check = 0;
                                var current_month = '';
                                var current_year = '';

                                $.each(table_data, function(index, item) {

                                    if (item.month) {
                                        current_month = item.month;
                                    }
                                    if (item.year) {
                                        current_year = item.year;
                                    }


                                    //console.log(sis_item.sis_id);


                                    if (item.day == i && item.criticality_analysis_id == sis_item.sis_id) {

                                        row_html += '<td class="day_spf_' + i + '">';
                                        if (item.day) {
                                            row_html += '<div class=""><select name="spf" class="table-select select-monthly color-select ' + item.day_spf_color + '">' + table_info.criticality_spf_dropdown + '</select></div>'; //spf dropdown here item.day_spf
                                        } else {
                                            row_html += '<div class=""><select name="spf" class="table-select select-monthly color-select bg-white">' + table_info.criticality_spf_dropdown + '</select></div>'; //no value on spf
                                        }
                                        row_html += '</td>';
                                        row_html += '<td class="day_availability_' + i + '">';
                                        if (item.day_availability) {
                                            row_html += '<div class=""><select name="avail" class="table-select select-monthly color-select ' + item.day_availability_color + '">' + table_info.criticality_avail_dropdown + '</select></div>'; // availability dropdown here item.day_availability

                                        } else {
                                            row_html += '<div class=""><select name="avail" class="table-select select-monthly color-select bg-white">' + table_info.criticality_avail_dropdown + '</select></div>'; //no value on availability
                                        }
                                        row_html += '</td>';
                                        row_html += '<td class="day_status_' + i + '">';
                                        if (item.day_status) {
                                            row_html += '<div class=""><select name="status"  style="font-family:lato,' + font_style + '; font-size: 16px;" class="table-select select-monthly color-select ' + item.day_status_color + '">' + table_info.criticality_status_dropdown + '</select></div>'; //status dropdown here item.day_status
                                        } else {
                                            row_html += '<div class=""><select name="status"  style="font-family:lato,' + font_style + '; font-size: 16px;" class="table-select select-monthly color-select bg-white">' + table_info.criticality_status_dropdown + '</select></div>'; //no value on status
                                        }
                                        row_html += '</td>';
                                        row_html += '<td class="day_hours_' + i + '">';
                                        if (item.day_hours) {
                                            row_html += '<div class=""><input type="text" class="form-control input-monthly" name="hours" value="' + item.day_hours + '"></div>';
                                        } else {
                                            row_html += '<div class=""><input type="text" class="form-control input-monthly" name="hours" value=""></div>';
                                        }
                                        row_html += '</td>';
                                        row_html += '<td class="action text-center">';
                                        row_html += '<a href="#" class="btn btn-primary edit-daily-value day-value' + i + '"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
                                        row_html += '<p class="sis-id hidden">' + sis_item.sis_id + '</p>';
                                        row_html += '<p class="button-day hidden">' + item.day + '</p>';
                                        row_html += '<p class="button-month hidden">' + item.month + '</p>';
                                        row_html += '<p class="button-year hidden">' + item.year + '</p>';
                                        row_html += '</td>';

                                        check = 1;

                                        var $row_data = $(row_html);
                                        var row_id = '#' + $row_data.attr('id') + ' ';

                                        var $spf_dropdown = $cahd_body.find(row_id + 'select[name=spf]');
                                        var $avail_dropdown = $cahd_body.find(row_id + 'select[name=avail]');
                                        var $status_dropdown = $cahd_body.find(row_id + 'select[name=status]');

                                        //check if object has values


                                        var day_object = {
                                            spf: item.day_spf,
                                            avail: item.day_availability,
                                            status: item.day_status
                                        };

                                        daily_value.push(day_object);

                                        //csv
                                        if(get_csv){
                                            csv_data[current_index]['SPF '+i] = item.day_spf_value;
                                            csv_data[current_index]['AVAIL '+i] = item.day_availability_value;
                                            csv_data[current_index]['STATUS '+i] = item.day_status_value;
                                            csv_data[current_index]['HOURS '+i] = item.day_hours;
                                        }

                                        return false;

                                    }

                                });

                                if (check == 0) {
                                    row_html += '<td class="day_spf_' + i + '">';
                                    row_html += '<div class=""><select name="spf" class="table-select select-monthly color-select bg-white">' + table_info.criticality_spf_dropdown + '</select></div>'; //spf dropdown here item.day_spf
                                    row_html += '</td>';
                                    row_html += '<td class="day_availability_' + i + '">';
                                    row_html += '<div class=""><select name="avail" class="table-select select-monthly color-select bg-white">' + table_info.criticality_avail_dropdown + '</select></div>'; // availability dropdown here item.day_availability
                                    row_html += '</td>';
                                    row_html += '<td class="day_status_' + i + '">';
                                    row_html += '<div class=""><select name="status"  style="font-family:lato,' + font_style + '; font-size: 16px;" class="table-select select-monthly color-select bg-white">' + table_info.criticality_status_dropdown + '</select></div>'; //status dropdown here item.day_status
                                    row_html += '</td>';
                                    row_html += '<td class="day_hours_' + i + '">';
                                    row_html += '<div class=""><input type="text" class="form-control input-monthly" name="hours" value=""></div>';
                                    row_html += '</td>';
                                    row_html += '<td class="action text-center">';
                                    row_html += '<a href="#" class="btn btn-primary edit-daily-value day-value-' + i + '"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
                                    row_html += '<p class="sis-id hidden">' + sis_item.sis_id + '</p>';
                                    row_html += '<p class="button-day hidden">' + i + '</p>';
                                    row_html += '<p class="button-month hidden">' + month + '</p>';
                                    row_html += '<p class="button-year hidden">' + year + '</p>';
                                    row_html += '</td>';

                                    var day_object = "none";
                                    daily_value.push(day_object);

                                    //csv
                                    if(get_csv){
                                        csv_data[current_index]['SPF '+i] = ' ';
                                        csv_data[current_index]['AVAIL '+i] = ' ';
                                        csv_data[current_index]['STATUS '+i] = ' ';
                                        csv_data[current_index]['HOURS '+i] = ' ';
                                    }
                                }



                            }

                            row_html += '</tr>';

                            $cahd_body.append(row_html);

                            //console.log(daily_value);

                            for (var i = start_day; i <= end_day; i++) {

                                /*var $avail_dropdown = $cahd_body.find(row_id+'select[name=avail]');
                                var $status_dropdown = $cahd_body.find(row_id+'select[name=status]');*/

                                /*var $spf_value = $current_day.find('.button-spf').text();
                                var $avail_value = $current_day.find('.button-avail').text();
                                var $status_value = $current_day.find('.button-status').text();
                                var $hours_value = $current_day.find('.button-hours').text();*/

                                //check if object has value

                                var default_select = '--';

                                if (daily_value[i] != 'none') {
                                    var $row_data = $(row_html);
                                    var row_id = '#' + $row_data.attr('id') + ' ';

                                    var $spf_dropdown = $cahd_body.find(row_id + '> .day_spf_' + i + ' select[name=spf]');
                                    var $avail_dropdown = $cahd_body.find(row_id + '> .day_availability_' + i + ' select[name=avail]');
                                    var $status_dropdown = $cahd_body.find(row_id + '> .day_status_' + i + ' select[name=status]');

                                    if (daily_value[i].spf != 0) {
                                        $spf_dropdown.val(daily_value[i].spf);
                                    }
                                    if (daily_value[i].avail != 0) {
                                        $avail_dropdown.val(daily_value[i].avail);
                                    }
                                    if (daily_value[i].status != 0) {
                                        $status_dropdown.val(daily_value[i].status);
                                    }
                                }


                            }

                            //increment progress bar
                            //incrementProgressBar(14);



                        });

                        if(get_csv){
                        JSONtoCSV(csv_data,"sample",true);
                        }
                    }

                    mini_tooltip();
                    scrollToData("#criticality-analysis-data-input");
                }
            });
        }

    }
}

function filter_criticality_analysis_values() {

    var $filter_form = $('#filter-criticality-analysis-history-form');

    $filter_form.submit(function(e) {

        e.preventDefault();

        $criticality_analysis_history = $('#my-criticality-analysis-history');
        $compliance_dashboard = $('#compliance-dashboard');

        var start_date = $filter_form.find('input[name=start_date]').val();


        //check if start_date has value
        if (start_date == '') {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth() + 1; //January is 0!
            var yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }

            today = dd + '/' + mm + '/' + yyyy; //date format
            $filter_form.find('input[name=start_date]').val(today);
            enableEndDateRange(today);
            $filter_form.find('input[name=end_date]').val(today);

        }

        var end_date = $filter_form.find('input[name=end_date]').val();

        var split_date = start_date.split('/');
        var split_end_date;


        var month = split_date[1];
        var start_day = split_date[0];
        var end_day;

        if (end_date == '') {
            end_day = split_date[0];
            $filter_form.find('input[name=end_date]').val(start_date);

        } else {
            split_end_date = end_date.split('/');
            end_day = split_end_date[0];
        }

        var year = split_date[2];

        var asset_role = null;
        var asset = $filter_form.find('select[name=asset]').val();
        var code = $filter_form.find('input[name=equipment_code]').val();
        var category = $filter_form.find('select[name=category]').val();
        var last_review_date = $filter_form.find('select[name=filter_last_review_date]').val();
        var owner = $filter_form.find('select[name=filter_owner]').val();
        var category_checked = $filter_form.find("input:checked[name='filter_category[]']");

        var number_of_days = daysInMonth(month, year);

        if(category_checked.length > 0){
            var filter_category = [];
            category_checked.each(function(index) {
                filter_category.push($(this).val());
            });
        }
        else{
            filter_category = null;
        }

        //to do: other filters
        if ($criticality_analysis_history.length > 0) {
            //getCriticalityAnalysisHistory(asset_role, asset, category, code, last_review_date, start_day, end_day, month, year);

            getCriticalityAnalysisHistoryDailyValues(start_day, end_day, month, year, asset_role, asset, category, code, last_review_date, filter_category, owner);


        } else if ($compliance_dashboard.length > 0) {
            $compliance_dashboard.find('tbody').html('');
            user_compliance_dashboard(asset, category, code, last_review_date, owner);
        }
        //incrementProgressBar(10);
    });
}

function editCriticalityAnalysisHistoryValues() {

    var $table = $('#criticality-analysis-per-day');
    var $edit_action = $('a.edit-daily-value');



    $(document).on('click', 'a.edit-daily-value', function(e) {


        var $edit_button = $(this);
        var $row_data = $(this).closest('.data-row');
        var $a = $(this).parent();
        var $day = $a.find('.button-day').text();
        var $month = $a.find('.button-month').text();
        var $year = $a.find('.button-year').text();
        var criticality_analysis_id = $a.find('.sis-id').text();

        var spf_value = $row_data.find('.day_spf_' + $day + ' > div > select[name=spf]').val();
        var avail_value = $row_data.find('.day_availability_' + $day + ' > div > select[name=avail]').val();
        var status_value = $row_data.find('.day_status_' + $day + ' > div > select[name=status]').val();
        var hours_value = $row_data.find('.day_hours_' + $day + ' > div > input[name=hours]').val();


        /*console.log(spf_value);
        console.log(avail_value);
        console.log(status_value);
        console.log(hours_value);
        console.log(criticality_analysis_id);    */

        e.preventDefault();

        token = $('input[name=9s8fjshd324hd98s]').val();

        var function_url = 'criticality-analysis/update_single_criticality_analysis_history_values';
        var ajax_url = base_url + function_url;
        var dataString = {
            "criticality_analysis_id": criticality_analysis_id,
            //"asset": asset,
            "day_spf": spf_value,
            "day_availability": avail_value,
            "day_status": status_value,
            "hours": hours_value,
            "day": $day,
            "month": $month,
            "year": $year,
            //"day_obs":,
            "9s8fjshd324hd98s": token
        };

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                //console.log(data);
                //alert(data);

                var $filter_form = $('#filter-criticality-analysis-history-form');

                var start_date = $filter_form.find('input[name=start_date]').val();


                //check if start_date has value
                if (start_date == '') {
                    var today = new Date();
                    var dd = today.getDate();
                    var mm = today.getMonth() + 1; //January is 0!
                    var yyyy = today.getFullYear();

                    if (dd < 10) {
                        dd = '0' + dd;
                    }

                    if (mm < 10) {
                        mm = '0' + mm;
                    }

                    today = dd + '/' + mm + '/' + yyyy; //date format
                    $filter_form.find('input[name=start_date]').val(today);
                    enableEndDateRange(today);
                    $filter_form.find('input[name=end_date]').val(today);

                }

                var end_date = $filter_form.find('input[name=end_date]').val();

                var split_date = start_date.split('/');
                var split_end_date;


                var month = split_date[1];
                var start_day = split_date[0];
                var end_day;

                if (end_date == '') {
                    end_day = split_date[0];
                    $filter_form.find('input[name=end_date]').val(start_date);

                } else {
                    split_end_date = end_date.split('/');
                    end_day = split_end_date[0];
                }

                var year = split_date[2];

                var asset_role = null;
                var asset = $filter_form.find('select[name=asset]').val();
                var code = $filter_form.find('input[name=equipment_code]').val();
                var category = $filter_form.find('select[name=category]').val();
                var last_review_date = $filter_form.find('select[name=filter_last_review_date]').val();
                var category_checked = $filter_form.find("input:checked[name='filter_category[]']");
                var owner = $filter_form.find('select[name=filter_owner]').val();

                if(category_checked.length > 0){
                    var filter_category = [];
                    category_checked.each(function(index) {
                        filter_category.push($(this).val());
                    });
                }
                else{
                    filter_category = null;
                }

                var number_of_days = daysInMonth(month, year);

                if (start_day > number_of_days) {
                    start_day = number_of_days;
                    $filter_form.find('select[name=start_day]').val(number_of_days);
                }

                if (end_day > number_of_days) {
                    end_day = number_of_days;
                    $filter_form.find('select[name=end_day]').val(number_of_days);
                }

                console.log(start_day);

                //to do: other filters
                //getCriticalityAnalysisHistory(asset_role, asset, category, code, last_review_date, start_day, end_day, month, year);

                getCriticalityAnalysisHistoryDailyValues(start_day, end_day, month, year, asset_role, asset, category, code, last_review_date, filter_category, owner);
                update_json_view('criticality_analysis');
                update_json_view('criticality_analysis_compliance','compliance');


            }
        });


    });
}

function user_criticality_analysis_scoring() {

    var $table_container = $('#criticality-analysis-scoring');
    var $table_body = $table_container.find('tbody');

    if ($table_container.length > 0) {

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();

        var function_url = 'criticality-analysis/get_menu_edit';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "menu_type": 'criticality_score'
        };

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                //console.log(data);

                var table_data = data.table_data;
                var table_info = data.table_info;
                var user_info = data.user_info;

                var session_asset_role = user_info.asset_role;
                var session_site_role = user_info.site_role;

                if (session_asset_role != 'superuser') {
                    $('th.action').remove();
                }

                var tables = '';

                if (table_data.length < 1) {

                    //$criticality_analysis_loading.addClass('hidden');
                    //$criticality_analysis.hide();

                } else {

                    //console.log(table_data);

                    //$criticality_analysis_loading.addClass('hidden');
                    //$criticality_analysis.show();

                    $.each(table_data, function(index, item) {

                        var row_html = '';

                        row_html += '<tr id="data-row-' + item.menu_id + '" class="data-row">';

                        row_html += '<td class="name">';
                        row_html += item.name;
                        row_html += '</td>';
                        row_html += '<td class="description">';
                        if (session_asset_role == 'superuser') {
                            row_html += '<select name="description" class="form-control">';
                            row_html += table_info.frequency;
                            row_html += '</select>';
                        } else {
                            row_html += item.description;
                        }
                        row_html += '</td>';
                        row_html += '<td class="text-center ';

                        if (session_asset_role != 'superuser') {
                            row_html += 'hidden';
                        }

                        row_html += ' ">';
                        if (session_asset_role == 'superuser') {
                            row_html += '<a href="#" class="btn btn-primary edit-menu"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
                        }
                        row_html += '<p class="menu-id hidden">' + item.menu_id + '</p>';
                        row_html += '<p class="value hidden">' + item.value + '</p>';
                        row_html += '<p class="code hidden">' + item.code + '</p>';
                        row_html += '<p class="color-class hidden">' + item.color_class + '</p>';
                        row_html += '<p class="menu-category-id hidden">' + item.menu_category_id + '</p>';
                        row_html += '</td>';

                        row_html += '</tr>';

                        $table_body.append(row_html);

                        var $row_data = $(row_html);
                        var row_id = '#' + $row_data.attr('id') + ' ';

                        var $description_dropdown = $table_body.find(row_id + 'select[name=description]');

                        $description_dropdown.val(item.description);

                    });
                }
            }
        });
    }
}

function user_criticality(table_name, menu_type, sub_title, show_secondary_description, disable_name) {

    var $table_container = $('#' + table_name);
    var $table_body = $table_container.find('tbody');

    var sub_title = sub_title || '';
    var show_secondary_description = show_secondary_description || false;
    var disable_name = disable_name || false;

    if ($table_container.length > 0) {

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();

        var function_url = 'criticality-analysis/get_menu_edit';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "menu_type": menu_type
        };

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',

            success: function(data) {

                //console.log(data);

                var table_data = data.table_data;
                var table_info = data.table_info;
                var user_info = data.user_info;

                var session_asset_role = user_info.asset_role;
                var session_site_role = user_info.site_role;

                if (session_asset_role != 'superuser') {
                    $('th.action').remove();
                }

                var tables = '';

                if (table_data.length < 1) {

                    //$criticality_analysis_loading.addClass('hidden');
                    //$criticality_analysis.hide();

                } else {

                    //console.log(table_data);

                    //$criticality_analysis_loading.addClass('hidden');
                    //$criticality_analysis.show();

                    $.each(table_data, function(index, item) {

                        var row_html = '';

                        row_html += '<tr id="data-row-' + item.menu_id + '" class="data-row">';

                        if (index == 0) {
                            row_html += '<td rowspan="' + table_data.length + '">' + sub_title + '</td>';
                        }
                        row_html += '<td class="value" align="center">';
                        if (session_asset_role == 'superuser') {
                            row_html += '<input type="text" name="value" value="' + item.value + '" class="form-control decimal-only">';
                        } else {
                            row_html += item.value;
                        }
                        row_html += '</td>';

                        row_html += '<td class="option-name">';
                        if (session_asset_role == 'superuser') {
                            if (disable_name && session_site_role != 'siteadmin') {
                                row_html += '<input type="text" name="option_name" value="' + item.name + '" class="form-control" disabled>';
                            } else {
                                row_html += '<input type="text" name="option_name" value="' + item.name + '" class="form-control">';
                            }

                        } else {
                            row_html += item.name;
                        }
                        row_html += '</td>';

                        row_html += '<td class="description">';
                        if (session_asset_role == 'superuser') {
                            row_html += '<input type="text" name="description" value="' + item.description + '" class="form-control">';
                            if (show_secondary_description) {
                                row_html += '<input type="text" name="secondary_description" value="' + item.secondary_description + '" class="form-control">';
                            }
                        } else {
                            row_html += item.description;
                        }
                        row_html += '</td>';



                        row_html += '<td class="text-center ';

                        if (session_asset_role != 'superuser') {
                            row_html += 'hidden';
                        }

                        row_html += ' ">';
                        if (session_asset_role == 'superuser') {
                            row_html += '<a href="#" class="btn btn-primary edit-menu"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
                        }
                        row_html += '<p class="menu-id hidden">' + item.menu_id + '</p>';
                        row_html += '<p class="value hidden">' + item.value + '</p>';
                        row_html += '<p class="code hidden">' + item.code + '</p>';
                        row_html += '<p class="color-class hidden">' + item.color_class + '</p>';
                        row_html += '<p class="menu-category-id hidden">' + item.menu_category_id + '</p>';
                        row_html += '</td>';

                        row_html += '</tr>';

                        $table_body.append(row_html);

                        /*var $row_data = $(row_html);
                        var row_id = '#'+$row_data.attr('id')+' ';

                        var $description_dropdown = $table_body.find(row_id+'select[name=description]');

                        $description_dropdown.val(item.description);*/

                    });
                }
            }
        });
    }
}

function update_user_criticality() {

    var $page_container = $('#criticality-criteria');
    var update_secondary_description = update_secondary_description || false;
    var update_name = update_name || false;

    if ($page_container.length > 0) {

        $(document).on('click', '.edit-menu', function(e) {

            e.preventDefault();

            var $edit_button = $(this);

            var $edit_button_container = $edit_button.closest('.data-row');

            var value = $edit_button_container.find('.value input[name=value]').val();
            var description = $edit_button_container.find('.description input[name=description]').val();

            var $secondary_description = $edit_button_container.find('.description input[name=secondary_description]');
            var $name_field = $edit_button_container.find('.option-name input[name=option_name]');

            if ($secondary_description.length > 0) {
                var secondary_description_value = $secondary_description.val();
            } else {
                var secondary_description_value = null;
            }

            if ($name_field.length > 0) {
                var name_value = $name_field.val();
            } else {
                var name_value = null;
            }
            //console.log(name_value);
            //console.log(value);

            var menu_id_value = $edit_button_container.find('.menu-id').text();
            var menu_category_id_value = $edit_button_container.find('.menu-category-id').text();

            var token = $('input[name=9s8fjshd324hd98s]').val();
            var current_user_id = $('input[name=current_user_id]').val();

            var function_url = 'criticality-analysis/update_criticality_criteria';

            var ajax_url = base_url + function_url;



            var dataString = {

                "9s8fjshd324hd98s": token,
                "current_user_id": current_user_id,

                "id": menu_id_value,
                "menu_category_id": menu_category_id_value,
                "name": name_value,
                "value": value,
                "description": description,
                "secondary_description": secondary_description_value,
                "color_class": null,
                "code": null,
                "order": null,
                "level": null

            };

            console.log(dataString);

            $.ajax({
                type: 'post',
                url: ajax_url,
                data: dataString,

                success: function(data) {
                    //addAlert('Success');
                    gritter();
                },

                error: function(data) {

                    console.log(data.responseText);
                }
            });

        });

    }
}

function gritter() {
    //$('.edit-menu').on('click', function(){
    $.gritter.add({
        //title: 'Success!',
        text: 'Updated Successfully',
        sticky: false,
        time: '1000',
        class_name: 'alert alert-success',
        fade_out_speed: 500,
        fade_in_speed: "medium"
    });

    //return false;
    //});
}

function edit_criticality_score() {

    var $page_container = $('#criticality-criteria');

    if ($page_container.length > 0) {

        $(document).on('click', '.edit-menu', function(e) {

            e.preventDefault();

            var $edit_button = $(this);

            var $edit_button_container = $edit_button.closest('.data-row');

            var description_value = $edit_button_container.find('.description select').val();
            var menu_id_value = $edit_button_container.find('.menu-id').text();
            var menu_category_id_value = $edit_button_container.find('.menu-category-id').text();

            var token = $('input[name=9s8fjshd324hd98s]').val();
            var current_user_id = $('input[name=current_user_id]').val();

            var function_url = 'criticality-analysis/update_criticality_criteria';

            var ajax_url = base_url + function_url;

            var dataString = {

                "9s8fjshd324hd98s": token,
                "current_user_id": current_user_id,

                "id": menu_id_value,
                "menu_category_id": menu_category_id_value,
                "name": null,
                "value": null,
                "description": description_value,
                "secondary_description": null,
                "color_class": null,
                "code": null,
                "order": null,
                "level": null

            };

            $.ajax({
                type: 'post',
                url: ajax_url,
                data: dataString,
                error: function(data) {
                    console.log(data.responseText);
                }
            });

        });

    }
}

function button_scroll() {
    $(document).on('click', 'a.glyphicon-arrow-right', function(e) {
        e.preventDefault();
        var pos = $('#criticality-analysis-per-day').scrollLeft();
        var extra_value = 0;
        var pos_value = pos % 1071;
        if (pos_value != 0) {
            extra_value = 1071 - pos_value;
        }

        $('#criticality-analysis-per-day').animate({
            scrollLeft: pos + 1071 + extra_value
        }, 300);
        //$("span").text(x += 1);
    });
    $(document).on('click', 'a.glyphicon-arrow-left', function(e) {
        e.preventDefault();
        var pos = $('#criticality-analysis-per-day').scrollLeft();
        var extra_value = 0;
        var pos_value = pos % 1071;
        if (pos_value != 0) {
            extra_value = 1071 - pos_value;
        }
        $('#criticality-analysis-per-day').animate({
            scrollLeft: pos - 1071 + extra_value
        }, 300);
        //$("span").text(x += 1);
    });
}

function incrementProgressBar(increment) {
    var parent = $('#data-input-values-progress-bar').parent('.progress');
    var parent_width = parseInt(parent.css('width'));
    var bar_width = $('#data-input-values-progress-bar').css('width');
    var width = parseInt(bar_width);
    var percent = (100 * width / parent_width);
    var new_width = percent + increment;
    $('#data-input-values-progress-bar').css('width', new_width + '%');
    //console.log(parent_width);
    //console.log(width);
    //console.log(percent);
    //console.log(increment);
}

//get number of days in a month
function daysInMonth(month, year) {
    return new Date(year, month, 0).getDate();
}

function dateRange() {
    $('input#start_date_range').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    }).on('changeDate', function(e) {
        $('input#end_date_range').datepicker('remove');
        $('input#end_date_range').val('');
        var start_day = $(this).val();
        //console.log(start_day);
        enableEndDateRange(start_day)
    });
}

function enableEndDateRange(start_day) {

    if (start_day != null) {

        if (start_day != null || start_day != '') {
            var split_date = start_day.split("/");
            var max_day = daysInMonth(split_date[1], split_date[2]);
            var end_day = max_day + '/' + split_date[1] + '/' + split_date[2];

            $('input#end_date_range').datepicker({
                format: 'dd/mm/yyyy',
                startDate: start_day,
                endDate: end_day,
                autoclose: true
            });
        }

    }
}

function mini_tooltip() {
    
    $('.add-subaction-tracker-tooltip').popover('destroy');
    $('.add-subaction-tracker-tooltip').popover({
        'trigger': 'hover',
        'placement': 'left',
        'html': true,
        'content': '<p>Add a subaction</p>'
    });

    //failure-rate
    $('.lambda-failure-rate-tooltip').popover('destroy');
    $('.lambda-failure-rate-tooltip').popover({
        'trigger': 'click focus',
        'placement': 'top',
        'html': true,
        'content': '<p>Lambda "Failure Rate"</p>'
    });

    $('.mttr-failure-rate-tooltip').popover('destroy');
    $('.mttr-failure-rate-tooltip').popover({
        'trigger': 'click focus',
        'placement': 'top',
        'html': true,
        'content': '<p>MTTR "Mean Time To Repair"</p>'
    });

    $('.mtbf-failure-rate-tooltip').popover('destroy');
    $('.mtbf-failure-rate-tooltip').popover({
        'trigger': 'click focus',
        'placement': 'top',
        'html': true,
        'content': '<p>MTBF "Mean Time Between Failure"</p>'
    });

    //status
    $('.status-mini-tooltip').popover('destroy');
    $('.status-mini-tooltip').popover({
        'trigger': 'click focus',
        'placement': 'right',
        'title': '<div class="text-center" id="status-popover"><strong>Status</strong></div>',
        'html': true,
        'content': '<div class="row"><div class="col-sm-1"><i class="fa fa-check"></i></div><div class="col-sm-1"> - </div><div class="col-sm-6 bg-green">OK</div></div><div class="row"><div class="col-sm-1"><i class="fa fa-question"></i></div><div class="col-sm-1"> - </div><div class="col-sm-6 bg-yellow">Alert</div></div><div class="row"><div class="col-sm-1"><i class="fa fa-exclamation"></i></div><div class="col-sm-1"> - </div><div class="col-sm-6 bg-orange">Warning</div></div><div class="row"><div class="col-sm-1"><i class="fa fa-times"></i></div><div class="col-sm-1"> - </div><div class="col-sm-6 bg-red">Critical</div></div><div class="row"><div class="col-sm-1"><i class="fa fa-times-circle"></i></div><div class="col-sm-1"> - </div><div class="col-sm-6 bg-dark-red">Fail</div></div><div class="row"><div class="col-sm-1"><i class="fa fa-question-circle"></i></div><div class="col-sm-1"> - </div><div class="col-sm-6 bg-dark-green">In Prog</div></div>'
    });

    //owner
    $('.owner-mini-tooltip').popover('destroy');
    $('.owner-mini-tooltip').popover({
        'trigger': 'click focus',
        'placement': 'top',
        'html': true,
        'content': 'Select an owner'
    });

    //decf
    $('.decf-mini-tooltip').popover('destroy');
    $('.decf-mini-tooltip').popover({
        'trigger': 'click focus',
        'placement': 'top',
        'html': true,
        'content': '<div id="decf-popover">Has a Defect Elimination commenced</div>'
    });

    //pp
    $('.pp-mini-tooltip').popover('destroy');
    $('.pp-mini-tooltip').popover({
        'trigger': 'click focus',
        'placement': 'top',
        'html': true,
        'content': '<div id="decf-popover">Has a Project Plan commenced</div>'
    });

    //tb
    $('.tb-mini-tooltip').popover('destroy');
    $('.tb-mini-tooltip').popover({
        'trigger': 'click focus',
        'placement': 'top',
        'html': true,
        'content': '<div id="decf-popover">Has a Technical Bulletin been published</div>'
    });

    //action tracker 
        //create tooltip
    $('.create-action').popover('destroy');
    $('.create-action').popover({
        'trigger': 'hover',
        'placement': 'bottom',
        'delay': { "show": 500, "hide": 100 },
        'html': true,
        'content': '<div id="">Add a related action</div>'
    });

    //add empty tooltip
    $('button.add-action-tracker-row').popover('destroy');
    $('button.add-action-tracker-row').popover({
        'trigger': 'hover',
        'placement': 'left',
        'delay': { "show": 500, "hide": 100 },
        'html': true,
        'content': '<div id="">Add a blank action</div>'
    });

    $('.show-hide-mini-tooltip').popover('destroy');
    $('.show-hide-mini-tooltip').popover({
        'trigger': 'hover',
        'placement': 'top',
        'delay': { "show": 500, "hide": 100 },
        'html': true,
        'content': '<div id="">Show/Hide more equipment details</div>'
    });

    

    $('body').on('click', function(e) {
        $('[data-toggle="popover"]').each(function() {
            //the 'is' for buttons that trigger popups
            //the 'has' for icons within a button that triggers a popup
            if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
                $(this).popover('hide');
            }
        });
    });
}

function JSONtoCSV(JSONData, ReportTitle, ShowLabel) {

    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
    var CSV = '';
    //This condition will generate the Label/Header
    if (ShowLabel) {
        var row = "";

        //This loop will extract the label from 1st index of on array
        for (var index in arrData[0]) {
            //Now convert each value to string and comma-seprated
            row += index + ',';
        }
        row = row.slice(0, -1);
        //append Label row with line break
        CSV += row + '\r\n';
    }

    //1st loop is to extract each row
    for (var i = 0; i < arrData.length; i++) {
        var row = "";
        //2nd loop will extract each column and convert it in string comma-seprated
        for (var index in arrData[i]) {
            row += '"' + arrData[i][index] + '",';
        }
        row.slice(0, row.length - 1);
        //add a line break after each row
        CSV += row + '\r\n';
    }

    if (CSV == '') {
        alert("Invalid data");
        return;
    }

    //this trick will generate a temp "a" tag
    var link = document.createElement("a");
    link.id = "lnkDwnldLnk";

    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);

    var csv = CSV;
    blob = new Blob([csv], {
        type: 'text/csv'
    });
    var csvUrl = window.webkitURL.createObjectURL(blob);
    var filename = ReportTitle + '.csv';
    $("#lnkDwnldLnk")
        .attr({
            'download': filename,
            'href': csvUrl
        });

    $('#lnkDwnldLnk')[0].click();
    document.body.removeChild(link);
}

function moreComments(){

    var more_comments_selector = '#more-comments';

    $(document).on('click', more_comments_selector, function(e){

        e.preventDefault();

        var $more_comments = $(this);

        var offset = $more_comments.data('offset');

        documentComments(offset);

    });
}


function scrollToData(data_view_selector){
    $('html, body').animate({
        scrollTop: $(data_view_selector).offset().top
    }, 1000);
}


function documentComments(offset, limit){

    var $comments_section = $('#single-document-comments');
    var $more_comments = $('#more-comments');

    if($comments_section.length > 0){

        var $loading = $('#loading');
        var $no_search = $('#no-search-found');

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();
        var document_id = $('input[name=document_id]').val();

        var limit = limit || 3;
        var offset = offset || 0;
        
        var function_url = 'document_ranking/get_ranking_details';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "document_id": document_id,
            "limit": limit,
            "offset": offset

        };

        
        $loading.removeClass('hidden');

        $no_search.addClass('hidden');
        

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                console.log(data);

                var table_data = data.table_data;
                var table_info = data.table_info;
                var user_info = data.user_info;

                var session_user_id = user_info.current_user_id;
                var session_asset_role = user_info.session_asset_role;
                var session_site_role = user_info.session_site_role;

                var uploads_folder = base_url + 'uploads/';

                var document_id = table_info.document_id;

                    var tables = '';

                    if (table_data.length < 1) {

                        $loading.addClass('hidden');
                        $no_search.removeClass('hidden');

                    } else {

                        $loading.addClass('hidden');
                        $no_search.addClass('hidden');

                        var new_offset = offset+limit;
                        var record_count = table_info.count;

                        if(new_offset <= record_count ){
                            $more_comments.attr('data-offset', new_offset);
                        }else{
                            $more_comments.hide();
                        }                        

                        $.each(table_data, function(index, item) {

                            var row_html = '';

                            row_html += '<li class="list-group-item comment-item">';

                                row_html += '<div class="row">';
                                    row_html += '<div class="col-xs-2">';
                                        row_html += '<img src="'+item.user_image_path+'" class="img-circle img-responsive user-img" alt="" />';
                                    row_html += '</div>';
                                    row_html += '<div class="col-xs-10 col-md-10">';
                                        row_html += '<div class="comment-body">';
                                            row_html += '<p class="strong">'+item.ranking_comment+'</p>';
                                            row_html += '<div class="mic-info">';
                                                row_html += 'By: <a href="#">'+item.full_name+'</a> on '+item.ranking_date;
                                            row_html += '</div>';
                                        row_html += '</div>';
                                    row_html += '</div>';
                                row_html += '</div>';
                            row_html += '</li>';

                            $comments_section.append(row_html);

                            //select_with_search();

                            /*var $row_data = $(row_html);
                            var row_id = '#' + $row_data.attr('id') + ' ';

                            var $owner_dropdown = $criticality_analysis_body.find(row_id + 'select[name=owner]');
                            var $defect_elimination_dropdown = $criticality_analysis_body.find(row_id + 'select[name=defect_elimination]');
                            var $project_plan_dropdown = $criticality_analysis_body.find(row_id + 'select[name=project_plan]');
                            var $technical_bulletin_dropdown = $criticality_analysis_body.find(row_id + 'select[name=technical_bulletin]');

                            $owner_dropdown.val(item.user_id);
                            $defect_elimination_dropdown.val(item.defect_elimination);
                            $project_plan_dropdown.val(item.project_plan);
                            $technical_bulletin_dropdown.val(item.technical_bulletin);*/


                        });

                        var $comment_area = $('#comment-container');
                        var $like_area = $('#like-container');

                        $comment_area.text(table_info.comments);
                        $like_area.text(table_info.likes);

                    }
                
                
            }
        });

    }
}

function get_action_tracker_list(filter_owner, filter_status){

    //old
    var $action_tracker_container_old = $('#action-tracker-ajax-old');

    var $action_tracker_container = $('#action-tracker-ajax');
    var $table_head = $action_tracker_container.find('thead');
    var $table_body = $action_tracker_container.find('tbody');
    var $loading = $('#loading-action-tracker');
    var $no_search = $('#no-action-tracker');

    if ($action_tracker_container.length > 0) {

       /* var $no_criticality_analysis = $('#no-criticality-analysis');
        var $no_search_found = $('#no-search-found');*/

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();
        var status = filter_status || null;
        var owner = filter_owner || null;

        if(owner == null){
            owner = current_user_id;
        }

        var function_url = 'action_tracker/get_action_tracker';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "owner": owner,
            "status": status
            /*to do action tracker filter variables here*/
        };

        $action_tracker_container_old.html('');
        $table_head.html('');
        $table_body.html('');
        /*to do loading animation */

        $loading.removeClass('hidden');

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                //alert(data);
                $loading.addClass('hidden');
                $no_search.removeClass('hidden');

                //console.log(data.status_dropdown);
                var table_data = data.table_data;

                if(table_data.length < 1){

                    $('.remove-action-tracker-row').addClass('hidden');
                    $('.add-action-tracker-row').addClass('hidden');

                }else{

                    var add_row = $('.add-action-tracker-row').hasClass('hidden');
                    if(add_row == true){
                        $('.add-action-tracker-row').removeClass('hidden');
                    }

                    $loading.addClass('hidden');
                    $no_search.addClass('hidden');

                    var status_dropdown = data.status_dropdown;
                    var user_options = data.user_option_values;
                    var document_name_options = data.document_name_dropdown;
                    var existing_document_name_options = data.existing_document_name_dropdown;
                    var tb_dropdown = data.tb_dropdown;
                    var equipment_dropdown = data.equipment_dropdown;
                    var subaction_data = data.subaction_table_data;
                    var selected_value = '';
                    var selected = '';

                    var column_names = '';
                    
                    column_names += '<div class="row content text-left">';
                        column_names += '<div class="col-xs-1"><p class="strong">Ref</p></div>';
                        column_names += '<div class="col-xs-2"><p class="strong">Document Code</p></div>';
                        column_names += '<div class="col-xs-2"><p class="strong">Action/Process Step</p></div>';
                        column_names += '<div class="col-xs-1"><p class="strong">Status</p></div>';
                        column_names += '<div class="col-xs-2"><p class="strong">Owner</p></div>';
                        column_names += '<div class="col-xs-1"><p class="strong">Group</p></div>';
                        column_names += '<div class="col-xs-1"><p class="strong">Due Date</p></div>';
                        column_names += '<div class="col-xs-1"><p class="strong">Comments</p></div>';
                        column_names += '<div class="col-xs-1"><p class="strong">Action</p></div>';
                    column_names += '</div>';

                    var thead_columns = '<tr>';

                        thead_columns += '<th class="asset">Asset</th>';
                        thead_columns += '<th class="tag-number">Tag Number</th>';
                        thead_columns += '<th id="main-description" class="show-columns">Description <a id="toggle-columns" class="pull-right mini-tooltip show-hide-mini-tooltip" data-toggle="popover"><i class="glyphicon glyphicon-chevron-left"></i></a></th>';
                        thead_columns += '<th class="more-details">Code</th>';
                        thead_columns += '<th class="more-details">PCE</th>';
                        thead_columns += '<th class="more-details">SCE</th>';
                        thead_columns += '<th class="more-details">ECE</th>';
                        thead_columns += '<th class="more-details">SIS</th>';
                        thead_columns += '<th class="more-details">Status</th>';
                        thead_columns += '<th class="more-details">CV</th>';
                        thead_columns += '<th class="more-details">CAS</th>';
                        thead_columns += '<th class="more-details">SPF</th>';
                        thead_columns += '<th class="more-details">OBS</th>';
                        thead_columns += '<th class="document-code">Document Code</th>';
                        thead_columns += '<th class="entry-date">Entry Date</th>';
                        thead_columns += '<th class="improvement-type">Improvement Type</th>';
                        thead_columns += '<th>Action/Process Step</th>';
                        thead_columns += '<th>Action Status</th>';
                        thead_columns += '<th class="document-owner">Owner</th>';
                        thead_columns += '<th>Location</th>';
                        thead_columns += '<th class="th-action-group">Group</th>';
                        thead_columns += '<th class="due-date">Due Date</th>';
                        thead_columns += '<th>PG</th>';
                        /*thead_columns += '<th>RE %</th>';
                        thead_columns += '<th>DE % <a class="mini-tooltip decf-mini-tooltip" data-toggle="popover"><i class="fa fa-question-circle"></i></a></th>';
                        thead_columns += '<th>PP % <a class="mini-tooltip pp-mini-tooltip" data-toggle="popover"><i class="fa fa-question-circle"></i></a></th>';
                        thead_columns += '<th>TB % <a class="mini-tooltip tb-mini-tooltip" data-toggle="popover"><i class="fa fa-question-circle"></i></a></th>';*/
                        thead_columns += '<th class="comments">Comments</th>';
                        thead_columns += '<th class="text-center actions">Action</th>';


                        thead_columns += '</tr>';

                    //$action_tracker_container_old.append(column_names);  
                    $table_head.append(thead_columns);

                    $.each(table_data, function(index, item) {

                        var row_table = '<tr class="data-row">';

                            //asset
                            row_table += '<td class="asset-value">'; 
                                if(item.asset != null){
                                    row_table += item.asset;
                                }
                            row_table += '</td>';
                                
                            //tag number
                            row_table += '<td class="tag-number-value">'; 
                                if(item.tag_number != null){
                                    row_table += item.tag_number;
                                }
                            row_table += '</td>';

                            //item description
                            row_table += '<td><select name="equipment_description" id="" class="table-select">';
                                if(item.criticality_analysis_id != null){
                                    selected_value = '<option value="'+item.criticality_analysis_id+'">'+item.equipment_description+'&nbsp;</option>';
                                    selected = '<option value="'+item.criticality_analysis_id+'" selected>'+item.equipment_description+'&nbsp;</option>';
                                    row_table += '<option></option>';
                                    row_table += selected;
                                    equipment_dropdown = equipment_dropdown.replace(selected_value, '');
                                }
                                else{
                                    row_table += '<option></option>';
                                }
                                row_table += equipment_dropdown; //item.equipment description
                            row_table += '</select></td>';

                            //code
                            row_table += '<td class="more-details code-value">';
                                if(item.code != null){ 
                                    row_table += item.code;
                                }
                            row_table += '</td>';

                            //pce
                            row_table += '<td class="pce-value">';
                                if(typeof item.pce !== 'undefined'){
                                    row_table += item.pce;
                                }
                            row_table += '</td>'; //pce

                            //sce
                            row_table += '<td class="sce-value">';
                                if(typeof item.sce !== 'undefined'){
                                    row_table += item.sce;
                                }
                            row_table += '</td>'; 

                            //ece
                            row_table += '<td class="ece-value">';
                                if(typeof item.ece !== 'undefined'){
                                    row_table += item.ece;
                                }
                            row_table += '</td>'; 

                            //sis
                            row_table += '<td class="sis-value">';
                                if(typeof item.sis !== 'undefined'){
                                    row_table += item.sis;
                                }
                            row_table += '</td>';

                            //status
                            row_table += '<td class="status-value">'; 
                                if(typeof item.day_status !== 'undefined'){
                                    row_table += item.day_status;
                                }
                            row_table += '</td>';

                            //cv
                            row_table += '<td class="cv-value">'; 
                                if(typeof item.cv !== 'undefined'){
                                    row_table += item.cv;
                                }
                            row_table += '</td>';

                            //cas
                            row_table += '<td class="cas-value">';
                                row_table += item.cas; 
                            row_table += '</td>'; 

                            //spf
                            row_table += '<td class="spf-value">'; 
                                if(typeof item.spf !== 'undefined'){
                                    row_table += item.spf;
                                }
                            row_table += '</td>';

                            //obs
                             row_table += '<td class="obs-value">'; 
                                if(typeof item.obs !== 'undefined'){
                                    row_table += item.obs;
                                }
                            row_table += '</td>';

                            //document
                            row_table += '<td class="doc-code document-dropdown"><select name="document_id" class="table-select">';
                                selected_value = '<option value="'+item.document_id+'">'+item.document_code+':'+item.document_name+'&nbsp;</option>';
                                selected = '<option value="'+item.document_id+'" selected>'+item.document_code+': '+item.document_name+'&nbsp;</option>';
                                if(item.document_id != null){
                                    row_table += '<option value="null">:</option>';
                                }
                                row_table += selected;
                                //alert(existing_document_name_options);
                                //row_table += selected_value;

                                existing_document_name_options = existing_document_name_options.replace(selected_value, '');

                                row_table += existing_document_name_options;
                            row_table += '</select></td>';

                            //entry date
                            row_table += '<td><input type="text" class="form-control datepicker-action-tracker" name="entry_date" value="';
                                row_table += item.entry_date; 
                            row_table += '"></td>';

                            //types of improvement
                            row_table += '<td><select name="types_of_improvement" id="" class="table-select improvement-type">';
                                if(item.improvement_id != null){
                                    row_table += '<option></option>';
                                    row_table += item.improvement;
                                }
                                else{
                                    row_table += '<option></option>';
                                    row_table += item.improvement; 
                                }
                            row_table += '</select></td>'; 

                            //action/process step
                            row_table += '<td><input type="text" class="form-control " name="action_process_step" value="'; 
                                row_table += item.action_process;
                            row_table += '"></td>';

                            //action status
                            row_table +='<td><select class="form-control color-select ' + item.status_color +'" name="action_tracker_status">';
                                row_table += item.status;
                            row_table += '</select></td>';

                            //owner
                            row_table += '<td><select name="owner" id="document_name" class="select2-dropdown table-select document-owner">'; 
                                row_table += '<option value="'+item.owner+'">'+item.full_name+ '</option>';
                                row_table += user_options;
                            row_table += '</select></td>'; 

                            //location
                            row_table += '<td><select name="location" class="table-select">';
                            row_table += '<option value="null"></option>';
                                row_table += item.location; 
                            row_table += '</select></td>'; 


                            //category
                            row_table += '<td><select name="action_group" id="category" class="table-select select-action-group">';
                                if(item.category_id != null){
                                    row_table += '<option></option>';
                                    row_table += item.category;
                                }
                                else{
                                    row_table += '<option></option>';
                                    row_table += item.category; 
                                }
                            row_table += '</select></td>'; 

                            //due date
                            row_table += '<td><input type="text" class="form-control datepicker-action-tracker" name="due_date" value="';
                                row_table += item.due_date;
                            row_table += '"></td>'; 

                            row_table += '<td class="percentages"><select name="progress" class="table-select">'; //pg
                                row_table += item.progress;
                            row_table += '</select></td>'; 

                            //comments
                            row_table += '<td class="comments" ><input type="text" class="form-control " name="comments" value="';
                                row_table += item.comments;
                            row_table += '"></td>';

                            //action buttons
                            row_table +='<td class="text-center"><a href="#" class="btn btn-primary add-subaction-tracker btn-sm" data-toggle="tooltip" data-placement="left" title="Add a subaction"><span class="glyphicon glyphicon-chevron-down"></span></a> ';
                                row_table += '<a href="#" class="btn btn-danger delete-row-action-tracker btn-sm" data-toggle="tooltip" data-placement="top" title="Delete this action"><span class="glyphicon glyphicon-minus"></span></a> ';

                                row_table += '<span class="show-files-group">';
                                //file upload view
                                if((item.uploads).length < 1){
                                    row_table += '<a href="#" class="btn btn-danger show-files-action-tracker btn-sm" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                                }
                                else{
                                    $.each(item.uploads, function(index, fileupload){
                                        if(index == 0){
                                            row_table += '<a href="'+base_url+'uploads/'+fileupload.filename+'" class="btn btn-success show-files-action-tracker btn-sm img-lightbox" data-lightbox="action-tracker-'+item.action_tracker_id+'" title="View Image"><span class="glyphicon glyphicon-picture"></span></a> ';
                                        }
                                        else{
                                            row_table += '<a href="'+base_url+'uploads/'+fileupload.filename+'" class="hidden btn btn-success show-files-action-tracker btn-sm img-lightbox" data-lightbox="action-tracker-'+item.action_tracker_id+'" title="View Image"><span class="glyphicon glyphicon-picture"></span></a> ';
                                        }
                                    });
                                }

                                row_table += '</span>';
                                

                                row_table += '<a href="#" class="btn btn-primary attach-action-tracker btn-sm"><span class="glyphicon glyphicon-paperclip"></span></a> ';
                                row_table += '<a href="#" class="btn btn-primary edit-action-tracker btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span></a> ';
                                row_table += '<p class="action-tracker-id hidden">' + item.action_tracker_id + '</p></td>';
                            

                        row_table += '</tr>';

                        //$action_tracker_container_old.append(row_html);
                        $table_body.append(row_table);

                        $.each(subaction_data, function(index, sub) {

                            if(item.action_tracker_id == sub.action_tracker_id){
                            var sub_row_table = '<tr class="subaction-data-row">';
                                sub_row_table += '<td colspan="13" class="subaction-equipment"></td>';
                                sub_row_table += '<td class="subaction-doc-code document-dropdown"><select name="document_id" class="table-select">';
                                selected_value = '<option value="'+sub.subaction_document_id+'">'+sub.subaction_document_code+':'+sub.subaction_document_name+'&nbsp;</option>';
                                selected = '<option value="'+sub.subaction_document_id+'" selected>'+sub.subaction_document_code+': '+sub.subaction_document_name+'&nbsp;</option>';
                                if(sub.subaction_document_id != null){
                                    sub_row_table += '<option value="null">:</option>';
                                }
                                sub_row_table += selected;
                                    //alert(existing_document_name_options);
                                    //row_table += selected_value;

                                existing_document_name_options = existing_document_name_options.replace(selected_value, '');

                                sub_row_table += existing_document_name_options;
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-entry-date"><input type="text" class="form-control datepicker-action-tracker" name="entry_date" value="';
                                    sub_row_table += sub.subaction_entry_date;
                                sub_row_table += '"></td>';

                                sub_row_table += '<td class="subaction-improvement"><select class="table-select improvement-type" name="types_of_improvement">';
                                    if(sub.subaction_improvement_id != null){
                                        sub_row_table += '<option></option>';
                                        sub_row_table += sub.subaction_improvement;
                                    }
                                    else{
                                        sub_row_table += '<option></option>';
                                        sub_row_table += sub.subaction_improvement; 
                                    }
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-process-step"><input type="text" class="form-control " name="action_process_step" value="'; 
                                    sub_row_table += sub.subaction_process;
                                sub_row_table += '"></td>';

                                sub_row_table +='<td class="subaction-status"><select class="form-control color-select ' + sub.subaction_status_color +'" name="action_tracker_status">';
                                    sub_row_table += sub.subaction_status;
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-owner"><select name="owner" id="document_name" class="select2-dropdown table-select document-owner">'; 
                                    sub_row_table += '<option value="'+sub.subaction_owner+'">'+sub.subaction_full_name+ '</option>';
                                    sub_row_table += user_options;
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-location"><select name="location" class="table-select">';
                                sub_row_table += '<option value="null"></option>';
                                    sub_row_table += sub.subaction_location; 
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-group"><select name="action_group" id="category" class="table-select select-action-group">';
                                    if(sub.subaction_category_id != null){
                                        sub_row_table += '<option></option>';
                                    sub_row_table += sub.subaction_category;
                                    }
                                    else{
                                        sub_row_table += '<option></option>';
                                        sub_row_table += sub.subaction_category; 
                                    }
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-due-date"><input type="text" class="form-control datepicker-action-tracker" name="due_date" value="';
                                    sub_row_table += sub.subaction_due_date;
                                sub_row_table += '"></td>';

                                sub_row_table += '<td class="subaction-pg"><select name="progress" class="table-select">'; //pg
                                    sub_row_table += sub.subaction_progress;
                                sub_row_table += '</select></td>'; 

                                //comments
                                sub_row_table += '<td class="subaction-comments" ><input type="text" class="form-control " name="comments" value="';
                                    sub_row_table += sub.subaction_comments;
                                sub_row_table += '"></td>';

                                sub_row_table += '<td class="subaction-action text-center">';
                                    sub_row_table += '<a href="#" class="btn btn-primary add-subaction-tracker btn-sm" style="visibility:hidden"><span class="glyphicon glyphicon-chevron-down"></span></a> ';
                                    sub_row_table += '<a href="#" class="btn btn-danger delete-row-subaction-tracker btn-sm"><span class="glyphicon glyphicon-minus"></span></a> ';

                                    sub_row_table += '<span class="show-files-group">';
                                    //file upload view
                                    if((sub.uploads).length < 1){
                                        sub_row_table += '<a href="#" class="btn btn-danger show-files-subaction-tracker btn-sm" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                                    }
                                    else{
                                        $.each(sub.uploads, function(index, fileupload){
                                            if(index == 0){
                                                sub_row_table += '<a href="'+base_url+'uploads/'+fileupload.filename+'" class="btn btn-success show-files-subaction-tracker btn-sm img-lightbox" data-lightbox="subaction-tracker-'+sub.subaction_tracker_id+'" title="View Image"><span class="glyphicon glyphicon-picture"></span></a> ';
                                            }
                                            else{
                                                sub_row_table += '<a href="'+base_url+'uploads/'+fileupload.filename+'" class="hidden btn btn-success show-files-subaction-tracker btn-sm img-lightbox" data-lightbox="subaction-tracker-'+sub.subaction_tracker_id+'" title="View Image"><span class="glyphicon glyphicon-picture"></span></a> ';
                                            }
                                        });
                                    }

                                    sub_row_table += '</span>';

                                    sub_row_table += '<a href="#" class="btn btn-primary attach-subaction-tracker btn-sm"><span class="glyphicon glyphicon-paperclip"></span></a> ';
                                    sub_row_table += '<a href="#" class="btn btn-primary edit-subaction-tracker btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span></a> ';
                                    sub_row_table += '<p class="subaction-tracker-id hidden">' + sub.subaction_tracker_id + '</p>';
                                    sub_row_table += '<p class="action-tracker-id hidden">' + item.action_tracker_id + '</p>';
                                sub_row_table += '</td>';  

                                sub_row_table += '</tr>';

                                $table_body.append(sub_row_table);
                            }
                        });
                    });

                    dateEffects();
                    mini_tooltip();
                    update_action_tracker_document_dropdown();
                    //select_with_search();
                    //bootstrapTooltipEffects();
                    //toggle_action_tracker_table_columns();
                }
            }
        });

    } 
}

function update_action_tracker(){
    $(document).on('click', 'a.edit-action-tracker', function(e) {

        e.preventDefault();

        var $edit_button = $(this);
        var $row_data = $edit_button.closest('.data-row');

        var action_tracker_id = $row_data.find('.action-tracker-id').text();
        var action_document_id = $row_data.find('select[name=document_id]').val() || null;
        /*var document_name = $row_data.find('select[name=document_id] option:selected').text().split(':')[0];
        var ref_array = document_name.split("-");
        var reference_code = '';
        for(var i=0;i<ref_array.length -1;i++){
            reference_code += ref_array[i] + '-';
        }*/

        //reference_code_with_id = reference_code + action_document_id;

        var action_category = $row_data.find('select[name=action_group]').val();

        var action_process_step = $row_data.find('input[name=action_process_step]').val();
        var status_id = $row_data.find('select[name=action_tracker_status]').val();
        var owner_id = $row_data.find('select[name=owner]').val();
        var entry_date = $row_data.find('input[name=entry_date]').val();
        var due_date = $row_data.find('input[name=due_date]').val();
        var comments = $row_data.find('input[name=comments]').val();
        var location = $row_data.find('select[name=location]').val();
        var progress = $row_data.find('select[name=progress]').val();
        var criticality_analysis_id = $row_data.find('select[name=equipment_description]').val();
        var improvement = $row_data.find('select[name=types_of_improvement]').val() || null;

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();

        var function_url = 'action_tracker/update';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "action_tracker_id": action_tracker_id,
            "criticality_analysis_id": criticality_analysis_id,
            "action_document": action_document_id,
            //"reference_code": reference_code_with_id,
            "action_category": action_category,
            "action_process": action_process_step,
            "action_tracker_status": status_id,
            "owner": owner_id,
            "location": location,
            "progress": progress,
            "due_date": due_date,
            "entry_date": entry_date,
            "comments": comments,
            "improvement": improvement

            /*to do action tracker filter variables here*/
        };


        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                //alert(data);
                $row_data.find('.asset-value').text('');
                $row_data.find('.tag-number-value').text('');
                $row_data.find('.code-value').text('');
                $row_data.find('.pce-value').text('');
                $row_data.find('.sce-value').text('');
                $row_data.find('.ece-value').text('');
                $row_data.find('.sis-value').text('');
                $row_data.find('.cv-value').text('');
                $row_data.find('.status-value').text('');
                $row_data.find('.cas-value').text('');
                $row_data.find('.spf-value').text('');
                $row_data.find('.obs-value').text('');
                
                if(data.asset != null){
                    $row_data.find('.asset-value').text(data.asset);
                }
                if(data.tag_number != null){
                    $row_data.find('.tag-number-value').text(data.tag_number);
                }
                if(data.code != null){
                    $row_data.find('.code-value').text(data.code);
                }
                if(data.pce != null){
                    $row_data.find('.pce-value').text(data.pce);
                }
                if(data.sce != null){
                    $row_data.find('.sce-value').text(data.sce);
                }
                if(data.ece != null){
                    $row_data.find('.ece-value').text(data.ece);
                }
                if(data.sis != null){
                    $row_data.find('.sis-value').text(data.sis);
                }
                if(data.cv != null){
                    $row_data.find('.cv-value').text(data.cv);
                }
                if(data.day_status != null){
                    $row_data.find('.status-value').html(data.day_status.replace(/\"/g, ""));
                    //$row_data.find('.status-value').css({'font-family':'FontAwesome'});
                }
                if(data.cas != null){
                    $row_data.find('.cas-value').text(data.cas);
                }
                if(data.spf != null){
                    $row_data.find('.spf-value').text(data.spf);
                }
                if(data.obs != null){
                    $row_data.find('.obs-value').text(data.obs);
                }
                //console.log(data);


            }
        });



        
    });
}

function update_sub_action_tracker(){
    $(document).on('click', 'a.edit-subaction-tracker', function(e) {

        e.preventDefault();

        var $edit_button = $(this);
        var $row_data = $edit_button.closest('.subaction-data-row');

        var subaction_tracker_id = $row_data.find('.subaction-tracker-id').text();
        var subaction_document_id = $row_data.find('select[name=document_id]').val() || null;
        /*var document_name = $row_data.find('select[name=document_id] option:selected').text().split(':')[0];
        var ref_array = document_name.split("-");
        var reference_code = '';
        for(var i=0;i<ref_array.length -1;i++){
            reference_code += ref_array[i] + '-';
        }*/

        //reference_code_with_id = reference_code + action_document_id;

        var action_category = $row_data.find('select[name=action_group]').val();

        var action_process_step = $row_data.find('input[name=action_process_step]').val();
        var status_id = $row_data.find('select[name=action_tracker_status]').val();
        var owner_id = $row_data.find('select[name=owner]').val();
        var entry_date = $row_data.find('input[name=entry_date]').val();
        var due_date = $row_data.find('input[name=due_date]').val();
        var comments = $row_data.find('input[name=comments]').val();
        var location = $row_data.find('select[name=location]').val();
        var progress = $row_data.find('select[name=progress]').val();
        var improvement = $row_data.find('select[name=types_of_improvement]').val() || null;

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();

        var function_url = 'action_tracker/update_subaction';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "subaction_tracker_id": subaction_tracker_id,
            "action_document": subaction_document_id,
            //"reference_code": reference_code_with_id,
            "action_category": action_category,
            "action_process": action_process_step,
            "action_tracker_status": status_id,
            "owner": owner_id,
            "location": location,
            "progress": progress,
            "due_date": due_date,
            "entry_date": entry_date,
            "comments": comments,
            "improvement": improvement

            /*to do action tracker filter variables here*/
        };


        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                //alert(data);
                //console.log(data);


            }
        });



        
    });
}

function add_remove_action_tracker_buttons(){

    var $action_tracker_container = $('#action-tracker-ajax');
    var $table_body = $action_tracker_container.find('tbody');

    $(document).on('click', '.add-action-tracker-row', function(e) {
        //alert('success');

        if($table_body.find('.data-row').length > 0){
            var $a = $table_body.find('tr.data-row').filter(':last');
            var cloned_row = $a.clone(); 
            //var document_id = cloned_row.find('select[name=document_id]').val();
            //var reference = cloned_row.find('input[name=reference]').val();
            //var action_tracker_status = cloned_row.find('select[name=action_tracker_status]').val();

            var token = $('input[name=9s8fjshd324hd98s]').val();
            var current_user_id = $('input[name=current_user_id]').val();

            var function_url = 'action_tracker/create';

            var ajax_url = base_url + function_url;

            var dataString = {

                "9s8fjshd324hd98s": token,
                "owner": current_user_id,
                //"document_id": document_id,
                //"reference": reference,
                //"action_tracker_status": action_tracker_status,
                "ajax_add": 'true'

                /*to do action tracker filter variables here*/
            };

            $.ajax({
                type: 'post',
                url: ajax_url,
                data: dataString,
                //dataType: 'json',
                success: function(data) {

                    //alert(data);


                    //cloned_row.find('input[name=reference]').val('');
                    cloned_row.find('.asset-value').text('');
                    cloned_row.find('.tag-number-value').text('');
                    cloned_row.find('.code-value').text('');
                    cloned_row.find('.pce-value').text('');
                    cloned_row.find('.sce-value').text('');
                    cloned_row.find('.ece-value').text('');
                    cloned_row.find('.sis-value').text('');
                    cloned_row.find('.status-value').text('');
                    cloned_row.find('.cv-value').text('');
                    cloned_row.find('.cas-value').text('');
                    cloned_row.find('.spf-value').text('');
                    cloned_row.find('.obs-value').text('');
                    cloned_row.find('input[name=action_process_step]').val('');

                    cloned_row.find('select[name=types_of_improvement] option:first-child').attr('selected', true);
                    cloned_row.find('select[name=action_group] option:first-child').attr('selected', true);
                    cloned_row.find('select[name=equipment_description] option:first-child').attr('selected', true);
                    cloned_row.find('select[name=document_id] option:first-child').attr('selected', true);
                    cloned_row.find('select[name=progress] option:first-child').attr('selected', true);
                    cloned_row.find('select[name=location] option:first-child').attr('selected', true);
                    //console.log(first_option.val());
                    cloned_row.find('select[name=action_tracker_status] option:selected').removeAttr("selected");
                    cloned_row.find('select[name=action_tracker_status]').removeAttr('class');
                    cloned_row.find('select[name=action_tracker_status]').addClass('form-control color-select bg-white');
                    cloned_row.find('select[name=action_tracker_status] option:selected').val('');
                    //cloned_row.find('select[name=document_id] option:selected').val('');
                    //cloned_row.find('select[name=document_id]').text('');
                    cloned_row.find('input[name=entry_date]').val('');
                    cloned_row.find('input[name=due_date]').val('');
                    cloned_row.find('select[name=owner]').val();
                    cloned_row.find('.action-tracker-id').text(data);
                    cloned_row.find('select[name=group] option:selected').removeAttr("selected");
                    cloned_row.find('input[name=comments]').val('');

                    var show_file = '<a href="#" class="btn btn-danger show-files-action-tracker btn-sm" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                    cloned_row.find('span.show-files-group').html(show_file);
                    $action_tracker_container.append(cloned_row);

                    //row_table += '<option></option>';

                     dateEffects();
                     mini_tooltip();
                     update_action_tracker_document_dropdown();

                }
            });
            
        }

    });
}

function delete_specific_row_action_tracker(){

    $(document).on('click', '.delete-row-action-tracker', function(e) {

        e.preventDefault();
        
        var $action_tracker_container = $('#action-tracker-ajax');
        var $row = $(this).closest('.data-row');
        var id = $row.find('.action-tracker-id').text();
        //console.log(id);



        var $delete_form_modal = $('#confirm-delete-form');
        var $delete_form_modal_delete_yes = $delete_form_modal.find('.go-yes');
        var $delete_form_modal_delete_no = $delete_form_modal.find('.go-no');

        var $delete_button = $(this);

        $delete_form_modal.modal();

        $delete_form_modal_delete_no.on('click', function(e) {

            $(this).closest('.modal').modal('hide');

        });

        $delete_form_modal_delete_yes.on('click', function(e) {

            $delete_form_modal.modal('hide');

            var token = $('input[name=9s8fjshd324hd98s]').val();
            var current_user_id = $('input[name=current_user_id]').val();

            var function_url = 'action_tracker/delete_action_tracker';

            var ajax_url = base_url + function_url;

            var dataString = {

                "9s8fjshd324hd98s": token,
                "current_user_id": current_user_id,
                "action_tracker_id": id,
                    /*to do action tracker filter variables here*/
            };

            $.ajax({
                    type: 'post',
                    url: ajax_url,
                    data: dataString,
                    //dataType: 'json',
                    success: function(data) {

                        $row.fadeOut(300, function(){ $(this).remove();});

                        var subaction_rows = $action_tracker_container.find('tr.subaction-data-row');

                        //remove all subrows
                        $.each(subaction_rows, function(index) {
                            var sub_id = $(this).find('p.action-tracker-id').text()
                            if( parseInt(sub_id) == id){
                                $(this).fadeOut(300, function(){ $(this).remove();});
                            }
                        });

                        if($action_tracker_container.find('.data-row').length < 2){
                            $('.remove-action-tracker-row').addClass('hidden');
                            $('.add-action-tracker-row').addClass('hidden');

                             

                            get_action_tracker_list();
                        }
                    }
                });

        });


        
    });

    $(document).on('click', '.delete-row-subaction-tracker', function(e) {

        e.preventDefault();
        
        var $action_tracker_container = $('#action-tracker-ajax');
        var $row = $(this).closest('.subaction-data-row');
        var id = $row.find('.subaction-tracker-id').text();
        //console.log(id);



        var $delete_form_modal = $('#confirm-delete-form');
        var $delete_form_modal_delete_yes = $delete_form_modal.find('.go-yes');
        var $delete_form_modal_delete_no = $delete_form_modal.find('.go-no');

        var $delete_button = $(this);

        $delete_form_modal.modal();

        $delete_form_modal_delete_no.on('click', function(e) {

            $(this).closest('.modal').modal('hide');

        });

        $delete_form_modal_delete_yes.on('click', function(e) {

            $delete_form_modal.modal('hide');

            var token = $('input[name=9s8fjshd324hd98s]').val();
            var current_user_id = $('input[name=current_user_id]').val();

            var function_url = 'action_tracker/delete_subaction_tracker';

            var ajax_url = base_url + function_url;

            var dataString = {

                "9s8fjshd324hd98s": token,
                "current_user_id": current_user_id,
                "subaction_tracker_id": id,
                    /*to do action tracker filter variables here*/
            };

            $.ajax({
                    type: 'post',
                    url: ajax_url,
                    data: dataString,
                    //dataType: 'json',
                    success: function(data) {

                        $row.fadeOut(300, function(){ $(this).remove();});

                        /*if($action_tracker_container.find('.data-row').length < 2){
                            $('.remove-action-tracker-row').addClass('hidden');
                            $('.add-action-tracker-row').addClass('hidden');

                             

                            get_action_tracker_list();
                        }*/
                    }
                });

        });


        
    });
}

function upload_from_specific_row_action_tracker(){

    


    $(document).on('click', '.attach-action-tracker', function(e) {

        e.preventDefault();
        
        var $action_tracker_container = $('#action-tracker-ajax');
        var $row = $(this).closest('.data-row');
        var id = $row.find('.action-tracker-id').text();

        //console.log(id);

        var $upload_form_modal = $('#upload-form');
        var $upload_form_modal_yes = $upload_form_modal.find('.go-yes');
        var $upload_form_modal_no = $upload_form_modal.find('.go-no');

        var $upload_button = $(this);

        //show modal
        $upload_form_modal.modal();

        var modal_body_hidden_item = $upload_form_modal.find('.hidden-item');
        var file_row = '<div class="row"><div class="col-sm-offset-1 col-sm-8"><div class="fileinput fileinput-new input-group" data-provides="fileinput"><div class="form-control action-tracker-upload" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div><span class="input-group-addon btn btn-default btn-file"><span class="glyphicon glyphicon-paperclip"></span><input type="file" name="userfile[]" ></span><a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-remove"></span></a></div></div><div class="col-sm-3 hidden text-center"></div></div>';
        $upload_form_modal.find('.upload-errors').html('');
        $upload_form_modal.find('.attach-files').html(file_row);
        var input_id = '<input type="hidden" name="action_tracker_id" value="'+id+'" >';

        //make the form an ajaxform
        var ajax_options = {
            dataType: 'json',
            beforeSubmit: function(){

                var upload_check = 1;

                $('input[type="file"]').each(function() {
                    var $this = $(this);
                    if ($this.val() == '') { 
                        upload_check = 0;
                    }
                });

                if(upload_check == 0){
                    $upload_form_modal.find('.upload-errors').html('<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><small>Please add a file on all input fields</small></div>')
                    return false;
                }

                var file_container_height = $upload_form_modal.find('.attach-files-container').height();
                $upload_form_modal.find('.uploading-progress').css('height',file_container_height);
                $upload_form_modal.find('.uploading-progress').removeClass('hidden');
                $upload_form_modal.find('.attach-files-container').addClass('hidden');
                $upload_form_modal.find('.upload-errors').html('');
            },
            success: function(data){


                var show_files_group = $row.find('span.show-files-group');

                var file_rows = $upload_form_modal.find('.attach-files > .row');

                $.each(data.file_check, function(index, check){
                    $.each(file_rows, function(i){
                        if(index == i){
                            $(this).find('.col-sm-3').removeClass('hidden');
                            if(check.checked == 0){
                                $(this).find('.col-sm-3').html('<span class="glyphicon glyphicon-remove red"></span>');
                            }
                            else{
                                $(this).find('.col-sm-3').html('<span class="glyphicon glyphicon-ok green"></span>');
                            }
                        }
                        
                        
                    });
                    
                });
                

                var show_file_group_html = '';

                //error uploads
                

                //upload data
                var upload_data = data.upload_data;
                if(upload_data.length < 1){
                    show_file_group_html += '<a href="#" class="btn btn-danger show-files-action-tracker btn-sm img-lightbox" data-lightbox="action-tracker-'+id+'" title="View Image" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                }
                else{ 
                    $.each(upload_data, function(index, data_file){
                        if(index == 0){
                            show_file_group_html += '<a href="'+base_url+'uploads/'+ data_file.filename +'" class="btn btn-success show-files-action-tracker btn-sm img-lightbox" data-lightbox="action-tracker-'+id+'" title="View Image"><span class="glyphicon glyphicon-picture"></span></a> ';
                        }
                        else{
                            show_file_group_html += '<a href="'+base_url+'uploads/'+ data_file.filename +'" class="btn btn-success show-files-action-tracker btn-sm img-lightbox hidden" data-lightbox="action-tracker-'+id+'" title="View Image"><span class="glyphicon glyphicon-picture" ></span></a> ';
                        }
                    });
                }

                //hidden
                setTimeout(function(){
                    $upload_form_modal.find('.uploading-progress').addClass('hidden');
                    $upload_form_modal.find('.attach-files-container').removeClass('hidden');
                    show_files_group.html(show_file_group_html);

                    if(data.errors != ''){
                        $upload_form_modal.find('.upload-errors').html('<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><br><small>' + data.errors +'</small></div>');
                    }
                    else{
                        
                    }                    
                }, 2000);
            }
        };

        $('#upload-action-tracker').ajaxForm(ajax_options); 

        modal_body_hidden_item.html(input_id);

        $upload_form_modal_no.on('click', function(e) {

            $(this).closest('.modal').modal('hide');
            modal_body_hidden_item.html('');

        });
        
    });

    $(document).on('click', '.attach-subaction-tracker', function(e) {

        e.preventDefault();
        
        var $action_tracker_container = $('#action-tracker-ajax');
        var $row = $(this).closest('.subaction-data-row');
        var id = $row.find('.subaction-tracker-id').text();
        //console.log(id);



        var $upload_form_modal = $('#upload-form');
        var $upload_form_modal_yes = $upload_form_modal.find('.go-yes');
        var $upload_form_modal_no = $upload_form_modal.find('.go-no');

        var $upload_button = $(this);

        //show modal
        $upload_form_modal.modal();
        var modal_body_hidden_item = $upload_form_modal.find('.hidden-item');
        var file_row = '<div class="row"><div class="col-sm-offset-1 col-sm-8"><div class="fileinput fileinput-new input-group" data-provides="fileinput"><div class="form-control action-tracker-upload" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div><span class="input-group-addon btn btn-default btn-file"><span class="glyphicon glyphicon-paperclip"></span><input type="file" name="userfile[]" ></span><a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-remove"></span></a></div></div><div class="col-sm-3 hidden text-center"></div></div>';
        $upload_form_modal.find('.attach-files').html(file_row);
        $upload_form_modal.find('.upload-errors').html('');

        var input_id = '<input type="hidden" name="subaction_tracker_id" value="'+id+'" >';

        //make the form an ajaxform
        var ajax_options = {
            dataType: 'json',
            beforeSubmit: function(){

                var upload_check = 1;

                $('input[type="file"]').each(function() {
                    var $this = $(this);
                    if ($this.val() == '') { 
                        upload_check = 0;
                    }
                });

                if(upload_check == 0){
                    $upload_form_modal.find('.upload-errors').html('<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><small>Please add a file on all input fields</small></div>')
                    return false;
                }

                var file_container_height = $upload_form_modal.find('.attach-files-container').height();
                $upload_form_modal.find('.uploading-progress').css('height',file_container_height);
                $upload_form_modal.find('.uploading-progress').removeClass('hidden');
                $upload_form_modal.find('.attach-files-container').addClass('hidden');
                $upload_form_modal.find('.upload-errors').html('');
            },
            success: function(data){

                var show_files_group = $row.find('span.show-files-group');

                var file_rows = $upload_form_modal.find('.attach-files > .row');

                $.each(data.file_check, function(index, check){
                    $.each(file_rows, function(i){
                        if(index == i){
                            $(this).find('.col-sm-3').removeClass('hidden');
                            if(check.checked == 0){
                                $(this).find('.col-sm-3').html('<span class="glyphicon glyphicon-remove red"></span>');
                            }
                            else{
                                $(this).find('.col-sm-3').html('<span class="glyphicon glyphicon-ok green"></span>');
                            }
                        }
                        
                        
                    });
                    
                });

                var show_file_group_html = '';

                //upload data
                var upload_data = data.upload_data;
                if(upload_data.length < 1){
                    show_file_group_html += '<a href="#" class="btn btn-danger show-files-subaction-tracker btn-sm img-lightbox" data-lightbox="subaction-tracker-'+id+'" title="View Image" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                }
                else{ 
                    $.each(upload_data, function(index, data_file){
                        if(index == 0){
                            show_file_group_html += '<a href="'+base_url+'uploads/'+ data_file.filename +'" class="btn btn-success show-files-subaction-tracker btn-sm img-lightbox" data-lightbox="subaction-tracker-'+id+'" title="View Image"><span class="glyphicon glyphicon-picture"></span></a> ';
                        }
                        else{
                            show_file_group_html += '<a href="'+base_url+'uploads/'+ data_file.filename +'" class="btn btn-success show-files-subaction-tracker btn-sm img-lightbox hidden" data-lightbox="subaction-tracker-'+id+'" title="View Image"><span class="glyphicon glyphicon-picture" ></span></a> ';
                        }
                    });
                }

                //hidden
                setTimeout(function(){
                    $upload_form_modal.find('.uploading-progress').addClass('hidden');
                    $upload_form_modal.find('.attach-files-container').removeClass('hidden');
                    show_files_group.html(show_file_group_html);

                    if(data.errors != ''){
                        $upload_form_modal.find('.upload-errors').html('<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><br><small>' + data.errors +'</small></div>');
                    }
                    else{
                        
                    }                    
                }, 2000); 
                
            }
        };
        $('#upload-action-tracker').ajaxForm(ajax_options); 

        modal_body_hidden_item.html(input_id);


        $upload_form_modal_no.on('click', function(e) {

            $(this).closest('.modal').modal('hide');
            modal_body_hidden_item.html('');

        });
        
    });
}

function filterMasterActionTracker() {



    $(document).on('submit', '#filter-master-action-tracker-form', function(e) {

        var $filter_master_action_tracker = $(this);
        var $table_body;

        //filter variables
        var filter_owner = $filter_master_action_tracker.find('select[name=owner]').val();
        var filter_status = $filter_master_action_tracker.find('select[name=status]').val();
        


        e.preventDefault();

        get_action_tracker_list(filter_owner,filter_status);

    });
}

function add_subaction_tracker_row(){

    $(document).on('click', '.add-subaction-tracker', function(e) {

        e.preventDefault();
        
        var $action_tracker_container = $('#action-tracker-ajax');
        var $row = $(this).closest('.data-row');
        var action_tracker_id = $row.find('.action-tracker-id').text();

        var cloned_row = $row.clone();

        cloned_row.find('select[name=types_of_improvement] option:first-child').attr('selected', true);
        cloned_row.find('select[name=action_group] option:first-child').attr('selected', true);
        cloned_row.find('select[name=equipment_description] option:first-child').attr('selected', true);
        cloned_row.find('select[name=document_id] option:first-child').attr('selected', true);
        cloned_row.find('select[name=progress] option:first-child').attr('selected', true);
        cloned_row.find('select[name=location] option:first-child').attr('selected', true);

        cloned_row.find('select[name=action_tracker_status] option:selected').removeAttr("selected");
        cloned_row.find('select[name=action_tracker_status] option:selected').val('');

        var improvement_html = cloned_row.find('td select[name=types_of_improvement]').html();
        var group_html = cloned_row.find('td select[name=action_group]').html();
        var equipment_html = cloned_row.find('td select[name=equipment_description]').html();
        var document_html = cloned_row.find('td select[name=document_id]').html();
        var progress_html = cloned_row.find('td select[name=progress]').html();
        var location_html = cloned_row.find('td select[name=location]').html();
        var status_html = cloned_row.find('td select[name=action_tracker_status]').html();
        var owner_html = cloned_row.find('td select[name=owner]').html();
        //console.log(improvement_html); 


        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();

        var function_url = 'action_tracker/create_subaction';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "owner": current_user_id,
            "action_tracker_id": action_tracker_id
            //"document_id": document_id,
            //"reference": reference,
            //"action_tracker_status": action_tracker_status,

                /*to do action tracker filter variables here*/
        };

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                var subaction_row = '';

                subaction_row += '<tr class="subaction-data-row"><td colspan="13" class="subaction-equipment"></td>';
                subaction_row += '<td class="subaction-doc-code document-dropdown"><select class="table-select">'+document_html+'</select></td>';
                subaction_row += '<td class="subaction-entry-date"><input type="text" class="form-control datepicker-action-tracker" name="entry_date" value=""></td>';
                subaction_row += '<td class="subaction-improvement"><select class="table-select improvement-type" name="types_of_improvement">'+improvement_html+'</select></td>';
                subaction_row += '<td class="subaction-process-step"><input class="form-control" name="action_process_step" value=""></td>';
                subaction_row += '<td class="subaction-status"><select class="form-control color-select bg-white" name="action_tracker_status">'+status_html+'</select></td>';
                subaction_row += '<td class="subaction-owner"><select class="table-select document-owner" name="owner" >'+owner_html+'</select></td>';
                subaction_row += '<td class="subaction-location"><select class="table-select" name="location">'+location_html+'</select></td>';
                subaction_row += '<td class="subaction-group"><select class="table-select select-action-group" name="action_group">'+group_html+'</select></td>';
                subaction_row += '<td class="subaction-due-date"><input type="text" class="form-control datepicker-action-tracker" name="due_date" value=""></td>';
                subaction_row += '<td class="subaction-pg"><select class="table-select" name="progress">'+progress_html+'</select></td>';
                subaction_row += '<td class="subaction-comments"><input type="text" class="form-control " name="comments" value=""></td>';
                subaction_row += '<td class="subaction-action text-center">';
                    subaction_row += '<a href="#" class="btn btn-primary add-subaction-tracker btn-sm" style="visibility:hidden"><span class="glyphicon glyphicon-chevron-down"></span></a> ';
                    subaction_row += '<a href="#" class="btn btn-danger delete-row-subaction-tracker btn-sm"><span class="glyphicon glyphicon-minus"></span></a> ';
                    subaction_row += '<span class="show-files-group">';
                    subaction_row += '<a href="#" class="btn btn-danger show-files-subaction-tracker btn-sm" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                    subaction_row += '</span>';
                    subaction_row += '<a href="#" class="btn btn-primary attach-subaction-tracker btn-sm"><span class="glyphicon glyphicon-paperclip"></span></a> ';
                    subaction_row += '<a href="#" class="btn btn-primary edit-subaction-tracker btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span></a> ';
                    subaction_row += '<p class="subaction-tracker-id hidden">' + data + '</p>';
                    subaction_row += '<p class="action-tracker-id hidden">' + action_tracker_id + '</p>';
                subaction_row += '</td>';
                subaction_row += '</tr>';

                console.log(data);

                $row.after(subaction_row);

                dateEffects();
                update_action_tracker_document_dropdown();
            }
        });

        
    });
}

function toggle_action_tracker_table_columns(){
    $(document).on('click', '#toggle-columns', function(e) {
        e.preventDefault();

        var table = $('table#action-tracker-ajax');
        var data_row = table.find('tr.data-row');
        var change_icon = $(this).find('i');

        if(table.find('.show-columns').length > 0){
            data_row.find('td:nth-child(4),td:nth-child(5),td:nth-child(6),td:nth-child(7),td:nth-child(8),td:nth-child(9),td:nth-child(10),td:nth-child(11),td:nth-child(12),td:nth-child(13)').hide();
            table.find('th:nth-child(4),th:nth-child(5),th:nth-child(6),th:nth-child(7),th:nth-child(8),th:nth-child(9),th:nth-child(10),th:nth-child(11),th:nth-child(12),th:nth-child(13)').hide();
            table.find('td.subaction-equipment').attr('colspan',3);
            table.find('th#main-description').removeClass('show-columns');
            table.animate({width:'1900px'},'slow',function(){
                change_icon.removeClass('glyphicon-chevron-left');
                change_icon.addClass('glyphicon-chevron-right');
            });
            
            //$('div.page-header').animate({width:'1866px'},'slow');

        }
        else{
            data_row.find('td:nth-child(4),td:nth-child(5),td:nth-child(6),td:nth-child(7),td:nth-child(8),td:nth-child(9),td:nth-child(10),td:nth-child(11),td:nth-child(12),td:nth-child(13)').show();
            table.find('th:nth-child(4),th:nth-child(5),th:nth-child(6),th:nth-child(7),th:nth-child(8),th:nth-child(9),th:nth-child(10),th:nth-child(11),th:nth-child(12),th:nth-child(13)').show();
            table.find('th#main-description').addClass('show-columns');
            table.find('td.subaction-equipment').attr('colspan',13);
            table.animate({width:'2400px'},'slow',function(){
                change_icon.removeClass('glyphicon-chevron-right');
                change_icon.addClass('glyphicon-chevron-left');
            });
            
            //$('div.page-header').animate({width:'2370px'},'slow');
        }
    });
}


function create_new_attach_file_row_action_tracker(){
    $(document).on('click', 'button.clone-attach-files', function(e) {
        e.preventDefault();

        var file_row = '<div class="row"><div class="col-sm-offset-1 col-sm-8"><div class="fileinput fileinput-new input-group" data-provides="fileinput"><div class="form-control action-tracker-upload" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div><span class="input-group-addon btn btn-default btn-file"><span class="glyphicon glyphicon-paperclip"></span><input type="file" name="userfile[]" ></span><a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-remove"></span></a></div></div><div class="col-sm-3 hidden text-center"></div></div>';

        $('.attach-files').append(file_row);

    });
}

function update_action_tracker_document_dropdown(){
    $('.document-owner').on('change', function() {

        var current_user_id = this.value;

        var $td = $(this).closest('td');
        var $document_dropdown = $td.siblings('td.document-dropdown');
        var dropdown = $document_dropdown.find('select[name=document_id]');

        var token = $('input[name=9s8fjshd324hd98s]').val();

        var function_url = 'action_tracker/get_action_tracker_document_owner';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id
            };

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {
                //alert(data);
                dropdown.empty().append('<option value="null" selected="">:  &nbsp;</option>'+data);
            }
        });

    });
}

function criticality_analysis_group(){

    $(document).on('change', '#group', function(e) {

        var result = this.options[e.target.selectedIndex].text;

        if(result == 'Other'){
            $( "#group" ).addClass( "hidden" );
            $( "#freetext" ).removeClass( "hidden" );
        }

        //console.log(result);
    });

    $( "#backtoselect" ).click(function() {
        $( "#group").val(null);
        $( "#freetext" ).addClass( "hidden" );
        $( "#group" ).removeClass( "hidden" );
    });
    
}

function organisation_role(){


    //$('.organisation-other').addClass("hidden");

    $(document).on('change', '.role-form-group .role-select', function(e) {
        //alert("test");
        var $select = $(this);

        var result = this.options[e.target.selectedIndex].text;

        if(result == 'Other'){
            $select.addClass( "hidden" );
            $select.next( '.organisation-other').removeClass( "hidden" );
        }

        //console.log(result);
    });

    $( ".backtoselect" ).click(function() {

        var $role_form = $(this).closest(".role-form-group");

        $role_form.find(".role-select").val(null);
        $role_form.find( ".organisation-other" ).addClass( "hidden" );
        $role_form.find( ".role-select" ).removeClass( "hidden" );
    });
    
}

function no_document_ready() {
    //$('.document-status-row').hide();
    video_js();
    spin_loading();

    $(window).scroll(function() {
        $('header').css({
            'left': $(this).scrollLeft() //Why this 15, because in the CSS, we have set left 15, so as we scroll, we would want this to remain at 15px left
        });
    });
}

no_document_ready();


$(document).ready(function() {

    $(".sticky-thead").stickyTableHeaders();

    fiveWhyQuestionEffects();
    numberEffects();
    alertEffects();
    carouselEffects();
    bootstrapTooltipEffects();
    customTooltipEffects();
    coloredSelectEffects();
    dateEffects();
    sectionEffects();

    deleteFileInView();

    requiredNoteEditables();

    validateSteps();
    checkForCompletedForms('form.check-completed');
    //casefileNext();

    checkHistoryAnswer();
    checkIfSaved();

    tooltipToggle();

    option1Checker();
    option2Checker();

    confirmDelete();

    //container_id, table_name, row_class, include_current_step, second_container_id, custom_row_options_classes
    dynamicRow('constraints-table', 'constraints');
    dynamicRow('next-steps-table', 'next_step');
    dynamicRow('cost-breakdown-table', 'cost_breakdown');
    dynamicRow('benefit-breakdown-table', 'benefits_breakdown');
    dynamicRow('enablers-table', 'enabler');
    dynamicRow('enablers-prerequisite-table', 'prerequisite');
    dynamicRow('enablers-dependencies-table', 'dependency');
    dynamicRow('organisation-table', 'organisation');
    dynamicRow('action-tracker-table', 'action_tracker');
    dynamicRow('reporting-table', 'reporting');
    dynamicRow('meeting-table', 'meeting');
    dynamicRow('action-log-table', 'action_log');
    dynamicRow('change-management-table', 'change_management');
    dynamicRow('milestone-table', 'milestone');
    dynamicRow('additional-user', 'document_owner', '.col-row');
    dynamicRow('follow-user', 'follow_user', '.col-row', false, '', 'col-sm-4 col-sm-offset-7', 'user_id');
    dynamicRow('expectation-table', 'expectation');
    dynamicRow('deliverable-table', 'deliverable');
    dynamicRow('file-table', 'file', '.file-row', true);
    dynamicRow('rate-of-success-table', 'rate_of_success');
    dynamicRow('type-of-improvement-table', 'type_of_improvement');
    dynamicRow('failure-cause-table', 'failure_cause', '.failure-cause-row');
    dynamicRow('consequence-table', 'failure_impact', '.consequence');
    dynamicRow('responsible-party-table', 'test_process');
    dynamicRow('process-step-table', 'process_step');
    dynamicRow('quality-control-step-table', 'quality_control_step');
    dynamicRow('timeline-table', 'timeline');
    dynamicRow('maintenance-activity-table', 'maintenance_activity', '.row-activity');
    dynamicRow('report-status-table', 'status_report_item', '.report-status-row');

    dynamicRow('interested-party-role-table', 'interested_party', '.col-row', false, '', 'col-sm-4 col-sm-offset-8 no-padding');
    dynamicRow('responsible-party-role-table', 'responsible_party', '.col-row', false, '', 'col-sm-4 col-sm-offset-8 no-padding');

    ajax_select("#system", "case-file/get_subcategory", "system", "#system_subcategory");
    ajax_select("#equipment-category", "case-file/get_subcategory", "equipment_category", "#equipment-class");
    ajax_select("#equipment-class", "case-file/get_deep_subcategory", "equipment_category", "#equipment-description");
    ajax_select("#equipment-description", "case-file/get_menu_details", "equipment_category", "#equipment-code", null, 'deep_subcategory', 'code');
    ajax_select("#detection_notification", "case-file/get_menu_details", "method_of_detection_notification", "#detection_description", null, 'menu', 'description');
    ajax_select("#failure_mechanism", "case-file/get_subcategory", 'failure_mechanism', "#failure_mechanism_subdivision");
    ajax_select(".failure-cause", "case-file/get_subcategory", 'failure_cause', ".failure-cause-subdivision", '.failure-cause-row');
    ajax_select(".failure-cause-subdivision", "case-file/get_menu_details", "failure_cause", ".failure-cause-description", '.failure-cause-row', 'subcategory', 'description');
    ajax_select("#failure-notification", "case-file/get_subcategory", 'failure_mode', "#failure_description");
    ajax_select("#failure_description", "case-file/get_menu_details", 'failure_mode', "#failure_code", null, 'subcategory', 'code');
    ajax_select(".type-of-improvement", "ofi/get_menu_details", "type_of_improvement", ".type-of-improvement-description", '.row.content', 'menu', 'description');
    ajax_select(".maintenance-activity-item", "case-file/get_menu_details", "maintenance_activity", ".maintenance-activity-description", '.row-activity', 'menu', 'description');

    ajax_autocomplete('.new-user', '.ajax-autocomplete', 'user/search_all', '.user-suggest', '.autosuggest');

    remove_empty_user_field();

    myAccountEffects();
    tb_ranking();
    scroll_top();
    rank_document();

    update_menu();
    add_menu();
    update_menu_category();
    add_menu_category();

    textareaEffects();

    menu_dropdown_selector();

    add_menu_subcategory();
    update_menu_subcategory();
    add_menu_deep_subcategory();
    update_menu_deep_subcategory();

    changePhoto();

    document_status();

    get_ranking_like();

    //other_to_textfield();
    //check_other_textfield();
    hide_plus_minus_button();

    getDataTable('basic-decf-json', 'basic-decf', 'BASIC-DECF');
    getDataTable('decf-json', 'case-file', 'DECF');
    getDataTable('ofi-json', 'ofi');
    getDataTable('project-plan-json', 'project-plan');
    getDataTable('technical-bulletin-json', 'technical-bulletin');
    getDataTable('witness-statement-json', 'witness-statement');
    getDataTable('technical-query-json', 'technical-query');
    getDataTable('erp-json', 'erp','ERP');

    //documentUploadModal();

    delete_file_row();
    upload_file();

    collapse_equipment_profile();
    autoReferenceId();
    select_with_search();

    editActionTrackerModal();
    editEquipmentRegisterModal();
    createActionTrackerModal();
    createEquipmentRegisterModal();
    my_action_tracker();


    user_document_status();

    filter_action_tracker();
    user_action_tracker();
    user_equipment_register();

    user_weekly_plan();
    update_weekly_plan();
    remove_weekly_plan();
    weekly_plan_clone();

    user_criticality_analysis();
    user_history_of_availability();

    user_failure_rate();
    edit_failure_rate();
    delete_failure_rate();

    update_user_single_index();
    user_single_index();

    update_user_compliance();
    user_compliance_dashboard();


    createWeeklyPlanModal();
    editWeeklyPlanModal();
    edit_criticality_analysis();
    delete_criticality_analysis();
    createCriticalityAnalysis();
    filterCriticalityAnalysis();


    addSis();
    getSisList();
    editSis();

    createUserAdmin();
    user_admin();
    editUserAdminModal();

    //getCriticalityAnalysisHistory();
    getCriticalityAnalysisHistoryDailyValues();
    filter_criticality_analysis_values();
    editCriticalityAnalysisHistoryValues();
    button_scroll();
    incrementProgressBar();
    daysInMonth();
    dateRange();
    enableEndDateRange();

    user_criticality_analysis_scoring();

    edit_criticality_score();

    user_criticality('criticality-redundancy', 'criticality_redundancy', 'Reliability/<br>Redundancy');
    user_criticality('criticality-safety', 'criticality_safety', 'Safety<br>Health<br>Criticality');
    user_criticality('criticality-environment', 'criticality_environment', 'Environmental<br>Criticality');
    user_criticality('criticality-operation', 'criticality_operation', 'Operational<br>Criticality');
    user_criticality('criticality-reinstatement', 'criticality_reinstatement', 'Reinstatement', true);
    user_criticality('criticality-status', 'criticality_status', 'Status', false, true);

    update_user_criticality();
    selectEffects();

    mini_tooltip();
    export_csv();

    documentComments();
    moreComments();

    //new action tracker
    get_action_tracker_list();
    update_action_tracker();
    add_remove_action_tracker_buttons();
    delete_specific_row_action_tracker();
    toggle_action_tracker_table_columns();
    filterMasterActionTracker();

    equipment_answer_clone();
    equipment_history_category_option();
    add_subaction_tracker_row();
    update_sub_action_tracker();
    upload_from_specific_row_action_tracker();
    create_new_attach_file_row_action_tracker();
    //update_action_tracker_document_dropdown();

    criticality_analysis_group();

    organisation_role();

});
