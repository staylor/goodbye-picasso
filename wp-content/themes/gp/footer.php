<?php

/**
 * The template used to display the footer
 *
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 */
?>
		</div><!-- .main -->
	</div><!-- .stack_top -->
	<div class="footer">
		<p>&copy; <?php	 echo date( 'Y' ) ?> Goodbye Picasso, New York, NY - All Rights Reserved.
		<a href="<?= home_url( '/credits/' ) ?>">Credits</a>.
		</p>
		<ul>
			<li><a target="_blank" class="apple" href="http://itunes.apple.com/us/album/the-book-of-aylene/id381329114"></a></li>
			<li><a target="_blank" class="facebook" href="http://www.facebook.com/goodbyepicasso"></a></li>
			<li><a target="_blank" class="myspace" href="http://www.myspace.com/goodbyepicasso"></a></li>
			<li><a target="_blank" class="twitter" href="http://twitter.com/goodbyepicasso"></a></li>
			<li><a target="_blank" class="reverb" href="http://www.reverbnation.com/goodbyepicasso"></a></li>
		</ul>
	</div>
	<div id="social_wrapper" class="email_form">
		<span class="tape medium_tape tilt_left"></span>
		<span class="tape medium_tape tilt_right"></span>
		<span class="tape medium_tape tilt_bottom_left"></span>
		<?php gp_lyrics(__('Most who started here have left... It\'s all in the name of progress')) ?>
		<div id="facebook_widget">
			<?php page_like_button() ?>
		</div>
	</div>
</div><!-- .wrapper -->
<?php wp_footer(); ?>
</body>
</html>
