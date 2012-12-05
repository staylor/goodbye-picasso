<?php	 		 		 	
/**
 * Return an html options list full of states
 *
 * @param $selected_state string[optional]      abbreviation of state to select
 * @param $b_add_space bool[optional]           first option is blank
 * @return string
 */
function state_picker( $selected_state = '', $b_add_space = false ) {
	$states = array(
		'AL' => 'ALABAMA',
		'AK' => 'ALASKA',
		'AZ' => 'ARIZONA',
		'AR' => 'ARKANSAS',
		'CA' => 'CALIFORNIA',
		'CO' => 'COLORADO',
		'CT' => 'CONNECTICUT',
		'DE' => 'DELAWARE',
		'DC' => 'DISTRICT OF COLUMBIA',
		'FL' => 'FLORIDA',
		'GA' => 'GEORGIA',
		'HI' => 'HAWAII',
		'ID' => 'IDAHO',
		'IL' => 'ILLINOIS',
		'IN' => 'INDIANA',
		'IA' => 'IOWA',
		'KS' => 'KANSAS',
		'KY' => 'KENTUCKY',
		'LA' => 'LOUISIANA',
		'ME' => 'MAINE',
		'MD' => 'MARYLAND',
		'MA' => 'MASSACHUSETTS',
		'MI' => 'MICHIGAN',
		'MN' => 'MINNESOTA',
		'MS' => 'MISSISSIPPI',
		'MO' => 'MISSOURI',
		'MT' => 'MONTANA',
		'NE' => 'NEBRASKA',
		'NV' => 'NEVADA',
		'NH' => 'NEW HAMPSHIRE',
		'NJ' => 'NEW JERSEY',
		'NM' => 'NEW MEXICO',
		'NY' => 'NEW YORK',
		'NC' => 'NORTH CAROLINA',
		'ND' => 'NORTH DAKOTA',
		'OH' => 'OHIO',
		'OK' => 'OKLAHOMA',
		'OR' => 'OREGON',
		'PA' => 'PENNSYLVANIA',
		'PR' => 'PUERTO RICO',
		'RI' => 'RHODE ISLAND',
		'SC' => 'SOUTH CAROLINA',
		'SD' => 'SOUTH DAKOTA',
		'TN' => 'TENNESSEE',
		'TX' => 'TEXAS',
		'UT' => 'UTAH',
		'VT' => 'VERMONT',
		'VI' => 'VIRGIN ISLANDS',
		'VA' => 'VIRGINIA',
		'WA' => 'WASHINGTON',
		'WV' => 'WEST VIRGINIA',
		'WI' => 'WISCONSIN',
		'WY' => 'WYOMING'
	);
	
	$s_options_list = "";
	
	//add blank state?
	if ($b_add_space) {
		$s_options_list .= "<option value=''></option>";
	}
	
	foreach ( $states as $st => $name ) {
		if( strtolower($st) == strtolower( $selected_state ) ) {
		    $s_options_list .= '<option value="'.$st.'" selected="selected">'. $name .'</option>';
		} else {
		    $s_options_list .= '<option value="'.$st.'">'. $name .'</option>';
		}
	}
	
	return $s_options_list;   
}
?>
