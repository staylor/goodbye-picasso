<?php
/*
Plugin Name: BandPress
Description: This plugin is terrible, I was an idiot when I wrote it
Author: Scott Taylor
Version: 1.0
Author URI: http://scotty-t.com
*/
define('PLUGIN_PATH', WP_PLUGIN_URL . '/bandpress');


function band_get_post_type() {
	global $post;
	$type = get_post_type( $post );

	if ( empty( $type ) && isset( $_GET['post_type'] ) )
		$type = $_GET['post_type'];

	if ( empty( $type ) && isset( $_GET['post'] ) )
		$type = get_post_type($_GET['post']);

	return $type;
}

function _b( $all, $key ) {
	if ( array_key_exists( $key, $all ) && is_array( $all[$key] ) ) {
		return $all[$key][0];
	}
}

function _t( $ISO ) {
	return date_timestamp_get( date_create( $ISO ) );
}

add_action( 'init', 'band_register_types' );
add_action( 'admin_init', 'band_admin_init' );
add_action( 'save_post', 'band_save_by_type' );
add_action( 'admin_print_styles', 'band_admin_styles' );
add_action( 'wp_print_styles', 'band_print_styles' );


$args = array(
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'capability_type' => 'post',
    'query_var' => true,
    'hierarchical' => false,
    'rewrite' => true,
    'supports' => array('title', 'editor', 'thumbnail', 'comments', 'excerpt', 'author')
);

function band_inflection( $term, $plural = '' ) {
    $u = ucfirst( $term);
    $p = strlen( $plural) ? ucfirst( $plural) : $u . 's';

    return array(
      	'name' => _x( $p, 'post type general name'),
        'singular_name' => _x( $u, 'post type singular name'),
        'add_new' => _x('Add New', strtolower( $u) ),
        'add_new_item' => __('Add New ' . $u),
        'edit_item' => __('Edit ' . $u),
        'new_item' => __('New ' . $u),
        'view_item' => __('View ' . $u),
        'search_items' => __('Search ' . $p),
        'not_found' =>  __('No ' . strtolower( $p) . ' found'),
        'not_found_in_trash' => __('No ' . strtolower( $p) . ' found in Trash')
    );
}

function band_register_types() {
    global $args;

    register_post_type('gallery', array_merge( $args, array(
    	'labels' => band_inflection('Gallery', 'Galleries'),
    	'supports' => array('title', 'editor', 'thumbnail', 'comments', 'author', 'page-attributes') )) );
    register_post_type('video', array_merge( $args, array(
    	'labels' => band_inflection('Video'),
    	'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes')
    ) ));
    register_post_type('song', array_merge( $args, array(
    	'labels' => band_inflection('Song'),
    	'supports' => array('title', 'editor', 'thumbnail', 'comments', 'page-attributes')
    ) ));

	register_taxonomy('album', 'song', array('hierarchical' => true, 'label' => 'Album', 'query_var' => true, 'rewrite' => true) );
}

function band_admin_init() {
	$type = band_get_post_type();

	if ( $type) {
	  	switch ( $type) {
	    case 'show':
		    add_meta_box('show-setlist', 'Setlist', 'setlist_details', 'show', 'normal', 'high');
		    break;
		default:
			break;
		}
	}
}

function band_admin_styles() {
	if ( 'show' !== get_post_type() ) {
		wp_enqueue_style('band_admin', PLUGIN_PATH . '/css/admin.css');
	}
}

function band_print_styles() {
	if ( is_single() && 'gallery' === get_post_type() )
		wp_enqueue_style( 'gallery', PLUGIN_PATH . '/css/jquery.fancybox-1.3.1.css' );
}

function setlist_details() {
	global $post;
	$c = get_post_meta( $post->ID, 'setlist' );

	$setlist = ! empty( $c ) ? $c : '';
?>
	<textarea name="setlist"><?php esc_html_e( $setlist ) ?></textarea>
<?php
}

function band_apply_rules( $post_var, $key = null ) {
	global $post;

	if (is_array( $post_var) ) {
		foreach ( $post_var as $p) {
			$f_key = $key ? $key : $p;
			if ( ! empty( $_POST[$p] ) ) {
				update_post_meta( $post->ID, $f_key, $_POST[$p] );
			} else {
				delete_post_meta( $post->ID, $f_key);
			}
		}
	} else {
		$f_key = $key ? $key : $post_var;

		if ( ! empty( $_POST[$post_var] ) ) {
			update_post_meta( $post->ID, $f_key, $_POST[$post_var] );
		} else {
			delete_post_meta( $post->ID, $f_key);
		}
	}
}

function band_save_by_type() {
	switch ( get_post_type() ) {
	case 'show':
		band_apply_rules( array( 'setlist' ) );
		break;
	default:
		return;
	}
}
define('PAGE_PARAM', 'to');

function band_get_posts_by_type($overrides = null) {
	query_posts(array_merge(array(
		'order_by' => 'menu_order',
		'order' => 'DESC',
		'post_type' => 'post',
		'posts_per_page' => -1,
		'paged' => get_query_var('paged')
	), is_null($overrides) ? array() : $overrides));
}

