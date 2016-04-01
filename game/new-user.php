<html lang="en">
<head>
	<meta charset="utf-8">
	<title>HTML5 Audio Game</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/menu.css" />
</head>
<body>
	<!--Header-->
	<header>
	<center>
		<table width="100%">
			<tr>
			<td align="center">
		<img src ="images/logo.png" alt="Mozart Logo" height = "50" width="150" align = "centre"/>
		</td>
		</tr>
		</table>
	<center>
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
		<td class="col-md-4" align="center">
		<h1>New User</h1>
		</td>
		<td class="col-md-4">
		</td>
		</tr>
		</table>
	</div>
	<!--Form-->
	<!--Form-->
	<script language="JavaScript">
<!--//
/*This Script allows therapists to enter new users*/
function newuser(form) {            
location="patient-profile.php" 
}
//-->
</script>
<form name="new" action="saveuser.php" method="post">

<center>
	<table>
	<div class="input-table">
		<tr>
			<td>
				<h3><b>Name</b></h3>
			</td>
			<td>
					<input name="newname" type="text">
			</td>
		</tr>
		<tr>
			<td>
				<h3><b>Date of Birth</b></h3>
			</td>
			<td>
					<input name="dob" type="date">
			</td>
		</tr>
		<tr>
			<td>
				<h3><b>Select Profile Icon</b></h3>
			</td>
			<td>
					<input name="dorehab" type="radio"> <img src ="images/profile.png" alt="Icon 1" height="50" width ="50">
					<input name="dorehab" type="radio"> <img src ="images/profile3.png" alt="Icon 2" height="50" width ="50">
					
			</td>
		</tr>
		</div>
		</table>
		</center>
		<center>
	<table>
	<div class="input-table">
<!--Footer-->
	<th>
						<input type="submit" value="Create User" class="tfbutton2">
						</th>
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
	</div>
	</table>
	</center>
	</form>

</body>
</html>