<?php
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{	
		$a=$_POST['adminpassword'];
		if($a=="suchitra1")	
			header("Location:communicatorbd.php");
		else
			echo "Incorrect password";
	}
?>
