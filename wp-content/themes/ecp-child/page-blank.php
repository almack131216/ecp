<?php
/* Template Name: Blank Page */
/**
 * The template for displaying bespoke, raw pages.
 *
 * @package ecp
 */
get_header('blank'); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
		 
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer('blank');
