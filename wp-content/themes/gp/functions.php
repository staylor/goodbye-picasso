<?php
/**
 * GoodbyePicasso functions and definitions
 *
 * @package WordPress
 * @subpackage Goodbye Picasso
 * @since 3.0.0
 */

/**
 *
 * $root and $theme can be inherited throughout
 * $theme references the child theme, this one
 *
 */
define('IS_AJAX', isset($_GET['ajax']) && $_GET['ajax']);
define('FACEBOOK_APP_ID', '142875799055891');
define('FACEBOOK_SECRET', 'd313c2950363ec70949d14cbdf55c8f5');

$root = get_bloginfo('url');
$theme = get_bloginfo('stylesheet_directory');

add_action( 'init', 'gp_setup' );

function gp_setup() {
	global $theme;

	add_theme_support('post-thumbnails');
	add_theme_support('automatic-feed-links');

	if (!is_admin()) {
		wp_enqueue_style('gp-main', $theme . '/style.css');
		wp_enqueue_style('gp-global', $theme . '/css/global.css');

		wp_enqueue_script('gp-font', $theme . '/js/font.js', array('jquery'));
		wp_enqueue_script('1', 'http://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js', array('jquery', 'gp-font'));
		wp_enqueue_script('2', $theme . '/js/XHR.js', array('jquery'));
		wp_enqueue_script('3', $theme . '/js/loop.js', array('jquery'));
		wp_enqueue_script('4', $theme . '/js/banner.js', array('jquery'));
		wp_enqueue_script('5', $theme . '/js/facebook.js', array('jquery'));
		wp_enqueue_script('6', $theme . '/js/lyrics.js', array('jquery'));
	}
}

function myfeed_request($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type'])) {
		$qv['post_type'] = get_post_types($args = array(
	  		'public'   => true,
	  		'_builtin' => false
		));

		$qv['post_type'][] = 'post';
	}

	return $qv;
}
//add_filter('request', 'myfeed_request');

/**
 *
 * Text Element functions
 * helps make style modular
 *
 */

function gp_header($title, $attrs = '') {
	if (is_array($attrs)) {
		foreach ($attrs as $prop=>$value) {
			$a[] = $prop . '="' . $value . '"';
		}
		$attrs = ' ' . implode(' ', $a);
	}

	echo '<h1 class="page-title"', $attrs, '>', $title, '</h1>';
}

function gp_lyrics($lyrics, $attrs = '') {
	if (is_array($attrs)) {
		foreach ($attrs as $prop=>$value) {
			$a[] = $prop . '="' . $value . '"';
		}
		$attrs = ' ' . implode(' ', $a);
	}

	echo '<span class="lyrics"', $attrs, '>', $lyrics, '</span>';
}

/**
 *
 * this function helps the loop determine
 * what kind of post this is
 *
 */

function the_loop_category() {
	$before = '<ul class="post-categories"><li>';
	$after = '</li></ul>';

	switch (get_post_type()) {
	case 'video':
		echo $before, '<a href="/media/#videos">Video</a>', $after;
		break;
	case 'song':
		echo $before, '<a href="/music/">Song</a>', $after;
		break;
	case 'gallery':
		echo $before, '<a href="/photos/">Photos</a>', $after;
		break;
	default:
		the_category();
		break;
	}
}


/**
 *
 * this function helps the nav determine
 * when an item is active
 *
 */

function _on($term = '', $terms = array(), $cat = '') {
	global $post, $wp_query;

	if (is_page($term)) {
		return 'class="on" ';
	} else if (count($terms) && (in_array(get_post_type($post->ID), $terms) ||
		in_array(get_query_var('taxonomy'), $terms))
	) {
		return 'class="on" ';
	} else if (is_single() && !empty($cat) &&
		is_array($cats = get_the_category()) && count($cats)
	) {
		if ($cat == $cats[0]->name) {
			return 'class="on" ';
		}
	}
}

/**
 *
 * custom comment callback for this theme
 *
 */

