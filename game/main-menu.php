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
	<link rel="stylesheet" href="css/menu.css" />
</head>
<body>
	
	<!--Header-->
	<header>
		<table width="100%">
			<tr>
			<td>
		<img src = "images/profile.png" alt="Profile" height = "50" width = "50" align ="left"/>
			<p><?php echo $selectedname;?></p>
			<p><?php echo $ID;?></p>
			</td>
			<td align="centre">
		<img src ="images/logo.png" alt="Mozart Logo" height = "50" width="150" align = "centre"/>
		</td>
		<td>
		<script type="text/javascript">
  			function closeIt()
  				{
   				 window.close();
  				}
		</script>
		<img src="images/close.png" alt="Close" height ="40" width ="40" align="right" onclick="closeIt();" />
		</td>
		</tr>
		</table>
	</header>
	
	<!--Title-->
	<div class="title">
		<h1>Main Menu</h1>
	</div>

	<!--Menu-->
	<div class="main">
		<table align = "center">
		<tr>
			<td>
			<a href = "patient-settings.php">
				<img class="center-image" src="images/settings.png" alt="Settings" height="100" width="100"/>
			</a>
			</td>
			<td>
		<h2 class="done-text">Settings</h2>
			</td>
		</tr>
		<tr>
			<td>
		<a href = "index.php">
			<img class="center-image" src="images/play_button.png" alt="Play Game" height="150" width="150"/>
		</a>
			</td>
			<td>
		<h2 class="done-text">Play Game</h2>
		</td>
		</tr>
		<tr>
		<td>
		<a href = "patient-help.php">
			<img class="center-image" src="images/help.png" alt="Help" height="100" width="100"/>
		</a>
		</td>
		<td>
		<h2 class="done-text">Exit</h2>
		</td>
		</tr>
		</table>

</body>
</html>