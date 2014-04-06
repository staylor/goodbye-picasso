<?php
if ( IS_AJAX ) {
	return;
}

global $like_meta ?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php if ( is_singular() && get_option('thread_comments') ) wp_enqueue_script( 'comment-reply' ); ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php
	wp_head();

	if (isset($like_meta) && !empty($like_meta)) echo $like_meta;
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-1544578-3', 'goodbyepicasso.com');
  ga('send', 'pageview');

</script>
</head>
<body <?php	 body_class(); ?>>
<div class="wrapper">
	<div class="banner">
		<span class="tape tilt_left"></span>
		<span class="tape tilt_right"></span>
		<a href="<?= home_url( '' ) ?>"></a>
		<img class="alignnone" src="<?= get_stylesheet_directory_uri() ?>/images/spacer.gif"/>
	</div>
	<div id="fb-root"></div>
	<div id="decoy"></div>
	<div class="stack_item stack_top">
		<ul class="main_nav">
			<li>[<a <?= _on('shows') ?>href="<?= home_url( '/shows/' ) ?>">SHOWS</a>]</li>
			<li>[<a <?= _on('media', array('song', 'album', 'video')) ?>href="<?= home_url( '/media/' ) ?>">MEDIA</a>]</li>
			<li>[<a <?= _on('bio') ?>href="<?= home_url( '/bio/' ) ?>">BIO</a>]</li>
			<li>[<a <?= _on('news', null, 'News') ?>href="<?= home_url( '/news/' ) ?>">NEWS</a>]</li>
			<li>[<a <?= _on('photos', array('gallery')) ?>href="<?= home_url( '/photos/' ) ?>">PHOTOS</a>]</li>
			<li>[<a <?= _on('blog', null, 'Blog') ?>href="<?= home_url( '/blog/' ) ?>">BLOG</a>]</li>
			<li>[<a <?= _on('contact') ?>href="<?= home_url( '/contact/' ) ?>">CONTACT</a>]</li>
		</ul>
		<div class="main" id="content">
