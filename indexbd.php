<!DOCTYPE html>
<html>
	<head>
		<title>Index of Blood Donation</title>
		<style>
			h1
			{
				color: #cc0000;
				text-align: center;
				font-size: 60px;
				font-family: "Lucida Console", Monaco, monospace;
			}
			p
			{
				text-align: center;
				font-family: "Lucida Console", Monaco, monospace;
			}
			h2
			{
				color: #b30000;
				text-align: left;
				font-family: "Lucida Console", Monaco, monospace;
			}
			input[type=submit]
			{
   				font-size: 40px; 
				font-family: "Lucida Console", Monaco, monospace;
				background-color: #ff3333;
				color: white;
			}
			input[type=text], select
			{
				font-size: 45px;
			}
		</style>
		<script>
			function validateadmin()
			{
				var x=document.getElementById("adminpassid").value;
				if(x=="suchitra1")
					return true;
				else
				{
					window.alert("Password entered is incorrect");
					return false;
				}
			}				
		</script>
	</head>
	<body>
		<h2>Login as Admin<br><br>
		<form method="post" onsubmit="return validateadmin()" action="indexbd.php">
			Password:
			<br><br>		
			<input type="password" name="adminpassword" id="adminpassid" required>
			<br><br>
			<input type="submit" value="Login">
		</form></h2>
		<br><br><br>
		<h1>Enroll here to become a donor</h1>
		<form action='enrollform.php' method='post'>
			<p><input type='submit' value='Enroll'><p>
		</form>
		<img src="v5.jpg" width="300" height="388">
		<?php
			if($_SERVER["REQUEST_METHOD"]=="POST")
			{		
				header("Location:communicatorbd.php");
			}
		?>
	</body>
</html>
