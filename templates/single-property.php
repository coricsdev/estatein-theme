<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main-content" class="max-w-7xl mx-auto px-4 py-10">

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="property-<?php the_ID(); ?>" <?php post_class(); ?>>

			<h1 class="text-3xl font-bold text-gray-900 mb-4">
				<?php the_title(); ?>
			</h1>

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="mb-6 rounded-xl overflow-hidden">
					<?php the_post_thumbnail( 'full', [ 'class' => 'w-full max-h-96 object-cover' ] ); ?>
				</div>
			<?php endif; ?>

			<div class="mb-8">
				<?php get_template_part( 'template-parts/property/meta' ); ?>
			</div>

			<?php
			$content = get_the_content();
			if ( $content ) :
			?>
				<div class="prose max-w-none text-gray-700 mb-8">
					<?php echo wp_kses_post( apply_filters( 'the_content', $content ) ); ?>
				</div>
			<?php endif; ?>

			<?php
			$gallery = estatein_field( 'gallery' );
			if ( ! empty( $gallery ) && is_array( $gallery ) ) :
			?>
				<section class="mt-8" aria-label="<?php esc_attr_e( 'Property Gallery', 'estatein' ); ?>">
					<h2 class="text-xl font-semibold text-gray-900 mb-4">
						<?php esc_html_e( 'Gallery', 'estatein' ); ?>
					</h2>
					<div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
						<?php foreach ( $gallery as $image ) :
							if ( empty( $image['ID'] ) ) {
								continue;
							}
						?>
							<div class="aspect-square overflow-hidden rounded-lg">
								<?php echo wp_get_attachment_image(
									(int) $image['ID'],
									'medium',
									false,
									[ 'class' => 'w-full h-full object-cover hover:scale-105 transition-transform' ]
								); ?>
							</div>
						<?php endforeach; ?>
					</div>
				</section>
			<?php endif; ?>

		</article>

	<?php endwhile; ?>

</main>

<?php get_footer(); ?>
