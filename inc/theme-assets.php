<?php
/**
 * Front-end and editor asset registration.
 *
 * @package annav_theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Cache-busting version from file modification time.
 *
 * @param string $relative_path Path relative to theme root, e.g. '/assets/css/style.css'.
 */
function annav_asset_version( $relative_path ) {
	$path = get_template_directory() . $relative_path;

	return file_exists( $path ) ? (string) filemtime( $path ) : '1.0.0';
}

/**
 * Member / auth page slugs that use public.css.
 *
 * @return string[]
 */
function annav_public_asset_page_slugs() {
	return array(
		'registrace',
		'muj-ucet',
		'nastavte-si-heslo',
	);
}

/**
 * Whether the current view needs member-area styles.
 */
function annav_needs_public_assets() {
	if ( apply_filters( 'annav_enqueue_public_assets', false ) ) {
		return true;
	}

	return annav_is_auth_page();
}

/**
 * Auth-related pages that load public.css.
 */
function annav_is_auth_page() {
	if ( ! is_singular( 'page' ) ) {
		return false;
	}

	$post = get_post();
	if ( ! $post ) {
		return false;
	}

	return in_array( $post->post_name, annav_public_asset_page_slugs(), true );
}

/**
 * Enqueue front-end styles and scripts.
 */
function annav_enqueue_frontend_assets() {
	if ( is_admin() ) {
		return;
	}

	$theme_uri = get_template_directory_uri();

	wp_dequeue_style( get_stylesheet() );
	wp_deregister_style( get_stylesheet() );

	wp_enqueue_style(
		'annav_style',
		$theme_uri . '/assets/css/style.css',
		array(),
		annav_asset_version( '/assets/css/style.css' )
	);

	if ( annav_needs_public_assets() ) {
		wp_enqueue_style(
			'annav_public',
			$theme_uri . '/assets/css/public.css',
			array( 'annav_style' ),
			annav_asset_version( '/assets/css/public.css' )
		);
	}

	wp_register_style(
		'annav_wp-block-fix',
		$theme_uri . '/assets/css/wp-block-fix-style.css',
		array( 'annav_style' ),
		annav_asset_version( '/assets/css/wp-block-fix-style.css' )
	);

	wp_enqueue_script(
		'annav_lazyload',
		$theme_uri . '/assets/js/lazyload.js',
		array(),
		annav_asset_version( '/assets/js/lazyload.js' ),
		true
	);

	wp_enqueue_script(
		'annav_flickity',
		$theme_uri . '/assets/js/libs/flickity.pkgd.min.js',
		array(),
		annav_asset_version( '/assets/js/libs/flickity.pkgd.min.js' ),
		true
	);

	wp_enqueue_script(
		'annav_gsap',
		$theme_uri . '/assets/js/libs/gsap.min.js',
		array(),
		annav_asset_version( '/assets/js/libs/gsap.min.js' ),
		true
	);

	wp_enqueue_script(
		'annav_scrolltrigger',
		$theme_uri . '/assets/js/libs/ScrollTrigger.min.js',
		array(),
		annav_asset_version( '/assets/js/libs/ScrollTrigger.min.js' ),
		true
	);

	wp_enqueue_script(
		'annav_theme-front',
		$theme_uri . '/assets/js/theme-front.js',
		array(),
		annav_asset_version( '/assets/js/theme-front.js' ),
		true
	);

	if ( get_option( 'thread_comments' ) && is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'annav_enqueue_frontend_assets', 20 );

/**
 * Shortcodes can render after wp_enqueue_scripts — load public.css in footer if needed.
 */
function annav_maybe_enqueue_public_assets_late() {
	if ( is_admin() || ! annav_needs_public_assets() ) {
		return;
	}

	if ( wp_style_is( 'annav_public', 'enqueued' ) || wp_style_is( 'annav_public', 'done' ) ) {
		return;
	}

	wp_enqueue_style(
		'annav_public',
		get_template_directory_uri() . '/assets/css/public.css',
		array( 'annav_style' ),
		annav_asset_version( '/assets/css/public.css' )
	);
}
add_action( 'wp_footer', 'annav_maybe_enqueue_public_assets_late', 1 );

/**
 * Non-critical Gutenberg fix stylesheet — printed at end of body.
 */
function annav_print_wp_block_fix_style() {
	if ( is_admin() || ! wp_style_is( 'annav_wp-block-fix', 'registered' ) ) {
		return;
	}

	wp_enqueue_style( 'annav_wp-block-fix' );
	wp_print_styles( 'annav_wp-block-fix' );
}
add_action( 'wp_footer', 'annav_print_wp_block_fix_style', 5 );

/**
 * Block editor only — not all wp-admin screens.
 */
function annav_enqueue_editor_styles() {
	wp_enqueue_style(
		'annav_editor',
		get_stylesheet_directory_uri() . '/assets/css/style-editor.css',
		array(),
		annav_asset_version( '/assets/css/style-editor.css' )
	);
}
add_action( 'enqueue_block_editor_assets', 'annav_enqueue_editor_styles' );
