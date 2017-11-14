<?php
/**
 * ecp functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ecp
 */

if ( ! function_exists( 'ecp_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function ecp_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on ecp  use a find and replace
	 * to change 'ecp' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'ecp', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'toptopheader' => esc_html__( 'TopTop Header Menu', 'ecp' ),
		'contactus' => esc_html__( 'Contact Us Header Menu', 'ecp' ),
		'header' => esc_html__( 'Header Hamburger Menu', 'ecp' ),
    	'abovecontent' => esc_html__( 'Above Main Content', 'ecp' ),
    	'bellowcontent' => esc_html__( 'Bellow Main Content', 'ecp' ),
    	'footer' => esc_html__( 'Footer Full Menu', 'ecp' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'ecp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif;
add_action( 'after_setup_theme', 'ecp_setup' );



function insert_admin_stylesheet() {
	wp_register_style( 'admin_style', get_stylesheet_directory_uri() .  '/adminstyles.css', false, '1.0.0' );
	wp_enqueue_style( 'admin_style' );
}
add_action( 'admin_enqueue_scripts', 'insert_admin_stylesheet' );


add_editor_style();


function load_dashicons_front_end() {
  wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ecp_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ecp_content_width', 1250 );
}
add_action( 'after_setup_theme', 'ecp_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ecp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ecp' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ecp' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'ecp_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ecp_scripts() {
	wp_enqueue_style( 'ecp-style', get_stylesheet_uri() );

  wp_enqueue_script( 'ecp-dcscripts', get_template_directory_uri() . '/js/dcscripts.js', array('jquery'), false, true );

	// wp_enqueue_script( 'ecp-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'ecp-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ecp_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
// <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

require get_template_directory() . '/ecpext/slider.php';

require get_template_directory() . '/ecpext/key_services.php';

require get_template_directory() . '/ecpext/page_parts.php';

require get_template_directory() . '/ecpext/people.php';

require get_template_directory() . '/ecpext/shortcodes_layout.php';

require get_template_directory() . '/ecpext/latest_posts.php';

// function show_page_part($path) {
// 	$ppost = get_page_by_path($path, OBJECT, 'page_parts');
// 	$content = apply_filters('the_content', $ppost->post_content);
// 	echo $content;
// }



