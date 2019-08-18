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

    $catTitlesUsed = [];

    $catPosts = '<br><br>';
    print_r($atts);

    $catId = $atts['cat_id'];
    $catDesc = $atts['cat_desc'];
    $hasSc = $atts['has_sc'];
    $hasSsc = $atts['has_ssc'];

    $args = array(
        'child_of' => $catId,
        'orderby' => 'description',
        'order' => 'ASC'
    );
    
    //'include' => array(DV_category_News_id, DV_category_Testimonials_id);

    $subcategories = get_categories( $args );

    if($subcategories){
        

        foreach($subcategories as $subcategory) {
            
            if( !in_array($subcategory->name, $catTitlesUsed)){
                $catTitlesUsed[] = $subcategory->term_id;
                $catPosts .= '<h3>_____| ';
                if($subcategory->category_parent != $catId) $catPosts .= '_____| ';
                $catPosts .= $subcategory->name;
                $catPosts .= ' |_____</h3>';
            }

            // print_r($subcategory);
            $catPosts .= '<h3>1. [c'.$catId.' -> sc'.$subcategories[0]->term_id.'] SC: '.$subcategories[0]->name.'!!!</h3>';
            if($catDesc && $subcategories[0]->description) $catPosts .= '<p>Description: '.$subcategories[0]->description.'</p>';
            $catPosts .= '<ul>';

            if( ($catId != $subcategory->parent && $hasSsc) || ($catId == $subcategory->parent && !$hasSsc) ){

                

                $catPosts .= '<li>';

                

                $catPosts .= '<h3>2. [C'.$catId.' -> sc'.$subcategories[0]->term_id;
                if($subcategories[0]->term_id != $subcategory->term_id) $catPosts .= ' -> ssc'.$subcategory->term_id;
                $catPosts .= '] SSC: <a href="' . get_category_link( $subcategory->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $subcategory->name ) . '" ' . '>' . $subcategory->name.'</a> ('.$subcategory->count.')</h3> ';
                if($catDesc && $subcategory->description) $catPosts .= '<p>Description: '. $subcategory->description . '</p>';
                // echo '<p>Subcat ID: '. $subcategory->term_id . '</p>'; 
                

                $postArgs = array(
                    'post_type'  => 'post',
                    'posts_per_page' => 10,
                    'cat' => $subcategory->term_id,
                    // 'category__in' => $subcategory->term_id,
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
                    //     // print_r($subcategory);
                    //     echo $subcategory->name;
                    //     // echo amactive_return_title_splitter( array('cat' => $subcategory->term_id) );
                    //     echo '<hr/>';
                    //     echo '</div>';
                    // echo '</div>';
                    
                    $catPosts .= '<ul>';
                    // echo '<h3>'.$subcategory->description.'</h3>';
                    while ( $featuredPosts->have_posts() ): $featuredPosts->the_post();  
                    
                    $thisPost = get_post();
                    $catPosts .= '<li>';
                    // $tmp = get_the_category($thisPost->ID);
                    // print_r($tmp);
                    // $catPosts .= '<h2>catName? '.$tmp[sizeof($tmp)-1]->cat_name.' ('.sizeof($tmp).')</h2>';
                    // print_r($tmp);             
                        // echo '<div class="row">';
                        // echo '<div class="col-xs-12">';
                        $catPosts .= '<div class="col-md-6 col-sm-6 col-xs-12 col-portfolio-item item-is-grid is-white">';
                        // get_template_part('content');
                        // $catPosts .= get_template_part('content', 'list-item');
                        $catPosts .= '<a href="'. esc_url( get_the_permalink() ) .'" title="Link to '.get_the_title().'">';
                        if( has_post_thumbnail() ):
                            $catPosts .= get_the_post_thumbnail( $thisPost->ID, 'thumbnail' );
                        endif;
                        $catPosts .= get_the_title().' ('.$thisPost->ID.')</a>';

                        
                        // $catPosts .= $featuredPosts->post_title;
                        // $catPosts .= do_shortcode('[display-posts id="7200" include_content="true" image_size="thumbnail" wrapper="div"]');
                        // print_r($featuredPosts);
                        $catPosts .= '</div>';                
                        // echo '</div>';
                        // echo '</div>';
                        $catPosts .= '</li>';
                    endwhile;
                    $catPosts .= '</ul>';
                    
                    wp_reset_postdata();
                    
                    $catPosts .= '</li>';
                endif;

                $catPosts .= '<hr/>';
            }

            $catPosts .= '</ul>';
        }
        $catPosts .= '<hr/>';
    }

    return $catPosts;

    // echo do_shortcode('[/show_more]');
    // echo '</div>';//.expandable


});
// ow_categories_with_subcategories_and_posts( 'more-programme', 'post' );

function category_has_parent($catid){
    $category = get_category($catid);
    if ($category->category_parent > 0){
        return true;
    }
    return false;
}

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