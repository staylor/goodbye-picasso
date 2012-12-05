<?php	 		 		 	
header('Content-Type: text/css');

function css3rgba($r, $g, $b, $a) {
	echo "background-color: rgb($r, $g, $b); background-color: rgba($r, $g, $b, $a);";
}

function css3($prop, $value) {
	$str = $prop . ': ' . $value;
	$props = array('', '-moz-', '-webkit-', '-o-', '-khtml-');

	foreach ($props as $p) {
		$rules[] = $p . $str;	
	}

	echo (implode('; ', $rules) . ';');
}

require_once('global-css.php');
?>
