<!DOCTYPE html>
<html>
	<head>
		<title>Create database</title>
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
   				font-size: 45px; 
				font-family: "Lucida Console", Monaco, monospace;
				background-color: plum;
			}
			input[type=text], select
			{
				font-size: 25px;
			}
		</style>
	</head>
	<body>
		<h1>Creating the Blood donation database...</h1>
		<br><br><br>
		<form action="createbdd.php" method="post">
			<p><input type="submit" value="Create the database, BloodDonation"></p>
		</form>
		<br><br><br>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				require("logincredentials.php");
				$myconnection=new mysqli($servername,$username,$password);
				if($myconnection->connect_error)
					die("Connection failed: ".$myconnection->connect_error);
				else
				{
					$sql="CREATE DATABASE BloodDonation";
					if($myconnection->query($sql)===TRUE)
					{	
						header("Location:createbdt.php");
					}
					else
						echo "An error occurred and database could not be created: ".$myconnection->error;
				}
				$myconnection->close();
			}
		?>
	</body>
</html>