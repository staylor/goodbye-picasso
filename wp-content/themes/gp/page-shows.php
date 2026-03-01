<?php
the_post();

get_header();

gp_header( 'Shows' );
gp_lyrics( 'It\'s much harder than it sounds (being no one in this town)' );

$year = get_query_var( 'gpy' );
if ( $year ):
	band_go_back( '/shows/', 'View upcoming shows' );
	echo do_shortcode('[gigpress_shows scope=past sort=desc show_menu=yearly year=' . $year . ']');
else:
	band_go_back( '/shows/2023/', 'View past dates' );
 	the_content();
endif;

get_footer();
