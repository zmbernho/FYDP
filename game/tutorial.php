<!DOCTYPE html> 
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>HTML5 Audio Game</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/menu.css" />
</head>
<body onload="playVideo();">
	
	<!--Header-->
	<header>
		<table width="100%">
			<tr>
			<td>
			</td>
			<td align="centre">
		<img src ="images/logo.png" alt="Mozart Logo" height = "50" width="150" align = "centre"/>
		</td>
		<td>
		</td>
		</tr>
		</table>
	</header>
	
	<!--Title-->
	<div class="title">
		<table width="100%">
		<tr>
		<td class="col-md-4">
		<a href="patient-help.php">
			<h3>< Back to Help</h3>
		</a>
		</td>
		<td class="col-md-4">
		<h1>Tutorial</h1>
		</td>
		<td class="col-md-4">
		<a href="index.php">
			<h3>To Game ></h3>
		</a>
		</td>
		</tr>
		</table>
	</div>

<center>
  <video id="video" width="640" height="360" type="video/mov" src="videos/tutorial.mov" autoplay>
  Your browser does not support HTML5 video
</video>
<script>
function playVideo(){
    var vid=document.getElementById('video');
    canPlayMP4 = (typeof vid.canPlayType === "function" && vid.canPlayType("videos/mov") !== "");
    vid.src=canPlayMP4?'videos/tutorial.mov';
    vid.load();
    vid.play();
}
</script>
</center>
<script>
        addEventListener("click",function(){
            window.location.replace("http://localhost/audio-game/patient-home.php");
        });
</script>
<!--Footer-->
	<footer>
	<center>
	<h2>Press the <b>Green Button</b> to return to the Menu</h2>
	</a>
	</td>
	</tr>
	</table>
	</center>
	</div>
	</footer>


</body>
</html>