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
};

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
            var next_link = form.find('input[name=next_link]').val();
            var link_to = form.find('input[name=link_to]').val(next_link);
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

//START DYNAMIC ROW
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
            row_options = getRowOptions('default', 'col-sm-4 col-sm-offset-8 col-xs-12');
        } else if (custom_row_options_classes == 'default-no-padding') {
            row_options = getRowOptions('default', "col-sm-4 col-sm-offset-8 col-xs-12 no-padding");
        } else if (custom_row_options_classes == 'default') {
            row_options = getRowOptions('default', "col-sm-4 col-sm-offset-8 col-xs-12");
        } else if (custom_row_options_classes != 'col-sm-4 col-sm-offset-8 col-xs-12') {
            row_options = getRowOptions('normal', custom_row_options_classes);
        } else {
            row_options = getRowOptions('normal', "col-sm-4 col-sm-offset-8 col-xs-12");
        }

        if (second_container_id != '') {
            console.log('second container empty');
            var $secondary_container = $('#' + second_container_id);
            var secondary_clone = $secondary_container.find(row_class).not('.row-options-container').outerHTML();

            $secondary_container.append(row_options);

            var $secondary_button_container = $secondary_container.find('.row-options-container');
            $secondary_button_container.hide();
        }

        //console.log(container_id);
        //console.log($main_container);
        $main_container.append(row_options);


        var $add_row_button = $main_container.find('.add-row');
        var $remove_row_button = $main_container.find('.remove-row');
        var $button_container = $main_container.find('.row-options-container');



        var $clone_row = $main_container.find(row_class).not('.row-options-container');
        console.log($clone_row);
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
                var c_upload_cont = $(b_upload).find('.display-file-manager');
                var c_upload = c_upload_cont.val();
                //window.b_upload = b_upload;

                if (c_upload == "") {
                    add_row_flag = false;
                }
            }

            if (add_row_flag == true) {
                if (second_container_id != '') {
                    $secondary_button_container.before(secondary_clone);
                }


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
                $new_clone_row.find('.select2-container').remove();
                $new_clone_row.find("input[name='change_status[]']").val('new');
                clone_row = $new_clone_row.outerHTML();
                clone_row = addValidator(clone_row);
                //console.log($new_clone_row);
                $button_container.before(clone_row);

                //console.log('after 2');
                autoReferenceId(ajax_row_id);
                selectEffects();
                fileManagerModal();



                ajax_autocomplete('.new-user', '.additional-user', 'user/search_all', '.user-suggest', '.autosuggest');

                //console.log('after 3');

                //temp disable
                textareaEffects();
                dateEffects();
                organisation_role();
                deliverableDateRange();

                

                //console.log('test');


                //console.log('after 3.5');


                $remove_row_button.prop('disabled', false);

            }

            var $this = $(this);

            var $dyna_row = $this.closest('.dynamic-row');
            alternateSeletInput($dyna_row, true);


            //console.log('after 4');

        });

$remove_row_button.click(function(e) {
    console.log(row_class);
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
        row_options += '<button type="button" class="btn btn-bordered btn-danger text-right remove-row"><span class="glyphicon glyphicon-minus"></span></button> <button type="button" class="btn btn-info text-right add-row"><span class="glyphicon glyphicon-plus"></span></button>';
        row_options += '</div>';
        row_options += '</div>';
        row_options += '</td>';
        row_options += '</tr>';

    } else if (option_type == 'normal') {

        row_options = '<div class="col-xs-12 text-right row-options-container no-padding">';
        row_options += '<div class="' + classes + '">';
        row_options += '<button type="button" class="btn btn-bordered btn-danger text-right remove-row"><span class="glyphicon glyphicon-minus"></span></button>';
        row_options += ' <button type="button" class="btn btn-bordered btn-info text-right add-row"><span class="glyphicon glyphicon-plus"></span></button>';
        row_options += '</div>';
        row_options += '</div>';
    } else {
        row_options = '<div class="row content text-right row-options-container">';
        row_options += '<div class="' + classes + '">';
        row_options += '<button type="button" class="btn btn-bordered btn-danger text-right remove-row"><span class="glyphicon glyphicon-minus"></span></button>';
        row_options += ' <button type="button" class="btn btn-bordered btn-info text-right add-row"><span class="glyphicon glyphicon-plus"></span></button>';
        row_options += '</div>';
        row_options += '</div>';
    }

    return row_options;
}

function ajax_add_row(function_url, table_name, include_current_step, row_count, db_primary) {

    var row_count = row_count || 1;
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

function addValidator(html_string) {

    $object = $($.parseHTML(html_string));

    $inputs = $object.find('[name]');

    $inputs.each(function() {
        input_name = $(this).attr('name');
        $(this).attr('data-bv-field', input_name);
    });

    return $object.outerHTML();
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

function ajax_autocomplete(change_selector, autocomplete_container, function_url, output_selector, output_container) {


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
                    "id": id
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
            content_css: base_url + 'theme/css/plugins/tinymce_custom.css'

        });



    });


    $(this).closest('.form-group').find('iframe').html();
    /*applyTextareaEffect($textareas);

    $('.wysihtml5-toolbar .btn-default').addClass('btn-editor');*/
}

function applyTextareaEffect($textarea) {
    $textarea.wysihtml5({
        stylesheets: ['theme/assets/plugins/bootstrap-wysihtml5/css/wysiwyg-color.css'],
        "size": "xs",
        "fa": true,
        "color": false,
        "image": false,
        "link": false,
    });
}

function update_document_cost_breakdown() {

    if ($('#cost-breakdown-table').find('.estimated-subtotal')) {

        var model_id = $("input[name=model_id]").val();
        var url = base_url + 'project-plan/update_costbreakdown_fields';

        var dataString = {
            "model_id": model_id
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

                $('.cost-breakdown-table-class').find('#estimated_cost_breakdown_total').val((estimated_subtotal).toFixed(2));
                $('.cost-breakdown-table-class').find('#actual_cost_breakdown_total').val((actual_subtotal).toFixed(2));
                $('.cost-breakdown-table-class').find('#cost_breakdown_variation').val((variation).toFixed(2));


            }
        });
}
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

    actualCostBreakDown();

    estimatedCostBreakDown();

    costVariationBreakdown();
}

function actualCostBreakDown() {
    $(document).on('keyup', '.auto-calc', function() {

        //console.log($(this).closest('.cost-breakdown-table-class').html());

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



        $(this).closest('.cost-breakdown-table-class').find('.subtotal').each(function() {

            var subtotal = $(this).val();

            if (subtotal != '') {
                total += parseFloat(subtotal);
            }
        });

        $(this).closest('.cost-breakdown-table-class').find('#actual_cost_breakdown_total').val(total.toFixed(2));


    });
}

function estimatedCostBreakDown() {
    $(document).on('keyup', '.auto-calc-estimate', function() {

        //console.log($(this).closest('.cost-breakdown-table-class').html());

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



        $(this).closest('.cost-breakdown-table-class').find('.estimated-subtotal').each(function() {

            var subtotal = $(this).val();

            if (subtotal != '') {
                total += parseFloat(subtotal);
            }
        });

        $(this).closest('.cost-breakdown-table-class').find('#estimated_cost_breakdown_total').val(total.toFixed(2));


    });
}

function costVariationBreakdown() {
    var estimated_cost;
    var actual_cost;
    $(document).on('keyup', '.auto-calc-estimate', function() {
        estimated_cost = $(this).closest('.cost-breakdown-table-class').find('#estimated_cost_breakdown_total').val();
        actual_cost = $(this).closest('.cost-breakdown-table-class').find('#actual_cost_breakdown_total').val();

        estimated_cost = parseFloat(estimated_cost);
        actual_cost = parseFloat(actual_cost);

        var variation = Math.abs(estimated_cost - actual_cost);

        if (isNaN(variation)) {
            variation = 0;
        }

        $('.cost-breakdown-table-class').find('#cost_breakdown_variation').val(variation.toFixed(2));
    });

    $(document).on('keyup', '.auto-calc', function() {
        actual_cost = $(this).closest('.cost-breakdown-table-class').find('#actual_cost_breakdown_total').val();
        estimated_cost = $(this).closest('.cost-breakdown-table-class').find('#estimated_cost_breakdown_total').val();

        estimated_cost = parseFloat(estimated_cost);
        actual_cost = parseFloat(actual_cost);

        var variation = Math.abs(estimated_cost - actual_cost);

        if (isNaN(variation)) {
            variation = 0;
        }

        $('.cost-breakdown-table-class').find('#cost_breakdown_variation').val(variation.toFixed(2));
    });
}

function hide_plus_minus_button() {
    $('.hide-plus-minus-buttons').find('.row-options-container').hide();
}

function delete_file_row() {

    $(document).on('click', '.btn-delete-file', function(e) {

        var file_row_class = '.file-row';

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

function organisation_role() {


    //$('.organisation-other').addClass("hidden");

    $(document).on('change', '.role-form-group .role-select', function(e) {
        //alert("test");
        var $select = $(this);

        var result = this.options[e.target.selectedIndex].text;

        if (result == 'Other') {
            $select.addClass("hidden");
            $select.next('.organisation-other').removeClass("hidden");
        }

        //console.log(result);
    });

    $(".backtoselect").click(function() {

        var $role_form = $(this).closest(".role-form-group");

        $role_form.find(".role-select").val(null);
        $role_form.find(".organisation-other").addClass("hidden");
        $role_form.find(".role-select").removeClass("hidden");
    });

}

//END DYNAMIC ROW



//START FORM SUBMISSION
function checkIfSaved() {
    $('a').not('#more-document-status, .delete-form, .pill, .create-document, .nexttab, .btn-upload-modal, .img-lightbox, .lb-close, .lb-next, .lb-prev, .dropdown, .nav-dropdown, .dropdown-toggle, .dropdown-link, a[data-rel=collapse], .btn-editor, a[data-wysihtml5-command="formatBlock"], .navbar-sidebar-toggle').click(function(e) {

        //console.log($(this).attr('class'));

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

function goToByScroll(id) {

    id = id.replace("link", "");

    $(window).scrollTop($("#" + id).offset().top);
}



//END FORM SUBMISSION


//START TEXTAREA EFFECTS
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
//END TEXTAREA EFFECTS


//START VALIDATION
function validateSteps() {

    $('.check-submit.check-completed').bootstrapValidator(required_field_properties);
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
    //END VALIDATION


//START DELETE FUNCTIONS
function delete_specific_row_action_tracker() {

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

            var current_user_id = $('input[name=current_user_id]').val();

            var function_url = 'action_tracker/delete_action_tracker';

            var ajax_url = base_url + function_url;

            var dataString = {

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

                    $row.fadeOut(300, function() {
                        $(this).remove();
                    });

                    var subaction_rows = $action_tracker_container.find('tr.subaction-data-row');

                    //remove all subrows
                    $.each(subaction_rows, function(index) {
                        var sub_id = $(this).find('p.action-tracker-id').text()
                        if (parseInt(sub_id) == id) {
                            $(this).fadeOut(300, function() {
                                $(this).remove();
                            });
                        }
                    });

                    if ($action_tracker_container.find('.data-row').length < 2) {
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

            var current_user_id = $('input[name=current_user_id]').val();

            var function_url = 'action_tracker/delete_subaction_tracker';

            var ajax_url = base_url + function_url;

            var dataString = {

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

                    $row.fadeOut(300, function() {
                        $(this).remove();
                    });

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

function delete_ajax(link, id, $delete_button, $modal) {



    var $data_row = $delete_button.closest('#data-row-' + id);

    console.log($data_row.html());

    //console.log($data_row.html());

    var dataString = {
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
    //END DELETE FUNCTIONS


    function ajax_select(change_selector, function_url, menu_type, output_selector, parent_selector, menu_level, menu_detail) {

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
                    "menu_type": menu_type,
                    "menu_level": menu_level,
                    "menu_detail": menu_detail
                };
                var ajax_url = base_url + function_url;


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
        console.log('update document status test');

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
        console.log(ajax_url);

        //alert(ajax_url);



        btn.button('loading');
        btn.text('...');
        $.ajax({
            type: "POST",
            url: ajax_url,
            data: post_data,
            dataType: "html",
            success: function(data) {
                console.log(data);

                // RESET TO 5 data-offset.
                $('#more-document-status').attr("data-offset", 5);
                documentStatusList();
                //user_document_status();
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
        console.log('update-document status window')

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
        console.log(ajax_url);


        btn.button('loading');
        btn.text('Updating...');
        $.ajax({
            type: "POST",
            url: ajax_url,
            data: data_object,
            dataType: "html",
            success: function(data) {
                console.log(data);
            }
        }).always(function() {
            btn.addClass('btn-success');
            btn.button('reset');
            btn.removeClass('btn-success');
        });
    });
}

function user_document_status_test() {

    var $document_status_history = $('#document-status-history').find('tbody');

    var document_id = $('input[name=model_id]').val();

    var function_url = 'document/get_user_document_status/table';

    var ajax_url = base_url + function_url;

    var dataString = {

        "document_id": document_id

    };

    $.ajax({
        type: 'post',
        url: ajax_url,
        data: dataString,
        dataType: 'html',
        success: function(data) {
            $('#document-status-list').html(data);
        }
    });
}

function navbarToggle() {

    $(document).on('click', '.navbar-sidebar-toggle', function() {
        var function_url = 'user/navbar_toggle';
        var ajax_url = base_url + function_url;

        var sidebar_state = "";
        var sidebar_condensed = "sidebar-condensed";

        if ($('body').hasClass(sidebar_condensed)) {
            sidebar_state = sidebar_condensed;
        } else {
            sidebar_state = "";
        }

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: {
                "sidebar_state": sidebar_state
            },
            dataType: 'html',
            success: function(data) {

                console.log(data);

            },
            error: function(data) {
                console.log(data);
            }
        });
    });
}

function editUserProfile() {
    var $user_info_panel = $('#user-info-panel');
    var $edit_user_profile = $('a.edit-user-information');
    var $cancel = $('#user-info-panel').find('.cancel-button');
    var $save = $('#user-info-panel').find('.save-button');

    $edit_user_profile.on('click', function(e) {
        $user_info_panel.find('.view-user-info').addClass('hidden');
        $user_info_panel.find('.edit-user-info').fadeIn().removeClass('hidden');

        $user_info_panel.find('#save-user-info').removeClass('hidden');
    });

    //cancel
    $cancel.on('click', function(e) {
        $user_info_panel.find('.view-user-info').fadeIn().removeClass('hidden');
        $user_info_panel.find('.edit-user-info').addClass('hidden');
        $user_info_panel.find('#save-user-info').addClass('hidden');
    });

    //save
    $save.on('click', function(e) {
        $user_info_panel.find('.save-animation').removeClass('hidden');



        //change this once ajax function is implemented
        //setTimeout(function() {

        //}, 2000);

var function_url = 'user/save_information';
var ajax_url = base_url + function_url;

$position_text = $user_info_panel.find("#user-position-value");
$discipline_text = $user_info_panel.find("#user-discipline-value");
$years_of_service_text = $user_info_panel.find("#user-years-of-service-value");
$area_of_operation_text = $user_info_panel.find("#user-area-of-operation-value");
$highest_qualification_text = $user_info_panel.find("#user-highest-qualification-value");
$email_address_text = $user_info_panel.find("#user-email-address-value");
$asset_operation_text = $user_info_panel.find("#user-current-asset-operation-value")

$position_select = $user_info_panel.find("select[name=position]");
$discipline_select = $user_info_panel.find("select[name=discipline]");
$area_of_operation_select = $user_info_panel.find("select[name=area_of_operation]");
$years_of_service_select = $user_info_panel.find("select[name=years_of_service]");
$highest_qualification_select = $user_info_panel.find("select[name=highest_qualification]");
$email_address_input = $user_info_panel.find("input[name=email_address]");
$asset_operation_select = $user_info_panel.find("select[name=current_asset_operation]");
        //$password_input = $user_info_panel.find("input[name=password]");

        $original_email_address_input = $user_info_panel.find("input[name=original_email_address]");
        $confirm_email_input = $user_info_panel.find("input[name=confirm_email_address]");

        var position = $position_select.val();
        var discipline = $discipline_select.val();
        var area_of_operation = $area_of_operation_select.val();
        var years_of_service = $years_of_service_select.val();
        var highest_qualification = $highest_qualification_select.val();
        var email_address = $email_address_input.val();
        var asset_operation = $asset_operation_select.val(); 
        //var password = $password_input.val();

        var original_email_address = $original_email_address_input.val();
        var confirm_email = $confirm_email_input.val();
        //var confirm_password = $user_info_panel.find("input[name=confirm_password]").val();

        var position_selected = $position_select.find('option:selected').text();
        var discipline_selected = $discipline_select.find('option:selected').text();
        var area_of_operation_selected = $area_of_operation_select.find('option:selected').text();
        var years_of_service_selected = $years_of_service_select.find('option:selected').text();
        var highest_qualification_selected = $highest_qualification_select.find('option:selected').text();
        var asset_operation_selected = $asset_operation_select.find('option:selected').text();

        var dataString = {
            "position": position,
            "discipline": discipline,
            "area_of_operation": area_of_operation,
            "asset_operation": asset_operation,
            "years_of_service": years_of_service,
            "highest_qualification": highest_qualification,
            "original_email_address": original_email_address,
            "email_address": email_address,
            "confirm_email_address": confirm_email,
            "password": null
        };

        console.log(dataString);

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {


                var result = data.result;
                var error_text = data.error_text;
                var $error_text = $user_info_panel.find('#my-account-error');

                if (result == "fail") {



                    $email_address_input.addClass('border-red');
                    $confirm_email_input.addClass('border-red');

                    $user_info_panel.find('.save-animation').addClass('hidden');
                    $error_text.text(error_text);
                    $error_text.removeClass('hidden');

                } else {

                    $email_address_input.removeClass('border-red');
                    $confirm_email_input.removeClass('border-red');
                    $error_text.addClass('hidden');

                    $position_text.text(position_selected);
                    $discipline_text.text(discipline_selected);
                    $area_of_operation_text.text(area_of_operation_selected);
                    $years_of_service_text.text(years_of_service_selected);
                    $highest_qualification_text.text(highest_qualification_selected);
                    $email_address_text.text(email_address);
                    $original_email_address_input.val(email_address);
                    $asset_operation_text.text(asset_operation_selected);

                    //back to normal my account
                    $user_info_panel.find('.save-animation').addClass('hidden');
                    $user_info_panel.find('.view-user-info').fadeIn().removeClass('hidden');
                    $user_info_panel.find('.edit-user-info').addClass('hidden');
                    $user_info_panel.find('#save-user-info').addClass('hidden');
                    //end back to normal

                }




            },
            error: function(data) {
                console.log(data);
            }
        });

});
}

function editLessonsToBeLearned() {

    var parent_container = $('#notifications-and-preferences');

    $('.panel-body').find('input[name="case_file_checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
        //console.log(this); // DOM element
        //console.log(event); // jQuery event
        //console.log(state); // true | false

        var function_url = 'user/update_user_notification';
        var ajax_url = base_url + function_url;

        var state_value = state;

        var dataString = {
            "state": state_value,
            "column": "notify_case_file"
        };

        if (parent_container.find('.save-animation').hasClass('hidden') == true) {
            parent_container.find('.save-animation').removeClass('hidden');
        }

        if (parent_container.find('.text-success').hasClass('hidden') == false) {
            parent_container.find('.text-success').addClass('hidden');
        }

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'html',
            success: function(data) {
                //alert(data);
                if (parent_container.find('.save-animation').hasClass('hidden') == false) {
                    setTimeout(function() {
                        parent_container.find('.save-animation').addClass('hidden');
                        parent_container.find('.text-success').fadeIn("slow");
                        parent_container.find('.text-success').removeClass('hidden');
                        parent_container.find('.text-success').delay(500).fadeOut("slow");
                    }, 500);
                }
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

$('.panel-body').find('input[name="tb_checkbox"]').on('switchChange.bootstrapSwitch', function(event, state) {
        //console.log(this); // DOM element
        //console.log(event); // jQuery event
        //console.log(state); // true | false

        var function_url = 'user/update_user_notification';
        var ajax_url = base_url + function_url;

        var state_value = state;

        var dataString = {
            "state": state_value,
            "column": "notify_technical_bulletin"
        };

        if (parent_container.find('.save-animation').hasClass('hidden') == true) {
            parent_container.find('.save-animation').removeClass('hidden');
        }

        if (parent_container.find('.text-success').hasClass('hidden') == false) {
            parent_container.find('.text-success').addClass('hidden');
        }

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'html',
            success: function(data) {
                if (parent_container.find('.save-animation').hasClass('hidden') == false) {
                    setTimeout(function() {
                        parent_container.find('.save-animation').addClass('hidden');
                        parent_container.find('.text-success').fadeIn("slow");
                        parent_container.find('.text-success').removeClass('hidden');
                        parent_container.find('.text-success').delay(500).fadeOut("slow");
                    }, 500);
                }
                //alert(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

$('.panel-body').find('input.equipment-category-box').on('ifToggled', function(e) {
        //console.log(this); // DOM element
        //console.log(event); // jQuery event
        //console.log(state); // true | false
        var parent_label = $(this).closest('label');
        var label = parent_label.text();
        var value = $(this).prop('checked');
        var notify = 0;

        if (value == true) {
            notify = 1;
        }

        var category_id = parent_label.find('input.equipment-category-id').val();

        //alert(notify);

        var function_url = 'user/update_single_user_preference';
        var ajax_url = base_url + function_url;

        //var state_value = state;

        var dataString = {
            "menu_id": category_id,
            "notify": notify
        };

        if (parent_container.find('.save-animation').hasClass('hidden') == true) {
            parent_container.find('.save-animation').removeClass('hidden');
        }

        if (parent_container.find('.text-success').hasClass('hidden') == false) {
            parent_container.find('.text-success').addClass('hidden');
        }

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'html',
            success: function(data) {
                if (parent_container.find('.save-animation').hasClass('hidden') == false) {
                    setTimeout(function() {
                        parent_container.find('.save-animation').addClass('hidden');
                        parent_container.find('.text-success').fadeIn("slow");
                        parent_container.find('.text-success').removeClass('hidden');
                        parent_container.find('.text-success').delay(500).fadeOut("slow");
                    }, 500);
                }
                //alert(data);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
}

function addRemoveFollowUser() {

    var parent_container = $('#my-account-follow-users');
    var $add_user = parent_container.find('span.glyphicon-plus');

    //add user
    $add_user.on('click', function(e) {
        //alert('success');
        var clone_row = parent_container.find('.hidden-clone').clone();
        clone_row.removeClass('hidden');
        clone_row.removeClass('hidden-clone');
        clone_row.addClass('input-group');
        clone_row.find('select').addClass('select2-dropdown');
        clone_row.insertBefore(parent_container.find('.add-remove-buttons'));

        selectEffects();
    });

}

function changePhoto() {
    var $change_photo = $('a.change-user-photo');
    var $change_photo_modal = $('#change-photo');

    $change_photo.on('click', function(e) {
        $change_photo_modal.modal();
    });
}

function fixSizeAddRemoveFollowUser() {
    var parent_container = $('#my-account-follow-users');
    var button_width = parent_container.find('div.add-remove-buttons').width();
    var input_group_width = parent_container.width() - button_width;
    parent_container.find('.new-user').width(input_group_width);
}

function addRemoveFollowUser() {

    var parent_container = $('#my-account-follow-users');
    var $add_user = parent_container.find('a.add-follower');
    var previous;
    var array_of_values = [];

    function selectRows() {
        var $select_value = parent_container.find('select.new-user');
        $select_value.each(function() {
            array_of_values.push(this.value);

        });
        console.log(array_of_values);
    }

    function previousValueAndOnChange() {
        $select_value = parent_container.find('select.new-user');

        $select_value.on('select2-open', function() {
            console.log($(this).val());
            previous = $(this).val();
        });

        $select_value.on('change', function(e) {
            var update = 1;
            var $parent = $(this).closest('div.input-group');
            var id = $parent.find('input[name=follow_user]').val();
            var new_value = $(this).val();
            var current = $(this);

            //change width
            fixSizeAddRemoveFollowUser();

            var current_user_id = $('input[name="current_user_id"]').val();

            //check if follow own account
            if (new_value == current_user_id) {
                $(this).select2('val', previous);
                update = 0;
            }

            for (var i = 0; i < array_of_values.length; i++) {
                if (array_of_values[i] == new_value) {
                    //console.log('has match');
                    $(this).select2('val', previous);
                    update = 0;
                    break;
                }
            }

            if (update == 1) {
                var followed_id = new_value;

                var function_url = 'user/update_single_follow_user';
                var ajax_url = base_url + function_url;

                //var state_value = state;

                var dataString = {
                    "followed_id": followed_id,
                    "follow_user_id": id
                };

                $.ajax({
                    type: 'post',
                    url: ajax_url,
                    data: dataString,
                    dataType: 'html',
                    success: function(data) {
                        var $parent = current.closest('div.input-group');
                        var id = $parent.find('input[name=follow_user]').val(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            }

        });
}

    //remove user
    $(document).on('click', 'button.remove-user-button', function() {

        var $parent = $(this).closest('div.input-group');
        var id = $parent.find('input[name=follow_user]').val();
        var current = $(this);

        var function_url = 'user/delete_single_follow_user';
        var ajax_url = base_url + function_url;

        var dataString = {
            "follow_user_id": id
        };

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'html',
            success: function(data) {
                current.closest('div.input-group').remove();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });

    selectRows();
    previousValueAndOnChange();

    //add user
    $add_user.on('click', function(e) {

        var last_child = parent_container.find('div.input-group:nth-last-child(2)');
        var last_value;

        if (last_child.length == 0) {
            last_value = '1';
        } else {
            last_value = last_child.find('select').val()
        }
        console.log(last_value);
        console.log(last_child.length);

        if (last_value == '' || last_value == '0' || last_value == null || last_value == ' ') {

        } else {
            var clone_row = parent_container.find('.hidden-clone').clone();
            clone_row.removeClass('hidden');
            clone_row.removeClass('hidden-clone');
            clone_row.addClass('input-group');
            clone_row.find('select').addClass('select2-dropdown');
            clone_row.insertBefore(parent_container.find('.add-remove-buttons'));

            selectEffects();
            array_of_values = [];
            selectRows();
            previousValueAndOnChange();
            fixSizeAddRemoveFollowUser();
        }


    });
}

function userHistoryOfAvailability(asset, category, code, last_review_date, category_list, owner_id, get_csv) {

    var $criticality_analysis = $('#history-of-availability-table'); //parent container
    var $table = $criticality_analysis.find('table'); //child table
    var $create_criticality_analysis = $('.create-criticality-analysis');

    if ($criticality_analysis.length > 0) {
        var $criticality_analysis_body = $criticality_analysis.find('tbody');
        var $criticality_analysis_loading = $('#loading-criticality-analysis');

        var $no_criticality_analysis = $('#no-criticality-analysis');
        var $no_search_found = $('#no-search-found');

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

                //console.log(data);

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
                            row_html += '<td>' + item.asset + '</td>';
                            row_html += '<td>' + item.tag_number + '</td>';
                            row_html += '<td>' + item.description + '</td>';
                            row_html += '<td class="' + item.arn_color + '">' + item.available_right_now + '</td>';
                            row_html += '<td class="' + item.alert_color + '">' + item.alert + '</td>';

                            var availability_info = item.availability_info;

                            $.each(availability_info, function(info_index, info_item) {

                                var single_availability_percentage = info_item.availability_percentage;
                                var single_availability_record = info_item.availability_record;
                                var single_availability_record_color = info_item.availability_record_color;
                                var percentage_color = info_item.percentage_color;

                                row_html += '<td class="' + percentage_color + '">' + single_availability_percentage + '</td>';
                                row_html += '<td class="' + single_availability_record_color + '">' + single_availability_record + '</td>';

                            });

                            row_html += '</tr>';

                            $criticality_analysis_body.append(row_html);




                        }); // end .each


                    } //end else

                }

                //currently disabled 
                //scrollbar($criticality_analysis, $table);
                tableReflow();
            }
        });

        //}//end get_csv else
    }
}

function scrollbar(container, element) {
    var parent_width = container.width();
    var children_width = element.width();

    if (parent_width < children_width) {
        var left = '<span id="panLeft" class="panner" data-scroll-modifier="-1">Left</span>';
        var right = '<span id="panRight" class="panner" data-scroll-modifier="1">Right</span>';

        container.append(left);
        container.append(right);

        //console.log('success');

        (function() {

            var scrollHandle = 0,
            scrollStep = 5,
            parent = container;

            //Start the scrolling process
            $(".panner").on("mouseenter", function() {
                var data = $(this).data('scrollModifier'),
                direction = parseInt(data, 10);

                $(this).addClass('active');

                startScrolling(direction, scrollStep);
            });

            //Kill the scrolling
            $(".panner").on("mouseleave", function() {
                stopScrolling();
                $(this).removeClass('active');
            });

            //Actual handling of the scrolling
            function startScrolling(modifier, step) {
                if (scrollHandle === 0) {
                    scrollHandle = setInterval(function() {
                        var newOffset = parent.scrollLeft() + (scrollStep * modifier);

                        parent.scrollLeft(newOffset);
                    }, 10);
                }
            }

            function stopScrolling() {
                clearInterval(scrollHandle);
                scrollHandle = 0;
            }

        }());
}
}

function tooltipsAndPopovers() {

    $('.required-input').popover({
     'global_close': true,
     'trigger': 'hover',
     'placement': 'right',
     'container': 'body',
     'html': true,

     'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
     'content': '<p>Required.</p>'
 })

    var title = "";
    var content = "";
    $('.highway-code-popover').popover({
        'global_close': true,
        'trigger': 'hover',
        'placement': 'right',
        'container': 'body',
        'html': true,
        
        'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
        'content': '<p>These are our Golden Rules for working in the site. Please look at these on a regular basis.</p>'
    });


    $('.enablers-popover').popover({
        'global_close': true,
        'trigger': 'hover',
        'placement': 'right',
        'container': 'body',
        'html': true,
        'title': '',
        'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
        'content': '<p><h4>Prerequisites</h4> Describe any fundamental aspects which must be in place at the start of the project and which must remain in place for the project to succeed</p><p><h4>Dependencies</h4> A description of any specialist help such as scaffolding, tools, access, isolations, etc. that the progress and success of the project depends on</p>'
    });

    $('.risks-and-threats-popover').popover({
        'global_close': true,
        'trigger': 'hover',
        'placement': 'right',
        'container': 'body',
        'html': true,
        'title': '',
        'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
        'content': '<p>Identify and list the risks and potential threats that should be considered and potential mitigating actions that could be introduced to reduce these when implementing this solution</p>'
    });


    $('.constraints-popover').popover({
        'global_close': true,
        'trigger': 'hover',
        'placement': 'right',
        'container': 'body',
        'html': true,
        'title': '',
        'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
        'content': '<p>List any bottlenecks or process gaps that may require special attention or temporary measures to ensure this does not affect progress</p>'
    });

    $('.basic-popover').popover({
        'global_close': true,
        'trigger': 'hover',
        'placement': 'right',
        'container': 'body',
        /*'width': 500,*/
        'html': true,
        'title': '',
        'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
        'content': '<p>Please take the time to complete the profile in detail. This is a reflection of your professionalism and commitment to attaining and sustaining excellence in your workplace Once completed it will enable you and others to share and learn from your experience If you want to save and return later simply click save at the bottom of the page</p><p>If you want to attach any media or documents please save them as a PDF if possible and remember to take the opportunity to label them and any photos accurately, highlight areas of specific interest with arrows, descriptions, etc.</p><p>It is important to document all the activities involved in dealing with this particular issue and sharing the results in order for others to benefit fully.</p><p>This will be rated by others and you should be able to point to this submission with a level of satisfaction and pride in future when involved in either personal appraisals or when discussing promotion.</p>'

    });

$('.step1-basic-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Please describe the equipment or issue in details so others can appreciate the history of it. </p> <p>Note:</p> <ul> <li>Was it maintained correctly, was it problematic, was maintenance recently carried out by vendors or by crew.</li> <li>If this is a system or process issues explain why it is required and what is the purpose of it.</li> </ul>'

});

$('.timeline-basic-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>Please provide a brief summary of the events leading to the event, including names of personnel who may provide clarification later</p>'

});

$('.method-basic-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> This is the method or activity by which a failure is discovered. This information is vitally important when evaluating the effect of maintenance, e.g. to distinguish between failures discovered by a planned action or by chance. </p>'

});

$('.failure-basic-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> The ‘Failure Mode’ is a more detailed description of the trigger/failing that was discovered after the Method of Detection determined further investigation was required. </p>'

});

$('.mechanism-basic-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> The failure mechanism is the physical, chemical or other process or combination of processes that leads to the failure. It is an attribute of the failure event that can be deduced technically, e.g. the apparent, observed cause of the failure. </p>'

});

$('.factor-basic-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>The 5 Whys is the simplest of RCA tools to use and essentially consists of asking the question ‘why?’ until the root cause is found or there is no further benefit in asking why?</p>'

});

$('.conclusion-basic-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Clearly define the root or probable cause, if there are multiple causes then please list them also </p> '

});

$('.cause-basic-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> The objective of these data is to identify the initiating event "root cause" in the sequence leading up to a failure of an equipment item. </p>'

});

$('.step4-basic-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Note: </p> <ul> <li>Identify the benefits</li> <li>Estimate the savings, cost of implementation and testing</li> <li>Identify if there are risks involved, what suitable mitigation can be employed</li> <li>Detail who need to do what, include a RACI chart if required</li> <li>Identify the next steps</li> </ul>'

});

$('.improvement-basic-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>What does the work scope consist of, for example;</p> <ul> <li>List the physical changes to equipment</li> <li>Changes to the surrounding areas</li> <li>Changes to the CMMS</li> <li>Changes to Operation</li> </ul>'

});

$('.step-process-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Note: </p> <ul> <li>A solution is not a solution until you have proven it resolves the problem or improves the situation</li> <li>Describe a suitable test process with baselines if possible, frequency, units of measurements, etc,.</li> <li>The improvement must be provide tangible results to be considered successful</li> <li>If there are routine inspections / test consider using the CMMS to schedule and allocate these</li> </ul>'

});


$('.evaluate-results-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Detail the results of the test process and clearly state if this has been an improvement and the next steps. </p> <p> Note: </p> <ul> <li>If these are positive you can start the process to close this issue out.</li> <li>If you have received negative results then either intensify focus, try something different, escalate to technical authority or involve vendors or specialists.</li> <li>Please summarise what happened after the improvement was performed</li> </ul>'

});


$('.recommendations-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> This is the final step, please provide lessons learned and recommendations you would like to share with others relating to your experience with this problem. </p> <p> Note: </p> <ul> <li>Sharing negative results can be as valuable as positive results</li> <li>You may be able to save somebody considerable expense and time attempting a solution you know will not work</li> <li>This is an example of a professionalism, print a copy so you and a colleague can proof read it prior to sharing</li> </ul>'

});

$('.forensic-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Please take the time to complete the profile in detail. This is a reflection of your professionalism and commitment to attaining and sustaining excellence in your workplace. Once completed it will enable you and others to share and learn from your experience. If you want to save and return later, simply click "save" at the bottom of the page. </p> <p> If you want to attach any media or documents please save them as a PDF if possible and remember to take the opportunity to label them and any photos accurately, highlight areas of specific interest with arrows, descriptions, etc. </p> <p> It is important to document all the activities involved in dealing with this particular issue and sharing the results in order for others to benefit fully. </p> <p> This will be rated by others and you should be able to point to this submission with a level of satisfaction and pride in future when involved in either personal appraisals or when discussing promotion. </p>'

});

$('.step1-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Please describe the equipment or issue in detail so on others can appreciate the history of it. </p> <p>Note:</p> <ul> <li>If appropriate explain the limits of operation, make, model, age and history</li> <li>Was it maintained correctly, was it problematic, was maintenance recently carried out by vendors or by crew.</li> <li>If this is a system or process issue explain why it is required and what is the purpose of it.</li> </ul>'

});


$('.step1-timeline-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>Please list all the relevant events and dates in order of the occurrence. If the event has been confirmed then select confirmed, however if no evidence is available then select “suspected” If you are in doubt regarding the relevance then list it and select “suspected” Do not leave out events that can be indicative of possible causes.</p>'

});


