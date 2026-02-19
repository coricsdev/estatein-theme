<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue the selected Google Font and apply it site-wide via inline CSS.
 * Runs after the main stylesheet so the inline style has higher specificity.
 */
add_action( 'wp_enqueue_scripts', function (): void {
	$settings    = estatein_get_settings_options();
	$fonts       = estatein_get_available_fonts();
	$selected    = $settings['google_font'] ?? 'none';
	$font_config = $fonts[ $selected ] ?? $fonts['none'];

	if ( $selected !== 'none' && ! empty( $font_config['import_url'] ) ) {
		wp_enqueue_style(
			'estatein-google-font',
			$font_config['import_url'],
			[],
			null
		);
	}

	if ( ! empty( $font_config['font_family'] ) ) {
		$inline_css = sprintf(
			'body, body * { font-family: %s; }',
			$font_config['font_family']
		);

		// Attach to the main stylesheet handle; fall back to wp_head inline block.
		if ( wp_style_is( 'estatein-app', 'enqueued' ) ) {
			wp_add_inline_style( 'estatein-app', $inline_css );
		} else {
			add_action( 'wp_head', function () use ( $inline_css ): void {
				printf( '<style id="estatein-font-override">%s</style>', $inline_css );
			} );
		}
	}
}, 20 ); // Priority 20 — runs after the main enqueue at priority 10.