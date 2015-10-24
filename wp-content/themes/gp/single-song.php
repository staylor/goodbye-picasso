<?php
the_post();

get_header();

?><div class="navigation">
	<div class="nav-previous">
		<span class="meta-nav">
			&larr; Back to "<?php echo get_the_term_list( get_the_ID(), 'album', '', ', ', '' ); ?>"
		</span>
	</div>
</div>
<div id="post-<?php the_ID(); ?>" <?php	post_class(); ?>>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	<?php full_like_button() ?>
</div>
<?php

comments_template( '', true );

get_footer();
