<?php	 		 		 	
/**
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 * 
 * Template Name: Blog
 */
 
get_header();
band_get_posts_by_type(array(
	'category_name' => 'Blog',
	'posts_per_page' => 10
));

gp_header(__('Blog'));
gp_lyrics(__('I read my epitaph, It\'s much worse than I had thought When my time comes to pass, I\'m killed by bullets my men shot'));

get_template_part('loop');

get_footer() ?>
