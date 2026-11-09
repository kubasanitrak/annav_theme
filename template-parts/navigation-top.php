<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage annav_theme
 * @since 1.0
 * * @version 1.0
 */

?>


<!-- <input type="checkbox" id="menuBtnID" class="desktop-hide nav-switch" checked> -->
<!-- <input type="checkbox" id="menuBtnID" class="desktop-hide nav-switch">
<label for="menuBtnID" class="hamburger hamburger--htx desktop-hide">
	<span>menu</span>
</label> -->
<div class="section-nav">
	<div class="header-col header-col--info">
		<p class="plain label"><?php echo get_bloginfo( 'name' ); ?></p>
		<p class="plain strong"><?php echo get_bloginfo( 'description' ); ?></p>
		<a class="abs-link" href="<?php echo get_site_url(); ?>"></a>
	</div>
	<div class="header-col header-col--menu">
		<p class="plain label">Navigation</p>
		<ul class="main-nav-list nav-list list-none">
			<li class="menu-item strong"><a href="#">Projects</a></li>
			<li class="menu-item strong"><a href="#">About</a></li>
			<li class="menu-item strong"><a href="#">Contact</a></li>
		</ul>
		<?php
			// wp_nav_menu( array(
			// 	'theme_location' => 'main-menu',
			// 	'container' => '',
			// 	'menu_class' => 'main-nav-list nav-list list-none',
			//  ) );
		?>
	</div>
	<div class="header-col header-col--lang">
		<p class="plain label">Language</p>
		<ul id="menu-langswitch-menu" class="nav-list list-none nav-lang">
			<li id="" class="nav-lang--item nav-lang--item-1 nav-lang--item-en nav-lang--item-first menu-item">
				<a href="#" lang="en-GB" hreflang="en-GB">English</a>
			</li>
			<li id="" class="nav-lang--item nav-lang--item-2 nav-lang--item-cs nav-lang--item-first menu-item">
				<a href="#" lang="cs-CZ" hreflang="cs-CZ">Česky</a>
			</li>
		</ul>
	</div>
</div>