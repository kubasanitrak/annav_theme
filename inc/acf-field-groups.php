<?php
/**
 * Local PHP registration for custom section / column field groups.
 * Keeps positioning fields available even before ACF JSON sync.
 */

add_action( 'acf/init', 'annav_register_acf_field_groups', 5 );
function annav_register_acf_field_groups() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	// Prefer DB / acf-json copies; PHP is a fallback for empty environments.
	$col  = function_exists( 'acf_get_field_group' ) ? acf_get_field_group( 'group_68b2964c11848' ) : null;
	$sec  = function_exists( 'acf_get_field_group' ) ? acf_get_field_group( 'group_69d688404780e' ) : null;
	if ( $col && $sec ) {
		return;
	}

	acf_add_local_field_group(
		array(
			'key'                   => 'group_68b2964c11848',
			'title'                 => 'BLOCK custom column',
			'fields'                => array(
				array(
					'key'           => 'field_6afc8b741284a',
					'label'         => 'Obrázek ?',
					'name'          => 'is_img',
					'type'          => 'true_false',
					'default_value' => 0,
					'ui'            => 0,
				),
				array(
					'key'           => 'field_69d6886b4b661',
					'label'         => 'Is Full widht ?',
					'name'          => 'is_full_width',
					'type'          => 'true_false',
					'default_value' => 0,
					'ui'            => 0,
				),
				array(
					'key'               => 'field_68668dc6f70f2',
					'label'             => 'Img',
					'name'              => 'column_img',
					'type'              => 'repeater',
					'layout'            => 'table',
					'button_label'      => 'Přidat obrázek',
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_6afc8b741284a',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
					'sub_fields'        => array(
						array(
							'key'           => 'field_68668dc6f70f3',
							'label'         => 'Obrázek',
							'name'          => 'column_img_item',
							'type'          => 'image',
							'return_format' => 'array',
							'preview_size'  => 'thumbnail',
							'library'       => 'all',
						),
						array(
							'key'  => 'field_6afc8a8167335',
							'label'=> 'Popiska',
							'name' => 'img_caption',
							'type' => 'text',
						),
						array(
							'key'  => 'field_6afc8a9367336',
							'label'=> 'Popiska 2. řádek',
							'name' => 'img_caption2',
							'type' => 'text',
						),
					),
				),
				array(
					'key'               => 'field_6476668d4c5c5',
					'label'             => 'Šířka v %',
					'name'              => 'width_perc',
					'type'              => 'range',
					'required'          => 1,
					'default_value'     => 50,
					'min'               => 10,
					'max'               => 100,
					'step'              => 5,
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_69d6886b4b661',
								'operator' => '!=',
								'value'    => '1',
							),
						),
					),
				),
				array(
					'key'           => 'field_691e0a01valign',
					'label'         => 'Vertical Align',
					'name'          => 'v_align',
					'type'          => 'select',
					'instructions'  => 'Positions the column within the section row height.',
					'choices'       => array(
						'top'    => 'Top',
						'center' => 'Center',
						'bottom' => 'Bottom',
					),
					'default_value' => 'top',
					'return_format' => 'value',
					'ui'            => 1,
					'wrapper'       => array(
						'width' => '50',
					),
				),
				array(
					'key'           => 'field_691e0a02inst',
					'label'         => 'Inset Top',
					'name'          => 'inset_top',
					'type'          => 'range',
					'instructions'  => 'Empty space inside the column (padding). Caption stays with the image.',
					'default_value' => 0,
					'min'           => 0,
					'max'           => 40,
					'step'          => 1,
					'append'        => '%',
					'wrapper'       => array(
						'width' => '25',
					),
				),
				array(
					'key'           => 'field_691e0a03insr',
					'label'         => 'Inset Right',
					'name'          => 'inset_right',
					'type'          => 'range',
					'default_value' => 0,
					'min'           => 0,
					'max'           => 40,
					'step'          => 1,
					'append'        => '%',
					'wrapper'       => array(
						'width' => '25',
					),
				),
				array(
					'key'           => 'field_691e0a04insb',
					'label'         => 'Inset Bottom',
					'name'          => 'inset_bottom',
					'type'          => 'range',
					'default_value' => 0,
					'min'           => 0,
					'max'           => 40,
					'step'          => 1,
					'append'        => '%',
					'wrapper'       => array(
						'width' => '25',
					),
				),
				array(
					'key'           => 'field_691e0a05insl',
					'label'         => 'Inset Left',
					'name'          => 'inset_left',
					'type'          => 'range',
					'default_value' => 0,
					'min'           => 0,
					'max'           => 40,
					'step'          => 1,
					'append'        => '%',
					'wrapper'       => array(
						'width' => '25',
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/custom-column',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);

	acf_add_local_field_group(
		array(
			'key'                   => 'group_69d688404780e',
			'title'                 => 'BLOCK custom section',
			'fields'                => array(
				array(
					'key'           => 'field_6afb38138622d',
					'label'         => 'Is Image ?',
					'name'          => 'is_img',
					'type'          => 'true_false',
					'default_value' => 0,
				),
				array(
					'key'           => 'field_69d689084b665',
					'label'         => 'Background',
					'name'          => 'section_bgr',
					'type'          => 'select',
					'choices'       => array(
						'transparent' => 'Transparent',
						'dark'        => 'Dark',
						'default'     => 'Light',
					),
					'default_value' => 'default',
					'return_format' => 'value',
				),
				array(
					'key'           => 'field_69d688b04b663',
					'label'         => 'Animate on Scroll?',
					'name'          => 'animate_on_scroll',
					'type'          => 'true_false',
					'default_value' => 0,
				),
				array(
					'key'               => 'field_69d688c94b664',
					'label'             => 'What To Animate?',
					'name'              => 'animation_type',
					'type'              => 'select',
					'choices'           => array(
						'paralax' => 'paralax',
						'clip'    => 'clip_path',
					),
					'return_format'     => 'value',
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_69d688b04b663',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
				),
				array(
					'key'           => 'field_6afde54e9a4d5',
					'label'         => 'Více sloupců ?',
					'name'          => 'has_cols',
					'type'          => 'true_false',
					'default_value' => 0,
				),
				array(
					'key'               => 'field_6afde56ca1da5',
					'label'             => 'Horizontal Spacing',
					'name'              => 'cols_align',
					'type'              => 'select',
					'choices'           => array(
						'jc_start'         => 'Left',
						'jc_center'        => 'Center',
						'jc_space_between' => 'Space Between',
					),
					'default_value'     => 'jc_start',
					'return_format'     => 'value',
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_6afde54e9a4d5',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
				),
				array(
					'key'               => 'field_691e0b01cvai',
					'label'             => 'Columns Vertical Align',
					'name'              => 'cols_v_align',
					'type'              => 'select',
					'instructions'      => 'Default cross-axis alignment for columns. Stretch enables per-column Top/Center/Bottom.',
					'choices'           => array(
						'ai_stretch' => 'Stretch',
						'ai_start'   => 'Top',
						'ai_center'  => 'Center',
						'ai_end'     => 'Bottom',
					),
					'default_value'     => 'ai_stretch',
					'return_format'     => 'value',
					'ui'                => 1,
					'wrapper'           => array(
						'width' => '50',
					),
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_6afde54e9a4d5',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
				),
				array(
					'key'               => 'field_691e0b02cmin',
					'label'             => 'Section Min Height',
					'name'              => 'cols_min_height',
					'type'              => 'select',
					'instructions'      => 'Gives the section height so Top/Center/Bottom can show.',
					'choices'           => array(
						''         => 'None',
						'minh_50'  => '50vh',
						'minh_75'  => '75vh',
						'minh_100' => '100vh',
					),
					'default_value'     => '',
					'return_format'     => 'value',
					'allow_null'        => 1,
					'ui'                => 1,
					'wrapper'           => array(
						'width' => '50',
					),
					'conditional_logic' => array(
						array(
							array(
								'field'    => 'field_6afde54e9a4d5',
								'operator' => '==',
								'value'    => '1',
							),
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'block',
						'operator' => '==',
						'value'    => 'acf/custom-section',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
		)
	);
}
