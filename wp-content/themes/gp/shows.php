<?php	 		 		 	
/**
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 * 
 * Template Name: Shows
 */
 
the_post();
get_header(); 

gp_header(__('Shows'));
gp_lyrics(__('It\'s much harder than it sounds (being no one in this town)'));

if (isset($_GET['gpy'])): 
	band_go_back('?upcoming', __('View upcoming shows'));	
	echo do_shortcode('[gigpress_shows scope=past sort=desc show_menu=yearly]'); 
else: 
	band_go_back('?gpy=' . date('Y'), __('View past dates'));
 	the_content();
endif; 
	
get_footer();
