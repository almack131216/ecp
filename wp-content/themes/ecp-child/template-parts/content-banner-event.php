<?php 
/**
 * Template part for displaying banner on homepage.
 * Banner will not be shown if date passes
 *
 * @package ecp
 */

$date_now = new DateTime();
$date_event = new DateTime("11/22/2017");//mm/dd/yyyy
$show_banner = false;

if ($date_now > $date_event) {
	//echo 'greater than';
	$show_banner = false;
}else{
	//echo 'Less than';
	$show_banner = true;
}
?>

<?php if ( $show_banner ) : ?>

<div id="banner-container">

	<?php
	 	//language_attributes();
	 	$amcust_tmpLang = get_bloginfo('language');
	 	//echo 'amcust_tmpLang: ' . $amcust_tmpLang;
		if($amcust_tmpLang=='cs-CZ'){
			echo do_shortcode("[pagepart slug='banner-cz']");
		}else{
			echo do_shortcode("[pagepart slug='banner']");//en-GB default
		}
	?>

</div>

<?php endif; ?>