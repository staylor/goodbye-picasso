<?php	 		 		 	
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

if (!IS_AJAX):	

get_header(); ?>
<h1 class="page-title"><?php	 		 		 	
	printf( __( 'Category Archives: %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
?></h1>
<?php	 		 		 	
	$category_description = category_description();
	if ( ! empty( $category_description ) )
		echo '<div class="archive-meta">' . $category_description . '</div>';
?>
	<div id="loop-content">
<?php endif;

/* Run the loop for the category page to output the posts.
 * If you want to overload this in a child theme then include a file
 * called loop-category.php and that will be used instead.
 */
 
	get_template_part( 'loop', 'category' );

if (!IS_AJAX): ?>
	</div>
<?php	 		 		 		
get_footer(); 

endif; ?>
