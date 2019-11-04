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
    $tmpArray['instagram'] = Array('name'=>'instagram', 'title'=>'Instagram - English College in Prague', 'href'=>'https://www.instagram.com/ecp_prague', 'fa'=>'fa-instagram');
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

    $depthCount = 0;
    $allTitlesUsed = [];
    $catPosts = '';
    // print_r($atts);

    $catId = $atts['cat_id'];//parent (root) categoryId
    $allTitlesUsed[] = $catId;

    $catDesc = false;//$atts['cat_desc'];
    $hasSsc = $atts['depth'] == 2 ? true : false;//sub-subcategories?

    // $catPosts .= '<h1>'.$depthCount.'. '.get_cat_name($catId).' ['.$catId.']</h1>';
    
    $args = array(
        'child_of' => $catId,
        'orderby' => 'description',
        'order' => 'ASC'
    );    
    //'include' => array(DV_category_News_id, DV_category_Testimonials_id);

    $subcategories = get_categories( $args );

    if($subcategories){        
        // $depthCount++;

        $catPosts .= '<div class="mp-wrap_all">';
        $catPosts .= '<div class="mp-wrap has-'.sizeof($subcategories).'-children">';
        
        $catPosts .= '<div class="mp-main-title has-4-children">';
            $catPosts .= '<h1>'.get_cat_name($catId).'</h1>';
        $catPosts .= '</div>';
        // $catPosts .= '<div class="tree">';

        foreach($subcategories as $subcategory) {
            $depthCount = $hasSsc ? 1 : 0;
            $catTitlesUsed = [];
            $catTitlesUsed[] = $catId;

            // $catPosts .= '<div class="mp-item">';
            $catPosts .= '<ul class="mp-item">';

            if( ($catId != $subcategory->parent && $hasSsc) || ($catId == $subcategory->parent && !$hasSsc) ){

                $catPosts .= '<li>';

                if($catId != $subcategory->category_parent) {
                    if(!in_array($subcategory->category_parent, $allTitlesUsed)){
                        // $catPosts .= '<h1>'.$depthCount.'. '.get_cat_name($subcategory->category_parent).' ['.$subcategory->category_parent.']</h1>';
                        // $catPosts .= '<h2>'.get_cat_name($subcategory->category_parent).'</h2>';
                    }
                    $catTitlesUsed[] = $subcategory->category_parent;
                    $allTitlesUsed[] = $subcategory->category_parent;
                    // if(!in_array()) $catPosts .= '<h5>['.get_cat_name($subcategory->category_parent).']</h5>';
                }

                if( !in_array($subcategory->term_id, $catTitlesUsed)){
                    // $depthCount++;
                    // // $catPosts .= '<h1>'.$depthCount.'. '.get_cat_name($subcategory->term_id).' ['.$subcategory->term_id.']</h1>';
                    // $catPosts .= '<h3>'.get_cat_name($subcategory->term_id).'</h3>';
                    $catTitlesUsed[] = $subcategory->term_id;
                }
                

                $catPosts .= '<h4>';
                // $catPosts .= $depthCount.'. [';
                // for($i=0;$i<sizeof($catTitlesUsed);$i++){
                //     // if($i>0) $catPosts .= ', ';
                //     $catPosts .= '--'.$catTitlesUsed[$i].'--';
                // }
                // $catPosts .= '] ';
                $catPosts .= '<a href="' . get_category_link( $subcategory->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $subcategory->name ) . '" ' . '>' . $subcategory->name.'</a>';
                // $catPosts .= ' ('.$subcategory->count.')';
                $catPosts .= '</h4>';
                
                // if($catDesc && $subcategory->description) $catPosts .= '<p>Description: '. $subcategory->description . '</p>';
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
                    
                    $catPosts .= '<ul class="ul-posts">';
                    
                    while ( $featuredPosts->have_posts() ): $featuredPosts->the_post();                    
                        $thisPost = get_post();
                        $catPosts .= '<li class="li-post">';
                        // $tmp = get_the_category($thisPost->ID);
                        // print_r($tmp);
                        // $catPosts .= '<h2>catName? '.$tmp[sizeof($tmp)-1]->cat_name.' ('.sizeof($tmp).')</h2>';
                        // print_r($tmp);             
                        // echo '<div class="row">';
                        // echo '<div class="col-xs-12">';
                        $catPosts .= '<div>';
                        // get_template_part('content');
                        // $catPosts .= get_template_part('content', 'list-item');
                        $catPosts .= '<h5>';
                        $catPosts .= '<a href="'. esc_url( get_the_permalink() ) .'" title="Link to '.get_the_title().'">';
                        // if( has_post_thumbnail() ):
                        //     $catPosts .= get_the_post_thumbnail( $thisPost->ID, 'thumbnail' );
                        // endif;
                        $catPosts .= get_the_title();
                        // $catPosts .= .' ('.$thisPost->ID.')';
                        $catPosts .= '</a>';
                        $catPosts .= '</h5>';
                        // $catPosts .= 'x';

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
                    
                    
                endif;

                $catPosts .= '</li>';
                // $catPosts .= '<hr/>';
            }

            $catPosts .= '</ul>';
            // $catPosts .= '</div>';//(END) ul-wrap
        }
        // $catPosts .= '</div>';//(END) tree
        $catPosts .= '</div>';//(END) mp-wrap
        $catPosts .= '</div>';//(END) mp-wrap_all
    }

    return $catPosts;
});


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

