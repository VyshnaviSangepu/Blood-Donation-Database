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
				background-color:pink;
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
				echo "<h1>Fill the form if you need blood:-</h1>";
				echo "<form action='addenrolledacceptor.php' method='post'>
					<p>Name:</p>
					<p><input type='text' name='name' title='Enter your full name.' required size='40' placeholder='Enter your full name'></p><br>
					<p>email-id:</p>
					<p><input type='text' name='email' pattern='[a-zA-Z0-9._]+@[a-zA-Z.]+' title='Enter your email-id.' required size='40' placeholder='Enter your email-id.'></p><br>
					<p>Mobile Number:</p>
					<p><input type='text' name='mobile' pattern='0{0,}[0-9]{10}' title='Enter your mobile number.' required size='40' placeholder='Enter your mobile number.'></p><br>
					<p>Your Blood Group:</p>
					<p><select name='bloodgroup'>
						    <option value='A+'>A+</option>
						    <option value='A-'>A-</option>
						    <option value='B+'>B+</option>
						    <option value='B-'>B-</option>
						    <option value='O+'>O+</option>
						    <option value='O-'>O-</option>
						    <option value='AB+'>AB+</option>
						    <option value='AB-'>AB-</option>
						  </select></p><br>
					<p><input type='submit' value='Ask for blood'></p>
				</form>";
			}
		?>
	</body>
</html>
