<div class="more-info-section full-width">
    <div class="more-info">
      <?php
        $insertedPostId = 103; // defaults to english
        $loc = '';
        if (function_exists ( "pll_current_language" )) {
          $loc = pll_current_language();
        }
        if ($loc == "cs") {
          $insertedPostId = 105;
        }
        $post   = get_post( $insertedPostId );
        $output =  apply_filters( 'the_content', $post->post_content );
        echo $output;
      ?>
    </div>
  </div>

  -----

edit post link

  <?php if ( get_edit_post_link() ) : ?>
    <footer class="entry-footer">
      <?php
        edit_post_link(
          sprintf(
            /* translators: %s: Name of current post */
            esc_html__( 'Edit %s', 'ecp' ),
            the_title( '<span class="screen-reader-text">"', '"</span>', false )
          ),
          '<span class="edit-link">',
          '</span>'
        );
      ?>
    </footer><!-- .entry-footer -->
  <?php endif; ?>