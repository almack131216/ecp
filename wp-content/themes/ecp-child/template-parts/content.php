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

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ecp_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	
	<?php
		if ( has_post_thumbnail() ) {
			echo('<div class="post-featured-image">');
			the_post_thumbnail();
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

		<div class="post-sharing-icons">
			<span class="dashicons"><a href="https://twitter.com/intent/tweet?url=<?php echo(urlencode( get_post_permalink() )) ?>&text=<?php echo( urlencode(get_the_title() ) ) ?>"></a></span>
			<span class="dashicons"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo(urlencode( get_post_permalink() )) ?>"></a></span>
		</div>

	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php ecp_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
