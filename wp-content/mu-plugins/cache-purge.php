<?php

class CachePurge {
	static $instance = array();

	public static function get_instance() {
		$c = get_called_class();
		if ( ! isset( static::$instance[ $c ] ) ) {
			static::$instance[ $c ] = new $c;
		}
		return static::$instance[ $c ];
	}

	private function __construct() {
		add_action( 'transition_post_status', array( $this, 'transition_post_status' ), 10, 3 );
	}

	public function transition_post_status( $new, $old, $post ) {
		if ( 'publish' !== $old && 'publish' !== $new ) {
			return;
		}
		$post = get_post( $post );
		$url = get_permalink( $post );

		// Purge this URL
		$this->purge( $url );

		// Purge the front page
		$this->purge( home_url( '/' ) );
	}

	private function purge( $url ) {
		wp_remote_get( $url, array(
			'timeout' => 0.01,
			'blocking' => false,
			'headers' => array( 'X-Nginx-Cache-Purge' => '1' )
		) );
	}
}
CachePurge::get_instance();
