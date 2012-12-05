<?php	 		 		 	
/**
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 * 
 * Template Name: Bio 
 */
 
the_post();
get_header(); ?>
<div class="bio-page">	
	<?php gp_header(__('Biography')) ?>
	<?php gp_lyrics(__('I think I should confess, this is me trying my best')) ?>
	<div class="entry-content">
		<?php the_content(); ?>		
	</div>	
</div>
<?php get_footer(); ?>
