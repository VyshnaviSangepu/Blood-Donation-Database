<!DOCTYPE html>
<html>
	<head>
		<style>
			body
			{
				background-color: pink;
			}
			p
			{
				font-size: 25px;
				text-align: center;
				font-family: "Lucida Console", Monaco, monospace;
			}
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
				$mydatabase="BloodDonation";
				$myconnection=new mysqli($servername,$username,$password,$mydatabase);
				if($myconnection->connect_error)
					die("Connection failed: ".$myconnection->connect_error);
				else
				{
					$today=date("d/m/Y");
					$a=$_POST['name'];
					$b=$_POST['email'];
					$c=$_POST['mobile'];
					$d=$_POST['bloodgroup'];
					$sql="INSERT INTO enrolledacceptors(name,email,mobile,bloodgroup,enrolldate)
						VALUES ('$a','$b','$c','$d','$today')";
				
					if($myconnection->query($sql)==TRUE)
						echo "<p>Congratulations. You are enrolled. We will contact you as soon as we have what you need. This website works on first come-first serve basis. !</p>";
					else
						echo "Error: " . $sql . "<br>" . $myconnection->error;
				}
				$myconnection->close();
			}
		}
?>
	</body>
</html>