$('.step1-method-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<h3>Method of Detection</h3> <p> This is the method or activity by which a failure is discovered. This information is vitally important when evaluating the effect of maintenance, e.g. to distinguish between failures discovered by a planned action or by chance. </p>'

});


$('.step1-failure-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<h3>Failure Mode</h3> <p> The ‘Failure Mode’ is a more detailed description of the trigger/failing that was discovered after the Method of Detection determined further investigation was required. </p>'

});


$('.step2-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Before you attempt to complete the section ensure you have received all possible sources of additional input. </p> <p> Now state what the actual problem is and what are the effects of this </p> <p> Note: </p> <p> If there has been an event to trigger this then detail: </p> <ul> <li>What happened</li> <li>When did it happen</li> <li>Where did it happen</li> <li>What is the issue you are trying to resolve, for example</li> <p>This pump must be reinstated without the threat of this failure happening again</p> <p>The reliability of this switch must be improved</p> <p>The protection on this equipment does not prevent damage</p> </ul>'

});

$('.step3-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> A root cause analysis must be performed, use the most appropriate method for the complexity of the problem. Describe below what the RCA methodology was used, key steps and highlight the root cause of the problem, upload any document/photos that have captured the process and findings. List the participants in case there are questions later regarding the process. </p> <p> Note: </p> <ul> <li>Do not work in isolation</li> <li>Do not stop too early</li> <li>There are often multiple events that lead to a single failure, look at all possibilities Consider "Why" did something happen, ask the question five times. (5 why)</li> <li>If despite your best efforts, you have been unable to fully ascertain the root cause but you have established a "probable or likely cause" then progress with what you have just remember to keep an open mind.</li> </ul>'

});

$('.step3-failure-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> The failure mechanism is the physical, chemical or other process or combination of processes that leads to the failure. It is an attribute of the failure event that can be deduced technically, e.g. the apparent, observed cause of the failure. </p>'

});


$('.step3-failure-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> The failure mechanism is the physical, chemical or other process or combination of processes that leads to the failure. It is an attribute of the failure event that can be deduced technically, e.g. the apparent, observed cause of the failure. </p>'

});


$('.step3-contributory-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>The 5 Whys is the simplest of RCA tools to use and essentially consists of asking the question ‘why?’ until the root cause is found or there is no further benefit in asking why?</p>'

});


$('.step3-conclusion-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Clearly define the root or probable cause, if there are multiple causes then please list them also </p>'

});


$('.step3-case-file-failure-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<h3>Failure Cause</h3> <p> The objective of these data is to identify the initiating event "root cause" in the sequence leading up to a failure of an equipment item. </p>'

});


$('.pp-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p class="strong">Introduction</p> <p>The template is designed to prompt the Project Leader and help in the creation of the Project Plan. Once your Project Plan is completed check the document against the following Quality Criteria:</p> <ul> <li>Is the plan achievable?</li> <li>Does it support the rest of the Project Initiation Document?</li> </ul>'

});

$('.pp-popover-start-date').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': 'The estimated start date field is required.'

});


$('.pp-step1-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> This step should be confined to one or two pages at most, use bullet points where possible and keep it brief. The following sections will help you to describe your plan, keep the contents of each section relevant to that specific section and review once you are complete. Allow a colleague to perform a peer review and see if they have any questions </p>'

});

$('.pp-ex-sum-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> What are we trying to achieve? </p>'

});

$('.pp-purpose-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Why are we doing this? </p>'

});


$('.pp-success-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>What does success look like, use this section to inform those involved in the project how we will determine if the project has been successful</p>'

});

$('.pp-location-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Where are we doing it? </p>'

});

$('.pp-step2-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': ' <p>This section should be transparent to management to remind them we the investment is justified. Remember we need to monitor project progress and cost, stage by stage</p>'

});

$('.pp-benefits-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': ' <p> Identify the area or areas of benefits and provide a brief description summarising all of these collectively </p>'

});


$('.pp-risks-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>List the risks and threats that could contribute to this project failing to complete on time or on budget with the original resources, such as excessive lead times, availability of parts, weather, etc</p><p>Prerequisites are aspects that must be, and must remain in place for the project plan to be achieved such as; </p> <ul> <li>All resources to be available for the duration of the project</li> <li>Work site to remain free of contaminants</li> <li>Gas-free Environment</li> </ul><p> Dependencies are aspects that must be, and must remain in place for the project plan to be achieved such as; </p> <ul> <li>Existing pump and motor to be removed</li> <li>Hatch to be cut to allow access</li> <li>Scaffolding to be erected</li> <li>Hot Work/Naked Flame to be allowed</li></ul>'

});

$('.pp-costs-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>Summary of all relevant costs, inclusive of travel, accommodation, per diem and contingency, if you do not have confirmed costs then estimate until confirmation is recieved</p>'

});

$('.pp-step3-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>A brief description of what the plan covers and it’s boundaries</p>'

});


$('.pp-boundaries-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Describe what is included and what is not included, there should be no surprises at the end of this project so clearly establish the boundaries </p>'

});


$('.pp-enablers-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>This term refers to all activities and requirements needed to allow the project to progress, do not leave things to chance, play safe and list any enablers, real or perceived.</p>'

});

$('.pp-prerequisites-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': ' <p> Prerequisites are aspects that must be, and must remain in place for the project plan to be achieved such as; </p> <ul> <li>All resources to be available for the duration of the project</li> <li>Work site to remain free of contaminants</li> <li>Gas-free Environment</li> </ul>'

});


$('.pp-dependencies-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': ' <p> Dependencies are aspects that must be, and must remain in place for the project plan to be achieved such as; </p> <ul> <li>Existing pump and motor to be removed</li> <li>Hatch to be cut to allow access</li> <li>Scaffolding to be erected</li> <li>Hot Work/Naked Flame to be allowed</li></ul>'

});


$('.pp-specialist-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': ' <p> This refers to specialist tools, resources and other enablers that are worth highlighting. If you are unsure of the availability then play safe and list it. </p>'

});


$('.pp-assumptions-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>List any assumptions being made that will affect the projects progress or success such as deck space and access</p>'

});


$('.pp-step4-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>This section includes details of the teams who is in charge and reporting</p>'

});


$('.pp-reporting-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>If you require close control then use this option for tracking progress</p>'

});

$('.pp-action-tracker-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p><strong>Status Colors:</strong></p><table><tr><td class="bg-green status-legend"> &nbsp; &nbsp;</td><td>&nbsp;-&nbsp;</td><td>Open</td></tr><tr><td class="bg-red status-legend"> &nbsp; &nbsp;</td><td>&nbsp;-&nbsp;</td><td>Closed</td></tr><tr><td class="bg-orange status-legend"> &nbsp; &nbsp;</td><td>&nbsp;-&nbsp;</td><td>Due</td></tr></table>'

});


$('.pp-deliverables-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> List the physical outcomes of the project, something that you can read, touch or use when completed. This step is essential in quality control of the commercial aspects of your project and could be key to commercial decisions regarding “did you receive what was asked for </p>'

});

$('.pp-expectation-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Clearly define who will provide what, what they need to achieve the output, how they will produce it “the process” and who it will be supplied to </p>'

});


$('.pp-step7-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>Clearly define the next steps, responsible parties and due dates. Keep it relevant to progress and refrain from allocating actions to more than one person</p>'

});

$('.cf-step4-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Note: </p> <ul> <li>Identify the benefits</li> <li>Estimate the savings, cost of implementation and testing</li> <li>Identify if there are risks involved, what suitable mitigation can be employed</li> <li>Detail who need to do what, include a RACI chart if required</li> <li>Identify the next steps</li> </ul>'

});


$('.cf-improvement-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>What does the work scope consist of, for example;</p> <ul> <li>List the physical changes to equipment</li> <li>Changes to the surrounding areas</li> <li>Changes to the CMMS</li> <li>Changes to Operation</li> </ul>'

});


$('.cf-step5-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Note: </p> <ul> <li>A solution is not a solution until you have proven it resolves the problem or improves the situation</li> <li>Describe a suitable test process with baselines if possible, frequency, units of measurements, etc,.</li> <li>The improvement must be provide tangible results to be considered successful</li> <li>If there are routine inspections / test consider using the CMMS to schedule and allocate these</li> </ul>'

});

$('.cf-pass-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>Explain what a pass or failure would look like, is a partial improvement acceptable? </p>'

});


$('.cf-step6-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Detail the results of the test process and clearly state if this has been an improvement and the next steps. </p> <p> Note: </p> <ul> <li>If these are positive you can start the process to close this issue out.</li> <li>If you have received negative results then either intensify focus, try something different, escalate to technical authority or involve vendors or specialists.</li> <li>Please summarise what happened after the improvement was performed</li> </ul>'

});



$('.cf-step7-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> This is the final step, please provide lessons learned and recommendations you would like to share with others relating to your experience with this problem. </p> <p> Note: </p> <ul> <li>Sharing negative results can be as valuable as positive results</li> <li>You may be able to save somebody considerable expense and time attempting a solution you know will not work</li> <li>This is an example of a professionalism, print a copy so you and a colleague can proof read it prior to sharing</li> </ul>'

});


$('.cf-detection-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Why was this not detected sooner </p>'

});


$('.cf-prevention-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': ' <p> What can we do to prevent this happening again </p>'

});

$('.cf-recommendations-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': ' <p>Please share any recommendations you may have, what went well, what didnt go so well. If you were to do this again what would you do differently. </p>'

});


$('.erp-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': ' <p> Please take the time to complete the profile in detail. This is a reflection of your professionalism and commitment to attaining and sustaining excellence in your workplace. Once completed it will give you and others visibility of equipment repairs throughout the ‘Repairs Journey’ including; </p> <p> • Communication updates to all interested parties (hereinafter referred to as; ‘users’ within a ‘user group’) as a repair item moves between each stage (end users being those involved or interested in the progress of the repair throughout the ‘Repairs Journey’) </p> <p> • Written reports of equipment by the individual carrying out the repair</p> <p> If you want to save and return later, simply click "save" at the bottom of the page. </p> <p> If you want to attach any media or documents please save them as a PDF if possible and remember to take the opportunity to label them and any photos accurately, highlight areas of specific interest with arrows, descriptions, etc. </p> <p> It is important to document all the activities involved in dealing with this particular equipment repair and sharing the results in order for other users to benefit fully. </p> <p> This will be rated by others and you should be able to point to this submission with a level of satisfaction and pride in future when involved in either personal appraisals or when discussing promotion. </p>'

});


$('.erp-step3-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> Please describe the equipment or issue in details on others can appreciate the history of it. </p> <p>Note:</p> <ul> <li>If appropriate explain the limits of operation, make, model, age and history</li> <li>Was it maintained correctly, was it problematic, was maintenance recently carried out by vendors or by crew.</li> <li>If this is a system or process issues explain why it is required and what is the purpose of it.</li> </ul>'

});


$('.erp-scope-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>Please summarize the scope of work involved in this repair.</p>'

});


$('.erp-deliverables-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>Please summarize the scope of work involved in this repair.</p>'

});

$('.erp-quality-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>Think about what measures need to be taken, do not leave quality issues to chance, ensure any risks relating to quality of workmanship are dealt with</p>'

});


$('.erp-pass-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>Explain what a pass or failure would look like, is a partial improvement acceptable? </p>'

});


$('.erp-step4-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p> This is the final step, please provide lessons learned and recommendations you would like to share with others relating to your experience with this problem. </p> <p> Note: </p> <ul> <li>Sharing negative results can be as valuable as positive results</li> <li>You may be able to save somebody considerable expense and time attempting a solution you know will not work</li> <li>This is an example of a professionalism, print a copy so you and a colleague can proof read it prior to sharing</li> </ul>'

});


$('.erp-findings-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>Describe what you found, these are fact based and should include failure, root cause and solution</p>'

});


$('.erp-summary-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>Describe the approach you took to the investigation (shore based or offshore, thorough investigation or restricted due to lack of access or operational issues.) Also describe the implementation of the solution and test.</p>'

});


$('.erp-recommendations-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>Please share any recommendations you may have, what went well, what didnt go so well. If you were to do this again what would you do differently. </p>'

});


$('.equipment_profile-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'container': 'body',
    /*'width': 500,*/
    'html': true,
    'title': '',
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>',
    'content': '<p>The purpose of gathering information relating to Equipment Profile enables detailed analysis of Reliability to be undertaken across assets and operators which will improve our understanding of equipment and failures.</p>'

});

$('.new-floor-plan-row').tooltip('destroy');
$('.new-floor-plan-row').tooltip({
    'trigger': 'hover',
    'placement': 'left',
    'html': true,
    'title': 'Add new floor plan.'
});

$('.delete-row-floor-plan').tooltip('destroy');
$('.delete-row-floor-plan').tooltip({
    'trigger': 'hover',
    'placement': 'left',
    'html': true,
    'title': 'Remove this floor plan.'
});

$('.view-floor-plan').tooltip('destroy');
$('.view-floor-plan').tooltip({
    'trigger': 'hover',
    'placement': 'left',
    'html': true,
    'title': 'View this floor plan.'
});


$('.add-subaction-tracker').tooltip('destroy');
$('.add-subaction-tracker').tooltip({
    'trigger': 'hover',
    'placement': 'left',
    'html': true,
    'title': 'Add a subaction'
});

$('.create-action').popover('destroy');
$('.create-action').popover({
    'trigger': 'hover',
    'placement': 'bottom',
    'delay': {
        "show": 500,
        "hide": 100
    },
    'html': true,
    'content': '<div id="">Add a related action</div>'
});

    //add empty tooltip
    $('button.add-action-tracker-row').tooltip('destroy');
    $('button.add-action-tracker-row').tooltip({
        'trigger': 'hover',
        'placement': 'left',
        'html': true,
        'title': 'Add new action'
    });

    //delete action tracker row
    $('.delete-row-action-tracker, .delete-row-subaction-tracker').tooltip('destroy');
    $('.delete-row-action-tracker, .delete-row-subaction-tracker').tooltip({
        'trigger': 'hover',
        'placement': 'top',
        'html': true,
        'title': 'Delete this action'
    });

    $('.show-files-action-tracker, .show-files-subaction-tracker').tooltip('destroy');
    $('.show-files-action-tracker, .show-files-subaction-tracker').tooltip({
        'trigger': 'hover',
        'placement': 'top',
        'container': 'body',
        'html': true,
        'title': 'View Image/s'
    });

    $('.attach-action-tracker, .attach-subaction-tracker').tooltip('destroy');
    $('.attach-action-tracker, .attach-subaction-tracker').tooltip({
        'trigger': 'hover',
        'placement': 'top',
        'container': 'body',
        'html': true,
        'title': 'Attach files'
    });

    $('.edit-action-tracker, .edit-subaction-tracker').tooltip('destroy');
    $('.edit-action-tracker, .edit-subaction-tracker').tooltip({
        'trigger': 'hover',
        'placement': 'top',
        'container': 'body',
        'html': true,
        'title': 'Save Action'
    });

    $('.gantt-tooltip').tooltip('destroy');
    $('.gantt-tooltip').tooltip({
        'trigger': 'hover',
        'placement': 'top',
        'container': 'body',
        'html': true
    });

    $('.show-hide-mini-tooltip').popover('destroy');
    $('.show-hide-mini-tooltip').popover({
        'trigger': 'hover',
        'placement': 'top',
        'delay': {
            "show": 500,
            "hide": 100
        },
        'html': true,
        'content': '<div id="">Show/Hide more equipment details</div>'
    });

    $('.status-mini-tooltip').popover('destroy');
    $('.status-mini-tooltip').popover({
        'global_close': true,
        'trigger': 'hover',
        'placement': 'bottom',
        'title': '<div class="text-center" id="status-popover"><strong>Status</strong><button type="button" class="close" data-dismiss="clickover"><span aria-hidden="true">&times;</span></button></div>',
        'html': true,
        'content': '<div class="row"><div class="col-sm-1"><i class="fa fa-check"></i></div><div class="col-sm-1"> - </div><div class="col-sm-6 bg-green">OK</div></div><div class="row"><div class="col-sm-1"><i class="fa fa-question"></i></div><div class="col-sm-1"> - </div><div class="col-sm-6 bg-yellow">Alert</div></div><div class="row"><div class="col-sm-1"><i class="fa fa-exclamation"></i></div><div class="col-sm-1"> - </div><div class="col-sm-6 bg-orange">Warning</div></div><div class="row"><div class="col-sm-1"><i class="fa fa-times"></i></div><div class="col-sm-1"> - </div><div class="col-sm-6 bg-red">Critical</div></div><div class="row"><div class="col-sm-1"><i class="fa fa-times-circle"></i></div><div class="col-sm-1"> - </div><div class="col-sm-6 bg-dark-red">Fail</div></div><div class="row"><div class="col-sm-1"><i class="fa fa-question-circle"></i></div><div class="col-sm-1"> - </div><div class="col-sm-6 bg-dark-green">In Prog</div></div>'
    });

$('.pp-specialist-due-date-popover').popover('destroy');
$('.pp-specialist-due-date-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'auto',
    'title': '',
    'html': true,
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content" style="font-weight:normal"></div></div>',
    'content': 'When do you need this? <br> Disabled if no estimated start date for this project work pack is given.'
});


$('.pp-quality-control-steps-popover').popover('destroy');
$('.pp-quality-control-steps-popover').popover({
    'global_close': true,
    'trigger': 'hover',
    'placement': 'right',
    'title': '',
    'html': true,
    'template': '<div class="popover popover-default" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content" style="font-size: 14px !important"></div></div>',
    'content': 'What requires 3rd party / independent / supervisory intervention? <br>For example: * Verification Body to witness shutdown test * Supervisor to inspect vessel prior to closure of vessel'
})



}

function defaultRowWriter(rowIndex, record, columns, cellWriter) {
    var tr = '';

    // grab the record's attribute for each column
    for (var i = 0, len = columns.length; i < len; i++) {
        tr += cellWriter(columns[i], record);
    }

    return '<tr id="data-row-' + record.document_id + '">' + tr + '</tr>';
}

