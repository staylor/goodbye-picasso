<?php	 		 		 	 
function time_picker( $hour = '08', $minutes = '00', $time_of_day = 'PM' ) {
 	$select = '<select name="%s">%s</select>';
 	$option = '<option%svalue="%s">%s</option>';
 	$on = ' selected="selected" ';
 	$off = ' ';
 	$times = array('AM', 'PM');
 	$h = '';
 	$m = '';
 	$t = '';
 	
 	for ($i = 1; $i < 13; $i++) {
 		$f = $i < 10 ? '0' . $i : $i;
 		$h .= sprintf($option, $f == $hour ? $on : $off, $f, $f);
 	}

	for ($j = 0; $j < 60; $j += 5) {
		$f = $j < 10 ? '0' . $j : $j;
		$m .= sprintf($option, $f == $minutes ? $on : $off, $f, $f);
	}
	
	foreach ($times as $timeof) {
		$t .= sprintf($option, $timeof == $time_of_day ? $on : $off, $timeof, $timeof);
	}
	
	return sprintf($select, 'hour', $h) . sprintf($select, 'minutes', $m) . sprintf($select, 'timeof', $t);
}
?>
