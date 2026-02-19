<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// ---------------------------------------------------------------------------
// Admin menu registration
// ---------------------------------------------------------------------------

add_action( 'admin_menu', function (): void {

	add_menu_page(
		__( 'Theme Options', 'estatein' ),
		__( 'Theme Options', 'estatein' ),
		'manage_options',
		'estatein-theme-options',
		'estatein_render_header_options_page',
		'dashicons-admin-generic',
		61
	);

	add_submenu_page(
		'estatein-theme-options',
		__( 'Header Options', 'estatein' ),
		__( 'Header', 'estatein' ),
		'manage_options',
		'estatein-theme-options',
		'estatein_render_header_options_page'
	);

	add_submenu_page(
		'estatein-theme-options',
		__( 'Footer Options', 'estatein' ),
		__( 'Footer', 'estatein' ),
		'manage_options',
		'estatein-footer-options',
		'estatein_render_footer_options_page'
	);

	add_submenu_page(
		'estatein-theme-options',
		__( 'Settings', 'estatein' ),
		__( 'Settings', 'estatein' ),
		'manage_options',
		'estatein-settings',
		'estatein_render_settings_page'
	);
} );

// ---------------------------------------------------------------------------
// Settings registration — Header
// ---------------------------------------------------------------------------

add_action( 'admin_init', function (): void {

	register_setting( 'estatein_header_group', 'estatein_header_options', [
		'sanitize_callback' => 'estatein_sanitize_header_options',
	] );

	// Logo & Branding section.
	add_settings_section(
		'estatein_header_logo_section',
		__( 'Logo & Branding', 'estatein' ),
		'__return_null',
		'estatein-theme-options'
	);

	add_settings_field(
		'header_logo',
		__( 'Header Logo', 'estatein' ),
		'estatein_field_header_logo',
		'estatein-theme-options',
		'estatein_header_logo_section'
	);

	add_settings_field(
		'header_show_tagline',
		__( 'Show Site Tagline', 'estatein' ),
		'estatein_field_header_show_tagline',
		'estatein-theme-options',
		'estatein_header_logo_section'
	);

	// Navigation section.
	add_settings_section(
		'estatein_header_nav_section',
		__( 'Navigation', 'estatein' ),
		'__return_null',
		'estatein-theme-options'
	);

	add_settings_field(
		'header_nav_alignment',
		__( 'Nav Alignment', 'estatein' ),
		'estatein_field_header_nav_alignment',
		'estatein-theme-options',
		'estatein_header_nav_section'
	);

	add_settings_field(
		'header_sticky',
		__( 'Sticky Header', 'estatein' ),
		'estatein_field_header_sticky',
		'estatein-theme-options',
		'estatein_header_nav_section'
	);

	add_settings_field(
		'nav_cta_label',
		__( 'Nav CTA Button Label', 'estatein' ),
		'estatein_field_nav_cta_label',
		'estatein-theme-options',
		'estatein_header_nav_section'
	);

	add_settings_field(
		'nav_cta_url',
		__( 'Nav CTA Button URL', 'estatein' ),
		'estatein_field_nav_cta_url',
		'estatein-theme-options',
		'estatein_header_nav_section'
	);

	add_settings_field(
		'nav_bg_color',
		__( 'Nav Background Color', 'estatein' ),
		'estatein_field_nav_bg_color',
		'estatein-theme-options',
		'estatein_header_nav_section'
	);

	// Sticky Banner section.
	add_settings_section(
		'estatein_header_banner_section',
		__( 'Sticky Banner', 'estatein' ),
		'__return_null',
		'estatein-theme-options'
	);

	add_settings_field(
		'banner_enabled',
		__( 'Enable Banner', 'estatein' ),
		'estatein_field_banner_enabled',
		'estatein-theme-options',
		'estatein_header_banner_section'
	);

	add_settings_field(
		'banner_message',
		__( 'Banner Message', 'estatein' ),
		'estatein_field_banner_message',
		'estatein-theme-options',
		'estatein_header_banner_section'
	);

	add_settings_field(
		'banner_text_color',
		__( 'Text Color', 'estatein' ),
		'estatein_field_banner_text_color',
		'estatein-theme-options',
		'estatein_header_banner_section'
	);

	add_settings_field(
		'banner_cta_label',
		__( 'CTA Button Label', 'estatein' ),
		'estatein_field_banner_cta_label',
		'estatein-theme-options',
		'estatein_header_banner_section'
	);

	add_settings_field(
		'banner_cta_url',
		__( 'CTA Button URL', 'estatein' ),
		'estatein_field_banner_cta_url',
		'estatein-theme-options',
		'estatein_header_banner_section'
	);

	add_settings_field(
		'banner_dismissible',
		__( 'Allow Visitors to Dismiss', 'estatein' ),
		'estatein_field_banner_dismissible',
		'estatein-theme-options',
		'estatein_header_banner_section'
	);

	add_settings_field(
		'banner_bg_type',
		__( 'Background Type', 'estatein' ),
		'estatein_field_banner_bg_type',
		'estatein-theme-options',
		'estatein_header_banner_section'
	);

	add_settings_field(
		'banner_bg_color',
		__( 'Background Color', 'estatein' ),
		'estatein_field_banner_bg_color',
		'estatein-theme-options',
		'estatein_header_banner_section'
	);

	add_settings_field(
		'banner_bg_image',
		__( 'Background Image', 'estatein' ),
		'estatein_field_banner_bg_image',
		'estatein-theme-options',
		'estatein_header_banner_section'
	);

	add_settings_field(
		'banner_bg_position',
		__( 'Background Position', 'estatein' ),
		'estatein_field_banner_bg_position',
		'estatein-theme-options',
		'estatein_header_banner_section'
	);

	// ---------------------------------------------------------------------------
	// Settings registration — Settings (Fonts, etc.)
	// ---------------------------------------------------------------------------

	register_setting( 'estatein_settings_group', 'estatein_settings_options', [
		'sanitize_callback' => 'estatein_sanitize_settings_options',
	] );

	add_settings_section(
		'estatein_settings_fonts_section',
		__( 'Typography', 'estatein' ),
		'__return_null',
		'estatein-settings'
	);

	add_settings_field(
		'google_font',
		__( 'Google Font', 'estatein' ),
		'estatein_field_google_font',
		'estatein-settings',
		'estatein_settings_fonts_section'
	);

	// ---------------------------------------------------------------------------
	// Settings registration — Footer
	// ---------------------------------------------------------------------------

	register_setting( 'estatein_footer_group', 'estatein_footer_options', [
		'sanitize_callback' => 'estatein_sanitize_footer_options',
	] );

	// General section.
	add_settings_section(
		'estatein_footer_general_section',
		__( 'General', 'estatein' ),
		'__return_null',
		'estatein-footer-options'
	);

	add_settings_field(
		'footer_copyright',
		__( 'Copyright Text', 'estatein' ),
		'estatein_field_footer_copyright',
		'estatein-footer-options',
		'estatein_footer_general_section'
	);

	add_settings_field(
		'footer_tagline',
		__( 'Footer Tagline', 'estatein' ),
		'estatein_field_footer_tagline',
		'estatein-footer-options',
		'estatein_footer_general_section'
	);
	
	add_settings_field(
		'footer_logo',
		__( 'Footer Logo', 'estatein' ),
		'estatein_field_footer_logo',
		'estatein-footer-options',
		'estatein_footer_general_section'
	);

	add_settings_field(
		'footer_terms_url',
		__( 'Terms & Conditions URL', 'estatein' ),
		'estatein_field_footer_terms_url',
		'estatein-footer-options',
		'estatein_footer_general_section'
	);

	add_settings_field(
		'footer_terms_label',
		__( 'Terms & Conditions Label', 'estatein' ),
		'estatein_field_footer_terms_label',
		'estatein-footer-options',
		'estatein_footer_general_section'
	);

	add_settings_field(
		'footer_bottom_bg_color',
		__( 'Footer Bottom Bar Background', 'estatein' ),
		'estatein_field_footer_bottom_bg_color',
		'estatein-footer-options',
		'estatein_footer_general_section'
	);

	// Social links section.
	add_settings_section(
		'estatein_footer_social_section',
		__( 'Social Links', 'estatein' ),
		'__return_null',
		'estatein-footer-options'
	);

	$social_fields = [
		'footer_social_facebook'  => __( 'Facebook URL', 'estatein' ),
		'footer_social_instagram' => __( 'Instagram URL', 'estatein' ),
		'footer_social_linkedin'  => __( 'LinkedIn URL', 'estatein' ),
		'footer_social_twitter'   => __( 'X (Twitter) URL', 'estatein' ),
		'footer_social_youtube'   => __( 'YouTube URL', 'estatein' ),
	];

	foreach ( $social_fields as $id => $label ) {
		add_settings_field(
			$id,
			$label,
			static function () use ( $id ): void {
				estatein_field_footer_social( $id );
			},
			'estatein-footer-options',
			'estatein_footer_social_section'
		);
	}
} );

