<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', function (): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	] );

	load_theme_textdomain( 'estatein', get_template_directory() . '/languages' );

	register_nav_menus( [
		'primary'        => __( 'Primary Menu', 'estatein' ),
		'footer'         => __( 'Footer Menu', 'estatein' ),
		'footer_columns' => __( 'Footer Columns (Parent = Heading, Child = Links)', 'estatein' ),
	] );
} );
