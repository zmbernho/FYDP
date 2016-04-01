<!--Edited by Sofia March 17-->
<?php
// This code outputs the last games data for a specific user
//Patient selected id(need to be changed to variable from website)
// Create connection
$conn = new mysqli('localhost','root','','Mozart_Data');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//SELECTS NAME OF ACTIVE PATIENT
$sql2 = "SELECT PATIENT_NAME,PATIENT_ID FROM PATIENT_USERS WHERE IS_ACTIVE != 0";
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
	// save patient data into an array
	for($row=0;$row = $result->fetch_assoc();$row++) {
		$selectedname=$row["PATIENT_NAME"];
		$ID=$row['PATIENT_ID'];
}}
//SQL CODE
$sql = "SELECT GAME_DATE, RANGE_MAX_X, RANGE_MIN_X, RANGE_MAX_Y, RANGE_MIN_Y FROM PATIENT_DATA_GAME WHERE PATIENT_ID = '$ID'AND GAME_DATE =( SELECT MAX(GAME_DATE) FROM patient_data_game WHERE PATIENT_ID = '$ID')"; 
$result = $conn->query($sql);
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
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>HTML5 Audio Game</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/menu.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<!--Header PATIENT SELECTION FORWARD-->
	<header>
	<center>
		<table width="100%">
			<tr>
			<td class="col-md-4">
				<img src = "images/profile.png" alt="Profile" height = "50" width = "50" align ="left" />
				<p><?php echo $selectedname;?> </p>
				<p><?php echo $ID;?> </p>
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
		<h1>Patient Performance</h1>
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
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1"><b>Game Statistics By Date</b></a></li>
    <li><a href="#tab2"><b>Overall Patient Statistics</b></a></li>
  </ul>

  <div class="tab-content">
    <div id="tab1" class="tab-pane fade in active">
		      <h3>Previous Game Performance</h3>
			<table style="display: inline-block;">
				<tr>
					<td class="col-md-4">
						<h3>Date:</h3> 
					</td>
					<td class="col-md-2"> 
						<select name="dates" align="right">
						<option value="1">February 12th, 2016</option>
						<option value="2">January 19th, 2016</option>
						<option value="3">December 20th, 2015</option>
					</select>
					</td>
				<tr>
					<td class="col-md-2">
						<p>Accuracy Percentage:</p>
					</td>
					<td class="col-md-4">
						<span></span>
					</td>
				</tr>
				<tr>
					<td class="col-md-2">
						<p>Target Notes Hit:</p>
					</td>
					<td class="col-md-4">
						<span></span>
					</td>
				</tr>
				<tr>
					<td class="col-md-2">
						<p>Badges Earned:</p>
					</td>
					<td class="col-md-4">
						<span></span>
					</td>
				</tr>
				<tr>
					<td class="col-md-2">
						<p>Maximum Force:</p>
					</td>
					<td class="col-md-4">
						<span></span>
					</td>
				</tr>
				<tr>
					<td class="col-md-2">
						<p>X Range: <?php echo $lastxmin ." cm - ". $lastxmax. " cm"; ?></p>
					</td>
					<td class="col-md-4">
						<span></span>
					</td>
				</tr>
				<tr>
					<td class="col-md-2">
						<p>Y Range:  <?php echo $lastymin ."  cm - ". $lastymax . " cm"; ?></p>
					</td>
					<td class="col-md-4">
						<span></span>
					</td>
				</tr>
			</table>    
			<table class="col-xs-6">
				<img src="images/line.png" style="float:right" width="400" height="200"/>
			</table>
		</div>
	
    <div id="tab2" class="tab-pane fade">
	      <h3>Overall Performance</h3>
		  <table style="display: inline-block;">
				<tr>
					<td class="col-md-4">
						<h4>Start Date:</h4> 
					</td>
					<td class="col-md-2"> 
						<span></span>
					</td>
				<tr>
					<td class="col-md-2">
						<h4>Accuracy Percentage:</h4>
					</td>
					<td class="col-md-4">
						<span></span>
					</td>
				</tr>
				<tr>
					<td class="col-md-2">
						<h4>Target Notes Hit:</h4>
					</td>
					<td class="col-md-4">
						<span></span>
					</td>
				</tr>
				<tr>
					<td class="col-md-2">
						<h4>Badges Earned:</h4>
					</td>
					<td class="col-md-4">
						<span></span>
					</td>
				</tr>
				<tr>
					<td>
						<br>
						</br>
					</td>
				</tr>
			</table>    
			<table class="col-xs-6">
				<img src="images/line.png" style="float:right" width="400" height="200"/>
			</table>
		</div>
  </div>

<script>
$(document).ready(function(){
    $(".nav-tabs a").click(function(){
        $(this).tab('show');
    });
    $('.nav-tabs a').on('shown.bs.tab', function(event){
        var x = $(event.target).text();         // active tab
        var y = $(event.relatedTarget).text();  // previous tab
        $(".act span").text(x);
        $(".prev span").text(y);
    });
});
</script>
	<!--Footer-->
	<footer>
		<center>
			<table>
				<tr>
					<td>
						<a href="settings.php">
							<img src="images/done.png" alt="Done" height="100" width="100"  />
						</a>
					</td>
					<td>
						<a href="settings.php">
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
<?php $conn->close(); ?>
<!--Footer-->

	</html>