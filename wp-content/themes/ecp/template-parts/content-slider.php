<?php 
/**
 * Template part for displaying nes on homepage.
 *
 * @package ecp
 */


$wpb_all_query = new WP_Query(array('post_type'=>'slider', 'post_status'=>'publish', 'posts_per_page'=>5)); ?>

<?php if ( $wpb_all_query->have_posts() ) : ?>

<div id="slider-container">

	<!-- the loop -->
	<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
		<div class="screen-item carpet" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(),'full', true)[0]; ?>');">
			<h1 class="claim"><?php the_title(); ?></h1>
		</div>
	<?php endwhile; ?>
	<!-- end of the loop -->
	<a href="." class="to-next-section">▼</a>

</div>

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php _e( ':-(' ); ?></p>
<?php endif; ?>
