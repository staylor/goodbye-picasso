<?php
the_post();

$albums = get_terms( 'album' );
get_header();

gp_lyrics( 'I am watching silhouettes<br/>I am talking with nothing but my ill intent to know<br/>How far you want to go<br/><br/>You are holding cheap champagne<br/>You are toasting every single face and name, and oh...<br/>Here\'s one for the show<br/><br/>You look so beautiful<br/><span> I\'m </span> You\'re losing your control' );

if ( ! empty( $albums ) ): ?>
<div class="posts">
	<?php

	gp_header( 'Discography' , array( 'id' => 'discography' ) );
	?>
	<div class="entry-content">
		<?php foreach ( $albums as $album ): ?>
		<h3>
			<a href="<?php echo get_term_link( $album, 'album') ?>"><?php
				echo $album->name, ' (', $album->count, ' songs)';
			?></a>
		</h3>
		<?php endforeach; ?>
	</div>
</div>
<?php
endif;

$posts = null; band_get_posts_by_type( array( 'post_type' => 'video' ) );

if ( have_posts() ): ?>
<div class="posts">
	<?php gp_header( 'Video', array('id' => 'videos')) ?>
	<div class="entry-content">
		<?php while ( have_posts() ): the_post(); ?>
		<h3>
			<a title="<?php	the_title_attribute() ?>" href="<?php the_permalink() ?>"><?php the_title() ?></a>
		<h3>
		<?php endwhile ?>
	</div>
</div>
<?php endif;

get_footer();
