<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css?v=200929', array(  ) );
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
        $tmpContent .= '<a class="disc '.$item['name'].'" title="'.$item['title'].'" href="'.$item['href'].'" target="_blank" rel="noopener noreferrer">';
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
    $styled = $atts['styled'] ? true : false;
    // $styled = true;
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

        $catPosts .= '<div class="mp-wrap_all '.($styled ? 'roots' : 'list').'">';

        $catPosts .= '<div class="mp-main-title">';
            $catPosts .= '<h1>'.get_cat_name($catId).'</h1>';
        $catPosts .= '</div>';
        // $catPosts .= '<div class="tree">';


        $catPosts .= '<div class="mp-wrap has-'.sizeof($subcategories).'-children">';
        
        

        foreach($subcategories as $subcategory) {
            $depthCount = $hasSsc ? 1 : 0;
            $catTitlesUsed = [];
            $catTitlesUsed[] = $catId;

            // $catPosts .= '<div class="mp-item">';
            $catPosts .= '<ul class="'.($styled ? 'mp-item' : 'mp-ul').'">';

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
                
                $catPosts .= '<a name="'.$subcategory->slug.'"></a>';
                $catPosts .= '<h4>';
                // $catPosts .= $depthCount.'. [';
                // for($i=0;$i<sizeof($catTitlesUsed);$i++){
                //     // if($i>0) $catPosts .= ', ';
                //     $catPosts .= '--'.$catTitlesUsed[$i].'--';
                // }
                // $catPosts .= '] ';
                // $catPosts .= '<a href="' . get_category_link( $subcategory->term_id ) . '" title="' . sprintf( __( "View all posts in %s" ), $subcategory->name ) . '" ' . '>';
                $catPosts .= $subcategory->name;
                // $catPosts .= ' ('.$subcategory->slug.')';
                // $catPosts .= '</a>';
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
                    'order' => 'DESC'
                    // 'meta_query' => array(
                    //     array(
                    //         'key' => '_thumbnail_id',
                    //         'compare' => 'EXISTS'
                    //     ),
                    // )
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
    // echo '<br>xxx '.$_GET['s'].' / '.get_query_var('s').' / '.get_query_var('sfind');
    // echo '<br>xxxx '.$_GET['sfind'].' / '.get_query_var('sfind').' / '.get_query_var('sfind');

    if(get_query_var('s')){
        $s = get_query_var('s');
        $sFind = get_query_var('s');
    }elseif($_GET['sfind']){
        $s = $_GET['sfind'];
        $sFind = $_GET['sfind'];
    }    
    // $sFind = get_query_var('s');

    //if searching...
    if($sFind){
        //load javascript functions below...
?>
<script type="text/javascript">
    // alert("searching...");
    // 1. run JavaScript after a complete page has loaded
    jQuery(window).bind("load", function() {
        //after #### time, highlightSearchWords()
        window.setTimeout(function(){
            highlightSearchWords("<?php echo $sFind; ?>"); },1000);
        // highlightSearchWords("<?php echo $sFind; ?>");
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

add_action('pre_get_posts', 'modified_search');
function modified_search($query){
    global $wp_query;
    if($wp_query->is_search){
        global $wpdb;
        // echo '<br>---functions<br>';
        $s_esc = esc_html($_REQUEST['s']);
        // $GLOBALS['wp_query']->query['s'] = $s_esc;
        // $GLOBALS['wp_the_query']->query_vars['s'] = $s_esc;
        set_query_var('s',$s_esc);
    }
}

// 201118_youtube-embed-fix
add_theme_support( 'responsive-embeds' );

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

// 210518
// REF: https://wordpress.stackexchange.com/questions/161476/how-to-remove-dashicons-min-css-from-frontend
add_action( 'wp_print_styles', 'amcust_dequeue_styles' );
function amcust_dequeue_styles() { 
    if ( ! is_user_logged_in() ) {
        wp_dequeue_style( 'dashicons' );
        wp_deregister_style( 'dashicons' );

        wp_dequeue_style( 'google-analytics-dashboard-for-wp' );
        wp_deregister_style( 'google-analytics-dashboard-for-wp' );        
    }
    //
    //GIT: CR | r1 | streamline css
    // DISABLE STYLESHEETS IN PLUGINS:
    // \wp-content\plugins\cookie-bar\cookie-bar.php
    // \wp-content\plugins\forget-about-shortcode-buttons\public\class-forget-about-shortcode-buttons-public.php
    //(END) CR | r1
    //GIT: CR | r2 | streamline css
    // \wp-content\plugins\tablepress\classes\class-css.php
    //(END) CR | r2
    //GIT: CR | r3 | streamline css
    // 
    //(END) CR | r3
}

function amcust_sc_embed_youtube( $atts = array() ) {
    //EXAMPLE: [embed_youtube v="3lLZxTzXf-Y" class="full margin-top-g2"][/embed_youtube]
    //parameters: v,class,title
    $appendClass = '';
    if($atts['class']) $appendClass = ' '.$atts['class'];

    $contentBuild = '<div class="youtube-wrap '.$appendClass.'">';
    if($atts['title']) $contentBuild .= '<h2>'.$atts['title'].'</h2>';
    $contentBuild .= '<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/'.$atts['v'].'?rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>';
    $contentBuild .= '</iframe>';
    $contentBuild .= '</div>';

    return $contentBuild;
}
add_shortcode( 'embed_youtube', 'amcust_sc_embed_youtube' );


/////////
// amgrid

function category_get_parent($catid){
    $category = get_category($catid);
    if ($category->category_parent > 0){
        return $category->category_parent;
    }
    return false;
}

add_action('wp_footer','amgrid_in_footer');
function amgrid_in_footer(){ // $tag variable is here
    //http://localhost:8080/ecp/more-programme/
    //load javascript functions below...
    global $post;

    if( amactive_is_localhost() ){
        $pageId = 927;
    }else{
        $pageId = 11720;
    }
    // if($post->ID === $pageId){//927
    if(has_shortcode($post->post_content, 'amgrid_posts')){
?>
<script type="text/javascript">
    // alert("? $post->ID: " + <?php echo $post->ID; ?>);
    init_amgrid();
    
    function init_amgrid(){
        // - Noel Delgado | @pixelia_me

        // alert('? JS - init_amgrid');

        const nodes = [].slice.call(document.querySelectorAll('li'), 0);
        const directions  = { 0: 'top', 1: 'right', 2: 'bottom', 3: 'left' };
        const classNames = ['in', 'out'].map((p) => Object.values(directions).map((d) => `${p}-${d}`)).reduce((a, b) => a.concat(b));

        const getDirectionKey = (ev, node) => {
            const { width, height, top, left } = node.getBoundingClientRect();
            const l = ev.pageX - (left + window.pageXOffset);
            const t = ev.pageY - (top + window.pageYOffset);
            const x = (l - (width/2) * (width > height ? (height/width) : 1));
            const y = (t - (height/2) * (height > width ? (width/height) : 1));
            return Math.round(Math.atan2(y, x) / 1.57079633 + 5) % 4;
        }

        class Item {
            constructor(element) {
                this.element = element;    
                this.element.addEventListener('mouseover', (ev) => this.update(ev, 'in'));
                this.element.addEventListener('mouseout', (ev) => this.update(ev, 'out'));
            }
            
            update(ev, prefix) {
                this.element.classList.remove(...classNames);
                this.element.classList.add(`${prefix}-${directions[getDirectionKey(ev, this.element)]}`);
            }
        }

        nodes.forEach(node => new Item(node));
    }

</script>
<?php
}//(END) if on grid page 
}//(END) amgrid_in_footer

/* list posts for AMGRID POSTS */
add_shortcode( 'amgrid_posts', function( $atts = [] ){	    
    $allTitlesUsed = [];
    $catPosts = '';

    $catId = $atts['cat_id'];//parent (root) categoryId
    $order_by = $atts['order_by'] ? $atts['order_by'] : 'all_order';
    $styled = $atts['styled'] ? true : false;
    $columns = $atts['columns'] ? $atts['columns'] : false;
    $devNotes = $atts['dev_notes'] ? true : false;
    $linkToPost = $atts['link_to_post'] ? true : false;
    $linkToTargetArr = $atts['link_to_target'] ? explode(',', $atts['link_to_target']) : false;
    if($linkToTargetArr){
        $catSkip = true;
        // $postIdsArr = $postIds;
        echo '<br>targets: ';
        print_r($linkToTargetArr);
    }

    $postIdsArr = $atts['post_ids'] ? explode(',', $atts['post_ids']) : null;
    if($postIdsArr){
        $catSkip = true;
        // $postIdsArr = $postIds;
        echo '<br>post_ids: ';
        print_r($postIdsArr);
    }
    $group = false;//$atts['group'] ? true : false;
    $catIdParent = $catId;
    $catIdParentDynamic = category_get_parent($catId);
    if($catIdParentDynamic) {
        // it has a parent
        $catIdParent = $catIdParentDynamic;
        if($devNotes) $catPosts .= '<h5 class="devNote">is child of '.$catIdParent.', group='.$group.'</h5>';
    }else{
        if($devNotes) $catPosts .= '<h5 class="devNote">IS PARENT CATEGORY, group='.$group.'</h5>';        
    }
    

    
    $allTitlesUsed[] = $catIdParent;

    $catDesc = false;//$atts['cat_desc'];

    if($devNotes) $catPosts .= '<h1 class="devNote">get_cat_name: '.get_cat_name($catId).' ['.$catId.'], order_by: '.$order_by.'</h1>';
    
    
    if($catSkip){
        $args = array(
            // 'cat' => $catId,
            'cat' => $catIdParent,
            'orderby' => 'all_order',
            'order' => 'ASC'
        );
    }else{
        $args = array(
            // 'cat' => $catId,
            'child_of' => $catIdParent,
            'orderby' => 'all_order',
            'order' => 'ASC'
        );
    }
    $subcategories = get_categories( $args );


    if(!$subcategories){    
        $catPosts .= '<h4>No items found</h4>';
    }else{
        $subcategoryCount = sizeof($subcategories);
        if($catSkip) $subcategoryCount = 1;
        // $subcategoryCounted = 0;
        $groupEnd = false;

        $catPosts .= '<div class="amgrid-wrap_all '.($styled ? 'roots' : 'list').'">';

        if($devNotes){
            $catPosts .= '<div class="devNote">';
                $catPosts .= '<h2>get_cat_name: '.get_cat_name($catId).', (subcategoryCount: '.$subcategoryCount.')</h2>';
            $catPosts .= '</div>';
        }
        

        $catPosts .= '<div class="amgrid-wrap_inner has-'.$subcategoryCount.'-children">';        

        foreach($subcategories as $subcategory) {
            $catTitlesUsed = [];
            $catTitlesUsed[] = $catId;

            if( ($catIdParent == $catId) || ($catIdParent != $catId && $subcategory->term_id == $catId) ){
                $subcategoryId = intval($subcategory->term_id);                
                // $catPosts .= '<ul class="'.($styled ? 'amgrid-item' : 'amgrid-ul').'">';//if(!$group) 
                // $catPosts .= '<li>';//if(!$group) 

                if($catId != $subcategory->category_parent) {
                    $catTitlesUsed[] = $subcategory->category_parent;
                    $allTitlesUsed[] = $subcategory->category_parent;
                }

                if( !in_array($subcategoryId, $catTitlesUsed)){
                    $catTitlesUsed[] = $subcategoryId;
                }
                
                $catPosts .= '<a name="'.$subcategory->slug.'"></a>';//if(!$group) 
                if($devNotes) $catPosts .= '<h4 class="devNote">$subcategory->name: '.$subcategory->name.' ['.$subcategoryId.'], order_by: '.$order_by.'</h4>';//if(!$group) 

                $postArgs = array(
                    'post_type'  => 'post',
                    'posts_per_page' => 100,
                    'cat' => $subcategoryId,
                    // 'category__in' => $subcategoryId,
                    'meta_key' => $order_by,
                    'orderby' => 'meta_value',//all_order
                    'order' => 'ASC',
                    'ignore_sticky_posts' => 1,
                    'meta_query' => array(
                        array(
                            'key' => '_thumbnail_id',
                            'compare' => 'EXISTS'
                        ),
                    )
                );

                if($postIdsArr){
                    $myarray = $postIdsArr;//3592,3604

                    $postArgs = array(
                        'post_type' => 'post',
                        'post__in'      => $myarray,
                        'orderby'=>'post__in',
                        'posts_per_page' => 100,
                        'ignore_sticky_posts' => 1,
                        'meta_query' => array(
                            array(
                                'key' => '_thumbnail_id',
                                'compare' => 'EXISTS'
                            ),
                        )
                    );
                }
                
                $featuredPosts = new WP_Query( $postArgs );//'type=post&posts_per_page=5'
                

                if( $featuredPosts->have_posts() ):
                    // $subcategoryCounted++;                    
                    $gridStart = '<div class="amgrid-wrap">';
                    $gridStart .= '<div class="container">';
                    $gridStart .= '<ul class="has-'.$columns.'-items">';
                    
                    $catPosts .= $gridStart;//if(!$group || $group && $subcategoryCounted == 1) 
                    
                    $postCount = 0;
                    while ( $featuredPosts->have_posts() ): $featuredPosts->the_post();
                    
                        $catQuoteField = '';
                        switch($subcategoryId){
                            case 3848: $catQuoteField = '';break;//Arts and PE
                            case 3840: $catQuoteField = '';break;//czech
                            case 3836: $catQuoteField = '';break;//english
                            case 1239:
                            case 3975: $catQuoteField = '';break;//governers
                            case 6796: $catQuoteField = 'graduates_quote';break;//graduates
                            case 1350:
                            case 2473: $catQuoteField = 'hof_quote';break;//head of faculties
                            case 3832: $catQuoteField = '';break;//humanities
                            case 2484: $catQuoteField = 'ib_quote';break;//IB
                            case 3844: $catQuoteField = '';break;//mathematics
                            case 3661: $catQuoteField = '';break;//modern foreign languages
                            case 2589: $catQuoteField = 'par_quote';break;//par
                            case 2591: $catQuoteField = 'pat_quote';break;//pat
                            case 3786: $catQuoteField = '';break;//science
                            case 1352:
                            case 2471: $catQuoteField = 'slt_quote';break;//slt
                            case 2479: $catQuoteField = 'st_quote';break;//st
                            case 2583: $catQuoteField = 'stu_quote';break;//stu
                            case 3701: $catQuoteField = '';break;//support
                            case 2477: $catQuoteField = 'tal_quote';break;//tal
                            case 3828: $catQuoteField = 'ust_quote';break;//ust
                        }
                        
                        
                        $thisPost = get_post();
                        if( has_post_thumbnail() ):
                            // $catPosts .= get_the_post_thumbnail( $thisPost->ID, 'thumbnail', array( 'class' => 'img-bg' ) );
                            $image_arr = wp_get_attachment_image_src( get_post_thumbnail_id($post_array->ID), 'medium' );
                        endif;
                        $metaString = get_metadata( 'post', $thisPost->ID, $catQuoteField, true );

                        $itemArr = array(
                            'title' => get_the_title(),
                            'subtitle' => get_metadata( 'post', $thisPost->ID, 'job_title', true ),
                            'quote' => $metaString && !is_array($metaString) ? $metaString : null,
                            'link_target' => $linkToTargetArr ? GenerateTabLink($linkToTargetArr[$postCount]) : null,
                            'link_post' => esc_url( get_the_permalink() ),
                            'thumb' => $image_arr ? $image_arr : null
                        );
                        $catPosts .= amgrid_listItem($itemArr);
                        
                        $postCount++;
                    endwhile;
                    //(END) while
                    
                    $gridEnd = '</ul>';//<!--['.$subcategoryCounted.'-'.$subcategoryCount.']-->
                    $gridEnd .= '</div>';
                    $gridEnd .= '</div>';

                    // if(!$group || $group && $subcategoryCounted == $subcategoryCount) $groupEnd = true;

                    $catPosts .= $gridEnd;                
                    wp_reset_postdata();                 
                    
                endif;

                // $catPosts .= '</li>';//if($groupEnd) 
                // $catPosts .= '</ul>';//if($groupEnd) //<!--[wrap '.$subcategoryCounted.'-'.$subcategoryCount.']-->
            }

            if($catSkip){
                break;
            }
        }
        //(END) foreach

        $catPosts .= '</div>';//(END) mp-wrap
        $catPosts .= '</div>';//(END) mp-wrap_all
    }

    return $catPosts;
});
// (END) amgrid
///////////////


function GenerateTabLink($getTarget){
    $url = strtok($_SERVER["REQUEST_URI"], '?');
    $tabUrl = $url.'?target='.$getTarget;
    return $tabUrl;
}


function amgrid_listItem($getItemArr){
    $listItem = '';
    $listItem .= '<li>';

    // $listItem .= '<div class="fade-bottom">';
    if($getItemArr['link_target']) $listItem .= '<a href="'.$getItemArr['link_target'].'" title="Link to '.$getItemArr['title'].'" class="read-more">Read More</a>';
    if($getItemArr['link_post'] && !$getItemArr['link_target']) $listItem .= '<a href="'.$getItemArr['link_post'].'" title="Link to '.$getItemArr['title'].'" class="read-more">Read More</a>';
    if(!$getItemArr['link_post'] && !$getItemArr['link_target']) $listItem .= '<div class="a-dummy"></div>';                                           
    // $listItem .= 'xxx</div>';
    //div.img-bg
    $listItem .= '<div class="img-bg">';
    if( $getItemArr['thumb'] ):                            
        $listItem .= '<img src="'.$getItemArr['thumb'][0].'">';                            
    endif;
    $listItem .= '<span class="txt-wrap">';
        $listItem .= '<span class="name">'.$getItemArr['title'].'</span>';
        $listItem .= '<span class="title">'.$getItemArr['subtitle'].'</span>';
    $listItem .= '</span>';
    $listItem .= '</div>';
    //(END) div.img-bg
    
    //div.info
    $listItem .= '<div class="info">';
        $listItem .= '<h3>'.$getItemArr['title'].'</h3>';
        $listItem .= '<div class="quote">';
        $listItem .= '<p>';                            
        
        if($getItemArr['quote']) $listItem .= $getItemArr['quote'];
        $listItem .= '</p>';
        $listItem .= '</div>';
    $listItem .= '</div>';
    //(END) div.info                        
    
    $listItem .= '</li>';

    return $listItem;
}