// ---------------------------------------------------------------------------
// Sanitization callbacks
// ---------------------------------------------------------------------------

function estatein_sanitize_header_options( $raw ): array {
	$raw = is_array( $raw ) ? $raw : [];

	return [
		'logo'                      => isset( $raw['logo'] ) ? absint( $raw['logo'] ) : 0,
		'show_tagline'              => ! empty( $raw['show_tagline'] ) ? 1 : 0,
		'nav_alignment'             => in_array( $raw['nav_alignment'] ?? '', [ 'left', 'center', 'right' ], true )
			? $raw['nav_alignment']
			: 'right',
		'sticky'                    => ! empty( $raw['sticky'] ) ? 1 : 0,
		'nav_cta_label'             => isset( $raw['nav_cta_label'] ) ? sanitize_text_field( $raw['nav_cta_label'] ) : '',
		'nav_cta_url'               => isset( $raw['nav_cta_url'] ) ? esc_url_raw( $raw['nav_cta_url'] ) : '',
		'nav_bg_color'              => isset( $raw['nav_bg_color'] ) ? sanitize_hex_color( $raw['nav_bg_color'] ) ?? '#1A1A1A' : '#1A1A1A',
		'banner_enabled'            => ! empty( $raw['banner_enabled'] ) ? 1 : 0,
		'banner_message'            => isset( $raw['banner_message'] ) ? wp_kses_post( $raw['banner_message'] ) : '',
		'banner_text_color'         => isset( $raw['banner_text_color'] ) ? sanitize_hex_color( $raw['banner_text_color'] ) ?? '#ffffff' : '#ffffff',
		'banner_cta_label'          => isset( $raw['banner_cta_label'] ) ? sanitize_text_field( $raw['banner_cta_label'] ) : '',
		'banner_cta_url'            => isset( $raw['banner_cta_url'] ) ? esc_url_raw( $raw['banner_cta_url'] ) : '',
		'banner_dismissible'        => ! empty( $raw['banner_dismissible'] ) ? 1 : 0,
		'banner_bg_type'            => in_array( $raw['banner_bg_type'] ?? '', [ 'color', 'image' ], true )
			? $raw['banner_bg_type']
			: 'color',
		'banner_bg_color'           => isset( $raw['banner_bg_color'] ) ? sanitize_hex_color( $raw['banner_bg_color'] ) ?? '#1d4ed8' : '#1d4ed8',
		'banner_bg_image'           => isset( $raw['banner_bg_image'] ) ? absint( $raw['banner_bg_image'] ) : 0,
		'banner_bg_position'        => in_array( $raw['banner_bg_position'] ?? '', [ 'center', 'top', 'bottom', 'left', 'right' ], true )
			? $raw['banner_bg_position']
			: 'center',
	];
}

