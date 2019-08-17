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
			echo do_shortcode('[ow_categories_with_subcategories_and_posts cat_id=1115 cat_desc="1"]');
		 
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

			endwhile; // End of the loop.
			//echo option_active_plugins();
			?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
get_footer('blank');
