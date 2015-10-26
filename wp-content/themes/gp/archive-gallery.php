<?php

get_header();
?>
<div class="galleries">
<?php
gp_header( 'Photos' );

gp_lyrics( 'I\'ve been drinking me straight whiskey, three bottles of Ten High With a barely legal peddler of pills that make me right' );
?>
	<div id="loop-content">
	<?php if ( have_posts() ): ?>
		<div class="posts">
		<?php
		band_nav_by_type( array( 'type' => 'photos' ) );

		while ( have_posts() ): the_post(); ?>
			<h2 class="entry-title">
				<a href="<?php the_permalink() ?>"><?php the_title() ?></a>
			</h2>
			<div class="entry-content">
			<?php
				the_content();
				band_gallery_preview_strip();
			?>
			</div>
		<?php endwhile;

		band_nav_by_type( array( 'type' => 'photos', 'where' => 'below' ) ); ?>
		</div>
	<?php endif; ?>
	</div>
</div>
<?php
get_footer();
