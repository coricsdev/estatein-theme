<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main-content" class="max-w-7xl mx-auto px-4 py-10">

	<header class="mb-8">
		<h1 class="text-3xl font-bold text-gray-900">
			<?php esc_html_e( 'Properties', 'estatein' ); ?>
		</h1>
	</header>

	<?php if ( have_posts() ) : ?>

		<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template-parts/property/card' ); ?>
			<?php endwhile; ?>
		</div>

		<div class="mt-10">
			<?php the_posts_pagination( [
				'prev_text' => __( '&laquo; Previous', 'estatein' ),
				'next_text' => __( 'Next &raquo;', 'estatein' ),
			] ); ?>
		</div>

	<?php else : ?>

		<p class="text-gray-500">
			<?php esc_html_e( 'No properties found.', 'estatein' ); ?>
		</p>

	<?php endif; ?>

</main>

<?php get_footer(); ?>
