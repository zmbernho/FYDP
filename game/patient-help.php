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
//get latest y range for the game 
$sql3 = "SELECT RANGE_MAX_Y, RANGE_MIN_Y FROM PATIENT_DATA_GAME where GAME_DATE =( SELECT MAX(GAME_DATE) FROM PATIENT_DATA_GAME WHERE PATIENT_ID = (SELECT PATIENT_ID FROM PATIENT_USERS WHERE IS_ACTIVE != 0) ) AND PATIENT_ID = (SELECT PATIENT_ID FROM PATIENT_USERS WHERE IS_ACTIVE != 0)"; 
$results = $conn->query($sql3);
if ($results->num_rows > 0){
	for ($row=0;$row = $results->fetch_assoc();$row++){
		$ymax = $row['RANGE_MAX_Y'];
		$ymin = $row['RANGE_MIN_Y'];
	}
}

$sqldate = "SELECT MAX(GAME_DATE) FROM PATIENT_DATA_GAME WHERE PATIENT_ID = (SELECT PATIENT_ID FROM PATIENT_USERS WHERE IS_ACTIVE != 0)";
$resul = $conn->query($sqldate);
if($resul->num_rows > 0){
	for ($rows=0;$row=$resul->fetch_assoc();$row++){
		$lastdate = $rows['GAME_DATE'];
	}
}

// $pausedtime = $_GET['pausetime'];
// $earnedpoints = $_GET['pts'];

// $sqlupdate1 = "UPDATE PATIENT_DATA_GAME SET POINTS='".$earnedpoints."' WHERE GAME_DATE='".$lastdate."' AND PATIENT_ID='".$ID."'";
// $sqlupdate2 = "UPDATE PATIENT_DATA_GAME SET ELAPSED_TIME='".$pausedtime."' WHERE GAME_DATE='".$lastdate."' AND PATIENT_ID='".$ID."'";
// $conn->query($sqlupdate1);
// $conn->query($sqlupdate2);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>HTML5 Audio Game</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/menu.css" />
</head>
<body>
	
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
	<div class="title">
		<table width="100%">
		<tr>
		<td class="col-md-4">
		<a href="patient-home.php">
			<h3>< Back to Patient Home</h3>
		</a>
		</td>
		<td class="col-md-4">
		<h1>Help</h1>
		</td>
		<td class="col-md-4">
		<a href="index.php">
			<h3>To Play Game ></h3>
		</a>
		</td>
		</tr>
		</table>
	</div>
	
	<!--Content-->
	<div id="patient-main">
		<section id="menu-scene" class="scene">
			<center>
				<canvas class="canvas" id="menu-canvas-help" width="400" height="390" style="positon:absolute; top:0; margin-left: auto; margin-right: auto; left:0; right:0; z-index:1">
					Sorry, your web browser does not support canvas content.
					<img id="play" src="images/play_button.png" alt="Play Game" height="100" width="100"/>
					<img id="tutorial" src="images/assistance.png" alt="Tutorial" height="100" width="100"/>
					<img id="call" src="images/call.png" alt="Therapist" height="100" width="100"/>
				</canvas>
			</center>
		</section>
			
	</div>
<script src="js/jquery-1.6.min.js"></script>
<script src="js/patient_help.js" yMin="<?php echo $ymin;?>" yMax="<?php echo $ymax;?>"></script>
</body>
</html>