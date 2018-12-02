<!DOCTYPE html>
<html>
	<head>
		<title>Create Tables</title>
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
		<h1>Creating the tables...</h1>
		<br><br><br>
		<form action="createbdt.php" method="post">
			<p><input type="submit" value="Create the tables"></p>
		</form>
		<br><br><br>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				require("logincredentials.php");
				$mydatabase="BloodDonation";
				$myconnection=new mysqli($servername,$username,$password,$mydatabase);
				if($myconnection->connect_error)
					die("Connection failed: ".$myconnection->connect_error);
				else
				{
					$sql="CREATE TABLE donors(
					name VARCHAR(120),
					email VARCHAR(100),
					mobile VARCHAR(120),
					bloodgroup VARCHAR(120),
					lasttime VARCHAR(120),
					timesincelast VARCHAR(120)
					);";
					$sql.="CREATE TABLE eligibles(
					name VARCHAR(120),
					email VARCHAR(100),
					mobile VARCHAR(120),
					bloodgroup VARCHAR(120),
					lasttime VARCHAR(120),
					timesincelast VARCHAR(120)
					);";
					$sql.="CREATE TABLE enrolledacceptors(
					name VARCHAR(120),
					email VARCHAR(100),
					mobile VARCHAR(120),
					bloodgroup VARCHAR(120),
					enrolldate VARCHAR(120)
					);";
					$sql.="CREATE TABLE enrolleddonors(
					name VARCHAR(120),
					email VARCHAR(100),
					mobile VARCHAR(120),
					bloodgroup VARCHAR(120),
					lasttime VARCHAR(120),
					timesincelast VARCHAR(120),
					enrolldate VARCHAR(120)
					);";
					if ($myconnection->multi_query($sql) === TRUE)
					{
    						header("Location:indexbd.php");
					}
					else
    						echo "Error: " . $sql . "<br>" . $myconnection->error;
				}
				$myconnection->close();
			}
		?>
	</body>
</html>
