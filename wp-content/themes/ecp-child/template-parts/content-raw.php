<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ecp
 */

?>

<article id="post-<?php the_ID(); ?>" class="page">

	<div class="entry-content">
		<?php
			the_content();
		?>
	</div><!-- .entry-content -->

	
</article><!-- #post-## -->
