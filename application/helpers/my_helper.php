<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

if ( !function_exists( 'calculate' ) ) {
	function calculate( $value, $operation, $operation_value ) {

		$result = null;

		if($value != 0){
			switch($operation){
				case "multiply":
					$result = $value*$operation_value;
					break;
			}
		}else{
			$result = 0;
		}

		return $result;

	}
}


if ( !function_exists( 'convert_date_to_string' ) ) {
	function convert_date_to_string( $date = null, $no_default = false, $time = false, $format = "d/m/Y" ) {

		if ( $date == null || $date == '' || $date == 0 || $date == 'now' || $date == '1970-01-01 00:00:00' || $date == '1969-12-31 00:00:00' || $date == '1970-01-01' ) {
			if ( $no_default ) {
				$result = '';
			}else {
				if ( $time ) {
					$result = date( 'g:i A' );
				}else {
					$result = date( $format );
				}

			}
		}else {

			$date = strtolower( $date );

			$result = strtotime( $date );

			if ( $time ) {
				$result = date( 'g:i A', $result );
			}else {
				$result = date( $format, $result );
			}


		}

		return $result;
	}
}

if ( !function_exists( 'convert_string_to_time' ) ) {

	function convert_string_to_time( $time_string = null ) {
		//TODO: make a function that will convert string'10:00 AM' and return to mysql time
		$result = '';
		/*$zone = new DateTimeZone('Europe/London');*/
		if ( $time_string == null || $time_string == '' ) {
			$result =  new DateTime();
			$date = $result->format( 'H:i:s' );
		}else {
			$result =  new DateTime( $time_string );
			$date = $result->format( 'H:i:s' );
		}
		return $date;
	}
}

if ( !function_exists( 'convert_string_to_date' ) ) {
	function convert_string_to_date( $date = null, $no_default = false, $time = false, $numeric = false ) {

		$result = '';

		if ( $date == null || $date == '' || $date == 0 || $date == 'now' || $date == '1970-01-01 00:00:00' || $date == '1969-12-31 00:00:00' ) {
			if ( $no_default ) {
				$result = '';
			}else {
				if ( $time ) {
					$result = date( 'g:i A' );
				}else {
					if ( $numeric ) {
						$result = date( 'j/n/Y' );
					}else {
						$result = date( 'm/d/Y' );
					}

				}

			}
		}else {
			$date = strtolower( $date );
			$date = explode( '/', $date );
			$date_day = $date[0];
			$date_month = $date[1];
			$date_year = $date[2];
			$result = strtotime( $date_month.'/'.$date_day.'/'.$date_year );
			if ( $time ) {
				$result = date( 'g:i A', $result );
			}else {
				if ( $numeric ) {
					$result = date( "j/n/Y", $result );

				}else {
					$result = date( "m/d/Y", $result );
				}

			}



		}

		if($result != ''){
			$result = strtotime( $result );	
		}
		
		if ( $time ) {
			$result = date( 'Y-m-d G:i:s', $result );
		}else {
			$result = date( 'Y-m-d', $result );
		}


		return $result;
	}
}

if ( !function_exists( 'check_max_step_completed' ) ) {
	function check_max_step_completed( $max_step_completed, $step, $current_step ) {

		/*if($max_step_completed == '' || $max_step_completed == 0){
			if($step > 0){
				redirect('case-file/edit/'.$id);
				exit();
			}
		}else if($max_step_completed > 0){
			if($max_step_completed < $step){
				redirect('case-file/edit/'.$id.'/'.$current_step);
				exit();
			}
		}*/
	}
}




if ( !function_exists( 'get_dynamic_key_value_dropdown' ) ) {
	function get_dynamic_key_value_dropdown( $results, $default_value = '', $key_value = true, $value_name, $key_name = '', $default_select_value = '- Select -', $color_class = "bg-white" ) {

		$options = '';

		if ( $default_value == null ) {
			$options .= '<option value="" class="'.$color_class.'">'.$default_select_value.'</option>';
		}


		if ( $key_value ) {
			foreach ( $results as $result ) {

				$key = $result->{$key_name};
				$value = $result->{$value_name};

				if ( $default_value == $key ) {
					$options .= '<option value="'.$key.'" selected="selected" >'.$value.'</option>';
				}else {
					$options .= '<option value="'.$key.'">'.$value.'</option>';
				}
			}
		}else {
			foreach ( $results as $result ) {

				$value = $result->{$value_name};

				if ( $default_value == $value ) {
					$options .= '<option value="'.$value.'" selected="selected">'.$value.'</option>';
				}else {
					$options .= '<option value="'.$value.'">'.$value.'</option>';
				}
			}
		}

		return $options;
	}
}



