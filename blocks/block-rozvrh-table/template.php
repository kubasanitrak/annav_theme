<?php
/**
 * Block Name: BLOCK-rozvrh-table
 * 
 * @param   array $block The block settings and attributes.
 * 
 */
?>

<?php
// Create class attribute allowing for custom "className" values.
    $CLS_W = 'customtable';
    
    // Create class attribute allowing for custom "className" values.
    $classes = ( ! empty( $block['className'] ) ) ? sprintf( $CLS_W . ' %s', $block['className'] ) : $CLS_W;
    
?>
    <div class="<?php echo esc_attr($classes); ?>">
        
        <?php if(get_field("timetable_label")): ?>
            <div class="customtable-header"><p class="strong"><?php echo get_field("timetable_label"); ?></p></div>
        <?php endif; ?>

    <?php
        if( have_rows('timetable') ):
        $TEMP_MARKUP = "";
    ?>
    <?php
        // Loop through rows.
        while( have_rows('timetable') ) : 
            the_row();
            
            $TEMP_MARKUP .= '<div class="customtable-row mar-T-0">';
            $TEMP_MARKUP .= '<div class="customtable-col customtable-col_TIME">';
            $TEMP_MARKUP .= get_sub_field('timetable_time');
            $TEMP_MARKUP .= '</div>';
            $TEMP_MARKUP .= '<div class="customtable-col customtable-col_COURSE">';
            $TEMP_MARKUP .= get_sub_field('timetable_item');
            $TEMP_MARKUP .= '</div>';
            $TEMP_MARKUP .= '</div><!-- END ROW -->';

        // End loop.
        endwhile;
        print $TEMP_MARKUP;
    ?>
    <?php
        endif;
    ?>
    </div>