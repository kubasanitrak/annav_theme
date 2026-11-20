<?php
/**
 * Block Name: BLOCK-custom-section
 * Section Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 */

    $IS_IMG           = get_field( 'is_img' );
    $IS_FULL_W        = get_field( 'is_full_width' );
    $IS_COLS          = get_field( 'has_cols' );
    $COLS_ALIGN       = get_field( 'cols_align' );
    $COLS_V_ALIGN     = get_field( 'cols_v_align' ) ?: 'ai_stretch';
    $COLS_MIN_HEIGHT  = get_field( 'cols_min_height' );
    $ANIMATE_ON_SCROLL = get_field( 'animate_on_scroll' );
    $BGR_COLOR        = get_field( 'section_bgr' );

    $CLS_W = 'section';
    if ( $IS_COLS ) :
        $CLS_W .= ' section-split-cols';
    endif;

    if ( $IS_FULL_W || $IS_COLS ) :
        $CLS_W .= ' section-full-width';
    else :
        $CLS_W .= ' section-padded';
    endif;

    if ( $IS_IMG ) :
        $CLS_W .= ' section-img';
    endif;

    if ( $COLS_ALIGN ) :
        $CLS_W .= ' ' . $COLS_ALIGN;
    endif;

    if ( $IS_COLS && $COLS_V_ALIGN ) :
        $allowed_v = array( 'ai_stretch', 'ai_start', 'ai_center', 'ai_end' );
        if ( in_array( $COLS_V_ALIGN, $allowed_v, true ) ) :
            $CLS_W .= ' ' . $COLS_V_ALIGN;
        endif;
    endif;

    if ( $IS_COLS && $COLS_MIN_HEIGHT ) :
        $allowed_minh = array( 'minh_50', 'minh_75', 'minh_100' );
        if ( in_array( $COLS_MIN_HEIGHT, $allowed_minh, true ) ) :
            $CLS_W .= ' ' . $COLS_MIN_HEIGHT;
        endif;
    endif;

    if ( $ANIMATE_ON_SCROLL ) :
        $CLS_W .= ' scroll-trigger';
        $CLS_W .= ' scroll-trigger--';
        $CLS_W .= get_field( 'animation_type' );
    endif;

    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;

    $DATA_THEME = 'default';
    if ( $BGR_COLOR ) :
        $DATA_THEME = $BGR_COLOR;
    endif;

    $block_id = esc_attr( get_field( 'id' ) ) ? esc_attr( get_field( 'id' ) ) : '';
?>

<div data-theme="<?php echo esc_attr( $DATA_THEME ); ?>"
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
    <InnerBlocks/>
</div>
