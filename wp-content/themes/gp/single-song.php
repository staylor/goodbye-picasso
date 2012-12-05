<?php	 		 		 	
/**
 * The Template used to display all single posts
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 */
the_post(); 

ob_start(); ?>
<meta property="og:url" content="<?= esc_attr(get_permalink()) ?>" />
<meta property="og:site_name" content="Goodbye Picasso" />
<meta property="fb:admins" content="5212917" />
<meta property="fb:app_id" content="142875799055891" />
<meta property="og:image" content="<?= $root . '/wp-content/uploads/2010/07/dreyer-piano-300x200.jpg' ?>" />
<meta property="og:title" content="<?= esc_attr(get_the_title()) ?>" />
<meta property="og:type" content="song" />
<meta property="og:description" content="<?= esc_attr(strip_tags(get_the_excerpt())) ?>" />
<?php	 		 		 	
$like_meta = ob_get_contents();
ob_end_clean();

get_header(); 
	
?><div class="navigation">
	<div class="nav-previous">
		<span class="meta-nav">
			&larr; Back to "<?= get_the_term_list(get_the_ID(), 'album', '', ', ', ''); ?>"
		</span>	
	</div>
</div>
<div id="post-<?php the_ID(); ?>" <?php	 post_class(); ?>>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<div class="entry-content">
		<?php	the_content(); ?>
	</div>
	<?php full_like_button() ?>
</div>
<?php comments_template( '', true ); ?>
<?php get_footer(); ?>
