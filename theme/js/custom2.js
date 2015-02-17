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


function sidebarLogo() {
    
	$("a.navbar-sidebar-toggle").on('click', function(){

		/*$("div#integrity_logo").hide();
		$("aside#sidebar").css( "margin-top", "0" );*/

		var $body = $('body');
        //console.log($body);
        if($body.hasClass('sidebar-condensed'))
        {
             //alert("test");

            $("div#integrity_logo").removeClass("hidden");
            $("aside#sidebar").removeAttr("style");
        }else{
        	 //alert("test");

            $("div#integrity_logo").addClass("hidden");
            $("aside#sidebar").css( "margin-top", "0" );
        }      
    });
}

sidebarLogo();

Module.Scoring = (function() {

	function sticky_head(){
		
		$(".sticky_column").stick_in_parent().on("sticky_kit:bottom", function(e) {
		    //console.log("has stuck!", e.target);
		});

		$("table#roles-checkbox").floatThead("reflow");
	}

	function loading_calculate(){

		$("#calculate-score-form").submit(function(){

			$("#calculate-score-loading").modal('show');
		});
	}

	function info_suggest() {

		$("#info-suggest").change(function(){

			//alert('ok');

			var $this = $(this);


			var value = $this.val();

			//console.log(value);

			if(value == 0)
			{
				//alert('value 1');
				$("#list-redundancy-equipment").removeClass('hidden');
			
			}else if(value == 1)
			{
				//alert('value 1');
				$("#list-redundancy-equipment").addClass('hidden');

			}
		});

	}

	function multi_functional(){

		$("#multi-functional-role").change(function(){

			//alert('ok');
			var $this = $(this);

			var value = $this.val();

			if(value == 1)
			{
				//alert('value 1');
				$this.closest('.main_container').find('.inside_container').removeClass('hidden');
			
			}else if(value == 0)
			{
				//alert('value 2');
				$this.closest('.main_container').find('.inside_container').addClass('hidden');

			}

		});

	}

	return {
		Sticky: sticky_head,
		Loading: loading_calculate,
		Suggest: info_suggest,
		multi_functional: multi_functional
	}
})();

