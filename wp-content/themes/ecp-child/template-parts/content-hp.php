<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ecp
 */

?>

<article id="homepage-content" <?php post_class(); ?>>
  <div class="four-main-section full-width">

    <?php echo display_key_services_boxes() ?>
    <!-- <div class="four-main site-width">
      <div class="section why-us">
        <h2>Why us &amp; how to apply</h2>
        <div>
          <p>Our story, fees and scholarships</p>
          <a href="#" class="button">See our benefits</a>
        </div>
      </div>

      <div class="section way-we-teach">
        <h2>The way we teach</h2>
        <div>
          <p>Modern education, our approach and curriculum</p>
          <a href="#" class="button">Meet our experts</a>
        </div>
      </div>

      <div class="section daily-life">
        <h2>Daily life &amp; activities</h2>
        <div>
          <p>Arts, Sports, Music, ... everything</p>
          <a href="#" class="button">Discover student life</a>
        </div>
      </div>

      <div class="section our-results">
        <h2>Our results &amp; stories</h2>
        <div>
          <p>Statistics, numbers and success stories</p>
          <a href="#" class="button">See our results</a>
        </div>
      </div>
    </div> -->

  </div>

  <?php // echo display_more_info_box() ?>
  
  <div class="entry-content">
     <?php
        the_content();
     ?>
  </div><!-- .entry-content -->


  <!-- <div class="more-info-section full-width">
    <div class="more-info">
      <h2>Would you like more information?</h2>
      <p>If you have any questions, feel free to contact us or book a free visit.</p>
      <a href="#" class="button">Contact us</a>
    </div>
  </div> -->



    <?php
    /**
     * if needed something to be added to hp template,
     * the following should be uncommented
     */
    ?>

  	 <!-- <div class="entry-content"> -->
    	 <?php
          //the_content();
    	 ?>
    	 <!-- </div>.entry-content -->

</article><!-- #post-## -->
