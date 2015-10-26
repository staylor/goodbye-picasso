<?php
the_post();
get_header();

//gp_lyrics( 'My time machine is broke, so let\'s pretend That we\'re both clean, and this is how we met' );

?>
<div class="post">
	<h2 class="entry-title">Booking / Management</h2>
	<div class="entry-content">
		<p>Wonderboy Media<br />
		Phone: +1 (646) 715-7347<br /><br />
		Email: <a href="mailto:goodbyepicassonyc@gmail.com">goodbyepicassonyc[at]gmail.com</a></p>
	</div>
</div>
<div class="post">
	<h2 class="entry-title">Send Us a Message</h2>
	<div class="entry-content">
		<?php the_content(); ?>
	</div>
</div>
<?php

get_footer();
