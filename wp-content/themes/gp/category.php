<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

if ( ! IS_AJAX ):

get_header();
?>
<h1 class="page-title"><?php
	printf(
		'Category Archives: %s',
		'<span>' . single_cat_title( '', false ) . '</span>'
	);
?></h1>
<?php
	$category_description = category_description();
	if ( ! empty( $category_description ) ) {
		echo '<div class="archive-meta">' . $category_description . '</div>';
	}
?>
	<div id="loop-content">
<?php endif;

	get_template_part( 'loop', 'category' );

if ( ! IS_AJAX ): ?>
	</div>
<?php
get_footer();

endif;
