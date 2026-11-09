<?php
/**
 * Block Name: BLOCK-section
 * Section Content Block Template.
 * 
 * @param   array $block The block settings and attributes.
 */

    // Create class attribute allowing for custom "className" values.
    
    $BGR_COLOR = get_field('section_bgr');
    
    $IS_FULL_H = get_field('is_full_height');
    $IS_FULL_W = get_field('is_full_width');
    $IS_HEADER = get_field('is_header');
    
    $HAS_SPLIT = get_field('has_split_cols');
    // $ANIMATE_ON_SCROLL = get_field('animate_on_scroll');
    

    $CLS_W = 'section';

    if($IS_HEADER) :
        $CLS_W .= ' section-header';
    endif;

    if($IS_FULL_W) :
        $CLS_W .= ' full-bleed';
    endif;

    if($HAS_SPLIT) :
        $CLS_W .= ' split-cols';
    endif;

    if($IS_FULL_H) :
        $CLS_W .= ' full-H';
    endif;

    // Create class attribute allowing for custom "className" values.
    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;

    $DATA_THEME = 'default';

    if($BGR_COLOR) :
        // $DATA_THEME = "";
        $DATA_THEME = $BGR_COLOR;
    endif;

    // Support custom id values.
    
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

        <InnerBlocks/>

        <?php if(get_field('has_cta')) : ?>
            <div class="section-row section-row--cta">
                <a href="<?php echo get_field('cta_url'); ?>" class="btn btn-oval btn-outline caps hover-bgr hover-bgr--ochre"><?php echo get_field('cta_label'); ?></a>
            </div>
        <?php endif; ?>

<?php if ( ! $is_preview ) : ?>
    </div>
<?php endif; ?>
    
<!-- 
default : Normal
ochre : Ochre
silky-blue : Sky blue
dark-green : Dark green
blue : Blue

h4 : větší
h5 : střední
plain : menší
 -->






