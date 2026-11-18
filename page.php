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

		<?php if(!is_front_page()) : ?>

			<?php if($PADDED_CONTENT) : ?>
				<div data-theme="default" class="section pad-T pad-B-3 section-nowrapper" >
				<?php else: ?>
				<div data-theme="default" class="section section-content header-trigger" >
			<?php endif; ?>
		<?php endif; ?>

			<?php the_content(); ?>

				<div data-theme="default" class="section section-feature section-padded" >
					<div class="custom-row custom-row--cols">
						<div class="custom-row--col custom-row--col_title">
							<h2 class="">Architectural space planning</h2>
						</div>
						<div class="custom-row--col custom-row--col_caption">
							<p class="plain muted">Spatial flows, volumes and bespoke layouts — resolved before a single finish is chosen.</p>
						</div>
					</div>
					<div class="custom-row custom-row--cols">
						<div class="custom-row--col custom-row--col_title">
							<h2 class="">Material & textile curation</h2>
						</div>
						<div class="custom-row--col custom-row--col_caption">
							<p class="plain muted">Rare stone, distinctive timber, hand-finished plasters and couture fabrics, sourced for each home.</p>
						</div>
					</div>
					<div class="custom-row custom-row--cols">
						<div class="custom-row--col custom-row--col_title">
							<h2 class="">Full turnkey execution</h2>
						</div>
						<div class="custom-row--col custom-row--col_caption">
							<p class="plain muted">From first sketch to final walkthrough — craftsmen, contractors and every seam, overseen by the studio.</p>
						</div>
					</div>
				</div>

				<div data-theme="default" class="section section-project-list section-padded" >
					<div class="project-list--header">
						<div class="project-list--label">Projects</div>
						<div class="project-list--label muted">Archive</div>
					</div>
					<div class="project-list--content">
						<h3 class="taC"><a href="#">Prague Playoffs 2021</a></h3>
						<h3 class="taC"><a href="#">First Republic-era villa</a></h3>
						<h3 class="taC"><a href="#">Interior of a House in Central America</a></h3>
						<h3 class="taC"><a href="#">Šárka Residence</a></h3>
						<h3 class="taC"><a href="#">Rich Beige Concrete Stone</a></h3>
					</div>
				</div>

		<?php #if($PADDED_CONTENT) : ?>
			</div>
		<?php #endif; ?>
		
	<?php endwhile; endif; ?>


	<?php get_footer(); ?>

