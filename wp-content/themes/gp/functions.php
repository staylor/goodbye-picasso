<?php
/**
 *
 * $root and $theme can be inherited throughout
 * $theme references the child theme, this one
 *
 */
define( 'FACEBOOK_APP_ID', '142875799055891');
define( 'FACEBOOK_SECRET', 'd313c2950363ec70949d14cbdf55c8f5' );

class GoodbyePicassoTheme {
	private static $instance;

	public static function get_instance() {
		if ( ! static::$instance instanceof GoodbyePicassoTheme ) {
			static::$instance = new static;
		}

		return static::$instance;
	}
	private function __construct() {
		add_action( 'init', [ $this, 'init' ] );
		add_action( 'pre_get_posts', [ $this, 'pre_get_posts' ] );
		add_action( 'template_redirect', [ $this, 'template_redirect' ] );
	}

	function pre_get_posts( &$query ) {
		if ( ! $query->is_main_query() ) {
			return;
		}

		if ( $query->is_home() || $query->is_author() ) {
			$query->set( 'post_type', array( 'post', 'video', 'gallery' ) );
			$query->set( 'posts_per_page', 5 );
			return;
		}

		if ( $query->get( 'album' ) && $query->is_archive() ) {
			$query->set( 'orderby', 'menu_order' );
			$query->set( 'order', 'ASC' );
			$query->set( 'posts_per_page', -1 );
		}
	}

	function init() {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
	}

	function template_redirect() {
		$theme = get_stylesheet_directory_uri();
		wp_enqueue_style( 'gp-main', get_stylesheet_uri() );
		wp_enqueue_style( 'gp-global', $theme . '/css/global.min.css' );

		wp_enqueue_script( 'gp-main', $theme . '/js/main.js', array( 'jquery' ) );

		if ( is_single() && 'gallery' === get_post_type() ) {
			wp_enqueue_style( 'gallery', $theme . '/css/jquery.fancybox.css' );
			wp_enqueue_script( 'fancybox', $theme . '/js/jquery.fancybox.pack.js', array( 'jquery' ) );
			wp_enqueue_script( 'bpr-gallery', $theme . '/js/gallery.js', array( 'fancybox' ) );
		}
	}
}
GoodbyePicassoTheme::get_instance();

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
	switch ( get_post_type() ) {
	case 'video':
		echo '<a href="/media/#videos">Video</a>';
		break;
	case 'song':
		echo '<a href="/music/">Song</a>';
		break;
	case 'gallery':
		echo '<a href="', get_post_type_archive_link( 'gallery' ), '">Photos</a>';
		break;
	default:
		$category = get_the_category();

		if ( is_array( $category ) && 1 === count( $category ) && 'Uncategorized' === reset( $category )->name ) {
			break;
		}

		the_category( ', ' );
		break;
	}
}

function _on( $truth ) {
	if ( $truth ) {
		return 'class="on" ';
	}
}

function gp_comment($comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<?php if ('' == $comment->comment_type ): ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment-author vcard">
				<?php
				echo get_avatar( $comment, 40 );
				printf(
					'%s <span class="says">says:</span>',
					sprintf(
						'<cite class="fn">%s</cite>',
						get_comment_author_link()
					)
				);
			?>
			</div>
			<?php if ( $comment->comment_approved == '0' ): ?>
			<em>Your comment is awaiting moderation.</em><br />
			<?php endif ?>
			<div class="comment-meta commentmetadata">
				<a href="<?php echo esc_url( get_comment_link( $comment ) ) ?>">
				<?php
				printf( '%1$s at %2$s', get_comment_date(), get_comment_time()) ?></a>
				<?php edit_comment_link( '(Edit)', ' ' ) ?>
			</div>
			<div class="comment-body"><?php comment_text() ?></div>
			<div class="tape medium-tape reply">
			<?php
				comment_reply_link( array_merge( $args, array(
					'depth' => $depth,
					'max_depth' => $args['max_depth']
				) ) );
			?>
			</div>
		</div>
	<?php else : ?>
	<li class="post pingback">
		<p>Pingback: <?php
			comment_author_link();
			edit_comment_link( '(Edit)', ' ' );
		?></p>
	<?php endif;?>
	</li><?php
}

function gp_author() {
// If a user has filled out their description, show a bio on their entries
	if ( ! get_the_author_meta( 'description' ) ) {
		return;
	}
	?>
	<div id="entry-author-info">
		<div id="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ) ?>
		</div>
		<div id="author-description">
			<h2>About <?php echo get_the_author() ?></h2>
			<?php the_author_meta( 'description' ); ?>
			<div id="author-link">
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
				<?php
					printf(
						'View all posts by %s <span class="meta-nav">&rarr;</span>',
						get_the_author()
					);
				?>
				</a>
			</div>
		</div>
	</div><?php
}

function page_like_button() {
	echo '<div class="fb-like" href="http://www.facebook.com/goodbyepicasso" data-layout="button" data-action="like" data-show-faces="false" data-share="false"></div>';
}

function the_like_button() {
	echo '<iframe src="http://www.facebook.com/plugins/like.php?href=', urlencode(get_permalink()), '&amp;layout=button_count&amp;show_faces=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden;width:85px;height:21px" allowTransparency="true"></iframe>';
}

function full_like_button() {
	?><fb:like></fb:like><?php
}

function band_go_back( $url = '', $text = '' ) {
?>
	<div class="navigation">
		<div class="nav-previous">
			<a href="<?php echo $url ?>"><span class="meta-nav">&larr;</span> <?php echo $text ?></a>
		</div>
	</div>
<?php
}