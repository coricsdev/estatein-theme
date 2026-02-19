<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$opts      = estatein_get_header_options();
$banner_id = 'estatein-sticky-banner';

// Build header classes.
$header_classes = 'estatein-header w-full';
if ( ! empty( $opts['sticky'] ) ) {
	$header_classes .= ' sticky top-0 z-40';
}

// Determine banner background mode.
$banner_bg_type   = $opts['banner_bg_type'] ?? 'color';
$banner_has_image = ( $banner_bg_type === 'image' ) && ! empty( $opts['banner_bg_image'] );
$banner_image_url = $banner_has_image
	? (string) wp_get_attachment_image_url( (int) $opts['banner_bg_image'], 'full' )
	: '';

// Build outer banner inline style.
if ( $banner_has_image && $banner_image_url ) {
	$banner_outer_style = sprintf(
		'background-image:url(%s);background-size:cover;background-position:%s center;color:%s;',
		esc_url( $banner_image_url ),
		esc_attr( $opts['banner_bg_position'] ),
		esc_attr( $opts['banner_text_color'] )
	);
} else {
	$banner_outer_style = sprintf(
		'background-color:%s;color:%s;',
		esc_attr( $opts['banner_bg_color'] ),
		esc_attr( $opts['banner_text_color'] )
	);
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( ! empty( $opts['banner_enabled'] ) && $opts['banner_message'] ) : ?>
	<div
		id="<?php echo esc_attr( $banner_id ); ?>"
		class="estatein-banner"
		style="<?php echo $banner_outer_style; ?>"
		role="banner"
		aria-label="<?php esc_attr_e( 'Site announcement', 'estatein' ); ?>"
	>
		<div class="estatein-banner__inner" style="color:<?php echo esc_attr( $opts['banner_text_color'] ); ?>;">
			<?php
			// Clean the banner message:
			// 1. Strip raw URLs (these belong in the CTA URL field).
			// 2. Force-close any broken/unclosed HTML tags.
			// 3. Strip all HTML tags except safe inline ones.
			$raw_message   = $opts['banner_message'];
			$clean_message = preg_replace( '#\s*https?://[^\s<]+#i', '', $raw_message );
			$clean_message = strip_tags( $clean_message, '<strong><em><span><br>' );
			$clean_message = force_balance_tags( $clean_message );
			echo wp_kses_post( trim( $clean_message ) );
			?><?php if ( ! empty( $opts['banner_cta_label'] ) && ! empty( $opts['banner_cta_url'] ) ) : ?> <a href="<?php echo esc_url( $opts['banner_cta_url'] ); ?>" class="estatein-banner__cta" style="color:<?php echo esc_attr( $opts['banner_text_color'] ); ?>;"><?php echo esc_html( $opts['banner_cta_label'] ); ?></a><?php endif; ?>

			<?php if ( ! empty( $opts['banner_dismissible'] ) ) : ?>
				<button
					type="button"
					class="estatein-banner__dismiss"
					aria-label="<?php esc_attr_e( 'Dismiss banner', 'estatein' ); ?>"
					onclick="estateinDismissBanner('<?php echo esc_js( $banner_id ); ?>')"
					style="color:<?php echo esc_attr( $opts['banner_text_color'] ); ?>;"
				>&times;</button>
			<?php endif; ?>
		</div>
	</div>

	<?php if ( ! empty( $opts['banner_dismissible'] ) ) : ?>
		<script>
		function estateinDismissBanner(id) {
			var el = document.getElementById(id);
			if (el) {
				el.style.display = 'none';
				try { sessionStorage.setItem('estatein_banner_dismissed', '1'); } catch(e) {}
			}
		}
		(function(){
			try {
				if (sessionStorage.getItem('estatein_banner_dismissed') === '1') {
					var el = document.getElementById('<?php echo esc_js( $banner_id ); ?>');
					if (el) { el.style.display = 'none'; }
				}
			} catch(e) {}
		})();
		</script>
	<?php endif; ?>
<?php endif; ?>

<header id="site-header" class="<?php echo esc_attr( $header_classes ); ?>">
	<div class="estatein-nav" style="background-color:<?php echo esc_attr( $opts['nav_bg_color'] ?? '#1A1A1A' ); ?>;">
		<div class="estatein-nav__container">

			<!-- Logo -->
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="estatein-nav__logo">
				<?php if ( ! empty( $opts['logo'] ) ) : ?>
					<?php echo wp_get_attachment_image(
						(int) $opts['logo'],
						'full',
						false,
						[ 'class' => 'estatein-nav__logo-img', 'alt' => get_bloginfo( 'name' ) ]
					); ?>
				<?php else : ?>
					<span class="estatein-nav__logo-text"><?php bloginfo( 'name' ); ?></span>
				<?php endif; ?>
			</a>

			<!-- Hamburger Toggle -->
			<button
				type="button"
				class="estatein-nav__toggle"
				aria-label="<?php esc_attr_e( 'Toggle navigation', 'estatein' ); ?>"
				aria-expanded="false"
				onclick="estateinToggleNav()"
			>
				<span class="estatein-nav__toggle-bar"></span>
				<span class="estatein-nav__toggle-bar"></span>
				<span class="estatein-nav__toggle-bar"></span>
			</button>

			<!-- Navigation + CTA (collapsible on mobile) -->
			<div class="estatein-nav__collapse" id="estatein-nav-collapse">
				<div class="estatein-nav__collapse-inner">

					<!-- Primary Navigation -->
					<?php
					wp_nav_menu( [
						'theme_location'  => 'primary',
						'container'       => 'nav',
						'container_class' => 'estatein-nav__menu',
						'container_attr'  => 'aria-label="' . esc_attr__( 'Primary navigation', 'estatein' ) . '"',
						'menu_class'      => 'estatein-nav__list',
						'fallback_cb'     => false,
						'depth'           => 1,
					] );
					?>

					<!-- CTA Button -->
					<?php if ( ! empty( $opts['nav_cta_label'] ) && ! empty( $opts['nav_cta_url'] ) ) : ?>
						<div class="estatein-nav__cta">
							<a href="<?php echo esc_url( $opts['nav_cta_url'] ); ?>" class="estatein-nav__cta-btn">
								<?php echo esc_html( $opts['nav_cta_label'] ); ?>
							</a>
						</div>
					<?php endif; ?>

				</div>
			</div>

		</div>
	</div>
</header>

<script>
function estateinToggleNav() {
	var collapse = document.getElementById('estatein-nav-collapse');
	var toggle = document.querySelector('.estatein-nav__toggle');
	if (!collapse || !toggle) return;
	var isOpen = collapse.classList.toggle('is-open');
	toggle.classList.toggle('is-open', isOpen);
	toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
}
</script>

<div id="page-wrap" class="min-h-screen">