<!DOCTYPE html>
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
				<h1>Login Area</h1>
			</div>

			<!--Form-->
			<script language="JavaScript">
<!--//
/*This Script allows people to enter by using a form that asks for a
UserID and Password*/
function pasuser(form) {
	if (form.id.value=="admin" || form.id.value=="Mozart") { 
		if (form.pass.value=="BigTitties123!" || form.id.value=="admin") {              
			location="patient-selection.php" 
		} else {
			alert("Invalid Password")
		}
	} else {  alert("Invalid UserID")
}
}
//-->
</script>
<div class="input-table">
	<center>
		<table border="0">
			<tr>
				<td>
					<h2><b>User ID:</b></h2>
				</td>
				<td>
					<form name="login">
						<input name="id" type="text" >
					</td>
				</tr>
				<tr>
					<td>
						<h2><b>Password:</b></h2>
					</td>
					<td>
						<input name="pass" type="password">
					</td>
				</tr>
				</table>
				<table>
				<tr>
						<center>
							<input type="button" value="Login" onClick="pasuser(this.form)" class="tfbutton2"
						</center>
				</tr>
				</table>
			</form>
	</center> 
</div>
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
</footer>
</body>
</html>