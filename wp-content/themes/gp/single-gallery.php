<?php	 		 		 	
/**
 * The Template used to display all single gallery posts
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 */

the_post();

if (!IS_AJAX):
	$temp = $wp_query;
	
	ob_start(); ?>
	<meta property="og:url" content="<?= esc_attr(get_permalink()) ?>" />
	<meta property="og:site_name" content="Goodbye Picasso" />
	<meta property="fb:admins" content="5212917" />
	<meta property="fb:app_id" content="142875799055891" />
	<meta property="og:title" content="<?= esc_attr(get_the_title()) ?>" />
	<meta property="og:image" content="<?= band_get_first_attachment() ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:description" content="<?php esc_attr(strip_tags(get_the_content())) ?>" />
	<?php	 		 		 	
	$like_meta = ob_get_contents();
	ob_end_clean(); 
	 
	get_header(); 
	band_go_back($root . '/photos/', 'Back to all Photos');
	?>	
	<div id="post-<?php	 the_ID(); ?>" <?php post_class(); ?>>		
		<h1 class="entry-title"><?php the_title(); ?></h1>	
		<div class="entry-content">
		<?php the_content(); ?>
		<div id="band-gallery-content"><?php	 		 		 	
endif;	

band_gallery_images(12);

if (!IS_AJAX): ?> 
		</div>
	</div>
	<?php	 		 		 	 
		$wp_query = $temp;
		rewind_posts();
		full_like_button(); 
	?>	
	</div>
	<?php comments_template( '', true );

	get_footer(); 
endif; ?>
