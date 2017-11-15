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


function amcust_sc_fact_container($atts = [], $content = null)
{
    // do something to $content 
    // run shortcode parser recursively
    $content = '<ul class="circle-container">'.do_shortcode($content).'</ul>';

    return $content;
}
add_shortcode( 'fact_container', 'amcust_sc_fact_container' );

function amcust_sc_fact_circle( $atts = array() ) {
    //requires 2 attributes (strong + small text)
    $circleContent = '<li class="circle"><div class="aligner">';
    $circleContent .= '<strong>'. $atts['strong'] .'</strong>';
    $circleContent .= '<span>'. $atts['small'] .'</span>';
    $circleContent .= '</div></li>';

    return $circleContent;
}
add_shortcode( 'fact_circle', 'amcust_sc_fact_circle' );