function getDataTable(table_id, controller, table_document_code) {


    var to_json = true;
    var table_document_code = table_document_code || '';
    //console.log(user_id);


    var function_url = controller + '/get-user-form';

    var ajax_url = base_url + function_url;

    var dataString = {

        "to_json": to_json,
        "table_document_code": table_document_code,

    };

    $.ajax({
        type: 'post',
        url: ajax_url,
        data: dataString,
        dataType: 'json',
        success: function(data) {

            //console.log(data);

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

function getUserData() {

    var function_url = 'user/get_user';

    var ajax_url = base_url + function_url;

    $.ajax({
        type: 'post',
        url: ajax_url,
        dataType: 'json',
        success: function(data) {
            var table_data = data.table_data;

            $(table_data).each(function(index, item) {
                // console.log(item);
            });
        }
    });
}

function bootstrapEffects() {
    // Boostrap Switch

    $('[data-toggle="tooltip"]').tooltip();
    $('input.boot-switch').bootstrapSwitch();

    // Bootstrap Tagsinput
    /*$('#tagsinput-custom').tagsinput({
        tagClass: function (item) {
            switch (item) {
                case 'html5':
                    return 'label label-info';
                case 'css3':
                    return 'label label-danger';
                case 'js':
                    return 'label label-success';
                case 'sass':
                    return 'badge badge-inverse';
                case 'less':
                    return 'badge badge-warning';
                default:
                    return 'badge';
            }
        }
    });*/
dateEffects();

$('#myTab a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
});
}

function executeDateStyleChange(){
    $('.datepicker-dropdown.datepicker-orient-bottom:before').css('display','none !important');
    $('.datepicker-dropdown.datepicker-orient-bottom:after').css('display','none !important');
    console.log('style change');
}

function dateEffects() {

    $('.estimated_start_date-datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true
    });

    $('[data-rel=datepicker], .datepicker').datepicker({
        format: 'dd/mm/yyyy'
    }).on('changeDate', function(e) {
        var $this = $(this);

        var current_date_value = $this.val();
        //$this.val(current_date_value+' ');
        //$this.val(current_date_value);
        //$this.focus();

        //var $form = $this.closest('form');

        //console.log($form.html());
        //$form.bootstrapValidator(required_field_properties);

        $this.datepicker('hide');
        
    });

    $('.datepicker-action-tracker').datepicker({
        format: 'd/m/yy'
    }).on('changeDate', function(e) {
        $(this).datepicker('hide');
    });

    $('.estimated_start_date-datepicker, [data-rel=datepicker], .datepicker, .datepicker-action-tracker').click(function(){
        executeDateStyleChange();
    });

    $('[data-rel=timepicker],.timepicker').timepicker();

    var a = $('p.pp-estimated-start-date').text();
    var b = $('p.pp-end-date').text();
    if (a != null || a != '') {
        $('input.specialist-due-date').datepicker({
            format: 'dd/mm/yyyy',
            startDate: a,
            endDate: b,
            orientation: 'auto',
            autoclose: true
        });

        $('.start-date-dependent').datepicker({
            format: 'dd/mm/yyyy',
            startDate: a,
            endDate: b,
            orientation: 'auto',
            autoclose: true
        });
    }

}

function selectEffects() {
    // Select2
    $('select.form-select2, select.select2-dropdown').select2();

    // SelectBoxIt
    /*$('select.form-selectboxit').selectBoxIt({ autoWidth: false });
    $('[rel="popover"]').popover({ trigger: 'hover', container: 'body' });*/

    // Chosen
    //$('select.form-chosen').chosen();
}

function tableEffects() {
    $('.sticky-thead').floatThead();
}

function tableReflow() {
    $('.sticky-thead').floatThead('reflow');
}

function inputEffects() {
    $('input.icheck[type=radio]').on('ifClicked', function() {
        if ($(this).prop('checked'))
            $(this).iCheck('uncheck');
    });
}

function option1Checker() {

    $(document).on('change', '.consequence-area-impact', function() {

        var highest_consequence = ajax_area_impact();

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
                "priority_value": consequence_priority_value
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

        var function_url = 'case-file/get_consequence_description';

        var consequence_priority_value = $(this).val();

        var consequence_area_impact = $(this).closest('.consequence').find('.consequence-area-impact').val();
        var $consequence_description = $(this).closest('.consequence').find('.consequence-description');



        var dataString = {
            "area_impact": consequence_area_impact,
            "priority_value": consequence_priority_value
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


function user_criticality(table_name, menu_type, sub_title, show_secondary_description, disable_name) {

    var $table_container = $('#' + table_name);
    var $table_body = $table_container.find('tbody');

    var sub_title = sub_title || '';
    var show_secondary_description = show_secondary_description || false;
    var disable_name = disable_name || false;

    if ($table_container.length > 0) {

        var current_user_id = $('input[name=current_user_id]').val();

        var function_url = 'criticality-analysis/get_menu_edit';

        var ajax_url = base_url + function_url;

        var dataString = {

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
                            row_html += '<a href="#" class="btn btn-info edit-menu"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
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

            var current_user_id = $('input[name=current_user_id]').val();

            var function_url = 'criticality-analysis/update_criticality_criteria';

            var ajax_url = base_url + function_url;



            var dataString = {

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
                    console.log('saved');
                },

                error: function(data) {

                    console.log(data.responseText);
                }
            });

        });

}
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

            var current_user_id = $('input[name=current_user_id]').val();

            var function_url = 'criticality-analysis/update_criticality_criteria';

            var ajax_url = base_url + function_url;

            var dataString = {

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

function user_criticality_analysis_scoring() {

    var $table_container = $('#criticality-analysis-scoring');
    var $table_body = $table_container.find('tbody');

    if ($table_container.length > 0) {

        var current_user_id = $('input[name=current_user_id]').val();

        var function_url = 'criticality-analysis/get_menu_edit';

        var ajax_url = base_url + function_url;

        var dataString = {

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
                            row_html += '<a href="#" class="btn btn-info edit-menu"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
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


function getIndividualActionTracker(){

    var $action_tracker_edit_popup = $('.action-tracker-edit-popup');
    var $document_modal = $('#document');
    var $edit_document_modal = $('#edit-action-tracker');
    var $loading_modal = $document_modal.find('.loading-modal');
    var $modal_title = $document_modal.find('.modal-title');
    var $modal_body = $document_modal.find('.modal-body');
    var $modal_footer = $document_modal.find('.modal-footer');
    var $edit_document_button = $document_modal.find('.edit-document');
    var $cancel_edit = $edit_document_modal.find('.edit-cancel');

    $action_tracker_edit_popup.click(function(e){
        e.preventDefault();
        //alert('test');
        var $this = $(this);
        var action_tracker_id = $this.data('action_tracker_id');

        $document_modal.modal('show');

        //console.log(action_tracker_id);

        if(action_tracker_id != null || action_tracker_id != ''){

            var function_url = 'action_tracker/get_single_action_tracker/'+action_tracker_id;

            var ajax_url = base_url + function_url;

            $loading_modal.show();
            $modal_title.hide();
            $modal_body.hide();
            $modal_footer.hide();

            $.ajax({
                type: 'get',
                url: ajax_url,
                dataType: 'json',
                success: function(data) {

                    var $document_details = $('#document-details');
                    var $footer_buttons = $document_modal.find('.modal-footer button');

                    //console.log($footer_buttons);
                    var document_id = data.document_id;
                    var document_type = data.document_type;
                    var document_code = data.document_code;
                    var entry_date = data.entry_date;
                    var last_update = data.last_update;
                    var owner_id = data.owner_id;
                    var owner = data.owner;
                    var due_date = data.due_date;
                    var action_process_step = data.action_process_step;
                    var comments = data.comments;
                    var status_id = data.status_id;
                    var status_color = data.status_color;
                    var status_text_color = data.status_text_color;
                    var status = data.status_value;

                    $footer_buttons.attr('data-id', document_id);

                    $document_modal.find('.document-type').text(document_type);
                    $document_modal.find('.document-code').text(document_code);
                    $document_modal.find('.entry-date').text(entry_date);
                    $document_modal.find('.last-update').text(last_update);

                    $document_modal.find('.owner').text(owner);
                    $document_modal.find('.due-date').text(due_date);
                    $document_modal.find('.action-process-step').text(action_process_step);
                    $document_modal.find('.action-process-step').addClass(status_text_color);
                    $document_modal.find('.comments').text(comments);

                    $document_modal.find('.status').addClass(status_color);
                    $document_modal.find('.status').text(status);

                    var $edit_action_tracker_id = $edit_document_modal.find('input[name=action_tracker_id]');
                    var $edit_document_id = $edit_document_modal.find('select[name=document_id]');
                    var $edit_action_process_step = $edit_document_modal.find('input[name=action_process]');
                    var $edit_status = $edit_document_modal.find('select[name=action_tracker_status]');
                    $edit_status.attr('class', 'form-control color-select');
                    var $edit_owner = $edit_document_modal.find('select[name=owner]');
                    var $edit_due_date = $edit_document_modal.find('input[name=due_date]');
                    var $edit_comments = $edit_document_modal.find('input[name=comments]');

                    console.log(status_id);

                    $edit_action_tracker_id.val(action_tracker_id);
                    $edit_document_id.select2('val', document_id);
                    $edit_action_process_step.val(action_process_step);
                    $edit_status.val(status_id);
                    $edit_status.addClass(status_color);
                    $edit_owner.select2( 'val', owner_id);
                    $edit_due_date.val(due_date);
                    $edit_comments.val(comments);

                    $loading_modal.hide();
                    $modal_title.show();
                    $modal_body.show();
                    $modal_footer.show();

                    //console.log(data);

                    loadDocumentDetails(document_id, $document_details);
                }
            }); //end ajax

        } //endif

    }); // end click event

$edit_document_button.click(function(e){
    $document_modal.modal('hide');
    $edit_document_modal.modal('show');
    }); // end click event

$cancel_edit.click(function(e){

    $edit_document_modal.modal('hide');
    $document_modal.modal('show');

});


$('#edit-action-tracker-form').submit(function(e){
    e.preventDefault();
    var $form = $(this);
    var post_data = $form.serializeArray();

    var function_url = 'action_tracker/update_document_action_tracker';

    var ajax_url = base_url + function_url;

    $.ajax({
        type: 'post',
        data: post_data,
        url: ajax_url,
        dataType: 'html',
        success: function(data) {

            console.log(data);
            $edit_document_modal.modal('hide');


        }
        }); //end ajax

});



} //end function


function loadDocumentDetails(document_id, $document_details){

    var function_url = 'document/get_document_modal_details/'+document_id;

    var ajax_url = base_url + function_url;

    $.ajax({
        type: 'get',
        url: ajax_url,
        dataType: 'html',
        success: function(data) {
            $document_details.html(data);
        }
    }); //end ajax

} //end function

function getActionTrackerList(post_data) {

    var temp_post = {
        'main_filter': null,
        'sub_filter' : null,
        'optional_filter': null
    }

    var post_data = post_data || temp_post;

    var $container = $('#action-tracker-container');
    var $action_tracker_container = $('#action-tracker-ajax');
    var $table_head = $action_tracker_container.find('thead');
    var $table_body = $action_tracker_container.find('tbody');
    var $loading = $('#loading-action-tracker');
    var $no_search = $('#no-action-tracker');

    if ($action_tracker_container.length > 0) {

        var function_url = 'action_tracker/get_action_tracker';

        var ajax_url = base_url + function_url;

        $table_head.html('');
        $table_body.html('');

        $loading.removeClass('hidden');

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: post_data,
            dataType: 'json',
            success: function(data) {

                console.log(data);

                //alert(data);
                $loading.addClass('hidden');

                //console.log(data.status_dropdown);
                var table_data = data.table_data;

                if (table_data.length < 1) {

                    $container.addClass('hidden');
                    $no_search.removeClass('hidden');


                } else {

                    $loading.addClass('hidden');

                    if ($no_search.hasClass('hidden') == false) {
                        $no_search.addClass('hidden');
                    }
                    if ($container.hasClass('hidden')) {
                        $container.removeClass('hidden');
                    }


                    var status_dropdown = data.status_dropdown;
                    var user_options = data.user_option_values;
                    var document_name_options = data.document_name_dropdown;
                    var existing_document_name_options = data.existing_document_name_dropdown;
                    var tb_dropdown = data.tb_dropdown;
                    var equipment_dropdown = data.equipment_dropdown;
                    var subaction_data = data.subaction_table_data;
                    var selected_value = '';
                    var selected = '';

                    var thead_columns = '<tr>';

                    thead_columns += '<th>Ref</th>';
                    thead_columns += '<th>Type</th>';
                    thead_columns += '<th>Action/Process Steps</th>';
                    thead_columns += '<th>Action Status</th>';
                    thead_columns += '<th>Owner</th>';
                    thead_columns += '<th>Due Date</th>';
                    thead_columns += '<th>Comments/Description</th>';

                    thead_columns += '</tr>';

                    //$action_tracker_container_old.append(column_names);  
                    $table_head.append(thead_columns);

                    $.each(table_data, function(index, item) {

                        var row_table = '<tr class="data-row">';

                        //console.log(item);

                        var popup_target = "document";

                        if(item.action_tracker_popup_type == 'document'){
                            popup_target = "document";
                        }else if(item.action_tracker_popup_type == "ce"){
                            popup_target = "equipment";
                        }else{

                        }

                        //NEW - REF
                        row_table += '<td class="">';
                        row_table += '<a class="action-tracker-edit-popup" href="#" data-action_tracker_id="'+item.action_tracker_id+'">'+item.reference+'</a>'
                        row_table += '</td>';

                        //NEW - Type
                        row_table += '<td class="">';
                        row_table += item.document_type_name;
                        row_table += '</td>';

                        //NEW - Action/Process Step
                        row_table += '<td class="">';
                        row_table += item.action_process_step;
                        row_table += '</td>';

                        //NEW - Action Status
                        row_table += '<td class="">';
                        row_table += '<span class="status-btn '+item.status_color+'">'
                        row_table += item.action_status;
                        row_table += '</td>';

                        //NEW - Owner
                        row_table += '<td class="">';
                        row_table += item.full_name;
                        row_table += '</td>';

                        //NEW - Due Date
                        row_table += '<td class="">';
                        row_table += item.due_date;
                        row_table += '</td>';

                        //NEW - Comments Description
                        row_table += '<td class="">';
                        row_table += item.comments;
                        row_table += '</td>';

                        row_table += '</tr>';

                        $table_body.append(row_table);
                    }); // foreach

                    //run functions here after table load
                    getIndividualActionTracker();
                }
            },
            error: function(error, data){
                console.log(error.responseText);
            }
        }); // end ajax

}
else{
    $no_search.removeClass('hidden');
}
}

function getActionTrackerListOld(filter_owner, filter_status) {

    var $container = $('#action-tracker-container');
    var $action_tracker_container = $('#action-tracker-ajax');
    var $table_head = $action_tracker_container.find('thead');
    var $table_body = $action_tracker_container.find('tbody');
    var $loading = $('#loading-action-tracker');
    var $no_search = $('#no-action-tracker');

    if ($action_tracker_container.length > 0) {

        /* var $no_criticality_analysis = $('#no-criticality-analysis');
        var $no_search_found = $('#no-search-found');*/
        var current_user_id = $('input[name=current_user_id]').val();
        var status = filter_status || null;
        var owner = filter_owner || null;

        if (owner == null) {
            owner = current_user_id;
        }

        var function_url = 'action_tracker/get_action_tracker';

        var ajax_url = base_url + function_url;

        var dataString = {

            "current_user_id": current_user_id,
            "owner": owner,
            "status": status
            /*to do action tracker filter variables here*/
        };

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

                //console.log(data.status_dropdown);
                var table_data = data.table_data;

                if (table_data.length < 1) {

                    $container.addClass('hidden');
                    $('.remove-action-tracker-row').addClass('hidden');
                    $('.add-action-tracker-row').closest('.panel-footer').addClass('hidden');
                    $no_search.removeClass('hidden');


                } else {

                    var add_row = $('.add-action-tracker-row').closest('.panel-footer').hasClass('hidden');
                    if (add_row == true) {
                        $('.add-action-tracker-row').removeClass('hidden');
                    }

                    $loading.addClass('hidden');

                    if ($no_search.hasClass('hidden') == false) {
                        $no_search.addClass('hidden');
                    }
                    if ($container.hasClass('hidden')) {
                        $container.removeClass('hidden');
                    }

                    var flash_action_id = $('p.flash-action-id').text();
                    var flash_subaction_id = $('p.flash-subaction-id').text();


                    var status_dropdown = data.status_dropdown;
                    var user_options = data.user_option_values;
                    var document_name_options = data.document_name_dropdown;
                    var existing_document_name_options = data.existing_document_name_dropdown;
                    var tb_dropdown = data.tb_dropdown;
                    var equipment_dropdown = data.equipment_dropdown;
                    var subaction_data = data.subaction_table_data;
                    var selected_value = '';
                    var selected = '';

                    var thead_columns = '<tr>';

                    thead_columns += '<th>Ref</th>';
                    thead_columns += '<th>Type</th>';
                    thead_columns += '<th>Action/Process Steps</th>';
                    thead_columns += '<th>Action Status</th>';
                    thead_columns += '<th>Owner</th>';
                    thead_columns += '<th>Due Date</th>';
                    thead_columns += '<th>Comments/Description</th>';

                    thead_columns += '</tr>';

                    //$action_tracker_container_old.append(column_names);  
                    $table_head.append(thead_columns);

                    $.each(table_data, function(index, item) {

                        var row_table = '<tr class="data-row">';

                        //console.log(item);

                        var popup_target = "document";

                        if(item.action_tracker_popup_type == 'document'){
                            popup_target = "document";
                        }else if(item.action_tracker_popup_type == "ce"){
                            popup_target = "equipment";
                        }else{

                        }

                        //NEW - REF
                        row_table += '<td class="">';
                        row_table += '<a class="action-tracker-edit-popup" href="#" data-action_tracker_id="'+item.action_tracker_id+'">'+item.reference+'</a>'
                        row_table += '</td>';

                        //NEW - Type
                        row_table += '<td class="">';
                        row_table += item.action_tracker_type;
                        row_table += '</td>';

                        //NEW - Action/Process Step
                        row_table += '<td class="">';
                        row_table += item.action_process;
                        row_table += '</td>';

                        //NEW - Action Status
                        row_table += '<td class="">';
                        row_table += '<span class="status-btn '+item.status_color+'">'
                        row_table += item.status_value;
                        row_table += '</td>';

                        //NEW - Owner
                        row_table += '<td class="">';
                        row_table += item.full_name;
                        row_table += '</td>';

                        //NEW - Due Date
                        row_table += '<td class="">';
                        row_table += item.due_date;
                        row_table += '</td>';

                        //NEW - Comments Description
                        row_table += '<td class="">';
                        row_table += item.trimmed_comments;
                        row_table += '</td>';


                        /*
                        //asset
                        row_table += '<td class="asset-value">';
                        if (item.asset != null) {
                            row_table += item.asset;
                        }
                        row_table += '</td>';

                        //tag number
                        row_table += '<td class="tag-number-value">';
                        if (item.tag_number != null) {
                            row_table += item.tag_number;
                        }
                        row_table += '</td>';

                        //item description
                        row_table += '<td><select name="equipment_description" id="" class="table-select">';
                        if (item.criticality_analysis_id != null) {
                            selected_value = '<option value="' + item.criticality_analysis_id + '">' + item.equipment_description + '&nbsp;</option>';
                            selected = '<option value="' + item.criticality_analysis_id + '" selected>' + item.equipment_description + '&nbsp;</option>';
                            row_table += '<option></option>';
                            row_table += selected;
                            equipment_dropdown = equipment_dropdown.replace(selected_value, '');
                        } else {
                            row_table += '<option></option>';
                        }
                        row_table += equipment_dropdown; //item.equipment description
                        row_table += '</select></td>';

                        //code
                        row_table += '<td class="more-details code-value">';
                        if (item.code != null) {
                            row_table += item.code;
                        }
                        row_table += '</td>';

                        //pce
                        row_table += '<td class="pce-value">';
                        if (typeof item.pce !== 'undefined') {
                            row_table += item.pce;
                        }
                        row_table += '</td>'; //pce

                        //sce
                        row_table += '<td class="sce-value">';
                        if (typeof item.sce !== 'undefined') {
                            row_table += item.sce;
                        }
                        row_table += '</td>';

                        //ece
                        row_table += '<td class="ece-value">';
                        if (typeof item.ece !== 'undefined') {
                            row_table += item.ece;
                        }
                        row_table += '</td>';

                        //sis
                        row_table += '<td class="sis-value">';
                        if (typeof item.sis !== 'undefined') {
                            row_table += item.sis;
                        }
                        row_table += '</td>';

                        //status
                        row_table += '<td class="status-value">';
                        if (typeof item.day_status !== 'undefined') {
                            row_table += item.day_status;
                        }
                        row_table += '</td>';

                        //cv
                        row_table += '<td class="cv-value">';
                        if (typeof item.cv !== 'undefined') {
                            row_table += item.cv;
                        }
                        row_table += '</td>';

                        //cas
                        row_table += '<td class="cas-value">';
                        row_table += item.cas;
                        row_table += '</td>';

                        //spf
                        row_table += '<td class="spf-value">';
                        if (typeof item.spf !== 'undefined') {
                            row_table += item.spf;
                        }
                        row_table += '</td>';

                        //obs
                        row_table += '<td class="obs-value">';
                        if (typeof item.obs !== 'undefined') {
                            row_table += item.obs;
                        }
                        row_table += '</td>';

                        //owner
                        row_table += '<td class="input-field"><select name="owner" id="document_name" class="select2-dropdown table-select document-owner">';
                        row_table += '<option value="' + item.owner + '">' + item.full_name + '</option>';
                        row_table += user_options;
                        row_table += '</select></td>';

                        //document
                        row_table += '<td class="doc-code document-dropdown input-field"><select name="document_id" class="table-select">';
                        selected_value = '<option value="' + item.document_id + '">' + item.document_code + ':' + item.document_name + '&nbsp;</option>';
                        selected = '<option value="' + item.document_id + '" selected>' + item.document_code + ': ' + item.document_name + '&nbsp;</option>';
                        if (item.document_id != null) {
                            row_table += '<option value="null">:</option>';
                        }
                        row_table += selected;
                        //alert(existing_document_name_options);
                        //row_table += selected_value;

                        existing_document_name_options = existing_document_name_options.replace(selected_value, '');

                        row_table += existing_document_name_options;
                        row_table += '</select></td>';

                        //entry date
                        row_table += '<td class="input-field"><input type="text" class="form-control datepicker-action-tracker" name="entry_date" value="';
                        row_table += item.entry_date;
                        row_table += '"></td>';

                        //types of improvement
                        row_table += '<td class="input-field"><select name="types_of_improvement" id="" class="table-select improvement-type">';
                        if (item.improvement_id != null) {
                            row_table += '<option></option>';
                            row_table += item.improvement;
                        } else {
                            row_table += '<option></option>';
                            row_table += item.improvement;
                        }
                        row_table += '</select></td>';

                        //action/process step
                        row_table += '<td class="input-field"><input type="text" class="form-control " name="action_process_step" value="';
                        row_table += item.action_process;
                        row_table += '"></td>';

                        //action status
                        row_table += '<td class="input-field"><select class="form-control color-select ' + item.status_color + '" name="action_tracker_status">';
                        row_table += item.status;
                        row_table += '</select></td>';

                        

                        //location
                        row_table += '<td class="input-field"><select name="location" class="table-select">';
                        row_table += '<option value="null"></option>';
                        row_table += item.location;
                        row_table += '</select></td>';


                        //category
                        row_table += '<td class="input-field"><select name="action_group" id="category" class="table-select select-action-group">';
                        if (item.category_id != null) {
                            row_table += '<option></option>';
                            row_table += item.category;
                        } else {
                            row_table += '<option></option>';
                            row_table += item.category;
                        }
                        row_table += '</select></td>';

                        //due date
                        row_table += '<td class="input-field"><input type="text" class="form-control datepicker-action-tracker" name="due_date" value="';
                        row_table += item.due_date;
                        row_table += '"></td>';

                        row_table += '<td class="percentages input-field"><select name="progress" class="table-select">'; //pg
                        row_table += item.progress;
                        row_table += '</select></td>';

                        //comments
                        row_table += '<td class="comments input-field" ><input type="text" class="form-control " name="comments" value="';
                        row_table += item.comments;
                        row_table += '"></td>';

                        //reply
                        row_table += '<td class="reply input-field">';
                        row_table += item.reply; //reply item.reply
                        row_table += '</td>';

                        //action buttons
                        row_table += '<td class="text-center action-column"><a href="#" class="btn btn-bordered btn-info add-subaction-tracker btn-sm"><span class="glyphicon glyphicon-chevron-down"></span></a> ';
                        row_table += '<a href="#" class="btn btn-bordered btn-danger delete-row-action-tracker btn-sm"><span class="glyphicon glyphicon-minus"></span></a> ';

                        row_table += '<span class="show-files-group">';
                        //file upload view
                        if ((item.uploads).length < 1) {
                            row_table += '<a href="#" class="btn btn-danger show-files-action-tracker btn-sm" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                        } else {
                            $.each(item.uploads, function(index, fileupload) {
                                if (index == 0) {
                                    row_table += '<a href="' + base_url + 'uploads/' + fileupload.filename + '" class="btn btn-success show-files-action-tracker btn-sm img-lightbox" data-lightbox="action-tracker-' + item.action_tracker_id + '"><span class="glyphicon glyphicon-picture"></span></a> ';
                                } else {
                                    row_table += '<a href="' + base_url + 'uploads/' + fileupload.filename + '" class="hidden btn btn-success show-files-action-tracker btn-sm img-lightbox" data-lightbox="action-tracker-' + item.action_tracker_id + '"><span class="glyphicon glyphicon-picture"></span></a> ';
                                }
                            });
                        }

                        row_table += '</span>';


                        row_table += '<a href="#" class="btn btn-info attach-action-tracker btn-sm"><span class="glyphicon glyphicon-paperclip"></span></a> ';
                        row_table += '<a href="#" class="btn btn-info edit-action-tracker btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span></a> ';
                        row_table += '<p class="action-tracker-id hidden">' + item.action_tracker_id + '</p>';
                        row_table += '<p class="author-id hidden">' + item.author_id + '</p></td>';

                        */

                        row_table += '</tr>';


                        //$action_tracker_container_old.append(row_html);
                        $table_body.append(row_table);

                        /*$.each(subaction_data, function(index, sub) {

                            if (item.action_tracker_id == sub.action_tracker_id) {
                                var sub_row_table = '<tr class="subaction-data-row">';
                                sub_row_table += '<td colspan="13" class="subaction-equipment input-field"></td>';

                                sub_row_table += '<td class="subaction-owner input-field"><select name="owner" id="document_name" class="select2-dropdown table-select document-owner">';
                                sub_row_table += '<option value="' + sub.subaction_owner + '">' + sub.subaction_full_name + '</option>';
                                sub_row_table += user_options;
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-doc-code document-dropdown input-field"><select name="document_id" class="table-select">';
                                selected_value = '<option value="' + sub.subaction_document_id + '">' + sub.subaction_document_code + ':' + sub.subaction_document_name + '&nbsp;</option>';
                                selected = '<option value="' + sub.subaction_document_id + '" selected>' + sub.subaction_document_code + ': ' + sub.subaction_document_name + '&nbsp;</option>';
                                if (sub.subaction_document_id != null) {
                                    sub_row_table += '<option value="null">:</option>';
                                }
                                sub_row_table += selected;
                                //alert(existing_document_name_options);
                                //row_table += selected_value;

                                existing_document_name_options = existing_document_name_options.replace(selected_value, '');

                                sub_row_table += existing_document_name_options;
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-entry-date input-field"><input type="text" class="form-control datepicker-action-tracker" name="entry_date" value="';
                                sub_row_table += sub.subaction_entry_date;
                                sub_row_table += '"></td>';

                                sub_row_table += '<td class="subaction-improvement input-field"><select class="table-select improvement-type" name="types_of_improvement">';
                                if (sub.subaction_improvement_id != null) {
                                    sub_row_table += '<option></option>';
                                    sub_row_table += sub.subaction_improvement;
                                } else {
                                    sub_row_table += '<option></option>';
                                    sub_row_table += sub.subaction_improvement;
                                }
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-process-step input-field"><input type="text" class="form-control " name="action_process_step" value="';
                                sub_row_table += 'sub.subaction_process';
                                sub_row_table += '"></td>';

                                sub_row_table += '<td class="subaction-status input-field"><select class="form-control color-select ' + sub.subaction_status_color + '" name="action_tracker_status">';
                                sub_row_table += sub.subaction_status;
                                sub_row_table += '</select></td>';

                                

                                sub_row_table += '<td class="subaction-location input-field"><select name="location" class="table-select">';
                                sub_row_table += '<option value="null"></option>';
                                sub_row_table += sub.subaction_location;
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-group input-field"><select name="action_group" id="category" class="table-select select-action-group">';
                                if (sub.subaction_category_id != null) {
                                    sub_row_table += '<option></option>';
                                    sub_row_table += sub.subaction_category;
                                } else {
                                    sub_row_table += '<option></option>';
                                    sub_row_table += sub.subaction_category;
                                }
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-due-date input-field"><input type="text" class="form-control datepicker-action-tracker" name="due_date" value="';
                                sub_row_table += sub.subaction_due_date;
                                sub_row_table += '"></td>';

                                sub_row_table += '<td class="subaction-pg input-field"><select name="progress" class="table-select">'; //pg
                                sub_row_table += sub.subaction_progress;
                                sub_row_table += '</select></td>';

                                //comments
                                sub_row_table += '<td class="subaction-comments input-field" ><input type="text" class="form-control " name="comments" value="';
                                sub_row_table += sub.subaction_comments;
                                sub_row_table += '"></td>';

                                //reply
                                sub_row_table += '<td class="subaction-reply input-field" >';
                                sub_row_table += sub.reply;
                                sub_row_table += '</td>';

                                sub_row_table += '<td class="subaction-action text-center">';
                                sub_row_table += '<a href="#" class="btn btn-bordered btn-info add-subaction-tracker btn-sm" style="visibility:hidden"><span class="glyphicon glyphicon-chevron-down"></span></a> ';
                                sub_row_table += '<a href="#" class="btn btn-bordered btn-danger delete-row-subaction-tracker btn-sm"><span class="glyphicon glyphicon-minus"></span></a> ';

                                sub_row_table += '<span class="show-files-group">';
                                //file upload view
                                if ((sub.uploads).length < 1) {
                                    sub_row_table += '<a href="#" class="btn btn-danger show-files-subaction-tracker btn-sm" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                                } else {
                                    $.each(sub.uploads, function(index, fileupload) {
                                        if (index == 0) {
                                            sub_row_table += '<a href="' + base_url + 'uploads/' + fileupload.filename + '" class="btn btn-success show-files-subaction-tracker btn-sm img-lightbox" data-lightbox="subaction-tracker-' + sub.subaction_tracker_id + '"><span class="glyphicon glyphicon-picture"></span></a> ';
                                        } else {
                                            sub_row_table += '<a href="' + base_url + 'uploads/' + fileupload.filename + '" class="hidden btn btn-success show-files-subaction-tracker btn-sm img-lightbox" data-lightbox="subaction-tracker-' + sub.subaction_tracker_id + '"><span class="glyphicon glyphicon-picture"></span></a> ';
                                        }
                                    });
                                }

                                sub_row_table += '</span>';

                                sub_row_table += '<a href="#" class="btn btn-info attach-subaction-tracker btn-sm"><span class="glyphicon glyphicon-paperclip"></span></a> ';
                                sub_row_table += '<a href="#" class="btn btn-info edit-subaction-tracker btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span></a> ';
                                sub_row_table += '<p class="subaction-tracker-id hidden">' + sub.subaction_tracker_id + '</p>';
                                sub_row_table += '<p class="action-tracker-id hidden">' + item.action_tracker_id + '</p>';
                                sub_row_table += '<p class="sub-author-id hidden">' + sub.author_id + '</p>';
                                sub_row_table += '</td>';

                                sub_row_table += '</tr>';

                                $table_body.append(sub_row_table);
                            }
                        });*/ //END .EACH
});

dateEffects();
tooltipsAndPopovers();
updateActionTrackerDocumentDropdown();
getIndividualActionTracker();

if(flash_action_id != ''){
    var hidden_p = $('.data-row').find('p.action-tracker-id:contains("'+flash_action_id+'")'); 
    var parent_row = hidden_p.closest('.data-row');     
    parent_row.find('input[name=comments]').focus().blur();
                        //console.log(parent_row);
                        parent_row.css('background-color','#76EAAA');
                        setTimeout(function() {
                            parent_row.css('background-color','#fff');
                        }, 1500);

                    }

                    if(flash_subaction_id != ''){
                        var hidden_p_sub = $('.subaction-data-row').find('p.subaction-tracker-id:contains("'+flash_subaction_id+'")'); 
                        var parent_row_sub = hidden_p_sub.closest('.subaction-data-row');     
                        parent_row_sub.find('input[name=comments]').focus().blur();
                        //console.log(parent_row);
                        parent_row_sub.css('background-color','#76EAAA');
                        setTimeout(function() {
                            parent_row_sub.css('background-color','#fff');
                        }, 1500);

                    }

                    $('p.flash-action-id').text('');
                    $('p.flash-subaction-id').text('');
                    //select_with_search();
                    //bootstrapTooltipEffects();
                    //toggle_action_tracker_table_columns();
                }
            }
        });

}
else{
    $no_search.removeClass('hidden');
}
}

function oldActionTrackerList(filter_owner, filter_status) {

    var $container = $('#action-tracker-container');
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

        if (owner == null) {
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

                //console.log(data.status_dropdown);
                var table_data = data.table_data;

                if (table_data.length < 1) {

                    $container.addClass('hidden');
                    $('.remove-action-tracker-row').addClass('hidden');
                    $('.add-action-tracker-row').closest('.panel-footer').addClass('hidden');
                    $no_search.removeClass('hidden');


                } else {

                    var add_row = $('.add-action-tracker-row').closest('.panel-footer').hasClass('hidden');
                    if (add_row == true) {
                        $('.add-action-tracker-row').removeClass('hidden');
                    }

                    $loading.addClass('hidden');

                    if ($no_search.hasClass('hidden') == false) {
                        $no_search.addClass('hidden');
                    }
                    if ($container.hasClass('hidden')) {
                        $container.removeClass('hidden');
                    }

                    var flash_action_id = $('p.flash-action-id').text();
                    var flash_subaction_id = $('p.flash-subaction-id').text();


                    var status_dropdown = data.status_dropdown;
                    var user_options = data.user_option_values;
                    var document_name_options = data.document_name_dropdown;
                    var existing_document_name_options = data.existing_document_name_dropdown;
                    var tb_dropdown = data.tb_dropdown;
                    var equipment_dropdown = data.equipment_dropdown;
                    var subaction_data = data.subaction_table_data;
                    var selected_value = '';
                    var selected = '';

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
                    thead_columns += '<th class="document-owner">Owner</th>'; //moved here
                    thead_columns += '<th class="document-code">Document Code</th>';
                    thead_columns += '<th class="entry-date">Entry Date</th>';
                    thead_columns += '<th class="improvement-type">Improvement Type</th>';
                    thead_columns += '<th>Action/Process Step</th>';
                    thead_columns += '<th>Action Status</th>';
                    thead_columns += '<th>Location</th>';
                    thead_columns += '<th class="th-action-group">Group</th>';
                    thead_columns += '<th class="due-date">Due Date</th>';
                    thead_columns += '<th>PG</th>';
                    thead_columns += '<th class="comments">Comments</th>';
                    thead_columns += '<th class="reply">Reply</th>';
                    thead_columns += '<th class="text-center actions">Action</th>';


                    thead_columns += '</tr>';

                    //$action_tracker_container_old.append(column_names);  
                    $table_head.append(thead_columns);

                    $.each(table_data, function(index, item) {

                        var row_table = '<tr class="data-row">';

                        //asset
                        row_table += '<td class="asset-value">';
                        if (item.asset != null) {
                            row_table += item.asset;
                        }
                        row_table += '</td>';

                        //tag number
                        row_table += '<td class="tag-number-value">';
                        if (item.tag_number != null) {
                            row_table += item.tag_number;
                        }
                        row_table += '</td>';

                        //item description
                        row_table += '<td><select name="equipment_description" id="" class="table-select">';
                        if (item.criticality_analysis_id != null) {
                            selected_value = '<option value="' + item.criticality_analysis_id + '">' + item.equipment_description + '&nbsp;</option>';
                            selected = '<option value="' + item.criticality_analysis_id + '" selected>' + item.equipment_description + '&nbsp;</option>';
                            row_table += '<option></option>';
                            row_table += selected;
                            equipment_dropdown = equipment_dropdown.replace(selected_value, '');
                        } else {
                            row_table += '<option></option>';
                        }
                        row_table += equipment_dropdown; //item.equipment description
                        row_table += '</select></td>';

                        //code
                        row_table += '<td class="more-details code-value">';
                        if (item.code != null) {
                            row_table += item.code;
                        }
                        row_table += '</td>';

                        //pce
                        row_table += '<td class="pce-value">';
                        if (typeof item.pce !== 'undefined') {
                            row_table += item.pce;
                        }
                        row_table += '</td>'; //pce

                        //sce
                        row_table += '<td class="sce-value">';
                        if (typeof item.sce !== 'undefined') {
                            row_table += item.sce;
                        }
                        row_table += '</td>';

                        //ece
                        row_table += '<td class="ece-value">';
                        if (typeof item.ece !== 'undefined') {
                            row_table += item.ece;
                        }
                        row_table += '</td>';

                        //sis
                        row_table += '<td class="sis-value">';
                        if (typeof item.sis !== 'undefined') {
                            row_table += item.sis;
                        }
                        row_table += '</td>';

                        //status
                        row_table += '<td class="status-value">';
                        if (typeof item.day_status !== 'undefined') {
                            row_table += item.day_status;
                        }
                        row_table += '</td>';

                        //cv
                        row_table += '<td class="cv-value">';
                        if (typeof item.cv !== 'undefined') {
                            row_table += item.cv;
                        }
                        row_table += '</td>';

                        //cas
                        row_table += '<td class="cas-value">';
                        row_table += item.cas;
                        row_table += '</td>';

                        //spf
                        row_table += '<td class="spf-value">';
                        if (typeof item.spf !== 'undefined') {
                            row_table += item.spf;
                        }
                        row_table += '</td>';

                        //obs
                        row_table += '<td class="obs-value">';
                        if (typeof item.obs !== 'undefined') {
                            row_table += item.obs;
                        }
                        row_table += '</td>';

                        //owner
                        row_table += '<td class="input-field"><select name="owner" id="document_name" class="select2-dropdown table-select document-owner">';
                        row_table += '<option value="' + item.owner + '">' + item.full_name + '</option>';
                        row_table += user_options;
                        row_table += '</select></td>';

                        //document
                        row_table += '<td class="doc-code document-dropdown input-field"><select name="document_id" class="table-select">';
                        selected_value = '<option value="' + item.document_id + '">' + item.document_code + ':' + item.document_name + '&nbsp;</option>';
                        selected = '<option value="' + item.document_id + '" selected>' + item.document_code + ': ' + item.document_name + '&nbsp;</option>';
                        if (item.document_id != null) {
                            row_table += '<option value="null">:</option>';
                        }
                        row_table += selected;
                        //alert(existing_document_name_options);
                        //row_table += selected_value;

                        existing_document_name_options = existing_document_name_options.replace(selected_value, '');

                        row_table += existing_document_name_options;
                        row_table += '</select></td>';

                        //entry date
                        row_table += '<td class="input-field"><input type="text" class="form-control datepicker-action-tracker" name="entry_date" value="';
                        row_table += item.entry_date;
                        row_table += '"></td>';

                        //types of improvement
                        row_table += '<td class="input-field"><select name="types_of_improvement" id="" class="table-select improvement-type">';
                        if (item.improvement_id != null) {
                            row_table += '<option></option>';
                            row_table += item.improvement;
                        } else {
                            row_table += '<option></option>';
                            row_table += item.improvement;
                        }
                        row_table += '</select></td>';

                        //action/process step
                        row_table += '<td class="input-field"><input type="text" class="form-control " name="action_process_step" value="';
                        row_table += item.action_process;
                        row_table += '"></td>';

                        //action status
                        row_table += '<td class="input-field"><select class="form-control color-select ' + item.status_color + '" name="action_tracker_status">';
                        row_table += item.status;
                        row_table += '</select></td>';

                        

                        //location
                        row_table += '<td class="input-field"><select name="location" class="table-select">';
                        row_table += '<option value="null"></option>';
                        row_table += item.location;
                        row_table += '</select></td>';


                        //category
                        row_table += '<td class="input-field"><select name="action_group" id="category" class="table-select select-action-group">';
                        if (item.category_id != null) {
                            row_table += '<option></option>';
                            row_table += item.category;
                        } else {
                            row_table += '<option></option>';
                            row_table += item.category;
                        }
                        row_table += '</select></td>';

                        //due date
                        row_table += '<td class="input-field"><input type="text" class="form-control datepicker-action-tracker" name="due_date" value="';
                        row_table += item.due_date;
                        row_table += '"></td>';

                        row_table += '<td class="percentages input-field"><select name="progress" class="table-select">'; //pg
                        row_table += item.progress;
                        row_table += '</select></td>';

                        //comments
                        row_table += '<td class="comments input-field" ><input type="text" class="form-control " name="comments" value="';
                        row_table += item.comments;
                        row_table += '"></td>';

                        //reply
                        row_table += '<td class="reply input-field">';
                        row_table += item.reply; //reply item.reply
                        row_table += '</td>';

                        //action buttons
                        row_table += '<td class="text-center action-column"><a href="#" class="btn btn-bordered btn-info add-subaction-tracker btn-sm"><span class="glyphicon glyphicon-chevron-down"></span></a> ';
                        row_table += '<a href="#" class="btn btn-bordered btn-danger delete-row-action-tracker btn-sm"><span class="glyphicon glyphicon-minus"></span></a> ';

                        row_table += '<span class="show-files-group">';
                        //file upload view
                        if ((item.uploads).length < 1) {
                            row_table += '<a href="#" class="btn btn-danger show-files-action-tracker btn-sm" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                        } else {
                            $.each(item.uploads, function(index, fileupload) {
                                if (index == 0) {
                                    row_table += '<a href="' + base_url + 'uploads/' + fileupload.filename + '" class="btn btn-success show-files-action-tracker btn-sm img-lightbox" data-lightbox="action-tracker-' + item.action_tracker_id + '"><span class="glyphicon glyphicon-picture"></span></a> ';
                                } else {
                                    row_table += '<a href="' + base_url + 'uploads/' + fileupload.filename + '" class="hidden btn btn-success show-files-action-tracker btn-sm img-lightbox" data-lightbox="action-tracker-' + item.action_tracker_id + '"><span class="glyphicon glyphicon-picture"></span></a> ';
                                }
                            });
                        }

                        row_table += '</span>';


                        row_table += '<a href="#" class="btn btn-info attach-action-tracker btn-sm"><span class="glyphicon glyphicon-paperclip"></span></a> ';
                        row_table += '<a href="#" class="btn btn-info edit-action-tracker btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span></a> ';
                        row_table += '<p class="action-tracker-id hidden">' + item.action_tracker_id + '</p>';
                        /*row_table += '<p class="author-name hidden">' + item.author_name + '</p>';*/
                        row_table += '<p class="author-id hidden">' + item.author_id + '</p></td>';



                        row_table += '</tr>';


                        //$action_tracker_container_old.append(row_html);
                        $table_body.append(row_table);

                        $.each(subaction_data, function(index, sub) {

                            if (item.action_tracker_id == sub.action_tracker_id) {
                                var sub_row_table = '<tr class="subaction-data-row">';
                                sub_row_table += '<td colspan="13" class="subaction-equipment input-field"></td>';

                                sub_row_table += '<td class="subaction-owner input-field"><select name="owner" id="document_name" class="select2-dropdown table-select document-owner">';
                                sub_row_table += '<option value="' + sub.subaction_owner + '">' + sub.subaction_full_name + '</option>';
                                sub_row_table += user_options;
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-doc-code document-dropdown input-field"><select name="document_id" class="table-select">';
                                selected_value = '<option value="' + sub.subaction_document_id + '">' + sub.subaction_document_code + ':' + sub.subaction_document_name + '&nbsp;</option>';
                                selected = '<option value="' + sub.subaction_document_id + '" selected>' + sub.subaction_document_code + ': ' + sub.subaction_document_name + '&nbsp;</option>';
                                if (sub.subaction_document_id != null) {
                                    sub_row_table += '<option value="null">:</option>';
                                }
                                sub_row_table += selected;
                                //alert(existing_document_name_options);
                                //row_table += selected_value;

                                existing_document_name_options = existing_document_name_options.replace(selected_value, '');

                                sub_row_table += existing_document_name_options;
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-entry-date input-field"><input type="text" class="form-control datepicker-action-tracker" name="entry_date" value="';
                                sub_row_table += sub.subaction_entry_date;
                                sub_row_table += '"></td>';

                                sub_row_table += '<td class="subaction-improvement input-field"><select class="table-select improvement-type" name="types_of_improvement">';
                                if (sub.subaction_improvement_id != null) {
                                    sub_row_table += '<option></option>';
                                    sub_row_table += sub.subaction_improvement;
                                } else {
                                    sub_row_table += '<option></option>';
                                    sub_row_table += sub.subaction_improvement;
                                }
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-process-step input-field"><input type="text" class="form-control " name="action_process_step" value="';
                                sub_row_table += 'sub.subaction_process';
                                sub_row_table += '"></td>';

                                sub_row_table += '<td class="subaction-status input-field"><select class="form-control color-select ' + sub.subaction_status_color + '" name="action_tracker_status">';
                                sub_row_table += sub.subaction_status;
                                sub_row_table += '</select></td>';

                                

                                sub_row_table += '<td class="subaction-location input-field"><select name="location" class="table-select">';
                                sub_row_table += '<option value="null"></option>';
                                sub_row_table += sub.subaction_location;
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-group input-field"><select name="action_group" id="category" class="table-select select-action-group">';
                                if (sub.subaction_category_id != null) {
                                    sub_row_table += '<option></option>';
                                    sub_row_table += sub.subaction_category;
                                } else {
                                    sub_row_table += '<option></option>';
                                    sub_row_table += sub.subaction_category;
                                }
                                sub_row_table += '</select></td>';

                                sub_row_table += '<td class="subaction-due-date input-field"><input type="text" class="form-control datepicker-action-tracker" name="due_date" value="';
                                sub_row_table += sub.subaction_due_date;
                                sub_row_table += '"></td>';

                                sub_row_table += '<td class="subaction-pg input-field"><select name="progress" class="table-select">'; //pg
                                sub_row_table += sub.subaction_progress;
                                sub_row_table += '</select></td>';

                                //comments
                                sub_row_table += '<td class="subaction-comments input-field" ><input type="text" class="form-control " name="comments" value="';
                                sub_row_table += sub.subaction_comments;
                                sub_row_table += '"></td>';

                                //reply
                                sub_row_table += '<td class="subaction-reply input-field" >';
                                sub_row_table += sub.reply;
                                sub_row_table += '</td>';

                                sub_row_table += '<td class="subaction-action text-center">';
                                sub_row_table += '<a href="#" class="btn btn-bordered btn-info add-subaction-tracker btn-sm" style="visibility:hidden"><span class="glyphicon glyphicon-chevron-down"></span></a> ';
                                sub_row_table += '<a href="#" class="btn btn-bordered btn-danger delete-row-subaction-tracker btn-sm"><span class="glyphicon glyphicon-minus"></span></a> ';

                                sub_row_table += '<span class="show-files-group">';
                                //file upload view
                                if ((sub.uploads).length < 1) {
                                    sub_row_table += '<a href="#" class="btn btn-danger show-files-subaction-tracker btn-sm" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                                } else {
                                    $.each(sub.uploads, function(index, fileupload) {
                                        if (index == 0) {
                                            sub_row_table += '<a href="' + base_url + 'uploads/' + fileupload.filename + '" class="btn btn-success show-files-subaction-tracker btn-sm img-lightbox" data-lightbox="subaction-tracker-' + sub.subaction_tracker_id + '"><span class="glyphicon glyphicon-picture"></span></a> ';
                                        } else {
                                            sub_row_table += '<a href="' + base_url + 'uploads/' + fileupload.filename + '" class="hidden btn btn-success show-files-subaction-tracker btn-sm img-lightbox" data-lightbox="subaction-tracker-' + sub.subaction_tracker_id + '"><span class="glyphicon glyphicon-picture"></span></a> ';
                                        }
                                    });
                                }

                                sub_row_table += '</span>';

                                sub_row_table += '<a href="#" class="btn btn-info attach-subaction-tracker btn-sm"><span class="glyphicon glyphicon-paperclip"></span></a> ';
                                sub_row_table += '<a href="#" class="btn btn-info edit-subaction-tracker btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span></a> ';
                                sub_row_table += '<p class="subaction-tracker-id hidden">' + sub.subaction_tracker_id + '</p>';
                                sub_row_table += '<p class="action-tracker-id hidden">' + item.action_tracker_id + '</p>';
                                /*sub_row_table += '<p class="sub-author-id hidden">' + sub.author_name + '</p>';*/
                                sub_row_table += '<p class="sub-author-id hidden">' + sub.author_id + '</p>';
                                sub_row_table += '</td>';

                                sub_row_table += '</tr>';

                                $table_body.append(sub_row_table);
                            }
                        });
});

dateEffects();
tooltipsAndPopovers();
updateActionTrackerDocumentDropdown();

if(flash_action_id != ''){
    var hidden_p = $('.data-row').find('p.action-tracker-id:contains("'+flash_action_id+'")'); 
    var parent_row = hidden_p.closest('.data-row');     
    parent_row.find('input[name=comments]').focus().blur();
                        //console.log(parent_row);
                        parent_row.css('background-color','#76EAAA');
                        setTimeout(function() {
                            parent_row.css('background-color','#fff');
                        }, 1500);

                    }

                    if(flash_subaction_id != ''){
                        var hidden_p_sub = $('.subaction-data-row').find('p.subaction-tracker-id:contains("'+flash_subaction_id+'")'); 
                        var parent_row_sub = hidden_p_sub.closest('.subaction-data-row');     
                        parent_row_sub.find('input[name=comments]').focus().blur();
                        //console.log(parent_row);
                        parent_row_sub.css('background-color','#76EAAA');
                        setTimeout(function() {
                            parent_row_sub.css('background-color','#fff');
                        }, 1500);

                    }

                    $('p.flash-action-id').text('');
                    $('p.flash-subaction-id').text('');
                    //select_with_search();
                    //bootstrapTooltipEffects();
                    //toggle_action_tracker_table_columns();
                }
            }
        });

}
else{
    $no_search.removeClass('hidden');
}
}

