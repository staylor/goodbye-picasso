<?php
/**
 * The Template for displaying all single posts.
 *
 */

the_post();

ob_start(); ?>
<meta property="og:title" content="<?= esc_attr(get_the_title()) ?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php band_get_first_image() ?>" />
<meta property="og:url" content="<?= esc_attr(get_permalink()) ?>" />
<meta property="og:site_name" content="Goodbye Picasso" />
<meta property="fb:admins" content="5212917" />
<meta property="fb:app_id" content="142875799055891" />
<meta property="og:description" content="<?= esc_attr(strip_tags(get_the_excerpt())) ?>" />
<?php
$like_meta = ob_get_contents();
ob_end_clean();

get_header();

?>
	<div id="post-<?php	 the_ID(); ?>" <?php post_class(); ?>>
		<span class="tape tilt_left"><?php	 the_date('M j \'y') ?></span>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<div class="entry-meta">
			<span class="author vcard">by
			<a class="url fn n" href="<?= get_author_posts_url(get_the_author_meta('ID')) ?>"><?php	 		 		 	 the_author()?></a>
			</span><br/>
			<?php the_tags('Tags: <span class="tape medium_tape">', '</span> <span class="tape medium_tape">', '</span>') ?>
		</div>
		<div class="entry-content">
			<?php the_content() ?>
			<?php wp_link_pages(array('before' => '<div class="page-link">' . __('Pages:'), 'after' => '</div>')); ?>
		</div>
		<?php full_like_button() ?>
		<?php	/*gp_author()*/ ?>
	</div>
<?php
comments_template( '', true );
get_footer(); ?>
