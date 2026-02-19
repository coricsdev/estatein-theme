<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Assumed ACF fields.
$price      = estatein_field( 'price' );
$address    = estatein_field( 'address' );
$bedrooms   = estatein_field( 'bedrooms' );
$bathrooms  = estatein_field( 'bathrooms' );
$floor_area = estatein_field( 'floor_area' );
$lot_area   = estatein_field( 'lot_area' );
$amenities  = estatein_field( 'amenities' );

$meta_items = [
	__( 'Price', 'estatein' )      => $price ? number_format( (float) $price, 2 ) : null,
	__( 'Address', 'estatein' )    => $address ? (string) $address : null,
	__( 'Bedrooms', 'estatein' )   => ( $bedrooms !== '' && $bedrooms !== false ) ? (string) $bedrooms : null,
	__( 'Bathrooms', 'estatein' )  => ( $bathrooms !== '' && $bathrooms !== false ) ? (string) $bathrooms : null,
	__( 'Floor Area', 'estatein' ) => $floor_area ? $floor_area . ' sqm' : null,
	__( 'Lot Area', 'estatein' )   => $lot_area ? $lot_area . ' sqm' : null,
];
?>

<dl class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-sm text-gray-700">
	<?php foreach ( $meta_items as $label => $value ) : ?>
		<?php if ( $value !== null && $value !== '' ) : ?>
			<div class="flex flex-col gap-1">
				<dt class="text-xs font-semibold uppercase tracking-wide text-gray-400">
					<?php echo esc_html( $label ); ?>
				</dt>
				<dd class="font-medium text-gray-900 m-0">
					<?php echo esc_html( $value ); ?>
				</dd>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</dl>

<?php if ( ! empty( $amenities ) && is_array( $amenities ) ) : ?>
	<div class="mt-6">
		<h3 class="text-sm font-semibold uppercase tracking-wide text-gray-400 mb-2">
			<?php esc_html_e( 'Amenities', 'estatein' ); ?>
		</h3>
		<ul class="flex flex-wrap gap-2 list-none m-0 p-0">
			<?php foreach ( $amenities as $amenity ) : ?>
				<li class="bg-blue-50 text-blue-700 text-xs font-medium px-3 py-1 rounded-full">
					<?php echo esc_html( $amenity ); ?>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
