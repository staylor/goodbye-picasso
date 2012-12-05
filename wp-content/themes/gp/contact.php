<?php	 		 		 	
/**
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 * 
 * Template Name: Contact 
 */
 
the_post(); 
get_header(); 

gp_header(__('Contact')); 
gp_lyrics(__('My time machine is broke, so let\'s pretend That we\'re both clean, and this is how we met'));

?>
<div class="post">
	<h2 class="entry-title">Booking / Management</h2>
	<div class="entry-content">
		<p>Wonderboy Media<br />
		Phone: +1 (646) 715-7347<br /><br />
		Email: <a href="mailto:booking@goodbyepicasso.com">booking[at]goodbyepicasso.com</a></p>
	</div>	
</div>	
<div class="post">
	<h2 class="entry-title">Send Us a Message</h2>	
	<div class="entry-content">
		<?php	 		 		 	 
			the_content(); 
		?>
	</div>
</div>
<?php get_footer() ?>
