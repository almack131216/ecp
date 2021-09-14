<?php

///////////////////////////////////////////////////////////////////////////////////////////// AMGRID
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
              this.element.addEventListener('mouseenter', (ev) => this.update(ev, 'in'));
              this.element.addEventListener('mouseleave', (ev) => this.update(ev, 'out'));
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
  $type = $atts['type'] ? $atts['type'] : null;
  $strReadMore = $atts['str_read_more'] ? $atts['str_read_more'] : 'Read More';

  $columns = $atts['columns'] ? $atts['columns'] : false;
  $devNotes = $atts['dev_notes'] == 'true' || $atts['dev_notes'] == true ? true : false;
  $linkToPost = true;    
  if($devNotes) $catPosts .= '<br>linkToPost: '.$linkToPost.' ('.$atts['link_to_post'].')';
  $linkToTargetArr = $atts['link_to_target'] ? explode(',', $atts['link_to_target']) : false;
  if($linkToTargetArr){
      $catSkip = true;
      // $postIdsArr = $postIds;
      if($devNotes) echo '<br>targets: ';
      if($devNotes) print_r($linkToTargetArr);
  }

  if($linkToTargetArr || $atts['link_to_post'] == 'false'){
      $linkToPost = false;
      if($devNotes) $catPosts .= '<br>$linkToPost set to false!';
  }

  $postIdsArr = $atts['post_ids'] ? explode(',', $atts['post_ids']) : null;
  if($postIdsArr){
      $catSkip = true;
      // $postIdsArr = $postIds;
      if($devNotes) echo '<br>post_ids: ';
      if($devNotes) print_r($postIdsArr);
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

      $catPosts .= '<div class="amgrid-wrap_all '.($type ? $type : 'list').'">';

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
                          'link_post' => $linkToPost ? esc_url( get_the_permalink() ) : false,
                          'thumb' => $image_arr ? $image_arr : null,
                          'type' => $type ? $type : null,
                          'str_read_more' => $strReadMore
                      );
                      $catPosts .= amgrid_listItem($itemArr);
                      
                      $postCount++;
                  endwhile;
                  //(END) while
                  
                  $gridEnd = '</ul>';//<!--['.$subcategoryCounted.'-'.$subcategoryCount.']-->
                  $gridEnd .= '</div>';
                  $gridEnd .= '</div>';

                  $catPosts .= $gridEnd;                
                  wp_reset_postdata();                 
                  
              endif;
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

///////////////////////////
// amgrid - GenerateTabLink
function GenerateTabLink($getTarget){
  $url = strtok($_SERVER["REQUEST_URI"], '?');
  $tabUrl = $url.'?target='.$getTarget;
  return $tabUrl;
}
///////////////////////////
// (END) amgrid - GenerateTabLink

///////////////////////////
// amgrid - amgrid_listItem
function amgrid_listItem($getItemArr){
  $listItem = '';    
  $listItem .= '<li'.($getItemArr['type'] ? ' class="'.$getItemArr['type'].'"' : null).'>';

  //footer link
  if($getItemArr['link_target']) $listItem .= '<a href="'.$getItemArr['link_target'].'" title="Link to '.$getItemArr['title'].'" class="read-more">'.$getItemArr['str_read_more'].'</a>';
  if($getItemArr['link_post'] && !$getItemArr['link_target']) $listItem .= '<a href="'.$getItemArr['link_post'].'" title="Link to '.$getItemArr['title'].'" class="read-more">'.$getItemArr['str_read_more'].'</a>';
  //(END) footer link

  //div.img-bg
  $listItem .= '';
  if( $getItemArr['thumb'] ){                          
      // $listItem .= '<img src="'.$getItemArr['thumb'][0].'">';
      $listItem .= '<div class="img-bg has-img" style="background-image:url('.$getItemArr['thumb'][0].')">';
  }else{
      $listItem .= '<div class="img-bg">';
  }
  $listItem .= '<span class="txt-wrap">';
      $listItem .= '<span class="name">'.$getItemArr['title'].'</span>';
      $listItem .= '<span class="title">'.$getItemArr['subtitle'].'</span>';
  $listItem .= '</span>';
  $listItem .= '</div>';
  //(END) div.img-bg
  
  //div.info
  $info = '';
  $info .= '<div class="info">';
      $info .= '<h3>'.$getItemArr['title'].$getItemArr['type'].'</h3>';
      $info .= '<div class="quote">';
      $info .= '<p>';                        
      if($getItemArr['quote']) $info .= $getItemArr['quote'];
      $info .= '</p>';        
      $info .= '</div>';
  $info .= '</div>';
  if($getItemArr['type'] !== "basic") $listItem .= $info;
  //(END) div.info                        
  
  $listItem .= '</li>';

  return $listItem;
}
///////////////////////////
// (END) amgrid - amgrid_listItem

  
?>