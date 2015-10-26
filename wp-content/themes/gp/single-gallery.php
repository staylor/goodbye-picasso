<?php
/**
 * The Template used to display all single gallery posts
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 */

the_post();

$temp = $wp_query;

get_header(); ?>
<div class="galleries">
<?php
band_go_back( get_post_type_archive_link( 'gallery' ), 'Back to all Photos' );
?>
<div <?php post_class(); ?>>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<div class="entry-content">
	<?php the_content(); ?>
	<div id="loop-content">
	<?php band_gallery_images( 12 ); ?>
	</div>
</div>
<?php
	$wp_query = $temp;
	rewind_posts();
	full_like_button();
?>
</div>
</div>
<?php
comments_template( '', true );

get_footer();
