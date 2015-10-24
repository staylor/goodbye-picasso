<?php
the_post();

get_header();
?>
<div class="bio-page">
	<?php
		gp_header( 'Biography' );
		gp_lyrics( 'I think I should confess, this is me trying my best' );
	?>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</div>
<?php

get_footer();