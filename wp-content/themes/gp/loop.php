<?php
 // only show the date for each day once
 // store them here to check
 $dates = array();

?>
<div class="posts">
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title">Not Found</h1>
		<div class="entry-content">
			<p>Apologies, but no results were found for the requested Archive. Perhaps searching will help find a related post.</p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
band_nav_by_type();

while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="post-narrow">
			<span class="post-date"><?php the_date( "M j, 'y") ?></span>
			<div class="post-categories"><?php the_loop_category(); ?></div>
			<?php the_tags( '<ul><li>', '</li><li>', '</li></ul>'); ?>
			<span class="tape medium-tape comments-link">
				<?php comments_popup_link( 'Comments?', '1 Comment', '% Comments' ); ?>
			</span>
			<span class="meta author-link">
				<?php
					printf( 'Posted by <span class="tape medium-tape author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
						get_author_posts_url( get_the_author_meta( 'ID' ) ),
						sprintf( 'View all posts by %s', get_the_author() ),
						get_the_author()
					);
				?>
			</span>
			<?php comments_template( '', true ); ?>
		</div>
		<div class="post-wide">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( 'Permalink to %s', the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php	the_title(); ?></a>
			</h2>
			<div class="entry-content">
				<?php
					the_content( 'Continue reading <span class="meta-nav">&rarr;</span>' );
					if ( get_post_type() == 'gallery' ) {
						band_gallery_preview_strip( 4 );
					}

					wp_link_pages( array(
						'before' => '<div class="page-link">' . 'Pages:',
						'after' => '</div>'
					) );
				?>
			</div>
		</div>
	</div>
<?php endwhile;

band_nav_by_type( array( 'where' => 'below' ) ); ?>
</div>