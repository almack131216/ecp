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
    <div id="footer-social-icons">
      <a href="https://twitter.com/ecp_prague" target="_blank" title="">&#xf099;</a>
      <a href="https://www.facebook.com/englishcollege" target="_blank" title="">&#xf09a;</a>
      <a href="https://www.youtube.com/user/TheEnglishCollege" target="_blank" title="">&#xf167;</a>
      <a href="https://inewsletter.co/the-english-college-in-prague/latest" target="_blank" title="">&#xe800;</a>
    </div>
    <div class="site-footer-content">
      <!-- <h2>MENU</h2> -->
      <div id="footer-menu-ecp">
        <?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
      </div>
    </div>
		<div class="site-info">
      <div class="site-info-content">
        <span>&copy; The English College in Prague - Anglické gymnázium, o. p. s.,</span> <span>Sokolovská 320, Prague 9, Czech Republic</span>
  			<!-- <span class="sep"> | </span> -->
  			<?php // printf( esc_html__( 'Theme: %1$s by %2$s.', 'ecp' ), 'ecp', '<a href="https://twitter.com/dadc" rel="designer">dadc</a>' ); ?>
      </div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<a href="#top" id="to-the-top">▲</a>

<?php wp_footer(); ?>

</body>
</html>
