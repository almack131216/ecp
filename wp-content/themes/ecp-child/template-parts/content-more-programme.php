<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ecp
 */
$categoryMore = 5364;
if(amactive_is_localhost()) $categoryMore = 1115;
$categoryMoreLink = '<div class="back-to-tree-wrap"><a href="/daily-life-activities/#more-programme" class="back-to-tree in-content"><span>:more programme</span></a></div>';
if ($lang === 'cs') $categoryMoreLink = '<div class="back-to-tree-wrap"><a href="/cs/zazit-vice/" class="back-to-tree in-content"><span>program :more</span></a></div>';
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("post-more-programme"); ?>>
	<header class="entry-header more-post-header">
		<?php
			if(in_category( $categoryMore )){
				echo $categoryMoreLink;
			}
			the_title( '<h1 class="entry-title text-align-center">', '</h1>' );
		?>		
	</header><!-- .entry-header -->

	<div class="amcust-news-wrap">
		<div class="col-content full-width">
			<div class="entry-content">
				<?php
					if ( has_post_thumbnail() ) {
						$appendClass = '';
						if(in_category( 2467 ) || in_category( 2469 )) $appendClass .= ' float-image-right';
						echo('<div class="post-featured-image'.$appendClass.'">');					
						the_post_thumbnail('large');
						echo('</div>');
					}
				?>
				<?php
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ecp' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ecp' ),
						'after'  => '</div>',
					) );
				?>
			</div><!-- .entry-content -->
			<?php
			if(in_category( $categoryMore )){
				echo $categoryMoreLink;
			}
			?>
		</div>
	</div>

	<footer class="entry-footer">
		<?php ecp_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
