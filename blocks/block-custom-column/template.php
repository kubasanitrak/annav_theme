<?php
/**
 * Block Name: BLOCK-custom-column
 *
 * This is the template that displays the featured news block.
 * @param   array $block The block settings and attributes.
 */
?>
<?php
    $CLS_W = 'split-cols--item ';
    
    $WIDE_OR_NARROW = get_field('wide_or_narrow');
    $CLS_W .= ' ';
    $CLS_W .= 'split-cols--item_' . strval($WIDE_OR_NARROW);

    $IS_IMG = get_field('is_img');
    $IMG_ID = get_field('custom_img_id');
    
    // Create class attribute allowing for custom "className" values.
    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;

    $isFullWidth = get_field( 'is_full_width' );
    $customWidth = get_field( 'width_perc' );
    $class_name = 'carousel-img--item';
    if( ! empty( $customWidth ) ) :
        $class_name .= ' ' . 'carousel-img--item---width_' . $customWidth;
    endif;

    // Support custom id values.
    $block_id = '';
    if ( ! empty( $block['anchor'] ) ) :
        $block_id = esc_attr( $block['anchor'] );
    endif;
?>

<div
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

    <?php
        if($IS_IMG) :
            $count = null;
            $IMGS = get_field('column_img');
            if (is_array($IMGS)) :
              $count = count($IMGS);
            endif;

            if( $IMGS ) :

        ?>
            <?php if($count > 1) : ?>
                <div class="<?php echo $class_name; ?>" id="">
            <?php endif; ?>
                <?php
                    
                    $min_ratio = null;
                    if ($count > 1) :
                        $ratio_arr = [];
                        foreach ($IMGS as $row) :
                            $imgOBJ = $row['column_img_item'];
                            $size = 'large';
                            $img_W = $imgOBJ['sizes'][$size . '-width'];
                            $img_H = $imgOBJ['sizes'][$size . '-height'];
                            $ratio_arr[] = $img_H / $img_W;
                        endforeach;
                        $min_ratio = min($ratio_arr);
                    endif;

                    foreach ($IMGS as $row) :
                        $imgOBJ = $row['column_img_item'];
                        if(empty($imgOBJ)) break;
                        $image_ID = $imgOBJ['ID'];

                        $img_src = wp_get_attachment_image_url($image_ID, 'medium');
                        $img_srcset = wp_get_attachment_image_srcset($image_ID, 'full');

                        $itemCAPTION = get_sub_field('img_caption');
                        $itemCAPTION2 = get_sub_field('img_caption2');

                        if ($count > 1) :
                            $style = "--img-aspect-ratio: " . $min_ratio;
                    ?>
                            <div class="carousel-cell carousel-img--item" style="<?php echo esc_attr($style); ?>">
                                <img class="carousel-img--item_img lazyload" 
                                    data-srcset="<?php echo esc_attr($img_srcset); ?>" 
                                    data-src="<?php echo esc_url($img_src); ?>" 
                                    data-sizes="auto" alt="">
                                <div class="image-caption">
                                    <?php if($itemCAPTION) : ?>
                                        <p class="plain carousel-img--item_txt"><?php echo esc_attr( $itemCAPTION ); ?></p>
                                    <?php endif; ?>
                                    <?php if($itemCAPTION2) : ?>
                                        <p class="plain carousel-img--item_txt"><?php echo esc_attr( $itemCAPTION2 ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                    <?php
                        else :
                    ?>
                            <img class="lazyload" 
                                data-srcset="<?php echo esc_attr($img_srcset); ?>" 
                                data-src="<?php echo esc_url($img_src); ?>" 
                                data-sizes="auto" alt="">
                    <?php
                        endif;
                    endforeach;
                    ?>
                <?php if($count > 1) : ?>

                    </div> <!-- END CAROUSEL-IMG -->
                <?php endif; ?>
            <?php
                endif;
            ?>
    <?php 
        else :
    ?>
            <InnerBlocks/>
    <?php 
        endif;
    ?>
    
    </div>