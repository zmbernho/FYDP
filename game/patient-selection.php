<!--Edited by Sofia March 17-->
	<?php
	session_start();
	?>
	<?php 
	$conn = new mysqli('localhost','root','','Mozart_Data');
	if ($conn->connect_error) {
	 die("Connection failed: " . $conn->connect_error);
	} 
	$sql1 = "UPDATE patient_users SET IS_ACTIVE = 0";
	$conn->query($sql1);
	$sql = "SELECT DISTINCT PATIENT_ID, PATIENT_NAME FROM PATIENT_USERS ORDER BY PATIENT_ID ASC"; 
	$result = $conn->query($sql);

	$patientlist = array();
	$patientid = array();
	if ($result->num_rows > 0) {
	// save patient data into an array
	for($row=0;$row = $result->fetch_assoc();$row++) {
		$patientlist[]=$row["PATIENT_NAME"];
		$patientid[]=$row["PATIENT_ID"];
	}} else {
		echo "0 results";
	}?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>HTML5 Audio Game</title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/menu.css" />
	<script language="javascript" type="text/javascript" src="asd.js"></script>
	<!-- JAVASCRIPT to clear search text when the field is clicked -->
<script type="text/javascript">
window.onload = function(){ 
	//Get submit button
	var submitbutton = document.getElementById("tfq");
	//Add listener to submit button
	if(submitbutton.addEventListener){
		submitbutton.addEventListener("click", function() {
			if (submitbutton.value == 'Search our website'){//Customize this text string to whatever you want
				submitbutton.value = '';
			}
		});
	}
}

</script>
<!-- CSS styles for standard search box with placeholder text-->
<style type="text/css">

	
</style>
</head>
</head>
<body>
	<!--Header PATIENT SELECTION FORWARD-->
	<header>
	<center>
		<table width="100%">
			<tr>
			<td class="col-md-4">
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
		<a href="start.php">
			<h3>< Back to Login</h3>
		</a>
		</td>
		<td class="col-md-4">
		<h1>Patient Search</h1>
		</td>
		<td class="col-md-4">
		</td>
		</table>
	</div>
	<!--Content-->
	<!-- HTML for SEARCH BAR -->
	<center>
	<div id="tfheader">
		<form id="tfnewsearch" method="post" action=""> <!--Should open the SQL patient List-->
		        <input type="text" id="tfq" class="tftextinput2" name="q" size="50" maxlength="120" value="Enter Patient First and Last Name"><input type="submit" value="Search" class="tfbutton2">
		</form>
		<div class="tfclear"></div>
	</div>
	</center>
	<div class="selection">
	<center>
		<table>
			<tr>
				<td class="col-md-6" align="center">
					<h3><b>Patient Name</b></h3>
				</td>
				<td class="col-md-2" align="center">
					<h3><b>Patient ID</b></h3>
				</td>
				<td class="col-md-4" align="center">
				</td>
			</tr>
			<tr>
				<form id="selectpatient0" method="post" action="patient-profile.php">
				<input type="hidden" name="Patient" value = "<?php echo $patientlist[0];?>">
				<input type="hidden" name="ID" value = "<?php echo $patientid[0];?>">
					<td class="col-md-6" align="center">
						<h3><?php echo $patientlist[0];?></h3>
					</td>
					<td class="col-md-2" align="center">
						<h3><?php echo $patientid[0]; ?></h3>
					</td>
					<td>
					<input type="submit" id="selectp0" value="Select" class="tfbutton2" />
				</form>
				</td>
			</tr>
			<tr>
				<form id="selectpatient1" method="post" action="patient-profile.php">
				<input type="hidden" name="Patient" value = "<?php echo $patientlist[1];?>"> 
				<input type="hidden" name="ID" value = "<?php echo $patientid[1];?>">
				<td class="col-md-6" align="center">
					<h3><?php echo $patientlist[1]; ?></h3>
				</td>
				<td class="col-md-2" align="center">
					<h3><?php echo $patientid[1]; ?></h3>
				</td>
				<td>
					<input type="submit" id="selectp1" value="Select" class="tfbutton2" />
				</form>
					
				</td>
				</td>
			</tr>
			<tr>
				<form id="selectpatient2" method="post" action="patient-profile.php">
				<input type="hidden" name="Patient" value = "<?php echo $patientlist[2];?>"> 
				<input type="hidden" name="ID" value = "<?php echo $patientid[2];?>">

				<td class="col-md-6" align="center">
					<h3><?php echo $patientlist[2]; ?></h3>
				</td>
					<td class="col-md-2" align="center">
					<h3><?php echo $patientid[2]; ?></h3>
				</td>
				<td>
					
					<input type="submit" id="selectp2" value="Select" class="tfbutton2"/>
					
					</form>
				</td>
				</td>
			</tr>
			<tr>
				<form id="selectpatient3" method="post" action="patient-profile.php">
				<input type="hidden" name="Patient" value = "<?php echo $patientlist[3];?>">
				<input type="hidden" name="ID" value = "<?php echo $patientid[3];?>"> 
				<td class="col-md-6" align="center">
					<h3><?php echo $patientlist[3];?></h3>
				</td>
					<td class="col-md-2" align="center">
					<h3><?php echo $patientid[3]; ?></h3>
				</td>
				<td>
				
				<input type="submit" id="selectp3" value="Select" class="tfbutton2" />
				</form>
				</td>
			</tr>
			<tr>
			<form id="selectpatient4" method="post" action="patient-profile.php">
			<input type="hidden" name="Patient" value = "<?php echo $patientlist[4];?>"> 
			<input type="hidden" name="ID" value = "<?php echo $patientid[4];?>">
				<td class="col-md-6" align="center">
					<h3><?php echo $patientlist[4];?></h3>
				</td>
					<td class="col-md-2" align="center">
					<h3><?php echo $patientid[4]; ?></h3>
				</td>
				<td>
					<input type="submit"  id="selectp4" value="Select" class="tfbutton2" />
				</form>
				</td>
			</tr>
		</table>
		</center>
	</div>
<!--Footer-->
	<footer>
	<center>
	<table>
	<tr>
	<td>
					<a href="new-user.php">
						<img src="images/new_user.png" alt="New User" height="100" width="100"  />
					</a>
	</td>
	<td>
	<a href="new-user.php">
	<h2> New Patient</h2>
	</a>
	</td>
	
	<tr>
	<td>
					<a href="doctor-help.php">
						<img src="images/help.png" alt="Help" height="100" width="100"  />
					</a>
	</td>
	<td>
	<a href="doctor-help.php">
	<h2> Help</h2>
	<?php $conn->close(); ?>
	</a>
	</td>
	</tr>
	</table>
	</center>
	</footer>
	</body>
	</html>