function estatein_sanitize_settings_options( $raw ): array {
	$raw         = is_array( $raw ) ? $raw : [];
	$valid_fonts = array_keys( estatein_get_available_fonts() );

	return [
		'google_font' => in_array( $raw['google_font'] ?? '', $valid_fonts, true )
			? $raw['google_font']
			: 'none',
	];
}

/**
 * Returns the Settings options array with defaults applied.
 *
 * @return array<string, mixed>
 */
function estatein_get_settings_options(): array {
	$saved = get_option( 'estatein_settings_options', [] );
	$saved = is_array( $saved ) ? $saved : [];

	return wp_parse_args( $saved, [
		'google_font' => 'none',
	] );
}

/**
 * Returns the available Google Font options.
 *
 * @return array<string, array{label:string, import_url:string, font_family:string}>
 */
function estatein_get_available_fonts(): array {
	return [
		'none' => [
			'label'       => __( '— Default (Theme CSS)', 'estatein' ),
			'import_url'  => '',
			'font_family' => '',
		],
		'urbanist' => [
			'label'       => 'Urbanist',
			'import_url'  => 'https://fonts.googleapis.com/css2?family=Geist:wght@100..900&family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap',
			'font_family' => '"Urbanist", sans-serif',
		],
		'inter' => [
			'label'       => 'Inter',
			'import_url'  => 'https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap',
			'font_family' => '"Inter", sans-serif',
		],
		'roboto' => [
			'label'       => 'Roboto',
			'import_url'  => 'https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap',
			'font_family' => '"Roboto", sans-serif',
		],
		'poppins' => [
			'label'       => 'Poppins',
			'import_url'  => 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap',
			'font_family' => '"Poppins", sans-serif',
		],
		'playfair_display' => [
			'label'       => 'Playfair Display',
			'import_url'  => 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap',
			'font_family' => '"Playfair Display", serif',
		],
	];
}

