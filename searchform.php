<?php ?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<div class="wp-block-search__inside-wrapper">
		<label>
			<span class="screen-reader-text"><?php echo esc_html_x( 'search', 'label', 'annav_theme' ); ?></span>
			<input type="search" id="search-fieldID" class="search-field wp-block-search__input" placeholder="<?php echo esc_attr_x( 'search', 'placeholder', 'annav_theme' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php echo esc_attr_x( 'search', 'label', 'annav_theme' ); ?>" />
		</label>
	</div>
	<input id="search-btnID" type="submit" class="search-submit visually-hidden" value="<?php echo esc_attr_x( 'ok', 'submit button', 'annav_theme' ); ?>" />
</form>
