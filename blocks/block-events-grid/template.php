<?php
/**
 * Block Name: BLOCK-events-grid
 *
 * This is the template that displays Events in grid.
 * @param   array $block The block settings and attributes.
 */
?>
<?php
    // $IS_LINKS_GRID = get_field('is_links_grid');

    $CLS_W = 'events-listing events-listing--grid';

    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;

    // Support custom id values.
    $block_id = '';
    if ( ! empty( $block['anchor'] ) ) :
        $block_id = esc_attr( $block['anchor'] );
    endif;
?>

<?php

$argType = get_field( 'loop_argument_type' );

$event_post_type = class_exists( 'EAB_Post_Types' ) ? EAB_Post_Types::POST_TYPE_EVENT  : 'eab_event';
$training_post_type = class_exists( 'EAB_Post_Types' ) ? EAB_Post_Types::POST_TYPE_TRAINING : 'eab_training';


if ( $argType === 'count' ) :
    $args = array(
        'post_type'      => array( $event_post_type, $training_post_type ),
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
        'posts_per_page' => get_field( 'items_count' ),
    );
else :
    $todisplay = get_field( 'select_items' );
    $args      = array(
        'post_type'      => array( $event_post_type, $training_post_type ),
        'post_status' => 'publish',
        'orderby'     => 'post__in',
        'post__in'    => is_array( $todisplay ) ? $todisplay : array(),
    );
endif;


    $the_query = new WP_Query( $args );

    if ( $the_query->have_posts() ) : 

        ?>
    <div data-theme="default"
        <?php
        echo wp_kses_data(
            get_block_wrapper_attributes(
                array(
                    'id'    => $block_id,
                    'class' => esc_attr( $classes ),
                )
            )
        );
        ?>
    >
    <?php if(get_field('section_title')) : ?>
        <header class="events-listing__header">
            <h5 class="section-headline caps events-listing__title"><?php echo get_field('section_title'); ?></h5>
        </header>
    <?php endif; ?>
        
        <div class="events-grid">
                        
        <?php 
            while ( $the_query->have_posts() ) : $the_query->the_post();
            $POST_ID = get_the_ID();
            $POST_TITLE = get_the_title();
            $EVT_SCHEDULE = class_exists( 'EAB_Event' ) ?EAB_Event::get_schedule_summary($POST_ID) : '';
        ?>
        <div class="events-card events-card--grid" data-post-id="<?php echo $POST_ID; ?>">
            <div class="events-card__header">
                <h3 class="events-card__title"><?php echo $POST_TITLE; ?></h3>
                <time class="events-card__date"><?php echo $EVT_SCHEDULE; ?></time>
                <!-- <p class="events-card__price">6&nbsp;100 Kč</p> -->
                <span class="icon icon-circ icon-arrow"></span>
            </div>
            <div class="events-card__media">
                <?php the_post_thumbnail( 'full', array( 'title' => $POST_TITLE, 'alt' => $POST_TITLE, 'class' => 'events-card__img lazyload', 'decoding' => 'async', 'loading' => 'lazy' ) ); ?>
            </div>
            <a class="events-card__link abs-link" href="<?php the_permalink(); ?>"> </a>
        </div>
        <?php
            endwhile;
            wp_reset_postdata();
        ?>
        </div>
        <?php if(get_field('has_cta')) : ?>
            <?php if(get_field('cta_title')) : ?>
                <div class="section-row section-row--headline">
                    <h4 class="taC"><?php echo get_field('cta_title'); ?></h4>
                </div>
            <?php endif; ?>
            <div class="section-row section-row--cta">
                <a href="<?php echo get_field('cta_url'); ?>" class="btn btn-oval btn-outline caps hover-bgr hover-bgr--ochre"><?php echo get_field('cta_label'); ?></a>
            </div>
        <?php endif; ?>
    </div>

<?php else: ?>
    <p><?php esc_html_e( 'Sorry, there are no items to display', 'annav_theme' ); ?></p>
<?php endif;  ?>
                    