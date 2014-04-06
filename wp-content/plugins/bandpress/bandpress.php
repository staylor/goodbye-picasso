<?php
/*
Plugin Name: BandPress
Description: This plugin is terrible, I was an idiot when I wrote it
Author: Scott Taylor
Version: 1.0
Author URI: http://scotty-t.com
*/
define('PLUGIN_PATH', WP_PLUGIN_URL . '/bandpress');

add_action( 'init', 'band_register_types' );
add_action( 'admin_print_styles', 'band_admin_styles' );

function band_inflection( $term, $plural = '' ) {
    $u = ucfirst( $term );
    $p = strlen( $plural ) ? ucfirst( $plural ) : $u . 's';

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
	$args = array(
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'capability_type' => 'post',
		'query_var' => true,
		'hierarchical' => false,
		'rewrite' => true,
		'has_archive' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'comments', 'author', 'page-attributes')
	);

    register_post_type( 'gallery', array_merge( $args, array(
    	'labels' => band_inflection( 'Gallery', 'Galleries' )
	) ) );
    register_post_type( 'video', array_merge( $args, array(
    	'labels' => band_inflection( 'Video' )
    ) ) );
    register_post_type( 'song', array_merge( $args, array(
    	'labels' => band_inflection( 'Song' )
    ) ) );

	register_taxonomy( 'album', 'song', array(
		'hierarchical' => true,
		'label' => 'Album',
		'query_var' => true,
		'rewrite' => true
	) );
}

function band_admin_styles() {
	wp_enqueue_style('band_admin', PLUGIN_PATH . '/css/admin.css');
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

function band_nav_by_type( $args = array() ) {
	global $wp_query;
	$_q = $wp_query;

	$defaults = array(
		'type' => 'posts',
		'where' => 'above',
		'use_qs' => false,
		'q' => $wp_query
	);
	$params = wp_parse_args( $args, $defaults );
	$wp_query = $params['q'];

	$max = $params['q']->max_num_pages;
	$page = $params['q']->get( 'paged' ) ? $params['q']->get( 'paged' ) : 1;

	if ( $max > 1 ):
?>
	<div id="nav-<?php echo $params['where'] ?>" class="navigation">
		<div class="nav-previous">
			<?php
			$prev = $page - 1;
			$plabel = sprintf( '<span class="meta-nav">&larr;</span> Newer %s (%d of %d)', $params['type'], $prev, $max );

			if ( $params['use_qs'] && $prev >= 1 ): ?>
			<a href="?<?php echo PAGE_PARAM, '=', $prev ?>"><?php echo $plabel ?></a>
			<?php elseif ( ! $params['use_qs'] ):
				previous_posts_link( $plabel );
			endif;
		?>
		</div>
		<div class="nav-next">
			<?php
			$next = $page + 1;
			$nlabel = sprintf( 'Older %s (%d of %d) <span class="meta-nav">&rarr;</span>', $params['type'], $next, $max );

			if ( $params['use_qs'] && ( $max >= $next ) ): ?>
			<a href="?<?php echo PAGE_PARAM, '=', $next ?>"><?php echo $nlabel ?></a>
			<?php elseif ( ! $params['use_qs'] ):
				next_posts_link( $nlabel );
			endif;
		?>
		</div>
	</div>
<?php
	endif;
	$wp_query = $_q;
}
function init_photos() {
	if ( is_single() && 'gallery' === get_post_type() ) {
		wp_enqueue_style( 'gallery', '/wp-content/plugins/bandpress/css/jquery.fancybox.css' );
		wp_enqueue_script('fancybox', '/wp-content/plugins/bandpress/js/jquery.fancybox.pack.js', array('jquery'));
		wp_enqueue_script('bpr-gallery', '/wp-content/plugins/bandpress/js/bandpress-gallery.js', array('fancybox'));
	}
}
add_action( 'template_redirect', 'init_photos' );


function band_check_title($str) {
	if ($str !== 'photo' && !strstr($str, 'photo-')) {
		return $str;
	}
}

function band_add_gallery_attrs($link, $title, $gallery) {
	return str_replace('<a', '<a rel="' . $gallery . '" class="fancybox" title="' .
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
		'paged'          => isset( $_GET['to'] ) ? $_GET['to'] : 1
	));

	if ( $q->have_posts() ):
		band_nav_by_type( array( 'type' => 'photos', 'use_qs' => true, 'q' => $q ) );?>
		<ul class="band_gallery">
		<?php while ( $q->have_posts() ): $q->the_post(); ?>
		<li>
			<?php
			$link = wp_get_attachment_image_src( get_the_ID(), 'thumbnail', true );
			$big = wp_get_attachment_image_src( get_the_ID(), 'full', true );
			$title = band_check_title( get_the_title() );
			?>
			<a href="<?php echo reset( $big ) ?>" title="<?php echo $title ?>" class="fancybox" rel="<?php echo $gallery_name ?>">
				<img class="attachment-thumbnail" src="<?php echo reset( $link ) ?>"/>
			</a>
			<span class="tape"><?php echo apply_filters( 'the_title', $title ) ?></span>
		</li>
		<?php endwhile ?>
		</ul><?php
	endif;

	wp_reset_postdata();
}