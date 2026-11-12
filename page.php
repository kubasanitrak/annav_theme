<?php
/**
 * Template Name: PAGE
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage annav_theme
 * @since 1.0
 * * @version 1.0
 */

get_header(); 

$PADDED_CONTENT = get_field('padded_content');

?>



<!-- PAGE CONTENT -->

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

		<?php if(is_front_page()) : ?>

		<?php endif; ?>

		<?php if($PADDED_CONTENT) : ?>
			<div data-theme="default" class="section pad-T pad-B-3 section-nowrapper" >
			<?php else: ?>
			<div data-theme="default" class="section section-content header-trigger" >
		<?php endif; ?>

			<?php the_content(); ?>

		<?php #if($PADDED_CONTENT) : ?>
			</div>
		<?php #endif; ?>
		
	<?php endwhile; endif; ?>


	<?php get_footer(); ?>