<?php 
/**
 * Template part for displaying nes on homepage.
 *
 * @package ecp
 */
?>

<?php
$amcust_tmpLang = get_bloginfo('language');
// echo 'amcust_tmpLang: ' . $amcust_tmpLang;
$titleArr = array("title"=>"Videos", "see_all_link"=>"/ecp-people", "see_all_text"=>"See All Videos");
$videosArr = [];
$videosArr[] = array("title"=>"ECP Admission Process","v"=>"si792If9UP4");
$videosArr[] = array("title"=>"ECP Short Video","v"=>"8gFOkWApiS4");

if($amcust_tmpLang=='cs-CZ') {
	$titleArr = array("title"=>"Videos CZ", "see_all_link"=>"/ecp-people", "see_all_text"=>"See All Videos CZ");
	$videosArr[0]['title'] = "CZ Title";
}

function PrintPreview($getVideoArr){
	$previewBtn = '';
	// <a class="vp-a vp-yt-type" href="https://www.youtube.com/watch?v=cneWYWYaWak" rel="nofollow" data-iv="1" data-ytid="cneWYWYaWak" data-autoplay="1">With Autoplay</a>
	$previewBtn .= '<a href="https://www.youtube.com/watch?v='.$getVideoArr['v'].'" class="vp-a vp-yt-type" title="'.$getVideoArr['title'].' - play on YouTube in a new window">';
	$previewBtn .= '<img src="https://img.youtube.com/vi/'.$getVideoArr['v'].'/0.jpg">';
	$previewBtn .= '<i class="fa fa-youtube-play"></i>';
	$previewBtn .= '<span>'.$getVideoArr['title'].'</span>';
	$previewBtn .= '</a>';
	return $previewBtn;
}

?>

<div id="video-container">
	<!-- The video -->
	<video autoplay muted loop
		id="myVideo"
		class="video"		
		poster="<?php echo get_site_url(); ?>/wp-content/uploads/2019/11/ecp-video_poster.jpg">
		<source src="<?php echo get_site_url(); ?>/wp-content/uploads/2019/11/ecp-video_trim.mp4" type="video/mp4">
		Your browser does not support the video tag.
	</video>

	<div id="inline-content" class="iframe-youtube" style="display:none;">
		<iframe class="responsive-iframe" src="https://www.youtube-nocookie.com/embed/C9E8K-4IDrk?cc_load_policy=1&cc_lang_pref=cs" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="true"></iframe>
	</div>


	<!-- Optional: some overlay text to describe the video -->
	<div class="video-content thumbnails">
		<?php
			echo do_shortcode('[title_splitter title="'.$titleArr['title'].'" see_all_link="'.$titleArr['see_all_link'].'" see_all_text="'.$titleArr['see_all_text'].'" see_all_class="none" class="white"]');		
		?>
		<div class="previews-wrap">
			<?php
				echo PrintPreview($videosArr[0]);
				echo PrintPreview($videosArr[1]);
			?>			
		</div>
	</div>
</div>

<script>
// Get the video
var video = document.getElementById("myVideo");

// Get the button
var btnPP = document.getElementById("btnPlayPause");
var btnMU = document.getElementById("btnMuteUnmute");

// Pause and play the video, and change the button text
function videoPlayPause() {
  if (video.paused) {
    video.play();
	// btnPP.innerHTML = "Pause";
	btnPP.getElementsByTagName("i")[0].setAttribute('class', 'fa fa-pause');
  } else {
    video.pause();
	// btnPP.innerHTML = "Play";
	btnPP.getElementsByTagName("i")[0].setAttribute('class', 'fa fa-play');
  }
}

// Mute and unmute the video, and change the button text
function videoMuteUnmute() {
  if (video.muted) {
    video.muted = false;
	// btnMU.innerHTML = "Mute";
	btnMU.getElementsByTagName("i")[0].setAttribute('class', 'fa fa-volume-off');
  } else {
    video.muted = true;
	// btnMU.innerHTML = "Audio";
	btnMU.getElementsByTagName("i")[0].setAttribute('class', 'fa fa-volume-up');
  }
}
</script>
