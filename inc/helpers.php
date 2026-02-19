<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renders a template part from template-parts/.
 *
 * @param string $slug Relative path under template-parts/ without .php, e.g. 'property/card'.
 * @param array  $args Variables to extract inside the template.
 */
function estatein_get_part( string $slug, array $args = [] ): void {
	get_template_part( 'template-parts/' . $slug, null, $args );
}

/**
 * Returns an ACF field value with a fallback.
 *
 * @param string    $key     ACF field key or name.
 * @param mixed     $fallback Value to return when field is empty.
 * @param int|false $post_id Post ID or false for current post.
 *
 * @return mixed
 */
function estatein_field( string $key, mixed $fallback = '', int|false $post_id = false ): mixed {
	if ( ! function_exists( 'get_field' ) ) {
		return $fallback;
	}

	$value = get_field( $key, $post_id ?: null );

	return ( $value !== null && $value !== '' && $value !== false ) ? $value : $fallback;
}

/**
 * Outputs a safe ACF text field.
 *
 * @param string    $key     ACF field key or name.
 * @param string    $fallback
 * @param int|false $post_id
 */
function estatein_the_field( string $key, string $fallback = '', int|false $post_id = false ): void {
	echo esc_html( (string) estatein_field( $key, $fallback, $post_id ) );
}

/**
 * Outputs an ACF image field as an <img> tag.
 * Expects the field to return an array (ACF Image array format).
 *
 * @param string $key   ACF field name.
 * @param string $size  WordPress image size.
 * @param array  $attrs Additional HTML attributes for the <img> tag.
 */
function estatein_the_image_field( string $key, string $size = 'large', array $attrs = [] ): void {
	$image = estatein_field( $key );

	if ( empty( $image ) ) {
		return;
	}

	if ( is_array( $image ) && ! empty( $image['ID'] ) ) {
		echo wp_get_attachment_image( (int) $image['ID'], $size, false, $attrs );
		return;
	}

	// Fallback: image returned as URL string.
	if ( is_string( $image ) ) {
		$alt_text = isset( $attrs['alt'] ) ? esc_attr( $attrs['alt'] ) : '';
		$class    = isset( $attrs['class'] ) ? esc_attr( $attrs['class'] ) : '';
		printf(
			'<img src="%s" alt="%s" class="%s" />',
			esc_url( $image ),
			$alt_text,
			$class
		);
	}
}

/**
 * Converts a hex color string to an [R, G, B] integer array.
 * Supports both 3-digit and 6-digit hex values.
 * Returns null on invalid input.
 *
 * @param string $hex Hex color, e.g. '#1a2b3c' or '#fff'.
 * @return array{0:int,1:int,2:int}|null
 */
function estatein_hex_to_rgb( string $hex ): ?array {
	$hex = ltrim( $hex, '#' );

	if ( strlen( $hex ) === 3 ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}

	if ( strlen( $hex ) !== 6 ) {
		return null;
	}

	return [
		(int) hexdec( substr( $hex, 0, 2 ) ),
		(int) hexdec( substr( $hex, 2, 2 ) ),
		(int) hexdec( substr( $hex, 4, 2 ) ),
	];
}
