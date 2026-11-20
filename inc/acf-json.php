<?php
/**
 * ACF Local JSON save/load paths.
 */

add_filter( 'acf/settings/save_json', 'annav_acf_json_save_point' );
function annav_acf_json_save_point( $path ) {
	return get_stylesheet_directory() . '/acf-json';
}

add_filter( 'acf/settings/load_json', 'annav_acf_json_load_point' );
function annav_acf_json_load_point( $paths ) {
	unset( $paths[0] );
	$paths[] = get_stylesheet_directory() . '/acf-json';
	return $paths;
}
