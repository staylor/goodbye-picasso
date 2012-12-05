<?php	 		 		 	
/*
Plugin Name: BandPress
Description: This plugin is terrible, I was an idiot when I wrote it
Author: Scott Taylor
Version: 1.0
Author URI: http://scotty-t.com
*/
define('PLUGIN_PATH', WP_PLUGIN_URL . '/bandpress');


function band_get_post_type() {
	global $post;
	$type = get_post_type( $post );

	if ( empty( $type ) && isset( $_GET['post_type'] ) )
		$type = $_GET['post_type'];

	if ( empty( $type ) && isset( $_GET['post'] ) )
		$type = get_post_type($_GET['post']);
	
	return $type;
}

function _b( $all, $key ) {
	if ( array_key_exists( $key, $all ) && is_array( $all[$key] ) ) {
		return $all[$key][0];
	}
}

function _t( $ISO ) {
	return date_timestamp_get( date_create( $ISO ) );
}

require_once( 'php/actions.php' );
require_once( 'php/query_posts.php' );
require_once( 'php/photos.php' );