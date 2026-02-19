<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', function (): void {
	register_post_type( 'property', [
		'labels' => [
			'name'               => __( 'Properties', 'estatein' ),
			'singular_name'      => __( 'Property', 'estatein' ),
			'add_new'            => __( 'Add New', 'estatein' ),
			'add_new_item'       => __( 'Add New Property', 'estatein' ),
			'edit_item'          => __( 'Edit Property', 'estatein' ),
			'new_item'           => __( 'New Property', 'estatein' ),
			'view_item'          => __( 'View Property', 'estatein' ),
			'search_items'       => __( 'Search Properties', 'estatein' ),
			'not_found'          => __( 'No properties found', 'estatein' ),
			'not_found_in_trash' => __( 'No properties found in trash', 'estatein' ),
		],
		'public'       => true,
		'has_archive'  => true,
		'rewrite'      => [ 'slug' => 'properties' ],
		'menu_icon'    => 'dashicons-building',
		'supports'     => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
		'show_in_rest' => true,
		'menu_position'=> 5,
	] );
} );
