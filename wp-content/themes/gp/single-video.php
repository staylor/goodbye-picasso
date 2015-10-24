<?php
the_post();

get_header();

band_go_back( home_url( '/media/#videos' ), 'Back to all Videos' );
?>
	<div id="post-<?php	the_ID(); ?>" <?php	post_class(); ?>>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<?php full_like_button() ?>
	</div>
<?php
comments_template( '', true );

get_footer();