<?php	 		 		 	
/*
 * Detect Mobile
 * used to know when to switch <img> to <canvas>
 * TODO: figure out how to do this with Caching
 *
 */

function isMobile() {
	if (preg_match("/iphone/i", $_SERVER["HTTP_USER_AGENT"])) {
		return true;
	}

	// Check the server headers to see if they're mobile friendly
	if (isset($_SERVER["HTTP_X_WAP_PROFILE"])) {
		return true;
	}

	// If the http_accept header supports wap then it's a mobile too
	if (preg_match("/wap\.|\.wap/i", $_SERVER["HTTP_ACCEPT"])) {
		return true;
	}

	// Still no luck? Let's have a look at the user agent on the browser. If it contains
	// any of the following, it's probably a mobile device. Kappow!
	if (isset($_SERVER["HTTP_USER_AGENT"])) {
		$user_agents = array("midp", "j2me", "avantg", "docomo", "novarra", "palmos", "palmsource", "240x320", "opwv", "chtml", "pda", "windows\ ce", "mmp\/", "blackberry", "mib\/", "symbian", "wireless", "nokia", "hand", "mobi", "phone", "cdm", "up\.b", "audio", "SIE\-", "SEC\-", "samsung", "HTC", "mot\-", "mitsu", "sagem", "sony", "alcatel", "lg", "erics", "vx", "NEC", "philips", "mmm", "xx", "panasonic", "sharp", "wap", "sch", "rover", "pocket", "benq", "java", "pt", "pg", "vox", "amoi", "bird", "compal", "kg", "voda", "sany", "kdd", "dbt", "sendo", "sgh", "gradi", "jb", "\d\d\di", "moto");
		foreach ($user_agents as $user_string) {
			if (preg_match("/" . $user_string . "/i", $_SERVER["HTTP_USER_AGENT"])) {
				return true;
			}
		}
	}

	// None of the above? Then it's probably not a mobile device.
	return false;
}

function init_photos() {
wp_enqueue_script('easing', '/wp-content/plugins/bandpress/js/jquery.easing-1.3.pack.js', array('jquery'));
wp_enqueue_script('fancybox', '/wp-content/plugins/bandpress/js/jquery.fancybox-1.3.1.pack.js', array('jquery', 'easing'));
wp_enqueue_script('bpr-gallery', '/wp-content/plugins/bandpress/js/bandpress-gallery.js', array('jquery', 'fancybox'));

}
add_action( 'wp', 'init_photos' );


/*
 * CDN Capabilities
 * adds subdomain support for image src
 *
 */

$current_dir = 0; 
$dirs = array('assets1', 'assets2', 'assets3', 'assets4'); 
$total_dirs = count($dirs);

function switch_domain($src) {
	global $current_dir, $dirs, $total_dirs;

	if ($current_dir === $total_dirs) {
		$current_dir = 0;
	}
	
	$new_src = str_replace('src="http://', 'src="http://' . $dirs[$current_dir] . '.', $src);
	$current_dir++;
	
	return $new_src;
}

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

	$attachments =& get_posts(array(
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

	$attachments =& get_posts(array(
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

	query_posts(array(
		'order'          => 'ASC',
		'orderby'        => 'menu_order',
		'post_type'      => 'attachment',
		'post_parent'    => $post->ID,
		'post_mime_type' => 'image',
		'post_status'    => 'inherit',
		'posts_per_page' => $p,
		'numberposts' 	 => $p,
		'paged'          => band_the_page()
	));	
	if (have_posts()):
		band_nav_by_type('photos', 'above', true);?>
		<ul class="band_gallery">
		<?php	 		 		 	 while (have_posts()): the_post(); ?>
		<li>
			<?php	 		 		 	 
			$link = wp_get_attachment_link(get_the_ID(), 'thumbnail', true); 
			echo band_add_gallery_attrs($link, get_the_title(), $gallery_name);			
			?>
			<span class="tape">
				<?php echo  apply_filters('the_title', band_check_title(get_the_title())) ?>
			</span>
		</li>
		<?php	 		 		 	 endwhile ?>
		</ul><?php	 		 		 	
	endif;	
}