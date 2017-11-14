<?php
/**
 * Page Parts helpers
 *
 * @package ecp
 */

function one_half_column( $atts, $content = null ) {
	return '<div class="one-half-column">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'one_half_column', 'one_half_column' );


function first_half_column( $atts, $content = null ) {
	return '<div class="first-half-column">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'first_half_column', 'first_half_column' );


function second_half_column( $atts, $content = null ) {
	return '<div class="second-half-column">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'second_half_column', 'second_half_column' );



function text_left_image_right_section( $atts, $content = null ) {
	return '<div class="text_left_image_right_section">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'text_left_image_right_section', 'text_left_image_right_section' );


function row_box( $atts, $content = null ) {
	return '<div class="row-box">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'row_box', 'row_box' );

function one_third( $atts, $content = null ) {
	return '<div class="one-third">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'one_third', 'one_third' );

function two_thirds( $atts, $content = null ) {
	return '<div class="two-thirds">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'two_thirds', 'two_thirds' );


function button( $atts, $content = null ) {
	$a = shortcode_atts( array(
	    'text' => 'button',
	    'style' => 'outlined',
	    'section' => 'no-specific-section'
	), $atts );
	// return '<span class="ecp-button '. $a['style'] . ' ' . $a['section'] .'">' . $a['text'] . '</span>';
	return '<span class="ecp-button '. $a['style'] . ' ' . $a['section'] .'">' . $content . '</span>';
}
add_shortcode( 'button', 'button' );




function calendar_month() {
	$lang = pll_current_language();
	return "<style>.embed-container-month { margin-top: 40px; position: relative; padding-bottom: 80% !important; height: 0; overflow: hidden; max-width: 100%; } .embed-container-month iframe, .embed-container-month object, .embed-container-month embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container-month'><iframe src='https://calendar.google.com/calendar/embed?height=600&wkst=1&bgcolor=%23FFFFFF&src=englishcollege.cz_3539333133303038363937%40resource.calendar.google.com&color=%23875509&ctz=Europe%2FPrague&hl={$lang}' style='border-width:0' frameborder='0' scrolling='no'></iframe></div>";
}
add_shortcode( 'calendar_month', 'calendar_month' );


function calendar_agenda() {
	$lang = pll_current_language();
	return "<style>.embed-container-agenda { position: relative; height: 90%; xxmin-height: 430px; overflow: hidden; max-width: 100%; } .embed-container-agenda iframe, .embed-container-agenda object, .embed-container-agenda embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container-agenda'><iframe src='https://calendar.google.com/calendar/embed?showTitle=0&showNav=0&showDate=0&showPrint=0&showTabs=0&showCalendars=0&mode=AGENDA&height=600&wkst=2&bgcolor=%23FFFFFF&src=englishcollege.cz_3539333133303038363937%40resource.calendar.google.com&color=%23875509&ctz=Europe%2FPrague&hl={$lang}' style='border-width:0; height:100%;background-color:grey;font-weight:bold!important' height='100%' frameborder='0' scrolling='no'></iframe></div>";
}
add_shortcode('calendar_agenda', 'calendar_agenda');


function show_more( $atts, $content = null ) {
	$a = shortcode_atts( array(
	    'text' => 'Show more',
	    'text_more' => 'Show more',
	    'text_less' => 'Show less',
	    'style' => 'normal',
	    'section' => 'no-specific-section'
	), $atts );
	// return '<a href="#" onclick="toggleMore(event)" class="show-more-handle show-more-handle-' . $a['style'] . ' ' . $a['section'] . '" data-more="'. $a['text_more'] .'" data-less="'. $a['text_less'] .'">' . $a['text_more'] . '</a>' . '<div class="expandable">' . do_shortcode($content) . '</div>';
	return '<a href="#" onclick="toggleMore(event)" class="show-more-handle show-more-handle-' . $a['style'] . ' ' . $a['section'] . '" data-more="'. $a['text_more'] .'" data-less="'. $a['text_less'] .'">' . $a['text_more'] . '</a>' . '<div class="expandable">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'show_more', 'show_more' );


function flex_row( $atts, $content = null ) {
	return '<div class="flex-row">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'flex_row', 'flex_row' );


function anchor( $atts, $content = null ) {
	extract( shortcode_atts(
      array(
          'name' => '',
          ), $atts )
      );
   return '<div name="'. $name .'" class="anchor-tagg" id="'. $name .'"></div>';
}
add_shortcode( 'anchor', 'anchor' );


function spacer( $atts, $content = null ) {
	extract( shortcode_atts(
      array(
          'size' => '1',
          ), $atts )
      );
   return '<div class="spacer-tagg size-' . $size . '"></div>';
}
add_shortcode( 'spacer', 'spacer' );
