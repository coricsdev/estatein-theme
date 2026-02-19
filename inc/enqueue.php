<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the full URI for a theme asset.
 */
function estatein_asset_url( string $relative_path ): string {
	return get_template_directory_uri() . '/' . ltrim( $relative_path, '/' );
}

/**
 * Returns the absolute filesystem path for a theme asset.
 */
function estatein_asset_path( string $relative_path ): string {
	return get_template_directory() . '/' . ltrim( $relative_path, '/' );
}

add_action( 'wp_enqueue_scripts', function (): void {
	$css_rel = 'assets/dist/css/app.min.css';
	$js_rel  = 'assets/dist/js/app.min.js';

	$css_path = estatein_asset_path( $css_rel );
	$js_path  = estatein_asset_path( $js_rel );

	if ( file_exists( $css_path ) ) {
		wp_enqueue_style(
			'estatein-app',
			estatein_asset_url( $css_rel ),
			[],
			(string) filemtime( $css_path )
		);
	} elseif ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {
		add_action( 'wp_footer', function (): void {
			echo '<!-- Missing asset: assets/dist/css/app.min.css - compile via Prepros -->';
		} );
	}

	if ( file_exists( $js_path ) ) {
		wp_enqueue_script(
			'estatein-app',
			estatein_asset_url( $js_rel ),
			[],
			(string) filemtime( $js_path ),
			true
		);
	} elseif ( is_user_logged_in() && current_user_can( 'manage_options' ) ) {
		add_action( 'wp_footer', function (): void {
			echo '<!-- Missing asset: assets/dist/js/app.min.js - compile via Prepros -->';
		} );
	}
} );

// Always reset browser default body margin regardless of compiled asset state.
add_action( 'wp_head', function (): void {
	echo '<style>body{margin:0;padding:0;}</style>';
}, 1 );