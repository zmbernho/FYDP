<!--Edited by Sofia March 17-->
<?php
// This code outputs the last games data for a specific user
// Patient selected id(need to be changed to variable from website)
global $lastxmax, $lastxmin, $lastymax, $lastymin;
// Create connection
$conn = new mysqli('localhost','root','','Mozart_Data');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
	//GETS ACTIVE PATIENT ID AND NAME
	$sql2 = "SELECT PATIENT_NAME,PATIENT_ID FROM PATIENT_USERS WHERE IS_ACTIVE != 0";
	$result = $conn->query($sql2);
	if ($result->num_rows > 0) {
	// save patient data into an array
	for($row=0;$row = $result->fetch_assoc();$row++) {
		$selectedname=$row["PATIENT_NAME"];
		$ID=$row['PATIENT_ID'];
	}}
	$sql = "SELECT RANGE_MAX_X, RANGE_MIN_X, RANGE_MAX_Y, RANGE_MIN_Y FROM PATIENT_DATA_GAME WHERE PATIENT_ID = '$ID'AND GAME_DATE =( SELECT MAX(GAME_DATE) FROM PATIENT_DATA_GAME WHERE PATIENT_ID = '$ID')"; 
	$result = $conn->query($sql);

	//Output results
	if ($result->num_rows > 0) {
    
	for($row=0;$row = $result->fetch_assoc();$row++) {
	// last game data
    $lastxmax = $row["RANGE_MAX_X"];
    $lastxmin = $row["RANGE_MIN_X"];
    $lastymax = $row["RANGE_MAX_Y"];
    $lastymin = $row["RANGE_MIN_Y"];
	}
} else {
    echo "0 results";
}?>
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
						<p><?php echo $selectedname; ?></p>
						<p><?php echo $ID; ?></p>
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
					<a href="patient-profile.php">
						<h3>< Back to Patient Profile</h3>
					</a>
				</td>
				<td class="col-md-4">
					<h1>Game Settings</h1>
				</td>
				<td class="col-md-4">
				</td>
			</tr>
		</table>
	</div>
	<!-- Content-->
	<!--Form-->
	<script language="JavaScript">
	<!--//
		/*This script grabs previous settings from the patient*/
		/*Need Sofia Code*/
function populate(xmax,xmin,ymax,ymin) {
	var indexxmax =0, indexxmin=0, indexymax=0,indexymin = 0;
	var lstxmax = xmax;
	var lstxmin = xmin;
	var lstymax = ymax;
	var lstymin = ymin; 
	//Find index for xmax
	var options = document.getElementById('xmax').options;
	for (var i= 0; i<options.length; i++){
		if(options[i].value == lstxmax){
			indexxmax = i; 
	}}
	//Find index for xmin
	var options2 = document.getElementById('xmin').options;
	for (n= 0; n<options2.length; n++){
		if(options2[n].value == lstxmin){
			indexxmin = n; 
	}}
	//Find index for ymax
	var options3 = document.getElementById('ymax').options;
	for (l= 0; l<options3.length; l++){
		if(options3[l].value == lstymax){
			indexymax = l; 
	}}
	//Find index for ymin
	var options4 = document.getElementById('ymin').options;
	for (s= 0; s<options4.length; s++){
		if(options4[s].value == lstymin){
			indexymin = s; 
	}}
		//set dropdowns
		var element1 = document.getElementById('force').selectedIndex=2;
		var element2 = document.getElementById('xmax').selectedIndex=indexxmax;
		var element3 = document.getElementById('xmin').selectedIndex=indexxmin;
		var element4 = document.getElementById('ymax').selectedIndex=indexymax;
		var element5 = document.getElementById('ymin').selectedIndex=indexymin;
}
</script>


<div class="input-table">
<center>
<h2><b>Exercise Force</b></h2>
		<table>
					
			<tr>
			<form action="savedata.php" method="post">
					<select id="force" name="force">
						<option name="force" value="1">1 N</option>
						<option name="force" value="2">2 N</option>
						<option name="force" value="3">3 N</option>
						<option name="force" value="4">4 N</option>
						<option name="force" value="5">5 N</option>
					</select>
				</tr>
				<tr>
				
					</table>
							</center>
							<center>
					<h2><b>Exercise Range</b></h2>
					</center>
					<center>
					<table>
					</tr>
					<tr>
					<th>
						<h4><b>X Range</b><h4>
					</th>
					<td style="padding: 5px">
						<select id= "xmin" name="xmin">
						<option name="xmin" value="0">0 cm</option>
						<option name="xmin" value="5">5 cm</option>
						<option name="xmin" value="10">10 cm</option>
					</select>
					</td>
					<td>
						<select id = "xmax" name = "xmax">
						<option name="xmax" value="20">20 cm</option>
						<option name="xmax" value="25">25 cm</option>
						<option name="xmax" value="30">30 cm</option>
						<option name="xmax" value="35">35 cm</option>
						<option name="xmax" value="40">40 cm</option>
						<option name="xmax" value="45">45 cm</option>
					</select>
					</td>
					<td rowspan="4" style="padding:10px"><img src="images/graph.png" alt="X Y Graph" width="200" height="200"/></td>
				</tr>
				<tr>
					<th>
						<h4><b>Y Range</b></h4>
					</th>
					<td>
						<select id = "ymin" name = "ymin">
						<option name= "ymin" value="0">0 cm</option>
						<option name= "ymin" value="5">5 cm</option>
						<option name= "ymin" value="10">10 cm</option>
						<option name= "ymin" value="15">15 cm</option>
						<option name= "ymin" value="20">20 cm</option>
					</select>
					</td>
					<td>
					<select id = "ymax" name="ymax">
					<option name= "ymax" value="40">40 cm</option>
						<option name= "ymax" value="45">45 cm</option>
						<option name= "ymax" value="50">50 cm</option>
						<option name= "ymax" value="55">55 cm</option>
						<option name= "ymax" value="60">60 cm</option>
						<option name= "ymax" value="65">65 cm</option>
						<option name= "ymax" value="70">70 cm</option>
						
					</select>
					</td>
				</tr>
				</table>
			</center>
			<center>
			<table>
				<tr>
					<td>
						<center>
							<input type="button" value="Use Previous Game Settings" onClick="populate(<?php echo $lastxmax .",".$lastxmin ."," . $lastymax. ",". $lastymin; ?>)">
						</center>
					</td>
					<td>
						<center>
						
							<input type="submit" value="Continue">
						
						</center>
					</td>
					<td>
					</form>
			</tr>
</table>

	</center>
	
	<!--Footer-->
	<footer>
		<center>
			<table>
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
<?php $conn->close(); ?>


</body>
</html>