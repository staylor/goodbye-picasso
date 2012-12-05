<?php global $root, $theme, $like_meta, $post ?>
<!DOCTYPE html>
<html <?php	 language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php	 		 		 	
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php	 		 		 	 if ( is_singular() && get_option('thread_comments') ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php	 		 		 	 bloginfo( 'pingback_url' ); ?>" />
<?php	 		 		 		
	wp_head();

	if (isset($like_meta) && !empty($like_meta)) echo $like_meta;
?>
<script type="text/javascript">
  var _gaq = _gaq || []; _gaq.push(['_setAccount', 'UA-1544578-3']); _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!--[if lt IE 7 ]><link rel="stylesheet" href="<?= $theme ?>/css/ie6.css"/><![endif]--> 
</head>
<body <?php	 body_class(); ?>>
<div class="wrapper">
	<div class="banner">
		<span class="tape tilt_left"></span>
		<span class="tape tilt_right"></span>
		<a href="<?= $root ?>"></a>
		<img class="alignnone" src="<?= $theme ?>/images/spacer.gif"/>
	</div>
	<div id="fb-root"></div>
	<div id="decoy"></div>	
	<div class="stack_item stack_top">
		<ul class="main_nav">
			<li>[<a <?= _on('shows') ?>href="<?= $root ?>/shows/">SHOWS</a>]</li>
			<li>[<a <?= _on('media', array('song', 'album', 'video')) ?>href="<?= $root ?>/media/">MEDIA</a>]</li>
			<li>[<a <?= _on('bio') ?>href="<?= $root ?>/bio/">BIO</a>]</li>
			<li>[<a <?= _on('news', null, 'News') ?>href="<?= $root ?>/news/">NEWS</a>]</li>
			<li>[<a <?= _on('photos', array('gallery')) ?>href="<?= $root ?>/photos/">PHOTOS</a>]</li>
			<li>[<a <?= _on('blog', null, 'Blog') ?>href="<?= $root ?>/blog/">BLOG</a>]</li>
			<li>[<a <?= _on('contact') ?>href="<?= $root ?>/contact/">CONTACT</a>]</li>
		</ul>
		<div class="main" id="content">
