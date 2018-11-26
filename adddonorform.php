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
				font-size: 20px;
    				padding: 12px;
			}
		</style>
	</head>
	<body>
		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				echo "
					<form action='communicatorbd.php' method='post'>
						<input type='submit' value='  Home   '>
					</form><br>";
				echo "
					<form action='displaydonor.php' method='post'>
						<input type='submit' value=' Donors  '>
					</form><br>";
				echo "
					<form action='displayeligible.php' method='post'>
						<input type='submit' value='Eligibles'>
					</form>";
				echo "<h1>Add a donor</h1>";
				echo "<form action='adddonor.php' method='post'>
					<p>Name:</p>
					<p><input type='text' name='name' pattern='[a-zA-Z]+ [a-zA-Z]+' title='Enter your full name.' required size='40' placeholder='Enter your full name'></p><br>
					<p>email-id:</p>
					<p><input type='text' name='email' pattern='[a-zA-Z0-9._]+@iitdh.ac.in' title='Enter your iitdh email-id.' required size='40' placeholder='Enter your iitdh email-id.'></p><br>
					<p>Mobile Number:</p>
					<p><input type='text' name='mobile' pattern='0{0,}[0-9]{10}' title='Enter your mobile number.' required size='40' placeholder='Enter your mobile number.'></p><br>
					<p>Blood Group:</p>
					<p><input type='text' name='bloodgroup' pattern='[A-Z]{1,2}[+-]{1}' title='Enter your blood group in capital letters.' required size='40' placeholder='Enter your blood group in capital letters.'></p><br>
					<p>Last Donation Date:</p>
					<p><input type='text' name='lasttime' pattern='[0-9]{2}/[0-9]{2}/[0-9]{4}' title='Format : dd/mm/yyyy' placeholder='dd/mm/yyyy' required size='40'></p><br>
					<p><input type='submit' value='   Add   '></p>
				</form>";
			}
		?>
	</body>
</html>