function updateActionTracker() {
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
            "improvement": improvement,
            "author": current_user_id

            /*to do action tracker filter variables here*/
        };


        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                console.log(data);

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
                $row_data.find('.author-id').text(current_user_id);
                $row_data.find('.reply').text('');

                if (data.asset != null) {
                    $row_data.find('.asset-value').text(data.asset);
                }
                if (data.tag_number != null) {
                    $row_data.find('.tag-number-value').text(data.tag_number);
                }
                if (data.code != null) {
                    $row_data.find('.code-value').text(data.code);
                }
                if (data.pce != null) {
                    $row_data.find('.pce-value').text(data.pce);
                }
                if (data.sce != null) {
                    $row_data.find('.sce-value').text(data.sce);
                }
                if (data.ece != null) {
                    $row_data.find('.ece-value').text(data.ece);
                }
                if (data.sis != null) {
                    $row_data.find('.sis-value').text(data.sis);
                }
                if (data.cv != null) {
                    $row_data.find('.cv-value').text(data.cv);
                }
                if (data.day_status != null) {
                    $row_data.find('.status-value').html(data.day_status.replace(/\"/g, ""));
                    //$row_data.find('.status-value').css({'font-family':'FontAwesome'});
                }
                if (data.cas != null) {
                    $row_data.find('.cas-value').text(data.cas);
                }
                if (data.spf != null) {
                    $row_data.find('.spf-value').text(data.spf);
                }
                if (data.obs != null) {
                    $row_data.find('.obs-value').text(data.obs);
                }


                $row_data.find('.reply').text(data.reply ? data.reply: '');
                //console.log(data);

                $row_data.find('td.input-field').addClass('has-success');
                $row_data.find('select[name="types_of_improvement"]').css('border-color', '#1e9765');
                $row_data.find('select[name="equipment_description"]').css('border-color', '#1e9765');
                $row_data.find('select[name="document_id"]').css('border-color', '#1e9765');
                $row_data.find('select[name="equipment_description"]').css('border-color', '#1e9765');
                $row_data.find('select[name="owner"]').css('border-color', '#1e9765');
                $row_data.find('select[name="location"]').css('border-color', '#1e9765');
                $row_data.find('select[name="action_group"]').css('border-color', '#1e9765');
                $row_data.find('select[name="progress"]').css('border-color', '#1e9765');

                setTimeout(function() {
                    $row_data.find('td.input-field').removeClass('has-success');
                    $row_data.find('select[name="types_of_improvement"]').css('border-color', 'gray');
                    $row_data.find('select[name="equipment_description"]').css('border-color', 'gray');
                    $row_data.find('select[name="document_id"]').css('border-color', 'gray');
                    $row_data.find('select[name="equipment_description"]').css('border-color', 'gray');
                    $row_data.find('select[name="owner"]').css('border-color', 'gray');
                    $row_data.find('select[name="location"]').css('border-color', 'gray');
                    $row_data.find('select[name="action_group"]').css('border-color', 'gray');
                    $row_data.find('select[name="progress"]').css('border-color', 'gray');
                }, 1500);


            }
        });




});
}

function updateSubActionTracker() {
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

                $row_data.find('td.input-field').addClass('has-success');
                $row_data.find('select[name="types_of_improvement"]').css('border-color', '#1e9765');
                $row_data.find('select[name="equipment_description"]').css('border-color', '#1e9765');
                $row_data.find('select[name="document_id"]').css('border-color', '#1e9765');
                $row_data.find('select[name="equipment_description"]').css('border-color', '#1e9765');
                $row_data.find('select[name="owner"]').css('border-color', '#1e9765');
                $row_data.find('select[name="location"]').css('border-color', '#1e9765');
                $row_data.find('select[name="action_group"]').css('border-color', '#1e9765');
                $row_data.find('select[name="progress"]').css('border-color', '#1e9765');
                $row_data.find('.subaction-reply').text(data.reply ? data.reply : '');

                setTimeout(function() {
                    $row_data.find('td.input-field').removeClass('has-success');
                    $row_data.find('select[name="types_of_improvement"]').css('border-color', 'gray');
                    $row_data.find('select[name="equipment_description"]').css('border-color', 'gray');
                    $row_data.find('select[name="document_id"]').css('border-color', 'gray');
                    $row_data.find('select[name="equipment_description"]').css('border-color', 'gray');
                    $row_data.find('select[name="owner"]').css('border-color', 'gray');
                    $row_data.find('select[name="location"]').css('border-color', 'gray');
                    $row_data.find('select[name="action_group"]').css('border-color', 'gray');
                    $row_data.find('select[name="progress"]').css('border-color', 'gray');
                }, 1500);
            }
        });
});
}

function addRemoveActionTrackerButtons() {



    /*var $action_tracker_container = $('#action-tracker-ajax');
    var $table_body = $action_tracker_container.find('tbody');

    $(document).on('click', '.add-action-tracker-row', function(e) {
        //alert('success');

        if ($table_body.find('.data-row').length > 0) {
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
                "author": current_user_id,
                //"document_id": document_id,
                //"reference": reference,
                //"action_tracker_status": action_tracker_status,
                "ajax_add": 'true'

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
                    cloned_row.find('.author-id').text(current_user_id);
                    cloned_row.find('select[name=group] option:selected').removeAttr("selected");
                    cloned_row.find('input[name=comments]').val('');
                    cloned_row.find('.reply').text('');

                    var show_file = '<a href="#" class="btn btn-danger show-files-action-tracker btn-sm" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                    cloned_row.find('span.show-files-group').html(show_file);
                    $action_tracker_container.append(cloned_row);

                    //row_table += '<option></option>';

                    dateEffects();
                    tooltipsAndPopovers();
                    updateActionTrackerDocumentDropdown();



                }
            });

        }

    });*/
}

function deleteSpecificRowActionTracker() {

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

                    $row.fadeOut(300, function() {
                        $(this).remove();
                    });

                    var subaction_rows = $action_tracker_container.find('tr.subaction-data-row');

                    //remove all subrows
                    $.each(subaction_rows, function(index) {
                        var sub_id = $(this).find('p.action-tracker-id').text()
                        if (parseInt(sub_id) == id) {
                            $(this).fadeOut(300, function() {
                                $(this).remove();
                            });
                        }
                    });

                    if ($action_tracker_container.find('.data-row').length < 2) {
                        $('.remove-action-tracker-row').addClass('hidden');
                        $('.add-action-tracker-row').addClass('hidden');

                        getActionTrackerList();
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

                    $row.fadeOut(300, function() {
                        $(this).remove();
                    });

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

function uploadFromSpecificRowActionTracker() {

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
        var input_id = '<input type="hidden" name="action_tracker_id" value="' + id + '" >';

        //make the form an ajaxform
        var ajax_options = {
            dataType: 'json',
            beforeSubmit: function() {

                var upload_check = 1;

                $('input[type="file"]').each(function() {
                    var $this = $(this);
                    if ($this.val() == '') {
                        upload_check = 0;
                    }
                });

                if (upload_check == 0) {
                    $upload_form_modal.find('.upload-errors').html('<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><small>Please add a file on all input fields</small></div>')
                    return false;
                }

                var file_container_height = $upload_form_modal.find('.attach-files-container').height();
                $upload_form_modal.find('.uploading-progress').css('height', file_container_height);
                $upload_form_modal.find('.uploading-progress').removeClass('hidden');
                $upload_form_modal.find('.attach-files-container').addClass('hidden');
                $upload_form_modal.find('.upload-errors').html('');
            },
            success: function(data) {


                var show_files_group = $row.find('span.show-files-group');

                var file_rows = $upload_form_modal.find('.attach-files > .row');

                $.each(data.file_check, function(index, check) {
                    $.each(file_rows, function(i) {
                        if (index == i) {
                            $(this).find('.col-sm-3').removeClass('hidden');
                            if (check.checked == 0) {
                                $(this).find('.col-sm-3').html('<span class="glyphicon glyphicon-remove red"></span>');
                            } else {
                                $(this).find('.col-sm-3').html('<span class="glyphicon glyphicon-ok green"></span>');
                            }
                        }


                    });

                });


                var show_file_group_html = '';

                //error uploads


                //upload data
                var upload_data = data.upload_data;
                if (upload_data.length < 1) {
                    show_file_group_html += '<a href="#" class="btn btn-danger show-files-action-tracker btn-sm img-lightbox" data-lightbox="action-tracker-' + id + '" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                } else {
                    $.each(upload_data, function(index, data_file) {
                        if (index == 0) {
                            show_file_group_html += '<a href="' + base_url + 'uploads/' + data_file.filename + '" class="btn btn-success show-files-action-tracker btn-sm img-lightbox" data-lightbox="action-tracker-' + id + '"><span class="glyphicon glyphicon-picture"></span></a> ';
                        } else {
                            show_file_group_html += '<a href="' + base_url + 'uploads/' + data_file.filename + '" class="btn btn-success show-files-action-tracker btn-sm img-lightbox hidden" data-lightbox="action-tracker-' + id + '"><span class="glyphicon glyphicon-picture" ></span></a> ';
                        }
                    });
                }

                //hidden
                setTimeout(function() {
                    $upload_form_modal.find('.uploading-progress').addClass('hidden');
                    $upload_form_modal.find('.attach-files-container').removeClass('hidden');
                    show_files_group.html(show_file_group_html);

                    if (data.errors != '') {
                        $upload_form_modal.find('.upload-errors').html('<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><br><small>' + data.errors + '</small></div>');
                    } else {

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

        var input_id = '<input type="hidden" name="subaction_tracker_id" value="' + id + '" >';

        //make the form an ajaxform
        var ajax_options = {
            dataType: 'json',
            beforeSubmit: function() {

                var upload_check = 1;

                $('input[type="file"]').each(function() {
                    var $this = $(this);
                    if ($this.val() == '') {
                        upload_check = 0;
                    }
                });

                if (upload_check == 0) {
                    $upload_form_modal.find('.upload-errors').html('<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><small>Please add a file on all input fields</small></div>')
                    return false;
                }

                var file_container_height = $upload_form_modal.find('.attach-files-container').height();
                $upload_form_modal.find('.uploading-progress').css('height', file_container_height);
                $upload_form_modal.find('.uploading-progress').removeClass('hidden');
                $upload_form_modal.find('.attach-files-container').addClass('hidden');
                $upload_form_modal.find('.upload-errors').html('');
            },
            success: function(data) {

                var show_files_group = $row.find('span.show-files-group');

                var file_rows = $upload_form_modal.find('.attach-files > .row');

                $.each(data.file_check, function(index, check) {
                    $.each(file_rows, function(i) {
                        if (index == i) {
                            $(this).find('.col-sm-3').removeClass('hidden');
                            if (check.checked == 0) {
                                $(this).find('.col-sm-3').html('<span class="glyphicon glyphicon-remove red"></span>');
                            } else {
                                $(this).find('.col-sm-3').html('<span class="glyphicon glyphicon-ok green"></span>');
                            }
                        }


                    });

                });

                var show_file_group_html = '';

                //upload data
                var upload_data = data.upload_data;
                if (upload_data.length < 1) {
                    show_file_group_html += '<a href="#" class="btn btn-danger show-files-subaction-tracker btn-sm img-lightbox" data-lightbox="subaction-tracker-' + id + '" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                } else {
                    $.each(upload_data, function(index, data_file) {
                        if (index == 0) {
                            show_file_group_html += '<a href="' + base_url + 'uploads/' + data_file.filename + '" class="btn btn-success show-files-subaction-tracker btn-sm img-lightbox" data-lightbox="subaction-tracker-' + id + '"><span class="glyphicon glyphicon-picture"></span></a> ';
                        } else {
                            show_file_group_html += '<a href="' + base_url + 'uploads/' + data_file.filename + '" class="btn btn-success show-files-subaction-tracker btn-sm img-lightbox hidden" data-lightbox="subaction-tracker-' + id + '"><span class="glyphicon glyphicon-picture" ></span></a> ';
                        }
                    });
                }

                //hidden
                setTimeout(function() {
                    $upload_form_modal.find('.uploading-progress').addClass('hidden');
                    $upload_form_modal.find('.attach-files-container').removeClass('hidden');
                    show_files_group.html(show_file_group_html);

                    if (data.errors != '') {
                        $upload_form_modal.find('.upload-errors').html('<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><br><small>' + data.errors + '</small></div>');
                    } else {

                    }
                }, 2000);

            }
        };
        //$('#upload-action-tracker').ajaxForm(ajax_options);

        modal_body_hidden_item.html(input_id);


        $upload_form_modal_no.on('click', function(e) {

            $(this).closest('.modal').modal('hide');
            modal_body_hidden_item.html('');

        });

    });
}

function filterMasterActionTracker() {

    var $form = $('#filter-master-action-tracker-form');

    var $main_filter = $form.find('select[name=main_filter]');
    var $sub_filter = $form.find('select[name=sub_filter]');
    var $sub_filter_refresh = $form.find('.sub-filter-spin');
    var $optional_filter = $form.find('select[name=optional_filter]');
    var $optional_filter_refresh = $form.find('.optional-filter-spin');
    var $optional_subfilter = $form.find('select[name=optional_subfilter]');
    var $optional_subfilter_refresh = $form.find('.optional-subfilter-spin');

    $main_filter.change(function(e){

        var $this = $(this);
        var option = $this.val();

        var function_url = 'action_tracker/get_sub_filter';

        var ajax_url = base_url + function_url;

        var dataString = {
            "main_filter": option
        };

        //before ajax

        $sub_filter.hide();
        $optional_subfilter.hide();
        $optional_subfilter.prop('disabled', true);
        $sub_filter_refresh.removeClass('hidden');

        //start ajax

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'html',
            success: function(data) {
                $sub_filter.html(data);
                $optional_filter.prop('disabled',true);
                $optional_filter.addClass('hidden');
                $sub_filter.show();
                $sub_filter_refresh.addClass('hidden');
            }
        }); //end ajax

    }); //end main filter


    $sub_filter.change(function(e){

        var $this = $(this);
        var main_filter_value = $main_filter.val();
        var option = $this.val();

        var function_url = 'action_tracker/get_optional_filter';

        var ajax_url = base_url + function_url;

        var dataString = {
            "main_filter": main_filter_value,
            "sub_filter": option
        };

        //before ajax

        $optional_filter.hide();
        $optional_subfilter.hide();
        $optional_subfilter.prop('disabled', true);
        $optional_filter_refresh.removeClass('hidden');

        //start ajax

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {
                var display = data.display_optional_filter;
                if(display){
                    var options = data.options;
                    $optional_filter.prop('disabled',false);
                    $optional_filter.removeClass('hidden');
                    $optional_filter.html(options);
                    
                }else{
                    $optional_filter.prop('disabled',true);
                    $optional_filter.addClass('hidden');
                }

                $optional_filter.show();
                $optional_filter_refresh.addClass('hidden');
            }
        }); //end ajax

    }); //end main filter



$optional_filter.change(function(e){

    var $this = $(this);
    var main_filter_value = $main_filter.val();
    var sub_filter_value = $sub_filter.val();
    var option = $this.val();

    var function_url = 'action_tracker/get_optional_subfilter';

    var ajax_url = base_url + function_url;

    var dataString = {
        "main_filter": main_filter_value,
        "sub_filter": sub_filter_value,
        "optional_filter": option
    };

        //before ajax

        $optional_subfilter.hide();
        $optional_subfilter_refresh.removeClass('hidden');

        //start ajax

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var display = data.display_optional_filter;
                if(display){
                    var options = data.options;
                    $optional_subfilter.prop('disabled',false);
                    $optional_subfilter.removeClass('hidden');
                    $optional_subfilter.html(options);
                    
                }else{
                    $optional_subfilter.prop('disabled',true);
                    $optional_subfilter.addClass('hidden');
                }

                $optional_subfilter.show();
                $optional_subfilter_refresh.addClass('hidden');
            },
            error: function(data, error){
                console.log(data.responseText);
                console.log(error);
            }
        }); //end ajax

    }); //end optional filter



$(document).on('submit', '#filter-master-action-tracker-form', function(e) {

    var $this = $(this);
    var $table_body;

    var post_data = $this.serializeArray();

        //filter variables
        //var filter_owner = $this.find('select[name=owner]').val();
        //var filter_status = $this.find('select[name=status]').val();

        e.preventDefault();

        getActionTrackerList(post_data); //old function getActionTrackerListOld(filter_owner, filter_status)
        /*
        TODO: filter based on post_data (main_filter, sub_filter, optional_filter)
        EX: basic-decf - document_type table - document_code column
            system - 
            specific system - 

        OUTPUT: must be the same as the currently working action tracker list
        */

    });

}

function addSubactionTrackerRow() {

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

        var current_user_id = $('input[name=current_user_id]').val();

        var function_url = 'action_tracker/create_subaction';

        var ajax_url = base_url + function_url;

        var dataString = {

            "owner": current_user_id,
            "action_tracker_id": action_tracker_id,
            "author": current_user_id
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
                    subaction_row += '<td class="subaction-owner input-field"><select class="table-select document-owner" name="owner" >' + owner_html + '</select></td>';
                    subaction_row += '<td class="subaction-doc-code document-dropdown input-field"><select class="table-select">' + document_html + '</select></td>';
                    subaction_row += '<td class="subaction-entry-date input-field"><input type="text" class="form-control datepicker-action-tracker" name="entry_date" value=""></td>';
                    subaction_row += '<td class="subaction-improvement input-field"><select class="table-select improvement-type" name="types_of_improvement">' + improvement_html + '</select></td>';
                    subaction_row += '<td class="subaction-process-step input-field"><input class="form-control" name="action_process_step" value=""></td>';
                    subaction_row += '<td class="subaction-status input-field"><select class="form-control color-select bg-white" name="action_tracker_status">' + status_html + '</select></td>';
                    subaction_row += '<td class="subaction-location input-field"><select class="table-select" name="location">' + location_html + '</select></td>';
                    subaction_row += '<td class="subaction-group input-field"><select class="table-select select-action-group" name="action_group">' + group_html + '</select></td>';
                    subaction_row += '<td class="subaction-due-date input-field"><input type="text" class="form-control datepicker-action-tracker" name="due_date" value=""></td>';
                    subaction_row += '<td class="subaction-pg input-field"><select class="table-select" name="progress">' + progress_html + '</select></td>';
                    subaction_row += '<td class="subaction-comments input-field"><input type="text" class="form-control " name="comments" value=""></td>';
                    subaction_row += '<td class="subaction-reply input-field"></td>';
                    subaction_row += '<td class="subaction-action text-center">';
                    subaction_row += '<a href="#" class="btn btn-bordered btn-info add-subaction-tracker btn-sm" style="visibility:hidden"><span class="glyphicon glyphicon-chevron-down"></span></a> ';
                    subaction_row += '<a href="#" class="btn btn-bordered btn-danger delete-row-subaction-tracker btn-sm"><span class="glyphicon glyphicon-minus"></span></a> ';
                    subaction_row += '<span class="show-files-group">';
                    subaction_row += '<a href="#" class="btn btn-danger show-files-subaction-tracker btn-sm" disabled><span class="glyphicon glyphicon-picture"></span></a> ';
                    subaction_row += '</span>';
                    subaction_row += '<a href="#" class="btn btn-info attach-subaction-tracker btn-sm"><span class="glyphicon glyphicon-paperclip"></span></a> ';
                    subaction_row += '<a href="#" class="btn btn-info edit-subaction-tracker btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span></a> ';
                    subaction_row += '<p class="subaction-tracker-id hidden">' + data + '</p>';
                    subaction_row += '<p class="action-tracker-id hidden">' + action_tracker_id + '</p>';
                    subaction_row += '<p class="sub-author-id hidden">' + current_user_id + '</p>';
                    /*subaction_row += '<p class="sub-author-name hidden">' + 'test' + '</p>';*/
                    subaction_row += '</td>';
                    subaction_row += '</tr>';

                    console.log(data);

                    $row.after(subaction_row);

                    dateEffects();
                    updateActionTrackerDocumentDropdown();
                }
        }); //end ajax


});
}

