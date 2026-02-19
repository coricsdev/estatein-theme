<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Block fields.
$heading        = get_field( 'heading' ) ?: '';
$description    = get_field( 'description' ) ?: '';
$image          = get_field( 'image' );
$image_position = get_field( 'image_position' ) ?: 'right';
$badge_image    = get_field( 'badge_image' );
$show_stats     = get_field( 'show_stats' );
$bg_color       = get_field( 'bg_color' ) ?: '#141414';
$text_color     = get_field( 'text_color' ) ?: '#ffffff';
$section_id     = get_field( 'section_id' ) ?: '';

// Determine column order.
$content_order = ( $image_position === 'left' ) ? 'order-2' : 'order-1';
$image_order   = ( $image_position === 'left' ) ? 'order-1' : 'order-2';

// Block anchor / ID.
$block_id = '';
if ( ! empty( $section_id ) ) {
	$block_id = esc_attr( $section_id );
} elseif ( ! empty( $block['anchor'] ) ) {
	$block_id = esc_attr( $block['anchor'] );
}

// Block classes for editor preview.
$block_class = 'estatein-twocol';
if ( ! empty( $block['className'] ) ) {
	$block_class .= ' ' . esc_attr( $block['className'] );
}
?>

<section
	<?php echo $block_id ? 'id="' . $block_id . '"' : ''; ?>
	class="<?php echo esc_attr( $block_class ); ?>"
	style="--twocol-bg:<?php echo esc_attr( $bg_color ); ?>;--twocol-text:<?php echo esc_attr( $text_color ); ?>;"
>
	<div class="estatein-twocol__container">

		<!-- Content Column -->
		<div class="estatein-twocol__content <?php echo esc_attr( $content_order ); ?>">

			<?php if ( $heading ) : ?>
				<h1 class="estatein-twocol__heading">
					<?php echo esc_html( $heading ); ?>
				</h1>
			<?php endif; ?>

			<?php if ( $description ) : ?>
				<p class="estatein-twocol__description">
					<?php echo esc_html( $description ); ?>
				</p>
			<?php endif; ?>

			<?php if ( have_rows( 'buttons' ) ) : ?>
				<div class="estatein-twocol__buttons">
					<?php while ( have_rows( 'buttons' ) ) : the_row();
						$btn_label  = get_sub_field( 'label' );
						$btn_url    = get_sub_field( 'url' );
						$btn_style  = get_sub_field( 'style' ) ?: 'outline';
						$btn_target = get_sub_field( 'new_tab' ) ? '_blank' : '_self';
						$btn_rel    = ( $btn_target === '_blank' ) ? ' rel="noopener noreferrer"' : '';

						if ( ! $btn_label || ! $btn_url ) {
							continue;
						}

						$btn_class = 'estatein-twocol__btn';
						$btn_class .= ( $btn_style === 'filled' )
							? ' estatein-twocol__btn--filled'
							: ' estatein-twocol__btn--outline';
					?>
						<a href="<?php echo esc_url( $btn_url ); ?>" class="<?php echo esc_attr( $btn_class ); ?>" target="<?php echo esc_attr( $btn_target ); ?>"<?php echo $btn_rel; ?>><?php echo esc_html( $btn_label ); ?></a>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>

			<?php if ( $show_stats && have_rows( 'stats' ) ) : ?>
				<div class="estatein-twocol__stats">
					<?php while ( have_rows( 'stats' ) ) : the_row();
						$stat_value = get_sub_field( 'value' );
						$stat_label = get_sub_field( 'label' );

						if ( ! $stat_value || ! $stat_label ) {
							continue;
						}
					?>
						<div class="estatein-twocol__stat">
							<span class="estatein-twocol__stat-value">
								<?php echo esc_html( $stat_value ); ?>
							</span>
							<span class="estatein-twocol__stat-label">
								<?php echo esc_html( $stat_label ); ?>
							</span>
						</div>
					<?php endwhile; ?>
				</div>
			<?php endif; ?>

		</div>

		<!-- Image Column -->
		<div class="estatein-twocol__image <?php echo esc_attr( $image_order ); ?>">

			<!-- Badge (positioned relative to image column) -->
			<?php if ( ! empty( $badge_image ) && is_array( $badge_image ) && ! empty( $badge_image['ID'] ) ) : ?>
				<div class="estatein-twocol__badge">
					<?php echo wp_get_attachment_image(
						(int) $badge_image['ID'],
						'thumbnail',
						false,
						[
							'class' => 'estatein-twocol__badge-img',
							'alt'   => ! empty( $badge_image['alt'] ) ? $badge_image['alt'] : esc_attr( $heading ),
						]
					); ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $image ) && is_array( $image ) && ! empty( $image['ID'] ) ) : ?>
				<?php echo wp_get_attachment_image(
					(int) $image['ID'],
					'full',
					false,
					[
						'class'   => 'estatein-twocol__img',
						'loading' => 'eager',
					]
				); ?>
			<?php elseif ( ! empty( $image ) && is_string( $image ) ) : ?>
				<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $heading ); ?>" class="estatein-twocol__img" loading="eager">
			<?php else : ?>
				<div class="estatein-twocol__img-placeholder">
					<span><?php esc_html_e( 'Add an image in block settings', 'estatein' ); ?></span>
				</div>
			<?php endif; ?>
		</div>

	</div>
</section>