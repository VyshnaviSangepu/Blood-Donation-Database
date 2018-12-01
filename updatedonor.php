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
			$a=$_POST['updatedlasttime'];
			$c=$_POST['timesincelast'];
			$b=$_POST['email'];
			$a1=$_POST['name'];
			$a2=$_POST['mobile'];
			$a3=$_POST['bloodgroup'];
			$today=date("d/m/Y");
			$arr1=explode("/",$today);
			$arr2=explode("/",$a);
			$wrong=0;
			if(($arr2[2]%400==0)||(($arr2[2]%100!=0)&&($arr2[2]%4==0)))
			{
				if(($arr2[1]==1)||($arr2[1]==3)||($arr2[1]==5)||($arr2[1]==7)||($arr2[1]==8)||($arr2[1]==10)||($arr2[1]==12))
				{
					if(($arr2[0]<1)||($arr2[0]>31))
						$wrong=1;
				}
				else if($arr2[1]==2)
				{
					if(($arr2[0]<1)||($arr2[0]>29))
						$wrong=1;
				}
				else if(($arr2[1]==4)||($arr2[1]==6)||($arr2[1]==9)||($arr2[1]==11))
				{
					if(($arr2[0]<1)||($arr2[0]>30))
						$wrong=1;
				}
				else
					$wrong=1;
			}
			else
			{
				if(($arr2[1]==1)||($arr2[1]==3)||($arr2[1]==5)||($arr2[1]==7)||($arr2[1]==8)||($arr2[1]==10)||($arr2[1]==12))
				{
					if(($arr2[0]<1)||($arr2[0]>31))
						$wrong=1;
				}
				else if($arr2[1]==2)
				{
					if(($arr2[0]<1)||($arr2[0]>28))
						$wrong=1;
				}
				else if(($arr2[1]==4)||($arr2[1]==6)||($arr2[1]==9)||($arr2[1]==11))
				{
					if(($arr2[0]<1)||($arr2[0]>30))
						$wrong=1;
				}
				else
					$wrong=1;
			}
			if($wrong==0)
			{
			$date1=date_create($arr1[2]."-".$arr1[1]."-".$arr1[0]);
			$date2=date_create($arr2[2]."-".$arr2[1]."-".$arr2[0]);
			$diff=date_diff($date1,$date2);
			$difference=$diff->format("%R%a");
			if($difference>0)
						echo "<p>Invalid date ( It's funny, you have entered a future date )</p>";
			else
			{
				$difference=$difference*(-1);
				$sql="UPDATE donors
					SET lasttime='$a', timesincelast='$difference'
					WHERE email='$b';";
				if($myconnection->query($sql)==TRUE)
				{
					echo "<p>Last time updated</p><br><br>";
					if(($c>56)&&($difference>56))
					{
						echo "<p>The donor was eligible before and after the changes</p><br><br>";
						$sql1="UPDATE eligibles
							SET lasttime='$a', timesincelast='$difference'
							WHERE email='$b';";
						if($myconnection->query($sql1)==TRUE)
							echo "<p>The donor has been updated in eligibles table too.</p><br><br>";
						else
							echo "Error: " . $sql1 . "<br>" . $myconnection->error;
					}
					else if($c>56)
					{
						echo "<p>This donor was eligible before but is not longer eligible now.</p><br><br>";
						$sql1="DELETE FROM eligibles
						WHERE email='$b';";
						if($myconnection->query($sql1)==TRUE)
							echo "<p>The donor has been deleted from the eligibles table.</p><br><br>";
						else
							echo "Error: " . $sql1 . "<br>" . $myconnection->error;
					}
					else if($difference>56)
					{
						echo "<p>The formal ineligible donor is now eligible for donation</p>"."<br><br>";
						$sql1="INSERT INTO eligibles(name,email,mobile,bloodgroup,lasttime,timesincelast)
								VALUES ('$a1','$b','$a2','$a3','$a','$c')";
						if($myconnection->query($sql1)==TRUE)
							echo "<p>The donor has been added to the eligibles table.</p><br><br>";
						else
							echo "Error: " . $sql1 . "<br>" . $myconnection->error;
					}
					else
						  echo "<p>The donor was neither eligible before, nor is eligible now.</p><br><br>";
				}
				else
					echo "Error: " . $sql . "<br>" . $myconnection->error;
				echo "<br><br><br>";
			}
			}
			else
			{
				echo "<p>Please enter a valid date.</p><br><br><br>";
			}
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