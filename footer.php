<?php 
	$DATA_THEME = get_field('data-theme') ? get_field('data-theme') : 'default';
?>
<div class="section scroll-trigger scroll-trigger--foter section-footer" data-theme="dark">
	
	<div class="section-footer--row section-footer--row_social">
			<!-- WIDGET FOLLOW US -->
			<?php
				// if ( is_active_sidebar( 'followus-widget-area' ) ) :
					// dynamic_sidebar( 'followus-widget-area' );
				// endif;
			?>
			<ul class="nav-list foot-navlist foot-navlist--social list-none">
				<li class="foot-navlist--social_item">
					<span class="foot-navlist--social_label strong">Instagram</span>
					<a href="" class="foot-navlist--social_link strong">annavenclovska</a>
				</li>
				<li class="foot-navlist--social_item">
					<span class="foot-navlist--social_label strong">Pinterest</span>
					<a href="" class="foot-navlist--social_link strong">annavenclovska</a>
				</li>
			</ul>
	</div>

	<div class="section-footer--row">
		<!-- LOGO -->
		<!-- <div class="logo-container" style="--logo-ratio: 800/212;"> -->
			<div class="svg-container logo" id="logoID" style="--aspect-ratio:1373/603;">
				<!-- LOGO SVG -->
				<?php get_template_part( 'template-parts/logo_footer', 'top' ); ?>
				<!-- LOGO SVG -->
			</div>
		<!-- </div> -->
	</div>

	<div class="section-footer--row section-footer--row_contact ">
		<div class="section-footer--col">
			<p class="plain label">Copyright</p>
			<?php 
				$CURR_YEAR = date('Y');
			?>
			<p class="plain copyright strong">©&nbsp;<?php echo strval($CURR_YEAR); ?>&nbsp;<?php echo get_bloginfo( 'name' ); ?></p>
		</div>
		
		<div class="section-footer--col">
			<p class="plain label">Fast travel</p>
			<p class="plain strong">Back to top</p>
		</div>

		<div class="section-footer--col">
			<p class="plain label">Studio</p>
			<p class="plain strong">Klikatá 1234/5, Řevnice</p>
		</div>

		<div class="section-footer--col">
			<p class="plain label">Mail us</p>
			<p class="plain strong"><a href="mailto:studio@annavenclovska.com" class="mailto-link strong">studio@annavenclovska.com</a></p>
		</div>
		
	</div>
</div>


</div> <!-- END WRAPPER -->

	<?php wp_footer(); ?>
</body>
</html>