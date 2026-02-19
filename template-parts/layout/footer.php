<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$opts        = estatein_get_footer_options();
$header_opts = estatein_get_header_options();

// Footer logo: use footer-specific logo, fall back to header logo.
$footer_logo_id = ! empty( $opts['footer_logo'] ) ? (int) $opts['footer_logo'] : 0;
$logo_id        = $footer_logo_id ?: ( (int) ( $header_opts['logo'] ?? 0 ) );

$socials = [
	'facebook'  => [ 'url' => $opts['social_facebook'],  'label' => 'Facebook',    'icon' => 'M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z' ],
	'linkedin'  => [ 'url' => $opts['social_linkedin'],   'label' => 'LinkedIn',    'icon' => 'M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 6a2 2 0 100-4 2 2 0 000 4z' ],
	'twitter'   => [ 'url' => $opts['social_twitter'],    'label' => 'X (Twitter)', 'icon' => 'M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z' ],
	'youtube'   => [ 'url' => $opts['social_youtube'] ?? '', 'label' => 'YouTube', 'icon' => 'M22.54 6.42a2.78 2.78 0 00-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 00-1.94 2A29 29 0 001 11.75a29 29 0 00.46 5.33A2.78 2.78 0 003.4 19.1c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 001.94-2 29 29 0 00.46-5.25 29 29 0 00-.46-5.43zM9.75 15.02V8.48l5.75 3.27-5.75 3.27z' ],
];

$copyright = $opts['copyright']
	? $opts['copyright']
	: '&copy;' . esc_html( (string) gmdate( 'Y' ) ) . ' ' . esc_html( get_bloginfo( 'name' ) ) . '. All Rights Reserved.';

$active_socials = array_filter( $socials, static fn( array $s ): bool => ! empty( $s['url'] ) );
?>
</div><!-- #page-wrap -->

<footer id="site-footer" class="estatein-footer">
	<div class="estatein-footer__container">

		<!-- Top Section -->
		<div class="estatein-footer__top">

			<!-- Logo + Email Column -->
			<div class="estatein-footer__brand">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="estatein-footer__logo">
					<?php if ( $logo_id ) : ?>
						<?php echo wp_get_attachment_image(
							$logo_id,
							'full',
							false,
							[ 'class' => 'estatein-footer__logo-img', 'alt' => get_bloginfo( 'name' ) ]
						); ?>
					<?php else : ?>
						<span class="estatein-footer__logo-text"><?php bloginfo( 'name' ); ?></span>
					<?php endif; ?>
				</a>

				<div class="estatein-footer__email-form">
					<div class="estatein-footer__email-input-wrap">
						<svg class="estatein-footer__email-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 7l-10 7L2 7"/></svg>
						<input type="email" class="estatein-footer__email-input" placeholder="<?php esc_attr_e( 'Enter Your Email', 'estatein' ); ?>" aria-label="<?php esc_attr_e( 'Email address', 'estatein' ); ?>">
						<button type="button" class="estatein-footer__email-btn" aria-label="<?php esc_attr_e( 'Subscribe', 'estatein' ); ?>">
							<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/></svg>
						</button>
					</div>
				</div>
			</div>

			<!-- Footer Navigation Columns -->
			<div class="estatein-footer__nav">
				<?php
				$menu_locations = get_nav_menu_locations();
				$menu_id        = $menu_locations['footer_columns'] ?? 0;

				if ( $menu_id ) :
					$menu_items = wp_get_nav_menu_items( (int) $menu_id );

					if ( $menu_items ) :
						// Group items by parent.
						$parents  = [];
						$children = [];

						foreach ( $menu_items as $item ) {
							if ( (int) $item->menu_item_parent === 0 ) {
								$parents[ $item->ID ] = $item;
							} else {
								$children[ $item->menu_item_parent ][] = $item;
							}
						}

						foreach ( $parents as $parent_id => $parent ) :
					?>
						<div class="estatein-footer__nav-col">
							<h4 class="estatein-footer__nav-heading">
								<?php echo esc_html( $parent->title ); ?>
							</h4>
							<?php if ( ! empty( $children[ $parent_id ] ) ) : ?>
								<ul class="estatein-footer__nav-list">
									<?php foreach ( $children[ $parent_id ] as $child ) : ?>
										<li>
											<a href="<?php echo esc_url( $child->url ); ?>" class="estatein-footer__nav-link"><?php echo esc_html( $child->title ); ?></a>
										</li>
									<?php endforeach; ?>
								</ul>
							<?php endif; ?>
						</div>
					<?php
						endforeach;
					endif;
				endif;
				?>
			</div>

		</div>

		<!-- Bottom Bar -->
		<div class="estatein-footer__bottom" style="background-color:<?php echo esc_attr( $opts['bottom_bg_color'] ); ?>;">
			<div class="estatein-footer__bottom-inner">
				<div class="estatein-footer__bottom-left">
					<span class="estatein-footer__copyright"><?php echo wp_kses_post( $copyright ); ?></span>
					<?php if ( ! empty( $opts['terms_url'] ) ) : ?>
						<a href="<?php echo esc_url( $opts['terms_url'] ); ?>" class="estatein-footer__terms-link"><?php echo esc_html( $opts['terms_label'] ?: __( 'Terms & Conditions', 'estatein' ) ); ?></a>
					<?php endif; ?>
					<?php
					wp_nav_menu( [
						'theme_location'  => 'footer',
						'container'       => false,
						'menu_class'      => 'estatein-footer__legal-links',
						'fallback_cb'     => false,
						'depth'           => 1,
					] );
					?>
				</div>

				<?php if ( $active_socials ) : ?>
					<ul class="estatein-footer__socials">
						<?php foreach ( $active_socials as $social ) : ?>
							<li>
								<a href="<?php echo esc_url( $social['url'] ); ?>" class="estatein-footer__social-link" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr( $social['label'] ); ?>">
									<svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="<?php echo esc_attr( $social['icon'] ); ?>"/></svg>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		</div>

	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>