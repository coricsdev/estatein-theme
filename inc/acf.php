<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ---------------------------------------------------------------------------
// Register custom block category
// ---------------------------------------------------------------------------

add_filter( 'block_categories_all', function ( array $categories ): array {
	array_unshift( $categories, [
		'slug'  => 'estatein',
		'title' => __( 'Estatein', 'estatein' ),
		'icon'  => 'admin-home',
	] );
	return $categories;
} );

// ---------------------------------------------------------------------------
// Register ACF Blocks
// ---------------------------------------------------------------------------

add_action( 'acf/init', function (): void {

	// Support both ACF 6+ (acf_register_block) and older (acf_register_block_type).
	$register_fn = function_exists( 'acf_register_block' )
		? 'acf_register_block'
		: ( function_exists( 'acf_register_block_type' ) ? 'acf_register_block_type' : null );

	if ( ! $register_fn ) {
		return;
	}

	$register_fn( [
		'name'            => 'two-column-layout',
		'title'           => __( 'Full Width Two Column Layout', 'estatein' ),
		'description'     => __( 'A full-width hero/feature section with heading, description, CTA buttons, image, and stat boxes.', 'estatein' ),
		'render_callback' => 'estatein_render_block_two_column',
		'category'        => 'estatein',
		'icon'            => 'columns',
		'keywords'        => [ 'hero', 'two column', 'cta', 'stats', 'feature' ],
		'supports'        => [
			'align'  => false,
			'anchor' => true,
		],
		'mode'            => 'preview',
		'example'         => [
			'attributes' => [
				'mode' => 'preview',
				'data' => [
					'heading'     => 'Discover Your Dream Property with Estatein',
					'description' => 'Your journey to finding the perfect property begins here.',
				],
			],
		],
	] );

} );

/**
 * Render callback for the Two Column Layout block.
 * Using a callback instead of render_template for reliable path resolution.
 *
 * @param array  $block      The block settings and attributes.
 * @param string $content    The block inner HTML (empty for ACF blocks).
 * @param bool   $is_preview True during backend preview render.
 */
function estatein_render_block_two_column( array $block, string $content = '', bool $is_preview = false ): void {
	$template = get_template_directory() . '/template-parts/blocks/two-column-layout.php';

	if ( file_exists( $template ) ) {
		include $template;
	} elseif ( current_user_can( 'manage_options' ) ) {
		echo '<p style="color:red;padding:20px;">Block template not found: template-parts/blocks/two-column-layout.php</p>';
	}
}

// ---------------------------------------------------------------------------
// Register ACF field groups via PHP (block fields)
// ---------------------------------------------------------------------------

add_action( 'acf/include_fields', function (): void {
	$fields_dir = get_template_directory() . '/inc/acf-fields/';

	if ( ! is_dir( $fields_dir ) ) {
		return;
	}

	foreach ( glob( $fields_dir . '*.php' ) as $file ) {
		require_once $file;
	}
} );

// ---------------------------------------------------------------------------
// Register ACF field groups for the Property CPT
// ---------------------------------------------------------------------------

add_action( 'acf/init', function (): void {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( [
		'key'    => 'group_property_details',
		'title'  => 'Property Details',
		'fields' => [
			[
				'key'   => 'field_property_price',
				'label' => 'Price',
				'name'  => 'price',
				'type'  => 'number',
			],
			[
				'key'   => 'field_property_address',
				'label' => 'Address',
				'name'  => 'address',
				'type'  => 'text',
			],
			[
				'key'   => 'field_property_bedrooms',
				'label' => 'Bedrooms',
				'name'  => 'bedrooms',
				'type'  => 'number',
			],
			[
				'key'   => 'field_property_bathrooms',
				'label' => 'Bathrooms',
				'name'  => 'bathrooms',
				'type'  => 'number',
			],
			[
				'key'   => 'field_property_floor_area',
				'label' => 'Floor Area (sqm)',
				'name'  => 'floor_area',
				'type'  => 'number',
			],
			[
				'key'   => 'field_property_lot_area',
				'label' => 'Lot Area (sqm)',
				'name'  => 'lot_area',
				'type'  => 'number',
			],
			[
				'key'           => 'field_property_gallery',
				'label'         => 'Gallery',
				'name'          => 'gallery',
				'type'          => 'gallery',
				'return_format' => 'array',
			],
			[
				'key'   => 'field_property_map_location',
				'label' => 'Map Location',
				'name'  => 'map_location',
				'type'  => 'google_map',
			],
			[
				'key'     => 'field_property_amenities',
				'label'   => 'Amenities',
				'name'    => 'amenities',
				'type'    => 'checkbox',
				'choices' => [
					'pool'    => 'Swimming Pool',
					'gym'     => 'Gym',
					'parking' => 'Parking',
					'garden'  => 'Garden',
				],
			],
		],
		'location' => [
			[
				[
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'property',
				],
			],
		],
	] );
} );