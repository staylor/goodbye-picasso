<?php
the_post();

get_header();
?>
	<div id="post-<?php	the_ID(); ?>" <?php post_class(); ?>>
		<span class="tape tilt-left"><?php the_date('M j \'y') ?></span>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">
			<span class="author vcard">by
			<a class="url fn n" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><?php the_author(); ?></a>
			</span><br/>
			<?php the_tags('Tags: <span class="tape medium-tape">', '</span> <span class="tape medium-tape">', '</span>') ?>
		</div>
		<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-link">' . 'Pages:' ,
				'after' => '</div>'
			) );
		?>
		</div>
		<?php full_like_button() ?>
	</div>
<?php
comments_template( '', true );

get_footer();
