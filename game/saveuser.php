<html>
<body>
						<?php 
						//This code is to create a new user in the database
						//Variables being inputed by user (need to be changed to variables from website)
						$firstname = $_POST["newname"];
						$dob = $_POST["dob"];	 
						// Create connection with db
						$conn = new mysqli('localhost','root','','Mozart_Data');
						// Check connection
						if ($conn->connect_error) {
						    die("Connection failed: " . $conn->connect_error);
						} 
						$sql = "SELECT PATIENT_ID FROM patient_users WHERE PATIENT_ID IN(SELECT max(PATIENT_ID) FROM PATIENT_USERS)";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {    
							for($row=0;$row = $result->fetch_assoc();$row++) {
							$id = $row["PATIENT_ID"]+1; }}
						//SQL CODE Creates New Patient 
						$sql1 = "UPDATE patient_users SET IS_ACTIVE = 0";
						$conn->query($sql1);
						$sql2 = "INSERT INTO patient_users (PATIENT_ID, PATIENT_NAME, PATIENT_DATE_OF_BIRTH, IS_ACTIVE) VALUES ( '$id', '$firstname', '$dob', 1)";
						//$conn->query($sql2);
						
						if ($conn->query($sql2) == TRUE ) {
						header("Location: patient-profile.php");
						} 
						$conn->close();
							?>
							</body>
							</html>
