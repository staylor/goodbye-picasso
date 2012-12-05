<?php	 		 		 	
/**
 * The template for displaying Tag Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */
 
if (!IS_AJAX): 

get_header(); ?>

<h1 class="page-title"><?php	 		 		 	
	printf( __( 'Tag Archives: %s', 'twentyten' ), '<span>' . single_tag_title( '', false ) . '</span>' );
?></h1>

<?php	 		 		 	
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */ ?>
	<div id="loop-content">
<?php endif;

 
 	get_template_part( 'loop', 'tag' );

if (!IS_AJAX): ?>
	</div>
<?php	 		 		 		
get_footer(); 

endif; ?>