if ( !function_exists( 'get_key_value_dropdown' ) ) {
	function get_key_value_dropdown( $result, $default_value = '', $key_value = true, $default_select_value = '- Select -' ) {

		$options = '';

		if ( $default_value == null ) {
			$options .= '<option value="" class="bg-white">'.$default_select_value.'</option>';
		}


		if ( $key_value ) {
			//var_dump($result);
			foreach ( $result as $key => $value ) {
				if ( $default_value == $key ) {
					$options .= '<option value="'.$key.'" selected="selected" >'.$value.'</option>';
				}else {
					$options .= '<option value="'.$key.'">'.$value.'</option>';
				}
			}
		}else {
			foreach ( $result as $value ) {
				if ( $default_value == $value ) {
					$options .= '<option value="'.$value.'" selected="selected">'.$value.'</option>';
				}else {
					$options .= '<option value="'.$value.'">'.$value.'</option>';
				}
			}
		}

		return $options;
	}
}

if ( !function_exists( 'get_key_value_dropdown_properties' ) ) {
	function get_key_value_dropdown_properties( $result, $default_value = '', $key_value = true, $no_default = false, $default_select_value = '- Select -' ) {

		$options = '';

		if ( $default_value == null ) {
			if ( $default_select_value != null ) {
				$options .= '<option value="" class="bg-white">'.$default_select_value.'</option>';
			}
		}

		if ( $no_default ) {
			$options = '';
		}


		if ( $key_value ) {
			//var_dump($result);
			foreach ( $result as $key => $value ) {
				if ( $default_value == $key ) {
					$options .= '<option value="'.$key.'" selected="selected" class="'.$value[1].'">'.$value[0].'</option>';
				}else {
					$options .= '<option value="'.$key.'" class="'.$value[1].'">'.$value[0].'</option>';
				}
			}
		}else {
			foreach ( $result as $value ) {
				if ( $default_value == $value ) {
					//$options .= '<option value="'.$value.'" selected="selected">'.$value.'</option>';
				}else {
					//$options .= '<option value="'.$value.'">'.$value.'</option>';
				}
			}
		}

		return $options;
	}
}

if ( !function_exists( 'priority_dropdown' ) ) {
	function priority_dropdown( $default_value = '', $exception = '' ) {

		$zero = false;
		$medium = false;
		$high = false;

		switch ( $default_value ) {
		case 'zero':
			$zero = true;
			break;
		case 'medium':
			$medium = true;
			break;
		case 'high':
			$high = true;
			break;
		}

		$result = '';



		if ( $zero ) {
			$result .= '<option class="form-control bg-white colored-select-option" value="zero" selected="selected">Zero</option>';
		}else {
			$result .= '<option class="form-control bg-white colored-select-option" value="zero">Zero</option>';
		}

		if ( $medium ) {
			$result .= '<option class="form-control bg-green colored-select-option" value="medium" selected="selected">Medium</option>';
		}else {
			$result .= '<option class="form-control bg-green colored-select-option" value="medium">Medium</option>';
		}

		if ( $exception != 'partial' ) {

			if ( $high ) {
				$result .= '<option class="form-control bg-red colored-select-option" value="high" selected="selected">High</option>';
			}else {
				$result .= '<option class="form-control bg-red colored-select-option" value="high">High</option>';
			}

		}




		return $result;
	}
}

if ( !function_exists( 'result_dropdown' ) ) {
	function result_dropdown( $default_value = '', $exception = '' ) {

		$issue_resolved = false;
		$partial_improvement = false;
		$no_improvement = false;

		switch ( $default_value ) {
		case 'issue resolved':
			$issue_resolved = true;
			break;
		case 'partial improvement':
			$partial_improvement = true;
			break;
		case 'no improvement':
			$no_improvement = true;
			break;
		default:
			break;

		}

		$result = '';



		if ( $issue_resolved ) {
			$result .= '<option class="form-control bg-green colored-select-option" value="issue resolved" selected="selected">Issue Resolved</option>';
		}else {
			$result .= '<option class="form-control bg-green colored-select-option" value="issue resolved">Issue Resolved</option>';
		}

		if ( $partial_improvement ) {
			$result .= '<option class="form-control bg-yellow colored-select-option" value="partial improvement" selected="selected">Partial Improvement</option>';
		}else {
			$result .= '<option class="form-control bg-yellow colored-select-option" value="partial improvement">Partial Improvement</option>';
		}

		if ( $exception != 'partial' ) {

			if ( $no_improvement ) {
				$result .= '<option class="form-control bg-red colored-select-option" value="no improvement" selected="selected">No Improvement</option>';
			}else {
				$result .= '<option class="form-control bg-red colored-select-option" value="no improvement">No Improvement</option>';
			}

		}




		return $result;
	}
}

