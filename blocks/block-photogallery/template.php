<?php
/**
 * Block Name: BLOCK-photogallery
 *
 * This is the template that displays the featured news block.
 * @param   array $block The block settings and attributes.
 */
?>

<?php
    $UNIQ_ID = 'kami-' . $block['id'];

    $IMG_GALLERY = get_field('gallery');
    $size = 'medium'; // (thumbnail, medium, large, full or custom size)
    $CLS_W = "section ps-gallery";
    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;
        
    // Check value exists.
    if( $IMG_GALLERY ) :

?>
<div 
    <?php
        echo wp_kses_data(
            get_block_wrapper_attributes(
                array(
                    'id'    => $UNIQ_ID,
                    'class' => esc_attr( $classes ),
                )
            )
        );
    ?>
>
	

    <?php
        
        foreach( $IMG_GALLERY as $imgOBJ_Single ) :

            // $imgOBJ_Single = get_field( 'gallery_single_img' );
            $IMG_ID_Single = $imgOBJ_Single['ID'];
            $img_src = wp_get_attachment_image_url( $IMG_ID_Single, $size );

            $img_W = $imgOBJ_Single['sizes'][ $size . '-width' ];
            $img_H = $imgOBJ_Single['sizes'][ $size . '-height' ];
            $style = "--ratio: " . $img_W . "/" . $img_H;

            $ratio = $img_W / $img_H;
            $is_portrait = ($ratio < 1) ? 'is-portrait' : '';

            $img_lightbox_src = wp_get_attachment_image_url( $IMG_ID_Single, 'full' );
            $img_srcset = wp_get_attachment_image_srcset( $IMG_ID_Single, 'full' );
        ?>
        <div class="ps-gallery--item <?php echo $is_portrait; ?>" style="<?php echo esc_attr( $style ); ?>">         
            <img class="lazyload lightbox" data-gallery="<?php echo esc_attr( $img_lightbox_src ); ?>" data-sizes="auto" data-srcset="<?php echo esc_attr( $img_srcset ); ?>" data-src="<?php echo esc_url( $img_src ); ?>" alt="">
        </div>
            
    <?php 
        endforeach;
    ?>

    </div> <!-- END CLASS ps-gallery -->

<?php endif; ?>