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
			echo "
				<form action='communicatorbd.php' method='post'>
					<input type='submit' value='Home'>
				</form>";
			echo "<br><br><br>";
			$a=$_POST['email'];
			$b=$_POST['lasttime'];
			$today=date("d/m/Y");
			$arr1=explode("/",$today);
			$arr2=explode("/",$b);
			$date1=date_create($arr1[2]."-".$arr1[1]."-".$arr1[0]);
			$date2=date_create($arr2[2]."-".$arr2[1]."-".$arr2[0]);
			$diff=date_diff($date1,$date2);
			$f=$diff->format("%R%a");
			$sql="DELETE FROM donors
				WHERE email='$a';";
			if($myconnection->query($sql)==TRUE)
			{
				$c=$f*(-1);
				echo "<p>Donor deleted.</p><br><br>";
				if($c>56)
				{
					echo "<p>The deleted donor was eligible for donating blood</p><br><br>";
					$sql1="DELETE FROM eligibles
						WHERE email='$a';";
					if($myconnection->query($sql1)==TRUE)
						echo "<p>The donor deleted from the eligibles table</p><br><br>";
					else
						echo "Error: " . $sql1 . "<br>" . $myconnection->error;
				}
				else
					echo "<p>The deleted donor was ineligible for donating blood</p><br><br>";
			}
			else
				echo "Error: " . $sql . "<br>" . $myconnection->error;
			echo "<br>";
			echo "
				<form action='displaydonor.php' method='post'>
					<input type='submit' value='View the donors table'>
				</form><br><br>";
			echo "
				<form action='preeligibledisplay.php' method='post'>
					<input type='submit' value='View the eligibles table'>
				</form>";
		}
		$myconnection->close();
	}
?>
	</body>
</html>