if ( !function_exists( 'raci_dropdown' ) ) {
	function raci_dropdown( $default_value = '', $exception = '' ) {

		$r = false;
		$a = false;
		$c = false;
		$i = false;

		switch ( $default_value ) {
		case 'r':
			$r = true;
			break;
		case 'a':
			$a = true;
			break;
		case 'c':
			$c = true;
			break;
		case 'i':
			$i = true;
			break;
		}

		$result = '';



		if ( $r ) {
			$result .= '<option class="form-control" value="r" selected="selected">R</option>';
		}else {
			$result .= '<option class="form-control" value="r">R</option>';
		}

		if ( $a ) {
			$result .= '<option class="form-control" value="a" selected="selected">A</option>';
		}else {
			$result .= '<option class="form-control" value="a">A</option>';
		}

		if ( $c ) {
			$result .= '<option class="form-control" value="c" selected="selected">C</option>';
		}else {
			$result .= '<option class="form-control" value="c">C</option>';
		}

		if ( $i ) {
			$result .= '<option class="form-control" value="i" selected="selected">I</option>';
		}else {
			$result .= '<option class="form-control" value="i">I</option>';
		}






		return $result;
	}
}

if ( !function_exists( 'consequence_dropdown' ) ) {
	function consequence_dropdown( $default_value = '', $exception = '' ) {

		$catastrophic = false;
		$severe = false;
		$moderate = false;
		$minor = false;
		$zero = false;

		//echo $default_value;

		switch ( $default_value ) {
		case '5':
			$catastrophic = true;
			break;
		case '4':
			$severe = true;
			break;
		case '3':
			$moderate = true;
			break;
		case '2':
			$minor = true;
			break;
		case '1':
			$zero = true;
			break;
		}

		$result = '';


		if ( $zero ) {
			$result .= '<option class="consequence-priority form-control bg-green colored-select-option" value="1" selected="selected">Zero</option>';
		}else {
			$result .= '<option class="consequence-priority form-control bg-green colored-select-option" value="1">Zero</option>';
		}

		if ( $minor ) {
			$result .= '<option class="consequence-priority form-control bg-yellow colored-select-option" value="2" selected="selected">Minor</option>';
		}else {
			$result .= '<option class="consequence-priority form-control bg-yellow colored-select-option" value="2">Minor</option>';
		}

		if ( $moderate ) {
			$result .= '<option class="consequence-priority form-control bg-orange colored-select-option" value="3" selected="selected">Moderate</option>';
		}else {
			$result .= '<option class="consequence-priority form-control bg-orange colored-select-option" value="3">Moderate</option>';
		}

		if ( $severe ) {
			$result .= '<option class="consequence-priority form-control bg-red colored-select-option" value="4" selected="selected">Severe</option>';
		}else {
			$result .= '<option class="consequence-priority form-control bg-red colored-select-option" value="4">Severe</option>';
		}

		if ( $catastrophic ) {
			$result .= '<option class="consequence-priority form-control bg-red colored-select-option" value="5" selected="selected">Catastrophic</option>';
		}else {
			$result .= '<option class="consequence-priority form-control bg-red colored-select-option" value="5">Catastrophic</option>';
		}

		return $result;
	}
}

if ( !function_exists( 'get_color_class' ) ) {
	function get_color_class( $answer, $color_condition = '' ) {

		$red = 'bg-red';
		$green = 'bg-green';

		switch ( $answer ) {
		case 'confirmed':
			$result = 'bg-green';
			break;
		case 'estimated':
			$result = 'bg-orange';
			break;
		case 'n/a':
			$result = 'bg-white';
			break;
		case 'yes':
			$result = $red;
			break;
		case 'no':
			$result = $green;
			break;
		case 'partial':
			$result = 'bg-yellow';
			break;
		case 'suspected':
			$result = 'bg-orange';
			break;
		case 'zero':
			$result = 'bg-white';
			break;
		case 'medium':
			$result = 'bg-green';
			break;
		case 'high':
			$result = 'bg-red';
			break;
		case 'issue resolved':
			$result = 'bg-green';
			break;
		case 'partial improvement':
			$result = 'bg-yellow';
			break;
		case 'unknown':
			$result = 'bg-yellow';
			break;
		case 'no improvement':
			$result = 'bg-red';
			break;
		case 1:
			$result = 'bg-green';
			break;
		case 2:
			$result = 'bg-yellow';
			break;
		case 3:
			$result = 'bg-orange';
			break;
		case 4:
			$result = 'bg-red';
			break;
		case 5:
			$result = 'bg-red';
			break;
		default:
			$result = 'bg-white';
			break;
		}

		if ( $color_condition == 'swap_yes_no' || $color_condition == 'reversed' ) {
			if ( $answer == 'yes' ) {
				$result = $green;
			}else if ( $answer == 'no' ) {
					$result = $red;
				}
		}

		return $result;

	}
}