function toggleActionTrackerTableColumns() {
    $(document).on('click', '#toggle-columns', function(e) {
        e.preventDefault();

        var table = $('table#action-tracker-ajax');
        var data_row = table.find('tr.data-row');
        var change_icon = $(this).find('i');

        if (table.find('.show-columns').length > 0) {
            data_row.find('td:nth-child(4),td:nth-child(5),td:nth-child(6),td:nth-child(7),td:nth-child(8),td:nth-child(9),td:nth-child(10),td:nth-child(11),td:nth-child(12),td:nth-child(13)').hide();
            table.find('th:nth-child(4),th:nth-child(5),th:nth-child(6),th:nth-child(7),th:nth-child(8),th:nth-child(9),th:nth-child(10),th:nth-child(11),th:nth-child(12),th:nth-child(13)').hide();
            table.find('td.subaction-equipment').attr('colspan', 3);
            table.find('th#main-description').removeClass('show-columns');
            table.animate({
                width: '1900px'
            }, 'slow', function() {
                change_icon.removeClass('glyphicon-chevron-left');
                change_icon.addClass('glyphicon-chevron-right');
            });

            //$('div.page-header').animate({width:'1866px'},'slow');

        } else {
            data_row.find('td:nth-child(4),td:nth-child(5),td:nth-child(6),td:nth-child(7),td:nth-child(8),td:nth-child(9),td:nth-child(10),td:nth-child(11),td:nth-child(12),td:nth-child(13)').show();
            table.find('th:nth-child(4),th:nth-child(5),th:nth-child(6),th:nth-child(7),th:nth-child(8),th:nth-child(9),th:nth-child(10),th:nth-child(11),th:nth-child(12),th:nth-child(13)').show();
            table.find('th#main-description').addClass('show-columns');
            table.find('td.subaction-equipment').attr('colspan', 13);
            table.animate({
                width: '2400px'
            }, 'slow', function() {
                change_icon.removeClass('glyphicon-chevron-right');
                change_icon.addClass('glyphicon-chevron-left');
            });

            //$('div.page-header').animate({width:'2370px'},'slow');
        }
    });
}

function createNewAttachFileRowActionTracker() {
    $(document).on('click', 'button.clone-attach-files', function(e) {
        e.preventDefault();

        var file_row = '<div class="row"><div class="col-sm-offset-1 col-sm-8"><div class="fileinput fileinput-new input-group" data-provides="fileinput"><div class="form-control action-tracker-upload" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div><span class="input-group-addon btn btn-default btn-file"><span class="glyphicon glyphicon-paperclip"></span><input type="file" name="userfile[]" ></span><a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-remove"></span></a></div></div><div class="col-sm-3 hidden text-center"></div></div>';

        $('.attach-files').append(file_row);

    });
}

function updateActionTrackerDocumentDropdown() {
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
                dropdown.empty().append('<option value="null" selected="">:  &nbsp;</option>' + data);
            }
        });

    });
}

function createActionTrackerModal() {
    var $create_action = $('a.create-action, .add-action-tracker-row');
    var $down_create_modal = $('#create-action-tracker');

    $create_action.click(function(e){
        $down_create_modal.modal();
        var datePicker = $('body').find('.datepicker');
        $(datePicker).css('z-index', '10000');
    });
}

function scrollToData(data_view_selector) {
    $('html, body').animate({
        scrollTop: $(data_view_selector).offset().top
    }, 1000);
}


function button_scroll() {
    $(document).on('click', 'a.glyphicon-arrow-right', function(e) {
        e.preventDefault();
        var container_value = $('#criticality-analysis-per-day').width();
        var pos = $('#criticality-analysis-per-day').scrollLeft();
        var extra_value = 0;
        var pos_value = pos % container_value;
        if (pos_value != 0) {
            extra_value = container_value - pos_value;
        }

        $('#criticality-analysis-per-day').animate({
            scrollLeft: pos + container_value + extra_value
        }, 300);
        //$("span").text(x += 1);
    });
    $(document).on('click', 'a.glyphicon-arrow-left', function(e) {
        e.preventDefault();
        var container_value = $('#criticality-analysis-per-day').width();
        var pos = $('#criticality-analysis-per-day').scrollLeft();
        var extra_value = 0;
        var pos_value = pos % container_value;
        if (pos_value != 0) {
            extra_value = container_value - pos_value;
        }
        $('#criticality-analysis-per-day').animate({
            scrollLeft: pos - container_value + extra_value
        }, 300);
        //$("span").text(x += 1);
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

function deliverableDateRange(){
    var a = $('p.pp-estimated-start-date').text();
    var b = $('p.pp-end-date').text();
    var start_date_value = $('input.deliverable_start_date_range').val();
    
    //initial check
    if(start_date_value != null && start_date_value != ''){
        console.log(start_date_value);

        $('input.deliverable_end_date_range').datepicker({
            format: 'dd/mm/yyyy',
            startDate: start_date_value,
            endDate: b,
            autoclose: true
        });
    }

    if (a != null || a != '') {
        $('input.deliverable_start_date_range').datepicker({
            format: 'dd/mm/yyyy',
            startDate: a,
            endDate: b,
            orientation: 'auto',
            autoclose: true
        }).on('changeDate', function(e) {

            var $selected_end_range = $(this).siblings('input.deliverable_end_date_range');
            $selected_end_range.datepicker('remove');
            $selected_end_range.val('');
            var start_day = $(this).val();
            //console.log(start_day);

            if (start_day != null) {

                if (start_day != null || start_day != '') {

                    $selected_end_range.datepicker({
                        format: 'dd/mm/yyyy',
                        startDate: start_day,
                        endDate: b,
                        autoclose: true
                    });
                }

            }
        });
    }
}



function ajaxSetup() {
    $.ajaxSetup({
        data: {
            "9s8fjshd324hd98s": $.cookie('k34lk3sdf08sdf34ddfr0')
        }
    });
}


/* REPORTS */
function user_compliance_dashboard(asset, category, code, last_review_date, category_list, owner_id) {

    //console.log(arguments)

    var $criticality_analysis = $('#compliance-dashboard');
    var $create_criticality_analysis = $('.create-criticality-analysis');

    if ($criticality_analysis.length > 0) {
        var $criticality_analysis_body = $criticality_analysis.find('tbody');
        var $criticality_analysis_loading = $('#loading-criticality-analysis');

        var $no_criticality_analysis = $('#no-criticality-analysis');
        var $no_search_found = $('#no-search-found');

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

                        if (item.group_rowspan != null) {
                            row_html += '<td class="resultant-availability text-middle text-center" rowspan="' + item.group_rowspan + '">';
                            row_html += item.resultant;
                            row_html += '</td>';

                            row_html += '<td class="compliant text-middle text-center ' + compliant_color + '" rowspan="' + item.group_rowspan + '">';
                            row_html += compliant;
                            row_html += '</td>';
                        }



                        row_html += '<td class="text-center">';
                        if (session_asset_role == 'superuser') {
                            row_html += '<a href="#" class="btn btn-info edit-criticality-analysis"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
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

function update_user_single_index() {

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

        var function_url = 'criticality-analysis/update_single_index';

        var ajax_url = base_url + function_url;

        var dataString = {

            "owner": owner_value,
            "defect_elimination": defect_elimination_value,
            "project_plan": project_plan_value,
            "technical_bulletin": technical_bulletin_value,
            "criticality_analysis_id": criticality_analysis_id_value
        };

        //console.log(dataString);

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'html',
            success: function(data) {
                //console.log(data);
                $table_body.html('');
                //user_single_index();
            }
        });


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

                            if (item.cv_greater_than_cas) {
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

                                row_html += '<td class="atex-m">';
                                row_html += item.atex_m;
                                row_html += '</td>';

                                row_html += '<td class="atex-e">';
                                row_html += item.atex_e;
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
                                if (session_asset_role != 'superuser') {
                                    row_html += item.user_value;
                                } else {
                                    row_html += '<select name="owner" class="form-control">';
                                    row_html += table_info.user_dropdown;
                                    row_html += '</select>';
                                }
                                row_html += '</td>';


                                row_html += '<td class="defect-elimination">';
                                if (session_asset_role != 'superuser') {
                                    row_html += item.defect_elimination_value;
                                } else {
                                    row_html += '<select name="defect_elimination" class="table-select">';
                                    row_html += table_info.criticality_defect_elimination_dropdown;
                                    row_html += '</select>';
                                }
                                row_html += '</td>';

                                row_html += '<td class="project-plan">';
                                if (session_asset_role != 'superuser') {
                                    row_html += item.project_plan_value;
                                } else {
                                    row_html += '<select name="project_plan" class="table-select">';
                                    row_html += table_info.criticality_project_plan_dropdown;
                                    row_html += '</select>';
                                }
                                row_html += '</td>';

                                row_html += '<td class="technical-bulletin">';
                                if (session_asset_role != 'superuser') {
                                    row_html += item.technical_bulletin_value;
                                } else {
                                    row_html += '<select name="technical_bulletin" class="table-select">';
                                    row_html += table_info.criticality_technical_bulletin_dropdown;
                                    row_html += '</select>';
                                }
                                row_html += '</td>';

                                if (session_asset_role == 'superuser') {
                                    row_html += '<td class="text-center">';
                                    row_html += '<a href="#" class="btn btn-info edit-criticality-analysis"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
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

                //scrollToData('#single-index-of-failing-equipment table');
                tableReflow();
            }
        });
}
}

function user_failure_rate(asset, category, code, last_review_date, category_list, owner_id, get_csv) {

    var $criticality_analysis = $('#failure-rate');

    if ($criticality_analysis.length > 0) {
        var $criticality_analysis_body = $criticality_analysis.find('tbody');
        var $criticality_analysis_loading = $('#loading-criticality-analysis');

        var $no_criticality_analysis = $('#no-criticality-analysis');
        var $no_search_found = $('#no-search-found');

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
                                row_html += '<input type="text" class="form-control datepicker" name="start_date" value="' + item.start_date + '">';
                                row_html += '</td>';

                                row_html += '<td class="failure-rate">';
                                row_html += '<input type="text" class="form-control" name="failure_rate" value="' + item.failure_rate + '">';
                                row_html += '</td>';

                                row_html += '<td class="mtbf">';
                                row_html += '<input type="text" class="form-control" name="mtbf" value="' + item.mtbf + '">';
                                row_html += '</td>';

                                row_html += '<td class="mttr">';
                                row_html += '<input type="text" class="form-control" name="mttr" value="' + item.mttr + '">';
                                row_html += '</td>';

                                row_html += '<td class="fail-date">';
                                row_html += '<input type="text" class="datepicker form-control" name="fail_date" value="' + item.fail_date + '" >';
                                row_html += '</td>';

                                row_html += '<td class="repair-date">';
                                row_html += '<input type="text" class="datepicker form-control" name="repair_date" value="' + item.repair_date + '" >';
                                row_html += '</td>';

                                row_html += '<td class="estimated-repair-time">';
                                row_html += '<input type="text" class=" form-control" name="estimated_repair_time" value="' + item.estimated_repair_time + '" >';
                                row_html += '</td>';

                                row_html += '<td class="actual-repair-time">';
                                row_html += '<input type="text" class=" form-control" name="actual_repair_time" value="' + item.actual_repair_time + '" >';
                                row_html += '</td>';

                                row_html += '<td class="text-center">';
                                row_html += '<a href="#" class="btn btn-info edit-failure-rate"><span class="glyphicon glyphicon-floppy-disk"></span></a>';

                                if (session_site_role == 'siteadmin') {
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
                //scrollToData("#failure-rate table");
                dateEffects();
                tableReflow();
            }
        });

        //}//end get_csv else
    }
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
            "actual_repair_time": actual_repair_time
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

function delete_failure_rate() {

    var $table_tbody = $('#failure-rate tbody');
    var $edit_action = $('a.delete-failure-rate');

    $(document).on('click', 'a.delete-failure-rate', function(e) {

        $table_tbody.html('');

        var $edit_button = $(this);
        var $row_data = $(this).closest('.data-row');

        e.preventDefault();

        var criticality_analysis_id = $row_data.find('.criticality-analysis-id').text();

        var function_url = 'criticality-analysis/delete';
        var ajax_url = base_url + function_url;
        var dataString = {
            "criticality_analysis_id": criticality_analysis_id
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
                                row_html += '<td class="atex_m">';
                                row_html += item.atex_m;
                                row_html += '</td>';
                                row_html += '<td class="atex_e">';
                                row_html += item.atex_e;
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
                                row_html += '<td class="atex_m">';
                                row_html += table_info.atex_m_dropdown;
                                row_html += '</td>';
                                row_html += '<td class="atex_e">';
                                row_html += table_info.atex_e_dropdown;
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
                                    row_html += '<a href="#" class="btn btn-info edit-criticality-analysis"><span class="glyphicon glyphicon-floppy-disk"></span></a>';

                                    if (session_site_role == 'siteadmin') {
                                        row_html += '<a href="#" class="btn btn-danger delete-criticality-analysis"><span class="glyphicon glyphicon-trash"></span></a>';
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
                                var $atex_m_dropdown = $criticality_analysis_body.find(row_id + 'select[name=atex_m]');
                                var $atex_e_dropdown = $criticality_analysis_body.find(row_id + 'select[name=atex_e]');

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
                                $atex_m_dropdown.val(item.atex_m_value);
                                $atex_e_dropdown.val(item.atex_e_value);

                        }); // end .each


                    } //end else

                }


                //end success  
                scrollToData("#my-criticality-analysis table");
                dateEffects();
                tableReflow();
            }
        });

        //}//end get_csv else
    }
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
        var atex_m_value = $row_data.find('select[name=atex_m]').val();
        var atex_e_value = $row_data.find('select[name=atex_e]').val();
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
            "atex_m": atex_m_value,
            "atex_e": atex_e_value,
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