function band_nav_by_type( $type = 'posts', $where = 'above', $use_qs = false, $in_cat = 0 ) {
	global $wp_query;
	$max = $wp_query->max_num_pages;
	$page = get_query_var('paged') ? (int) get_query_var('paged') : 1;

	if ( $max > 1 ):
?>
	<div id="nav-<?php echo $where ?>" class="navigation">
		<div class="nav-previous">
			<?php
			$prev = $page - 1;
			if ( $use_qs && $prev >= 1 ): ?>
			<a href="?<?php echo PAGE_PARAM, '=', $prev ?>">
			<?php
				_e( '<span class="meta-nav">&larr;</span>Newer ' . $type . ' (' . $prev . ' of ' . $max . ')' ) ?></a>
			<?php elseif (!$use_qs):
				previous_posts_link( __( '<span class="meta-nav">&larr;</span> Newer ' . $type . ' (' . $prev . ' of ' . $max . ')' ), $in_cat );
			endif;
		?>
		</div>
		<div class="nav-next">
			<?php
			$next = $page + 1;

			if ( $use_qs && ( $max >= $next ) ): ?>
			<a href="?<?php echo PAGE_PARAM, '=', $next ?>">
			<?php
				_e('Older ' . $type . ' (' . $next . ' of ' . $max . ') <span class="meta-nav">&rarr;</span>' ) ?></a>
			<?php elseif ( ! $use_qs ):
				next_posts_link( __('Older ' . $type . ' (' . $next . ' of ' . $max . ') <span class="meta-nav">&rarr;</span>' ), $in_cat );
			endif;
		?>
		</div>
	</div>
<?php
	endif;
}
function init_photos() {
	if ( is_single() && 'gallery' === get_post_type ) {
		wp_enqueue_script('easing', '/wp-content/plugins/bandpress/js/jquery.easing-1.3.pack.js', array('jquery'));
		wp_enqueue_script('fancybox', '/wp-content/plugins/bandpress/js/jquery.fancybox-1.3.1.pack.js', array('jquery', 'easing'));
		wp_enqueue_script('bpr-gallery', '/wp-content/plugins/bandpress/js/bandpress-gallery.js', array('jquery', 'fancybox'));
	}
}
add_action( 'template_redirect', 'init_photos' );


function band_check_title($str) {
	if ($str !== 'photo' && !strstr($str, 'photo-')) {
		return $str;
	}
}

function band_add_gallery_attrs($link, $title, $gallery) {
	return str_replace('<a', '<a rel="' . $gallery . '" title="' .
		band_check_title(apply_filters('the_title_attribute', $title)) . '"', $link);
}

function band_get_first_attachment() {
	global $post;

	$attachments = get_posts(array(
		'order'          => 'ASC',
		'post_type'      => 'attachment',
		'post_parent'    => $post->ID,
		'post_mime_type' => 'image',
		'post_status'    => 'inherit',
		'numberposts' 	 => 1
	));
	foreach ($attachments as $att) {
		$src = wp_get_attachment_image_src($att->ID, 'thumbnail', true);
	}
	unset($attachments);

	return str_replace('jpg', 'jpeg', str_replace('-150x150', '', $src[0]));
}

function band_gallery_preview_strip($number = 5) {
	global $post;

	$attachments = get_posts(array(
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'post_type'      => 'attachment',
		'post_parent'    => $post->ID,
		'post_mime_type' => 'image',
		'post_status'    => 'inherit',
		'numberposts' 	 => $number
	));

	$gallery = '<div class="band_gallery_strip_wrapper">';

	if ($attachments) {
		$gallery .= '<span class="tape tilt_left"></span>';
		$gallery .= '<span class="tape tilt_right"></span>';
		$gallery .= '<ul class="band_gallery_strip">';
		foreach ($attachments as $att) {
			$src = wp_get_attachment_image_src($att->ID, 'thumbnail', true);
			$gallery .= '<li><img src="' . $src[0] . '"/></li>';
		}
		$gallery .= '</ul>';
	}
	$gallery .= '</div>';
	unset($attachments);

	echo $gallery;
}

function band_get_first_image() {
	global $post;

	$split = explode('src="', $post->post_content);
	$src = explode('"', $split[1]);

	echo $src[0];
}

function band_gallery_images($p = -1) {
	global $post;

	$gallery_name = $post->post_name;

	$q = new WP_Query( array(
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'post_type'      => 'attachment',
		'post_parent'    => $post->ID,
		'post_mime_type' => 'image',
		'post_status'    => 'inherit',
		'posts_per_page' => $p,
		'numberposts' 	 => $p,
		'paged'          => get_query_var('paged')
	));

	if ( $q->have_posts() ):
		band_nav_by_type('photos', 'above', true);?>
		<ul class="band_gallery">
		<?php while ( $q->have_posts() ): $q->the_post(); ?>
		<li>
			<?php
			$link = wp_get_attachment_link(get_the_ID(), 'thumbnail', true);
			echo band_add_gallery_attrs($link, get_the_title(), $gallery_name);
			?>
			<span class="tape">
				<?php echo apply_filters('the_title', band_check_title(get_the_title())) ?>
			</span>
		</li>
		<?php endwhile ?>
		</ul><?php
	endif;

	wp_reset_postdata();
}