<?php	 		 		 	
/**
 * The main template file
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 */

if (!IS_AJAX):	

	ob_start(); ?>
	<meta property="og:title" content="Goodbye Picasso - Official Website" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="http://goodbyepicasso.com/wp-content/uploads/2010/06/good.jpg" />
	<meta property="og:url" content="http://goodbyepicasso.com" />
	<meta property="og:site_name" content="Goodbye Picasso" />
	<meta property="fb:admins" content="5212917" />
	<meta property="fb:app_id" content="142875799055891" />
	<meta property="og:description" content="Songwriter Chris Dreyer and guitarist Scott Taylor formed Goodbye Picasso in New York City in 2007 after making a move from Nashville and instantly made a splash in the city's vibrant music scene. They are regulars at songwriters-haven Rockwood Music Hall and won the Audience Award at the 2008 A.N.T. Festival at Ars Nova for Chris Dreyer's magnum opus, The Book of Aylene. The band has performed each year at the CMJ Music Marathon and in 2010 are releasing The Book of Aylene as a full-length recording." />
	<?php	 		 		 	
	$like_meta = ob_get_contents();
	ob_end_clean();

	get_header();

	gp_lyrics(__('This neighborhood was filled with words, now everyone here speaks in numbers So I just reply in notes and measures')); ?>
	<div id="loop-content">
<?php	 		 		 	 endif;

	band_get_posts_by_type(array(
		'post_type' => array('post', 'video', 'gallery'),
		'posts_per_page' => 5
	));

	get_template_part('loop'); 

if (!IS_AJAX): ?>
	</div>
<?php	 		 		 		
get_footer(); 

endif; ?>
