<!DOCTYPE html>
<html>
	<head>
		<title>Home Page</title>
		<style>
		h1 { color:#cc0000; text-align: center; font-size: 60px;font-family: "Lucida Console", Monaco, monospace;}
		h3 { color:#b30000; text-align: center; font-size: 50px;}
		h6 {color:#b30000; text-align: center; font-size: 40px;}
		p{ text-align: center;}
		input[type=submit]
		{
   			font-size: 50px; 
			font-family: "Lucida Console", Monaco, monospace;
			background-color: #ff3333;
			color: white;
		}
		</style>
	</head>
	<body>
		<h1>Welcome !! This is our website :)</h1>
		<h6>Hi. We have made a project on the Blood Donation Database and Website. We have worked hard and hope our efforts pay off. To see what we have done, click the button below.</h6>
		<form action="homepage.php" method="post">
			<p><input type="submit" value="Explore"></p>
		</form>
		<img src="v2.jpg" width="360" height="125">
		<img id="v5" src="v6.jpg" align="right" width="402" height="125">
		<?php
			if($_SERVER["REQUEST_METHOD"]=="POST")
			{		
				header("Location:createbdd.php");
			}
		?>			
	</body>
</html>	
