<?php
/**
 * Block Name: BLOCK-custom-site-header
 *
 * This is the template that displays the featured news block.
 * @param   array $block The block settings and attributes.
 */
?>
<?php
// IMG
    $IMG_PORT = get_field('header_img_port');
    $IMG_LAND = get_field('header_img_land');
    // $VIDEO_PORTRAIT = str_replace(".mp4", "", get_field( 'video_port_url' ));


// VIDEO
    $LOOP_VIDEO = get_field('video_loop');

    $CLS_W = 'section section-header_bgr scroll-trigger full-width';

    $RAND_INDEX = 0;
    $video_count = 0;

    $VIDEOS = get_field('header_video');
    if (is_array($VIDEOS)) :
      $video_count = count($VIDEOS);
    endif;

    if($video_count > 1) :
        $CLS_W .= ' ';
        $CLS_W .= 'random-shuffle';
        $RAND_INDEX = rand(0, count($VIDEOS) - 1);
    endif;

    if(!empty($VIDEOS)) :
        foreach( $VIDEOS as $key=>$video ) :
            if($key === $RAND_INDEX) :
                $VIDEOSRC = $video['videoname'];
                $image_ID = $video['videoposter_id'];
            endif;
        endforeach;
        $VIDEOPOSTER = wp_get_attachment_image_url( $image_ID, 'full' );
    endif;



// COMMON
    $DATA_THEME = get_field('color_theme') ? strval(get_field('color_theme')) : 'default';
    // Create class attribute allowing for custom "className" values.
    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;
    // $block_id = 'ps-' . $block['id'];
    $block_id = 'bgvidID';
?>
    
    <?php
        if( $VIDEOS ) :
    ?>


        <div class="<?php echo esc_attr( $classes ); ?>" data-anim="video" data-theme="<?php echo esc_attr( $DATA_THEME ); ?>">
            <?php
                $video_attrs = array(
                    'lazyload'  => '',
                    'playsinline' => '',
                    'autoplay'  => '',
                    'muted'     => '',
                    'loop'     => '',
                    'poster'    => esc_url( $VIDEOPOSTER ),
                    'id'        => esc_attr( $block_id ),
                    'class'     => 'playing web-video lazyload autoplay-anim inline-video',
                    'data-videosrc' => esc_url( str_replace( '.mp4', '', $VIDEOSRC['url'] ) ),
                    // 'data-videosrc_portrait' => esc_url( str_replace( '.mp4', '', $VIDEO_PORTRAIT['url'] ) ),
                );
                if ( $LOOP_VIDEO ) {
                    $video_attrs['loop'] = '';
                }
                echo '<video';
                foreach ( $video_attrs as $attr => $value ) {
                    if ( '' === $value ) {
                        echo ' ' . esc_attr( $attr );
                    } else {
                        echo ' ' . esc_attr( $attr ) . '="' . $value . '"';
                    }
                }
                echo '></video>';
            ?>
<?php
        else :
?>

        <div class="<?php echo esc_attr( $classes ); ?>" data-theme="<?php echo esc_attr( $DATA_THEME ); ?>">
    <?php
            $IS_LANDSCAPE = '';
            
            if($IMG_PORT) :
                $IS_LANDSCAPE = ' landscape-only ';
                $portrait_img_src = wp_get_attachment_image_url( $IMG_PORT, 'medium' );
                $portrait_img_srcset = wp_get_attachment_image_srcset( $IMG_PORT, 'full' );
    ?>
                <img class="full-bgr--img lazyload portrait-only" data-srcset="<?php echo esc_attr( $portrait_img_srcset ); ?>" data-src="<?php echo esc_url( $portrait_img_src ); ?>" data-sizes="auto" alt="">
    <?php
            endif;

            if($IMG_LAND) :
                $landscape_img_src = wp_get_attachment_image_url( $IMG_LAND, 'medium' );
                $landscape_img_srcset = wp_get_attachment_image_srcset( $IMG_LAND, 'full' );
    ?>
                <img class="full-bgr--img lazyload <?php echo esc_attr( $IS_LANDSCAPE ); ?>" data-srcset="<?php echo esc_attr( $landscape_img_srcset ); ?>" data-src="<?php echo esc_url( $landscape_img_src ); ?>" data-sizes="auto" alt="">
            
<?php 
            endif;
    endif;
?>

        <div class="header-ovrlay_content narrow">
            <InnerBlocks/>
        </div>
    </div>