function estatein_sanitize_footer_options( $raw ): array {
	$raw = is_array( $raw ) ? $raw : [];

	return [
		'copyright'        => isset( $raw['copyright'] ) ? wp_kses_post( $raw['copyright'] ) : '',
		'tagline'          => isset( $raw['tagline'] ) ? sanitize_text_field( $raw['tagline'] ) : '',
		'terms_url'        => isset( $raw['terms_url'] ) ? esc_url_raw( $raw['terms_url'] ) : '',
		'terms_label'      => isset( $raw['terms_label'] ) ? sanitize_text_field( $raw['terms_label'] ) : '',
		'footer_logo'      => isset( $raw['footer_logo'] ) ? absint( $raw['footer_logo'] ) : 0,
		'bottom_bg_color'  => isset( $raw['bottom_bg_color'] ) ? sanitize_hex_color( $raw['bottom_bg_color'] ) ?? '#141414' : '#141414',
		'social_facebook'  => isset( $raw['social_facebook'] ) ? esc_url_raw( $raw['social_facebook'] ) : '',
		'social_instagram' => isset( $raw['social_instagram'] ) ? esc_url_raw( $raw['social_instagram'] ) : '',
		'social_linkedin'  => isset( $raw['social_linkedin'] ) ? esc_url_raw( $raw['social_linkedin'] ) : '',
		'social_twitter'   => isset( $raw['social_twitter'] ) ? esc_url_raw( $raw['social_twitter'] ) : '',
		'social_youtube'   => isset( $raw['social_youtube'] ) ? esc_url_raw( $raw['social_youtube'] ) : '',
	];
}

// ---------------------------------------------------------------------------
// Option getter helpers (use these in templates)
// ---------------------------------------------------------------------------

/**
 * Returns the full header options array with defaults applied.
 *
 * @return array<string, mixed>
 */
function estatein_get_header_options(): array {
	$saved = get_option( 'estatein_header_options', [] );
	$saved = is_array( $saved ) ? $saved : [];

	return wp_parse_args( $saved, [
		'logo'                      => 0,
		'show_tagline'              => 0,
		'nav_alignment'             => 'right',
		'sticky'                    => 0,
		'nav_cta_label'             => 'Contact Us',
		'nav_cta_url'               => '/contact-us/',
		'nav_bg_color'              => '#1A1A1A',
		'banner_enabled'            => 0,
		'banner_message'            => '',
		'banner_text_color'         => '#ffffff',
		'banner_cta_label'          => '',
		'banner_cta_url'            => '',
		'banner_dismissible'        => 1,
		'banner_bg_type'            => 'color',
		'banner_bg_color'           => '#1d4ed8',
		'banner_bg_image'           => 0,
		'banner_bg_position'        => 'center',
	] );
}

/**
 * Returns the full footer options array with defaults applied.
 *
 * @return array<string, mixed>
 */
function estatein_get_footer_options(): array {
	$saved = get_option( 'estatein_footer_options', [] );
	$saved = is_array( $saved ) ? $saved : [];

	return wp_parse_args( $saved, [
		'copyright'        => '',
		'tagline'          => '',
		'terms_url'        => '',
		'terms_label'      => 'Terms & Conditions',
		'footer_logo'      => 0,
		'bottom_bg_color'  => '#141414',
		'social_facebook'  => '',
		'social_instagram' => '',
		'social_linkedin'  => '',
		'social_twitter'   => '',
		'social_youtube'   => '',
	] );
}

// ---------------------------------------------------------------------------
// Media uploader + conditional bg field JS
// ---------------------------------------------------------------------------

