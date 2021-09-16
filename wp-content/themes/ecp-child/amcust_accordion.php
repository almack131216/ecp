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

    // if(has_shortcode($post->post_content, 'amacc_row')){
      ?>
      <script type="text/javascript">        
        function showNext(getNumber){
          var nextStep = getNumber + 1;
          // alert(getNumber + ' - ' + nextStep);

          // document.getElementById("accordion-1").checked = false;
          // document.getElementById("accordion-2").checked = false;
          // document.getElementById("accordion-3").checked = false;
          // document.getElementById("accordion-4").checked = false;
          // document.getElementById("accordion-5").checked = false;
          // document.getElementById("accordion-6").checked = false;
          document.getElementById("accordion-" + nextStep).checked = true;
          scrollToAnchor("accordion-" + nextStep);
        }

        function scrollToAnchor(aid){
            var aTag = jQuery("a[name='"+ aid +"']");
            jQuery('html,body').animate({scrollTop: aTag.offset().top},'slow');
        }
      </script>
      <?php
    // }
  
    // set up default parameters
    // extract(shortcode_atts(array(
    //  'link' => '#'
    // ), $atts));
    
    // return '<a href="'. $link .'" target="blank" class="doti-button">' . $content . '</a>';
  
    $rowNum = $atts['number'] ? $atts['number'] : null;
    $rowTitle = $atts['title'] ? $atts['title'] : 'insert title here';
    $rowOpen = $atts['open'] ? $atts['open'] : false;
    $btnContinue = $atts['btn_continue'] && $atts['btn_continue'] == "false" ? false : true;
  
    $rowBuild = '';
    $rowBuild .= '<a name="accordion-'.$rowNum.'"></a>';
    $rowBuild .= '<nav class="drop-down-menu">';
    $rowBuild .= '<input id="accordion-'.$rowNum.'" class="activate" name="accordion-'.$rowNum.'" type="checkbox"';
    if($rowOpen) $rowBuild .= ' checked="checked"';
    $rowBuild .= ' />';
    $rowBuild .= '<label class="accordion-title first" for="accordion-'.$rowNum.'">';
    // $rowBuild .= '<div class="pulse-bg"></div>';
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
    // $rowBuild .= '<label class="pulse-container margin-y-g2" for="accordion-'.round($rowNum + 1,0).'"><span class="pulse-bg"></span><span class="pulse-button"><i class="fa fa-chevron-down" aria-hidden="true"></i></span><span class="continue">Step '.round($rowNum + 1,0).'</span></label>';
    if($btnContinue) $rowBuild .= '<div onClick="showNext('.$rowNum.')" class="pulse-container margin-y-g2" for="accordion-'.round($rowNum + 1,0).'"><span class="pulse-bg"></span><span class="pulse-button"><i class="fa fa-chevron-down" aria-hidden="true"></i></span><span class="continue">Step '.round($rowNum + 1,0).'</span></div>';
    $rowBuild .= '</div>';
    $rowBuild .= '</nav>';    
  
    return $rowBuild;
  }
  add_shortcode('amacc_row', 'amacc_row');

  
?>