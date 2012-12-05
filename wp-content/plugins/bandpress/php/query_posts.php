<?php
define('PAGE_PARAM', 'to');

function band_sqlize($array) {
	$i = 1;
	$total = count($array);
	$sql = ' ';

	foreach ($array as $key => $value) {
		$check = is_int($value) ? $value : ('"' . $value . '"');
		$sql .= $key . ' = ' . $check . ($total > 1 && $i !== $total ? ' AND ' : '');
		$i++;
	}
	
	return $sql;
}


function band_the_page() {
	return get_query_var('paged') ? (int) get_query_var('paged') : 1;
}

function band_query_taxonomy_all() {
	global $query_string;
	query_posts($query_string . '&orderby=menu_order&order=ASC&posts_per_page=-1');
}

function band_count_by_type($type) {

	$query = new WP_Query(array(
		'fields' => 'ids',
		'post_type'   => $type,
		'post_status' => 'publish'
	));
	
	return $query->found_posts;
}

function band_get_posts_by_type($overrides = null) {
	query_posts(array_merge(array(
		'order_by' => 'menu_order',
		'order' => 'DESC', 		
		'post_type' => 'post',
		'posts_per_page' => -1,
		'paged' => band_the_page()
	), is_null($overrides) ? array() : $overrides));
}

function band_go_back($url = '', $text = '') {
	?>
	<div class="navigation">
		<div class="nav-previous">
			<a href="<?php echo $url ?>"><span class="meta-nav">&larr;</span> <?php echo $text ?></a>
		</div>
	</div>
	<?php
}

function band_nav_by_type( $type = 'posts', $where = 'above', $use_qs = false, $in_cat = 0 ) {
	global $wp_query;
	$max = $wp_query->max_num_pages;
	$page = band_the_page();
	
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