if( !function_exists('yes_no_default')){
	function yes_no_default($value, $default = true, $default_text = 'N/A', $full_text = false){

		$result = '';

		if($full_text){
			$yes = 'Yes';
			$no = 'No';
		}else{
			$yes = 'Y';
			$no = 'N';
		}

		if($value === 0 || $value === '0'){
			$result .= '<option value="'.$value.'">'.$no.'</option>';
		}else if($value == 1){
			$result .= '<option value="'.$value.'">'.$yes.'</option>';
		}else{
			if($default){
				$result .= '<option value="">'.$default_text.'</option>';
			}
		}




		return $result;
	}
}



if( !function_exists('default_option')){
	function default_option($value, $text, $default_text = '- Select -'){

		$result = '';

		
		if($value != ""){
			$result .= '<option value="'.$value.'">'.$text.'</option>';
		}else{
			$result .= '<option value="">'.$default_text.'</option>';
		}




		return $result;
	}
}


if ( !function_exists( 'comment_question_value' ) ) {
	function comment_question_value( $select_type, $answer, $value = 'hidden', $exclude = false ) {

		$result = '';

		if ( $select_type == 'reversed' && ( $answer == 'yes' || $answer == 'partial' || $answer == 'suspected' ) ) {
			$result = $value;
		}else if ( $select_type == 'reversed' && ( $answer == 'no' || $answer == 'partial' || $answer == 'suspected' ) ) {

			}else if ( $select_type == 'normal' && ( $answer == 'yes' || $answer == 'partial' || $answer == 'suspected' ) ) {

			}else if ( $select_type == 'normal' && ( $answer == 'no' || $answer == 'partial' || $answer == 'suspected' ) ) {
				$result = $value;
			}else {
			$result = $value;
		}

		if ( $exclude ) {
			return 'hidden-permanent';
		}else {
			return $result;
		}


	}
}

if ( !function_exists( 'comment_question_dropdown' ) ) {
	function comment_question_dropdown( $default_value = '', $select_type = 'normal', $na_default = 'N/A', $additional_settings = 'normal' ) {

		$na = false;
		$yes = false;
		$no = false;
		$partial = false;
		$suspected = false;

		if ( $select_type == 'reversed' || $additional_settings == 'reversed' ) {
			$yes_color = 'bg-green';
			$no_color = 'bg-red';
		}else {
			$yes_color = 'bg-red';
			$no_color = 'bg-green';
		}

		switch ( $default_value ) {
		case 'n/a':
			$na = true;
			break;
		case 'yes':
			$yes = true;
			break;
		case 'no':
			$no = true;
			break;
		case 'partial':
			$partial = true;
			break;
		case 'suspected':
			$suspected = true;
			break;
		}

		$result = '';


		if ( $select_type != 'none' ) {

			if ( $na ) {
				$result .= '<option class="form-control bg-white colored-select-option" value="n/a" selected="selected">'.$na_default.'</option>';
			}else {
				$result .= '<option class="form-control bg-white colored-select-option" value="n/a">'.$na_default.'</option>';
			}

			if ( $yes ) {
				$result .= '<option class="form-control '.$yes_color.' colored-select-option" value="yes" selected="selected">Yes</option>';
			}else {
				$result .= '<option class="form-control '.$yes_color.' colored-select-option" value="yes">Yes</option>';
			}

			if ( $no ) {
				$result .= '<option class="form-control '.$no_color.' colored-select-option" value="no" selected="selected">No</option>';
			}else {
				$result .= '<option class="form-control '.$no_color.' colored-select-option" value="no">No</option>';
			}

			if ( $select_type != 'no_partial' && $select_type != 'normal_option' ) {

				if ( $partial ) {
					$result .= '<option class="form-control bg-yellow colored-select-option" value="partial" selected="selected">Unknown</option>';
				}else {
					$result .= '<option class="form-control bg-yellow colored-select-option" value="partial">Unknown</option>';
				}

			}

			if ( $select_type != 'no_suspected' && $select_type != 'normal_option' ) {
				if ( $suspected ) {
					$result .= '<option class="form-control bg-orange colored-select-option" value="suspected" selected="selected">Suspected</option>';
				}else {
					$result .= '<option class="form-control bg-orange colored-select-option" value="suspected">Suspected</option>';
				}
			}



		}




		return $result;
	}
}