function update_criticality_analysis_view(json_view_name, query_type) {

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

function filterCriticalityAnalysis() {



    $(document).on('submit', '#filter-criticality-analysis-form', function(e) {

        var $filter_criticality_analysis = $(this);
        var $table_body;

        //initialize tables to be filtered
        var $criticality_analysis_table = $('#my-criticality-analysis');
        var $single_index_table = $('#single-index-of-failing-equipment');
        var $user_compliance_dashboard = $('#compliance-dashboard');
        var $failure_rate_table = $('#failure-rate');
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

        if (category_checked.length > 0) {
            var filter_category = [];
            category_checked.each(function(index) {
                filter_category.push($(this).val());
            });
        } else {
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
        } else if ($failure_rate_table.length > 0) {
            $table_body = $failure_rate_table.find('tbody');
            $table_body.html('');
            user_failure_rate(filter_asset, category, filter_code, filter_last_review_date, filter_category, filter_owner);
        }

    });
}

function filterCriticalityAnalysisValues() {

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

        if (category_checked.length > 0) {
            var filter_category = [];
            category_checked.each(function(index) {
                filter_category.push($(this).val());
            });
        } else {
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

function getCriticalityAnalysisHistoryDailyValues(start_day, end_day, current_month, current_year, asset_role, asset, category, code, last_review_date, category_list, owner_id, get_csv) {

    //console.log(arguments);

    var $cahd = $('#criticality-analysis-per-day'); //left table
    var $cah = $('#my-criticality-analysis-history'); // right table

    var $nosearch = $('.no-search-found-equipment-status');


    var $cah_loading = $('#loading-criticality-analysis-history');
    var $criticality_analysis_history_loading = $('#loading-criticality-analysis-history_values');

    //$('a.glyphicon-arrow-left').addClass('hidden');
    //$('a.glyphicon-arrow-right').addClass('hidden');
    $('.arrow-scroll').addClass('hidden');

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

            if ($nosearch.find('.hidden').length < 1) {
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

                            row_html += '<tr id="data-row-' + item_list.criticality_analysis_id + '" class="data-row fix-row-height">';
                            row_html += '<td class="asset no-wrap-style">';
                            row_html += item_list.asset;
                            row_html += '</td>';
                            row_html += '<td class="tag-number no-wrap-style">';
                            row_html += item_list.tag_number;
                            row_html += '</td>';
                            row_html += '<td class="description no-wrap-style">';
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
                            row_html += '<td class="atex_m">';
                            row_html += item_list.atex_m;
                            row_html += '</td>';
                            row_html += '<td class="atex_e">';
                            row_html += item_list.atex_e;
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
                        row_day_head += '<th class="data-input-status-columns-daily no-wrap-style">Status &nbsp;<a class="mini-tooltip status-mini-tooltip" data-toggle="popover"><i class="fa fa-question-circle hidden-xs"></i></a></th>';
                        row_day_head += '<th class="data-input-hour-column-daily">Hours</th>';
                        row_day_head += '<th class="data-input-action-column-daily text-center">Action</th>';
                        row_day_head += '</tr>';

                        $cahd_head.append(row_day_head);

                        $.each(table_data, function(index, item) {

                            //console.log(item.day_status);



                            var row_html = '';

                            row_html += '<tr id="data-row-' + item.criticality_analysis_id + '" class="data-row fix-row-height">';
                            row_html += '<td class="day_spf_' + start_day + '">';
                            row_html += '<div class=""><select name="spf" class="table-select color-select ' + item.day_spf_color + '">' + table_info.criticality_spf_dropdown + '</select></div>'; //spf dropdown here item.day_spf
                            row_html += '</td>';
                            row_html += '<td class="day_availability_' + start_day + '">';
                            row_html += '<div class=""><select name="avail" class="table-select color-select ' + item.day_availability_color + '">' + table_info.criticality_avail_dropdown + '</select></div>'; // availability dropdown here item.day_availability
                            row_html += '</td>';
                            row_html += '<td class="day_status_' + start_day + '">';
                            row_html += '<div class=""><select name="status" style="font-family:lato,' + font_style + ';" class="table-select color-select ' + item.day_status_color + '">' + table_info.criticality_status_dropdown + '</select></div>'; //status dropdown here item.day_status
                            row_html += '</td>';
                            row_html += '<td class="day_hours_' + start_day + '">';
                            if (item.day_hours == null || item.day_hours == 'null') {
                                row_html += '<div class=""><input type="text" class="form-control input-small text-center" name="hours" value=""></div>';

                            } else {
                                row_html += '<div class=""><input type="text" class="form-control input-small text-center" name="hours" value="' + item.day_hours + '"></div>';
                            }
                            row_html += '</td>';
                            row_html += '<td class="action text-center">';
                            row_html += '<a href="#" class="btn btn-sm btn-info edit-daily-value day-value-' + start_day + '"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
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
                            if (get_csv) {

                                $.each(item_list, function(index, item_listed) {
                                    if (item_listed.criticality_analysis_id == item.criticality_analysis_id) {
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
                        if (get_csv) {
                            JSONtoCSV(csv_data, "sample", true);
                        }
                    }

                    tooltipsAndPopovers();
                    scrollToData("#criticality-analysis-data-input");
                }
            });
}

        //ajax function for no specified day but month and year is specified
        else if (start_day != end_day && month && year) {

            $cahd.removeClass('width-2-days');
            $cahd.removeClass('width-monthly');

            $container_width = $cahd.width();

            if ($nosearch.find('.hidden').length < 1) {
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

                        row_html += '<tr id="data-row-' + item_list.criticality_analysis_id + '" class="data-row fix-row-height">';
                        row_html += '<td class="asset no-wrap-style">';
                        row_html += item_list.asset;
                        row_html += '</td>';
                        row_html += '<td class="tag-number no-wrap-style">';
                        row_html += item_list.tag_number;
                        row_html += '</td>';
                        row_html += '<td class="description no-wrap-style">';
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
                        row_html += '<td class="atex_m">';
                        row_html += item_list.atex_m;
                        row_html += '</td>';
                        row_html += '<td class="atex_e">';
                        row_html += item_list.atex_e;
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



                        if (end_day - start_day >= 1) {
                            $('.arrow-scroll').removeClass('hidden');
                            //$('a.glyphicon-arrow-left').removeClass('hidden');
                            //$('a.glyphicon-arrow-right').removeClass('hidden');
                        }

                        var row_day_head = '<tr>';

                        var number_of_days = daysInMonth(month, year);

                        for (var i = start_day; i <= end_day; i++) {
                            row_day_head += '<th class="data-input-row-header-column text-center resize-column" colspan=5 style="width:' + $container_width + 'px;">&nbsp;<span class="">' + i + '-' + month + '-' + year + '</span>&nbsp;</th>';
                        }
                        row_day_head += '</tr>';

                        $cahd_head.append(row_day_head);


                        var row_head = '<tr>';

                        for (var i = start_day; i <= end_day; i++) {
                            row_head += '<th class="data-input-row-columns">SPF</th>';
                            row_head += '<th class="data-input-row-columns">Avail</th>';
                            row_head += '<th class="data-input-row-columns no-wrap-style">Status &nbsp;<a class="mini-tooltip status-mini-tooltip" data-toggle="popover"><i class="fa fa-question-circle hidden-xs"></i></a></th>';
                            row_head += '<th class="data-input-row-columns">Hours</th>';
                            row_head += '<th class="data-input-action-column text-center">Action</th>';
                        }

                        row_head += '</tr>';

                        $cahd_head.append(row_head);

                        $.each(sis_list, function(index, sis_item) {

                            var current_index = index;
                            //console.log(sis_item.sis_id);
                            //csv
                            if (get_csv) {
                                $.each(item_list, function(index, item_listed) {
                                    if (item_listed.criticality_analysis_id == sis_item.sis_id) {
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
                                        row_html += '<a href="#" class="btn btn-sm btn-info edit-daily-value day-value' + i + '"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
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
                                        if (get_csv) {
                                            csv_data[current_index]['SPF ' + i] = item.day_spf_value;
                                            csv_data[current_index]['AVAIL ' + i] = item.day_availability_value;
                                            csv_data[current_index]['STATUS ' + i] = item.day_status_value;
                                            csv_data[current_index]['HOURS ' + i] = item.day_hours;
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
                                    row_html += '<a href="#" class="btn btn-sm btn-info edit-daily-value day-value-' + i + '"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
                                    row_html += '<p class="sis-id hidden">' + sis_item.sis_id + '</p>';
                                    row_html += '<p class="button-day hidden">' + i + '</p>';
                                    row_html += '<p class="button-month hidden">' + month + '</p>';
                                    row_html += '<p class="button-year hidden">' + year + '</p>';
                                    row_html += '</td>';

                                    var day_object = "none";
                                    daily_value.push(day_object);

                                    //csv
                                    if (get_csv) {
                                        csv_data[current_index]['SPF ' + i] = ' ';
                                        csv_data[current_index]['AVAIL ' + i] = ' ';
                                        csv_data[current_index]['STATUS ' + i] = ' ';
                                        csv_data[current_index]['HOURS ' + i] = ' ';
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

if (get_csv) {
    JSONtoCSV(csv_data, "sample", true);
}
}

tooltipsAndPopovers();
scrollToData("#criticality-analysis-data-input");
}
});
}

}
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

                    if (category_checked.length > 0) {
                        var filter_category = [];
                        category_checked.each(function(index) {
                            filter_category.push($(this).val());
                        });
                    } else {
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
                    update_json_view('criticality_analysis_compliance', 'compliance');


                }
            });


});
}
/* END REPORTS */


/* DOCUMENT RANKING */
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

function moreComments() {

    var more_comments_selector = '#more-comments';

    $(document).on('click', more_comments_selector, function(e) {

        e.preventDefault();

        var $more_comments = $(this);

        var offset = $more_comments.data('offset');

        documentComments(offset);

    });
}

function documentComments(offset, limit) {

    var $comments_section = $('#single-document-comments');
    var $more_comments = $('#more-comments');

    if ($comments_section.length > 0) {

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

                    $more_comments.removeClass('btn-info');
                    $more_comments.addClass('btn-success');
                    $more_comments.html('<i class="fa fa-refresh"></i> Refresh');

                } else {

                    $loading.addClass('hidden');
                    $no_search.addClass('hidden');

                    var new_offset = offset + limit;
                    var record_count = table_info.count;

                    if (new_offset <= record_count) {
                        $more_comments.attr('data-offset', new_offset);
                    } else {
                        $more_comments.hide();
                    }

                    $.each(table_data, function(index, item) {

                        var row_html = '';

                        row_html += '<li class="list-group-item comment-item">';

                        row_html += '<div class="row">';
                        row_html += '<div class="col-xs-2">';
                        row_html += '<img src="' + item.user_image_path + '" class="img-circle img-responsive user-img border-grey" alt="" />';
                        row_html += '</div>';
                        row_html += '<div class="col-xs-10 col-md-10">';
                        row_html += '<div class="comment-body">';
                        row_html += '<p class="strong">' + item.ranking_comment + '</p>';
                        row_html += '<div class="mic-info">';
                        row_html += 'By: <a href="#">' + item.full_name + '</a> on ' + item.ranking_date;
                        row_html += '</div>';
                        row_html += '</div>';
                        row_html += '</div>';
                        row_html += '</div>';
                        row_html += '</li>';

                        $comments_section.append(row_html);


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

function documentHistoryListener() {

    // On click more news...
    $('#more-document-status').click(function(e) {

        e.preventDefault();

        // Get data offset and limit. 
        var $dom = $(this);

        // Variables.
        var offset = parseInt($dom.attr("data-offset")) ;
        var limit = parseInt($dom.attr("data-limit"));
        var document_id = parseInt($dom.attr("data-id"));

        // Function URL.
        var function_url = base_url + 'document/get_user_document_status_post';

        var $data_result = {};

        // Ajax Data String Info.
        var dataString = {
            "document_id" : document_id, 
            "limit" : limit,
            "offset" : offset
        };

        // Append 5 latest news. 
        $.ajax({
            url: function_url,
            type: "POST",
            data: dataString, 
            dataType: "JSON",
            beforeSend: function() {

            },
            success: function(data) {

                //console.log(data);

                $data_result = data;
                $data_result = $data_result.table_data;
                var table_count = data.table_info.count;

                if(offset <= table_count-limit){
                    $dom.show();
                }else{
                    $dom.hide();
                }

                var row_html = '';

                for(var key in $data_result) {
                    /*console.log($data_result[key].fullname);*/

                    row_html += '<tr>';
                    row_html += '<td>';
                    row_html += $data_result[key].fullname;
                    row_html += '</td>';
                    row_html += '<td>';
                    row_html += $data_result[key].status;
                    row_html += '</td>';
                    row_html += '<td>';
                    row_html += $data_result[key].date;
                    row_html += '</td>';
                    row_html += '</tr>';
                }

                $('#document-status-list').append(row_html);
            },
            complete: function() {
                // Change offset. 
                $dom.attr("data-offset", offset + 5);
            }
        });
});
}

function documentStatusList(offset, limit) {

    var $document_status_list = $('#document-status-list');
    var $more_comments = $('#more-document-status');

    if ($document_status_list.length > 0) {

        var $loading = $('#loading');
        var $no_search = $('#no-search-found');

        var document_id = $('input[name=model_id]').val();

        //alert(document_id);

        var limit = limit || 5;
        var offset = offset || 0;

        var function_url = 'document/get_user_document_status_post';

        var ajax_url = base_url + function_url;

        var dataString = {

            "document_id": document_id,
            "limit": limit,
            "offset": offset

        };


        //$loading.removeClass('hidden');
        //$no_search.addClass('hidden');


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

                var document_id = table_info.document_id;

                var tables = '';

                if (table_data.length < 1) {

                    $("#document-status-container").hide();

                    /*$loading.addClass('hidden');
                    $no_search.removeClass('hidden');

                    $more_comments.removeClass('btn-info');
                    $more_comments.addClass('btn-success');
                    $more_comments.html('<i class="fa fa-refresh"></i> Refresh');*/

                } else {

                    $("#document-status-container").show();

                    $loading.addClass('hidden');
                    $no_search.addClass('hidden');

                    var new_offset = offset + limit;
                    var record_count = table_info.count;

                    /*if(record_count <= 5){
                        $('#more-document-status').hide();
                    }else{
                        $('#more-document-status').show();
                    }*/

                    //console.log('new offset:'+new_offset);
                    //console.log('record count:'+record_count);

                    /*if (new_offset <= record_count) {
                        //$more_comments.attr('data-offset', new_offset);
                    } else {
                        $more_comments.hide();
                    }*/

                    var row_html = '';
                    $.each(table_data, function(index, item) {

                        row_html += '<tr>';
                        row_html += '<td>';
                        row_html += item.fullname;
                        row_html += '</td>';
                        row_html += '<td>';
                        row_html += item.status;
                        row_html += '</td>';
                        row_html += '<td>';
                        row_html += item.date;
                        row_html += '</td>';
                        row_html += '</tr>';

                        
                    });

                    $document_status_list.html(row_html);
                }
            }
        });

}
}

function tb_ranking() {


    $("#feedback_button").click(function() {

        $(this).find('.glyphicon').toggleClass("glyphicon-chevron-down");
        $(this).closest('#ranking-container').find('.form').slideToggle();

    });


    $(document).on('click', "#like-button", function() {

        console.log('clicked like button');

        var $like_button = $(this);
        var $like_button_icon = $(this).find('i.fa');

        if ($like_button_icon.hasClass('fa-thumbs-o-up')) {
            $like_button_icon.removeClass('fa-thumbs-o-up');
            $like_button_icon.addClass('fa-thumbs-up');
        } else {
            $like_button_icon.removeClass('fa-thumbs-up');
            $like_button_icon.addClass('fa-thumbs-o-up');

        }

        var $ranking_like = $(this).closest('#ranking-container').find('input[name=ranking_like]');
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
/* END DOCUMENT RANKING */

function exportCSV() {

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

/* WEEKLY PLAN */
function userWeeklyPlan() {

    var $weekly_plan = $('#my-weekly-plan');
    var $weekly_plan_body = $weekly_plan.find('tbody');
    var $weekly_plan_loading = $('#loading-weekly-plan');

    if ($weekly_plan.length > 0) {

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
                        row_html += '<input class="form-control" type="text" name="work_order" value="' + item.work_order + '">';
                        row_html += '</td>';
                        row_html += '<td class="job-description">';
                        row_html += '<input class="form-control" type="text" name="job_description" value="' + item.job_description + '">';
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
                        row_html += '<input class="form-control datepicker" type="text" name="weekly_plan_date" value="' + item.date + '">';
                        row_html += '</td>';
                        row_html += '<td class="comment">';
                        row_html += '<input class="form-control" type="text" name="comment" value="' + item.comments + '">';
                        row_html += '</td>';
                        row_html += '<td class="status">';
                        row_html += '<select name="status" class="form-control">';
                        row_html += table_info.status_dropdown;
                        row_html += '</select>';
                        row_html += '</td>';
                        row_html += '<td class="text-center">';
                        row_html += '<a href="#" class="btn btn-bordered btn-danger delete-weekly-plan"><span class="glyphicon glyphicon-minus"></span></a> ';
                        row_html += '<a href="#" class="btn btn-bordered btn-info update-weekly-plan"><span class="glyphicon glyphicon-floppy-disk"></span></a>';
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

function updateWeeklyPlan() {

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

function removeWeeklyPlan() {

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
            error: function(data) {
                console.log(data.responseText);
            }
        });


    });
}

function weeklyPlanClone() {

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

    $(document).on('click', main_container + ' ' + options_container + ' ' + add_row_str, function(e) {

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
            success: function(data) {
                console.log(data);
            }
        });


    });


    $(document).on('click', main_container + ' ' + options_container + ' ' + remove_row_str, function(e) {

        var remove_flag = false;
        var refresh_flag = false;

        e.preventDefault();

        $rows = $table_body.find('tr');
        $last_child = $rows.last();

        if ($rows.length <= 1) {
            $last_child.remove();
            remove_flag = true;
            refresh_flag = true;
        } else {
            $last_child.fadeOut(function() {
                $(this).remove();
            });
            remove_flag = true;
        }

        if (remove_flag) {

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
                success: function(data) {
                    console.log(data);
                }
            });

        }


        if (refresh_flag) {
            userWeeklyPlan();
        }




    });
}

function containerResize() {
    $(document).on('click', '.navbar-sidebar-toggle', function(e) {
        $new_width = $('#criticality-analysis-per-day').width();
        //alert($new_width +'px');
        $('#criticality-analysis-per-day').find('.resize-column').css('width', $new_width);
        fixSizeAddRemoveFollowUser();
    });
}

function createWeeklyPlan() {

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
                success: function(data) {
                    userWeeklyPlan();
                }
            });

        });
}
/* END WEEKLY PLAN */

/* NOTIFICATION */

function checkForCompletedForms(check_selector) {

    console.log('notification called');

    if ($(check_selector).length) {
        console.log('notification start');

        var notifyInterval = setInterval(function() {
            ajax_execute(check_selector, 'notify_owners', null);
            console.log('notification test');
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

        /* END NOTIFICATION */


        /* FIVE WHY QUESTIONS */

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

/* END FIVE WHY QUESTIONS */


/* EXPERIMENTAL FUNCTIONALITIES */


function equipmentProfileDropdownDependency(){

    var $equipment_category_dropdown = $('#equipment-category');
    var $equipment_class_dropdown = $("#equipment-class");
    var $equipment_description_dropdown = $("#equipment-description");
    var $equipment_code_textfield = $("#equipment-code");
    var $equipment_category_dependent = $(".equipment-category-dependent");
    var $equipment_class_dependent = $(".equipment-class-dependent");

    $equipment_category_dropdown.change(function(){
        $equipment_category_dependent.each(function(index, value){
            var $this = $(this);
            if($this.is("select")){
                $this.find('option').not('option:nth-child(1)').remove();
            }else{
                $this.val('');
            }
        });
    });

    $equipment_class_dropdown.change(function(){
        $equipment_category_dependent.each(function(index, value){
            var $this = $(this);
            if($this.is("select")){
                $this.find('option').not('option:nth-child(1)').remove();
            }else{
                $this.val('');
            }
        });
    });

    


}



function actionTrackerChanges(){

    var $action_process_step = $("input[name='action_process_step[]']");
    var $action_status = $("select[name='action_tracker_status[]']");
    var $action_due_date = $("input[name='due_date[]']");
    var $action_comments = $("input[name='comments[]'");

    

    var change_status;

    $action_process_step.keyup(function(){

        var $this = $(this);

        var $change_status = $this.closest('.data-row').find("input[name='change_status[]']");

        var original_value = $this.data('original');
        var current_value = $this.val();
        var current_change_status = $this.closest('.data-row').find("input[name='change_status[]']").val();

        if(current_value != original_value && current_change_status != 'new'){
            change_status = 'modified';

            $change_status.val(change_status);
        }
        /*else if(current_value == original_value && current_change_status != 'new'){
            $change_status.val('old');
        }*/


    });


    $action_comments.keyup(function(){
        var $this = $(this);

        var $change_status = $this.closest('.data-row').find("input[name='change_status[]']");

        var original_value = $this.data('original');
        var current_value = $this.val();
        var current_change_status = $this.closest('.data-row').find("input[name='change_status[]']").val();

        if(current_value != original_value && current_change_status != 'new'){
            change_status = 'modified';

            $change_status.val(change_status);
        }
        /*else if(current_value == original_value && current_change_status != 'new'){
            $change_status.val('old');
        }*/


    });


    $action_status.change(function(){
        var $this = $(this);

        var $change_status = $this.closest('.data-row').find("input[name='change_status[]']");

        var original_value = $this.data('original');
        var current_value = $this.val();
        var current_value_text = $this.find('option:selected').text();
        //alert(current_value_text);
        var current_change_status = $this.closest('.data-row').find("input[name='change_status[]']").val();

        if(current_value != original_value && current_change_status != 'new'){

            if(current_value_text == 'Closed'){
                change_status = 'closed';
            }else{
                change_status = 'modified';
            }

            
            $change_status.val(change_status);

        }else{

            if(current_value_text == 'Closed'){
                change_status = 'closed';
            }

            $change_status.val(change_status);

        }


    });


}



function getUserFollowers(){

    var function_url = "user/get_current_followers";

    var ajax_url = base_url + function_url;

    $.ajax({
        type: "POST",
        url: ajax_url,
        dataType: "html",
        success: function(data) {
            $('#user-followers').html(data);
            //console.log('success action tracker past due date notification');
        }
    });

}

function getDocumentFollowers(){

    var function_url = "document/get_document_followers/table";

    var ajax_url = base_url + function_url;

    $.ajax({
        type: "POST",
        url: ajax_url,
        dataType: "html",
        success: function(data) {
            $('#document-followers').html(data);
            //console.log('success action tracker past due date notification');
        }
    });

}

function refreshNotifications(){

    var $refresh_button = $('.refresh-table');

    $refresh_button.click(function(){
        displayActionTrackerPastDueDate();
        notifyActionTrackerPastDueDate();
    });
}

function notifyActionTrackerPastDueDate(){

    var function_url = "action_tracker/notify_action_tracker_past_due_date";

    var ajax_url = base_url + function_url;

    $.ajax({
        type: "POST",
        url: ajax_url,
        dataType: "html",
        success: function(data) {
            console.log('success action tracker past due date notification');
        }
    });
}

function displayActionTrackerPastDueDate(){

    var function_url = "action_tracker/get_action_tracker_past_due_date/table";

    var ajax_url = base_url + function_url;

    
    $('#action-tracker-past-due-date').html('<i class="fa fa-refresh fa-spin"></i> Loading Action Trackers...');

    $.ajax({
        type: "POST",
        url: ajax_url,
        dataType: "html",
        success: function(data) {

            $('#action-tracker-past-due-date').html(data);
        }
    });
}

function uploadButtonTweaks(){

    if ( !$.browser.msie ) {
        var $html = $('html');
        /*var $body = $('body');
        var $page_wrapper = $('.page-wrapper');*/

        $html.removeClass('ie');
    }
    /*var $btn_file = $('.btn.btn-file');

    $btn_file.click(function(){
        console.log('clicked upload button');
        var $this = $(this);
        var $input_group = $this.closest('.input-group.form-file-input');
        var $file_input = $input_group.find('input[type=file]');
        $file_input.trigger('click');
        //console.log($input_group);
        //console.log($file_input);
        return false;
    });*/
}

function required_input(){

    $('.required-input').append('&nbsp;<i class="fa fa-asterisk text-required required-input-icon"></i>');
}

function follow_document(document_id, follow) {

    var follow = follow || false;

    var function_url = "user/follow_document";

    var ajax_url = base_url + function_url;

    var dataString = {
        "document_id": document_id,
        "follow": follow
    };


    $.ajax({
        type: "POST",
        url: ajax_url,
        data: dataString,
        dataType: "html",
        success: function(data) {
            console.log(data);
        }
    });
}

function add_floorplan_position(floorplan_id, x, y, note) {

    var function_url = "document/add_floorplan_position";

    var ajax_url = base_url + function_url;

    var dataString = {
        "floorplan_id": floorplan_id,
        "x": x,
        "y": y,
        "note": note
    };


    $.ajax({
        type: "POST",
        url: ajax_url,
        data: dataString,
        dataType: "html",
        success: function(data) {
            console.log(data);
        }
    });
}

function remove_floorplan_position(floorplan_id, x, y){

    var function_url = "document/remove_floorplan_position";

    var ajax_url = base_url + function_url;

    var dataString = {
        "floorplan_id": floorplan_id,
        "x": x,
        "y": y
    };


    $.ajax({
        type: "POST",
        url: ajax_url,
        data: dataString,
        dataType: "html",
        success: function(data) {
            console.log(data);
        }
    });
}

function loadImage() {


    $('#floorplan-loading').removeClass('hidden');

    var function_url = "document/load_image";

    var ajax_url = base_url + function_url;

    $.ajax({
        async: false,
        type: "POST",
        url: ajax_url,
        dataType: "html",
        success: function(data) {
            $('#floorplan-container').html(data);
            imageNotes();
            $('#floorplan-loading').addClass('hidden');
        }
    });
}

function loadFloorPlanImage() {

    var floor_plan_container = $('#floor-plan-container');

    if(floor_plan_container.length > 0){

        //$('#floorplan-loading').removeClass('hidden');

        var floor_plan_id = $('input[name="floor_plan_id"]').val();
        var dataString = {
            'floor_plan_id': floor_plan_id
        };

        var function_url = "mcdr/load_floor_plan_image";

        var ajax_url = base_url + function_url;

        $.ajax({
            async: false,
            type: "POST",
            data: dataString,
            url: ajax_url,
            dataType: "html",
            success: function(data) {
                $('#floor-plan-container').html(data);
                    //imageNotes();
                    imageNotesFloorPlan();
                    $('#floorplan-loading').addClass('hidden');

                    //alert(data);
                }
            });
    }
}

function imageNotesFloorPlan() {


    var $image = $('#image');
    var $image_markers = $('#image-markers');
    var floor_plan_id = $('input[name="floor_plan_id"]').val();

    var $floorplan_container = $image.closest('.floorplan-container');

    var function_url = "document/get_floorplan_detail/"+floor_plan_id;

    var ajax_url = base_url + function_url;

    var $add_point_modal = $('#add-point-modal');

    var $button_save = $add_point_modal.find('.go-save');
    var $button_delete = $add_point_modal.find('.go-delete');
    var $button_cancel = $add_point_modal.find('.go-cancel');


    if ($image.length > 0) {

        $.ajax({
            type: "POST",
            url: ajax_url,
            dataType: "json",
            success: function(data) {


                var isOnAdd = false;

                console.log(data);

                floorplan_info = data.info;
                floorplan_positions = data.positions;



                var $img = $image.imgNotes({
                    canEdit: true
                });

                    /*$image.imgViewer("option", "onClick", function(e, self) {
                        var pos = self.cursorToImg( e.pageX, e.pageY);
                        console.log(e.pageX + " " + e.pageY + " " + pos.x + " " + pos.y);
                    });*/

$img.imgNotes("import", floorplan_positions);

$img.imgNotes("option", "onAdd", function(ev, elem) {
    console.log('on add');
                        //console.log(this);
                        this.options.vAll = "bottom";
                        this.options.hAll = "middle";

                        isOnAdd = true;

                        return $(document.createElement('span')).addClass("marker black").html(this.noteCount);
                    });








$img.imgNotes("option", "onEdit", function(ev, elem) {
    console.log('on edit');


    var $elem = $(elem);
    var point_number = $elem.context.innerText;

    var point_x = $elem.data('relx');
    var point_y = $elem.data('rely');
    var point_note = $elem.data('note');

                        /*var notes = $img.imgNotes("export");
                        var notes_length = notes.length;

                        var last_added_note = notes[notes_length-1];
                        console.log(last_added_note);*/

                        if(isOnAdd){
                            add_floorplan_position(floor_plan_id, point_x, point_y, point_note);
                        }
                        

                        var new_note = [];

                        //$('#NoteDialog').remove();
                        $add_point_modal.modal({
                            keyboard: false,
                            backdrop: 'static'
                        });

                        var $textarea = $add_point_modal.find('textarea');
                        $textarea.val($elem.data("note"));



                        $button_save.click(function() {

                            $add_point_modal.modal('hide');
                            console.log('clicked save');
                            var txt = $textarea.val();
                            $elem.data("note", txt);

                            //update_floorplan_note(floorplan_id, x, y, note);

                            $img.imgNotes("import", new_note);
                        });

                        $button_delete.click(function(e){

                            //console.log(point_x);
                            //console.log(point_y);
                            //console.log(point_note);
                            /*$(this).text('Removing...');
                            $(this).prop('disabled',true);

                            if($(this).prop('disabled')){*/
                                var point_x = $elem.data('relx');
                                var point_y = $elem.data('rely');
                                var point_note = $elem.data('note');

                                remove_floorplan_position(floor_plan_id, point_x, point_y);
                                

                                /*$image.remove();
                                $image_markers.remove();

                                loadImage();*/

                                location.reload();

                                //$elem.trigger("remove");
                                /*$add_point_modal.modal('hide');

                                $(this).text('Remove');
                                $(this).prop('disabled',false);
                            }*/


                            
                        });


});



                } //end success
            });



}
}

function imageNotes() {


    var $image = $('#image');
    var $image_markers = $('#image-markers');

    var $floorplan_container = $image.closest('.floorplan-container');

    var function_url = "document/get_floorplan_detail/1";

    var ajax_url = base_url + function_url;

    var $add_point_modal = $('#add-point-modal');

    var $button_save = $add_point_modal.find('.go-save');
    var $button_delete = $add_point_modal.find('.go-delete');
    var $button_cancel = $add_point_modal.find('.go-cancel');


    if ($image.length > 0) {

        $.ajax({
            type: "POST",
            url: ajax_url,
            dataType: "json",
            success: function(data) {


                var isOnAdd = false;

                console.log(data);

                floorplan_info = data.info;
                floorplan_positions = data.positions;



                var $img = $image.imgNotes({
                    canEdit: true
                });

                    /*$image.imgViewer("option", "onClick", function(e, self) {
                        var pos = self.cursorToImg( e.pageX, e.pageY);
                        console.log(e.pageX + " " + e.pageY + " " + pos.x + " " + pos.y);
                    });*/

$img.imgNotes("import", floorplan_positions);

$img.imgNotes("option", "onAdd", function(ev, elem) {
    console.log('on add');
                        //console.log(this);
                        this.options.vAll = "bottom";
                        this.options.hAll = "middle";

                        isOnAdd = true;

                        return $(document.createElement('span')).addClass("marker black").html(this.noteCount);
                    });








$img.imgNotes("option", "onEdit", function(ev, elem) {
    console.log('on edit');


    var $elem = $(elem);
    var point_number = $elem.context.innerText;

    var point_x = $elem.data('relx');
    var point_y = $elem.data('rely');
    var point_note = $elem.data('note');

                        /*var notes = $img.imgNotes("export");
                        var notes_length = notes.length;

                        var last_added_note = notes[notes_length-1];
                        console.log(last_added_note);*/

                        if(isOnAdd){
                            add_floorplan_position(1, point_x, point_y, point_note);
                        }
                        

                        var new_note = [];

                        //$('#NoteDialog').remove();
                        $add_point_modal.modal({
                            keyboard: false,
                            backdrop: 'static'
                        });

                        var $textarea = $add_point_modal.find('textarea');
                        $textarea.val($elem.data("note"));



                        $button_save.click(function() {

                            $add_point_modal.modal('hide');
                            console.log('clicked save');
                            var txt = $textarea.val();
                            $elem.data("note", txt);

                            //update_floorplan_note(floorplan_id, x, y, note);

                            $img.imgNotes("import", new_note);
                        });

                        $button_delete.click(function(e){

                            //console.log(point_x);
                            //console.log(point_y);
                            //console.log(point_note);
                            /*$(this).text('Removing...');
                            $(this).prop('disabled',true);

                            if($(this).prop('disabled')){*/
                                var point_x = $elem.data('relx');
                                var point_y = $elem.data('rely');
                                var point_note = $elem.data('note');

                                remove_floorplan_position(1, point_x, point_y);
                                

                                /*$image.remove();
                                $image_markers.remove();

                                loadImage();*/

                                location.reload();

                                //$elem.trigger("remove");
                                /*$add_point_modal.modal('hide');

                                $(this).text('Remove');
                                $(this).prop('disabled',false);
                            }*/


                            
                        });


});



                } //end success
            });



}
}

function imageNotesOptions() {

    var $img = $('#image').imgNotes();

    $img.imgNotes("option", "onEdit", function(ev, elem) {
        console.log('on edit');
        var $elem = $(elem);
        $('#NoteDialog').remove();
        return $('<div id="NoteDialog"></div>').dialog({
            title: "Note Editor",
            resizable: false,
            modal: true,
            height: "300",
            width: "450",
            position: {
                my: "left bottom",
                at: "right top",
                of: elem
            },
            buttons: {
                "Save": function() {
                    console.log('save clicked');
                    var txt = $('textarea', this).val();
                    //          Put the editied note back into the data area of the element
                    //          Very important that this step is included in custom callback implementations
                    $elem.data("note", txt);
                    $(this).dialog("close");
                },
                "Delete": function() {
                    $elem.trigger("remove");
                    $(this).dialog("close");
                },
                Cancel: function() {
                    $(this).dialog("close");
                }
            },
            open: function() {
                $(this).css("overflow", "hidden");
                var textarea = $('<textarea id="txt" style="height:100%; width:100%;">');
                $(this).html(textarea);
                //          Get the note text and put it into the textarea for editing
                textarea.val($elem.data("note"));
            }
        });
});

var $toggle = $("#toggleEdit");

if ($img.imgNotes("option", "canEdit")) {
    $toggle.text("View");
} else {
    $toggle.text("Edit");
}

$toggle.on("click", function() {
    var $this = $(this);
    if ($this.text() == "Edit") {
        $this.text("View");
        $img.imgNotes("option", "canEdit", true);
    } else {
        $this.text('Edit');
        $img.imgNotes('option', 'canEdit', false);
    }
});


var $export = $("#export");

$export.on("click", function() {
    var $table = $("<table/>").addClass("gridtable");
    var notes = $img.imgNotes('export');
    $table.append("<th>X</th><th>Y</th><th>NOTE</th>");
    $.each(notes, function(index, item) {
        $table.append("<tr><td>" + item.x + "</td><td>" + item.y + "</td><td>" + item.note + "</td></tr>");
    });
    $('#txt').html($table);
});

var $print = $("#print");

$print.on("click", function() {
    $(".viewport").printThis();
});
}

function generateTickerRow(image, title, content) {

    var ticker_content = '';

    if (typeof image != 'undefined' && typeof title != 'undefined' && typeof content != 'undefined') {
        row_state = 'complete';
    } else if (typeof image == 'undefined' && typeof title != 'undefined' && typeof content != 'undefined') {
        row_state = 'no_image';
    } else if (typeof image == 'undefined' && typeof title == 'undefined' && typeof content != 'undefined') {
        row_state = 'content_only';
    } else if (typeof image != 'undefined' && typeof title == 'undefined' && typeof content == 'undefined') {
        row_state = 'image_only';
    } else if (typeof image != 'undefined' && typeof title == 'undefined' && typeof content != 'undefined') {
        row_state = 'no_title';
    } else {
        row_state = 'title_only';
    }



    switch (row_state) {
        case "complete":
        ticker_content += '<div class="col-xs-4 no-padding"><img class="img-responsive" src="' + image + '"></div>';
        ticker_content += '<div class="col-xs-8">';
        ticker_content += '<h4>' + title + '</h4>';
        ticker_content += '<p>' + content + '</p>';
        ticker_content += '</div>';
        break;
        case "no_image":
        ticker_content += '<div class="col-xs-12">';
        ticker_content += '<h4>' + title + '</h4>';
        ticker_content += '<p>' + content + '</p>';
        ticker_content += '</div>';
        break;
        case "content_only":
        ticker_content += '<div class="col-xs-12">';
        ticker_content += '<br>';
        ticker_content += '<p>' + content + '</p>';
        ticker_content += '</div>';
        break;
        case "image_only":
        ticker_content += '<div class="col-xs-12">';
        ticker_content += '<img class="img-responsive" src="' + image + '">';
        ticker_content += '</div>';
        break;
        case "no_title":
        ticker_content += '<div class="col-xs-4 no-padding"><img class="img-responsive" src="' + image + '"></div>';
        ticker_content += '<div class="col-xs-8">';
        ticker_content += '<br>';
        ticker_content += '<p>' + content + '</p>';
        ticker_content += '</div>';
        break;
        case "title_only":
        ticker_content += '<div class="col-xs-12">';
        ticker_content += '<h4>' + title + '</h4>';
        ticker_content += '</div>';
        break;
    }




    return ticker_content;
}

function ticker() {


    var ticker_info = {
        "tickers": [{
            "image": "test",
            "title": "Test",
            "content": "the quick brown fox jumps over the lazy dog"
        }, {
            "title": "No Image",
            "content": "this is a test content"
        }, {
            "content": "This is a content with no image and no title at all"
        }, {
            "image": "test2",
            "content": "this is content with image no title"
        }],
        "height": "78px",
        "id": "sidebar-ticker",
        "row": "ticker-row",
        "scroll": true
    };

    var $ticker_rows = ticker_info.tickers;

    console.log($ticker_rows);

    var ticker_content = '';

    $.each($ticker_rows, function(index, row) {

        var row_state = 'complete';

        var image = row.image;
        var title = row.title;
        var content = row.content;

        ticker_content += '<div class="row ticker-row">';
        ticker_content += generateTickerRow(image, title, content);
        ticker_content += '</div>';

    });



    console.log(ticker_info);
    console.log('ticker called');

    var style_height = ticker_info.height;
    var $sidebar_ticker = $('#' + ticker_info.id);


    $sidebar_ticker.append(ticker_content);


    var $sidebar_ticker_row = $sidebar_ticker.find('.' + ticker_info.row);


    $sidebar_ticker_row.css('height', style_height);
    var ticker_row_height = $sidebar_ticker_row.height();

    console.log(ticker_row_height);
    var sidebar_ticker_event = $sidebar_ticker.newsTicker({
        row_height: ticker_row_height,
        max_rows: 3,
        duration: 4000,
        speed: 1000,
    });

    var scroll = ticker_info.scroll;

    if (scroll) {
        $sidebar_ticker.css('overflow-y', 'scroll');
    }


    sidebar_ticker_event.newsTicker('add', generateTickerRow('testimage', 'Test Title', 'hello world'));
}

function get_sidebar_followers() {

    var $followers_container = $('#no-of-followers');

    if ($followers_container.length > 0) {

        var function_url = "user/get_followers";

        var dataString = {
            "count": true
        };


        var ajax_url = base_url + function_url;


        $.ajax({
            type: "POST",
            url: ajax_url,
            data: dataString,
            dataType: "html",
            success: function(data) {
                $followers_container.text(data);
            }
        });

    }
}

function filterProjectTracker() {
    $(document).on('submit', '#filter-project-tracker-form', function(e) {

        var $filter_project_tracker = $(this);
        var $table_body;

            //filter variables
            var filter_name = $filter_project_tracker.find('input[name=project_name_input]').val();
            var filter_number = $filter_project_tracker.find('input[name=project_number_input]').val();
            var filter_author = $filter_project_tracker.find('input[name=author_input]').val();
            var filter_start_date = $filter_project_tracker.find('input[name=start_date_input]').val();
            var filter_project_condition = $filter_project_tracker.find('select[name=project_condition]').val();
            var filter_work_party = $filter_project_tracker.find('select[name=work_party]').val();



            e.preventDefault();

            getProjectTrackerList(filter_name, filter_number, filter_author, filter_start_date, filter_project_condition, filter_work_party);

            //alert(filter_name+'<br>'+filter_number+'<br>'+filter_author+'<br>'+filter_start_date);

        });
}
    //project tracker

    function editCostBreakdown() {
        $("form#update-cost-breakdown-row").on('click', '.edit-cost-breakdown-row', function(e) {
            e.preventDefault();

            var $row = $(this).closest('tr');
            var supplier = $row.find('input[name="c_supplier"]').val();
            var status = $row.find('select[name="c_status"]').val();
            var due_date = $row.find('input[name="c_due_date"]').val();
            var po_number = $row.find('input[name="c_po_number"]').val();
            var location = $row.find('input[name="c_component_location"]').val();
            var id = $row.find('input[name="c_id"]').val();

            var dataString = {
                'c_supplier': supplier,
                'c_due_date': due_date,
                'c_status': status,
                'c_po_number': po_number,
                'c_component_location': location,
                'c_id': id
            };

            var function_url = 'reliability-maintenance/update-cost-breakdown-row';
            var ajax_url = base_url + function_url;

            $.ajax({
                type: 'post',
                url: ajax_url,
                data: dataString,
                dataType: 'html',
                success: function(data) {
                    $row.find('td.input-fields').addClass('has-success');
                    $row.find('select[name="c_status"]').css('border-color', '#1e9765');
                    setTimeout(function() {
                        $row.find('td.input-fields').removeClass('has-success');
                        $row.find('select[name="c_status"]').css('border-color', 'gray');
                    }, 1500);
                }
            });

        //console.log(dataString);

    });
}

function getProjectTrackerList(project_name, project_number, author, start_date, project_condition, work_party) {

    var $container = $('#project-tracker-container');
    var $project_tracker_container = $('#project-tracker-ajax');
    var $table_head = $project_tracker_container.find('thead');
    var $table_body = $project_tracker_container.find('tbody');
    var $loading = $('#loading-project-tracker');
    var $no_search = $('#no-project-tracker');

    if ($project_tracker_container.length > 0) {

        /* var $no_criticality_analysis = $('#no-criticality-analysis');
        var $no_search_found = $('#no-search-found');*/

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();
        var project_name = project_name || null;
        var project_number = project_number || null;
        var author = author || null;
        var start_date = start_date || null;
        var project_condition = project_condition || null;
        var work_party = work_party || null;

        /*if(owner == null){
            owner = current_user_id;
        }*/

        var function_url = 'reliability_maintenance/get_project_tracker';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "project_name": project_name,
            "project_number": project_number,
            "author": author,
            "start_date": start_date,
            "project_condition": project_condition,
            "work_party": work_party

            /*to do action tracker filter variables here*/
        };

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

                //console.log(data);

                //alert(data);
                $loading.addClass('hidden');

                //console.log(data.status_dropdown);
                var table_data = data.table_data;

                if (table_data.length < 1) {

                    $container.addClass('hidden');
                    //$('.remove-project-tracker-row').addClass('hidden');
                    $('.add-project-tracker-row').closest('.panel-footer').addClass('hidden');
                    $no_search.removeClass('hidden');


                } else {

                    var add_row = $('.add-project-tracker-row').closest('.panel-footer').hasClass('hidden');
                    if (add_row == true) {
                        $('.add-project-tracker-row').removeClass('hidden');
                    }

                    $loading.addClass('hidden');

                    if ($no_search.hasClass('hidden') == false) {
                        $no_search.addClass('hidden');
                    }
                    if ($container.hasClass('hidden')) {
                        $container.removeClass('hidden');
                    }


                    var status_dropdown = data.status_dropdown;
                    var user_options = data.user_option_values;
                    var document_name_options = data.document_name_dropdown;
                    var existing_document_name_options = data.existing_document_name_dropdown;
                    var tb_dropdown = data.tb_dropdown;
                    var equipment_dropdown = data.equipment_dropdown;
                    var subaction_data = data.subaction_table_data;
                    var selected_value = '';
                    var selected = '';

                    var thead_columns = '<tr>';

                    thead_columns += '<th class="project-name">Project Name</th>';
                    thead_columns += '<th class="project-number">Project Number</th>';
                    thead_columns += '<th class="project-author">Author</th>';
                    thead_columns += '<th class="project-condition">Project Condition</th>';
                    thead_columns += '<th class="project-work-party">Work Party</th>';
                    thead_columns += '<th class="project-date">Estimated Start Date</th>';
                    thead_columns += '<th>Estimated Total</th>';
                    thead_columns += '<th>Actual Total</th>';
                    thead_columns += '<th>Cost Breakdown</th>';
                    thead_columns += '<th>Specialist Requirement</th>';
                    thead_columns += '<th class="text-center actions" width="200px;">Action</th>';


                    thead_columns += '</tr>';

                    //$action_tracker_container_old.append(column_names);  
                    $table_head.append(thead_columns);

                    $.each(table_data, function(index, item) {

                        if (item.name == null) {
                            item.name = '';
                        }

                        if (item.code == null) {
                            item.code = 'PP';
                        }

                        var row_table = '<tr class="data-row">';
                        row_table += '<td>' + item.name + '</td>';
                        row_table += '<td>' + item.code + '</td>';
                        row_table += '<td>' + item.author + '</td>';
                        row_table += '<td>' + item.project_condition + '</td>';
                        row_table += '<td>' + item.work_party + '</td>';
                        row_table += '<td>' + item.start_date + '</td>';
                        row_table += '<td>' + item.estimated_total + '</td>';
                        row_table += '<td>' + item.actual_total + '</td>';
                        row_table += '<td class="cost-breakdown-data">';
                        row_table += '<button  class="btn btn-default btn-sm show-cost-breakdown"><span class="glyphicon glyphicon-search"></span> View</button>';
                        row_table += '<p class="hidden cost-breakdown-document-id">' + item.document_id + '</p>';
                        row_table += '<p class="hidden cost-breakdown-project-name">' + item.name + '</p>'
                        row_table += '<p class="hidden cost-breakdown-project-number">' + item.code + '</p>'
                        row_table += '</td>';
                        row_table += '<td class="specialist-requirement-data">';
                        row_table += '<button  class="btn btn-default btn-sm show-specialist-requirement"><span class="glyphicon glyphicon-search"></span> View</button>';
                        row_table += '<p class="hidden specialist-requirement-document-id">' + item.document_id + '</p>';
                        row_table += '<p class="hidden specialist-requirement-project-name">' + item.name + '</p>'
                        row_table += '<p class="hidden specialist-requirement-project-number">' + item.code + '</p>'
                        row_table += '</td>';
                        row_table += '<td>'
                        row_table += '<a href="' + base_url + 'project-plan/view/' + item.document_id + '" class="btn  btn-sm btn-success tooltip-view" data-placement="bottom" data-toggle="tooltip" data-original-title="View Document"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></a> ';
                        row_table += '<a href="' + base_url + 'project-plan/edit/' + item.document_id + '/1" class="btn  btn-sm btn-primary tooltip-view ' + item.disabled + '" data-placement="bottom" data-toggle="tooltip" data-original-title="Edit Document"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> ';
                        row_table += '<a href="'+item.updates_url+'" data-id="'+item.document_id+'" class="document-update-view-button btn btn-sm btn-info tooltip-view" data-placement="bottom" data-toggle="tooltip" data-original-title="View Project Updates"><i class="fa fa-lg fa-comments"></i></a> ';
                        row_table += '<a href="'+ base_url +'reliability-maintenance/project-tracker-gantt-chart/'+item.document_id+'" data-id="'+item.document_id+'" class="document-update-view-button btn btn-sm btn-default tooltip-view" data-placement="bottom" data-toggle="tooltip" data-original-title="View this Project\'s Gannt Chart"><i class="fa fa-bar-chart-o"></i></a> ';
                        row_table += '<a href="#" data-id="'+item.document_id+'" class="follow-project-btn btn btn-sm btn-default tooltip-view" data-placement="bottom" data-toggle="tooltip" data-original-title="Follow this Project"><i class="fa fa-lg '+item.check_class+'"></i></a> ';
                        row_table += '</td>';

                       //action buttons
                        /*row_table += '<a href="#" class="btn btn-bordered btn-danger delete-row-project-tracker btn-sm"><span class="glyphicon glyphicon-minus"></span></a> ';
                        row_table += '<a href="#" class="btn btn-info edit-project-tracker btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span></a> ';
                        row_table += '<p class="project-tracker-id hidden">' + item.project_plan_id + '</p></td>';*/



                        row_table += '</tr>';


                        $table_body.append(row_table);


                    });

                    //dateEffects();
                    //tooltipsAndPopovers();
                    $('.tooltip-view').tooltip();
                    //select_with_search();
                    //bootstrapTooltipEffects();
                    //toggle_action_tracker_table_columns();
                }
            }
        });

}
}

function followProjectTracker() {

    $(document).on('click', '.follow-project-btn', function(e) {
        e.preventDefault();
        var $icon = $(this).find('i');
        var document_id = $(this).data('id');

        if ($icon.hasClass('fa-square-o')) { // not checked
            $icon.removeClass('fa-square-o');
            $(this).tooltip('hide')
            .attr('data-original-title', 'Unfollow')
            .tooltip('fixTitle')
            .tooltip('show');
            $icon.addClass('fa-check-square-o');

            follow_document(document_id, true);

        } else { // checked
            $icon.removeClass('fa-check-square-o');
            $(this).tooltip('hide')
            .attr('data-original-title', 'Follow this project')
            .tooltip('fixTitle')
            .tooltip('show');
            $icon.addClass('fa-square-o');

            follow_document(document_id); //unfollow

        }
    });
}

function projectTrackerdetailedCostBreakdown() {

    var $project_tracker_modal = $('#project-tracker-cost-breakdown-modal');
    var $cost_breakdown_button = $('.show-cost-breakdown');
    var $modal_container = $('#project-tracker-cost-breakdown');


    $(document).on('click', 'button.show-cost-breakdown', function(e) {

        var document_id = $(this).next('p.cost-breakdown-document-id').text();
        var name = $(this).siblings('p.cost-breakdown-project-name').text();
        var code = $(this).siblings('p.cost-breakdown-project-number').text();
        var $modal_body = $modal_container.find('.modal-body');
        $modal_body.html('');

        //alert($document_id);
        //console.log('test');
        $modal_container.modal();

        var function_url = 'reliability-maintenance/get-cost-breakdown-per-id/' + document_id;
        var ajax_url = base_url + function_url;


        $.ajax({
            type: 'get',
            url: ajax_url,
            cache: false,
            success: function(data) {


                $modal_body.append(data);
                $modal_body.find('.project-name-data').text(name);
                $modal_body.find('.project-number-data').text(code);
                dateEffects();
                $('.tooltip-view').tooltip();
                editCostBreakdown();
            }
        });

    });
}

function projectTrackerdetailedSpecialistRequirment() {

    var $project_tracker_modal = $('#project-tracker-specialist-requirement-modal');
    var $cost_breakdown_button = $('.show-specialist-requirement');
    var $modal_container = $('#project-tracker-specialist-requirement');


    $(document).on('click', 'button.show-specialist-requirement', function(e) {

        var document_id = $(this).next('p.specialist-requirement-document-id').text();
        var name = $(this).siblings('p.specialist-requirement-project-name').text();
        var code = $(this).siblings('p.specialist-requirement-project-number').text();
        var $modal_body = $modal_container.find('.modal-body');
        $modal_body.html('');

        //alert($document_id);
        //console.log('test');
        $modal_container.modal();

        var function_url = 'reliability-maintenance/get-specialist-requirement-per-id/' + document_id;
        var ajax_url = base_url + function_url;


        $.ajax({
            type: 'get',
            url: ajax_url,
            cache: false,
            success: function(data) {


                $modal_body.append(data);
                $modal_body.find('.project-name-data').text(name);
                $modal_body.find('.project-number-data').text(code);
                dateEffects();
            }
        });

    });
}

function firstTimeLogin() {

    var $first_time_login_modal = $('#first-time-login-modal');
    var $first_time_submit = $('#first-time-change-password');
    var $change_password_panel = $('#change-password-form');

    var $change_password_form = $change_password_panel.find('form');

    $first_time_login_modal.modal();

    $change_password_form.submit(function(e) {
        e.preventDefault();

        var $form = $(this);

        var post_data = $form.serializeArray();

        var $password = $form.find('input[name=password]');
        var $confirm_password = $form.find('input[name=confirm_password]');

        var password = $password.val();
        var confirm_password = $confirm_password.val();

        if (password != confirm_password) {

            $password.closest('.form-group').addClass('has-error');
            $confirm_password.closest('.form-group').addClass('has-error');

            $('#alert-password').removeClass('hidden');

        } else {

            $password.closest('.form-group').removeClass('has-error');
            $confirm_password.closest('.form-group').removeClass('has-error');

            $('#alert-password').addClass('hidden');

            var function_url = 'user/password_reset'
            var ajax_url = base_url + function_url;

            $.ajax({
                type: "POST",
                url: ajax_url,
                data: post_data,
                dataType: "html",
                success: function(data) {
                    if (data == 'success') {
                        $first_time_login_modal.modal('hide');
                        $('#success-password').removeClass('hidden');
                    }
                }
            });

        }



    });
}

function projectTrackerGanttChart() {

    var a = $('.gantt');

    if (a.length < 1) {

    } else {

        var document_id = $('input[name="document_id"]').val();
        var add_on = '';

        if(document_id != ''){
            add_on = '/'+document_id;
        }
        var function_url = 'reliability-maintenance/get_project_gantt_chart'+add_on;
        var ajax_url = base_url + function_url;


        $.ajax({
            type: 'get',
            url: ajax_url,
            cache: false,
            dataType: 'json',
            success: function(data) {

                //console.log(data);
                var table_data = data.table_data;
                var multi_project = data.multi_project;
                var gantt_data = new Array();

                if(multi_project == 1){
                    $.each(table_data, function(index, item) {

                        var pp_doc_id = item.document_id;
                        var start_date = item.start_date;
                        var end_date = item.end_date;
                        var ongoing = '';
                        var additional_label = ' ';
                        var indicator = 'bar-' + index;

                        //console.log(indicator);

                        if (end_date == '') {
                            end_date = new Date();
                            ongoing = 'ongoing';
                            additional_label = ' (Project Duration not specified)';
                        }

                        //comparison on dates to get color
                        var start = new Date(start_date);
                        var end = new Date(end_date);
                        var current = new Date();
                        var custom_Class, label;



                        if (start > current && ongoing != 'ongoing') {
                            custom_Class = 'gantt-color-orange ' + indicator; //upcoming
                            label = 'upcoming';
                        } else if (start > current && ongoing == 'ongoing') {
                            custom_Class = 'gantt-color-orange ' + indicator; //upcoming
                            end_date = start_date;
                            label = 'upcoming' + additional_label;
                        } else {
                            if (end < current && ongoing != 'ongoing') {
                                custom_Class = 'gantt-color-red ' + indicator; //finished
                                label = 'finished';
                            } else {
                                custom_Class = 'gantt-color-green ' + indicator; //ongoing
                                label = 'in-progess' + additional_label;
                            }
                        }

                        /*console.log(start_date);*/

                        var project_data = {
                            name: item.code,
                            desc: item.name,
                            startLink: '<a href="'+base_url+'reliability-maintenance/project-tracker-gantt-chart/'+pp_doc_id +'">',
                            endLink: '</a>',
                            values: [{
                                from: start_date,
                                to: end_date,
                                label: label,
                                customClass: custom_Class,
                                ppTitle: item.code,
                                ppDescription: label
                                
                            }]
                        };

                        gantt_data.push(project_data);

                        $(".gantt").popover({
                            selector: ".bar",
                            trigger: "hover",
                            placement: 'auto right'
                        });
                    });

"use strict";

$(".gantt").gantt({
    source: gantt_data,
    scale: "days",
    minScale: "days",
    navigate: "scroll",
    maxScale: "months",
    itemsPerPage: 50
});
}
else{
    var start_date = table_data.start_date;

    if(start_date == '' || start_date == null){
        $('.gantt').addClass('no-chart-available');
        $('.gantt').removeClass('gantt');
        $('.no-chart-available').html('This project has no start date specified! <a href="'+base_url + 'project-plan/view/'+ table_data.document_id+'" type="button" class="btn btn-sm btn-primary">View Project</a>');
        $('.horizontal-overflow-scroll').removeClass('horizontal-overflow-scroll');
    }
    else{
        var end_date = table_data.end_date;
        var ongoing = '';
        var additional_label = ' ';
        var indicator = 'bar-' + 0;

        if (end_date == '') {
            end_date = new Date();
            ongoing = 'ongoing';
            additional_label = ' (Project Duration not specified)';
        }

                        //comparison on dates to get color
                        var start = new Date(start_date);
                        var end = new Date(end_date);
                        var current = new Date();
                        var custom_Class, label;



                        if (start > current && ongoing != 'ongoing') {
                            custom_Class = 'gantt-color-orange ' + indicator; //upcoming
                            label = 'upcoming';
                        } else if (start > current && ongoing == 'ongoing') {
                            custom_Class = 'gantt-color-orange ' + indicator; //upcoming
                            end_date = start_date;
                            label = 'upcoming' + additional_label;
                        } else {
                            if (end < current && ongoing != 'ongoing') {
                                custom_Class = 'gantt-color-red ' + indicator; //finished
                                label = 'finished';
                            } else {
                                custom_Class = 'gantt-color-green ' + indicator; //ongoing
                                label = 'in-progess' + additional_label;
                            }
                        }

                        var project_data = {
                            name: 'Whole Project Duration',
                            desc: '',
                            values: [{
                                from: start_date,
                                to: end_date,
                                label: label,
                                customClass: custom_Class,
                                ppTitle: 'Project Status',
                                ppDescription: label
                            }]
                        };


                        gantt_data.push(project_data);

                        //DELIVERABLES

                        project_data = {
                            name: 'Deliverables',
                            desc: '',
                            values: [{
                                from: '',
                                to: ''
                            }]
                        }

                        gantt_data.push(project_data);

                        $.each(data.deliverables, function(index,item){

                            project_data = {
                                name: item.name,
                                desc: item.desc,
                                values: [{
                                    from: item.from,
                                    to: item.to,
                                    label: item.label,
                                    customClass: item.customClass,
                                    ppTitle: item.ppTitle,
                                    ppDescription: item.ppDescription  
                                }]
                            }
                            gantt_data.push(project_data);

                        });

                        //RISKS AND THREATS
                        project_data = {
                            name: 'Risks and Threats associated with the Delivery',
                            desc: '',
                            values: [{
                                from: '',
                                to: ''
                            }]
                        }

                        gantt_data.push(project_data);

                        $.each(data.constraints, function(index,item){

                            console.log(item.ppDescription);

                            project_data = {
                                name: item.name,
                                desc: item.desc,
                                values: [{
                                    from: item.from,
                                    to: item.to,
                                    label: '',
                                    customClass: item.customClass,
                                    ppTitle: item.ppTitle,
                                    ppDescription: item.ppDescription
                                }]
                            }
                            gantt_data.push(project_data);

                        });

                        //SPECIALIST REQUIREMENT
                        project_data = {
                            name: 'Specialist Requirement',
                            desc: '',
                            values: [{
                                from: '',
                                to: ''
                            }]
                        }

                        gantt_data.push(project_data);

                        $.each(data.specialist_requirement, function(index,item){

                            project_data = {
                                name: item.name,
                                desc: item.desc,
                                values: [{
                                    from: item.from,
                                    to: item.to,
                                    label: item.label,
                                    customClass: item.customClass,
                                    ppTitle: item.ppTitle,
                                    ppDescription: item.ppDescription  
                                }]
                            }
                            gantt_data.push(project_data);

                        });

                        //ASSOCIATED ACTIVITIES
                        project_data = {
                            name: 'Associated Activities',
                            desc: '',
                            values: [{
                                from: '',
                                to: ''
                            }]
                        }

                        gantt_data.push(project_data);

                        $.each(data.action_log, function(index,item){

                            project_data = {
                                name: item.name,
                                desc: item.desc,
                                values: [{
                                    from: item.from,
                                    to: item.to,
                                    label: item.label,
                                    customClass: item.customClass,
                                    ppTitle: item.ppTitle,
                                    ppDescription: item.ppDescription  
                                }]
                            }
                            gantt_data.push(project_data);

                        });

                        //ACTION TRACKER
                        project_data = {
                            name: 'Action Tracker',
                            desc: '',
                            values: [{
                                from: '',
                                to: ''
                            }]
                        }

                        gantt_data.push(project_data);

                        $.each(data.action_tracker, function(index,item){

                            project_data = {
                                name: item.name,
                                desc: item.desc,
                                values: [{
                                    from: item.from,
                                    to: item.to,
                                    label: item.label,
                                    customClass: item.customClass,
                                    ppTitle: item.ppTitle,
                                    ppDescription: item.ppDescription  
                                }]
                            }
                            gantt_data.push(project_data);

                        });

                        //MILESTONES
                        project_data = {
                            name: 'Milestones',
                            desc: '',
                            values: [{
                                from: '',
                                to: ''
                            }]
                        }

                        gantt_data.push(project_data);

                        $.each(data.milestone, function(index,item){

                            project_data = {
                                name: item.name,
                                desc: item.desc,
                                values: [{
                                    from: item.from,
                                    to: item.to,
                                    label: item.label,
                                    customClass: item.customClass,
                                    ppTitle: item.ppTitle,
                                    ppDescription: item.ppDescription  
                                }]
                            }
                            gantt_data.push(project_data);

                        });

                        //CHANGE MANAGEMENT
                        project_data = {
                            name: 'Change Management',
                            desc: '',
                            values: [{
                                from: '',
                                to: ''
                            }]
                        }

                        gantt_data.push(project_data);

                        $.each(data.change_management, function(index,item){

                            project_data = {
                                name: item.name,
                                desc: item.desc,
                                values: [{
                                    from: item.from,
                                    to: item.to,
                                    label: item.label,
                                    customClass: item.customClass,
                                    ppTitle: item.ppTitle,
                                    ppDescription: item.ppDescription  
                                }]
                            }
                            gantt_data.push(project_data);

                        });



                        $(".gantt").popover({
                            selector: ".bar",
                            trigger: "hover",
                            placement: 'auto right'
                        });




                        "use strict";

                        $(".gantt").gantt({
                            source: gantt_data,
                            scale: "days",
                            minScale: "days",
                            navigate: "scroll",
                            maxScale: "months",
                            itemsPerPage: 50
                        });
                    }

                }


                
                //console.log(table_data);


            //    tooltipsAndPopovers();
                //console.log(document_id);

            }

        });
}
}

function get_document_update(){

    var $document_update_container = $('#document-update-container');
    var document_id = $document_update_container.data('id');
    var $loading_updates = $('#loading-updates');


    if($document_update_container.length > 0){


        var function_url = 'document/get_document_updates/'+document_id;
        var ajax_url = base_url + function_url;

        $loading_updates.removeClass('hidden');

        $.ajax({
            type: 'post',
            url: ajax_url,
            dataType: 'html',
            success: function(data) {
                $loading_updates.addClass('hidden');
                $document_update_container.html(data);
                refresh_document_update_comments();
                new_document_update_comment();
                bootstrapEffects();
            }
        });

    }   
}

function refresh_update_comments(document_update_id, $comment_button){

    console.log($comment_button.html());
    var $loading_comments = $comment_button.closest('.timeline-panel').find('.loading-comments');
    //onsole.log($loading_comments.html());
    var $comment_container = $comment_button.closest('.single-timeline').find('.comments-container');

    var comment_container_height = $comment_container.height();
    

    var function_url = 'document/get_document_update_comments/'+document_update_id;
    var ajax_url = base_url + function_url;

    $loading_comments.css('height', comment_container_height+'px');
    $loading_comments.css('display','block');
    $loading_comments.removeClass('hidden');
    //console.log($comment_container.html());
    $comment_container.html('');

    $.ajax({
        type: 'post',
        url: ajax_url,
        dataType: 'html',
        success: function(data) {

            $loading_comments.addClass('hidden');
            $comment_container.html(data);
        }
    });
}

function refresh_document_update_comments(){

    var $refresh_comment_button = $('.refresh-comment');
    var $comment_container = $refresh_comment_button.closest('.single-timeline').find('.comments-container');

    

    

    $refresh_comment_button.click(function(){

        var $refresh_comment_button = $(this);

        var document_update_id = $refresh_comment_button.data('id');

        refresh_update_comments(document_update_id, $refresh_comment_button);

    });
}

function new_document_update_comment(){

    var $comment_button = $('.submit-comment');
    

    var $loading_comments = $('#loading-comments');

    $comment_button.click(function(){

        var $comment_button = $(this);

        var $comment_container = $comment_button.closest('.single-timeline').find('.comments-container');
        var $comment_text_container = $comment_button.closest('.single-timeline').find('.comment-text-container');
        var document_update_id = $comment_button.data('id');

        var comment_text = $comment_text_container.find('.comment-textarea').val();

        if(comment_text == ''){
            $comment_text_container.addClass('has-error');
            return false;
        }else{
            $comment_text_container.removeClass('has-error');
        }

        var function_url = 'document/new_document_update_comment';
        var ajax_url = base_url + function_url;

        var dataString = {
            'document_update_id': document_update_id,
            'comment': comment_text
        };


        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'html',
            success: function(data) {
                console.log(data);
                console.log('comment added');
                refresh_update_comments(document_update_id, $comment_button);
            }
        });

    });
}

