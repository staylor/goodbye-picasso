<?php	 		 		 	
/**
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 * 
 * Template Name: Photos
 */
 
the_post();

if (!IS_AJAX):

get_header(); ?>
<div class="band_galleries">
	<?php	 		 		 	 
	
	gp_header(__('Photos')); 
	gp_lyrics(__('I\'ve been drinking me straight whiskey, three bottles of Ten High With a barely legal peddler of pills that make me right')); ?>
	<div id="loop-content">
<?php	 		 		 	 endif; 
	
	band_get_posts_by_type(array(
		'post_type' => 'gallery',
		'posts_per_page' => 3
	)); 
	
	if (have_posts()): ?>
		<div class="posts">
		<?php	 		 		 	
		band_nav_by_type('photos'); 		
		while (have_posts()): the_post(); ?>
			<h2 class="entry-title"><a href="<?php	 the_permalink() ?>"><?php the_title() ?></a></h2>
			<div class="entry-content">
			<?php the_content(); 
				band_gallery_preview_strip();
			?></div><?php	 		 		 	 
		endwhile; 
		band_nav_by_type('photos', 'below'); ?>
		</div>
	<?php endif ?>
	
<?php if (!IS_AJAX): ?>	
	</div>
</div>	
<?php	 		 		 	 
get_footer(); 

endif;
?>
