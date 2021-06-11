<?php

		$connect = mysqli_connect('localhost','root','','database');
		if(!$connect){echo"Database Connection Problem"; header("location: ../setup/setup.php");}
		$app_name = "Traffic Case Information";
	
?>