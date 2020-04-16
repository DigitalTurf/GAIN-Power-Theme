<?php
function gain_power_url_preview(){
	$url       = $_POST['url'];
	$json_data = array();

    // Old code that was causing the issue
	/*$cache_key = 'bp_activity_oembed_' . md5( serialize( $url ) );
	$data      = get_transient( $cache_key );
	if ( ! empty( $data ) ) {
		wp_send_json( $data );
	}

	// Fetch the oembed code for URL.
	$embed_code = wp_oembed_get( $url );
	if ( ! empty( $embed_code ) ) {
		$json_data['title']       = ' ';
		$json_data['description'] = $embed_code;
		$json_data['images']      = '';
		$json_data['error']       = '';
		$json_data['wp_embed']    = true;

		set_transient( $cache_key, $json_data, DAY_IN_SECONDS );

		wp_send_json( $json_data );
	}*/

	// include website parser
	require_once trailingslashit( buddypress()->plugin_dir . 'bp-activity/vendors' ) . '/website-parser/website_parser.php';

	// curling
	if ( class_exists( 'WebsiteParser' ) ) {

		$parser = new WebsiteParser( $url );
		$body   = wp_remote_get( $url );

		if ( ! is_wp_error( $body ) && isset( $body['body'] ) ) {

			$title       = '';
			$description = '';
			$images      = array();

			$parser->content = $body['body'];

			$meta_tags = $parser->getMetaTags( false );

			if ( is_array( $meta_tags ) && ! empty( $meta_tags ) ) {
				foreach ( $meta_tags as $tag ) {
					if ( is_array( $tag ) && ! empty( $tag ) ) {
						if ( $tag[0] == 'og:title' ) {
							$title = $tag[1];
						}
						if ( $tag[0] == 'og:description' ) {
							$description = html_entity_decode( $tag[1], ENT_QUOTES, 'utf-8' );
						} elseif ( strtolower( $tag[0] ) == 'description' && $description == '' ) {
							$description = html_entity_decode( $tag[1], ENT_QUOTES, 'utf-8' );
						}
						if ( $tag[0] == 'og:image' ) {
							$images[] = $tag[1];
						}
					}
				}
			}
			if ( $title == '' ) {
				$title = $parser->getTitle( false );
			}
			if ( empty( $images ) ) {
				$images = $parser->getImageSources( false );
			}
			if ( ! empty( $images ) ) {
				$images_obj = [];

				foreach ( $images as $key => $img ) {
					if ( strpos( $url, 'youtube.com' ) > 0 ) {
						$img = 'https://www.youtube.com' . $img;
					}
					if ( @fopen( $img, 'r' ) ) {
						$images_obj[] = $img;
					}
				}
				$images = $images_obj;
			}

			// Generate Image URL Previews
			if ( empty( $images ) ) {
				$content_type = wp_remote_retrieve_header( $body, 'content-type' );
				if ( false !== strpos( $content_type, 'image' ) ) {
					$images = array( $url );
				}
			}

			$json_data['title']       = $title;
			$json_data['description'] = $description;
			$json_data['images']      = $images;
			$json_data['error']       = '';
		} else {
			// Extract HTML using curl
			$ch = curl_init();

			curl_setopt( $ch, CURLOPT_HEADER, 1 );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt( $ch, CURLOPT_URL, $url );
			curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );

			$data = curl_exec( $ch );
			curl_close( $ch );

			// Load HTML to DOM Object
			$dom = new DOMDocument();
			@$dom->loadHTML( $data );

			// Parse DOM to get Title
			$nodes = $dom->getElementsByTagName( 'title' );
			$title = $nodes->item( 0 )->nodeValue;

			if ( '' === $title || null === $title ) {
				$nodes = $dom->getElementsByTagName( 'h1' );
				$title = $nodes->item( 0 )->nodeValue;
			}

			if ( '' === $title || null === $title ) {
				$nodes = $dom->getElementsByTagName( 'h2' );
				$title = $nodes->item( 0 )->nodeValue;
			}

			// Parse DOM to get Meta Description
			$metas = $dom->getElementsByTagName( 'meta' );
			$body  = '';
			for ( $i = 0; $i < $metas->length; $i ++ ) {
				$meta = $metas->item( $i );
				if ( $meta->getAttribute( 'name' ) == 'description' ) {
					$body = $meta->getAttribute( 'content' );
				}
			}

			// Parse DOM to get Images
			$image_urls = array();
			$images     = $dom->getElementsByTagName( 'img' );

			for ( $i = 0; $i < $images->length; $i ++ ) {
				$image = $images->item( $i );
				$src   = $image->getAttribute( 'src' );

				if ( filter_var( $src, FILTER_VALIDATE_URL ) ) {
					$image_src[] = $src;
				}
			}

			if ( isset( $image_src ) && isset( $body ) && '' === trim( $title ) ) {
				$title = $body;
			}

			if ( isset( $title ) && isset( $body ) && isset( $image_src ) ) {
				$json_data['title']       = $title;
				$json_data['description'] = $body;
				$json_data['images']      = $image_src;
				$json_data['error']       = '';
			} else {
				$json_data['error'] = 'Sorry! preview is not available right now. Please try again later.';
			}
		}
	} else {
		$json_data['error'] = 'Sorry! preview is not available right now. Please try again later.';
	}

	wp_send_json( $json_data );
}