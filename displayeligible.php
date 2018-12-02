<!DOCTYPE html>
<html>
	<head>
		<style>
			h2
			{
				text-align: right;
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
				height: 55px;
				font-size: 25px;
				font-family: "Lucida Console", Monaco, monospace;
				background-color: palevioletred;
				color: black;
			}
			td
			{
				height: 40px;
   				font-size: 20px;
				font-family: "Lucida Console", Monaco, monospace;
			}
			tr:nth-child(even){background-color: #ebadc2;}	
			input[type=submit]
			{
   				font-size: 25px; 
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
		<?php
				echo "
					<form action='communicatorbd.php' method='post'>
						<input type='submit' value='      Home       '>
					</form><br>";
				echo "
					<form action='displaydonor.php' method='post'>
						<input type='submit' value='      Donors     '>
					</form><br>";
				echo "
					<form action='displayenrolled.php' method='post'>
						<input type='submit' value='Enrolled donors'>
					</form>";
				echo "
					<form action='eligibleblood.php' method='post'>
						<h2><input type='submit' value='Search for Blood'><br><br>
						<select name='blood'>
						    <option value='A+'>A+</option>
						    <option value='A-'>A-</option>
						    <option value='B+'>B+</option>
						    <option value='B-'>B-</option>
						    <option value='O+'>O+</option>
						    <option value='O-'>O-</option>
						    <option value='AB+'>AB+</option>
						    <option value='AB-'>AB-</option>
						  </select><br>
						</h2>
					</form>";
				echo "<h1>Eligibles Table</h1>";
				require("logincredentials.php");
				$mydatabase = "BloodDonation";
				$myconnection = new mysqli($servername, $username, $password, $mydatabase);
				if ($myconnection->connect_error)
					die("Connection failed: " . $myconnection->connect_error);
				$sql= "SELECT * FROM eligibles
					ORDER BY email;";
				if ($myconnection->query($sql) == TRUE)
				{
					$result = $myconnection->query($sql);
					echo "
						<table style='width:100%'>
								<tr>
								<th>Name</th>
								<th>email-id</th>
								<th>Mobile Number</th>
								<th>Blood Group</th>
								<th>Last Donation</th>
							<tr>";
					if ($result->num_rows > 0)
					{
   						while($row = $result->fetch_assoc())
						{
							echo " <tr>
									<td style='text-align:center;'>".$row['name']."</td>
									<td style='text-align:center;'>".$row['email']."</td>
									<td style='text-align:center;'>".$row['mobile']."</td>
									<td style='text-align:center;'>".$row['bloodgroup']."</td>
									<td style='text-align:center;'>".$row['lasttime']."</td>
									</tr>";
  	 					}
					}
				}
				else
					echo "Error: " . $sql . "<br>" . $myconnection->error;
				$myconnection->close();
		?>
	</body>
</html>
