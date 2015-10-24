<?php
the_post();

get_header();

gp_header( 'Shows' );
gp_lyrics( 'It\'s much harder than it sounds (being no one in this town)' );

if ( isset( $_GET[ 'gpy' ] ) ):
	band_go_back('?upcoming', __('View upcoming shows'));
	echo do_shortcode('[gigpress_shows scope=past sort=desc show_menu=yearly]');
else:
	band_go_back('?gpy=' . date('Y'), __('View past dates'));
 	the_content();
endif;

get_footer();