if ( !function_exists( 'area_of_impact_dropdown' ) ) {
	function area_of_impact_dropdown() {

		$result = '	<option class="form-control" value="safety">Safety</option>
                	<option class="form-control" value="environment">Environment</option>
                	<option class="form-control" value="production">Production</option>
                	<option class="form-control" value="drilling">Drilling</option>
                	<option class="form-control" value="costs">Costs</option>
                	<option class="form-control" value="reputation">Reputation</option>
                	<option class="form-control" value="legislative">Legislative</option>';

		return $result;
	}
}

if ( !function_exists( 'get_certainty_options' ) ) {
	function get_certainty_options() {

		$result = '<option class="danger  form-control" value="1">Yes</option>
                <option class="success form-control" value="2">No</option>
                <option class="warning form-control" value="3">Partial</option>
                <option class="primary form-control" value="4">N/A</option>';

		return $result;
	}
}

if ( !function_exists( 'random_string' ) ) {
	function random_string( $number_of_string ) {

		$result = substr( md5( microtime() ), rand( 0, 26 ), $number_of_string );

		return $result;
	}
}

if ( !function_exists( 'select_age_from' ) ) {
	function select_age_from() {

		$result = '';
		$n = 15;

		while ( $n < 99 ) {
			$result .= "<option value='{$n}'>{$n}</option>";
			$n++;
		}

		return $result;
	}
}

if ( !function_exists( 'select_age_to' ) ) {
	function select_age_to() {


		$result = "<option value='99'>99</option>";

		$n = 0;

		while ( $n < 99 ) {
			$result .= "<option value='{$n}'>{$n}</option>";
			$n++;
		}

		return $result;
	}
}

if ( !function_exists( 'image_thumbnail' ) ) {

	function image_thumbnail( $image_path, $width, $height, $mandatory = false ) {

		$image = '<img src="'.$image_path.'" width="'.$width.'" height="'.$height.'" />';

		if ( $mandatory ) {
			if ( $image_path == '' ) {
				return $image;
			}else {
				return $image;
			}
		}else {
			if ( $image_path == '' ) {
				return '';
			}else {
				return $image;
			}
		}
	}
}

if ( !function_exists( 'verify_checkbox_active' ) ) {

	function verify_checkbox_active( $value, $compare_string ) {

		$result = '';

		if ( $value == $compare_string ) {
			$result .= 'checked="checked"';
		}

		return $result;
	}
}

if ( !function_exists( 'select_month' ) ) {

	function select_month( $single_month = false, $month_start = 1 ) {

		$monthOptions = '';

		if ( $month_start == '' ) {
			$monthOptions .= "<option value=''>Month</option>";
		}else {
			if ( $single_month ) {
				$monthName = date( "M", mktime( 0, 0, 0, $month_start ) );
				$monthOptions .= "<option value=\"{$month_start}\">{$monthName}</option>\n";
			}else {

				for ( $month=$month_start; $month<=12; $month++ ) {
					$monthName = date( "M", mktime( 0, 0, 0, $month ) );
					$monthOptions .= "<option value=\"{$month}\">{$monthName}</option>\n";
				}

			}
		}


		return $monthOptions;
	}
}

if ( !function_exists( 'select_number' ) ) {

	function select_number( $from, $to, $default = false ) {

		$result = '';

		if ( $default ) {
			$result .= "<option value='{$default}'>{$default}</option>";
		}

		$n = $from;

		while ( $n <= $to ) {
			$result .= "<option value='{$n}'>{$n}</option>";
			$n++;
		}

		return $result;
	}
}

if ( !function_exists( 'select_gender' ) ) {

	function select_gender() {
		$result = '';
		$arrays = array( "all", "male", "female" );
		foreach ( $arrays as $array ) {
			$result .= "<option value='{$array}'>{$array}</option>";
		}

		return $result;
	}
}

