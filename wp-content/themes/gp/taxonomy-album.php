<?php
/**
 * The Template used to display an Album
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 */

get_header();
band_go_back( home_url( '/media/' ), 'Back to Media');

$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));

gp_header($term->name);
?>
<div class="posts">
	<ul>
	<?php band_query_taxonomy_all(); ?>
	<?php if (have_posts()): while (have_posts()): the_post(); ?>
		<li><a href="<?php	 		 		 	 the_permalink() ?>" title="<?php	 		 		 	 the_title_attribute() ?>"><?=
			$post->menu_order, '. ', the_title() ?></a></li>
	<?php endwhile; endif ?>
	</ul>
	<?= apply_filters('the_content', $term->description); ?>
</div>
<?php get_footer(); ?>