function gp_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<?php if ('' == $comment->comment_type): ?>
	<li <?php	comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php	 		 		 	 comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php	echo get_avatar($comment, 40); ?>
				<?php	printf( __('%s <span class="says">says:</span>'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?>
			</div>
			<?php	if ($comment->comment_approved == '0'): ?>
				<em><?php	 		 		 	 _e('Your comment is awaiting moderation.'); ?></em><br /><?php	 		 		 	 endif ?>
			<div class="comment-meta commentmetadata"><a href="<?= esc_url(get_comment_link($comment->comment_ID)) ?>">
				<?php	 /* translators: 1: date, 2: time */
				printf( __('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?></a>
				<?php	edit_comment_link( __('(Edit)'), ' ') ?>
			</div>
			<div class="comment-body"><?php	 		 		 	 comment_text() ?></div>
			<div class="tape medium_tape reply">
				<?php	comment_reply_link(array_merge($args,
					array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
			</div>
		</div>
	<?php	else : ?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:') ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)'), ' ') ?></p>
	<?php  endif;?>
	</li><?php
}

/**
 *
 * pulled out author data, easier to debug design
 *
 */

function gp_author() {
// If a user has filled out their description, show a bio on their entries
	if (get_the_author_meta('description')): ?>
		<div id="entry-author-info">
			<div id="author-avatar">
				<?php	 echo get_avatar(get_the_author_meta('user_email'), 60) ?>
			</div>
			<div id="author-description">
				<h2><?php	 printf(esc_attr__('About %s'), get_the_author()) ?></h2>
				<?php	 the_author_meta('description'); ?>
				<div id="author-link">
					<a href="<?php	echo get_author_posts_url(get_the_author_meta('ID')); ?>">
						<?php
						printf( __('View all posts by %s <span class="meta-nav">&rarr;</span>'), get_the_author()) ?>
					</a>
				</div>
			</div>
		</div><?php
	endif;
}

/**
 *
 * generic Like button function for posts in a loop
 * requires meta tags in the template the permalink
 * refers to
 *
 */

function get_facebook_cookie() {
	$args = array();
	parse_str(trim($_COOKIE['fbs_' . FACEBOOK_APP_ID], '\\"'), $args);
	ksort($args);

	$payload = '';

	foreach ($args as $key => $value) {
		if ($key != 'sig') {
			$payload .= $key . '=' . $value;
		}
	}

	if (md5($payload . FACEBOOK_SECRET) != $args['sig']) {
	    return null;
	}
	return $args;
}

function page_like_button($height = 80, $width = 780) {
	echo '<fb:like href="http://www.facebook.com/goodbyepicasso" action="like" layout="standard" colorscheme="light" show_faces="true" height="', $height, '" width="', $width, '"></fb:like>';
}

function the_like_button() {
	echo '<iframe src="http://www.facebook.com/plugins/like.php?href=', urlencode(get_permalink()), '&amp;layout=button_count&amp;show_faces=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden;width:85px;height:21px" allowTransparency="true"></iframe>';
}

function full_like_button() {
	?><fb:like></fb:like><?php
}

/**
 * Twitter Tweet button
 *
 */
function the_tweet_button() {
	echo '<a href="http://twitter.com/share?url=', urlencode(get_permalink()), '&amp;text=', str_replace('"', '\"', get_the_title()),'" class="twitter-share-button" data-count="none" data-via="goodbyepicasso">Tweet</a>';
}

/**
 *
 * AKISMET PLUGIN MUST BE ACTIVATED!!
 * function to call Akismet to filter mail for SPAM
 *
 * $content['comment_author'] = $name;
 * $content['comment_author_email'] = $email;
 * $content['comment_author_url'] = $website;
 * $content['comment_content'] = $message;
 *
 */
function gp_checkSpam($content) {
	// innocent until proven guilty
	$isSpam = FALSE;

	$content = (array) $content;

	if (function_exists('akismet_init')) {

		$wpcom_api_key = get_option('wordpress_api_key');

		if (!empty($wpcom_api_key)) {

			global $akismet_api_host, $akismet_api_port;

			// set remaining required values for akismet api
			$content['user_ip'] = preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] );
			$content['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
			$content['referrer'] = $_SERVER['HTTP_REFERER'];
			$content['blog'] = get_option('home');

			if (empty($content['referrer'])) {
				$content['referrer'] = get_permalink();
			}

			$queryString = '';

			foreach ($content as $key => $data) {
				if (!empty($data)) {
					$queryString .= $key . '=' . urlencode(stripslashes($data)) . '&';
				}
			}

			$response = akismet_http_post($queryString, $akismet_api_host, '/1.1/comment-check', $akismet_api_port);

			if ($response[1] == 'true') {
				update_option('akismet_spam_count', get_option('akismet_spam_count') + 1);
				$isSpam = TRUE;
			}
		}
	}
	return $isSpam;
}