function update_document(){

    var $update_document_panel = $('#update-document-panel');
    var $update_document_button = $update_document_panel.find('.update-document');
    var $title = $update_document_panel.find('.update-title');
    var $description = $update_document_panel.find('.update-description');

    var $document_update_container = $('#document-update-container');
    var document_id = $document_update_container.data('id');
    var $loading_updates = $('#loading-updates');

    $update_document_button.click(function(){

        var title = $title.val();
        var description = $description.val();

        if(title == ''){
            $title.closest('.form-group').addClass('has-error');
            return false;
        }else{
            $title.closest('.form-group').removeClass('has-error');
        }

        if(description == ''){
            $description.closest('.form-group').addClass('has-error');
            return false;
        }else{
            $description.closest('.form-group').removeClass('has-error');
        }

        var function_url = 'document/update_document';
        var ajax_url = base_url + function_url;

        dataString = {
            'document_id': document_id,
            'title': title,
            'description': description
        };

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'html',
            success: function(data) {
                get_document_update();
            }
        });

    });    
}

function floorPlanZoom() {

    var $floorplan_container = $('#floorplan-container');
    var $floorplan = $floorplan_container.find('.floorplan-image');

    if ($floorplan_container.length > 0) {
        //wheelzoom($floorplan);
        $(document).on('click', '.floorplan-image', function(e) {
            var offset = $(this).offset();
            console.log(e.clientX - offset.left);
            console.log(e.clientY - offset.top);
            $('#add-point-modal').modal();
        });
    }
}

function getFloorPlanList() {

    var $container = $('#floor-plan-table-container');
    var $floor_plan_container = $('#floor-plan-ajax');
    var $table_head = $floor_plan_container.find('thead');
    var $table_body = $floor_plan_container.find('tbody');
    var $loading = $('#loading-floor-plan');
    var $no_search = $('#no-floor-plan');

    if ($floor_plan_container.length > 0) {

        /* var $no_criticality_analysis = $('#no-criticality-analysis');
        var $no_search_found = $('#no-search-found');*/

        var token = $('input[name=9s8fjshd324hd98s]').val();
        var current_user_id = $('input[name=current_user_id]').val();
        var document_id = $('input[name=model_id]').val();

        

        $table_head.html('');
        $table_body.html('');
        /*to do loading animation */
        var function_url = 'mcdr/get_floor_plan';

        var ajax_url = base_url + function_url;

        var dataString = {

            "9s8fjshd324hd98s": token,
            "current_user_id": current_user_id,
            "document_id": document_id
            /*to do action tracker filter variables here*/
        };
        $loading.removeClass('hidden');

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                console.log(data);
                $loading.addClass('hidden');

                        //console.log(data.status_dropdown);
                        var table_data = data.table_data;

                        if (table_data.length < 1) {

                            $container.addClass('hidden');
                            $('.remove-floor-plan-row').addClass('hidden');
                            $container.find('.add-floor-plan-row').addClass('hidden');
                            $no_search.removeClass('hidden');


                        } else {

                            var add_row = $container.find('.add-floor-plan-row').hasClass('hidden');
                            if (add_row == true) {
                                $('.add-floor-plan-row').removeClass('hidden');
                            }

                            $loading.addClass('hidden');

                            if ($no_search.hasClass('hidden') == false) {
                                $no_search.addClass('hidden');
                            }
                            if ($container.hasClass('hidden')) {
                                $container.removeClass('hidden');
                            }

                            var thead_columns = '<tr>';

                            thead_columns += '<th class="floor-plan-id">Floor Plan ID</th>';
                            thead_columns += '<th class="floor-plan-name">Name</th>';
                            thead_columns += '<th class="text-center actions">Action</th>';


                            thead_columns += '</tr>';

                            //$action_tracker_container_old.append(column_names);  
                            $table_head.append(thead_columns);

                            $.each(table_data, function(index, item) {

                                var row_table = '<tr class="data-row">';

                                row_table += '<td class="floor-plan-id-value">';
                                row_table += item.floor_plan_id;
                                row_table += '</td>';

                                row_table += '<td class="floor-plan-name-value">';
                                if (item.name == null) {
                                    item.name = '';
                                }
                                row_table += '<input type="text" class="form-control input-sm" name="floor_plan_name[]" value="'+item.name+'">';
                                row_table += '</td>';

                                    //action buttons
                                    row_table += '<td class="text-center action-column">';
                                    row_table += '<a href="#" class="btn btn-bordered btn-danger delete-row-floor-plan btn-sm"><span class="glyphicon glyphicon-minus"></span></a> ';
                                    row_table += '<input type="hidden" name="floor_plan_id[]" value="'+item.floor_plan_id+'">';
                                    row_table += '<a href="'+base_url+'mcdr/view-floor-plan/'+item.floor_plan_id+'" class="btn btn-bordered btn-success view-floor-plan btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a></td>';

                                    row_table += '</tr>';


                                //$action_tracker_container_old.append(row_html);
                                $table_body.append(row_table);
                            });

tooltipsAndPopovers();
                            //select_with_search();
                            //bootstrapTooltipEffects();
                            //toggle_action_tracker_table_columns();
                        }
                    }
                });

}
}

function createFloorPlan(){
    var $container = $('#floor-plan-container');
    var $floor_plan_container = $('#floor-plan-ajax');
    var $table_head = $floor_plan_container.find('thead');
    var $table_body = $floor_plan_container.find('tbody');
    var cloned_row;

    var current_user_id = $('input[name=current_user_id]').val();
    var document_id = $('input[name=model_id]').val();

    var function_url = 'mcdr/create_floor_plan';

    var ajax_url = base_url + function_url;
    var dataString = {

        "current_user_id": current_user_id,
        "document_id": document_id,
    };

    $(document).on('click', '.new-floor-plan-row', function(e) {
        e.preventDefault();
        if ($table_body.find('.data-row').length > 0) {

            var last_row = $table_body.find('tr.data-row').filter(':last');
            cloned_row = last_row.clone();

            $.ajax({
                type: 'post',
                url: ajax_url,
                data: dataString,
                dataType: 'json',
                success: function(data) {
                    //alert(data);
                    console.log(data);

                    cloned_row.find('.floor-plan-id-value').text(data);
                    cloned_row.find('input[name="floor_plan_id[]"]').val(data);
                    var a = cloned_row.find('.view-floor-plan').attr('href',base_url+'mcdr/view-floor-plan/'+data);
                    console.log(a);
                    $floor_plan_container.append(cloned_row);
                }     
            });
        }
        else{
            $.ajax({
                type: 'post',
                url: ajax_url,
                data: dataString,
                dataType: 'json',
                success: function(data) {
                    getFloorPlanList();
                }     
            });
        }     
    });
}

function removeFloorPlan(){
    var $container = $('#floor-plan-container');
    var $floor_plan_container = $('#floor-plan-ajax');
    var $table_body = $floor_plan_container.find('tbody');

    var function_url = 'mcdr/delete_floor_plan';
    

    var ajax_url = base_url + function_url;
    

    $(document).on('click', '.delete-row-floor-plan', function(e) {
        e.preventDefault();
        var $button = $(this);

        var floor_plan_id = $(this).siblings('input[name="floor_plan_id[]"]').eq(0).val();

        var dataString = {
            'floor_plan_id': floor_plan_id
        };

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'html',
            success: function(data) {

                $row = $button.closest('.data-row');

                var rowCount = $floor_plan_container.find('tbody tr').length;

                    //alert(rowCount);

                    if(rowCount == 1){
                        getFloorPlanList();
                    }
                    else{
                        $row.fadeOut(300, function() {
                           $row.remove();
                       });
                    }

                    
                }     
            });


    });   
}

function uploadFloorPlan() {

    var upload_form = $('#upload-floor-plan');

    if(upload_form.length > 0){

        //make the form an ajaxform
        var ajax_options = {
            dataType: 'json',
            beforeSubmit: function() {

                var upload_check = 1;

                var input_file = upload_form.find('input[type="file"]');

                if (input_file.val() == '') {
                    upload_check = 0;
                }

                if (upload_check == 0) {
                    upload_form.find('.upload-errors').html('<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><small>No File selected</small></div>')
                    return false;
                }

                /*var file_container_height = $upload_form_modal.find('.attach-files-container').height();
                $upload_form_modal.find('.uploading-progress').css('height', file_container_height);
                $upload_form_modal.find('.uploading-progress').removeClass('hidden');
                $upload_form_modal.find('.attach-files-container').addClass('hidden');*/
                upload_form.find('.upload-errors').html('');
            },
            success: function(data) {

                //console.log(data);

                //error uploads


                //upload data
                var upload_data = data.upload_data;

                //hidden
                setTimeout(function() {
                    upload_form.find('.uploading-progress').addClass('hidden');
                    upload_form.find('.attach-files-container').removeClass('hidden');

                    if (data.errors != '') {
                        upload_form.find('.upload-errors').html('<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><br><small>' + data.errors + '</small></div>');

                    } else {
                        loadFloorPlanImage();
                        getFloorPlanPlotPoints();
                    }

                    $('.upload-button').prop('disabled', false);
                }, 2000);
            }
        };

        $('#upload-floor-plan').ajaxForm(ajax_options);

        var upload_button = upload_form.find('.go-yes');

        $(document).on('click','.upload-button',function(e){
            e.preventDefault();

            var $upload_form_modal = $('#confirm-upload-form');
            var $upload_form_modal_yes = $upload_form_modal.find('.go-yes');
            var $upload_form_modal_no = $upload_form_modal.find('.go-no');

            var $upload_button = $(this);

            $upload_button.prop('disabled', true);

            $upload_form_modal.modal();

            $upload_form_modal_no.on('click', function(e) {

                $(this).closest('.modal').modal('hide');

                $upload_button.prop('disabled', false);

            });

            $upload_form_modal_yes.on('click', function(e) {

                $upload_form_modal.modal('hide');

                $('#upload-floor-plan').submit();


            });
        });          
    }    
}

function getFloorPlanPlotPoints(){
    var plot_point_container = $('#floor-plan-points');

    if(plot_point_container.length > 0){

        var table = plot_point_container.find('table.plot-table');
        var thead = table.find('thead');
        var tbody = table.find('tbody');

        tbody.html('');

        var floorplan_id = $('input[name="floorplan_id"]').val();
        
        var dataString = {
            'floor_plan_id':floorplan_id
        };

        var ajax_url = base_url + 'mcdr/get-floor-plan-plot-points';

        $.ajax({
            type: 'post',
            url: ajax_url,
            data: dataString,
            dataType: 'json',
            success: function(data) {

                if(data.length < 1){
                    table.addClass('hidden');
                    plot_point_container.find('#no-plot-points').removeClass('hidden');
                }else{
                    console.log(data);

                    if(table.hasClass('hidden')){
                        table.removeClass('hidden');
                    }


                    if(plot_point_container.find('#no-plot-points').hasClass('hidden') == false){
                        plot_point_container.find('#no-plot-points').addClass('hidden');
                    }

                    $.each(data, function(index, item) {
                        var tbody_data = '<tr>';

                        tbody_data += '<td>'+item.plot_num+'</td>';
                        tbody_data += '<td>'+item.note+'</td>';
                        tbody_data += '</tr>';

                        tbody.append(tbody_data);
                    });
                }
                

            }     
        });
}
}

function show_advance_search(){

    var hidden_search = $('.equipment-profile-document-search');

    $('#document-type-document-search').on('change',function(){

        var select_val = $(this).val();

        //basic version
        if(select_val == 'ofi' || select_val == 'basic-decf' || select_val == 'technical-bulletin'){
            if(hidden_search.hasClass('hidden')){
                hidden_search.removeClass('hidden');
                hidden_search.hide()
                hidden_search.slideDown();
            }

            hidden_search.find('input,select').attr("disabled",false);
        }
        else{
            if(!hidden_search.hasClass('hidden')){
                hidden_search.slideUp(400,function(){
                    hidden_search.addClass('hidden');
                });
                
            }

            hidden_search.find('input,select').attr("disabled",true);
        }
    });

    $('#document-type-document-search option').each(function() {
        var select_val = $(this).val();
        if($(this).is(':selected') && (select_val == 'ofi' || select_val == 'basic-decf' || select_val == 'technical-bulletin')){
            if(hidden_search.hasClass('hidden')){
                hidden_search.removeClass('hidden');
            }
        }
    });
}

function get_document_options(document_type, $container, selector){

    var function_url = 'document/get_document_selection/';

    var ajax_url = base_url + function_url;

    var dataString = {
        'document_type': document_type
    }

    $.ajax({
        type: "POST",
        url: ajax_url,
        data: dataString,
        dataType: "html",
        success: function(data) {
            $container.find(selector).html(data);
        }
    });
}

function fileManagerModal(){

    var $trigger_file_manager = $('.display-file-manager');
    var $file_manager_modal = $('#file-manager-modal');

    var $file_list_container = $('#file-list-container');

    

    $trigger_file_manager.click(function(){
        var $this = $(this);
        $file_manager_modal.modal();
        loadFileList($file_list_container, $file_manager_modal, $this);
        filterFileList($file_list_container, $file_manager_modal, $this);
        refreshFileList($file_list_container, $file_manager_modal, $this);
    });



}

function refreshFileList($file_list_container, $file_manager_modal, $trigger_file_manager){

    var $file_list_tab_button = $('.file-list-tab-button');

    $file_list_tab_button.click(function(){
        loadFileList($file_list_container, $file_manager_modal, $trigger_file_manager);
    });

}

