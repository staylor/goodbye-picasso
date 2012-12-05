<?php	 		 		 	
/**
 * The loop that displays posts
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * @package WordPress
 * @subpackage Twenty Ten
 * @since 3.0.0
 */
 
 // only show the date for each day once
 // store them here to check 
 $dates = array();	 
 
?>
<div class="posts">
<?php	 		 		 	 /* If there are no posts to display, such as an empty archive page */ ?>
<?php	if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php	_e( 'Not Found', 'twentyten' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested Archive. Perhaps searching will help find a related post.', 'twentyten' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php	 		 		 	 /* Start the Loop */ ?>
<?php band_nav_by_type(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php	 the_ID(); ?>" <?php post_class(); ?>>
		<div class="post_narrow">
			<?php	/*if (!in_array(get_the_date(), $dates)):*/ ?>
			<span class="post-date"><?php the_date( 'M <\s\p\a\n>j</\s\p\a\n>') ?></span>	
			<?php	/*$dates[] = get_the_date(); endif*/ ?>
			<?php	the_loop_category() ?>
			<?php	the_tags('<ul><li>', '</li><li>', '</li></ul>') ?>
			<span class="tape medium_tape comments-link">
				<?php	comments_popup_link( __( 'Comments?'), __( '1 Comment'), __( '% Comments')); ?>
			</span>		
			<span class="meta author-link">
				<?php	 		 		 	
					printf(__('Posted by <span class="tape medium_tape author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>'),
						get_author_posts_url( get_the_author_meta( 'ID' ) ),
						sprintf( esc_attr__( 'View all posts by %s'), get_the_author() ),
						get_the_author()
					);
				?>
			</span>
			<?php comments_template( '', true ); ?>	
		</div>
		<div class="post_wide">
			<h2 class="entry-title">
				<a href="<?php	 the_permalink(); ?>" title="<?php	printf( esc_attr__( 'Permalink to %s'), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php	the_title(); ?></a>
			</h2>		
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>')); 
					if (get_post_type() == 'gallery') {
						band_gallery_preview_strip(4);
					}
					wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:'), 'after' => '</div>')); 
				?>
			</div>		
		</div>
	</div>
<?php endwhile; ?>
<?php band_nav_by_type('posts', 'below'); ?>
</div>
