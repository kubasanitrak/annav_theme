<?php
/**
 * Block Name: BLOCK-team
 *
 * This is the template that displays News in list.
 * @param   array $block The block settings and attributes.
 */
?>
<?php
    // $IS_LINKS_GRID = get_field('is_links_grid');

    $CLS_W = 'section section-team pad-T-1 pad-B-5';

    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;

    // Support custom id values.
    $block_id = '';
    if ( ! empty( $block['anchor'] ) ) :
        $block_id = esc_attr( $block['anchor'] );
    endif;
?>

<?php
$argType = get_field( 'loop_argument_type' );

if ( $argType === 'count' ) :
    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
        'posts_per_page' => get_field( 'items_count' ),
    );
else :
    $todisplay = get_field( 'select_items' );
    $args      = array(
        'post_type'   => 'any',
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
        <h5 class="section-headline team-list--headline caps">
            <?php echo get_field('section_title'); ?>
        </h5>
    <?php endif; ?>
        
        <div class="team-list-container">
                        
            <?php 
                while ( $the_query->have_posts() ) : $the_query->the_post();
                $POST_ID = get_the_ID();
                $POST_TITLE = get_the_title();
            ?>
            <div class="team-list">
                <div class="team-list--item team-list--item_img border-T">
                    <h3 class="team-list--item_title "><?php echo $POST_TITLE; ?></h3>
                    <?php the_post_thumbnail( 'full', array( 'class' => 'lazyload' ) ); ?>
                </div>
                <div class="team-list--item team-list--item_caption">
                    <h3 class="team-list--item_title "><?php echo $POST_TITLE; ?></h3>
                    <div class="team-list--item_row">
                        <h5 class="section-headline caps border-B"><?php echo get_field('instructor_shortdesc', $POST_ID ); ?></h5>
                        <?php the_content(); ?>
                    </div>
                    <?php 
                        $CONTACT_MAIL = get_field('instructor_email', $POST_ID );
                        $CONTACT_PHONE = get_field('instructor_phone', $POST_ID );
                        if($CONTACT_MAIL || $CONTACT_PHONE) :
                    ?>
                        <div class="team-list--item_row">
                            <h5 class="section-headline caps border-B"><?php _e('Kontakt', 'annav_theme' ); ?></h5>
                            <p class="plain"><a class="hover-underline" href="mailto:<?php echo $CONTACT_MAIL; ?>"><?php echo $CONTACT_MAIL; ?></a></p>
                            <p class="plain"><a class="hover-underline" href="tel:<?php echo $CONTACT_PHONE; ?>"><?php echo $CONTACT_PHONE; ?></a></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            ?>
        </div>
    </div>

<?php else: ?>
    <p><?php esc_html_e( 'Sorry, there are no items to display', 'annav_theme' ); ?></p>
<?php endif;  ?>
                    