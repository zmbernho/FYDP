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
	</div>

	<!--Form-->
	<form>
		<label for="username">User Name:</label>        <input type="text" name="username" /><br/>

<label for="password">Password:</label>   <input type="password" name="password" /><br/>
<br class="clear" />

<br />
</form>

<!--Footer-->
	<footer align="centre">
		<table>
			<tr>
				<td>
					<a href="patient-selection.php">
						<p>Login</p>
					</a>
				</td>
			</tr>
			<tr>
				<td>
					<a href="doctor-help.php">
						<img src="images/help.png" alt="Help" height="50" width="50" />
					</a>
				</td>
			</tr>
		</table>
	</footer>
	</body>
	</html>