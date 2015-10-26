		</div><!-- .main -->
	</div><!-- .stack_top -->
	<div class="footer">
		<p>&copy; <?php	 echo date( 'Y' ) ?> Goodbye Picasso, New York, NY - All Rights Reserved.
		<a href="<?php echo home_url( '/credits/' ) ?>">Credits</a>.
		</p>
		<ul>
			<li><a target="_blank" class="apple" href="https://itunes.apple.com/us/artist/goodbye-picasso/id381329115"></a></li>
			<li><a target="_blank" class="facebook" href="http://www.facebook.com/goodbyepicasso"></a></li>
			<li><a target="_blank" class="twitter" href="http://twitter.com/goodbyepicasso"></a></li>
		</ul>
	</div>
	<div id="social-wrapper">
		<?php gp_lyrics( 'Most who started here have left... It\'s all in the name of progress' ) ?>
		<div id="facebook_widget">
			<?php page_like_button() ?>
		</div>
	</div>
</div><!-- .wrapper -->
<?php wp_footer(); ?>
</body>
</html>
