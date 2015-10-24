<?php
/**
 * Template Name: Credits
 */

the_post();
get_header();

gp_header( 'Credits' ); ?>
<div class="post">
	<div class="entry-content">
		<?php the_content() ?>
	</div>
</div>
<?php

get_footer();
