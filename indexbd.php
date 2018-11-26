<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Index of Photo Album</title>
		<style>
			body
			{
				background-color: pink;
			}
			h1
			{
				color: mediumvioletred;
				text-align: center;
				font-size: 50px;
				font-family: "Lucida Console", Monaco, monospace;
			}
			p
			{
				text-align: center;
				font-family: "Lucida Console", Monaco, monospace;
			}
			h4
			{
				color: mediumvioletred;
				text-align: left;
				font-family: "Lucida Console", Monaco, monospace;
			}
			table
			{
    				border-collapse: collapse;
			}
			table, td, th
			{
				border: 1px solid mediumvioletred;
			}
			th
			{
				height: 65px;
				font-size: 25px;
				font-family: "Lucida Console", Monaco, monospace;
				background-color: palevioletred;
				color: black;
			}
			td
			{
				height: 50px;
   				font-size: 20px;
				font-family: "Lucida Console", Monaco, monospace;
			}
			tr:nth-child(even){background-color: #ebadc2;}	
			input[type=submit]
			{
   				font-size: 20px; 
				font-family: "Lucida Console", Monaco, monospace;
				background-color: plum;
			}
			input[type=text], select
			{
				font-size: 25px;
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
		<h4>Login as Admin<br><br>
		<form method="post" onsubmit="return validateadmin()" action="indexbd.php">
			Password:
			<br><br>		
			<input type="password" name="adminpassword" id="adminpassid" required>
			<br><br>
			<input type="submit" value="Login">
		</form></h4>
		<br><br><br>
		<h1>Enroll here to become a donor</h1>
		//sign in with google... then redirect to enrollform.php
		<form action='enrollform.php' method='post'>
			<p><input type='submit' value='Enroll'><p>
		</form>
		<?php
			if($_SERVER["REQUEST_METHOD"]=="POST")
			{		
				header("Location:communicatorbd.php");
			}
		?>
	</body>
</html>