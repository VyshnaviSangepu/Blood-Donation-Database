<!DOCTYPE html>
<html>
	<head>
		<title>CommunicatorBD</title>
		<style>
		h1 { color: #e60000; text-align: center; font-size: 50px;font-family: "Lucida Console", Monaco, monospace;}
		p {text-align: center; font-family: "Lucida Console", Monaco, monospace;padding-left: 5em;}
		input[type=submit]
		{
   			font-size: 40px; 
			font-family: "Lucida Console", Monaco, monospace;
			background-color: #ff3333;
			color: white;
		}
		body {
    background-image: url("v4.jpg");
    background-repeat: no-repeat;
	background-position: left center;
}
		</style>
	</head>
	<body>
		<h1>IIT Dharwad Blood Donation Database</h1>
		<br><br><br>
		<form method="post" action="displaydonor.php">
			<p><input type="submit" value="Display the donors table"></p>
		</form>
		<br>
		<form method="post" action="displayeligible.php">
			<p><input type="submit" value="Display the eligibles table"s></p>
		</form>
		<br>
		<form method="post" action="displayenrolled.php">
			<p><input type="submit" value="Display enrolled donors"></p>
		</form>
		<br><br><br><br><br><br><br><br>
	</body>
</html>	