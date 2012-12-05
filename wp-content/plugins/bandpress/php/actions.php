<?php	 		 		 	
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

function band_create_page( $title = '', $template = '' ) {
	global $user_ID;

	if (empty( $title) ) {
		return;
	}

	$q = new WP_Query(array(
		'name' => strtolower( $title),
		'post_type' => 'page'
	));

	if ( !$q->have_posts() ) {
		$id = wp_insert_post(array(
			'post_title' => $title,
			'post_content' => '',
			'post_status' => 'publish',
			'post_date' => date('Y-m-d H:i:s'),
			'post_author' => $user_ID,
			'post_type' => 'page'
		) ); 
		

		if ( ! empty( $template) ) {
			update_post_meta( $id, '_wp_page_template', $template);
		}
	}
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
    
    band_create_page('Media', 'media.php');
    band_create_page('Contact', 'contact.php');
    band_create_page('Photos', 'photos.php');
    
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
		wp_register_style('band_admin', PLUGIN_PATH . '/css/admin.css');
		wp_enqueue_style('band_admin');
	}
}

function band_print_styles() {
	if ( 'gallery' === get_post_type() )
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
