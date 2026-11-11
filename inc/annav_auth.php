<?php
/**
 * Custom wp-login.php styling.
 *
 * @package annav_theme
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registration page URL.
 */
function annav_auth_register_url() {
	return home_url( '/registrace/' );
}

/**
 * Login page URL.
 *
 * @param string $redirect Optional redirect target.
 */
function annav_auth_login_url( $redirect = '' ) {
	return wp_login_url( $redirect );
}

/**
 * Enqueue login screen assets.
 */
function annav_login_enqueue_assets() {
	$theme_uri = get_template_directory_uri();

	wp_enqueue_style(
		'annav_login',
		$theme_uri . '/assets/css/login.css',
		array(),
		annav_asset_version( '/assets/css/login.css' )
	);

	wp_enqueue_script(
		'annav_login',
		$theme_uri . '/assets/js/login.js',
		array(),
		annav_asset_version( '/assets/js/login.js' ),
		true
	);
}
add_action( 'login_enqueue_scripts', 'annav_login_enqueue_assets' );

function annav_login_logo_url() {
	return home_url( '/' );
}
add_filter( 'login_headerurl', 'annav_login_logo_url' );

function annav_login_logo_title() {
	return esc_attr( get_bloginfo( 'name' ) );
}
add_filter( 'login_headertext', 'annav_login_logo_title' );

function annav_login_body_class( $classes ) {
	$classes[] = 'annav_login';
	return $classes;
}
add_filter( 'login_body_class', 'annav_login_body_class' );

/**
 * Custom footer on login screen — registration prompt.
 */
function annav_login_footer_markup() {
	$register_url = annav_auth_register_url();
	?>
	<div class="annav_login-footer">
		<p class="annav_login-footer__text"><?php esc_html_e( 'Nemáte ještě účet?', 'annav_theme' ); ?></p>
		<a class="annav_login-footer__link" href="<?php echo esc_url( $register_url ); ?>">
			<?php esc_html_e( 'Zaregistrujte se', 'annav_theme' ); ?>
		</a>
	</div>
	<?php
}
add_action( 'login_footer', 'annav_login_footer_markup' );

/**
 * Change login button label.
 */
function annav_login_form_defaults( $defaults ) {
	$defaults['label_username'] = __( 'E-mail', 'annav_theme' );
	$defaults['label_password'] = __( 'Heslo', 'annav_theme' );
	$defaults['label_log_in']   = __( 'Přihlásit se', 'annav_theme' );
	return $defaults;
}
add_filter( 'login_form_defaults', 'annav_login_form_defaults' );

/**
 * Forgot-password link below the password field.
 */
function annav_login_forgot_link() {
	?>
	<p class="annav_login-forgot">
		<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>">
			<?php esc_html_e( 'Zapomněli jste heslo?', 'annav_theme' ); ?>
		</a>
	</p>
	<?php
}
add_action( 'login_form', 'annav_login_forgot_link' );
