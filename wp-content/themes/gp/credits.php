<?php	 		 		 	
/**
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 * 
 * Template Name: Credits
 */
 
the_post(); 
get_header(); 

gp_header(__('Credits')); ?>
<div class="post">
	<div class="entry-content">
		<?php	the_content() ?>
	</div>
</div>
<?php	get_footer() ?>