if ( !function_exists( 'select_limit' ) ) {

	function select_limit( $from = 0, $to = 100 ) {
		$result = '';
		$n=$from;
		while ( $n < $to ) {
			$result .= "<option value='{$n}'>{$n}</option>";
			$n++;
		}

		return $result;
	}
}

if ( !function_exists( 'default_select' ) ) {
	function default_select( $value, $option_value = '', $select_text = '- Select -' ) {

		$result = '';

		if ( $option_value == null && $option_value != '' ) {

			$result = '<option value="">'.$select_text.'</option>';

		}else {

			if ( is_numeric( $value ) ) {
				if ( $value == 0 ) {
					$result = '<option value="">'.$select_text.'</option>';
				}
			}else {
				if ( $value == '' ) {
					$result = '<option value="">'.$select_text.'</option>';
				}else {
					if ( $value == 'yes' || $value == 'no' ) {
						$result = '<option value="'.$value.'">'.ucfirst( $value ).'</option>';
					}else {
						$result = '<option value="'.$value.'">'.ucfirst( $value ).'</option>';
					}
				}
			}

		}



		return $result;

	}
}

if ( !function_exists( 'steps_default_status' ) ) {

	function steps_default_status( $current_number, $max_number ) {

		$result = "";

		if ( $current_number <= $max_number ) {

		}else {
			$result = 'disabled="disabled"';
		}

		return $result;

	}
}

if ( !function_exists( 'steps_active' ) ) {

	function steps_active( $current_step, $compare_step ) {

		$result = "";

		if ( $current_step == $compare_step ) {
			$result = 'active';
		}

		return $result;
	}
}

if ( !function_exists( 'super_unique' ) ) {

	function super_unique( $array ) {
		$result = array_map( "unserialize", array_unique( array_map( "serialize", $array ) ) );

		foreach ( $result as $key => $value ) {
			if ( is_array( $value ) ) {
				$result[$key] = super_unique( $value );
			}
		}

		return $result;
	}
}

if ( !function_exists( 'detect_file' ) ) {

	function detect_file( $url, $filename ) {

		$data_setup = "{'example_option':true}";

		$result = '';

		$extension = get_filename_extension( $filename );

		switch ( $extension ) {
		case 'flv':
		case 'mp4':
			$result .=  '<video id="'.generate_slug( $filename ).'" class="video-js vjs-default-skin vjs-big-play-centered"
				  controls preload="auto" poster="" width="100%" height="500">
				 <source src="'.$url.'" type="video/'.$extension.'" />
				 <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
				</video>';
			break;
		case 'png':
		case 'jpg':
		case 'bmp':
		case 'jpeg':
		case 'gif':
			$result .= '<img class="img-responsive" src="'.$url.'" width="300" height="300" style="margin-bottom: 40px;"/>';
			break;
		case 'pdf':
		case 'docx':
		case 'doc':
		case 'odt':
			$result .= '<img class="pdf img-responsive" src="'.base_url( 'images/pdf-icon.png' ).'" width="150" height="150" />';
			break;

		}

		return $result;
	}
}

if ( !function_exists( 'file_url' ) ) {

	function file_url( $filename, $upload_directory = 'uploads' ) {

		$url = '';

		if ( $filename != null || $filename != '' ) {

			$url = base_url( $upload_directory.'/'.$filename );

		}

		return $url;
	}
}

if ( !function_exists( 'get_viewer_role' ) ) {

	function get_viewer_role( $user_id_1, $user_id_2 ) {

		if ( $user_id_1 == $user_id_2 ) {
			$view_mode = 'owner';
		}else {
			$view_mode = 'editor';
		}

		return $view_mode;
	}
}

if ( !function_exists( 'generate_steps_link' ) ) {
	function generate_steps_link( $step_function, $no_of_steps, $current_form_step, $step_titles = array() ) {

		$step_link_display = '';

		for ( $step = 1;$step<$no_of_steps+1;$step++ ) {

			$step_title = @$step_titles[$step-1];
			if(empty($step_title)){
				$step_title = 'this step';
			}

			$step_link = base_url( $step_function.'/'.$step );

			$steps_active = steps_active( $current_form_step, $step );

			$step_link_display .= '<div class="stepwizard-step">
	                  				<a href="'.$step_link.'" class="btn btn-default btn-circle '.$steps_active.'" data-toggle="tooltip" data-placement="top" title="Navigate directly to '.$step_title.'">'.$step.'</a>
	              				</div>';
		}

		return $step_link_display;
	}
}

