<?php 
/**
 * Template part for displaying nes on homepage.
 *
 * @package ecp
 */


$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>3)); ?>

<?php if ( $wpb_all_query->have_posts() ) : ?>

<div class="news-list">

	<!-- the loop -->
	<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); ?>
		<div class="one-post-in-list">
			<div class="featured-image-in-list">
				<a href="<?php the_permalink(); ?>">
					<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('thumbnail');
						} else {
							echo('<img src="' . get_bloginfo('template_directory') . '/assets/150x115.png">');
						}
					?>
				</a>
			</div>
			<div class="info-in-list">
				<div class="date-in-list"><?php ecp_posted_on_simple(); ?></div>
				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
			</div>
		</div>
	<?php endwhile; ?>
	<!-- end of the loop -->

</div>

	<?php wp_reset_postdata(); ?>

<?php else : ?>
	<p><?php _e( 'Sorry, no news.' ); ?></p>
<?php endif; ?>