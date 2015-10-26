<?php

get_header(); ?>

<h1 class="page-title"><?php
	printf( 'Tag Archives: %s', '<span>' . single_tag_title( '', false ) . '</span>' );
?></h1>

<?php

get_template_part( 'loop', 'tag' );

get_footer();
