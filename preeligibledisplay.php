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
		</style>
	</head>
	<body>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				require("logincredentials.php");
				$mydatabase = "BloodDonation";
				$myconnection = new mysqli($servername, $username, $password, $mydatabase);
				if ($myconnection->connect_error)
					die("Connection failed: " . $myconnection->connect_error);
				$sql= "SELECT * FROM donors
					ORDER BY email;";
				$sr=0;
				if ($myconnection->query($sql) == TRUE)
				{
					$result = $myconnection->query($sql);
					if ($result->num_rows > 0)
					{
   						while($row = $result->fetch_assoc())
						{
							$today=date("d/m/Y");
                    					$arr1=explode("/",$today);
							$a=$row['name'];
							$b=$row['email'];
                    					$c=$row['mobile'];
                   					$d=$row['bloodgroup'];
                   					$e=$row['lasttime'];
                   					$arr2=explode("/",$e);
                    					$date1=date_create($arr1[2]."-".$arr1[1]."-".$arr1[0]);
                    					$date2=date_create($arr2[2]."-".$arr2[1]."-".$arr2[0]);
                   					$diff=date_diff($date1,$date2);
                    					$f=$diff->format("%R%a");
							$f=$f*(-1);
							if($f>56)
							{
								$sql1= "SELECT * FROM eligibles
									WHERE email='$b';";
								if ($myconnection->query($sql1) == TRUE)
								{
									$result1 = $myconnection->query($sql1);
									if ($result1->num_rows == 0)
									{
										$sql2="INSERT INTO eligibles(name,email,mobile,bloodgroup,lasttime,timesincelast)
                                                VALUES ('$a','$b','$c','$d','$e','$f')";
										if($myconnection->query($sql2) == TRUE);
										else
										{
											$sr=$sr+1;
											echo "Error: " . $sql2 . "<br>" . $myconnection->error;
										}
									}
								}
								else
								{
									$sr=$sr+1;
									echo "Error: " . $sql1 . "<br>" . $myconnection->error;
								}
							}
  	 					}
					}
				}
				else
				{
					$sr=$sr+1;
					echo "Error: " . $sql . "<br>" . $myconnection->error;
				}
				if($sr==0)
					header("Location:displayeligible.php");
				$myconnection->close();
			}
		?>
	</body>
</html>