// if on localhost...
function amactive_is_localhost() {    
    if($_SERVER['HTTP_HOST']=="localhost:8080") return true;
    return false;   
}

// add highlight_search_term .js file
function my_theme_scripts_function() {
    if( amactive_is_localhost() ){
        // https://johannburkard.de/blog/programming/javascript/highlight-javascript-text-higlighting-jquery-plugin.html
        // https://www.jqueryscript.net/demo/jQuery-Plugin-To-Highlight-Searched-Text-In-A-Certain-Container-highlight-js/
        wp_enqueue_script( 'highlight_search_term', get_template_directory_uri().'-child/amadded/jquery.highlight-5.js' );
    }else{
        wp_enqueue_script( 'highlight_search_term', get_template_directory_uri().'-child/amadded/jquery.highlight-5.js' );
    }
}
add_action('wp_enqueue_scripts','my_theme_scripts_function');

// if searching...
// highlight search term
// scrollTo search term
add_action('wp_footer','myscript_in_footer');
function myscript_in_footer(){
    $s = get_query_var('s');
    //if searching...
    if($s){
        //load javascript functions below...
?>
<script type="text/javascript">
    // 1. run JavaScript after a complete page has loaded
    jQuery(window).bind("load", function() {
        //after #### time, highlightSearchWords()
        window.setTimeout(function(){
            highlightSearchWords("<?php echo $s; ?>"); },1000);
        // highlightSearchWords("<?php echo $s; ?>");
    });

    // 2. highlightSearchWords
    function highlightSearchWords(getSearchTerm){
        console.log(getSearchTerm);
        jQuery("body").highlight(getSearchTerm);

        if(jQuery("body").highlight(getSearchTerm)){
            highlightScrollToWord();
        }                
    }

    // 3. ScrollTo first instance of word
    function highlightScrollToWord(){
        var scrollTo = jQuery('.highlight:nth-child(1)').offset();
        var top = (scrollTo || { "top": NaN }).top;
        var vOffset = 100;
        if (isNaN(top)) {
            // alert(getSearchTerm + ' - COUNT: ' + jQuery('.search-excerpt').length);
            console.log("No keyword match found");
        } else {
            console.log('Keyword match found at: ' + top);
            jQuery('html, body').animate({scrollTop: top - vOffset},1000);
        }
    }

</script>
<?php
    }
    // (END) if searching...
}



// function wps_highlight_results($text){
//     if(is_search()){
//         $sr = get_query_var('s');
//         $keys = explode(" ",$sr);
//         $text = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">'.$sr.'</strong>', $text);
//     }
//     return $text;
// }
// add_filter('the_excerpt', 'wps_highlight_results');
// add_filter('the_title', 'wps_highlight_results');
// add_filter('the_content', 'wps_highlight_results');
// add_filter('get_the_content', 'wps_highlight_results');