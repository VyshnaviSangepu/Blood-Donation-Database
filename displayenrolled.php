<!DOCTYPE html>
<html>
	<head>
		<style>
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
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				echo "
					<form action='communicatorbd.php' method='post'>
						<input type='submit' value='   Home    '>
					</form>";
				echo "<br>";
				echo "
					<form action='displaydonor.php' method='post'>
						<input type='submit' value='  Donors   '>
					</form><br>";
				echo "
					<form action='preeligibledisplay.php' method='post'>
						<input type='submit' value='Eligibles'>
					</form><br>";
				echo "<h1>Enrolled Donors</h1>";
				require("logincredentials.php");
				$mydatabase = "BloodDonation";
				$myconnection = new mysqli($servername, $username, $password, $mydatabase);
				if ($myconnection->connect_error)
					die("Connection failed: " . $myconnection->connect_error);
				$sql = "SELECT * FROM enrolleddonors
						ORDER BY email;";
				if ($myconnection->query($sql) == TRUE)
				{
					$result = $myconnection->query($sql);
					echo "
						<table style='width:100%'>
							<tr>
								<th>Name</th>
								<th>email-id</th>
								<th>Mobile number</th>
								<th>Blood group</th>
								<th>Last Donation</th>
								<th>Last modified</th>
								<th>Remove</th>
								<th>Add to donors</th>
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
									<td style='text-align:center;'>".$row['enrolldate']."</td>
									<td style='text-align:center;'>".
										"<form action='delenrolleddonor.php' method='post'>
											<input type='hidden' name='name' value='".$row['name']."'>
											<input type='hidden' name='email' value='".$row['email']."'>
											<input type='hidden' name='mobile' value='".$row['mobile']."'>
											<input type='hidden' name='bloodgroup' value='".$row['bloodgroup']."'>
											<input type='hidden' name='lasttime' value='".$row['lasttime']."'>
											<input type='hidden' name='enrolldate' value='".$row['enrolldate']."'>
											<input type='submit' value='Remove'>
										</form>"."</td>
									<td style='text-align:center;'>".
										"<form action='adddonor.php' method='post'>
											<input type='hidden' name='name' value='".$row['name']."'>
											<input type='hidden' name='email' value='".$row['email']."'>
											<input type='hidden' name='mobile' value='".$row['mobile']."'>
											<input type='hidden' name='bloodgroup' value='".$row['bloodgroup']."'>
											<input type='hidden' name='lasttime' value='".$row['lasttime']."'>
											<input type='hidden' name='enrolldate' value='".$row['enrolldate']."'>
											<input type='submit' value='Add'>
										</form>"."</td>
								</tr>";
    						}
					}
				}
				else
					echo "Error: " . $sql . "<br>" . $myconnection->error;
				$myconnection->close();
			}
		?>
	</body>
</html>
