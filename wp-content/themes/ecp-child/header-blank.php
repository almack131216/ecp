<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * <!DOCTYPE html>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ecp
 */

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400|Playfair+Display:400,700,700i&amp;subset=latin-ext" rel="stylesheet"> -->
<!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,700i|Open+Sans:300,300i,400&amp;subset=latin-ext" rel="stylesheet"> -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400|Ubuntu:400,700,700i&amp;subset=latin-ext" rel="stylesheet">
<script src="https://use.typekit.net/pea3abk.js"></script>
<script>try{Typekit.load({ async: true });}catch(e){}</script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ecp' ); ?></a>
  <div id="toptop" style="display:none;">
    <?php wp_nav_menu( array( 'theme_location' => 'toptopheader', 'menu_id' => 'toptop' ) ); ?>
  </div>

	<header id="masthead" class="site-header" role="banner">
    <div class="page-box" style="display:none;">
  		<div class="site-branding bigger-emblem">
  			<?php
        $imgLogo = '/assets/ECP-logo-full-white-transparent-25-year-190418.png';
			//$imgLogo = '/assets/ECP-logo-full-white-transparent.svg';

  			if ( is_front_page() && is_home() ) : ?>
  				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php bloginfo('template_directory');echo $imgLogo; ?>" alt="English College Prague" class="site-logo"></a></h1>
  			<?php else : ?>
  				<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php bloginfo('template_directory');echo $imgLogo; ?>" alt="English College Prague" class="site-logo"></a></div>
  			<?php
  			endif;

  			$description = get_bloginfo( 'description', 'display' );
  			if ( $description || is_customize_preview() ) : ?>
  				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
  			<?php
  			endif; ?>
  		</div><!-- .site-branding -->

      <div class="headerbuttons">
        <div class="first-line">
          <div class="search-box"><?php get_search_form(); ?></div>
          <nav id="site-navigation" class="main-navigation" role="navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><i class="fa fa-bars"></i></button>
            <?php // wp_nav_menu( array( 'theme_location' => 'header', 'menu_id' => 'header-menu' ) ); ?>
          </nav><!-- #site-navigation -->
        </div>
    		
        <div id="menucontactus"><?php wp_nav_menu( array( 'theme_location' => 'contactus', 'menu_id' => 'contactus' ) ); ?></div>
      </div>
    </div><!-- page-box -->

	</header><!-- #masthead -->

	<div id="content" class="site-content">

    <div id="toggleable-menu" class="x" style="display:none;">
      <?php wp_nav_menu( array( 'theme_location' => 'header', 'menu_id' => 'header-menu' ) ); ?>
    </div>
