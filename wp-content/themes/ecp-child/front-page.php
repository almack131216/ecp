<?php
/**
 * The homepage template file.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ecp
 */

get_header(); ?>
	
	<?php //get_template_part( 'template-parts/carpet', 'none') ?>
	<?php get_template_part( 'template-parts/content-banner-event', 'slider') ?>
	<?php get_template_part( 'template-parts/content', 'slider') ?>

	<?php // echo display_key_services_boxes() ?>
	<!-- <div class="carpet">
		<h1 class="claim">Successful students<br />are compassionate ones</h1>
	</div> -->

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'hp' );

			endwhile;
			?>


		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
// get_sidebar();
get_footer();
