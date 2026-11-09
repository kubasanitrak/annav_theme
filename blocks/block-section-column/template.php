<?php
/**
 * Block Name: BLOCK-section-column
 *
 * This is the template that displays the featured news block.
 * @param   array $block The block settings and attributes.
 */
?>
<?php

// split-cols--item 
// carousel-item carousel-item--img_container
// split-cols--item split-cols--item_img
// split-cols--img
// split-cols--item split-cols--item_caption
// split-cols--item split-cols--item_header pad-Block pad-Inline
    $CLS_W = 'split-cols--item ';

    $SHOW_ARR_DOWN = get_field('display_scroll_down_arr');

    $IS_IMG = get_field('is_img');

    $IS_CLIPPATH = get_field('is_clippath');
    if($IS_CLIPPATH) :
        $CLS_W .= ' ';
        $CLS_W .= 'split-cols--item_header pad-Block pad-Inline';
    endif;

    $img_L_count = 0;
    $IMGS = get_field('column_img');
    if (is_array($IMGS)) :
      $img_L_count = count($IMGS);
    endif;

    if($img_L_count > 1) :
        $CLS_W .= ' ';
        $CLS_W .= 'carousel';
    endif;
    
    if(!$IS_IMG) :
        $CLS_W .= ' ';
        // $CLS_W .= 'split-cols--item_caption';
    endif;
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

    <?php
        // IMG OR CAROUSEL
        if($IS_IMG) :
            $count = null;
            // $IMGS = get_field('column_img');
            // if (is_array($IMGS)) :
              // $count = count($IMGS);
            // endif;

            // if($count > 1) :
                // CAROUSEL CLASS
                // $CLS .= ' ';
            // endif;

            if( $IMGS ) :

        ?>
            <?php if($img_L_count > 1) : ?>
                <!-- <div class="carousel-item carousel-item--img_container" id=""> -->
            <?php endif; ?>
                <?php
                    $min_ratio = null;
                    if ($img_L_count > 1) :
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

                        if ($img_L_count > 1) :
                            $style = "--img-aspect-ratio: " . $min_ratio;
                    ?>
                            <div class="carousel-item carousel-item--img_container" style="<?php echo esc_attr($style); ?>">
                                <img class="lazyload" 
                                    data-srcset="<?php echo esc_attr($img_srcset); ?>" 
                                    data-src="<?php echo esc_url($img_src); ?>" 
                                    data-sizes="auto" alt="">
                            </div>
                    <?php
                        else :
                            if($IS_CLIPPATH) :
                    ?>
                                <div class="split-cols--item_img-container">
                    <?php
                            else :
                    ?>
                                <div class="split-cols--img">
                    <?php
                            endif;
                    ?>
                                <!-- <div class="split-cols--img"> -->
                                <img class="lazyload" 
                                    data-srcset="<?php echo esc_attr($img_srcset); ?>" 
                                    data-src="<?php echo esc_url($img_src); ?>" 
                                    data-sizes="auto" alt="">
                            </div>
                    <?php
                        endif;
                    endforeach;
                    ?>
                <?php if($img_L_count > 1) : ?>
                    <!-- </div>  -->
                    <!-- END CAROUSEL-IMG -->
                <?php endif; ?>
            <?php
                endif;
            ?>
    <?php 
        else :
        // CLAIM AND OR HEADLINE
    ?>

        <h1 class="section-header--title">
            <?php echo get_field('content_title'); ?>
        </h1>

        <p class="section-header--subtitle border-T <?php echo get_field('content_subtitle_size') ?>">
            <?php echo get_field('content_subtitle'); ?>
        </p>

        <?php 
            if($SHOW_ARR_DOWN) :
        ?>
            <a href="#" class="link-icon link-icon--arrow scroll-down"></a>
        <?php 
            endif;
        ?>
    <?php 
        endif;
    ?>
    
</div>
<?php
    if ($img_L_count > 1) :
?>
<script>
(function(){
    const initializeBlock = function (block) {
        const _carousel = block;
        // Initialize Flickity with options
        new Flickity(_carousel, {
            wrapAround: true,
            prevNextButtons: false,
            pageDots: true,
            cellAlign: 'left',
        });
    };

    // Initialize each block on page load (front end).
    document.addEventListener('DOMContentLoaded', () => {
        let _selector = '.carousel';
        // const flickityBlocks = document.querySelectorAll('.carousel');
        const flickityBlocks = document.querySelectorAll(_selector);
        flickityBlocks.forEach(block => {
            initializeBlock(block);
        });
    });

    // Initialize dynamic block preview (editor).
    if (window.acf) {
        window.acf.addAction('render_block_preview/type=flickity', initializeBlock);
    }
})();
</script>
<?php 
    endif;
?>