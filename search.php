<?php get_header(); ?>
<section id="content" role="main">
	<?php if ( have_posts() ) : ?>
		<header class="header">
			<h1 class="entry-title"><?php printf( esc_html__( 'Search Results for: %s', 'annav_theme' ), esc_html( get_search_query() ) ); ?></h1>
		</header>

		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
				</div>
			</article>
		<?php endwhile; ?>

		<?php the_posts_navigation(); ?>
	<?php else : ?>
		<article id="post-0" class="post no-results not-found">
			<header class="header">
				<h2 class="entry-title"><?php esc_html_e( 'Nothing Found', 'annav_theme' ); ?></h2>
			</header>
			<section class="entry-content">
				<p><?php esc_html_e( 'Sorry, nothing matched your search. Please try again.', 'annav_theme' ); ?></p>
				<?php get_search_form(); ?>
			</section>
		</article>
	<?php endif; ?>
</section>
<?php get_footer(); ?>