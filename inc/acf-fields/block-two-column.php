<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

acf_add_local_field_group( [
	'key'      => 'group_two_column_layout',
	'title'    => 'Full Width Two Column Layout',
	'fields'   => [

		// ── Content Tab ──
		[
			'key'   => 'field_twocol_tab_content',
			'label' => 'Content',
			'type'  => 'tab',
		],
		[
			'key'           => 'field_twocol_heading',
			'label'         => 'Heading',
			'name'          => 'heading',
			'type'          => 'text',
			'required'      => 1,
			'default_value' => 'Discover Your Dream Property with Estatein',
		],
		[
			'key'           => 'field_twocol_description',
			'label'         => 'Description',
			'name'          => 'description',
			'type'          => 'textarea',
			'rows'          => 3,
			'default_value' => 'Your journey to finding the perfect property begins here. Explore our listings to find the home that matches your dreams.',
		],

		// ── CTA Buttons Tab ──
		[
			'key'   => 'field_twocol_tab_cta',
			'label' => 'CTA Buttons',
			'type'  => 'tab',
		],
		[
			'key'        => 'field_twocol_buttons',
			'label'      => 'Buttons',
			'name'       => 'buttons',
			'type'       => 'repeater',
			'min'        => 0,
			'max'        => 2,
			'layout'     => 'block',
			'sub_fields' => [
				[
					'key'      => 'field_twocol_btn_label',
					'label'    => 'Button Label',
					'name'     => 'label',
					'type'     => 'text',
					'required' => 1,
				],
				[
					'key'      => 'field_twocol_btn_url',
					'label'    => 'Button URL',
					'name'     => 'url',
					'type'     => 'url',
					'required' => 1,
				],
				[
					'key'           => 'field_twocol_btn_style',
					'label'         => 'Button Style',
					'name'          => 'style',
					'type'          => 'select',
					'choices'       => [
						'outline' => 'Outline (Secondary)',
						'filled'  => 'Filled (Primary)',
					],
					'default_value' => 'outline',
				],
				[
					'key'           => 'field_twocol_btn_target',
					'label'         => 'Open in New Tab',
					'name'          => 'new_tab',
					'type'          => 'true_false',
					'default_value' => 0,
					'ui'            => 1,
				],
			],
		],

		// ── Image Tab ──
		[
			'key'   => 'field_twocol_tab_image',
			'label' => 'Image',
			'type'  => 'tab',
		],
		[
			'key'           => 'field_twocol_image',
			'label'         => 'Image',
			'name'          => 'image',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'required'      => 0,
		],
        [
			'key'           => 'field_twocol_badge',
			'label'         => 'Center Badge Image',
			'name'          => 'badge_image',
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'thumbnail',
			'instructions'  => 'Optional circular badge that floats at the center divide between columns. Recommended: PNG with transparent background, ~120x120px.',
		],
		[
			'key'           => 'field_twocol_image_position',
			'label'         => 'Image Position',
			'name'          => 'image_position',
			'type'          => 'select',
			'choices'       => [
				'right' => 'Image on Right',
				'left'  => 'Image on Left',
			],
			'default_value' => 'right',
		],

		// ── Stat Boxes Tab ──
		[
			'key'   => 'field_twocol_tab_stats',
			'label' => 'Stat Boxes',
			'type'  => 'tab',
		],
		[
			'key'           => 'field_twocol_show_stats',
			'label'         => 'Show Stat Boxes',
			'name'          => 'show_stats',
			'type'          => 'true_false',
			'default_value' => 1,
			'ui'            => 1,
		],
		[
			'key'               => 'field_twocol_stats',
			'label'             => 'Stats',
			'name'              => 'stats',
			'type'              => 'repeater',
			'min'               => 0,
			'max'               => 6,
			'layout'            => 'table',
			'conditional_logic' => [
				[
					[
						'field'    => 'field_twocol_show_stats',
						'operator' => '==',
						'value'    => '1',
					],
				],
			],
			'sub_fields'        => [
				[
					'key'      => 'field_twocol_stat_value',
					'label'    => 'Value',
					'name'     => 'value',
					'type'     => 'text',
					'required' => 1,
				],
				[
					'key'      => 'field_twocol_stat_label',
					'label'    => 'Label',
					'name'     => 'label',
					'type'     => 'text',
					'required' => 1,
				],
			],
		],

		// ── Settings Tab ──
		[
			'key'   => 'field_twocol_tab_settings',
			'label' => 'Settings',
			'type'  => 'tab',
		],
		[
			'key'           => 'field_twocol_bg_color',
			'label'         => 'Background Color',
			'name'          => 'bg_color',
			'type'          => 'color_picker',
			'default_value' => '#141414',
		],
		[
			'key'           => 'field_twocol_text_color',
			'label'         => 'Text Color',
			'name'          => 'text_color',
			'type'          => 'color_picker',
			'default_value' => '#ffffff',
		],
		[
			'key'           => 'field_twocol_section_id',
			'label'         => 'Section ID',
			'name'          => 'section_id',
			'type'          => 'text',
			'instructions'  => 'Optional HTML ID for anchor links.',
		],
	],
	'location'  => [
		[
			[
				'param'    => 'block',
				'operator' => '==',
				'value'    => 'acf/two-column-layout',
			],
		],
	],
] );