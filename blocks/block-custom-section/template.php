<?php
/**
 * Block Name: BLOCK-custom-section
 * Section Content Block Template.
 * 
 * @param   array $block The block settings and attributes.
 */

    // Create class attribute allowing for custom "className" values.
    
    $IS_IMG = get_field('is_img');
    $IMG_ID = get_field('custom_img_id');

    // $IS_COLUMN_CONTAINER = get_field('is_column_container');
    $IS_FULL_W = get_field('is_full_width');
    $IS_COLS = get_field('is_cols');
    // $HAS_SPLIT = get_field('is_split_screen');
    $ANIMATE_ON_SCROLL = get_field('animate_on_scroll');
    $BGR_COLOR = get_field('section_bgr');

    $CLS_W = '';
    $CLS_W = 'section';
    if($IS_COLS) :
        $CLS_W .= ' section-split-cols';
        $CLS_W .= get_field('cols-align') ? get_field('cols-align') : '';
    endif;

    if($IS_FULL_W && !$IS_COLS) :
        $CLS_W .= ' section-full-width';
    else :
        $CLS_W .= ' section-padded';
    endif;
    
    if($IS_IMG) :
        $CLS_W .= ' section-img';
    endif;

    // scroll-trigger--news, scroll-trigger--morph, scroll-trigger--contact, scroll-trigger--faq
    if($ANIMATE_ON_SCROLL) :
        $CLS_W .= ' scroll-trigger';
        $CLS_W .= ' scroll-trigger--';
        $CLS_W .= get_field('animation_type');
    endif;

    // Create class attribute allowing for custom "className" values.
    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;

    $DATA_THEME = 'default';

    if($BGR_COLOR) :
        $DATA_THEME = $BGR_COLOR;
    endif;

    // Support custom id values.
    //*/
    $block_id = esc_attr( get_field( 'id' ) ) ? esc_attr( get_field( 'id' ) ) : '';

?>
    


<?php #if ( ! $is_preview ) { ?>

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
<?php #} ?>

    <?php #if(!$IS_IMG) : ?>
        
        <InnerBlocks/>

    <?php #else : ?>

        <?php
            #$img_src = wp_get_attachment_image_url( $IMG_ID, 'medium' );
            #$img_srcset = wp_get_attachment_image_srcset( $IMG_ID, 'full' );
        ?>
        <!-- <img class="lazyload" data-srcset="<?php #echo esc_attr( $img_srcset ); ?>" data-src="<?php #echo esc_url( $img_src ); ?>" data-sizes="auto" alt=""> -->

    <?php #endif; ?>

    
<!-- TODO ALLOWED INNER BLOCKS IF IS_COLUMNS -->
   

<?php #if ( ! $is_preview ) { ?>
    
    </div>
<?php #} ?>

<?php 
/*
transparent : Transparent
dark : Dark
default : Light

paralax : paralax
clip : clip_path

cols-align:
jc_start : Left
jc_center : Center
jc_space_between : Space Between
*/
 ?>