add_action( 'admin_enqueue_scripts', function ( string $hook ): void {
	$theme_option_hooks = [
		'toplevel_page_estatein-theme-options',
		'theme-options_page_estatein-footer-options',
		'theme-options_page_estatein-settings',
	];

	if ( ! in_array( $hook, $theme_option_hooks, true ) ) {
		return;
	}

	wp_enqueue_media();

	wp_add_inline_script( 'jquery-core', '
		jQuery(function($){
			$(document).on("click", ".estatein-upload-logo-btn", function(e){
				e.preventDefault();
				var btn    = $(this);
				var target = btn.data("target");
				var frame  = wp.media({
					title:    "Select Image",
					button:   { text: "Use this image" },
					multiple: false,
					library:  { type: "image" }
				});
				frame.on("select", function(){
					var attachment = frame.state().get("selection").first().toJSON();
					$("#" + target + "_id").val(attachment.id);
					$("#" + target + "_preview").attr("src", attachment.url).show();
					$("#" + target + "_remove").show();
				});
				frame.open();
			});
			$(document).on("click", ".estatein-remove-logo-btn", function(e){
				e.preventDefault();
				var btn    = $(this);
				var target = btn.data("target");
				$("#" + target + "_id").val("0");
				$("#" + target + "_preview").hide().attr("src","");
				btn.hide();
			});
		});
	' );

	wp_add_inline_script( 'jquery-core', '
		jQuery(function($){
			function estateinSyncBgFields() {
				var selected = $(".estatein-bg-type-toggle:checked").val();
				$("[data-bg-field]").closest("tr").hide();
				$("[data-bg-field=\'" + selected + "\']").closest("tr").show();
			}
			estateinSyncBgFields();
			$(document).on("change", ".estatein-bg-type-toggle", estateinSyncBgFields);
		});
	' );
} );

// ---------------------------------------------------------------------------
// Field renderers — Header: Logo & Branding
// ---------------------------------------------------------------------------

function estatein_field_header_logo(): void {
	$opts    = estatein_get_header_options();
	$logo_id = (int) $opts['logo'];
	$src     = $logo_id ? wp_get_attachment_image_url( $logo_id, 'medium' ) : '';
	?>
	<input type="hidden"
		id="header_logo_id"
		name="estatein_header_options[logo]"
		value="<?php echo esc_attr( (string) $logo_id ); ?>">

	<img id="header_logo_preview"
		src="<?php echo $src ? esc_url( $src ) : ''; ?>"
		style="max-height:80px;display:<?php echo $src ? 'block' : 'none'; ?>;margin-bottom:8px;">

	<button type="button"
		class="button estatein-upload-logo-btn"
		data-target="header_logo">
		<?php esc_html_e( 'Select Logo', 'estatein' ); ?>
	</button>

	<button type="button"
		class="button estatein-remove-logo-btn"
		data-target="header_logo"
		id="header_logo_remove"
		style="<?php echo $logo_id ? '' : 'display:none;'; ?>margin-left:4px;">
		<?php esc_html_e( 'Remove', 'estatein' ); ?>
	</button>

	<p class="description"><?php esc_html_e( 'Recommended: SVG or PNG with transparent background.', 'estatein' ); ?></p>
	<?php
}

function estatein_field_header_show_tagline(): void {
	$opts = estatein_get_header_options();
	?>
	<label>
		<input type="checkbox"
			name="estatein_header_options[show_tagline]"
			value="1"
			<?php checked( 1, (int) $opts['show_tagline'] ); ?>>
		<?php esc_html_e( 'Display site tagline next to / below the logo', 'estatein' ); ?>
	</label>
	<?php
}

// ---------------------------------------------------------------------------
// Field renderers — Header: Navigation
// ---------------------------------------------------------------------------

function estatein_field_header_nav_alignment(): void {
	$opts       = estatein_get_header_options();
	$current    = $opts['nav_alignment'];
	$alignments = [
		'left'   => __( 'Left', 'estatein' ),
		'center' => __( 'Center', 'estatein' ),
		'right'  => __( 'Right', 'estatein' ),
	];
	?>
	<select name="estatein_header_options[nav_alignment]">
		<?php foreach ( $alignments as $value => $label ) : ?>
			<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current, $value ); ?>>
				<?php echo esc_html( $label ); ?>
			</option>
		<?php endforeach; ?>
	</select>
	<?php
}

function estatein_field_header_sticky(): void {
	$opts = estatein_get_header_options();
	?>
	<label>
		<input type="checkbox"
			name="estatein_header_options[sticky]"
			value="1"
			<?php checked( 1, (int) $opts['sticky'] ); ?>>
		<?php esc_html_e( 'Make header stick to the top on scroll', 'estatein' ); ?>
	</label>
	<?php
}

function estatein_field_nav_cta_label(): void {
	$opts = estatein_get_header_options();
	?>
	<input type="text"
		name="estatein_header_options[nav_cta_label]"
		value="<?php echo esc_attr( $opts['nav_cta_label'] ); ?>"
		class="regular-text"
		placeholder="<?php esc_attr_e( 'e.g. Contact Us', 'estatein' ); ?>">
	<p class="description"><?php esc_html_e( 'Leave blank to hide the nav CTA button.', 'estatein' ); ?></p>
	<?php
}

function estatein_field_nav_cta_url(): void {
	$opts = estatein_get_header_options();
	?>
	<input type="url"
		name="estatein_header_options[nav_cta_url]"
		value="<?php echo esc_attr( $opts['nav_cta_url'] ); ?>"
		class="regular-text"
		placeholder="https://">
	<?php
}

function estatein_field_nav_bg_color(): void {
	$opts = estatein_get_header_options();
	?>
	<input type="color"
		name="estatein_header_options[nav_bg_color]"
		value="<?php echo esc_attr( $opts['nav_bg_color'] ); ?>">
	<p class="description"><?php esc_html_e( 'Background color for the navigation bar.', 'estatein' ); ?></p>
	<?php
}

// ---------------------------------------------------------------------------
// Field renderers — Header: Sticky Banner
// ---------------------------------------------------------------------------

function estatein_field_banner_enabled(): void {
	$opts = estatein_get_header_options();
	?>
	<label>
		<input type="checkbox"
			name="estatein_header_options[banner_enabled]"
			value="1"
			<?php checked( 1, (int) $opts['banner_enabled'] ); ?>>
		<?php esc_html_e( 'Show sticky banner above the header', 'estatein' ); ?>
	</label>
	<?php
}

function estatein_field_banner_message(): void {
	$opts = estatein_get_header_options();
	?>
	<textarea
		name="estatein_header_options[banner_message]"
		rows="3"
		class="large-text"
	><?php echo esc_textarea( $opts['banner_message'] ); ?></textarea>
	<p class="description"><?php esc_html_e( 'Basic HTML allowed (a, strong, em).', 'estatein' ); ?></p>
	<?php
}

function estatein_field_banner_text_color(): void {
	$opts = estatein_get_header_options();
	?>
	<input type="color"
		name="estatein_header_options[banner_text_color]"
		value="<?php echo esc_attr( $opts['banner_text_color'] ); ?>">
	<?php
}

function estatein_field_banner_cta_label(): void {
	$opts = estatein_get_header_options();
	?>
	<input type="text"
		name="estatein_header_options[banner_cta_label]"
		value="<?php echo esc_attr( $opts['banner_cta_label'] ); ?>"
		class="regular-text"
		placeholder="<?php esc_attr_e( 'e.g. Learn More', 'estatein' ); ?>">
	<p class="description"><?php esc_html_e( 'Leave blank to hide the button.', 'estatein' ); ?></p>
	<?php
}

function estatein_field_banner_cta_url(): void {
	$opts = estatein_get_header_options();
	?>
	<input type="url"
		name="estatein_header_options[banner_cta_url]"
		value="<?php echo esc_attr( $opts['banner_cta_url'] ); ?>"
		class="regular-text"
		placeholder="https://">
	<?php
}

function estatein_field_banner_dismissible(): void {
	$opts = estatein_get_header_options();
	?>
	<label>
		<input type="checkbox"
			name="estatein_header_options[banner_dismissible]"
			value="1"
			<?php checked( 1, (int) $opts['banner_dismissible'] ); ?>>
		<?php esc_html_e( 'Allow visitors to close the banner (persists for the session)', 'estatein' ); ?>
	</label>
	<?php
}

function estatein_field_banner_bg_type(): void {
	$opts    = estatein_get_header_options();
	$current = $opts['banner_bg_type'];
	?>
	<fieldset>
		<label style="margin-right:16px;">
			<input type="radio"
				name="estatein_header_options[banner_bg_type]"
				value="color"
				<?php checked( $current, 'color' ); ?>
				class="estatein-bg-type-toggle">
			<?php esc_html_e( 'Solid Color', 'estatein' ); ?>
		</label>
		<label>
			<input type="radio"
				name="estatein_header_options[banner_bg_type]"
				value="image"
				<?php checked( $current, 'image' ); ?>
				class="estatein-bg-type-toggle">
			<?php esc_html_e( 'Background Image', 'estatein' ); ?>
		</label>
	</fieldset>
	<?php
}

function estatein_field_banner_bg_color(): void {
	$opts = estatein_get_header_options();
	?>
	<div data-bg-field="color">
		<input type="color"
			name="estatein_header_options[banner_bg_color]"
			value="<?php echo esc_attr( $opts['banner_bg_color'] ); ?>">
		<p class="description"><?php esc_html_e( 'Solid background color for the banner.', 'estatein' ); ?></p>
	</div>
	<?php
}

function estatein_field_banner_bg_image(): void {
	$opts     = estatein_get_header_options();
	$image_id = (int) $opts['banner_bg_image'];
	$src      = $image_id ? wp_get_attachment_image_url( $image_id, 'medium' ) : '';
	?>
	<div data-bg-field="image">
		<input type="hidden"
			id="banner_bg_image_id"
			name="estatein_header_options[banner_bg_image]"
			value="<?php echo esc_attr( (string) $image_id ); ?>">

		<img id="banner_bg_image_preview"
			src="<?php echo $src ? esc_url( $src ) : ''; ?>"
			style="max-height:80px;display:<?php echo $src ? 'block' : 'none'; ?>;margin-bottom:8px;border-radius:4px;">

		<button type="button"
			class="button estatein-upload-logo-btn"
			data-target="banner_bg_image">
			<?php esc_html_e( 'Select Image', 'estatein' ); ?>
		</button>

		<button type="button"
			class="button estatein-remove-logo-btn"
			data-target="banner_bg_image"
			id="banner_bg_image_remove"
			style="<?php echo $image_id ? '' : 'display:none;'; ?>margin-left:4px;">
			<?php esc_html_e( 'Remove', 'estatein' ); ?>
		</button>

		<p class="description"><?php esc_html_e( 'Recommended: wide, dark texture (min 1400px wide).', 'estatein' ); ?></p>
	</div>
	<?php
}

function estatein_field_banner_bg_position(): void {
	$opts      = estatein_get_header_options();
	$current   = $opts['banner_bg_position'];
	$positions = [
		'center' => __( 'Center', 'estatein' ),
		'top'    => __( 'Top', 'estatein' ),
		'bottom' => __( 'Bottom', 'estatein' ),
		'left'   => __( 'Left', 'estatein' ),
		'right'  => __( 'Right', 'estatein' ),
	];
	?>
	<div data-bg-field="image">
		<select name="estatein_header_options[banner_bg_position]">
			<?php foreach ( $positions as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $current, $value ); ?>>
					<?php echo esc_html( $label ); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>
	<?php
}

// ---------------------------------------------------------------------------
// Field renderers — Settings: Typography
// ---------------------------------------------------------------------------

function estatein_field_google_font(): void {
	$opts    = estatein_get_settings_options();
	$fonts   = estatein_get_available_fonts();
	$current = $opts['google_font'];
	?>
	<select name="estatein_settings_options[google_font]" id="estatein_google_font">
		<?php foreach ( $fonts as $slug => $font ) : ?>
			<option value="<?php echo esc_attr( $slug ); ?>" <?php selected( $current, $slug ); ?>>
				<?php echo esc_html( $font['label'] ); ?>
			</option>
		<?php endforeach; ?>
	</select>
	<p class="description">
		<?php esc_html_e( 'Selected font is loaded from Google Fonts and applied site-wide via CSS. Choose "Default" to use your theme stylesheet font.', 'estatein' ); ?>
	</p>
	<?php
}

// ---------------------------------------------------------------------------
// Field renderers — Footer
// ---------------------------------------------------------------------------

function estatein_field_footer_copyright(): void {
	$opts = estatein_get_footer_options();
	?>
	<input type="text"
		name="estatein_footer_options[copyright]"
		value="<?php echo esc_attr( $opts['copyright'] ); ?>"
		class="regular-text"
		placeholder="&copy; 2025 Estatein. All rights reserved.">
	<p class="description"><?php esc_html_e( 'HTML allowed. Leave blank to use the default year + site name.', 'estatein' ); ?></p>
	<?php
}

function estatein_field_footer_tagline(): void {
	$opts = estatein_get_footer_options();
	?>
	<input type="text"
		name="estatein_footer_options[tagline]"
		value="<?php echo esc_attr( $opts['tagline'] ); ?>"
		class="regular-text"
		placeholder="<?php esc_attr_e( 'Finding your dream property.', 'estatein' ); ?>">
	<?php
}

function estatein_field_footer_logo(): void {
	$opts    = estatein_get_footer_options();
	$logo_id = (int) ( $opts['footer_logo'] ?? 0 );
	$src     = $logo_id ? wp_get_attachment_image_url( $logo_id, 'medium' ) : '';
	?>
	<input type="hidden"
		id="footer_logo_id"
		name="estatein_footer_options[footer_logo]"
		value="<?php echo esc_attr( (string) $logo_id ); ?>">

	<img id="footer_logo_preview"
		src="<?php echo $src ? esc_url( $src ) : ''; ?>"
		style="max-height:80px;display:<?php echo $src ? 'block' : 'none'; ?>;margin-bottom:8px;">

	<button type="button"
		class="button estatein-upload-logo-btn"
		data-target="footer_logo">
		<?php esc_html_e( 'Select Footer Logo', 'estatein' ); ?>
	</button>

	<button type="button"
		class="button estatein-remove-logo-btn"
		data-target="footer_logo"
		id="footer_logo_remove"
		style="<?php echo $logo_id ? '' : 'display:none;'; ?>margin-left:4px;">
		<?php esc_html_e( 'Remove', 'estatein' ); ?>
	</button>

	<p class="description"><?php esc_html_e( 'If empty, the header logo will be used.', 'estatein' ); ?></p>
	<?php
}

function estatein_field_footer_terms_url(): void {
	$opts = estatein_get_footer_options();
	?>
	<input type="url"
		name="estatein_footer_options[terms_url]"
		value="<?php echo esc_attr( $opts['terms_url'] ); ?>"
		class="regular-text"
		placeholder="https://">
	<p class="description"><?php esc_html_e( 'Leave blank to hide the Terms & Conditions link.', 'estatein' ); ?></p>
	<?php
}

function estatein_field_footer_terms_label(): void {
	$opts = estatein_get_footer_options();
	?>
	<input type="text"
		name="estatein_footer_options[terms_label]"
		value="<?php echo esc_attr( $opts['terms_label'] ); ?>"
		class="regular-text"
		placeholder="<?php esc_attr_e( 'Terms & Conditions', 'estatein' ); ?>">
	<?php
}

function estatein_field_footer_bottom_bg_color(): void {
	$opts = estatein_get_footer_options();
	?>
	<input type="color"
		name="estatein_footer_options[bottom_bg_color]"
		value="<?php echo esc_attr( $opts['bottom_bg_color'] ); ?>">
	<p class="description"><?php esc_html_e( 'Background color for the footer bottom bar.', 'estatein' ); ?></p>
	<?php
}

function estatein_field_footer_social( string $field_id ): void {
	$opts  = estatein_get_footer_options();
	$key   = str_replace( 'footer_social_', 'social_', $field_id );
	$value = $opts[ $key ] ?? '';
	?>
	<input type="url"
		name="estatein_footer_options[<?php echo esc_attr( $key ); ?>]"
		value="<?php echo esc_attr( $value ); ?>"
		class="regular-text"
		placeholder="https://">
	<?php
}

// ---------------------------------------------------------------------------
// Page renderers
// ---------------------------------------------------------------------------

function estatein_render_header_options_page(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Header Options', 'estatein' ); ?></h1>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'estatein_header_group' );
			do_settings_sections( 'estatein-theme-options' );
			submit_button( __( 'Save Header Options', 'estatein' ) );
			?>
		</form>
	</div>
	<?php
}

function estatein_render_settings_page(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Settings', 'estatein' ); ?></h1>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'estatein_settings_group' );
			do_settings_sections( 'estatein-settings' );
			submit_button( __( 'Save Settings', 'estatein' ) );
			?>
		</form>
	</div>
	<?php
}

function estatein_render_footer_options_page(): void {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Footer Options', 'estatein' ); ?></h1>
		<form method="post" action="options.php">
			<?php
			settings_fields( 'estatein_footer_group' );
			do_settings_sections( 'estatein-footer-options' );
			submit_button( __( 'Save Footer Options', 'estatein' ) );
			?>
		</form>
	</div>
	<?php
}