/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 *
 * @author Joost van Veen
 * @version 1.0
 */
if ( !function_exists( 'dump' ) ) {
	function dump( $var, $label = 'Dump', $echo = TRUE ) {
		// Store dump in variable
		ob_start();
		var_dump( $var );
		$output = ob_get_clean();

		// Add formatting
		$output = preg_replace( "/\]\=\>\n(\s+)/m", "] => ", $output );
		$output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

		// Output
		if ( $echo == TRUE ) {
			echo $output;
		}
		else {
			return $output;
		}
	}
}

if ( !function_exists( 'dump_exit' ) ) {
	function dump_exit( $var, $label = 'Dump', $echo = TRUE ) {
		dump ( $var, $label, $echo );
		exit;
	}
}

if ( !function_exists( 'image_exist_original' ) ) {
	function image_exist_original() {
		$image_exist = false;
		$is_array = false;


		//CHECK ARRAY AND IMAGE SIZE
		if ( !empty( $url ) && !is_array( $url ) ) {

			//echo '!empty';
			if ( getimagesize( $url ) ) {
				$image_exist = true;
			}
		}else {

			$is_array = true;
			$url_src = $url['src'];

			if ( !empty( $url_src ) ) {
				if ( getimagesize( $url_src ) ) {
					$image_exist = true;
				}
			}

		}


		$default_attributes = array(
			'src' => 'images/defaultimage.jpg',
			'class' => 'img-responsive'
		);

		//GET IMAGE TYPE
		if ( $image_type == 'normal' || $image_type == 'img' ) {
			$default_attributes = array(
				'src' => 'images/defaultimage.jpg',
				'class' => 'img-responsive'
			);
		}else if ( $image_type == 'user'  ) {
				$default_attributes = array(
					'src' => 'images/user-icon.png',
					'class' => 'img-responsive',
				);
			}else if ( $image_type == 'hidden' ) {
				if ( !$image_exist ) {
					return '';
				}
			}





		if ( $image_exist && $is_array ) {

			$final_attributes = array_replace( $default_attributes, $url );

		}else {
			$url['src'] = $default_attributes['src'];
			$final_attributes = array_replace( $default_attributes, $url );
		}




		return img( $final_attributes );
	}
}

if ( !function_exists( 'image_exist' ) ) {
	function image_exist( $url = array(), $image_type = 'normal', $return_type = 'image' ) {

		$image_exist = false;
		$is_array = false;
		$default_width = 128;
		$default_height = 128;

		if ( !empty( $url ) && !is_array( $url ) ) {

			//echo '!empty';
			if ( @getimagesize( $url ) ) {
				$image_exist = true;
			}
		}else {

			$is_array = true;
			$url_src = $url['src'];

			if ( !empty( $url_src ) ) {
				if ( @getimagesize( $url_src ) ) {
					$image_exist = true;
				}
			}

		}


		$default_attributes = array(
			'src' => base_url( 'images/defaultimage.jpg' ),
			'class' => 'img-responsive'
		);

		//GET IMAGE TYPE
		if ( $image_type == 'normal' || $image_type == 'img' ) {
			$default_attributes = array(
				'src' => base_url( 'images/defaultimage.jpg' ),
				'class' => 'img-responsive'
			);

		}else if ( $image_type == 'user'  ) {
				$default_attributes = array(
					'src' => base_url( 'images/user-icon.png' ),
					'class' => 'img-circle img-profile'
				);
			}else if ( $image_type == 'circle' ) {
				$default_attributes = array(
					'src' => base_url( 'images/user-icon.png' ),
					'class' => 'img-circle img-profile border-grey'
				);
			}else if ( $image_type == 'cover' ) {
				$default_attributes = array(
					'src' => base_url( 'images/default-image.png' ),
					'class' => 'img-circle img-profile'
				);
			}else if ( $image_type == 'hidden' ) {
				if ( !$image_exist ) {
					return '';
				}
			}


		$default_attributes['width'] = $default_width;
		$default_attributes['height'] = $default_height;
		$default_attributes['class'] = $default_attributes['class'].' img-exist';


		if ( $image_exist && $is_array ) {

			$final_attributes = array_replace( $default_attributes, $url );
			$return_url = $url;

		}else if($image_exist && !$is_array) {
			$new_url = array(
				'src' => $url
			);
			$final_attributes = array_replace( $default_attributes, $new_url );
			$return_url = $new_url;

		}else{
			
			$new_url = array(
				'src' => $default_attributes['src']
			);
			$final_attributes = array_replace( $default_attributes, $new_url );
			$return_url = $new_url;
			
		}

		switch($return_type){
			case 'image':

				return img( $final_attributes );
				break;
			case 'url':
				
				return $return_url['src'];
				break;
		}

		
	}
}



