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
					<a href="settings.php">
						<h3>< Back to Game Settings</h3>
					</a>
				</td>
				<td class="col-md-4">
					<h1>Instructions</h1>
				</td>
				<td class="col-md-4">
				</td>
			</tr>
		</table>
	</div>
<!-- Content-->
<center>
<h3>Please get the patient situated at the robot as soon as you click DONE we are transitioning to Patient Mode. </h3>
<h3> Thank you!</h3>
</center>
<!--Footer-->
	<footer>
		<center>
			<table>
			<tr>
			<td>
			<a href="patient-home.php">
							<img src="images/done.png" alt="Done" height="100" width="100"  />
						</a>
					</td>
					<td>
						<a href="patient-home.php">
							<h2> Done</h2>
						</a>
					</td>
				</tr>
				<tr>
					<td>
						<a href="doctor-help.php">
							<img src="images/help.png" alt="Help" height="100" width="100"  />
						</a>
					</td>
					<td>
						<a href="doctor-help.php">
							<h2> Help</h2>
						</a>
					</td>
				</tr>
			</table>
		</center>
	</div>
</footer>

</body>
</html>