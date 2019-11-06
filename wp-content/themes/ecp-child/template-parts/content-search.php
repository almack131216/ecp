<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ecp
 */

// $amcust_highlight = false;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		// if(!$amcust_highlight){
			the_title( sprintf( '<h2 class="entry-title"><a href="%s?sfind='.$s.'" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
		// }else{
		// 	$title = html_entity_decode(get_the_title());
		// 	$keys= explode(" ",$s);
		// 	$title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title);
		// 	echo '<h2 class="entry-title"><a href="'.esc_url( get_permalink() ).'?s='.$s.'" rel="bookmark">'. $title .'</a></h2>';
		// }
		 ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ecp_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php
		// if(!$amcust_highlight){
			the_excerpt();
		// }else{
		// 	$excerpt = html_entity_decode(get_the_excerpt());
		// 	$keys= explode(" ",$s);
		// 	$excerpt = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $excerpt);

		// 	echo $excerpt;
		// }
		?>
	</div><!-- .entry-summary -->

	<footer class="entry-footer">
		<?php ecp_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->