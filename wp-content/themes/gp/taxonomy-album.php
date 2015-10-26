<?php
get_header();

band_go_back( home_url( '/media/' ), 'Back to Media' );

$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

gp_header( $term->name );
?>

<ul>
<?php while ( have_posts() ): the_post(); ?>
<li>
	<a href="<?php the_permalink() ?>"><?php
		echo $post->menu_order, '. ', the_title();
	?></a>
</li>
<?php endwhile; ?>
</ul>
<?php

echo apply_filters( 'the_content', $term->description );

get_footer();
