<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Assumed ACF fields - rename to match your actual field names.
$price      = estatein_field( 'price' );
$address    = estatein_field( 'address' );
$bedrooms   = estatein_field( 'bedrooms' );
$bathrooms  = estatein_field( 'bathrooms' );
$floor_area = estatein_field( 'floor_area' );
?>

<article id="property-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-xl shadow-md overflow-hidden flex flex-col' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden">
			<?php the_post_thumbnail( 'medium_large', [ 'class' => 'w-full h-full object-cover transition-transform hover:scale-105' ] ); ?>
		</a>
	<?php endif; ?>

	<div class="p-4 flex flex-col flex-1 gap-2">

		<?php if ( $price ) : ?>
			<p class="text-blue-700 font-bold text-lg m-0">
				<?php echo esc_html( number_format( (float) $price, 2 ) ); ?>
			</p>
		<?php endif; ?>

		<h2 class="text-gray-900 font-semibold text-base leading-snug m-0">
			<a href="<?php the_permalink(); ?>" class="hover:underline">
				<?php the_title(); ?>
			</a>
		</h2>

		<?php if ( $address ) : ?>
			<p class="text-gray-500 text-sm m-0"><?php echo esc_html( $address ); ?></p>
		<?php endif; ?>

		<div class="flex gap-4 text-sm text-gray-600 mt-auto pt-3 border-t border-gray-100">

			<?php if ( $bedrooms !== '' && $bedrooms !== false ) : ?>
				<span><?php echo esc_html( $bedrooms ); ?> <?php esc_html_e( 'Beds', 'estatein' ); ?></span>
			<?php endif; ?>

			<?php if ( $bathrooms !== '' && $bathrooms !== false ) : ?>
				<span><?php echo esc_html( $bathrooms ); ?> <?php esc_html_e( 'Baths', 'estatein' ); ?></span>
			<?php endif; ?>

			<?php if ( $floor_area ) : ?>
				<span><?php echo esc_html( $floor_area ); ?> sqm</span>
			<?php endif; ?>

		</div>

	</div>

</article>
