<?php	 		 		 	
/**
 * The Template for displaying all single posts.
 *
 */

the_post(); 

$part = explode('<param name="movie" value="', get_the_content());
$href = explode('"', $part[1]);
$url = $href[0];


$desc = get_the_excerpt() ? $url . get_the_excerpt() : $url;

ob_start(); ?>
<meta property="og:url" content="<?= esc_attr(get_permalink()) ?>" />
<meta property="og:site_name" content="Goodbye Picasso" />
<meta property="fb:admins" content="5212917" />
<meta property="fb:app_id" content="142875799055891" />
<meta property="og:title" content="<?= esc_attr(get_the_title()) ?>" />
<meta property="og:type" content="article" />
<meta property="og:description" content="<?= esc_attr($desc) ?>" />
<?php	 		 		 	
$like_meta = ob_get_contents();
ob_end_clean();

get_header(); 

band_go_back($root . '/media/#videos', 'Back to all Videos');
?>
	<div id="post-<?php	the_ID(); ?>" <?php	  post_class(); ?>>
		<h1 class="entry-title"><?php	the_title(); ?></h1>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<?php full_like_button() ?>
	</div>
	<?php comments_template( '', true ); ?>
<?php get_footer();