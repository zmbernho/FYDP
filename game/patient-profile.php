<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>HTML5 Audio Game</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/menu.css" />
</head>
<body>
<?php
session_start(); 
?>
<?php 
$conn = new mysqli('localhost','root','','Mozart_Data');
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
} 
//checks if someone is active already 
$sql3 = "SELECT PATIENT_ID FROM PATIENT_USERS WHERE IS_ACTIVE != 0 ";
$checking = $conn->query($sql3);
if($checking->num_rows < 1) {
	$select = $_POST['ID'];
	//SETS SELECTED TO IS_ACTIVE
	$sql = "UPDATE PATIENT_USERS SET IS_ACTIVE = 1 WHERE PATIENT_ID = '$select'"; 
	$conn->query($sql);
}

//GET NAME AND ID OF SELECTED PATIENT
$sql2 = "SELECT PATIENT_NAME,PATIENT_ID FROM PATIENT_USERS WHERE IS_ACTIVE != 0";
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
	// save patient data into an array
	for($row=0;$row = $result->fetch_assoc();$row++) {
		$selectedname=$row["PATIENT_NAME"];
		$selectedID=$row['PATIENT_ID'];
}}
?>
	<!--Header PATIENT SELECTION FORWARD-->
	<header>
	<center>
		<table width="100%">
			<tr>
			<td class="col-md-4">
				<img src = "images/profile.png" alt="Profile" height = "50" width = "50" align ="left" />
				<p><?php echo $selectedname; ?></p>
				<p><?php echo $selectedID; ?></p>
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
		<a href="patient-selection.php">
			<h3>< Back to Patient Selection</h3>
		</a>
		</td>
		<td class="col-md-4">
		<h1>Patient Profile</h1>
		</td>
		<td class="col-md-4">
			<a href="settings.php">
			<h3>To Game Setup ></h3>
		</a>
		</td>
		</tr>
		</table>
	</div>
	<!--Content-->
	<div class="table">
	<center>
		<table>
		<tr>
				<td>
					<a href = "patient-performance.php">
						<img src="images/performance.png" alt="Performance" width="100" height="100"/>
					</a>
				</td>
				<td>
					<a href= "patient-performance.php">
					<h2>Patient Performance</h2>
				</a>
				</td>
			</tr>
			<tr>
				<td>
					<a href = "settings.php">
						<img src="images/settings.png" alt="Settings" width="100" height="100"/>
					</a>
				</td>
				<td>
					<a href= "settings.php">
					<h2>Game Settings</h2>
				</a>
				</td>
			</tr>
			
			
			<tr>
				<td>
					<a href ="settings.php">
					<img src="images/play_button.png" alt="Game Setup" width="100" height="100"/>
					</a>
				</td>
				<td>
					<a href ="settings.php">
					<h2>Patient Mode</h2>
				</a>
				</td>
			</tr>
			<tr>
				<td>
					<a href = "doctor-help.php">
						<img src="images/help.png" alt="Help" width="100" height="100"/>
					</a>
				</td>
				<td>
					<a href= "doctor-help.php">
					<h2>Help</h2>
				</a>
				</td>
			</tr>
		</table>
		</center>
	</div>
	<?php $conn->close(); ?>
</body>
</html>