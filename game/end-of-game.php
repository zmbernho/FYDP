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
//get latest date of current user
$sqldate = "SELECT MAX(GAME_DATE) FROM PATIENT_DATA_GAME WHERE PATIENT_ID = (SELECT PATIENT_ID FROM PATIENT_USERS WHERE IS_ACTIVE != 0)";
$resul = $conn->query($sqldate);
if($resul->num_rows > 0){
	for ($rows=0;$row=$resul->fetch_assoc();$row++){
		$lastdate = $rows['GAME_DATE'];
	}
}
//get total points from game
$totalpointsearned = $_GET['totalpts'];
$sqlpts = "UPDATE PATIENT_GAME_DATA SET POINTS='".$totalpointsearned."' WHERE GAME_DATE='".$lastdate."' AND PATIENT_ID='".$ID."'";
$conn->query($sqlpts);
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
		<a href="patient-help.php">
			<h3>< Back to Help</h3>
		</a>
		</td>
		<td class="col-md-4">
		<h1>End of Game</h1>
		</td>
		<td class="col-md-4">
		<a href="index.php">
			<h3>To Game ></h3>
		</a>
		</td>
		</tr>
		</table>
	</div>
	
	<!--Content-->
	<center>
		<h2>Congratulations on completing this song!</h2>
		<h2>You earned <b> <?php echo $totalpointsearned;?> </b> points!</h2>
		<img src="images/bitches.png"/>
	</center>

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