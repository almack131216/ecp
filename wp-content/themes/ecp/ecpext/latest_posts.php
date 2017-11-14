<?php
/**
 * Latest posts shortcode
 *
 * @package ecp
 */


// Add Shortcode for People
function show_latest_news( $atts ) {

	// Attributes
	$a = shortcode_atts(
		array(
			'count' => '3',
		),
		$atts
	);

    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => $a['count']
    );


    $string = '';
    $postsquery = new WP_Query( $args );
    if( $postsquery->have_posts() ){
        // $string .= '</div><div class="people-box">';
        $string .= '<div class="news-list">';
        while( $postsquery->have_posts() ){
            $postsquery->the_post();

            $string .= '<div class="one-post-in-list">';
            $string .= '<div class="featured-image-in-list">';
            $string .= '<a href="' . get_the_permalink() . '">';
            if ( has_post_thumbnail() ) {
                $string .= get_the_post_thumbnail(null, 'thumbnail');
            } else {
                $string .= '<img src="' . get_bloginfo('template_directory') . '/assets/150x115.png">';
            }
            $string .= '</a>';
            $string .= '</div>';
            $string .= '<div class="info-in-list">';
            $string .= '<div class="date-in-list">' . ecp_posted_on_simple_noecho() . '</div>';
            $string .= '<h4><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h4>';
            $string .= '</div>';
            $string .= '</div>';
        }
        $string .= '</div>';
    }
    wp_reset_postdata();
    return $string;

}
add_shortcode( 'show_latest_news', 'show_latest_news' );

