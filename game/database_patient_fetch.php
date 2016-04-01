<html>
<body>
<?php

$conn = new mysqli('localhost','root','','Mozart_Data');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT DISTINCT PATIENT_NAME, PATIENT_LASTNAME FROM PATIENT_USERS"; 
$result = $conn->query($sql);

$patientlist = array();
if ($result->num_rows > 0) {
    // output data of each row
    for($row=0;$row = $result->fetch_assoc();$row++) {
        $patientlist[]=$row["PATIENT_NAME"] . " ". $row["PATIENT_LASTNAME"];
    }
} else {
    echo "0 results";
}
//Echos specific patient in that row
$thisname = $patientlist[1];
echo $_GET('$thisname');
$conn->close();

?>
</body>
</html>
