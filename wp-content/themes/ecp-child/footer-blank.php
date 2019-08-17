<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ecp
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">    
    <?php
      echo print_amcust_share_btns(); 
    ?>
		<div class="site-info">
      <div class="site-info-content">
        <span>&copy; The English College in Prague - Anglické gymnázium, o. p. s.,</span> <span>Sokolovská 320, Prague 9, Czech Republic</span>
  			<!-- <span class="sep"> | </span> -->
  			<?php // printf( esc_html__( 'Theme: %1$s by %2$s.', 'ecp' ), 'ecp', '<a href="https://twitter.com/dadc" rel="designer">dadc</a>' ); ?>
      </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<a href="#top" id="to-the-top"><i class="fa fa-chevron-up"></i></a>

<?php wp_footer(); ?>

</body>
</html>
