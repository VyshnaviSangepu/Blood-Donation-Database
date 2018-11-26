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
			$arr1=explode("/",$today);
			$a=$_POST['name'];
			$b=$_POST['email'];
			$c=$_POST['mobile'];
			$d=$_POST['bloodgroup'];
			$e=$_POST['lasttime'];
			$arr2=explode("/",$e);
			$wrong=0;
			$wrongbg=0;
			if((strcmp($d,"A+")!=0)&&(strcmp($d,"A-")!=0)&&(strcmp($d,"B+")!=0)&&(strcmp($d,"B-")!=0)&&(strcmp($d,"O+")!=0)&&(strcmp($d,"O-")!=0)&&(strcmp($d,"AB+")!=0)&&(strcmp($d,"AB-")!=0))
				$wrongbg=1;
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
			if(($wrong==0)&&($wrongbg==0))
			{
				$date1=date_create($arr1[2]."-".$arr1[1]."-".$arr1[0]);
				$date2=date_create($arr2[2]."-".$arr2[1]."-".$arr2[0]);
				$diff=date_diff($date1,$date2);
				$f=$diff->format("%R%a");
				if($diff->format("%R%a")>0)
				{
					echo "<p>Invalid date</p>";
					echo "
						<form action='enrollform.php' method='post'>
							<input type='submit' value='Try to enroll again'>
						</form>";
				}
				else
				{
					$f=$f*(-1);
					$sql="INSERT INTO enrolleddonors(name,email,mobile,bloodgroup,lasttime,timesincelast,enrolldate)
						VALUES ('$a','$b','$c','$d','$e','$f','$today')";
				
					if($myconnection->query($sql)==TRUE)
						echo "<p>Congratulations. You are enrolled. If your details are found authentic, the admin will consider you for future donations !</p>";
					else
						echo "Error: " . $sql . "<br>" . $myconnection->error;
				}
			}
			else
			{
				if($wrong==1)
					echo "<p>Please enter a valid date.</p><br>";
				if($wrongbg==1)
					echo "<p>Please enter a valid blood group.</p><br><br>";
				echo "
				<form action='enrollform.php' method='post'>
					<input type='submit' value='Try to enroll again'>
				</form>";
			}
		}
		$myconnection->close();
	}
?>
	</body>
</html>