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
<a href="http://localhost:8080/ecp/contact-us/">Contact us</a>
    <?php
      echo print_amcust_share_btns(); 
    ?>

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
<a href="#top" id="to-the-top"><i class="fa fa-chevron-up"></i></a>

<?php
//echo '???' . $lang;
if ( $lang === 'cs') {
  ?>
<div id="mySidenav" class="sidenav cz">
  <a href="https://www.englishcollege.cz/cs/o-nas-a-jak-se-prihlasit/#jak-se-prihlasit" class="tab-apply">Přihlaste se</a>
  <a href="https://inewsletter.co/the-english-college-in-prague/latest" class="tab-newsletter" target="_blank">Newsletter</a>
</div>
<?php
} else {
	?>
<div id="mySidenav" class="sidenav">
  <a href="https://www.englishcollege.cz/why-us-how-to-apply/#how-to-apply" class="tab-apply">Apply Today</a>
  <a href="https://inewsletter.co/the-english-college-in-prague/latest" class="tab-newsletter" target="_blank">Newsletter</a>
</div>
<?php
}
?>

<?php wp_footer(); ?>

</body>
</html>
