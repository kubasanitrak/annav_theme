<?php
/**
 * Block Name: BLOCK-columns
 *
 * This is the template that displays the featured news block.
 * @param   array $block The block settings and attributes.
 */

?>
<?php
    $CLS_W = 'split-cols';
    $IMG_ID = get_field('custom_img_id');   

    // Create class attribute allowing for custom "className" values.
    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;

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
    <div class="split-cols--item split-cols--item_img">
        <?php
            $img_src = wp_get_attachment_image_url( $IMG_ID, 'medium' );
            $img_srcset = wp_get_attachment_image_srcset( $IMG_ID, 'full' );
        ?>
        <div class="split-cols--img">
            <img decoding="async" class="lazyload" data-srcset="<?php echo esc_attr( $img_srcset ); ?>" data-src="<?php echo esc_url( $img_src ); ?>" data-sizes="" alt="" loading="lazy">
        </div>
    </div>
    <div class="split-cols--item split-cols--item_caption">
        <InnerBlocks/>
    </div>
</div>
