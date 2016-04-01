<html>
<body>
<?php
session_start(); 
?>
<?php

$game_date = "2016-03-22" ;
$xmax = $_POST['xmax'];
$xmin = $_POST['xmin'];
$ymax = $_POST['ymax'];
$ymin = $_POST['ymin'];
// Create connection
$conn = new mysqli('localhost','root','','Mozart_Data');
// Check connection
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


							//SQL CODE
							$sql = "INSERT INTO PATIENT_DATA_GAME (PATIENT_ID, GAME_DATE, RANGE_MAX_X, RANGE_MIN_X, RANGE_MAX_Y, RANGE_MIN_Y) VALUES ('$ID', '$game_date', '$xmax', '$xmin', '$ymax', '$ymin')";
							$conn->query($sql);
							$conn->close();
							header("Location: transition.php");
							?>"
</body>
</html>
