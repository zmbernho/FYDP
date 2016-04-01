<?php 
//get patient NAME AND ID
$conn = new mysqli('localhost','root','','Mozart_Data');
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
} 
//GET NAME AND ID OF SELECTED PATIENT
$sql2 = "SELECT PATIENT_NAME,PATIENT_ID FROM PATIENT_USERS WHERE IS_ACTIVE != 0";
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
	// save patient data into an array
	for($row=0;$row = $result->fetch_assoc();$row++) {
		$selectedname=$row["PATIENT_NAME"];
		$ID=$row['PATIENT_ID'];
}}
$conn->close();
?>
<!DOCTYPE html> 
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>HTML5 Audio Game</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<script src="js/jquery-1.12.1.min"></script>
	
</head>
<body onload="playSound();"> 
<!--Header PATIENT SELECTION FORWARD-->
	<header>
	<center>
		<table width="100%">
			<tr>
			<td class="col-md-4">
				<img src = "images/profile.png" alt="Profile" height = "50" width = "50" align ="left" />
				<p><?php echo $selectedname;?></p>
				<p><?php echo $ID;?></p>
			</td>
			<td class="col-md-4" style="text-align: center;">
				<img src ="images/logo.png" alt="Mozart Logo"  height = "50" width="150" />
			</td>
			<td class="col-md-4"> 
				</td>
		</tr>
		</table>
	</center>
	</header>
<!--Title-->
<!--Title-->
	<div class="title">
		<table width="100%">
		<tr>
		<td class="col-md-4">
		<a href="patient-help.php">
			<h3>< Back to Patient Help</h3>
		</a>
		</td>
		<td class="col-md-4">
		<h1>Call Therapist</h1>
		</td>
		<td class="col-md-4">
		</td>
		</tr>
		</table>
	</div>
	
	
<center>
<br>
<audio id="noise">
</audio>
<script>
function playSound(){
    var snd=document.getElementById('noise');
    canPlayMP3 = (typeof snd.canPlayType === "function" && snd.canPlayType("audio/mpeg") !== "");
    snd.src=canPlayMP3?'audio/ring.mp3':'audio/ring.ogg';
    snd.load();
    snd.play();
}
</script>
</center>

<!--Footer-->
	<!--Footer-->
	<footer>
	<center>
	<h2>Press the <b>Green Button</b> to return to the Menu</h2>
	<script>
        addEventListener("click",function(){
            window.location.replace("http://localhost/audio-game/patient-home.php");
        });
</script>
	</center>
	</div>
	</footer>
	
</body>
</html>