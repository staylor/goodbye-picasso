<?php	 		 		 	
/**
 * The Template used to display all Show posts
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 */

get_header(); ?>
<?php	 		 		 	 if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div id="post-<?php	 		 		 	 the_ID(); ?>" <?php	 		 		 	 post_class(); ?>>
	<h1 class="entry-title"><?php	 		 		 	 the_title(); ?></h1>
	<div id="nav-above" class="navigation">
		<div class="nav-previous"><?php	 		 		 	 previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link' ) . '</span> %title' ); ?></div>
		<div class="nav-next"><?php	 		 		 	 next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link' ) . '</span>' ); ?></div>
	</div>
	<?php	 		 		 	 echo get_the_post_thumbnail( get_the_ID(), 'medium', array('class' => 'main_image') ) ?>
	<div class="entry-content">
		<?php	 		 		 	 the_content();
		
			$data = get_post_custom(get_the_ID());
			$ISO = _t(_b($data, 'date'));
			$venue = _b($data, 'venue');
			$address = _b($data, 'address');
			$link = _b($data, 'website');
			$setlist = _b($data, 'setlist');
			$price = _b($data, 'price');
			
			if (strpos($link, 'http') != 0) {
				$link = 'http://' . $link;
			}
		?>
		<p><strong>Date</strong>: <?= date('l, F d, Y', $ISO) ?> @ <?= date('g:i A', $ISO) ?><br/>
		<?php	 		 		 	 if (!empty($venue)): ?><strong>Venue</strong>: <?= $venue ?><br/><?php	 		 		 	 endif ?>
		<?php	 		 		 	 if (!empty($address)): ?><strong>Address</strong>: <?= $address ?><br/><?php	 		 		 	 endif ?>
		<strong>Location</strong>: <?= _b($data, 'city'), ', ', _b($data, 'state') ?><br/>
		<?php	 		 		 	 if (!empty($link)): ?><strong>Website</strong>: <a target="_blank" href="<?= $link ?>"><?= $link ?></a><br/><?php	 		 		 	 endif ?>
		<?php	 		 		 	 if (!empty($price)): ?><strong>Price</strong>: $<?= $price ?><?php	 		 		 	 endif ?></p>
	</div>
	<?php	 		 		 	 if (!empty($setlist)): ?><div class="setlist turn_left">
		<h2>Setlist</h2>
		<p><?= nl2br($setlist) ?></p>
	</div><?php	 		 		 	 endif ?>
</div>			
<?php	 		 		 	 comments_template( '', true ); ?>
<?php	 		 		 	 endwhile; ?>
<?php	 		 		 	 get_footer(); ?>
