<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

add_theme_support( 'post-thumbnails' );

function amcust_sc_fact_container($atts = [], $content = null)
{
    // do something to $content 
    // run shortcode parser recursively
    $contentBuild = '<div class="circle-container-wrap">';
    if($atts['title']) $contentBuild .= '<h2>'.$atts['title'].'</h2>';
    $contentBuild .= '<ul class="circle-container">'.do_shortcode($content).'</ul></div>';

    return $contentBuild;
}
add_shortcode( 'fact_container', 'amcust_sc_fact_container' );

function amcust_sc_fact_circle( $atts = array() ) {
    //requires 2 attributes (strong + small text)
    $appendClass = '';
    if($atts['class']) $appendClass = ' '.$atts['class'];

    $contentBuild = '<li class="circle"><div class="aligner'.$appendClass.'">';
    $contentBuild .= '<strong>'. $atts['strong'] .'</strong>';
    $contentBuild .= '<span>'. $atts['small'] .'</span>';
    $contentBuild .= '</div></li>';

    return $contentBuild;
}
add_shortcode( 'fact_circle', 'amcust_sc_fact_circle' );


add_shortcode('amcust_share_btns', 'print_amcust_share_btns');
function print_amcust_share_btns() {
    $tmpArray = Array();
    $tmpArray['twitter'] = Array('name'=>'twitter', 'title'=>'Twitter - English College in Prague', 'href'=>'https://twitter.com/ecp_prague', 'fa'=>'fa-twitter');
    $tmpArray['facebook'] = Array('name'=>'facebook', 'title'=>'Facebook - English College in Prague', 'href'=>'https://www.facebook.com/englishcollege', 'fa'=>'fa-facebook');
    $tmpArray['youtube'] = Array('name'=>'youtube', 'title'=>'YouTube Channel - English College in Prague', 'href'=>'https://www.youtube.com/user/TheEnglishCollege', 'fa'=>'fa-youtube');
    $tmpArray['newsletter'] = Array('name'=>'newsletter', 'title'=>'Newsletter', 'href'=>'https://inewsletter.co/the-english-college-in-prague/latest', 'fa'=>'fa-file-text-o');
    
    // $tmpContent .= '<a class="social" title="Twitter - English College in Prague" href="https://twitter.com/ecp_prague" target="_blank" rel="noopener noreferrer"><i class="fa fa-lg fa-twitter"></i>twitter</a>';
    // $tmpContent .= '<a class="social" title="Facebook - English College in Prague" href="https://www.facebook.com/englishcollege" target="_blank" rel="noopener noreferrer"><i class="fa fa-lg fa-facebook"></i>facebook</a>';
    // $tmpContent .= '<a class="social" title="YouTube Channel - English College in Prague" href="https://www.youtube.com/user/TheEnglishCollege" target="_blank" rel="noopener noreferrer"><i class="fa fa-lg fa-youtube"></i>youtube</a>';
    // $tmpContent .= '<a class="social" title="Newsletter" href="https://inewsletter.co/the-english-college-in-prague/latest" target="_blank" rel="noopener noreferrer"><i class="fa fa-lg fa-file-text-o"></i>newsletter</a>';
    
    $tmpContent = '<div class="contactus-social-icons-wrap">';
    $tmpContent .= '<div class="contactus-social-icons">';
    foreach($tmpArray as $item) {
        $tmpContent .= '<a class="social" title="'.$item['title'].'" href="'.$item['href'].'" target="_blank" rel="noopener noreferrer">';
        $tmpContent .= '<i class="fa fa-lg '.$item['fa'].'"></i></a>';
    }
    $tmpContent .= '</div>';
    $tmpContent .= '</div>';

    return $tmpContent;
	//return do_shortcode("[pagepart slug='more-information-share']");
}