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
$videosArr[] = array("title"=>"ECP Admission Process 2","v"=>"si792If9UP4");

if($amcust_tmpLang=='cs-CZ') {
	$titleArr = array("title"=>"Videos CZ", "see_all_link"=>"/ecp-people", "see_all_text"=>"See All Videos CZ");
}

function PrintPreview($getVideoArr){
	$previewBtn = '<a href="#" class="preview" title="ECP Admission Process">';
	$previewBtn .= '<img src="http://img.youtube.com/vi/si792If9UP4/0.jpg">';
	$previewBtn .= '<i class="fa fa-youtube-play"></i>';
	$previewBtn .= '<span>ECP Admission Process</span>';
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
	<div class="video-content basic display-none">
		<h1>Come and join us!</h1>
		<!-- <p>Lorem ipsum...</p> -->
		<!-- Use a button to pause/play the video with JavaScript -->
		<!-- <button id="btnPlayPause" onclick="videoPlayPause()" class="video-button"><i class="fa fa-pause"></i></button>
		<button id="btnMuteUnmute" onclick="videoMuteUnmute()" class="video-button"><i class="fa fa-volume-up"></i></button>
		<a id="btnGoToFullVideo" href="<?php echo get_site_url(); ?>/ecp-video/" class="video-button">Watch full video 1</a> -->
		<span class="video-button-parent">
		<?php
			//echo do_shortcode("[video_lightbox_youtube video_id='C9E8K-4IDrk&rel=0&autoplay=1' auto_play='true' width='640' height='480' class='btnWatchFullVideo' anchor='Watch full video 2']");
			// echo do_shortcode("[video_lightbox_youtube video_id='C9E8K-4IDrk&rel=0&autoplay=1&cc_load_policy=1&cc_lang_pref=cs' auto_play='true' width='640' height='480' class='btnWatchFullVideo' anchor='Watch full video 3']");
			echo do_shortcode("[wp-video-popup video='https://www.youtube.com/watch?v=C9E8K-4IDrk&rel=0&autoplay=1&cc_load_policy=1&cc_lang_pref=cs']");
		?>
		<a href="#" class="wp-video-popup">Play Video</a>
		<!-- <a rel="lightbox" data-gall="gall-frame" data-lightbox-type="inline" href="#inline-content">RL iframe</a> -->
		<!-- <a href="https://www.youtube.com/watch?v=C9E8K-4IDrk&rel=false&autoplay=1&cc_load_policy=1&cc_lang_pref=cs" rel="lightbox" data-lightbox-type="iframe">RL YouTube</a> -->
		</span>
	</div>
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
