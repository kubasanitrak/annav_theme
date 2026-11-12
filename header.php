<?php  ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php
$theme_dir = get_template_directory();
$theme_uri = get_template_directory_uri();
?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1">

<meta name="robots" content= "index, follow">
<meta name="author" content="Jakub Sanitrák<=>kubaS">
<meta name="twitter:card"       content="summary_large_image" >
<meta name="twitter:site"       content="@KSanitrak" >
<meta name="twitter:creator"    content="@KSanitrak" >
<meta property="og:title" content="<?php echo get_bloginfo( 'name' ); ?>" />
<meta property="og:site_name" content="<?php echo get_bloginfo( 'name' ); ?>" />
<meta property="og:url" content="" />
<meta property="og:description" content="" />
<meta property="og:type" content="website" />
<?php if ( file_exists( $theme_dir . '/og-image.png' ) ) : ?>
<meta property="og:image" content="<?php echo esc_url( $theme_uri . '/og-image.png' ); ?>" />
<?php endif; ?>


<?php if ( file_exists( $theme_dir . '/assets/apple-touch-icon.png' ) ) : ?>
<link href="<?php echo esc_url( $theme_uri . '/assets/apple-touch-icon.png' ); ?>" rel="apple-touch-icon">
<?php endif; ?>
<?php if ( file_exists( $theme_dir . '/assets/favicon.svg' ) ) : ?>
<link rel="icon" type="image/svg+xml" href="<?php echo esc_url( $theme_uri . '/assets/favicon.svg' ); ?>">
<?php endif; ?>
<?php if ( file_exists( $theme_dir . '/assets/favicon.ico' ) ) : ?>
<link rel="alternate icon" href="<?php echo esc_url( $theme_uri . '/assets/favicon.ico' ); ?>">
<?php endif; ?>
<?php if ( file_exists( $theme_dir . '/assets/safari-pinned-tab.svg' ) ) : ?>
<link rel="mask-icon" href="<?php echo esc_url( $theme_uri . '/assets/safari-pinned-tab.svg' ); ?>" color="">
<?php endif; ?>

<!-- PREFETCH WEBFONTS -->
<!-- <link rel="prefetch" href="<?php #echo get_template_directory_uri(); ?>/assets/fonts/Zirkel-Bold.woff" as="font" type="font/woff" crossorigin> -->
<!-- PREFETCH WEBFONTS -->

<!-- START WP_HEAD() -->
<?php wp_head(); ?>
<!-- END WP_HEAD() -->

<!--[if lt IE]>
<style></style>
<![endif]-->


<style>
		/* CRITICAL CSS */
			@supports (--custom:property) {[style*="--aspect-ratio"] {position: relative; padding-bottom: 0; } [style*="--aspect-ratio"]::before {padding-bottom: calc(100% / (var(--aspect-ratio))); display: block; content: ""; } [style*="--aspect-ratio"] > :first-child:not(.play-button) {position: absolute; top: 0; left: 0; height: 100%; width: 100%; } }			
			@supports (--custom: property) {[style*="--img-ratio"] {position: relative; padding-bottom: 0; } [style*="--img-ratio"]::before {padding-bottom: calc(100% / (var(--img-ratio))); display: block; content: ""; width: 100%; } [style*="--img-ratio"] > img {position: absolute; width: 100%; height: 100%; object-fit: cover; top: 0; left: 0; } }

		/* LOADING */
			.js .wrapper.loading:after,.js .wrapper.loading:before{content:"";position:fixed;z-index:100000}.js .wrapper.loading:before{top:0;left:0;width:100%;height:100%;background:#000}.js .wrapper.loaded:after,.js .wrapper.loaded:before{opacity:0;z-index:-100000;transition:opacity .2s,z-index .2s}
		

</style>

<?php 
	$DATA_THEME = get_field('data-theme') ? get_field('data-theme') : 'default';
?>
</head>

<body>
	<script> document.body.className="js";</script>

	<div class="header" id="headerID" data-theme="<?php echo $DATA_THEME; ?>">
		<!-- style="background-color: pink;" -->
		<div class="logo-container " id="logo_header_ID" >
			<div class="svg-container logo" style="--aspect-ratio: 352/107;">
				<!-- LOGO SVG -->
				<?php get_template_part( 'template-parts/logo_header', 'top' ); ?>
				<!-- LOGO SVG -->
			</div>
			<a class="abs-link" href="<?php echo get_site_url(); ?>"></a>
		</div>
		<!-- NAVIGATION TOP -->
				<?php get_template_part( 'template-parts/navigation', 'top' ); ?>
		<!-- NAVIGATION TOP -->
	</div> <!-- END DIV CLASS HEADER -->

	<div class="wrapper loading" id="wrapper-id" >