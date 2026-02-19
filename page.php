<?php
declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_template_part( 'template-parts/layout/header' );
?>

<main id="main-content" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php get_template_part( 'template-parts/layout/footer' ); ?>