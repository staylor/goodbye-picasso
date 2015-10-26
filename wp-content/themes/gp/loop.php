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
			<span class="post-date"><?php the_date( "F j, Y") ?></span>
			<span class="tape medium-tape comments-link">
				<?php comments_popup_link( 'Comments?', '1 Comment', '% Comments' ); ?>
			</span>
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

band_nav_by_type( array( 'where' => 'below' ) );
