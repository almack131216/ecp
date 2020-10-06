<?php 
/**
 * Template part for displaying nes on homepage.
 *
 * @package ecp
 */
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
	<div class="video-content">
		<h1>Come and join us!</h1>
		<!-- <p>Lorem ipsum...</p> -->
		<!-- Use a button to pause/play the video with JavaScript -->
		<button id="btnPlayPause" onclick="videoPlayPause()" class="video-button"><i class="fa fa-pause"></i></button>
		<button id="btnMuteUnmute" onclick="videoMuteUnmute()" class="video-button"><i class="fa fa-volume-up"></i></button>
		<a id="btnGoToFullVideo" href="<?php echo get_site_url(); ?>/ecp-video/" class="video-button">Watch full video</a>
		
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