Module.module1 = (function() {
	// The functions above are PRIVATE FUNCTIONS that exist in the module.
	function hehe() {
		alert('hehe');
	}

	function haha() {
		alert('haha');
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
	                //console.log(data);
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
	                //console.log(data.responseText);
	                //console.log(error);
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

	return {
		// To enable the use of these PRIVATE functions, we need to add them to the return statement.
		// We can either call them as follows: Module.module1.hehe();
		// 									   Module.module1.haha();
		hehe: hehe,
		filterMasterActionTracker: filterMasterActionTracker
	}
})();

Module.module2 = (function() {
	function get_more_document_tracks() {
		$('#more-document-tracks').click(function() {
			// Get limit and offset.
			var limit = parseInt( $(this).attr("data-limit") );
			var offset = parseInt( $(this).attr("data-offset") );

			var test = $(this).attr("data-test");
			var result = {};
			var build_data = '';
			var params = { "limit": limit, "offset": offset };

			$.ajax({
				url: base_url + 'document/ajax_get_document_tracks',
				method: "GET",
				data: params,
				contentType: "application/json",
				success: function(data) {
					result = $.parseJSON(data);

					/*delete(result['sql']);*/
					
					/*alert(result['sql']);
					
					alert(result['sql']);
					//console.log(result);
					alert(result.length);*/

					//console.log(result + ' Length: ' + result.length);

					if(result.length != 0 || typeof result == 'undefined') {

						for(i in result) {
							build_data += '<tr>';
							build_data += '<td>' + result[i]['action'] + '</td>';
							build_data += '<td>' + result[i]['action_date'] + '</td>';
							build_data += '</tr>';
						}

						$('#recent-document-table').append(build_data);
					}
					else {
						alert('No more document logs found.');

						// Remove on finish.
						$('#more-document-tracks').fadeOut();
					}
				},
				beforeSend: function() {

				},
				complete: function() {
					

				}
			});

			$(this).attr("data-offset", offset + limit);
		});
	}

	return {
		get_more_document_tracks: get_more_document_tracks
	}
})();

Module.Paginate_Action_Tracks = (function() {
	// Listener for paginated links.
	// On click.
	// add New 
	// Listen again.
	// get_action_tracker() -- Function to get multiple data.
	function listen_pagination_links() {
		
		var $result = '';

		$('#paginated-links a').click(function() {
			// Get link url.
			var $page = parseInt($(this).attr("data-page-number"));
			
			// Get Search Values.
			var $main_filter = $('#main_filter').val();
			var $sub_filter = $('#sub_filter').val();
			var $optional_filter = $('#optional_filter').val();
			var $main_filter_data = $('#main-filter-data').val();
			var $optional_subfilter = $('#optional_subfilter').val();

			var $data = {
				"main_filter": $main_filter,
				"sub_filter": $sub_filter,
				"optional_filter": $optional_filter,
				"optional_subfilter": $optional_subfilter,
				"page": $page
			};

			alert('Data passed: ' + JSON.stringify($data));

			$.ajax({
				url: base_url + 'action_tracker/get_action_tracker',
				data: $data,
				method: "POST",
				async: false,
				success: function(data) {
					// Log Results.
					//console.log(data);

					// Isolate and Get variables.
					$result = $.parseJSON(data);

					// Table data.
					$table_data = $result['table_data'];
					$count = $result['count'];
					
					var $result_data = '';

					if($table_data.length != 0) {
						// Build table data.
						$result_data = '<p>Records found: <span class="text-danger">' + $count + '</span></p>';
						$result_data += '<table class="table">';

						$result_data += '<tr>';

						$result_data += '<th>' + 'Ref' + '</th>';
						$result_data += '<th>' + 'Type' + '</th>';
						$result_data += '<th>' + 'Action/Process Steps' + '</th>';
						$result_data += '<th>' + 'Action Status' + '</th>';
						$result_data += '<th>' +'Owner' + '</th>';
						$result_data += '<th>' + 'Due Date' + '</th>';
						$result_data += '<th>' + 'Comments/Description' + '</th>';

						$result_data += '</tr>';

						for(i in $table_data) {
							$result_data += '<tr>';

							$result_data += '<td>' + $table_data[i]['reference'] + '</td>';
							$result_data += '<td>' + $table_data[i]['document_type_name'] + '</td>';
							$result_data += '<td>' + $table_data[i]['action_process_step'] + '</td>';
							$result_data += '<td>' + $table_data[i]['full_name'] + '</td>';
							$result_data += '<td>' + $table_data[i]['reference'] + '</td>';
							$result_data += '<td>' + $table_data[i]['reference'] + '</td>';
							$result_data += '<td>' + $table_data[i]['reference'] + '</td>';

							$result_data += '</tr>';
						}

						$result_data += '</table>';

						$result_display = $result_data + $result['pagination_data'];
					} else {
						$result_data += '<div class="alert alert-danger" role="alert">No results found.</div>';
						$result_display = $result_data + $result['pagination_data'];
					}
				}
			});

			// If empty. Do nothing.

			/*alert($result['last_query']);*/

			$('#action-tracker-data').html($result_display).hide().fadeIn();

			listen_pagination_links();

			return false;
		});

		
	}

	function filter_search_results()
	{
		// Static IF Else on Values.
		// AJAX CALL.
	}

	return {
		listen_pagination_links: listen_pagination_links
	}
	
})();

Module.Criticality_Analysis = (function() {

	// ---------------------------------------------------

	function CSV_process() {

		if(navigator.appName == 'Microsoft Internet Explorer') {
			$('#loading-spinner').hide();
		} else {
			$('#loading-gear').hide();
		}

		$('#csv-generate').click(function() {
			// Main filter value.
			var $main_filter_value = $('#main-filter option:selected').data("value");
			
			$.ajax({
				url: base_url + 'criticality_analysis/generate_ce_report',
				method: "GET",
				beforeSend: function() {
					$('#csv-export-modal').modal();
				},
				success: function(data) {
					window.location = base_url + 'criticality_analysis/generate_ce_report?report_type=' + $main_filter_value;
				}, 
				complete: function() {
					$('#csv-export-modal').modal('hide');
				}
			});
		});	
	}

	// ---------------------------------------------------
	
	function get_cas_details(){

	    $("a.ca-details").on('click', function(e){

	        e.preventDefault();
			var $this = $(this);
			var modal_ca_id = $this.data('id');
			var $loading_ca_details = $('#loading-ca-details');

	        //console.log(modal_ca_id);
			var $modal_content = $("#ca-details-content");

	        var function_url = "criticality_analysis/stage_details/" + modal_ca_id;

	        var ajax_url = base_url + function_url;

	        $.ajax({
	            type: "get",
	            url: ajax_url,
	            dataType: "html",
	            success: function(data) {
	                //console.log(data);
	                $loading_ca_details.addClass('hidden');
	                $modal_content.html(data);
	            },
	            error: function(error, data){
	                //console.log(error.responseText);
	            }
	        }); // end ajax


	    });
	}

	// 2 Listeners.
	// 1st Populate
	// 2nd Input Fields
	function get_tag_data() {

		$('#tag_input').click(function() {
			// Trigger Modal.
			$('#tag_num').modal();

			var $ajax_result = {};
			var $data = '';

			// Ajax Call.
			$.ajax({
				url: base_url + 'criticality_analysis/ajax_get_critical_equipment/',
				method: "GET",
				async: false,
				success: function(data) {
					$ajax_result = $.parseJSON(data);

					if($ajax_result.length > 0) {
						// Build table.
						$data += '<table class="table table-bordered table-condensed" style="margin-top: 30px;">';
						$data += '<thead>';
						$data += '<tr>';
						$data += '<th>Tag No</th>';
						$data += '<th>System/Sub System</th>';
						$data += '<th>Qty</th>';
						$data += '<th></th>';
						$data += '</tr>';
						$data += '</thead>';
						$data += '<tbody>';
						
						// Generate result.
						for(i in $ajax_result) {
							
							// Stringified data.
							var $full_data = JSON.stringify($ajax_result[i]);
							$full_data = $full_data.replace(/\s+/g, '');

							// In between.
							$data += '<tr>';
							$data += '<td>' + $ajax_result[i]['tag_number'] + '</td>';
							$data += '<td>' + $ajax_result[i]['subsystem_component'] + '</td>';
							$data += '<td>' + $ajax_result[i]['quantity'] + '</td>';
							$data += '<td class="text-center">' + '<buton data-dismiss="modal" class="btn btn-sm btn-default criticality-data"  data-full=' + $full_data + '><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>' + '</td>';
							$data += '</tr>';
						}

						$data += '</tbody>';
						$data += '</table>';
					} else {
						$data += '<div class="alert alert-danger" role="alert">No data found.</div>';
					}
				}
			});

			// Append data to modal.
			$('#criticality-table-content').html($data);

			// Call listener.
			transfer_criticality_data();
		});
	}

	/*function ca_yes_no(){

	    $("select.select_value").on('change', function(){

	        //alert('test');
	        var value = $(this).val();

	        //console.log(value);

	        if(value == 1)
	        {
	            $(this).closest("div.main_container").find(".inside_container").removeClass("hidden");
	        }
	        else if(value == 0)
	        {
	            $(this).closest("div.main_container").find(".inside_container").addClass("hidden");
	        }
		});
	}*/

	// Optimize and change.
	function ca_yes_no() {
		//var $choice = $('select.select_value');
		var $choice = $('.group-answer').closest('select.select_value')

		$choice.change(function() {
			// This.
			var $this = $(this);

			// Get value.
			var $choice_value = $this.val();

			// Find inside container.
			var $inside_container = $this.closest("div.main_container").find(".inside_container");
			var $reset_button = $inside_container.siblings('.reset-rating');

			// 1 or 0.
			if($choice_value == 1) {
				// Show.
				$inside_container.removeClass("hidden");
				$reset_button.show();
			}
			else 
			if($choice_value == 0 || $choice_value == 2) {	
				$inside_container.addClass("hidden");
				$reset_button.hide();
			}
		});
	}

	function add_reset_button() {
		$('.group-question').find('table')
							.before( $('<button>Reset</button>').addClass("btn btn-default pull-right reset-rating")
																 .css("margin-right", "45px")
																 .css("margin-bottom", "10px")
																 .hide() );
		// All reset rating.
		var $reset_rating = $('.reset-rating');

		// Listener.
		$reset_rating.click(function(e) {
			e.preventDefault();
			
			var $this = $(this);

			// Get options.
			var $options = $this.next().find('option');
			var $zero_option = $this.next().find('option[value=""]');
			var $all_options = $this.next().find('option');
			var $select = $options.closest('select');
			
			// Remove selected from ALL options.
			$all_options.removeAttr("selected");
			$all_options.removeAttr("style");
			// Show all options.
			// $options.show();

			//To show elements
			$options.each(function(index, val) {
			    if(navigator.appName == 'Microsoft Internet Explorer') {
			        if (this.nodeName.toUpperCase() === 'OPTION') {
			            var span = $(this).parent();
			            var opt = this;
			            if($(this).parent().is('span')) {
			                $(opt).show();
							$(span).replaceWith(opt);
			            }
			        }
			    } else {
			        $(this).show(); //all other browsers use standard .show()
			    }
			});

			

			// Make the zeros selected.
			$zero_option.attr("selected", "");
			$zero_option.html('0');

			// Hide and show again animation.
			$select.hide().fadeIn();
		});	

		// Display the reset button where initially the page loads.
		$('.group-answer option:selected[value=1]')
										.closest('.group-question')
										.find('button').show();
	}

	function transfer_criticality_data() {
		// Model Tables invovled.
		$('.criticality-data').click(function() {
			// Get id.
			var $full_data = $(this).attr("data-full");
			
			//console.log($full_data);
			
			// Isolate.
			var $data = $.parseJSON($full_data);

			// Isolate datas
			var $asset_code = $data['asset_code'];
			var $critical_equipment_id = $data['critical_equipment_id'];
			var $ref = $data['ref'];
			var $name = $data['name'];

			var $tag_number = $data['tag_number'];
			var $subsystem_component = $data['subsystem_component'];

			var $code = $data['code'];
			var $quantity = $data['quantity'];

			// Change values.
			$('#asset_code').val($asset_code);
			$('#critical_equipment_id').val($critical_equipment_id); 
			$('#ref').val($ref); 
			$('#parent_sce').val($name);

			$('#tag_input').val($tag_number); parent_sce
			$('#sub_system').val($subsystem_component);

			$('#code').val($code); parent_sce
			$('#quantity').val($quantity);
		});
	}

	/*function transfer_criticality_data() {
		// Model Tables invovled.
		$('.criticality-data').click(function() {
			// Get id.
			var $full_data = $(this).attr("data-full");
			
			//console.log($full_data);
		});
	}*/

	function role_multi_test(){

		$role_body = $('#role-multi-functional');
		$role_selection = $role_body.find('.role-selection');
		$role_add = $role_body.find('.add-role');
		$role_list = $role_body.find('.role-list');
		$role_list_role_ids = $role_list.find('.role-id');

		$role_add.click(function(e){
			e.preventDefault();

			var role_id = $role_selection.val();

			$.ajax({
				url: base_url + 'criticality_analysis/role_list',
				method: "post",
				dataType: "html",
				data: {
					'add_role_id': role_id,
					'role_ids': $role_list_role_ids	
				},
				success: function(data) {
					//console.log(data);
				}
			});


		});
	}

	function redundancy_list_modal(){

		var $redundancy_list_body = $('#redundancy-list-body'); //for html('');
		var $redundant_items = $('#redundant-items2');
		var $all_equipment = $('#code-items');
		var redundant_ids = $('#redundant_ids').val();
		var code = $('input[name=code]').val();

		$("#second-loading").removeClass('hidden');

		if($redundant_items.html() == ''){
			$.ajax({
		        url: base_url + 'criticality_analysis/get_ce_by_ids',
		        type: 'post',
		        dataType: 'html',
		        data: {"redundant_ids":redundant_ids, "code":code},
		        success: function(data) {
		        	$redundant_items.html(data);
		        	$("#second-loading").addClass('hidden');
			    },
			    error: function(error, data){
			    	//console.log(error.responseText);
			    }
			});
		}

	}

	
	function available_redundancy() {

	    var $modal = $('#available_redundancy');
	    var $available_redundancy = $('.available-redundancy');

	    $available_redundancy.click(function(e) {
	        e.preventDefault();
	        $modal.modal();
	        available_redundancy_modal();
	    });


	    var $second_popup_modal = $('#ce-modal-redundancy-list');
	    var $redundancy_list_button = $('#redundancy-list-button');

	    $redundancy_list_button.click(function(e) {
	        e.preventDefault();
	        $second_popup_modal.modal();
	        redundancy_list_modal();
	    });






	    var $submit = $('#submit-available-redundancy');

	    $submit.click(function(e) {

	        var $this = $(this);
	        var $form = $this.closest('.modal').find('.ce-redundancy-form');


	        var post_data = $form.serialize();

	        $.ajax({
	            url: base_url + 'criticality_analysis/process_available_redundancy',
	            type: 'post',
	            dataType: 'json',
	            data: post_data,
	            beforeSend: function() {
	                // Hack -----------------------------------
	                var $very_similar = $('#equipment-redundancy').find('input:checked');
	                var $all_equipment = $('#equipment-all').find('input:checked');
	                var $content = $very_similar.extend($all_equipment);

	                console.log($content);
	                // Hack END -------------------------------
	            },
	            success: function(data) {
	                var redundant_ids = data.redundant_ids;
	                var equipment_count = data.equipment_count;

	                $available_redundancy.val(equipment_count);
	                $('.selected-redundancy-ce').text(equipment_count);
	                $("input[name=spof]").val(equipment_count);
	                $("input[name=spof_value]").val(equipment_count);

	                $("input[name=redundant_ids]").val(redundant_ids);
	            },
	            error: function(error, data) {
	                //console.log(error.responseText);
	            }
	        });

	        // Get redudant Data.
	        //var $new_redundant_data = $('#equipment-redundancy').find('td input:checked').parent().parent().clone();
	        //$new_redundant_data.find('input').prop('checked',false);
	        //var $redundant_data = $new_redundant_data;

	        var $redundant_data = $('#equipment-redundancy').find('td input:checked').parent().parent();

	        // Target Modal.
	        var $modal_redundancy_list = $('#ce-modal-redundancy-list');
	        var $modal_table_content = $modal_redundancy_list.find('tbody');
	        var $redundant_data_rows = '';
	        var x = '';

	        // Modal Content.
	        $('#redundant-items2').html('');

	        $redundant_data.each(function(index, value) {
	            $('#redundant-items2').append(value);

	        });


	        // Append data.
	        //$('#ce-modal-redundancy-list').find('tbody').html($redundant_data_rows);
	        //$('#excluded').html($redundant_data_rows);
	        //
	        //redundant-items2
	        //$('#redundant-items2').html($redundant_data_rows);
	    });
	}

	function insert_ce_code_data() {
	    // Get Code.
	    var $code = $('#code').val();
	    var $critical_equipment_id = $('#criticality_analysis_id').val();
	    var $result = '';


	    var $all_equipment_button = $('#all-equipment-redundancy-list');

	    $all_equipment_button.click(function(e) {
	        e.preventDefault();

	        var redundant_ids = $('#redundant_ids').val();
	        $("#second-loading").removeClass('hidden');
	        $('#code-items-table').addClass('hidden');

	        $.ajax({
	            url: base_url + 'criticality_analysis/ajax_get_ce_equipment_code',
	            method: "POST",
	            data: {
	                "code": $code,
	                "critical_equipment_id": $critical_equipment_id,
	                "redundant_ids": redundant_ids
	            },
	            dataType: "html",
	            success: function(data) {
	                $('#code-items').html(data);
	                $("#second-loading").addClass('hidden');
	                $('#code-items-table').removeClass('hidden');
	            },
	            error: function(data) {
	                //console.log('test');
	            }
	        });
	    })



	    // Append to html.
	}

	function insert_redundant_entries() {
	    $('#calculate-score-form').submit(function(e) {
	        alert('hehe');


	        e.preventDefault();
	        /*return false;*/
	    });
	}

	function change_final_redundancies() {

	    var $available_redundancy = $('.available-redundancy');

	    $('#submit-final-redundancy').click(function() {

	        var $this = $(this);
	        var $form = $this.closest('.modal').find('.ce-redundancy-second-modal');

	        var post_data = $form.serialize();

	        $.ajax({
	            url: base_url + 'criticality_analysis/process_available_redundancy',
	            type: 'post',
	            dataType: 'json',
	            data: post_data,
	            success: function(data) {
	                var redundant_ids = data.redundant_ids;
	                var equipment_count = data.equipment_count;

	                $available_redundancy.val(equipment_count);
	                $('.selected-redundancy-ce').text(equipment_count);
	                $("input[name=spof]").val(equipment_count);
	                $("input[name=spof_value]").val(equipment_count);

	                $("input[name=redundant_ids]").val(redundant_ids);
	            },
	            error: function(error, data) {
	                //console.log(error.responseText);
	            }
	        });
	        // Get both table's checked inputs.
	        // redundant-items2
	        // code-items

	        // Directory.
	        // Repeating items.
	        var $redudant_item_list = $('#redundant-items2');
	        var $all_equipment_list = $('#code-items');

	        var $redudant_items = $redudant_item_list.find('input:checked').parent().parent();
	        var $all_items = $all_equipment_list.find('input:checked').parent().parent();

	        $redudant_item_list.html($redudant_items);
	        $all_equipment_list.html($all_items);
	    });
	}

	function available_redundancy_modal(){

		var $available_redundancy = $('#available_redundancy');

		var $body = $available_redundancy.find('.ce-by-group');
		var code = $('#code').val();
		var critical_equipment_id = $('#critical_equipment_id').val();
		var redundant_ids = $('#redundant_ids').val();
		
		// alert(code);
		
		$.ajax({
				url: base_url + 'criticality_analysis/get_ce_by_group',
				method: "post",
				data: {"code": code, "critical_equipment_id": critical_equipment_id, "redundant_ids": redundant_ids},
				dataType: "html",
				success: function(data) {
		        	$("#critical-loading").addClass('hidden');
					$body.html(data);
				}
		});
	}

	function mutually_exclusive_dropdown() {

		// Hide all on start -------------------------
		
		// Get the DIV answer choice containers.
		var $question_container =  $('.group-answer option:selected[value=1]').closest('.group-question');
		var $selected_values = $question_container.find('.answer option:selected');

		// Loop the div container.
		$question_container.each(function(index, value) {
			// Loop value.
			var $question_group = $(value);
			var $group_selected_values = $question_group.find('.answer option:selected');

			// Loop the selected values.
			$group_selected_values.each(function(index, value) {

				var selected_value = $(value).html();
				$question_group
							.find('.answer option:selected[value!=' + selected_value + ']')
							.parent()
							.find('option[value=' + selected_value + ']')
							.wrap((navigator.appName == 'Microsoft Internet Explorer') ? '<span>' : null).hide();
			
			});	
			// $('.group-question').eq(0).find('.answer option:selected[value!=1]').parent()
		});

		// END ----------------------------------------

		// Bind on .answer.
		var $answers = $('.answer');

		$answers.change(function() {
			// Get this.
			var $this = $(this);

			// Parent Container
			var $parent = $this.closest('tbody');

			// Get all options.
			// Get all options first.
			var $options = $parent.find('option');

			//// Show all muna.
			//$options.show();

			// SHOW MICROSOFT. ---------------------------------
			//To show elements
			$options.each(function(index, val) {
			    if(navigator.appName == 'Microsoft Internet Explorer') {
			        if (this.nodeName.toUpperCase() === 'OPTION') {
			            var span = $(this).parent();
			            var opt = this;
			            if($(this).parent().is('span')) {
			                $(opt).show();
			                $(span).replaceWith(opt);
			            }
			        }
			    } else {
			        $(this).show(); //all other browsers use standard .show()
			    }
			});
			// END MICROSOFT SHOW. -----------------------------

			// Get all selected.
			var $selected = $this.closest('tbody').find('option:selected[value != ""]');

			var $selected_container = [];

			// Loop and hide each of the selected.
			$selected.each(function(index, value) {
				$selected_container.push( $(value).val() );
			});	

			// Make array unique.
			$selected_container = $($.unique($selected_container));

			// Loop and hide options with the corresponding values.
			$selected_container.each(function(index, value) {

				/*.find('.answer option:selected[value!=' + selected_value + ']')
							.parent()
							.find('option[value=' + selected_value + ']')
							.wrap((navigator.appName == 'Microsoft Internet Explorer') ? '<span>' : null).hide();


				$parent
					.find('option[value="' + value + '"]').hide();*/

				$parent
					.find('.answer option:selected[value!=' + value + ']')
					.parent()
					.find('option[value=' + value + ']')
					.wrap((navigator.appName == 'Microsoft Internet Explorer') ? '<span>' : null).hide();
			});
		});	
	}

	function old_calculate_cas(){

		var $calculate_cas_score = $('#calculate-cas-score');


		$calculate_cas_score.click(function(e){

			e.preventDefault();
			var $this = $(this);
			var $form = $(this).closest('form');

			$ca_role_id = $form.find('select[name=ca_role_id]');
			$answers = $form.find('.group-answer');

			var yes_flag = false;

			var ca_role_val = $ca_role_id.val();
			var yes_flag_text = '';

			//console.log(ca_role_val);

			if(ca_role_val != ""){
				yes_flag = true;

			}else{
				var $yes_flag_object = $ca_role_id;
				yes_flag_text = "Please select role.";
			}		

			/*$answers.each(function(index,value){
				var ans = $(value).val();
				if(ans == 1){
					yes_flag = true;
				}else{
					yes_flag = false;
					var $yes_flag_object = $(value);
					yes_flag_text = "Please select Y/N answer for equipment questions.";
				}
			});*/


			if(yes_flag){

				var post_data = $form.serialize();

				$this.find('.fa-clipboard').removeClass('fa-clipboard').addClass('fa-refresh fa-spin');

				
				$.ajax({
			        url: base_url + 'criticality_analysis/calculate_scoring/json',
			        type: 'post',
			        dataType: 'json',
			        data: post_data,
			        success: function(data) {
			        	var new_url = base_url + 'criticality_analysis/stage';
			        	$this.find('i').removeClass('fa-refresh').removeClass('fa-spin').addClass('fa-clipboard');
			        	//console.log(data.cas);
			        	$form.find('input[name=cas_val]').val(data.cas);
			        	$form.find('.submit-score').replaceWith('<a href="'+new_url+'" class="btn btn-info"><i class="fa-save"></i>  Submit</a>');
			        	$form.find('.cas-message').addClass('hidden');
				    },
				    error: function(error, data){
				    	//console.log(error.responseText);
				    }
				});
			}else{
				$form.find('.cas-message').text(yes_flag_text).removeClass('hidden');
				//console.log(yes_flag_text);
			}


			
		})
	}

	function calculate_cas(){

		var $calculate_cas_score = $('#calculate-cas-score');
		var $submit_cas_score = $('#submit-cas-score');


		$calculate_cas_score.click(function(e){

			var $this = $(this);
			var $form = $(this).closest('form');

			$form.attr('action', base_url + 'criticality_analysis/scoring')
			
		});
	}

	function filter_cas(){

		$filter_cas_submit = $('#filter-ca-stage-form');

		$filter_cas_submit.submit(function(e){
			e.preventDefault();
			
			var $this = $(this);

			refresh_cas_list($this);
		});	
	}

	function filter_cas_2(){

		$filter_cas_submit = $('#filter-ca-stage-form');

		$filter_cas_submit.submit(function(e){
			e.preventDefault();
			
			var $this = $(this);

			refresh_cas_list_2($this);
		});	
	}

	function refresh_cas_list($form){

		if($form != null){
			var $this = $form;
			var post_data = $this.serialize();
		}else{
			var post_data = {
				"main_filter" : ""
			};
		}
		
		var $loading = $('#loading-cas-list');
		var $body = $('#cas-list');

		$loading.removeClass('hidden');

		$.ajax({
			url: base_url + 'criticality_analysis/filter_cas',
			method: "get",
			data: post_data,
			dataType:"html",
			success: function(data) {
				$loading.addClass('hidden');
				$body.html(data);
				get_cas_details();
			},
			complete: function() {
				// Apply class on finish.
				$('.data-table').dataTable();
			}
		});
	} 

	function refresh_cas_list_2($form){

		if($form != null){
			var $this = $form;
			var post_data = $this.serialize();
		}else{
			var post_data = {
				"main_filter" : ""
			};
		}
		
		var $loading = $('#loading-cas-list');
		var $body = $('#cas-list');

		$loading.removeClass('hidden');

		$.ajax({
			url: base_url + 'criticality_analysis/filter_cas_2',
			method: "get",
			data: post_data,
			dataType:"html",
			success: function(data) {
				$loading.addClass('hidden');
				$body.html(data);
				get_cas_details();
			},
			complete: function() {
				// Apply class on finish.
				$('.data-table').dataTable();
			}
		});
	}

	function multi_role(){

		remove_role_row();

		$add_role = $('#add-role');
		$role_list = $('#role-list tbody');
		$role_row = $('#role-sample');
		

		$('#add-role').click(function(e){
			e.preventDefault();

			var $this = $(this);
			var add_role_value = $this.closest('table').find('select').val();
			$role_row.find('select').val(add_role_value);

			//console.log(add_role_value);

			var $new_role_row = $role_row.clone();
			$new_role_row.find('select').prop('disabled',false);
			$new_role_row.removeClass('hidden');
			//$new_role_row.find('select').val(add_role_value);
			//$new_role_row.find('select').val(add_role_value);
			$role_list.append($new_role_row.outerHTML());
			remove_role_row();
		});
	}

	function remove_role_row(){
		$role_list = $('#role-list tbody');
		$remove_role = $role_list.find('.remove');
		$remove_role.click(function(e){
			e.preventDefault();
			var $this = $(this);
			var $role_row = $this.closest('tr');

			$role_row.remove();
		});
	}


	return {
		get_tag_data: get_tag_data,
		ca_yes_no: ca_yes_no,
		role_multi_test: role_multi_test,
		available_redundancy: available_redundancy,
		mutually_exclusive_dropdown: mutually_exclusive_dropdown,
		calculate_cas: calculate_cas,
		filter_cas: filter_cas,
		refresh_cas_list: refresh_cas_list,
		multi_role: multi_role,
		add_reset_button: add_reset_button, 
		insert_ce_code_data: insert_ce_code_data,
		change_final_redundancies: change_final_redundancies,
		CSV_process: CSV_process,
		refresh_cas_list_2: refresh_cas_list_2,
		filter_cas_2: filter_cas_2
	}
})();

Module.Critical_Equipment = (function() {
	// Asset Listener.
	function asset_listener() {
		var $result = '';


		$('#asset_id').on('change', '', function() {
			var $asset_id = $(this).val();
			/*alert($asset_id);*/

			// Erase Ref.
			$('#ref').val('');

			$.ajax({
				url: base_url + 'criticality_analysis/ajax_get_all_parent_sce/',
				method: "GET",
				async: false,
				data: {"asset_id": $asset_id},
				success: function(data) {
					$result = data;
					$result = $.parseJSON($result);
					// alert($result);
					//console.log($result);
				}
			});

			// If naay result.
			if($result.length > 0 || 1) {
				// Change Result of Parent SCE Fields.
				var $options = '';
				for(i in $result) {
					//console.log($result[i]);
					$options += '<option data-ref="' + $result[i]['ref'] + '" value="' + $result[i]['ce_parent_sce_id'] + '" >' + $result[i]['name'] + '</option>';
				}

				$('#parent_sce_options').html($options);
			}
		});
	}

	function parent_sce_listener() {
		$('#parent_sce_options').on('change', '', function() {
			// Ref.
			var $ref = $('option:selected', this).attr("data-ref");
			$('#ref').val($ref);	
		});
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
	                //console.log(error.responseText);
	            }
	        }); // end ajax

	    });
	}

	function getCriticalEquipment() {

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
	            },
	            complete: function() {
	            	// Bind with listener.
	            	critical_equipment_edit();
	            }
	        }); // end ajax
		}
	}

	function get_critical_equipment_edit_details()
	{
		$('#critical-equipment-edit').submit(function(e) {
			// Test listener.
			/*alert('ehehe');*/
			
			// Cancel Submit.
			e.preventDefault();

			// Get data.
			var $this = $(this);

			// Result.
			var $result = {};
			var $update_result = '';

			// Get serialized.
			var $data = $this.serialize();

			$update_result += "<div class=\"alert alert-success alert-dismissible\" role=\"alert\">";
			$update_result += "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>";
			$update_result += "<strong>Comment Added Successfully!</strong>.";
			$update_result += "</div>";

			$.ajax({
				url: base_url + 'criticality_analysis/ajax_update_critical_equipment',
				method: "POST",
				data: $data, 
				async: false,
				success: function(data) {
					$result = data;

					if($result == 'True.') { 
						$('#update-alert').html($update_result).hide().fadeIn('slow');
						$('#edit').modal('toggle');
						//console.log($result);
					}
				}
			});

			// String params.
			var $string_params = JSON.parse('{"' + decodeURI($data).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
			var $critical_equipment_id = $string_params['critical_equipment_id'];
			var $ce_parent_sce_id = $string_params['ce_parent_sce_id'];

			// To get the ref target the parent sce.
			var $ref = $('#create').find('option[value=' + $ce_parent_sce_id +']').attr("data-ref");
			/*	$modal_create.find('option[value=1]');
			var $ref = $string_params['ref'];*/
			
			var $tag_number = $string_params['tag_number'];
			var $subsystem_component = $string_params['subsystem_component'];
			var $source_of_information = $string_params['source_of_information'];
			var $code = $string_params['code'];
			var $quantity = $string_params['quantity'];
			var $conflict = $string_params['conflict'];
			var $availability = $string_params['availability'];
			var $rule_set = $string_params['rule_set'];

			// Hide
			var $selector = '#critical-equipment a[data-id=' + 1 +']';
			var $table_row = $($selector).parent().parent().find('td').hide();

			//console.log($selector);
			
			// Change Data.
			
			$table_row.eq('1').html($ref); // Ref
			$table_row.eq('2').html($ce_parent_sce_id); // Parent SCE
			$table_row.eq('3').html('<a href=\"' + base_url + 'criticality-analysis/scoring/create/' + $critical_equipment_id + '\">' + $tag_number + '</a>'); // Tag Number
			$table_row.eq('4').html($subsystem_component); // Subsystem Componenet
			$table_row.eq('5').html($source_of_information); // Source of Information
			$table_row.eq('6').html($code); // Code
			$table_row.eq('7').html($quantity); // Quality
			$table_row.eq('8').html($conflict); // Conflict
			$table_row.eq('9').html($availability); // Availability
			$table_row.eq('10').html($rule_set); // Rule Set

			$table_row.fadeIn('slow');
		});	
	}

	function critical_equipment_edit() {
		$('.edit-button').click( function() {
			// Populate data.	
			var $this = $(this);
			var $data_id = $this.attr("data-id");
			var $result = {};
			var $data = '';
			/*alert(base_url + 'criticality-analysis/ajax_get_single_critical_equipment');*/

			$.ajax({
				url: base_url + 'criticality-analysis/ajax_get_single_critical_equipment',
				method: "GET",
				async: false,
				data: {"critical_equipment_id": $data_id},
				success: function(data) {
					$data = data;
					$result = $.parseJSON(data);
					//console.log($result);
				}
			});

			// Get data.
			$critical_equipment_id = $result['critical_equipment_id'];
			$tag_number = $result['tag_number'];
			$subsystem_component = $result['subsystem_component'];
			$code = $result['code'];
			$ref = $result['ref'];
			$conflict = $result['conflict'];
			$quantity = $result['quantity'];
			$availability = $result['availability'];
			$rule_set = $result['rule_set'];
			$source_of_information = $result['source_of_information'];
			$ce_group_id = $result['ce_group_id'];
			$ce_parent_sce_id = $result['ce_parent_sce_id'];

			// Asset asset_id
			// Parent SCE parent_sce_options
			// Group ce_group_id
			// Ref ref
			// Tag Number tag_number
			// Subsystem/ Component subsystem_component
			// Code code
			// Quantity quantity
			// Conflict conflict
			// Availability availability
			// Source of Info source_of_information
			// Rule Set rule_set
			
			var $modal = $('#edit');

			// Critical Equipment ID.
			$modal.find('#critical_equipment_id').val($critical_equipment_id);

			// PARENT SCE ID.
			$modal.find('#parent_sce_options option[value="' + $ce_parent_sce_id +'"]').attr("selected", "");

			// GROUP ID.
			$modal.find('#ce_group_id option[value="' + $ce_group_id +'"]').attr("selected", "");
			
			// Ref.
			$modal.find('#ref').val($ref);
			//$modal.find('#ref').val('haha');

			// Tag Number.
			$modal.find('#tag_number').val($tag_number);

			// Subsystem Component.
			$modal.find('#subsystem_component').val($subsystem_component);

			// Code.
			$modal.find('#code').val($code);

			// Quantity.
			$modal.find('#quantity').val($quantity);

			// Conflict.
			$modal.find('#conflict').val($conflict);

			// Source of Information.
			$modal.find('#source_of_information').val($source_of_information);

			// Availability.
			$modal.find('#availability').val($availability);

			// Rule Set.
			$modal.find('#rule_set').val($rule_set);
		});
	}

	return {
		asset_listener: asset_listener,
		parent_sce_listener: parent_sce_listener,
		getCriticalEquipment: getCriticalEquipment,
		get_critical_equipment_edit_details: get_critical_equipment_edit_details
	}
})();
