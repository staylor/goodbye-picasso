<?php
the_post();

get_header();
?>
	<div id="post-<?php	the_ID(); ?>" <?php post_class(); ?>>
		<span class="tape"><?php the_date('M j \'y') ?></span>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta"></div>
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
