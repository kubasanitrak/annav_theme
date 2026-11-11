<?php
/**
 * Template Name: SINGLE POST
 *
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage annav_theme
 * @since 1.0
 * * @version 1.0
 */

get_header(); ?>

<style>
</style>

<!-- PAGE CONTENT -->
<?php #get_template_part( 'template-parts/logo', 'top' ); ?>

<!-- <div class="content-container"> -->
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<!-- <div class="page-title-container"> -->
				<!-- <h1 class="page-title caps"> -->
					<!-- <?php #the_title(); ?> -->
					<?php #echo get_field('one_off_date'); ?>
				<!-- </h1> -->
			<!-- </div> -->
			<!-- <div class="content"> -->
				<?php the_content(); ?>
				<?php 
				?>
			<!-- </div> -->
		<?php endwhile; endif; ?>

<!-- </div>  -->
<!-- END CONTENT -->

<!-- MENU + SOCIAL LINKS -->
	<?php get_footer(); ?>

