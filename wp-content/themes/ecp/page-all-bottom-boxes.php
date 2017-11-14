<?php
/**
 * Template Name: All 4 bottom boxes
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ecp
 */

get_header(); ?>

	<?php // echo display_key_services_menu(get_the_ID()) ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				// if ( comments_open() || get_comments_number() ) :
				// 	comments_template();
				// endif;

				// echo get_page_part_content('more-information');

				// echo('HUHUHUHUUHU');

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php //echo display_more_info_box() ?>

	<div class="full-width four-main-section all-four-display">
		<?php echo display_key_services_boxes_bottom(get_the_ID()) ?>
	</div>

<?php
// get_sidebar();
get_footer();
