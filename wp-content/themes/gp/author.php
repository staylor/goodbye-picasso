<?php
the_post();

get_header(); ?>

<h1 class="page-title author"><?php
	printf(
		'Author Archives: %s',
		"<span class='vcard'><a class='url fn n' href='" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "' title='" . esc_attr( get_the_author() ) . "' rel='me'>" . get_the_author() . "</a></span>"
	);
?></h1>

<?php if ( get_the_author_meta( 'description' ) ) : ?>
	<div id="entry-author-info">
		<div id="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?>
		</div><!-- #author-avatar -->
		<div id="author-description">
			<h2><?php printf( 'About %s', get_the_author() ); ?></h2>
			<?php the_author_meta( 'description' ); ?>
		</div><!-- #author-description	-->
	</div><!-- #entry-author-info -->
<?php
	rewind_posts();
endif;
?>
	<div id="loop-content">
	<?php get_template_part( 'loop', 'author' );  ?>
	</div>
<?php
get_footer();
