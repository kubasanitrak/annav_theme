<?php
/**
 * Block Name: BLOCK-faq
 * 
 * @param   array $block The block settings and attributes.
 * 
 */

    $BGR_COLOR = get_field('section_bgr');
    // Create class attribute allowing for custom "className" values.
    $CLS_W = 'section faq-item--container pad-T-1 pad-B-5';


    
    // Create class attribute allowing for custom "className" values.
    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;
    
    //*/
    $DATA_THEME = $BGR_COLOR ? $BGR_COLOR : 'default';
    /*/
    $DATA_THEME = 'default';
    if($BGR_COLOR) :
        $DATA_THEME = $BGR_COLOR;
    endif;
    //*/

    $block_id = $block['id'];
    if ( ! empty( $block['anchor'] ) ) :
        $block_id = esc_attr( $block['anchor'] );
    endif;
    
?>
<?php if ( ! $is_preview ) : ?>

<div data-theme="<?php echo $DATA_THEME ?>"
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
<?php endif; ?>

    <?php if(get_field('section_title')) : ?>
        <h5 class="section-headline caps border-B">
            <?php echo get_field('section_title'); ?>
        </h5>
    <?php endif; ?>

    <?php
        if( have_rows('faq_rows') ):
        $TEMP_MARKUP = "";
    ?>
    <?php
            
            // Loop through REPEATER rows.
            while( have_rows('faq_rows') ) : 
                the_row();
                
                $TEMP_MARKUP .= '<div class="faq-item">';
                $TEMP_MARKUP .= '<h2 class="faq-item--title">';
                $TEMP_MARKUP .= get_sub_field('faq_item_title');
                $TEMP_MARKUP .= '</h2>';
                if( get_sub_field('faq_item_caption') ) :
                    $TEMP_MARKUP .= '<p class="faq-item--caption">';
                    $TEMP_MARKUP .= get_sub_field('faq_item_caption');
                    $TEMP_MARKUP .= '</p>';
                endif;
                $TEMP_MARKUP .= '</div><!-- END ROW -->';
            // End loop.
            endwhile;
            print $TEMP_MARKUP;
        ?>
    <?php
        endif;
    ?>

<?php if ( ! $is_preview ) : ?>
    </div>
<?php endif; ?>