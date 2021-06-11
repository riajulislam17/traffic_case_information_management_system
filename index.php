<?php
	//site traffic
	if(isset($_COOKIE['sergeant']))
	{
		header("location: sergeant/search.php");
		echo "aaaaaa";
	}
	else if(isset($_COOKIE['admin']))
	{
		header("location: admin/index.php");
		echo "bbbbb";
	}
	if(isset($_COOKIE['driver']))
	{
		header("location: sergeant/search.php");
		echo "cccccc";
	}
	else
	{
		header("location: config/login.php");
		echo "ddddd";
	}
	var_dump($_COOKIE['sergeant']);

?>