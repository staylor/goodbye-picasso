<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width">
	<link href='https://fonts.googleapis.com/css?family=Reenie+Beanie' rel='stylesheet' type='text/css'>
<?php
if ( is_singular() && get_option('thread_comments') ) {
	wp_enqueue_script( 'comment-reply' );
}

wp_head();
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
<body <?php	body_class(); ?>>
<div class="wrapper">
	<div class="banner">
		<span class="tape tilt-left"></span>
		<span class="tape tilt-right"></span>
		<a href="<?php echo home_url() ?>"></a>
		<img src="<?php echo get_stylesheet_directory_uri() ?>/images/spacer.gif"/>
	</div>
	<div id="fb-root"></div>
	<div class="stack-item stack-top">
		<ul class="main-nav">
			<li><a <?php echo _on( is_page( 'shows' ) ) ?>href="<?php echo home_url( '/shows/' ) ?>">SHOWS</a></li>
			<li><a <?php echo _on( is_page( 'media' ) || in_array( get_post_type(), array('song', 'album', 'video') ) ) ?>href="<?php echo home_url( '/media/' ) ?>">MEDIA</a></li>
			<li><a <?php echo _on( is_page( 'bio' ) ) ?>href="<?php echo home_url( '/bio/' ) ?>">BIO</a></li>
			<li><a <?php echo _on( is_home() ) ?>href="<?php echo home_url( '/' ) ?>">NEWS</a></li>
			<li><a <?php echo _on( is_post_type_archive( 'gallery' ) ) ?>href="<?php echo home_url( '/gallery/' ) ?>">PHOTOS</a></li>
			<li><a <?php echo _on( is_page( 'contact' ) ) ?>href="<?php echo home_url( '/contact/' ) ?>">CONTACT</a></li>
		</ul>
		<div class="main" id="content">
