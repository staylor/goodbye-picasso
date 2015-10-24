<?php
if ( ! IS_AJAX ):

get_header();

	gp_lyrics( 'This neighborhood was filled with words, now everyone here speaks in numbers So I just reply in notes and measures' ); ?>
	<div id="loop-content">
<?php endif;

	get_template_part( 'loop' );

if ( ! IS_AJAX ): ?>
	</div>
<?php
endif;

get_footer();