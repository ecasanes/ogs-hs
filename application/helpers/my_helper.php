<?php if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );



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



if ( !function_exists( 'year_dropdown' ) ) {
	function year_dropdown($default_value = null) {

		if($default_value == null){
			$current_year = date('Y');
		}else{
			$current_year = $default_value;
		}
		

		$year_lowest_limit = date('Y', strtotime(date("Y", strtotime( date('Y'))) . " - 10 year"));
		$year_highest_limit = date('Y', strtotime(date("Y", strtotime( date('Y'))) . " + 10 year"));

		$output = "";
		for($i=$year_lowest_limit;$i<$year_highest_limit;$i++){
			if($i != $current_year){
				$output .= '<option value="'.$i.'">'.$i.'</option>';
			}else{
				$output .= '<option value="'.$i.'" selected="selected">'.$i.'</option>';
			}
			
		}

		return $output;

	}
}


if ( !function_exists( 'display_loading' ) ) {
	function display_loading() {

		$output = "";

		$output .= '<span class="loading">';
		$output .= '<i class="fa fa-loading fa-spin></i> Loading...';
		$output .= '</span>';



		return $output;

	}
}


if ( !function_exists( 'display_success_error_message' ) ) {
	function display_success_error_message($error, $success) {

		$output = "";

		if(isset($error)):
        	$output .= '<span class="error-message"><?php echo $error; ?></span>';
        endif;

        if(isset($success)):
        	$output .= '<span class="success-message"><?php echo $success; ?></span>';
        endif; 

		return $output;

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