function filterFileList($file_list_container, $file_manager_modal, $trigger_file_manager){

    $(document).on('click', '#filter-file-list', function(e){
        e.preventDefault();
        var filename = $('input[name="search_file"]').val();
        var filetype = $('select[name="file_type"]').val();
        var order = $('select[name="order"]').val()
        //alert(filename+' '+filetype+' '+order);

        loadFileList($file_list_container, $file_manager_modal, $trigger_file_manager, filename, filetype, order)
    });
}

function loadFileList($file_list_container, $file_manager_modal, $trigger_file_manager, filename, type, order){

    var function_url = 'user/file_list';

    var ajax_url = base_url + function_url;
    var filename = filename || null;
    var order = order || 'ASC';
    var type = type || null;
    var dataString = {
        'filename': filename,
        'type': type,
        'order': order
    }

    $.ajax({
        type: "POST",
        url: ajax_url,
        data: dataString,
        dataType: "html",
        success: function(data) {
            $file_list_container.html(data);

            var $add_to_textfield = $('.insert-to-field');
            var $rename_button = $('.rename-file');
            var $rename_modal = $('#edit-filename-modal');
            

            $add_to_textfield.click(function(){
                var $this = $(this);
                var file_path = $this.closest('.file-row').find('.filepath').text();
                var file_item_id = $this.closest('.file-row').find('.file-item-id').text();
                var filename = $this.closest('tr').find('.filename').text();
                //$file_manager_modal.modal('hide');
                $trigger_file_manager.val(filename);
                var $trigger_file_item_id = $trigger_file_manager.closest('.file-row').find(".file-item-id");
                var $trigger_file_path = $trigger_file_manager.closest('.file-row').find('.img-lightbox');

                $trigger_file_item_id.val(file_item_id);
                $trigger_file_path.attr('href', file_path);
            });

            /*$rename_button.click(function(){
                $rename_modal.modal('show');
            });*/
}
});

}

var fileFunctions = {
    rename: function(){
        $(document).on('click', '.rename-file', function(e){

            $('#edit-filename-modal').modal('show');

            var function_url = 'user/edit_file_name';
            var ajax_url = base_url + function_url;
            var parent = $(this).closest('tr.file-row');
            var file_id = parent.find('.file-item-id').text();
            var filename = parent.find('.filename').text();
            var extension = parent.find('.extension').text();

            $(document).on('click', '.go-yes', function(e){

                var newFileName = $('input[name="filename"]').val();

                var dataString = {
                    'file_id': file_id,
                    'file_name': filename,
                    'new_file_name': newFileName
                }

                $.ajax({
                    type: "POST",
                    url: ajax_url,
                    data: dataString,
                    dataType: "html",
                    success: function(data) {
                        console.log(data);
                    }
                });


            });


        });
}
};

function deleteFileList(){

    $(document).on('click', '.remove-file-from-list', function(e){
        e.preventDefault();

        var function_url = 'user/remove_file';

        var ajax_url = base_url + function_url;
        var parent = $(this).closest('tr.file-row');
        var file_id = parent.find('.file-item-id').text();
        var filename = parent.find('.filename').text();
        var dataString = {
            'file_id': file_id,
            'file_name': filename
        }

        $.ajax({
            type: "POST",
            url: ajax_url,
            data: dataString,
            dataType: "html",
            success: function() {

                parent.hide(400, function(){
                    parent.remove();
                });
            }
        });
    });

}

function create_document_modal(){

    var $document_modal = $('#add-document-modal');
    var $document_modal_selection = $document_modal.find('select[name=document_creation] option:selected');

    var $new_document_name = $document_modal.find('input[name=document_name]');
    var $new_start_date = $document_modal.find('input[name=start_date]');
    var $new_duration_no = $document_modal.find('input[name=duration_no]');
    var $new_duration_days = $document_modal.find('select[name=duration_days] option:selected');

    var $duplicate_form = $document_modal.find('.create-from-previous');
    var $new_form = $document_modal.find('.new');
    var $select_document = $new_form.find('select[name=document_id]');

    var $submit_button = $document_modal.find('.submit-button');

    var title;
    var document_name;
    var document_type;
    var selected_document_creation = $document_modal_selection.val();

    var new_document_name;
    var new_start_date;
    var new_duration_no;
    var new_duration_days;
    var new_duration;
    var document_id;
    var error = false;


    $new_document_name.keyup(function(){
        var $this = $(this);
        if($this.val() == '' || $this.val == null || $this.val == ' '){
            $this.closest('.form-group').addClass('has-error');
            error = true;
        }else{
            $this.closest('.form-group').removeClass('has-error');
            $this.closest('.form-group').addClass('has-success');
            error = false;
        }
    });


    $submit_button.click(function(e){
        //e.preventDefault();
        //console.log('submitted');

        document_id = $select_document.val();
        new_document_name = $new_document_name.val();
        new_start_date = $new_start_date.val();
        new_duration_no = $new_duration_no.val();
        new_duration_days = $new_duration_days.val();

        new_duration = new_duration_no + ' ' + new_duration_days;


        if(document_type != 'project-plan'){
            if(new_document_name == null || new_document_name == '' || new_document_name == ''){
                $new_document_name.closest('.form-group').addClass('has-error');
                error = true;
                return false;
            }else{
                $new_document_name.closest('.form-group').removeClass('has-error');
                $new_document_name.closest('.form-group').removeClass('has-success');
                error = false;
            }
        }else{
            if(new_document_name == null || new_document_name == '' || new_document_name == '' || new_duration_no == '' || new_start_date == ''){
                $new_document_name.closest('.form-group').addClass('has-error');
                $new_start_date.closest('.form-group').addClass('has-error');
                $new_duration_no.closest('.form-group').addClass('has-error');
                error = true;
                return false;
            }else{
                $new_document_name.closest('.form-group').removeClass('has-error');
                $new_document_name.closest('.form-group').removeClass('has-success');

                $new_start_date.closest('.form-group').removeClass('has-error');
                $new_start_date.closest('.form-group').removeClass('has-success');

                $new_duration_no.closest('.form-group').removeClass('has-error');
                $new_duration_no.closest('.form-group').removeClass('has-success');

                error = false;
            }
        }
        

        if(selected_document_creation == 'new'){
            console.log('new test');
        }else if(selected_document_creation == 'duplicate'){
            console.log(document_id);
        }

    });


    //$(document).on('click', '.create-document', function(e){
        $('.create-document').click(function(e){

            e.preventDefault();

            var $this = $(this);
        //console.log($this);
        title = $this.data('title');
        document_name = $this.data('name');
        document_type = $this.data('document-type');
        //console.log(title);
        
        $document_modal.find('.title').text(title);
        $document_modal.find('.new-selection').text('New '+title);
        $document_modal.find('.document-name').text(document_name);
        $document_modal.find('input[name=document_type]').val(document_type);

        console.log(document_type);
        if(document_type == 'project-plan'){
            console.log('project work pack');
            $document_modal.find('.project-workpack-date input').prop('disabled',false);
            $document_modal.find('.project-workpack-date').show();
        }else{
            $document_modal.find('.project-workpack-date input').prop('disabled',true);
            $document_modal.find('.project-workpack-date').hide();
        }

        $duplicate_form.hide();

        
        $document_modal.modal();
    });


$(document).on('change', 'select[name=document_creation]', function(){

    var $this = $(this);

    selected_document_creation = $this.find('option:selected').val();
        //console.log(selection);

        if(selected_document_creation == 'new'){
            $duplicate_form.hide();
            //$new_form.show();
            $submit_button.text('Create New');
        }else if(selected_document_creation == 'duplicate'){
            $duplicate_form.show();
            //$new_form.hide();
            $submit_button.text('Duplicate');
            get_document_options(document_type, $document_modal, 'select[name=document_id]');
        }


    });
}

function checkScrollBar() {
    if($('body').hasScrollBar()){
        var $this = $(this);
        $this.addClass('has-scroll');
    }else{
        var $this = $(this);
        $this.removeClass('has-scroll');
    }
}

function disableDisplayNone(){

    var $alternate_input = $('.alternate-input');
    var $alternate_select = $('.alternate-select');

    $.each($alternate_input, function(item,value){
        var $this = $(this);
        if($this.css('display') == 'none'){
            $this.prop('disabled', true);
        }
    });

    $.each($alternate_select, function(item,value){
        var $this = $(this);
        if($this.css('display') == 'none'){
            $this.prop('disabled', true);
        }
    });
}

function alternateSeletInput($main_container, clone){

    var clone = clone || false;
    var $main_container = $main_container || null;

    if(clone){
        var $dynamic_row = $main_container;
        //console.log($dynamic_row.html());
        var $alternate_input = $dynamic_row.find('.alternate-input');
        var $main_alternate_button = $dynamic_row.find('.alternate-button');

        

        var $last_alternate_input = $alternate_input.last();
        var $alternate_button = $main_alternate_button.last();

        $last_alternate_input.hide();
        $last_alternate_input.unbind();
        $alternate_button.unbind();

        $.each($main_alternate_button, function(index, value){
            var $this = $(this);
            var $this_alternate_select_container = $this.closest('.alternate-select-input');
            var $this_alternate_select = $this_alternate_select_container.find('.alternate-select');
            var $this_alternate_input = $this_alternate_select_container.find('.alternate-input');
            if($this.hasClass('alt-input')){

                $this_alternate_input.prop('disabled',false);
                $this_alternate_input.show();
                
                $this_alternate_select.hide();
                $this_alternate_select.prop('disabled',true);

            }else if($this.hasClass('alt-select')){

                $this_alternate_select.prop('disabled',false);
                $this_alternate_select.show();
                
                $this_alternate_input.hide();
                $this_alternate_input.prop('disabled', true);

            }
        });

    }else{
        var $alternate_button = $('.alternate-button');
        $('.alternate-input').hide();
    }
    


    //$('.alternate-input').unbind();
    //$('.alternate-input').unbind();
    //$('.tooltip').remove();
    //$('.alternate-input').find('*').unbind();

    

    
    

    $alternate_button.click(function(){

        var $this = $(this);
        var $alternate_select_container = $this.closest('.alternate-select-input');
        var $alternate_select = $alternate_select_container.find('.alternate-select');
        var $alternate_input = $alternate_select_container.find('.alternate-input');

        if($this.hasClass('alt-input')){

            $alternate_select.prop('disabled', false);
            $alternate_select.show();
            $alternate_input.prop('disabled',true);
            $alternate_input.hide();
            $this.find('i').removeClass('fa-th-list');
            $this.find('i').addClass('fa-plus-circle');
            $this.attr('title','add new');
            /*$this.tooltip('fixTitle');
            
            $this.tooltip('show');
            $this.tooltip('hide');*/

            $this.removeClass('alt-input');
            $this.addClass('alt-select');

        }else if($this.hasClass('alt-select')){

            $alternate_input.prop('disabled',false);
            //$alternate_input.val('');
            $alternate_input.show();
            $alternate_select.prop('disabled',true);
            $alternate_select.hide();
            $this.find('i').addClass('fa-th-list');
            $this.find('i').removeClass('fa-plus-circle');
            $this.attr('title','select from previous');
            /*$this.tooltip('fixTitle');
            
            $this.tooltip('show');
            $this.tooltip('hide');*/

            $this.addClass('alt-input');
            $this.removeClass('alt-select');

        }
    });
}

function checkFileConfig(file_extension){

    var return_data = false;

    var function_url = "user/check_allowed_extension/"+file_extension;

    var ajax_url = base_url + function_url;

    $.ajax({
        async:false,
        type: "GET",
        url: ajax_url,
        dataType: "html",
        success: function(data) {
            console.log(data);
            return_data = data;
        }
    });

    return return_data;
}

function uploadFileForm() {

    /*$(document).on('click', '.attach-action-tracker', function(e) {

        e.preventDefault();*/

        var form_html = $('.upload-file-list-form').html();
        var $upload_form_modal = $('.upload-file-list-form');
        var $upload_form_modal_yes = $upload_form_modal.find('.go-yes');
        var $upload_form_modal_no = $upload_form_modal.find('.go-no');

        var modal_body_hidden_item = $upload_form_modal.find('.hidden-item');
        var file_row = '<div class="row"><div class="col-sm-offset-1 col-sm-8"><div class="fileinput fileinput-new input-group" data-provides="fileinput"><div class="form-control action-tracker-upload" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div><span class="input-group-addon btn btn-default btn-file"><span class="glyphicon glyphicon-paperclip"></span><input type="file" name="userfile[]" ></span><a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><span class="glyphicon glyphicon-remove"></span></a></div></div><div class="col-sm-3 hidden text-center"></div></div>';
        $upload_form_modal.find('.upload-errors').html('');
        $upload_form_modal.find('.attach-files').html(file_row);
        //var input_id = '<input type="hidden" name="action_tracker_id" value="' + id + '" >';

        //make the form an ajaxform
        var ajax_options = {
            dataType: 'json',
            beforeSubmit: function() {

                var upload_check = 1;
                var file_allowed = true;
                var file_extension;
                var not_allowed_file_extension = [];

                $('input[type="file"]').each(function() {
                    var $this = $(this);

                    var file_name = $this.val();
                    file_extension = file_name.split('.')[1];
                    file_extension = file_extension.toLowerCase();

                    file_allowed = checkFileConfig(file_extension);

                    if(file_allowed == "false"){
                        upload_check = 2;
                        not_allowed_file_extension.push(file_extension);
                    }

                    if (file_name == '') {
                        upload_check = 0;
                    }
                });

                if (upload_check == 0) {
                    $upload_form_modal.find('.upload-errors').html('<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><p>Please add a file on all input fields</p></div>');
                    return false;
                }else if (upload_check == 2) {
                    var warning_message = ' file extension is not allowed';
                    if(not_allowed_file_extension.length > 1){
                        warning_message = " file extensions are not allowed";
                    }
                    $upload_form_modal.find('.upload-errors').html('<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><p> ['+not_allowed_file_extension.join(", ") + ']' + warning_message + '.</p></div>');
                    return false;
                }

                var file_container_height = $upload_form_modal.find('.attach-files-container').height();
                $upload_form_modal.find('.uploading-progress').css('height', file_container_height);
                $upload_form_modal.find('.uploading-progress').removeClass('hidden');
                $upload_form_modal.find('.attach-files-container').addClass('hidden');
                $upload_form_modal.find('.upload-errors').html('');
            },
            success: function(data) {

                //var show_files_group = $row.find('span.show-files-group');

                var file_rows = $upload_form_modal.find('.attach-files > .row');

                $.each(data.file_check, function(index, check) {
                    $.each(file_rows, function(i) {
                        if (index == i) {
                            $(this).find('.col-sm-3').removeClass('hidden');
                            if (check.checked == 0) {
                                $(this).find('.col-sm-3').html('<span class="glyphicon glyphicon-remove red"></span>');
                            } else {
                                $(this).find('.col-sm-3').html('<span class="glyphicon glyphicon-ok green"></span>');
                            }
                        }
                    });

                });


                var show_file_group_html = '';

                //error uploads

                //hidden
                setTimeout(function() {
                    $upload_form_modal.find('.uploading-progress').addClass('hidden');
                    $upload_form_modal.find('.attach-files-container').removeClass('hidden');
                    //show_files_group.html(show_file_group_html);

                    if (data.errors != '') {
                        $upload_form_modal.find('.upload-errors').html('<div class="alert alert-danger fade in" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button><br><small>' + data.errors + '</small></div>');
                    } else {

                    }

                    setTimeout(function() {
                        $('.upload-file-list-form').html(form_html);
                    },3000);
                }, 2000);
            }
        };

        $('#upload-general-files').ajaxForm(ajax_options);

        //modal_body_hidden_item.html(input_id);

        $upload_form_modal_no.on('click', function(e) {

            $(this).closest('.modal').modal('hide');
            modal_body_hidden_item.html('');

        });
    /*
});*/
}

function sidebarLogo(){
    /*Default Sidebar Condensed*/
    //window.location.reload();
    var $body = $('body');
    if($body.hasClass('sidebar-condensed')){
        $("div#integrity_logo").addClass("hidden");
        $("aside#sidebar").css( "margin-top", "0" );
    }

    /*Sidebar Button Trigger*/
    $("a.navbar-sidebar-toggle").on('click', function(){
        var $body = $('body');
        console.log($body);
        if($body.hasClass('sidebar-condensed'))
        {
            //alert("test");
            $("div#integrity_logo").addClass("hidden");
            $("aside#sidebar").css( "margin-top", "0" );
        }else{
            $("div#integrity_logo").removeClass("hidden");
            $("aside#sidebar").removeAttr("style");
        } 
        
    });
}

function getCriticalEquipment(){

    $critical_equipment_table = $('#critical-equipment-table');
    $refresh_equiment = $('#refresh-equipment');

    if($critical_equipment_table.length > 0){

        var function_url = "criticality_analysis/get_critical_equipment/table"

        var ajax_url = base_url + function_url;

        //before ajax

        $refresh_equiment.removeClass('hidden');

        //start ajax


        $.ajax({
            type: "POST",
            url: ajax_url,
            dataType: "html",
            success: function(data) {

                $critical_equipment_table.html(data);
                $refresh_equiment.addClass('hidden');

                edit_ce_modal();
            }
        }); // end ajax

    }

    

}


function criticality_analysis_scoring(){

    $("select.select_value").on('change', function(){

        //alert('test');
        var value = $(this).val();

        //console.log(value);

        if(value == 1)
        {
            $(this).closest("div.main_container").find("table.inside_container").removeClass("hidden");
        }
        else if(value == 2)
        {
            $(this).closest("div.main_container").find("table.inside_container").addClass("hidden");
        }

        

    });

}


function get_edit_ce(){

    var function_url = "criticality_analysis/get_critical_equipment/table"

    var ajax_url = base_url + function_url;

    //before ajax

    $refresh_equiment.removeClass('hidden');

    //start ajax


    $.ajax({
        type: "POST",
        url: ajax_url,
        dataType: "html",
        success: function(data) {

            $critical_equipment_table.html(data);
            $refresh_equiment.addClass('hidden');
        }
    }); // end ajax

}


function edit_ce_modal(){

    $("a.edit-button").on('click', function(e){

        e.preventDefault();

        var $this = $(this);

        //PHP generated value id
        var modal_ce_id = $this.data('id');

        //console.log(modal_ce_id);

        //Modal Content with ID
        var $modal_content = $("#edit-modal-content");

        //Modal Main Container
        //var $modal_container = $("modal-containter");

        //$modal_container.append('<p>Test</p>');

        // Calls Php Function and queries critical equipment with id;
        var function_url = "criticality_analysis/edit_ce/" + modal_ce_id;

        var ajax_url = base_url + function_url;

        $.ajax({
            type: "POST",
            url: ajax_url,
            dataType: "html",
            success: function(data) {
                //console.log(data);
                $modal_content.html(data);

            },
            error: function(error, data){
                console.log(error.responseText);
            }
        }); // end ajax

    });

}

/*Menu Admin Functions*/

function get_menu_list()
{

    var function_url = "menu_admin/ajax_menu_list";

    var ajax_url = base_url + function_url;

    $.ajax({
        type: "GET",
        url: ajax_url,
        dataType: 'html',
        success: function(data){

            //console.log(data);
            $("tbody#menu-admin").html(data);
            edit_menu_category();

        }
    });
}

function add_menu_category()
{
    $("#add-menu-category").on('click', function(){

        var function_url = "menu_admin/modal_create";

        var ajax_url = base_url + function_url;

        $.ajax({
            type: "GET",
            url: ajax_url,
            dataType: 'html',
            success: function(data){
                $("#menu-admin-create").html(data);
                $("#create-menu").modal('show');

            }
        });
        
        

    });
}

function edit_menu_category()
{
    $(".edit-menu-category").on('click', function(){
        
        var $this = $(this);
        var id = $this.data('id');

        //alert(id);

        $("#edit-menu").modal('show');
        
        var function_url = "menu_admin/edit/"+id;

        var ajax_url = base_url + function_url;

        $.ajax({
            type: "post",
            url: ajax_url,
            dataType: 'html',
            success: function(data){
                //alert(data);
                //console.log(data);
                $("#menu-admin-edit").html(data);
            },
            error: function(error, data){
                console.log(error.responseText);
            }

        });


    });
}


function get_menu_category_list()
{
    //alert('ok');
    var function_url = "menu_category_admin/ajax_menu_category_list";

    var ajax_url = base_url + function_url;

    $.ajax({
        type: "GET",
        url: ajax_url,
        dataType: 'html',
        success: function(data){
            $("div.loading-menu-table").addClass('hidden');
            //console.log(data);
            $("tbody#menu-admin-category").html(data);
            edit_menu_category_admin();

        }
    });
}


function create_menu_category_modal()
{
    $("button.create-category").on('click', function(){
        //$("#create-menu-category").modal('show');

        var function_url = "menu_category_admin/modal_create";

        var ajax_url = base_url + function_url;

        $.ajax({
            type: "GET",
            url: ajax_url,
            dataType: 'html',
            success: function(data){
                //console.log(data);
                $("#add-menu-admin-category").html(data);
                $("#create-menu-category").modal('show');

            }
        });

    });
}

function edit_menu_category_admin()
{

    $("button.edit-menu-catgeory-admin").on('click', function (){

        var $this = $(this);
        var id = $this.data('id');

        //console.log(id);
        $("#edit-menu").modal('show');
        
        var function_url = "menu_category_admin/edit/"+id;

        var ajax_url = base_url + function_url;

        $.ajax({
            type: "post",
            url: ajax_url,
            dataType: 'html',
            success: function(data){
                //console.log(data);
                $("#edit-menu-admin-category").html(data);
                $("#edit-menu-category").modal('show');
            },
            error: function(error, data){
                console.log(error.responseText);
            }

        });


    });
}


function get_menu_subcategory_list()
{
    var function_url = "menu_subcategory_admin/ajax_menu_subcategory_list";

    var ajax_url = base_url + function_url;

    $.ajax({
        type: "GET",
        url: ajax_url,
        dataType: 'html',
        success: function(data){

            //console.log(data);
            $("tbody#menu-subcategory-admin").html(data);
            $(".loading-menu-subcategory").addClass('hidden');
            $("#menu-subcategory-thead").removeClass('hidden');
            $("button.create-menu-subcategory").removeClass('hidden');
            menu_subcategory_edit_modal();

        }
    });
}


function menu_subcategory_add_modal()
{
    $(".create-menu-subcategory").on('click', function (){

        var function_url = "menu_subcategory_admin/create_modal";

        var ajax_url = base_url + function_url;

        $.ajax({
            type: "GET",
            url: ajax_url,
            dataType: 'html',
            success: function(data){
                //console.log(data);
                $("#create-modal-menu-subcategory").html(data);
                $("#create-menu-subcategory-modal").modal('show');

            }
        });

    });
}


function menu_subcategory_edit_modal()
{
    $("button.edit-menu-subcategory").on('click', function(){

        var $this = $(this);
        var id = $this.data('id');

        //console.log(id);
        $("#edit-menu").modal('show');
        
        var function_url = "menu_subcategory_admin/edit/"+id;

        var ajax_url = base_url + function_url;

        $.ajax({
            type: "post",
            url: ajax_url,
            dataType: 'html',
            success: function(data){
                //console.log(data);
                $("#edit-modal-menu-subcategory").html(data);
                $("#edit-menu-subcategory-modal").modal('show');
            },
            error: function(error, data){
                console.log(error.responseText);
            }

        });

    });
}







/* END EXPERIMENTAL FUNCTIONALITIES */

jQuery(function($) {
    'use strict';

    ajaxSetup();

    selectEffects();
    bootstrapEffects();
    tooltipsAndPopovers();
    inputEffects();
    tableEffects();
    document_status();
    //user_document_status();

    editUserProfile();
    changePhoto();

    userHistoryOfAvailability();
    editLessonsToBeLearned();
    addRemoveFollowUser();

    deliverableDateRange();

    getDataTable('basic-decf-json', 'basic-decf', 'DECF');
    getDataTable('decf-json', 'case-file', 'F-DECF');
    getDataTable('ofi-json', 'ofi');
    getDataTable('project-plan-json', 'project-plan');
    getDataTable('technical-bulletin-json', 'technical-bulletin');
    getDataTable('witness-statement-json', 'witness-statement');
    getDataTable('technical-query-json', 'technical-query');
    getDataTable('erp-json', 'erp', 'ERP');
    getDataTable('mcdr-json', 'mcdr', 'MCDR');

    getUserData();

    navbarToggle();



    dynamicRow('constraints-table', 'constraints', null, false, '', 'default');
    dynamicRow('next-steps-table', 'next_step');
    dynamicRow('cost-breakdown-table', 'cost_breakdown', null, false, '', 'default');
    dynamicRow('benefit-breakdown-table', 'benefits_breakdown', null, false, '', 'default');
    dynamicRow('enablers-table', 'enabler', null, false, '', 'default');
    dynamicRow('enablers-prerequisite-table', 'prerequisite', null, false, '', 'default');
    dynamicRow('enablers-dependencies-table', 'dependency', null, false, '', 'default');
    dynamicRow('organisation-table', 'organisation', null, false, '', 'default');
    dynamicRow('action-tracker-table', 'action_tracker', null, false, '', 'default');
    dynamicRow('reporting-table', 'reporting', null, false, '', 'default');
    dynamicRow('meeting-table', 'meeting', null, false, '', 'default');
    dynamicRow('action-log-table', 'action_log', '.row', false, '', 'default');
    dynamicRow('change-management-table', 'change_management', null, false, '', 'default');
    dynamicRow('milestone-table', 'milestone', null, false, '', 'default');
    dynamicRow('additional-user', 'document_owner', '.col-row');
    dynamicRow('follow-user', 'follow_user', '.col-row', false, '', 'col-sm-4 col-sm-offset-7', 'user_id');
    dynamicRow('expectation-table', 'expectation', null, false, '', 'default-no-padding');
    dynamicRow('deliverable-table', 'deliverable', null, false, '', 'default');
    dynamicRow('file-table', 'file', '.file-row', true);
    dynamicRow('rate-of-success-table', 'rate_of_success', null, false, '', 'default');
    dynamicRow('type-of-improvement-table', 'type_of_improvement', null, false, '', 'default');
    dynamicRow('failure-cause-table', 'failure_cause', '.failure-cause-row', false, '', 'default');
    dynamicRow('consequence-table', 'failure_impact', '.consequence', false, '', 'default');
    dynamicRow('responsible-party-table', 'test_process', null, false, '', 'default');
    dynamicRow('process-step-table', 'process_step');
    dynamicRow('quality-control-step-table', 'quality_control_step', null, false, '', 'default');
    dynamicRow('timeline-table', 'timeline', null, false, '', 'default');
    dynamicRow('maintenance-activity-table', 'maintenance_activity', '.row-activity', false, '', 'default');
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


    textareaEffects();


    delete_file_row();

    checkIfSaved();
    confirmDelete();

    validateSteps();

    option1Checker();
    option2Checker();
    coloredSelectEffects();

    user_criticality('criticality-redundancy', 'criticality_redundancy', 'Reliability/<br>Redundancy');
    user_criticality('criticality-safety', 'criticality_safety', 'Safety<br>Health<br>Criticality');
    user_criticality('criticality-environment', 'criticality_environment', 'Environmental<br>Criticality');
    user_criticality('criticality-operation', 'criticality_operation', 'Operational<br>Criticality');
    user_criticality('criticality-reinstatement', 'criticality_reinstatement', 'Reinstatement', true);
    user_criticality('criticality-status', 'criticality_status', 'Status', false, true);
    update_user_criticality();
    edit_criticality_score();
    user_criticality_analysis_scoring();

    

    getActionTrackerList();

    getIndividualActionTracker();


    updateActionTracker();
    updateSubActionTracker();
    addRemoveActionTrackerButtons();
    //deleteSpecificRowActionTracker();
    uploadFromSpecificRowActionTracker();
    filterMasterActionTracker();
    addSubactionTrackerRow();
    toggleActionTrackerTableColumns();
    createNewAttachFileRowActionTracker();
    updateActionTrackerDocumentDropdown();
    createActionTrackerModal();


    button_scroll();
    scroll_top();
    enableEndDateRange();
    daysInMonth();
    dateRange();


    /* REPORTS */
    user_criticality_analysis();
    user_compliance_dashboard();
    update_user_compliance();
    update_user_single_index();
    user_single_index();

    user_failure_rate();
    edit_failure_rate();
    delete_failure_rate();

    edit_criticality_analysis();
    delete_criticality_analysis();
    createCriticalityAnalysis();

    filterCriticalityAnalysis();
    filterCriticalityAnalysisValues();

    getCriticalityAnalysisHistoryDailyValues();
    editCriticalityAnalysisHistoryValues();
    containerResize();
    /* END REPORTS */

    /* DOCUMENT RANKING */
    exportCSV();

    documentComments();
    moreComments();
    /* END DOCUMENT RANKING */

    documentStatusList();

    userWeeklyPlan();
    updateWeeklyPlan();
    removeWeeklyPlan();
    weeklyPlanClone();
    createWeeklyPlan();
    fixSizeAddRemoveFollowUser();

    /* evaluation pp*/
    numberEffects();
    hide_plus_minus_button();

    checkForCompletedForms('form.check-completed');

    /* document ranking */
    tb_ranking();
    rank_document();
    get_ranking_like();
    /* end document ranking */

    fiveWhyQuestionEffects();


    /* experimental functions */

    //ticker();
    get_sidebar_followers();
    firstTimeLogin();
    //imageNotes();
    loadImage();
    floorPlanZoom();
    getFloorPlanList();
    createFloorPlan();
    removeFloorPlan();
    uploadFloorPlan();
    loadFloorPlanImage();

    get_document_update();
    update_document();

    required_input();

    create_document_modal();

    checkScrollBar();

    alternateSeletInput();
    disableDisplayNone();

    uploadButtonTweaks();

    displayActionTrackerPastDueDate();
    refreshNotifications();

    getDocumentFollowers();
    getUserFollowers();

    fileManagerModal();

    actionTrackerChanges();

    equipmentProfileDropdownDependency();

    getCriticalEquipment();

    /* end experimental functions */

    /*project tracker*/
    getProjectTrackerList();
    filterProjectTracker();
    editCostBreakdown();
    followProjectTracker();
    projectTrackerdetailedCostBreakdown();
    projectTrackerdetailedSpecialistRequirment();
    projectTrackerGanttChart();
    getFloorPlanPlotPoints();
    show_advance_search();
    uploadFileForm();
    deleteFileList();
    //filterFileList();


    //inspection_type();
    /*loadInspectionType();*/
    //postGeneralInspectionData();

    //inspection_type();

    fileFunctions.rename();
    //viewGeneralInspectionData();
    documentHistoryListener();

    sidebarLogo();
    //addMoreFiles();
    criticality_analysis_scoring();

    get_menu_list();
    add_menu_category();

    get_menu_category_list();
    create_menu_category_modal();

    get_menu_subcategory_list();
    menu_subcategory_add_modal();

});


(function($) {
    $.fn.outerHTML = function() {
        return $(this).clone().wrap('<div></div>').parent().html();
    };
})(jQuery);

(function($) {
    $.fn.hasScrollBar = function() {
        return this.get(0).scrollHeight > this.height();
    }
})(jQuery);
