<?php	 		 		 	
/**
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 * 
 * Template Name: News
 */
 
get_header();
band_get_posts_by_type(array(
	'category_name' => 'News',
	'posts_per_page' => 10
));

gp_header(__('News'));
gp_lyrics(__('Did you get that magazine? There\'s an article on me'));

get_template_part('loop');

get_footer(); ?>
