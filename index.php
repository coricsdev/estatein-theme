<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'template-parts/layout/header' );
?>

<main id="main-content" class="site-main">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
	else :
		echo '<p>' . esc_html__( 'No content found.', 'estatein' ) . '</p>';
	endif;
	?>
</main>

<?php get_template_part( 'template-parts/layout/footer' ); ?>