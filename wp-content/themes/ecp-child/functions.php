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

function remove_all_theme_styles() {
    if ( is_page_template('page-blank.php') ) {
        global $wp_styles;
        $wp_styles->queue = array();
        //wp_register_style( 'hotspots', 'https://www.englishcollege.cz/wp-content/plugins/draw-attention/public/assets/css/public.css', false, '1.8.17' );
        //wp_enqueue_style( 'hotspots' );
    }
}
// add_action('wp_print_styles', 'remove_all_theme_styles', 100);

/**
 * @package active-plugins
 * @version 1.0
 *
 * Plugin Name: Active Plugins
 * Plugin URI: http://wordpress.org/extend/plugins/#
 * Description: This is a development plugin 
 * Author: Your Name
 * Version: 1.0
 * Author URI: https://example.com/
 */
add_shortcode( 'activeplugins', function(){	
	$active_plugins = get_option( 'active_plugins' );
	$plugins = "";
	if( count( $active_plugins ) > 0 ){
		$plugins = "<ul>";
		foreach ( $active_plugins as $plugin ) {
			$plugins .= "<li>" . $plugin . "</li>";
		}
		$plugins .= "</ul>";
	}
	return $plugins;
});



/*
Plugin Name: Disable CF7 plugin
Plugin URI: http://www.damiencarbery.com
Description: Disable Contact Form 7 plugin except for certain pages.
Author: Damien Carbery
Version: $Revision: $
$Id: $
*/
add_filter( 'option_active_plugins', 'disable_plugins_per_page' );
function disable_plugins_per_page( $plugin_list ) {
    // Quit immediately if in admin area.
    if ( is_admin() ) {
        return $plugin_list;
    }
    $disable_plugins = array (
      // Plugin Name => Urls *not* to disable on.
      'jetpack/jetpack.php',
      'advanced-custom-fields-pro/acf.php'
    );
    $plugins_to_disable = array();
    foreach ( $plugin_list as $plugin ) {
        if (true == array_key_exists( $plugin, $disable_plugins ) ) {
            //error_log( "Found $plugin in list of active plugins." );
            //if ( false === array_search( $_SERVER['REQUEST_URI'], $disable_plugins[ $plugin ] ) ) {
                //error_log( "Disable $plugin on ".$_SERVER['REQUEST_URI']."." );
                //$plugins_to_disable[] = $plugin;
            //}
        }
    }
    // If there are plugins to disable then remove them from the list,
    // otherwise return the original list.
    $plugins_to_disable[] = 'jetpack/jetpack.php';
    $plugins_to_disable[] = 'js_composer/js_composer.php';
    $plugins_to_disable[] = 'wordpress-seo-premium/wp-seo-premium.php';
        if ( count( $plugins_to_disable ) ) {
        $new_list = array_diff( $plugin_list, $plugins_to_disable );
        return $new_list;
    }
    else {
        return $plugin_list;
    }
}

/*
    //'include' => array(DV_category_News_id, DV_category_Press_id, DV_category_Testimonials_id)
    $args_cat = array(
        'orderby' => 'description',
        'order' => 'ASC',
        'include' => array(1115)
    );

    $categories = get_categories( $args_cat );

    //var_dump($categories);
    foreach($categories as $category):

        


        

    endforeach;
    */


/* list posts for MORE PROGRAMME */
add_shortcode( 'ow_categories_with_subcategories_and_posts', function( $atts = [] ){	

    echo '<br><br>';
    print_r($atts);

    $catId = $atts['cat_id'];
    $catDesc = $atts['cat_desc'];

    $args = array('child_of' => $catId);
    $categories = get_categories( $args );

    if($categories){
        echo '<ul>';

        foreach($categories as $category) {
            
            if($catId != $category->parent){
                echo '<li>';
                echo '<h3>['.$category->parent.'] cat: <a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> ('.$category->count.')</h3> ';
                if($catDesc && $category->description) echo '<p> Description: '. $category->description . '</p>';
                // echo '<p>Subcat ID: '. $category->term_id . '</p>'; 
                
                // $args = array(
                //     'type' => 'post',
                //     'posts_per_page' => 4,
                //     'orderby' => 'post_date',
                //     'order' => 'DESC',
                //     'cat' => 2,
                //     'category__not_in' => 38,
                //     'meta_query' => array(
                //         array(
                //             'key' => '_thumbnail_id',
                //             'compare' => 'EXISTS'
                //         ),
                //     )
                // );
                // $carousel = new WP_Query( $args );
                // if( $carousel->have_posts() ):

                $postArgs = array(
                    'post_type'  => 'post',
                    'posts_per_page' => 10,
                    'cat' => $category->term_id,
                    // 'category__in' => $category->term_id,
                    'orderby' => 'post_date',
                    'order' => 'DESC',
                    'meta_query' => array(
                        array(
                            'key' => '_thumbnail_id',
                            'compare' => 'EXISTS'
                        ),
                    )
                );
                $featuredPosts = new WP_Query( $postArgs );//'type=post&posts_per_page=5'
                if( $featuredPosts->have_posts() ):            
                    // echo '<div class="row row-homepage-wrap">';
                    //     echo '<div class="col-md-12">';
                    //     // print_r($category);
                    //     echo $category->name;
                    //     // echo amactive_return_title_splitter( array('cat' => $category->term_id) );
                    //     echo '<hr/>';
                    //     echo '</div>';
                    // echo '</div>';
                    
                    echo '<ul>';
                    // echo '<h3>'.$category->description.'</h3>';
                    while ( $featuredPosts->have_posts() ): $featuredPosts->the_post();   
                        echo '<li>';             
                        // echo '<div class="row">';
                        // echo '<div class="col-xs-12">';
                        echo '<div class="col-md-6 col-sm-6 col-xs-12 col-portfolio-item item-is-grid is-white">';
                        // get_template_part('content');
                        get_template_part('content', 'list-item');
                        echo $featuredPosts->post_title;
                        echo '</div>';                
                        // echo '</div>';
                        // echo '</div>';
                        echo '</li>';
                    endwhile;
                    echo '</ul>';
                    
                    wp_reset_postdata();
                    
                    echo '</li>';
                endif;

                echo '<hr/>';
            }
        }
        echo '<hr/>';
    }

    // 40 - news
    // 4 - press
    // 3 testimonials


});
// ow_categories_with_subcategories_and_posts( 'more-programme', 'post' );

function get_first_paragraph( $getArr ){
    global $post;
    $str = wpautop( get_the_content() );
    $str = substr( $str, 0, strpos( $str, '</p>' ) + 4 );
    $str = strip_tags($str, '<a><strong><em>');

    $str .= $getArr['readmore'];

    if( $getArr['readmore'] ){
        $str .= '&nbsp;<a href="'.esc_url( get_permalink() ).'" title="Link to '.get_the_title().'">';
        $str .= '[Read&nbsp;More]';
        $str .= '</a>';
    }

    return '<p class="hidden-xs-down">' . $str . '</p>';
    // global $post, $posts;
    // $post_content = $post->post_content;
    // $post_content = apply_filters('the_content', $post_content);
    // $post_content = str_replace('</p>', '', $post_content);
    // $paras = explode('<p>', $post_content);
    // array_shift($paras);

    // return $paras[0];
}