<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ecp
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		?>		
	</header><!-- .entry-header -->

	<div class="amcust-news-wrap">
		<div class="col-brief">
			<?php
			if(in_category( 4787 )){
				echo '<a href="/test-resp-img-map/" class="btn-back-to-tree"><span>tree</span></a>';
			}

			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php ecp_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php
			endif; ?>

			<div class="contactus-social-icons-wrap text-align-left">
				<h4>Share this article</h4>
				<div class="contactus-social-icons">
					<a class="social disc" title="Share on Twitter" href="https://twitter.com/intent/tweet?url=<?php echo(urlencode( get_post_permalink() )) ?>&text=<?php echo( urlencode(get_the_title() ) ) ?>"><i class="fa fa-lg fa-twitter"></i></a>
					<a class="social disc" title="Share on Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo(urlencode( get_post_permalink() )) ?>"><i class="fa fa-lg fa-facebook"></i></a>
				</div>
			</div>
			
		</div>
		<div class="col-content">
			<?php
				if ( has_post_thumbnail() ) {
					$appendClass = '';
					if(in_category( 2467 ) || in_category( 2469 )) $appendClass .= ' float-image-right';
					echo('<div class="post-featured-image'.$appendClass.'">');					
					the_post_thumbnail('large');
					echo('</div>');
				}
			?>

			<div class="entry-content">
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
		</div>
	</div>

	<footer class="entry-footer">
		<?php ecp_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