if ( !function_exists( 'check_image_exist' ) ) {
	function check_image_exist( $url ) {

		$image_exist = false;

		if ( @getimagesize( $url ) ) {
			$image_exist = true;
		}

		return $image_exist;
	}
}




if ( !function_exists( 'display_link' ) ) {
	function display_link( $url, $text, $link_type = 'normal', $hidden = false, $attributes = array() ) {



		if ( !$hidden ) {
			return '';
		}


		if ( $link_type == 'normal' ) {
			$default_attributes = array(
				'title' => $text
			);
		}elseif ( $link_type == 'button' || $link_type == 'btn' ) {
			$default_attributes = array(
				'title' => $text,
				'class' => 'btn btn-primary',
				'data-toggle' => 'tooltip',
				'data-placement' => 'left',
			);
		}

		if ( is_array( $attributes ) && !empty( $attributes ) ) {
			$final_attributes = array_replace( $default_attributes, $attributes );
		}else {
			$final_attributes = $default_attributes;
		}


		return anchor( $url, $text, $final_attributes );

	}
}

if ( !function_exists( 'truncate' ) ) {
	function truncate( $string, $length, $dots = "..." ) {
		return ( strlen( $string ) > $length ) ? substr( $string, 0, $length - strlen( $dots ) ) . $dots : $string;
	}
}

if ( !function_exists( 'text_exist' ) ) {
	function text_exist( $return_string, $required_string ) {
		if ( empty( $required_string ) ) {
			return '';
		}else {
			return $return_string;
		}
	}
}

if ( !function_exists( 'menu_key_value' ) ) {
	function menu_key_value( $result, $menu_level = "menu", $key_value = true ) {

		$options = '';
		$key_value_result = array();


		switch ( $menu_level ) {
		case 'menu':
			$id = 'menu_id';
			break;

		case 'subcategory':
			$id = 'menu_subcategory_id';
			break;

		case 'deep_subcategory':
			$id = 'menu_deep_subcategory_id';
			break;

		default:
			// code...
			break;
		}


		if ( $key_value ) {
			foreach ( $result as $row ) {
				$key_value_result[$row->{$id}] = array( $row->name, $row->color_class );
			}
		}else {
			foreach ( $result as $row ) {
				$key_value_result[] = $row->name;
			}
		}

		return $key_value_result;

	}
}


if ( !function_exists( 'generate_slug' ) ) {
	function generate_slug( $str ) {
		$clean = preg_replace( "/[^a-zA-Z0-9\/_|+ -]/", '', $str );
		$clean = strtolower( trim( $clean, '-' ) );
		$clean = preg_replace( "/[\/_|+ -]+/", '-', $clean );

		return $clean;
	}
}

if ( !function_exists( 'url_exists' ) ) {
	function url_exists( $file ) {
		$file_headers = @get_headers( $file );
		if ( $file_headers[0] == 'HTTP/1.0 404 Not Found' ) {
			$exists = false;
		}
		else {
			$exists = true;
		}

		return $exists;
	}
}


if ( !function_exists( 'get_filename' ) ) {
	function get_filename( $filename, $implode_symbol = '-' ) {
		$extensions = explode( '.', $filename );
		$extension = array_pop( $extensions );
		$new_filename = implode( $implode_symbol, $extensions );

		return $new_filename;
	}
}

if ( !function_exists( 'get_filename_extension' ) ) {
	function get_filename_extension( $filename ) {
		$extensions = explode( '.', $filename );
		$extension = array_pop( $extensions );
		$extension = strtolower( $extension );

		return $extension;
	}
}


if ( !function_exists( 'calculate_time_between_dates' ) ) {
	function calculate_time_between_dates( $final_date, $first_date ) {

		$final_date = convert_date_to_string( $final_date, false, false, 'm/d/Y' );
		$first_date = convert_date_to_string( $first_date, false, false, 'm/d/Y' );

		$datetime_1 = strtotime( $first_date );
		$datetime_2 = strtotime( $final_date );

		$seconds = $datetime_2 - $datetime_1;
		$minutes = $seconds/60;
		$hours = $minutes/60;
		$days = $hours/24;

		$results = array(
			'seconds' => $seconds,
			'minutes' => $minutes,
			'hours' => $hours,
			'days' => $days
		);

		return $results;

	}
}
