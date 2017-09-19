<?php
/**
 * Helper function to figure out which post type the pagee is currently on. Used accross whole theme
 * @return posttype
 */
function sh_get_post_type() {

	$pt = '';

	$base = str_replace( 'http://','' , home_url() );
	$base = str_replace( 'https://', '', $base );
	$base = explode( '/', rtrim( $base,'/' ) );
	$url_base_count = count( $base );

	$url_path = trim( parse_url( add_query_arg( array() ), PHP_URL_PATH ), '/' );
	$parts = explode( '/', rtrim( $url_path, '/' ) );

	$index = 0;

	if ( 1 === $url_base_count ) {
		$index = 0;
	} elseif ( 2 === $url_base_count ) {
		$index = 1;
	}

	if ( is_array( $parts ) || is_object( $parts ) ) {
		if ( isset( $parts[ $index ] ) ) {
			if ( get_field( 'sh_brochure_slug','option' ) === $parts[ $index ] ) {
				$pt = 'sh_brochure_';
			} elseif ( get_field( 'sh_contact_slug','option' ) === $parts[ $index ] ) {
				$pt = 'sh_contact_';
			} else {
				$pt = get_post_type() . '_';
			}
		}
	}

	return $pt;
}
