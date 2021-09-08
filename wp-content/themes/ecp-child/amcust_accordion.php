<?php

function amaccordion( $atts = array(), $content = null ) {
  
    // set up default parameters
    // extract(shortcode_atts(array(
    //  'link' => '#'
    // ), $atts));
    
    // return '<a href="'. $link .'" target="blank" class="doti-button">' . $content . '</a>';
    return '<nav class="accordion">' . $content . '</nav>';
  }
  add_shortcode('amaccordion_wrap', 'amaccordion');
  
  
  function amacc_row( $atts = array(), $content = null ) {
  
    // set up default parameters
    // extract(shortcode_atts(array(
    //  'link' => '#'
    // ), $atts));
    
    // return '<a href="'. $link .'" target="blank" class="doti-button">' . $content . '</a>';
  
    $rowNum = $atts['number'] ? $atts['number'] : null;
    $rowTitle = $atts['title'] ? $atts['title'] : 'insert title here';
    $rowOpen = $atts['open'] ? $atts['open'] : false;
  
    $rowBuild = '';
    $rowBuild .= '<nav class="drop-down-menu">';
    $rowBuild .= '<input id="accordion-'.$rowNum.'" class="activate" name="accordion-'.$rowNum.'" type="checkbox"';
    if($rowOpen) $rowBuild .= ' checked="checked"';
    $rowBuild .= ' />';
    $rowBuild .= '<label class="accordion-title first" for="accordion-'.$rowNum.'">';
    $rowBuild .= '<span class="badge">'.$rowNum.'</span>';
    $rowBuild .= $rowTitle;
    $rowBuild .= '</label>';
    $rowBuild .= '<div class="drop-down">';
    if($atts['do_shortcode']){
        $rowBuild .= do_shortcode($content);        
    }elseif($atts['insert_post']){
      $insertPost = '[display-posts id='.$atts['insert_post'].' include_content="true" wrapper="div" include_title="false" category_display="false" ignore_sticky_posts="true"';
      // $insertPost .= ' image_size="medium"';
      $insertPost .= ']';
      $rowBuild .= do_shortcode($insertPost);
    }else{
        $rowBuild .= $content;
    }
    $rowBuild .= '</div>';
    $rowBuild .= '</nav>';    
  
    return $rowBuild;
  }
  add_shortcode('amacc_row', 'amacc_row');

  
?>