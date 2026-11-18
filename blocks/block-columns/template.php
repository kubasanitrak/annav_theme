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
        <!-- INNER BLOCKS RESTRICTED TO CUSTOM COLS ONLY -->
        <?php $allowed_blocks = [ 'acf/custom-column' ]; ?>
        <InnerBlocks/>
    </div>
</div>
