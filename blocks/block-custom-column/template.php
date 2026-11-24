<?php
/**
 * Block Name: BLOCK-custom-column
 *
 * This is the template that displays the featured news block.
 * @param   array $block The block settings and attributes.
 */

    $CLS_W = 'split-cols--item';

    $IS_IMG = get_field( 'is_img' );

    $isFullWidth = get_field( 'is_full_width' );
    $customWidth = get_field( 'width_perc' );
    $vAlign      = get_field( 'v_align' ) ?: 'top';
    $insetTop    = (int) get_field( 'inset_top' );
    $insetRight  = (int) get_field( 'inset_right' );
    $insetBottom = (int) get_field( 'inset_bottom' );
    $insetLeft   = (int) get_field( 'inset_left' );

    if ( $isFullWidth ) :
        $CLS_W .= ' split-cols--item--width_100';
    elseif ( ! empty( $customWidth ) ) :
        $CLS_W .= ' split-cols--item--width_' . intval( $customWidth );
    endif;

    $vAlign = in_array( $vAlign, array( 'top', 'center', 'bottom' ), true ) ? $vAlign : 'top';
    $CLS_W .= ' v_align-' . $vAlign;

    if ( $insetTop || $insetRight || $insetBottom || $insetLeft ) :
        $CLS_W .= ' has-insets';
    endif;

    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;

    $block_id = '';
    if ( ! empty( $block['anchor'] ) ) :
        $block_id = esc_attr( $block['anchor'] );
    endif;

    $inline_style = sprintf(
        '--inset-t:%d%%;--inset-r:%d%%;--inset-b:%d%%;--inset-l:%d%%;',
        $insetTop,
        $insetRight,
        $insetBottom,
        $insetLeft
    );
?>

<div
    <?php
        echo wp_kses_data(
            get_block_wrapper_attributes(
                array(
                    'id'    => $block_id,
                    'class' => esc_attr( $classes ),
                    'style' => $inline_style,
                )
            )
        );
    ?>
>

    <?php
        if ( $IS_IMG ) :
            $count = null;
            $IMGS  = get_field( 'column_img' );
            if ( is_array( $IMGS ) ) :
                $count = count( $IMGS );
            endif;

            if ( $IMGS ) :
    ?>
            <?php if ( $count > 1 ) : ?>
                <div class="split-cols--item---inner carousel-img">
            <?php else : ?>
                <div class="split-cols--item---inner">
            <?php endif; ?>
                <?php
                    $min_ratio = null;
                    if ( $count > 1 ) :
                        $ratio_arr = array();
                        foreach ( $IMGS as $row ) :
                            $imgOBJ = $row['column_img_item'];
                            $size   = 'large';
                            $img_W  = $imgOBJ['sizes'][ $size . '-width' ];
                            $img_H  = $imgOBJ['sizes'][ $size . '-height' ];
                            $ratio_arr[] = $img_H / $img_W;
                        endforeach;
                        $min_ratio = min( $ratio_arr );
                    endif;

                    foreach ( $IMGS as $row ) :
                        $imgOBJ = $row['column_img_item'];
                        if ( empty( $imgOBJ ) ) {
                            break;
                        }
                        $image_ID = $imgOBJ['ID'];

                        $img_src    = wp_get_attachment_image_url( $image_ID, 'medium' );
                        $img_srcset = wp_get_attachment_image_srcset( $image_ID, 'full' );

                        $itemCAPTION  = $row['img_caption'];
                        $itemCAPTION2 = $row['img_caption2'];

                        if ( $count > 1 ) :
                            $style = '--img-aspect-ratio: ' . $min_ratio;
                ?>
                            <div class="carousel-cell carousel-img--item" style="<?php echo esc_attr( $style ); ?>">
                                <img class="carousel-img--item_img lazyload"
                                    data-srcset="<?php echo esc_attr( $img_srcset ); ?>"
                                    data-src="<?php echo esc_url( $img_src ); ?>"
                                    data-sizes="auto" alt="">
                <?php else : ?>
                        <div class="split-cols--item---img_container">
                            <img class="lazyload"
                                data-srcset="<?php echo esc_attr( $img_srcset ); ?>"
                                data-src="<?php echo esc_url( $img_src ); ?>"
                                data-sizes="auto" alt="">
                <?php endif; ?>
                <?php if ( $itemCAPTION || $itemCAPTION2 ) : ?>
                                <div class="split-cols--item---caption">
                                    <?php if ( $itemCAPTION ) : ?>
                                        <p class="plain split-cols--item---caption_txt"><?php echo esc_html( $itemCAPTION ); ?></p>
                                    <?php endif; ?>
                                    <?php if ( $itemCAPTION2 ) : ?>
                                        <p class="plain split-cols--item---caption_txt"><?php echo esc_html( $itemCAPTION2 ); ?></p>
                                    <?php endif; ?>
                                </div>
                <?php endif; ?>
                            </div>
                <?php
                    endforeach;
                ?>
                </div>
            <?php
            endif;
            ?>
    <?php else : ?>
            <div class="split-cols--item---inner">
                <InnerBlocks/>
            </div>
    <?php endif; ?>

</div>
