<?php
/**
 * Template part for displaying carpet.
 *
 * @package ecp
 */

?>

<div class="carpet" style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('<?php echo get_field( 'hero_image' )['url']; ?>')">
	<!-- <h1 class="claim"><?php //_e( 'Successful students<br />are compassionate ones', 'ecp' ) ?></h1> -->
	<h1 class="claim"><?php the_field( 'hero_claim' ); ?><h1>
	<a href="." class="to-next-section">▼</a>
</div>
